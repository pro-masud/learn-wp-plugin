<?php 
namespace Promasud\WpDarkMode\Admin;

class Menus {
    function __construct(){
        add_action('admin_menu', [ $this, 'wp_dark_mode_admin_page' ] );
    }

    public function wp_dark_mode_admin_page(){
        add_options_page( 
            __( 'WP Dark Mode', 'wp-dark-mode' ),
            __( 'WP Dark Mode', 'wp-dark-mode' ),
            'manage_options',
            'wp-dark-mode',
            [ $this, 'wp_dark_mode_admin_front_end' ],
        );
    }


    public function wp_dark_mode_admin_front_end(){
        echo "Addmin Page";
    }
}