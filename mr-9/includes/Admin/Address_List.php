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

    /**
     * Column Default Function 
     * 
     * */
    protected function column_default( $item, $column_name ){
        switch( $column_name ){
            case 'value':
                # code
                break;
            
            default: 
            return isset( $item->$column_name) ? $item->$column_name : '';
        }
    }

    /**
     * Column Name Change Options Here
     * */ 

    public function column_name( $item ){
        $actions = [];

        $actions['edit'] = sprintf( '<a href="%s" title"%s">%s</a>', admin_url('admin.php?page=mr-9&action=edit&id=' . $item->id ), $item->id, __('Edit', 'mr-9') );
        $actions['delete'] = sprintf( '<a href="%s" class"submitdelete" onclick="return confirm(\'Are you sure?\');" title="%s">%s</a>', wp_nonce_url( admin_url('admin-post.php?action=mr9-delete-address&id=' . $item->id ), 'mr-9' ), $item->id, __('Delete', 'mr-9') );

        return sprintf(
            '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url( 'admin.php?page=mr-9&action=view&id' . $item->id ), $item->name, $this->row_actions( $actions )
        );
    }

     /**
     * Column Name Change Options Here
     * */ 

     public function column_cb( $item ){
        return sprintf( '<input type="checkbox" name="address_id" value="%d">',  $item->id );
    }

    public function prepare_items() {
        $column = $this->get_columns();
        $hidden = [];
        $sortable = $this->get_sortable_columns();

        $per_page = 20;

        $this->_column_headers = [ $column, $hidden, $sortable ];

        $this->items = mr9_get_address();

        $this->set_pagination_args( [
            'total_items'   => mr9_address_count(),
            'per_page'      => $per_page,
        ] );
    }
}
