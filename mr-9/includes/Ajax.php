<?php
namespace Promasud\MR_9;


/**
 * 
 * Initalization Ajax Class
 * 
 * */ 
class Ajax{

    function __construct(){
        add_action( 'wp_ajax_mr_enquiry', [ $this, 'submit_enquiry']);

    }

    public function submit_enquiry(){
        echo 'hello';
    }
}