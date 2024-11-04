<?php 
/**
 * Plugin Name: Wp Dark Mode
 * Version: 1.0.0
 * Description: Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, similique!
 * Author: Masud Rana
 * Author URI: http://promasudbd.com
 * Text Domain: wp-dark-mode
 * Domain Path: /language
 */

    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly.
    }

    require_once __DIR__ . '/vendor/autoload.php';

    final class WP_Dark_Mode {
        /**
         * Plugin Version
         * 
         * @var string
         */ 
        const version = '1.0';

        /**
         * Class Construct Function Here
         */ 
        function __construct() {
            $this->define_constants();
            
            add_action('plugins_loaded', [ $this, 'wp_dark_mode_init_plugin' ]);
            
        }

        public function wp_dark_mode_init_plugin(){
           
            new Promasud\WpDarkMode\Admin();
        }

        /**
         * Initializes a singleton instance
         * 
         * @return \WP_Dark_Mode;
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
            define('WP_Dark_Mode_VERSION', self::version);
            define('WP_Dark_Mode_FILE', __FILE__);
            define('WP_Dark_Mode_PATH', __DIR__);
            define('WP_Dark_Mode_URL', plugins_url('', WP_Dark_Mode_FILE));
            define('WP_Dark_Mode_ASSETS', WP_Dark_Mode_URL . '/assets');
        }

    }

    /**
     * Initializes the main plugin
     */ 
    function WP_Dark_Mode() {
        return WP_Dark_Mode::init();
    }

    /**
     * Kick-off the plugin
     */ 
    WP_Dark_Mode();