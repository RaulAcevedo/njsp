<?php if ( ! defined('ABSPATH')) exit('restricted access');
/** Backend settings for symptom checker */
// @TODO: Add validation support
$options = array();

							
$options['sidebar'] = array(
							'label'=>__('Gallery With Sidebar', THEME_NAME),
							'type'=>'dropdown',
							'value'=>array('active'=>'Active','inactive'=>'Inactive'),
							'validation'=>'required',
							'std'=>'active',
							'info'=>__('Active or Inactive Sidebar on gallery.', THEME_NAME));

$options['images_per_page']	= array(
							'label'=>__('Images Per Page', THEME_NAME),
							'type'=>'input',
							'std'=>'12',
							'validation'=>'trim|required|is_natural_no_zero',
							'info'=>__('Number of images you want to show per page', THEME_NAME));
							
$options['album_on_single'] = array(
							'label'=>__('Show Album on Single Gallery Post', THEME_NAME),
							'type'=>'dropdown',
							'value'=>array('active'=>'Active','inactive'=>'Inactive'),
							'validation'=>'required',
							'std'=>'active',
							'info'=>__('Active or Inactive Album on Single.', THEME_NAME));
							
$options['album_on_category'] = array(
							'label'=>__('Show Album on Category', THEME_NAME),
							'type'=>'dropdown',
							'value'=>array('active'=>'Active','inactive'=>'Inactive'),
							'validation'=>'required',
							'std'=>'active',
							'info'=>__('Active or Inactive Album on gallery category.', THEME_NAME));
$options['title_limit'] = array(
							'label'=>__('Title Limit (Grid View)', THEME_NAME),
							'type'=>'input',
							'value'=>'',
							'validation'=>'required',
							'std'=>'25',
							'info'=>__('The title character limit on grid view.', THEME_NAME));

$options['content_limit'] = array(
							'label'=>__('Content Limit (List View)', THEME_NAME),
							'type'=>'input',
							'value'=>'',
							'validation'=>'required',
							'std'=>'25',
							'info'=>__('The content words limit on list view.', THEME_NAME));