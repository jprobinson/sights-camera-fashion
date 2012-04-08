<?php get_header(); ?>

<div id="main">
	<div id="content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php the_date('', '<h4 class="blog_date">', '</h4>'); ?>
			
			<article class="post">
				<header>
					<h2><a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</header>

				<p><?php the_content(); ?></p>
				
				<footer>
					<nav class="tags">
					<?php
						echo get_the_tag_list('<ul><li class="tag-title">Tags:</li><li>','</li><li>','</li></ul>');
					?>
					</nav>
					<div class="comment_number">
						<a class="title" href="<?php the_permalink(); ?>"><?php _e('Comments'); ?>: <?php comments_number('0 :(','1 :|','% :D'); ?></a>
					</div>
				</footer>
			</article>

			<?php endwhile; else: ?>
		
			<p><?php _e('Sorry, we couldn’t find the post you are looking for.'); ?></p>

		<?php endif; ?>
	</div>

</div> 

<?php get_footer(); ?>