<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

/**
 * Single post item widget
 */
function wph_jo_post_teaser( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'layout'       => 'layout_1',
				'second_line'  => 'date',
				'img_size'     => 'jo_square_thumb',
				'post_id'      => '',
				'aspect_ratio' => '100%',
				'el_class'     => ''
			),
			$atts )
	);

	// nodata error
	if ( ! trim( $post_id ) || ! is_numeric( $post_id ) || $post_id < 0 || get_post_status( $post_id ) === false ) {
		return '<div class="nodata-error">' .
		       esc_html__( 'Invalid item specified for this widget', 'jo-theme' ) .
		       '</div>';
	}

	// parse aspect ratio
	if ( ! preg_match( '/^([0-9]+)(%?)$/', trim($aspect_ratio), $parsed_ratio ) ) {
		return '<div class="nodata-error">' .
		       esc_html__( 'Invalid aspect ratio specified for this widget', 'jo-theme' ) .
		       '</div>';
	} else {
		$parsed_ratio = $parsed_ratio[1];
	}

	// add class modificators
	if ( $parsed_ratio <= 40 ) {
		$el_class .= ' ratio-wide';
	}

	// generate tags string
	$post_tags = array();
	foreach ( wph_jo_get_portfolio_tags( $post_id ) as $tag ) {
		$post_tags[] = $tag['name'];
		$el_class .= ' tag-' . $tag['slug'];
	}

	// generate second line string
	switch($second_line) {
		case 'date':
			$second_line_str = get_the_date( '', $post_id );
			break;

		case 'tags':
			$second_line_str = join( ', ', $post_tags );
			break;

		case 'categories':
			$categories      = get_the_category( $post_id );
			$second_line_str = array();
			foreach ( $categories as $cat ) {
				$second_line_str[] = $cat->name;
			}
			$second_line_str = join( ',', $second_line_str );
			break;

		default:
		case 'none':
			$second_line_str = '';
			break;
	}

	// prepare variables
	$post_classes = array( trim($el_class), trim($layout) );
	if($second_line_str) { $post_classes[] = 'with-2-line'; }

	$tpl  = wph_jo_load_sc_template( 'post-teaser.tpl' );
	$vars = array(
		'{el_class}'  => join( ' ', get_post_class( $post_classes, $post_id ) ),
		'{title}'     => get_the_title( $post_id ),
		'{add-info}'  => ($second_line_str) ? '<span class="second-line">' . $second_line_str . '</span>' : '',
		'{image}'     => wph_jo_get_post_image( $post_id, $img_size ),
		'{link}'      => get_the_permalink( $post_id ),
		'{ratio}'     => esc_attr( $parsed_ratio ),
		'{read_more}' => esc_html__( 'Read more', 'jo-theme' )
	);

	return wph_jo_render_sc_template( $tpl, $vars );
}


/**
 * Composer parameters
 */
function wph_jo_post_teaser_integrateVC() {
	$image_sizes = array(
		'jo_square_thumb(650x650)' => 'jo_square_thumb',
		'jo_wide_thumb(1280x650)'  => 'jo_wide_thumb'
	);

	foreach ( wph_jo_get_image_sizes() as $size => $info ) {
		$title_str                 = $size . '(' . $info['width'] . 'x' . $info['height'] . ')';
		$image_sizes[ $title_str ] = $size;
	}

	vc_map( array(
		'name'     => esc_html__( 'Post teaser', 'jo-theme' ),
		'base'     => 'wph_jo_post_teaser',
		'icon'     => WPH_ASSETS_DIR . '/images/wphunters_logo.png',
		'category' => esc_html__( 'JO Theme', 'jo-theme' ),
		'params'   => array(
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Background image size', 'jo-theme' ),
				'description' => esc_html__( 'It is recommended to use larger image for larger blocks to avoid lake of image quality on some devices.', 'jo-theme' ),
				'param_name'  => 'img_size',
				'value'       => $image_sizes
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Layout', 'jo-theme' ),
				'param_name'  => 'layout',
				'description' => esc_html__( 'Controls how should be displayed inner elements(tags, date, title, image, etc..)', 'jo-theme' ),
				'value' => array(
					esc_html__( 'Layout #1 (white box on hover)', 'jo-theme' )       => 'layout_1',
					esc_html__( 'Layout #2 (white line on the bottom)', 'jo-theme' ) => 'layout_2',
					esc_html__( 'Layout #3 (gradient on the bottom)', 'jo-theme' )   => 'layout_3',
				)
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Additional information to show:', 'jo-theme' ),
				'param_name'  => 'second_line',
				'description' => esc_html__( 'Will be shown under post title.', 'jo-theme' ),
				'value'       => array(
					esc_html__( 'Post date', 'jo-theme' )              => 'date',
					esc_html__( 'Post tags', 'jo-theme' )              => 'tags',
					esc_html__( 'Post categories', 'jo-theme' )        => 'categories',
					esc_html__( 'None (show only title)', 'jo-theme' ) => 'none',
				)
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Item ID', 'jo-theme' ),
				'description' => wp_kses_post( __( 'ID of item that should be displayed. <a href="http://docs.wphunters.com/?p=165" target="_blank">How to get it?</a>', 'jo-theme' ) ),
				'param_name'  => 'post_id',
				'admin_label' => true,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Aspect ratio', 'jo-theme' ),
				'description' => wp_kses_post( __( 'Enter ther ratio of width to height in percents.<br/><b>For example:</b> 100% value will make a square, 30% - wide rectangle.', 'jo-theme' ) ),
				'param_name'  => 'aspect_ratio',
				'value'       => '100%'
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
wph_jo_register_sc( 'wph_jo_post_teaser', 'wph_jo_post_teaser', 'wph_jo_post_teaser_integrateVC' );