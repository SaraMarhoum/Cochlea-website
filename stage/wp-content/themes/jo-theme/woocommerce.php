<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
get_header(); ?>

<section id="wph-main-container" <?php post_class('static-page'); ?>>
	
	<!-- Page body -->
	<div class="container page-body"><?php woocommerce_content(); ?></div>

</section>
<?php get_footer();