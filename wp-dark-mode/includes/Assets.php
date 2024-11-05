<?php 
namespace Promasud\WpDarkMode;

class Assets{

    function __construct(){
        add_action( 'wp_enqueue_scripts', [ $this, 'dark_mode_enqueue_assets_file' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'dark_mode_enqueue_assets_file' ] );
    }

     /**
     * 
     * Dark Mode Plugin Include JS files
     * 
     * */ 
    public function wp_dark_mode_js_assets_file(){
        return [
            'dark-mode' => [
                'src'       => WP_Dark_Mode_ASSETS . '/js/darkmode-js.min.js',
                'version'   => filemtime( WP_Dark_Mode_ASSETS . '/assets/js/darkmode-js.min.js' ),
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
                'src'       => WP_Dark_Mode_ASSETS . '/css/blockout.css',
                'version'   => filemtime( WP_Dark_Mode_ASSETS . '/assets/css/blockout.css' ),
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
}