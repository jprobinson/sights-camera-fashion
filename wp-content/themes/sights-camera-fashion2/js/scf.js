$(document).ready(function() {
	var post_offset = ($('.thumb').length - 1);
	var thumb_pages = Math.ceil(post_offset/4);
	var thumb_page_head = 1;

	
	var select_post = function(post_id){
		get_current_post().css('display','none');
		get_current_post().removeClass('current_post');
		$('.current_thumb').removeClass('current_thumb');
		$('#post_'+post_id).show();
		$('#post_'+post_id).addClass('current_post');
		$('#thumb_holder_'+post_id).addClass('current_thumb');
		if ("onhashchange" in window) {
		  window.location.hash = post_id;
		}
	};
	
	var click_thumbnail = function(thumbnail){
		if(thumbnail){
			var thumb_id = $(thumbnail).prop("id");
			var post_id = thumb_id.replace("thumb_holder_","");
			select_post(post_id);
		}
	};
	
	var insert_next_post = function(){
		$.ajax({
			url:"/wp-admin/admin-ajax.php",
			type:"POST",
			async:false,
			data:'action=get_next_post&post_offset='+post_offset,
			success:function (results) {
				if(results != ''){
					var post_results = results.substring(0,results.length-1);
					$(post_results).insertAfter('#post_'+(post_offset-1));
				}
			}
		});
	}
	
	var insert_next_thumbnail = function(thumb_page){
		var new_post = true;
		$.ajax({
			url:"/wp-admin/admin-ajax.php",
			type:"POST",
			async:false,
			data:'action=get_next_thumbnail&post_offset='+post_offset,
			success:function (results) {
				if((results != '0') && (results != '-1')){
					var thumb_img = results.substring(0,results.length-1);
					var thumb = $(thumb_img);
					thumb.appendTo(thumb_page);
				}
				else{
					new_post = false;
				}
			}
		});
		return new_post;
	};
	
	var insert_next_thumb_page = function(){
		var success = false;
		var newThumbPage = $(document.createElement('ul'));
		newThumbPage.attr('id','thumb_page_'+thumb_page_head);
		newThumbPage.hide();
		var thumbsAdded;
		for(thumbsAdded=0;thumbsAdded<=3;thumbsAdded++){
			post_offset++;
			if(insert_next_thumbnail(newThumbPage)){
				insert_next_post();
			}
			else{
				post_offset--;
				break;
			}
		}

		if(thumbsAdded > 0){
			$('#thumbnail_container').append(newThumbPage);
			$('.thumb').click(function(){ click_thumbnail(this); });
			thumb_pages++;
			return true;
		}
		else{
			return false;
		}
	
	};

	var get_current_post = function(){
		return $('.current_post');
	};
	
	var get_current_post_id = function(){
		var curr_post = $('.current_post');
		return  curr_post.prop('id').replace("post_","");
	};
	
	var shift_thumbs_left = function(){
		thumb_page_head++;
		var inserted = true;
		if(thumb_page_head > thumb_pages){
			inserted = insert_next_thumb_page();
		}
	
		if(inserted){
			$('#thumb_page_'+(thumb_page_head-1)).hide(
				"slide",
				 { direction: "left" }, 
				200,
				function(){
					$('#thumb_page_'+(thumb_page_head)).show("slide", { direction: "right" }, 200);
				});
		}
		else{
			thumb_page_head--;
			// $('#next_thumb').hide();
		}

		if(thumb_page_head > 1){
			// $('#prev_thumb').show();
		}
	};
	
	var shift_thumbs_right = function(){
		thumb_page_head--;
		if(thumb_page_head >= 1){
			$('#thumb_page_'+(thumb_page_head+1)).hide(
				"slide",
				 { direction: "right" }, 
				200,
				function(){
					$('#thumb_page_'+(thumb_page_head)).show("slide", { direction: "left" }, 200);
				});
		}

		if(thumb_page_head == 1){
			// $('#prev_thumb').hide();
		}
	};
	
	var locationHashChanged = function() {
		if(location.hash.indexOf('#') != -1){
			var hash = location.hash.replace('#','');
			click_thumbnail(document.getElementById('thumb_holder_'+ hash));
		}
	}

	window.onhashchange = locationHashChanged;
	
	locationHashChanged();

	
	//CLICKED THUMBNAIL
	$('.thumb').click(function(){ click_thumbnail(this); });
	
	//CLICKED NEXT 
	$('#next_thumb').click(function(event){ 
		event.preventDefault();
		shift_thumbs_left();
	});
	
	//CLICKED NEXT 
	$('#prev_thumb').click(function(event){ 
		event.preventDefault();
		shift_thumbs_right();
	});

});
