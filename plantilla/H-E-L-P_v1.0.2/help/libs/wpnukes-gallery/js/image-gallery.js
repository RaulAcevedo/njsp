jQuery(document).ready(function($){

	

	function add_image(data, old)

	{

		var info = $.extend({'id':'','img':'','alt':'','caption':''}, data), unique_id = 'nukes-gal-'+info.id;

		info.caption = (info.caption) ? info.caption : info.alt;

		

		/** NO duplicate */

		if($('li#'+unique_id).length) return;

		else if(info.img)

			$('#image-gallery').prepend('<li id="'+unique_id+'"><img alt="'+info.alt+'" src="'+info.img+'">'+(( ! old) ? '<span class="new_tag"></span>' : '')+'<div class="upload_gal_control"><i class="featured_upload_img"></i><i class="delete_upload_img"></i></div><div class="upload_gallery_overlay">'+info.caption+'</div><input type="hidden" name="gallery[]" value="'+info.id+'"><i class="move_upload_img"></i></li>');

	}

	

	function process_img(rows, old)

	{

		$.each(rows, function(k, v){

			if($.trim(v)){

				if ( v.indexOf('[gallery') !== -1 ) {

				//$('#gallery_spinner').css('display','block');

				  ids = v.match(/ids=['"](.*?)['"]/);

				  

				  jQuery.ajax({url:ajaxurl, type:'post',data:{'action':'nukes_gallery','ids':ids[1]}, fw_gallery:true,success:function(response){

					  var imgs = $.parseJSON(response);

					  if(typeof(imgs) != 'object') return;



						$.each(imgs, function(k,v){

							add_image(v, old);

						});

						

						//$('#gallery_spinner').css('display','none');

					}});

				  

				} else if ( v.indexOf('[embed') === 0 ) {

				}else{

				    

				    var caption = '', html = $('<div>'+v+'</div>');

				    

				    if( v.indexOf('[caption') !== -1 ){

        				var mycap = v.replace(/<[^>]*>/g,'').match(/\[[^]*\](.*?)\[/);

        				caption = mycap[1];

    				}



					var id = $('img', html).attr('class').match(/wp-image-(\d+)/);

					add_image({'img':$('img', html).attr('src'), 'alt': $('img', html).attr('alt'), 'caption': caption, 'id':id[1]});

				}

			}

		});

	}

	

	$('#gal-ctrls').ajaxSend(function(event, jqxhr, settings){

			if( settings === undefined ) return false;
			
			if(undefined !== settings['data'])

			{

				var action = settings.data.match(/action=([a-z-_]+)/);

				

				if((undefined != action[1]) && (action[1] == 'send-attachment-to-editor' || action[1] == 'nukes_gallery')){

						$('#gallery_spinner').css('display','block');

					}

			}

		});

		

	$('#gal-ctrls').ajaxSuccess(function(event, xhr, settings){


			if( settings === undefined ) return false;

			if(undefined != settings['data'])

			{

				var action = settings.data.match(/action=([a-z-_]+)/);

				if((undefined != action[1]) && (action[1] == 'send-attachment-to-editor' || action[1] == 'nukes_gallery')){

					if($('#image-gallery').hasClass('ui-sortable')) $('#image-gallery').sortable("refresh");

					else $('#image-gallery').sortable({handle: '.move_upload_img',containment: '#image-gallery'}); /** sortable */

					$('#gallery_spinner').css('display','none');

				}

			}

		});

		

	window.send_to_editor = function(HTML)

	{

		/** Check for multiple rows */

		var rows = HTML.split("\n");

		process_img(rows);

	}

	

	if(undefined != nukes_gallery)

	{

		process_img({0:nukes_gallery}, true);

	}

	

});