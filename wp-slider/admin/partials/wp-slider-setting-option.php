<?php 
class Wp_Slider_Option {

    private $options;

   public function __construct(){
       add_action( 'admin_menu', [ $this, 'wp_slider_settings_menus' ]);
       add_action( 'admin_init', [ $this, 'wp_slider_page_init' ]);
    }

    public function wp_slider_settings_menus(){

        $parent_slug = 'edit.php?post_type=wp_slider_carousel';
        $capability = 'manage_options';

        add_submenu_page($parent_slug, __('Settings', 'wp-settings'), __('Settings', 'wp-settings'), $capability, 'wp-slider-setting', [ $this, 'wp_slider_settings_option'] );
    }

    public function wp_slider_settings_option(){
        $this->options = get_option( 'wp_slider_settings' );

        ?>
            <div class="wrap">
                <?php echo $this->options; ?>
                <h1 class="wp-heading-inline" >
                    <?php _e('Edit Address', 'mr-9') ?>
                </h1>
                <form action="options.php" method="post">
                    <?php 
                        settings_fields( 'wp_slider_main_options_group' ); // Ensure the group matches register_setting()
                        do_settings_sections( 'wp-slider-carousel' ); // Ensure this matches add_settings_section() 'page'

                        submit_button();
                    ?>
                </form>
            </div>
        <?php
    }


    public function wp_slider_page_init(){

        register_setting(
        'wp_slider_main_options_group',
        'wp_slider_settings',
        [ $this, 'wp_slider_sanitaize' ]
        );

        add_settings_section( 
            'slider_settings_behaviour', // ID
            __( 'Slider Carousel Behaviour', 'wp-slider' ), // Name
            array( $this, 'wp_slider_settings_behaviour_header' ),
            'wp-slider-carousel',
        );

        add_settings_field( 
            'interval', // ID
            __( 'Slider Interval (milliseconds)', 'wp-slider' ), // Name
            array( $this, 'interval_callback' ),
            'wp-slider-carousel',
            'slider_settings_behaviour',
        );

        add_settings_section( 
            'slider_settings_setup', // ID
            __( 'Slider Carousel Setup', 'wp-slider' ), // Name
            array( $this, 'wp_slider_settings_header_setup' ),
            'wp-slider-carousel',
        );

        add_settings_section( 
            'slider_settings_button_link', // ID
            __( 'Button Link', 'wp-slider' ), // Name
            array( $this, 'wp_slider_settings_link_buttons_header' ),
            'wp-slider-carousel',
        );

        add_settings_section( 
            'slider_settings_custom_markup', // ID
            __( 'Custom Markup', 'wp-slider' ), // Name
            array( $this, 'wp_slider_settings_custom_markup_header' ),
            'wp-slider-carousel',
        );
    }

    public function wp_slider_sanitaize( $input ) {
        $sanitized_input = array();
    
        if ( isset( $input['interval'] ) ) {
            $sanitized_input['interval'] = absint( $input['interval'] ); // Ensures the interval is an integer.
        }
    
        return $sanitized_input;
    }
    

    /**
     * WP Slider Behaviour Section 
     * */ 
    public function wp_slider_settings_behaviour_header(){
        echo "<p>Slider Header Section</p>";
    }

    public function interval_callback() {
        printf(
            '<input type="text" id="interval" name="wp_slider_settings[interval]" value="%s" size="15" />',
            isset( $this->options['interval'] ) ? esc_attr( $this->options['interval'] ) : ''
        );
        echo '<p class="description">' . __( 'How long each image shows for before it slides. Set to 0 to disable animation.', 'wp-slider' ) . '</p>';
    }
    

    /**
     * WP Slider Setup Section 
     * */ 
    public function wp_slider_settings_header_setup(){
        echo "<p>Slider Header Section</p>";
    }

    /**
     * WP Slider Setup Section  
     * */ 
    public function wp_slider_settings_link_buttons_header(){
        echo "<p>Slider Header Section</p>";
    }

    /**
     * WP Slider Setup Section  
     * */ 
    public function wp_slider_settings_custom_markup_header(){
        echo "<p>Slider Header Section</p>";
    }
}

if(is_admin()){
   $wp_slider_settings_option =  new Wp_Slider_Option();
}