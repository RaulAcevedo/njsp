<?php get_header(); 
$settings = $GLOBALS['_webnukes']->fw_get_settings('sub_blog_listing');?>

<div style="background:url(<?php echo kvalue( $settings,'search_banner_image');?>);" class="banner">
    <div class="container">
        <h1><?php echo str_replace( '%s', '"'.get_search_query().'"', kvalue($settings, 'search_banner_heading') ); ?></h1>
        <div class="bread-bar clearfix"> <?php echo get_the_breadcrumb(); ?> </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="span9">
        	<?php blog_listing(); ?>
            <?php fw_the_pagination(); ?>
        </div>
        <div class="span3"><?php dynamic_sidebar( kvalue( $settings, 'search_sidebar') ); ?></div>
	</div>
</div>

<?php get_footer(); ?>