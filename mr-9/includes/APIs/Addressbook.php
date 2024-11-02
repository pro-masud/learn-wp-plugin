<?php 
namespace Promasud\MR_9\APIs;
use WP_REST_Controller;
use WP_REST_Server;
use WP_Error;

class Addressbook extends WP_REST_Controller {
    function __construct(){
        $this->namespace = 'academy/v1';
        $this->rest_base = 'contacts'; 
    }
    public function register_routes(){
        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base,
            [
                [
                    'methods'               => WP_REST_Server::READABLE,
                    'callback'              => [ $this, 'get_items' ],
                    'permission_callback'   => [ $this, 'get_items_permissions_check' ],
                    'args'                  => $this->get_collection_params(),
                ],
                'schema'    => [ $this, 'get_item_schema' ],
            ],
        );

        register_rest_route(
            $this->namespace,
            '/' . '/(?P<id>[\d]+',
            [
                [
                    'args'  => [
                        'id'    => [
                            'description'   => __( 'Unique identifier for the object.', 'mr-9' ),
                            'type'          => 'integer',
                        ],
                    ],
                ],
                [
                    'methods'               => WP_REST_Server::READABLE,
                    'callback'              => [ $this, 'get_item' ],
                    'permission_callback'   => [ $this, 'get_item_permissions_check' ],
                    'args'                  => $this->get_collection_params(),
                ],
                'schema'    => [ $this, 'get_item_schema' ],
            ],
        );
    }

    /**
     * 
     * Checks if a given request has access to read contacts
     * 
     * @param \WP_REST_Request $request
     * 
     * @return boolean
     * 
     * Description: this function working on user login or return to false option here
     * */
    public function get_items_permissions_check( $request ){
        if( current_user_can( 'manage_options' )){
            return true;
        }

        return false;
    }
     protected function get_contact( $id ){
        $contact = mr9_get_address( $id );

        if( ! $contact ){
            return new WP_Error(
                'rest_contact_invalid_id',
                __( 'Invalid Contact ID.' ),
                [ 'status'  => 404 ]
            );
        }

        return $contact;
    }


    /**
     * 
     * Checks if a given request has access to read contacts
     * 
     * @param \WP_REST_Request $request
     * 
     * @return boolean
     * 
     * Description: this function working on user login or return to false option here
     * */
    public function get_item_permissions_check( $request ){
        if( current_user_can( 'manage_options' )){
            return false;
        }

        $contact = $this->get_contact( $request['id'] );

        if( is_wp_error( $contact )){
            return $contact;
        }

        return true;
    }

    /**
     * Recrleves a list of address items.
     * 
     * @param \WP_REST_Request $request
     * 
     * @return \WP_REST_Request/WP_Error
     * 
     * */

     public function get_items( $request ) {
        $args = [];
        $params = $this->get_collection_params();
    
        foreach( $params as $key => $value ) {
            if( isset( $request[ $key ] ) ) {
                $args[ $key ] = $request[ $key ];
            }
        }
    
        // change `per_page` to `number`
        $args['number'] = $args['per_page'];
        $args['offset'] = $args['number'] * ( $args['page'] - 1 );
    
        unset( $args['per_page'] );
        unset( $args['page'] );
    
        $data = [];
        $contacts = mr9_get_address( $args );
    
        foreach( $contacts as $contact ) {
            $response = $this->prepare_item_for_response( $contact, $request );
            $data[] = $this->prepare_response_for_collection( $response );
        }

        $total = mr9_address_count();
        $max_pages = ceil( $total / (int) $args[ 'number' ] );
        
        $response = rest_ensure_response( $data );

        $response->header( 'X-WP-Total', (int) $total );
        $response->header( 'X-WP-TotalPages', (int) $max_pages );
    
        // return $data instead of $response
        return $response;
    }


    public function prepare_item_for_response( $item, $request ) {
        $data = [];
        $fields = $this->get_fields_for_response( $request );
        
        // Debug: Check fields array
        error_log(print_r($fields, true));
    
        if ( in_array( 'id', $fields, true ) ) {
            $data['id'] = (int) $item->id;
        }
        if ( in_array( 'name', $fields, true ) ) {
            $data['name'] = $item->name;
        }
        if ( in_array( 'address', $fields, true ) ) {
            $data['address'] = $item->address;
        }
        if ( in_array( 'phone', $fields, true ) ) {
            $data['phone'] = $item->phone;
        }
        if ( in_array( 'date', $fields, true ) ) {
            $data['date'] = mysql_to_rfc3339( $item->created_at );
        }
        
        // Check if data is populated
        error_log(print_r($data, true));
    
        $context = ! empty( $request['context'] ) ? $request['context'] : 'view';
        $data = $this->filter_response_by_context( $data, $context );
        
        $response =  rest_ensure_response( $data );
        $response->add_links( $this->prepare_links( $item ) );
       
        return $response;
    }

    /**
     * 
     * Prepares links for the request.
     * 
     * @param \WP_Post $post post object. 
     * 
     * @return array links for the given post.
     * 
     * */

     protected function prepare_links( $item ){
        $base = sprintf( '%s/%s', $this->namespace, $this->rest_base );
 
        $links = [
            'self'  => [
                'href'  => rest_url( trailingslashit( $base ) . $item->id ),
            ],
            'collection'    => [
                'href'  => rest_url( $base ),
            ],
        ];

        return $links;
     }

    /**
     * 
     * Retrieves the contact schema, conforming to JSON Schema.
     * 
     * */
    public function get_item_schema(){
        if( $this->schema ){
            return $this->add_additional_fields_schema( $this->schema );
        }

        $schema = [
            '$schema'   => 'http://json-schema.org/draft-04/schema#',
            'title'     => 'contact',
            'type'      => 'object',
            'properties'    => [
                'id'    => [
                    'description'   => __( 'Unique identifier for the object.' ),
                    'type'          => 'integer',
                    'context'       => [ 'view', 'edit' ],
                    'readonly'      => true,
                ],
                'name' => [
                    'description' => __( 'Name of the contact.' ),
                    'type'        => 'string',
                    'context'     => [ 'view', 'edit' ],
                    'required'    => true,
                    'arg_options' => [
                        'sanitize_callback' => 'sanitize_text_field',
                    ],
                ],
                'address' => [
                    'description' => __( 'Address of the contact.' ),
                    'type'        => 'string',
                    'context'     => [ 'view', 'edit' ],
                    'arg_options' => [
                        'sanitize_callback' => 'sanitize_textarea_field',
                    ],
                ],
                'phone' => [
                    'description' => __( 'Phone number of the contact.' ),
                    'type'        => 'string',
                    'required'    => true,
                    'context'     => [ 'view', 'edit' ],
                    'arg_options' => [
                        'sanitize_callback' => 'sanitize_text_field',
                    ],
                ],
                'date' => [
                    'description' => __( "The date the object was published, in the site's timezone." ),
                    'type'        => 'string',
                    'format'      => 'date-time',
                    'context'     => [ 'view' ],
                    'readonly'    => true,
                ],
            ]
        ];

        $this->schema = $schema;

        return $this->add_additional_fields_schema( $this->schema );
    }

    public function get_collection_params(){
        $params = parent::get_collection_params();

        unset( $params['search'] );

        return $params;
    }
}