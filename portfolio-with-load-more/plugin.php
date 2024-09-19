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
            add_action("plugins_loaded", array($this, 'Portfolio_Text_Domain_loaded' ));
            add_action('wp_enqueue_scripts', array($this, 'Portfolio_Assets_Files'));

            // Custom Post Type Included
            $this->Custom_Post_Type_Ragister();
        }

        // Register Custom Post Types
        private function Custom_Post_Type_Ragister(){
            include PORTFOLIO_HELPER_INCLUDES_DIR . "/Custom-Post-Types.php";
        }

        /** Plugin Text Domain Loaded fuction */
        public function Portfolio_Text_Domain_loaded(){
            load_plugin_textdomain('portfolio', false, trailingslashit( PORTFOLIO_HELPER_DIR . 'language' ) );
        }

        // Plugin Included All CSS and JS file included here
        public function Portfolio_Assets_Files(){
            // plugin css file include 
            wp_enqueue_style('portfolio-bootstrap', PORTFOLIO_HELPER_DIR . 'assets/css/bootstrap.min.css', null,  PORT_LOAD_MORE_VERSION );
            wp_enqueue_style('portfolio-css', PORTFOLIO_HELPER_DIR . 'assets/css/portfolio.css', null, PORT_LOAD_MORE_VERSION );

            // Plugin JS file Include
            wp_enqueue_script('portfolio-bootstrap', PORTFOLIO_HELPER_DIR . "assets/js/bootstrap.min.js", ['jquery'], PORT_LOAD_MORE_VERSION, true );
            wp_enqueue_script('portfolio-isotope', PORTFOLIO_HELPER_DIR . "assets/js/isotope.pkgd.min.js", ['jquery'], PORT_LOAD_MORE_VERSION, true );
            wp_enqueue_script('portfolio-js', PORTFOLIO_HELPER_DIR . "assets/js/portfolio.js", [ 'jquery', 'portfolio-isotope' ], PORT_LOAD_MORE_VERSION, true );
        }
    }

    new PortfolioLoadMore();