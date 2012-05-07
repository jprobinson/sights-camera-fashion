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
			echo "<li class=\"thumb current_thumb\" id=\"thumb_holder_{$thumb_index}\">";
	 }	
	else{  
		echo "<li class=\"thumb\" id=\"thumb_holder_{$thumb_index}\">";
	 }
	echo get_the_post_thumbnail($post->ID,'thumbnail',array());
	echo "</li>";
}

/**
*	POST!
*
*/
function get_scf_post_article($post,$post_index){
		if ($post_index == 0) { 
			echo "<article class=\"main_post current_post\" id=\"post_".$post_index."\" >";
	 	}	
		else{  
			echo "<article class=\"main_post\" id=\"post_".$post_index."\" style=\"display:none;\">";
	 	} 

		echo "<header><h4>".mysql2date('M j, Y',$post->post_date)."</h4>";
		echo "<h4><a class=\"title\" href=\"". $post->guid."\">". get_the_title($post->ID). "</a></h4></header>";
		echo "<div class=\"img_container\">";
		
		echo wp_get_post_image('height=475&css=scf-main-image&parent_id='.$post->ID);
		echo "</div>
	
		<div class=\"text_container\">
			<header></header>
			<div>". strip_images($post->post_content) ."<div>
			
			<nav class=\"tags\">";

			echo get_the_tag_list('<ul><li class="tag-title">Tags:</li><li>','</li><li>','</li></ul>');
			
			echo"</nav>";
			echo "<div class=\"comment_number\">";
			echo "<a class=\"title\" href=\"". $post->guid ."\">Comments: ". get_comments_number($post->ID) ."</a>";
			echo "</div>						

			<footer></footer>
		</div>
	
		<footer>
	
		</footer>
	</article> ";

	
}



if ( ! function_exists( 'scf_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function scf_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta">
				<div class="comment-author">
					
					<p><span class="comment-author-name"><?php echo get_comment_author(); ?></span> / <?php echo get_comment_date() . ' @  ' . get_comment_time(); ?>:</p>

					<?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author  -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
					<br />
				<?php endif; ?>

			</header>

			<div class="comment-content"><?php comment_text(); ?></div>

			<footer class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</footer><!-- .reply -->
		</article><!-- #comment-## -->
		<hr/>
	<?php
			break;
	endswitch;
}
endif; // ends check for scf_comment()

?>