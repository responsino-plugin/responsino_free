<?php
if (!defined('ABSPATH')) {
	exit;
}
?>

<section class="responsino-builder-view responsino-config-screen-layout" id="responsino-view-confirmation" aria-label="<?php esc_attr_e('admin.builder.confirmation.aria_label', 'responsino'); ?>">

	<div class="responsino-builder-section-col">
		<!-- Header -->
		<div class="responsino-builder-section-header">
			<h3 class="responsino-builder-section-title"><i class="fas fa-check-circle"></i> <?php esc_html_e('admin.builder.confirmation.title', 'responsino'); ?></h3>
		</div>

		<div class="responsino-builder-section">
			<div style="background-color: #f1f5f9; padding: 12px 16px; border-radius: 6px; font-size: 11.5px; color: var(--responsino-text-secondary); line-height: 1.45;">
				<?php esc_html_e('admin.builder.confirmation.description', 'responsino'); ?>
			</div>

			<div class="responsino-form-group">
				<label for="responsino-style-confirm-type"><?php esc_html_e('admin.builder.confirmation.confirm_type.label', 'responsino'); ?></label>
				<select id="responsino-style-confirm-type" class="responsino-form-select">
					<option value="message" selected><?php esc_html_e('admin.builder.confirmation.confirm_type.message', 'responsino'); ?></option>
					<option value="url"><?php esc_html_e('admin.builder.confirmation.confirm_type.url', 'responsino'); ?></option>
				</select>
			</div>

			<!-- WYSIWYG Message setting container (Matches reference image) -->
			<div class="responsino-form-group">
				<label for="responsino-style-confirm-color"><?php esc_html_e('admin.builder.confirmation.confirm_color.label', 'responsino'); ?></label>
				<div class="responsino-color-picker-row">
					<input type="color" id="responsino-style-confirm-color" class="responsino-form-input" style="width: 60px; height: 36px; padding: 2px; cursor: pointer;" value="#000000" />
					<input type="text" id="responsino-style-confirm-hex" class="responsino-form-input" value="#000000" style="width: 120px;" />
				</div>
			</div>

			<div class="responsino-form-group" id="responsino-config-group-confirm-msg">
				<label for="responsino_confirm_message_text"><?php esc_html_e('admin.builder.confirmation.confirm_message.label', 'responsino'); ?></label>

            <?php
            wp_editor(
                    esc_html__('admin.builder.confirmation.confirm_message.default', 'responsino'),
                    'responsino_confirm_message_text',
                    [
                            'media_buttons' => false,
                            'textarea_name' => 'responsino_form[confirm_message_text]',
                            'textarea_rows' => 1,
                            'tinymce'       => [
                                    'setup' => 'function(ed) { ed.on("init", function() { this.getDoc().body.style.fontSize = "13px"; }); }',
                            ]
                    ]
            );
            ?>

			</div>

			<!-- Custom redirect URL (Initially hidden) -->
			<div class="responsino-form-group" id="responsino-config-group-confirm-ext-url" style="display: none;">
				<label for="responsino-config-confirm-url"><?php esc_html_e('admin.builder.confirmation.redirect_url.label', 'responsino'); ?></label>
				<input type="url" id="responsino-config-confirm-url" class="responsino-form-input" value="<?php esc_attr_e('admin.builder.confirmation.redirect_url.default_value', 'responsino'); ?>" placeholder="<?php esc_attr_e('admin.builder.confirmation.redirect_url.placeholder', 'responsino'); ?>" />
			</div>
		</div>
	</div>
</section>
