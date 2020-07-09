<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>

<!-- Flow -->
<div class="wph-blog-grid">
<div class="block-grid-xs-1 block-grid-sm-2 block-grid-md-4 wow sequenced fx-fadeIn">

	<?php $layout = wph_jo_opt('blogroll_grid_layout', 'layout_3');
	while ( have_posts() ) {
		the_post();

		// run shortcode
		echo '<div class="item">';
		echo wph_jo_post_teaser( array(
			'layout'   => $layout,              // appearance
			'post_id'  => get_the_ID(),         // post ID
			'img_size' => 'jo_square_thumb',    // set larger image size
			'el_class' => 'nohover'             // disable hover animations
		) );
		echo '</div>';
	} ?>

</div>
</div>

<!-- Pagination -->
<?php wph_jo_theme_paging_nav(); ?>