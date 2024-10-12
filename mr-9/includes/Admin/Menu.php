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
        $capability = 'manage_options';
        add_menu_page( __('MR9', 'mr-9'), __('MR9', 'mr-9'), $capability , $parent_slug, [$this, 'mr9_address_book'], 'dashicons-welcome-learn-more' );
        add_submenu_page($parent_slug, __('Address Book', 'mr-9'), __('Address Book', 'mr-9'),$capability, $parent_slug, [$this, 'mr9_address_book'] );
        add_submenu_page($parent_slug, __('Settings', 'mr-9'), __('Settings', 'mr-9'),$capability, 'mr9-settings', [$this, 'mr9_address_book_settings'] );
    }

    public function mr9_address_book(){
        $addressbook = new Addressbook();

        $addressbook -> mr9_plugin_page();
    }

    public function mr9_address_book_settings(){
        echo 'This is a Address Book Settings';
    }
}