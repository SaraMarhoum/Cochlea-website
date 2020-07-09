<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>

<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" name="s"
	       autocomplete="off"
	       required="required"
	       value="<?php echo get_search_query(); ?>"
	       placeholder="<?php echo esc_attr(esc_html__('Search', 'jo-theme')); ?>" />

    <button class="submit-btn"><i class="wph-icon-search-1"></i></button>
</form>
