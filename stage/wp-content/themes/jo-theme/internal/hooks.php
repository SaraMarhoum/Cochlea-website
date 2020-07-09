<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */


/**
 * Theme setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @internal
 */
add_action( 'init', 'wph_jo_action_theme_setup' );
function wph_jo_action_theme_setup() {

	// Make Theme available for translation.
	load_theme_textdomain( 'jo-theme', get_template_directory() . '/languages' );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare custom sizes.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'jo_slider_preview', 1280, 0 );
	add_image_size( 'jo_square_thumb', 650, 650 );
	add_image_size( 'jo_wide_thumb', 1280, 650 );

	// Enable title-tag functionality
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Load ACF fields
	if ( ! defined( 'WPH_DEV_ENV' ) ) {
		require_once WPH_THEMEDIR . '/internal/acf_fields.php';
	}

}





/**
 * Dashboard styles & scripts
 */
add_action( 'admin_enqueue_scripts', 'wph_jo_admin_enqueue_scripts' );
function wph_jo_admin_enqueue_scripts() {

	wp_enqueue_style( 'wph-admin-styles', get_template_directory_uri() . '/public/admin.css' );
	wp_enqueue_script( 'wph-admin-scripts', get_template_directory_uri() . '/public/admin.js', array( 'jquery' ) );

	$translation_array = array(
		'preview'            => esc_html__( 'Preview', 'jo-theme' ),
		'reset_button_text'  => esc_html__( 'Reset', 'jo-theme' ),
		'reset_confirm_text' => esc_html__( 'This action will reset all your settings to defaults. If you sure, please type "reset" into a field below.', 'jo-theme' ),
		'theme_version'      => wp_get_theme( get_template() )->get( 'Version' ),
		'theme_name'         => basename( get_template_directory() ),
		'site_url'           => site_url()
	);
	wp_localize_script( 'wph-admin-scripts', 'JO_DATA', $translation_array );
}





/**
 * Deal with paid plugins
 * (updates are enabled in dev mode)
 */
if ( ! defined( 'WPH_DEV_ENV' ) ) {

	add_action( 'acf/init', 'wph_jo_setup_acf_updates' );
	function wph_jo_setup_acf_updates() {
		acf_update_setting( 'show_updates', false );
	}

	add_action( 'vc_before_init', 'wph_jo_set_as_theme' );
	function wph_jo_set_as_theme() {

		if ( function_exists( 'vc_manager' ) ) {
			vc_manager()->disableUpdater( true );
		}

		vc_set_as_theme();
	}

	add_action( 'init', 'wph_jo_setup_revslider_as_theme' );
	function wph_jo_setup_revslider_as_theme() {
		if ( ! function_exists( 'set_revslider_as_theme' ) ) {
			return;
		}
		set_revslider_as_theme();
	}

	add_action( 'init', 'wph_jo_setup_ss3_updates' );
	function wph_jo_setup_ss3_updates() {
		if ( ! class_exists( 'N2Base' ) ) {
			return;
		}

		if ( get_transient( 'wph_jo_ss3_setlicense' ) === false ) {
			N2Base::getApplication( 'smartslider' )->storage->set( 'license', 'isActive', time() );
			set_transient( 'wph_jo_ss3_setlicense', 'true', 3 * HOUR_IN_SECONDS );
		}
	}

}





/**
 * Register widget areas
 *
 * @internal
 */
add_action( 'widgets_init', 'wph_jo_action_theme_widgets_init' );
function wph_jo_action_theme_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'jo-theme' ),
		'id'            => 'jo-blog-sidebar',
		'description'   => esc_html__( 'Appears in the blog section on the right side.', 'jo-theme' ),
		'before_widget' => '<div id="%1$s" class="item site-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="widget-title"><span>',
		'after_title'   => '</span></h1>',
	) );

}





/**
 * Register theme's own icon font for icon pickers
 *
 * @internal
 */
add_filter( 'acf/acf_field_fonticonpicker/settings', 'wph_jo_register_iconfont' );
function wph_jo_register_iconfont( $settings ) {

	$settings['config'] = WPH_ASSETS_DIR . '/icons/config.json';
	$settings['icons']  = WPH_ASSETS_DIR . '/icons/css/wphunters-icons.css';

	return $settings;
}





/**
 * Custom settings for tags cloud
 *
 * @internal
 */
add_filter( 'widget_tag_cloud_args', 'wph_jo_filter_tag_cloud' );
function wph_jo_filter_tag_cloud( $args ) {

	$args['smallest']  = 18;
	$args['largest']   = 32;
	$args['unit']      = 'px';
	$args['separator'] = ' ';

	return $args;
}





/**
 * Module to load template blocks via get_template_part
 *
 * @internal
 */
add_action('get_template_part_tpl-blocks', 'wph_jo_load_tpl_block', 10, 2);
function wph_jo_load_tpl_block( $slug, $name ) {

	$file      = '/tpl-blocks/' . basename( $name ) . '.php';
	$main_dir  = get_template_directory();
	$child_dir = get_stylesheet_directory();

	// firstly, check child theme
	if ( is_readable( $child_dir . $file ) ) {
		require $child_dir . $file;

		return;
	}

	// and secondly, check main theme folder
	if ( is_readable( $main_dir . $file ) ) {
		require $main_dir . $file;

		return;
	}
}




/**
 * Contact From 7 shortcodes
 *
 * @internal
 */
add_filter( 'wpcf7_form_elements', 'wph_jo_wpcf7_form_elements' );
function wph_jo_wpcf7_form_elements( $form ) {

	$form = do_shortcode( $form );
	return $form;
}



/**
 * Excerpt control
 *
 * @internal
 */
function wph_jo_custom_excerpt_more( $more ) { return '..'; }
function wph_jo_custom_excerpt_length( $length ) { return 30; }

add_filter( 'excerpt_length', 'wph_jo_custom_excerpt_length' );
add_filter( 'excerpt_more', 'wph_jo_custom_excerpt_more' );



/**
 * Proper classnames for instagram widget
 */
add_filter( 'wpiw_list_class', 'wph_jo_wpiw_lclass' );
function wph_jo_wpiw_lclass( $current_class ) {
	return 'wph-' . trim( $current_class ) . ' wow sequenced fx-fadeIn';
}



/**
 * Control body class
 *
 * @internal
 */
add_filter( 'body_class', 'wph_jo_body_class' );
function wph_jo_body_class( $classes = '' ) {

	if ( get_page_template_slug() == 'template-blog.php' ) {
		$classes[] = 'blog';
	}

	if ( ! have_posts() || wph_jo_is_empty_search() ) {
		$classes[] = 'search-no-results';
	}

	return $classes;
}



/**
 * Move comment field to bottom (for WP 4.4)
 */
add_filter( 'comment_form_fields', 'wph_jo_move_comment_field_to_bottom' );
function wph_jo_move_comment_field_to_bottom( $fields ) {

	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}



/**
 * A hook to reset ACF form settings to defaults
 */
add_filter('acf/update_value', 'my_acf_update_value', 10, 3);
function my_acf_update_value( $value, $post_id, $field ) {

	// skip select fields due to bug in ACF's default value for them
	if ( $field['type'] == 'select' ) {
		return $value;
	}

	// generate default value
	if ( isset( $field['default_font'] ) ) {
		$new_value = $field['default_font'];
	} elseif ( isset( $field['default_value'] ) ) {
		$new_value = $field['default_value'];
	} else {
		$new_value = null;
	}

	// assign new value only when reset flag is accepted
	if ( $post_id == 'options' && isset( $_POST['wph-reset-button'] ) ) {
		$value = $new_value;
	}

	return $value;
}
