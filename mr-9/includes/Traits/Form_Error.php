<?php 
namespace Promasud\MR_9\Traits;

trait Form_Error {
    
    public $errors = []; 

    public function has_error( $key ){
        return isset( $this->errors[ $key ] ) ? true : false;
    }

    public function get_errors( $key ){

        if(isset(  $this->errors[ $key ] )){
            return  $this->errors[ $key ];
        }

        return false;
    }
}