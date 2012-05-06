$(document).ready(function() {
	var post_offset = 5;
	var reel_head = 5;

	
	var select_post = function(post_id){
		get_current_post().css('display','none');
		get_current_post().removeClass('current_post');
		$('.current_thumb').removeClass('current_thumb');
		$('#post_'+post_id).fadeIn("slow");
		$('#post_'+post_id).addClass('current_post');
		$('#thumb_holder_'+post_id).addClass('current_thumb');
	};
	
	var click_thumbnail = function(thumbnail){
		var thumb_id = $(thumbnail).prop('id');
		var post_id = thumb_id.replace("thumb_holder_","");
		select_post(post_id);
	};
	
	var insert_next_post = function(){
		$.ajax({
			url:"/wp-admin/admin-ajax.php",
			type:"POST",
			async:false,
			data:'action=get_next_post&post_offset='+post_offset,
			success:function (results) {
				var post_results = results.substring(0,results.length-1);
				$(post_results).insertAfter('#post_'+post_offset-1);
			}
		});
	}
	
	var insert_next_thumbnail = function(){
		$.ajax({
			url:"/wp-admin/admin-ajax.php",
			type:"POST",
			async:false,
			data:'action=get_next_thumbnail&post_offset='+post_offset,
			success:function (results) {
				var thumb_img = results.substring(0,results.length-1);
				var thumb = $(thumb_img);
				console.log(thumb);
				thumb.hide();
				thumb.insertBefore('#next_thumb');
				$('.thumb_'+post_offset).click(function(){click_thumbnail(this)});
			}
		});
	};
	
	var insert_next_article = function(){
		post_offset++;
		insert_next_thumbnail();
		insert_next_post();
	};

	var get_current_post = function(){
		return $('.current_post');
	};
	
	var get_current_post_id = function(){
		var curr_post = $('.current_post');
		return  curr_post.prop('id').replace("post_","");
	};
	
	var shift_thumbs_left = function(){
		reel_head++;
		if(reel_head > post_offset){
			insert_next_article();
		}
	
		$('#thumb_holder_'+(reel_head-6)).hide();
		$('#thumb_holder_'+(reel_head)).show();
		select_post(parseInt(get_current_post_id())+1);
	};
	
	var shift_thumbs_right = function(){
		reel_head--;
		if((reel_head - 5) >= 0){
			$('#thumb_holder_'+(reel_head+1)).hide();
			$('#thumb_holder_'+(reel_head - 5)).show();
			select_post(parseInt(get_current_post_id())-1);
		}

	};
	
	//CLICKED THUMBNAIL
	$('.thumb').click(function(){ click_thumbnail(this); });
	
	//CLICKED NEXT 
	$('#next_thumb a').click(function(event){ 
		event.preventDefault();
		shift_thumbs_left();
	});
	
	//CLICKED NEXT 
	$('#prev_thumb a').click(function(event){ 
		event.preventDefault();
		shift_thumbs_right();
	});
});
