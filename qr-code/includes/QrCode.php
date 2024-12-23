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

        $width = get_option( 'qr_code_setting_width_id' );
        $width = $width ? $width : '150';
        $height = get_option( 'qr_code_setting_height_id' );
        $height = $height ? $height : '150';

        $dimension  = apply_filters( 'qr_code_image_dimension', "{$width}x{$height}" );
        $attr  = apply_filters( 'qr_code_image_attr', '' );

        $src = sprintf( "https://api.qrserver.com/v1/create-qr-code/?size=%s&data=%s",  $dimension, $post_permalink );

        $content .= sprintf( "<img %s src='%s' alt='%s'>", $attr, $src, $post_title );

        return $content;
    }

    public function qr_code_settings_options() {

        add_settings_section(
        'qr_setting_section',
        'Qr Code Settings Fields',
        [ $this, 'qr_code_setting_section_callback_function'],
        'general'
        );

        add_settings_field(
            'qr_code_setting_width_id',
            __( 'Qr Code Width', 'qr-code' ),
            array( $this, 'qr_width_settings_callback' ), // Use array callback with $this
            'general',
            'qr_setting_section'
        );
    
        add_settings_field(
            'qr_code_setting_height_id',
            __( 'Qr Code Height', 'qr-code' ),
            array( $this, 'qr_height_settings_callback' ), // Use array callback with $this
            'general',
            'qr_setting_section'
        );
    
        register_setting( 'general', 'qr_code_setting_width_id', array( 
            'sanitize_callback' => 'esc_attr'
        ) );
    
        register_setting( 'general', 'qr_code_setting_height_id', array( 
            'sanitize_callback' => 'esc_attr'
        ) );
    }
    
    public function qr_code_setting_section_callback_function(){
        echo "<p>" . esc_html('Qr Code Options') . "</p>";
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