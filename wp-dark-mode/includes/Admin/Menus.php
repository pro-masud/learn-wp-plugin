<?php 
namespace Promasud\WpDarkMode\Admin;

class Menus {
    function __construct(){
        add_action('admin_menu', [ $this, 'wp_dark_mode_admin_page' ] );
    }

    public function wp_dark_mode_admin_page(){
        add_options_page( 
            __( 'My Options', 'textdomain' ),
            __( 'My Plugin', 'textdomain' ),
            'manage_options',
            'my-plugin.php',
            [ $this, 'wp_dark_mode_admin_front_end' ],
        );
    }


    public function wp_dark_mode_admin_front_end(){
        echo "Addmin Page";
    }
}