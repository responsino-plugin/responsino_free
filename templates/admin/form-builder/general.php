<?php
if (!defined('ABSPATH')) {
	exit;
}
?>

<section class="responsino-builder-view responsino-config-screen-layout" id="responsino-view-general" aria-label="<?php esc_attr_e('admin.builder.general.title', 'responsino'); ?>">

	<div class="responsino-builder-section-col">
		<!-- Header -->
		<div class="responsino-builder-section-header">
			<h3 class="responsino-builder-section-title"><i class="fas fa-sliders-h"></i> <?php esc_html_e('admin.builder.general.title', 'responsino'); ?></h3>
		</div>

		<div class="responsino-builder-section">
			<div class="responsino-form-group">
				<label for="responsino-setting-form-id"><?php esc_html_e('admin.builder.general.form_id.label', 'responsino'); ?> <span style="color: var(--responsino-text-secondary);">(<?php esc_html_e('admin.builder.general.form_id.hint', 'responsino'); ?>)</span></label>
				<input type="text" id="responsino-setting-form-id" class="responsino-form-input" value="<?php echo (int) $formId ?>" readonly style="background-color: #f1f5f9; cursor: not-allowed;" />
				<p class="responsino-settings-text"><?php echo sprintf(esc_html__('admin.builder.general.form_id.description', 'responsino'), '<code>[responsino_form id="' . (int) $formId . '"]</code>'); ?></p>
			</div>

			<div class="responsino-form-group">
				<label for="responsino-setting-form-name"><?php esc_html_e('admin.builder.general.form_name.label', 'responsino'); ?></label>
				<input type="text" id="responsino-setting-form-name" class="responsino-form-input" value="<?php esc_html_e('admin.builder.general.form_name.default', 'responsino'); ?>" />
				<p class="responsino-settings-text"><?php esc_html_e('admin.builder.general.form_name.description', 'responsino'); ?></p>
			</div>

			<div class="responsino-form-group">
				<label for="responsino-setting-custom-classes"><?php esc_html_e('admin.builder.general.custom_classes.label', 'responsino'); ?></label>
				<input type="text" id="responsino-setting-custom-classes" class="responsino-form-input" value="<?php esc_html_e('admin.builder.general.custom_classes.default', 'responsino'); ?>" placeholder="<?php esc_html_e('admin.builder.general.custom_classes.placeholder', 'responsino'); ?>" />
				<p class="responsino-settings-text"><?php esc_html_e('admin.builder.general.custom_classes.description', 'responsino'); ?></p>
			</div>

			<div class="responsino-switch-group">
	      <span class="responsino-switch-label">
	        <i class="fas fa-shield-alt"></i> <?php esc_html_e('admin.builder.general.honeypot.label', 'responsino'); ?>
	      </span>
				<label class="responsino-switch-wrapper" for="responsino-setting-honeypot">
					<input type="checkbox" id="responsino-setting-honeypot" checked />
					<span class="responsino-switch-slider"></span>
				</label>
			</div>
		</div>

	</div>

</section>
