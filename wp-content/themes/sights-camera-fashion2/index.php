<?php // get_header();
 ?>
<!DOCTYPE html>
<html>
	<head>
		<head profile="http://gmpg.org/xfn/11">
		<title>Sights Camera Fashion - A Blog by Kelsey Higgins-Robinson</title>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo("template_url"); ?>/js/jquery.jcarousel.js"></script>
		<script type="text/javascript" src="<?php bloginfo("template_url"); ?>/js/scf.js"></script>

		<?php wp_head(); ?>
	</head>

<body>

<div id="wrapper">

	<header id="header">
		<div id="logo">
			<a href="<?php echo site_url(); ?>"><h1>Sights &bull; Camera &bull; Fashion</h1></a>
		</div>

		<nav id="pages_links">
			<ul class="horiz_list">
				<?php wp_list_pages('title_li='); ?>
			</ul>
		</nav>
	</header>

	<div id="main">
		<div id="post_container">

			<?php
				$post_index = 0;
				query_posts('showposts=6');
			 	if (have_posts()) : while (have_posts()) : the_post(); 


					get_scf_post_article($post,$post_index);
				

				 	$post_index++;
					endwhile; else: ?>
		
				<p><?php _e('Sorry, we couldn’t find the post you are looking for.'); ?></p>

			<?php endif; ?>
		
		</div>
		<div style="clear:both;"></div>
	
		<div id="thumbnail_container">
			<ul>
				<li class="thumb_button" id="prev_thumb"><a href="#">Prev</a></li>
				
			<?php
				rewind_posts();
				query_posts('showposts=6');
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


		<footer id="footer">
			<span><?php echo date.format('Y'); ?> &#169; Kelsey Higgins-Robinson</span>
		</footer>

	</div>
	<div style="clear:both;"></div>
</div> 

</body>
</html>
<?php
// get_footer(); 
?>