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

        add_settings_section(
            'wp_dark_mode_default_postion_section',
            'Pre-Defined Positions',
            [ $this, 'wp_dark_mode_print_default_postion_info' ],
            'wp-dark-mode-admin-section-page',
        );

        add_settings_field(
            'wp_dark_mode_bottom_left',
            __( 'Bottom Left', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_bottom_left_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_default_postion_section',
        );

        add_settings_field(
            'wp_dark_mode_bottom_right',
            __( 'Bottom Right', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_bottom_right_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_default_postion_section',
        );

        add_settings_section(
            'wp_dark_mode_widget_settings_section',
            'Widget Settings',
            [ $this, 'wp_dark_mode_print_widget_settings_section_info' ],
            'wp-dark-mode-admin-section-page',
        );

        add_settings_field(
            'wp_dark_mode_button_dark_settings',
            __( 'Button Dark', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_button_dark_setting_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_widget_settings_section',
        );

        add_settings_field(
            'wp_dark_mode_button_light_settings',
            __( 'Button Light', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_button_light_setting_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_widget_settings_section',
        );

        add_settings_field(
            'wp_dark_mode_button_size_settings',
            __( 'Button Size', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_button_size_setting_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_widget_settings_section',
        );

        add_settings_field(
            'wp_dark_mode_icon_size_settings',
            __( 'Icon Size', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_icon_size_setting_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_widget_settings_section',
        );

        add_settings_section(
            'wp_dark_mode_extra_settings_section',
            'Extra Settings',
            [ $this, 'wp_dark_mode_print_extra_section_info' ],
            'wp-dark-mode-admin-section-page',
        );

        add_settings_field(
            'wp_dark_mode_wtcc_section',
            __( 'Want to create a cookie?', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_wtcc_settings_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_extra_settings_section',
        );

        add_settings_field(
            'wp_dark_mode_match_os',
            __( 'Want to match the OS mode?', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_wtmosm_settings_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_extra_settings_section',
        );

        add_settings_field(
            'wp_dark_mode_wyotwb_section',
            __( 'Want to use your own toggle widget or button?', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_wyotwb_settings_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_extra_settings_section',
        );
    }

    // Sanitization callback
    public function sanitize($input) {
        $absint_keys = [
            'wp_dark_mode_sipo_section',
            'wp_dark_mode_bottom_left',
            'wp_dark_mode_bottom_right',
            'wp_dark_mode_wtcc_section',
            'wp_dark_mode_wtmosm_section',
            'wp_dark_mode_wyotwb_section',
        ];
    
        $sanitized_input = [];
        foreach ($input as $key => $value) {
            if (in_array($key, $absint_keys, true)) {
                $sanitized_input[$key] = absint($value);
            } else {
                $sanitized_input[$key] = sanitize_text_field($value);
            }
        }
    
        return $sanitized_input;
    }
    

    public function wp_dark_mode_print_main_section_info(){
        echo esc_html( text: "WP Dark Mode Settings Options" );
    }
    public function wp_dark_mode_print_default_postion_info(){
        echo esc_html( "Choose the position that you prefer:" );
    }

    public function wp_dark_mode_print_widget_settings_section_info(){
        echo esc_html( "Enter Your Setting Options:" );
    }
    public function wp_dark_mode_print_extra_section_info(){
        ?>
           <p><?php echo esc_html( "The cookies will allow the plugin to keep the dark mode active if the suer enabled it previously.:" ); ?></p> 
           <p><?php echo esc_html( "The match OS will allow the plugin to activate dark mode if the OS or browser are in Dark mode." ); ?></p> 
           <p><?php echo esc_html( "Want to use your own widget or element as toggler? mark the last checkbox with the label Want to use your own toggle widget or button?. then add the class darkmode-enable to the element that you want to use as toggle." ); ?></p> 
        <?php
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
    public function wp_dark_mode_bottom_left_callback(){
        printf(
            '<input type="checkbox" id="wp_dark_mode_bottom_left" name="wp_dark_mode_options[wp_dark_mode_bottom_left]" value="1" %s />',
            checked( 1, isset($this->options['wp_dark_mode_bottom_left']) ? $this->options['wp_dark_mode_bottom_left'] : 0, false )
        );  
    }

    public function wp_dark_mode_bottom_right_callback(){
        printf(
            '<input type="checkbox" id="wp_dark_mode_bottom_right" name="wp_dark_mode_options[wp_dark_mode_bottom_right]" value="1" %s />',
            checked( 1, isset($this->options['wp_dark_mode_bottom_right']) ? $this->options['wp_dark_mode_bottom_right'] : 0, false )
        );  
    }

    public function wp_dark_mode_button_dark_setting_callback(){
        printf(
            '<input type="color" id="wp_dark_mode_button_dark_settings" name="wp_dark_mode_options[wp_dark_mode_button_dark_settings]" value="%s" />',
            isset( $this->options[ 'wp_dark_mode_button_dark_settings' ] ) ? esc_attr( $this->options[ 'wp_dark_mode_button_dark_settings' ] ) : ''
        );
    }

    public function wp_dark_mode_button_light_setting_callback(){
        printf(
            '<input type="color" id="wp_dark_mode_button_light_settings" name="wp_dark_mode_options[wp_dark_mode_button_light_settings]" value="%s" />',
            isset( $this->options[ 'wp_dark_mode_button_light_settings' ] ) ? esc_attr( $this->options[ 'wp_dark_mode_button_light_settings' ] ) : ''
        );
    }

    public function wp_dark_mode_button_size_setting_callback(){
        printf(
            '<input type="range" min="20" max="100" step="5" id="wp_dark_mode_button_size_settings" name="wp_dark_mode_options[wp_dark_mode_button_size_settings]" value="%s" />',
            isset( $this->options[ 'wp_dark_mode_button_size_settings' ] ) ? esc_attr( $this->options[ 'wp_dark_mode_button_size_settings' ] ) : ''
        );
    }

    public function wp_dark_mode_icon_size_setting_callback(){
        printf(
            '<input type="range" min="20" max="100" step="5" id="wp_dark_mode_icon_size_settings" name="wp_dark_mode_options[wp_dark_mode_icon_size_settings]" value="%s" />',
            isset( $this->options[ 'wp_dark_mode_icon_size_settings' ] ) ? esc_attr( $this->options[ 'wp_dark_mode_icon_size_settings' ] ) : ''
        );
    }

    public function wp_dark_mode_wtcc_settings_callback(){
        printf(
            '<input type="checkbox" id="wp_dark_mode_wtcc_section" name="wp_dark_mode_options[wp_dark_mode_wtcc_section]" value="1" %s />',
            checked( 1, isset($this->options['wp_dark_mode_wtcc_section']) ? $this->options['wp_dark_mode_wtcc_section'] : 0, false )
        );  
    }

    public function wp_dark_mode_wtmosm_settings_callback(){
        printf(
            '<input type="checkbox" id="wp_dark_mode_wtmosm_section" name="wp_dark_mode_options[wp_dark_mode_wtmosm_section]" value="1" %s />',
            checked( 1, isset($this->options['wp_dark_mode_wtmosm_section']) ? $this->options['wp_dark_mode_wtmosm_section'] : 0, false )
        );  
    }

    public function wp_dark_mode_wyotwb_settings_callback(){     
        printf(
            '<input type="checkbox" id="wp_dark_mode_wyotwb_section" name="wp_dark_mode_options[wp_dark_mode_wyotwb_section]" value="1" %s />',
            checked( 1, isset($this->options['wp_dark_mode_wyotwb_section']) ? $this->options['wp_dark_mode_wyotwb_section'] : 0, false )
        );  
    }
}