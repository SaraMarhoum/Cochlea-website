<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */


require_once 'class-tgm-plugin-activation.php';

// helper function to ensure that valid JSON provided
function wph_jo_is_JSON() {
	call_user_func_array( 'json_decode', func_get_args() );
	return ( json_last_error() === JSON_ERROR_NONE );
}


// show error message when we can't access server
function wph_jo_show_tgm_notice() { ?>
	<div class="error notice">
		<p><?php esc_html_e( 'Distribution server for "JO" theme is not available. Plugin updates is temporarily disabled.',
				'jo-theme' ); ?></p>
	</div>
	<?php
}


// get online data & merge with offline if check passed
function wph_jo_get_online_tgmpa_data() {

	// get theme version
	$theme_version = wp_get_theme( get_template() )->get( 'Version' );
	if ( ! $theme_version ) { $theme_version = '1.0'; }

	// get online data
	$online_data = wp_remote_get( 'http://themeforest.nazarkin.su/jo/plugins.php?version=' . $theme_version );

	// perform checks for valid json response
	if ( is_wp_error( $online_data ) ) {
		return $online_data;
	}

	// check whether answer is valid JSON
	if ( ! wph_jo_is_JSON( $online_data['body'] ) ) {
		return new WP_Error(
			'',
			esc_html__( 'Plugin distribution server for "JO" theme has returned non-JSON response.', 'jo-theme' ),
			$online_data['body']
		);
	}

	return json_decode( $online_data['body'], true );
}


// since theme-check does not allow us to store plugin zip's inside theme
// we need to store it on our own server
add_action( 'tgmpa_register', 'wph_jo_register_required_plugins' );
function wph_jo_register_required_plugins() {

	// retrieve new data once a day
	if ( false == ( $plugins = get_transient( 'wph_jo_tgmpa_online_data' ) ) ) {
		$plugins = wph_jo_get_online_tgmpa_data();
		is_wp_error( $plugins ) || set_transient( 'wph_jo_tgmpa_online_data', $plugins, DAY_IN_SECONDS );
	}

	// show error when we have some difficulties
	if ( is_wp_error( $plugins ) || ! is_array( $plugins ) ) {
		add_action( 'admin_notices', 'wph_jo_show_tgm_notice' );
		return;
	}

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => false,                   // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
	);

	tgmpa( $plugins, $config );

}
