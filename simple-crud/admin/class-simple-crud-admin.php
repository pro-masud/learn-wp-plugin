<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://dev-masud-rana.netlify.app/
 * @since      1.0.0
 *
 * @package    Simple_Crud
 * @subpackage Simple_Crud/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Simple_Crud
 * @subpackage Simple_Crud/admin
 * @author     Masud Rana <promasudbd@gmail.com>
 */
class Simple_Crud_Admin {

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
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action('admin_menu', [$this, 'simple_crud_admin_display_add']);

	}

	public function simple_crud_admin_display_add() {
        $capabality = 'manage_options';
        $slug       = 'simple-crud-list';

        // Add a Menu
        add_menu_page(
            __( 'Simple CRUD', 'simple-crud' ),     // Page title
            __( 'Simple CRUD', 'simple-crud' ),     // Menu title
            $capabality,                            // Capability
            $slug,                                  // Menu slug
            [$this, 'simple_crud_admin_page_list'],      // Callback function
            'dashicons-admin-generic',              // Icon URL or Dashicons class
            100                                     // Position in the menu
        );

        // Add a submenu
        add_submenu_page(
            $slug,                                  // Parent slug
            __( 'Student List', 'simple-crud' ),    // Page title
            __( 'Student List', 'simple-crud' ),    // Menu title
            $capabality,                            // Capability
            'simple-crud-add',                      // Submenu slug
            [$this, 'simple_crud_submenu_page_add'] // Callback function
        );
    }

    public function simple_crud_admin_page_list() {
        echo '<h1>Simple CRUD Admin Page</h1>';
        echo '<p>Welcome to the Simple CRUD plugin.</p>';
    }

    public function simple_crud_submenu_page_add() {
        echo '<h1>Simple CRUD Submenu Page</h1>';
        echo '<p>This is the submenu under the Simple CRUD plugin.</p>';

		include_once SIMPLE_CRUD_PATH . '/admin/views/simple-crud-student-add.php';
    }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Crud_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Crud_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simple-crud-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Crud_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Crud_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-crud-admin.js', array( 'jquery' ), $this->version, false );

	}
}