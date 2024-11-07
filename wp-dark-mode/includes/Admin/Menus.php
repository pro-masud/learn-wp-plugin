<?php 
namespace Promasud\WpDarkMode\Admin;

class Menus {

    private $options;

    function __construct(){
        add_action('admin_menu', [ $this, 'wp_dark_mode_admin_page' ] );
        add_action('admin_init', [ $this, 'wp_dark_mode_init_page' ] );
    }

    public function wp_dark_mode_admin_page(){
        add_options_page( 
            __( 'WP Dark Mode', 'wp-dark-mode' ),
            __( 'WP Dark Mode', 'wp-dark-mode' ),
            'manage_options',
            'wp-dark-mode-admin-section-page',
            [ $this, 'wp_dark_mode_admin_front_end' ],
        );
    }

    public function wp_dark_mode_admin_front_end(){
        $this->options = get_option('wp_dark_mode_options');
        ?> 
        <div class="wrap">
            <form action="options.php" method="post">
                <?php 
                    settings_fields( 'wp_dark_mode_main_options_group' );
                    do_settings_sections( 'wp-dark-mode-admin-section-page' );
                    submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    public function wp_dark_mode_init_page(){
        register_setting(
            'wp_dark_mode_main_options_group',
            'wp_dark_mode_options',
            [ $this, 'sanitize' ],
        );
 
        add_settings_section(
            'wp_dark_mode_main_section',
            'Custom Position',
            [ $this, 'wp_dark_mode_print_main_section_info' ],
            'wp-dark-mode-admin-section-page',
        );

        add_settings_field(
            'wp_dark_mode_bottom',
            __( 'Bottom Position', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_bottom_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_main_section',
        );

        add_settings_field(
            'wp_dark_mode_left',
            __( 'Left Position', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_left_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_main_section',
        ); 

        add_settings_field(
            'wp_dark_mode_right',
            __( 'Right Position', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_right_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_main_section',
        );

        add_settings_field(
            'wp_dark_mode_sipo_section',
            __( 'Show in Posts only', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_print_sipo_section' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_main_section',
        );

        add_settings_field(
            'wp_dark_mode_time_section',
            __( 'Time', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_print_time_section' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_main_section',
        );
    }

    public function wp_dark_mode_print_main_section_info(){
        echo "hello world";
    }

    public function wp_dark_mode_bottom_callback(){
        printf(
            '<input type="text" id="wp_dark_mode_bottom" placeholder="32px" name="wp_dark_mode_options[wp_dark_mode_bottom]" value="%s" />',
            isset( $this->options[ 'wp_dark_mode_bottom' ] ) ? esc_attr( $this->options[ 'wp_dark_mode_bottom' ] ) : ''
        );
    }
    
    public function wp_dark_mode_left_callback(){
        printf(
            '<input type="text" id="wp_dark_mode_left" placeholder="32px" name="wp_dark_mode_options[wp_dark_mode_left]" value="%s" />',
            isset( $this->options[ 'wp_dark_mode_left' ] ) ? esc_attr( $this->options[ 'wp_dark_mode_left' ] ) : ''
        );
    }

    public function wp_dark_mode_right_callback(){
        printf(
            '<input type="text" id="wp_dark_mode_right" placeholder="32px" name="wp_dark_mode_options[wp_dark_mode_right]" value="%s" />',
            isset( $this->options[ 'wp_dark_mode_right' ] ) ? esc_attr( $this->options[ 'wp_dark_mode_right' ] ) : ''
        );
    }
    public function wp_dark_mode_print_sipo_section(){
        printf(
            '<input type="checkbox" id="wp_dark_mode_sipo_section" name="wp_dark_mode_options[wp_dark_mode_sipo_section]" value="1" %s />',
            checked( 1, isset($this->options['wp_dark_mode_sipo_section']) ? $this->options['wp_dark_mode_sipo_section'] : 0, false )
        );  
    }
    public function wp_dark_mode_print_time_section(){
        printf(
            '<input type="text" id="wp_dark_mode_time_section" placeholder="0.3s" name="wp_dark_mode_options[wp_dark_mode_time_section]" value="%s" />',
            isset( $this->options[ 'wp_dark_mode_time_section' ] ) ? esc_attr( $this->options[ 'wp_dark_mode_time_section' ] ) : ''
        );
    }
}