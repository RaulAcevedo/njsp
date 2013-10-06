<?php 

class FW_Metaboxes
{
	var $_config;
	
	function __construct()
	{
		global $pagenow;
		add_action('admin_init', array($this, 'fw_post_meta_box'));
		
		
	}

	function fw_post_meta_box()
	{
		global $pagenow;
		
		add_action('save_post', array( $this, 'save_post'));
		if($pagenow == 'post.php' || $pagenow == 'post-new.php')
		{
			include('config/posts.php');
			$this->_config = $options;
		}
		
		//$this->scripts_styles();
		add_action('admin_print_scripts', array( $this, 'scripts_styles'));
		
		$boxes = array('post'=>__('Post Settings', THEME_NAME), 'fw_testimonial'=>__('Testimonial Settings', THEME_NAME),
					'page'=>__('Page Settings', THEME_NAME), 'fw_event'=>__('Event Settings', THEME_NAME));
		
		
		foreach( $boxes as $k => $v )
		{
			add_meta_box( $k.'_settings', $v, array($this, 'post_settings'), $k, 'normal',  'core' );
		}
		
						 
		
	}
	
	function save_post($post_id)
	{
		global $post;
		//printr($_POST);
		$types = array('post', 'wpnukes_galleries', 'fw_testimonial', 'fw_audio', 'fw_event', 'page');
		$post_type = kvalue($_POST, 'post_type');
	
		if( !in_array( $post_type, $types ) ) return;
		
		$config = kvalue($this->_config, $post_type);
		if( !$config ) return;
		
		$data = array();
		foreach( (array)$config as $k => $v)
		{
			if( kvalue($_POST, $k )) $data[str_replace('webnukes_', '', $k)] = kvalue($_POST, $k );
		}
		//printr($data);
		
		
		$key = 'wpnukes_'.$post_type.'_settings';

		if( $data ) update_post_meta( $post_id, $key, $data);
		

		if( $post_type == 'fw_event') update_post_meta( $post_id, 'fw_event_start_time', kvalue( $_POST, 'event_start' ) );
		
		if( $post_type == 'fw_audio' ) update_post_meta( $post_id, 'fw_audio_singer', kvalue( $_POST, 'singer' ) );

	}
	
	function scripts_styles()
	{
		global $pagenow, $post_type; //printr($post_type);
		
		wp_enqueue_style( 'metabox-jqtransform-css', get_template_directory_uri().'/includes/views/css/jqtransform.css' );
		$styles = array('custom_style'=> 'views/css/style.css');
		foreach($styles as $k => $v ) wp_register_style( $k, get_template_directory_uri().'/libs/metaboxes/'.$v);
		
		if( $post_type != 'page'){
			if( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) wp_enqueue_style('custom_style');
		}
		if( $post_type == 'fw_event' ){
			wp_enqueue_script('googlemap', 'http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places');
			wp_enqueue_script('googlemap_custom', THEME_URL.'/libs/metaboxes/views/js/map.js');
			wp_enqueue_script('jquery-timepicker', THEME_URL.'/libs/metaboxes/views/js/jquery-ui-timepicker-addon.js', array('jquery-ui-datepicker', 'jquery-ui-slider'));
			wp_enqueue_style('jquery-ui-datepicker', THEME_URL.'/libs/metaboxes/views/css/jquery.ui.datepicker.css');
			wp_enqueue_style('jquery-ui-timepicker', THEME_URL.'/libs/metaboxes/views/css/jquery-ui-timepicker-addon.css');
		}
		
		wp_enqueue_script( 'metabox-jqtransform_script', get_template_directory_uri().'/includes/views/js/jquery.jqtransform.js' );
		wp_enqueue_script( 'metabox-custom_script', get_template_directory_uri().'/libs/metaboxes/views/js/scripts.js' );
	}

	
	function post_settings( $post )
	{	
		global $post_type;
		
		$config = kvalue( $this->_config, $post_type );
		if( !$config ) return;
		
		
		
		$key = 'wpnukes_'.$post_type.'_settings';
		
		$settings = (array)get_post_meta($post->ID, $key, true);
		
		
		echo $this->generate( $config, $settings, get_template_directory().'/libs/metaboxes/views/posts.php');
		
	}
	
	function generate( $options, $settings, $tpl)
	{
		
		$_webnukes = $GLOBALS['_webnukes'];
		$_webnukes->load('html_class', '', true); /** Load WPnukes HTML class */
		$_webnukes->load('wp_html_class','html'); /** Load wordpress HTML class */
		
		$data = array();
		//$settings = get_option('wpnukes_video_settings');
		
		foreach( (array)$options as $k=>$v )
		{
			$value = (isset($settings[str_replace('webnukes_', '', $k)])) ? array($k=>$settings[str_replace('webnukes_', '', $k)]) : array($k=>kvalue($v, 'std'));
			$data['fields'][$k] = $_webnukes->html->generator($k, $v, $value, 'array');
			if( $html = kvalue( kvalue( $v, 'settings' ), 'html' ) )  $data['html'] = $html;
		}


		return $_webnukes->html->layout($tpl, $data, true);
	}
	
}

new FW_Metaboxes;