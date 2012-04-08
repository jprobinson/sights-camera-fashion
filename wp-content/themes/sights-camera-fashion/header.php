<!DOCTYPE html>
<html>
	<head>
		<head profile="http://gmpg.org/xfn/11">
		<title>Sights Camera Fashion - A Blog by Kelsey Higgins-Robinson</title>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<link href='http://fonts.googleapis.com/css?family=Imprima' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	
			<?php wp_head(); ?>
	</head>
		
<body>

<div id="wrapper">

	<header id="header">
		<div id="logo">
			<a href="<?php echo site_url(); ?>"><h1>Sights &bull; Camera &bull; Fashion</h1></a>
		</div>
		
		<nav>
			<ul>
				<?php wp_list_pages('title_li='); ?>
			</ul>
		</nav>
	</header>