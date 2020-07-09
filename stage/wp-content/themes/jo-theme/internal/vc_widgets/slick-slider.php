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
function wph_jo_slick_slider( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'photo_ids' => '',
				'options'   => 'autoplay: true' . "\n" . 'autoplaySpeed: 3500',
				'el_class'  => '',
				'css'       => ''
			),
			$atts )
	);

	/**
	 * @var $photo_ids string
	 * @var $options   string
	 * @var $css       string
	 * @var $el_class  string
	 */

	// generate CSS class for container
	$container_class = esc_attr( $el_class . wph_jo_custom_css_class( $css, ' ' ) );

	// parse options
	$options_out = array();
	foreach ( explode( PHP_EOL, strip_tags( $options ) ) as $line ) {
		list( $property, $value ) = array_map('trim', explode( ':', $line, 2 ));

		if ( strtolower( $value ) == 'true' || strtolower( $value ) == 'false' ) {
			$value = (bool) strtolower( $value );

		} else if ( preg_match( '/^[0-9]+$/', $value ) ) {
			$value = (int) $value;

		} else {
			$value = '"' . esc_attr( $value ) . '"';
		}

		$options_out[$property] = $value;
	}

	// make output
	$main_tpl      = wph_jo_load_sc_template( 'slick-slider.tpl' );
	$single_tpl    = wph_jo_load_sc_template( 'slick-slider.single.tpl' );
	$images_markup = '';

	foreach ( explode( ',', $photo_ids ) as $image_id ) {
		$image_id   = trim( $image_id );
		$image_url  = wph_jo_get_image_by_id( $image_id, 'br_square_thumb' );
		$image_href = wph_jo_get_image_by_id( $image_id, 'large' );
		$meta       = wph_jo_get_attachment( $image_id );

		$vars = array(
			'{caption}' => ( $meta['caption'] ) ? esc_attr( $meta['caption'] ) : esc_attr( $meta['title'] ),
			'{img_url}' => esc_url( $image_url ),
			'{href}'    => esc_url( $image_href ),
			'{alt}'     => esc_attr( $meta['alt'] )
		);

		$images_markup .= wph_jo_render_sc_template( $single_tpl, $vars );
	}

	// final render
	return wph_jo_render_sc_template(
		$main_tpl,
		array(
			'{options}' => json_encode($options_out),
			'{classes}' => $container_class,
			'{images}'  => $images_markup
		)
	);
}


/**
 * Add to composer
 */
function wph_jo_slick_slider_integrateVC() {
	vc_map( array(
		'name'     => esc_html__( 'Custom slider', 'jo-theme' ),
		'base'     => 'wph_jo_slick_slider',
		'icon'     => WPH_ASSETS_DIR . '/images/wphunters_logo.png',
		'category' => esc_html__( 'JO Theme', 'jo-theme' ),
		'params'   => array(
			array(
				'type'        => 'attach_images',
				'heading'     => esc_html__( 'Images', 'jo-theme' ),
				'param_name'  => 'photo_ids',
				'value'       => '',
				'description' => esc_html__( 'Upload images for this slider. Recommended amount - at least 6 images.', 'jo-theme' ),
				'admin_label' => true
			),
			array(
				'type'        => 'textarea',
				'heading'     => esc_html__( 'Custom options', 'jo-theme' ),
				'param_name'  => 'options',
				'value'       => 'autoplay: true' . "\n" . 'autoplaySpeed: 3500',
				'description' => wp_kses_post(__( '<b>Format:</b> option: value (one per line). <a href="http://kenwheeler.github.io/slick/#settings" target="_blank">Complete list of available options.</a>', 'jo-theme' )),
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
wph_jo_register_sc('wph_jo_slick_slider', 'wph_jo_slick_slider', 'wph_jo_slick_slider_integrateVC');