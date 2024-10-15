<?php 
namespace Promasud\MR_9;

class Installers{
    
    public function run(){

        $this->add_version();
        $this->create_table();
        
    }


    public function add_version(){
        $installed = get_option('mr_9_installed');

        if ( ! $installed ) {
            update_option('mr_9_installed', time());
        }

        update_option('mr_9_version', MR_9_VERSION); // Corrected here
    }

    public function create_table(){
      
    }
}