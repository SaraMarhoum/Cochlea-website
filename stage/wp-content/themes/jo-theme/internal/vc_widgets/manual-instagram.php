<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */


/**
 * Single button
 */
function wph_jo_manual_instagram_widget( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'badge_text'   => '',
				'badge_link'   => '',
				'size'     => 'thumbnail',
				'images'   => '',
				'el_class' => ''
			),
			$atts )
	);


	// check for an errors
	if ( ! function_exists( 'nazarkinre_wpiw_render' ) ) {
		return '<div class="nodata-error"><b>Error!</b> Plugin "WP Manual Instagram Widget" is not installed!</div>';
	}

	// prepare input
	$images = wph_jo_param_group_parse_atts( $images );
	foreach ( $images as $k => $image ) {
		$images[ $k ] = wp_parse_args( $image, array( 'id' => '', 'description' => '', 'link' => '' ) );
	}

	// badge
	if ( trim( $badge_text ) ) {
		$badge_link = ( trim( $badge_link ) ) ? $badge_link : 'javascript:return false;';

		$badge  = '<div class="text-badge vh-center-js">';
		$badge .= '<a href="' . esc_attr( $badge_link ) . '">';
		$badge .= esc_html( $badge_text );
		$badge .= '</a>';
		$badge .= '</div>';
	} else {
		$badge = '';
	}

	$el_class = esc_attr( $el_class );

	ob_start();
	nazarkinre_wpiw_render(
		array(
			'images'     => $images,
			'image_size' => $size
		),
		array(
			'before_widget' => "<div class=\"wph-instagram-pics-wrapper {$el_class}\">",
			'after_widget'  => "{$badge}</div>"
		)
	);

	return ob_get_clean();
}


/**
 * Add to composer
 */
function wph_jo_manual_instagram_widget_integrateVC() {
	vc_map( array(
		'name'     => esc_html__( 'Manual Instagram widget', 'jo-theme' ),
		'base'     => 'wph_jo_manual_instagram_widget',
		'icon'     => WPH_ASSETS_DIR . '/images/wphunters_logo.png',
		'category' => esc_html__( 'JO Theme', 'jo-theme' ),
		'params'   => array(
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Size', 'jo-theme' ),
				'param_name'  => 'size',
				'value'       => array(
					esc_html__( 'Thumbnail', 'jo-theme' ) => 'thumbnail',
					esc_html__( 'Small', 'jo-theme' )     => 'small',
					esc_html__( 'Large', 'jo-theme' )     => 'large',
					esc_html__( 'Original', 'jo-theme' )  => 'original',
				),
				'description' => esc_html__( 'Choose which size of image will be shown in this widget.', 'jo-theme' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Badge Text', 'jo-theme' ),
				'param_name'  => 'badge_text',
				'value'       => '',
				'admin_label' => true,
				'description' => esc_html__( 'Will be shown over photos.', 'jo-theme' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Badge Link', 'jo-theme' ),
				'param_name'  => 'badge_link',
				'value'       => '',
			),
			array(
				'heading'    => esc_html__( 'Images', 'jo-theme' ),
				'type'       => 'param_group',
				'value'      => '',
				'param_name' => 'images',
				'params'     => array(
					array(
						'type'        => 'attach_image',
						'heading'     => esc_html__( 'Image', 'jo-theme' ),
						'param_name'  => 'id',
						'value'       => '',
						'description' => esc_html__( 'Upload image. Recommended size is at least 1280x800px', 'jo-theme' )
					),
					array(
						'type'        => 'textarea',
						'heading'     => esc_html__( 'Caption', 'jo-theme' ),
						'param_name'  => 'description',
						'value'       => '',
						'description' => esc_html__( 'Can be empty.', 'jo-theme' ),
						'admin_label' => true
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Caption link', 'jo-theme' ),
						'param_name'  => 'link',
						'value'       => '',
						'description' => esc_html__( 'Leave empty to remove link.', 'jo-theme' )
					),
				)
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'jo-theme' ),
				'param_name'  => 'el_class',
				'value'       => '',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'jo-theme' )
			),
		)
	) );
}


/**
 * Register widget
 */
wph_jo_register_sc( 'wph_jo_manual_instagram_widget', 'wph_jo_manual_instagram_widget', 'wph_jo_manual_instagram_widget_integrateVC' );
