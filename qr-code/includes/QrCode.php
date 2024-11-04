<?php
namespace ProMausd\QR_Code;

class QrCode {
     
    function __construct(){
        add_filter( 'the_content', [ $this, 'Qr_Code_Content' ] );

        add_action('admin_init', [ $this, 'qr_code_settings_options' ]);
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

    public function qr_code_settings_options() {
        add_settings_field(
            'qr_code_setting_width_id',
            __( 'Qr Code Width', 'qr-code' ),
            array( $this, 'qr_width_settings_callback' ), // Use array callback with $this
            'general'
        );
    
        add_settings_field(
            'qr_code_setting_height_id',
            __( 'Qr Code Height', 'qr-code' ),
            array( $this, 'qr_height_settings_callback' ), // Use array callback with $this
            'general'
        );
    
        register_setting( 'general', 'qr_code_setting_width_id', array( 
            'sanitize_callback' => 'esc_attr'
        ) );
    
        register_setting( 'general', 'qr_code_setting_height_id', array( 
            'sanitize_callback' => 'esc_attr'
        ) );
    }
    

    public function qr_width_settings_callback( $args ){
        $width = get_option( 'qr_code_setting_width_id' );
    
        // Correct the id and name attributes to match the width setting.
        printf( "<input type='text' id='%s' name='%s' value='%s' />", 'qr_code_setting_width_id', 'qr_code_setting_width_id', esc_attr( $width ) );
    }
    
    public function qr_height_settings_callback( $args ){
        $height = get_option( 'qr_code_setting_height_id' );
    
        // Use the height setting correctly here.
        printf( "<input type='text' id='%s' name='%s' value='%s' />", 'qr_code_setting_height_id', 'qr_code_setting_height_id', esc_attr( $height ) );
    }
    
}