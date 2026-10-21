<?php
if (!defined('ABSPATH')) {
	exit;
}

if (!\Responsino\EnvironmentChecks::check()) {
    include RESPONSINO_PLUGIN_PATH . 'templates/admin/responsino-admin-env-error.php';

    return;
}

?>
<div class="wrap">
    <div id="responsino-feedback-admin" class="responsino-admin-container <?php echo esc_attr($page)?>">
        <h1 class="wp-heading-inline" style="display:none;"></h1>
        <hr class="wp-header-end" style="display:none;">

        <nav class="responsino-admin-nav">
            <div class="responsino-nav-brand">
                <i class="fas fa-comment-dots"></i>
                <span><?php esc_html_e('admin.horizontal_navigation.brand', 'responsino'); ?></span>
            </div>
            <ul class="responsino-nav-tabs">
                <li class="responsino-nav-item <?php echo ($page === 'responsino-dashboard') ? 'active' : ''; ?>">
                    <a href="<?php echo esc_url(admin_url('admin.php?page=responsino-dashboard&nonce=' . $nonce)); ?>">
                        <i class="fas fa-home"></i> <?php esc_html_e('admin.horizontal_navigation.dashboard', 'responsino'); ?>
                    </a>
                </li>
                <li class="responsino-nav-item <?php echo ($page === 'responsino-forms') ? 'active' : ''; ?>">
                    <a href="<?php echo esc_url(admin_url('admin.php?page=responsino-forms&nonce=' . $nonce)); ?>">
                        <i class="fas fa-file-alt"></i> <?php esc_html_e('admin.horizontal_navigation.all_forms', 'responsino'); ?>
                    </a>
                </li>
                <li class="responsino-nav-item <?php echo ($page === 'responsino-form-builder' && empty($id)) ? 'active' : ''; ?>">
                    <a href="<?php echo esc_url(admin_url('admin.php?page=responsino-form-builder&nonce=' . $nonce)); ?>">
                        <i class="fas fa-plus-circle"></i> <?php esc_html_e('admin.horizontal_navigation.add_form', 'responsino'); ?>
                    </a>
                </li>
                <li class="responsino-nav-item <?php echo ($page === 'responsino-form-feedbacks') ? 'active' : ''; ?>">
                    <a href="<?php echo esc_url(admin_url('admin.php?page=responsino-form-feedbacks&nonce=' . $nonce)); ?>">
                        <i class="fas fa-list"></i> <?php esc_html_e('admin.horizontal_navigation.feedback_list', 'responsino'); ?>
                    </a>
                </li>
                <li class="responsino-nav-item <?php echo ($page === 'responsino-export') ? 'active' : ''; ?>">
                    <a href="<?php echo esc_url(admin_url('admin.php?page=responsino-export&nonce=' . $nonce)); ?>">
                        <i class="fas fa-file-export"></i> <?php esc_html_e('admin.horizontal_navigation.export', 'responsino'); ?>
                    </a>
                </li>
                <li class="responsino-nav-item <?php echo ($page === 'responsino-about') ? 'active' : ''; ?>">
                    <a href="<?php echo esc_url(admin_url('admin.php?page=responsino-about&nonce=' . $nonce)); ?>">
                        <i class="fas fa-info-circle"></i> <?php esc_html_e('admin.horizontal_navigation.about', 'responsino'); ?>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="responsino-admin-content" id="responsino-main-content">
            <?php
            if (isset($admin_template) && file_exists($admin_template)) {
                include $admin_template;
            }
            ?>
        </div>
    </div>

</div>

