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
function wph_jo_button( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'link'     => '',
				'style'    => 'btn-primary',
				'size'     => '',
				'align'    => 'align_center',
				'el_class' => '',
				'css'      => ''
			),
			$atts )
	);

	/**
	 * @var $link       string
	 * @var $style      string
	 * @var $size       string
	 * @var $align      string
	 * @var $css        string
	 * @var $el_class   string
	 */

	$container_class = esc_attr( $el_class . wph_jo_custom_css_class( $css, ' ' ) . ' ' . $align );
	$btn_classes     = array( esc_attr( $style ) );
	if($size) $btn_classes[] = esc_attr($size);

	// build link
	$link = vc_build_link($link);

	// make output
	$tpl  = wph_jo_load_sc_template( 'button.tpl' );
	$vars = array(
		'{classes}'     => $container_class,
		'{btn_classes}' => join( ' ', $btn_classes ),
		'{href}'        => esc_attr( $link['url'] ),
		'{target}'      => esc_attr( $link['target'] ),
		'{text}'        => esc_html( $link['title'] )
	);

	return wph_jo_render_sc_template( $tpl, $vars );
}


/**
 * Add to composer
 */
function wph_jo_button_integrateVC() {
	vc_map( array(
		'name'     => esc_html__( 'Button', 'jo-theme' ),
		'base'     => 'wph_jo_button',
		'icon'     => WPH_ASSETS_DIR . '/images/wphunters_logo.png',
		'category' => esc_html__( 'JO Theme', 'jo-theme' ),
		'params'   => array(
			array(
				'type'        => 'vc_link',
				'heading'     => esc_html__( 'Link', 'jo-theme' ),
				'param_name'  => 'link',
				'admin_label' => true
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Style', 'jo-theme' ),
				'param_name'  => 'style',
				'value' => array(
					esc_html__( 'Primary color', 'jo-theme' )             => 'btn-primary',
					esc_html__( 'Green color', 'jo-theme' )               => 'btn-success',
					esc_html__( 'Blue color', 'jo-theme' )                => 'btn-info',
					esc_html__( 'Orange color', 'jo-theme' )              => 'btn-warning',
					esc_html__( 'Red color', 'jo-theme' )                 => 'btn-danger',
					esc_html__( 'Simple (without backdrop)', 'jo-theme' ) => 'btn-simple'
				),
				'description' => esc_html__( 'Select button size.', 'jo-theme' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Size', 'jo-theme' ),
				'param_name'  => 'size',
				'value' => array(
					esc_html__( 'Default', 'jo-theme' )     => '',
					esc_html__( 'Large wide', 'jo-theme' )  => 'btn-wide',
					esc_html__( 'Large', 'jo-theme' )       => 'btn-lg',
					esc_html__( 'Small', 'jo-theme' )       => 'btn-sm',
					esc_html__( 'Extra small', 'jo-theme' ) => 'btn-xs'
				),
				'description' => esc_html__( 'Select button size.', 'jo-theme' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Alignment', 'jo-theme' ),
				'param_name'  => 'align',
				'value'       => array(
					esc_html__( 'Center', 'jo-theme' ) => 'align_center',
					esc_html__( 'Left', 'jo-theme' )   => 'align_left',
					esc_html__( 'Right', 'jo-theme' )  => 'align_right'
				),
				'description' => esc_html__( 'Select button alignment.', 'jo-theme' )
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
wph_jo_register_sc( 'wph_jo_button', 'wph_jo_button', 'wph_jo_button_integrateVC' );