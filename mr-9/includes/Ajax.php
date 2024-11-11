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
        add_action( 'wp_ajax_noprive_mr_enquiry', [ $this, 'submit_enquiry']);
        add_action( 'wp_ajax_mr-delete-contact', [ $this, 'delete_address']);
    }

    public function submit_enquiry(){

        if( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'mr9-enquiry-form')){
            wp_send_json_error( [
                'message'   => 'Nonce verification failed!'
            ] );
        }

        wp_send_json_error([
             'message'   => 'Enquiry has been send Unsuccessfull Data'
        ]);
    }

    public function delete_address(){

        if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'mr9-admin-nonce' ) ) {
            wp_send_json_error( [
                'message' => __( 'Nonce verification failed!', 'mr-9' )
            ] );
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( [
                'message' => __( 'No permission!', 'mr-9' )
            ] );
        }

        $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

        mr9_delete_address( $id );
        
        wp_send_json_success();
    }
}