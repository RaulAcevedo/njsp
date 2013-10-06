<?php if ( ! defined('ABSPATH')) exit('restricted access'); 


// Class FW_Tweets to fetch latest tweets from twitter ID
class Twitter extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'tweets', /* Name */'Twitter', array( 'description' => 'Twitter tweets' ) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		wp_enqueue_script('jquery-bxslider');
		
		extract( $args );
		$title = @apply_filters( 'widget_title', $instance['twitter_title'] );
		echo $before_widget;
		if($title) echo $before_title.$title.$after_title;
				
		FW_Twitter(array('screen_name'=>kvalue($instance, 'twitter_id'), 'count'=>kvalue($instance, 'tweets_num'), 'selector'=>'.tweets-list'));?>
        
        <div class="tweets-box">
            <ul class="tweets-list">
            </ul>
		</div>
        <div class="follow-twitter"><?php echo ( $instance['follow_label'] ) ? $instance['follow_label'] : __( 'Follow us on Twitter', THEME_NAME ); ?> </div>
			
		<?php
		echo $after_widget;
	}
	
	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['twitter_title'] = strip_tags($new_instance['twitter_title']);
		$instance['twitter_id'] = strip_tags($new_instance['twitter_id']);
		$instance['tweets_num'] = strip_tags($new_instance['tweets_num']);
		$instance['follow_label'] = strip_tags($new_instance['follow_label']);

		return $instance;
	}

	/** @see WP_Widget::form */
	function form( $instance )
	{
		if ( $instance )
		{
			$twitter_title = esc_attr( $instance[ 'twitter_title' ] );
			$twitter_id = esc_attr($instance['twitter_id']);
			$tweets_num = esc_attr($instance['tweets_num']);
			$follow_label = esc_attr($instance['follow_label']);

		}
		else
		{
			$twitter_title = _e( 'Twitter', THEME_NAME );
			$twitter_id = 'wordpress';
			$tweets_num = 1;
			$follow_label = '';
		}

	?>    
            <label for="<?php echo $this->get_field_id('twitter_title'); ?>"><?php _e('Title:', THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('twitter_title'); ?>" name="<?php echo $this->get_field_name('twitter_title'); ?>" type="text" value="<?php echo $twitter_title; ?>" />
            <label for="<?php echo $this->get_field_id('twitter_id'); ?>"><?php _e('Twitter ID:', THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" type="text" value="<?php echo $twitter_id; ?>" />

            <label for="<?php echo $this->get_field_id('tweets_num'); ?>"><?php _e('Number of Tweets:', THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('tweets_num'); ?>" name="<?php echo $this->get_field_name('tweets_num'); ?>" type="text" value="<?php echo $tweets_num; ?>" />
            <label for="<?php echo $this->get_field_id('follow_label'); ?>"><?php _e('Follow us Label:', THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('follow_label'); ?>" name="<?php echo $this->get_field_name('follow_label'); ?>" type="text" value="<?php echo $follow_label; ?>" />
		</p>
	<?php 
	}
}


//Class Recent_posts with images
class Recent_Posts extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'tbrecent_posts', /* Name */'Rockband Recent Posts', array( 'description' => 'Recent posts with images' ) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( $title )
		echo $before_title . $title . $after_title;
		
?>
		<div class="posts-list">
          	<ul>
                	<?php
					query_posts('posts_per_page='.$instance['post_limit']);
					while(have_posts()): the_post();?>
                    	<li>
              				<a href="<?php the_permalink(); ?>">
									<?php if(has_post_thumbnail()):	the_post_thumbnail(array(55, 55));
									else:?><img width="55" height="55" src="<?php echo get_template_directory_uri();?>/images/widget-post.gif" align="noimage" title="noimage" />
                                    <?php endif; ?>
                            </a>
                			<div class="post-text">
                                <h5> <a href="<?php the_permalink(); ?>"><?php echo substr(get_the_title(), 0, 25) . '...'; //the_title(); ?></a></h5>
                                <p><?php $content=substr(strip_tags(get_the_content()), 0, 58); 
										 //$content=strip_tags($content);
										echo $content.'...';?></p>
                			</div>
              			</li>
                    <?php endwhile; ?>
                </ul>
          </div>
		<?php wp_reset_query();
		echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['post_limit'] = strip_tags($new_instance['post_limit']);
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form( $instance )
	{
		if ( $instance )
		{
			$post_title = esc_attr($instance['title']);
			$limit =  esc_attr($instance['post_limit']);
		}
		else
		{
			$post_title = __( 'Recent Posts', THEME_NAME );
			$limit = 5;
		}
	?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $post_title; ?>" />
            
			<label for="widget-recent-posts-3-number"><?php _e('Number of posts to show:', THEME_NAME);?></label>
			<input type="text" size="3" value="<?php echo $limit; ?>" name="<?php echo $this->get_field_name('post_limit'); ?>" id="<?php echo $this->get_field_id('post_limit'); ?>">
		</p>
	<?php 
	}
}


//Class Recent_Videos with images
class FW_Gallery extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'widget-gallery', /* Name */'Gallery', array( 'description' => 'Display Gallery' ) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		
		global $post;
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( $title )
		echo $before_title . $title . $after_title;
		
		$exclude = explode( ',', kvalue( $instance, 'exclude' ) );
		$query = new WP_Query(array('post_type'=>'wpnukes_galleries', 'post_status'=>'publish', 'showposts'=>kvalue( $instance, 'number'), 'post__not_in'=>$exclude)); //printr($query);?>
        <div class="gallery-thumbs">
            <ul class="clearfix">
                <?php while( $query->have_posts() ): $query->the_post(); ?>
                    <li>
                        <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'gallery-widget' );//printr($src); ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <img alt="<?php the_title(); ?>" src="<?php echo kvalue( $src, '0'); ?>" />
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
        
		<?php wp_reset_query();
		echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
		$instance['exclude'] = strip_tags($new_instance['exclude']);
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form( $instance )
	{
		if ( $instance )
		{
			$title = esc_attr($instance['title']);
			$number =  esc_attr($instance['number']);
			$exclude = esc_attr($instance['exclude']);
			
		}
		else
		{
			$title = __( 'Gallery', THEME_NAME );
			$number = '';
			$exclude = '';
			
		}
	?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>    
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Images:', THEME_NAME);?></label><br />
			<input type="text" name="<?php echo $this->get_field_name('number'); ?>" id="<?php echo $this->get_field_id('number'); ?>" value="<?php echo $number; ?>"  />
        </p>
        <p>    
			<label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e('Exclude:', THEME_NAME);?></label><br />
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('exclude'); ?>" id="<?php echo $this->get_field_id('exclude'); ?>" value="<?php echo $exclude; ?>"  />
            <small><?php _e('Comma separated IDs of attachments', THEME_NAME); ?></small>
        </p>
        
	<?php 
	}
}


//Class Recent_Videos with images
class FW_Upcoming_event extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'upcoming-event', /* Name */'Upcoming Event', array( 'description' => 'Count down the upcoming event' ) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		
		wp_enqueue_script('jquery-countdown');
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		if( $title ) echo $before_title.$title.$after_title;
		echo $before_widget;
		
		$query = new WP_Query(array('post_type'=>'fw_event', 'showposts'=>1, 'meta_key' =>'fw_event_start_time', 'meta_query' => array(array('key' => 'fw_event_start_time', 'value' => date('Y-m-d h:i:s'), 'type' => 'date', 'compare' => '>='	)), 'orderby'=>'meta_value', 'order'=>'ASC'));//printr($query);
		//$query = get_posts( array('post_type'=>'fw_audio', 'posts_per_page'=>$instance['number']) );?>
        
        <?php while( $query->have_posts() ): $query->the_post(); ?>
            
            <?php $settings = get_post_meta( get_the_ID(), 'wpnukes_fw_event_settings', true ); //printr($settings); ?>
            <div class="event-countdown">
                <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                
                <div class="counter">
                    <div class="count-down"></div>
                </div>
                <?php echo character_limiter( get_the_excerpt(), 50 ); ?>
                
                <ul>
                    <li>
                        <span><i class="icon-date"></i><?php echo date('d - m - Y', strtotime(kvalue( $settings, 'event_start')) ); ?></span>
                        <span>
                            <?php echo date('h:ia', strtotime(kvalue( $settings, 'event_start')) ); ?> - 
                            <?php echo date('h:ia', strtotime(kvalue( $settings, 'event_end')) ); ?>
                        </span>
                    </li>
                    <li><span><i class="icon-location"></i><?php echo kvalue( $settings, 'event_place'); ?></span></li>
                </ul>
            
            </div><!-- event-countdown ends -->
        <?php endwhile; ?>
        <script type="text/javascript">
			jQuery(document).ready(function($) {
                if ($('.count-down').length !== 0){
					$('.count-down').countdown({
						timestamp : new Date('<?php echo date( 'm/d/Y h:i:s', strtotime(kvalue( $settings, 'event_start'))); ?>')//(new Date()).getTime() + 19*24*60*60*1000
					});
				}
            });
		</script>
		<?php wp_reset_query();
		echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form( $instance )
	{
		if ( $instance )
		{
			$title = esc_attr($instance['title']);
			
		}
		else
		{
			$title = __( 'Events', THEME_NAME );
	
			
		}?>
        
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
       
		<?php 
	}
}


class FW_Fbplugin extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'fbplugin', /* Name */'Facebook Page Likebox', array( 'description' => 'This widget is used to show Facebook Page Fans and Allow users to Like Facebook Page' ) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		global $wpdb;
		extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if($title)
		echo $before_title . $title . $after_title;
	?>
    <div id="fb-root"></div>
	<script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=343918698971500";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
	<?php
		echo $this->set_value($instance);
		echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] 				= strip_tags($new_instance['title']);
		$instance['href'] 				= strip_tags($new_instance['href']);
		$instance['width']	 			= strip_tags($new_instance['width']);
		$instance['height']	 			= strip_tags($new_instance['height']);
		$instance['colorscheme']		= strip_tags($new_instance['colorscheme']);
		$instance['show_faces'] 		= strip_tags($new_instance['show_faces']);
		$instance['border_color']	 	= strip_tags($new_instance['border_color']);
		$instance['stream']			 	= strip_tags($new_instance['stream']);
		$instance['header']				= strip_tags($new_instance['header']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		if ($instance)
		{
			$title 				= esc_attr($instance['title']);
			$page_url 			= esc_attr($instance['href']);
			$width	 			= esc_attr($instance['width']);
			$height	 			= esc_attr($instance['height']);
			$colorscheme		= esc_attr($instance['colorscheme']);
			$show_faces 		= esc_attr($instance['show_faces']);
			$border_color	 	= esc_attr($instance['border_color']);
			$stream			 	= esc_attr($instance['stream']);
			$header				= esc_attr($instance['header']);
		}
		else
		{
			$title 				= '';
			$page_url 			= '';
			$width	 			= 250;
			$height				= 320;
			$colorscheme		= 'light';
			$show_faces 		= '';
			$border_color	 	= '';
			$stream			 	= '';
			$header				= '';
		}
	?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title',THEME_NAME); ?>:</label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('href'); ?>"><?php _e('Facebook Page URL',THEME_NAME); ?>:</label> 
            <input class="widefat" id="<?php echo $this->get_field_id('href'); ?>" name="<?php echo $this->get_field_name('href'); ?>" type="text" value="<?php echo $page_url; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width',THEME_NAME); ?>:</label> 
            <input id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" style="width:50px;" />px
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height',THEME_NAME); ?>:</label> 
            <input id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" style="width:50px;" />px
        </p>
        <p>
			<label for="<?php echo $this->get_field_id('colorscheme'); ?>"><?php _e('Color Scheme',THEME_NAME); ?>:</label>
            <select name="<?php echo $this->get_field_name('colorscheme'); ?>" id="<?php echo $this->get_field_id('colorscheme'); ?>">
            	<option value="light" <?php echo ($colorscheme == 'light') ? 'selected="selected"' : '';?>>Light</option>
                <option value="dark" <?php echo ($colorscheme == 'dark') ? 'selected="selected"' : '';?>>Dark</option>
            </select>
		</p>
        <p>
            <label for="<?php echo $this->get_field_id('show_faces'); ?>"><?php _e('Show Faces',THEME_NAME); ?>:</label> 
            <input id="<?php echo $this->get_field_id('show_faces'); ?>" name="<?php echo $this->get_field_name('show_faces'); ?>" type="checkbox" value="true" <?php echo ($show_faces) ? 'checked="checked"' : '';?> />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('border_color'); ?>"><?php _e('Border Color',THEME_NAME); ?>:</label> 
            <input class="widefat" id="<?php echo $this->get_field_id('border_color'); ?>" name="<?php echo $this->get_field_name('border_color'); ?>" type="text" value="<?php echo $border_color; ?>" style="width:100px;" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('stream'); ?>"><?php _e('Show Stream',THEME_NAME); ?>:</label> 
            <input id="<?php echo $this->get_field_id('stream'); ?>" name="<?php echo $this->get_field_name('stream'); ?>" type="checkbox" value="true" <?php echo ($stream) ? 'checked="checked"' : '';?> />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('header'); ?>"><?php _e('Show Header',THEME_NAME); ?>:</label> 
            <input id="<?php echo $this->get_field_id('header'); ?>" name="<?php echo $this->get_field_name('header'); ?>" type="checkbox" value="true" <?php echo ($header) ? 'checked="checked"' : '';?> />
        </p>
	<?php 
	}
	
	function set_value($instance)
	{
		$data = '';
		foreach($instance as $k=>$v)
		{
			if($v) {
				$atr = 'data-'.str_replace('_', '-', $k);
				$data .= " $atr=\"$v\" ";
			}
			else {
				$atr = 'data-'.str_replace('_', '-', $k);
				$data .= " $atr=\"false\" ";
			}
			
		}
		return '<div class="fb-like-box" '.$data.'></div>';
	}

}


//Donate_Widget Class
class FW_Donate extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'donate', /* Name */'Donation widget', array( 'description' => 'This widget is used for donation' ) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		global $wpdb;
		extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if($title)
		echo $before_title . $title . $after_title;
		require_once('thirdparty/libpaypal.php');
		
		//Create the authentication
		$pp_type = ($instance['pp_type'] == 'sandbox') ? true : false;
		$auth = new PaypalAuthenticaton($instance['pp_username'], $instance['pp_api_username'], $instance['pp_api_password'], $instance['pp_sign'], $pp_type);
		
		//Create the paypal object
		$paypal = new Paypal($auth);
		$pp_settings = new PaypalSettings();
		$pp_settings->allowMerchantNote = true;
		$pp_settings->logNotifications = true;
		
		//the base url
		$return =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$selected_page = get_page(kvalue($instance, 'selected_page')); ?>
        
        <div class="donation">
			<?php
            if(count($_POST) && $notif = $paypal->handleNotification())
            $this->save_transaction($notif);
            
            $current_pos = $wpdb->get_row("SELECT SUM(total) as total FROM `fw_donation` WHERE `status` = 'Completed'"); 
			$total = ($current_pos->total) ? $current_pos->total : 1;
			$total = (is_numeric($instance['raised']) && $instance['raised'] < $instance['target']) ? $instance['raised'] : $total;
			$dtotal = (is_numeric($instance['raised']) && $instance['raised'] < $instance['target']) ? $instance['raised'] : 0;
            $percent = ($instance['target']) ? $total / $instance['target'] : 0;

			$action = $paypal->getButtonAction(); //get button action
			$products = array();
			$params = $paypal->getButtonParams($products, "$return?action=paid", "$return?action=cancel", "$return?action=notify"); //get params for the form
			unset($params['currency_code']);
			unset($params['amount']);
			$params['cmd'] = '_donations';
			$params['item_name'] = 'Donation';?>
            
            
            
            <div class="donate-box">
                <form action="<?php echo $action; ?>" method="post">
                    <div class="donate-detail">
                        <h3><?php echo $instance['note']; ?></h3>
                        
                        <div class="ratio"><?php echo $percent*100; ?>% Raised</div>
                        
                        <div class="progress">
                          <div style="width:<?php echo $percent*100; ?>%" class="bar"></div>
                        </div>
                    </div><!-- donate-detail ends -->
                    <ul>
                        <li>Funds Raised <span><?php echo $instance['currency'].number_format($dtotal, 0, '.', ','); ?></span></li>
                        <li>Goal <span><?php echo $instance['currency'].number_format($instance['target'], 0, '.', ','); ?></span></li>
                    </ul>
                    <?php foreach($params as $key => $value) { ?>
                        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>"/>
                    <?php }?> 
                    <input type="submit" value="Donate Now" class="btn btn-donate">
                </form>
            </div>
      	
        </div>
	<?php
		echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] 				= strip_tags($new_instance['title']);
		$instance['target'] 			= strip_tags($new_instance['target']);
		$instance['raised'] 			= strip_tags($new_instance['raised']);
		$instance['currency'] 			= strip_tags($new_instance['currency']);
		$instance['note']	 			= strip_tags($new_instance['note']);
		$instance['pp_type'] 			= strip_tags($new_instance['pp_type']);
		$instance['pp_username'] 		= strip_tags($new_instance['pp_username']);
		$instance['pp_api_username'] 	= strip_tags($new_instance['pp_api_username']);
		$instance['pp_api_password'] 	= strip_tags($new_instance['pp_api_password']);
		$instance['pp_sign'] 			= strip_tags($new_instance['pp_sign']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		if ($instance)
		{
			$title 				= esc_attr($instance['title']);
			$target 			= esc_attr($instance['target']);
			$raised 			= (isset($instance['raised'])) ? esc_attr($instance['raised']) : 0;
			$currency 			= esc_attr($instance['currency']);
			$note	 			= esc_attr($instance['note']);
			$pp_type 			= esc_attr($instance['pp_type']);
			$pp_username 		= esc_attr($instance['pp_username']);
			$pp_api_username 	= esc_attr($instance['pp_api_username']);
			$pp_api_password 	= esc_attr($instance['pp_api_password']);
			$pp_sign 			= esc_attr($instance['pp_sign']);
		}
		else
		{
			$title 				= __('You\'ve Helped Raise...', 'donate_widget');
			$target 			= 25000;
			$raised 			= 0;
			$currency 			= '$';
			$note 				= '';
			$pp_type 			= 'sandbox';
			$pp_username 		= '';
			$pp_api_username 	= '';
			$pp_api_password 	= '';
			$pp_sign 			= '';
		}
	?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('target'); ?>"><?php _e('Target:',THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('target'); ?>" name="<?php echo $this->get_field_name('target'); ?>" type="text" value="<?php echo $target; ?>" />
        </p>
		
        <p>
            <label for="<?php echo $this->get_field_id('raised'); ?>"><?php _e('Manually enter the raised money:',THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('raised'); ?>" name="<?php echo $this->get_field_name('raised'); ?>" type="text" value="<?php echo $raised; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('currency'); ?>"><?php _e('Currency Sign:',THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('currency'); ?>" name="<?php echo $this->get_field_name('currency'); ?>" type="text" value="<?php echo $currency; ?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Note:',THEME_NAME); ?></label> 
            <textarea name="<?php echo $this->get_field_name('note'); ?>" id="<?php echo $this->get_field_id('note'); ?>" cols="35" rows="3"><?php echo $note; ?></textarea>
        </p>
        <p>
			<label for="<?php echo $this->get_field_id('pp_type'); ?>"><?php _e('Select Paypal Type:',THEME_NAME); ?></label><br />
            <input type="radio" id="<?php echo $this->get_field_id('pp_type'); ?>" name="<?php echo $this->get_field_name('pp_type'); ?>" value="live" <?php echo ($pp_type == 'live') ? 'checked="checked"' : '';?> />Live
            <input type="radio" id="<?php echo $this->get_field_name('pp_type'); ?>" name="<?php echo $this->get_field_name('pp_type'); ?>" value="sandbox" <?php echo ($pp_type == 'sandbox') ? 'checked="checked"' : '';?> />Sandbox
		</p>
        <p>
            <label for="<?php echo $this->get_field_id('pp_username'); ?>"><?php _e('Paypal Username:',THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('pp_username'); ?>" name="<?php echo $this->get_field_name('pp_username'); ?>" type="text" value="<?php echo $pp_username; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('pp_api_username'); ?>"><?php _e('Paypal API Username:',THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('pp_api_username'); ?>" name="<?php echo $this->get_field_name('pp_api_username'); ?>" type="text" value="<?php echo $pp_api_username; ?>" />
        </p>
		<p>
            <label for="<?php echo $this->get_field_id('pp_api_password'); ?>"><?php _e('Paypal API Password:',THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('pp_api_password'); ?>" name="<?php echo $this->get_field_name('pp_api_password'); ?>" type="password" value="<?php echo $pp_api_password; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('pp_sign'); ?>"><?php _e('Paypal Signature:',THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('pp_sign'); ?>" name="<?php echo $this->get_field_name('pp_sign'); ?>" type="text" value="<?php echo $pp_sign; ?>" />
        </p>
	<?php 
	}
	
	function save_transaction($data)
	{
		global $wpdb;
		$array = array('transID'=>$data->transactionId, 'status'=>$data->status, 'total'=>$data->total, 'donalID'=>$data->buyer->id, 
						'donalName'=>$data->buyer->firstName.' ' .$data->buyer->lastName, 'donalEmail'=>$data->buyer->email, 'note'=>$data->products[0]->name,
						'data'=>serialize($data), 'date'=>date('Y-m-d H:i:s', $data->date )
						);
						
		if($transID = $wpdb->get_row("SELECT `transID` FROM `fw_donation` WHERE `transID` = '".$data->transactionId."'")){
			echo '<p class="errormsg donationmsg">The transaction is already in our record.</p>';
		}
		elseif($data->status == 'Completed') {
			$result = $wpdb->insert('fw_donation', $array);
			if($result) echo '<p class="successmsg donationmsg">'.__('Thank you for your donation.',THEME_NAME).'</p>';
		}
		else{
			$result = $wpdb->insert('fw_donation', $array);
			echo '<p class="errormsg donationmsg">'.__('Sorry! unfortunetly the transaction is failed.',THEME_NAME).'</p>';
		}
	}

} // class donation



//Class Recent_Videos with images
class Contact_us extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'widget-contact', /* Name */'Contact Us', array( 'description' => 'Display contact detail' ) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		
		
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( $title )
		echo $before_title . $title . $after_title;
		
		$facebook = kvalue( $instance, 'facebook');
		$twitter = kvalue( $instance, 'twitter'); ?>
        <section class="contact-box">
         <p><?php echo kvalue( $instance, 'text' ); ?></p>
         <ul class="contact-list">
            <li class="addrs"><?php echo kvalue($instance, 'address');?></li>
            <li class="list-phone"><?php echo kvalue($instance, 'phone');?></li>
            
            <li class="list-email"><a href="mailto:<?php echo kvalue($instance, 'email');?>"><?php echo kvalue($instance, 'email');?></a></li>
            <li class="list-facebook"><a href="<?php echo strstr($facebook, 'http://') ? $facebook : 'http://'.$facebook; ?>" target="_blank"><?php echo $facebook; ?></a></li>
            <li class="list-twitter"><a href="<?php echo strstr($twitter, 'http://') ? $twitter : 'http://'.$twitter; ?>" target="_blank"><?php echo $twitter;?></a></li>
        </ul>
        </section>
		<?php	echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['twitter'] = strip_tags($new_instance['twitter']);
		$instance['facebook'] = strip_tags($new_instance['facebook']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['text'] = strip_tags($new_instance['text']);
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form( $instance )
	{
		if ( $instance )
		{
			$post_title = esc_attr($instance['title']);
			$address =  esc_attr($instance['address']);
			$phone = esc_attr($instance['phone']);
			$twitter =  esc_attr($instance['twitter']);
			$facebook = esc_attr($instance['facebook']);
			$email =  esc_attr($instance['email']);
			$text =  esc_attr($instance['text']);
		}
		else
		{
			$post_title = __( 'Contact Us', THEME_NAME );
			$address = '';
			$phone = '';
			$facebook = '';
			$twitter = '';
			$email = '';
			$text = '';
			
		}
	?>
		
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $post_title; ?>" />
        </p>
        <p>    
			<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', THEME_NAME);?></label><br />
			<textarea rows="3" cols="34" name="<?php echo $this->get_field_name('text'); ?>" id="<?php echo $this->get_field_id('text'); ?>"><?php echo $text; ?></textarea>
        </p>
        <p>    
			<label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', THEME_NAME);?></label><br />
			<textarea rows="3" cols="34" name="<?php echo $this->get_field_name('address'); ?>" id="<?php echo $this->get_field_id('address'); ?>"><?php echo $address; ?></textarea>
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone Number:', THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" />
        </p>
        
        <p>    
            <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:', THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
		</p>
         <p>    
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook:', THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $facebook; ?>" />
		</p>
        <p>    
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter:', THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" />
		</p>
	<?php 
	}
}


//Feedburner_Widget Class
class FW_Tbfeedburner extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'tbfeedburner', /* Name */'Feedburner', array( 'description' => 'A Feedburner Form' ) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if($title)
		echo $before_title . $title . $after_title;
	?>
		<div class="newsletter">
            <p><?php echo $instance['feedtext']; ?></p>
            <form action="http://feedburner.google.com/fb/a/mailverify" id="newletter_sub" method="post" target="popupwindow">
					
				<?php $message = __('Enter any Valid Email Address', THEME_NAME);?>
        
                <input type="text" placeholder="<?php echo $message;?>" name="email" id="email_address" class="textfield" />
                <input type="hidden" value="<?php echo $instance['feedlink']; ?>" name="uri" id="uri" />
                <input type="hidden" name="loc" value="en_US" />
            
                <input class="btn" type="submit" name="S" value="Submit" />
            
            </form>
        </div>
	<?php
		echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['feedlink'] = strip_tags($new_instance['feedlink']);
		$instance['feedtext'] = strip_tags($new_instance['feedtext']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = (isset($instance['title'])) ? esc_attr($instance['title']) : '';
		$link = (isset($instance['feedlink'])) ? esc_attr($instance['feedlink']) : '';
		$text = (isset($instance['feedtext'])) ? esc_attr($instance['feedtext']) : '';
	?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            <label for="<?php echo $this->get_field_id('feedlink'); ?>"><?php _e('Feedburner Link:',THEME_NAME); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('feedlink'); ?>" name="<?php echo $this->get_field_name('feedlink'); ?>" type="text" value="<?php echo $link; ?>" />
            <label for="<?php echo $this->get_field_id('feedtext'); ?>"><?php _e('Enter Text:',THEME_NAME); ?></label> 
            <textarea class="widefat" id="<?php echo $this->get_field_id('feedtext'); ?>" name="<?php echo $this->get_field_name('feedtext'); ?>" ><?php echo $text; ?></textarea>
        </p>
	<?php 
	}
} // class Feedburner_Widget



//register Recent_Posts class
add_action( 'widgets_init', create_function( '', 'register_widget("Recent_Posts");' ) );


add_action('widgets_init', create_function('', 'register_widget("Twitter");' ) );


add_action( 'widgets_init', create_function( '', 'register_widget("FW_Gallery");' ) );

add_action( 'widgets_init', create_function( '', 'register_widget("FW_Upcoming_event");') );

add_action( 'widgets_init', create_function( '', 'register_widget("FW_Fbplugin");') );


add_action( 'widgets_init', create_function( '', 'register_widget("FW_Donate");') );

//register Contact_us class
add_action( 'widgets_init', create_function( '', 'register_widget("Contact_us");' ) );

add_action( 'widgets_init', create_function( '', 'register_widget("FW_Tbfeedburner");' ) );

function fw_create_donation_table()
{
	//Create table for donation
	$query = "CREATE TABLE IF NOT EXISTS `fw_donation` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `transID` varchar(30) NOT NULL,
			  `status` varchar(20) NOT NULL,
			  `total` float NOT NULL,
			  `donalID` varchar(30) NOT NULL,
			  `donalName` varchar(120) NOT NULL,
			  `donalEmail` varchar(240) NOT NULL,
			  `note` text NOT NULL,
			  `data` text NOT NULL,
			  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($query);
}