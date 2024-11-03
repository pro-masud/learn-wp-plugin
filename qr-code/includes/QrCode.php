<?php
namespace ProMausd\QR_Code;

class QrCode {
     
    function __construct(){
        add_filter( 'the_content', [$this, 'Qr_Code_Content'] );

        add_action( 'admin_init', 'qr_code_settings_options' );
    }


    public function Qr_Code_Content( $content ){
        $post_id = get_the_ID();
        $post_title = get_the_title();
        $post_permalink = urldecode( get_the_permalink( $post_id ) );

       
        $post_type = get_post_type( $post_id );

        $post_type_filter = apply_filters( 'qr_post_type_change', array() );
        
        if(!in_array( $post_type, $post_type_filter)){
            return $content;
        }

        $dimension  = apply_filters( 'qr_code_image_dimension', '150x150' );
        $attr  = apply_filters( 'qr_code_image_attr', '' );

        $src = sprintf( "https://api.qrserver.com/v1/create-qr-code/?size=%s&data=%s",  $dimension, $post_permalink );

        $content .= sprintf( "<img %s src='%s' alt='%s'>", $attr, $src, $post_title );

        return $content;
    }

    public function qr_code_settings_options(){
        add_settings_field(
            'qr_code_setting_width_id',
            __( 'Qr Code Width', 'qr-code' ),
            'qr_width_settings_callback',
            'general',
        );

        add_settings_field(
            'qr_code_setting_height_id',
            __( 'Qr Code Height', 'qr-code' ),
            'qr_height_settings_callback',
            'general',
        );

        register_setting( 'general', 'qr_code_setting_width_id', array( 
            'sanitize_callback' => 'esc_attr'
        ) );

        register_setting( 'general', 'qr_code_setting_height_id', array( 
            'sanitize_callback' => 'esc_attr'
        ) );
    }


    public function qr_width_settings_callback( $args ){

    }
}