<?php if ( ! defined('ABSPATH')) exit('restricted access');

//SUB, DYNAMIC
$options = array();

//settings
//string section, preview boleen, 
//section_heading = HEADING OF THE SECTION
/**
	DYNAMIC SECTION
	Use the section only in very first element
	Use tab to create the sub tabs
*/

//GENERAL SETTINGS

$options['general_settings']['SUB']['color_and_style']['style'] = array(
												'label' =>__('Color Scheme', THEME_NAME),
												'type' =>'colorbox',
												'info' => __( 'Select the default color scheme' , THEME_NAME),
												'validation'=>'',
												'std' => '#F2B636',
												'attrs'=>array('class' => 'nuke-color-field'),
											);
											
$options['general_settings']['SUB']['color_and_style']['heading_color'] = array(
												'label' =>__('Heading Color', THEME_NAME),
												'type' =>'colorbox',
												'info' => '',
												'validation'=>'',
												'attrs'=>array('class' => 'nuke-color-field'),
											);
$options['general_settings']['SUB']['color_and_style']['text_color'] = array(
												'label' =>__('Content Text Color', THEME_NAME),
												'type' =>'colorbox',
												'info' => __( 'Choose the color for normal text' , THEME_NAME),
												'validation'=>'',
												'attrs'=>array('class' => 'nuke-color-field'),
											);

$options['general_settings']['SUB']['general_settings']['comment_status'] = array(
												'label' =>__('Comment Captcha', THEME_NAME),
												'type' =>'switch',
												'info' => 'Show / Hide captcha on Comment Form',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);

$options['general_settings']['SUB']['general_settings']['gallery_view'] = array(
												'label' =>__('Default Gallery View', THEME_NAME),
												'type' =>'dropdown',
												'info' => '',
												'validation'=>'',
												'value' => array( 2 => 2, 3 => 3, 4 => 4),
												'attrs'=>array('class' => 'input-block-level'),
												'settings' => array('section_heading' => __('Gallery Settings', THEME_NAME))
											);
$options['general_settings']['SUB']['general_settings']['gallery_per_page'] = array(
												'label' =>__('Number of Images Per Page', THEME_NAME),
												'type' =>'input',
												'info' => __('Enter the number of images per page', THEME_NAME),
												'validation'=>'',
												'attrs'=>array('class' => 'input-small'),
											);
$options['general_settings']['SUB']['general_settings']['testi_status'] = array(
												'label' =>__('Status', THEME_NAME),
												'type' =>'switch',
												'info' => __('show or hide testimonials on homepage', THEME_NAME),
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
												'settings' => array('section_heading'=>__('Testimonial Settings', THEME_NAME ))
											);
$options['general_settings']['SUB']['general_settings']['testi_order'] = array(
												'label' =>__('Sorting Option', THEME_NAME),
												'type' =>'dropdown',
												'info' => __('Sorting order of testimonials on homepage', THEME_NAME),
												'validation'=>'',
												'value' => array( 'date' => 'Date', 'rand' => 'Random'),
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['general_settings']['SUB']['general_settings']['testi_number'] = array(
												'label' =>__('Number Testimonials', THEME_NAME),
												'type' =>'input',
												'validation'=>'',
												'info' => __('Number testimonials to show on homepage bottom area', THEME_NAME),
												'attrs'=>array('class' => 'input-block-level'),
											);
											
$options['general_settings']['SUB']['background']['type'] = array(
												'label' =>__('Background Type', THEME_NAME),
												'type' =>'radio',
												'info' => '',
												'validation'=>'',
												'value' => array('image'=>'Image', 'pattern' => 'Pattern'),
												'attrs'=>array('class' => ''),
											);
$options['general_settings']['SUB']['background']['bg_image'] = array(
												'label' =>__('Background Image', THEME_NAME),
												'type' =>'image',
												'info' => '',
												'validation'=>'valid_url',
												'attrs'=>array('placeholder'=>'Upload Background Image', 'class' => 'input-block-level'),
												'settings'=>array('preview'=>true),
											);
$options['general_settings']['SUB']['background']['patterns'] = array(
												'label' =>__('Patterns', THEME_NAME),
												'type' =>'patterns',
												'info' => '',
												'validation'=>'',
												'value' => array('pattern-1', 'pattern-2', 'pattern-3', 'pattern-4', 'pattern-5', 'pattern-6', 'pattern-7','pattern-8', 'pattern-9', 'pattern-10', 'pattern-11'),
												'attrs'=>array('class' => ''),
											);
$options['general_settings']['SUB']['background']['position'] = array(
												'label' =>__('Background Position', THEME_NAME),
												'type' =>'radio',
												'info' => '',
												'validation'=>'',
												'value' => array('left'=>'Left', 'right' => 'Right', 'center' => 'Center'),
												'attrs'=>array('class' => ''),
											);
$options['general_settings']['SUB']['background']['repeat'] = array(
												'label' =>__('Background Repeat', THEME_NAME),
												'type' =>'radio',
												'info' => '',
												'validation'=>'',
												'value' => array('no'=>'No Repeat', 'tile' => 'Tile', 'horizontal' => 'Tile Horizontally', 'vertical' => 'Tile Vertically'),
												'attrs'=>array('class' => ''),
											);
$options['general_settings']['SUB']['background']['attachment'] = array(
												'label' =>__('Background Attachment', THEME_NAME),
												'type' =>'radio',
												'info' => '',
												'validation'=>'',
												'value' => array('scroll'=>'Scroll', 'fixed' => 'Fixed'),
												'attrs'=>array('class' => ''),
											);
$options['general_settings']['SUB']['background']['color'] = array(
												'label' =>__('Background Color', THEME_NAME),
												'type' =>'colorbox',
												'info' => '',
												'validation'=>'',
												'attrs'=>array('class' => 'nuke-color-field'),
											);
$options['general_settings']['SUB']['logo']['logo'] = array(
												'label' =>__('Logo', THEME_NAME),
												'type' =>'image',
												'info' => '',
												'validation'=>'valid_url',
												'attrs'=>array('placeholder'=>'Upload logo', 'class' => 'input-block-level'),
												'settings'=>array('preview'=>true),
											);

											
$options['general_settings']['SUB']['header_settings']['favicon'] = array(
												'label' =>__('Favicon', THEME_NAME),
												'type' =>'image',
												'info' => __( 'Enter the .ico file URL or use upload option, <a href="http://en.wikipedia.org/wiki/Favicon" target="_blank"><strong>what is favicon?</strong></a>.' , THEME_NAME),
												'validation'=>'valid_url',
												'attrs'=>array('placeholder'=>'Upload Favicon', 'class' => 'input-block-level'),
												'settings'=>array('preview'=>true),
											);

$options['general_settings']['SUB']['header_settings']['twitter_status'] = array(
												'label' =>__('Status', THEME_NAME),
												'type' =>'switch',
												'info' => __( 'Enable / Disbale to hide and show twitter feed in header' , THEME_NAME),
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
												'settings' => array('section_heading'=> __('Twitter Feed', THEME_NAME)),
											);
$options['general_settings']['SUB']['header_settings']['tweet_number'] = array(
												'label' =>__('Number of Tweets', THEME_NAME),
												'type' =>'input',
												'info' => __( 'Enter the number of tweets to show' , THEME_NAME),
												'validation'=>'required',
												'std' => 5,
												'attrs'=>array('class' => 'input-small'),
											);
$options['general_settings']['SUB']['header_settings']['twitter_id'] = array(
												'label' =>__('Twitter ID', THEME_NAME),
												'type' =>'input',
												'info' => __( 'Enter the twitter ID to fetch feed ( e.g Wordpress )' , THEME_NAME),
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['general_settings']['SUB']['header_settings']['css_js'] = array(
												'label' =>__('Header CSS/JS', THEME_NAME),
												'type' =>'textarea',
												'info' => '',
												'validation'=>'stripslashes',
												'attrs'=>array('placeholder'=>'Header CSS/JS', 'class' => 'input-block-level'),
												'settings' => array('section_heading' => __('Header Script / Styles', THEME_NAME)),
											);
$options['general_settings']['SUB']['footer_settings']['logo'] = array(
												'label' =>__('Footer Logo', THEME_NAME),
												'type' =>'image',
												'info' => '',
												'validation'=>'valid_url',
												'attrs'=>array('placeholder'=>'upload Footer logo', 'class' => 'input-block-level'),
												'settings'=>array('preview'=>true),
											);
$options['general_settings']['SUB']['footer_settings']['copyrights'] = array(
												'label' =>__('Copyrights', THEME_NAME),
												'type' =>'textarea',
												'info' => '',
												'validation'=>'stripslashes',
												'attrs'=>array('placeholder'=>'Enter copyright text', 'class' => 'input-block-level'),
											);


$options['general_settings']['SUB']['footer_settings']['analytics'] = array(
												'label' =>__('Analytics Code', THEME_NAME),
												'type' =>'textarea',
												'info' => __( 'Insert the analytics code or custom scripts to include in footer', THEME_NAME ),
												'validation'=>'stripslashes',
												'attrs'=>array('placeholder'=>'Enter tracking code here', 'class' => 'input-block-level'),
											);




$options['general_settings']['SUB']['APIs']['twitter_key'] = array(
												'label' =>__('Consumer Key', THEME_NAME),
												'type' =>'input',
												'info' => __( 'Insert the twitter consumer key to fetch data' , THEME_NAME),
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
												'settings'=>array('section_heading'=>__('Twitter API Information')),
											);
$options['general_settings']['SUB']['APIs']['twitter_secret'] = array(
												'label' =>__('Consumer Secret', THEME_NAME),
												'type' =>'input',
												'info' => __( 'Insert the twitter consumer secret' , THEME_NAME),
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['general_settings']['SUB']['APIs']['twitter_token'] = array(
												'label' =>__('Token', THEME_NAME),
												'type' =>'input',
												'info' => __( 'Insert the twitter token' , THEME_NAME),
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['general_settings']['SUB']['APIs']['twitter_t_secret'] = array(
												'label' =>__('Twitter Token Secret', THEME_NAME),
												'type' =>'input',
												'info' => __( 'Insert the twitter token secret' , THEME_NAME),
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['general_settings']['SUB']['APIs']['recaptcha_key'] = array(
												'label' =>__('Recaptcha Public Key', THEME_NAME),
												'type' =>'input',
												'info' => __( 'Insert the recaptcha Public key' , THEME_NAME),
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
												'settings'=>array('section_heading'=>__('Recapctha Settings')),
											);
$options['general_settings']['SUB']['APIs']['recaptcha_p_key'] = array(
												'label' =>__('Recaptcha Private Key', THEME_NAME),
												'type' =>'input',
												'info' => __( 'Insert the recaptcha Private key' , THEME_NAME),
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['home_page_settings']['SUB']['home_page_slider']['status'] = array(
												'label' =>__('Show Slider', THEME_NAME),
												'type' =>'switch',
												'info' => __( 'Switch it on if you want to show slider at home page. If you switch it off it will not show slider at home page.' , THEME_NAME),
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['home_page_settings']['SUB']['home_page_slider']['home_revslider'] = array(
												'label' =>__('Revolution Slider', THEME_NAME),
												'type' =>'dropdown',
												'info' => 'Select revolution slider you have created to show on homepage',
												'validation'=>'',
												'value' => fw_get_rev_sliders(),
												'attrs'=>array('class' => 'input-block-level'),
											);


$options['home_page_settings']['SUB']['message_box']['msg_status'] = array(
												'label' =>__('Status', THEME_NAME),
												'type' =>'switch',
												'info' => '',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
												'settings'=>array('section_heading'=>__('Homepage Message Settings', THEME_NAME)),
											);

$options['home_page_settings']['SUB']['message_box']['msg_heading'] = array(
												'label' =>__('Heading', THEME_NAME),
												'type' =>'input',
												'info' => '',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['home_page_settings']['SUB']['message_box']['msg_text'] = array(
												'label' =>__('Message Text', THEME_NAME),
												'type' =>'textarea',
												'info' => '',
												'validation'=>'stripslashes',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['home_page_settings']['SUB']['upcoming_events']['number'] = array(
												'label' =>__('Number of Upcoming Events', THEME_NAME),
												'type' =>'input',
												'info' => __( 'Enter the number of upcoming events on homepage' , THEME_NAME),
												'validation'=>'',
												'attrs'=>array('class' => 'input-small'),
											);
$options['home_page_settings']['SUB']['upcoming_events']['title'] = array(
												'label' =>__('Title of Upcoming Events', THEME_NAME),
												'type' =>'input',
												'info' => __( 'Give the title to the upcoming events area on homepage.' , THEME_NAME),
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);

$options['blog_settings']['SUB']['blog_listing']['cat_banner_heading'] = array(
												'label' =>__('Banner Heading', THEME_NAME),
												'type' =>'input',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
												'settings'=>array('section_heading'=>__('Category Page', THEME_NAME) ),
											);
$options['blog_settings']['SUB']['blog_listing']['cat_banner_image'] = array(
												'label' =>__('Banner Image', THEME_NAME),
												'type' =>'image',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['blog_settings']['SUB']['blog_listing']['cat_sidebar'] = array(
												'label' =>__('Sidebar', THEME_NAME),
												'type' =>'dropdown',
												'validation'=>'',
												'value' => fw_sidebars_array(),
												'attrs'=>array('class' => 'input-block-level'),
											);

$options['blog_settings']['SUB']['blog_listing']['arc_banner_heading'] = array(
												'label' =>__('Banner Heading', THEME_NAME),
												'type' =>'input',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
												'settings'=>array('section_heading'=>__('Archive Page', THEME_NAME) ),
											);
$options['blog_settings']['SUB']['blog_listing']['arc_banner_image'] = array(
												'label' =>__('Banner Image', THEME_NAME),
												'type' =>'image',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['blog_settings']['SUB']['blog_listing']['arc_sidebar'] = array(
												'label' =>__('Sidebar', THEME_NAME),
												'type' =>'dropdown',
												'validation'=>'',
												'value' => fw_sidebars_array(),
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['blog_settings']['SUB']['blog_listing']['auth_banner_heading'] = array(
												'label' =>__('Banner Heading', THEME_NAME),
												'type' =>'input',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
												'settings'=>array('section_heading'=>__('Author Page', THEME_NAME) ),
											);
$options['blog_settings']['SUB']['blog_listing']['auth_banner_image'] = array(
												'label' =>__('Banner Image', THEME_NAME),
												'type' =>'image',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['blog_settings']['SUB']['blog_listing']['auth_sidebar'] = array(
												'label' =>__('Sidebar', THEME_NAME),
												'type' =>'dropdown',
												'validation'=>'',
												'value' => fw_sidebars_array(),
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['blog_settings']['SUB']['blog_listing']['tag_banner_heading'] = array(
												'label' =>__('Banner Heading', THEME_NAME),
												'type' =>'input',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
												'settings'=>array('section_heading'=>__('TAG Page', THEME_NAME) ),
											);
$options['blog_settings']['SUB']['blog_listing']['tag_banner_image'] = array(
												'label' =>__('Banner Image', THEME_NAME),
												'type' =>'image',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['blog_settings']['SUB']['blog_listing']['tag_sidebar'] = array(
												'label' =>__('Sidebar', THEME_NAME),
												'type' =>'dropdown',
												'validation'=>'',
												'value' => fw_sidebars_array(),
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['blog_settings']['SUB']['blog_listing']['search_banner_heading'] = array(
												'label' =>__('Banner Heading', THEME_NAME),
												'type' =>'input',
												'validation'=>'',
												'info' => __('Use %s to replace with search query, e.g. Your Search for %s', THEME_NAME),
												'attrs'=>array('class' => 'input-block-level'),
												'settings'=>array('section_heading'=>__('Search Page', THEME_NAME) ),
											);
$options['blog_settings']['SUB']['blog_listing']['search_banner_image'] = array(
												'label' =>__('Banner Image', THEME_NAME),
												'type' =>'image',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['blog_settings']['SUB']['blog_listing']['search_sidebar'] = array(
												'label' =>__('Sidebar', THEME_NAME),
												'type' =>'dropdown',
												'validation'=>'',
												'value' => fw_sidebars_array(),
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['blog_settings']['SUB']['blog_listing']['event_banner_heading'] = array(
												'label' =>__('Banner Heading', THEME_NAME),
												'type' =>'input',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
												'settings'=>array('section_heading'=>__('Events Page', THEME_NAME) ),
											);
$options['blog_settings']['SUB']['blog_listing']['event_banner_image'] = array(
												'label' =>__('Banner Image', THEME_NAME),
												'type' =>'image',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['blog_settings']['SUB']['blog_listing']['event_sidebar'] = array(
												'label' =>__('Sidebar', THEME_NAME),
												'type' =>'dropdown',
												'validation'=>'',
												'value' => fw_sidebars_array(),
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['blog_settings']['SUB']['detail_page']['post_banner_heading'] = array(
												'label' =>__('Banner Heading', THEME_NAME),
												'type' =>'input',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
												'settings'=>array('section_heading'=>__('Post Detail Page', THEME_NAME) ),
											);
$options['blog_settings']['SUB']['detail_page']['post_banner_image'] = array(
												'label' =>__('Banner Image', THEME_NAME),
												'type' =>'image',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['blog_settings']['SUB']['detail_page']['post_sidebar'] = array(
												'label' =>__('Default Sidebar', THEME_NAME),
												'type' =>'dropdown',
												'validation'=>'',
												'value' => fw_sidebars_array(),
												'attrs'=>array('class' => 'input-block-level'),
											);

$options['blog_settings']['SUB']['detail_page']['page_banner_heading'] = array(
												'label' =>__('Banner Heading', THEME_NAME),
												'type' =>'input',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
												'settings'=>array('section_heading'=>__('Wordpress Pages', THEME_NAME) ),
											);
$options['blog_settings']['SUB']['detail_page']['page_banner_image'] = array(
												'label' =>__('Banner Image', THEME_NAME),
												'type' =>'image',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['blog_settings']['SUB']['detail_page']['page_sidebar'] = array(
												'label' =>__('Default Sidebar', THEME_NAME),
												'type' =>'dropdown',
												'validation'=>'',
												'value' => fw_sidebars_array(),
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['blog_settings']['SUB']['detail_page']['event_banner_heading'] = array(
												'label' =>__('Banner Heading', THEME_NAME),
												'type' =>'input',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
												'settings'=>array('section_heading'=>__('Event Detail Page', THEME_NAME) ),
											);
$options['blog_settings']['SUB']['detail_page']['event_banner_image'] = array(
												'label' =>__('Banner Image', THEME_NAME),
												'type' =>'image',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['blog_settings']['SUB']['detail_page']['event_sidebar'] = array(
												'label' =>__('Default Sidebar', THEME_NAME),
												'type' =>'dropdown',
												'validation'=>'',
												'value' => fw_sidebars_array(),
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['blog_settings']['SUB']['detail_page']['gal_banner_heading'] = array(
												'label' =>__('Banner Heading', THEME_NAME),
												'type' =>'input',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
												'settings'=>array('section_heading'=>__('Gallery Page', THEME_NAME) ),
											);
$options['blog_settings']['SUB']['detail_page']['gal_banner_image'] = array(
												'label' =>__('Banner Image', THEME_NAME),
												'type' =>'image',
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);

$options['contact_page_settings']['SUB']['contact_page_settings']['sidebar'] = array(
												'label' =>__('Contact Page Sidebar', THEME_NAME),
												'type' =>'dropdown',
												'info' => __('Choose sidebar for contact page', THEME_NAME),
												'validation'=>'',
												'value' => fw_sidebars_array(),
												'attrs'=>array('class' => 'input-small'),
											);
$options['contact_page_settings']['SUB']['contact_page_settings']['google_map_status'] = array(
												'label' =>__('Google Map Status', THEME_NAME),
												'type' =>'switch',
												'info' => __( 'Show / Hide Google map on contact page' , THEME_NAME),
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['contact_page_settings']['SUB']['contact_page_settings']['google_map'] = array(
												'label' =>__('Google Map Code', THEME_NAME),
												'type' =>'textarea',
												'info' => __( 'Insert google map code with &lt;ifram&gt; tag' , THEME_NAME),
												'validation'=>'stripslashes',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['contact_page_settings']['SUB']['contact_page_settings']['captcha_status'] = array(
												'label' =>__('Anti Spam', THEME_NAME),
												'type' =>'switch',
												'info' => __( 'Enable / Disable antispam captcha, You need to add <a href="http://google.com/recaptcha">google recaptcha</a> keys' , THEME_NAME),
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['contact_page_settings']['SUB']['contact_page_settings']['contact_email'] = array(
												'label' =>__('Contact Email', THEME_NAME),
												'type' =>'input',
												'info' => __( 'Insert email ID where contact email should be shouted' , THEME_NAME),
												'validation'=>'valid_email',
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['contact_page_settings']['SUB']['contact_page_settings']['success_msg'] = array(
												'label' =>__('Success Message', THEME_NAME),
												'type' =>'textarea',
												'info' => __( 'Insert custom success message for contact form submission' , THEME_NAME),
												'validation'=>'stripslashes',
												'attrs'=>array('class' => 'input-block-level'),
											);

$options['fonts']['SUB']['fonts_settings']['font_api_key'] = array(
												'label' =>__('Google Font API Key', THEME_NAME),
												'type' =>'input',
												'info' => __( 'Over 651+ Google fonts included. Please <a href="javascript:void(0);" id="google_font_update">Click Here</a> to update latest fonts from google' , THEME_NAME),
												'validation'=>'',
												'value' => array('option1'=>'option 1','option2'=>'option 2','option3'=>'option 3',),
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['fonts']['SUB']['fonts_settings']['font_family'] = array(
												'label' =>__('Font Familly', THEME_NAME),
												'type' =>'dropdown',
												'info' => __( 'Over 651+ Google fonts included' , THEME_NAME),
												'validation'=>'',
												'value' => google_fonts_array(),
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['fonts']['SUB']['fonts_settings']['content_family'] = array(
												'label' =>__('Content Font Familly', THEME_NAME),
												'type' =>'dropdown',
												'info' => '',
												'validation'=>'',
												'value' => google_fonts_array(),
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['fonts']['SUB']['fonts_settings']['h1'] = array(
												'label' =>__('H1 Font Size', THEME_NAME),
												'type' =>'input',
												'info' => '',
												'validation'=>'',
												'attrs'=>array('class' => 'input-small'),
											);
$options['fonts']['SUB']['fonts_settings']['h2'] = array(
												'label' =>__('H2 Font Size', THEME_NAME),
												'type' =>'input',
												'info' => '',
												'validation'=>'',
												'attrs'=>array('class' => 'input-small'),
											);
$options['fonts']['SUB']['fonts_settings']['h3'] = array(
												'label' =>__('H3 Font Size', THEME_NAME),
												'type' =>'input',
												'info' => '',
												'validation'=>'',
												'attrs'=>array('class' => 'input-small'),
											);
$options['fonts']['SUB']['fonts_settings']['h4'] = array(
												'label' =>__('H4 Font Size', THEME_NAME),
												'type' =>'input',
												'info' => '',
												'validation'=>'',
												'attrs'=>array('class' => 'input-small'),
											);
$options['fonts']['SUB']['fonts_settings']['h5'] = array(
												'label' =>__('H5 Font Size', THEME_NAME),
												'type' =>'input',
												'info' => '',
												'validation'=>'',
												'attrs'=>array('class' => 'input-small'),
											);
$options['fonts']['SUB']['fonts_settings']['body'] = array(
												'label' =>__('Body Content Font Size', THEME_NAME),
												'type' =>'input',
												'info' => '',
												'validation'=>'',
												'attrs'=>array('class' => 'input-small'),
											);
$options['sidebars']['SUB']['sidebars']['sidebar'] = array(
												'label' =>__('Create Sidebar', THEME_NAME),
												'type' =>'input',
												'info' => '',
												'validation'=>'',
												'attrs'=>array('class' => 'input-small'),
											);




$options['language']['SUB']['choose_language']['language'] = array(
												'label' =>__('Select Language', THEME_NAME),
												'type' =>'dropdown',
												'info' => __('Select the langauge which are uploaded in language directory', THEME_NAME),
												'validation'=>'',
												'value' => fw_get_languages(FW_LANG_DIR),
												'attrs'=>array('class' => 'input-block-level'),
											);
$options['language']['SUB']['upload_new_language']['language'] = array(
												'label' =>__('Upload Language', THEME_NAME),
												'type' =>'file',
												'info' => __('Upload .mo language file', THEME_NAME),
												'validation'=>'callback_ext[mo]',
												'attrs'=>array('class' => 'input-block-level', 'id'=>'file_upload'),
												'settings' => array('directory'=>get_template_directory().'/languages'),
											);

$options['social_networking']['SUB']['social_networking']['SOCIAL']['social'] = array(
												'label' =>__('Upload Language', THEME_NAME),
												'type' =>'social',
												'info' => __('Upload .mo language file', THEME_NAME),
												'validation'=>'',
												'attrs'=>array('class' => 'input-block-level', 'id'=>'file_upload'),
												'settings' => array(),
											);







