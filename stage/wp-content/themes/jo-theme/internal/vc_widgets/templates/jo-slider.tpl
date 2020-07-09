<!-- Slider itself -->
<div class="wph-jo-slider {classes}" data-slider-height="{height}" data-slider-id="{uid}">

	<div class="slides">
		{slides}
	</div>

	<div class="titles">
		{titles}
	</div>

</div>

<!-- Toolbox -->
<div class="wph-slider-toolbox" data-slider-id="{uid}"><div class="container">

	<div class="toolbox-column">
		<div class="site-socials">{socials}</div>
		{searchform}
	</div>

	<div class="toolbox-column scroll-btn">
		<a href="#wph-slider-{uid}">{scroll_down_lg} <i class="wph-icon-angle-down-3"></i></a>
	</div>

</div></div>

<!-- Scrolling anchor -->
<div id="wph-slider-{uid}"></div>