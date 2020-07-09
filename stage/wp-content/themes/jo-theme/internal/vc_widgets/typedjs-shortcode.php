<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

/**
 * Typed.js shortcode
 */
function wph_jo_typedjs( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'classes' => '',
				'str'     => '',
				'repeat'  => 'yes',
				'cursor'  => 'yes'
			),
			$atts )
	);

	$tpl  = wph_jo_load_sc_template( 'typedjs.tpl' );
	$vars = array(
		'{classes}' => $classes,
		'{str}'     => trim( $str, '"\'' ),
		'{repeat}'  => ( $repeat && ($repeat == 1 || $repeat == 'yes') ) ? 'yes' : 'no',
		'{cursor}'  => ( $cursor && ($cursor == 1 || $cursor == 'yes') ) ? 'yes' : 'no'
	);

	return wph_jo_render_sc_template($tpl, $vars);
}


/**
 * Register Widget
 */
wph_jo_register_sc('typed', 'wph_jo_typedjs');