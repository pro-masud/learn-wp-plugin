<?php 
namespace Promasud\WpDarkMode;

class Assets{

    function __construct(){
        add_action( 'wp_enqueue_scripts', [ $this, 'wp_dark_mode_front_assets_file' ] );
    }

    public function wp_dark_mode_style_assets_file(){
        return [
            'dark-mode-style' => [
                'src'       => MR_9_ASSETS . '/css/blockout.css',
                'version'   => filemtime( MR_9_PATH . '/assets/css/blockout.css' ),
            ],
        ];
    }

    public function wp_dark_mode_js_assets_file(){
        return [
            'dark-mode' => [
                'src'       => MR_9_ASSETS . '/js/darkmode-js.min.js',
                'version'   => filemtime( MR_9_PATH . '/assets/js/darkmode-js.min.js' ),
                'deps'       => [ 'jquery' ]
            ]
        ];
    }

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