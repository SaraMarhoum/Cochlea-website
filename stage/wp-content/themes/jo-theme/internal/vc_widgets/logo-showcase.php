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
function wph_jo_logo_showcase( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'logos'    => '',
				'el_class' => '',
				'css'      => ''
			),
			$atts )
	);

	// generate inner markup
	$logos         = wph_jo_param_group_parse_atts( $logos );
	$logos_html    = '';
	$logo_defaults = array( 'logo' => '', 'url' => '', 'el_class' => '' );
	foreach ( $logos as $logo ) {
		$logo = array_merge( $logo_defaults, $logo );
		$logos_html .= wph_jo_single_logo( array(
			'logo'     => $logo['logo'],
			'url'      => $logo['url'],
			'el_class' => $logo['el_class']
		) );
	}

	// variables
	$main_tpl = wph_jo_load_sc_template( 'logo-showcase.tpl' );

	// render
	return wph_jo_render_sc_template(
		$main_tpl,
		array(
			'{classes}' => esc_attr( $el_class . wph_jo_custom_css_class( $css, ' ' ) ),
			'{content}' => $logos_html
		)
	);
}

function wph_jo_single_logo( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'logo'     => '',
				'url'      => '',
				'el_class' => '',
				'css'      => ''
			),
			$atts )
	);

	// variables
	$main_tpl = wph_jo_load_sc_template( 'logo-showcase.single.tpl' );

	// render
	return wph_jo_render_sc_template(
		$main_tpl,
		array(
			'{classes}' => esc_attr( $el_class . wph_jo_custom_css_class( $css, ' ' ) ),
			'{logo}'    => wph_jo_get_image_by_id( $logo, 'original' ),
			'{link}'    => ( trim( $url ) ) ? esc_attr( $url ) : 'javascript:return false;'
		)
	);
}


/**
 * Add to composer
 */
function wph_jo_logo_showcase_integrateVC() {
	vc_map( array(
		'name'     => esc_html__( 'Logo Showcase', 'jo-theme' ),
		'base'     => 'wph_jo_logo_showcase',
		'icon'     => WPH_ASSETS_DIR . '/images/wphunters_logo.png',
		'category' => esc_html__( 'JO Theme', 'jo-theme' ),
		'params'   => array(
			array(
				'heading'    => esc_html__( 'Logo items', 'jo-theme' ),
				'type'       => 'param_group',
				'value'      => '',
				'param_name' => 'logos',
				'params' => array(
					array(
						'type'        => 'attach_image',
						'heading'     => esc_html__( 'Logo image', 'jo-theme' ),
						'param_name'  => 'logo',
						'value'       => '',
						'description' => esc_html__( 'Upload image for this item.', 'jo-theme' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'URL', 'jo-theme' ),
						'param_name'  => 'url',
						'value'       => '',
						'admin_label' => true,
						'description' => esc_html__( 'Leave empty to remove link and just show logo.', 'jo-theme' )
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
 * Register Widgets
 */
wph_jo_register_sc('wph_jo_logo_showcase', 'wph_jo_logo_showcase', 'wph_jo_logo_showcase_integrateVC');