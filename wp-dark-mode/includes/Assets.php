<?php 
namespace Promasud\WpDarkMode;

class Assets{

    function __construct(){
        add_action( 'wp_enqueue_scripts', [ $this, 'dark_mode_enqueue_assets_file' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'dark_mode_enqueue_assets_file' ] );

        add_action( 'wp_enqueue_scripts', [ $this, 'dark_mode_plugin_enqueue_files'] );
    }

    /**
     * 
     * Dark Mode Plugin Include JS files
     * 
     * */ 
    public function wp_dark_mode_js_assets_file(){
        return [
            'wp-dark-mode' => [
                'src'       => WP_DARK_MODEe_ASSETS . '/js/darkmode-js.min.js',
                'version'   => filemtime( WP_DARK_MODE_PATH . '/assets/js/darkmode-js.min.js' ),
                'deps'       => [ 'jquery' ]
            ]
        ];
    }

    /**
     * 
     * Dark Mode Plugin Include CSS files
     * 
     * */ 
    public function wp_dark_mode_style_assets_file(){
        return [
            'dark-mode-style' => [
                'src'       => WP_DARK_MODEe_ASSETS . '/css/blockout.css',
                'version'   => filemtime( WP_DARK_MODE_PATH . '/assets/css/blockout.css' ),
            ],
        ];
    }

    /**
     * 
     * Dark Mode Plugin Regitster CSS and JS files
     * 
     * */ 
    public function dark_mode_enqueue_assets_file(){
        $style_files    = $this->wp_dark_mode_style_assets_file();

        foreach( $style_files as $handle => $style){
            $deps = isset( $style['deps']) ? $style['deps'] : false ;

            wp_register_style( $handle, $style['src'], $deps, $style['version'] );
        }

        $script_files   = $this->wp_dark_mode_js_assets_file();

        foreach( $script_files as $handle => $script){
            $deps = isset( $script['deps']) ? $script['deps'] : false ;

            wp_register_script( $handle, $script['src'], $deps, $script['version'], true );
        }
    }


    /**
     * Initializes the main plugin
     */ 

     public function dark_mode_plugin_enqueue_files(){
        wp_enqueue_script( 'dark-mode-style' );
        wp_enqueue_style( 'wp-dark-mode' );
    }
}