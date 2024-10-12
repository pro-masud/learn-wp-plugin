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
        $parent_slug = 'mr-9';
        $capabality = 'manage_options';
        add_menu_page( __('MR9', 'mr-9'), __('MR9', 'mr-9'), $capabality , $parent_slug, [$this, 'mr9_plugin_page'], 'dashicons-welcome-learn-more' );
        add_submenu_page($parent_slug, __('Address Book', 'mr-9'), __('Address Book', 'mr-9'),$capabality, 'mr-9-address-book', [$this, 'mr9_address_book'] );
    }

    public function mr9_plugin_page(){
        echo "Hello World";
    }

    public function mr9_address_book(){
        echo 'This is a Address Book';
    }
} 