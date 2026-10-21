<?php

namespace Responsino\Page;

/**
 * About Page class.
 */
class About extends Page {

    /**
     * @return string
     */
    protected function get_template_path(): string {
        return RESPONSINO_PLUGIN_PATH . 'templates/admin/responsino-about.php';
    }

    /**
     * Registers meta boxes for the About page.
     */
    public function register_meta_boxes() {
        add_meta_box('responsino-about-plugin', esc_html__('admin.page.about.box.about', 'responsino'), [$this, 'postbox_about_plugin'], 'responsino-about', 'normal');
        add_meta_box('responsino-usage', esc_html__('admin.page.about.box.usage', 'responsino'), [$this, 'postbox_usage'], 'responsino-about', 'normal');
        add_meta_box('responsino-more-information', esc_html__('admin.page.about.box.more_info', 'responsino'), [$this, 'postbox_more_information'], 'responsino-about', 'normal');
        add_meta_box('responsino-help-support', esc_html__('admin.page.about.box.support', 'responsino'), [$this, 'postbox_help_support'], 'responsino-about', 'normal');
        add_meta_box('responsino-affiliate-program', esc_html__('admin.page.about.box.affiliate', 'responsino'), [$this, 'postbox_affiliate_program'], 'responsino-about', 'normal');
        add_meta_box('responsino-about-author', esc_html__('admin.page.about.box.author', 'responsino'), [$this, 'postbox_about_author'], 'responsino-about', 'side');
        add_meta_box('responsino-debug-info', esc_html__('admin.page.about.box.debug', 'responsino'), [$this, 'postbox_debug_information'], 'responsino-about', 'side');
    }

    /**
     * Content of the about plugin meta box.
     */
    public function postbox_about_plugin() {
        ?>
        <p>
            <?php esc_html_e('admin.page.about.about_text', 'responsino'); ?>
        </p>
        <p>
            <?php esc_html_e('admin.page.about.usage_text', 'responsino'); ?>
        </p>
        <?php
    }

    /**
     * Content of the usage meta box.
     */
    public function postbox_usage() {
        ?>
        <p>
            <?php esc_html_e('admin.page.about.usage.step1', 'responsino'); ?>
            <?php esc_html_e('admin.page.about.usage.step2', 'responsino'); ?>
        </p>
        <p>
            <?php esc_html_e('admin.page.about.usage.step3', 'responsino'); ?>
        </p>
        <?php
    }

    /**
     * Content of the more information meta box.
     */
    public function postbox_more_information() {
        ?>
        <p>
	        <?php echo sprintf(
				esc_html__( 'admin.page.about.more_info.link', 'responsino' ),
	            '<a href="' . esc_url( 'https://responsino.de/docs/' ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'admin.page.about.more_info.official_website', 'responsino' ) . '</a>'
			); ?>
        </p>
        <?php
    }

    /**
     * Content of the help and support meta box.
     */
    public function postbox_help_support() {
        ?>
        <p>
			<?php echo sprintf(
				esc_html__( 'admin.page.about.support.link', 'responsino' ),
	            '<a href="' . esc_url( 'https://responsino.de/docs/' ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'admin.page.about.documentation.title', 'responsino' ) . '</a>',
				'<a href="' . esc_url( 'https://responsino.de/support-forum/' ) . '" target="_blank" rel="noopener noreferrer">Support-Forum</a>'
			);?>
        </p>
        <?php
    }

    /**
     * Content of the affiliate program meta box.
     */
    public function postbox_affiliate_program() {
        ?>
        <p>
			<?php echo sprintf(
				esc_html__( 'admin.page.about.affiliate.link', 'responsino' ),
	            '<a href="' . esc_url( 'https://responsino.de/affiliate/' ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__('admin.page.about.affiliate', 'responsino') . '</a>'
			);?>
        </p>
        <p>
            <?php esc_html_e('admin.page.about.affiliate.text', 'responsino'); ?>
        </p>
        <?php
    }

    /**
     * Content of the author meta box.
     */
    public function postbox_about_author() {
        ?>
        <p>
	        <?php echo sprintf(
				esc_html__( 'admin.page.about.author.text', 'responsino' ),
	            '<a href="' . esc_url( 'https://responsino.de/' ) . '" target="_blank" rel="noopener noreferrer">Kai Steudten</a>'
			);?>
        </p>
        <?php
    }

    /**
     * Content of the debug information meta box.
     */
    public function postbox_debug_information() {
        global $wpdb;
        ?>
        <p>
            <strong><?php esc_html_e('admin.page.about.debug.hint', 'responsino'); ?></strong>
        </p>
        <ul>
            <li>Website: <?php echo esc_url(site_url()); ?></li>
            <li>Block Theme: <?php echo wp_is_block_theme() ? 'yes' : 'no'; ?></li>
            <li>Responsino: <?php echo esc_html(RESPONSINO_VERSION); ?></li>
            <li>Responsino (DB): <?php echo esc_html(RESPONSINO_DB_VERSION); ?></li>
            <li>WordPress: <?php echo esc_html(wp_get_wp_version()); ?></li>
            <li>Multisite: <?php echo is_multisite() ? 'yes' : 'no'; ?></li>
            <li>PHP: <?php echo esc_html(PHP_VERSION); ?></li>
            <li>mySQL (Server): <?php echo esc_html($wpdb->db_server_info()); ?></li>
            <li>mbstring: <?php echo extension_loaded( 'mbstring' ) ? 'yes' : '<span style="color:#800000;font-weight:bold;">no</span>'; ?></li>
            <li>ZipArchive: <?php echo class_exists( 'ZipArchive', false ) ? 'yes' : '<span style="color:#800000;font-weight:bold;">no</span>'; ?></li>
            <li>DOMDocument: <?php echo class_exists( 'DOMDocument', false ) ? 'yes' : '<span style="color:#800000;font-weight:bold;">no</span>'; ?></li>
            <li>simplexml_load_string: <?php echo function_exists( 'simplexml_load_string' ) ? 'yes' : '<span style="color:#800000;font-weight:bold;">no</span>'; ?></li>
            <li>libxml_disable_entity_loader: <?php echo function_exists( 'libxml_disable_entity_loader' ) ? 'yes' : '<span style="color:#800000;font-weight:bold;">no</span>'; ?></li>
            <li>UTF-8 conversion: <?php echo ( function_exists( 'mb_detect_encoding' ) && function_exists( 'iconv' ) ) ? 'yes' : '<span style="color:#800000;font-weight:bold;">no</span>'; ?></li>
            <li>WP Memory Limit: <?php echo esc_html(WP_MEMORY_LIMIT); ?></li>
            <li>Server Memory Limit: <?php echo esc_html( @ini_get( 'memory_limit' ) ); ?></li>
            <li>WP_DEBUG: <?php echo WP_DEBUG ? 'true' : 'false'; ?></li>
            <li>WP_POST_REVISIONS: <?php echo is_bool( WP_POST_REVISIONS ) ? ( WP_POST_REVISIONS ? 'true' : 'false' ) : esc_html( WP_POST_REVISIONS ); ?></li>
        </ul>
        <?php
    }

    /**
     * Renders the page.
     */
    public function render() {
        $this->register_meta_boxes();
        parent::render();
    }
}
