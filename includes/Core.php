<?php

namespace Responsino;

use Responsino\Database\Database as DB;

class Core {
    public function run() {
		if (!EnvironmentChecks::check()) {
			return;
		}

        if (is_admin()) {
            new Admin();
        }

        // DB-Update Check
        DB::update_check();

        // Always initialize FormFrontend as it handles both Frontend rendering and AJAX
        new FormFrontend();
    }

	public static function plugin_activation() {
		\Responsino\Database\Database::update_check();
	}
}
