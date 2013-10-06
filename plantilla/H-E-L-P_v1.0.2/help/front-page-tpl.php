<?php /* Template Name: Frontpage */
get_header(); ?>

<?php $g_settings = $GLOBALS['_webnukes']->fw_get_settings('sub_general_settings'); 
$s_settings = $GLOBALS['_webnukes']->fw_get_settings('sub_home_page_slider');?>

<?php if( kvalue( $s_settings, 'status') == 'on' ): ?>
    <div class="fullwidthbanner-container">
        <?php if( function_exists( 'putRevSlider') && kvalue( $s_settings, 'home_revslider') ) 
        putRevSlider(kvalue( $s_settings, 'home_revslider'),"homepage") ?>
    </div>
<?php endif; ?>

<?php //get_template_part('libs/homepage_slider'); ?>
<?php if( $GLOBALS['_webnukes']->fw_get_settings( 'sub_message_box', 'msg_status' ) == 'on' ): ?>
<?php $settings = $GLOBALS['_webnukes']->fw_get_settings( 'sub_message_box' ); ?>

<div class="alert alert-full">
    <div class="container">
        <div class="alert-contents">
            <h4><?php echo kvalue( $settings, 'msg_heading'); ?></h4>
            <p><?php echo kvalue( $settings, 'msg_text'); ?></p>
            <a href="#" class="close">x</a> </div>
    </div>
</div>
<!-- alert ends -->
<?php endif; ?>
<div class="container">
    <div class="row">
        <div class="span6">
        	<?php $settings = $GLOBALS['_webnukes']->fw_get_settings( 'sub_upcoming_events');
            $query = new WP_Query(array('post_type'=>'fw_event', 'showposts'=>kvalue( $settings, 'number'), 'meta_key' =>'fw_event_start_time', 'meta_query' => array(array('key' => 'fw_event_start_time', 'value' => date('Y-m-d h:i:s'), 'type' => 'date', 'compare' => '>='	)), 'orderby'=>'meta_value', 'order'=>'ASC'));//printr($query); ?>
            <?php fw_load_file( get_template_directory().'/libs/events/upcoming.php', array('settings'=> $settings, 'query'=>$query) ); ?>
            <?php wp_reset_query(); ?>
        </div>
        
        <div class="span3"><?php dynamic_sidebar('homepage-sidebar1'); ?></div>
	    <div class="span3"><?php dynamic_sidebar('homepage-sidebar2'); ?></div>
   	</div> 
    
</div>

<?php //$settings = $GLOBALS['_webnukes']->fw_get_settings('sub_general_settings');
if( kvalue( $g_settings, 'testi_status') == 'on'){
	$query = new WP_Query('post_type=fw_testimonial&orderby='.kvalue( $g_settings, 'testi_order', 'date').'&order=DESC&showposts='.kvalue($g_settings, 'testi_number', 5));
	fw_load_file( get_template_directory().'/libs/testimonial/slider.php', array('query'=>$query, 'container'=>true) ); 
}
?>
                    
<?php get_footer(); ?>
