<!DOCTYPE html>
<!--[if IE 8] <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<link rel="stylesheet" href=""/>
	<link rel="stylesheet" href="<?php bloginfo('pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>> 
	<div id='container'>
	<header id='header'>
		<?php cmg_logo();?>
		<?php cmg_menu( 'primary-menu' ); ?>
	</header>