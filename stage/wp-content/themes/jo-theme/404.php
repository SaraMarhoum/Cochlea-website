<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } get_header(); ?>

<!-- ========= Content ========= -->
<section id="wph-main-container"><div class="container-inner">

	<!-- Big text background -->
	<h1 class="background fittext vh-center-js wow zoomIn"
	    data-comp-rate="0.3"
	    data-max-size="650">
		<?php echo esc_html__( '404', 'jo-theme' ); ?>
	</h1>

	<!-- Buttons row -->
	<div class="foreground wow fadeIn" data-wow-delay="250ms">
		<h1><?php echo esc_html__( 'Page not found', 'jo-theme' ); ?></h1>

		<a class="btn btn-lg btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php esc_html_e( 'Ok, go to home', 'jo-theme' ); ?>
		</a>
	</div>

</div></section>

<?php get_footer(); ?>