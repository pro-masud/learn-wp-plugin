<?php 
/**
 * Plugin Name: MR9
 * Version: 1.0.0
 * Description: Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, similique!
 * Author: Masud Rana
 * Author URI: promasudbd.com
 * Text Domain: mr-9
 * Domain Path: /language
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Composer Autoload File Path Here
 */ 
include_once __DIR__ . "/vendor/autoload.php"; 

/**
 * This is the MR-9 Plugin Main Class
 */ 
final class MR_9 {
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

        register_activation_hook(__FILE__, [ $this, 'plugin_activate' ]);
        
        add_action('plugins_loaded', [ $this, 'mr_9_init_plugin' ]);
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
        define('MR_9_VERSION', self::version);
        define('MR_9_FILE', __FILE__);
        define('MR_9_PATH', __DIR__);
        define('MR_9_URL', plugins_url('', MR_9_FILE));
        define('MR_9_ASSETS', MR_9_URL . '/assets');
    }

    /**
     * Initialization Plugin
     */ 
    public function mr_9_init_plugin() {

        new Promasud\MR_9\Assets();

        if (defined('DOING_AJAX') && DOING_AJAX) {
            new Promasud\MR_9\Ajax();
        }
        
        if(is_admin()){
            new Promasud\MR_9\Admin();
        }else{
            new Promasud\MR_9\Frontend();
        }

        new Promasud\MR_9\APIs();
    }

    /**
     * Define Plugin Activation Function
     */ 
    public function plugin_activate() {
      $installers = new Promasud\MR_9\Installers();
      
      $installers->run();
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