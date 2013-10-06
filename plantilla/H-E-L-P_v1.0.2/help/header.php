<?php global $wp_query; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">
<title>
<?php ( is_home() || is_front_page() ) ? bloginfo('name') : wp_title(); ?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php if( $favicon = $GLOBALS['_webnukes']->fw_get_settings('sub_header_settings', 'favicon' ) ): ?>
	<link rel="icon" type="image/png" href="<?php echo $favicon; ?>" />
<?php endif; ?>

<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<?php wp_head(); ?>
</head>
 
<body <?php body_class(); ?>>
<div class="wrap">
    
  <div class="tp-bar">
    <div class="container">
    
        <div class="logo">
			<?php $logo = $GLOBALS['_webnukes']->fw_get_settings('sub_logo');
             $logo_src = kvalue($logo, 'logo');?>
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo ( $logo_src ) ? $logo_src : get_template_directory_uri().'/images/logo.png'; ?>" alt="<?php bloginfo('name');?>"> 
            </a>
            <span class="slogan"> <?php bloginfo('description'); ?> </span> 
        </div>
        <!-- logo ends -->
        
      <div class="tp-right">
        <div class="social-links">
          <ul>
            <?php echo fw_social_networks(); ?>
          </ul>
        </div>
        <div class="tweets">
        	<?php $header_settings = $GLOBALS['_webnukes']->fw_get_settings('sub_header_settings');
			if( kvalue( $header_settings, 'twitter_status' ) == 'on' ):
				FW_Twitter(array('selector'=>'#tweet', 'template' => 'li','count'=>kvalue($header_settings, 'tweet_number'), 'screen_name'=> kvalue($header_settings, 'twitter_id'))); ?>
				
				<ul id="tweet"></ul>
			<?php endif; ?>
          
        </div>
      </div>
    </div>
  </div><!-- tp-bar ends -->
  <nav class="menu-bar">
    <div class="container">
      <a href="#" class="tablet-menu"></a>
      <?php wp_nav_menu(array('theme_location' => 'main_menu', 'container'=>null, 'menu_class' => 'menu', 'fallback_cb' => false)); ?>
      <!-- menu ends --> 
      
      <div class="user-controls">
        <?php if( !is_user_logged_in() ): ?>
        	<a href="#" class="user-login"></a>
        <?php endif; ?>
        <a href="#" class="user-search"></a>
      </div>
    </div>
  </nav><!-- menu-bar ends -->