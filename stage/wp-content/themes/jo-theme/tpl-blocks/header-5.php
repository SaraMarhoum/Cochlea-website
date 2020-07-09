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

	<!-- navigation -->
	<nav class="center-block navigation">
		<?php wph_jo_display_navigation('primary'); ?>
	</nav>

	<!-- search & socials -->
	<div class="right-side">
		<?php get_template_part('tpl-blocks', 'header-toolbox'); ?>
	</div>

</header>
</div>
</div>