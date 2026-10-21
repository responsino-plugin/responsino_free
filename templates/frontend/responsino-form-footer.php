<?php
/**
 * Template for Form Overlay Widget
 */
if (!defined('ABSPATH')) exit;?>

<template id="responsino-general-overlay-template">
    <div class="responsino-feedback-plugin responsino-general-overlay-backdrop" role="dialog" aria-modal="true" aria-labelledby="responsino-general-overlay-title">
        <div class="responsino-general-overlay-modal responsino-overlay-card-pos-center">
            <!-- HEADER -->
            <div class="responsino-overlay-header">

                <button id="responsino-general-overlay-back-button" class="responsino-general-overlay-icon-btn" aria-label="Back" style="display: none;">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>

                <div id="responsino-general-overlay-header-indicator-wrapper" class="responsino-overlay-header-indicator-wrapper">
                    <div id="responsino-general-overlay-progress-bar-container" class="responsino-general-overlay-progress-bar-container" style="display: none;">
                        <div id="responsino-general-overlay-progress-bar" class="responsino-general-overlay-progress-bar"></div>
                    </div>

                    <div id="responsino-general-overlay-title" class="responsino-overlay-header-title" style="display: none;">Feedback</div>

                    <div id="responsino-general-overlay-step-indicator" class="responsino-overlay-header-step-indicator" style="display: none;"></div>
                </div>

                <button id="responsino-general-overlay-close-button" class="responsino-general-overlay-icon-btn" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- BODY -->
            <div class="responsino-overlay-body">
                <div id="responsino-general-overlay-content" class="responsino-feedback-type-placeholder responsino-form-id-1" data-type="overlay" data-form-id="1" data-form-updated="20260717120405"></div>
            </div>

            <!-- FOOTER -->
            <div class="responsino-overlay-footer">
                <?php esc_html_e('admin.frontend.default_footer_text', 'responsino') ?>
            </div>
        </div>
    </div>
</template>