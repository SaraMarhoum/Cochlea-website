<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: BBDesign & WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */


/**
 * Import demo data
 */
add_action( 'wp_ajax_import_demo_action', 'wph_jo_oneclick_demoajax' );
function wph_jo_oneclick_demoajax() {
	global $wpdb;

	$installer_dir = get_template_directory() . '/demo-installer';

	// plugin check
	if ( ! function_exists( 'wph_init_cpts' ) ) {
		echo '<p><b>' . esc_html__( 'Error!', 'jo-theme' ) . '</b><br/>';
		echo wp_kses_post( __( 'You need to install <b>CPTs plugin</b> to continue.', 'jo-theme' ) ) . '</p>';
		die();
	}


	if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
		define( 'WP_LOAD_IMPORTERS', true );
	}


	if ( ! class_exists( 'WP_Import' ) ) {
		$class_wp_importer = $installer_dir . '/inc/wordpress-importer.php';
		if ( file_exists( $class_wp_importer ) ) {
			require $class_wp_importer;
		}
	}


	// import items
	if ( class_exists( 'WP_Import' ) ) {
		// get the xml file from directory
		$import_filepath = get_template_directory() . '/demo-installer/data/import.xml';

		// import data
		$wp_import                    = new WP_Import();
		$wp_import->fetch_attachments = true;
		$wp_import->import( $import_filepath );
	}


	// setup menus
	$locations = get_registered_nav_menus();
	foreach ( $locations as $locationId => $menuValue ) {
		$menu = get_term_by( 'name', 'Main menu', 'nav_menu' );

		if ( isset( $menu ) ) {
			$locations[ $locationId ] = $menu->term_id;
		}
	}
	set_theme_mod( 'nav_menu_locations', $locations );


	// setup sidebars
	$wie_file = $installer_dir . '/inc/widgets_import.php';
	if ( file_exists( $wie_file ) ) {
		require $wie_file;

		$temp_dir = wp_upload_dir();
		$newname  = $temp_dir['path'] . '/widgets_import.wie';

		copy( get_template_directory() . '/demo-installer/data/widgets.wie', $newname );
		$result = wie_process_import_file( $newname );

		if ( is_wp_error( $result ) ) {
			echo '<p><b>Error!</b><br/>' . $result->get_error_message() . '</p>';
		} else {
			echo '<p>Widgets imported successfully.</p>';
		}
	}

	die(); // this is required to return a proper result
}


/**
 * Tune WP
 */
add_action( 'wp_ajax_tunewp_action', 'wph_jo_oneclick_tune' );
function wph_jo_oneclick_tune() {
	global $wpdb, $wp_rewrite;

	// set permalink structure
	$wp_rewrite->set_permalink_structure( '/%postname%/' );

	// set homepage
	$homepage = get_page_by_title( 'Index 2' );
	if ( $homepage !== null ) {
		update_option( 'page_on_front', $homepage->ID );
		update_option( 'show_on_front', 'page' );
	}

	// Set the blog page
	$blog   = get_page_by_title( 'Blogroll regular' );
	update_option( 'page_for_posts', $blog->ID );

	// update Visual Composer post types
	$role = get_role('administrator');
	if($role instanceof WP_Role) {
		$role->add_cap( 'vc_access_rules_post_types/page', true );
		$role->add_cap( 'vc_access_rules_post_types/jo-portfolio', true );
		$role->add_cap( 'vc_access_rules_post_types', 'custom' );
	}

	// echo final result
	$message = wp_kses_post(
		__( '<b>Done!</b> Your WordPress installation successfully tuned to use "JO" theme.', 'jo-theme' )
	);
	die( $message );
}


/**
 * Register custom admin page
 */
add_action( 'admin_menu', 'wph_jo_oneclick_menu', 11 );
function wph_jo_oneclick_menu() {
	add_theme_page(
		esc_html__( 'Theme Installation Wizard', 'jo-theme' ),    // page title
		esc_html__( 'Installation Wizard', 'jo-theme' ),          // menu title
		'import',                                                 // capability
		'wph_jo_oneclick',                                        // menu slug
		'wph_jo_oneclick_page'                                    // callback function
	);
}

function wph_jo_oneclick_page() {
	global $title;
	$this_dir = get_template_directory_uri() . '/demo-installer';
	$file     = get_template_directory() . '/demo-installer/view.php';
	if ( file_exists( $file ) ) {
		require $file;
	}
}
