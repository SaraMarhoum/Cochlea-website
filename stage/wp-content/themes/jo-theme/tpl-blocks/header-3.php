<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>

<div class="wph-header-container">
<div class="container">
<header class="wph-site-header header-layout-2" data-visibility="desktop">

	<!-- Logo -->
	<a href="<?php echo esc_url( home_url('/') ) ?>" class="first-line header-brand">
		<?php if ( wph_jo_opt( 'image_as_logo' ) ): ?>
			<img src="<?php echo esc_attr( wph_jo_opt( 'logo_image' ) ); ?>"/>
		<?php else: ?>
			<h1><?php echo esc_attr( wph_jo_opt( 'logo_text', get_bloginfo( 'name' ) ) ); ?></h1>
		<?php endif ?>
	</a>

	<!-- Other controls (menu, socials) -->
	<div class="second-line">

		<!-- search form -->
		<div class="left-side">
			<?php get_template_part('tpl-blocks', 'header-toolbox'); ?>
		</div>

		<!-- navigation -->
		<nav class="center-block navigation">
			<?php wph_jo_display_navigation('primary'); ?>
		</nav>

		<!-- phone number -->
		<?php if(wph_jo_opt('phone_number')): ?>
		<div class="right-side phone-col">
			<i class="wph-icon-phone-3"></i>
			<?php $sphone = esc_html(wph_jo_opt('phone_number')); ?>
			<a href="tel:<?php echo urlencode($sphone); ?>"><?php echo $sphone; ?></a>
		</div>
		<?php endif; ?>
		
	</div>

</header>
</div>
</div>