<?php 
namespace Promasud\WpDarkMode\Admin;

class Menus {

    private $options;

    function __construct() {
        add_action('admin_menu', [ $this, 'wp_dark_mode_admin_page' ]);
        add_action('admin_init', [ $this, 'wp_dark_mode_init_page' ]);
    }

    // Add the admin page
    public function wp_dark_mode_admin_page() {
        add_options_page(
            __( 'WP Dark Mode', 'wp-dark-mode' ),
            __( 'WP Dark Mode', 'wp-dark-mode' ),
            'manage_options',
            'wp-dark-mode-admin-section-page',
            [ $this, 'wp_dark_mode_admin_front_end' ]
        );
    }

    // Display the admin page
    public function wp_dark_mode_admin_front_end() {
        $this->options = get_option('wp_dark_mode_options');
        ?> 
        <div class="wrap">
            <h1><?php esc_html_e( 'WP Dark Mode Settings', 'wp-dark-mode' ); ?></h1>
            <form action="options.php" method="post">
                <?php 
                    settings_fields('wp_dark_mode_main_options_group');
                    do_settings_sections('wp-dark-mode-admin-section-page');
                    submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    // Initialize settings and fields
    public function wp_dark_mode_init_page() {
        register_setting(
            'wp_dark_mode_main_options_group',
            'wp_dark_mode_options',
            [ $this, 'sanitize' ]
        );
        
        // Main Section
        add_settings_section(
            'wp_dark_mode_main_section',
            __( 'Custom Position', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_print_main_section_info' ],
            'wp-dark-mode-admin-section-page'
        );

        add_settings_field(
            'wp_dark_mode_bottom',
            __( 'Bottom Position', 'wp-dark-mode' ),
            [ $this, 'text_field_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_main_section',
            ['id' => 'wp_dark_mode_bottom', 'placeholder' => '32px']
        );

        add_settings_field(
            'wp_dark_mode_left',
            __( 'Left Position', 'wp-dark-mode' ),
            [ $this, 'text_field_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_main_section',
            ['id' => 'wp_dark_mode_left', 'placeholder' => '32px']
        );

        add_settings_field(
            'wp_dark_mode_right',
            __( 'Right Position', 'wp-dark-mode' ),
            [ $this, 'text_field_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_main_section',
            ['id' => 'wp_dark_mode_right', 'placeholder' => '32px']
        );

        // Default Position Section
        add_settings_section(
            'wp_dark_mode_default_position_section',
            __( 'Pre-Defined Positions', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_print_default_position_info' ],
            'wp-dark-mode-admin-section-page'
        );

        add_settings_field(
            'wp_dark_mode_bottom_left',
            __( 'Bottom Left', 'wp-dark-mode' ),
            [ $this, 'checkbox_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_default_position_section',
            ['id' => 'wp_dark_mode_bottom_left']
        );

        add_settings_field(
            'wp_dark_mode_bottom_right',
            __( 'Bottom Right', 'wp-dark-mode' ),
            [ $this, 'checkbox_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_default_position_section',
            ['id' => 'wp_dark_mode_bottom_right']
        );

        // Widget Settings Section
        add_settings_section(
            'wp_dark_mode_widget_settings_section',
            __( 'Widget Settings', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_print_widget_settings_section_info' ],
            'wp-dark-mode-admin-section-page'
        );

        add_settings_field(
            'wp_dark_mode_button_dark_settings',
            __( 'Button Dark Color', 'wp-dark-mode' ),
            [ $this, 'color_picker_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_widget_settings_section',
            ['id' => 'wp_dark_mode_button_dark_settings']
        );

        add_settings_field(
            'wp_dark_mode_button_light_settings',
            __( 'Button Light Color', 'wp-dark-mode' ),
            [ $this, 'color_picker_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_widget_settings_section',
            ['id' => 'wp_dark_mode_button_light_settings']
        );

        // Extra Settings Section
        add_settings_section(
            'wp_dark_mode_extra_settings_section',
            __( 'Extra Settings', 'wp-dark-mode' ),
            [ $this, 'wp_dark_mode_print_extra_section_info' ],
            'wp-dark-mode-admin-section-page'
        );

        add_settings_field(
            'wp_dark_mode_wtcc_section',
            __( 'Enable Cookies', 'wp-dark-mode' ),
            [ $this, 'checkbox_callback' ],
            'wp-dark-mode-admin-section-page',
            'wp_dark_mode_extra_settings_section',
            ['id' => 'wp_dark_mode_wtcc_section']
        );
    }

    // Sanitization callback
    public function sanitize($input) {
        $sanitized_input = [];
        foreach ($input as $key => $value) {
            $sanitized_input[$key] = sanitize_text_field($value);
        }
        return $sanitized_input;
    }

    // Section descriptions
    public function wp_dark_mode_print_main_section_info() {
        echo esc_html( __( 'Configure the custom positions for the dark mode toggle.', 'wp-dark-mode' ) );
    }

    public function wp_dark_mode_print_default_position_info() {
        echo esc_html( __( 'Choose from pre-defined toggle positions.', 'wp-dark-mode' ) );
    }

    public function wp_dark_mode_print_widget_settings_section_info() {
        echo esc_html( __( 'Customize the appearance of the toggle widget.', 'wp-dark-mode' ) );
    }

    public function wp_dark_mode_print_extra_section_info() {
        echo wp_kses_post( '
            <p>' . __( 'Enable cookies to remember user preference.', 'wp-dark-mode' ) . '</p>
            <p>' . __( 'Automatically match the OS dark mode setting.', 'wp-dark-mode' ) . '</p>
            <p>' . __( 'Use your own custom toggle widget or button.', 'wp-dark-mode' ) . '</p>
        ' );
    }

    // Field callbacks
    public function text_field_callback($args) {
        $id = $args['id'];
        $placeholder = $args['placeholder'] ?? '';
        printf(
            '<input type="text" id="%1$s" name="wp_dark_mode_options[%1$s]" placeholder="%2$s" value="%3$s" />',
            esc_attr($id),
            esc_attr($placeholder),
            isset($this->options[$id]) ? esc_attr($this->options[$id]) : ''
        );
    }

    public function checkbox_callback($args) {
        $id = $args['id'];
        printf(
            '<input type="checkbox" id="%1$s" name="wp_dark_mode_options[%1$s]" value="1" %2$s />',
            esc_attr($id),
            checked(1, isset($this->options[$id]) ? $this->options[$id] : 0, false)
        );
    }

    public function color_picker_callback($args) {
        $id = $args['id'];
        printf(
            '<input type="color" id="%1$s" name="wp_dark_mode_options[%1$s]" value="%2$s" />',
            esc_attr($id),
            isset($this->options[$id]) ? esc_attr($this->options[$id]) : ''
        );
    }
}