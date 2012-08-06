<?php get_header(); ?>
	<div id="single_post_container">

		<?php
			$post_index = 0;
            // query_posts('showposts=1');
		 	if (have_posts()) : while (have_posts()) : the_post(); 


				get_scf_single_post_article($post,$post_index);
			

	            comments_template( '', true ); 
				$post_index++;
				 endwhile; else: ?>
		
			<p><?php _e('Sorry, we couldn’t find the post you are looking for.'); ?></p>

		<?php endif; ?>

    </div> 

<?php get_footer(); ?>