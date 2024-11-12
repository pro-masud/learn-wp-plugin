<?php 
// Register Custom Post Type
function wp_slider_carousel_post_type() {

	$labels = array(
		'name'                  => _x( 'Wp Sliders', 'Post Type General Name', 'wp-slider' ),
		'singular_name'         => _x( 'Wp Slider Carousel', 'Post Type Singular Name', 'wp-slider' ),
		'menu_name'             => __( 'Wp Sliders', 'wp-slider' ),
		'name_admin_bar'        => __( 'Wp Slider', 'wp-slider' ),
		'archives'              => __( 'Slider Archives', 'wp-slider' ),
		'attributes'            => __( 'Slider Attributes', 'wp-slider' ),
		'parent_item_colon'     => __( 'Parent Item:', 'wp-slider' ),
		'all_items'             => __( 'All Sliders', 'wp-slider' ),
		'add_new_item'          => __( 'Add New Slider', 'wp-slider' ),
		'add_new'               => __( 'Add New Slider', 'wp-slider' ),
		'new_item'              => __( 'New Slider', 'wp-slider' ),
		'edit_item'             => __( 'Edit Slider', 'wp-slider' ),
		'update_item'           => __( 'Update Slider', 'wp-slider' ),
		'view_item'             => __( 'View Slider', 'wp-slider' ),
		'view_items'            => __( 'View Sliders', 'wp-slider' ),
		'search_items'          => __( 'Search Slider', 'wp-slider' ),
		'not_found'             => __( 'Not found Slider', 'wp-slider' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wp-slider' ),
		'featured_image'        => __( 'Slider Image', 'wp-slider' ),
		'set_featured_image'    => __( 'Set Slider image', 'wp-slider' ),
		'remove_featured_image' => __( 'Remove Slider image', 'wp-slider' ),
		'use_featured_image'    => __( 'Use as Slider image', 'wp-slider' ),
		'insert_into_item'      => __( 'Insert into Slider', 'wp-slider' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Slider', 'wp-slider' ),
		'items_list'            => __( 'Sliders list', 'wp-slider' ),
		'items_list_navigation' => __( 'Sliders list navigation', 'wp-slider' ),
		'filter_items_list'     => __( 'Filter Sliders list', 'wp-slider' ),
	);
	$args = array(
		'label'                 => __( 'Wp Slider Carousel', 'wp-slider' ),
		'description'           => __( 'This is a Wp Slider Post Type', 'wp-slider' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( 'wp_slider_cat' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'wp_slider_carousel', $args );

}
add_action( 'init', 'wp_slider_carousel_post_type', 0 );

// Register Custom Taxonomy
function wp_slider_cat_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Slider Categories', 'Taxonomy General Name', 'wp-slider' ),
		'singular_name'              => _x( 'Slider Category', 'Taxonomy Singular Name', 'wp-slider' ),
		'menu_name'                  => __( 'Slider Categories', 'wp-slider' ),
		'all_items'                  => __( 'All Categories', 'wp-slider' ),
		'parent_item'                => __( 'Parent Category', 'wp-slider' ),
		'parent_item_colon'          => __( 'Parent Category:', 'wp-slider' ),
		'new_item_name'              => __( 'New Category Name', 'wp-slider' ),
		'add_new_item'               => __( 'Add New Category', 'wp-slider' ),
		'edit_item'                  => __( 'Edit Category', 'wp-slider' ),
		'update_item'                => __( 'Update Category', 'wp-slider' ),
		'view_item'                  => __( 'View Category', 'wp-slider' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'wp-slider' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'wp-slider' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wp-slider' ),
		'popular_items'              => __( 'Popular Categories', 'wp-slider' ),
		'search_items'               => __( 'Search Categories', 'wp-slider' ),
		'not_found'                  => __( 'Not Found', 'wp-slider' ),
		'no_terms'                   => __( 'No categories', 'wp-slider' ),
		'items_list'                 => __( 'Categories list', 'wp-slider' ),
		'items_list_navigation'      => __( 'Categories list navigation', 'wp-slider' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'wp_slider_cat', array( 'wp_slider_carousel' ), $args );

}
add_action( 'init', 'wp_slider_cat_taxonomy', 0 );
