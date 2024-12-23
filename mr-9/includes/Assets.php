<?php
namespace Promasud\MR_9;

class Assets{

    function __construct(){
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ]);
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
    }

    public function get_scripts(){
        return [
            'frontend-script' => [
                'src'       => MR_9_ASSETS . '/js/front-end.js',
                'version'   => filemtime( MR_9_PATH . '/assets/js/front-end.js' ),
                'deps'       => [ 'jquery' ]
            ],
            'mr-enquiry-script' => [
                'src'       => MR_9_ASSETS . '/js/enquiry.js',
                'version'   => filemtime( MR_9_PATH . '/assets/js/enquiry.js' ),
                'deps'       => [ 'jquery' ]
            ],
            'mr-admin-script' => [
                'src'       => MR_9_ASSETS . '/js/admin.js',
                'version'   => filemtime( MR_9_PATH . '/assets/js/admin.js' ),
                'deps'       => [ 'jquery', 'wp-util' ]
            ]
        ];
    }

    public function get_styles(){
        return [
            'frontend-style' => [
                'src'       => MR_9_ASSETS . '/css/front-end.css',
                'version'   => filemtime( MR_9_PATH . '/assets/css/front-end.css' ),
            ],
            'mr-admin-css' => [
                'src'       => MR_9_ASSETS . '/css/admin.css',
                'version'   => filemtime( MR_9_PATH . '/assets/css/admin.css' ),
            ],
            'mr-enquiry-css' => [
                'src'       => MR_9_ASSETS . '/css/enquiry.css',
                'version'   => filemtime( MR_9_PATH . '/assets/css/enquiry.css' ),
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


        wp_localize_script( 'mr-enquiry-script', 'MR9', [
            'ajaxurl'   => admin_url( 'admin-ajax.php' ),
            'error'     => __("Something went wrong", 'mr-9')
        ]);

        wp_localize_script( 'mr-admin-script', 'MR', [
            'nonce'     => wp_create_nonce( 'mr9-admin-nonce' ),
            'confirm'   => __( 'Are You Sure ?', 'mr-9'),
            'error'     => __( 'Something went wrong', 'mr-9' ),
        ]);
    }
}