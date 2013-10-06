jQuery(document).ready(function($) {
		
	var temp = window.send_to_editor;
	// Restore the main ID when the add media button is pressed
	jQuery('em.upload_image').on('click', function() {
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		var field = $(this).prev().attr('id');
		window.send_to_editor = function(html){
			var img = $('img', html).attr('src');
			$('#'+field).val(img);
			window.send_to_editor = temp;
			tb_remove();
			//$('#album_image_preview').html('<img src="'+img+'" height="150" width="150" />');
		}
	
	});
	  
});
