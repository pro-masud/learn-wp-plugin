<?php 
/**
 * Plugin Name: MR9
 * version: 1.0.0
 * Description: Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, similique!
 * Author: Masud Rana
 * Author URI: promasudbd@gmail.com
 * Text Domain: mr-9
 * Domain Path:/language
 * */ 

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * This is a MR-9 Plugin Main Class
 * */ 

final class MR_9 {

    /**
     * Class Construct Function Here
     * 
     * @return \MR_9
     * */ 
    function __construct(){

    }

    /**
     * Initailizes a singletan instance
     * 
     * @return \MR_9
    */
    public static function init(){
        static $instance = false;

        if(! $instance){
            $instance = new self();
        }

        return $instance;
    }
}

/**
 * Initializes the main plugin
 * */ 

function Mr_9(){
    return MR_9::init();
}

/**
 * Kick-off the plugin
 * */ 
Mr_9();