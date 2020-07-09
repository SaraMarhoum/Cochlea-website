<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

add_filter( 'the_password_form', 'wph_jo_custom_password_form' );
function wph_jo_custom_password_form() {
	$o = '<form class="wph-form wph-narrow-form" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post" id="wph-password-form">
    ' . __( 'To view this protected post, enter the password below:', 'jo-theme' ) . '
    <input class="form-control" name="post_password" type="password" size="20" maxlength="20" />
    <button class="btn btn-primary">' . esc_attr__( 'Submit', 'jo-theme' ) . '</button>
    </form>';

	return $o;
}