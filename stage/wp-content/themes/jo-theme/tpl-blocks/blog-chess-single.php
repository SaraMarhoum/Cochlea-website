<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>

<article <?php post_class('post-item mp-container wow fadeIn'); ?>>

	<!-- Post thumbnail -->
	<div class="image-column inner-col">

		<!-- Image element -->
		<?php $image = wph_jo_get_post_image( null, 'jo_square_thumb' ); ?>
		<div class="image mp-target"
		     data-mp-noscale="true"
		     style="background-image: url('<?php echo esc_url($image); ?>')"></div>

	</div>


	<!-- Post title, excerpt and etc.. -->
	<div class="meta-column inner-col">

		<!-- post date and featured badge -->
		<?php if (is_sticky()): ?>
			<div class="featured-badge"><?php esc_html_e('Featured Post', 'jo-theme'); ?></div>
		<?php endif; ?>

		<!-- just title -->
		<h1 class="post-title">
			<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
		</h1>

		<!-- Post date -->
		<div class="post-date"><?php echo get_the_date('d F Y'); ?></div>


		<!-- Read more link -->
		<a href="<?php echo get_permalink(); ?>" class="read-more-btn">
			<?php esc_html_e('Read more', 'jo-theme') ?>
			<i class="wph-icon-angle-right-3"></i>
		</a>

	</div>

	<!-- Link overlay -->
	<a class="link-overlay" href="<?php echo get_permalink(); ?>">
		<?php esc_html_e('Read more', 'jo-theme') ?>
	</a>

</article>