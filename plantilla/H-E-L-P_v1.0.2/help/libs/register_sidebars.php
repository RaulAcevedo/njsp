<?php if ( ! defined('ABSPATH')) exit('restricted access'); 

add_action( 'widgets_init', 'theme_register_sidebars' );

function theme_register_sidebars()
{	
	global $_webnukes;
	
	//EXAMPLE HOW TO REGISTER SIDEBAR
	
	/** Blog Sidebar */
	
	register_sidebar(
		array( 'id' => 'homepage-sidebar1',
			'name' => __( 'Homepage Sidebar 1', THEME_NAME ),
			'description' => 'Widgets in this area will be shown on homepage sidebar.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>'
		)
	);
	
	register_sidebar(
		array( 'id' => 'homepage-sidebar2',
			'name' => __( 'Homepage Sidebar 2', THEME_NAME ),
			'description' => 'Widgets in this area will be shown on homepage sidebar.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>'
		)
	);
	
	register_sidebar(
		array( 'id' => 'blog-sidebar',
			'name' => __( 'Blog Sidebar', THEME_NAME ),
			'description' => 'Widgets in this area will be shown on the blog pages.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>'
		)
	);
	
	register_sidebar(
		array( 'id' => 'footer-sidebar',
			'name' => __( 'Footer Sidebar', THEME_NAME ),
			'description' => 'Widgets in this area will be shown on the footer area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>'
		)
	);
	
	/** Create dynamic sidebars */
	$settings = $_webnukes->fw_get_settings('sub_sidebars');
	$sidebars = array_filter((array)kvalue( kvalue( $settings, 'DYNAMIC'), 'create_sidebar'));

	
	if($sidebars && is_array( $sidebars ))
	{

		foreach($sidebars as $val)
		{
			$id = texttoslug($val);
			
			//$id = ($_webnukes->kvalue($val,'id')) ? $val['id'] : 'dynamic-sidebar'.$key;

			/** Register Dynamic Sidebar */
			register_sidebar(
				array( 'id' => $id,
					'name' => $val,
					'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h2>',
					'after_title' => '</h2>'
				)
			);
		}
		
	}
	global $wp_registered_sidebars;
	update_option('wp_registered_sidebars', $wp_registered_sidebars);
}



/**
 * Function is used to load dynamically created sidebars
 *
 * @param	string		$tpl_name		Name of WP template file where do you want to show the sidebar
 * @param	string		$default		id/Name of the default sidebar if provided $tpl_name doesn't find.
 * @return	string						prints the dyanmic created html of sidebar if found else prints nothing
 */
function _load_dynamic_sidebar($tpl_name, $default = 'blog-sidebar')
{
	global $_webnukes, $post;

	$settings = $_webnukes->fw_get_settings('sub_blog_listing');
	//printr($settings);
	$post_type = kvalue( $post, 'post_type');
	$custom_posts = array( 'post', 'page', 'fw_event', 'fw_audio', 'fw_singer' );
	$sidebar = '';
	if( in_array( $post_type, $custom_posts ) ) 
	{
		$meta = get_post_meta( get_the_ID(), 'wpnukes_'.$post_type.'_settings', true);

		$sidebar = kvalue( $meta, 'sidebar');
		if( !$sidebar ) {
			$sidebar = $GLOBALS['_webnukes']->fw_get_settings( 'sub_detail_page', $tpl_name );
		}
	}
	
	$sidebar = ( !$sidebar ) ? kvalue( $settings, $tpl_name ) : $sidebar;

	if( $sidebar ) 
	{
		if(is_active_sidebar($sidebar)) dynamic_sidebar($sidebar);
	}else dynamic_sidebar($default);

}