<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

/**
 * Register shortcode
 */
function wph_jo_testimonials_slider( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'items'    => '',
				'el_class' => '',
			),
			$atts )
	);

	// nodata error
	if(!trim($items)) {
		return '<div class="nodata-error">' . esc_html__('No items specified for this block', 'jo-theme') . '</div>';
	}

	// load templates
	$main_tpl   = wph_jo_load_sc_template( 'testimonials.tpl' );
	$single_tpl = wph_jo_load_sc_template( 'testimonials.single.tpl' );
	$author_tpl = wph_jo_load_sc_template( 'testimonials.author.tpl' );

	// get items
	$items    = array_map( 'trim', explode( ',', $items ) );
	$loop_out = $loop_authors = '';
	$query    = new WP_Query( array(
		'cache_results'  => true,
		'post__in'       => $items,
		'post_type'      => 'jo-testimonials',
		'orderby'        => 'post__in',
		'posts_per_page' => - 1
	) );

	// create markup
	while ( $query->have_posts() ) {
		$query->the_post();

		// single
		$vars = array(
			'{text}'    => nl2br( trim( get_the_content() ) ),
			'{classes}' => esc_attr( join( ' ', get_post_class( 'item', get_the_ID() ) ) ),
		);
		$loop_out .= wph_jo_render_sc_template( $single_tpl, $vars );

		// photo
		$photo = get_field( 'author_photo' );
		if ( ! $photo ) {
			$photo = WPH_ASSETS_DIR . '/images/avatar_placeholder.png';
		}

		// author
		$name = get_field( 'author_name' );
		$vars = array(
			'{image}'     => esc_attr( $photo ),
			'{name_esc}'  => esc_attr( $name ),
			'{name_html}' => esc_html( $name ),
			'{info}'      => wp_kses_post( get_field( 'author_info' ) )
		);
		$loop_authors .= wph_jo_render_sc_template( $author_tpl, $vars );
	}

	// final tpl compilation
	$out = wph_jo_render_sc_template( $main_tpl,
		array(
			'{el_class}' => trim( $el_class ),
			'{slider}'   => $loop_out,
			'{authors}'  => $loop_authors
		) );

	// out
	wp_reset_query();

	return $out;
}


/**
 * Composer parameters
 */
function wph_jo_testimonials_slider_integrateVC() {
	vc_map( array(
		'name'     => esc_html__( 'Testimonials Slider', 'jo-theme' ),
		'base'     => 'wph_jo_testimonials_slider',
		'icon'     => WPH_ASSETS_DIR . '/images/wphunters_logo.png',
		'category' => esc_html__( 'JO Theme', 'jo-theme' ),
		'params'   => array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Item ID\'s', 'jo-theme' ),
				'description' => wp_kses_post( __( 'Comma separated list of testimonials item ID\'s. <a href="http://docs.wphunters.com/?p=165" target="_blank">How to get it?</a>', 'jo-theme' ) ),
				'param_name'  => 'items',
				'admin_label' => true,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'jo-theme' ),
				'param_name'  => 'el_class',
				'value'       => '',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'jo-theme' )
			),
		)
	) );
}


/**
 * Register Widget
 */
wph_jo_register_sc('wph_jo_testimonials_slider', 'wph_jo_testimonials_slider', 'wph_jo_testimonials_slider_integrateVC');