<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>

<article <?php post_class( 'post-item wow fadeIn' ); ?>>

	<!-- Post header -->
	<?php get_template_part( 'tpl-blocks', 'blog-post-header' ); ?>

	<!-- Featured badge -->
	<?php if ( is_sticky() ): ?>
		<div class="featured-badge"><?php esc_html_e( 'Featured Post', 'jo-theme' ); ?></div>
	<?php endif; ?>

	<!-- Big Post Title -->
	<h1 class="post-title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h1>

	<!-- Meta line (title, date, author, featured badge) -->
	<div class="post-meta-subline">
		<span class="date"><?php echo get_the_date(); ?></span> &bull;
		<span class="author"><?php printf( esc_html__( 'By %s', 'jo-theme' ), get_the_author() ); ?></span>
	</div>

	<!-- Post Content -->
	<div class="post-content">
		<?php the_excerpt(); ?>
	</div>

	<!-- "Read more" button -->
	<a href="<?php the_permalink(); ?>" class="read-more-btn">
		<?php echo esc_html__( 'Read more', 'jo-theme' ); ?>
		<i class="wph-icon-angle-right-3"></i>
	</a>

</article>