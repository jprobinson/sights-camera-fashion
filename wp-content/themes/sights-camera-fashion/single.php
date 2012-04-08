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
						echo get_the_tag_list('<ul><li class="tag-title">Tags:</li> <li>','</li><li>','</li></ul>');
					?>
					</nav>
					
				
				<?php comments_template( '/comments.php' ); ?> 
				<hr style="border:1px;"/>
				<?php
					$fields =  array(
						'author' => '<p class="comment-form-author">' . ( $req ? '<span class="required">*</span>' : '' ) .
									'<input id="author" name="author" type="text"placeholder="Name" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
						'email'  => '<p class="comment-form-email">' . ( $req ? '<span class="required">*</span>' : '' ) .
	            '<input id="email" name="email" type="email" placeholder="Email [will not be published]" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
						'url'    => '',
					); 
					$comments_args = array(
							'fields'=>$fields,
							'title_reply'=>'<h4>'. _x('Comment on this post') .':</h4>',
							'comment_notes_after' => '',
							'comment_notes_before' => '',
							'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br /><textarea rows="4" cols="70" id="comment" name="comment" aria-required="true"></textarea></p>',
					);
					
					comment_form($comments_args);
				?>
					
				</footer>
			</article>

			<?php endwhile; else: ?>
		
			<p><?php _e('Sorry, we couldn’t find the post you are looking for.'); ?></p>

		<?php endif; ?>
	</div>

</div> 

<?php get_footer(); ?>