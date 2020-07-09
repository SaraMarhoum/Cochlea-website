<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */


/**
 * Load Visual Composer templates from folder
 * and then add them to pre-defined templates
 */

add_filter( 'vc_load_default_templates', 'wph_jo_load_custom_vc_templates' );
function wph_jo_load_custom_vc_templates( $vc_data ) {

	$vc_data           = array(); // remove composer's default templates
	$tpl_files_pattern = get_template_directory() . '/internal/vc_templates/*.tpl';
	$tpl_files         = glob( $tpl_files_pattern );
	$delimiter         = '.';
	array_multisort( array_map( 'filemtime', $tpl_files ), SORT_NUMERIC, SORT_DESC, $tpl_files );

	foreach ( $tpl_files as $file ) {

		// extract filename
		$filename_parts = explode( $delimiter, basename( $file ) );
		$filename       = reset( $filename_parts );

		// create array
		$data                 = array();
		$data['category']     = esc_html__( 'JO Theme', 'jo-theme' );
		$data['name']         = '[JO] ' . ucfirst( str_replace( array( '-', '_' ), ' ', $filename ) );
		$data['custom_class'] = 'wph_jo_tpl_' . str_replace( array( '-', '_' ), '_', $filename );
		$data['content']      = wph_jo_fetch_file( $file );

		// send to visual composer
		array_unshift( $vc_data, $data );
	}

	return $vc_data;
}
