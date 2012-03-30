<?php get_header(); ?>

<div id="main">
	<div id="content">
		
		<h1>Main Content Area</h1>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<h1><?php the_title(); ?></h1>
			<p><?php the_content(); ?></p>
			<hr>
		
		<?php endwhile; else: ?>
		
			<p><?php _e('Sorry, we couldn’t find the post you are looking for.'); ?></p>

		<?php endif; ?>
	</div>


	<?php get_sidebar(); ?>

</div> 

<div id="delimiter"></div>

<?php get_footer(); ?>