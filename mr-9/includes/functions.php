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