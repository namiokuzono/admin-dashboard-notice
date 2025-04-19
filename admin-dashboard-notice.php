<?php
/**
 * Plugin Name: Admin Dashboard Notice
 * Plugin URI: https://github.com/a8cnam/admin-dashboard-notice
 * Description: A WordPress plugin to display notices in the admin dashboard.
 * Version: 1.0.0
 * Author: Nami Okuzono
 * Author URI: https://github.com/a8cnam
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: admin-dashboard-notice
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('ADMIN_DASHBOARD_NOTICE_VERSION', '1.0.0');
define('ADMIN_DASHBOARD_NOTICE_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ADMIN_DASHBOARD_NOTICE_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include the debug file for troubleshooting
require_once ADMIN_DASHBOARD_NOTICE_PLUGIN_DIR . 'debug.php';

// Add menu item to the admin bar
function adn_add_admin_menu() {
    add_menu_page(
        'Admin Dashboard Notice Settings',
        'Notice',
        'manage_options',
        'admin-dashboard-notice',
        'adn_settings_page',
        'dashicons-megaphone',
        30
    );
}
add_action('admin_menu', 'adn_add_admin_menu');

// Create the settings page
function adn_settings_page() {
    // Save settings if form is submitted
    if (isset($_POST['adn_save_settings'])) {
        if (isset($_POST['adn_notice_message']) && isset($_POST['adn_notice_type'])) {
            update_option('adn_notice_message', sanitize_text_field($_POST['adn_notice_message']));
            update_option('adn_notice_type', sanitize_text_field($_POST['adn_notice_type']));
            echo '<div class="notice notice-success"><p>Settings saved.</p></div>';
        }
    }

    // Get current settings
    $notice_message = get_option('adn_notice_message', '');
    $notice_type = get_option('adn_notice_type', 'info');

    // Display the settings form
    ?>
    <div class="wrap">
        <h1><span class="dashicons dashicons-megaphone" style="font-size: 30px; width: 30px; height: 30px; margin-right: 10px;"></span> Admin Dashboard Notice Settings</h1>
        <p>Configure the notice that appears on your WordPress admin dashboard.</p>
        
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="adn_notice_message">Notice Message</label></th>
                    <td>
                        <textarea name="adn_notice_message" id="adn_notice_message" rows="3" cols="50" class="large-text"><?php echo esc_textarea($notice_message); ?></textarea>
                        <p class="description">Enter the message you want to display in the notice.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="adn_notice_type">Notice Type</label></th>
                    <td>
                        <select name="adn_notice_type" id="adn_notice_type">
                            <option value="info" <?php selected($notice_type, 'info'); ?>>Info</option>
                            <option value="success" <?php selected($notice_type, 'success'); ?>>Success</option>
                            <option value="warning" <?php selected($notice_type, 'warning'); ?>>Warning</option>
                            <option value="error" <?php selected($notice_type, 'error'); ?>>Error</option>
                        </select>
                        <p class="description">Select the type of notice to display.</p>
                    </td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="adn_save_settings" class="button button-primary" value="Save Settings">
            </p>
        </form>
    </div>
    <?php
}

// Display notice on admin dashboard
function adn_display_admin_notice() {
    $screen = get_current_screen();
    if (!$screen || $screen->id !== 'dashboard') {
        return;
    }

    $notice_message = get_option('adn_notice_message', 'Welcome to your WordPress dashboard!');
    $notice_type = get_option('adn_notice_type', 'info');
    
    if (empty($notice_message)) {
        return;
    }
    ?>
    <div class="notice notice-<?php echo esc_attr($notice_type); ?> is-dismissible">
        <p><?php echo wp_kses_post($notice_message); ?></p>
    </div>
    <?php
}
add_action('admin_notices', 'adn_display_admin_notice');

// Register plugin activation hook
function adn_activate() {
    // Add default options if they don't exist
    add_option('adn_notice_message', 'Welcome to your WordPress dashboard!');
    add_option('adn_notice_type', 'info');
}
register_activation_hook(__FILE__, 'adn_activate');

// Register plugin deactivation hook
function adn_deactivate() {
    // Cleanup if needed
}
register_deactivation_hook(__FILE__, 'adn_deactivate');
