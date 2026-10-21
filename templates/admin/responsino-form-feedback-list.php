<?php
if (!defined('ABSPATH')) {
	exit;
}
?>

<section id="responsino-view-start" class="responsino-view-section responsino-form-feedback-list">
	<header class="responsino-view-header flex-row">
		<h2 style="font-size: 24px; font-weight: 600; margin: 0 0 25px 0; color: var(--responsino-primary-color);"><?php esc_html_e('admin.page.feedback_list.title', 'responsino'); ?></h2>
	</header>

	<form method="get">
		<input type="hidden" name="page" value="responsino-form-feedbacks" />
		<?php wp_nonce_field('responsino_admin_nonce', 'nonce'); ?>
		<?php $feedback_table->display(); ?>
	</form>

	<div id="responsino-modal-backdrop" class="responsino-modal-backdrop hidden"></div>
	<div id="responsino-modal-container" class="responsino-modal-container hidden"></div>

	<template id="responsino-feedback-details-modal">
		<div class="responsino-modal responsino-feedback-dialog-container">
			<header class="responsino-modal-header responsino-feedback-dialog-header">
				<div style="display: flex; align-items: center; gap: 12px;">
					<div class="responsino-feedback-avatar" id="responsino-modal-avatar-wrapper">
						<i class="fas fa-comment-dots"></i>
					</div>
					<div>
						<h2 id="responsino-modal-feedback-id-title" style="margin: 0; font-size: 1.15rem; font-weight: 600;"><?php esc_html_e('admin.page.feedback_list.modal.id_title', 'responsino'); ?></h2>
						<p style="margin: 2px 0 0 0; font-size: 0.75rem; color: var(--responsino-text-secondary);"><?php esc_html_e('admin.page.feedback_list.modal.created_at', 'responsino'); ?> <span id="responsino-modal-date-text" style="font-weight: 500;">{{date}}</span></p>
					</div>
				</div>
				<button class="responsino-modal-modal-close" id="responsino-modal-btn-close-modal" aria-label="<?php echo esc_attr__('admin.page.feedback_list.modal.close', 'responsino') ?>"><i class="fas fa-times"></i></button>
			</header>

			<div class="responsino-modal-scrollable-body" style="background-color: #f6f8fb;">
				<div class="responsino-details-grid-layout">

					<!-- LINKER BEREICH: FORMULAR (USERWERTE) -->
					<div style="display: flex; flex-direction: column; gap: 20px;">
						<!-- BEARBEITUNGS-STATUS -->
						<div class="responsino-details-card">
							<div class="responsino-card-title-bar">
								<i class="fas fa-tasks" style="color: var(--app-primary-color);"></i>
								<h3><?php esc_html_e('admin.page.feedback_list.modal.status.title', 'responsino'); ?></h3>
							</div>
							<div class="responsino-status-segmented-control" id="responsino-modal-status-control">
								<button type="button" class="responsino-status-btn" data-status="unread">
									<i class="far fa-envelope"></i> <?php esc_html_e('admin.page.feedback_list.modal.status.unread', 'responsino'); ?>
								</button>
								<button type="button" class="responsino-status-btn" data-status="read">
									<i class="far fa-envelope-open"></i> <?php esc_html_e('admin.page.feedback_list.modal.status.read', 'responsino'); ?>
								</button>
								<button type="button" class="responsino-status-btn" data-status="archived">
									<i class="fas fa-archive"></i> <?php esc_html_e('admin.page.feedback_list.modal.status.archived', 'responsino'); ?>
								</button>
							</div>
						</div>

						<!-- KUNDEN-FORMULARWERTE -->
						<div class="responsino-details-card responsino-details-form-card">
							<div class="responsino-card-title-bar">
								<i class="fas fa-file-invoice" style="color: var(--app-primary-color);"></i>
								<h3><?php esc_html_e('admin.page.feedback_list.modal.customer_form_values', 'responsino'); ?></h3>
							</div>

							<div class="responsino-form-body">
								<div id="responsino-admin-feedback-form-render" class="responsino-feedback-plugin responsino-form-frontend-wrapper" data-is-admin="1"></div>

								<!-- URL der Einsendung -->
								<div class="responsino-form-group-item">
									<label class="responsino-form-field-label"><?php esc_html_e('admin.page.feedback_list.modal.source_url', 'responsino'); ?></label>
									<div style="margin-bottom: 8px; font-size: 0.85rem; color: var(--responsino-primary-color); font-weight: 600;" id="responsino-modal-page-path"></div>
									<div class="responsino-copyable-input-group">
										<input type="text" id="responsino-input-source-url" class="responsino-form-text-control" readonly style="font-family: monospace; font-size: 0.8rem;">
										<button id="responsino-btn-copy-url" class="responsino-form-copy-btn" type="button" title="<?php echo esc_attr__('admin.page.feedback_list.modal.copy_to_clipboard', 'responsino') ?>">
											<i class="far fa-copy"></i>
										</button>
										<button id="responsino-btn-open-url" class="responsino-form-open-btn" type="button" title="<?php echo esc_attr__('admin.page.feedback_list.modal.open_in_new_window', 'responsino') ?>">
											<i class="fas fa-external-link-alt"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- RECHTER BEREICH: TRACKING INFORMATIONEN -->
					<div class="responsino-details-card responsino-details-tracking-card">
						<div class="responsino-card-title-bar">
							<i class="fas fa-satellite-dish" style="color: var(--responsino-primary-color); animation: pulse 2s infinite;"></i>
							<h3><?php esc_html_e('admin.page.feedback_list.modal.tracking.title', 'responsino'); ?></h3>
						</div>

						<div class="responsino-tracking-grid">

							<!-- UserAgent -->
							<div class="responsino-tracking-metric-box full-width">
								<div class="responsino-metric-icon-sphere"><i class="fas fa-info-circle"></i></div>
								<div class="responsino-metric-info-block">
									<span class="responsino-metric-label" title="<?php echo esc_attr__('admin.page.feedback_list.modal.tracking.user_agent', 'responsino') ?>"><?php esc_html_e('admin.page.feedback_list.modal.tracking.user_agent', 'responsino') ?></span>
									<div class="responsino-track-ua-text" id="responsino-track-useragent" style="font-size: 0.75rem; color: var(--responsino-text-secondary); word-break: break-all; line-height: 1.3;">-</div>
								</div>
							</div>
						</div>

						<!-- Collapse Section JSON -->
						<div class="responsino-raw-data-section" style="margin-top: 20px; border-top: 1px dashed #e2e8f0; padding-top: 15px;">
							<button class="responsino-raw-toggle-btn" id="responsino-btn-raw-toggle" type="button" style="background: none; border: none; font-size: 0.8rem; color: var(--responsino-primary-color); cursor: pointer; display: flex; align-items: center; justify-content: space-between; width: 100%; padding: 4px 6px; border-radius: 4px; transition: background 0.2s;">
								<span style="font-weight: 600;" title="<?php echo esc_attr__('admin.page.feedback_list.modal.json_data', 'responsino') ?>"><i class="fas fa-code" style="margin-right: 6px;"></i> <?php esc_html_e('admin.page.feedback_list.modal.json_data', 'responsino') ?></span>
								<i class="fas fa-chevron-down" id="responsino-raw-chevron"></i>
							</button>
							<pre class="responsino-raw-json-pre hidden" id="responsino-raw-json-block" style="background: #1e293b; color: #38bdf8; font-family: monospace; font-size: 0.75rem; padding: 12px; border-radius: 6px; margin-top: 10px; max-height: 150px; overflow-y: auto; text-align: left;"></pre>
						</div>
					</div>

				</div>
			</div>

			<footer class="responsino-modal-modal-footer" style="padding: 1rem 1.5rem; display: flex; justify-content: flex-end; background-color: #f8f9fa; border-top: 1px solid var(--responsino-border-color);">
				<button class="responsino-modal-btn-secondary" id="responsino-modal-btn-modal-done" style="font-weight: 500; font-size: 0.85rem; padding: 8px 16px; border-radius: var(--responsino-radius);"><?php esc_html_e('admin.page.feedback_list.modal.close_button', 'responsino'); ?></button>
			</footer>
		</div>
	</template>

</section>