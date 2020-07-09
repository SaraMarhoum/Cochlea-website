<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/**
 * Add content ID column to custom post types
 */

add_action( 'init', 'wph_jo_enable_revealid' );
function wph_jo_enable_revealid() {
	$custom_post_types = get_post_types(
		array( '_builtin' => false ),
		'names'
	);

	$custom_post_types[] = 'post';

	foreach ( $custom_post_types as $post_type ) {
		if ( substr( $post_type, 0, 3 ) !== 'jo-' && $post_type !== 'post' ) {
			continue;
		}

		add_filter( 'manage_' . $post_type . '_posts_columns', 'wph_jo_revealid_add_id_column' );
		add_action( 'manage_' . $post_type . '_posts_custom_column', 'wph_jo_revealid_id_column_content', 10, 2 );
	}

	add_action( 'manage_jo-portfolio_posts_columns', 'wph_jo_revealid_add_thumb_column' );
}

function wph_jo_revealid_id_column_content( $column, $id ) {
	if ( 'revealid_id' == $column ) {
		echo $id;
	}

	if ( 'featured_thumb' == $column ) {
		echo '<a href="' . get_edit_post_link() . '">';
		echo '<img src="' . wph_jo_get_post_image( null, 'medium' ) . '" alt="' . get_the_title() . '"/>';
		echo '</a>';
	}
}

function wph_jo_revealid_add_id_column( $columns ) {
	$checkbox = array_slice( $columns, 0, 1 );
	$columns  = array_slice( $columns, 1 );

	$id['revealid_id'] = esc_html__( 'ID', 'jo-theme' );
	$columns           = array_merge( $checkbox, $id, $columns );

	return $columns;
}

function wph_jo_revealid_add_thumb_column( $columns ) {
	$checkbox = array_slice( $columns, 0, 1 );
	$columns  = array_slice( $columns, 1 );

	$id['featured_thumb'] = esc_html__( 'Thumbnail', 'jo-theme' );
	$columns              = array_merge( $checkbox, $id, $columns );

	return $columns;
}