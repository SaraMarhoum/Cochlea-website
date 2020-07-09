<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>

<!-- Flow -->
<div class="wph-blog-chess wph-chess-narrow-block">

	<?php while ( have_posts() ) {
		the_post();
		get_template_part( 'tpl-blocks', 'blog-chess-single' );
	} ?>

</div>

<!-- Pagination -->
<div class="wph-chess-narrow-block">

	<?php wph_jo_theme_paging_nav(); ?>

</div>
