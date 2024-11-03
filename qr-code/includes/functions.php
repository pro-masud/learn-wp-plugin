<?php

function change_post_type_qr_code( $post_type ){
    $post_type[] = 'post';

    return $post_type;
}

add_filter( 'qr_post_type_change', 'change_post_type_qr_code' );