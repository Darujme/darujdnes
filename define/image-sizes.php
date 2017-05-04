<?php
add_action('after_setup_theme', 'add_image_sizes');

function add_image_sizes() {
	add_image_size('l', 1280);

	add_image_size('square50', 50, 50, true);
	add_image_size('square50_2x', 100, 100, true);

	add_image_size('square290', 290, 290, true);
	add_image_size('square290_2x', 580, 580, true);
}
