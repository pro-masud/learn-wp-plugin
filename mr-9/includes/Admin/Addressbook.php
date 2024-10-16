<?php 

namespace Promasud\MR_9\Admin;

class Addressbook {

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

        var_dump( mr9_insert_address() );

        var_dump($_POST );
        exit;
    }
}