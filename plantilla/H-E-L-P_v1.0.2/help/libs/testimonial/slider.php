<?php $query = kvalue( $args, 'query' ); ?>

<?php if( $query->have_posts() ): ?>
    
    <div class="testimonials">
        <div class="<?php echo (kvalue( $args, 'container')) ? 'container' : 'child-container'; ?>">
            <div class="testimonial-detail">
                <ul class="testimoni">
                    
                    <?php while( $query->have_posts() ): $query->the_post(); ?>
                    
                        <?php $settings = get_post_meta(get_the_ID(), 'wpnukes_fw_testimonial_settings', true); //printr($settings);?>
                        <li>
                            <blockquote>
                                <?php the_content(); ?>
                            </blockquote>
                            <span class="name"><?php the_title(); ?> | <?php  echo kvalue( $settings, 'company'); ?></span> 
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php wp_reset_query(); ?>