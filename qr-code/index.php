<?php 
/**
 * Plugin Name: QR Code
 * Version: 1.0.0
 * Description: Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, similique!
 * Author: Masud Rana
 * Author URI: http://promasudbd.com
 * Text Domain: qr-code
 * Domain Path: /language
 */

 if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

final class QR_Code {
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
        
    }

    /**
     * Initializes a singleton instance
     * 
     * @return \QR_Code;
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
        define('QR_Code_VERSION', self::version);
        define('QR_Code_FILE', __FILE__);
        define('QR_Code_PATH', __DIR__);
        define('QR_Code_URL', plugins_url('', QR_Code_FILE));
        define('QR_Code_ASSETS', QR_Code_URL . '/assets');
    }

}

/**
 * Initializes the main plugin
 */ 
function QR_Code() {
    return QR_Code::init();
}

/**
 * Kick-off the plugin
 */ 
QR_Code();