<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>

<div class="toolbox">

	<?php if(wph_jo_display_socials('options', true)): ?>
		<i class="wph-icon-search-1 search-icon-toggle"></i>
		<div class="site-socials"><?php wph_jo_display_socials(); ?></div>
		<div class="searchbox"><?php get_search_form(); ?></div>
	<?php else: ?>
		<?php get_search_form(); ?>
	<?php endif; ?>
	
</div>