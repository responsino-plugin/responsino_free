<?php

namespace Responsino;

use Responsino\Database\Form;
use Responsino\Database\FormFeedback;
use Responsino\Helper\ConfigHelper;
use Responsino\Helper\FormFeedbackHelper;
use Responsino\Helper\IndexBuilder;
use Responsino\Page\About;
use Responsino\Page\Dashboard;
use Responsino\Page\Export;
use Responsino\Page\Feedbacks;
use Responsino\Page\FormBuilder;
use Responsino\Page\Forms;

class Admin {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_menu_page']);
        add_action('admin_init', [$this, 'handle_admin_actions']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_assets']);
        add_filter('admin_footer_text', [$this, 'add_admin_footer_text']);
        
        // AJAX Handlers
        add_action('wp_ajax_responsino_render_form_builder_templates', [$this, 'ajax_render_form_builder_templates']);
        add_action('wp_ajax_responsino_get_chart_recent_feedbacks', [$this, 'ajax_get_chart_recent_feedbacks']);
        add_action('wp_ajax_responsino_save_form_data', [$this, 'ajax_save_form_data']);
        add_action('wp_ajax_responsino_update_form_status', [$this, 'ajax_update_form_status']);
		add_action('wp_ajax_responsino_update_form_feedback_status', [$this, 'ajax_update_form_feedback_status']);
		add_action('wp_ajax_responsino_get_form_feedback_by_id', [$this, 'ajax_get_form_feedback_by_id']);
		add_action('wp_ajax_responsino_delete_feedback', [$this, 'ajax_delete_feedback']);
    }

    public function add_menu_page() {
		if (!EnvironmentChecks::check()) {
			return;
		}

		$icon_svg = 'data:image/svg+xml;base64,' . base64_encode(
			'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path fill="#fff" d="M320 544C461.4 544 576 436.5 576 304C576 171.5 461.4 64 320 64C178.6 64 64 171.5 64 304C64 358.3 83.2 408.3 115.6 448.5L66.8 540.8C62 549.8 63.5 560.8 70.4 568.3C77.3 575.8 88.2 578.1 97.5 574.1L215.9 523.4C247.7 536.6 282.9 544 320 544zM192 272C209.7 272 224 286.3 224 304C224 321.7 209.7 336 192 336C174.3 336 160 321.7 160 304C160 286.3 174.3 272 192 272zM320 272C337.7 272 352 286.3 352 304C352 321.7 337.7 336 320 336C302.3 336 288 321.7 288 304C288 286.3 302.3 272 320 272zM416 304C416 286.3 430.3 272 448 272C465.7 272 480 286.3 480 304C480 321.7 465.7 336 448 336C430.3 336 416 321.7 416 304z"/></svg>'
		);

        add_menu_page(
            'Responsino Feedback',
            'Responsino',
            'manage_options',
            'responsino-dashboard',
            function() { (new Dashboard())->render(); },
            $icon_svg,
            30
        );

        add_submenu_page(
            'responsino-dashboard',
           esc_html__('admin.menu.dashboard', 'responsino'),
           esc_html__('admin.menu.dashboard', 'responsino'),
            'manage_options',
            'responsino-dashboard',
            '__return_null'
        );

        add_submenu_page(
            'responsino-dashboard',
           esc_html__('admin.menu.all_forms', 'responsino'),
           esc_html__('admin.menu.all_forms', 'responsino'),
            'manage_options',
            'responsino-forms',
            function() { (new Forms())->render(); }
        );

        add_submenu_page(
            'responsino-dashboard',
           esc_html__('admin.menu.add_form', 'responsino'),
           esc_html__('admin.menu.add_form', 'responsino'),
            'manage_options',
            'responsino-form-builder',
            function() { (new FormBuilder())->render(); }
        );

        add_submenu_page(
            'responsino-dashboard',
           esc_html__('admin.menu.feedback_list', 'responsino'),
           esc_html__('admin.menu.feedback_list', 'responsino'),
            'manage_options',
            'responsino-form-feedbacks',
            function() { (new Feedbacks())->render(); }
        );

        add_submenu_page(
            'responsino-dashboard',
           esc_html__('admin.menu.export', 'responsino'),
           esc_html__('admin.menu.export', 'responsino'),
            'manage_options',
            'responsino-export',
            function() { (new Export())->render(); }
        );

        add_submenu_page(
            'responsino-dashboard',
           esc_html__('admin.menu.about', 'responsino'),
           esc_html__('admin.menu.about', 'responsino'),
            'manage_options',
            'responsino-about',
            function() { (new About())->render(); }
        );
    }

    public function enqueue_assets($hook) {
		if (strpos($hook, 'page-responsino') === false) {
			return;
		}

        if (!EnvironmentChecks::check()) {
            return;
        }

		$languageHelper = new \Responsino\Helper\LanguageHelper();
        $currentLocale = $languageHelper->get_current_locale();

        wp_enqueue_style('responsino-font-awesome', RESPONSINO_PLUGIN_URL . 'assets/css/external/font-awesome.min.css');
        wp_enqueue_style('responsino-admin-style', RESPONSINO_PLUGIN_URL . 'assets/css/dist/responsino-admin.css', [], RESPONSINO_VERSION);

        switch (true) {
            case $hook === 'responsino_page_responsino-form-builder':
                wp_enqueue_style('responsino-form-builder-style', RESPONSINO_PLUGIN_URL . 'assets/css/dist/responsino-form-builder.css', [], RESPONSINO_VERSION);
                wp_enqueue_style('responsino-form-frontend-style', RESPONSINO_PLUGIN_URL . 'assets/css/dist/responsino-form-frontend.css', ['responsino-form-builder-style'], RESPONSINO_VERSION);

                wp_enqueue_script('responsino-sortable-js', RESPONSINO_PLUGIN_URL . 'assets/js/external/sortable.min.js', [], '1.15.7');
                
                $this->enqueue_responsino_admin_script('responsino-form-builder-script', RESPONSINO_PLUGIN_URL . 'assets/js/dist/responsino-form-builder.js', [], RESPONSINO_VERSION);
                $this->enqueue_responsino_admin_script('responsino-form-frontend-script', RESPONSINO_PLUGIN_URL . 'assets/js/dist/responsino-form-frontend.js', ['responsino-form-builder-script'], RESPONSINO_VERSION);
                break;
            case ($hook === 'responsino_page_responsino-form-feedbacks' || $hook === 'responsino_page_responsino-export'):
                wp_enqueue_style('responsino-form-frontend-style', RESPONSINO_PLUGIN_URL . 'assets/css/dist/responsino-form-frontend.css', [], RESPONSINO_DB_VERSION);

                $this->enqueue_responsino_admin_script('responsino-admin-script', RESPONSINO_PLUGIN_URL . 'assets/js/dist/responsino-admin.js', [], RESPONSINO_VERSION);
                $this->enqueue_responsino_admin_script('responsino-form-frontend-script', RESPONSINO_PLUGIN_URL . 'assets/js/dist/responsino-form-frontend.js', [], RESPONSINO_VERSION);

                wp_localize_script('responsino-admin-script', 'responsinoAdmin', [
					'locale' => $currentLocale,
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('responsino_admin_nonce'),
                ]);
                break;
            case ($hook === 'responsino_page_responsino-forms'):
                $this->enqueue_responsino_admin_script('responsino-admin-script', RESPONSINO_PLUGIN_URL . 'assets/js/dist/responsino-admin.js', [], RESPONSINO_VERSION);
                break;
            case ($hook === 'responsino_page_responsino-about'):
                wp_enqueue_script('common');
                wp_enqueue_script('wp-lists');
                wp_enqueue_script('postbox');
                $this->enqueue_responsino_admin_script('responsino-admin-script', RESPONSINO_PLUGIN_URL . 'assets/js/dist/responsino-admin.js', [], RESPONSINO_VERSION);
                break;
            case ($hook === 'toplevel_page_responsino-dashboard'):
                wp_enqueue_script('responsino-chart-js', RESPONSINO_PLUGIN_URL . 'assets/js/external/chart.min.js', [], '4.0.0');

                $this->enqueue_responsino_admin_script('responsino-admin-script', RESPONSINO_PLUGIN_URL . 'assets/js/dist/responsino-admin.js', [], RESPONSINO_VERSION);

                wp_localize_script('responsino-admin-script', 'responsinoAdmin', [
					'locale' => $currentLocale,
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('responsino_admin_nonce'),
                ]);
                break;
        }
    }

    public function handle_admin_actions() {
		if (!EnvironmentChecks::check()) {
			wp_safe_redirect(admin_url('admin.php?page=responsino-forms'));
			exit;
		}

		if (isset($_GET['page']) && $_GET['page'] === 'responsino-forms' && isset($_GET['action']) && isset($_GET['id'])) {
			$nonce = sanitize_text_field(wp_unslash($_GET['nonce'] ?? ''));
			if (empty($nonce) || !wp_verify_nonce($nonce, 'responsino_admin_nonce')) {
				wp_safe_redirect(admin_url('admin.php?page=responsino-forms'));
				exit;
			}

            $form_db = new Form();
            $id = (int) $_GET['id'];

            if ( $_GET['action'] === 'duplicate' ) {
                $new_id = $form_db->duplicate_form( $id );
                if ( $new_id ) {
					wp_safe_redirect( admin_url( 'admin.php?page=responsino-forms&duplicate_success=1&nonce=' . $nonce ) );
                    exit;
                }
            } elseif ( $_GET['action'] === 'delete' ) {
                if ( $form_db->delete_form( $id ) ) {
					wp_safe_redirect( admin_url( 'admin.php?page=responsino-forms&delete_success=1&nonce=' . $nonce ) );
                    exit;
                }
            }
        }

        if ( isset( $_GET['page'] ) && $_GET['page'] === 'responsino-form-builder' && isset( $_GET['id'] ) ) {
			$nonce = sanitize_text_field(wp_unslash($_GET['nonce'] ?? ''));
			if (empty($nonce) || !wp_verify_nonce($nonce, 'responsino_admin_nonce')) {
				wp_safe_redirect(admin_url('admin.php?page=responsino-forms'));
				exit;
			}

            $form_db = new Form();
            $id = (int) $_GET['id'];
            if ( $id && !$form_db->get_form( $id ) ) {
				wp_safe_redirect( admin_url( 'admin.php?page=responsino-forms&form_not_found=1&nonce=' . $nonce ) );
                exit;
            }
        }
    }

    public function ajax_save_form_data() {
        check_ajax_referer('responsino_admin_nonce', 'nonce');

        if (!current_user_can('manage_options')) {
            wp_send_json_error(esc_html__('Permission denied', 'responsino'));
        }

		$form_id = isset($_POST['form_id']) ? absint($_POST['form_id']) : 0;
		// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- JSON is validated and sanitized field-by-field by FormDataSanitizer.
		$raw_data = (isset($_POST['form_data']) && is_string($_POST['form_data'])) ? wp_unslash($_POST['form_data']) : '';
		$type = isset($_POST['type']) && is_string($_POST['type']) ? sanitize_key(wp_unslash($_POST['type'])) : 'preview';

		if (!in_array($type, ['preview', 'live'], true)) {
			wp_send_json_error('Invalid save type.', 400);
		}

		if (empty($raw_data)) {
			wp_send_json_error(esc_html__('Missing data', 'responsino'), 400);
		}

		$decoded_data = json_decode($raw_data, true);
		if (
			JSON_ERROR_NONE !== json_last_error() ||
			!is_array($decoded_data) ||
			empty($decoded_data)
		) {
			wp_send_json_error(esc_html__('Invalid data', 'responsino'), 400);
		}

		$configHelper = new ConfigHelper();
		$valid_form_fields = $configHelper->get_form_fields_data()['valid'];

		$sanitizer = new \Responsino\Helper\FormDataSanitizer(
			$valid_form_fields
		);

		$sanitizedFormDataDecoded = $sanitizer->sanitize($decoded_data);
		if (is_wp_error($sanitizedFormDataDecoded)) {
			wp_send_json_error(
				esc_html__('Invalid form configuration. Please check your form settings.', 'responsino'),
				400
			);
		}

		$sanitizedFormData = wp_json_encode($sanitizedFormDataDecoded);

        $form_name = $sanitizedFormDataDecoded['settings']['main']['title'] ?? esc_html__('admin.db.default_new_form_name', 'responsino');

        $form_db = new Form();
        $result = $form_db->update_form_data($form_id, $sanitizedFormData, $type, $form_name);

        if ($result !== false) {
            // Rebuild targeting index
            $index_builder = new IndexBuilder();
            $index_builder->rebuild();

            $response = ['message' => esc_html__('Form data saved successfully', 'responsino')];
            if ($form_id === 0) {
                $response['new_id'] = $result;
            }
            wp_send_json_success($response);
        } else {
            wp_send_json_error(esc_html__('Failed to save form data', 'responsino'));
        }
    }

    public function ajax_update_form_status() {
        check_ajax_referer('responsino_admin_nonce', 'nonce');

        if (!current_user_can('manage_options')) {
            wp_send_json_error(esc_html__('Permission denied', 'responsino'));
        }

        $form_id = isset($_POST['form_id']) ? (int) $_POST['form_id'] : 0;
        $status  = isset($_POST['status']) ? (int) $_POST['status'] : 0;

        if (!$form_id || !$status) {
            wp_send_json_error(esc_html__('Missing data', 'responsino'));
        }

        $form_db = new Form();
        $success = $form_db->update_form_status($form_id, $status);

        if ($success !== false) {
            // Rebuild targeting index
            $index_builder = new IndexBuilder();
            $index_builder->rebuild();

            wp_send_json_success(['message' => esc_html__('Status updated successfully', 'responsino')]);
        } else {
            wp_send_json_error(esc_html__('Failed to update status', 'responsino'));
        }
    }

    public function ajax_update_form_feedback_status() {
        check_ajax_referer('responsino_admin_nonce', 'nonce');

        if (!current_user_can('manage_options')) {
            wp_send_json_error(esc_html__('Permission denied', 'responsino'));
        }

        $feedback_id = isset($_POST['feedback_id']) ? (int) $_POST['feedback_id'] : 0;
        $status      = isset($_POST['status']) ? sanitize_text_field(wp_unslash($_POST['status'])) : '';

        if (!$feedback_id || !$status) {
            wp_send_json_error(esc_html__('Missing data', 'responsino'));
        }

        $fb_db   = new FormFeedback();
        $success = $fb_db->update_status($feedback_id, $status);

        if ($success !== false) {
            wp_send_json_success(['message' => esc_html__('Feedback status updated successfully', 'responsino')]);
        } else {
            wp_send_json_error(esc_html__('Failed to update feedback status', 'responsino'));
        }
    }

    public function ajax_delete_feedback() {
        check_ajax_referer('responsino_admin_nonce', 'nonce');

        if (!current_user_can('manage_options')) {
            wp_send_json_error(esc_html__('Permission denied', 'responsino'));
        }

        $id = absint(wp_unslash($_POST['id'] ?? 0));
        $feedback_db = new FormFeedback();
        if (!empty($id) && $feedback_db->delete_feedback($id)) {
            wp_send_json_success();
        } else {
            wp_send_json_error();
        }
    }

    public function ajax_render_form_builder_templates() {
        check_ajax_referer('responsino_admin_nonce', 'nonce');

        if (!current_user_can('manage_options')) {
            wp_send_json_error(esc_html__('Permission denied', 'responsino'));
        }

        $templates = [
            'fields',
            'general',
            'display',
            'styles',
            'targeting',
            'confirmation',
            'notification',
            'tracking',
        ];

        $rendered = [];

        foreach ($templates as $tmpl) {
            $php_file  = RESPONSINO_PLUGIN_PATH . 'templates/admin/form-builder/' . $tmpl . '.php';

            ob_start();
            if (!file_exists($php_file)) {
                continue;
            }

            include $php_file;

            $rendered[$tmpl] = ob_get_clean();
        }

        wp_send_json_success([
             'templates' => $rendered,
             'html'      => implode("\n\n", $rendered),
         ]);
    }

    public function ajax_get_chart_recent_feedbacks() {
        check_ajax_referer('responsino_admin_nonce', 'nonce');

        if (!current_user_can('manage_options')) {
            wp_send_json_error(esc_html__('Permission denied', 'responsino'));
        }

        $feedback_db = new FormFeedback();
        $feedbacks = $feedback_db->get_feedbacks(['range' => 'last_30_days', 'limit' => 500]);

        $formatted_feedback = [];
        foreach ($feedbacks as $entity) {
            $data = $entity->toArray();
            // Map created to time for JS chart compatibility
            $data['time'] = $data['created'];
            $formatted_feedback[] = $data;
        }

        wp_send_json_success([
            'feedback' => $formatted_feedback
        ]);
    }

    public function ajax_get_form_feedback_by_id() {
        check_ajax_referer('responsino_admin_nonce', 'nonce');

        if (!current_user_can('manage_options')) {
            wp_send_json_error(esc_html__('Permission denied', 'responsino'));
        }

        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        if (!$id) {
            wp_send_json_error(esc_html__('ID missing', 'responsino'));
        }

        $feedback_db = new FormFeedback();
        $feedback = $feedback_db->get_feedback_by_id($id);
        if (!$feedback) {
            wp_send_json_error(esc_html__('Feedback not found', 'responsino'));
        }

        $user_data = $feedback->getDecodedFeedbackData();

        $helper = new FormFeedbackHelper();
        $prepared_data = $helper->prepare_steps_for_detail_view($user_data);

        $feedbackArray = $feedback->toArray(['feedback_data']);
        $feedbackArray['title'] = $user_data['title'];

		$form_db = new Form();
		$formData = $form_db->get_form($feedback->getFormId());

		$accentColor = '#000';
		if (!empty($formData->getDecodedPreviewData())) {
			$accentColor = $formData->getDecodedPreviewData()['settings']['styles']['accentColor'] ?? '#000';
		}

        wp_send_json_success([
            'feedback' => $feedbackArray,
            'steps' => $prepared_data['steps'],
            'user_values' => $prepared_data['userValues'],
			'accent_color' => $accentColor,
        ]);
    }

    /**
     * Adds a "Thank You" message to the admin footer content.
     *
     * @param string $content Current admin footer content.
     * @return string New admin footer content.
     */
    public function add_admin_footer_text( $content ): string {
        $screen = get_current_screen();

        if ( ! $screen || false === strpos( $screen->base, 'responsino' ) ) {
            return (string) $content;
        }

        if ( ! is_string( $content ) ) {
            $content = '';
        }

		$content .= sprintf(
			esc_html__( 'admin.notice.thank_you', 'responsino' ),
		    '<a href="' . esc_url( 'https://responsino.de/' ) . '" target="_blank" rel="noopener noreferrer">Responsino</a>'
		);

        return $content;
    }

	private function enqueue_responsino_admin_script($handle, $file, $deps = [], $version = RESPONSINO_VERSION) {
		$deps[] = 'wp-i18n';

		wp_enqueue_script($handle, $file, $deps, $version, true);
		wp_set_script_translations($handle, 'responsino', RESPONSINO_PLUGIN_PATH . 'languages/');
	}
}
