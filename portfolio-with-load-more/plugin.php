<?php 
/**
     * Plugin Name: Portfolio with Load More
     * version: 1.0.0
     * Description: Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, similique!
     * Author: MR9
     * Author URI: promasudbd@gmail.com
     * Text Domain: portfolio
     * Domain Path:/language
     * */ 

    /** Portfolio version */ 
    define('PORT_LOAD_MORE_VERSION', '1.0.0');

    /** Portfolio Directory Path Version */
    define('PORTFOLIO_HELPER_DIR', trailingslashit(plugin_dir_path( __FILE__ )));

    /** Portfolio includes directory path */ 
    define("PORTFOLIO_HELPER_INCLUDES_DIR", trailingslashit( PORTFOLIO_HELPER_DIR . 'includes' ));

    // create a plugin main Class
    class PortfolioLoadMore{
        // create a plugin construct function
        public function __construct(){
            add_action("plugin_loaded", array($this, 'Portfolio_Text_Domain_loaded' ));
        }

        /** Plugin Text Domain Loaded fuction */ 
        public function Portfolio_Text_Domain_loaded(){
            load_plugin_textdomain('portfolio', false, trailingslashit( PORTFOLIO_HELPER_DIR . 'language' ) );
        }
    }

    new PortfolioLoadMore();