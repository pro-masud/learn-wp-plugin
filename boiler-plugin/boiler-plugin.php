<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://dev-masud-rana.netlify.app/
 * @since             1.0.0
 * @package           boiler_plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Boilder Plugin
 * Plugin URI:        https://dev-masud-rana.netlify.app/
 * Description:       This is a description of the plugin.
 * Version:           1.0.0
 * Author:            Masud Rana
 * Author URI:        https://dev-masud-rana.netlify.app//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       boilder-plugin
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Composer Autoload File Path Here
 */ 
include_once __DIR__ . "/vendor/autoload.php"; 

final class BOILDER_PLUGIN {
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

        register_activation_hook(__FILE__, [ $this, ' boilder_plugin_activate' ]);
        
        add_action('plugins_loaded', [ $this, ' boilder_plugin_init_plugin' ]);
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
        define('BOILDER_PLUGIN_VERSION', self::version);
        define('BOILDER_PLUGIN_FILE', __FILE__);
        define('BOILDER_PLUGIN_PATH', __DIR__);
        define('BOILDER_PLUGIN_URL', plugins_url('', BOILDER_PLUGIN_FILE));
        define('BOILDER_PLUGIN_ASSETS', BOILDER_PLUGIN_URL . '/assets');
    }

	/**
     * Initialization Plugin files
     */ 
    public function boilder_plugin_init_plugin() {
        if(is_admin()){
            new Promasud\MR_9\Admin();
        }else{
            new Promasud\MR_9\Frontend();
        }
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
function Boilder_Plugin() {
    return BOILDER_PLUGIN::init();
}

/**
 * Kick-off the plugin
 */ 
Boilder_Plugin();