<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */


/**
 * Helper functions
 */
function wph_jo_generate_filter_html($query) {

	/* @var $query WP_Query */

	$res = array();
	if ( $query->have_posts() === false ) {
		return '';
	}

	while ( $query->have_posts() ) {
		$query->the_post();
		foreach ( wph_jo_get_portfolio_tags( get_the_ID() ) as $t ) {
			$res[ $t['slug'] ] = $t['name'];
		}
	}

	// get array to proper looking
	$res = array_unique( $res );
	//natcasesort( $res );

	// clean query and return empty string
	// if there is no any tags
	wp_reset_postdata();
	if ( ! sizeof( $res ) ) {
		return '';
	}

	// generate HTML output
	$out = '<a href="#" data-filter="wph_inner_all" class="filter-active">' . esc_html__( 'All', 'jo-theme' ) . '</a>';
	foreach ( $res as $slug => $name ) {
		$slug = esc_attr( $slug );
		$name = esc_html( $name );
		$out .= "<a href=\"#\" data-filter=\"{$slug}\">{$name}</a>";
	}

	return $out;
}


/**
 * Register shortcode
 */
function wph_jo_portfolio_showcase( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'items'         => 'size:6|order_by:date|order:DESC|post_type:jo-portfolio',
				'teaser_layout' => 'layout_1',
				'teaser_sl'     => 'date',
				'teaser_ims'    => 'jo_square_thumb',
				'teaser_ar'     => '100%',
				'teaser_ecl'    => '',
				'masonry'       => '',
				'hide_filter'   => 'no',
				'css_columns'   => '3',
				'el_class'      => '',
				'css'           => ''
			),
			$atts )
	);

	// return error when VC is not available
	if ( ! function_exists( 'vc_build_loop_query' ) ) {
		$out = '';
		$out .= '<div class="nodata-error">';
		$out .= esc_html__( 'Visual Composer is required for correct working of this widget.', 'jo-theme' );
		$out .= '</div>';
		return $out;
	}

	// check query for errors
	$items = vc_build_loop_query( $items );
	if ( ! is_array( $items ) || ! isset( $items[1] ) || ! $items[1] instanceof WP_Query ) {
		return '<div class="nodata-error">' . esc_html__( 'No items specified for this block', 'jo-theme' ) . '</div>';
	} else {
		$query = $items[1];
	}

	// generate filter markup
	if ( strtolower( $hide_filter ) !== 'yes' ) {
		$filter_markup = wph_jo_generate_filter_html( $query );
	} else {
		$filter_markup = '';
	}

	// generate items markup
	$items_markup = '';
	while ( $query->have_posts() ) {
		$query->the_post();

		// get tags
		$filter_tags = array('wph_inner_all');
		foreach(wph_jo_get_portfolio_tags(get_the_ID()) as $tag) {
			$filter_tags[] = $tag['slug'];
		}

		// enable masonry
		$aspect_ratio = $teaser_ar;
		if ( strtolower( $masonry ) === 'yes' ) {
			$img_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'original' );
			if ( $img_data ) {
				$aspect_ratio = round( $img_data[2] / $img_data[1], 2 ) * 100;
				$aspect_ratio .= '%';
			}
		}

		$filter_tags = join('|', $filter_tags);
		$items_markup .= '<div class="item w-' . esc_attr( $css_columns ) . '" data-groups="' . $filter_tags . '">';
		$items_markup .= wph_jo_post_teaser( array(
			'layout'       => $teaser_layout,
			'second_line'  => $teaser_sl,
			'img_size'     => $teaser_ims,
			'post_id'      => get_the_ID(),
			'aspect_ratio' => $aspect_ratio,
			'el_class'     => $teaser_ecl
		) );
		$items_markup .= '</div>';
	}

	// final compilation
	$tpl  = wph_jo_load_sc_template( 'portfolio-showcase.tpl' );
	$vars = array(
		'{classes}' => esc_attr( $el_class . wph_jo_custom_css_class( $css, ' ' ) ),
		'{items}'   => $items_markup,
		'{filter}'  => $filter_markup
	);

	wp_reset_postdata();

	return wph_jo_render_sc_template( $tpl, $vars );
}


/**
 * Add to composer
 */
function wph_jo_portfolio_showcase_integrateVC() {
	$image_sizes = array(
		'jo_square_thumb(650x650)' => 'jo_square_thumb',
		'jo_wide_thumb(1280x650)'  => 'jo_wide_thumb'
	);

	foreach ( wph_jo_get_image_sizes() as $size => $info ) {
		$title_str                 = $size . '(' . $info['width'] . 'x' . $info['height'] . ')';
		$image_sizes[ $title_str ] = $size;
	}

	vc_map( array(
		'name'     => esc_html__( 'Portfolio showcase', 'jo-theme' ),
		'base'     => 'wph_jo_portfolio_showcase',
		'icon'     => WPH_ASSETS_DIR . '/images/wphunters_logo.png',
		'category' => esc_html__( 'JO Theme', 'jo-theme' ),
		'params'   => array(
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Hide filter?', 'jo-theme' ),
				'param_name'  => 'hide_filter',
				'description' => esc_html__( 'If checked, portfolio filter won\'t be shown.', 'jo-theme' ),
				'value'       => array( esc_html__( 'Yes', 'jo-theme' ) => 'yes' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Columns count', 'jo-theme' ),
				'param_name'  => 'css_columns',
				'description' => esc_html__( 'Select how many columns should have this showcase.', 'jo-theme' ),
				'value' => array(
					esc_html__( '1 column (fullwidth)', 'jo-theme' ) => '1',
					esc_html__( '2 columns', 'jo-theme' )            => '2',
					esc_html__( '3 columns', 'jo-theme' )            => '3',
					esc_html__( '4 columns', 'jo-theme' )            => '4',
				)
			),
			array(
				'type'        => 'loop',
				'heading'     => esc_html__( 'Items source', 'jo-theme' ),
				'description' => '',
				'param_name'  => 'items',
				'value'       => 'size:6|order_by:date|order:DESC|post_type:jo-portfolio',
				'settings'    => array(),
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'jo-theme' ),
				'param_name'  => 'el_class',
				'value'       => '',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'jo-theme' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Background image size', 'jo-theme' ),
				'description' => esc_html__( 'It is recommended to use larger image for larger blocks to avoid lake of image quality on some devices.', 'jo-theme' ),
				'group'       => esc_html__( 'Post teaser options', 'jo-theme' ),
				'param_name'  => 'teaser_ims',
				'value'       => $image_sizes
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Layout', 'jo-theme' ),
				'param_name'  => 'teaser_layout',
				'description' => esc_html__( 'Controls how should be displayed inner elements(tags, date, title, image, etc..)', 'jo-theme' ),
				'group'       => esc_html__( 'Post teaser options', 'jo-theme' ),
				'value'       => array(
					esc_html__( 'Layout #1 (white box on hover)', 'jo-theme' )       => 'layout_1',
					esc_html__( 'Layout #2 (white line on the bottom)', 'jo-theme' ) => 'layout_2',
					esc_html__( 'Layout #3 (gradient on the bottom)', 'jo-theme' )   => 'layout_3',
				)
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Additional information to show:', 'jo-theme' ),
				'param_name'  => 'teaser_sl',
				'description' => esc_html__( 'Will be shown under post title.', 'jo-theme' ),
				'group'       => esc_html__( 'Post teaser options', 'jo-theme' ),
				'value'       => array(
					esc_html__( 'Post date', 'jo-theme' )              => 'date',
					esc_html__( 'Post tags', 'jo-theme' )              => 'tags',
					esc_html__( 'Post categories', 'jo-theme' )        => 'categories',
					esc_html__( 'None (show only title)', 'jo-theme' ) => 'none',
				)
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Enable masonry?', 'jo-theme' ),
				'param_name'  => 'masonry',
				'description' => esc_html__( 'If checked, portfolio items will be rearranged in masonry layout. Aspect ratio value will be ignored.', 'jo-theme' ),
				'group'       => esc_html__( 'Post teaser options', 'jo-theme' ),
				'value'       => array( esc_html__( 'Yes', 'jo-theme' ) => 'yes' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Aspect ratio', 'jo-theme' ),
				'description' => wp_kses_post( __( 'Enter ther ratio of width to height in percents.<br/><b>For example:</b> 100% value will make a square, 30% - wide rectangle.', 'jo-theme' ) ),
				'group'       => esc_html__( 'Post teaser options', 'jo-theme' ),
				'param_name'  => 'teaser_ar',
				'value'       => '100%'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'jo-theme' ),
				'param_name'  => 'teaser_ecl',
				'value'       => '',
				'group'       => esc_html__( 'Post teaser options', 'jo-theme' ),
				'description' => esc_html__( 'Will be applied to every single post teaser element.', 'jo-theme' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'CSS box', 'jo-theme' ),
				'param_name' => 'css',
				'group'      => esc_html__( 'Design Options', 'jo-theme' )
			),
		)
	) );
}


/**
 * Register Widget
 */
wph_jo_register_sc( 'wph_jo_portfolio_showcase', 'wph_jo_portfolio_showcase', 'wph_jo_portfolio_showcase_integrateVC' );