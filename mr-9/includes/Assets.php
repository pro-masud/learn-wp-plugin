<?php
namespace Promasud\MR_9;

class Assets{

    function __construct(){
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ]);
    }

    public function enqueue_assets(){
        wp_register_script( 'mr9-frontend-script', MR_9_ASSETS . '/js/front-end.js', [ 'jquery' ], filemtime( MR_9_PATH . '/assets/js/front-end.js' ), true );

        wp_register_style( 'mr9-front-end-css', MR_9_ASSETS . '/assets/css/front-end.css' );

        wp_enqueue_script( 'mr9-frontend-script' );
        wp_enqueue_style( 'mr9-front-end-css' );
    }
}