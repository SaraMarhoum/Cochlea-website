<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

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
function wph_jo_profile_container( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'inst_fill_method' => 'auto',
				'inst_images'      => '',
				'inst_badge_text'  => '',
				'inst_badge_link'  => '',
				'inst_username'    => 'wphunters',
				'photo'            => '',
				'el_class'         => '',
				'css'              => ''
			),
			$atts )
	);

	// render instagram block
	if ( $inst_fill_method === 'auto' ) {
		$inst_markup = wph_jo_instagram_widget( array(
			'badge_text'   => $inst_badge_text,
			'badge_link'   => $inst_badge_link,
			'username'     => $inst_username,
			'size'         => 'small',
			'photos_limit' => 6,
		) );
	} else {
		$inst_markup = wph_jo_manual_instagram_widget( array(
			'badge_text' => $inst_badge_text,
			'badge_link' => $inst_badge_link,
			'size'       => 'small',
			'images'     => $inst_images
		) );
	}

	// final render
	return wph_jo_render_sc_template(
		wph_jo_load_sc_template( 'profile-card.tpl' ),
		array(
			'{instagram}' => $inst_markup,
			'{classes}'   => esc_attr( $el_class . wph_jo_custom_css_class( $css, ' ' ) ),
			'{content}'   => do_shortcode( $content ),
			'{photo}'     => wph_jo_get_image_by_id( $photo, 'jo_square_thumb' )
		)
	);
}


/**
 * Add to composer
 */
function wph_jo_profile_container_integrateVC() {
	vc_map( array(
		'name'     => esc_html__( 'Profile card', 'jo-theme' ),
		'base'     => 'wph_jo_profile_container',
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
				'type'        => 'attach_image',
				'heading'     => esc_html__( 'Profile photo', 'jo-theme' ),
				'param_name'  => 'photo',
				'value'       => '',
				'description' => esc_html__( 'Upload image for this item.', 'jo-theme' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Fill method', 'jo-theme' ),
				'description' => esc_html__( 'We recommend using manual method since correct work of automatic is not guaranteed.', 'jo-theme' ),
				'param_name'  => 'inst_fill_method',
				'group'       => esc_html__( 'Instagram block', 'jo-theme' ),
				'value'       => array(
					esc_html__( 'Automatic', 'jo-theme' ) => 'auto',
					esc_html__( 'Manual', 'jo-theme' )    => 'manual'
				)
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Username', 'jo-theme' ),
				'param_name'  => 'inst_username',
				'value'       => 'wphunters',
				'description' => esc_html__( 'Profile should be public in order to proper widget work.', 'jo-theme' ),
				'group'       => esc_html__( 'Instagram block', 'jo-theme' ),
				'dependency'  => array(
					'element' => 'inst_fill_method',
					'value'   => 'auto'
				)
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Badge Text', 'jo-theme' ),
				'param_name'  => 'inst_badge_text',
				'value'       => '',
				'description' => esc_html__( 'Will be shown over photos.', 'jo-theme' ),
				'group'       => esc_html__( 'Instagram block', 'jo-theme' )
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Badge Link', 'jo-theme' ),
				'param_name' => 'inst_badge_link',
				'value'      => '',
				'group'      => esc_html__( 'Instagram block', 'jo-theme' )
			),
			array(
				'heading'    => esc_html__( 'Images', 'jo-theme' ),
				'type'       => 'param_group',
				'group'      => esc_html__( 'Instagram block', 'jo-theme' ),
				'value'      => '',
				'param_name' => 'inst_images',
				'dependency' => array(
					'element' => 'inst_fill_method',
					'value'   => 'manual'
				),
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
wph_jo_register_sc( 'wph_jo_profile_container', 'wph_jo_profile_container', 'wph_jo_profile_container_integrateVC' );
