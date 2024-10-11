<?php 
namespace Promasud\MR_9\Frontend;

class Shortcode {
    function __construct(){
        add_shortcode('mr-9-shortcode', [$this, 'mr_9_render_shortcode']);
    }

    public function mr_9_render_shortcode($attr, $content = ''){
        echo 'This is a Shortcode';
    }
}