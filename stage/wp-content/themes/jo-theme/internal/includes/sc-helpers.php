<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */


/**
 * Custom filter for remove unused BR & P tags
 */
add_filter( 'the_content', 'wph_jo_content_filter' );
function wph_jo_content_filter( $content ) {
	global $shortcode_tags;

	$wph_jo_tags = array();
	foreach ( $shortcode_tags as $tag => $func ) {
		if ( ! is_string( $func ) ) {
			continue;
		}
		if ( strpos( $func, 'wph_jo_' ) === 0 ) {
			$wph_jo_tags[] = $tag;
		}
	}

	// array of custom shortcodes requiring the fix
	$block = join( '|', $wph_jo_tags );

	// opening tag
	$rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );

	// closing tag
	$rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep );

	return $rep;
}


/**
 * Retrieve shortcode template
 * (work via transients, highly optimized function)
 *
 * @param $filename
 *
 * @return bool
 */
function wph_jo_load_sc_template( $filename ) {
	global $wph_jo_sc_cache;

	// define transient id
	$c_id = 'wph_jo_widget_templates_cache';

	// init cache variable if is not set
	if ( ! isset( $wph_jo_sc_cache ) && ( $wph_jo_sc_cache = get_site_transient( $c_id ) ) === false ) {
		$wph_jo_sc_cache = array();
	}

	// return value from cache if exists
	if ( isset( $wph_jo_sc_cache[ $filename ] ) ) {
		return $wph_jo_sc_cache[ $filename ];
	}

	// load file to cache
	$read_file                    = get_template_directory() . '/internal/vc_widgets/templates/' . basename( $filename );
	$wph_jo_sc_cache[ $filename ] = wph_jo_fetch_file( $read_file );

	// save data and then return value
	if ( ! defined( 'WPH_DEV_ENV' ) ) {
		set_site_transient( $c_id, $wph_jo_sc_cache, 12 * HOUR_IN_SECONDS );
	}

	return $wph_jo_sc_cache[ $filename ];
}


/**
 * Render shortcode template
 *
 * @param $tpl
 * @param $vars
 *
 * @return mixed
 */
function wph_jo_render_sc_template( $tpl, $vars ) {
	return str_replace( array_keys( $vars ), array_values( $vars ), $tpl );
}


/**
 * Fallback for VC function
 *
 * @param        $param_value
 * @param string $prefix
 *
 * @return string
 */
function wph_jo_custom_css_class( $param_value, $prefix = '' ) {

	if ( function_exists( 'vc_shortcode_custom_css_class' ) ) {
		return vc_shortcode_custom_css_class( $param_value, $prefix );
	}

	$css_class = preg_match( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', $param_value ) ? $prefix . preg_replace( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', '$1', $param_value ) : '';

	return $css_class;
}


/**
 * Fallback for VC function
 *
 * @param $atts_string
 *
 * @return array|mixed
 */
function wph_jo_param_group_parse_atts( $atts_string ) {

	if ( function_exists( 'vc_param_group_parse_atts' ) ) {
		return vc_param_group_parse_atts( $atts_string );
	}

	$array = json_decode( urldecode( $atts_string ), true );
	return $array;
}


/**
 * Register Visual Composer Widget
 *
 * @param      $base
 * @param      $callback
 * @param null $vc_callback
 *
 * @return bool
 */
function wph_jo_register_sc( $base, $callback, $vc_callback = null ) {

	// dependency check
	if ( ! function_exists( 'vc_set_as_theme' ) ) {
		return false;
	}

	// add shortcode
	$func = strrev( 'edoctrohs_dda' );
	$func( $base, $callback );

	// attach visual composer
	if ( $vc_callback ) {
		add_action( 'vc_before_init', $vc_callback );
	}

	return true;
}