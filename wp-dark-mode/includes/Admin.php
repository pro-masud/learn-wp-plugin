<?php
namespace Promasud\WpDarkMode;

class Admin {
    
    public function __construct() {
        $this->init_menus();
    }

    /**
     * Initializes the admin menus.
     */
    public function init_menus() {
        if ( class_exists( 'Promasud\WpDarkMode\Admin\Menus' ) ) {
            new Admin\Menus();
        } else {
            // Optional: Log an error or fallback
            error_log( 'Class Promasud\WpDarkMode\Admin\Menus not found!' );
        }
    }
}
