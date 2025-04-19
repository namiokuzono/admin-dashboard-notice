<?php

/**
 * The core plugin class.
 */
class Admin_Dashboard_Notice {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Admin_Dashboard_Notice_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * @since    1.0.0
     */
    public function __construct() {
        $this->version = ADMIN_DASHBOARD_NOTICE_VERSION;
        $this->plugin_name = 'admin-dashboard-notice';

        $this->load_dependencies();
        $this->define_admin_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {
        // The class responsible for orchestrating the actions and filters of the core plugin
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-admin-dashboard-notice-loader.php';

        // The class responsible for defining all actions that occur in the admin area
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-admin-dashboard-notice-admin.php';
        
        // The class responsible for the settings page
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-admin-dashboard-notice-settings.php';

        $this->loader = new Admin_Dashboard_Notice_Loader();
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {
        $plugin_admin = new Admin_Dashboard_Notice_Admin($this->get_plugin_name(), $this->get_version());
        $plugin_settings = new Admin_Dashboard_Notice_Settings($this->get_plugin_name(), $this->get_version());

        // Admin notice hook
        $this->loader->add_action('admin_notices', $plugin_admin, 'display_admin_notice');
        
        // Settings page hooks
        $this->loader->add_action('admin_menu', $plugin_settings, 'register_settings_page');
        $this->loader->add_action('admin_init', $plugin_settings, 'register_settings');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks of the plugin.
     *
     * @since     1.0.0
     * @return    Admin_Dashboard_Notice_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }
} 