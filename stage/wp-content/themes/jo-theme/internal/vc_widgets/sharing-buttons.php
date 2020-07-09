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
function wph_jo_share_buttons( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'text'     => '',
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
	$buttons         = wph_jo_post_sharing_buttons( '', true );

	$out = '<div class="share-buttons-container ' . trim( $container_class ) . '">';
	$out .= '<div class="text-inner">' . wp_kses_post( $text ) . '</div>';
	$out .= $buttons;
	$out .= '</div>';

	return $out;
}


/**
 * Add to composer
 */
function wph_jo_share_buttons_integrateVC() {
	vc_map( array(
		'name'     => esc_html__( 'Share buttons', 'jo-theme' ),
		'base'     => 'wph_jo_share_buttons',
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
wph_jo_register_sc('wph_jo_share_buttons', 'wph_jo_share_buttons', 'wph_jo_share_buttons_integrateVC');