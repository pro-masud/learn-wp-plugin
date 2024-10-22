<?php
namespace Promasud\MR_9;

class Assets{

    function __construct(){
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ]);
    }

    public function get_scripts(){
        return [
            'frontend-script' => [
                'src'       => MR_9_ASSETS . '/js/front-end.js',
                'version'   => filemtime( MR_9_PATH . '/assets/js/front-end.js' ),
                'deps'       => [ 'jquery' ]
            ]
        ];
    }

    public function get_styles(){
        return [
            'frontend-style' => [
                'src'       => MR_9_ASSETS . '/css/front-end.css',
                'version'   => filemtime( MR_9_PATH . '/assets/css/front-end.css' ),
            ]
        ];
    }

    public function enqueue_assets(){

        $scripts = $this->get_scripts();

        foreach( $scripts as $handle => $script){
            $deps = isset( $script['deps']) ? $script['deps'] : false ;

            wp_register_script( $handle, $script['src'], $deps, $script['version'], true );
        }

        $styles = $this->get_styles();

        foreach( $styles as $handle => $style){
            $deps = isset( $style['deps']) ? $style['deps'] : false ;

            wp_register_style( $handle, $style['src'], $deps, $style['version'] );
        }
    }
}