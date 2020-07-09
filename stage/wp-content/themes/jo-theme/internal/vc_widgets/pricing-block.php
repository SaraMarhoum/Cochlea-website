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
function wph_jo_pricing_block( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'title'     => esc_html__( 'Premium service', 'jo-theme' ),
				'price'     => esc_html__( '$ 599', 'jo-theme' ),
				'highlight' => esc_html__( 'Most popular', 'jo-theme' ),
				'height'    => '360px',
				'el_class'  => '',
				'css'       => ''
			),
			$atts )
	);

	// some processing
	if ( trim( $highlight ) ) { $el_class .= ' highlighted'; }
	if ( ! trim( $height ) ) { $height = '360px'; }

	// final tpl compilation
	$main_tpl = wph_jo_load_sc_template( 'pricing-block.tpl' );

	return wph_jo_render_sc_template( $main_tpl,
		array(
			'{classes}'   => esc_attr( $el_class . wph_jo_custom_css_class( $css, ' ' ) ),
			'{title}'     => wp_kses_post( $title ),
			'{price}'     => wp_kses_post( $price ),
			'{height}'    => esc_attr( $height ),
			'{highlight}' => wp_kses_post( $highlight ),
			'{content}'   => do_shortcode( $content )
		)
	);
}


/**
 * Composer parameters
 */
function wph_jo_pricing_block_integrateVC() {
	vc_map( array(
		'name'     => esc_html__( 'Pricing', 'jo-theme' ),
		'base'     => 'wph_jo_pricing_block',
		'icon'     => WPH_ASSETS_DIR . '/images/wphunters_logo.png',
		'category' => esc_html__( 'JO Theme', 'jo-theme' ),
		'params'   => array(
			array(
				'type'       => 'textarea_html',
				'holder'     => 'div',
				'heading'    => esc_html__( 'Text', 'jo-theme' ),
				'param_name' => 'content',
				'value'      => wp_kses_post( __( '2 photosets<br/>Up to 5 people<br/>60 Photos<br/>Free album<br/>Free makeup',
					'jo-theme' ) ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Tile title', 'jo-theme' ),
				'param_name'  => 'title',
				'value'       => esc_html__('Premium service', 'jo-theme'),
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Price', 'jo-theme' ),
				'param_name'  => 'price',
				'value'       => esc_html__('$ 599', 'jo-theme'),
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Highlight', 'jo-theme' ),
				'description' => esc_html__( 'This price block will be highlighted and text from this field will be displayed at the bottom. Leave empty to make block regular.', 'jo-theme' ),
				'param_name'  => 'highlight',
				'value'       => esc_html__('Most popular', 'jo-theme'),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Tile height', 'jo-theme' ),
				'description' => esc_html__( 'CSS measurement units are supported.', 'jo-theme' ),
				'param_name'  => 'height',
				'value'       => '360px',
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
wph_jo_register_sc( 'wph_jo_pricing_block', 'wph_jo_pricing_block', 'wph_jo_pricing_block_integrateVC' );