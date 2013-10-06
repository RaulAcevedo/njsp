<?php if( ! defined('ABSPATH')) exit('restricted access'); /** Do not delete these lines */?>

<?php
/** if post is password protected then password is required */
if ( post_password_required() ):?>
	<p class="alert"><?php _e( 'This post is password protected. Enter the password to view comments.', THEME_NAME ); ?></p>
	<?php return;
endif;?>

<section class="comment-area">
	
   <?php if( have_comments() ): ?>
    <div class="heading">
    	<?php $comments_count = wp_count_comments( get_the_ID() ); ?>
        <h2><?php _e('Comments', THEME_NAME); ?> <strong>(<?php echo kvalue($comments_count, 'approved' ); ?>)</strong></h2>
    </div>
    <!-- heading ends -->
    <?php else: ?>
    	<div class="heading">
        	<h2><?php _e('No Comments', THEME_NAME); ?></h2>
        </div>
    <?php endif; ?>
    
    
	<?php
	/** Let's Seperate the comments from Trackbacks */
	if(have_comments()):?>
		<div class="user-comments">
			<ul>
				<?php wp_list_comments( 'type=comment&callback=fw_list_comments' ); /** Callback to Comments */ ?>  
			</ul>
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
				<div class="pagination"><?php paginate_comments_links(); ?></div>
			<?php endif; ?>
		</div>
	<?php else: 
		/** If comments are open, but there are no comments. */
		if( ! comments_open()) : ?>
			<h3><?php _e( 'Sorry comments are closed for this Post.', THEME_NAME ); ?></h3>
		<?php endif;
	endif; ?>
</section>
<section class="comment-area">
   <!-- <div class="comment-area">-->
    	<?php fw_comment_form(); ?>
    <!--</div>-->
    <!-- comment-area ends -->
</section>