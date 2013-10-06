<?php 



if(is_array(get_post_meta(get_the_ID(), 'wpnukes_gallery', true))) $gallery = '[gallery ids="'.implode(',', (array)get_post_meta(get_the_ID(), 'wpnukes_gallery', true)).'"]';

else $gallery = get_post_meta(get_the_ID(), 'wpnukes_gallery', true); ?>

<script type="text/javascript">var nukes_gallery = '<?php echo $gallery;?>';</script>



<div id="gal-ctrls">

    <div class="left_ctrl">

        <a href="#" class="button insert-media add_media left" data-editor="content" title="Add Media"><span class="wp-media-buttons-icon"></span><?php _e('Add / Edit Media', THEME_NAME);?></a>

        <span class="spinner" id="gallery_spinner"></span>

    </div>

    <div class="clear"></div>

</div>



<div class="upload_gallery">

	<ul id="image-gallery" class="align_left"></ul>

</div>



<div class="clear"></div>