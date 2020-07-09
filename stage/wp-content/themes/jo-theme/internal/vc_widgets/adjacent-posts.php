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
function wph_jo_adjacent_posts( $atts = array(), $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'singular' => 'post',
				'el_class' => '',
				'css'      => ''
			),
			$atts )
	);

	// get adjacent posts
	$prevPost = get_adjacent_post( false, '', true, 'category' );
	$nextPost = get_adjacent_post( false, '', false, 'category' );

	// get links to posts
	$prevPostLink = ( $prevPost instanceof WP_Post ) ? get_permalink( $prevPost ) : '#';
	$nextPostLink = ( $nextPost instanceof WP_Post ) ? get_permalink( $nextPost ) : '#';

	// define variables
	$tpl  = wph_jo_load_sc_template( 'adjacent-posts.tpl' );
	$vars = array(
		'{classes}'    => esc_attr( $el_class . wph_jo_custom_css_class( $css, ' ' ) ),
		'{cpt_name}'   => esc_html($singular),
		'{next}'       => $nextPostLink,
		'{next_label}' => esc_html__( 'Next', 'jo-theme' ),
		'{prev}'       => $prevPostLink,
		'{prev_label}' => esc_html__( 'Previous', 'jo-theme' )
	);

	return wph_jo_render_sc_template( $tpl, $vars );
}


/**
 * Add to composer
 */
function wph_jo_adjacent_posts_integrateVC() {
	vc_map( array(
		'name'     => esc_html__( 'Adjacent posts navigation', 'jo-theme' ),
		'base'     => 'wph_jo_adjacent_posts',
		'icon'     => WPH_ASSETS_DIR . '/images/wphunters_logo.png',
		'category' => esc_html__( 'JO Theme', 'jo-theme' ),
		'show_settings_on_create' => false,
		'params'   => array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Singular name', 'jo-theme' ),
				'param_name'  => 'singular',
				'value'       => 'post',
				'description' => esc_html__( 'Previous {singular}, Next {singular}', 'jo-theme' )
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
wph_jo_register_sc('wph_jo_adjacent_posts', 'wph_jo_adjacent_posts', 'wph_jo_adjacent_posts_integrateVC');