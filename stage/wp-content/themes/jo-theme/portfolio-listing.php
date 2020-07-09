<?php
/**
 * Template name: Portfolio listing page
 */

if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
get_header();

// display "no posts found" message
if ( ! have_posts() ) {
	get_template_part( 'content', 'none' );

	return;
} ?>

<!-- Main container -->
<div id="wph-main-container" class="container">

	<?php
	// render filter
	get_template_part('tpl-blocks', 'portfolio-filter');

	// show portfolio items
	get_template_part('tpl-blocks', 'portfolio-items');

	// portfolio next page link
	get_template_part('tpl-blocks', 'portfolio-pagination'); ?>

</div>

<?php wp_reset_query(); get_footer();