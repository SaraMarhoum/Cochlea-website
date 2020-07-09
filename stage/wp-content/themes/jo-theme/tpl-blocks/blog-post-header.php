<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

$use_hero    = get_field( 'use_post_hero_block' );
$hero_markup = get_field( 'hero_markup' );

if ( ! has_post_thumbnail() || ( $use_hero && ! trim( $hero_markup ) ) ) {
	return;
} ?>

<!-- Post hero -->
<div class="post-header mp-container <?php if ( ! $use_hero && has_post_thumbnail() ) echo 'img-only'; ?>">

<?php if ( $use_hero ): // display custom markup if specified
		echo do_shortcode( $hero_markup );

	elseif ( has_post_thumbnail() ) : // display featured image ?>
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large', array('class' => 'mp-target') ); ?></a>

	<?php endif; ?>

</div>