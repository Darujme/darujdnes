<?php
/**
 * Metas
 */
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'wp_generator');


/**
 * Remove gallery styles
 */
add_filter( 'use_default_gallery_style', '__return_false' );


/**
 * Shortcuts
 */
function assetsPath() {
  echo get_stylesheet_directory_uri().'/assets';
}

function getAssetsPath() {
  return get_stylesheet_directory_uri().'/assets';
}

function get_post_thumbnail_uri($size = 'full'){
    global $post;
    $thumb = @wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $size );
    $url = $thumb['0'];

    return $url;
}

function post_thumbnail_uri($size = 'full'){
    global $post;
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $size );
    $url = $thumb['0'];

    echo $url;
}

function is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}



function embedWrapper($content) {
	$pattern = '~<iframe.*</iframe>|<embed.*</embed>~';
	preg_match_all($pattern, $content, $matches);

	foreach ($matches[0] as $match) {
		$wrappedframe = '<div class="embed-container">' . $match . '</div>';

		$content = str_replace($match, $wrappedframe, $content);
	}
	return $content;
}
add_filter('the_content', 'embedWrapper');

