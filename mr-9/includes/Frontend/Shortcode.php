<?php 
namespace Promasud\MR_9\Frontend;

class Shortcode {
    function __construct(){
        add_shortcode('mr-9-shortcode', [$this, 'mr_9_render_shortcode']);
    }

    public function mr_9_render_shortcode($attr, $content = ''){
        wp_enqueue_script( 'frontend-script' );
        wp_enqueue_style( 'frontend-style' );

        echo '<div class="mr9-shortcode">This is a Shortcode</div>';
    }
}