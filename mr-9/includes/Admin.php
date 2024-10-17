<?php
namespace Promasud\MR_9;
class Admin{

    public function __construct(){

        $addressbook = new Admin\Addressbook(); 

        $this->dispatch_actions( $addressbook );

        new Admin\Menu( $addressbook );
    }

    /**
     * Addressbook handle control function here
     * */ 

    public function dispatch_actions( $addressbook ){
        add_action('admin_init', [ $addressbook, 'form_handle' ]);
    }
}