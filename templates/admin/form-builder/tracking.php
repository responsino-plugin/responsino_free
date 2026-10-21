<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="responsino-builder-view responsino-config-screen-layout" id="responsino-view-tracking"
         aria-label="<?php esc_attr_e('admin.builder.tracking.title', 'responsino'); ?>">

	<div class="responsino-builder-section-col">
		<!-- Header -->
		<div class="responsino-builder-section-header">
			<h3 class="responsino-builder-section-title"><i class="fas fa-chart-line"></i> <?php esc_html_e('admin.builder.tracking.title', 'responsino'); ?>
			</h3>
		</div>

		<div class="responsino-builder-section">
			<div style="background-color: #f1f5f9; padding: 12px 16px; border-radius: 6px; font-size: 11.5px; color: var(--responsino-text-secondary); line-height: 1.45; margin-bottom: 20px;">
				<?php esc_html_e('admin.builder.tracking.description', 'responsino'); ?>
			</div>

			<!-- Main toggler activation -->
			<div class="responsino-switch-group">
				<span class="responsino-switch-label" style="font-size: 14px; font-weight: 650; color: var(--responsino-text);">
				<i class="fas fa-toggle-on" style="color: var(--responsino-success);"></i> <?php esc_html_e('admin.builder.tracking.enabled.label', 'responsino'); ?>
				</span>
				<label class="responsino-switch-wrapper" for="responsino-setting-tracking-enabled">
					<input type="checkbox" id="responsino-setting-tracking-enabled" checked/>
					<span class="responsino-switch-slider"></span>
				</label>
			</div>

			<div id="responsino-tracking-settings-fields-group" style="display: flex; flex-direction: column; gap: 14px; margin-top: 10px;">

				<span style="font-size: 11px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;"><?php esc_html_e('admin.builder.tracking.data_points.title', 'responsino'); ?></span>

				<!-- URL -->
				<div class="responsino-switch-group" style="margin-bottom: 0;">
					<span class="responsino-switch-label">
					<i class="fas fa-link" style="width: 16px; color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.tracking.url.label', 'responsino'); ?>
					</span>
					<label class="responsino-switch-wrapper" for="responsino-setting-tracking-url">
						<input type="checkbox" id="responsino-setting-tracking-url" checked/>
						<span class="responsino-switch-slider"></span>
					</label>
				</div>

				<!-- Page Title -->
				<div class="responsino-switch-group" style="margin-bottom: 0;">
					<span class="responsino-switch-label">
					<i class="fas fa-heading" style="width: 16px; color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.tracking.page_title.label', 'responsino'); ?>
					</span>
					<label class="responsino-switch-wrapper" for="responsino-setting-tracking-pageTitle">
						<input type="checkbox" id="responsino-setting-tracking-pageTitle" checked/>
						<span class="responsino-switch-slider"></span>
					</label>
				</div>

				<!-- Referrer -->
				<div class="responsino-switch-group" style="margin-bottom: 0;">
					<span class="responsino-switch-label">
					<i class="fas fa-sign-in-alt" style="width: 16px; color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.tracking.referrer.label', 'responsino'); ?>
					</span>
					<label class="responsino-switch-wrapper" for="responsino-setting-tracking-referrer">
						<input type="checkbox" id="responsino-setting-tracking-referrer" checked/>
						<span class="responsino-switch-slider"></span>
					</label>
				</div>

				<!-- User Agent -->
				<div class="responsino-switch-group" style="margin-bottom: 0;">
					<span class="responsino-switch-label">
					<i class="fas fa-laptop" style="width: 16px; color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.tracking.user_agent.label', 'responsino'); ?>
					</span>
					<label class="responsino-switch-wrapper" for="responsino-setting-tracking-userAgent">
						<input type="checkbox" id="responsino-setting-tracking-userAgent" checked/>
						<span class="responsino-switch-slider"></span>
					</label>
				</div>

				<!-- Language -->
				<div class="responsino-switch-group responsino-pro-feature-hint" style="margin-bottom: 0;">
					<span class="responsino-switch-label">
					<i class="fas fa-language" style="width: 16px; color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.tracking.language.label', 'responsino'); ?>
					</span>
					<label class="responsino-switch-wrapper" for="responsino-setting-tracking-language">
						<span class="responsino-switch-slider"></span>
					</label>
				</div>

				<!-- Screen Resolution -->
				<div class="responsino-switch-group responsino-pro-feature-hint" style="margin-bottom: 0;">
					<span class="responsino-switch-label">
					<i class="fas fa-desktop" style="width: 16px; color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.tracking.screen_resolution.label', 'responsino'); ?>
					</span>
					<label class="responsino-switch-wrapper" for="responsino-setting-tracking-screenResolution">
						<span class="responsino-switch-slider"></span>
					</label>
				</div>

				<!-- Viewport Size -->
				<div class="responsino-switch-group responsino-pro-feature-hint" style="margin-bottom: 0;">
					<span class="responsino-switch-label">
					<i class="fas fa-window-maximize" style="width: 16px; color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.tracking.viewport_size.label', 'responsino'); ?>
					</span>
					<label class="responsino-switch-wrapper" for="responsino-setting-tracking-viewportSize">
						<span class="responsino-switch-slider"></span>
					</label>
				</div>

				<!-- Timezone -->
				<div class="responsino-switch-group responsino-pro-feature-hint" style="margin-bottom: 0;">
					<span class="responsino-switch-label">
					<i class="fas fa-globe" style="width: 16px; color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.tracking.timezone.label', 'responsino'); ?>
					</span>
					<label class="responsino-switch-wrapper" for="responsino-setting-tracking-timezone">
						<span class="responsino-switch-slider"></span>
					</label>
				</div>

				<!-- Connection Type -->
				<div class="responsino-switch-group responsino-pro-feature-hint" style="margin-bottom: 0;">
				<span class="responsino-switch-label">
				<i class="fas fa-wifi" style="width: 16px; color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.tracking.connection_type.label', 'responsino'); ?>
				</span>
					<label class="responsino-switch-wrapper" for="responsino-setting-tracking-connectionType">
						<span class="responsino-switch-slider"></span>
					</label>
				</div>

				<!-- Device Type -->
				<div class="responsino-switch-group responsino-pro-feature-hint" style="margin-bottom: 0;">
				<span class="responsino-switch-label">
				<i class="fas fa-mobile-alt" style="width: 16px; color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.tracking.device_type.label', 'responsino'); ?>
				</span>
					<label class="responsino-switch-wrapper" for="responsino-setting-tracking-deviceType">
						<span class="responsino-switch-slider"></span>
					</label>
				</div>

				<!-- Session ID -->
				<div class="responsino-switch-group responsino-pro-feature-hint" style="margin-bottom: 0;">
				<span class="responsino-switch-label">
				<i class="fas fa-id-badge" style="width: 16px; color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.tracking.session_id.label', 'responsino'); ?>
				</span>
					<label class="responsino-switch-wrapper" for="responsino-setting-tracking-anonymizedSessionId">
						<span class="responsino-switch-slider"></span>
					</label>
				</div>

				<!-- Time on Page -->
				<div class="responsino-switch-group responsino-pro-feature-hint" style="margin-bottom: 0;">
				<span class="responsino-switch-label">
				<i class="fas fa-hourglass-half" style="width: 16px; color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.tracking.time_on_page.label', 'responsino'); ?>
				</span>
					<label class="responsino-switch-wrapper" for="responsino-setting-tracking-timeOnPageSeconds">
						<span class="responsino-switch-slider"></span>
					</label>
				</div>

				<!-- Color Scheme -->
				<div class="responsino-switch-group responsino-pro-feature-hint" style="margin-bottom: 0;">
				<span class="responsino-switch-label">
				<i class="fas fa-adjust" style="width: 16px; color: var(--responsino-primary);"></i> <?php esc_html_e('admin.builder.tracking.color_scheme.label', 'responsino'); ?>
				</span>
					<label class="responsino-switch-wrapper" for="responsino-setting-tracking-colorScheme">
						<span class="responsino-switch-slider"></span>
					</label>
				</div>

			</div>
		</div>
	</div>
</section>