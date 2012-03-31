<?php get_header(); ?>

<div id="main">
	<div id="content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php $my_date = the_date('', '<h4>', '</h4>', FALSE); echo $my_date; ?>

			<?php if($my_date != ''){ echo "<hr>"; } ?>
			
			<article class="post ">
				<header>
					<h2><?php the_title(); ?></h2>
				</header>

				<p><?php the_content(); ?></p>
				
				<footer>
					<a class="permalink" href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a>
				</footer>
			</article>

			<?php endwhile; else: ?>
		
			<p><?php _e('Sorry, we couldn’t find the post you are looking for.'); ?></p>

		<?php endif; ?>
	</div>

</div> 

<?php get_footer(); ?>