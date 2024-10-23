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
        add_action( 'wp_ajax_mr9_delete_contact', [ $this, 'delete_address']);

    }

    public function submit_enquiry(){

        if( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'mr9-enquiry-form')){
            wp_send_json_error( [
                'message'   => 'Nonce verification failed!'
            ] );
        }
        
        // wp_send_json_success([
        //     'message'   => 'Enquiry has been send Successfully'
        // ]);

        wp_send_json_error([
             'message'   => 'Enquiry has been send Unsuccessfull Data'
        ]);
    }

    public function delete_address(){
        wp_send_json_success();
    }
}