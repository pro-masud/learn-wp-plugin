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
                [
                    'methods'               => WP_REST_Server::CREATABLE,
                    'callback'              => [ $this, 'create_item' ],
                    'permission_callback'   => [ $this, 'create_item_permissions_check' ],
                    'args'                  => $this->get_endpoint_args_for_item_schema( WP_REST_Server::CREATABLE ),
                ],
                'schema'    => [ $this, 'get_item_schema' ],
            ]
        );

        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base . '/(?P<id>[\d]+)',
            [
                'args'   => [
                    'id' => [
                        'description' => __( 'Unique identifier for the object.' ),
                        'type'        => 'integer',
                    ],
                ],
                [
                    'methods'             => WP_REST_Server::READABLE,
                    'callback'            => [ $this, 'get_item' ],
                    'permission_callback' => [ $this, 'get_item_permissions_check' ],
                    'args'                => [
                        'context' => $this->get_context_param( [ 'default' => 'view' ] ),
                    ],
                ],
                [
                    'methods'             => WP_REST_Server::EDITABLE,
                    'callback'            => [ $this, 'update_item' ],
                    'permission_callback' => [ $this, 'update_permissions_check' ],
                    'args'                => [
                        'context' => $this->get_context_param( [ 'default' => 'view' ] ),
                    ],
                ],
                [
                    'methods'             => WP_REST_Server::DELETABLE,
                    'callback'            => [ $this, 'delete_item' ],
                    'permission_callback' => [ $this, 'delete_item_permissions_check' ],
                ],
                'schema'    => [ $this, 'get_item_schema' ],
            ]
        );
    }

    public function update_permissions_check( $request ){
        return $this->get_item_permissions_check( $request );
    }

    public function update_item( $request ){
        $contact = $this->get_contact( $request['id'] );
        $prepare = $this->prepare_item_for_database( $request );

        $prepare = array_merge( (array) $contact, $prepare );

        $update_data = mr9_insert_address( $prepare );

        if( ! $update_data ){
            return new WP_Error(
                'rest_not_updated',
                __( ' Sorry, the address colud not be updated.' ),
                [ 'status'  => 400 ]
            );
        }

        $contact = $this->get_contact( $request['id'] );
        $response = $this->prepare_item_for_response( $contact, $request );

        return rest_ensure_response( $response );
    }

    /**
     * Checks if a given request has access to read contacts
     * 
     * @param \WP_REST_Request $request
     * @return boolean
     */
    public function create_item_permissions_check( $request ){
        return $this->get_items_permissions_check( $request );
    }

    /**
     * Checks if a given request has access to read contacts
     * 
     * @param \WP_REST_Request $request
     * @return boolean
     */
    
    public function create_item( $request ){
        $contact = $this->prepare_item_for_database( $request );

        if( is_wp_error( $contact )){
            return $contact;
        }

        $contact_id = mr9_insert_address( $contact );

        if( is_wp_error( $contact_id )){
            $contact_id->add_data( [ 'status' => 400 ]);

            return $contact_id;
        }
 
        $contact =  $this->get_contact( $contact_id );

        $response = $this->prepare_item_for_response( $contact, $request );

        $response->set_status( 201 );
        $response->header( 'Location', rest_url( sprintf( '%s%s%d', $this->namespace, $this->rest_base, $contact_id )));

        return rest_ensure_response( $response );
    }

    protected function prepare_item_for_database( $request ){
        $prepared  = [];

        if( isset( $request['name'] ) ){
            $prepared['name'] = $request['name'];
        }

        if( isset( $request['address'] ) ){
            $prepared['address'] = $request['address'];
        }

        if( isset( $request['phone'] ) ){
            $prepared['phone'] = $request['phone'];
        }
        return $prepared;
    }

    /**
     * Checks if a given request has access to read contacts
     * 
     * @param \WP_REST_Request $request
     * @return boolean
     */
    public function delete_item_permissions_check( $request ){
        return $this->get_item_permissions_check( $request );
    }

    /**
     * Retrieves a list of address items.
     * 
     * @param \WP_REST_Request $request
     * @return \WP_REST_Response|WP_Error
     */
    public function delete_item( $request ){
        $contact = $this->get_contact( $request['id'] );
        $previous = $this->prepare_item_for_response( $contact, $request );
         
        $delete = mr9_delete_address( $request['id'] );

        if( ! $delete ){
            return new WP_Error(
                'rest_not_deleted',
                __( ' Sorry, the address colud not be deleted.' ),
                [ 'status'  => 400 ]
            );
        }

        $data = [
            'delete'    => true, 
            'previous'  => $previous->get_data(),
        ];

        $response = rest_ensure_response( $data );

        return $response;
    }


    /**
     * Checks if a given request has access to read contacts
     * 
     * @param \WP_REST_Request $request
     * @return boolean
     */
    public function get_items_permissions_check( $request ){
        return current_user_can( 'manage_options' );
    }

    /**
     * Retrieves a list of address items.
     * 
     * @param \WP_REST_Request $request
     * @return \WP_REST_Response|WP_Error
     */
    public function get_items( $request ) {
        $args = [];
        $params = $this->get_collection_params();
    
        foreach( $params as $key => $value ) {
            if( isset( $request[ $key ] ) ) {
                $args[ $key ] = $request[ $key ];
            }
        }
    
        $args['number'] = $args['per_page'];
        $args['offset'] = $args['number'] * ( $args['page'] - 1 );
    
        unset( $args['per_page'] );
        unset( $args['page'] );
    
        $data = [];
        $contacts = mr9_get_address( $args ); // Make sure this function returns an array or object.
    
        // Check if $contacts is valid before iterating
        if (!empty($contacts) && (is_array($contacts) || is_object($contacts))) {
            foreach( $contacts as $contact ) {
                $response = $this->prepare_item_for_response( $contact, $request );
                $data[] = $this->prepare_response_for_collection( $response );
            }
        } else {
            // Log if no contacts are found
            error_log('No contacts returned from mr9_get_address: ' . print_r($contacts, true));
        }
    
        $total = mr9_address_count();
        $max_pages = ceil( $total / (int) $args[ 'number' ] );
    
        $response = rest_ensure_response( $data );
        $response->header( 'X-WP-Total', (int) $total );
        $response->header( 'X-WP-TotalPages', (int) $max_pages );
    
        return $response;
    }
    
    protected function get_contact( $id ){
        $contact = mr9_single_address( $id );

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
     * Checks if a given request has access to read a single contact
     * 
     * @param \WP_REST_Request $request
     * @return boolean|WP_Error
     */

    public function get_item_permissions_check( $request ){
        if ( ! current_user_can( 'manage_options' ) ) {
            return false;
        }

        $contact = $this->get_contact( $request['id'] );

        if ( is_wp_error( $contact ) ) {
            return $contact;
        }

        return true;
    }

    /**
     * Retrieves a single address item.
     * 
     * @param \WP_REST_Request $request
     * @return \WP_REST_Response|WP_Error
     */
    public function get_item( $request ) {
        $contact = $this->get_contact( $request['id'] );

        $response = $this->prepare_item_for_response( $contact, $request );
        $response = rest_ensure_response( $response );

        return $response;
    }
    
    public function prepare_item_for_response( $item, $request ) {
        $data = [];
        $fields = $this->get_fields_for_response( $request );

        // Determine if the item is an object or an array and access properties accordingly
        $id = is_object( $item ) ? $item->id ?? null : (isset($item['id']) ? $item['id'] : null);
        $name = is_object( $item ) ? $item->name ?? null : (isset($item['name']) ? $item['name'] : null);
        $address = is_object( $item ) ? $item->address ?? null : (isset($item['address']) ? $item['address'] : null);
        $phone = is_object( $item ) ? $item->phone ?? null : (isset($item['phone']) ? $item['phone'] : null);
        $date = is_object( $item ) ? $item->created_at ?? null : (isset($item['created_at']) ? $item['created_at'] : null);

        // Set data only if the keys exist
        if (in_array('id', $fields, true) && $id !== null) {
            $data['id'] = (int) $id;
        } else {
            // Handle missing id case
            $data['id'] = 0; // or choose not to include it at all
        }

        if (in_array('name', $fields, true)) {
            $data['name'] = $name ?? null;
        }
        if (in_array('address', $fields, true)) {
            $data['address'] = $address ?? null;
        }
        if (in_array('phone', $fields, true)) {
            $data['phone'] = $phone ?? null;
        }
        if (in_array('date', $fields, true) && $date !== null) {
            $data['date'] = mysql_to_rfc3339($date);
        }

        $context = !empty($request['context']) ? $request['context'] : 'view';
        $data = $this->filter_response_by_context($data, $context);

        $response = rest_ensure_response($data);
        $response->add_links($this->prepare_links($item));

        return $response;
    }

    /**
     * Prepares links for the request.
     * 
     * @param object $item Contact object
     * @return array Links for the given item
     */
    protected function prepare_links( $item ){
        $base = sprintf( '%s/%s', $this->namespace, $this->rest_base );
    
        // Check if item is an array or object for the ID
        $id = is_array( $item ) ? $item['id'] : $item->id;
    
        $links = [
            'self'  => [
                'href'  => rest_url( trailingslashit( $base ) . $id ),
            ],
            'collection'    => [
                'href'  => rest_url( $base ),
            ],
        ];
    
        return $links;
    }
    
    /**
     * Retrieves the contact schema, conforming to JSON Schema.
     * 
     * @return array The contact schema
     */
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

    /**
     * Defines parameters for collection requests.
     * 
     * @return array Collection parameters
     */
    public function get_collection_params(){
        $params = [
            'page' => [
                'description'       => __( 'Current page of the collection.' ),
                'type'              => 'integer',
                'default'           => 1,
                'sanitize_callback' => 'absint',
            ],
            'per_page' => [
                'description'       => __( 'Number of items per page.' ),
                'type'              => 'integer',
                'default'           => 10,
                'sanitize_callback' => 'absint',
            ],
        ];

        return $params;
    }
}