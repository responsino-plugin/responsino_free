<?php

/**
 * Responsino Form Builder Template
 */
if (!defined('ABSPATH')) {
    exit;
}

$responsinoStatusText = esc_html__('admin.page.builder.status.paused', 'responsino');
$responsinoStatusClass = 'responsino-status-paused';
$responsinoStatus = $formData['status'] ?? 1;
switch ($responsinoStatus) {
    case 2:
        $responsinoStatusText = esc_html__('admin.page.builder.status.live', 'responsino');
        $responsinoStatusClass = 'responsino-status-live';
        break;
    case 3:
        $responsinoStatusText = esc_html__('admin.page.builder.status.admin_only', 'responsino');
        $responsinoStatusClass = 'responsino-status-admin-only';
        break;
}
$responsinoDisplayedFormId = '-';
if (!empty($formId) && is_numeric($formId)) {
	$responsinoDisplayedFormId = (int) $formId;
}
?>

<!-- Responsino FormBuilder Application Frame -->
<main id="responsino-formbuilder-app" role="main">

    <div class="responsino-formbuilder-frame">

        <!-- Builder Header Area -->
        <div class="responsino-builder-header">

            <!-- Header Top Row (Form Title, Status, Action Buttons) -->
            <div class="responsino-header-top-row">
                <div class="responsino-header-title-container">
                    <div class="responsino-title-input-group">
                        <div class="responsino-form-title-wrapper">
                            <input type="text" id="responsino-form-title" class="responsino-form-title-input" value="<?php echo (esc_html($formData['settings']['main']['title'] ?? '') ?? esc_html__('admin.page.builder.form_title.default', 'responsino'))?>" title="<?php echo esc_html__('admin.page.builder.form_title.edit_title', 'responsino') ?>" />
                            <i class="fas fa-pen text-xs" style="color: #94a3b8; cursor: pointer;"></i>
                        </div>
	                    <span style="font-size: 11px; color: var(--responsino-text-secondary);"><?php esc_html_e('admin.page.builder.form_id', 'responsino'); ?>: <span id="responsino-active-form-id-display"><?php echo esc_html($responsinoDisplayedFormId) ?></span>
	                        <span style="margin-left: 12px; border-left: 1px solid rgba(255, 255, 255, 0.2); padding-left: 12px;"><?php esc_html_e('admin.page.builder.last_saved', 'responsino'); ?>: <span id="responsino-last-updated-display"><?php echo '-' ?></span></span>
	                        <span style="margin-left: 12px; border-left: 1px solid rgba(255, 255, 255, 0.2); padding-left: 12px;"><?php esc_html_e('admin.page.builder.last_published', 'responsino'); ?>: <span id="responsino-last-published-display"><?php echo '-' ?></span></span>
	                    </span>
                    </div>
                </div>

                <!-- Action Button Group & Status -->
                <div class="responsino-action-button-group">
                    <!-- Undo and Redo Button Group -->
                    <div class="responsino-header-history-group">
                        <button class="responsino-btn" id="responsino-btn-undo" title="<?php echo esc_attr__('admin.page.builder.undo', 'responsino') ?>" disabled>
                            <i class="fas fa-undo"></i>
                        </button>
                        <button class="responsino-btn" id="responsino-btn-redo" title="<?php echo esc_attr__('admin.page.builder.redo', 'responsino') ?>" disabled>
                            <i class="fas fa-redo"></i>
                        </button>
                    </div>

                    <!-- Combined Status Dropdown Indicator -->
                    <div class="responsino-status-dropdown-container">
                        <button class="responsino-status-wrapper-btn" id="responsino-btn-change-status" title="<?php echo esc_html__('admin.page.builder.change_status', 'responsino') ?>">
                            <div class="responsino-status-indicator <?php echo esc_html($responsinoStatusClass) ?>" id="responsino-form-status-badge">
                                <span class="responsino-status-dot"></span>
                                <span id="responsino-form-status-text"><?php echo esc_html($responsinoStatusText) ?></span>
                                <i class="fas fa-chevron-down" style="font-size: 8px; opacity: 0.7; margin-left: 2px;"></i>
                            </div>
                        </button>
                        <div class="responsino-status-dropdown-menu" id="responsino-status-dropdown-menu">
                            <div class="responsino-status-dropdown-item" data-status="1">
                                <span class="responsino-status-dot-paused" style="width: 6px; height: 6px; border-radius: 50%; display: inline-block;"></span>
                                <span><?php esc_html_e('admin.page.builder.status.paused', 'responsino'); ?></span>
                                <i class="fas fa-check responsino-status-check"></i>
                            </div>
                            <div class="responsino-status-dropdown-item" data-status="2">
                                <span class="responsino-status-dot-live" style="width: 6px; height: 6px; border-radius: 50%; display: inline-block;"></span>
                                <span><?php esc_html_e('admin.page.builder.status.live', 'responsino'); ?></span>
                                <i class="fas fa-check responsino-status-check"></i>
                            </div>
                            <div class="responsino-status-dropdown-item" data-status="3">
                                <span class="responsino-status-dot-admin" style="width: 6px; height: 6px; border-radius: 50%; display: inline-block;"></span>
                                <span><?php esc_html_e('admin.page.builder.status.admin_only', 'responsino'); ?></span>
                                <i class="fas fa-check responsino-status-check"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Templates & Import/Export as separate small grouped buttons -->
                    <div style="display: flex; gap: 4px; align-items: center;">
                        <button class="responsino-btn" id="responsino-btn-load-templates" title="<?php echo esc_attr__('admin.page.builder.load_templates', 'responsino') ?>" style="padding: 8px 10px; font-size: 12px; height: 34px;">
                            <i class="fas fa-folder-open"></i> <?php esc_html_e('admin.page.builder.templates', 'responsino'); ?>
                        </button>
                        <button class="responsino-btn" id="responsino-btn-export-json" title="<?php echo esc_attr__('admin.page.builder.json_export_import', 'responsino') ?>" style="padding: 8px 10px; font-size: 12px; height: 34px;">
                            <i class="fas fa-code"></i> <?php esc_html_e('admin.page.builder.json_label', 'responsino'); ?>
                        </button>
                    </div>

                    <!-- Save / Publish buttons -->
                    <div style="display: flex; gap: 4px; align-items: center;">
                        <button class="responsino-btn" id="responsino-btn-save-draft" title="<?php echo esc_attr__('admin.page.builder.save_draft', 'responsino') ?>" style="padding: 8px 10px; font-size: 12px; height: 34px;">
                            <i class="fas fa-save"></i> <?php esc_html_e('admin.page.builder.save', 'responsino'); ?>
                        </button>
                        <button class="responsino-btn responsino-btn-primary" id="responsino-btn-publish" title="<?php echo esc_attr__('admin.page.builder.publish', 'responsino') ?>" style="padding: 8px 12px; font-size: 12px; height: 34px;">
                            <i class="fas fa-paper-plane"></i> <?php esc_html_e('admin.page.builder.publish_btn', 'responsino'); ?>
                        </button>
                    </div>

                    <!-- Integrated Preview Segment (Split-View and Fullscreen) -->
                    <div class="responsino-header-preview-segment">
                        <button class="responsino-segment-btn" id="responsino-btn-toggle-split-preview" title="<?php echo esc_attr__('admin.page.builder.split_view_title', 'responsino') ?>">
                            <i class="fas fa-columns"></i> <?php esc_html_e('admin.page.builder.split_view', 'responsino'); ?>
                        </button>
                        <button class="responsino-segment-btn" id="responsino-btn-preview-modal" title="<?php echo esc_attr__('admin.page.builder.preview_modal_title', 'responsino') ?>">
                            <i class="fas fa-expand"></i> <?php esc_html_e('admin.page.builder.preview', 'responsino'); ?>
                        </button>
                    </div>
                </div>

                <button class="responsino-btn responsino-btn-close" id="responsino-btn-close-app" title="<?php echo esc_attr__('admin.page.builder.close_editor', 'responsino') ?>">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Header Bottom Row (Configuration Step Navigation) -->
            <nav class="responsino-header-nav-row" aria-label="<?php echo esc_attr__('admin.page.builder.nav_steps', 'responsino') ?>">
                <div class="responsino-nav-tab" data-view="fields" id="responsino-nav-fields">
                    <i class="fas fa-cubes"></i> <?php esc_html_e('admin.page.builder.nav.fields', 'responsino'); ?>
                </div>
                <div class="responsino-nav-tab" data-view="general" id="responsino-nav-general">
                    <i class="fas fa-cog"></i> <?php esc_html_e('admin.page.builder.nav.general', 'responsino'); ?>
                </div>
                <div class="responsino-nav-tab" data-view="styles" id="responsino-nav-styles">
                    <i class="fas fa-paint-brush"></i> <?php esc_html_e('admin.page.builder.nav.styles', 'responsino'); ?>
                </div>
                <div class="responsino-nav-tab" data-view="display" id="responsino-nav-display">
                    <i class="fas fa-eye"></i> <?php esc_html_e('admin.page.builder.nav.display', 'responsino'); ?>
                </div>
                <div class="responsino-nav-tab" data-view="targeting" id="responsino-nav-targeting">
                    <i class="fas fa-bullseye"></i> <?php esc_html_e('admin.page.builder.nav.targeting', 'responsino'); ?>
                </div>
                <div class="responsino-nav-tab" data-view="confirmation" id="responsino-nav-confirmation">
                    <i class="fas fa-check-circle"></i> <?php esc_html_e('admin.page.builder.nav.confirmation', 'responsino'); ?>
                </div>
                <div class="responsino-nav-tab" data-view="notification" id="responsino-nav-notification">
                    <i class="fas fa-envelope"></i> <?php esc_html_e('admin.page.builder.nav.notification', 'responsino'); ?>
                </div>
                <div class="responsino-nav-tab" data-view="tracking" id="responsino-nav-tracking">
                    <i class="fas fa-chart-line"></i> <?php esc_html_e('admin.page.builder.nav.tracking', 'responsino'); ?>
                </div>
            </nav>

        </div>

        <!-- Content Area split by Selected tab (Loaded dynamically from /src/templates/admin/form-builder/) -->
        <div class="responsino-builder-content-container">

	        <?php
			include RESPONSINO_PLUGIN_PATH . 'templates/admin/form-builder/default.php';
            include RESPONSINO_PLUGIN_PATH . 'templates/admin/form-builder/fields.php';
            include RESPONSINO_PLUGIN_PATH . 'templates/admin/form-builder/general.php';
            include RESPONSINO_PLUGIN_PATH . 'templates/admin/form-builder/styles.php';
            include RESPONSINO_PLUGIN_PATH . 'templates/admin/form-builder/display.php';
            include RESPONSINO_PLUGIN_PATH . 'templates/admin/form-builder/targeting.php';
            include RESPONSINO_PLUGIN_PATH . 'templates/admin/form-builder/confirmation.php';
            include RESPONSINO_PLUGIN_PATH . 'templates/admin/form-builder/notification.php';
            include RESPONSINO_PLUGIN_PATH . 'templates/admin/form-builder/tracking.php';
            ?>

        </div>

    </div>

</main>

<!-- MODAL 1: EXPORT / IMPORT MODAL -->
<div id="responsino-modal-export" class="responsino-modal-overlay" role="dialog" aria-modal="true" aria-labelledby="responsino-json-title">
    <div class="responsino-modal-box" style="max-width: 650px;">
        <div class="responsino-modal-header">
            <h3 class="responsino-modal-title" id="responsino-json-title"><i class="fas fa-code"></i> <?php esc_html_e('admin.page.builder.json_modal.title', 'responsino'); ?></h3>
            <button class="responsino-btn responsino-btn-close" id="responsino-btn-close-export-modal" title="<?php esc_attr_e('admin.page.builder.close', 'responsino'); ?>"><i class="fas fa-times"></i></button>
        </div>
        <div class="responsino-modal-body">
            <p style="margin-bottom: 12px; color: var(--responsino-text-secondary);">
                <?php esc_html_e('admin.page.builder.json_modal.description', 'responsino'); ?>
            </p>

            <div class="responsino-form-group">
                <label for="responsino-json-textarea"><?php esc_html_e('admin.page.builder.json_modal.label', 'responsino'); ?></label>
                <textarea id="responsino-json-textarea" class="responsino-form-textarea" style="min-height: 180px; font-size: 11.5px; background-color: #0f172a; color: #a5f3fc;" placeholder="<?php esc_attr_e('admin.page.builder.json_modal.placeholder', 'responsino'); ?>"></textarea>
            </div>
        </div>
        <div class="responsino-modal-footer">
            <button class="responsino-btn" id="responsino-btn-modal-import-action" style="background-color: var(--responsino-primary); color: white; border-color: var(--responsino-primary);">
                <i class="fas fa-download"></i> <?php esc_html_e('admin.page.builder.json_modal.import_btn', 'responsino'); ?>
            </button>
            <button class="responsino-btn" id="responsino-btn-copy-json" style="background-color: var(--responsino-success); color: white; border-color: var(--responsino-success);">
                <i class="fas fa-copy"></i> <?php esc_html_e('admin.page.builder.json_modal.copy_btn', 'responsino'); ?>
            </button>
            <button class="responsino-btn" id="responsino-btn-close-export-cancel"><?php esc_html_e('admin.page.builder.close', 'responsino'); ?></button>
        </div>
    </div>
</div>

<!-- MODAL 2: LIVE POPUP WIDGET PREVIEW -->
<div id="responsino-modal-preview" class="responsino-modal-overlay" role="dialog" aria-modal="true" aria-labelledby="responsino-preview-title">
    <div class="responsino-modal-box" style="max-width: 900px; width: 95%;">

	    <div id="responsino-preview-simulator-container-modal-box" class="responsino-preview-simulator-container"></div>

    </div>
</div>

<!-- MODAL 3: SELECT TEMPLATE -->
<div id="responsino-modal-templates" class="responsino-modal-overlay" role="dialog" aria-modal="true" aria-labelledby="responsino-tmpl-title">
    <div class="responsino-modal-box" style="max-width: 1200px; width: 95%; max-height: 90vh;">
        <div class="responsino-modal-header">
            <h3 class="responsino-modal-title" id="responsino-tmpl-title"><i class="fas fa-folder-open"></i> <?php esc_html_e('admin.page.builder.modal_tmpl_title', 'responsino'); ?></h3>
            <button class="responsino-btn responsino-btn-close" id="responsino-btn-close-tmpl-modal"><i class="fas fa-times"></i></button>
        </div>
        <div class="responsino-modal-body" style="overflow-y: auto; flex: 1; padding: 24px;">
            <p style="margin-bottom: 20px; color: var(--responsino-text-secondary); font-size: 13.5px;">
                <?php esc_html_e('admin.page.builder.modal_tmpl_desc', 'responsino'); ?>
            </p>

            <div class="responsino-template-grid-new" id="responsino-templates-container">
                <!-- Wird dynamisch befüllt -->
            </div>
        </div>
        <div class="responsino-modal-footer">
            <button class="responsino-btn" id="responsino-btn-close-tmpl-cancel"><?php esc_html_e('admin.page.builder.modal_tmpl_cancel', 'responsino'); ?></button>
        </div>
    </div>
</div>


<!-- PRO / Freemius Upgrade Modal -->
<div id="responsino-modal-pro-upgrade" class="responsino-modal-overlay" role="dialog" aria-modal="true" aria-labelledby="responsino-pro-title">
    <div class="responsino-modal-box" style="max-width: 500px;">
        <div class="responsino-modal-header" style="background-color: var(--responsino-primary-light); border-bottom: 1px solid var(--responsino-border); padding: 16px 24px; border-top-left-radius: 12px; border-top-right-radius: 12px;">
            <h3 class="responsino-modal-title" id="responsino-pro-title" style="color: var(--responsino-primary); font-weight: 700;">
                <i class="fas fa-crown" style="color: var(--responsino-warning);"></i> <?php esc_html_e('admin.page.builder.pro.title', 'responsino'); ?>
            </h3>
            <button class="responsino-btn responsino-btn-close" id="responsino-btn-close-pro-modal"><i class="fas fa-times"></i></button>
        </div>
        <div class="responsino-modal-body" style="padding: 24px;">
            <div style="text-align: center; margin-bottom: 24px;">
                <div style="font-size: 48px; margin-bottom: 12px; color: var(--responsino-warning);">
                    <i class="fas fa-gem"></i>
                </div>
                <h4 style="font-size: 18px; font-weight: 700; color: var(--responsino-text); margin-bottom: 8px;"><?php esc_html_e('admin.page.builder.pro.subtitle', 'responsino'); ?></h4>
                <p style="color: var(--responsino-text-secondary); font-size: 13.5px; line-height: 1.5; margin: 0;">
                    <?php esc_html_e('admin.page.builder.pro.description', 'responsino'); ?>
                </p>
            </div>

            <div style="background-color: var(--responsino-bg); border: 1px solid var(--responsino-border); border-radius: 8px; padding: 16px; margin-bottom: 4px;">
                <h5 style="font-weight: 700; font-size: 13px; color: var(--responsino-text); margin-bottom: 12px; margin-top: 0; text-transform: uppercase; letter-spacing: 0.05em;"><?php esc_html_e('admin.page.builder.pro.benefits_title', 'responsino'); ?></h5>
                <ul style="list-style: none; display: flex; flex-direction: column; gap: 10px; font-size: 13px; padding-left: 0; margin: 0;">
                    <li style="display: flex; align-items: flex-start; gap: 8px; color: var(--responsino-text);">
                        <i class="fas fa-check-circle" style="color: var(--responsino-success); margin-top: 2px;"></i>
                        <span><?php esc_html_e('admin.page.builder.pro.benefit.1', 'responsino'); ?></span>
                    </li>
                    <li style="display: flex; align-items: flex-start; gap: 8px; color: var(--responsino-text);">
                        <i class="fas fa-check-circle" style="color: var(--responsino-success); margin-top: 2px;"></i>
                        <span><?php esc_html_e('admin.page.builder.pro.benefit.2', 'responsino'); ?></span>
                    </li>
                    <li style="display: flex; align-items: flex-start; gap: 8px; color: var(--responsino-text);">
                        <i class="fas fa-check-circle" style="color: var(--responsino-success); margin-top: 2px;"></i>
                        <span><?php esc_html_e('admin.page.builder.pro.benefit.3', 'responsino'); ?></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="responsino-modal-footer" style="padding: 16px 24px; border-top: 1px solid var(--responsino-border); display: flex; justify-content: flex-end; gap: 12px; background-color: var(--responsino-bg); border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
            <button class="responsino-btn" id="responsino-btn-close-pro-cancel" style="border: 1px solid var(--responsino-border); background: white; color: var(--responsino-text-secondary); font-weight: 550; padding: 8px 16px; border-radius: 6px; cursor: pointer; height: auto;"><?php esc_html_e('admin.page.builder.pro.cancel_btn', 'responsino'); ?></button>
            <a href="https://responsino.de" target="_blank" class="responsino-btn" id="responsino-btn-pro-upgrade-cta" style="background-color: var(--responsino-primary); color: white; font-weight: 600; padding: 8px 20px; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; border: 1px solid var(--responsino-primary); box-shadow: var(--responsino-shadow-md); transition: all 0.2s; height: auto;">
                <i class="fas fa-shopping-cart"></i> <?php esc_html_e('admin.page.builder.pro.upgrade_btn', 'responsino'); ?>
            </a>
        </div>
    </div>
</div>

<!-- Generic Preview Shell Template -->
<template id="responsino-preview-shell-template">
	<div class="responsino-form-builder-template-display-preview-panel">
		<div class="responsino-form-builder-template-display-preview-card">
			<!-- Preview Toolbar -->
			<div data-slot="header" class="responsino-form-builder-template-display-preview-toolbar"></div>

			<!-- Simulated Website Stage -->
			<div data-slot="body" class="responsino-form-builder-template-display-stage" id="responsino-display-stage-wrapper">
				<!-- The inner shell for the actual widget/overlay content -->
				<div class="responsino-preview-shell responsino-preview-shell--overlay">
					<div data-slot="inner-header"></div>
					<div data-slot="inner-body"></div>
					<div data-slot="inner-footer"></div>
				</div>
			</div>

			<!-- Status Bar -->
			<div data-slot="footer" class="responsino-form-builder-template-display-preview-footer"></div>
		</div>
	</div>
</template>

<!-- Neues allgemeines Overlay-Formular Template -->
<template id="responsino-general-overlay-template">
    <div class="responsino-feedback-plugin responsino-general-overlay-backdrop" role="dialog" aria-modal="true" aria-labelledby="responsino-general-overlay-title">
        <div class="responsino-general-overlay-modal responsino-overlay-card-pos-center">
            <!-- HEADER -->
            <div class="responsino-overlay-header">
                <!-- Zurück-Button (Sinnvoll bei mehrschrittigen Formularen) -->
                <button id="responsino-general-overlay-back-button" class="responsino-general-overlay-icon-btn" aria-label="<?php echo esc_attr__('admin.builder.overlay_template.back', 'responsino') ?>" style="display: none;">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>

                <!-- Flexibler Indikator-Container (wird dynamisch gesteuert: progress, title, step oder none) -->
                <div id="responsino-general-overlay-header-indicator-wrapper" class="responsino-overlay-header-indicator-wrapper">
                    <!-- Variante 1: Progressbar -->
                    <div id="responsino-general-overlay-progress-bar-container" class="responsino-general-overlay-progress-bar-container" style="display: none;">
                        <div id="responsino-general-overlay-progress-bar" class="responsino-general-overlay-progress-bar"></div>
                    </div>

                    <!-- Variante 2: Formulartitel -->
                    <div id="responsino-general-overlay-title" class="responsino-overlay-header-title" style="display: none;"><?php esc_html_e('admin.builder.overlay_template.feedback', 'responsino'); ?></div>

                    <!-- Variante 3: Schritt-Indikator -->
                    <div id="responsino-general-overlay-step-indicator" class="responsino-overlay-header-step-indicator" style="display: none;"></div>
                </div>

                <!-- Schließen-Button -->
                <button id="responsino-general-overlay-close-button" class="responsino-general-overlay-icon-btn" aria-label="<?php echo esc_attr__('admin.builder.overlay_template.close', 'responsino') ?>">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- BODY -->
            <div class="responsino-overlay-body">
                <div id="responsino-general-overlay-content" class="responsino-feedback-type-placeholder responsino-form-id-1" data-type="overlay" data-form-id="1" data-form-updated="20260717120405"></div>
            </div>

            <!-- FOOTER -->
            <div class="responsino-overlay-footer">
                <?php esc_html_e('admin.builder.overlay_template.footer_text', 'responsino'); ?>
            </div>
        </div>
    </div>
</template>

<!-- Template for dynamic warning banners -->
<template id="responsino-tmpl-warning-banner">
    <div class="responsino-submit-warning-banner">
        <i class="fas fa-exclamation-triangle"></i>
        <span class="responsino-warning-text"></span>
        <span class="responsino-warning-count-badge" style="display: none;"></span>
    </div>
</template>

<!-- Toast Notifications Container -->
<div id="responsino-toast-container" aria-live="polite"></div>