<?php 

namespace Promasud\MR_9\Admin;

use Promasud\MR_9\Traits\Form_Error;

class Addressbook {

    use Form_Error;

    public function mr9_plugin_page(){
        $action = isset( $_GET['action']) ? $_GET['action'] : 'list';
        $id     = isset( $_GET['id']) ? intval( $_GET['id'] ) : 0;

        switch($action){
            case 'new':
                $template = __DIR__ . '/views/address-new.php';
                break;

            case 'edit':
                $address = mr9_single_address($id);
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

        $id = isset( $_POST['id'] ) ? intval( $_POST['id'] ) : 0;
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

        $args = [
            'name' => $name,
            'address' => $address,
            'phone' => $phone
        ];

        if( $id ){
            $args['id'] = $id;
        }

        $insert_id = mr9_insert_address( $args );
        
        if( is_wp_error( $insert_id )){
            wp_die(  $insert_id->get_error_message() );
        }

        $redirected_to = admin_url( 'admin.php?page=mr-9&inserted=true' );

        wp_redirect( $redirected_to );

        exit;
    }

}