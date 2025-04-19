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
    add_options_page(
        'Admin Dashboard Notice Settings',
        'Admin Dashboard Notice',
        'manage_options',
        'admin-dashboard-notice',
        'adn_settings_page'
    );
}
add_action('admin_menu', 'adn_add_admin_menu');

// Create the settings page
function adn_settings_page() {
    // Save settings if form is submitted
    if (isset($_POST['adn_notice_message']) && check_admin_referer('adn_save_notice')) {
        update_option('adn_notice_message', sanitize_textarea_field($_POST['adn_notice_message']));
        update_option('adn_notice_type', sanitize_text_field($_POST['adn_notice_type']));
        echo '<div class="notice notice-success"><p>Settings saved successfully!</p></div>';
    }

    // Get current notice message
    $notice_message = get_option('adn_notice_message', 'Welcome to your WordPress dashboard!');
    $notice_type = get_option('adn_notice_type', 'info');
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="">
            <?php wp_nonce_field('adn_save_notice'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="adn_notice_message">Notice Message</label>
                    </th>
                    <td>
                        <textarea name="adn_notice_message" id="adn_notice_message" class="large-text" rows="5"><?php echo esc_textarea($notice_message); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="adn_notice_type">Notice Type</label>
                    </th>
                    <td>
                        <select name="adn_notice_type" id="adn_notice_type">
                            <option value="info" <?php selected($notice_type, 'info'); ?>>Info (Blue)</option>
                            <option value="success" <?php selected($notice_type, 'success'); ?>>Success (Green)</option>
                            <option value="warning" <?php selected($notice_type, 'warning'); ?>>Warning (Yellow)</option>
                            <option value="error" <?php selected($notice_type, 'error'); ?>>Error (Red)</option>
                        </select>
                    </td>
                </tr>
            </table>
            <?php submit_button('Save Notice'); ?>
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
