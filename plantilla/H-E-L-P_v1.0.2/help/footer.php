
<footer class="footer">
	<div class="container">
    	<div class="row"><?php dynamic_sidebar('footer-sidebar'); ?></div>
    </div>
</footer>

<div class="bottom">
    <div class="container">
        <div class="bottom-left">
            <p><?php echo $GLOBALS['_webnukes']->fw_get_settings('sub_footer_settings', 'copyrights'); ?></p>
            
            <?php wp_nav_menu(array('theme_location' => 'bottom_menu', 'container'=>null, 'menu_class' => '', 'fallback_cb' => false)); ?>
		</div>
		
        <div class="social-links">
            <ul><?php echo fw_social_networks(); ?></ul>
        </div>
    </div>
</div>


<div id="dialog-search">
	<div class="heading"><?php _e('Search', THEME_NAME); ?></div>
  <div class="dialog-block">
      <form method="get" action="" class="user-search-form">
        <input type="text" name="s" class="input-block-level" placeholder="<?php _e('Enter Any Keyword', THEME_NAME); ?>">
        <input type="submit" class="btn" value="<?php _e('Search', THEME_NAME); ?>">
      </form>
  </div>
  <!-- dialog-block ends --> 
</div><!-- dialog ends -->
<div id="dialog-login">
	<div class="heading"><?php _e('User Login', THEME_NAME); ?></div>
  <div class="dialog-block">
      <form method="get" action="<?php echo home_url(); ?>/login.php" class="user-login-form">
        <input type="text" name="log" class="input-block-level" placeholder="User Login">
        <input type="password" name="pwd" class="input-block-level" placeholder="Password">
        <div class="controls">
          <label class="help-inline"><input type="checkbox" class="checkbox"><?php _e('Remeber me', THEME_NAME); ?></label>
          <input type="submit" class="btn pull-right" value="<?php _e('Sign In', THEME_NAME); ?>">
        </div>
      </form>
  </div><!-- dialog-block ends --> 
</div><!-- dialog ends -->
<div class="dialog-overlay"></div>

<?php wp_footer(); ?>




