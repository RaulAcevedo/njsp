<?php if ( ! defined('ABSPATH')) exit('restricted access');

/** Theme settings note: don't remove it */
define('THEME_NAME', 'fw_help');
define('FRAME_WORK', 'Version 1.0');
define ('FW_LANG_DIR', get_template_directory().'/languages' );
/** Initialize the WPnukes Apanel */
require_once('includes/launcher.php');

get_template_part('theme_functions');

/** Load the default functions after theme setup */
add_action('after_setup_theme', 'wl_theme_setup');

function wl_theme_setup()
{
	/** Add languages support */
	load_theme_textdomain(THEME_NAME, THEME_PATH .'/languages');
	
	/** Allows theme developers to link a custom stylesheet file to the TinyMCE visual editor. default(style.css) */
	add_editor_style();
	
	register_nav_menus(array('main_menu'=>__('Main Menu', THEME_NAME), 'bottom_menu' => __('Bottom Menu', THEME_NAME)));
	
	fw_create_donation_table();
}

/** Set the width of images and content. Should be equal to the width the theme	*/
$content = (isset($content_width)) ? $content_width : 613;

/** Add feed link support */
add_theme_support( 'automatic-feed-links' );

/** Post thumnail Support and add new sizes that themes is required */
add_theme_support('post-thumbnails');

//Example Code
add_image_size('events-top', 870, 290, true );
add_image_size( 'gallery-col', 570, 320, true );
add_image_size( 'events-small', 111, 84, true );
add_image_size( 'gallery-widget', 62, 62, true );

/** include theme scripts and styles */
get_template_part('libs/scripts_styles');

/** include theme breadcrumbs */
get_template_part('libs/breadcrumbs');

/** include theme register sidebars */
get_template_part('libs/register_sidebars');

/** include theme widgets */
get_template_part('libs/widgets');