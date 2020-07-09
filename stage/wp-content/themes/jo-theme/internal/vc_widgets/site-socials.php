<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */


/**
 * Register a stand-alone shortcode
 */
wph_jo_register_sc('wph_jo_site_socials', 'wph_jo_socials_shortcode');
function wph_jo_socials_shortcode() {

	$socials = wph_jo_display_socials( 'options', true );
	if ( ! trim( $socials ) ) {
		return '';
	}

	return '<div class="site-socials">' . $socials . '</div>';

}


/**
 * Register shortcode
 */
function wph_jo_socials_widget( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'text'     => '',
				'socials'  => 'Facebook : http://facebook.com/example' . "\n" . 'Twitter : http://twitter.com/example',
				'align'    => 'align_center',
				'el_class' => '',
				'css'      => ''
			),
			$atts )
	);

	/**
	 * @var $text string
	 * @var $css string
	 * @var $align string
	 */

	$container_class = esc_attr( $el_class . ' ' . $align . wph_jo_custom_css_class( $css, ' ' ) );
	$buttons         = '';

	// parse networks list
	foreach ( explode( PHP_EOL, strip_tags( $socials ) ) as $line ) {
		list( $network, $link ) = explode( ':', $line, 2 );
		$network = preg_replace( '|\s+|', '-', strtolower( trim( $network ) ) );
		$buttons .= '<a href="' . esc_url( trim( $link ) ) . '"><i class="wph-icon-' . esc_attr( $network ) . '"></i></a>';
	}

	// make output
	// TODO: add styles for this block
	// TODO: move this to .tpl file
	$out = '<div class="share-buttons-container ' . trim( $container_class ) . '">';
	$out .= '<div class="text-inner">' . wp_kses_post( $text ) . '</div>';
	$out .= '<div class="share-buttons">' . $buttons . '</div>';
	$out .= '</div>';

	return $out;
}


/**
 * Add to composer
 */
function wph_jo_socials_widget_integrateVC() {
	vc_map( array(
		'name'     => esc_html__( 'Socials list', 'jo-theme' ),
		'base'     => 'wph_jo_socials_widget',
		'icon'     => WPH_ASSETS_DIR . '/images/wphunters_logo.png',
		'category' => esc_html__( 'JO Theme', 'jo-theme' ),
		'params'   => array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Text', 'jo-theme' ),
				'param_name'  => 'text',
				'value'       => '',
				'description' => esc_html__( 'Basic HTML allowed.', 'jo-theme' ),
				'admin_label' => true
			),
			array(
				'type'        => 'textarea',
				'heading'     => esc_html__( 'Socials', 'jo-theme' ),
				'param_name'  => 'socials',
				'value'       => 'Facebook : http://facebook.com/example' . "\n" . 'Twitter : http://twitter.com/example',
				'description' => wp_kses_post(__( '<b>Format:</b> Facebook : http://facebook.com/example (one per line)', 'jo-theme' )),
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
wph_jo_register_sc('wph_jo_socials_widget', 'wph_jo_socials_widget', 'wph_jo_socials_widget_integrateVC');