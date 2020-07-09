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
function wph_jo_tile_block( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'title'        => '',
				'description'  => '',
				'button'       => '',
				'aspect_ratio' => '100%',
				'bg_color'     => '',
				'el_class'     => '',
				'css'          => ''
			),
			$atts )
	);

	// parse aspect ratio
	if ( ! preg_match( '/^([0-9]+)%$/', trim($aspect_ratio), $parsed_ratio ) ) {
		return '<div class="nodata-error">' .
		       esc_html__( 'Invalid aspect ratio specified for this widget', 'jo-theme' ) .
		       '</div>';
	} else {
		$parsed_ratio = $parsed_ratio[1];
	}

	// parse background color
	if ( ! trim( $bg_color ) ) {
		$bg_color = 'transparent';
	}

	// generate button markup
	$button_markup = $overlay_markup = '';
	if ( trim( $button ) ) {
		$button           = vc_build_link( $button );
		$button['url']    = esc_attr( $button['url'] );
		$button['target'] = esc_attr( $button['target'] );
		$button['title']  = esc_html( $button['title'] );

		$overlay_markup = "<a href=\"{$button['url']}\" target=\"{$button['target']}\" class=\"link-overlay\">{$button['title']}</a>";
		$button_markup  = str_replace( ' class="link-overlay"', 'class="tile-link"', $overlay_markup );
	}

	// final tpl compilation
	$main_tpl = wph_jo_load_sc_template( 'tile-block.tpl' );
	return wph_jo_render_sc_template( $main_tpl,
		array(
			'{class}'   => esc_attr( $el_class . wph_jo_custom_css_class( $css, ' ' ) ),
			'{ratio}'   => $parsed_ratio,
			'{title}'   => wp_kses_post( $title ),
			'{descr}'   => ( trim( $description ) ) ? '<div class="desc">' . wp_kses_post( $description ) . '</div>' : '',
			'{overlay}' => $overlay_markup,
			'{bg}'      => esc_attr( $bg_color ),
			'{button}'  => $button_markup
		)
	);
}


/**
 * Composer parameters
 */
function wph_jo_tile_block_integrateVC() {
	vc_map( array(
		'name'     => esc_html__( 'Tile block', 'jo-theme' ),
		'base'     => 'wph_jo_tile_block',
		'icon'     => WPH_ASSETS_DIR . '/images/wphunters_logo.png',
		'category' => esc_html__( 'JO Theme', 'jo-theme' ),
		'params'   => array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Tile title', 'jo-theme' ),
				'param_name'  => 'title',
				'value'       => '',
				'admin_label' => true
			),
			array(
				'type'        => 'textarea',
				'heading'     => esc_html__( 'Description', 'jo-theme' ),
				'param_name'  => 'description',
				'value'       => '',
				'description' => esc_html__( 'Will be shown under title. Can be empty.', 'jo-theme' )
			),
			array(
				'type'        => 'vc_link',
				'heading'     => esc_html__( 'Button', 'jo-theme' ),
				'param_name'  => 'button',
				'value'       => '',
				'description' => esc_html__( 'Can be empty.', 'jo-theme' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Aspect ratio', 'jo-theme' ),
				'description' => wp_kses_post( __( 'Enter ther ratio of width to height in percents.<br/><b>For example:</b> 100% value will make a square, 30% - wide rectangle.', 'jo-theme' ) ),
				'param_name'  => 'aspect_ratio',
				'value'       => '100%'
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => __( 'Background Color', 'jo-theme' ),
				'param_name'  => 'bg_color',
				'description' => esc_html__( 'If empty - transparent background will used.', 'jo-theme' ),
				'std'         => ''
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'jo-theme' ),
				'param_name'  => 'el_class',
				'value'       => '',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'jo-theme' )
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
wph_jo_register_sc( 'wph_jo_tile_block', 'wph_jo_tile_block', 'wph_jo_tile_block_integrateVC' );