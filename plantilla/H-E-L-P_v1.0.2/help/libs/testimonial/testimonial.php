<?php

// Register Custom Post Type
function fw_testimonial_post_type() {
	
	$labels = array(
		'name'                => _x( 'Testimonials', 'Testimonials', THEME_NAME ),
		'singular_name'       => _x( 'Testimonial', 'Testimonial', THEME_NAME ),
		'menu_name'           => __( 'Testimonials', THEME_NAME ),
		'parent_item_colon'   => __( 'Parent Testimonial:', THEME_NAME ),
		'all_items'           => __( 'All Testimonials', THEME_NAME ),
		'view_item'           => __( 'View Testimonial', THEME_NAME ),
		'add_new_item'        => __( 'Add New Testimonial', THEME_NAME ),
		'add_new'             => __( 'New Testimonial', THEME_NAME ),
		'edit_item'           => __( 'Edit Testimonial', THEME_NAME ),
		'update_item'         => __( 'Update Testimonial', THEME_NAME ),
		'search_items'        => __( 'Search Testimonials', THEME_NAME ),
		'not_found'           => __( 'No Testimonials found', THEME_NAME ),
		'not_found_in_trash'  => __( 'No Testimonials found in Trash', THEME_NAME ),
	);

	$rewrite = array(
		'slug'                => 'testimonial',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => false,
	);

	$args = array(
		'label'               => __( 'Testimonial', THEME_NAME ),
		'description'         => __( 'Custom post type Testimonial is used to create Testimonials', THEME_NAME ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => false,
		'menu_position'       => 5,
		'menu_icon'           => get_template_directory_uri().'/images/testimonial.png',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);

	register_post_type( 'fw_testimonial', $args );
}


// Hook into the 'init' action
add_action( 'init', 'fw_testimonial_post_type' );



