<?php 

namespace Promasud\MR_9\Admin;

class Addressbook {

    public $errors = []; 

    public function mr9_plugin_page(){
        $action = isset( $_GET['action']) ? $_GET['action'] : 'list';

        switch($action){
            case 'new':
                $template = __DIR__ . '/views/address-new.php';
                break;

            case 'edit':
                $template = __DIR__ . '/views/address-edit.php';
                break;

            case 'view':
                $template = __DIR__ . '/views/address-view.php';
                break;

           default: 
                $template = __DIR__ . '/views/address-list.php';
                break;
        }

        if( file_exists( $template ) ){
            include $template;
        }
    }

    public function form_handle(){

        if( ! isset( $_POST['submit_address'] ) ){
            return;
        }

        if( ! wp_verify_nonce( $_POST['_wpnonce'], 'new-mr9')){
            wp_die( 'Are you cheating?' );
        }

        if( ! current_user_can( 'manage_options' )){
            wp_die( 'Are you Cheating?' );
        }

        $name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '' ;
        $address = isset( $_POST['address'] ) ? sanitize_text_field( $_POST['address'] ) : '' ;
        $phone = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '' ;

        if( empty( $name )){
            $this->errors['name'] = __( 'Please provide a Name', 'mr-9');
        }

        if( empty( $phone )){
            $this->errors['phone'] = __( 'Please provide a Phone number', 'mr-9');
        }

        if( ! empty( $this->errors )){
            return;
        }

        $insert_id = mr9_insert_address([
            'name' => $name,
            'address' => $address,
            'phone' => $phone
        ] );
        
        if( is_wp_error( $insert_id )){
            wp_die(  $insert_id->get_error_message() );
        }

        $redirected_to = admin_url( 'admin.php?page=mr-9&inserted=true' );

        wp_redirect( $redirected_to );

        exit;
    }
}