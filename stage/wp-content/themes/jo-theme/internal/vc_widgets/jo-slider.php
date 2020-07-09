<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */


/**
 * Define widget
 */
function wph_jo_slider( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'slides'   => '',
				'design'   => 'design-1',
				's_height' => 'fullscreen',
				'el_class' => '',
			),
			$atts )
	);

	// generate slides markup
	$slides = wph_jo_param_group_parse_atts($slides);
	$slides_markup = ''; $titles_markup = '';
	foreach ( $slides as $slide ) {
		$slide['design'] = $design;
		$titles_markup .= wph_jo_slider_single( $slide, true );
		$slides_markup .= wph_jo_slider_single( $slide );
	}

	// final compilation
	return wph_jo_render_sc_template(
		wph_jo_load_sc_template( 'jo-slider.tpl' ),
		array(
			'{classes}'        => esc_attr( $el_class . ' ' . $design ),
			'{height}'         => esc_attr( str_replace( array('px', 'em'), '', strtolower( $s_height ) ) ),
			'{slides}'         => $slides_markup,
			'{titles}'         => $titles_markup,
			'{uid}'            => wph_jo_unique_id(),
			'{scroll_down_lg}' => esc_html__( 'Scroll down', 'jo-theme' ),
			'{searchform}'     => get_search_form( false ),
			'{socials}'        => wph_jo_display_socials( 'options', true )
		)
	);
}


/**
 * Single slide markup function
 */
function wph_jo_slider_single( $atts, $is_title = false ) {

	// attributes
	extract( shortcode_atts(
			array(
				'title'    => '',
				'color'    => '#fff',
				'url'      => '',
				'image'    => '',
				'design'   => 'design-1',
				'el_class' => '',
			),
			$atts )
	);

	// prepare template
	if ( $is_title ) {
		$tpl = wph_jo_load_sc_template( 'jo-slider.title.tpl' );
	} else {
		$tpl_name = ($design === 'design-1') ? 'jo-slider.bg-1.tpl' : 'jo-slider.bg-2.tpl';
		$tpl = wph_jo_load_sc_template( $tpl_name );
	}

	// assign template variables
	return wph_jo_render_sc_template(
		$tpl,
		array(
			'{classes}' => esc_attr( $el_class ),
			'{url}'     => esc_attr( $url ),
			'{title}'   => wp_kses_post( $title ),
			'{color}'   => esc_attr( $color ),
			'{image}'   => wph_jo_get_image_by_id( $image, 'jo_slider_preview' )
		)
	);
}


/**
 * Composer parameters
 */
function wph_jo_slider_integrateVC() {
	vc_map( array(
		'name'     => esc_html__( 'JO Main Slider', 'jo-theme' ),
		'base'     => 'wph_jo_slider',
		'icon'     => WPH_ASSETS_DIR . '/images/wphunters_logo.png',
		'category' => esc_html__( 'JO Theme', 'jo-theme' ),
		'params'   => array(
			array(
				'heading'    => esc_html__( 'Slides', 'jo-theme' ),
				'type'       => 'param_group',
				'value'      => '',
				'param_name' => 'slides',
                'params' => array(
	                array(
		                'type'        => 'textfield',
		                'value'       => '',
		                'heading'     => esc_html__( 'Title', 'jo-theme' ),
		                'description' => esc_html__( 'Main text for this slide.', 'jo-theme' ),
		                'param_name'  => 'title',
		                'admin_label' => true
	                ),
	                array(
		                'type'        => 'colorpicker',
		                'heading'     => esc_html__( 'Color', 'jo-theme' ),
		                'param_name'  => 'color',
		                'description' => esc_html__( 'Select custom text color for title.', 'jo-theme' ),
		                'std'         => '#fff'
	                ),
	                array(
		                'type'        => 'textfield',
		                'value'       => '',
		                'heading'     => esc_html__( 'Slide URL', 'jo-theme' ),
		                'description' => esc_html__( 'Can be empty.', 'jo-theme' ),
		                'param_name'  => 'url',
	                ),
					array(
						'type'        => 'attach_image',
						'heading'     => esc_html__( 'Background image', 'jo-theme' ),
						'param_name'  => 'image',
						'value'       => '',
						'description' => esc_html__( 'Upload image for this item.', 'jo-theme' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Extra class name', 'jo-theme' ),
						'param_name'  => 'el_class',
						'value'       => '',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'jo-theme' )
					)
				)
            ),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Slider design', 'jo-theme' ),
				'description' => esc_html__( 'Select slider design.', 'jo-theme' ),
				'param_name'  => 'design',
				'admin_label' => true,
				'value' => array(
					esc_html__( 'Design one', 'jo-theme' ) => 'design-1',
					esc_html__( 'Design two', 'jo-theme' ) => 'design-2',
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Slider height', 'jo-theme' ),
				'param_name'  => 's_height',
				'value'       => '',
				'description' => esc_html__( 'Type "fullscreen" or decimal height in pixels.', 'jo-theme' ),
				'dependency'  => array(
					'element' => 'design',
					'value'   => 'design-1'
				)
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'jo-theme' ),
				'param_name'  => 'el_class',
				'value'       => '',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'jo-theme' )
			)
		)
	) );
}


/**
 * Register Widget
 */
wph_jo_register_sc( 'wph_jo_slider', 'wph_jo_slider', 'wph_jo_slider_integrateVC' );