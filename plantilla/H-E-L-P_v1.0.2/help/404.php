<?php get_header();?>
	<div class="container">
    	<div class="row">
            <div class="page-404">
                <span>404</span>
                <h2><?php echo __('Page Not Found', THEME_NAME);?></h2>
                <p><?php echo __('Sorry but the page you are looking for cannot be found.<br /> Please use search box to search anything or go back to <a href="'.home_url().'">Home page</a>.', THEME_NAME);?></p>
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
<?php get_footer();?>