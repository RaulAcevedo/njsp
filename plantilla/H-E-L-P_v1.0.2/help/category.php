<?php get_header(); 
$settings = $GLOBALS['_webnukes']->fw_get_settings('sub_blog_listing');?>

<?php fw_set_banner('cat'); ?>

<div class="container">
    <div class="row">
        <div class="span9">
        	<?php blog_listing(); ?>
            <?php fw_the_pagination(); ?>
        </div>
        <div class="span3"><?php dynamic_sidebar( kvalue( $settings, 'cat_sidebar') ); ?></div>
	</div>
</div>

<?php get_footer(); ?>