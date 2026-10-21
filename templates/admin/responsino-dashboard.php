<?php
if (!defined('ABSPATH')) {
	exit;
}

use Responsino\Helper\FormHelper;

$responsinoFormHelper = new FormHelper();
?>

<section id="responsino-view-start" class="responsino-view-section">
    <header class="responsino-view-header">
        <h2 style="font-size: 24px; font-weight: 600; margin: 0 0 5px 0; color: var(--responsino-primary-color);"><?php esc_html_e('admin.page.dashboard.welcome', 'responsino'); ?></h2>
        <p><?php esc_html_e('admin.page.dashboard.overview', 'responsino'); ?></p>
    </header>
    <div class="responsino-stats-grid bento-grid">
        <div class="responsino-stat-card card-span-2">
            <div class="responsino-stat-info" style="width: 100%;">
                <span class="responsino-stat-label"><?php esc_html_e('admin.page.dashboard.summary', 'responsino'); ?></span>
                <div style="display: flex; justify-content: space-between; margin-top: 15px; gap: 15px; flex-wrap: wrap;">
                    <div>
                        <span style="font-size: 11px; color: var(--responsino-text-secondary); text-transform: uppercase; display: block;"><?php esc_html_e('admin.page.dashboard.total', 'responsino'); ?></span>
                        <span class="responsino-stat-value" id="responsino-stat-total" style="font-size: 24px; margin: 0;"><?php echo (int) $stats['total']; ?></span>
                    </div>
                    <div>
                        <span style="font-size: 11px; color: var(--responsino-text-secondary); text-transform: uppercase; display: block;"><?php esc_html_e('admin.page.dashboard.today', 'responsino'); ?></span>
                        <span class="responsino-stat-value" id="responsino-stat-today" style="font-size: 24px; margin: 0;"><?php echo (int) $stats['today']; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="responsino-stat-card card-span-2">
            <div class="responsino-stat-info">
                <span class="responsino-stat-label"><?php esc_html_e('admin.page.dashboard.distribution_by_type', 'responsino'); ?></span>
                <div id="responsino-stat-types" style="display: flex; flex-direction: column; gap: 15px; margin-top: 15px;">
                    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 11px; color: var(--responsino-text-secondary); text-transform: uppercase; min-width: 80px;"><?php esc_html_e('admin.page.dashboard.type.shortcode', 'responsino'); ?></span>
                            <span class="responsino-badge" style="background:#f6f7f7; color:#50575e"><?php echo (int) ($stats['types']['shortcode']['total'] ?? 0); ?></span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 11px; color: var(--responsino-text-secondary); text-transform: uppercase; min-width: 80px;"><?php esc_html_e('admin.page.dashboard.type.pre_content', 'responsino'); ?></span>
                            <span class="responsino-badge" style="background:#f6f7f7; color:#50575e"><?php echo (int) ($stats['types']['pre-content']['total'] ?? 0); ?></span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 11px; color: var(--responsino-text-secondary); text-transform: uppercase; min-width: 80px;"><?php esc_html_e('admin.page.dashboard.type.post_content', 'responsino'); ?></span>
                            <span class="responsino-badge" style="background:#f6f7f7; color:#50575e"><?php echo (int) ($stats['types']['post-content']['total'] ?? 0); ?></span>
                        </div>
	                    <div style="display: flex; align-items: center; gap: 10px;">
		                    <span style="font-size: 11px; color: var(--responsino-text-secondary); text-transform: uppercase; min-width: 80px;"><?php esc_html_e('admin.page.dashboard.type.overlay', 'responsino'); ?></span>
		                    <span class="responsino-badge" style="background:#f6f7f7; color:#50575e"><?php echo (int) ($stats['types']['modal']['total'] ?? 0); ?></span>
	                    </div>
	                    <div style="display: flex; align-items: center; gap: 10px;">
		                    <span style="font-size: 11px; color: var(--responsino-text-secondary); text-transform: uppercase; min-width: 80px;"><?php esc_html_e('admin.page.dashboard.type.slide_in', 'responsino'); ?></span>
		                    <span class="responsino-badge" style="background:#f6f7f7; color:#50575e"><?php echo (int) ($stats['types']['slide-in']['total'] ?? 0); ?></span>
	                    </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 11px; color: var(--responsino-text-secondary); text-transform: uppercase; min-width: 80px;"><?php esc_html_e('admin.page.dashboard.type.feedback_button', 'responsino'); ?></span>
                            <span class="responsino-badge" style="background:#f6f7f7; color:#50575e"><?php echo (int) ($stats['types']['feedback-button']['total'] ?? 0); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="responsino-recent-activity card-span-4 card-span-2">
            <h3><?php esc_html_e('admin.page.dashboard.recent_activities', 'responsino'); ?></h3>
            <ul id="responsino-activity-list" class="responsino-list-simple">
                <?php 
                $responsinoFormFeedbackDb = new \Responsino\Database\FormFeedback();
                $responsinoRecentFeedbacks = $responsinoFormFeedbackDb->get_feedbacks(['limit' => 5]);
                if (empty($responsinoRecentFeedbacks)):
                ?>
                    <li><?php esc_html_e('admin.page.dashboard.no_activities', 'responsino'); ?></li>
                <?php else: ?>
                    <?php foreach ($responsinoRecentFeedbacks as $responsinoFeedbackEntity):
                        $responsinoFeedbackItem = $responsinoFeedbackEntity->toArray();
                        $responsinoFeedbackData = $responsinoFeedbackEntity->getDecodedFeedbackData();
                        ?>
                        <li>
                            <div style="display: flex; flex-direction: column; width: 100%;">
                                <span style="display: block; width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    <strong><?php echo esc_html($responsinoFormHelper->get_form_type_name($responsinoFeedbackItem['form_type'])); ?>:</strong>
                                    <?php echo esc_html($responsinoFeedbackData['title'] ?? '-'); ?>
                                </span>
                                <small style="color: var(--responsino-text-secondary); font-size: 11px;">
									<?php echo esc_html(date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($responsinoFeedbackItem['created']))); ?>
                                    <span style="margin-left: 2px; opacity: 0.8;">| #<?php echo (int) $responsinoFeedbackItem['id']; ?></span>
                                </small>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <div class="responsino-dashboard-chart-container">
        <h3><?php esc_html_e('admin.page.dashboard.feedback_trend', 'responsino'); ?></h3>
        <div style="height: 300px; width: 100%;">
            <canvas id="responsino-feedback-trend-chart"></canvas>
        </div>
    </div>
</section>
