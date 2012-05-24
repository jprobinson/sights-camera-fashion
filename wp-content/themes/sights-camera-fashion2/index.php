<?php get_header(); ?>

	<div id="main">
		<div id="post_container">
			<a href="#" class="prev_post"><span>Prev</span></a>

			<?php
				$post_index = 0;
				query_posts('showposts=10');
			 	if (have_posts()) : while (have_posts()) : the_post(); 


					get_scf_post_article($post,$post_index);
				

				 	$post_index++;
					endwhile; else: ?>
		
				<p><?php _e('Sorry, we couldn’t find the post you are looking for.'); ?></p>

			<?php endif; ?>
			
			<a href="#" class="next_post"><span>Next</span></a>
		</div>
		
		<div style="clear:both;"></div>
	
		<div id="thumbnail_container">
			<ul>
				<li class="thumb_button" id="prev_thumb"><a href="#">Prev</a></li>
				
			<?php
				rewind_posts();
				query_posts('showposts=10');
				$thumb_index = 0;
			  	while (have_posts()) : the_post(); 	
			
					get_scf_thumbnail($post,$thumb_index);
					$thumb_index++;
		 	
				endwhile; 
			?>
		
				<li class="thumb_button" id="next_thumb"><a href="#">Next</a></li>
			</ul>
		</div>
		
	</div> 
<?php
 get_footer(); 
?>