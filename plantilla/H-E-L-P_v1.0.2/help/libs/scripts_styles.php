<?php if ( ! defined('ABSPATH')) exit('restricted access');

if( ! is_admin())
{
	/** Include styles and scripts */
	add_action('wp_enqueue_scripts', 'fw_enqueue_scripts');
	
	/** add action to wp_print_styles for print our styles */
	add_action('wp_head', 'fw_theme_head', 30);
	
	/** add action wp_footer */
	add_action('wp_footer', 'fw_theme_footer', 30);
}

function fw_enqueue_scripts()
{
	global $wp_styles, $wp_query;
	$css_dir = THEME_URL . 'css/';
	$js_dir = THEME_URL . '/js/';
	

	$scripts = array('jquery-countdown'=>'jquery.countdown.js', 'jquery-ui-tooltip'=>'jquery-ui-tooltip.js','jquery-bxslider'=>'jquery.bxslider.js', 'jquery-prettyPhoto'=>'jquery.prettyPhoto.js',
				'jquery-jPages'=>'jPages.js', 'jquery-cookie'=>'jquery.cookie.js',
				'custom-scripts'=>'script.js', 'custom-js'=>'custom.js');
	
	
	fw_demo_color_picker();
		
	/** register and enqueue scripts */
	foreach($scripts as $js => $file)
	{
		wp_register_script($js, $js_dir.$file, array(), '', true);
	}
	
	wp_enqueue_script(array('jquery', 'jquery-ui-core', 'jquery-ui-dialog', 'jquery-effects-drop', 'jquery-ui-tooltip', 'jquery-cookie'));
	//if( is_home() || is_front_page() ) wp_enqueue_script( array('jquery-themepunch-revolution-min') );

	if( is_singular( 'wpnukes_galleries' ) ) wp_enqueue_script( 'jquery-prettyPhoto' ); 

	if( is_single() || is_page() ) wp_enqueue_script( array('comment-reply' ) );
	
	if( is_page_template('page-builder.php' ) ) wp_enqueue_script(array('jquery-prettyPhoto', 'jquery-bxslider'));
	if( is_singular( 'wpnukes_galleries' ) ) wp_enqueue_script( array( 'jquery-jPages' ) );
	
	
	wp_enqueue_script( array( 'custom-scripts', 'custom-js' ) );
	
	$cache = wp_cache_get( 'alloptions', 'options');
	if( kvalue( $cache, 'google_web_fonts' ) ) $fonts = kvalue( $cache, 'google_web_fonts' );
	else $fonts = @file_get_contents(get_template_directory().'/libs/default_fonts');
	$fonts = @json_decode($fonts);
	
	/** Applying google fonts for headings and content */
	$font_family = $GLOBALS['_webnukes']->fw_get_settings('sub_fonts_settings', 'font_family');
	$content_family = $GLOBALS['_webnukes']->fw_get_settings('sub_fonts_settings', 'content_family');//printr($font_settings);
	$google_font = '';
	$google_content_font = '';
	
	if( $fonts )
	{
		foreach( (array)kvalue( $fonts, 'items' ) as $f )
		{
			$family = kvalue( $f, 'family');
			if( $family == $font_family ){
				$google_font = str_replace(' ', '+', $family) ;
				if( $varians = kvalue( $f, 'variants') ) $google_font .= ':'.implode(',',$varians);
				if( $subset = kvalue( $f, 'subsets') ) $google_font .= '&subset='.implode(',',$subset);
			}
			if( kvalue( $f, 'family') == $content_family ) {
				$google_content_font = str_replace(' ', '+', $family) ;
				if( $varians = kvalue( $f, 'variants') ) $google_content_font .= ':'.implode(',',$varians);
				if( $subset = kvalue( $f, 'subsets') ) $google_content_font .= '&subset='.implode(',',$subset);
			}
			
			if( $google_content_font && $google_font ) break;
		}
	}
	
	if( ! $google_font ) $google_font = 'Droid+Sans:400,700';
	if( ! $google_content_font ) $google_content_font = '';
	
	/** Include style files */
	$styles = array (
		'main-styles' => 'style.css',
		'common-styles' => 'css/common.css',
		'responsive-styles' => 'css/responsive.css',
		'slider' => 'css/slider.css',
		'prettyPhoto' => 'css/prettyPhoto.css',
	);
	wp_enqueue_style( 'google_font_family', 'http://fonts.googleapis.com/css?family='.$google_font);
	if( $google_content_font ) wp_enqueue_style( 'goog_font_content_family', 'http://fonts.googleapis.com/css?family='.$google_content_font);
	
	foreach($styles as $css=>$file)
	{
		/** register our stylesheets from array */
		wp_register_style($css, THEME_URL.'/'.$file, false, '1.0', 'screen' );
		wp_enqueue_style( $css );
	}
	
	//$wp_styles->add_data( 'ie9lt', 'conditional', 'lt IE 9' );
	
}

function fw_theme_head()
{
	global $_webnukes;
	echo '<script type="text/javascript">var ajaxurl="'.admin_url('admin-ajax.php').'";</script>'."\n";
	$font_settings = $GLOBALS['_webnukes']->fw_get_settings('sub_fonts_settings');
	$bg_settings = $GLOBALS['_webnukes']->fw_get_settings('sub_background');//printr($font_settings);
	
	$style = '<style>';
	if( $font_family = kvalue( $font_settings, 'font_family' ) ) $style .= 'h1, h2, h3, h4, h5, h6{ font-family: '.$font_family.' !important;}';
	if( $content_family = kvalue( $font_settings, 'content_family' ) ) $style .= 'body{ font-family: '.$content_family.' !important;}';
	
	foreach( range(1, 6) as $h )
	{
		if( kvalue( $font_settings, 'h'.$h ) ) $style .= 'h'.$h.'{ font-size: '.kvalue( $font_settings, 'h'.$h ).'px !important;}';
	}
	$style .= fw_custom_style();
	if( $body_size = kvalue( $font_settings, 'body' ) ) $style .= 'body{ font-size: '.$body_size.' !important;}';
	$style .= '</style>';
	
	echo $style;
	fw_apply_color_scheme();
	echo $_webnukes->fw_get_settings('sub_header_settings', 'css_js')."\n";
}

function fw_theme_footer()
{
	global $_webnukes, $wp_query;
	$slider_settings = $_webnukes->fw_get_settings('sub_cslider');
	if( is_archive() || is_singular('post') || $wp_query->is_posts_page): ?>
		
	<?php endif; ?>
    
	<script type="text/javascript">
    /*** Slides Script ***/
    jQuery(document).ready( function($){
        
        <?php if( is_page_template('front-page-tpl.php') ): ?>
        /*** Home page slider ***/	
        if( $('#da-slider').length !== 0 ){
            $('#da-slider').cslider({
                bgincrement	: <?php echo (int)kvalue( $slider_settings, 'bgincrement'); ?>,	// increment the bg position (parallax effect) when sliding
                autoplay	: <?php echo (kvalue( $slider_settings, 'autoplay')) ? 'true' : 'false'; ?>,// slideshow on / off
                interval	: <?php echo kvalue( $slider_settings, 'interval') ? kvalue( $slider_settings, 'interval') : 4000; ?>  // time between transitions
            });
        } 
        <?php endif;?>    
		
		<?php if( is_singular('wpnukes_galleries') ): ?>
			$("div#pagination").jPages({
				containerID : "gallery",
				perPage : <?php echo kvalue($GLOBALS['_webnukes']->fw_get_settings( 'sub_general_settings' ), 'gallery_per_page', 8); ?>,
				startPage    : 1,
				startRange   : 1,
				midRange     : 5,
				endRange     : 1,
				previous	 : "<?php _e('Previous', THEME_NAME); ?>",
				next		 : "<?php _e('Next', THEME_NAME); ?>",
				
			});
		<?php endif; ?>   
    });
    </script>
    
   
	<?php echo "\n".$_webnukes->fw_get_settings('sub_footer_settings', 'analytics')."\n";
}

function fw_demo_color_picker()
{
	wp_enqueue_style( 'wp-color-picker' );
	
	wp_enqueue_script(
        'iris',
        admin_url( 'js/iris.min.js' ),
        array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ),
        false,
        1
    );
    wp_enqueue_script(
        'wp-color-picker',
        admin_url( 'js/color-picker.min.js' ),
        array( 'iris' ),
        false,
        1
    );
    $colorpicker_l10n = array(
        'clear' => __( 'Clear' ),
        'defaultString' => __( 'Default' ),
        'pick' => __( 'Select Color' )
    );
    wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n );
}

function fw_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'fw_login_logo_url' );

function fw_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'fw_login_logo_url_title' );

function fw_login_stylesheet() { ?>
    <link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo get_template_directory_uri() . '/css/style-login.css'; ?>" type="text/css" media="all" />
    <style>
		.login h1 a{background-image:url(<?php echo kvalue('', '', get_template_directory_uri().'/images/logo-inverse.png');?>);}
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'fw_login_stylesheet' );