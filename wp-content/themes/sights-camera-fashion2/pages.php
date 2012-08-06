<?php
/*
Template Name: Pages
*/
?>
<?php get_header(); ?>


	<div id="pages_container">
	<?php
 	if (have_posts()) : while (have_posts()) : the_post(); 

		echo $post->post_content;
		
	endwhile; endif; ?>

    </div> 
	<div style="clear:both;"></div>
<?php get_footer(); ?>