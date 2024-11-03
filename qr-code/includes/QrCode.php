<?php
namespace ProMausd\QR_Code;

class QrCode {
     
    function __construct(){
        add_filter( 'the_content', 'Qr_Code_Content' );
    }


    public function Qr_Code_Content( $content ){

    }
}