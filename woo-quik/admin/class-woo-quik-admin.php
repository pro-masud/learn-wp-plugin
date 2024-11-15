<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://dev-masud-rana.netlify.app/
 * @since      1.0.0
 *
 * @package    Woo_Quik
 * @subpackage Woo_Quik/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks to enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woo_Quik
 * @subpackage Woo_Quik/admin
 * @author     Masud Rana <promasudbd@gmail.com>
 */
class Woo_Quik_Admin {

    private $options;

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
     * @param    string    $plugin_name    The name of this plugin.
     * @param    string    $version        The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;

        add_action( 'admin_menu', [ $this, 'woo_quik_view_admin_bar' ] );
        add_action( 'admin_init', [ $this, 'woo_quik_view_admin_callback_view' ] );
    }

    /**
     * Add admin menu page.
     */
    public function woo_quik_view_admin_bar() {
        add_menu_page(
            __( 'Woo Quik View', 'woo-quik' ),
            __( 'Woo Quik View', 'woo-quik' ),
            'manage_options',
            'woo-quik-view',
            [ $this, 'woo_quik_view_admin_callback_frontend_view' ],
            'dashicons-tagcloud',
            100
        );
    }

    /**
     * Render the admin page content.
     */
    public function woo_quik_view_admin_callback_frontend_view() {
        $this->options = get_option( 'woo_quik_view_option' );
        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <form action="options.php" method="post">
                <?php 
                    settings_fields( 'woo_quik_view_group' );
                    do_settings_sections( 'woo-quik-view' );
                    submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register settings and fields.
     */
    public function woo_quik_view_admin_callback_view() {
        register_setting(
            'woo_quik_view_group',
            'woo_quik_view_option',
            [ 'sanitize_callback' => [ $this, 'sanitize_options' ] ]
        );

        add_settings_section(
            'woo_quik_view_admin_page_section',
            __( 'Woo Quik View Settings', 'woo-quik' ),
            [ $this, 'woo_quik_view_section_page' ],
            'woo-quik-view'
        );

        add_settings_field(
            'woo_quik_view_bottom',
            __( 'Bottom Position', 'woo-quik' ),
            [ $this, 'woo_quik_view_bottom_callback' ],
            'woo-quik-view',
            'woo_quik_view_admin_page_section'
        );
    }

    /**
     * Section description callback.
     */
    public function woo_quik_view_section_page() {
        echo '<p>' . __( 'Configure the settings for Woo Quik View.', 'woo-quik' ) . '</p>';
    }

    /**
     * Field callback for 'Bottom Position'.
     */
    public function woo_quik_view_bottom_callback() {
        $options = get_option( 'woo_quik_view_option' );
        $value = isset( $options['bottom_position'] ) ? esc_attr( $options['bottom_position'] ) : '';
        echo '<input type="text" id="bottom_position" name="woo_quik_view_option[bottom_position]" value="' . $value . '" />';
    }

    /**
     * Sanitize options callback.
     *
     * @param array $input The input values.
     * @return array The sanitized values.
     */
    public function sanitize_options( $input ) {
        $sanitized = [];
        if ( isset( $input['bottom_position'] ) ) {
            $sanitized['bottom_position'] = sanitize_text_field( $input['bottom_position'] );
        }
        return $sanitized;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo-quik-admin.css', [], $this->version, 'all' );
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woo-quik-admin.js', [ 'jquery' ], $this->version, false );
    }
}
