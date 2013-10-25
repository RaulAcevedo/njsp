<?php get_header();?>
	<div class="container">
    	<div class="row">
            <div class="page-404">
                <span>404</span>
                <h2><?php echo __('Página no encontrada', THEME_NAME);?></h2>
                <p><?php echo __('Lo sentimos pero la página solicitada no fue encontrada.<br /> Por favor, utilice la búsqueda o regrese a la  to <a href="'.home_url().'">Página Principal</a>.', THEME_NAME);?></p>
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
<?php get_footer();?>