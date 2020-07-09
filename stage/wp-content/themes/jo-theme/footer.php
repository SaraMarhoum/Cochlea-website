<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>


<!-- ========= Footer ========= -->
<?php if(wph_jo_opt('wph_jo_remove_footer') !== 'true'): ?>
<?php if ( ! wph_jo_is_composer_post() ): ?><div class="wph-footer-spacer"></div><?php endif; ?>

<footer class="wph-site-footer container">

	<!-- Footer caption -->
	<div class="left-side footer-caption">
		<?php wph_jo_display_footer_text(); ?>
	</div>

	<!-- Footer appendix -->
	<div class="right-side">
		<?php wph_jo_display_footer_appendix(); ?>
	</div>

</footer>
<?php endif; ?>


<!-- ========= WordPress JS code ========= -->
<?php wp_footer(); ?>


</body></html>