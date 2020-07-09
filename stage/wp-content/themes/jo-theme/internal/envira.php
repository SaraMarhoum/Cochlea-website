<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */


add_filter( 'envira_gallery_gallery_themes', 'wph_jo_add_envira_theme' );
add_filter( 'envira_gallery_lightbox_themes', 'wph_jo_add_envira_theme' );
function wph_jo_add_envira_theme( $themes ) {

	if ( isset( $themes[0]['file'] ) ) {
		$def_file = $themes[0]['file'];
	} else {
		$def_file = '';
	}

	$themes[] = array(
		'value' => 'wphunters_jo',
		'name'  => esc_html__( 'WPHunters JO', 'jo-theme' ),
		'file'  => $def_file
	);

	return $themes;
}


add_filter( 'envira_gallery_pre_data', 'wph_jo_envira_gallery_customize', 10, 2 );
function wph_jo_envira_gallery_customize( $data, $gallery_id ) {
	$data['config']['classes'][] = 'col-gutter-' . $data['config']['gutter'];

	return $data;
}


add_filter('envira_pagination_css_classes', 'wph_jo_envira_pagination', 10, 3);
function wph_jo_envira_pagination($classes, $html, $data) {
	$classes[] = 'wph-pagination';
	return $classes;
}

add_action('envira_gallery_api_envirabox_config', 'wph_jo_envirabox_config');
function wph_jo_envirabox_config($data) {
	echo 'padding: 0,';
}