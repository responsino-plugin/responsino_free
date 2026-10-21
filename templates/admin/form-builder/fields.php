<?php
if (!defined('ABSPATH')) {
	exit;
}
?>

<section class="responsino-builder-view responsino-felder-editor-layout" id="responsino-view-fields" aria-label="<?php esc_attr_e('admin.builder.fields.title', 'responsino'); ?>">

    <!-- Sidebar selection & specifics -->
    <aside class="responsino-builder-sidebar">

        <!-- Tab Header in Sidebar -->
        <div class="responsino-sidebar-tabs-header">
            <div class="responsino-sidebar-tab-trigger responsino-sidebar-tab-active" data-panel="add-fields" id="responsino-tab-trigger-add">
                <i class="fas fa-plus-circle"></i> <?php esc_html_e('admin.builder.fields.add_fields', 'responsino'); ?>
            </div>
            <div class="responsino-sidebar-tab-trigger" data-panel="field-options" id="responsino-tab-trigger-options">
                <i class="fas fa-sliders-h"></i> <?php esc_html_e('admin.builder.fields.field_options', 'responsino'); ?>
            </div>
        </div>

        <!-- Container für dynamische Warnmeldungen -->
        <div id="responsino-warning-banners-container"></div>

        <!-- Sidebar Tab Panel Content -->
        <div class="responsino-sidebar-tab-content-wrapper">

            <!-- PANEL A: Felder hinzufügen -->
            <div class="responsino-sidebar-tab-panel responsino-sidebar-tab-panel-active" id="responsino-panel-add-fields">

                <!-- Search boxes for standard fields -->
                <div class="responsino-search-box-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" id="responsino-search-fields-input" class="responsino-search-input" placeholder="<?php esc_attr_e('admin.builder.fields.search_placeholder', 'responsino'); ?>" title="<?php esc_html_e('admin.builder.fields.search_title', 'responsino'); ?>" autocomplete="off" />
                </div>

                <div class="responsino-sidebar-section-title" id="responsino-sec-title-standard">
                    <span><?php esc_html_e('admin.builder.fields.standard_fields', 'responsino'); ?></span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>

                <!-- Draggable elements container -->
                <div id="responsino-draggable-store-grid" style="display: flex; flex-direction: column; gap: 16px;margin-bottom: 15px;">

                    <!-- Grid 1: Standard elements -->
                    <div class="responsino-fields-grid">
                        <div class="responsino-draggable-field-item" draggable="true" data-type="headline" id="responsino-field-drag-headline">
                            <i class="fas fa-heading"></i>
                            <span><?php esc_html_e('admin.builder.fields.headline', 'responsino'); ?></span>
                        </div>

                        <div class="responsino-draggable-field-item" draggable="true" data-type="description" id="responsino-field-drag-desc">
                            <i class="fas fa-align-left"></i>
                            <span><?php esc_html_e('admin.builder.fields.description', 'responsino'); ?></span>
                        </div>

                        <div class="responsino-draggable-field-item" draggable="true" data-type="button" id="responsino-field-drag-button">
                            <i class="fas fa-square-minus" style="transform: scaleY(0.75);"></i>
                            <span><?php esc_html_e('admin.builder.fields.button', 'responsino'); ?></span>
                        </div>

                        <div class="responsino-draggable-field-item" draggable="true" data-type="textarea" id="responsino-field-drag-textarea">
                            <i class="fas fa-keyboard"></i>
                            <span><?php esc_html_e('admin.builder.fields.textarea', 'responsino'); ?></span>
                        </div>

	                    <div class="responsino-draggable-field-item" draggable="true" data-type="dropdown" id="responsino-field-drag-dropdown">
		                    <i class="fas fa-chevron-down"></i>
		                    <span><?php esc_html_e('fields.dropdown.name', 'responsino'); ?></span>
	                    </div>

	                    <div class="responsino-draggable-field-item" draggable="true" data-type="chips" id="responsino-field-drag-chips">
		                    <i class="fas fa-tags"></i>
		                    <span><?php esc_html_e('fields.chips.name', 'responsino'); ?></span>
	                    </div>

	                    <div class="responsino-draggable-field-item" draggable="true" data-type="radio" id="responsino-field-drag-radio">
		                    <i class="fas fa-circle-dot"></i>
		                    <span><?php esc_html_e('fields.radio.name', 'responsino'); ?></span>
	                    </div>

	                    <div class="responsino-draggable-field-item" draggable="true" data-type="name" id="responsino-field-drag-name">
		                    <i class="fas fa-user"></i>
		                    <span><?php esc_html_e('fields.name.name', 'responsino'); ?></span>
	                    </div>

	                    <div class="responsino-draggable-field-item" draggable="true" data-type="email" id="responsino-field-drag-email">
		                    <i class="fas fa-envelope"></i>
		                    <span><?php esc_html_e('fields.email.name', 'responsino'); ?></span>
	                    </div>
                    </div>

                    <div class="responsino-sidebar-section-title" id="responsino-sec-title-reviews" style="margin-top: 8px; margin-bottom: 0;">
                        <span><?php esc_html_e('admin.builder.fields.reviews', 'responsino'); ?></span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>

                    <!-- Grid 2: Reviews elements -->
                    <div class="responsino-fields-grid">
                        <div class="responsino-draggable-field-item" draggable="true" data-type="rating" id="responsino-field-drag-rating">
                            <i class="fas fa-star"></i>
                            <span><?php esc_html_e('admin.builder.fields.rating', 'responsino'); ?></span>
                        </div>
                    </div>

	                <div class="responsino-sidebar-section-title" id="responsino-sec-title-reviews" style="margin-top: 8px; margin-bottom: 0;">
		                <span><?php esc_html_e('admin.builder.fields.pro_section.headline', 'responsino'); ?></span>
		                <i class="fas fa-chevron-down text-xs"></i>
	                </div>

	                <div class="responsino-fields-grid">
		                <div class="responsino-draggable-field-item responsino-draggable-pro-item responsino-pro-feature-hint">
			                <i class="fas fa-thumbs-up"></i>
			                <span><?php esc_html_e('admin.builder.fields.thumbs', 'responsino'); ?></span>
		                </div>

		                <div class="responsino-draggable-field-item responsino-draggable-pro-item responsino-pro-feature-hint">
			                <i class="fas fa-smile"></i>
			                <span><?php esc_html_e('admin.builder.fields.smileys', 'responsino'); ?></span>
		                </div>

		                <div class="responsino-draggable-field-item responsino-draggable-pro-item responsino-pro-feature-hint">
			                <i class="fas fa-chart-bar"></i>
			                <span><?php esc_html_e('admin.builder.fields.nps', 'responsino'); ?></span>
		                </div>
	                </div>


                </div>

                <div class="responsino-empty-search-msg" id="responsino-search-no-results">
                    <?php esc_html_e('admin.builder.fields.search_no_results', 'responsino'); ?>
                </div>

                <div style="margin-top: auto; padding-top: 24px; font-size: 11px; color: var(--responsino-text-secondary); line-height: 1.4; border-top: 1px dashed var(--responsino-border);">
                    <i class="fas fa-mouse-pointer" style="margin-right: 4px;"></i>
                    <strong><?php esc_html_e('admin.builder.fields.tip', 'responsino'); ?>:</strong> <?php esc_html_e('admin.builder.fields.tip_text', 'responsino'); ?>
                </div>

            </div>

            <!-- PANEL B: Feldoptionen -->
            <div class="responsino-sidebar-tab-panel" id="responsino-panel-field-options">

                <!-- Default notice if no element selected -->
                <div class="responsino-no-field-selected" id="responsino-options-empty-notice">
                    <i class="fas fa-mouse-pointer"></i>
                    <p><?php esc_html_e('admin.builder.fields.no_field_selected', 'responsino'); ?></p>
                </div>

                <!-- Active options form -->
                <div class="responsino-field-options-form" id="responsino-options-form-container" style="display: none;">
                    <input type="hidden" id="responsino-opt-element-id" />

                    <div style="display: flex; flex-direction: column; margin-bottom: 12px;">
                        <span id="responsino-opt-element-type-badge" style="font-size: 12px; font-weight: 650; color: var(--responsino-text-secondary); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;"><?php esc_html_e('admin.builder.fields.options.field_type', 'responsino'); ?></span>
                        <span class="responsino-badge-id" id="responsino-opt-element-id-badge" style="align-self: flex-start; font-size: 10px; color: #64748b; background-color: #f1f5f9; padding: 2px 6px; border-radius: 4px; font-family: var(--responsino-font-mono);"><?php esc_html_e('admin.builder.fields.options.id', 'responsino'); ?>: #</span>
                    </div>

                    <!-- Basic Label Option -->
                    <div class="responsino-form-group" id="responsino-opt-group-label">
                        <label for="responsino-opt-label"><?php esc_html_e('admin.builder.fields.options.label.title', 'responsino'); ?> <i class="fas fa-question-circle responsino-help-tip" title="<?php esc_html_e('admin.builder.fields.options.label.hint', 'responsino'); ?>"></i></label>
                        <input type="text" id="responsino-opt-label" class="responsino-form-input" />
                    </div>

                    <!-- Dynamic settings dependent on Field Type -->

                    <!-- Description setting -->
                    <div class="responsino-form-group" id="responsino-opt-group-desc-text">
                        <label for="responsino-opt-desc-text"><?php esc_html_e('admin.builder.fields.options.description.title', 'responsino'); ?></label>
                        <textarea id="responsino-opt-desc-text" class="responsino-form-textarea" placeholder="<?php esc_html_e('admin.builder.fields.options.description.placeholder', 'responsino'); ?>"></textarea>
                    </div>

                    <!-- Placeholder parameter -->
                    <div class="responsino-form-group" id="responsino-opt-group-placeholder">
                        <label for="responsino-opt-placeholder"><?php esc_html_e('admin.builder.fields.options.placeholder.title', 'responsino'); ?></label>
                        <input type="text" id="responsino-opt-placeholder" class="responsino-form-input" placeholder="<?php esc_html_e('admin.builder.fields.options.placeholder.placeholder', 'responsino'); ?>" />
                    </div>

                    <!-- Button Type Picker -->
                    <div class="responsino-form-group" id="responsino-opt-group-button-type">
                        <label for="responsino-opt-button-type"><?php esc_html_e('admin.builder.fields.options.button_type.title', 'responsino'); ?></label>
                        <select id="responsino-opt-button-type" class="responsino-form-select">
                            <option value="next"><?php esc_html_e('admin.builder.fields.options.button_type.next', 'responsino'); ?></option>
                            <option value="submit"><?php esc_html_e('admin.builder.fields.options.button_type.submit', 'responsino'); ?></option>
                            <option value="back"><?php esc_html_e('admin.builder.fields.options.button_type.back', 'responsino'); ?></option>
                        </select>
                    </div>

                    <!-- Button Icon Picker -->
                    <div class="responsino-form-group" id="responsino-opt-group-icon">
                        <label for="responsino-opt-icon"><?php esc_html_e('admin.builder.fields.options.icon.title', 'responsino'); ?> <i class="far fa-question-circle responsino-help-tip" title="<?php esc_html_e('admin.builder.fields.options.icon.hint', 'responsino'); ?>"></i></label>
                        <select id="responsino-opt-icon" class="responsino-form-select">
                            <option value="fa-arrow-right"><?php esc_html_e('admin.builder.fields.options.icon.option.arrow_right', 'responsino'); ?></option>
                            <option value="fa-arrow-circle-right"><?php esc_html_e('admin.builder.fields.options.icon.option.arrow_circle_right', 'responsino'); ?></option>
                            <option value="fa-arrow-left"><?php esc_html_e('admin.builder.fields.options.icon.option.arrow_left', 'responsino'); ?></option>
                            <option value="fa-arrow-circle-left"><?php esc_html_e('admin.builder.fields.options.icon.option.arrow_circle_left', 'responsino'); ?></option>
                            <option value="fa-paper-plane"><?php esc_html_e('admin.builder.fields.options.icon.option.paper_plane', 'responsino'); ?></option>
                            <option value="fa-check"><?php esc_html_e('admin.builder.fields.options.icon.option.check', 'responsino'); ?></option>
                            <option value="fa-heart"><?php esc_html_e('admin.builder.fields.options.icon.option.heart', 'responsino'); ?></option>
                            <option value="fa-comment"><?php esc_html_e('admin.builder.fields.options.icon.option.comment', 'responsino'); ?></option>
                            <option value="fa-laugh-beam"><?php esc_html_e('admin.builder.fields.options.icon.option.laugh_beam', 'responsino'); ?></option>
                            <option value="fa-futbol"><?php esc_html_e('admin.builder.fields.options.icon.option.futbol', 'responsino'); ?></option>
                            <option value="fa-lightbulb"><?php esc_html_e('admin.builder.fields.options.icon.option.lightbulb', 'responsino'); ?></option>
                            <option value="fa-bug"><?php esc_html_e('admin.builder.fields.options.icon.option.bug', 'responsino'); ?></option>
                            <option value="fa-comment-dots"><?php esc_html_e('admin.builder.fields.options.icon.option.comment_dots', 'responsino'); ?></option>
                            <option value="fa-times"><?php esc_html_e('admin.builder.fields.options.icon.option.none', 'responsino'); ?></option>
                        </select>
                    </div>

                    <!-- Button Icon Position -->
                    <div class="responsino-form-group" id="responsino-opt-group-icon-position">
                        <label for="responsino-opt-icon-position"><?php esc_html_e('admin.builder.fields.options.icon_position.title', 'responsino'); ?></label>
                        <select id="responsino-opt-icon-position" class="responsino-form-select">
                            <option value="right"><?php esc_html_e('admin.builder.fields.options.icon_position.right', 'responsino'); ?></option>
                            <option value="left"><?php esc_html_e('admin.builder.fields.options.icon_position.left', 'responsino'); ?></option>
                        </select>
                    </div>

                    <!-- Rating Stars Amount -->
                    <div class="responsino-form-group" id="responsino-opt-group-rating-stars">
                        <label for="responsino-opt-rating-stars"><?php esc_html_e('admin.builder.fields.options.rating_stars.title', 'responsino'); ?> <i class="fas fa-question-circle responsino-help-tip" title="<?php esc_html_e('admin.builder.fields.options.rating_stars.hint', 'responsino'); ?>"></i></label>
                        <select id="responsino-opt-rating-stars" class="responsino-form-select">
                            <option value="3"><?php esc_html_e('admin.builder.fields.options.rating_stars.3', 'responsino'); ?></option>
                            <option value="5"><?php esc_html_e('admin.builder.fields.options.rating_stars.5', 'responsino'); ?></option>
                        </select>
                    </div>

                    <!-- Alignment Selection (Ausrichtung) -->
                    <div class="responsino-form-group" id="responsino-opt-group-alignment">
                        <label for="responsino-opt-alignment"><?php esc_html_e('admin.builder.fields.options.alignment.title', 'responsino'); ?> <i class="fas fa-question-circle responsino-help-tip" title="<?php esc_html_e('admin.builder.fields.options.alignment.hint', 'responsino'); ?>"></i></label>
                        <select id="responsino-opt-alignment" class="responsino-form-select">
                            <option value="left"><?php esc_html_e('admin.builder.fields.options.alignment.left', 'responsino'); ?></option>
                            <option value="center"><?php esc_html_e('admin.builder.fields.options.alignment.center', 'responsino'); ?></option>
                            <option value="right"><?php esc_html_e('admin.builder.fields.options.alignment.right', 'responsino'); ?></option>
                        </select>
                    </div>

                    <!-- Heading Tag Type Selection -->
                    <div class="responsino-form-group" id="responsino-opt-group-h-type" style="display: none;">
                        <label for="responsino-opt-h-type"><?php esc_html_e('admin.builder.fields.h_type.title', 'responsino'); ?> <i class="fas fa-question-circle responsino-help-tip" title="<?php esc_html_e('admin.builder.fields.h_type.hint', 'responsino'); ?>"></i></label>
                        <select id="responsino-opt-h-type" class="responsino-form-select">
                            <option value="h1"><?php esc_html_e('admin.builder.fields.h_type.h1', 'responsino'); ?></option>
                            <option value="h2"><?php esc_html_e('admin.builder.fields.h_type.h2', 'responsino'); ?></option>
                            <option value="h3"><?php esc_html_e('admin.builder.fields.h_type.h3', 'responsino'); ?></option>
                            <option value="h4"><?php esc_html_e('admin.builder.fields.h_type.h4', 'responsino'); ?></option>
                            <option value="h5"><?php esc_html_e('admin.builder.fields.h_type.h5', 'responsino'); ?></option>
                            <option value="h6"><?php esc_html_e('admin.builder.fields.h_type.h6', 'responsino'); ?></option>
                            <option value="div"><?php esc_html_e('admin.builder.fields.h_type.div', 'responsino'); ?></option>
                        </select>
                    </div>

                    <!-- Text formatting settings -->
                    <div class="responsino-form-group" id="responsino-opt-group-textFormatting" style="display: none;">
                        <label><?php esc_html_e('admin.builder.fields.text_formatting.title', 'responsino'); ?> <i class="fas fa-question-circle responsino-help-tip" title="<?php esc_html_e('admin.builder.fields.text_formatting.hint', 'responsino'); ?>"></i></label>
                        <div style="display: flex; gap: 8px; width: 100%;">
                            <!-- Bold -->
                            <label class="responsino-formatting-btn" style="flex: 1; display: flex; align-items: center; justify-content: center; height: 32px;">
                                <input type="checkbox" id="responsino-opt-bold" style="display: none;" />
                                <i class="fas fa-bold"></i>
                            </label>
                            <!-- Italic -->
                            <label class="responsino-formatting-btn" style="flex: 1; display: flex; align-items: center; justify-content: center; height: 32px;">
                                <input type="checkbox" id="responsino-opt-italic" style="display: none;" />
                                <i class="fas fa-italic"></i>
                            </label>
                            <!-- Underline -->
                            <label class="responsino-formatting-btn" style="flex: 1; display: flex; align-items: center; justify-content: center; height: 32px;">
                                <input type="checkbox" id="responsino-opt-underline" style="display: none;" />
                                <i class="fas fa-underline"></i>
                            </label>
                        </div>
                    </div>

	                <!-- Name Format Settings -->
	                <div class="responsino-form-group" id="responsino-opt-group-name-type" style="margin-bottom: 14px; display: none;">
		                <label style="font-size: 11px; font-weight: 650; margin-bottom: 6px; display: block;"><?php esc_html_e('fields.name.format.label', 'responsino'); ?></label>
		                <select id="responsino-opt-name-type" class="responsino-form-input" style="padding: 6px;">
			                <option value="full" selected><?php esc_html_e('fields.name.format.full', 'responsino'); ?></option>
			                <option value="first_last"><?php esc_html_e('fields.name.format.first_last', 'responsino'); ?></option>
			                <option value="first_middle_last"><?php esc_html_e('fields.name.format.first_middle_last', 'responsino'); ?></option>
		                </select>
	                </div>

	                <div class="responsino-form-group" id="responsino-opt-group-name-placeholders" style="margin-bottom: 14px; display: none;">
		                <label style="font-size: 11px; font-weight: 650; margin-bottom: 6px; display: block;"><?php esc_html_e('admin.builder.fields.placeholder.label', 'responsino'); ?></label>
		                <div style="display: flex; flex-direction: column; gap: 8px;">
			                <input type="text" id="responsino-opt-name-ph-first" class="responsino-form-input" placeholder="<?php esc_html_e('fields.name.first_name', 'responsino'); ?>" />
			                <input type="text" id="responsino-opt-name-ph-middle" class="responsino-form-input" placeholder="<?php esc_html_e('fields.name.middle_name', 'responsino'); ?>" />
			                <input type="text" id="responsino-opt-name-ph-last" class="responsino-form-input" placeholder="<?php esc_html_e('fields.name.last_name', 'responsino'); ?>" />
		                </div>
	                </div>

                    <!-- Inline styles (Font size) -->
                    <div class="responsino-form-group" id="responsino-opt-group-font-size">
                        <div>
                            <input type="hidden" id="responsino-opt-font-size" value="inherit" />
                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 6px;">
                                <span style="font-size: 13px; font-weight: 550; color: var(--responsino-text-main); white-space: nowrap;"><?php esc_html_e('admin.builder.fields.font_size.title', 'responsino'); ?></span>
                                <button type="button" id="responsino-opt-font-size-reset" class="responsino-btn" style="font-size: 10px; padding: 2px 4px; height: auto; background: none; border: none; color: var(--responsino-primary); cursor: pointer; text-decoration: underline; box-shadow: none;"><?php esc_html_e('admin.builder.fields.font_size.reset', 'responsino'); ?></button>
                            </div>

	                        <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px; width: 100%;">
		                        <input type="range" id="responsino-opt-font-size-slider" min="6" max="48" step="1" value="16" class="responsino-range-input" style="flex-grow: 1; margin: 0; min-width: 0;" />
		                        <div style="display: inline-flex; align-items: center; border: 1px solid var(--responsino-border); border-radius: 6px; padding: 4px 8px; background: #ffffff; width: 68px; min-width: 68px; justify-content: space-between; height: 28px; box-sizing: border-box;">
			                        <input type="number" id="responsino-opt-font-size-input" min="6" max="48" value="16" style="width: 32px; border: none; font-size: 13px; text-align: right; padding: 0; outline: none; background: transparent; -webkit-appearance: none; -moz-appearance: textfield; margin: 0; font-family: inherit; font-weight: 600; color: var(--responsino-text-main);" />
			                        <span style="font-size: 12px; color: #94a3b8; font-weight: 500; margin-left: 2px; pointer-events: none; user-select: none;">px</span>
		                        </div>
	                        </div>
                        </div>

                        <div style="margin-top: 14px;">
                            <input type="hidden" id="responsino-opt-line-height" value="inherit" />
                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 6px;">
                                <span style="font-size: 13px; font-weight: 550; color: var(--responsino-text-main); white-space: nowrap;"><?php esc_html_e('admin.builder.fields.line_height.title', 'responsino'); ?></span>
                                <button type="button" id="responsino-opt-line-height-reset" class="responsino-btn" style="font-size: 10px; padding: 2px 4px; height: auto; background: none; border: none; color: var(--responsino-primary); cursor: pointer; text-decoration: underline; box-shadow: none;"><?php esc_html_e('admin.builder.fields.line_height.reset', 'responsino'); ?></button>
                            </div>

                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px; width: 100%;">
                                <input type="range" id="responsino-opt-line-height-slider" min="0.8" max="3.0" step="0.1" value="1.4" class="responsino-range-input" style="flex-grow: 1; margin: 0; min-width: 0;" />
                                <div style="display: inline-flex; align-items: center; border: 1px solid var(--responsino-border); border-radius: 6px; padding: 4px 8px; background: #ffffff; width: 68px; min-width: 68px; justify-content: space-between; height: 28px; box-sizing: border-box;">
                                    <input type="number" id="responsino-opt-line-height-input" min="0.8" max="3.0" step="0.1" value="1.4" style="width: 32px; border: none; font-size: 13px; text-align: right; padding: 0; outline: none; background: transparent; -webkit-appearance: none; -moz-appearance: textfield; margin: 0; font-family: inherit; font-weight: 600; color: var(--responsino-text-main);" />
                                    <span style="font-size: 12px; color: #94a3b8; font-weight: 500; margin-left: 2px; pointer-events: none; user-select: none;"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Option: BorderRadius (Eckenradius) -->
                    <div class="responsino-form-group" id="responsino-opt-group-border-radius" style="display: none;">
                        <div>
                            <input type="hidden" id="responsino-opt-border-radius" value="inherit" />
                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 6px;">
                                <span style="font-size: 13px; font-weight: 550; color: var(--responsino-text-main); white-space: nowrap;"><?php esc_html_e('admin.builder.fields.border_radius.title', 'responsino'); ?></span>
                                <button type="button" id="responsino-opt-border-radius-reset" class="responsino-btn" style="font-size: 10px; padding: 2px 4px; height: auto; background: none; border: none; color: var(--responsino-primary); cursor: pointer; text-decoration: underline; box-shadow: none;"><?php esc_html_e('admin.builder.fields.border_radius.reset', 'responsino'); ?></button>
                            </div>

                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px; width: 100%;">
                                <input type="range" id="responsino-opt-border-radius-slider" min="0" max="100" step="1" value="6" class="responsino-range-input" style="flex-grow: 1; margin: 0; min-width: 0;" />
                                <div style="display: inline-flex; align-items: center; border: 1px solid var(--responsino-border); border-radius: 6px; padding: 4px 8px; background: #ffffff; width: 68px; min-width: 68px; justify-content: space-between; height: 28px; box-sizing: border-box;">
                                    <input type="number" id="responsino-opt-border-radius-input" min="0" max="100" value="6" style="width: 32px; border: none; font-size: 13px; text-align: right; padding: 0; outline: none; background: transparent; -webkit-appearance: none; -moz-appearance: textfield; margin: 0; font-family: inherit; font-weight: 600; color: var(--responsino-text-main);" />
                                    <span style="font-size: 12px; color: #94a3b8; font-weight: 500; margin-left: 2px; pointer-events: none; user-select: none;">px</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Option: Textfarbe -->
                    <div class="responsino-form-group" id="responsino-opt-group-textColor" style="display: none; margin-bottom: 14px;">
                        <label for="responsino-opt-text-color" style="display: flex; align-items: center; gap: 6px; font-weight: 550; font-size: 11.5px; color: var(--responsino-text-main); margin-bottom: 4px;">
                            <i class="fas fa-paint-brush" style="color: var(--responsino-text-secondary); font-size: 11px;"></i> <?php esc_html_e('admin.builder.fields.text_color.title', 'responsino'); ?>
                        </label>
                        <div style="display: flex; gap: 6px; align-items: center;">
                            <input type="color" id="responsino-opt-text-color" style="width: 44px; height: 32px; padding: 2px; cursor: pointer; border-radius: 4px; border: 1px solid var(--responsino-border);" />
                            <input type="text" id="responsino-opt-text-color-hex" class="responsino-form-input" style="font-family: var(--responsino-font-mono); font-size: 11px; height: 32px; padding: 4px 8px;" placeholder="#222222" />
                        </div>
                    </div>

                    <!-- Validation: Required status -->
                    <div class="responsino-switch-group" id="responsino-opt-group-required">
                        <span class="responsino-switch-label"><i class="fas fa-exclamation-triangle" style="color: var(--responsino-warning); font-size: 11px;"></i> <?php esc_html_e('admin.builder.fields.required.title', 'responsino'); ?></span>
                        <label class="responsino-switch-wrapper" for="responsino-opt-required">
                            <input type="checkbox" id="responsino-opt-required" />
                            <span class="responsino-switch-slider"></span>
                        </label>
                    </div>

                    <!-- Option: Hide Label -->
                    <div class="responsino-switch-group" id="responsino-opt-group-hide-label" style="display: none;">
                        <span class="responsino-switch-label"><i class="fas fa-eye-slash" style="color: var(--responsino-text-secondary); font-size: 11px;"></i> <?php esc_html_e('admin.builder.fields.hide_label.title', 'responsino'); ?></span>
                        <label class="responsino-switch-wrapper" for="responsino-opt-hide-label">
                            <input type="checkbox" id="responsino-opt-hide-label" />
                            <span class="responsino-switch-slider"></span>
                        </label>
                    </div>

	                <!-- Option: ChoicesList (Auswahlmöglichkeiten) -->
	                <div class="responsino-form-group" id="responsino-opt-group-choicesList" style="display: none; margin-top: 14px; margin-bottom: 14px;">
		                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
			                <label style="margin-bottom: 0; font-size: 13px; font-weight: 600; color: var(--responsino-text-main); display: flex; align-items: center; gap: 6px;">
				                <?php echo esc_html__('fields.dropdown.choices_title', 'responsino'); ?> <i class="far fa-question-circle responsino-help-tip" title="<?php echo esc_attr__('fields.dropdown.choices_tooltip', 'responsino'); ?>"></i>
			                </label>
		                </div>
		                <div id="responsino-opt-choices-list-container" class="responsino-choices-list-container"></div>
	                </div>

                    <!-- Option: Full Width -->
                    <div class="responsino-switch-group" id="responsino-opt-group-full-width">
                        <span class="responsino-switch-label"><i class="fas fa-arrows-alt-h" style="color: var(--responsino-text-secondary); font-size: 11px;"></i> <?php esc_html_e('admin.builder.fields.full_width.title', 'responsino'); ?></span>
                        <label class="responsino-switch-wrapper" for="responsino-opt-full-width">
                            <input type="checkbox" id="responsino-opt-full-width" />
                            <span class="responsino-switch-slider"></span>
                        </label>
                    </div>

                    <!-- Option: Element-Breite -->
                    <div class="responsino-form-group" id="responsino-opt-group-width" style="display: none;">
                        <label for="responsino-opt-width" style="display: flex; align-items: center; gap: 6px; font-weight: 550; font-size: 11.5px; color: var(--responsino-text-main); margin-bottom: 4px;">
                            <i class="fas fa-arrows-alt-h" style="color: var(--responsino-text-secondary); font-size: 11px;"></i> <?php esc_html_e('admin.builder.fields.width.title', 'responsino'); ?>
                        </label>
                        <select id="responsino-opt-width" class="responsino-form-select">
                            <option value="100%"><?php esc_html_e('admin.builder.fields.width.100', 'responsino'); ?></option>
                            <option value="50%"><?php esc_html_e('admin.builder.fields.width.50', 'responsino'); ?></option>
                            <option value="33%"><?php esc_html_e('admin.builder.fields.width.33', 'responsino'); ?></option>
                            <option value="25%"><?php esc_html_e('admin.builder.fields.width.25', 'responsino'); ?></option>
                        </select>
                    </div>

                    <!-- Option: In neuer Zeile starten -->
                    <div class="responsino-switch-group" id="responsino-opt-group-clear-before" style="display: none;">
                        <span class="responsino-switch-label"><i class="fas fa-level-down-alt" style="color: var(--responsino-text-secondary); font-size: 11px; transform: rotate(90deg);"></i> <?php esc_html_e('admin.builder.fields.clear_before.title', 'responsino'); ?></span>
                        <label class="responsino-switch-wrapper" for="responsino-opt-clear-before">
                            <input type="checkbox" id="responsino-opt-clear-before" />
                            <span class="responsino-switch-slider"></span>
                        </label>
                    </div>

	                <!-- Email Options -->
	                <div class="responsino-switch-group" id="responsino-opt-group-email-confirmation" style="margin-bottom: 14px; display: none;">
		                <span class="responsino-switch-label"><i class="fas fa-envelope-open-text" style="color: var(--responsino-primary); font-size: 11px;"></i> <?php esc_html_e('fields.email.confirmation_activation', 'responsino'); ?></span>
		                <label class="responsino-switch-wrapper" for="responsino-opt-email-confirmation">
			                <input type="checkbox" id="responsino-opt-email-confirmation" />
			                <span class="responsino-switch-slider"></span>
		                </label>
	                </div>

	                <div class="responsino-form-group" id="responsino-opt-group-email-placeholders" style="margin-bottom: 14px; display: none;">
		                <label style="font-size: 11px; font-weight: 650; margin-bottom: 6px; display: block;"><?php esc_html_e('admin.builder.fields.placeholder.label', 'responsino'); ?></label>
		                <div style="display: flex; flex-direction: column; gap: 8px;">
			                <input type="text" id="responsino-opt-email-ph-main" class="responsino-form-input" placeholder="<?php esc_html_e('fields.email.placeholder', 'responsino'); ?>" />
			                <input type="text" id="responsino-opt-email-ph-confirm" class="responsino-form-input" placeholder="<?php esc_html_e('fields.email.confirmation_placeholder', 'responsino'); ?>" />
		                </div>
	                </div>

                    <!-- Button Custom Color Settings -->
                    <div id="responsino-opt-group-button-colors" style="border-top: 1px dashed var(--responsino-border); padding-top: 14px; margin-top: 14px; display: none; flex-direction: column; gap: 12px;">
                        <div id="responsino-opt-custom-colors-title" style="font-weight: 650; font-size: 11.5px; color: var(--responsino-text-primary); margin-bottom: 2px;">
                            <i class="fas fa-palette" style="color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.fields.custom_colors.title', 'responsino'); ?>
                        </div>

                        <!-- Toggle to override colors -->
                        <div class="responsino-switch-group" style="margin-bottom: 6px;">
                            <span class="responsino-switch-label" style="font-size: 11px;"><?php esc_html_e('admin.builder.fields.custom_colors.enabled_label', 'responsino'); ?></span>
                            <label class="responsino-switch-wrapper" for="responsino-opt-btn-custom-colors-enabled">
                                <input type="checkbox" id="responsino-opt-btn-custom-colors-enabled" />
                                <span class="responsino-switch-slider"></span>
                            </label>
                        </div>

                        <div id="responsino-opt-btn-colors-subpanel" style="display: none; flex-direction: column; gap: 10px; padding-left: 6px; border-left: 2px solid var(--responsino-border);">
                            <!-- Standard state colors -->
                            <div id="responsino-opt-colors-standard-header" style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--responsino-text-secondary);"><?php esc_html_e('admin.builder.fields.custom_colors.standard_state', 'responsino'); ?></div>

                            <div class="responsino-form-group" id="responsino-opt-colors-group-bg" style="margin-bottom: 4px;">
                                <label style="font-size: 10.5px;"><?php esc_html_e('admin.builder.fields.custom_colors.bg_color', 'responsino'); ?></label>
                                <div style="display: flex; gap: 6px; align-items: center;">
                                    <input type="color" id="responsino-opt-btn-bg-color" style="width: 44px; height: 32px; padding: 2px; cursor: pointer; border-radius: 4px; border: 1px solid var(--responsino-border);" />
                                    <input type="text" id="responsino-opt-btn-bg-hex" class="responsino-form-input" style="font-family: var(--responsino-font-mono); font-size: 11px; height: 32px; padding: 4px 8px;" />
                                </div>
                            </div>

                            <div class="responsino-form-group" id="responsino-opt-colors-group-text" style="margin-bottom: 4px;">
                                <label style="font-size: 10.5px;"><?php esc_html_e('admin.builder.fields.custom_colors.text_color', 'responsino'); ?></label>
                                <div style="display: flex; gap: 6px; align-items: center;">
                                    <input type="color" id="responsino-opt-btn-text-color" style="width: 44px; height: 32px; padding: 2px; cursor: pointer; border-radius: 4px; border: 1px solid var(--responsino-border);" />
                                    <input type="text" id="responsino-opt-btn-text-hex" class="responsino-form-input" style="font-family: var(--responsino-font-mono); font-size: 11px; height: 32px; padding: 4px 8px;" />
                                </div>
                            </div>

                            <div class="responsino-form-group" id="responsino-opt-colors-group-border" style="margin-bottom: 8px;">
                                <label style="font-size: 10.5px;"><?php esc_html_e('admin.builder.fields.custom_colors.border_color', 'responsino'); ?></label>
                                <div style="display: flex; gap: 6px; align-items: center;">
                                    <input type="color" id="responsino-opt-btn-border-color" style="width: 44px; height: 32px; padding: 2px; cursor: pointer; border-radius: 4px; border: 1px solid var(--responsino-border);" />
                                    <input type="text" id="responsino-opt-btn-border-hex" class="responsino-form-input" style="font-family: var(--responsino-font-mono); font-size: 11px; height: 32px; padding: 4px 8px;" />
                                </div>
                            </div>

                            <!-- Hover state colors -->
                            <div id="responsino-opt-colors-hover-header" style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--responsino-text-secondary); margin-top: 4px; border-top: 1px dashed var(--responsino-border); padding-top: 8px;"><?php esc_html_e('admin.builder.fields.custom_colors.hover_state', 'responsino'); ?></div>

                            <div class="responsino-form-group" id="responsino-opt-colors-group-hover-bg" style="margin-bottom: 4px;">
                                <label style="font-size: 10.5px;"><?php esc_html_e('admin.builder.fields.custom_colors.bg_color_hover', 'responsino'); ?></label>
                                <div style="display: flex; gap: 6px; align-items: center;">
                                    <input type="color" id="responsino-opt-btn-hover-bg-color" style="width: 44px; height: 32px; padding: 2px; cursor: pointer; border-radius: 4px; border: 1px solid var(--responsino-border);" />
                                    <input type="text" id="responsino-opt-btn-hover-bg-hex" class="responsino-form-input" style="font-family: var(--responsino-font-mono); font-size: 11px; height: 32px; padding: 4px 8px;" />
                                </div>
                            </div>

                            <div class="responsino-form-group" id="responsino-opt-colors-group-hover-text" style="margin-bottom: 4px;">
                                <label style="font-size: 10.5px;"><?php esc_html_e('admin.builder.fields.custom_colors.text_color_hover', 'responsino'); ?></label>
                                <div style="display: flex; gap: 6px; align-items: center;">
                                    <input type="color" id="responsino-opt-btn-hover-text-color" style="width: 44px; height: 32px; padding: 2px; cursor: pointer; border-radius: 4px; border: 1px solid var(--responsino-border);" />
                                    <input type="text" id="responsino-opt-btn-hover-text-hex" class="responsino-form-input" style="font-family: var(--responsino-font-mono); font-size: 11px; height: 32px; padding: 4px 8px;" />
                                </div>
                            </div>

                            <div class="responsino-form-group" id="responsino-opt-colors-group-hover-border" style="margin-bottom: 4px;">
                                <label style="font-size: 10.5px;"><?php esc_html_e('admin.builder.fields.custom_colors.border_color_hover', 'responsino'); ?></label>
                                <div style="display: flex; gap: 6px; align-items: center;">
                                    <input type="color" id="responsino-opt-btn-hover-border-color" style="width: 44px; height: 32px; padding: 2px; cursor: pointer; border-radius: 4px; border: 1px solid var(--responsino-border);" />
                                    <input type="text" id="responsino-opt-btn-hover-border-hex" class="responsino-form-input" style="font-family: var(--responsino-font-mono); font-size: 11px; height: 32px; padding: 4px 8px;" />
                                </div>
                            </div>

                            <button type="button" id="responsino-opt-btn-colors-reset" class="responsino-btn" style="margin-top: 10px; width: 100%; font-size: 11px; padding: 6px 12px; height: auto; display: flex; align-items: center; justify-content: center; gap: 6px; border: 1px solid var(--responsino-border); background: #ffffff; color: var(--responsino-text-primary); border-radius: 4px; cursor: pointer; transition: all 0.2s; box-shadow: none;">
                                <i class="fas fa-undo"></i> <?php esc_html_e('admin.builder.fields.custom_colors.reset', 'responsino'); ?>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2 Trigger Toggle for Buttons & Ratings -->
                    <div id="responsino-opt-group-step2" style="border-top: 1px dashed var(--responsino-border); padding-top: 14px; margin-top: 4px; flex-direction: column;">
                        <div class="responsino-switch-group">
              <span class="responsino-switch-label" style="color: var(--responsino-step2-accent); font-weight: 650;">
                <i class="fas fa-project-diagram"></i> <?php esc_html_e('admin.builder.fields.step2.title_activate', 'responsino'); ?>
              </span>
                            <label class="responsino-switch-wrapper" for="responsino-opt-step2-enabled">
                                <input type="checkbox" id="responsino-opt-step2-enabled" />
                                <span class="responsino-switch-slider"></span>
                            </label>
                        </div>
                        <p style="font-size: 10.5px; color: var(--responsino-text-secondary); line-height: 1.35; margin-top: 6px;">
                            <?php esc_html_e('admin.builder.fields.step2.description', 'responsino'); ?>
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </aside>

    <!-- Visual Editor Canvas Area -->
    <article class="responsino-editor-canvas-column" id="responsino-canvas-column">

        <div class="responsino-editor-steps-container">

            <!-- SCHRITT 1 CONTAINER CARD -->
            <div class="responsino-step-card responsino-step-card-step1" id="responsino-step-1-card">

                <div class="responsino-step-header" id="responsino-step-1-header">
                    <div class="responsino-step-meta-left">
                        <span class="responsino-step-index-badge responsino-step-badge-1">1</span>
                        <div>
                            <h3 class="responsino-step-title"><?php esc_html_e('admin.builder.fields.step1.title', 'responsino'); ?></h3>
                            <span class="responsino-step-subtitle" id="responsino-step-1-count"><?php esc_html_e('admin.builder.fields.step1.subtitle', 'responsino'); ?></span>
                        </div>
                    </div>
                    <div class="responsino-step-nav-action" id="responsino-step-1-nav-toggle" style="display: none;">
                        <i class="fas fa-compress-alt"></i> <?php esc_html_e('admin.builder.fields.nav.back', 'responsino'); ?>
                    </div>
                </div>

                <!-- Droppable Area -->
                <div class="responsino-step-canvas-droppable" id="responsino-canvas-step-1" data-step="1">

                    <div class="responsino-canvas-empty-notifier">
                        <i class="fas fa-hand-holding-hand drag-icon"></i>
                        <span><?php esc_html_e('admin.builder.fields.step1.empty_notifier', 'responsino'); ?></span>
                    </div>

                </div>

            </div>


            <!-- CONNECTOR CONNECTOR LINE (VISUAL ONLY) -->
            <div id="responsino-steps-visual-connector" style="display: flex; justify-content: center; align-items: center; margin: -10px 0;">
                <div style="width: 2px; height: 24px; background: repeating-linear-gradient(to bottom, #cbd5e1, #cbd5e1 4px, transparent 4px, transparent 8px); z-index: 1;"></div>
            </div>


            <!-- SCHRITT 2 CONTAINER CARD (Tied dynamically) -->
            <div class="responsino-step-card responsino-step-card-step2" id="responsino-step-2-card">

                <div class="responsino-step-header" id="responsino-step-2-header" style="cursor: pointer;">
                    <div class="responsino-step-meta-left">
                        <span class="responsino-step-index-badge responsino-step-badge-2">2</span>
                        <div>
                            <h3 class="responsino-step-title"><?php esc_html_e('admin.builder.fields.step2.title', 'responsino'); ?></h3>
                            <span class="responsino-step-subtitle" id="responsino-step-2-count"><?php esc_html_e('admin.builder.fields.step2.subtitle', 'responsino'); ?></span>
                        </div>
                    </div>
                    <div class="responsino-step-nav-action" id="responsino-step-2-nav-toggle">
                        <i class="fas fa-expand-alt"></i> <?php esc_html_e('admin.builder.fields.nav.maximize', 'responsino'); ?>
                    </div>
                </div>

                <!-- Droppable Area Step 2 -->
                <div class="responsino-step-canvas-droppable" id="responsino-canvas-step-2" data-step="2">

                    <div class="responsino-canvas-empty-notifier" id="responsino-step-2-disabled-notifier">
                        <i class="fas fa-lock"></i>
                        <span><?php esc_html_e('admin.builder.fields.step2.disabled_notifier', 'responsino'); ?></span>
                    </div>

                    <div class="responsino-canvas-empty-notifier" id="responsino-step-2-enabled-empty-notifier" style="display: none;">
                        <i class="fas fa-plus"></i>
                        <span><?php esc_html_e('admin.builder.fields.step2.enabled_notifier', 'responsino'); ?></span>
                    </div>

                </div>

            </div>

        </div>

    </article>

    <!-- Split-View Live-Vorschau Column (Initially collapsed or shown per click) -->
    <aside class="responsino-split-preview-column responsino-feedback-plugin" id="responsino-split-preview-column" style="display: none;">
	    <!-- RIGHT COLUMN: LIVE INTERACTIVE SIMULATOR -->
	    <div id="responsino-preview-simulator-container-fields" class="responsino-preview-simulator-container"></div>
    </aside>

</section>
