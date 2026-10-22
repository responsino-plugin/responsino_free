import { utils, logger } from '../components/responsino-form-utils.js';
import { config } from '../components/responsino-form-config.js';
import { RESPONSINOFormValidator } from '../components/responsino-form-frontend-form-validation.js';
import { __ } from '../components/responsino-i18n.js';
import { fields } from '../components/responsino-form-fields.js';

(function() {
    let parsedOverlays = [];
    if (typeof window.responsinoActiveOverlayData !== "undefined" && window.responsinoActiveOverlayData.overlayData) {
        try {
            const parsed = JSON.parse(window.responsinoActiveOverlayData.overlayData);
            if (Array.isArray(parsed)) {
                parsedOverlays = parsed;
            }
        } catch (e) {
            console.error("RESPONSINO: Error while parsing responsinoActiveOverlayData.overlayData:", e);
        }
    } else if (Array.isArray(window.responsinoActiveOverlays)) {
        parsedOverlays = window.responsinoActiveOverlays;
    }
    window.responsinoActiveOverlays = parsedOverlays;
})();

const api = {
    fetchFormsData: function(formIds) {
        if (typeof responsinoFormFrontend === "undefined") {
            console.error("RESPONSINO: responsinoFormFrontend is not defined. AJAX cannot be performed.");
            return Promise.reject("responsinoFormFrontend not defined");
        }
        const formData = new FormData();
        formData.append('action', 'responsino_get_forms_data');
        formData.append('nonce', responsinoFormFrontend.nonce);
        Array.from(formIds).forEach(id => formData.append('form_ids[]', id));

        return fetch(responsinoFormFrontend.ajaxurl, {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error(`HTTP error! status: ${response.status}, body: ${text}`);
                    });
                }
                return response.json();
            });
    },

    submitFeedback: function(formId, answers, formType = 'shortcode', containerEl = null, activeStep2TriggerId = '') {
        if (typeof responsinoFormFrontend === "undefined") {
            console.error("RESPONSINO: responsinoFormFrontend is not defined. AJAX cannot be performed.");
            return Promise.reject("responsinoFormFrontend not defined");
        }
        const formData = new FormData();
        formData.append('action', 'responsino_submit_feedback');
        formData.append('nonce', responsinoFormFrontend.nonce);
        formData.append('form_id', formId);
        formData.append('form_type', formType);
        formData.append('answers', JSON.stringify(answers));

        // Get activeStep2TriggerId
        let finalTriggerId = activeStep2TriggerId || '';
        if (!finalTriggerId && containerEl) {
            finalTriggerId = containerEl.responsinoStep2TriggerId || '';
        }
        if (finalTriggerId) {
            formData.append('active_step2_trigger_id', finalTriggerId);
        }

        const stateObj = containerEl ? containerEl.responsinoStateObj : null;
        const trackingData = utils.getTrackingData(stateObj);
        formData.append('tracking_data', JSON.stringify(trackingData));

        let hpValue = "";
        if (containerEl) {
            const hpInput = containerEl.querySelector('input[name="responsino_hp_field"]');
            if (hpInput) {
                hpValue = hpInput.value;
            }
        } else {
            const hpInput = document.querySelector(`[data-form-id="${formId}"] input[name="responsino_hp_field"]`);
            if (hpInput) {
                hpValue = hpInput.value;
            }
        }
        formData.append('responsino_hp_field', hpValue);

        return fetch(responsinoFormFrontend.ajaxurl, {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error(`HTTP error! status: ${response.status}, body: ${text}`);
                    });
                }
                return response.json();
            });
    }
};

class ResponsinoOverlayController {
    static instances = new Set();

    static closeAll(formId) {
        ResponsinoOverlayController.instances.forEach(instance => {
            if (String(instance.formId) === String(formId)) {
                instance.close();
            }
        });
    }

    constructor(config) {
        this.config = config;
        this.formId = config.id;
        this.overlayId = `responsino-overlay-container-${this.formId}`;
        this.overlayEl = null;
        this.innerPlaceholderEl = null;
        this.standardBtnEl = null;
        this.isTriggered = false;
        this.delayTimer = null;
        this.scrollListener = null;
        this.escKeyListener = null;
        this.backdropListener = null;

        ResponsinoOverlayController.instances.add(this);
    }

    init() {
        if (this.isFrequencyCapped()) {
            console.log(`RESPONSINO Overlay: Form ${this.formId} is frequency capped. Skipping trigger registration.`);
            this.hideTrigger();
            return;
        }

        if (this.config.triggerSettings.useStandard) {
            this.createFeedbackButton();

            window.addEventListener('resize', () => {
                const feedbackButton = document.querySelector('.responsino-feedback-button-widget-button');
                if (feedbackButton) {
                    document.body.removeChild(feedbackButton.parentNode);
                }

                this.createFeedbackButton();
            });
        }

        this.setupTrigger();
    }

    hideTrigger() {
        // Hide standard feedback button if it exists
        if (this.standardBtnEl) {
            const wrapper = this.standardBtnEl.closest(".responsino-feedback-plugin");
            if (wrapper) {
                wrapper.style.display = "none";
            } else {
                this.standardBtnEl.style.display = "none";
            }
        }

        // Hide custom click selectors if defined
        if (this.config.trigger === 'click'
            && this.config.triggerSettings
            && this.config.triggerSettings.clickSelector
            && this.config.triggerSettings.hideOnClose
        ) {
            try {
                const targets = document.querySelectorAll(this.config.triggerSettings.clickSelector);
                targets.forEach(target => {
                    target.style.display = "none";
                });
            } catch (e) {
                console.warn("RESPONSINO: Error hiding custom selectors", e);
            }
        }
    }

    isFrequencyCapped() {
        if (this.config && this.config.isPreview) {
            return false;
        }
        const scope = (this.config.globalData && this.config.globalData.cookieScope) || "domain";
        const pathHash = (window.responsinoFormFrontend && window.responsinoFormFrontend.pathHash) ? `_${window.responsinoFormFrontend.pathHash}` : "";
        const pathKey = scope === "page" ? pathHash : "";
        const closeCookie = `responsino_closed_${this.formId}${pathKey}`;
        const submitCookie = `responsino_submitted_${this.formId}${pathKey}`;
        if (utils.getCookie(closeCookie) || utils.getCookie(submitCookie)) {
            return true;
        }
        return false;
    }

    createFeedbackButton() {
        const targetContainer = (this.config && this.config.targetContainer) || document.body;
        if (targetContainer.querySelector('.responsino-feedback-button-widget-button')) {
            console.log("RESPONSINO Overlay: feedback-button already exists in this container.");
            return;
        }

        const btnId = `responsino-standard-feedback-btn-${this.formId}`;
        const btn = document.createElement("button");
        btn.id = btnId;

        const fbConf = (this.config.triggerSettings && this.config.triggerSettings.feedbackButton) || {};

        btn.classList = `responsino-feedback-button-widget-button`;
        if (window.matchMedia("(max-width: 767px)").matches) {
            const icon = document.createElement("i");
            icon.className = "fa-solid fa-comment-dots responsino-feedback-button-widget-button-icon";
            btn.appendChild(icon);
        } else {
            const textSpan = document.createElement("span");
            textSpan.className = "responsino-feedback-button-widget-button-text";
            textSpan.textContent = fbConf.text || "Feedback";
            btn.appendChild(textSpan);

            const position = fbConf.position || "right-middle";
            const posClass = `responsino-feedback-button-widget-button--${position}`;
            btn.classList.add(posClass);
        }

        if (fbConf.customStylesEnabled !== false) {
            if (fbConf.bgColor) btn.style.setProperty('--responsino-fb-btn-bg', fbConf.bgColor);
            if (fbConf.textColor) btn.style.setProperty('--responsino-fb-btn-color', fbConf.textColor);
            if (fbConf.borderColor) btn.style.setProperty('--responsino-fb-btn-border', fbConf.borderColor);
            if (fbConf.hoverBgColor) btn.style.setProperty('--responsino-fb-btn-hover-bg-color', fbConf.hoverBgColor);
            if (fbConf.hoverTextColor) btn.style.setProperty('--responsino-fb-btn-hover-color', fbConf.hoverTextColor);
            if (fbConf.hoverBorderColor) btn.style.setProperty('--responsino-fb-btn-hover-border-color', fbConf.hoverBorderColor);
            if (fbConf.fontSize) btn.style.fontSize = `${fbConf.fontSize}px`;
        }

        btn.addEventListener("click", () => {
            this.open();
            targetContainer.classList.add("responsino-feedback-button-widget-is-open");
        });

        const wrapper = document.createElement("div");
        wrapper.className = "responsino-feedback-plugin";
        wrapper.appendChild(btn);

        targetContainer.appendChild(wrapper);
        this.standardBtnEl = btn;

        if (this.config && this.config.isPreview) {
            btn.classList.add('responsino-feedback-button-widget-button--visible');
        } else {
            const handleScroll = () => {
                if (window.matchMedia("(min-width: 768px)").matches) {
                    const scrollThreshold = 400;
                    const maxScroll = Math.max(
                        0,
                        document.documentElement.scrollHeight - window.innerHeight
                    );

                    // Wenn die Seite weniger als 400px scrollbar ist: immer anzeigen
                    // Andernfalls: erst ab Erreichen der 400px anzeigen
                    const isShortPage = maxScroll < scrollThreshold;
                    const hasScrolledPastThreshold = window.scrollY > scrollThreshold;

                    if (isShortPage || hasScrolledPastThreshold) {
                        btn.classList.add('responsino-feedback-button-widget-button--visible');
                    } else {
                        btn.classList.remove('responsino-feedback-button-widget-button--visible');
                    }
                } else {
                    btn.classList.remove('responsino-feedback-button-widget-button--visible');
                }
            };

            window.addEventListener('scroll', handleScroll);
            handleScroll();
        }
    }

    setupTrigger() {
        const type = this.config.trigger || "click";

        if (type === "click") {
            const selector = this.config.triggerSettings.clickSelector;
            if (selector) {
                const setupClickListeners = () => {
                    try {
                        const targets = document.querySelectorAll(selector);
                        targets.forEach(target => {
                            if (!target.dataset.responsinoHasOverlayListener) {
                                target.dataset.responsinoHasOverlayListener = "true";
                                target.addEventListener("click", (e) => {
                                    e.preventDefault();
                                    this.open();
                                });
                            }
                        });
                    } catch (e) {}
                };
                setupClickListeners();
                setTimeout(setupClickListeners, 1000);
                setTimeout(setupClickListeners, 3000);
            }
        } else if (type === "exit-intent") {
            let triggeredOnThisSession = false;
            const sessionStartTime = Date.now();
            const exitDelay = (this.config.triggerSettings && this.config.triggerSettings.exitIntentDelay) || "immediate";
            let requiredMs = 0;
            if (exitDelay === "5s") requiredMs = 5000;
            else if (exitDelay === "10s") requiredMs = 10000;
            else if (exitDelay === "60s") requiredMs = 60000;

            const exitListener = (e) => {
                if (triggeredOnThisSession) return;
                if (Date.now() - sessionStartTime < requiredMs) return;
                if (e.clientY < 20) {
                    triggeredOnThisSession = true;
                    document.removeEventListener("mouseleave", exitListener);
                    this.open();
                }
            };
            document.addEventListener("mouseleave", exitListener);
        } else if (type === "delay") {
            const delaySeconds = this.config.triggerSettings.delaySeconds || 5;
            this.delayTimer = setTimeout(() => {
                this.open();
            }, delaySeconds * 1000);
        } else if (type === "scroll") {
            const scrollType = this.config.triggerSettings.scrollType || "end";
            const percent = this.config.triggerSettings.scrollPercent || 50;

            this.scrollListener = () => {
                const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                if (docHeight <= 0) return;

                const scrolled = window.scrollY;
                if (scrollType === "end") {
                    if (scrolled >= docHeight - 10) {
                        this.open();
                    }
                } else if (scrollType === "percent") {
                    const currentPercent = (scrolled / docHeight) * 100;
                    if (currentPercent >= percent) {
                        this.open();
                    }
                }
            };

            window.addEventListener("scroll", this.scrollListener);
        }
    }

    open() {
        if (!this.config.isPreview && this.isTriggered) return;
        if (this.isTriggered) return;
        if (this.isFrequencyCapped()) return;

        this.isTriggered = true;

        if (this.scrollListener) {
            window.removeEventListener("scroll", this.scrollListener);
            this.scrollListener = null;
        }

        const targetContainer = (this.config && this.config.targetContainer) || document.body;
        let overlay = document.getElementById(this.overlayId);

        if (!overlay) {
            const template = document.getElementById("responsino-general-overlay-template");
            const position = this.config.globalData.position || "center";
            const showBackdrop = this.config.globalData.showBackdrop !== false && this.config.globalData.showBackdrop !== "0" && this.config.globalData.showBackdrop !== 0;
            const noBackdropClass = showBackdrop ? "" : " responsino-overlay-no-backdrop";

            if (template) {
                const clone = template.content.cloneNode(true);
                overlay = clone.querySelector(".responsino-feedback-plugin");

                overlay.id = this.overlayId;
                const previewClass = this.config.isPreview ? " responsino-preview-mode" : "";
                overlay.className = `responsino-feedback-plugin responsino-general-overlay-backdrop responsino-overlay-pos-${position}${noBackdropClass}${previewClass}`;

                const customStyleClasses = this.config?.style?.customClasses || '';
                if (customStyleClasses) {
                    overlay.classList.add(...this.config.style.customClasses.split(" ").filter(Boolean));
                }

                const modal = overlay.querySelector(".responsino-general-overlay-modal");
                if (modal) {
                    modal.className = `responsino-general-overlay-modal responsino-overlay-card-pos-${position}`;
                }

                const closeBtn = overlay.querySelector("#responsino-general-overlay-close-button") || overlay.querySelector(".responsino-general-overlay-close-button");
                if (closeBtn) {
                    closeBtn.addEventListener("click", () => this.close());
                }

                const placeholder = overlay.querySelector("#responsino-general-overlay-content") || overlay.querySelector(".responsino-feedback-type-placeholder");
                if (placeholder) {
                    placeholder.id = `responsino-general-overlay-content-${this.formId}`;
                    placeholder.setAttribute("data-form-id", this.formId);
                    placeholder.setAttribute("data-type", "overlay");
                    this.innerPlaceholderEl = placeholder;
                }

                targetContainer.appendChild(overlay);
                this.overlayEl = overlay;
            } else {
                overlay = document.createElement("div");
                overlay.id = this.overlayId;
                const previewClass = this.config.isPreview ? " responsino-preview-mode" : "";
                overlay.className = `responsino-feedback-plugin responsino-general-overlay-backdrop responsino-overlay-pos-${position}${noBackdropClass}${previewClass}`;

                const container = document.createElement("div");
                container.className = `responsino-general-overlay-modal responsino-overlay-card-pos-${position}`;

                const header = document.createElement("div");
                header.className = "responsino-overlay-header";

                const backBtn = document.createElement("button");
                backBtn.id = "responsino-general-overlay-back-button";
                backBtn.className = "responsino-general-overlay-icon-btn";
                backBtn.style.cssText = "display: none;";
                backBtn.innerHTML = '<i class="fa-solid fa-arrow-left"></i>';
                header.appendChild(backBtn);

                const indicatorWrapper = document.createElement("div");
                indicatorWrapper.className = "responsino-overlay-header-indicator-wrapper";

                const pbContainer = document.createElement("div");
                pbContainer.className = "responsino-general-overlay-progress-bar-container";
                pbContainer.style.cssText = "display: none;";
                const pbBar = document.createElement("div");
                pbBar.className = "responsino-general-overlay-progress-bar";
                pbContainer.appendChild(pbBar);
                indicatorWrapper.appendChild(pbContainer);

                const titleEl = document.createElement("div");
                titleEl.className = "responsino-overlay-header-title";
                titleEl.style.cssText = "display: none;";
                titleEl.textContent = this.config.name || "Feedback";
                indicatorWrapper.appendChild(titleEl);

                const stepIndicator = document.createElement("div");
                stepIndicator.className = "responsino-overlay-header-step-indicator";
                stepIndicator.style.cssText = "display: none;";
                indicatorWrapper.appendChild(stepIndicator);

                header.appendChild(indicatorWrapper);

                const closeBtn = document.createElement("button");
                closeBtn.id = "responsino-general-overlay-close-button";
                closeBtn.className = "responsino-general-overlay-icon-btn";
                closeBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
                closeBtn.addEventListener("click", () => this.close());
                header.appendChild(closeBtn);

                container.appendChild(header);

                const body = document.createElement("div");
                body.className = "responsino-overlay-body";

                const placeholder = document.createElement("div");
                placeholder.className = "responsino-feedback-type-placeholder";
                placeholder.id = `responsino-general-overlay-content-${this.formId}`;
                placeholder.setAttribute("data-form-id", this.formId);
                placeholder.setAttribute("data-type", "overlay");
                body.appendChild(placeholder);

                container.appendChild(body);

                const footer = document.createElement("div");
                footer.className = "responsino-overlay-footer";
                footer.textContent = (this.config.style && this.config.style.customFooterText !== undefined && this.config.style.customFooterText !== null && this.config.style.customFooterText !== "")
                    ? this.config.style.customFooterText
                    : __('admin.frontend.default_footer_text');
                container.appendChild(footer);

                overlay.appendChild(container);
                targetContainer.appendChild(overlay);

                this.overlayEl = overlay;
                this.innerPlaceholderEl = placeholder;
            }
        } else {
            this.overlayEl = overlay;
            this.innerPlaceholderEl = overlay.querySelector(".responsino-feedback-type-placeholder") || overlay.querySelector(`#responsino-general-overlay-content-${this.formId}`);
        }

        this.overlayEl.offsetHeight;

        // Apply slide-in animations (resetting previous states if reused)
        const modal = this.overlayEl.querySelector(".responsino-general-overlay-modal");

        if (modal) {
            const subType = this.config.displaySubType || "modal";
            const position = this.config.globalData.position || "center";
            modal.classList.remove("slide-out-left", "slide-out-right", "slide-in-left", "slide-in-right");

            if (subType === "slide-in") {
                const isLeft = position.includes("left") || position === "left-middle";
                const isRight = position.includes("right") || position === "right-middle";
                if (isLeft) modal.classList.add("slide-in-left");
                else if (isRight) modal.classList.add("slide-in-right");
            }
        }

        this.overlayEl.classList.add("responsino-overlay-is-visible");

        const allowScroll = (this.config.globalData && this.config.globalData.allowBodyScroll);
        if (!this.config.isPreview && !allowScroll) {
            document.body.style.overflow = "hidden";
        }

        // Hide header/footer if configured
        const hideHeader = (this.config.globalData && this.config.globalData.hideHeader);
        const hideFooter = (this.config.globalData && this.config.globalData.hideFooter);
        const headerEl = this.overlayEl.querySelector(".responsino-overlay-header");
        const footerEl = this.overlayEl.querySelector(".responsino-overlay-footer");
        if (hideHeader && headerEl) headerEl.style.display = "none";
        if (hideFooter && footerEl) footerEl.style.display = "none";

        this.loadFormContent();
    }

    loadFormContent() {
        if (this.config && this.config.stateObj) {
            this.renderForm(this.config.stateObj);
            return;
        }
        const checkAndRender = () => {
            const cachedForm = window.responsinoCachedData && window.responsinoCachedData[this.formId];
            if (cachedForm && cachedForm.formData) {
                const stateObj = cachedForm.formData;
                this.renderForm(stateObj);
            } else {
                setTimeout(checkAndRender, 100);
            }
        };
        checkAndRender();
    }

    renderForm(stateObj) {
        const display = stateObj?.settings?.display || {};
        const displayType = display.displayType || "overlay";
        const displaySubType = display.displaySubType || "modal";
        const subTypeSettings = display.subTypeData?.[displaySubType] || {};

        const headerIndicator = (displayType === "overlay" && this.config && this.config.style) ? (this.config.style.headerIndicator || "title") : ((subTypeSettings.globalData && subTypeSettings.globalData.design && subTypeSettings.globalData.design.headerIndicator !== undefined)
            ? subTypeSettings.globalData.design.headerIndicator
            : 'none');
        const customTitle = (this.config && this.config.style && this.config.style.headerTitle) ? this.config.style.headerTitle.trim() : ((subTypeSettings.globalData && subTypeSettings.globalData.design && subTypeSettings.globalData.design.headerTitle)
            ? subTypeSettings.globalData.design.headerTitle.trim()
            : "");
        const formName = customTitle || this.config.name || "Feedback";
        const hideHeader = (this.config.globalData && this.config.globalData.hideHeader);
        const hideFooter = (this.config.globalData && this.config.globalData.hideFooter);

        const updateFooterUI = (step) => {
            if (!this.overlayEl) return;
            const footerEl = this.overlayEl.querySelector(".responsino-overlay-footer");
            if (!footerEl) return;
            if (hideFooter === true) return;

            const showFooterText = (this.config && this.config.style && this.config.style.showFooterText !== undefined)
                ? this.config.style.showFooterText
                : ((subTypeSettings.globalData && subTypeSettings.globalData.design && subTypeSettings.globalData.design.showFooterText !== undefined)
                    ? subTypeSettings.globalData.design.showFooterText
                    : true);

            if (showFooterText) {
                footerEl.style.display = "block";
                footerEl.innerHTML = "";
                const customFooter = (this.config && this.config.style && this.config.style.customFooterText !== undefined && this.config.style.customFooterText !== null)
                    ? this.config.style.customFooterText.trim()
                    : ((subTypeSettings.globalData && subTypeSettings.globalData.design && subTypeSettings.globalData.design.customFooterText)
                        ? subTypeSettings.globalData.design.customFooterText.trim()
                        : "");
                footerEl.textContent = customFooter !== "" ? customFooter : __('admin.frontend.default_footer_text');
            } else {
                const isFeedbackButton = (displayType === "overlay") && (displaySubType === "feedback-button");
                const hideOptionEnabled = isFeedbackButton && subTypeSettings.hideOptionEnabled;

                if (hideOptionEnabled && String(step) === "1") {
                    footerEl.style.display = "block";
                    footerEl.innerHTML = "";
                    const hideLink = document.createElement("a");
                    hideLink.href = "#";
                    hideLink.className = "responsino-feedback-button-widget-hide-link";
                    hideLink.setAttribute("data-action", "hide");
                    hideLink.textContent = __("widget.feedback_button.hide_button");
                    hideLink.addEventListener("click", (e) => {
                        e.preventDefault();

                        let submitDays = 30;
                        if ((this.config.globalData.submitDays !== undefined) && parseInt(this.config.globalData.submitDays, 10) > 10) {
                            submitDays = parseInt(this.config.globalData.submitDays, 10);
                        }

                        this.config.globalData.closeDays = submitDays;

                        this.close();
                        this.hideTrigger();
                    });
                    footerEl.appendChild(hideLink);
                } else {
                    footerEl.style.display = "none";
                    footerEl.innerHTML = "";
                }
            }
        };

        const getHeaderElements = () => {
            const ov = this.overlayEl;
            if (!ov) return null;
            return {
                backBtn: ov.querySelector("#responsino-general-overlay-back-button") || ov.querySelector(".responsino-general-overlay-icon-btn") || ov.querySelector(".responsino-feedback-button-widget-icon-button"),
                pbContainer: ov.querySelector(".responsino-general-overlay-progress-bar-container") || ov.querySelector(".responsino-feedback-button-widget-progress-bar-container"),
                pbBar: ov.querySelector(".responsino-general-overlay-progress-bar") || ov.querySelector(".responsino-feedback-button-widget-progress-bar"),
                titleEl: ov.querySelector(".responsino-overlay-header-title"),
                stepIndicator: ov.querySelector(".responsino-overlay-header-step-indicator")
            };
        };

        const updateHeaderUI = (step) => {
            const els = getHeaderElements();
            if (!els) return;

            const headerEl = this.overlayEl.querySelector(".responsino-overlay-header");

            switch (step) {
                case 1:
                    if (hideHeader) {
                        headerEl.style.display = "none";
                    }
                    break;
                default:
                    headerEl.style.display = "flex";
                    break;
            }

            if (step === 2) {
                els.backBtn.style.display = "block";
            } else {
                els.backBtn.style.display = "none";
            }

            els.pbContainer.style.display = "none";
            els.titleEl.style.display = "none";
            els.stepIndicator.style.display = "none";

            const hasStep2 = utils.isOptionStep2ActiveOnStep1(stateObj);
            const totalSteps = hasStep2 ? 2 : 1;

            if (headerIndicator === "progress") {
                els.pbContainer.style.display = "block";
                let progress = "35%";
                if (step === 2) progress = "75%";
                else if (step === "confirmed") progress = "100%";
                els.pbBar.style.width = progress;
            } else if (headerIndicator === "title") {
                els.titleEl.style.display = "block";
                els.titleEl.textContent = formName;
            } else if (headerIndicator === "step") {
                els.stepIndicator.style.display = "block";
                if (step === "confirmed") {
                    els.stepIndicator.textContent = __('widget.status_completed');
                } else {
                    els.stepIndicator.textContent = __('widget.step_indicator_full', { step: step, total: totalSteps });
                }
            }
        };

        const els = getHeaderElements();
        if (els && els.backBtn && !els.backBtn.dataset.hasListener) {
            els.backBtn.dataset.hasListener = "true";
            els.backBtn.addEventListener("click", () => {
                if (this.innerPlaceholderEl && this.innerPlaceholderEl.responsinoGoToStep) {
                    this.innerPlaceholderEl.responsinoGoToStep(1);
                }
            });
        }

        updateHeaderUI(1);
        updateFooterUI(1);

        engine.render(this.innerPlaceholderEl, stateObj, {
            isSplit: false,
            isPreview: !!this.config.isPreview,
            onStepChange: (step, triggerId) => {
                updateHeaderUI(step);
                updateFooterUI(step);
            },
            onConfirm: (answers, activeStep2TriggerId = '') => {
                updateHeaderUI("confirmed");
                updateFooterUI("confirmed");

                if (!this.config.isPreview) {
                    const submitDays = this.config.globalData.submitDays !== undefined ? parseInt(this.config.globalData.submitDays, 10) : 30;

                    api.submitFeedback(this.formId, answers, displaySubType, this.innerPlaceholderEl, activeStep2TriggerId)
                        .then(data => {
                            this.innerPlaceholderEl.responsinoAnswers = {};
                            this.innerPlaceholderEl.responsinoStep2TriggerId = null;

                            if (submitDays > 0) {
                                const scope = (this.config.globalData && this.config.globalData.cookieScope) || "domain";
                                const pathHash = (window.responsinoFormFrontend && window.responsinoFormFrontend.pathHash) ? `_${window.responsinoFormFrontend.pathHash}` : "";
                                const pathKey = scope === "page" ? pathHash : "";
                                const cookiePath = scope === "page" ? window.location.pathname : "/";
                                utils.setCookie(`responsino_submitted_${this.formId}${pathKey}`, "1", submitDays, cookiePath);
                            }
                        })
                        .catch(err => {
                            console.error("RESPONSINO: Error while sending the feedbacks:", err);
                        });

                    if (submitDays > 0) {
                        // Hide trigger if configured or if standard feedback button
                        if ((this.config.triggerSettings && this.config.triggerSettings.hideOnSubmit) || this.config.triggerSettings.useStandard) {
                            this.hideTrigger();
                        }
                    }
                } else {
                    console.log("[Preview] Simulation of feedback confirmation:", answers);
                }

                setTimeout(() => {
                    this.close();
                }, 3000);
            }
        });

        const showBackdrop = this.config.globalData.showBackdrop !== false && this.config.globalData.showBackdrop !== "0" && this.config.globalData.showBackdrop !== 0;
        if (!showBackdrop) {
            this.overlayEl.classList.add("responsino-overlay-no-backdrop");
        } else {
            this.overlayEl.classList.remove("responsino-overlay-no-backdrop");
        }

        const modal = this.overlayEl.querySelector(".responsino-general-overlay-modal");
        if (modal) {
            const customWidth = this.config.globalData && this.config.globalData.overlayWidth;
            if (customWidth && parseInt(customWidth, 10) > 0) {
                modal.style.maxWidth = `${parseInt(customWidth, 10)}px`;
            } else {
                modal.style.maxWidth = "";
            }
        }

        if (this.backdropListener) {
            this.overlayEl.removeEventListener("click", this.backdropListener);
            this.backdropListener = null;
        }

        if (this.config.globalData.closeOnBackdrop) {
            this.overlayEl.classList.add("responsino-close-on-backdrop");
            this.backdropListener = (e) => {
                if (e.target === this.overlayEl) {
                    this.close();
                }
            };
            this.overlayEl.addEventListener("click", this.backdropListener);
        } else {
            this.overlayEl.classList.remove("responsino-close-on-backdrop");
        }

        if (this.escKeyListener) {
            document.removeEventListener("keydown", this.escKeyListener);
            this.escKeyListener = null;
        }

        if (this.config.globalData.closeOnEsc) {
            this.escKeyListener = (e) => {
                if (e.key === "Escape") {
                    this.close();
                }
            };
            document.addEventListener("keydown", this.escKeyListener);
        }
    }

    close() {
        if (!this.overlayEl) return;

        const subType = this.config.displaySubType || "modal";
        const modal = this.overlayEl.querySelector(".responsino-general-overlay-modal");
        const position = this.config.position || "center";

        if (subType === "slide-in" && modal) {
            const isLeft = position.includes("left") || position === "left-middle";
            const isRight = position.includes("right") || position === "right-middle";

            modal.classList.remove("slide-in-left", "slide-in-right");
            if (isLeft) modal.classList.add("slide-out-left");
            else if (isRight) modal.classList.add("slide-out-right");
        }

        this.overlayEl.classList.remove("responsino-overlay-is-visible");

        const targetContainer = (this.config && this.config.targetContainer) || document.body;
        targetContainer.classList.remove("responsino-feedback-button-widget-is-open");
        document.body.style.overflow = "";

        if (this.escKeyListener) {
            document.removeEventListener("keydown", this.escKeyListener);
            this.escKeyListener = null;
        }
        if (this.backdropListener) {
            this.overlayEl.removeEventListener("click", this.backdropListener);
            this.backdropListener = null;
        }

        if (!this.config.isPreview) {
            const closeDays = this.config.globalData.closeDays !== undefined ? parseInt(this.config.globalData.closeDays, 10) : 1;
            if (closeDays > 0) {
                const scope = (this.config.globalData && this.config.globalData.cookieScope) || "domain";
                const pathHash = (window.responsinoFormFrontend && window.responsinoFormFrontend.pathHash) ? `_${window.responsinoFormFrontend.pathHash}` : "";
                const pathKey = scope === "page" ? pathHash : "";
                const cookiePath = scope === "page" ? window.location.pathname : "/";
                utils.setCookie(`responsino_closed_${this.formId}${pathKey}`, "1", closeDays, cookiePath);

                // Hide trigger if configured or if standard feedback button
                if ((this.config.triggerSettings && this.config.triggerSettings.hideOnClose) || this.config.triggerSettings.useStandard) {
                    this.hideTrigger();
                }
            }
        }

        setTimeout(() => {
            if (this.innerPlaceholderEl) {
                this.innerPlaceholderEl.responsinoCurrentStep = 1;
                this.innerPlaceholderEl.responsinoAnswers = {};
                this.innerPlaceholderEl.responsinoStep2TriggerId = null;
                const stateObj = (this.config && this.config.stateObj) || (window.responsinoCachedData && window.responsinoCachedData[this.formId] && window.responsinoCachedData[this.formId].formData);
                if (stateObj) {
                    engine.render(this.innerPlaceholderEl, stateObj, {});
                }
            }
            this.isTriggered = false;
        }, 300);
    }

    destroy() {
        if (this.delayTimer) {
            clearTimeout(this.delayTimer);
            this.delayTimer = null;
        }
        if (this.scrollListener) {
            window.removeEventListener("scroll", this.scrollListener);
            this.scrollListener = null;
        }
        if (this.escKeyListener) {
            document.removeEventListener("keydown", this.escKeyListener);
            this.escKeyListener = null;
        }
        if (this.backdropListener && this.overlayEl) {
            this.overlayEl.removeEventListener("click", this.backdropListener);
            this.backdropListener = null;
        }
        if (this.overlayEl && this.overlayEl.parentNode) {
            this.overlayEl.parentNode.removeChild(this.overlayEl);
            this.overlayEl = null;
        }
        if (this.standardBtnEl) {
            const wrapper = this.standardBtnEl.closest(".responsino-feedback-plugin");
            if (wrapper && wrapper.parentNode) {
                wrapper.parentNode.removeChild(wrapper);
            } else if (this.standardBtnEl.parentNode) {
                this.standardBtnEl.parentNode.removeChild(this.standardBtnEl);
            }
            this.standardBtnEl = null;
        }
        if (this.config && this.config.targetContainer) {
            this.config.targetContainer.classList.remove("responsino-feedback-button-widget-is-open");
        }
        ResponsinoOverlayController.instances.delete(this);
    }
}

const engine = {
    render: function(containerEl, stateObj, options = {}) {
        if (!containerEl || !stateObj) return;

        // shortcode, pre-content, post-content, feedback-button, exit-intent
        const formType = containerEl.getAttribute("data-type");

        containerEl.responsinoStateObj = stateObj;
        containerEl.responsinoOptions = options;

        const isSplit = !!options.isSplit;
        const indicatorEl = options.indicatorEl || null;

        // Encapsulate answers & step state per container element
        if (options.answers) {
            containerEl.responsinoAnswers = { ...options.answers };
        } else if (!Object.prototype.hasOwnProperty.call(containerEl, 'responsinoAnswers')) {
            containerEl.responsinoAnswers = {};
        }
        if (!Object.prototype.hasOwnProperty.call(containerEl, 'getAnswers')) {
            containerEl.getAnswers = function() {
                return this.responsinoAnswers;
            };
        }
        if (!Object.prototype.hasOwnProperty.call(containerEl, 'responsinoAnswersArray')) {
            Object.defineProperty(containerEl, 'responsinoAnswersArray', {
                get: function() {
                    return Object.entries(this.responsinoAnswers || {}).map(([key, value]) => ({
                        elementId: key,
                        value: value
                    }));
                },
                configurable: true
            });
        }

        if (typeof containerEl.responsinoCurrentStep === "undefined") {
            containerEl.responsinoCurrentStep = 1;
        }
        if (typeof containerEl.responsinoStep2TriggerId === "undefined") {
            containerEl.responsinoStep2TriggerId = null;
        }

        const isStep2AcType = utils.isOptionStep2ActiveOnStep1(stateObj);

        // We clear the root container to inject the static wrapper skeletons once per state render
        containerEl.innerHTML = '';

        // Create Honeypot field if enabled
        if (stateObj.settings && stateObj.settings.main && stateObj.settings.main.honeypot !== false) {
            const hpWrap = document.createElement("div");
            hpWrap.style.cssText = "display:none !important; position:absolute; width:1px; height:1px; overflow:hidden;";
            const hpInput = document.createElement("input");
            hpInput.type = "text";
            hpInput.name = "responsino_hp_field";
            hpInput.setAttribute("tabindex", "-1");
            hpInput.setAttribute("autocomplete", "off");
            hpWrap.appendChild(hpInput);
            containerEl.appendChild(hpWrap);
        }

        // Create Step 1 Wrapper
        const step1Wrap = document.createElement("div");
        step1Wrap.className = "responsino-fd-step";
        step1Wrap.setAttribute("data-step", "1");
        containerEl.appendChild(step1Wrap);

        const step1List = (stateObj.steps && stateObj.steps.step1) ? stateObj.steps.step1 : [];
        engine.renderElementsListToContainer(step1Wrap, step1List, containerEl, goToStep, stateObj, isStep2AcType);

        // Create Step 2 Wrappers for each trigger element with step2Enabled = true
        const itemsWithStep2 = step1List.filter(item => {
            return (['rating', 'button'].includes(item.type)) && item.settings && item.settings.step2Enabled === true;
        });

        const uniqueStep2TriggerIds = new Set(itemsWithStep2.map(i => i.id));

        Array.from(uniqueStep2TriggerIds).forEach(triggerId => {
            const step2Wrap = document.createElement("div");
            step2Wrap.className = "responsino-fd-step";
            step2Wrap.setAttribute("data-step", "2");
            step2Wrap.setAttribute("data-trigger-id", triggerId);
            containerEl.appendChild(step2Wrap);

            const step2List = utils.getStep2List(stateObj, triggerId);
            engine.renderElementsListToContainer(step2Wrap, step2List, containerEl, goToStep, stateObj, isStep2AcType);
        });

        // Create Success / Confirmation Wrapper
        const successWrap = document.createElement("div");
        successWrap.className = "responsino-fd-success";
        containerEl.appendChild(successWrap);
        engine.renderConfirmation(successWrap, stateObj);

        // Define transition controller function
        function validateCurrentStep() {
            const currentStep = containerEl.responsinoCurrentStep;
            let activeStepWrap = null;
            if (currentStep === 1) {
                activeStepWrap = containerEl.querySelector('.responsino-fd-step[data-step="1"]');
            } else if (currentStep === 2) {
                const actId = containerEl.responsinoStep2TriggerId || (itemsWithStep2[0] ? itemsWithStep2[0].id : null);
                activeStepWrap = containerEl.querySelector(`.responsino-fd-step[data-step="2"][data-trigger-id="${actId}"]`);
            }

            if (!activeStepWrap) return true;

            const requiredGroups = activeStepWrap.querySelectorAll('.responsino-fd-group[data-required="true"]');
            let allValid = true;
            let firstInvalidGroup = null;

            requiredGroups.forEach(group => {
                const elementId = group.getAttribute("data-element-id");
                const val = containerEl.responsinoAnswers[elementId];
                const isInvalid = (val === undefined || val === null || (typeof val === 'string' && val.trim() === ''));

                if (isInvalid) {
                    allValid = false;
                    if (!firstInvalidGroup) {
                        firstInvalidGroup = group;
                    }
                    group.classList.add("responsino-fd-invalid");
                    if (!group.querySelector(".responsino-fd-error-msg")) {
                        const errMsg = document.createElement("div");
                        errMsg.className = "responsino-fd-error-msg";
                        errMsg.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${__("validation.error.required")}`;
                        group.appendChild(errMsg);
                    }
                } else {
                    group.classList.remove("responsino-fd-invalid");
                    const err = group.querySelector(".responsino-fd-error-msg");
                    if (err) err.remove();
                }
            });

            if (!allValid && firstInvalidGroup) {
                firstInvalidGroup.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }

            return allValid;
        }

        function goToStep(step, step2TriggerId = null) {
            const currentStep = containerEl.responsinoCurrentStep;

            let targetStep = step;
            let targetTriggerId = step2TriggerId;

            if (currentStep === 1 && step === "confirmed" && isStep2AcType) {
                // Find if any of the answered items have step 2 enabled
                const answeredTrigger = itemsWithStep2.find(item => {
                    const val = containerEl.responsinoAnswers[item.id];
                    return (val !== undefined && val !== null && val !== '');
                });
                if (answeredTrigger) {
                    targetStep = 2;
                    targetTriggerId = answeredTrigger.id;
                }
            }

            if (
                (currentStep === 1 && (targetStep === 2 || targetStep === "confirmed")) ||
                (currentStep === 2 && targetStep === "confirmed")
            ) {
                if (!validateCurrentStep()) {
                    console.warn("RESPONSINO: Validation failed for step", currentStep);
                    return;
                }
            }

            containerEl.responsinoCurrentStep = targetStep;
            if (targetTriggerId) {
                containerEl.responsinoStep2TriggerId = targetTriggerId;
            }

            // Hide all steps/success wrappers
            const allSteps = containerEl.querySelectorAll('.responsino-fd-step, .responsino-fd-success');
            allSteps.forEach(el => el.classList.remove('is-active'));

            if (targetStep === 2) {
                const actId = targetTriggerId || containerEl.responsinoStep2TriggerId || (itemsWithStep2[0] ? itemsWithStep2[0].id : null);
                const targetStep2 = containerEl.querySelector(`.responsino-fd-step[data-step="2"][data-trigger-id="${actId}"]`);
                if (targetStep2) {
                    targetStep2.classList.add('is-active');
                } else {
                    const fallbackStep2 = containerEl.querySelector(`.responsino-fd-step[data-step="2"]`);
                    if (fallbackStep2) fallbackStep2.classList.add('is-active');
                }
                if (indicatorEl) {
                    indicatorEl.textContent = __("widget.step_indicator", { step: 2, total: 2 });
                }
                if (options.onStepChange) options.onStepChange(targetStep, actId);
            } else if (targetStep === "confirmed") {
                const answersArr = containerEl.responsinoAnswersArray || [];

                let activeStep2TriggerId = '';
                if (currentStep === 2 && containerEl.responsinoStep2TriggerId) {
                    activeStep2TriggerId = containerEl.responsinoStep2TriggerId;
                }

                if (options.onConfirm) options.onConfirm(answersArr, activeStep2TriggerId);

                const confirm = (stateObj && stateObj.confirmation) || { type: 'message', message: __("confirmation.message.default") };
                let isRedirect = false;
                let redirectUrl = '';

                if (confirm.type !== 'message') {
                    redirectUrl = confirm.extUrl || '';
                    if (redirectUrl) {
                        const isAdminPreviewMode = !!(
                            document.getElementById("responsino-split-widget-live-inner-form") ||
                            document.getElementById("responsino-widget-live-inner-form") ||
                            document.getElementById("responsino-preview-inner-form")
                        );
                        if (!isAdminPreviewMode) {
                            isRedirect = true;
                        }
                    }
                }

                const targetSuccess = containerEl.querySelector('.responsino-fd-success');
                if (targetSuccess) {
                    targetSuccess.classList.add('is-active');
                }
                if (indicatorEl) {
                    indicatorEl.textContent = __("widget.status_confirmed");
                }

                if (isRedirect && redirectUrl) {
                    let countdown = 3;
                    const countdownEl = containerEl.querySelector('.responsino-fd-countdown-number');
                    const interval = setInterval(() => {
                        countdown--;
                        if (countdownEl) {
                            countdownEl.textContent = countdown;
                        }
                        if (countdown <= 0) {
                            clearInterval(interval);
                            window.location.href = redirectUrl;
                        }
                    }, 1000);
                } else if (redirectUrl) {
                    // Admin/Preview simulation
                    let countdown = 3;
                    const countdownEl = containerEl.querySelector('.responsino-fd-countdown-number');
                    const interval = setInterval(() => {
                        countdown--;
                        if (countdownEl) {
                            countdownEl.textContent = countdown;
                        }
                        if (countdown <= 0) {
                            clearInterval(interval);
                            const badgeEl = containerEl.querySelector('.responsino-fd-confirm-badge');
                            if (badgeEl) {
                                badgeEl.innerHTML = `<span style="color: #104689; font-weight: bold;"><i class="fas fa-info-circle"></i> ${__("admin.builder.simulation_redirect_msg")}</span><br>${redirectUrl}`;
                            }
                        }
                    }, 1000);
                }
            } else {
                // Step 1
                const targetStep1 = containerEl.querySelector('.responsino-fd-step[data-step="1"]');
                if (targetStep1) {
                    targetStep1.classList.add('is-active');
                }
                if (indicatorEl) {
                    indicatorEl.textContent = isStep2AcType ? __("widget.step_indicator", { step: 1, total: 2 }) : __("widget.step_single", { step: 1 });
                }
                if (options.onStepChange) options.onStepChange(step, null);
            }

            // Update progress bar & back button elements in the closest widget container if present on the page
            const pWid = containerEl.closest('#responsino-feedback-button-widget-container');
            if (pWid) {
                const pb = pWid.querySelector('#responsino-feedback-button-widget-progress-bar');
                if (pb) {
                    let progress = '35%';
                    if (step === 2) progress = '75%';
                    else if (step === 'confirmed') progress = '100%';
                    pb.style.width = progress;
                }
                const bb = pWid.querySelector('#responsino-feedback-button-widget-back-button');
                if (bb) {
                    if (step === 2) {
                        bb.hidden = false;
                        bb.style.display = 'block';
                    } else {
                        bb.hidden = true;
                        bb.style.display = 'none';
                    }
                }
            }
        }

        containerEl.responsinoGoToStep = goToStep;

        // Initial active step visualization
        goToStep(containerEl.responsinoCurrentStep, containerEl.responsinoStep2TriggerId);
    },

    renderElementsListToContainer: function(stepWrap, itemsList, containerEl, goToStep, stateObj, isStep2AcType) {
        stepWrap.innerHTML = '';
        if (itemsList.length === 0) {
            stepWrap.innerHTML = `<div class="responsino-fd-empty-message">${__("widget.no_elements")}</div>`;
            return;
        }

        const markFieldValid = (groupEl) => {
            if (groupEl.classList.contains("responsino-fd-invalid")) {
                groupEl.classList.remove("responsino-fd-invalid");
                const err = groupEl.querySelector(".responsino-fd-error-msg");
                if (err) err.remove();
            }
        };

        const processedItemsList = [...itemsList];

        const interactiveElements = processedItemsList.filter(i => ['rating'].includes(i.type));
        const hasSubmitButton = processedItemsList.some(i => i.type === 'button' && i.settings && i.settings.buttonType === 'submit');
        const enableAutoAdvance = (interactiveElements.length === 1) && !hasSubmitButton;

        processedItemsList.forEach(item => {
            if (item.settings && item.settings.clearBefore) {
                const breakEl = document.createElement("div");
                breakEl.className = "responsino-fd-break";
                stepWrap.appendChild(breakEl);
            }

            const g = document.createElement("div");
            g.className = "responsino-fd-group";
            g.setAttribute("data-element-id", item.id);
            g.setAttribute("data-element-type", item.type);
            if (item.settings && item.settings.required) {
                g.setAttribute("data-required", "true");
            }

            const w = (item.settings && item.settings.width) || "100%";
            g.classList.add(`responsino-fd-width-${w.replace("%", "")}`);

            const interactiveNode = fields.render(item, 'interactive', stateObj, {
                answers: containerEl.responsinoAnswers,
                onAnswerChange: (fieldId, value) => {
                    containerEl.responsinoAnswers[fieldId] = value;
                },
                goToStep: goToStep,
                isStep2AcType: isStep2AcType,
                markFieldValid: () => markFieldValid(g),
                isReadOnly: !!(containerEl.responsinoOptions && containerEl.responsinoOptions.isReadOnly),
                enableAutoAdvance: enableAutoAdvance
            });

            if (interactiveNode) {
                g.appendChild(interactiveNode);
            }

            if (g) {
                stepWrap.appendChild(g);
            }
        });
    },

    renderConfirmation: function(successWrap, stateObj) {
        const confirm = (stateObj && stateObj.confirmation) || { type: 'message', message: __("confirmation.message.default") };
        const formattedMsg = (confirm.message || '').replace(/\n/g, '<br>');
        const color = confirm.textColor || stateObj?.settings?.style?.accentColor || "#000000";

        if (confirm.type === 'message') {
            successWrap.innerHTML = `
        <div class="responsino-fd-confirm-msg">
          <div class="responsino-fd-confirm-icon" style="color: ${color};"><i class="fas fa-check-circle"></i></div>
          <div class="responsino-fd-confirm-text" style="color: ${color};">${formattedMsg}</div>
        </div>
      `;
        } else {
            let url = confirm.extUrl || '';
            successWrap.innerHTML = `
        <div class="responsino-fd-confirm-msg">
          <div class="responsino-fd-confirm-icon" style="color: ${color};"><i class="fas fa-check-circle"></i></div>
          <div class="responsino-fd-confirm-text" style="color: ${color};">
            <div>${formattedMsg || __("confirmation.message.default")}</div>
            <p style="margin: 10px 0 6px 0; font-size: 0.9em; opacity: 0.95;">
              ${__("confirmation.message.redirecting", { seconds: `<span class="responsino-fd-countdown-number" style="font-weight: bold; color: ${color}; font-size: 1.1em;">3</span>` })}
            </p>
            <div class="responsino-fd-confirm-badge" style="margin-top: 8px; font-size: 0.8em; opacity: 0.8; word-break: break-all; padding: 4px 8px; background: #f1f5f9; border-radius: 4px; border-left: 3px solid ${color}; display: inline-block; text-align: left;">
              ${__("confirmation.message.target")} ${url}
            </div>
          </div>
        </div>
      `;
        }
    },

    initAutoRender: function() {
        // Perform cleanup
        utils.cleanupExpiredLocalStorage();

        // Decide if we are executing within Admin preview workspace or standard site frontend
        const placeholders = document.querySelectorAll(".responsino-feedback-type-placeholder");
        const overlays = window.responsinoActiveOverlays;

        if (placeholders.length === 0 && overlays.length === 0) {
            // Im Admin steuert die responsino-admin.js das Rendern explizit. Keine doppelten Event-Listener nötig.
            return;
        }

        // --- FRONT-END PRODUCTION VISITOR ENGINE ---
        const formsToFetch = new Set();
        const cachedData = {};

        placeholders.forEach(el => {
            const id = el.getAttribute("data-form-id");
            const formUpdated = el.getAttribute("data-form-updated");
            if (id) {
                const cached = utils.getFromLocalStorage(id, formUpdated);
                if (cached) {
                    cachedData[id] = cached;
                    window.responsinoCachedData = window.responsinoCachedData || {};
                    window.responsinoCachedData[id] = cached;
                } else {
                    formsToFetch.add(parseInt(id));
                }
            }
        });

        overlays.forEach(config => {
            if (config.id) {
                const id = config.id.toString();
                const formUpdated = config.formUpdated || "";
                const cached = utils.getFromLocalStorage(id, formUpdated);
                if (cached) {
                    cachedData[id] = cached;
                    window.responsinoCachedData = window.responsinoCachedData || {};
                    window.responsinoCachedData[id] = cached;
                } else {
                    formsToFetch.add(parseInt(id));
                }
            }
        });

        const renderAll = () => {
            // 1. Render all explicitly placed placeholders for forms (shortcodes, inline containers)
            placeholders.forEach(el => {
                const id = el.getAttribute("data-form-id");
                const type = el.getAttribute("data-type");

                // If the form is configured as in-content or shortcode, render it!
                if (cachedData[id]) {
                    const stateObj = cachedData[id].formData;

                    logger.log('[Frontend] Rendering in-content placeholder:', { id, type, stateObj });

                    let displaySubType = (stateObj && stateObj.settings && stateObj.settings.display.displaySubType) || "shortcode";
                    if (type === "pre-content" || type === "post-content") {
                        displaySubType = "in-content";
                    }

                    // Validate targeting
                    const targeting = (stateObj && stateObj.targeting && stateObj.targeting[displaySubType]) || {};
                    const isTargetingValid = RESPONSINOFormValidator.validateTargeting(targeting, config.CONTEXT);

                    // Only render inline if the displayType is in-content / shortcode
                    if ((displaySubType === "in-content" || type === "shortcode") && isTargetingValid) {
                        engine.renderPlaceholder(el, cachedData[id]);
                    } else {
                        el.style.display = "none";
                    }
                }
            });
        };

        // Wenn alles im Cache ist, sofort rendern
        if (formsToFetch.size === 0) {
            renderAll();
        } else {
            // Fehlende Daten laden
            api.fetchFormsData(formsToFetch)
                .then(res => {
                    if (res.success && res.data) {
                        Object.keys(res.data).forEach(id => {
                            const resultData = res.data[id];
                            if (resultData && resultData.formData) {
                                utils.saveToLocalStorage(resultData);
                                cachedData[id] = resultData;
                                window.responsinoCachedData = window.responsinoCachedData || {};
                                window.responsinoCachedData[id] = resultData;
                            }
                        });
                    }
                    renderAll();
                })
                .catch(err => {
                    console.error("RESPONSINO Error: fetching placeholders data failed", err);
                    renderAll(); // Trotzdem rendern, was wir haben
                });
        }
    },

    renderPlaceholder: function (el, resultData) {
        const formId = el.getAttribute("data-form-id");
        const type = el.getAttribute("data-type");
        const stateObj = resultData.formData;

        const scope = (stateObj.settings.display.subTypeData && stateObj.settings.display.subTypeData.shortcode && stateObj.settings.display.subTypeData.shortcode.globalData.main.cookieScope) || "domain";
        const pathHash = (window.responsinoFormFrontend && window.responsinoFormFrontend.pathHash) ? `_${window.responsinoFormFrontend.pathHash}` : "";
        const pathKey = scope === "page" ? pathHash : "";
        const submitCookie = `responsino_submitted_${formId}_${type}${pathKey}`;
        if (utils.getCookie(submitCookie)) {
            // Hide placeholder
            if (el) {
                const wrapper = el.closest(".responsino-feedback-plugin");
                if (wrapper) {
                    wrapper.style.display = "none";
                } else {
                    el.style.display = "none";
                }
            }

            return false;
        }

        engine.render(el, stateObj, {
            isSplit: false,
            onConfirm: (answers, activeStep2TriggerId = '') => {
                const submitDays = stateObj.settings.display.subTypeData.shortcode.globalData.main.cookieSubmitDays !== undefined ? parseInt(stateObj.settings.display.subTypeData.shortcode.globalData.main.cookieSubmitDays, 10) : 30;

                api.submitFeedback(formId, answers, type, el, activeStep2TriggerId)
                    .then(data => {
                        el.responsinoAnswers = {};
                        el.responsinoStep2TriggerId = null; // Reset for next interactions

                        if (submitDays > 0) {
                            const pathHash = (window.responsinoFormFrontend && window.responsinoFormFrontend.pathHash) ? `_${window.responsinoFormFrontend.pathHash}` : "";
                            const pathKey = scope === "page" ? pathHash : "";
                            const cookiePath = scope === "page" ? window.location.pathname : "/";
                            utils.setCookie(`responsino_submitted_${formId}_${type}${pathKey}`, "1", submitDays, cookiePath);
                        }
                    })
                    .catch(err => {
                        console.error("RESPONSINO Error: sending feedback", err);
                    });

                setTimeout(() => {
                    if (submitDays > 0) {
                        // Hide placeholder
                        if (el) {
                            const wrapper = el.closest(".responsino-feedback-plugin");
                            if (wrapper) {
                                wrapper.style.display = "none";
                            } else {
                                el.style.display = "none";
                            }
                        }
                    }
                }, 5000);
            }
        });

        utils.applyInContentStyles(el, stateObj);

        el.style.visibility = "visible";
    }
};

// Public Interface exposure (Bridge pattern ensuring backward compatibility)
window.RESPONSINOFrontend = {
    render: engine.render,
    initAutoRender: engine.initAutoRender
};

window.ResponsinoOverlayController = ResponsinoOverlayController;

// Automate initialization sequence
engine.initAutoRender();

document.addEventListener("DOMContentLoaded", () => {
    window.responsinoActiveOverlays.forEach(overlayConfig => {
        const targeting = (overlayConfig.targeting && overlayConfig.targeting.overlay) || {};

        const overlayId = overlayConfig.id || "";
        const overlayName = overlayConfig.name || "";
        const overlayType = overlayConfig.displaySubType || "";

        logger.log('[Frontend] Rendering overlay:', { overlayId, overlayName, overlayType, overlayConfig });

        if (RESPONSINOFormValidator.validateTargeting(targeting, config.CONTEXT)) {
            const controller = new ResponsinoOverlayController(overlayConfig);
            controller.init();
        }
    });
});