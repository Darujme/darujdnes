<?php $theme_settings = darujmeGetThemeSettings();?>

<footer class="copy">
	<div class="container">
		<div class="copy-left"><p><?php print(isset($theme_settings['footer_left']) ? $theme_settings['footer_left'] : '');?></p></div>
		<div class="copy-logo"><svg class="shape shape-logo-darujme"><use xlink:href="#shape-logo-darujme" /></svg></div>
		<div class="copy-right"><p><?php print(isset($theme_settings['footer_right']) ? $theme_settings['footer_right'] : '');?></p></div>
	</div>
</footer>
