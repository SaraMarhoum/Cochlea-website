<div class="wrap">

	<h2><?php echo esc_html($title); ?></h2>

	<!-- Description text -->
	<div class="main-grid">
		<div class="text-col">
			<h3><?php esc_attr_e('Step 1. Include demo data', 'jo-theme'); ?></h3>

			<p><?php echo wp_kses_post(__('<i>This step is optional</i> Here you can include demo data to your site. This procedure will make your site look as our demo. Learning demo data helps you to understand overall architecture and internal institution of the theme.', 'jo-theme')); ?></p>

			<p><?php echo wp_kses_post(__('To start import just click the button below. Importing process may take up to <b>3-5 minutes</b>. Do not close window until import process is done. Note that we did not include images to release files. They used only for demonstration purposes.', 'jo-theme')); ?></p>

			<p><b><?php esc_attr_e('Before start, please make sure that:', 'jo-theme'); ?></b></p>

			<ul class="ul-square">
				<li><?php esc_attr_e('All required plugins are installed and activated', 'jo-theme'); ?></li>
			</ul>

			<p><b><?php esc_attr_e('Note!', 'jo-theme'); ?></b> <?php esc_attr_e('All images that will be imported provided only for demo purposes. Do not use it in a real project without a proper license.', 'jo-theme'); ?></p>

			<!-- Buttons -->
			<div class="buttons-line">
				<button class="button button-primary button-large wphunters-import">
					<?php esc_attr_e('Import demo data', 'jo-theme'); ?>
				</button>

				<span class="spinner"></span>
			</div>

			<!-- Result field -->
			<div class="import-message">
				<h3><?php esc_attr_e('Import results', 'jo-theme'); ?></h3>
				<p></p>
			</div>

			<hr class="mega-hr"/>

			<!-- Second section -->
			<h3><?php esc_attr_e('Step 2. Tune your WordPress installation', 'jo-theme'); ?></h3>

			<p><?php echo wp_kses_post(__('In this step you can automatically tune settings of your site to get much better experience using our theme. Of course, you can skip this step or make changes by yourself. <b>What we\'ll do with your site:</b>', 'jo-theme')); ?></p>

			<ul class="ul-square">
				<li><?php echo wp_kses_post(__('Set home page to <i>Index page</i>(if that page exists).', 'jo-theme')); ?></li>
				<li><?php echo wp_kses_post(__('Set permalinks settings to <i>Post name</i> option.', 'jo-theme')); ?></li>
				<li><?php echo wp_kses_post(__('Tune <i>Visual Composer</i> to work with Theme\'s Custom Post types.', 'jo-theme')); ?></li>
			</ul>

			<!-- Buttons -->
			<div class="buttons-line">
				<button class="button button-primary button-large wphunters-tune">
					<?php esc_attr_e('Tune WordPress for using with this theme', 'jo-theme'); ?>
				</button>

				<span class="spinner"></span>
			</div>

			<!-- Result field -->
			<div class="tune-message">
				<h3><?php esc_attr_e('Setup results', 'jo-theme'); ?></h3>
				<p></p>
			</div>

			<hr class="mega-hr"/>

			<!-- Third section -->
			<h3><?php esc_attr_e('(OPTIONAL) Step 3. Import sliders', 'jo-theme'); ?></h3>

			<p><?php echo wp_kses_post(__('If you want to use <b>Smart Slider 3</b> on this site, you might need our pre-designed sliders/hero blocks. To import them follow these steps:', 'jo-theme')); ?></p>

			<ol>
				<li>Go to <a href="<?php echo admin_url('admin.php?page=nextend-smart-slider3-pro') ?>">Smart Slider</a> page</li>
				<li><?php echo wp_kses_post(__('Click button <i>"Import by upload"</i>', 'jo-theme')); ?></li>
				<li><?php echo wp_kses_post(__('Select one of archives from folder <i>"Sliders"</i> from your download package', 'jo-theme')); ?></li>
				<li><?php echo wp_kses_post(__('Click green <i>"Import"</i> button on the top.', 'jo-theme')); ?></li>
				<li><?php esc_attr_e('Repeat steps 1-4 for each archive from package.', 'jo-theme'); ?></li>
			</ol>
		</div>

		<!-- Image logo -->
		<div class="logo-col"><img src="<?php echo esc_attr($this_dir) ?>/style/logo_black.png" alt=""/></div>

	</div>

</div>

<!-- JavaScript & styles -->
<link rel="stylesheet" href="<?php echo esc_attr($this_dir) ?>/style/style.css"/>
<script type="text/javascript" src="<?php echo esc_attr($this_dir) ?>/style/importer.js"></script>
