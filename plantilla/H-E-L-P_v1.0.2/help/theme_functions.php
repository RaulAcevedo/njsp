<?php 

get_template_part('libs/events/events');
get_template_part('libs/testimonial/testimonial');
get_template_part('libs/metaboxes/metaboxes');
get_template_part('libs/wpnukes-gallery/wpnukes-gallery');
get_template_part('libs/contactform');
get_template_part( 'includes/thirdparty/recaptcha/recaptcha');

add_filter( 'pre_option_link_manager_enabled', '__return_true' );
add_action( 'wp_ajax_nopriv_FW_ajax_callback', 'FW_Twitter_ajax_callback');
add_action( 'wp_ajax_FW_ajax_callback', 'FW_Twitter_ajax_callback');


function fw_social_networks($settings = array())
{
	$settings = $GLOBALS['_webnukes']->fw_get_settings('sub_social_networking');
	
	$html = '';
	if( $settings )
	{
		foreach( $settings as $k => $v )
		{
			if( kvalue( $v, 'status' ) == 'on' ) 
			$html .= '<li><a href="'.kvalue($v, 'url').'" class="icon-'.$k.' tooltip" title="'.$k.'" target="_blank"></a></li>';
		}
	}
	return $html;
}

function FW_Twitter( $args = array() )
{
	$selector = kvalue( $args, 'selector' );
	$temp = kvalue( $args, 'template', 'blockquote' );
	$count = kvalue( $args, 'count', 3 );
	$screen = kvalue( $args, 'screen_name', 'Wordpress' );
	
	$apis = $GLOBALS['_webnukes']->fw_get_settings('sub_APIs');//printr($apis);
	$options = array('template'=>$temp, 'count' => $count, 'screen_name'=>$screen);
	?>
    
    
	<script type="text/javascript">
		jQuery(document).ready(function($) {
            $('<?php echo $selector; ?>').tweets(<?php echo json_encode($options); ?>);
        });
    </script>
    
    
    <?php
}

function FW_Twitter_ajax_callback()
{
	$settings = $GLOBALS['_webnukes']->fw_get_settings('sub_APIs');
	get_template_part('libs/codebird');
	Codebird::setConsumerKey(kvalue($settings, 'twitter_key'), kvalue($settings, 'twitter_secret'));
	$cb = Codebird::getInstance();
	$cb->setToken(kvalue($settings, 'twitter_token'), kvalue($settings, 'twitter_t_secret'));
	
	$params = array(
	 'screen_name' => kvalue($_POST, 'screen_name'),
	 'count' => kvalue($_POST, 'count'),
	 'exclude_replies'=>0,
	 'include_rts'=>0,
	 'include_entities'=>0,
	 'trim_user'=>false,
	 'contributor_details'=>false
	);
	$reply = $cb->statuses_userTimeline($params);
	unset($reply->httpstatus);
	echo json_encode($reply);exit;
}

function fw_custom_style()
{
	global $_webnukes;
	$genral_setting_background =  $GLOBALS['_webnukes']->fw_get_settings('sub_background');

	$general_setttings =  $GLOBALS['_webnukes']->fw_get_settings('sub_color_and_style');
	$custom_style = '';
	if($_webnukes->kvalue($general_setttings, 'heading_color') != ''){
		$custom_style .= 'h1,h2,h3,h4,h5,h6{
			color:'.$_webnukes->kvalue($general_setttings, 'heading_color').';
		}';
	}
	if($_webnukes->kvalue($general_setttings, 'text_color') != ''){
		$custom_style .= 'p{color:'.$_webnukes->kvalue($general_setttings, 'text_color').'
		}';
	}
	if($_webnukes->kvalue($genral_setting_background, 'type') == 'image'){
		$custom_style .='body{';
		$custom_style .= 'background-image:url('.$_webnukes->kvalue($genral_setting_background, 'bg_image').');';
		$custom_style .= 'background-repeat:'.$_webnukes->kvalue($genral_setting_background, 'repeat').';';
		$custom_style .= 'background-position:'.$_webnukes->kvalue($genral_setting_background, 'position').';';
		$custom_style .= 'background-attachment:'.$_webnukes->kvalue($genral_setting_background, 'attachment').';';
		$custom_style .= 'background-color:'.$_webnukes->kvalue($genral_setting_background, 'color').';';
		$custom_style .= '}';
	}
	if($_webnukes->kvalue($genral_setting_background, 'type') == 'pattern'){
		$custom_style .='body{';
		$custom_style .= 'background-image:url('.get_template_directory_uri().'/images/'.$_webnukes->kvalue($genral_setting_background, 'patterns').'.png);';
		$custom_style .= 'background-color:'.$_webnukes->kvalue($genral_setting_background, 'color').';';
		$custom_style .= '}';
	}
	return $custom_style;
}


function fw_load_file( $file, $args )
{
	if( file_exists( $file ) ) require( $file );
}



function fw_featured_image( $args = array() )
{
	global $post;
	$id = kvalue( $args, 'id' ) ? kvalue( $args, 'id' ) : get_post_thumbnail_id($post->ID);

	$image = wp_get_attachment_image_src( $id, kvalue( $args, 'size') );
	
	if( $image ) return current( (array) $image );
	else return false;
}



/**
 * A callback function of comments listing
 * 
 * @param	object	$comment	containg a list of comments
 * @param	array	$args		An array of arguments to merge with defaults.
 * @param	int		$depth		Containing the reply depth level.
 */

function fw_list_comments($comment, $args, $depth)
{

	$GLOBALS['comment'] = $comment; 
	if(get_comment_type() == 'comment'):?>
    		
            <li>
                <div class="comment-box" id="comment-<?php comment_ID();?>"> 
                	<figure class="snap"><?php echo get_avatar( $comment, $size='94'); /** get avatar */?></figure>
                    <div class="comment-tp"> 
                    	<?php /** check if this comment author not have approved comments befor this */
						if($comment->comment_approved == '0' ) : ?>
							<em><?php /** print message below */
							_e( 'Your comment is awaiting moderation.', THEME_NAME ); ?></em>
							<br />
						<?php endif; ?>
                        <strong><?php echo get_comment_author_link(); ?></strong>
                        <p><?php comment_date( get_option( 'date_format' ) ) .' / '. comment_time( 'g:i a' ); /** print date time */?></p>
                        
                    </div>
                    <?php comment_text(); /** print our comment text */ ?> 
                    <?php /** check if thread comments are enable then print a reply link */
					comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    
                    
                </div>
	<?php
	endif;
}


function fw_comment_form( $args = array(), $post_id = null ) 
{
	
	if ( null === $post_id )
		$post_id = get_the_ID();
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html5    = 'html5' === $args['format'];
	$fields   =  array(
		'author' => '<li class="row-fluid comment-form-author"><div class="span6">' . '<label for="author">' . __( 'Name', THEME_NAME ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input class="input-block-level" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
		'email'  => '<div class="span6"><label for="email">' . __( 'Email', THEME_NAME ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input class="input-block-level" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div></li>',
		'url'    => '<li class="comment-form-url row-fluid"><div class="span12"><label for="url">' . __( 'Website', THEME_NAME ) . '</label> ' .
		            '<input class="input-block-level" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></li>',
	);

	$required_text = sprintf( ' ' . __('Required fields are marked %s', THEME_NAME ), '<span class="required">*</span>' );
	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<li class="row-fluid comment-form-comment"><div class="span12"><label for="comment">' . _x( 'Comment', 'noun', THEME_NAME ) . '</label> <textarea class="input-block-level" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div></li>',
		'must_log_in'          => '<li class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', THEME_NAME ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</li>',
		'logged_in_as'         => '<li class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', THEME_NAME ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</li>',
		'comment_notes_before' => '<li class="comment-notes">' . __( 'Your email address will not be published.', THEME_NAME ) . ( $req ? $required_text : '' ) . '</li>',
		'comment_notes_after'  => '<li class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', THEME_NAME ), ' <code>' . allowed_tags() . '</code>' ) . '</li>',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave <strong>Reply</strong>', THEME_NAME ),
		'title_reply_to'       => __( 'Leave  <strong>Reply</strong> to %s', THEME_NAME ),
		'cancel_reply_link'    => __( 'Cancel reply', THEME_NAME ),
		'label_submit'         => __( 'Post Comment', THEME_NAME ),
		'format'               => 'xhtml',
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open( $post_id ) ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<div id="respond" class="comment-respond">
				<ul class="unstyled"><li><h2 id="reply-title" class="text-pink comment-reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h2></li></ul>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php do_action( 'comment_form_must_log_in_after' ); ?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="comment-form"<?php echo $html5 ? ' novalidate' : ''; ?>>
						<ul class="unstyled">
							<?php do_action( 'comment_form_top' ); ?>
                            <?php if ( is_user_logged_in() ) : ?>
                                <?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
                                <?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
                            <?php else : ?>
                                <?php echo $args['comment_notes_before']; ?>
                                <?php
                                do_action( 'comment_form_before_fields' );
                                foreach ( (array) $args['fields'] as $name => $field ) {
                                    echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
                                }
                                do_action( 'comment_form_after_fields' );
                                ?>
                            <?php endif; ?>
                            <?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
                            <?php echo $args['comment_notes_after']; ?>
                            <li class="row-fluid form-submit">
                            	<div class="span12">
                                	<input class="btn" name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
																<?php comment_id_fields( $post_id ); ?>
                                <?php do_action( 'comment_form', $post_id ); ?>
                                </div>
														</li>
                        </ul>
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
	<?php
}



function blog_listing()
{
	while(have_posts() ): the_post();?>
        
        <section class="blog-box">
            
            <?php if( has_post_thumbnail() ): ?>
            	<div class="image"> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('events-top'); ?></a> </div>
            <?php endif; ?>
            
            <div class="blog-info clearfix">
                <div class="blog-left">
                    <figure class="snap"><?php echo get_avatar( get_the_author_meta('ID')); ?></figure>
                    <a class="blog-author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a>
                    <?php the_category(); ?>
                </div>
                
                <!-- blog-left ends -->
                <div class="blog-details">
                    <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                    <p class="date"><?php echo get_the_date(); ?></p>
                    <?php the_excerpt(); ?>
                    <a class="readmore" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php _e('Read More', THEME_NAME); ?></a> 
                </div>
                <!-- details end --> 
            </div>
            <!-- blog-info ends --> 
        </section>
	
    <?php
	endwhile;
}

function fw_new_excerpt_more( $more ) {
	return ' <a href="'.get_permalink().'" title="'.__('Read More', THEME_NAME).'">.....</a>';
}
add_filter('excerpt_more', 'fw_new_excerpt_more');


/**
 * this function either prints or return the pagination of any archive/listing page.
 *
 * @param	array	$args	Array of arguments
 * @param	bolean	$echo	whether print or return the output.
 *
 * @return	string	Prints or return the pagination output.
 */
function fw_the_pagination($args = array(), $echo = 1)
{
	
	global $wp_query;
	
	$default =  array('base' => str_replace( 99999, '%#%', esc_url( get_pagenum_link( 99999 ) ) ), 'format' => '?paged=%#%', 'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages, 'next_text' => __('Next', THEME_NAME), 'prev_text' => __('Prev', THEME_NAME), 'type'=>'list');
						
	$args = wp_parse_args($args, $default);			
	
	$pagination = '<div class="pagination pagination-left">'.paginate_links($args).'</div>';
	
	if(paginate_links(array_merge(array('type'=>'array'),$args)))
	{
		if($echo) echo $pagination;
		return $pagination;
	}
}


function fw_set_custom_query( $query )
{

	//if( kvalue( $query->query, 'fw_album' ) ) $query->set( 'post_type', 'fw_audio' );
	if( kvalue( $query->query, 'event_category' ) ) $query->set( 'post_type', 'fw_event' );

	return $query;
}

add_action('pre_get_posts', 'fw_set_custom_query');


function fw_set_banner( $tpl = 'cat' )
{
	global $post;
	
	if( is_singular() ){
		$p_type = kvalue( $post, 'post_type');
		$settings = get_post_meta(kvalue( $post, 'ID' ), 'wpnukes_'.$p_type.'_settings', true);//printr($settings);
		$data = ( kvalue($settings, $tpl.'_banner_heading') || kvalue( $settings, $tpl.'_banner_image' ) ) ? true : false;
		if( !$data ) $settings = $GLOBALS['_webnukes']->fw_get_settings('sub_detail_page');
	}
	else $settings = $GLOBALS['_webnukes']->fw_get_settings('sub_blog_listing');//printr($settings);?>
    
    	<div style="background:url(<?php echo kvalue( $settings, $tpl.'_banner_image');?>);" class="banner">
            <div class="container">
                <h1><?php echo kvalue( $settings, $tpl.'_banner_heading');?></h1>
                <div class="bread-bar clearfix">
                    <?php echo get_the_breadcrumb(); ?>
                </div>
            </div>
        </div>
		
	<?php 
}


function fw_contact_form_submit()
{
	$t = $GLOBALS['_webnukes'];
	$t->load('validation_class');
	$settings = $t->fw_get_settings('sub_contact_page_settings');
	$recaptcha_opt = $t->fw_get_settings('sub_APIs');

	/** set validation rules for contact form */
	$t->validation->set_rules('contact_name','<strong>'.__('Name', THEME_NAME).'</strong>', 'required|min_length[4]|max_lenth[30]');
	$t->validation->set_rules('contact_email','<strong>'.__('Email', THEME_NAME).'</strong>', 'required|valid_email');
	$t->validation->set_rules('contact_subject','<strong>'.__('Subject', THEME_NAME).'</strong>', 'required|min_length[5]');
	$t->validation->set_rules('contact_message','<strong>'.__('Message', THEME_NAME).'</strong>', 'required|min_length[5]');
	if( kvalue($settings, 'captcha_status') == 'on')
	{
		$challenge = $_POST['recaptcha_challenge_field'];
		$response = $_POST['recaptcha_response_field'];
		$recaptcha_response = recaptcha_check_answer ($recaptcha_opt['recaptcha_p_key'], $_SERVER['REMOTE_ADDR'], $challenge, $response);
		if( !$recaptcha_response->is_valid )
		{
			$t->validation->_error_array['captcha'] = __('Invalid captcha entered, please try again.', THEME_NAME);
		}
	}
	
	$messages = '';
	
	if($t->validation->run() !== FALSE && empty($t->validation->_error_array))
	{
		$name = $t->validation->post('contact_name');
		$email = $t->validation->post('contact_email');
		$subject = $t->validation->post('contact_subject');
		$message = $t->validation->post('contact_message');
		$contact_to = ( kvalue($settings, 'contact_email') ) ? kvalue($settings, 'contact_email') : get_option('admin_email');
		
		$headers = 'From: '.$name.' <'.$email.'>' . "\r\n";
		wp_mail($contact_to, $subject, $message, $headers);
		
		$message = kvalue($settings, 'success_msg') ? $settings['success_msg'] : sprintf( __('Thank you <strong>%s</strong> for using our contact form! Your email was successfully sent and we will be in touch with you soon.',THEME_NAME), $name);

		$messages = '<div class="alert alert-success">
						<p class="title">'.__('SUCCESS! ', THEME_NAME).$message.'</p>
					</div>';
							
		if( kvalue($settings, 'redirect_url')){
			wp_redirect(kvalue($settings, 'redirect_url'));exit;
		}
	}else
	{
		 if( is_array( $t->validation->_error_array ) )
		 {
			 foreach( $t->validation->_error_array as $msg )
			 {
				 $messages .= '<div class="alert alert-error">
									<p class="title">'.__('Error! ', THEME_NAME).$msg.'</p>
								</div>';
			 }
		 }
	}
	
	return $messages;
}


function fw_apply_color_scheme( $cookie = false )
{
	$styles = $GLOBALS['_webnukes']->fw_get_settings('sub_color_and_style', 'style', '#96c052');
	$_COOKIE['fw_color_scheme'] = isset( $_COOKIE['fw_color_scheme'] ) ? $_COOKIE['fw_color_scheme'] : $styles;

	$custom_style = ( $cookie && isset( $_COOKIE['fw_color_scheme'] ) ) ? $_COOKIE['fw_color_scheme'] : $styles;
	
	$content = @file_get_contents(get_template_directory_uri().'/css/color.css');
	
	if( $custom_style ){
		
		
		$replace = str_replace('#96c052', $custom_style, $content );
		
		$replace = ( $custom_style ) ? $replace : $content ;
	}else $replace = $content;
	
	echo "\n".'<style title="fw_color_scheme">'.$replace.'</style>';
}






