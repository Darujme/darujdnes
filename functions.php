<?php

/**
 * Utils
 */

require_once __DIR__.'/utils/disable-emoji.php';
require_once __DIR__.'/utils/hide-wp-embed.php';
require_once __DIR__.'/utils/utils.php';
require_once __DIR__.'/utils/remove-admin-menu.php';
require_once __DIR__.'/utils/darujme.php';

/**
 * Define
 */
require_once __DIR__.'/define/post-types.php';
require_once __DIR__.'/define/image-sizes.php';
require_once __DIR__.'/define/meta-fields.php';

if (is_admin()) {
	require_once __DIR__.'/admin/pages.php';
}

/**
 * Theme support
 */
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );
add_theme_support( 'title-tag' );


add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );

/**
 * Load custom CSS
 */
function mango_styles() {
    if (!is_admin() && !(is_login_page())) {
        if(file_exists( __DIR__.'/assets/styles/index_colored.css')){
          wp_enqueue_style('theme-main', getAssetsPath().'/styles/index_colored.css?v='.$v);
        }else{
          wp_enqueue_style('theme-main', getAssetsPath().'/styles/index.css?v='.$v);
        }
    }
}
add_action('init', 'mango_styles');


// return first image url from metabox image_advanced
function metaimage($meta, $size, $post){
	$return = array_values(rwmb_meta( $meta, 'type=image&size='.$size, $post))[0]['url'];

	return $return;
}


/**
 * http://tgmpluginactivation.com/
 */
define('theme_path', TEMPLATEPATH . '/mu-plugins/');
require_once theme_path. 'tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'require_plugins' );

function require_plugins() {

    $plugins = array(
    	 array(
        'name'      => 'Meta-box',
        'slug'      => 'meta-box',
        'required'  => true,
        'source'    => theme_path. '/meta-box.zip',
        'force_activation' => true
    ));

    $config = array(
	    'has_notices'  => true,
	    'dismissable'  => false,
	    'is_automatic' => true,
	    'strings'      => array(
	    	'notice_can_install_required'     => _n_noop(
				'Tato šablona vyžaduje aktivaci následujícího pluginu: %1$s.', 'This theme requires the following plugins: %1$s.', 'darujme'
				),
	    	'install_link' => _n_noop(
					'Zahájit aktivaci pluginu.', 'Begin installing plugins', 'darujme'
				),
	    )
	);

    tgmpa( $plugins, $config );
}

function calculateProgress(){
	global $Post;

	$target = rwmb_meta( 'cta_target_price', '', $Post);

	if (!$target) {
		return 0;
	}

	$now = darujmeCountCollectedAmount();
	$percent = $now / ($target / 100);

	return $percent;
}






