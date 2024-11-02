<?php

    function mr9_insert_address( $args = [] ){
        global $wpdb;

        if( empty( $args['name']) ){
            return new \WP_Error( 'no-name', __( 'You mush provide a name.', 'mr-9' ) );
        }

        $defaults = [
            'name'          => '',
            'address'       => '',
            'phone'         => '',
            'create_by'     => get_current_user_id(),
            'created_at'    => current_time( 'mysql' ),
        ];

        $data = wp_parse_args( $args, $defaults );

        if( isset( $data['id'] )){

            $id = $data['id'];
            unset( $data['id'] );

            $update = $wpdb->update(
                $wpdb->prefix . 'mr9_addresses',
                $data,
                [ 'id' => $id ],
                [
                    '%s',
                    '%s',
                    '%s',
                    '%d',
                    '%s',
                ],
                [ '%d' ]
            );

            return $update;
        }else{
            $inserted = $wpdb->insert(
                "{$wpdb->prefix}mr9_addresses",
                $data,
                [
                    '%s',
                    '%s',
                    '%s',
                    '%d',
                    '%s',
                ]
            );
        
            if( ! $inserted ) {
                return new \WP_Error( 'failed-to-insert', __('Failed to insert data', 'mr-9' ) );
            }
        
            return $wpdb->insert_id;
        }
    }

    /**
     * Fetch Address data
     * @param array $args
     * 
     * @return array
     * */ 

    function mr9_get_address( $args = [] ){
        global $wpdb;
        
        $defaults = [
            'number' => 20,
            'offset' => 0,
            'orderby' => 'id',
            'order' => 'ASC',
        ];

        $args = wp_parse_args( $args, $defaults );

        $sql = $wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}mr9_addresses
                ORDER BY {$args['orderby']} {$args['order']}
                LIMIT %d, %d",
                $args['offset'], $args['number']
        );

        $items = $wpdb->get_results( $sql );

        return $items;
    }


    function mr9_address_count(){
        global $wpdb;

        return (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}mr9_addresses" );
    }


    /**
     * fetch single data form address book
     * */ 

    function mr9_single_address( $id ){
        global $wpdb;

        return $wpdb->get_row(
            $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}mr9_addresses WHERE id ='%d'", $id ),
        );
    }

    /**
     * 
     * fetch single data delete form address book
     * 
     * */

    function mr9_delete_address( $id ){
        global $wpdb;

        return $wpdb->delete(
            $wpdb->prefix . 'mr9_addresses',
            [ 'id'      => $id ],
            [ '%d' ]
        );
    }