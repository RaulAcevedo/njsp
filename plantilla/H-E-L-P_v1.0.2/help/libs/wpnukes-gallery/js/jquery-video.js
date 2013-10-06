var $_webnukes = (undefined != $_webnukes && typeof($_webnukes) == 'object') ? $_webnukes : {};



(function($){

    var options = {

            container : '#video_manager', /** Links Container */

            per_page : 10, /** Videos per page */

            multi_thread : 0, /** Multi-threading */

            cycle : 20, /** How many links process per cycle */

            seperator : "\n", /** Links Seperator */

            logs : true, /** Show logs */

            lcontainer : '#logs', /** Logs container */

            pbar : '.progressbar', /** Progress bar container */

            content : 'thumbnail', /** Content Container */

            pcontainer : "div#vid-pagination", /** Pagination Container */

			iframe:{'width':'500','height':'281'},

			classback:'',

			filters : '#vid-filter'

        };

    

    $_webnukes.videos = videos = {

            current : 0,

            is_multi : false,

            links : [],

            filter : '',

			kill:false,

			nopagi:false,

			isnew:false,

			options:{},

			counter:{'featured':0},

            init: function(opts){

				this.reset(true);

				this.isnew = true;

				this.options = opts;

                this.links = $.trim($(this.options.container).val()).split(this.options.seperator);

				

				if( ! this.links.length) return;

				

                if($.type(this.links) == 'array')

                {

                    $(this.options.pbar).fadeIn('slow');

                    if(this.options.multi_thread) this.multi_thread();

                    else this.next();

                }

            },

            

            multi_thread : function(){

                //TODO: write multi_thread code

                this.next();

            },

            

            next : function(){

                this.progress();



                if(this.current < this.links.length && ! this.kill) this.fetch(this.links[this.current]);

                else this.reset();

            },

            fetch : function(url){

                this.current++;

                if(host = this.get_host(url)){

                    if(undefined != this[host]) this[host](url);

                    else this.log('<strong>Url not supported: </strong>'+url, true);

                }else this.log('<strong>Invalid URL: </strong>'+url, true);

            },

            progress : function(){

                $(this.options.pbar+' div:first').width(parseInt((this.current / this.links.length) * 100)+'%');

            },

            filters : function(){

                $('#'+this.options.content+' li').css('display', 'block');

            },

            pagination : function(refresh){

				return;

                if(this.nopagi) return;

				

                if(refresh) this.filters();

                

                if($('#'+this.options.content+' li').length < this.options.per_page) $(this.options.pcontainer).html('');

                else if(this.current > (this.options.per_page - 1) && this.current < this.links.length){

                    $('#'+this.options.content+' li').not(':hidden').eq(parseInt(this.options.per_page)).css('display','none');

                }

                else if(this.current >= this.links.length)

                {

					if($(this.options.pcontainer).children('*').length) $(this.options.pcontainer).jPages("distory");

                    $(this.options.pcontainer).jPages({containerID : this.options.content, perPage : this.options.per_page});

                }

            },

            get_host : function(url){

                var parseURL = url.match(/^(http|https):\/\/(www\.)?([A-Z0-9][A-Z0-9_-]+)\.([A-Z0-9][A-Z0-9_-]+)?:?(\d+)?\/?/i);

                return (parseURL && undefined != parseURL[3]) ? parseURL[3] : '';

            },

            

            add : function(info){

				if(this.kill) return this.reset();

				

				info = $.extend({featured:false}, info);

				

				this.counter[info.source] = (undefined == this.counter[info.source]) ? 1 : this.counter[info.source] + 1;

				

				if(info.featured) this.counter['featured'] = this.counter['featured'] + 1;



                var unique_id = info.source+'-'+info.id;

                var hidden = '';

                $.each(info, function(k, v){

					if(k == 'source' || k == 'id' || k == 'duration') hidden += '<input type="hidden" name="videos['+unique_id+']['+k+']" value="'+v+'" class="video-'+k+'" />';

					else if(k == 'featured') hidden += '<label><span>&nbsp;</span><input type="checkbox" name="videos['+unique_id+']['+k+']" class="video-'+k+'" '+((info.featured) ? 'value="1" checked="checked"' : '')+'/> Featured Video?</label>';

					else if(k == 'desc' || k == 'tags') hidden += '<label><span>'+videos.ucwords(k)+'</span><textarea name="videos['+unique_id+']['+k+']" class="video-'+k+'">'+v+'</textarea></label>';

                    else hidden += '<label><span>'+videos.ucwords(k)+'</span><input type="text" name="videos['+unique_id+']['+k+']" value="'+v+'" class="video-'+k+'" /></label>';

                });

                

				var New = (this.isnew) ? '<span class="new_tag"></span>' : '', Class = (info.featured) ? info.source+'-vid featured-vid' : info.source+'-vid';

				

                $('#thumbnail').prepend('<li id="'+unique_id+'" class="'+Class+'"><img width="208" height="136" alt="" src="'+info.thumb+'">'+

                    '<div class="upload_gal_control">'+New+'<div class="upload_gal_control"><i class="featured_upload_img'+(info.featured ? ' checked' : '')+'"></i><i class="edit_upload_img"></i><i class="delete_upload_img"></i></div></div>'+

                    '<div class="upload_gallery_overlay">'+info.title+'</div><span class="vid_duration">'+$().toTime(info.duration)+'</span><i class="move_upload_img"></i><i class="play_upload_img"></i><div class="hidden_data">'+hidden+'</div></li>');

                

                this.pagination();

            },

			

            youtube : function(url){

                var settings = {'source':'youtube','id':'id','thumb':'[thumbnail][hqDefault]','title':'title','desc':'description','duration':'duration','views':'viewCount','author':'uploader','rating':'rating','tags':'tags'};

                var videoInfo = url.match(/(?:youtube(?:-nocookie)?\.com\/(?:[^/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i)

                

                 /** Error message if the URL is not correct */

                 if(undefined != videoInfo[1] && ! $('#youtube-'+videoInfo[1]).length)

                 {

                    this.log('<strong>Fetching video info:</strong> '+url);

                    

                     $.getJSON('http://gdata.youtube.com/feeds/api/videos/'+videoInfo[1]+'?v=2&alt=jsonc',function(data,status,xhr){

                       $.each(settings, function(sk, sv){

                                settings[sk] = (undefined == data.data[sv]) ? sv : data.data[sv];

                            });

                            

                            settings['thumb'] = data.data['thumbnail']['hqDefault'];

                        videos.add(settings);

                    }).error(function(e){

                        videos.log('<strong>Unable to load data</strong>: '+url, true);

                    }).complete(function(){

                        videos.log('<strong>Success:</strong> '+url, true);

                    });

                 }

            },

            

            vimeo : function(url){

                var settings = {'source':'vimeo','id':'id','thumb':'thumbnail_medium','title':'title','desc':'description','duration':'duration','views':'stats_number_of_plays','author':'user_name','tags':'tags'};

                var videoInfo = url.match(/\/([0-9]+)/);

                

                /** Error message if the URL is not correct */

                

                if( ! $('#vimeo-'+videoInfo[1]).length) /** Stop Duplicates */

                {

                    this.log('<strong>Fetching video info:</strong> '+url);

                    $.getJSON('http://www.vimeo.com/api/v2/video/' + videoInfo[1] + '.json?callback=?', {format: "json"}, function(data) {

                        $.each(settings, function(sk, sv){

                            settings[sk] = (undefined == data[0][sv]) ? sv : data[0][sv];

                        });

                        

                        videos.add(settings);

                    }).error(function(e){

                        videos.log('<strong>Unable to load data:</strong> '+url, true);

                    }).complete(function(){

                        videos.log('<strong>Success:</strong> '+url, true);

                    });

                }else this.log('<strong>Already Exists:</strong> '+url, true);

            },

            embed : function(source, id)

            {

                switch(source)

                {

                    case "vimeo" :

                        return '<iframe src="http://player.vimeo.com/video/'+id+'?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=f7d64f" width="'+this.options.iframe.width+'" height="'+this.options.iframe.height+'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen>Loading..</iframe>';

                        break;

                    case "youtube" :

                        return '<iframe width="'+this.options.iframe.width+'" height="'+this.options.iframe.height+'" src="http://www.youtube.com/embed/'+id+'" frameborder="0" allowfullscreen></iframe>';

                        break;

                }

            },

            

            log : function(log, next){

                if(this.options.logs) $(this.options.lcontainer).prepend('<li id="link-'+this.current+'">'+log+'</li>');

                if(next && ! this.options.multi_thread) this.next();

            },

            clear_log : function()

            {

                if(this.options.logs) $(this.options.lcontainer).html('');

            },

			

			reset : function(logs)

			{

				if(undefined == this.options.content) this.options = options;

				if(logs) this.clear_log();

				$(this.options.pbar).fadeOut('slow');

				

				if($('#'+this.options.content).hasClass('ui-sortable')) $('#'+this.options.content).sortable("refresh");

				else $('#'+this.options.content).sortable({containment: "#video-gallery", handle: '.move_upload_img'}); /** sortable */

				

				this.pagination(true);

				this.current = 0, this.is_multi = false, this.links = [], this.filter = '', this.kill = false, /*this.options = {},*/ this.isnew = false;

				$('#publish').removeAttr('disabled');

				this.the_filters();

			},

			

			ucwords : function(str)

			{

				return str.toLowerCase().replace(/\b[a-z]/g, function(letter) {

					return letter.toUpperCase();

				});

			},

			

			the_filters : function()

			{

				var html = '', counter = 0, selected = $('.button-primary', $(this.options.filters)).attr('id');

				

				selected = (selected) ? selected.replace(/-vid/,'') : '';

				

				$.each(this.counter, function(k, v){

						if(v)

						{

							html += '<a id="'+k+'-vid" href="#" class="button'+(selected ==  k ? ' button-primary' : '')+'">'+videos.ucwords(k)+' ('+v+')</a>'+"\n";

							if(k != 'featured') counter = counter + v;

						}

					});

				

				selected = (this.counter[selected]) ? selected : 'show-all';

					

				if(html) html += '<a id="show-all" href="#" class="button'+(selected == 'show-all' ? ' button-primary' : '')+'">All ('+counter+')</a>';

				

				$(this.options.filters).html(html);	

				

				$('a#'+selected, $(this.options.filters)).trigger('click');

			},

        };

        

    $.fn.nukes_videos = function(arg){

		var opts = options;

        ($.type(arg) != 'object' && arg) ? $.extend(opts, {'container':arg}) : $.extend(opts, arg);

		

        videos.init(opts);

    };

	

  	$.fn.toTime = function(seconds){

		sec_numb    = parseInt(seconds);

		var hours   = Math.floor(sec_numb / 3600);

		var minutes = Math.floor((sec_numb - (hours * 3600)) / 60);

		var seconds = sec_numb - (hours * 3600) - (minutes * 60);

		

		if (hours   < 10) hours   = (hours <= 0) ? '' : (hours < 10) ? "0"+hours+':' : hours+':';

		if (minutes < 10) minutes = "0"+minutes;

		if (seconds < 10) seconds = "0"+seconds;

		var time    = hours+minutes+':'+seconds;

		

		return time;

  	};

		

})(jQuery);





jQuery(document).ready(function($){

		

		var fwdialog = {autoOpen: true, modal: true, width:'600', height:'auto', draggable: true, appendTo: "body", dialogClass: "wp-dialog"}, the_dialog = {};

		

		/** Video Manager */

		$('#add-videos').click(function(e){

				e.preventDefault();

				if($('#video-uploader').is(':visible')) $(this).val('Show Video Grabber');

				else $(this).val('Hide Video Grabber');

				

				$('#video-uploader').toggle('slow');

			});

		

		$('#process-videos').click(function(e){

				e.preventDefault();

				$(this).nukes_videos();

			});

			

		/** General Code */

		$('.upload_gallery').on('click', 'i.play_upload_img, i.edit_upload_img', function(e){

				

				var container = $(this).parents('li:first');

				var data = $('.hidden_data', container);

				

				dialog = $.extend(fwdialog, {title:$('label > .video-title', data).val(), width:videos.options.iframe.width});

				

				var tab = 'Edit Video Info';

				if($(this).hasClass('edit_upload_img')){

					tab = 'Play Video';

					dialog.create = function(){$(this).html($(data).html());};

				}else dialog.create = function( event, ui ){$(this).html(videos.embed($('.video-source', data).val(), $('.video-id', data).val()));}

								

				dialog.buttons = {};

				

				dialog.buttons[tab] = function(event){



													var btn_txt = $('span.ui-button-text:first');

													if($(btn_txt).text() == 'Play Video'){

														$(btn_txt).text('Edit Video Info');

														$(this).html(videos.embed($('.video-source', data).val(), $('.video-id', data).val()));

													}

													else{

															$(btn_txt).text('Play Video');

															$(this).html($(data).html());

														}

												};

				dialog.buttons['Save'] = function(){

											var prevTitle = $('.video-title', data).val();

											$('label > :input', this).each(function(){

												

													var New = this, newvalue = $(this).val();

													$(data).find('.'+$(this).attr('class')).each(function(){

														

														if($(this).attr('type') == 'checkbox')

														{

															var featuredbox = $('.featured_upload_img', container);

															

															if($(New).is(':checked')){

																if( ! $(this).is(':checked')) videos.counter['featured']++;

																$(container).addClass('featured-vid');

																$(featuredbox).addClass('checked');

																$(this).attr('checked','checked');

																

															}else{

																if($(this).is(':checked')) videos.counter['featured']--;

																$(container).removeClass('featured-vid');

																$(featuredbox).removeClass('checked');

																$(this).removeAttr('checked');

															}

														}else this.defaultValue = newvalue;

													});

												});

											var curTitle = $('.video-title', data).val();

											if(prevTitle != curTitle) $('.upload_gallery_overlay', container).text(curTitle);



											$(this).dialog("destroy");

											videos.the_filters();

										};

										

				dialog.buttons['Cancel'] = function(){$(this).dialog("destroy");};

												

				$( "#play-video" ).dialog(dialog);

				

				/** Update Dialog Title */

				$('#play-video').on('keyup', 'input.video-title', function(){

					var newtitle = ($(this).val()) ? $(this).val() : '[NO TITLE]';

					$('.ui-dialog .ui-dialog-title').text(newtitle);

				});

			});

		

		/** Filteration */

		$('#vid-filter').on('click', 'a', function(e){

				e.preventDefault();

				

				var thisID = $(this).attr('id'), thumbnail = $('#thumbnail');

				

				if(thisID != 'show-all')

				{

					$('li.'+thisID, thumbnail).fadeIn('slow');

					

					$.each(videos.counter, function(k){

							if(k+'-vid' != thisID) $('li.'+k+'-vid', thumbnail).filter(':not(.'+thisID+')').fadeOut('fast');

						});

						

				}else $('li', thumbnail).fadeIn('slow');

				

				$('#vid-filter > a').removeClass('button-primary');

				$(this).addClass('button-primary');

			});

		

		/** Featured Gallery Item */

		$('#thumbnail').on('click', 'i.featured_upload_img', function(){

			

				var parent = $(this).parents('li:first'), data = $(parent).children('.hidden_data');

				

				if($(this).hasClass('checked')){

					$('.video-featured', data).removeAttr('checked');

					videos.counter['featured']--;

				}else{

					$('.video-featured', data).attr('checked','checked');

					videos.counter['featured']++;

				}

				

				videos.the_filters();

				$(this).toggleClass('checked');

				$(parent).toggleClass('featured-vid');

			});

			

		$('#play-video').on('change', '.video-featured', function(){

				if($(this).is(':checked')) $(this).attr('checked','checked');

				else $(this).removeAttr('checked');

			});

			

		/** Delete Gallery Items */

		$('.upload_gallery').on('click', 'i.delete_upload_img', function(){

			

				if( confirm("Are you sure you want to delete this item?") ){

					

					var parent = $(this).parents('li:first');

					classes = $(parent).attr('class').replace(/-vid/,'').split(' ');



					if(undefined != videos.counter[classes[0]])

					{

						videos.counter[classes[0]] = videos.counter[classes[0]] - 1;

						if($(parent).hasClass('featured-vid') && undefined != videos.counter['featured']) videos.counter['featured'] = videos.counter['featured'] - 1;

					}



					$(this).parents('li:first').remove();

					videos.reset();

				}

			});

		

		/** load videos */

		if(undefined != nukes_videos){

			$.each(nukes_videos, function(k,v){

				$_webnukes.videos.add(v);

			});

			

			$_webnukes.videos.reset();

		}



	});