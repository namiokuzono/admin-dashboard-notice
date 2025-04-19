<?php
/**
 * Plugin Name: Admin Dashboard Notice
 * Plugin URI: https://github.com/a8cnam/admin-dashboard-notice
 * Description: A WordPress plugin to display notices in the admin dashboard.
 * Version: 1.0.0
 * Author: a8cnam
 * Author URI: https://github.com/a8cnam
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: admin-dashboard-notice
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Define plugin constants
define('ADMIN_DASHBOARD_NOTICE_VERSION', '1.0.0');
define('ADMIN_DASHBOARD_NOTICE_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ADMIN_DASHBOARD_NOTICE_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include the debug file for troubleshooting
require_once ADMIN_DASHBOARD_NOTICE_PLUGIN_DIR . 'debug.php';

// Include the main plugin class
require_once ADMIN_DASHBOARD_NOTICE_PLUGIN_DIR . 'includes/class-admin-dashboard-notice.php';

// Initialize the plugin
function run_admin_dashboard_notice() {
    $plugin = new Admin_Dashboard_Notice();
    $plugin->run();
}
run_admin_dashboard_notice();
