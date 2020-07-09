<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */


/**
 * Theme defaults
 */
define( 'ACF_LITE', ! defined( 'WPH_DEV_ENV' ) );
define( 'WPH_THEMEDIR', get_template_directory() );
define( 'WPH_ASSETS_DIR', get_template_directory_uri() . '/public' );
define( 'WPH_IGNORE_HEALTH_CHECKER', false );


/**
 * Run theme health checker
 */
require_once WPH_THEMEDIR . '/internal/health_check.php';
if ( defined( 'WPH_STOP_LOADING' ) && WPH_STOP_LOADING ) { return; }


/**
 * Load other required files if checks passed
 */
require_once WPH_THEMEDIR . '/internal/fallbacks.php';
require_once WPH_THEMEDIR . '/internal/includes.php';
require_once WPH_THEMEDIR . '/WP-Less-Compilator/wp-less.php';
require_once WPH_THEMEDIR . '/TGM-Plugin-Activation/init.php';
require_once WPH_THEMEDIR . '/demo-installer/oneclick_install.php';


/**
 * Define options pages
 */
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_sub_page( array(
		'page_title' => __( 'Theme Options', 'jo-theme' ),
		'menu_slug'  => 'wph-theme-settings',
		'capability' => 'manage_options',
		'parent'     => 'themes.php',
	) );

}