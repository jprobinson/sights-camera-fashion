<?php get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'post', get_post_format() ); ?>

				<?php endwhile; ?>


			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<div class="entry-content">
						<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post</p>
						<?php get_search_form(); ?>
					</div>
				</article>

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>