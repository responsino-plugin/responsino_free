<?php
if (!defined('ABSPATH')) {
	exit;
}
?>

<section class="responsino-builder-view responsino-config-screen-layout" id="responsino-view-display" aria-label="Widget Display">

    <div class="responsino-settings-wrapper responsino-form-builder-template-display-layout-grid">

        <!-- LEFT COLUMN: SETTINGS FORM -->
        <div class="responsino-form-builder-template-display-left-col">

            <!-- Top Header -->
            <div class="responsino-builder-section-header">
                <h3 class="responsino-builder-section-title" style="margin-bottom: 0;">
                    <i class="fas fa-eye" style="color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.display.header.title', 'responsino'); ?>
                </h3>
            </div>

            <!-- Hidden compatibility inputs for legacy bindings -->
            <input type="hidden" id="responsino-style-display-type" value="in-content" />

            <!-- SECTION 1: HAUPTANZEIGETYP WÄHLEN -->
            <div class="responsino-form-builder-template-display-section">
                <div class="responsino-form-builder-template-display-section-header">
                    <h4 class="responsino-form-builder-template-display-section-title">
                        <i class="fas fa-layer-group"></i> <?php esc_html_e('admin.builder.display.section1.title', 'responsino'); ?>
                    </h4>
                    <span class="responsino-form-builder-template-display-badge"><?php esc_html_e('admin.builder.display.step1', 'responsino'); ?></span>
                </div>
                <p class="responsino-form-builder-template-display-desc">
                    <?php esc_html_e('admin.builder.display.section1.description', 'responsino'); ?>
                </p>

                <div class="responsino-form-builder-template-display-grid-cards">
                    <!-- Card 1: In-Content -->
                    <div class="responsino-form-builder-template-display-type-card active" data-type="in-content" data-subtype="shortcode">
                        <div class="responsino-form-builder-template-display-type-card-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="responsino-form-builder-template-display-type-card-content">
                            <h4><?php esc_html_e('admin.builder.display.card1.title', 'responsino'); ?></h4>
                            <p><?php esc_html_e('admin.builder.display.card1.description', 'responsino'); ?></p>
                        </div>
                        <div class="responsino-form-builder-template-display-card-indicator">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>

                    <!-- Card 2: Overlay Pop-Up -->
                    <div class="responsino-form-builder-template-display-type-card" data-type="overlay" data-subtype="modal">
                        <div class="responsino-form-builder-template-display-type-card-icon">
                            <i class="fas fa-window-restore"></i>
                        </div>
                        <div class="responsino-form-builder-template-display-type-card-content">
                            <h4><?php esc_html_e('admin.builder.display.card2.title', 'responsino'); ?></h4>
                            <p><?php esc_html_e('admin.builder.display.card2.description', 'responsino'); ?></p>
                        </div>
                        <div class="responsino-form-builder-template-display-card-indicator">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>

                    <!-- Card 3: Slide-In Panel -->
                    <div class="responsino-form-builder-template-display-type-card" data-type="overlay" data-subtype="slide-in">
                        <div class="responsino-form-builder-template-display-type-card-icon">
                            <i class="fas fa-square-parking"></i>
                        </div>
                        <div class="responsino-form-builder-template-display-type-card-content">
                            <h4><?php esc_html_e('admin.builder.display.card3.title', 'responsino'); ?></h4>
                            <p><?php esc_html_e('admin.builder.display.card3.description', 'responsino'); ?></p>
                        </div>
                        <div class="responsino-form-builder-template-display-card-indicator">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>

                    <!-- Card 4: Floating Feedback Button -->
                    <div class="responsino-form-builder-template-display-type-card" data-type="overlay" data-subtype="feedback-button">
                        <div class="responsino-form-builder-template-display-type-card-icon">
                            <i class="fas fa-comment-dots"></i>
                        </div>
                        <div class="responsino-form-builder-template-display-type-card-content">
                            <h4><?php esc_html_e('admin.builder.display.card4.title', 'responsino'); ?></h4>
                            <p><?php esc_html_e('admin.builder.display.card4.description', 'responsino'); ?></p>
                        </div>
                        <div class="responsino-form-builder-template-display-card-indicator">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>

                <!-- In-Content Specific Sub-Option: Automatic insertion -->
                <div id="responsino-incontent-sub-options" style="margin-top: 14px; padding: 12px; background: #f8fafc; border-radius: 8px; border: 1px solid var(--responsino-border);">
                    <div class="responsino-switch-group" style="margin-bottom: 0;">
            <span class="responsino-switch-label" style="font-weight: 600; font-size: 12px;">
              <i class="fas fa-magic" style="color: var(--responsino-primary); font-size: 12px;"></i> <?php esc_html_e('admin.builder.display.in_content.auto_insert', 'responsino'); ?>
            </span>
                        <label class="responsino-switch-wrapper" for="responsino-style-display-in-content">
                            <input type="checkbox" id="responsino-style-display-in-content" />
                            <span class="responsino-switch-slider"></span>
                        </label>
                    </div>
                    <div id="responsino-in-content-auto-position-group" style="display: none; margin-top: 10px; flex-direction: column; gap: 6px;">
                        <label for="responsino-style-in-content-position" style="font-size: 11.5px; font-weight: 600;"><?php esc_html_e('admin.builder.display.in_content.position.label', 'responsino'); ?></label>
                        <select id="responsino-style-in-content-position" class="responsino-form-select" style="height: 34px;">
                            <option value="bottom" selected><?php esc_html_e('admin.builder.display.in_content.position.bottom', 'responsino'); ?></option>
                            <option value="top"><?php esc_html_e('admin.builder.display.in_content.position.top', 'responsino'); ?></option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: AUSLÖSER & TIMING (TRIGGERS) -->
            <div class="responsino-form-builder-template-display-section" id="responsino-display-section-triggers" style="display: none;">
                <div class="responsino-form-builder-template-display-section-header">
                    <h4 class="responsino-form-builder-template-display-section-title">
                        <i class="fas fa-bolt"></i> <?php esc_html_e('admin.builder.display.section2.title', 'responsino'); ?>
                    </h4>
                    <span class="responsino-form-builder-template-display-badge"><?php esc_html_e('admin.builder.display.step2', 'responsino'); ?></span>
                </div>
                <p class="responsino-form-builder-template-display-desc">
                    <?php esc_html_e('admin.builder.display.section2.description', 'responsino'); ?>
                </p>

                <!-- Hidden trigger select for compatibility -->
                <select id="responsino-style-overlay-trigger" style="display: none;">
                    <option value="click">click</option>
                    <option value="exit-intent">exit-intent</option>
                    <option value="delay">delay</option>
                    <option value="scroll">scroll</option>
                </select>

                <!-- Segmented Control for Triggers -->
                <div class="responsino-form-builder-template-display-segmented-control" id="responsino-display-trigger-segmented-control">
                    <button type="button" class="responsino-form-builder-template-display-segment-btn active" data-trigger="click">
                        <i class="fas fa-mouse-pointer"></i> <?php esc_html_e('admin.builder.display.trigger.click', 'responsino'); ?>
                    </button>
                    <button type="button" class="responsino-form-builder-template-display-segment-btn" data-trigger="exit-intent">
                        <i class="fas fa-door-open"></i> <?php esc_html_e('admin.builder.display.trigger.exit_intent', 'responsino'); ?>
                    </button>
                    <button type="button" class="responsino-form-builder-template-display-segment-btn" data-trigger="delay">
                        <i class="fas fa-clock"></i> <?php esc_html_e('admin.builder.display.trigger.delay', 'responsino'); ?>
                    </button>
                    <button type="button" class="responsino-form-builder-template-display-segment-btn" data-trigger="scroll">
                        <i class="fas fa-arrows-alt-v"></i> <?php esc_html_e('admin.builder.display.trigger.scroll', 'responsino'); ?>
                    </button>
                </div>

                <!-- Trigger Detail Card -->
                <div class="responsino-form-builder-template-display-trigger-detail-card" id="responsino-display-trigger-content">

                    <!-- Panel Click -->
                    <div id="responsino-overlay-trigger-panel-click" style="display: flex; flex-direction: column; gap: 10px;">
                        <div class="responsino-form-group" id="responsino-overlay-click-selector-group" style="margin-bottom: 0;">
                            <label for="responsino-style-overlay-click-selector" class="responsino-form-builder-template-display-label"><?php esc_html_e('admin.builder.display.trigger.click.selector.label', 'responsino'); ?></label>
                            <input type="text" id="responsino-style-overlay-click-selector" class="responsino-form-input" placeholder="#my-feedback-btn, .open-feedback" style="height: 34px; font-size: 12.5px;" />
                            <span class="responsino-form-builder-template-display-hint"><?php esc_html_e('admin.builder.display.trigger.click.hint', 'responsino'); ?></span>
                        </div>

                        <div class="responsino-switch-group" id="responsino-overlay-click-use-standard-toggle-group" style="margin-top: 6px; margin-bottom: 0; display: none;">
                            <span class="responsino-switch-label" style="font-size: 11.5px;"><?php esc_html_e('admin.builder.display.trigger.click.standard_button.label', 'responsino'); ?></span>
                            <label class="responsino-switch-wrapper" for="responsino-style-overlay-click-use-standard">
                                <input type="checkbox" id="responsino-style-overlay-click-use-standard" checked />
                                <span class="responsino-switch-slider"></span>
                            </label>
                        </div>
                    </div>

                    <!-- Panel Exit-Intent -->
                    <div id="responsino-overlay-trigger-panel-exit-intent" style="display: none; flex-direction: column; gap: 10px;">
                        <p class="responsino-form-builder-template-display-hint">
                            <i class="fas fa-info-circle" style="color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.display.trigger.exit_intent.hint', 'responsino'); ?>
                        </p>
                        <div class="responsino-form-group" style="margin-bottom: 0;">
                            <label for="responsino-style-exit-intent-delay" class="responsino-form-builder-template-display-label"><?php esc_html_e('admin.builder.display.trigger.exit_intent.sensitivity.label', 'responsino'); ?></label>
                            <select id="responsino-style-exit-intent-delay" class="responsino-form-select" style="height: 34px;">
                                <option value="immediate" selected><?php esc_html_e('admin.builder.display.trigger.exit_intent.sensitivity.immediate', 'responsino'); ?></option>
                                <option value="5s"><?php esc_html_e('admin.builder.display.trigger.exit_intent.sensitivity.5s', 'responsino'); ?></option>
                                <option value="10s"><?php esc_html_e('admin.builder.display.trigger.exit_intent.sensitivity.10s', 'responsino'); ?></option>
                                <option value="60s"><?php esc_html_e('admin.builder.display.trigger.exit_intent.sensitivity.60s', 'responsino'); ?></option>
                            </select>
                        </div>
                    </div>

                    <!-- Panel Delay -->
                    <div id="responsino-overlay-trigger-panel-delay" style="display: none; flex-direction: column; gap: 10px;">
                        <p class="responsino-form-builder-template-display-hint">
                            <i class="fas fa-clock" style="color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.display.trigger.delay.hint', 'responsino'); ?>
                        </p>
                        <div class="responsino-form-group" style="margin-bottom: 0;">
                            <label for="responsino-style-overlay-delay-seconds" class="responsino-form-builder-template-display-label"><?php esc_html_e('admin.builder.display.trigger.delay.label', 'responsino'); ?></label>
                            <input type="number" id="responsino-style-overlay-delay-seconds" class="responsino-form-input" min="1" max="3600" value="5" style="height: 34px;" />
                        </div>
                    </div>

                    <!-- Panel Scroll -->
                    <div id="responsino-overlay-trigger-panel-scroll" style="display: none; flex-direction: column; gap: 10px;">
                        <p class="responsino-form-builder-template-display-hint">
                            <i class="fas fa-arrows-alt-v" style="color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.display.trigger.scroll.hint', 'responsino'); ?>
                        </p>
                        <div class="responsino-form-group" style="margin-bottom: 0;">
                            <label for="responsino-style-overlay-scroll-type" class="responsino-form-builder-template-display-label"><?php esc_html_e('admin.builder.display.trigger.scroll.condition.label', 'responsino'); ?></label>
                            <select id="responsino-style-overlay-scroll-type" class="responsino-form-select" style="height: 34px;">
                                <option value="end" selected><?php esc_html_e('admin.builder.display.trigger.scroll.condition.end', 'responsino'); ?></option>
                                <option value="percent"><?php esc_html_e('admin.builder.display.trigger.scroll.condition.percent', 'responsino'); ?></option>
                            </select>
                        </div>
                        <div id="responsino-overlay-scroll-percent-container" class="responsino-form-group" style="display: none; margin-bottom: 0;">
                            <label for="responsino-style-overlay-scroll-percent" class="responsino-form-builder-template-display-label"><?php esc_html_e('admin.builder.display.trigger.scroll.percent.label', 'responsino'); ?></label>
                            <input type="number" id="responsino-style-overlay-scroll-percent" class="responsino-form-input" min="1" max="100" value="50" style="height: 34px;" />
                        </div>
                    </div>

                </div>
            </div>

            <!-- SECTION 2B: FEEDBACK-BUTTON EINSTELLUNGEN -->
            <div class="responsino-form-builder-template-display-section" id="responsino-display-section-feedback-button" style="display: none;">
                <div class="responsino-form-builder-template-display-section-header">
                    <h4 class="responsino-form-builder-template-display-section-title">
                        <i class="fas fa-comment-alt"></i> 2. <?php esc_html_e('admin.builder.display.feedback_button.title', 'responsino'); ?>
                    </h4>
                    <span class="responsino-form-builder-template-display-badge"><?php esc_html_e('admin.builder.display.step.2', 'responsino'); ?></span>
                </div>
                <p class="responsino-form-builder-template-display-desc">
                    <?php esc_html_e('admin.builder.display.feedback_button.description', 'responsino'); ?>
                </p>

                <div class="responsino-form-builder-template-display-trigger-detail-card" id="responsino-overlay-click-standard-btn-group" style="display: flex; flex-direction: column; gap: 10px;">
                    <div class="responsino-form-group" style="margin-bottom: 0;">
                        <label for="responsino-style-feedback-btn-text" class="responsino-form-builder-template-display-label"><?php esc_html_e('admin.builder.display.feedback_button.label.text', 'responsino'); ?></label>
                        <input type="text" id="responsino-style-feedback-btn-text" class="responsino-form-input" style="height: 34px; font-size: 12.5px;" value="<?php esc_html_e('admin.builder.display.feedback_button.label.default', 'responsino'); ?>" />
                    </div>
                    <div class="responsino-form-group" style="margin-bottom: 0;">
                        <label for="responsino-style-feedback-btn-position" class="responsino-form-builder-template-display-label"><?php esc_html_e('admin.builder.display.feedback_button.position.label', 'responsino'); ?></label>
                        <select id="responsino-style-feedback-btn-position" class="responsino-form-select" style="height: 34px;">
                            <option value="right-middle" selected><?php esc_html_e('admin.builder.display.feedback_button.position.right_middle', 'responsino'); ?></option>
                            <option value="left-middle"><?php esc_html_e('admin.builder.display.feedback_button.position.left_middle', 'responsino'); ?></option>
                            <option value="bottom-right"><?php esc_html_e('admin.builder.display.feedback_button.position.bottom_right', 'responsino'); ?></option>
                            <option value="bottom-middle"><?php esc_html_e('admin.builder.display.feedback_button.position.bottom_middle', 'responsino'); ?></option>
                            <option value="bottom-left"><?php esc_html_e('admin.builder.display.feedback_button.position.bottom_left', 'responsino'); ?></option>
                        </select>
                    </div>
                    <div class="responsino-switch-group" style="margin-bottom: 0;">
                        <span class="responsino-switch-label" style="font-size: 11px;"><?php esc_html_e('admin.builder.display.feedback_button.hide_option.label', 'responsino'); ?></span>
                        <label class="responsino-switch-wrapper" for="responsino-style-feedback-hide-option-enabled">
                            <input type="checkbox" id="responsino-style-feedback-hide-option-enabled" />
                            <span class="responsino-switch-slider"></span>
                        </label>
                    </div>

                    <!-- CUSTOM STYLES & FARBEN FÜR FEEDBACK-BUTTON -->
                    <div class="responsino-switch-group" style="margin-top: 6px; margin-bottom: 0; padding-top: 10px; border-top: 1px dashed var(--responsino-border, #e2e8f0);">
                        <div class="responsino-form-builder-template-display-toggle-info">
                            <span class="responsino-form-builder-template-display-toggle-title" style="font-size: 12px; font-weight: 600;"><?php esc_html_e('admin.builder.display.feedback_button.custom_design.title', 'responsino'); ?></span>
                            <span class="responsino-form-builder-template-display-toggle-desc" style="font-size: 11px; color: var(--responsino-text-muted, #6c757d);"><?php esc_html_e('admin.builder.display.feedback_button.custom_design.description', 'responsino'); ?></span>
                        </div>
                        <label class="responsino-switch-wrapper" for="responsino-opt-feedback-btn-custom-enabled">
                            <input type="checkbox" id="responsino-opt-feedback-btn-custom-enabled" />
                            <span class="responsino-switch-slider"></span>
                        </label>
                    </div>

                    <div id="responsino-opt-feedback-btn-colors-subpanel" style="display: none; flex-direction: column; gap: 12px; margin-top: 4px; padding-top: 10px; border-top: 1px dashed var(--responsino-border, #e2e8f0);">

                        <!-- Schriftgröße -->
                        <div class="responsino-form-group" style="margin-bottom: 0;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                                <label for="responsino-opt-feedback-btn-font-size" class="responsino-form-builder-template-display-label" style="margin-bottom: 0;"><?php esc_html_e('admin.builder.display.feedback_button.font_size.label', 'responsino'); ?></label>
                                <span id="responsino-opt-feedback-btn-font-size-val" style="font-size: 12px; font-weight: 600; color: var(--responsino-primary, #104689);">16px</span>
                            </div>
                            <input type="range" id="responsino-opt-feedback-btn-font-size" min="10" max="24" value="16" style="width: 100%; accent-color: var(--responsino-primary, #104689);" />
                        </div>

                        <!-- Farb-Raster -->
                        <div class="responsino-form-builder-template-display-color-grid">

                            <div class="responsino-form-builder-template-display-color-field">
                                <label class="responsino-form-builder-template-display-label"><?php esc_html_e('admin.builder.display.feedback_button.background.label', 'responsino'); ?></label>
                                <div class="responsino-form-builder-template-display-color-wrapper">
                                    <input type="color" id="responsino-opt-feedback-btn-bg" value="#104689" />
                                    <input type="text" id="responsino-opt-feedback-btn-bg-hex" value="#104689" readonly />
                                </div>
                            </div>

                            <div class="responsino-form-builder-template-display-color-field">
                                <label class="responsino-form-builder-template-display-label"><?php esc_html_e('admin.builder.display.feedback_button.text_color.label', 'responsino'); ?></label>
                                <div class="responsino-form-builder-template-display-color-wrapper">
                                    <input type="color" id="responsino-opt-feedback-btn-text" value="#ffffff" />
                                    <input type="text" id="responsino-opt-feedback-btn-text-hex" value="#FFFFFF" readonly />
                                </div>
                            </div>

                            <div class="responsino-form-builder-template-display-color-field">
                                <label class="responsino-form-builder-template-display-label"><?php esc_html_e('admin.builder.display.feedback_button.border.label', 'responsino'); ?></label>
                                <div class="responsino-form-builder-template-display-color-wrapper">
                                    <input type="color" id="responsino-opt-feedback-btn-border" value="#104689" />
                                    <input type="text" id="responsino-opt-feedback-btn-border-hex" value="#104689" readonly />
                                </div>
                            </div>

                            <div class="responsino-form-builder-template-display-color-field">
                                <label class="responsino-form-builder-template-display-label"><?php esc_html_e('admin.builder.display.feedback_button.hover.background.label', 'responsino'); ?></label>
                                <div class="responsino-form-builder-template-display-color-wrapper">
                                    <input type="color" id="responsino-opt-feedback-btn-hover-bg" value="#0a2e5c" />
                                    <input type="text" id="responsino-opt-feedback-btn-hover-bg-hex" value="#0A2E5C" readonly />
                                </div>
                            </div>

                            <div class="responsino-form-builder-template-display-color-field">
                                <label class="responsino-form-builder-template-display-label"><?php esc_html_e('admin.builder.display.feedback_button.hover.text_color.label', 'responsino'); ?></label>
                                <div class="responsino-form-builder-template-display-color-wrapper">
                                    <input type="color" id="responsino-opt-feedback-btn-hover-text" value="#ffffff" />
                                    <input type="text" id="responsino-opt-feedback-btn-hover-text-hex" value="#FFFFFF" readonly />
                                </div>
                            </div>

                            <div class="responsino-form-builder-template-display-color-field">
                                <label class="responsino-form-builder-template-display-label"><?php esc_html_e('admin.builder.display.feedback_button.hover.border.label', 'responsino'); ?></label>
                                <div class="responsino-form-builder-template-display-color-wrapper">
                                    <input type="color" id="responsino-opt-feedback-btn-hover-border" value="#0a2e5c" />
                                    <input type="text" id="responsino-opt-feedback-btn-hover-border-hex" value="#0A2E5C" readonly />
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 3: GLOBALE EINSTELLUNGEN -->
            <div class="responsino-form-builder-template-display-section">
                <div class="responsino-form-builder-template-display-section-header">
                    <h4 class="responsino-form-builder-template-display-section-title">
                        <i class="fas fa-sliders"></i> <?php esc_html_e('admin.builder.display.global.title', 'responsino'); ?>
                    </h4>
                    <span class="responsino-form-builder-template-display-badge"><?php esc_html_e('admin.builder.display.step.3', 'responsino'); ?></span>
                </div>
                <p class="responsino-form-builder-template-display-desc">
                    <?php esc_html_e('admin.builder.display.global.description', 'responsino'); ?>
                </p>

                <!-- Global Settings Navigation Tabs -->
                <div class="responsino-form-builder-template-display-tabs-nav">
                    <button type="button" class="responsino-form-builder-template-display-tab-btn active" data-global-tab="behavior">
                        <i class="fas fa-hand"></i> <?php esc_html_e('admin.builder.display.tab.behavior', 'responsino'); ?>
                    </button>
                    <button type="button" class="responsino-form-builder-template-display-tab-btn" data-global-tab="box-model">
                        <i class="fas fa-expand"></i> <?php esc_html_e('admin.builder.display.tab.box_model', 'responsino'); ?>
                    </button>
                    <button type="button" class="responsino-form-builder-template-display-tab-btn" data-global-tab="styling">
                        <i class="fas fa-palette"></i> <?php esc_html_e('admin.builder.display.tab.styling', 'responsino'); ?>
                    </button>
                </div>

                <!-- TAB PANEL 1: VERHALTEN & FREQUENZ -->
                <div class="responsino-form-builder-template-display-tab-panel active" id="responsino-display-global-tab-behavior">

                    <div class="responsino-form-builder-template-display-group-card" id="responsino-display-group-frequency">
                        <h5 class="responsino-form-builder-template-display-group-title"><i class="fas fa-history"></i> <?php esc_html_e('admin.builder.display.group.frequency.title', 'responsino'); ?></h5>

                        <div class="responsino-form-builder-template-display-grid-2">
                            <div class="responsino-form-builder-template-display-form-row" id="responsino-display-row-close-days">
                                <label class="responsino-form-builder-template-display-label" for="responsino-style-overlay-rule-close-days">
                                    <?php esc_html_e('admin.builder.display.frequency.close_days.label', 'responsino'); ?>
                                </label>
                                <div class="responsino-form-builder-template-display-input-suffix">
                                    <input type="number" id="responsino-style-overlay-rule-close-days" value="1" min="0" />
                                    <span><?php esc_html_e('admin.builder.display.days', 'responsino'); ?></span>
                                </div>
                                <span class="responsino-form-builder-template-display-hint"><?php esc_html_e('admin.builder.display.frequency.close_days.hint', 'responsino'); ?></span>
                            </div>

                            <div class="responsino-form-builder-template-display-form-row" id="responsino-display-row-submit-days">
                                <label class="responsino-form-builder-template-display-label" for="responsino-style-overlay-rule-submit-days">
                                    <?php esc_html_e('admin.builder.display.frequency.submit_days.label', 'responsino'); ?>
                                </label>
                                <div class="responsino-form-builder-template-display-input-suffix">
                                    <input type="number" id="responsino-style-overlay-rule-submit-days" value="30" min="0" />
                                    <span><?php esc_html_e('admin.builder.display.days', 'responsino'); ?></span>
                                </div>
                                <span class="responsino-form-builder-template-display-hint"><?php esc_html_e('admin.builder.display.frequency.submit_days.hint', 'responsino'); ?></span>
                            </div>
                        </div>

                        <div class="responsino-form-builder-template-display-form-row" id="responsino-display-row-cookie-scope" style="margin-top: 10px;">
                            <label class="responsino-form-builder-template-display-label" for="responsino-style-overlay-rule-cookie-scope"><?php esc_html_e('admin.builder.display.cookie_scope.label', 'responsino'); ?></label>
                            <select id="responsino-style-overlay-rule-cookie-scope" class="responsino-form-select" style="height: 34px;">
                                <option value="domain" selected><?php esc_html_e('admin.builder.display.cookie_scope.domain', 'responsino'); ?></option>
                                <option value="page"><?php esc_html_e('admin.builder.display.cookie_scope.page', 'responsino'); ?></option>
                            </select>
                        </div>

                        <!-- Hide Click Trigger Options (Visible when trigger is click) -->
                        <div class="responsino-form-builder-template-display-form-row" id="responsino-display-row-hide-click-on-close" style="margin-top: 10px; display: none;">
                            <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                <div style="flex: 1; padding-right: 15px;">
                                    <label class="responsino-form-builder-template-display-label" style="margin-bottom: 0;"><?php esc_html_e('admin.builder.display.trigger.hide_click_on_close.label', 'responsino'); ?></label>
                                    <div style="font-size: 11px; color: var(--responsino-text-secondary);"><?php esc_html_e('admin.builder.display.trigger.hide_click_on_close.desc', 'responsino'); ?></div>
                                </div>
                                <label class="responsino-switch-wrapper" for="responsino-style-overlay-rule-hide-click-on-close" style="cursor: pointer;">
                                    <input type="checkbox" id="responsino-style-overlay-rule-hide-click-on-close" />
                                    <span class="responsino-switch-slider"></span>
                                </label>
                            </div>
                        </div>

                        <div class="responsino-form-builder-template-display-form-row" id="responsino-display-row-hide-click-on-submit" style="margin-top: 10px; display: none;">
                            <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                <div style="flex: 1; padding-right: 15px;">
                                    <label class="responsino-form-builder-template-display-label" style="margin-bottom: 0;"><?php esc_html_e('admin.builder.display.trigger.hide_click_on_submit.label', 'responsino'); ?></label>
                                    <div style="font-size: 11px; color: var(--responsino-text-secondary);"><?php esc_html_e('admin.builder.display.trigger.hide_click_on_submit.desc', 'responsino'); ?></div>
                                </div>
                                <label class="responsino-switch-wrapper" for="responsino-style-overlay-rule-hide-click-on-submit" style="cursor: pointer;">
                                    <input type="checkbox" id="responsino-style-overlay-rule-hide-click-on-submit" />
                                    <span class="responsino-switch-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="responsino-form-builder-template-display-group-card" id="responsino-display-group-closing-options" style="margin-top: 14px;">
                        <h5 class="responsino-form-builder-template-display-group-title"><i class="fas fa-times-circle"></i> <?php esc_html_e('admin.builder.display.group.closing_options.title', 'responsino'); ?></h5>

                        <div class="responsino-form-builder-template-display-toggle-list">
	                        <label class="responsino-form-builder-template-display-toggle-item">
		                        <div class="responsino-form-builder-template-display-toggle-info">
			                        <span class="responsino-form-builder-template-display-toggle-title"><?php esc_html_e('admin.builder.display.overlay.allow_scroll.title', 'responsino'); ?></span>
			                        <span class="responsino-form-builder-template-display-toggle-desc"><?php esc_html_e('admin.builder.display.overlay.allow_scroll.desc', 'responsino'); ?></span>
		                        </div>
		                        <div class="responsino-switch-wrapper">
			                        <input type="checkbox" id="responsino-style-overlay-rule-allow-scroll" checked />
			                        <span class="responsino-switch-slider"></span>
		                        </div>
	                        </label>

	                        <label class="responsino-form-builder-template-display-toggle-item">
		                        <div class="responsino-form-builder-template-display-toggle-info">
			                        <span class="responsino-form-builder-template-display-toggle-title"><?php esc_html_e('admin.builder.display.overlay.hide_header.title', 'responsino'); ?></span>
			                        <span class="responsino-form-builder-template-display-toggle-desc"><?php esc_html_e('admin.builder.display.overlay.hide_header.desc', 'responsino'); ?></span>
		                        </div>
		                        <div class="responsino-switch-wrapper">
			                        <input type="checkbox" id="responsino-style-overlay-rule-hide-header" />
			                        <span class="responsino-switch-slider"></span>
		                        </div>
	                        </label>

	                        <label class="responsino-form-builder-template-display-toggle-item">
		                        <div class="responsino-form-builder-template-display-toggle-info">
			                        <span class="responsino-form-builder-template-display-toggle-title"><?php esc_html_e('admin.builder.display.overlay.hide_footer.title', 'responsino'); ?></span>
			                        <span class="responsino-form-builder-template-display-toggle-desc"><?php esc_html_e('admin.builder.display.overlay.hide_footer.desc', 'responsino'); ?></span>
		                        </div>
		                        <div class="responsino-switch-wrapper">
			                        <input type="checkbox" id="responsino-style-overlay-rule-hide-footer" />
			                        <span class="responsino-switch-slider"></span>
		                        </div>
	                        </label>

                            <label class="responsino-form-builder-template-display-toggle-item">
                                <div class="responsino-form-builder-template-display-toggle-info">
                                    <span class="responsino-form-builder-template-display-toggle-title"><?php esc_html_e('admin.builder.display.overlay.show_backdrop.title', 'responsino'); ?></span>
                                    <span class="responsino-form-builder-template-display-toggle-desc"><?php esc_html_e('admin.builder.display.overlay.show_backdrop.desc', 'responsino'); ?></span>
                                </div>
                                <div class="responsino-switch-wrapper">
                                    <input type="checkbox" id="responsino-style-overlay-rule-show-backdrop" checked />
                                    <span class="responsino-switch-slider"></span>
                                </div>
                            </label>

                            <label class="responsino-form-builder-template-display-toggle-item">
                                <div class="responsino-form-builder-template-display-toggle-info">
                                    <span class="responsino-form-builder-template-display-toggle-title"><?php esc_html_e('admin.builder.display.overlay.close_on_backdrop.title', 'responsino'); ?></span>
                                    <span class="responsino-form-builder-template-display-toggle-desc"><?php esc_html_e('admin.builder.display.overlay.close_on_backdrop.desc', 'responsino'); ?></span>
                                </div>
                                <div class="responsino-switch-wrapper">
                                    <input type="checkbox" id="responsino-style-overlay-rule-backdrop" checked />
                                    <span class="responsino-switch-slider"></span>
                                </div>
                            </label>

                            <label class="responsino-form-builder-template-display-toggle-item">
                                <div class="responsino-form-builder-template-display-toggle-info">
                                    <span class="responsino-form-builder-template-display-toggle-title"><?php esc_html_e('admin.builder.display.overlay.esc_close.title', 'responsino'); ?></span>
                                    <span class="responsino-form-builder-template-display-toggle-desc"><?php esc_html_e('admin.builder.display.overlay.esc_close.desc', 'responsino'); ?></span>
                                </div>
                                <div class="responsino-switch-wrapper">
                                    <input type="checkbox" id="responsino-style-overlay-rule-esc" checked />
                                    <span class="responsino-switch-slider"></span>
                                </div>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- TAB PANEL 2: ABSTÄNDE & MAßE -->
                <div class="responsino-form-builder-template-display-tab-panel" id="responsino-display-global-tab-box-model">

                    <!-- Padding Box Model -->
                    <div class="responsino-form-builder-template-display-group-card" id="responsino-display-group-padding">
                        <div class="responsino-form-builder-template-display-box-header">
                            <h5 class="responsino-form-builder-template-display-group-title" style="margin: 0;"><i class="fas fa-expand"></i> <?php esc_html_e('admin.builder.display.box_model.padding.title', 'responsino'); ?></h5>
                            <div class="responsino-form-builder-template-display-box-actions">
                                <select id="responsino-globaldata-padding-unit" class="responsino-box-model-unit-select">
                                    <option value="px" selected>px</option>
                                    <option value="rem">rem</option>
                                    <option value="em">em</option>
                                </select>
                                <button type="button" id="responsino-globaldata-padding-link" class="responsino-box-model-link-btn is-linked" title="<?php esc_html_e('admin.builder.display.box_model.link.title', 'responsino'); ?>">
                                    <i class="fas fa-link"></i>
                                </button>
	                            <button type="button" id="responsino-globaldata-padding-reset" class="responsino-box-model-reset-btn" title="<?php esc_html_e('admin.builder.display.box_model.reset.title', 'responsino'); ?>">
		                            <i class="fas fa-undo"></i>
	                            </button>
                            </div>
                        </div>

                        <div class="responsino-form-builder-template-display-box-inputs">
                            <div class="responsino-form-builder-template-display-box-field">
                                <span><?php esc_html_e('admin.builder.display.box_model.label.top', 'responsino'); ?></span>
                                <input type="text" id="responsino-globaldata-padding-top" placeholder="16" />
                            </div>
                            <div class="responsino-form-builder-template-display-box-field">
                                <span><?php esc_html_e('admin.builder.display.box_model.label.right', 'responsino'); ?></span>
                                <input type="text" id="responsino-globaldata-padding-right" placeholder="16" />
                            </div>
                            <div class="responsino-form-builder-template-display-box-field">
                                <span><?php esc_html_e('admin.builder.display.box_model.label.bottom', 'responsino'); ?></span>
                                <input type="text" id="responsino-globaldata-padding-bottom" placeholder="16" />
                            </div>
                            <div class="responsino-form-builder-template-display-box-field">
                                <span><?php esc_html_e('admin.builder.display.box_model.label.left', 'responsino'); ?></span>
                                <input type="text" id="responsino-globaldata-padding-left" placeholder="16" />
                            </div>
                        </div>
                    </div>

                    <!-- Margin Box Model -->
                    <div class="responsino-form-builder-template-display-group-card" id="responsino-display-group-margin" style="margin-top: 14px;">
                        <div class="responsino-form-builder-template-display-box-header">
                            <h5 class="responsino-form-builder-template-display-group-title" style="margin: 0;"><i class="fas fa-arrows-alt"></i> <?php esc_html_e('admin.builder.display.box_model.margin.title', 'responsino'); ?></h5>
                            <div class="responsino-form-builder-template-display-box-actions">
                                <select id="responsino-globaldata-margin-unit" class="responsino-box-model-unit-select">
                                    <option value="px" selected>px</option>
                                    <option value="rem">rem</option>
                                    <option value="em">em</option>
                                </select>
                                <button type="button" id="responsino-globaldata-margin-link" class="responsino-box-model-link-btn is-linked" title="<?php esc_html_e('admin.builder.display.box_model.link.title', 'responsino'); ?>">
                                    <i class="fas fa-link"></i>
                                </button>
	                            <button type="button" id="responsino-globaldata-margin-reset" class="responsino-box-model-reset-btn" title="<?php esc_html_e('admin.builder.display.box_model.reset.title', 'responsino'); ?>">
		                            <i class="fas fa-undo"></i>
	                            </button>
                            </div>
                        </div>

                        <div class="responsino-form-builder-template-display-box-inputs">
                            <div class="responsino-form-builder-template-display-box-field">
                                <span><?php esc_html_e('admin.builder.display.box_model.label.top', 'responsino'); ?></span>
                                <input type="text" id="responsino-globaldata-margin-top" placeholder="0" />
                            </div>
                            <div class="responsino-form-builder-template-display-box-field">
                                <span><?php esc_html_e('admin.builder.display.box_model.label.right', 'responsino'); ?></span>
                                <input type="text" id="responsino-globaldata-margin-right" placeholder="auto" />
                            </div>
                            <div class="responsino-form-builder-template-display-box-field">
                                <span><?php esc_html_e('admin.builder.display.box_model.label.bottom', 'responsino'); ?></span>
                                <input type="text" id="responsino-globaldata-margin-bottom" placeholder="0" />
                            </div>
                            <div class="responsino-form-builder-template-display-box-field">
                                <span><?php esc_html_e('admin.builder.display.box_model.label.left', 'responsino'); ?></span>
                                <input type="text" id="responsino-globaldata-margin-left" placeholder="auto" />
                            </div>
                        </div>
                    </div>

                    <!-- Dimensions & Position -->
                    <div class="responsino-form-builder-template-display-group-card" id="responsino-display-group-dimensions" style="margin-top: 14px;">
                        <h5 class="responsino-form-builder-template-display-group-title"><i class="fas fa-arrows-alt"></i> <?php esc_html_e('admin.builder.display.dimensions.title', 'responsino'); ?></h5>
                        <div class="responsino-form-builder-template-display-form-row" id="responsino-display-row-overlay-position" style="margin-bottom: 12px;">
                            <label class="responsino-form-builder-template-display-label" for="responsino-style-overlay-position"><?php esc_html_e('admin.builder.display.dimensions.overlay_position.label', 'responsino'); ?></label>
                            <select id="responsino-style-overlay-position" class="responsino-form-select" style="height: 34px;">
                                <option value="center" selected><?php esc_html_e('admin.builder.display.dimensions.overlay_position.center', 'responsino'); ?></option>
                                <option value="bottom-right"><?php esc_html_e('admin.builder.display.dimensions.overlay_position.bottom_right', 'responsino'); ?></option>
                                <option value="bottom-left"><?php esc_html_e('admin.builder.display.dimensions.overlay_position.bottom_left', 'responsino'); ?></option>
                                <option value="bottom-middle"><?php esc_html_e('admin.builder.display.dimensions.overlay_position.bottom_middle', 'responsino'); ?></option>
                                <option value="right-middle"><?php esc_html_e('admin.builder.display.dimensions.overlay_position.right_middle', 'responsino'); ?></option>
                                <option value="left-middle"><?php esc_html_e('admin.builder.display.dimensions.overlay_position.left_middle', 'responsino'); ?></option>
                                <option value="top-right"><?php esc_html_e('admin.builder.display.dimensions.overlay_position.top_right', 'responsino'); ?></option>
                                <option value="top-middle"><?php esc_html_e('admin.builder.display.dimensions.overlay_position.top_middle', 'responsino'); ?></option>
                                <option value="top-left"><?php esc_html_e('admin.builder.display.dimensions.overlay_position.top_left', 'responsino'); ?></option>
                            </select>
                        </div>
                        <div class="responsino-form-builder-template-display-grid-2">
                            <div class="responsino-form-builder-template-display-form-row">
                                <label class="responsino-form-builder-template-display-label" for="responsino-style-overlay-rule-width"><?php esc_html_e('admin.builder.display.dimensions.max_width.label', 'responsino'); ?></label>
                                <div class="responsino-form-builder-template-display-input-suffix">
                                    <input type="number" id="responsino-style-overlay-rule-width" placeholder="480" min="280" max="1200" />
                                    <span>px</span>
                                </div>
                            </div>

                            <div class="responsino-form-builder-template-display-form-row" id="responsino-display-row-min-height">
                                <label class="responsino-form-builder-template-display-label" for="responsino-style-min-height"><?php esc_html_e('admin.builder.display.dimensions.min_height.label', 'responsino'); ?></label>
                                <div class="responsino-form-builder-template-display-input-suffix">
                                    <input type="number" id="responsino-style-min-height" placeholder="Auto" min="0" max="800" />
                                    <span>px</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- TAB PANEL 3: DESIGN & FARBEN -->
                <div class="responsino-form-builder-template-display-tab-panel" id="responsino-display-global-tab-styling">

                    <div class="responsino-form-builder-template-display-group-card" id="responsino-display-group-custom-colors">
                        <div class="responsino-switch-group" style="margin-bottom: 0;">
                            <div class="responsino-form-builder-template-display-toggle-info">
                                <span class="responsino-form-builder-template-display-toggle-title"><?php esc_html_e('admin.builder.display.custom_colors.title', 'responsino'); ?></span>
                                <span class="responsino-form-builder-template-display-toggle-desc"><?php esc_html_e('admin.builder.display.custom_colors.desc', 'responsino'); ?></span>
                            </div>
                            <label class="responsino-switch-wrapper" for="responsino-opt-globaldata-custom-enabled">
                                <input type="checkbox" id="responsino-opt-globaldata-custom-enabled" />
                                <span class="responsino-switch-slider"></span>
                            </label>
                        </div>

                        <div id="responsino-opt-globaldata-colors-subpanel" style="display: none; margin-top: 14px; padding-top: 14px; border-top: 1px dashed var(--responsino-border);">
                            <div class="responsino-form-builder-template-display-color-grid">

                                <div class="responsino-form-builder-template-display-color-field">
                                    <label class="responsino-form-builder-template-display-label"><?php esc_html_e('admin.builder.display.custom_colors.label.background', 'responsino'); ?></label>
                                    <div class="responsino-form-builder-template-display-color-wrapper">
                                        <input type="color" id="responsino-opt-globaldata-bg" value="#ffffff" />
                                        <input type="text" id="responsino-opt-globaldata-bg-hex" value="#FFFFFF" readonly />
                                    </div>
                                </div>

                                <div class="responsino-form-builder-template-display-color-field">
                                    <label class="responsino-form-builder-template-display-label"><?php esc_html_e('admin.builder.display.custom_colors.label.border', 'responsino'); ?></label>
                                    <div class="responsino-form-builder-template-display-color-wrapper">
                                        <input type="color" id="responsino-opt-globaldata-border" value="#e2e8f0" />
                                        <input type="text" id="responsino-opt-globaldata-border-hex" value="#E2E8F0" readonly />
                                    </div>
                                </div>

                                <div class="responsino-form-builder-template-display-color-field" style="grid-column: span 2;">
                                    <label class="responsino-form-builder-template-display-label" for="responsino-opt-globaldata-border-style"><?php esc_html_e('admin.builder.display.custom_colors.label.border_style', 'responsino'); ?></label>
                                    <select id="responsino-opt-globaldata-border-style" class="responsino-form-select" style="height: 34px;">
                                        <option value="solid" selected><?php esc_html_e('admin.builder.display.custom_colors.option.solid', 'responsino'); ?></option>
                                        <option value="dashed"><?php esc_html_e('admin.builder.display.custom_colors.option.dashed', 'responsino'); ?></option>
                                        <option value="dotted"><?php esc_html_e('admin.builder.display.custom_colors.option.dotted', 'responsino'); ?></option>
                                    </select>
                                </div>

	                            <div class="responsino-form-builder-template-display-color-field" style="grid-column: span 2;">
		                            <label class="responsino-form-builder-template-display-label" for="responsino-opt-globaldata-border-width"><?php esc_html_e('admin.builder.display.custom_colors.label.border_width', 'responsino'); ?></label>
		                            <div class="responsino-form-builder-template-display-input-suffix">
			                            <input type="number" id="responsino-opt-globaldata-border-width" value="1" min="0" max="20" />
			                            <span>px</span>
		                            </div>
	                            </div>

                                <div class="responsino-form-builder-template-display-color-field" style="grid-column: span 2;">
                                    <label class="responsino-form-builder-template-display-label" for="responsino-opt-globaldata-border-radius"><?php esc_html_e('admin.builder.display.custom_colors.label.border_radius', 'responsino'); ?></label>
                                    <div class="responsino-form-builder-template-display-input-suffix">
                                        <input type="number" id="responsino-opt-globaldata-border-radius" value="0" min="0" max="50" />
                                        <span>px</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="responsino-form-builder-template-display-group-card" id="responsino-display-group-header-footer" style="margin-top: 14px;">
                        <h5 class="responsino-form-builder-template-display-group-title"><i class="fas fa-heading"></i> <?php esc_html_e('admin.builder.display.header_footer.title', 'responsino'); ?></h5>
                        <div class="responsino-form-builder-template-display-grid-2">
                            <div class="responsino-form-builder-template-display-form-row">
                                <label class="responsino-form-builder-template-display-label" for="responsino-style-overlay-header-indicator"><?php esc_html_e('admin.builder.display.header_footer.indicator_type.label', 'responsino'); ?></label>
                                <select id="responsino-style-overlay-header-indicator" class="responsino-form-select" style="height: 34px;">
                                    <option value="progress" selected><?php esc_html_e('admin.builder.display.header_footer.indicator_type.option.progress', 'responsino'); ?></option>
                                    <option value="title"><?php esc_html_e('admin.builder.display.header_footer.indicator_type.option.title', 'responsino'); ?></option>
                                    <option value="step"><?php esc_html_e('admin.builder.display.header_footer.indicator_type.option.step', 'responsino'); ?></option>
                                    <option value="none"><?php esc_html_e('admin.builder.display.header_footer.indicator_type.option.none', 'responsino'); ?></option>
                                </select>
                            </div>

                            <div class="responsino-form-builder-template-display-form-row" id="responsino-style-overlay-header-title-container" style="display: none;">
                                <label class="responsino-form-builder-template-display-label" for="responsino-style-overlay-header-title"><?php esc_html_e('admin.builder.display.header_footer.custom_title.label', 'responsino'); ?></label>
                                <input type="text" id="responsino-style-overlay-header-title" class="responsino-form-input" placeholder="<?php esc_html_e('admin.builder.display.header_footer.custom_title.placeholder', 'responsino'); ?>" style="height: 34px;" />
                            </div>
                        </div>

                        <div class="responsino-switch-group" style="margin-top: 12px; margin-bottom: 0;">
                            <span class="responsino-switch-label" style="font-size: 11.5px;"><?php esc_html_e('admin.builder.display.header_footer.show_footer.label', 'responsino'); ?></span>
                            <label class="responsino-switch-wrapper" for="responsino-style-overlay-show-footer">
                                <input type="checkbox" id="responsino-style-overlay-show-footer" checked />
                                <span class="responsino-switch-slider"></span>
                            </label>
                        </div>

                        <div class="responsino-form-group" id="responsino-style-overlay-footer-text-container" style="margin-top: 8px; margin-bottom: 0;">
                            <label class="responsino-form-builder-template-display-label" for="responsino-style-overlay-footer-text"><?php esc_html_e('admin.builder.display.header_footer.custom_footer_text.label', 'responsino'); ?></label>
                            <input type="text" id="responsino-style-overlay-footer-text" class="responsino-form-input" placeholder="<?php esc_html_e('admin.builder.display.header_footer.custom_footer_text.placeholder', 'responsino'); ?>" style="height: 34px;" />
                        </div>
                    </div>

                </div>

            </div>

        </div>

    <!-- RIGHT COLUMN: LIVE INTERACTIVE SIMULATOR -->
    <div id="responsino-preview-simulator-container" class="responsino-preview-simulator-container"></div>


    </div>

</section>
