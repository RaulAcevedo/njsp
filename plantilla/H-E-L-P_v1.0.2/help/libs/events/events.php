<?php 

// Register Custom Post Type
function fw_event_post_type() {
	
	$labels = array(
		'name'                => _x( 'Events', 'Events', THEME_NAME ),
		'singular_name'       => _x( 'Event', 'Event', THEME_NAME ),
		'menu_name'           => __( 'Events', THEME_NAME ),
		'parent_item_colon'   => __( 'Parent Event:', THEME_NAME ),
		'all_items'           => __( 'All Events', THEME_NAME ),
		'view_item'           => __( 'View Event', THEME_NAME ),
		'add_new_item'        => __( 'Add New Event', THEME_NAME ),
		'add_new'             => __( 'New Event', THEME_NAME ),
		'edit_item'           => __( 'Edit Event', THEME_NAME ),
		'update_item'         => __( 'Update Event', THEME_NAME ),
		'search_items'        => __( 'Search Events', THEME_NAME ),
		'not_found'           => __( 'No Events found', THEME_NAME ),
		'not_found_in_trash'  => __( 'No Events found in Trash', THEME_NAME ),
	);

	$rewrite = array(
		'slug'                => 'event',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => false,
	);

	$args = array(
		'label'               => __( 'Event', THEME_NAME ),
		'description'         => __( 'Custom post type Event is used to create events', THEME_NAME ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => false,
		'menu_position'       => 5,
		'menu_icon'           => get_template_directory_uri().'/images/event.png',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		//'taxonomies'		  => array('event_category'),
		'capability_type'     => 'post',
	);

	register_post_type( 'fw_event', $args );
	
	
	register_taxonomy('event_category', 'fw_event', array(
			'hierarchical' => true,
			'labels' => array(
				'name' => _x( 'Event Categories', 'Event Categories', THEME_NAME ),
				'singular_name' => _x( 'Event Category', 'Event Category', THEME_NAME ),
				'search_items' =>  __( 'Search Event Categories', THEME_NAME ),
				'all_items' => __( 'All Event Categories', THEME_NAME ),
				'parent_item' => __( 'Parent Event Category', THEME_NAME ),
				'parent_item_colon' => __( 'Parent Event Category:', THEME_NAME ),
				'edit_item' => __( 'Edit Event Category' , THEME_NAME),
				'update_item' => __( 'Update Event Category', THEME_NAME ),
				'add_new_item' => __( 'Add New Event Category', THEME_NAME ),
				'new_item_name' => __( 'New Event Category Name', THEME_NAME ),
				'menu_name' => __( 'Event Category', THEME_NAME ),
			),
			'rewrite' => array(
				'slug' => 'event-category', /** This controls the base slug that will display before each term */
				'with_front' => false, /** Don't display the category base before "/galleries/" */
				'hierarchical' => true /** This will allow URL's like "/galleries/videos/youtube/" */
			),
		));
		
		
}

// Hook into the 'init' action
add_action( 'init', 'fw_event_post_type' );



