<?php 

$options = array();

$options['fw_event']['sidebar']			= array(
											'label' =>__('Post Sidebar', THEME_NAME),
											'type' =>'dropdown',
											'info' => __( 'select the sidebar for the current post' , THEME_NAME),
											'validation'=>'',
											'value' => fw_sidebars_array(),
											'attrs'=>array('class' => ''),
										);
$options['fw_event']['event_banner_heading'] = array(
											'label' =>__('Banner Heading', THEME_NAME),
											'type' =>'input',
											'info' => __( 'Enter the banner heading for the current post' , THEME_NAME),
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['fw_event']['event_banner_image'] = array(
											'label' =>__('Banner Image', THEME_NAME),
											'type' =>'image',
											'info' => __( 'select the banner image for the current post' , THEME_NAME),
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['fw_event']['author_box'] = 		array(
											'label' =>__('Show / Hide Author Box', THEME_NAME),
											'type' =>'switch',
											'info' => __( 'show or hide author box for this post' , THEME_NAME),
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['fw_event']['event_organizer'] = array(
											'label' =>__('Event Organizer', THEME_NAME),
											'type' =>'input',
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['fw_event']['event_ticker_link'] = array(
											'label' =>__('Buy Ticket URL', THEME_NAME),
											'type' =>'input',
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['fw_event']['event_start'] = array(
											'label' =>__('Event Start time', THEME_NAME),
											'type' =>'input',
											'validation'=>'',
											'attrs'=>array('class' => 'input-small', 'id' => 'event_start_time'),
										);
$options['fw_event']['event_end'] = array(
											'label' =>__('Event End Time', THEME_NAME),
											'type' =>'input',
											'validation'=>'',
											'attrs'=>array('class' => 'input-small', 'id' => 'event_end_time'),
										);
$options['fw_event']['searchAddress'] = array(
											'label' =>__('Search Address', THEME_NAME),
											'type' =>'input',
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level', 'id' => 'searchTextField'),
											'settings'=> array('html'=>'<div id="map_canvas" style="width:100%; height: 200px;" class="clear"></div>'),
										);
$options['fw_event']['event_place'] = array(
											'label' =>__('Event Place', THEME_NAME),
											'type' =>'input',
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level', 'id' => 'event_place'),
										);
$options['fw_event']['lang'] = array(
											'label' =>__('Langitude', THEME_NAME),
											'type' =>'input',
											'validation'=>'',
											'attrs'=>array('class' => 'input-small', 'id' => 'lang'),
										);
$options['fw_event']['lat'] = array(
											'label' =>__('Latitude', THEME_NAME),
											'type' =>'input',
											'validation'=>'',
											'attrs'=>array('class' => 'input-small', 'id' => 'lat'),
										);
$options['post']['post_banner_heading'] = array(
											'label' =>__('Banner Heading', THEME_NAME),
											'type' =>'input',
											'info' => __( 'Enter the banner heading for the current post' , THEME_NAME),
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['post']['post_banner_image'] = array(
											'label' =>__('Banner Image', THEME_NAME),
											'type' =>'image',
											'info' => __( 'select the banner image for the current post' , THEME_NAME),
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['post']['sidebar'] = 			array(
											'label' =>__('Post Sidebar', THEME_NAME),
											'type' =>'dropdown',
											'info' => __( 'select the sidebar for the current post' , THEME_NAME),
											'validation'=>'',
											'value' => fw_sidebars_array(),
											'attrs'=>array('class' => ''),
										);
$options['post']['author_box'] = 		array(
											'label' =>__('Show / Hide Author Box', THEME_NAME),
											'type' =>'switch',
											'info' => __( 'show or hide author box for this post' , THEME_NAME),
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);



$options['fw_testimonial']['company'] = array(
											'label' =>__('Company Name', THEME_NAME),
											'type' =>'input',
											'info' => __( 'Enter the company name' , THEME_NAME),
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['fw_testimonial']['address'] = array(
											'label' =>__('Address', THEME_NAME),
											'type' =>'input',
											'info' => __( 'Enter the author address' , THEME_NAME),
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['fw_testimonial']['email'] = array(
											'label' =>__('Email', THEME_NAME),
											'type' =>'input',
											'info' => __( 'Enter email address of the author' , THEME_NAME),
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['fw_testimonial']['link'] = array(
											'label' =>__('Link', THEME_NAME),
											'type' =>'input',
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);



$options['page']['page_banner_heading'] = array(
											'label' =>__('Banner Heading', THEME_NAME),
											'type' =>'input',
											'info' => __( 'Enter the banner heading for the current post' , THEME_NAME),
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['page']['page_banner_image'] = array(
											'label' =>__('Banner Image', THEME_NAME),
											'type' =>'image',
											'info' => __( 'select the banner image for the current post' , THEME_NAME),
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['page']['sidebar']			= array(
											'label' =>__('Page Sidebar 1', THEME_NAME),
											'type' =>'dropdown',
											'info' => __( 'select the sidebar for the current page' , THEME_NAME),
											'validation'=>'',
											'value' => fw_sidebars_array(),
											'attrs'=>array('class' => ''),
										);

$options['page']['author_box'] = 		array(
											'label' =>__('Show / Hide Author Box', THEME_NAME),
											'type' =>'switch',
											'info' => __( 'show or hide author box for this post' , THEME_NAME),
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);
$options['page']['enable_comments']			= array(
											'label' =>__('Enable Comments', THEME_NAME),
											'type' =>'switch',
											'validation'=>'',
											'attrs'=>array('class' => 'input-block-level'),
										);




