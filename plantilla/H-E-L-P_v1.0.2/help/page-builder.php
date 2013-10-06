<?php /* Template Name: Page Builder */
get_header(); 
$t = $GLOBALS['_webnukes'];
$t->load('layout_class');
$settings = get_post_meta(get_the_ID(), 'page_builder_data', true);//printr($settings);
$lay = kvalue( $settings, 'structure' );?>


<?php $setting = get_post_meta(get_the_ID(), 'wpnukes_page_settings', true);//printr($setting);?>

<div style="background:url(<?php echo kvalue( $setting,'page_banner_image');?>);" class="banner">
    <div class="container">
        <h1><?php echo kvalue($setting, 'page_banner_heading'); ?></h1>
        <div class="bread-bar clearfix"> <?php echo get_the_breadcrumb(); ?> </div>
    </div>
</div>

<div class="container">

    <div class="row">
        
		<?php $t->layout->sidebar( $settings, 'left' ); ?>
        
        <?php if( $lay == 'col-full' || !$lay ) $content_span = 'span12';
		elseif( $lay == 'col-left2' || $lay == 'col-right2' || $lay == 'col-both' ) $content_span = 'span6';
		else $content_span = 'span8'; ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class("contents ".$content_span); ?> style="margin-bottom:20px;" >
            
            <?php $t->layout->build_page($settings); ?>
        </article>
        
        <?php $t->layout->sidebar( $settings, 'right' ); ?>
	</div>
    
</div>

<?php get_footer(); ?>