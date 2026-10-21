<?php

namespace Responsino\Page;

/**
 * Export Page class.
 */
class Export extends Page {

    /**
     * @return string
     */
    protected function get_template_path(): string {
		return RESPONSINO_PLUGIN_PATH . 'templates/admin/responsino-export.php';
    }

    /**
     * Prepares data for the export page.
     */
    public function render() {
		$form_db = new \Responsino\Database\Form();
		$forms = $form_db->get_forms(['limit' => 999, 'orderby' => 'responsino_fd_name', 'order' => 'ASC']);

        $this->data = [
            'forms' => $forms,
        ];

        parent::render();
    }
}
