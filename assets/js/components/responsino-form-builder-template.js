import { utils } from './responsino-form-utils.js';
import { config } from './responsino-form-config.js';

import { __ } from './responsino-i18n.js';

export const FormBuilderTemplates = {
    init: function() {
        const container = document.getElementById("responsino-templates-container");
        if (!container) return;

        container.innerHTML = "";

        // Render each template dynamically
        Object.entries(config.FORM_TEMPLATES).forEach(([key, tmpl]) => {
            // Create card element
            const card = document.createElement("div");
            card.className = 'responsino-template-card-new';
            card.dataset.template = key;

            // Card Header
            const header = document.createElement("div");
            header.className = "responsino-template-card-header";

            const title = document.createElement("h4");
            title.className = "responsino-template-card-title";
            title.textContent = tmpl.title;
            header.appendChild(title);

            // Refresh Button for Resetting the Preview
            const refreshBtn = document.createElement("button");
            refreshBtn.className = "responsino-template-card-refresh-btn";
            refreshBtn.type = "button";
            refreshBtn.title = __("admin.builder.reset_preview");
            refreshBtn.innerHTML = '<i class="fas fa-redo"></i>';
            header.appendChild(refreshBtn);

            card.appendChild(header);

            // Card Body (scrollable form preview area)
            const body = document.createElement("div");
            body.className = "responsino-template-card-body responsino-feedback-plugin";
            body.id = `responsino-tmpl-preview-${key}`;
            // Mark for lazy rendering
            body.dataset.rendered = "false";
            card.appendChild(body);

            // Function to render/re-render this preview form
            const renderPreview = () => {
                if (window.ResponsinoFrontend) {
                    body.responsinoCurrentStep = 1;
                    body.responsinoStep2TriggerId = null;
                    body.responsinoAnswers = {};

                    const tempState = {
                        settings: {
                            styles: {
                                accentColor: '#000000',
                                secondaryColor: '#555555',
                            }
                        },
                        title: tmpl.title,
                        steps: tmpl.steps,
                    };

                    window.ResponsinoFrontend.render(body, tempState, {
                        isPreview: true,
                        isSplit: false,
                        onConfirm: () => {
                            console.log(`Responsino: Dummy confirm on template preview ${key}`);
                        }
                    });
                }
                body.dataset.rendered = "true";
            };

            // Attach render function for lazy load & refresh button
            body.responsinoRenderPreview = renderPreview;

            refreshBtn.addEventListener("click", (e) => {
                e.preventDefault();
                e.stopPropagation();
                renderPreview();
            });

            // Card Footer
            const footer = document.createElement("div");
            footer.className = "responsino-template-card-footer";

            const footerBtn = document.createElement("button");
            footerBtn.className = 'responsino-template-card-btn';
            footerBtn.type = "button";
            footerBtn.innerHTML = '<i class="fas fa-plus"></i> ' + __("admin.builder.use_template");

            footer.appendChild(footerBtn);
            card.appendChild(footer);

            // Add card to grid
            container.appendChild(card);

            // Click Handler for Template Loading or PRO Upgrade (on the button, not card)
            footerBtn.addEventListener("click", (e) => {
                e.preventDefault();
                e.stopPropagation();

                const formBuilder = window.ResponsinoFormBuilder;
                if (!formBuilder) return;

                if (confirm(__("admin.confirm.load_template"))) {
                    formBuilder.state.settings.main.title = tmpl.title;
                    formBuilder.state.steps = JSON.parse(JSON.stringify(tmpl.steps));

                    if (key === 'blank') formBuilder.state.activeStep2TriggerId = "";
                    else if (key === 'website') formBuilder.state.activeStep2TriggerId = "web-2";
                    else formBuilder.state.activeStep2TriggerId = "";

                    formBuilder.controller.loadFormStateToInputs();
                    formBuilder.engine.renderStepCanvas(1);
                    formBuilder.engine.renderStepCanvas(2);
                    formBuilder.controller.setStepFocus(1);

                    const modal = document.getElementById("responsino-modal-templates");
                    if (modal) modal.classList.remove("responsino-modal-overlay-active");

                    utils.showToast(__("admin.toast.template_loaded", { title: tmpl.title }), "success");
                    formBuilder.api.saveStateToLocalStorage();
                }
            });
        });

        // Setup IntersectionObserver for Lazy Rendering of the form templates
        if ('IntersectionObserver' in window) {
            const observerOptions = {
                root: document.querySelector("#responsino-modal-templates .responsino-modal-body") || null,
                rootMargin: "50px",
                threshold: 0.01
            };

            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const bodyEl = entry.target;
                        if (bodyEl.dataset.rendered === "false") {
                            if (typeof bodyEl.responsinoRenderPreview === "function") {
                                bodyEl.responsinoRenderPreview();
                            }
                            obs.unobserve(bodyEl); // Render once, then stop observing
                        }
                    }
                });
            }, observerOptions);

            // Observe all bodies
            document.querySelectorAll(".responsino-template-card-body").forEach(el => {
                observer.observe(el);
            });
        } else {
            // Fallback for browsers without IntersectionObserver (render everything immediately)
            document.querySelectorAll(".responsino-template-card-body").forEach(bodyEl => {
                if (typeof bodyEl.responsinoRenderPreview === "function") {
                    bodyEl.responsinoRenderPreview();
                }
            });
        }
    }
};
