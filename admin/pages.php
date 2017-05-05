<?php

require_once __DIR__.'/compile_colors_css.php';

require_once __DIR__ . '/../utils/darujme.php';

function register_darujme_settings_menu_page(){
	$suffix = add_menu_page(
		'Nastavení propojení s Darujme.cz',
		'Darujme.cz',
		'manage_options',
		'darujme-settings',
		'render_darujme_settings_menu_page',
		get_stylesheet_directory_uri() . '/assets/images/menu-icon-darujme.png'
	);

	add_action( "admin_print_scripts-$suffix", 'darujme_settings_menu_page_enqueue_assets');
}

add_action('admin_menu', 'register_darujme_settings_menu_page');

function darujme_settings_menu_page_enqueue_assets() {
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('iris');
}

function render_darujme_settings_menu_page(){
	if (!empty($_POST)) {
		$settings = [];

		if (!empty($_POST['darujme_api_id'])) {
			$settings['api_id'] = sanitize_text_field($_POST['darujme_api_id']);
		}

		if (!empty($_POST['darujme_api_secret'])) {
			$settings['api_secret'] = sanitize_text_field($_POST['darujme_api_secret']);
		}

		if (!empty($_POST['darujme_project_id']) && !empty($_POST['darujme_project_type'])) {
			$settings['items'] = [];
			foreach ($_POST['darujme_project_id'] as $key => $id) {
				if (!$id || !isset($_POST['darujme_project_type'][$key])) {
					continue;
				}
				$type = $_POST['darujme_project_type'][$key];
				$donate_label = $_POST['darujme_project_donate_label'][$key];
				$donate_url = $_POST['darujme_project_donate_url'][$key];
				$settings['items'][] = [
					'type' => $type,
					'id' => $id,
					'donate_label' => $donate_label,
					'donate_url' => $donate_url,
				];
			}
		}

		if (isset($_POST['darujme_footer_left']) || isset($_POST['darujme_footer_right']) || isset($_POST['darujme_color_primary']) || isset($_POST['darujme_color_secondary'])) {
			$settings_theme = [];
			$settings_theme['footer_left'] = sanitize_text_field($_POST['darujme_footer_left']);
			$settings_theme['footer_right'] = sanitize_text_field($_POST['darujme_footer_right']);
			$settings_theme['color_primary'] = sanitize_text_field($_POST['darujme_color_primary']);
			$settings_theme['color_secondary'] = sanitize_text_field($_POST['darujme_color_secondary']);

			compile_color_css($settings_theme['color_primary'], $settings_theme['color_secondary']);

			update_option('darujme_theme_settings', $settings_theme);
		}

		update_option('darujme_settings', $settings);
	}

	require __DIR__ . '/templates/darujme-settings.php';
}
