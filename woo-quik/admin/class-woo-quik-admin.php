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
        $this->options = get_option( 'woo_quik_view_option', [] );

        ?>
        <div class="wrap">
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
			[ $this, 'sanitize_options' ]
        );

        add_settings_section(
            'woo_quik_view_admin_page_section',
            __( 'Woo Quik View', 'woo-quik' ),
            [ $this, 'woo_quik_view_section_page' ],
            'woo-quik-view'
        );

        add_settings_field(
            'woo_quik_disable_enable_view',
            __( 'Quik View Disable/Enable', 'woo-quik' ),
            [ $this, 'woo_quik_view_disable_enable_view' ],
            'woo-quik-view',
            'woo_quik_view_admin_page_section'
        );
    }

	public function woo_quik_view_disable_enable_view() {
		$checked = isset( $this->options['woo_quik_disable_enable_view'] ) && $this->options['woo_quik_disable_enable_view'] === 'yes';
		printf(
			'<input type="checkbox" id="woo_quik_disable_enable_view" name="woo_quik_view_option[woo_quik_disable_enable_view]" value="yes" %s />',
			checked( $checked, true, false )
		);
	}
	

    /**
     * Section description callback.
     */
    public function woo_quik_view_section_page() {
        echo '<p>' . __( 'Configure the settings for Woo Quik View.', 'woo-quik' ) . '</p>';
    }

    /**
     * Sanitize options callback.
     *
     * @param array $input The input values.
     * @return array The sanitized values.
     */
	public function sanitize_options( $input ) {
		if ( ! is_array( $input ) ) {
			return [];
		}
	
		$checkbox_keys = [
			'woo_quik_disable_enable_view', // Add more checkbox keys here if needed.
		];
	
		$sanitized = [];
	
		foreach ( $input as $key => $value ) {
			if ( in_array( $key, $checkbox_keys, true ) ) {
				$sanitized[ $key ] = $value === 'yes' ? 'yes' : 'no';
			} else {
				$sanitized[ $key ] = sanitize_text_field( $value );
			}
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
