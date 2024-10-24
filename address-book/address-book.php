<?php 
/**
 * Plugin Name: Address Book
 * Version: 1.0.0
 * Description: Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, sint.
 * Author: Masud Rana
 * Author URL: promasudbd.com
 * Text Domain: address-book
 * Domain Path: /language
 * 
 * */

 if( ! defined( 'ABSPATH' )){
    exit; // Exit if accessed directly.
 }


/**
 * 
 * This is a Address Book Main Class
 * 
 * */

 final class Address_book {

    // Plugin Veriable
    const version = '1.0';

    /**
     * Address Book Main Construct Function
     * 
     * */
    function __() {

    }


    /**
     * 
     * Defiends Constants used in the plugin
     * 
     * */
    public function define_contants(){
        define( 'ADDRESS_BOOK_VERSION', self::version );
        define( 'ADDRESS_BOOK_FILE', __FILE__ );
        define( 'ADDRESS_BOOK_PATH', __DIR__ );
        define( 'ADDRESS_BOOK_URL', plugins_url('', ADDRESS_BOOK_PATH ));
        define( 'ADDRESS_BOOK_ASSETS', ADDRESS_BOOK_URL . '/assets' );
    } 
 }  