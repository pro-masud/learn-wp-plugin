<?php

class SimpleCRUD {

    public function __construct() {
        add_action('admin_menu', [$this, 'simple_crud_admin_display_add']);
    }

    public function simple_crud_admin_display_add() {
        $capabality = 'manage_options';
        $slug = 'simple-crud';

        // Add a Menu
        add_menu_page(
            __( 'Simple CRUD', 'simple-crud' ),     // Page title
            __( 'Simple CRUD', 'simple-crud' ),     // Menu title
            $capabality,                            // Capability
            $slug,                                  // Menu slug
            [$this, 'simple_crud_admin_page'],      // Callback function
            'dashicons-admin-generic',              // Icon URL or Dashicons class
            100                                     // Position in the menu
        );

        // Add a submenu
        add_submenu_page(
            $slug,                                  // Parent slug
            'Student List',                         // Page title
            'Student List',                         // Menu title
            $capabality,                            // Capability
            'simple-crud-add',                      // Submenu slug
            [$this, 'simple_crud_submenu_page_add'] // Callback function
        );
    }

    public function simple_crud_admin_page() {
        echo '<h1>Simple CRUD Admin Page</h1>';
        echo '<p>Welcome to the Simple CRUD plugin.</p>';
    }

    public function simple_crud_submenu_page_add() {
        echo '<h1>Simple CRUD Submenu Page</h1>';
        echo '<p>This is the submenu under the Simple CRUD plugin.</p>';
    }
}

// Instantiate the class
if( is_admin() ){
    new SimpleCRUD();
}
