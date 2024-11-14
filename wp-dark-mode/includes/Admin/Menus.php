<?php 
namespace Promasud\WpDarkMode\Admin;

class Menus {
    private $options;

    public function __construct() {
        add_action('admin_menu', [ $this, 'wp_dark_mode_admin_page' ] );
        add_action('admin_init', [ $this, 'wp_dark_mode_init_page' ] );
    }

    public function wp_dark_mode_admin_page() {
        add_options_page( 
            __( 'WP Dark Mode', 'wp-dark-mode' ),
            __( 'WP Dark Mode', 'wp-dark-mode' ),
            'manage_options',
            'wp-dark-mode-admin-section-page',
            [ $this, 'wp_dark_mode_admin_front_end' ]
        );
    }

    public function wp_dark_mode_admin_front_end() {
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

    public function wp_dark_mode_init_page() {
        
        register_setting(
            'wp_dark_mode_main_options_group',
            'wp_dark_mode_options',
            [ $this, 'sanitize' ]
        );

        $this->init_settings_sections();
        $this->init_settings_fields();
    }

    public function sanitize($input) {
        if (!is_array($input)) return [];
        
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
            $sanitized_input[$key] = in_array($key, $absint_keys, true)
                ? absint($value)
                : sanitize_text_field($value);
        }
    
        return $sanitized_input;
    }

    private function init_settings_sections() {
        add_settings_section(
            'wp_dark_mode_main_section',
            __( 'Custom Position', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_print_main_section_info' ],
            'wp-dark-mode-admin-section-page'
        );

        add_settings_section(
            'wp_dark_mode_default_postion_section',
            __( 'Pre-Defined Positions', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_print_default_postion_info' ],
            'wp-dark-mode-admin-section-page'
        );

        add_settings_section(
            'wp_dark_mode_widget_settings_section',
            __( 'Widget Settings', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_print_widget_settings_section_info' ],
            'wp-dark-mode-admin-section-page'
        );

        add_settings_section(
            'wp_dark_mode_extra_settings_section',
            __( 'Extra Settings', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_print_extra_section_info' ],
            'wp-dark-mode-admin-section-page'
        );
    }

    private function init_settings_fields() {
        add_settings_field(
            'wp_dark_mode_bottom',
            __( 'Bottom Position', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_bottom_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_main_section'
        );

        add_settings_field(
            'wp_dark_mode_left',
            __( 'Left Position', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_left_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_main_section'
        );

        add_settings_field(
            'wp_dark_mode_right',
            __( 'Right Position', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_right_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_main_section'
        );

        add_settings_field(
            'wp_dark_mode_sipo_section',
            __( 'Show in Posts Only', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_sipo_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_main_section'
        );

        add_settings_field(
            'wp_dark_mode_bottom_left',
            __( 'Bottom Left', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_bottom_left_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_default_postion_section'
        );

        add_settings_field(
            'wp_dark_mode_bottom_right',
            __( 'Bottom Right', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_bottom_right_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_default_postion_section'
        );
    }

    public function wp_dark_mode_print_main_section_info() {
        echo esc_html("WP Dark Mode Settings Options");
    }

    public function wp_dark_mode_print_default_postion_info() {
        echo esc_html("Choose the position that you prefer:");
    }

    public function wp_dark_mode_print_widget_settings_section_info() {
        echo esc_html("Enter Your Widget Settings Options:");
    }

    public function wp_dark_mode_print_extra_section_info() {
        echo esc_html("Additional settings and options for dark mode behavior.");
    }

    public function wp_dark_mode_bottom_callback() {
        $value = $this->options['wp_dark_mode_bottom'] ?? '';
        printf(
            '<input type="text" id="wp_dark_mode_bottom" placeholder="32px" name="wp_dark_mode_options[wp_dark_mode_bottom]" value="%s" />',
            esc_attr($value)
        );
    }

    public function wp_dark_mode_left_callback() {
        $value = $this->options['wp_dark_mode_left'] ?? '';
        printf(
            '<input type="text" id="wp_dark_mode_left" placeholder="32px" name="wp_dark_mode_options[wp_dark_mode_left]" value="%s" />',
            esc_attr($value)
        );
    }

    public function wp_dark_mode_right_callback() {
        $value = $this->options['wp_dark_mode_right'] ?? '';
        printf(
            '<input type="text" id="wp_dark_mode_right" placeholder="32px" name="wp_dark_mode_options[wp_dark_mode_right]" value="%s" />',
            esc_attr($value)
        );
    }

    public function wp_dark_mode_sipo_callback() {
        $checked = $this->options['wp_dark_mode_sipo_section'] ?? 0;
        printf(
            '<input type="checkbox" id="wp_dark_mode_sipo_section" name="wp_dark_mode_options[wp_dark_mode_sipo_section]" value="1" %s />',
            checked(1, $checked, false)
        );
    }

    public function wp_dark_mode_bottom_left_callback() {
        $checked = $this->options['wp_dark_mode_bottom_left'] ?? 0;
        printf(
            '<input type="checkbox" id="wp_dark_mode_bottom_left" name="wp_dark_mode_options[wp_dark_mode_bottom_left]" value="1" %s />',
            checked(1, $checked, false)
        );
    }

    public function wp_dark_mode_bottom_right_callback() {
        $checked = $this->options['wp_dark_mode_bottom_right'] ?? 0;
        printf(
            '<input type="checkbox" id="wp_dark_mode_bottom_right" name="wp_dark_mode_options[wp_dark_mode_bottom_right]" value="1" %s />',
            checked(1, $checked, false)
        );
    }
}
