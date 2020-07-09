<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

// manage columns (remove sidebar when no widgets is present)
$flow_cls    = 'col-xs-12 col-sm-7 col-md-8 have-sidebar';
$sidebar_cls = 'col-xs-12 col-sm-5 col-md-4';
if ( ! is_active_sidebar( 'jo-blog-sidebar' ) ) {
	$flow_cls    = 'col-xs-12';
	$sidebar_cls = 'hidden';
} ?>

<section id="wph-main-container" class="container">
<div class="row wph-blog-single">

	<!-- Flow -->
	<div class="post-area <?php echo esc_attr($flow_cls); ?>">

		<!-- Post body -->
		<div <?php post_class( 'post-item' ); ?>>
			<?php get_template_part( 'tpl-blocks', 'blog-post-body' ); ?>
		</div>

		<!-- Post's switcher -->
		<div class="switcher-section">
			<?php echo wph_jo_adjacent_posts(); ?>
		</div>

		<!-- Comments -->
		<?php if ( comments_open() ): ?>
			<div class="wph-comments-section"><?php comments_template(); ?></div>
		<?php endif; ?>

	</div>

	<!-- Sidebar -->
	<div class="<?php echo esc_attr($sidebar_cls); ?>">
		<div class="wph-blog-sidebar"><?php dynamic_sidebar( 'jo-blog-sidebar' ); ?></div>
	</div>

</div>
</section>
