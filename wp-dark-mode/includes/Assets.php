<?php 
namespace Promasud\WpDarkMode;

class Assets{

    function __construct(){
        add_action( 'wp_enqueue_scripts', [ $this, 'wp_dark_mode_front_assets_file' ] );
    }

    public function get_assets_styles_file(){
        
    }

    public function wp_dark_mode_front_assets_file(){

    }
}