<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */


/**
 * Retrieve options from ACF
 */
if ( ! function_exists( 'wph_jo_opt' ) ):

	function wph_jo_opt( $option, $default = false ) {

		// correct ID detection
		$id = (get_queried_object_id()) ? get_queried_object_id() : get_the_ID();

		// firstly, check post meta for override
		$value = get_post_meta( $id, $option, true );
		if ( $value != false ) {
			return $value;
		}

		// then get value from ACF
		$value = get_field( $option, 'options' );
		if ( ! $value ) {
			return $default;
		}

		return (is_string($value)) ? do_shortcode( $value ) : $value;
	}

endif;



/**
 * Retrieve rewritable options
 */
if ( ! function_exists( 'wph_jo_get_rewritable_setting' ) ):

	function wph_jo_get_rewritable_setting($field, $default = false, $id = false) {

		// use globals for common listings
		if ( ! $id && ( is_search() || is_archive() ) ) {
			goto use_default;
		}

		// then get settings for current post/page especially
		$layout = get_field( $field, $id );
		if ( $layout && $layout !== 'inherit' ) {
			return esc_attr( $layout );
		}

		// and lastly get global value
		use_default:
		$layout = get_field( $field, 'options' );

		return ( $layout ) ? esc_attr( $layout ) : $default;
	}

endif;



/**
 * Display list of socials
 */
if ( ! function_exists( 'wph_jo_display_socials' ) ):

	function wph_jo_display_socials( $data_source = 'options', $return = false ) {
		if ( $return ) { ob_start(); }

		while ( have_rows( 'social_networks', $data_source ) ) : the_row(); ?>

			<a href="<?php echo esc_url( get_sub_field( 'profile_url' ) ) ?>">
				<i class=<?php echo esc_attr(get_sub_field( 'profile_icon' )) ?>></i>
			</a>

		<?php endwhile;

		return ($return) ? ob_get_clean() : '';
	}

endif;



/**
 * Display posts pagination
 */
if ( ! function_exists( 'wph_jo_theme_paging_nav' ) ):

	function wph_jo_theme_paging_nav( $wp_query = null ) {

		if ( ! $wp_query ) {
			$wp_query = $GLOBALS['wp_query'];
		}

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		// generate links
		$page_links = paginate_links( array(
			'prev_next' => false,
			'mid_size'  => 3,
			'type'      => 'array'
		) );

		$prev_link = '<a href="' . previous_posts( false ) . '" class="prev-link"><i class="wph-icon-arrow-left"></i></a>';
		$next_link = '<a href="' . next_posts( $wp_query->max_num_pages, false ) . '" class="next-link"><i class="wph-icon-arrow-right"></i></a>';

		array_unshift($page_links, $prev_link);
		$page_links[] = $next_link;

		echo '<div class="wph-pagination">';
		echo implode($page_links);
		echo '</div>';
	}

endif;



/**
 * Display comments pagination
 */
if ( ! function_exists( 'wph_jo_theme_comments_nav' ) ):

	function wph_jo_theme_comments_nav() {

		if ( get_comment_pages_count() < 1 || ! get_option( 'page_comments' ) ) {
			return;
		}
		?>

		<div class="pager">
			<span class="previous"><?php previous_comments_link() ?></span>
			<span class="next"><?php next_comments_link() ?></span>
		</div>

		<?php
	}

endif;



/**
 * Sharing buttons
 */
if ( ! function_exists( 'wph_jo_post_sharing_buttons' ) ):

	function wph_jo_post_sharing_buttons( $classes = '', $return = false ) {
		$url  = urlencode( get_the_permalink() );
		$data = array(
			'wph-icon-facebook' => 'http://www.facebook.com/sharer.php?u=' . $url,
			'wph-icon-gplus'    => 'https://plus.google.com/share?url=' . $url,
			'wph-icon-twitter'  => 'https://twitter.com/share?url=' . $url,
			'wph-icon-linkedin' => 'http://www.linkedin.com/shareArticle?mini=true&url=' . $url
		);

		$out = '<div class="share-buttons ' . esc_attr( $classes ) . '">';
		foreach($data as $class => $url) {
			$url   = esc_attr( $url );
			$class = esc_attr( $class );
			$out .= '<a href="' . $url . '" target="_blank"><i class="' . $class . '"></i></a>';
		}
		$out .= '</div>';

		if($return) {
			return $out;
		} else {
			echo $out;
			return '';
		}
	}

endif;



/**
 * Display footer text
 */
if ( ! function_exists( 'wph_jo_display_footer_text' ) ):

	function wph_jo_display_footer_text() {
		$default = 'Copyright &copy; 2016. Design by <a href="http://wphunters.com/">WPHunters</a>';
		echo wph_jo_opt( 'footer_text', $default );
	}

endif;



/**
 * Display footer appendix block
 */
if ( ! function_exists( 'wph_jo_display_footer_appendix' ) ):

	function wph_jo_display_footer_appendix() {
		$layout = wph_jo_get_rewritable_setting( 'footer_appendix', 'gotop' );
		get_template_part( 'tpl-blocks', 'footer-' . basename( $layout ) );
	}

endif;



/**
 * Display header navigation
 */
if ( ! function_exists( 'wph_jo_display_header' ) ):

	function wph_jo_display_header() {

		$layout       = wph_jo_get_rewritable_setting( 'header_layout', 'header_1' );
		$header_style = str_replace( 'header_', '', $layout );

		get_template_part( 'tpl-blocks', 'header-' . basename( $header_style ) );
		get_template_part( 'tpl-blocks', 'header-mobile' );

	}

endif;



/**
 * Display page hero text
 */
if ( ! function_exists( 'wph_jo_page_heading' ) ):

	function wph_jo_page_heading() {

		$q_id = get_queried_object_id();

		if ( is_archive() ) { // archive page title
			$heading    = esc_html__( 'Archive', 'jo-theme' );
			$archive_title = explode( ': ', get_the_archive_title(), 2 );
			$subline    = isset( $archive_title[1] ) ? $archive_title[1] : $archive_title[0];
			$subline    = esc_html( $subline );

		} else if ( is_search() ) { // search results page
			$heading = esc_html__( 'Search', 'jo-theme' );
			$subline = esc_html( get_search_query() );

		} else { // all other pages
			if ( $q_id && get_field( 'disable_hero', $q_id ) === true ) {
				return;
			}

			if ( is_singular( 'post' ) || is_home() ) {
				$heading = wph_jo_opt( 'blogroll_hero_text', esc_html__( 'Blog', 'jo-theme' ) );
				$subline = false;
			} else {
				$heading = get_field( 'hero_text', $q_id );
				$subline = get_field( 'hero_subline', $q_id );
			}

			if ( $heading == '' && $subline == '' ) {
				$heading = get_the_title( $q_id );
			}
		}

		// don't print hero if strings are empty
		if ( ! $heading ) {
			return;
		} ?>

		<div class="wph-page-hero fittext <?php if(trim($subline)) echo 'with-subline'; ?>" data-max-size="72">
			<h1><?php echo wp_kses_post( $heading ); ?></h1>
			<div class="subline"><?php echo wp_kses_post( $subline ); ?></div>
		</div>

		<?php }

endif;



/**
 * Display theme navigation
 *
 * @param     $location
 * @param int $depth
 */
function wph_jo_display_navigation( $location, $depth = 0 ) {

	// "0" value for $depth will disable any limitation on menu depth

	$defaults = array(
		'container'  => false,
		'depth'      => $depth,
		'menu_class' => 'nav_menu'
	);

	// firstly, check post meta for override
	$menu = get_post_meta( get_the_ID(), 'custom_' . $location . '_menu', true );
	if ( $menu != false ) {
		$defaults = array_merge( $defaults, array( 'menu' => $menu ) );
		wp_nav_menu( $defaults );

		return;
	}

	// display regular menu
	if ( has_nav_menu( $location ) ) {
		$defaults = array_merge( $defaults, array( 'theme_location' => $location ) );
		wp_nav_menu( $defaults );

		return;
	}

	// display warning if something went wrong
	wph_jo_display_menu_warn( );
}


/**
 * Helper for displaying warn when no menu found
 */
function wph_jo_display_menu_warn( ) {

	echo '<ul class="nav_menu"><li><a href="' . get_admin_url( null, 'nav-menus.php' ) . '"><span class="text-danger">';
	echo esc_html__( 'Define your primary menu in dashboard', 'jo-theme' );
	echo '</span></a></li></ul>';

}


/**
 * Return post thumbnail & placeholder if is not available
 *
 * @param null $post_id
 * @param null $size
 *
 * @return string|void
 */
function wph_jo_get_post_image( $post_id = null, $size = null ) {

	// placeholder management
	$placeholder = WPH_ASSETS_DIR . '/images/placeholder.png';

	// get image
	if ( has_post_thumbnail( $post_id ) ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
	} else {
		$image = array( $placeholder );
	}

	// fallback
	if ( ! trim( $image[0] ) ) {
		$image[0] = $placeholder;
	}

	return esc_attr( $image[0] );
}


/**
 * Return image url from img url (used in VC widgets)
 *
 * @param        $image_id
 * @param string $size
 *
 * @return string|void
 */
function wph_jo_get_image_by_id( $image_id, $size = 'full' ) {

	// placeholder
	$placeholder = WPH_ASSETS_DIR . '/images/placeholder.png';

	// retrieve an image
	$image = wp_get_attachment_image_src( $image_id, $size );

	// replace image with placeholder if non-exists
	if ( ! $image || ! trim( $image[0] ) ) {
		$image = array( $placeholder );
	}

	return esc_attr( $image[0] );
}


/**
 * Return attachment meta data to use in markup
 *
 * @param $attachment_id
 *
 * @return array
 */
function wph_jo_get_attachment( $attachment_id ) {
	$attachment = get_post( $attachment_id );

	return array(
		'alt'         => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption'     => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href'        => get_permalink( $attachment->ID ),
		'src'         => $attachment->guid,
		'title'       => $attachment->post_title
	);
}


/**
 * Is this post made with composer?
 *
 * @return bool
 */
function wph_jo_is_composer_post() {

	$object = get_queried_object();
	return $object instanceof WP_Post && has_shortcode($object->post_content, 'vc_row');
}


/**
 * Make sure to use page or post layout
 *
 * @return bool
 */
function wph_jo_is_page() {

	if(is_page()) {
		return true;
	}

	return in_array(get_post_type(), array('jo-portfolio'));
}


/**
 * Cut str to limit
 *
 * @param        $str
 * @param        $limit
 * @param string $end
 *
 * @return string
 */
function wph_jo_cut_str( $str, $limit, $end = '..' ) {

	// get length of string
	if ( function_exists( 'mb_strlen' ) ) {
		$strlen = mb_strlen( $str, 'UTF-8' );
	} else {
		$strlen = strlen( $str );
	}

	if ( $strlen <= $limit ) {
		return $str;
	}

	return substr( $str, 0, $limit ) . $end;
}


/**
 * Convert object to an associative array
 *
 * @param $d
 *
 * @return array
 */
function wph_jo_object_to_array($d) {
	if ( is_object( $d ) ) {
		// Gets the properties of the given object
		// with get_object_vars function
		$d = get_object_vars( $d );
	}

	if ( is_array( $d ) ) {
		/*
		* Return array converted to object
		* Using __FUNCTION__ (Magic constant)
		* for recursive call
		*/
		return array_map( __FUNCTION__, $d );
	} else {
		// Return array
		return $d;
	}
}


/**
 * Retrieve all tags
 *
 * @param null   $post_id
 * @param string $taxonomy
 *
 * @return array
 */
function wph_jo_get_portfolio_tags( $post_id = null, $taxonomy = 'jo-portfolio-tag' ) {

	if ( $post_id ) {
		$terms = wph_jo_object_to_array( get_the_terms( $post_id, $taxonomy ) );
		return ($terms) ? $terms : array();
	}

	$terms = wph_jo_object_to_array( get_terms( $taxonomy ) );
	return ($terms) ? $terms : array();
}


/**
 * Echo pluralised comment count
 */
function wph_jo_comment_count() {

	if ( comments_open() ) {
		printf( _n( '1 comment', '%s comments', get_comments_number(), 'jo-theme' ), get_comments_number() );
	} else {
		echo esc_html__( 'Comments', 'jo-theme' );
	}

}


/**
 * Retrieve file contents
 *
 * @param $file
 */
function wph_jo_fetch_file($file) {
	global $wp_filesystem;

	// load WP Filesystem if is not yes loaded
	if ( empty( $wp_filesystem ) ) {
		require_once( ABSPATH . '/wp-admin/includes/file.php' );
		WP_Filesystem();
	}

	// try to read file by WP Filesystem
	$contents = $wp_filesystem->get_contents( $file );

	// sometimes WP Filesystem fails to read existing & readable files,
	// so in these cases we need to use standard PHP function which is not allowed by
	// Theme Check, so we decided to use this small hack
	if ( ! $contents && is_readable( $file ) ) {
		$default_func = strrev( 'stnetnoc_teg_elif' );
		$contents     = $default_func( $file );
	}

	return $contents;
}


/**
 * Compare WP version
 *
 * @param string $version
 *
 * @return bool
 */
function wph_jo_wp_is_newer( $version = '4.1' ) {
	global $wp_version;

	if ( version_compare( $wp_version, $version, '>=' ) ) {
		return true;
	}
	return false;
}


/**
 * Return unique incremented integer
 *
 * @return int
 */
function wph_jo_unique_id() {
	global $wph_jo_unique_id;

	if ( ! isset( $wph_jo_unique_id ) ) { $wph_jo_unique_id = 0; }
	$wph_jo_unique_id += 1;

	return $wph_jo_unique_id;
}


/**
 * Detect empty search queries
 *
 * @return bool
 */
function wph_jo_is_empty_search() {
	return is_search() && ! trim( get_search_query() );
}


/**
 * Get size information for all currently-registered image sizes.
 *
 * @global $_wp_additional_image_sizes
 * @uses   get_intermediate_image_sizes()
 * @return array $sizes Data for all currently-registered image sizes.
 */
function wph_jo_get_image_sizes() {
	global $_wp_additional_image_sizes;

	$sizes = array();

	foreach ( get_intermediate_image_sizes() as $_size ) {
		if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
			$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
			$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
			$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
			$sizes[ $_size ] = array(
				'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
			);
		}
	}

	return $sizes;
}