<?php get_header(); ?>

<?php $settings = get_post_meta(get_the_ID(), 'wpnukes_fw_event_settings', true); ?>

<div style="background:url(<?php echo kvalue( $settings,'post_banner_image');?>);" class="banner">
    <div class="container">
        <br /> 
        <h1>Detalles del Evento</h1>
        <div class="bread-bar clearfix"> <?php echo get_the_breadcrumb(); ?> </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="span9">
        	<?php while( have_posts() ): the_post(); ?>
            	
                <?php $meta = get_post_meta(get_the_ID(), 'wpnukes_fw_event_settings', true); //printr($meta); ?>
                
            	<section class="blog-box">
                	<div class="details">
                    	<div class="location-map">
                          <iframe src="http://maps.google.com/?ie=UTF8&q=<?php echo kvalue( $meta, 'event_place'); ?>&amp;ll=<?php echo kvalue( $meta, 'lat'); ?>,<?php echo kvalue( $meta, 'lang'); ?>&amp;&amp;t=m&amp;z=10&amp;output=embed&amp;spn=0.006295,0.006702&amp;daddr=Lugar%40<?php echo kvalue( $meta, 'lat'); ?>,<?php echo kvalue( $meta, 'lang'); ?>"></iframe>
                        </div>
                        <h4><?php the_title(); ?></h4>
                        <ul class="list">
                            <li>
                                <span><i class="icon-date"></i><?php echo date('d - m - Y', strtotime(kvalue( $meta, 'event_start')) ); ?></span>
                                <span>
                                    <?php echo date('h:ia', strtotime(kvalue( $meta, 'event_start')) ); ?> - 
                                    <?php echo date('h:ia', strtotime(kvalue( $meta, 'event_end')) ); ?>
                                </span>
                            </li>
                            <li><span><i class="icon-location"></i><?php echo kvalue( $meta, 'event_place'); ?></span></li>
                        </ul>
                        <?php the_content(); ?>
                        
                        <?php if( kvalue( $settings, 'author_box' ) == 'on' ): ?>
                            <div class="author-box">
                              
                              <figure class="snap">
                                <?php echo get_avatar( get_the_author_meta( 'ID' ), 78 ); ?>
                              </figure>
                              <div class="auth-details">
                                <h4><?php _e('Author', THEME_NAME); ?> - <?php the_author(); ?></h4>
                                <p><?php echo get_the_author_meta('description'); ?> </p>
                              </div>
                            </div>
                        <?php endif; ?>
                        
                    </div>
                </section>
                <?php comments_template(); ?>
            <?php endwhile; ?>
        </div>
        <div class="span3">
        	<?php dynamic_sidebar( kvalue( $settings, 'sidebar') ); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>