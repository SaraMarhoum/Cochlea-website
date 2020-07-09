<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>


<!-- ========= Page hero block ========= -->
<?php wph_jo_page_heading() ?>


<!-- ========= Content holder ========= -->
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
