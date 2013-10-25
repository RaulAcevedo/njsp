<?php  /* Template Name: Contact */
get_header(); 
$meta = get_post_meta(get_the_ID(), 'wpnukes_page_settings', true); //printr($meta);
$settings = $GLOBALS['_webnukes']->fw_get_settings('sub_contact_page_settings');?>

<?php $banner = ( !kvalue( $settings, 'google_map_status') ) ? 'background-image:'.kvalue($meta, 'page_banner_image') : ''; ?>
<div class="banner" style=" <?php echo $banner; ?> ">
	<?php if( kvalue( $settings, 'google_map_status') ): ?>
        <div class="location-map">
            <?php echo kvalue( $settings, 'google_map' ); ?>
        </div>
    <?php endif; ?>
    
    <div class="container">
        <h1><?php echo kvalue($meta, 'page_banner_heading'); ?></h1>
        <div class="bread-bar clearfix"> <?php echo get_the_breadcrumb(); ?> </div>
    </div>
</div>

<div class="container">
    
    <div class="row">
    	<div class="span5">
            <?php dynamic_sidebar(kvalue($meta, 'sidebar')); ?>
		</div>
       	<div class="span7">
        	<section class="comment-area">
            	<h2 class="text-pink"><?php _e('Déjenos <strong>sus comentarios</strong>', THEME_NAME); ?></h2>
        		<?php fw_contact_form($settings); //do_shortcode('fw_contact_form'); ?>
            </section>
        </div>
	</div>
</div>
<?php get_footer(); ?>