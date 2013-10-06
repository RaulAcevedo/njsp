<?php get_header();//printr($wp_query);
if( is_page() || $wp_query->is_posts_page ) $settings = get_post_meta(kvalue($wp_query->query, 'page_id'), 'wpnukes_page_settings', true);
else $settings = $GLOBALS['_webnukes']->fw_get_settings('sub_blog_listing');//printr($settings);?>

<div style="background:url(<?php echo kvalue( $settings,'arc_banner_image', kvalue( $settings, 'page_banner_image'));?>);" class="banner">
    <div class="container">
        <h1><?php echo kvalue($settings, 'arc_banner_heading', kvalue( $settings, 'page_banner_heading')); ?></h1>
        <div class="bread-bar clearfix"> <?php echo get_the_breadcrumb(); ?> </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="span9">
        	<?php blog_listing(); ?>
            <?php fw_the_pagination(); ?>
        </div>
        <div class="span3"><?php dynamic_sidebar( kvalue( $settings, 'arc_sidebar', kvalue($settings, 'sidebar')) ); ?></div>
	</div>
</div>

<?php get_footer(); ?>