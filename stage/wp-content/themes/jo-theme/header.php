<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


<!-- ========= Preloader ========= -->
<div class="preloader-overlay">
	<div class="preloader main-site-preloader"></div>
</div>


<!-- ========= Scrolling anchor ========= -->
<div id="page-top"></div>


<!-- ========= Header ========= -->
<?php wph_jo_display_header(); ?>