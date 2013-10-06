<?php get_header(); ?>

<?php $settings = get_post_meta(get_the_ID(), 'wpnukes_page_settings', true);?>

<div style="background:url(<?php echo kvalue( $settings,'page_banner_image');?>);" class="banner">
    <div class="container">
        <h1><?php echo kvalue($settings, 'page_banner_heading'); ?></h1>
        <div class="bread-bar clearfix"> <?php echo get_the_breadcrumb(); ?> </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="span9">
        	<?php while( have_posts() ): the_post(); ?>
                
            	<section class="blog-box">
                	<div class="details">
                    	<div class="location-map">
                          <?php if( has_post_thumbnail() ) the_post_thumbnail('events-top'); ?>
                        </div>
                        <h4><?php the_title(); ?></h4>
                        <ul class="list">
                        	<li><span><a href="#"><i class="icon-user"></i><?php the_author();?></a></span></li>
                            <li>
                                <span><i class="icon-date"></i><?php the_date(); ?></span>
                            </li>
                            <li><span><i class="icon-list"></i><?php the_category(', '); ?></span></li>
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
                
                <?php if( kvalue( $settings, 'enable_comments' ) == 'on' ): ?>
                	<?php comments_template(); ?>
                <?php endif; ?>
                
            <?php endwhile; ?>
        </div>
        <div class="span3">
        	<?php dynamic_sidebar( kvalue( $settings, 'sidebar') ); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>