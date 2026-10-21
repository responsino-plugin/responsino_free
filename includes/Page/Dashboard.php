<?php

namespace Responsino\Page;

use Responsino\Database\FormFeedback;
use Responsino\EnvironmentChecks;

/**
 * Dashboard Page class.
 */
class Dashboard extends Page {

	/**
	 * @return string
	 */
	protected function get_template_path(): string {
		return RESPONSINO_PLUGIN_PATH . 'templates/admin/responsino-dashboard.php';
	}

	/**
	 * Prepares data for the dashboard.
	 */
	public function render() {
		if (EnvironmentChecks::check()) {
			$feedback_db = new FormFeedback();
			$stats = $feedback_db->get_stats();

			$this->data = [
				'stats' => $stats,
			];

			parent::render();
		}
	}
}
