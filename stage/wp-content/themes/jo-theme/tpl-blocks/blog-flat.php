<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

// manage columns (remove sidebar when no widgets is present)
$flow_cls    = 'col-xs-12 col-sm-7 col-md-8 have-sidebar';
$sidebar_cls = 'col-xs-12 col-sm-5 col-md-4';
if ( ! is_active_sidebar( 'jo-blog-sidebar' ) ) {
	$flow_cls    = 'col-xs-12';
	$sidebar_cls = 'hidden';
} ?>

<div class="row wph-flat-blog">

	<!-- Flow -->
	<div class="posts-flow <?php echo esc_attr($flow_cls); ?>">
		<?php while ( have_posts() ) {
			the_post();
			get_template_part( 'tpl-blocks', 'blog-flat-single' );
		} ?>

		<!-- Pagination -->
		<?php wph_jo_theme_paging_nav(); ?>
	</div>

	<!-- Sidebar -->
	<div class="<?php echo esc_attr($sidebar_cls); ?>">
		<div class="wph-blog-sidebar"><?php dynamic_sidebar( 'jo-blog-sidebar' ); ?></div>
	</div>

</div>