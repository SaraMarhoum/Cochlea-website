<?php
/**
 * Template name: Blogroll Page
 */

if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
get_header();


// get posts if this is not "posts page"
if ( ! is_home() ) {
	$wph_jo_paged = (int) get_query_var( 'paged', 1 );
	if ( $wph_jo_paged <= 0 ) {
		$wph_jo_paged = 1;
	}

	$args = array(
		'post_type'   => 'post',
		'post_status' => 'publish',
		'paged'       => $wph_jo_paged
	);

	if ( wph_jo_opt( 'custom_posts_per_page' ) ) {
		$args['posts_per_page'] = wph_jo_opt( 'custom_posts_per_page' );
	}

	query_posts( $args );
}


// get main template part
get_template_part( 'loop' );


// reset query and render footer
wp_reset_query();
get_footer();