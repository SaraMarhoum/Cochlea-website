<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>

<div class="wph-header-container">
<div class="container">
<header class="wph-site-header header-layout-1" data-visibility="desktop">

	<!-- logo -->
	<a href="<?php echo esc_url( home_url('/') ) ?>" class="left-side header-brand">
		<?php if ( wph_jo_opt( 'image_as_logo' ) ): ?>
			<img src="<?php echo esc_attr( wph_jo_opt( 'logo_image' ) ); ?>"/>
		<?php else: ?>
			<h1><?php echo esc_attr( wph_jo_opt( 'logo_text', get_bloginfo( 'name' ) ) ); ?></h1>
		<?php endif ?>
	</a>

	<!-- menu toggle -->
	<div class="right-side">
		<a href="#" class="fullscreen-menu-toggle">
			<i class="menu-bars"><i class="first"></i><i class="second"></i><i class="third"></i></i>
			<span><?php esc_html_e('Menu', 'jo-theme'); ?></span>
		</a>
	</div>

</header>
</div>
</div>