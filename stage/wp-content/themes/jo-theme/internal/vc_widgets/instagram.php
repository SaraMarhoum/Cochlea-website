<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

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
function wph_jo_instagram_widget( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'badge_text'   => '',
				'badge_link'   => '',
				'username'     => 'wphunters',
				'size'         => 'thumbnail',
				'photos_limit' => 10,
				'el_class'     => ''
			),
			$atts )
	);


	// check for an errors
	if ( !class_exists('null_instagram_widget') )
	{
		return '<div class="nodata-error"><b>Error!</b> Plugin "WP Instagram Widget" is not installed!</div>';
	}

	ob_start();
	$el_class = esc_attr( $el_class );

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

	the_widget( 'null_instagram_widget',
		array(
			'username' => esc_attr( $username ),
			'number'   => esc_attr( $photos_limit ),
			'size'     => esc_attr( $size )
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
function wph_jo_instagram_widget_integrateVC() {
	vc_map( array(
		'name'     => esc_html__( 'Instagram widget', 'jo-theme' ),
		'base'     => 'wph_jo_instagram_widget',
		'icon'     => WPH_ASSETS_DIR . '/images/wphunters_logo.png',
		'category' => esc_html__( 'JO Theme', 'jo-theme' ),
		'params'   => array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Username', 'jo-theme' ),
				'param_name'  => 'username',
				'value'       => 'wphunters',
				'admin_label' => true,
				'description' => esc_html__( 'Profile should be public in order to proper widget work.', 'jo-theme' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Photos', 'jo-theme' ),
				'param_name'  => 'photos_limit',
				'value'       => 10,
				'admin_label' => true,
				'description' => esc_html__( 'Max number of photos to display', 'jo-theme' )
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Size', 'jo-theme' ),
				'param_name' => 'size',
				'value'      => array(
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
wph_jo_register_sc('wph_jo_instagram_widget', 'wph_jo_instagram_widget', 'wph_jo_instagram_widget_integrateVC');