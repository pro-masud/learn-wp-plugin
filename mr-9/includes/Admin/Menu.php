<?php 

namespace Promasud\MR_9\Admin;

/**
 * The Menu Hander
 * */ 
class Menu {

    public $addressbook;

    public function __construct( $addressbook ) {
        $this->addressbook = $addressbook;

        add_action('admin_menu', [ $this, 'admin_menu' ] );
    }

    public function admin_menu(){
        $parent_slug = 'mr-9';
        $capability = 'manage_options';

        $hook = add_menu_page( __('MR9', 'mr-9'), __('MR9', 'mr-9'), $capability , $parent_slug, [ $this->addressbook, 'mr9_plugin_page'], 'dashicons-welcome-learn-more' );
        add_submenu_page($parent_slug, __('Address Book', 'mr-9'), __('Address Book', 'mr-9'),$capability, $parent_slug, [ $this->addressbook, 'mr9_plugin_page'] );
        add_submenu_page($parent_slug, __('Settings', 'mr-9'), __('Settings', 'mr-9'),$capability, 'mr9-settings', [$this, 'mr9_address_book_settings'] );
        
        add_action( 'admin_head-' . $hook, [ $this, 'enqueue_scripts' ] );
    }

    public function mr9_address_book(){
        $addressbook = new Addressbook();

        $addressbook -> mr9_plugin_page();
    }

    public function mr9_address_book_settings(){
        echo 'This is a Address Book Settings';
    }

    public function enqueue_scripts(){
        wp_enqueue_style( 'mr-admin-css' );
        wp_enqueue_script( 'mr-admin-script' );
    }
}