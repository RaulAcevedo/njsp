

(function($){
	"use strict";
	var rockband = {
			
			count: 0,
			tweets: function( options, selector ){
				
				options.action = 'FW_ajax_callback';
			
				$.ajax({
					url: ajaxurl,
					type: 'POST',
					data:options,
					dataType:"json",
					success: function(res){

						var reply = res;
						
						var html = '';
						if( options.template === 'blockquote' ){
							$.each(reply, function(k, element){
								var date = new Date(element.created_at);
								html += '<li>';
								html += '<h6>'+element.user.name+' ( '+date.toString('dddd, MMMM ,yyyy')+' )</h6>';
								html += '<p>'+element.text+'</p>';
								html += '</li>';
							});
						}else{
							$.each(reply, function(k, element) {
								html += '<li>'+element.text+'</li>';
							});
						}
						$(selector).html( html );
							
						if( options.template === 'blockquote' ){
							if( $('.tweets-list').length !== 0){
								$('.tweets-list').bxSlider({
									mode: 'vertical',
									minSlides: 2,
									maxSlides: 2,
									ticker: true,
									speed: 25000
								});
							}
						}
							
					}
				});
				
			},
			
			playlist: function(thiss){
				
				$('.jp-playlist-item').removeClass('jp-playlist-current');
				$(thiss).addClass('jp-playlist-current');
				$(".jp-jplayer").jPlayer( "destroy" );

				rockband.count++;
				//console.log(thiss);
				var audio = $(thiss).attr('href'); //alert(audio);return;
				var type = $(thiss).attr('data-type');
				var newtype = {};
				newtype[type] = audio;
				
		
				var title = $(thiss).text();
				var byauth = $(thiss).next().text();
				$('.jp-centered .jp-title').html(title+' <span>'+byauth+'</span>');
				//var test['type'] = $(this).attr('data-type');
				$(".jp-jplayer").jPlayer( {
					cssSelectorAncestor: ".jp-audio",
					ready: function () {
						if( rockband.count < 2 ){
							$(this).jPlayer("setMedia", newtype);
						}else{
							$(this).jPlayer("setMedia", newtype).jPlayer("play"); // Attempts to Auto-Play the media
						}
					},
					supplied: "oga, mp3, m4a, webma, fla, wav, mpeg",
					swfPath: "/js/player"
				});
			},
			player_controls: function( thiss ){
				
					var jp_interface = $(thiss).parents('.jp-interface');
					var playlist_div = $(jp_interface).next();
					var current_item = $(playlist_div).find('.jp-playlist-current').parents('li');
					var action = $(thiss).attr('class');
					
					if( action === 'jp-next')
					{
						if( $('.jp-playlist-item', $(current_item).next()).length !== 0 ){
							this.playlist($('.jp-playlist-item', $(current_item).next()) );
						}
					} else if( action === 'jp-previous')
					{
						if( $('.jp-playlist-item', $(current_item).prev()).length !== 0 ){
							this.playlist( $('.jp-playlist-item', $(current_item).prev()) );
						}
					}
			},
		};
	
	$.fn.tweets = function( options ){
		
		var settings = {
				screen_name	:	'wordpress',
				count		:	3,
				template	:	'blockquote'
			};
			
			options = $.extend( settings, options );
			
			rockband.tweets( options, this );
	};
	
	jQuery(document).ready(function($) {
                
		$('li a.track-lyrics').click(function(e) {
			e.preventDefault();
			var html = $('.cont', $(this).parents('li') );
			$(html).slideToggle('slow');
		});
		
		$('.jp-next, .jp-previous').click(function(e) {
			e.preventDefault();
			rockband.player_controls(this);
			return false;
			
		});
		
		
		/*** jplayer initiate ***/
		$('.jp-playlist-item').click(function(e) {
			e.preventDefault();
			rockband.playlist(this);

			return false;
		});
		$('.jp-playlist-item:first').trigger('click');
	});
		
})(jQuery);




