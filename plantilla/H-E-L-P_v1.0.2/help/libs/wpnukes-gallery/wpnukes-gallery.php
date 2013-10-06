<?php if ( ! defined('ABSPATH')) exit('restricted access');



class wpnukes_gallery
{
	private $baseurl = '';
	private $path = '';
	private $text_domain = THEME_NAME;
	
	function __construct()
	{
		/** Plugin Base URL */
		$this->baseurl = get_template_directory_uri().'/libs/wpnukes-gallery/';

		/** Plugin Path */
		$this->path = get_template_directory().'/libs/wpnukes-gallery/';
		
		/** Register Post type */
		add_action( 'init', array($this, 'register_posttype'));
		
		/** Custom Taxonomy */
		//add_action( 'init', array($this, 'register_taxonomy'), 0 );
		
		/** Contextual Help */
		//add_action( 'contextual_help', array($this, 'contextual_help'), 10, 3 );
		
		/** Load Custom javascript files on new and edit gallery page only */
		add_action( 'admin_print_scripts-post-new.php', array($this, 'admin_script'), 11 );
		add_action( 'admin_print_scripts-post.php', array($this, 'admin_script'), 11 );
		
		/** Load Custom styleshee files */
		add_action( 'admin_print_styles-post-new.php', array($this, 'admin_style'), 11 );
		add_action( 'admin_print_styles-post.php', array($this, 'admin_style'), 11 );

		/** Add Video Callback function */
		//add_action('wp_ajax_add_videos', array($this, 'add_videos'));
		
		/** Ajax Callback */
		add_action('wp_ajax_nukes_gallery', array( $this, 'get_attachments'));
		
		/** Create custom meta box */
		add_action( 'add_meta_boxes', array($this, 'metaboxes') );
		
		
		/** Gallery Settings Pages */
		//add_action('admin_menu', array($this, 'settings_page'));
		
		/** Save Post */
		add_action( 'publish_wpnukes_galleries', array($this, 'save_post') );
		
		/** Front-end Functionality */
		
		/** Front-end Ajax requests handler */
		//add_action('wp_ajax_wpnukes_gallery_ajax_callback', array($this, 'ajax_callback'));
		//add_action('wp_ajax_nopriv_wpnukes_gallery_ajax_callback', array($this, 'ajax_callback'));
		
		/** Custom field for gallery categories */
		//add_action('wpnukes_gallery_edit_form_fields', array($this, 'category_edit_form'));
		//add_action('wpnukes_gallery_add_form_fields', array($this, 'category_edit_form'));
		
		/** Custom field for gallery categories data saving */
		//add_action('created_term', array($this, 'save_gallery_thumbnail'));
        //add_action('edit_term', array($this, 'save_gallery_thumbnail'));
		
		//add_action( 'admin_print_scripts-edit-tags.php', array($this, 'admin_category_script'), 11 );
		//add_action( 'admin_print_scripts-post.php', array($this, 'admin_script'), 11 );
		
		/** Gallery Columns */
		add_filter('manage_edit-wpnukes_galleries_columns', array($this, 'head_only_gallery'), 10);  
		add_action('manage_wpnukes_galleries_posts_custom_column', array($this, 'content_only_gallery'), 10, 2); 
		
		/** Add Shortcode */
		add_shortcode('wpnukes_gallery', array($this, 'wpnukes_gallery_shortcode'));

	}
	
	
	function wpnukes_gallery_shortcode($atts, $content = null)
	{
		extract(shortcode_atts(array('id'=>0,'per_page' => 0,'container'=>'ul'), $atts));
		
		ob_start();
		$this->gallery_html('post_id='.$id.'&images_per_page='.$per_page.'&container='.$container);
		$contents = ob_get_contents();
		ob_end_clean();
		
		return $contents;
	}
	
	function head_only_gallery($default)
	{
		unset($default['date']);

		$default['gallery_image'] = __('Images and Videos', THEME_NAME);
		$default['author'] = __('Author', THEME_NAME);
		$default['date'] = __('Date', THEME_NAME);
		
		return $default;
	}
	
	function content_only_gallery($column_name, $post_ID)
	{
		if($column_name == 'wpnukes_gallery')
		{
			$terms = get_the_term_list( $post_ID , 'wpnukes_gallery' , '' , ',' , '' );
			if(is_string($terms)) echo $terms;
			else _e('Unable to get category', THEME_NAME);
			
		}elseif($column_name == 'gallery_image')
			echo array_sum( (array)get_post_meta($post_ID, 'wpnukes_gallery_count', true) );
	}

	
	
	function save_post($post_id)
	{
		global $post;
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
		$post_id = is_int($post_id) ? $post_id : $post->ID;

		$nonce = isset($_POST['wpnukes_gallery_content_nonce']) ? $_POST['wpnukes_gallery_content_nonce'] : '';
		if( ! current_user_can( 'edit_page', $post_id) ) return;
		elseif( ! wp_verify_nonce($nonce, plugin_basename($this->path)) ) return;
		
		$count = array();
		
		/** Store Videos */
		if(isset($_POST['videos']))
		{
			$videos = array_reverse($_POST['videos']);
			$count['videos'] = count($videos);
			update_post_meta($post_id, 'wpnukes_videos', $videos);
		}

		/** Store Gallery */
		if(isset($_POST['gallery']))
		{
			$count['images'] = count($_POST['gallery']);
			update_post_meta($post_id, 'wpnukes_gallery', (array) $_POST['gallery']);
		}
		
		update_post_meta($post_id, 'wpnukes_gallery_count', $count);
	}
	
	function get_attachments()
	{
		if(empty($_POST['ids'])) return;
		$ids = explode(',', $_POST['ids']);

		$attachments = get_posts(array('posts_per_page'=>-1,'post_type'=>'attachment','post__in'=>$ids,'orderby'=>'none'));//print_r($attachments);
		$response = array_flip($ids);

		foreach($attachments as $attachment)
		{
			$thumbnail = current((array)wp_get_attachment_image_src($attachment->ID));
			$response[$attachment->ID] = array('id'=>$attachment->ID,'alt'=>$attachment->post_title,'caption'=>$attachment->post_excerpt,'img'=>$thumbnail);
		}
		
		$response = array_reverse($response);
		exit(json_encode($response));
	}
	
	
	
	function metaboxes()
	{
		/** Use metabox on gallery page only */
		if('wpnukes_galleries' != $GLOBALS['post_type']) return;
		
		add_meta_box('the_shortcode', __('Shortcode', THEME_NAME), array($this, 'shortcode'), 'wpnukes_galleries', 'side', 'high');
		
		add_meta_box('the_image_uploader', __('Upload Images', THEME_NAME), array($this, 'upload_images'), 'wpnukes_galleries', 'normal', 'high');
		add_meta_box('the_video_uploader', __('Upload Videos', THEME_NAME), array($this, 'upload_Videos'), 'wpnukes_galleries', 'normal', 'high');
	}
	
	function shortcode()
	{
		echo '[wpnukes_gallery id="'.get_the_ID().'"]';
	}
	
	function upload_images()
	{
		include($this->path.'views/upload_images.php');
	}
	
	
	
	function upload_videos()
	{
		include($this->path.'views/upload_videos.php');
	}
	
	function admin_style()
	{

		if('wpnukes_galleries' != $GLOBALS['post_type']) return;
		
		wp_enqueue_style("wp-jquery-ui-dialog");
		wp_enqueue_style( 'gallery-admin-style', $this->baseurl .'css/style.css');
	}
	
	function admin_script()
	{
		if('wpnukes_galleries' != $GLOBALS['post_type']) return;
		
		wp_enqueue_script( 'nukes-videos', $this->baseurl . 'js/jquery-video.js', array('jquery-ui-dialog'));
		wp_enqueue_script( 'galleries-admin-script', $this->baseurl . 'js/image-gallery.js');
	}
	
	
	function register_posttype()
	{
		register_post_type( 'wpnukes_galleries',
        array(
            'labels' => array(
                'name' => _x('Galleries', 'WPnukes Galleries', THEME_NAME),
                'singular_name' =>  _x('Gallery', 'WPnukes Gallery', THEME_NAME),
                'add_new' =>  _x('Add New', THEME_NAME),
                'add_new_item' =>  __('Add New Gallery', THEME_NAME),
                'edit' =>  __('Edit', THEME_NAME),
                'edit_item' =>  __('Edit Gallery', THEME_NAME),
                'new_item' =>  __('New Gallery', THEME_NAME),
                'view' =>  __('View', THEME_NAME),
                'view_item' =>  __('View Gallery', THEME_NAME),
                'search_items' =>  __('Search Gallery', THEME_NAME),
                'not_found' =>  __('No Gallery found', THEME_NAME),
                'not_found_in_trash' =>  __('No Gallery found in Trash', THEME_NAME),
                'parent' =>  __('Parent Gallery', THEME_NAME)
            ),
			'description' => __('Gallery plugin to manage image and videos', THEME_NAME),
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'thumbnail' ),
            /*'taxonomies' => array( '' ),*/
            'menu_icon' => $this->baseurl. 'images/gallery-image.png',
            'has_archive' => true
        )
	    );
	}
	
	
	
	/**
	 * @see wpnukes_gallery::gallery_array()
	 * @since 1.0.0
	 *
	 * @param int $post_id Id of the gallery post.
	 * @param string $thumb_size Either register size of the image or an array of width height.
	 * @return array returns the array of images and videos found in the current gallery post.
	 */
	public function gallery_array($post_id, $thumb_size, $args = array())
	{
		global $post, $wpdb, $wp_embed;

		$title_limit = 25;
		
		/** Default values of the 3rd argument $args */
		$default = array('show_featured' => false, 'number' => -1, 'mime_type' => 'all', 'no_detail' => false);
		$args = wp_parse_args($args, $default);

		$is_featured = ($args['show_featured']) ? true : false;
		
		$views = get_post_meta($post_id, 'wpnukes_gallery_views_counter', true);
		
		$content = array();
		
		$showposts = $args['number'];
		
		/** Check whether only featured images need to show */
		if($is_featured) {
			$gallery = (get_post_thumbnail_id(get_the_ID())) ? array(get_post_thumbnail_id(get_the_ID())) : array();
			$gallery = ($gallery) ? $gallery : array(current( (array)get_post_meta($post_id, 'wpnukes_gallery', true)));
		}else{
			$gallery = get_post_meta($post_id, 'wpnukes_gallery', true);
		}

		if( $gallery && ($args['mime_type'] == 'all' || $args['mime_type'] == 'image') )
		{

			$gallery = ( $showposts == 1 ) ? current((array)$gallery) : $gallery;
			$posts = get_posts(array('showposts' => $showposts,'post_type'=>'attachment', 'post_mime_type'  => '"image/jpeg,image/gif,image/jpg,image/png"', 
								'include'=>$gallery));

			$gallery = array_flip((array)$gallery);

			if($posts)
			{
				foreach($posts as $p)
				{
					$img_info = array();
					$thumb = wp_get_attachment_image_src($p->ID, $thumb_size);
					if($args['no_detail']) $img_info['thumb'] = $thumb[0];
					else{
						
						$img_info['type'] = 'picture';
						$img_info['uid'] = $p->ID;
						$img_info['url'] = wp_get_attachment_url($p->ID);
						$img_info['thumb'] = $thumb[0];
						$img_info['title'] = $this->get_title(kvalue($p, 'post_title'));
						$img_info['date'] = date(get_option('date_format'), strtotime($p->post_date));
						$img_info['author'] = get_userdata($p->post_author)->display_name;
						$img_info['views'] = isset($views[$p->ID]) ? $views[$p->ID] : 0;
						$img_info['duration'] = '';
						$img_info['cat'] = '';//get_the_term_list(get_the_ID(), 'wpnukes_gallery', '', ' ,');
						$img_info['desc'] = $p->post_excerpt;
					}
					$gallery[$p->ID] = $img_info;
					
					
				}
			}
		}
		$content = $gallery;

		/** Check whether only featured videos need to show */
		$videos = get_post_meta($post_id, 'wpnukes_videos', true);

		if($videos && ($args['mime_type'] == 'all' || $args['mime_type'] == 'video') )
		{
			
			foreach(array_reverse((array)$videos) as $video)
			{
	
				$img_info = array();
				if($args['no_detail']) $img_info['thumb'] = $video['thumb'];
				else{
					$url = ($video['source'] == 'vimeo') ? 'http://vimeo.com/'.$video['id'] : 'http://www.youtube.com/watch?v='.$video['id'];
					$img_info['type'] = 'video';
					$img_info['uid'] = $video['id'];
					$img_info['url'] = $url;
					$img_info['thumb'] = $video['thumb'];
					$img_info['title'] = $video['title'];
					$img_info['date'] = get_the_date();
					$img_info['author'] = $video['author'];
					$views[$video['id']] = isset($views[$video['id']]) ? $views[$video['id']] : 0;
					$img_info['views'] = (int)$video['views'] + $views[$video['id']];
					$img_info['duration'] = $video['duration'];
					$img_info['cat'] = $video['tags'];
					$img_info['desc'] = character_limiter($video['desc'], 100);
				}
				
				if($is_featured){
					 if(isset($video['featured']) && $video['featured']) $content[] = $img_info;
				}else{
					$content[] = $img_info;
				}				
			}
		}
		return $content;
	}
	
	/**
	 * @see wpnukes_gallery::get_title()
	 * @since 1.0.0
	 *
	 * @return string returns formatted title.
	 */
	function get_title($title, $limit = '')
	{
		return ( $limit ) ? substr(str_replace(array('-', '_', '+'), ' ', $title), 0, $limit) : str_replace(array('-', '_'), ' ', $title);
	}
	
	
}

/** Initiate the Class */
$GLOBALS['wpnukes_gal'] = new wpnukes_gallery;