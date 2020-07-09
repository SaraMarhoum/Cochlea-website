<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


/**
 * Register menus
 */
register_nav_menus( array(
	'primary' => esc_html__( 'Primary menu', 'jo-theme' )
) );