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
        
        load_plugin_textdomain( 'wp-dark-mode', false, dirname( WP_DARK_MODE_FILE ) . '/language' );
    }

    public function wp_dark_mode_init_plugin(){
        
      $plugin_assets =   new Promasud\WpDarkMode\Assets();
        new Promasud\WpDarkMode\Admin();

        wp_dark_mode_init_assets( $plugin_assets->wp_dark_mode_init() );
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
        define('WP_DARK_MODE_VERSION', self::version);
        define('WP_DARK_MODE_FILE', __FILE__);
        define('WP_DARK_MODE_PATH', __DIR__);
        define('WP_DARK_MODE_URL', plugins_url('', WP_DARK_MODE_FILE));
        define('WP_DARK_MODE_ASSETS', WP_DARK_MODE_URL . '/assets');
    }
}

/**
 * Initializes the main plugin
 */ 
function WP_Dark_Mode() {
    return WP_Dark_Mode::init();
}



/**
 * Include Files here.
 * 
 * @return files
 */ 

function wp_dark_mode_init_assets( $args ){
    return $args;
}

/**
 * Kick-off the plugin
 */ 
if( is_admin()){
    WP_Dark_Mode();
}else{
    add_action('wp_init', 'wp_dark_mode_init_assets' );
}