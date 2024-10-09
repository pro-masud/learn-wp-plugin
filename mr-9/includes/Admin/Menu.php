<?php 

namespace Promasud\MR_9\Admin;

/**
 * The Menu Hander
 * */ 
class Menu {

    public function __construct() {
        add_action('admin_menu', [ $this, 'admin_menu' ] );
    }

    public function admin_menu(){
        add_menu_page(__('MR9', 'mr-9'), __('MR9', 'mr-9'), 'manage_options', 'mr-9', [$this, 'mr9_plugin_page'], 'dashicons-welcome-learn-more' );
    }

    public function mr9_plugin_page(){
        echo "Hello World";
    }
} 