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

            // create a custom shortcode here
            add_shortcode('portfolio', array($this, 'portfolio_short_code'));
        }

        // portfolio shortcode here
        public function portfolio_short_code(){
            ob_start();
            ?>
                <div class="section" data-aos="fade">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <ul class="portfolio-filter text-center">
                                        <li class="active"><a href="#" data-filter="*"> All</a></li>
                                        <li><a href="#" data-filter=".cat1">Cat 1</a></li>
                                        <li><a href="#" data-filter=".cat2">Cat 2</a></li>
                                        <li><a href="#" data-filter=".cat3">Cat 3</a></li>
                                    </ul>
                                </div>
                                <div class="portfolio--items portfolio-grid portfolio-gallery grid-4 gutter">
                                    <div class="portfolio-item cat2">
                                        <a href="#" class="portfolio-image popup-gallery" title="Bread">
                                            <img src="https://miro.medium.com/v2/resize:fit:800/0*JUUIaKYvIBQq9p9y.jpg" alt="">
                                            <div class="portfolio-hover-title">
                                                <div class="portfolio-content">
                                                    <h4>This is a Title</h4>
                                                    <div class="portfolio-category">
                                                        <span>Category 01</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
           return ob_get_clean();
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
            wp_enqueue_style('portfolio-bootstrap', plugin_dir_url( __FILE__ ) . 'assets/css/bootstrap.min.css', null,  PORT_LOAD_MORE_VERSION );
            wp_enqueue_style('portfolio-css', plugin_dir_url( __FILE__ ) . 'assets/css/portfolio.css', null, PORT_LOAD_MORE_VERSION );

            // Plugin JS file Include
            wp_enqueue_script('portfolio-bootstrap', plugin_dir_url( __FILE__ ) . "assets/js/bootstrap.min.js", ['jquery'], PORT_LOAD_MORE_VERSION, true );
            wp_enqueue_script('portfolio-isotope', plugin_dir_url( __FILE__ ) . "assets/js/isotope.pkgd.min.js", ['jquery'], PORT_LOAD_MORE_VERSION, true );
            wp_enqueue_script('portfolio-js', plugin_dir_url( __FILE__ ) . "assets/js/portfolio.js", [ 'jquery', 'portfolio-isotope' ], PORT_LOAD_MORE_VERSION, true );
        }
    }

    new PortfolioLoadMore();