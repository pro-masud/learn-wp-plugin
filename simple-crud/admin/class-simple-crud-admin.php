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

    /**
     * Insert or update student data into the database.
     */
    public function simple_crud_data_insert() {
        global $wpdb;

        $meg = "";
        $id  = isset($_GET['id']) ? intval($_GET['id']) : '';

        if (isset($_POST['insert-student-btn'])) {
            // Check nonce for security
            if (!isset($_POST['simple_crud_nonce']) || !wp_verify_nonce($_POST['simple_crud_nonce'], 'simple_crud_action')) {
                die('Security check failed.');
            }

            $student_name = sanitize_text_field($_POST['student_name']);
            $student_id   = sanitize_text_field($_POST['student_id']);
            $student_email = sanitize_email($_POST['student_email']);
            $student_msg  = sanitize_textarea_field($_POST['student_msg']);

            if ($id) {
                // Update record
                $updated = $wpdb->update(
                    "simple_crud",
                    [
                        'student_name'    => $student_name,
                        'student_id'      => $student_id,
                        'student_email'   => $student_email,
                        'student_message' => $student_msg,
                    ],
                    ['id' => $id]
                );

                $meg = $updated ? "Data updated successfully." : "Failed to update data.";
            } else {
                // Insert new record
                $inserted = $wpdb->insert(
                    "simple_crud", 
                    [
                        'student_name'    => $student_name,
                        'student_id'      => $student_id,
                        'student_email'   => $student_email,
                        'student_message' => $student_msg,
                    ]
                );

                $meg = $inserted ? "Data saved successfully." : "Failed to save data.";
            }
        }

        if (!empty($meg)) {
            echo '<div class="notice notice-success is-dismissible"><p>' . esc_html($meg) . '</p></div>';
        }
    }

    /**
     * Register admin menu and submenus.
     */
    public function simple_crud_admin_display_add() {
        $capability = 'manage_options';
        $slug       = 'simple-crud-list';

        // Add main menu
        add_menu_page(
            __( 'Simple CRUD', 'simple-crud' ),     // Page title
            __( 'Simple CRUD', 'simple-crud' ),     // Menu title
            $capability,                            // Capability
            $slug,                                  // Menu slug
            [$this, 'simple_crud_admin_page_list'], // Callback function
            'dashicons-admin-generic',              // Icon
            100                                     // Position
        );

        // Add submenu for listing
        add_submenu_page(
            $slug,
            __( 'Student List', 'simple-crud' ),
            __( 'Student List', 'simple-crud' ),
            $capability,
            $slug,
            [$this, 'simple_crud_admin_page_list']
        );

        // Add submenu for adding
        add_submenu_page(
            $slug,
            __( 'Student Add', 'simple-crud' ),
            __( 'Student Add', 'simple-crud' ),
            $capability,
            'simple-crud-add',
            [$this, 'simple_crud_submenu_page_add']
        );
    }

    /**
     * Display list of students.
     */
    public function simple_crud_admin_page_list() {
        echo '<h1>Simple CRUD Admin Page</h1>';
        echo '<p>Welcome to the Simple CRUD plugin.</p>';

        include_once SIMPLE_CRUD_PATH . '/admin/views/simple-crud-student-view.php';
    }

    /**
     * Display add/edit form for students.
     */
    public function simple_crud_submenu_page_add() {
        global $wpdb;

        $id = isset($_GET['id']) ? intval($_GET['id']) : '';
        $row = [];

        if ($id) {
            $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM simple_crud WHERE id = %d", $id), ARRAY_A);
        }

        include_once SIMPLE_CRUD_PATH . '/admin/views/simple-crud-student-add.php';

        // Handle form submission
        $this->simple_crud_data_insert();
    }

    /**
     * Enqueue admin styles.
     */
    public function enqueue_styles() {
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simple-crud-admin.css', array(), $this->version, 'all' );
    }

    /**
     * Enqueue admin scripts.
     */
    public function enqueue_scripts() {
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-crud-admin.js', array( 'jquery' ), $this->version, false );
    }
}