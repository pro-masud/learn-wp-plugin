<?php 
namespace Promasud\MR_9;

class APIs {

    function __construct(){
        add_action( 'rest_api_init', [ $this, 'register_api'] );
    }

    public function register_api(){
        $addressbook = new APIs\Addressbook();

        $addressbook->register_routes();
    }
}