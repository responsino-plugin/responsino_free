<?php
if (!defined('ABSPATH')) {
	exit;
}
?>

<section class="responsino-builder-view responsino-config-screen-layout" id="responsino-view-notification" aria-label="<?php esc_attr_e('admin.builder.notification.title', 'responsino'); ?>">

	<div class="responsino-builder-section-col">
		<!-- Header -->
		<div class="responsino-builder-section-header">
			<h3 class="responsino-builder-section-title"><i class="fas fa-envelope"></i> <?php esc_html_e('admin.builder.notification.title', 'responsino'); ?></h3>
		</div>

		<div class="responsino-builder-section">
			<div style="background-color: #f1f5f9; padding: 12px 16px; border-radius: 6px; font-size: 11.5px; color: var(--responsino-text-secondary); line-height: 1.45; margin-bottom: 20px;">
				<?php esc_html_e('admin.builder.notification.description', 'responsino'); ?>
			</div>

			<!-- Main toggler activation -->
			<div class="responsino-switch-group">
		      <span class="responsino-switch-label" style="font-size: 14px; font-weight: 650; color: var(--responsino-text);">
		        <i class="fas fa-toggle-on" style="color: var(--responsino-success);"></i> <?php esc_html_e('admin.builder.notification.enabled.label', 'responsino'); ?>
		      </span>
				<label class="responsino-switch-wrapper" for="responsino-notification-enabled">
					<input type="checkbox" id="responsino-notification-enabled" checked />
					<span class="responsino-switch-slider"></span>
				</label>
			</div>

			<div id="responsino-notification-settings-fields-group" style="display: flex; flex-direction: column; gap: 20px;">

				<div class="responsino-form-group">
					<label for="responsino-notify-recipient"><?php esc_html_e('admin.builder.notification.recipient.label', 'responsino'); ?> <i class="fas fa-question-circle responsino-help-tip" title="<?php esc_html_e('admin.builder.notification.recipient.hint', 'responsino'); ?>"></i></label>
					<div class="responsino-color-picker-row">
						<input type="text" id="responsino-notify-recipient" class="responsino-form-input" value="<?php esc_html_e('admin.builder.notification.recipient.default', 'responsino'); ?>" />
					</div>
				</div>

				<div class="responsino-form-group">
					<label for="responsino-notify-subject"><?php esc_html_e('admin.builder.notification.subject.label', 'responsino'); ?></label>
					<div class="responsino-color-picker-row">
						<input type="text" id="responsino-notify-subject" class="responsino-form-input" value="<?php esc_html_e('admin.builder.notification.subject.default', 'responsino'); ?>" />
					</div>
				</div>

				<div class="responsino-form-group">
					<label for="responsino-notify-sender-name"><?php esc_html_e('admin.builder.notification.sender_name.label', 'responsino'); ?></label>
					<div class="responsino-color-picker-row">
						<input type="text" id="responsino-notify-sender-name" class="responsino-form-input" value="<?php esc_html_e('admin.builder.notification.sender_name.default', 'responsino'); ?>" />
					</div>
				</div>

				<div class="responsino-form-group">
					<label for="responsino-notify-sender-email"><?php esc_html_e('admin.builder.notification.sender_email.label', 'responsino'); ?></label>
					<div class="responsino-color-picker-row">
						<input type="email" id="responsino-notify-sender-email" class="responsino-form-input" value="info@my-website.com" />
					</div>
				</div>

			</div>
		</div>
	</div>
</section>