<!DOCTYPE html>
<html lang="<?php echo substr(get_bloginfo ( 'language' ), 0, 2);?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<title><?php echo get_bloginfo( 'name' ); ?></title>

	<meta name="description" content="<?php echo get_bloginfo( 'description' ); ?>" />

	<!-- Facebook Metadata /-->
	<meta property="fb:page_id" content="275224689703667" />
	<meta property="og:image" content="<?php echo THEMEURL . 'images/video.jpg'; ?>" />
	<meta property="og:description" content="<?php echo get_bloginfo( 'description' ); ?>"/>
	<meta property="og:title" content="<?php echo get_bloginfo( 'name' ); ?>"/>

	<!-- Google+ Metadata /-->
	<meta itemprop="name" content="<?php echo get_bloginfo( 'name' ); ?>">
	<meta itemprop="description" content="<?php echo get_bloginfo( 'description' ); ?>">
	<meta itemprop="image" content="<?php echo THEMEURL . 'images/video.jpg'; ?>">

	<meta name="author" content="<?php echo THEMEURL;?>humans.txt">

	<?php include_once('inc/favicon.php'); ?>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<?php wp_head(); ?>

	<!-- Jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<!-- Slick -->
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

	<!-- Fontawesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" />

</head>
<body>

	<?php

	global $contacto;

	$contacto = new App\PageContacto;

	?>

	<?php

	/**
	 *CLTVO: poner esto en true sólo en la versiones locales.
	 */

	if( !defined('CLTVO_ISLOCAL') || ( CLTVO_ISLOCAL != true) ){ include_once('inc/analytics.php'); }

	?>

	<!--[if gt IE 8]><div style="z-index: 1000; padding: 5px 0; text-align: center; position: absolute; top: 0; left: 0; width: 100%; background-color: #312822;"><p style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: white;">Consider <a style="color: #EA7640;
	text-decoration: underline;" href="http://www.google.com/intl/es/chrome/browser/" target="_blank">updating your browser</a> in order to render this site correctly.</p></div><!-->
	<!--<![endif]-->

	<!-- Aquí abre el main-wrap -->
	<div class="main-wrap" id="app">
