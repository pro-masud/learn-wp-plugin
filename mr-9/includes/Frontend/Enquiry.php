<?php 
namespace Promasud\MR_9\Frontend;

/**
 * 
 * Intailization Class 
 * 
 * */ 
class Enquiry{

    /**
     * 
     * Initializes the class
     * 
     * */ 

    function __construct(){
        add_shortcode( 'mr9-enquiry', [ $this, 'mr9_render_shortcode' ] );
    }

    /**
     * 
     * Shortcode Handler Class
     *
     * @param array $atts
     * @param string $content
     * 
     * @return string
     *  
     * */
    
    public function mr9_render_shortcode( $atts, $content = '' ){
        
        ob_start();
        
        include __DIR__ . '/views/enquiry.php';

       return ob_get_clean();
    }

}