<?php
if (!defined('ABSPATH')) {
	exit;
}
?>

<section class="responsino-builder-view responsino-config-screen-layout" id="responsino-view-styles" aria-label="<?php esc_attr_e('admin.builder.styles.title', 'responsino'); ?>">

	<div class="responsino-builder-section-col">
		<!-- Header -->
		<div class="responsino-builder-section-header">
			<h3 class="responsino-builder-section-title"><i class="fas fa-palette"></i> <?php esc_html_e('admin.builder.styles.title', 'responsino'); ?></h3>
		</div>

		<div class="responsino-builder-section">
			<div style="background-color: #f1f5f9; padding: 12px 16px; border-radius: 6px; font-size: 11.5px; color: var(--responsino-text-secondary); line-height: 1.45; margin-bottom: 20px;">
				<?php esc_html_e('admin.builder.styles.description', 'responsino'); ?>
			</div>

			<div class="responsino-form-group">
				<label for="responsino-style-accent-color"><?php esc_html_e('admin.builder.styles.accent_color.label', 'responsino'); ?></label>
				<div class="responsino-color-picker-row">
					<input type="color" id="responsino-style-accent-color" class="responsino-form-input" style="width: 60px; height: 36px; padding: 2px; cursor: pointer;" value="#000000" />
					<input type="text" id="responsino-style-accent-hex" class="responsino-form-input" value="#000000" style="width: 120px;" />
					<span class="responsino-settings-text"><?php esc_html_e('admin.builder.styles.accent_color.description', 'responsino'); ?></span>
				</div>
			</div>
			<div class="responsino-form-group">
				<label for="responsino-style-secondary-color"><?php esc_html_e('admin.builder.styles.secondary_color.label', 'responsino'); ?></label>
				<div class="responsino-color-picker-row">
					<input type="color" id="responsino-style-secondary-color" class="responsino-form-input" style="width: 60px; height: 36px; padding: 2px; cursor: pointer;" value="#555555" />
					<input type="text" id="responsino-style-secondary-hex" class="responsino-form-input" value="#555555" style="width: 120px;" />
					<span class="responsino-settings-text"><?php esc_html_e('admin.builder.styles.secondary_color.description', 'responsino'); ?></span>
				</div>
			</div>
		</div>
	</div>
</section>
