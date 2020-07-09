<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>


<!-- ========= Page hero block ========= -->
<?php wph_jo_page_heading() ?>


<?php // show the builder content without any markup
if(wph_jo_is_composer_post()) {
	echo '<section class="container vc_enabled" id="wph-main-container">';
	the_content();
	echo '</section>';
	return;
} ?>


<section id="wph-main-container" <?php post_class('static-page container'); ?>>

	<!-- Page body -->
	<div class="page-content">
		<!-- Content -->
		<?php the_content(); ?>

		<!-- pagination -->
		<?php wp_link_pages(); ?>
	</div>

	<!-- Comments -->
	<?php if ( comments_open() ): ?>
		<div class="wph-comments-section"><?php comments_template(); ?></div>
	<?php endif; ?>

</section>
