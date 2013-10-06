<?php wp_nonce_field( plugin_basename( $this->path ), 'wpnukes_gallery_content_nonce' );?>



<script type="text/javascript">var nukes_videos = <?php echo json_encode(get_post_meta(get_the_ID(), 'wpnukes_videos', true));?></script>

<p>

	<div id="video-ctrls">

    	<div class="left_ctrl">

			<input type="button" id="add-videos" href="#" class="button left" value="<?php _e('Show Video Grabber', THEME_NAME);?>">

   		</div>

        <div class="right_ctrl" id="vid-filter"></div>

        <div class="clear"></div>

	</div>

	

	<div id="vid-pagination"></div>

	<div class="upload_gallery" id="video-gallery">

	

		<div id="video-uploader">

			<p><label for="smashing-post-class"><?php _e( 'Enter the URL of videos to upload, you can upload multiple videos at once', THEME_NAME ); ?> </label></p>

			<div class="ui-progressbar progressbar">

				<div class="ui-progressbar-value"></div>

			</div>

			

			<div class="gallery_upload_list">

				<textarea id="video_manager" rows="5" cols="90" name="video_manager"></textarea>

				<a id="process-videos" href="#" class="button button-primary"><?php _e('Process Videos', THEME_NAME);?></a>

			</div>

			

			<div class="gallery_upload_log">

				<ul id="logs"><li><h1><i><?php _e('LIVE VIDEOS LOG', THEME_NAME);?></i></h1></li></ul>

			</div>

            <div class="clear"></div>

		</div>

	

		<ul id="thumbnail"></ul>

	</div>

	

	<div class="clear"></div>

	

	<div id="play-video"></div>

</p>