<?php
if (!defined('ABSPATH')) {
	exit;
}

$responsinoProNoticeModalPath = RESPONSINO_PLUGIN_PATH . 'templates/admin/partial/responsino-pro-notice-modal.php';
if (isset($responsinoProNoticeModalPath) && file_exists($responsinoProNoticeModalPath)) {
	$responsinoProNoticeHeadline = esc_html__('admin.page.export.pro_notice.headline', 'responsino');

	$responsinoProNoticeIntro = wp_kses(__('admin.page.export.pro_notice.intro', 'responsino'), ['strong' => []]);
	$responsinoProNoticeAdvantages = [
		esc_html__('admin.page.export.pro_notice.advantage.1', 'responsino'),
		esc_html__('admin.page.export.pro_notice.advantage.2', 'responsino'),
		esc_html__('admin.page.export.pro_notice.advantage.3', 'responsino'),
		esc_html__('admin.page.export.pro_notice.advantage.4', 'responsino')
	];

	include $responsinoProNoticeModalPath;
}
?>

<?php include RESPONSINO_PLUGIN_PATH . 'templates/admin/partial/mockup/export.php'; ?>