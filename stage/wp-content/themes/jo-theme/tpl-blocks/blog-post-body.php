<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>

<!-- Post header module -->
<?php get_template_part( 'tpl-blocks', 'blog-post-header' ); ?>

<!-- Meta line (title, date, author, featured badge) -->
<div class="post-meta">
	<h1 class="post-title"><?php the_title(); ?></h1>

	<div class="meta-subline">
		<span class="date"><?php echo get_the_date(); ?></span> &bull;
		<span class="author"><?php printf( esc_html__( 'By %s', 'jo-theme' ), get_the_author() ); ?></span>

		<?php if ( is_sticky() ): ?>
			&bull; <span class="featured-badge"><?php esc_html_e( 'Featured Post', 'jo-theme' ); ?></span>
		<?php endif; ?>
	</div>
</div>

<!-- Post text -->
<div class="post-content">
	<?php the_content(); ?>

	<!-- pagination -->
	<?php wp_link_pages(); ?>
</div>

<!-- Sharing buttons and tags -->
<div class="post-footer row">
	<hr/>

	<?php echo wph_jo_share_buttons( array(
		'text'     => esc_html__( 'Share:', 'jo-theme' ),
		'align'    => 'align_left',
		'el_class' => 'col-xs-12 col-sm-6 left-side'
	) ); ?>

	<!-- Post Tags(if defined) -->
	<?php if ( get_the_tags() ): ?><div class="col-xs-12 col-sm-6 right-side">
		<span class="wph-secondary-font text-inner">TAGS:</span>
		<span class="tagcloud"><?php the_tags( '' ); ?></span>
	</div><?php endif; ?>
</div>