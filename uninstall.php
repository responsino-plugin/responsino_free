<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package Responsino
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
	exit;
}

require_once plugin_dir_path(__FILE__) . 'responsino.php';

if (class_exists('\Responsino\Database\Database')) {
	\Responsino\Database\Database::uninstall_cleanup();
}