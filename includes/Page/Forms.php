<?php

namespace Responsino\Page;

use Responsino\Lists\FormListTable;

/**
 * Forms List Page class.
 */
class Forms extends Page {

    /**
     * @return string
     */
    protected function get_template_path(): string {
        return RESPONSINO_PLUGIN_PATH . 'templates/admin/responsino-form-list.php';
    }

    /**
     * Prepares data for the forms page.
     */
    public function render() {

        $form_table = new FormListTable();
        $form_table->prepare_items();

		$data = [
			'isDelete' => false,
			'isDuplicate' => false,
			'formNotFound' => false,
			'form_table' => $form_table,
		];

		if (!empty($_GET['nonce']) && wp_verify_nonce(sanitize_key(wp_unslash($_GET['nonce'])), 'responsino_admin_nonce')) {
			$data['isDelete'] = (bool) absint(wp_unslash($_GET['delete_success'] ?? 0));
			$data['isDuplicate'] = (bool) absint(wp_unslash($_GET['duplicate_success'] ?? 0));
			$data['formNotFound'] = (bool) absint(wp_unslash($_GET['form_not_found'] ?? 0));
		}

        $this->data = $data;

        parent::render();
    }
}
