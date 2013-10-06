<?php /* Template Name: Evetns */
get_header(); 
$setting  = get_post_meta(get_the_ID(), 'wpnukes_page_settings', true);
$paged = get_query_var('paged');?>

<?php fw_set_banner('page'); ?>
<div class="container">
    <div class="row">
        <div class="span9"> 
        	<?php $query = new WP_Query( array('post_type'=>'fw_event', 'paged'=>$paged, 'showposts'=>get_option('posts_per_page'), 'meta_key' =>'fw_event_start_time', 'meta_query' => array(array('key' => 'fw_event_start_time', 'value' => date('Y-m-d h:i:s'), 'type' => 'date', 'compare' => '>='	)), 'orderby'=>'meta_value', 'order'=>'ASC') );//printr($query);

			fw_load_file( get_template_directory().'/libs/events/upcoming.php', array('query'=>$query) ); ?>
            
            <?php fw_the_pagination(array('total'=>$query->max_num_pages)); ?>
            <?php wp_reset_query(); ?>
        </div>
        <div class="span3">
        	<?php dynamic_sidebar(kvalue( $setting, 'sidebar' )); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>