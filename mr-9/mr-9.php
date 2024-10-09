<?php 
/**
 * Plugin Name: MR9
 * Version: 1.0.0
 * Description: Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, similique!
 * Author: Masud Rana
 * Author URI: promasudbd@gmail.com
 * Text Domain: mr-9
 * Domain Path: /language
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * This is the MR-9 Plugin Main Class
 */ 

final class MR_9 {
    /**
     * Plugin Version
     * 
     * @var string
     */ 
    private static $version = '1.0';

    /**
     * Class Construct Function Here
     */ 
    function __construct() {
        $this->define_constants();


        /**
         * Plugin Activation Hook
        */
        register_activation_hook(__FILE__, [$this, 'plugin_activate'] );
    }

    /**
     * Initializes a singleton instance
     * 
     * @return \MR_9;
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Defines constants used in the plugin
     */ 
    public function define_constants() {
        define('MR_9_VERSION', self::$version);
        define('MR_9_FILE', __FILE__);
        define('MR_9_PATH', __DIR__);
        define('MR_9_URL', plugins_url('', MR_9_FILE ));
        define('MR_9_ASSETS', MR_9_URL . '');
    }

    /**
     * Define Plugin Activation Function
     * */ 
    public function plugin_activate(){

        $installed = get_option( 'mr_9_installed' );

        if( ! $installed ){
            update_option('mr_9_installed', time() );
        }

        update_option('mr_9_vesion', MR_9_VERSION );
    }
}

/**
 * Initializes the main plugin
 */ 
function Mr_9() {
    return MR_9::init();
}

/**
 * Kick-off the plugin
 */ 
Mr_9();
