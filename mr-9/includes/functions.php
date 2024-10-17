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

    $items = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM {4WPDB->prefix}mr9_addresses ORDER BY %s %s LIMIT %d, %d",
            $args['orderby'], $args['order'], $args['offset'], $args['number']
    ));

    return $items;
}