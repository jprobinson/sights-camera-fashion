<?php

add_theme_support( 'post-thumbnails' ); 

function strip_images($content){
   return preg_replace('/<img[^>]+./','',$content);
}


/*
*
*	AJAX!
*
*/
add_action('wp_ajax_get_next_post', 'prefix_ajax_get_next_post');

function prefix_ajax_get_next_post() {
	
	if(isset($_POST['post_offset'])){
		$post_args = array(
		    'numberposts'     => 1,
		    'offset'          => $_POST['post_offset']);
		$posts = get_posts($post_args);
		if(isset($posts[0]))
			echo get_scf_post_article($posts[0],$_POST['post_offset']); 
	}
	return;
}

add_action('wp_ajax_get_next_thumbnail', 'prefix_ajax_get_next_thumbnail');

function prefix_ajax_get_next_thumbnail() {
	
	if(isset($_POST['post_offset'])){
		$post_args = array(
		    'numberposts'     => 1,
		    'offset'          => $_POST['post_offset']);
		$posts = get_posts($post_args);
		if(isset($posts[0]))
			echo get_scf_thumbnail($posts[0],$_POST['post_offset']); 
	}
	return;
}

function get_scf_thumbnail($post,$thumb_index){
	if ($thumb_index == 0) { 
			echo "<li class=\"thumb current_thumb\" id=\"thumb_holder_{$thumb_index}\" data-postid=\"{$thumb_index}\" >";
	}	
	else{  
		echo "<li class=\"thumb\" id=\"thumb_holder_{$thumb_index}\" data-postid=\"{$thumb_index}\">";
	}

	echo get_the_post_thumbnail($post->ID,array(150,150),array());
	echo "</li>";
}

/**
*	POST!
*
*/
function get_scf_post_article($post,$post_index){
		if ($post_index == 0) { 
			echo "<article class=\"main_post current_post\" id=\"post_{$post_index}\" data-post-id=\"{$post_index}\" >";
	 	}	
		else{  
			echo "<article class=\"main_post\" id=\"post_{$post_index}\" data-post-id=\"{$post_index}\" style=\"display:none;\">";
	 	} 

		echo "<header><h3>".mysql2date('M j, Y',$post->post_date)."   <br/>  <a class=\"title\" href=\"". $post->guid."\">". get_the_title($post->ID). "</a></h3></header>";
		
		echo "<div class=\"img_container\"><a class=\"title\" href=\"". $post->guid."\">";
		
		echo wp_get_post_image('height=400&css=scf-main-image&parent_id='.$post->ID);
		echo "</a></div>
	    	<div class=\"text_container\">
    		    <div class=\"comment_number\">";
    			    echo "<a class=\"title\" href=\"". $post->guid ."\">". get_comments_number($post->ID) ."</a>";
    			echo "</div>
		    
    			<div class=\"location_link\">". strip_images($post->post_content) ."</div>";
                // <nav class=\"tags\">";
                // 
                // echo get_the_tag_list('<ul><li class="tag-title"></li><li>',',</li><li>','</li></ul>');
                //          
                // echo"</nav>
				
    	   echo" </div>
        	</article> ";

	
}


function get_scf_single_post_article($post,$post_index){

		echo "<article class=\"main_post\" id=\"post_{$post_index}\" data-post-id=\"{$post_index}\" >";

		echo "<header><h1>".mysql2date('M j, Y',$post->post_date)." - <a class=\"title\" href=\"". $post->guid."\">". get_the_title($post->ID). "</a></h1></header>";
		
		echo "<div class=\"single_img_container\">";
		
		echo wp_get_post_image('height=550&css=scf-main-image&parent_id='.$post->ID);
			echo "</div>
    	    	<div class=\"single_post_content\">
        			<div class=\"location_link\">". strip_images($post->post_content) ."</div>
                    <div>";
        			    echo strip_images(preg_replace('/<a[^>]+>([^<]+)<\/a>/i','\1',$post->post_content))."
        	        </div>

        			<nav class=\"tags\">";

        			echo get_the_tag_list('<ul><li class="tag-title">Tagged:</li><li>',',</li><li>','</li></ul>');

        			echo"</nav></div>
            	</article> ";
}

?>