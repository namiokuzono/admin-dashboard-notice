<?php

/**
 * The admin-specific functionality of the plugin.
 */
class Admin_Dashboard_Notice_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Display the admin notice.
     *
     * @since    1.0.0
     */
    public function display_admin_notice() {
        // Get the current screen
        $screen = get_current_screen();
        
        // Only show on dashboard
        if (!$screen || $screen->id !== 'dashboard') {
            return;
        }

        // Get the notice message from options
        $notice_message = get_option('admin_dashboard_notice_message', 'Welcome to your WordPress dashboard!');
        $notice_type = get_option('admin_dashboard_notice_type', 'info');

        // Output the notice
        ?>
        <div class="notice notice-<?php echo esc_attr($notice_type); ?> is-dismissible">
            <p><?php echo esc_html($notice_message); ?></p>
        </div>
        <?php
    }
} 