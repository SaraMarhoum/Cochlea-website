<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

/**
 * Load IE fallback scripts
 */
wp_enqueue_script( 'ie_fallback_js', get_template_directory_uri() . '/public/js/vendor/ie_fallback.js' );
wp_script_add_data( 'ie_fallback_js', 'conditional', 'lt IE 9' );






/**
 * Load WP internal scripts
 */
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}





/**
 * Find & load all JS assets under parent & child theme
 */
$scripts = glob( get_template_directory() . '/public/js/assets/*.js' );
if ( ! is_array( $scripts ) ) { $scripts = array(); }

if ( is_child_theme() ) {
	$child_scripts = glob( get_stylesheet_directory() . '/js_assets/*.js' );
	$child_scripts = (is_array($child_scripts)) ? $child_scripts : array();
	$scripts = array_merge( $scripts, $child_scripts );
}

$controllers  = glob( get_template_directory() . '/public/js/controllers/*.js' );
$main_scripts = glob( get_template_directory() . '/public/js/*.js' );
$scripts = array_merge( $scripts, ( is_array( $controllers ) ) ? $controllers : array() );
$scripts = array_merge( $scripts, ( is_array( $main_scripts ) ) ? $main_scripts : array() );

// walk through scripts & enqueue them
foreach ( $scripts as $script ) {

	if ( ! is_file( $script ) ) {
		continue;
	}

	// generate handle name
	$handle = basename( $script, '.js' );
	$handle = 'wph-' . strtolower( $handle ) . '-js';
	$script = str_replace( get_template_directory(), '', $script );

	// if that file also available in child theme - use it instead of parent
	if ( file_exists( get_stylesheet_directory() . $script ) ) {
		$js_path = get_stylesheet_directory_uri() . $script;
	} else {
		$js_path = get_template_directory_uri() . $script;
	}

	wp_enqueue_script( $handle, $js_path, array( 'jquery' ), '', true );
}





/**
 * Child scripts.js
 */
if ( file_exists( get_stylesheet_directory() . '/js/scripts.js' ) ) {
	wp_enqueue_script( 'wph-child-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(), '', true );
}





/**
 * Load modernizr
 */
if ( file_exists( get_template_directory() . '/public/js/vendor/modernizr.custom.js' ) ) {
	wp_enqueue_script( 'wph-modernizr', get_template_directory_uri() . '/public/js/vendor/modernizr.custom.js' );
}





/**
 * Localize scripts
 */
$translation_array = array(
	'map_overlay_title' => esc_html__( 'Click on map to enable interaction', 'jo-theme' ),
	'nav_title'         => esc_html__( 'Navigation', 'jo-theme' ),
	'WOWDisable'        => wph_jo_opt( 'disable_animations' ),
	'loading'           => esc_html__( 'Loading...', 'jo-theme' )
);
wp_localize_script( 'wph-wphjs.helpers-js', 'WPH_JS', $translation_array );





/**
 * Pass data to LESS engine
 */
add_filter( 'less_vars', '_set_less_vars', 10, 2 );
function _set_less_vars( $vars ) {

	if ( ! is_array( $vars ) ) {
		$vars = array();
	}

	$primary_font   = wph_jo_opt( 'primary_font', array('font' => 'Libre Baskerville') );
	$secondary_font = wph_jo_opt( 'secondary_font', array('font' => 'Roboto') );

	// general
	$vars['assetsdir'] = '~"' . get_template_directory_uri() . '/public"';

	// fonts
	$vars['primary-font']        = '"' . $primary_font['font'] . '"';
	$vars['secondary-font']    = '"' . $secondary_font['font'] . '"';

	// colors
	$vars['primary-color']   = wph_jo_opt( 'primary_color', '#67afd1' );
	$vars['secondary-color'] = wph_jo_opt( 'secondary_color', '#eeeeee' );
	$vars['site-background'] = wph_jo_opt( 'site_background', '#ffffff' );

	return $vars;
}





/**
 * Load required styles
 */

if ( ! in_array( 'acfgfs-enqueue-fonts', wp_styles()->queue ) ) {

	wp_enqueue_style(
		'acfgfs-enqueue-fonts',
		'https://fonts.googleapis.com/css?family=Libre+Baskerville:400,400i|Roboto:300,400'
	);

}

if ( ! in_array( 'acf-fonticonpicker-icons', wp_styles()->queue ) ) {

	wp_enqueue_style(
		'acf-fonticonpicker-icons',
		WPH_ASSETS_DIR . '/icons/css/wphunters-icons.css'
	);

}

// load static styles
wp_enqueue_style( 'wph-twbs', get_template_directory_uri() . '/public/less/bootstrap.less' );
wp_enqueue_style( 'wph-animate-module', get_template_directory_uri() . '/public/animate.css' );

wp_enqueue_style( 'wph-style-main', get_template_directory_uri() . '/public/less/style.less' );
wp_enqueue_style( 'wph-child-styles', get_stylesheet_directory_uri() . '/style.css' );





/**
 * Enqueue inline custom js and custom css
 */
if ( wph_jo_opt( 'custom_css', false ) ) {
	wp_add_inline_style( 'wph-style-main', wph_jo_opt( 'custom_css' ) );
}

if ( wph_jo_opt( 'custom_js', false ) ) {
	add_action( 'wp_footer', 'wph_jo_print_customjs', 20 );
}

function wph_jo_print_customjs() {
	global $wp_scripts;
	if ( ! wp_script_is( 'wph-custom-inline-js', 'done' ) ) :?>
		<script type="text/javascript"><?php echo wph_jo_opt( 'custom_js' ); ?></script>
		<?php $wp_scripts->done[] = 'wph-custom-inline-js'; endif;
}





/**
 * Header color modification
 * (ability to set custom color for header on a per-page basis)
 */
$header_color = wph_jo_get_rewritable_setting( 'header_color', '#fff' );
$header_bg    = wph_jo_get_rewritable_setting( 'header_background_color', 'rgba(0, 0, 0, 0.8)' );

if ( is_404() ) {
	$header_color = '#000';
	$header_bg    = 'rgba(0,0,0,0)';
}

if ( trim( $header_color ) ) {

	$header_custom_css = ".wph-site-header, .wph-page-hero { color: {$header_color}; }";
	$header_custom_css .= ".wph-header-container, .wph-page-hero { background: {$header_bg}; }";

	wp_add_inline_style( 'wph-style-main', $header_custom_css );

}