<?php
/**
 * Debug file for Admin Dashboard Notice plugin
 * 
 * This file helps troubleshoot issues with the plugin.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Add a simple notice to test if admin_notices hook is working
function adn_debug_notice() {
    ?>
    <div class="notice notice-info is-dismissible">
        <p>This is a test notice from the debug file. If you can see this, the admin_notices hook is working.</p>
    </div>
    <?php
}
add_action('admin_notices', 'adn_debug_notice');

// Add a simple menu item to test if admin_menu hook is working
function adn_debug_menu() {
    add_menu_page(
        'Debug Page',
        'Debug',
        'manage_options',
        'adn-debug',
        'adn_debug_page',
        'dashicons-info',
        100
    );
}
add_action('admin_menu', 'adn_debug_menu');

// Create the debug page
function adn_debug_page() {
    ?>
    <div class="wrap">
        <h1>Admin Dashboard Notice Debug</h1>
        <p>This is a debug page to help troubleshoot the Admin Dashboard Notice plugin.</p>
        
        <h2>Plugin Information</h2>
        <ul>
            <li>Plugin Directory: <?php echo esc_html(plugin_dir_path(dirname(__FILE__))); ?></li>
            <li>Plugin URL: <?php echo esc_html(plugin_dir_url(dirname(__FILE__))); ?></li>
        </ul>
        
        <h2>Options</h2>
        <ul>
            <li>Notice Message: <?php echo esc_html(get_option('adn_notice_message', 'Not set')); ?></li>
            <li>Notice Type: <?php echo esc_html(get_option('adn_notice_type', 'Not set')); ?></li>
        </ul>
        
        <h2>Hooks</h2>
        <p>Checking if hooks are registered:</p>
        <ul>
            <li>admin_notices: <?php echo has_action('admin_notices') ? 'Yes' : 'No'; ?></li>
            <li>admin_menu: <?php echo has_action('admin_menu') ? 'Yes' : 'No'; ?></li>
            <li>admin_init: <?php echo has_action('admin_init') ? 'Yes' : 'No'; ?></li>
        </ul>
        
        <h2>Current Screen</h2>
        <?php
        $screen = get_current_screen();
        if ($screen) {
            echo '<p>Current screen ID: ' . esc_html($screen->id) . '</p>';
            echo '<p>Current screen base: ' . esc_html($screen->base) . '</p>';
        } else {
            echo '<p>Screen object not available</p>';
        }
        ?>
    </div>
    <?php
} 