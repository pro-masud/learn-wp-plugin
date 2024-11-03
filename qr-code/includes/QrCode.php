<?php
namespace ProMausd\QR_Code;

class QrCode {
     
    function __construct(){
        add_filter( 'the_content', [$this, 'Qr_Code_Content'] );
    }


    public function Qr_Code_Content( $content ){
        $post_id = get_the_ID();
        $post_title = get_the_title();
        $post_permalink = urldecode( get_the_permalink( $post_id ) );

        $src = sprintf( "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=%s", $post_permalink );

        $post_type = get_post_type( $post_id );

        $post_type_filter = apply_filters( 'qr_post_type_change', array() );
        
        if(!in_array( $post_type, $post_type_filter)){
            return $content;
        }

        $content .= sprintf( "<img src='%s' alt='%s'>", $src, $post_title );

        return $content;
    }
}