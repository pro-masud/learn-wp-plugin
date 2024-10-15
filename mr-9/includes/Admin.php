<?php
namespace Promasud\MR_9;
class Admin{

    public function __construct(){
        $this->dispatch_actions();

        new Admin\Menu();
    }

    /**
     * Addressbook handle control function here
     * */ 

    public function dispatch_actions(){
        $addressbook = new Admin\Addressbook();

        add_action('admin_init', [ $addressbook, 'form_handle' ]);
    }
}