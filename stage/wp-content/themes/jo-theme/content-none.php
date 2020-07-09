<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>

<section id="wph-main-container" class="container">

	<!-- Error title -->
	<h1><?php esc_html_e( 'Nothing Found', 'jo-theme' ); ?></h1>

	<!-- Error explanation -->
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php printf( wp_kses_post( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.',
			'jo-theme' ) ), admin_url( 'post-new.php' ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.',
			'jo-theme' ); ?></p>
		<?php get_search_form(); ?>

	<?php else : ?>

		<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.',
			'jo-theme' ); ?></p>
		<?php get_search_form(); ?>

	<?php endif; ?>

</section>
