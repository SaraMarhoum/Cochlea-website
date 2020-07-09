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
function wph_jo_styled_textbox( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'font_family' => 'wph-primary-font',
				'custom_color'   => '',
				'font_size'   => '',
				'line_height' => '',
				'el_class'    => '',
				'css'         => ''
			),
			$atts )
	);

	/**
	 * @var $font_family     string
	 * @var $custom_color       string
	 * @var $font_size       string
	 * @var $line_height     string
	 * @var $el_class        string
	 * @var $css             string
	 */

	// classes
	$container_class = array( $el_class, wph_jo_custom_css_class( $css ), $font_family );
	$container_class = esc_attr( join( ' ', $container_class ) );

	// generate CSS
	$css_output = '';
	$css_string = array( 'font-size' => $font_size, 'line-height' => $line_height, 'color' => $custom_color );
	foreach ( $css_string as $prop => $value ) {
		if ( ! $value ) {
			continue;
		}
		$css_output .= $prop . ':' . esc_attr( $value ) . ';';
	}

	// make output
	$tpl  = wph_jo_load_sc_template( 'styled-textbox.tpl' );
	$vars = array(
		'{text}'    => do_shortcode( $content ),
		'{classes}' => $container_class,
		'{css}'     => $css_output
	);

	return wph_jo_render_sc_template( $tpl, $vars );
}


/**
 * Add to composer
 */
function wph_jo_styled_textbox_integrateVC() {
	vc_map( array(
		'name'     => esc_html__( 'Styled textbox', 'jo-theme' ),
		'base'     => 'wph_jo_styled_textbox',
		'icon'     => WPH_ASSETS_DIR . '/images/wphunters_logo.png',
		'category' => esc_html__( 'JO Theme', 'jo-theme' ),
		'params'   => array(
			array(
				'type'       => 'textarea_html',
				'holder'     => 'div',
				'heading'    => esc_html__( 'Text', 'jo-theme' ),
				'param_name' => 'content',
				'value'      => wp_kses_post( __( '<p>Ultrices et diam? Cursus! Placerat nisi, magna, scelerisque adipiscing ridiculus aliquet phasellus, dis. Ridiculus dis, a dapibus nec natoque etiam.</p>',
					'jo-theme' ) ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Choose font', 'jo-theme' ),
				'param_name' => 'font_family',
				'value'      => array(
					esc_html__( 'Primary font', 'jo-theme' )  => 'wph-primary-font',
					esc_html__( 'Secondary font', 'jo-theme' ) => 'wph-secondary-font',
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Font size', 'jo-theme' ),
				'param_name'  => 'font_size',
				'value'       => '',
				'description' => esc_html__( 'Leave empty to use default.', 'jo-theme' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Line-height', 'jo-theme' ),
				'param_name'  => 'line_height',
				'value'       => '',
				'description' => esc_html__( 'Leave empty to use default.', 'jo-theme' )
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => __( 'Text Color', 'jo-theme' ),
				'param_name'  => 'custom_color',
				'description' => esc_html__( 'Select custom text color for text.', 'jo-theme' ),
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
wph_jo_register_sc( 'wph_jo_styled_textbox', 'wph_jo_styled_textbox', 'wph_jo_styled_textbox_integrateVC' );