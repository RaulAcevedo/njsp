<?php get_header(); 
$t = $GLOBALS['wpnukes_gal'];//printr($t);
$settings = $GLOBALS['_webnukes']->fw_get_settings('sub_general_settings');
$span_array = array('2'=>'span6', '3'=>'span4', '4'=>'span3');?>

<?php fw_set_banner('gal'); ?>

<div class="container">
    <div class="gallery">
        <h2><?php the_title(); ?></h2>
        <div class="row" id="gallery"> 
        	<?php while( have_posts() ): the_post(); ?>
            	
                <?php $gal = $t->gallery_array( get_the_ID(), 'gallery-col' ); //printr($gal) ?>
                
                <?php foreach( $gal as $g ): ?>
                    <div class="<?php echo kvalue( $span_array, kvalue( $settings, 'gallery_view', 3)); ?>">
                        <div class="image col<?php echo kvalue( $settings, 'gallery_view', 3); ?>">
                        
                            <a title="gallery image" data-rel="prettyPhoto[gallery1]" href="<?php echo kvalue( $g, 'url'); ?>">
                            	<img alt="thumb" src="<?php echo kvalue( $g, 'thumb'); ?>">
                                <div class="image-info">
                                    <p><?php echo kvalue( $g, 'title'); ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
            	<?php endforeach; ?>
            <?php endwhile; ?>
        </div>
        
        <div id="pagination" class="pagination pagination-centered"></div>
       
    </div>
</div>


<?php get_footer(); ?>