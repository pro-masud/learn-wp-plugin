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
        ?>
            <div class="wrap">
                <h1 class="wp-heading-inline" >
                    <?php _e('Edit Address', 'mr-9') ?>
                </h1>
                <form action="options.php" method="post">
                    <?php 
                        settings_fields( 'wp_slider_settings' );
                        do_settings_sections( 'wp-slider-carousel' );
                        submit_button();
                    ?>
                </form>
            </div>
        <?php
    }


    public function wp_slider_page_init(){
        register_setting(
        'wp_slider_settings',
        'wp_slider_settings',
        [ $this, 'wp_slider_sanitaize' ]
        );

        add_settings_section( 
            'slider_settings_behaviour', // ID
            __( 'Slider Carousel Behaviour', 'wp-slider' ), // Name
            array( $this, 'wp_slider_settings_behaviour_header' ),
            'wp-slider-carousel',
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
    }

    public function wp_slider_sanitaize( $input ){

    }

    /**
     * WP Slider Behaviour Section 
     * */ 
    public function wp_slider_settings_behaviour_header(){
        echo "<p>Slider Header Section</p>";
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
}

if(is_admin()){
   $wp_slider_settings_option =  new Wp_Slider_Option();
}