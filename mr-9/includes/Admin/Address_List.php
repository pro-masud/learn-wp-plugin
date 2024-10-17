<?php 
namespace Promasud\MR_9\Admin;


if( !class_exists( 'WP_List_Table' )){
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * 
 * List Table Class
 * 
 * */ 
class Address_List extends \WP_List_Table {

    function __construct(){
        parent::__construct([
            'singular'  => 'contact',
            'plural'    => 'contacts',
            'ajax'      => false
        ]);
    }


    public function get_columns(){
        return [
            'cb'            => '<input type="checkbox"',
            'name'          => __( 'Name', 'mr-9' ),
            'address'       => __( 'Address', 'mr-9' ),
            'phone'         => __( 'Phone', 'mr-9' ),
            'created_at'    => __( 'Date', 'mr-9' ),
        ];
    }

    public function prepare_items() {
        # code.....
    }
}