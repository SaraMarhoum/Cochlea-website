<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>


<?php // display "no posts found" message
if ( ! have_posts() || wph_jo_is_empty_search() ) {
	get_template_part( 'content', 'none' );

	return;
} ?>


<?php // display single post/page
if ( is_singular() ) {
	the_post();

	if ( wph_jo_is_page() ) {
		get_template_part( 'content', 'page' );
	} else {
		get_template_part( 'content', str_replace('jo-', '', get_post_type()) );
	}

	return;
} ?>


<?php // page hero
wph_jo_page_heading(); ?>

<section id="wph-main-container" class="container">

	<?php // display listing
	$blog_layout = wph_jo_opt('blogroll_page_layout', 'flat');
	get_template_part( 'tpl-blocks', 'blog-' . $blog_layout ); ?>

</section>
