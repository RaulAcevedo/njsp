<?php $settings = kvalue( $args, 'settings' );
$query = kvalue( $args, 'query'); ?>

<?php if( $query->have_posts() ): ?>

<div class="events">
	<?php if( $section_title = kvalue( $settings, 'title') ): ?> 
		<h2><?php echo $section_title; ?></h2>
    <?php endif; ?>
    
	<div class="events-area">
		<ul class="events-list">
			<?php $count = 1; ?>
            
            <?php while( $query->have_posts() ): $query->the_post(); ?>
                    <?php $meta = get_post_meta(get_the_ID(), 'wpnukes_fw_event_settings', true); ?>
                    <li>
                        <div class="event-box <?php echo ($count == 1) ? 'event-box-featured' : ''; ?>">
                            <?php if( has_post_thumbnail()): ?>
                                <figure class="image"> 
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if( $count == 1 ): ?>
                                        	<img src="<?php echo fw_featured_image(array('size'=>array(870, 290))); ?>"  />
                                        <?php else: ?>
                                        <?php the_post_thumbnail('events-small'); ?>
                                        <?php endif; ?>
                                    </a> 
                                </figure>
                            <?php endif; ?>
                            <div class="detail">
                                <h5><a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
                                <ul>
                                    <li>
                                        <span><i class="icon-date"></i><?php echo date('d - m - Y', strtotime(kvalue( $meta, 'event_start')) ); ?></span>
                                        <span>
                                            <?php echo date('h:ia', strtotime(kvalue( $meta, 'event_start')) ); ?> - 
                                            <?php echo date('h:ia', strtotime(kvalue( $meta, 'event_end')) ); ?>
                                        </span>
                                    </li>
                                    <li><span><i class="icon-location"></i><?php echo kvalue( $meta, 'event_place'); ?></span></li>
                                </ul>
                            </div>
                        </div>
                        <!-- event-box ends --> 
                    </li>
    
                    
    
            <?php $count++;
            endwhile; ?>
		</ul>
    </div>
</div>
<?php endif; ?>

<!-- events end --> 
  
