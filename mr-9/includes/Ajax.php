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
        
        // wp_send_json_success([
        //     'message'   => 'Enquiry has been send Successfully'
        // ]);

        wp_send_json_error([
             'message'   => 'Enquiry has been send Unsuccessfull Data'
        ]);
    }
}