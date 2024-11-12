<?php 
class Wp_Slider_Option {

    private $options;

   public function __construct(){
       add_action( 'admin_menu', [ $this, 'wp_slider_settings_menus' ]);
    }

    public function wp_slider_settings_menus(){

        $parent_slug = 'edit.php?post_type=wp_slider_carousel';
        $capability = 'manage_options';

        add_submenu_page($parent_slug, __('Settings', 'wp-settings'), __('Settings', 'wp-settings'), $capability, 'wp-slider-setting', [ $this, 'wp_slider_settings_option'] );
    }

    public function wp_slider_settings_option(){
        echo "hello world";
    }
}

if(is_admin()){
   $wp_slider_settings_option =  new Wp_Slider_Option();
}