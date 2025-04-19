<?php

/**
 * The settings page functionality of the plugin.
 */
class Admin_Dashboard_Notice_Settings {

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
     * Register the settings page.
     *
     * @since    1.0.0
     */
    public function register_settings_page() {
        add_options_page(
            'Admin Dashboard Notice Settings',
            'Admin Dashboard Notice',
            'manage_options',
            'admin-dashboard-notice',
            array($this, 'render_settings_page')
        );
    }

    /**
     * Register the settings.
     *
     * @since    1.0.0
     */
    public function register_settings() {
        register_setting('admin_dashboard_notice_options', 'admin_dashboard_notice_message');
        register_setting('admin_dashboard_notice_options', 'admin_dashboard_notice_type');
    }

    /**
     * Render the settings page.
     *
     * @since    1.0.0
     */
    public function render_settings_page() {
        // Get the current values
        $notice_message = get_option('admin_dashboard_notice_message', 'Welcome to your WordPress dashboard!');
        $notice_type = get_option('admin_dashboard_notice_type', 'info');
        
        // Output the settings page
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('admin_dashboard_notice_options');
                do_settings_sections('admin_dashboard_notice_options');
                ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Notice Message</th>
                        <td>
                            <textarea name="admin_dashboard_notice_message" rows="5" cols="50" class="large-text"><?php echo esc_textarea($notice_message); ?></textarea>
                            <p class="description">Enter the message you want to display in the admin dashboard notice.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Notice Type</th>
                        <td>
                            <select name="admin_dashboard_notice_type">
                                <option value="info" <?php selected($notice_type, 'info'); ?>>Info (Blue)</option>
                                <option value="success" <?php selected($notice_type, 'success'); ?>>Success (Green)</option>
                                <option value="warning" <?php selected($notice_type, 'warning'); ?>>Warning (Yellow)</option>
                                <option value="error" <?php selected($notice_type, 'error'); ?>>Error (Red)</option>
                            </select>
                            <p class="description">Select the type of notice to display.</p>
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }
} 