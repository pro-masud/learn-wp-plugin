<?php
    /**
     * Plugin Name: MR9
     * version: 1.0.0
     * Description: Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, similique!
     * Author: MR9
     * Author URI: promasudbd@gmail.com
     * Text Domain: mr-9 
     * Domain Path:/language
     * */ 

    /**
     * #-01MR9 Plugin Text Domain loaded user defiends creation
     * #-02 load plugin text domain action hook add
     * 
    */
     add_action("plugins_loaded", "mr9_text_domain_loaded_files");

     function mr9_text_domain_loaded_files(){
        load_plugin_textdomain("mr-9", false, dirname(__FILE__). "./language");
     }
?>
