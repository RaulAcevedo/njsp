<?php if ( ! defined('ABSPATH')) exit('restricted access');
//$vid = &$GLOBALS['_wpnukes_videos'];

$default_settings = array(
							'blog' => array('title'=>'Blog','min-col'=>1,'max-col'=>4),
							'testimonials' => array('title'=>'Testimonials','min-col'=>1,'max-col'=>4),

							'content' => array('title'=>'Cotents','min-col'=>1,'max-col'=>4),
							'gallery' => array('title'=>'Gallery','min-col'=>1,'max-col'=>4),
							'events' => array('title'=>'Upcoming Events','min-col'=>1,'max-col'=>4),

							'contactus' => array('title'=>'Contact Us','min-col'=>1,'max-col'=>4),

							'heading' => array('title'=>'Heading','min-col'=>1,'max-col'=>4, 'delete'=>false),
						);
$options = array();


$options['gallery']['gal_id'] = array(
										'label' => __('Gallery Post', THEME_NAME),
										'type' =>'dropdown',
										'info' => __('Select the gallery post to show its attachments or videos', THEME_NAME),
										'validation'=>'',
										'std' => '8',
										'value' => fw_get_post_array(array('post_type'=>'wpnukes_galleries', 'show_rand'=>false)),
										'attrs'=>array('class' => ''),
									);
$options['gallery']['number'] = array(
										'label' => __('Number of Images per Page', THEME_NAME),
										'type' =>'input',
										'info' => __('Enter number of image to show page page', THEME_NAME),
										'validation'=>'',
										'std' => '8',
										'attrs'=>array('class' => 'input-small'),
									);
$options['gallery']['columns'] = array(
										'label' => __('Number of Columns', THEME_NAME),
										'type' =>'dropdown',
										'info' => __('select the number of columns for gallery', THEME_NAME),
										'validation'=>'',
										'std' => '4',
										'value' => array( 2 => 2, 3 => 3, 4 => 4 ),
										'attrs'=>array('class' => ''),
									);
$options['gallery']['cols'] = array(
										'type' =>'hidden',
										'std' =>'1',
										'attrs'=>array('class' => 'widget_cols'),
									);
$options['content']['content'] = array(
										'label' => __('Content', THEME_NAME),
										'type' =>'textarea',
										'validation'=>'',
										'std' => '',
										'attrs'=>array('class' => 'input-block-level'),
									);
$options['content']['cols'] = array(
										'type' =>'hidden',
										'std' =>'1',
										'attrs'=>array('class' => 'widget_cols'),
									);




$options['heading']['tag'] = array(
										'label' => __('Heading Tag', THEME_NAME),
										'type' =>'dropdown',
										'validation'=>'',
										'std' => '2',
										'value' => array('1' => 'H1', '2' => 'H2', '3' => 'H3', '4' => 'H4', '5' => 'H5', '6' => 'H6'),
										'attrs'=>array('class' => 'input-small'),
									);
$options['heading']['heading'] = array(
										'label' => __('Heading', THEME_NAME),
										'type' =>'input',
										'validation'=>'',
										'std' => '',
										'attrs'=>array('class' => 'input-small'),
									);
$options['heading']['cols'] = array(
										'type' =>'hidden',
										'std' =>'1',
										'attrs'=>array('class' => 'widget_cols'),
									);

$options['contactus']['title'] = 	array(
										'label' => __('Title', THEME_NAME),
										'type' =>'input',
										'validation'=>'',
										'std' => '',
										'attrs'=>array('class' => 'input-block-level'),
									);
$options['contactus']['cols'] = array(
										'type' =>'hidden',
										'std' =>'1',
										'attrs'=>array('class' => 'widget_cols'),
									);
$options['blog']['category'] = array(
										'label' => __('Category', THEME_NAME),
										'type' =>'dropdown',
										'info' => 'Select the category for blog post',
										'validation'=>'',
										'std' => '8',
										'value' => fw_get_categories(),
									);
$options['blog']['number'] = array(
										'label' => __('Number of Posts', THEME_NAME),
										'type' =>'input',
										'info' => __('Enter number of blog posts to show', THEME_NAME),
										'validation'=>'',
										'std' => '5',
										'attrs'=>array('class' => 'input-small'),
									);
$options['blog']['cols'] = array(
										'type' =>'hidden',
										'std' =>'4',
										'attrs'=>array('class' => 'widget_cols'),
									);


$options['events']['title'] = array(
										'label' => __('Heading', THEME_NAME),
										'type' =>'input',
										'info' => __('Enter Heading of the event area', THEME_NAME),
										'validation'=>'',
										'std' => 'Upcoming Events',
										'attrs'=>array('class' => 'input-block-level'),
									);
$options['events']['number'] = array(
										'label' => __('Number of Events', THEME_NAME),
										'type' =>'input',
										'info' => __('Enter number of events to show', THEME_NAME),
										'validation'=>'',
										'std' => '5',
										'attrs'=>array('class' => 'input-small'),
									);
$options['events']['cols'] = array(
										'type' =>'hidden',
										'std' =>'4',
										'attrs'=>array('class' => 'widget_cols'),
									);
									
$options['testimonials']['number'] = array(
										'label' => __('Number of Testimonials', THEME_NAME),
										'type' =>'input',
										'std' =>'4',
										'attrs'=>array('class' => 'widget_cols'),
									);
$options['testimonials']['cols'] = array(
										'type' =>'hidden',
										'std' =>'4',
										'attrs'=>array('class' => 'widget_cols'),
									);







