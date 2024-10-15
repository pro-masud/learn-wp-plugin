<?php 
namespace Promasud\MR_9;

/**
 * 
 * 
 * 
 * */ 
class Installers{
    
    public function run(){

        $this->add_version();
        $this->create_table();
        
    }

    /**
     * 
     * Plugin Version Check 
     * 
     * */ 
    public function add_version(){
        $installed = get_option('mr_9_installed');

        if ( ! $installed ) {
            update_option('mr_9_installed', time());
        }

        update_option('mr_9_version', MR_9_VERSION); // Corrected here
    }


    /**
     * 
     * Create a Database Table Create Table Function
     * 
     * */ 

    public function create_table(){
        
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $schema = " CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}mr9_addresses` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(100) NOT NULL DEFAULT '',
            `address` varchar(255) DEFAULT NULL,
            `phone` varchar(30) DEFAULT NULL,
            `create_by` bigint(20) unsigned NOT NULL,
            `created_at` datetime NOT NULL,
            PRIMARY KEY (`id`)
        ) $charset_collate";

        if( ! function_exists( 'dbDelta' )){
            require_once ABSPATH . 'wp-admin/includes/upgrade.php'; 
        }

        dbDelta($schema);
    }
}