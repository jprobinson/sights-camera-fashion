<?php get_header(); ?>

		<div id="post_container">

			<?php
				$post_index = 0;
				query_posts('showposts=8');
			 	if (have_posts()) : while (have_posts()) : the_post(); 

					get_scf_post_article($post,$post_index);			

				 	$post_index++;
					endwhile; else: ?>
		
				<p><?php _e('Sorry, we couldn’t find the post you are looking for.'); ?></p>

			<?php endif; ?>
			
			
		</div>
	    <nav id="thumb_nav">
	    	<div id="thumbnail_container">
                <ul id="thumb_page_1">
    			<?php
    				rewind_posts();
    				query_posts('showposts=8');
    				$thumb_index = 0;
    				$thumb_page=1;
    			  	while (have_posts()) : the_post(); 	 			
        	 	        if ((($thumb_index+1) % 5) === 0){
        	 	            $thumb_page++;
        	 	            echo "</ul><ul id=\"thumb_page_$thumb_page\" style='display:none;'>";
        	 	        }
    	 	            			
    					get_scf_thumbnail($post,$thumb_index);

    	 	        
				 	
    				 	$thumb_index++;
    				endwhile; 
    			?>
    			</ul>
    		</div>
    		<div class="thumb_action">
    	        <a id="prev_thumb" title="Previous" href="#">Previous</a>
    	        <a id="next_thumb" title="Next" href="#">Next</a>
    	    </div>
	  </nav>
	<div style="clear:both;"></div>
<?php
 get_footer(); 
?>