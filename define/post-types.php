<?php

/**
 * Generate the labels for custom post types
 *
 * @param string $singular The singular post type name
 * @param string $plural The plural post type name
 * @return array Array of labels
 */
function post_type_labels( $singular, $plural = '' )
{
    if( $plural == '') $plural = $singular .'s';

    return array(
        'name' => _x( $plural, 'post type general name', 'sk' ),
        'singular_name' => _x( $singular, 'post type singular name', 'sk' ),
        'add_new' => __( 'Add New', 'sk' ),
        'add_new_item' => sprintf( __( 'Add New %s', 'sk' ), $singular),
        'edit_item' => sprintf( __( 'Edit %s', 'sk' ), $singular),
        'new_item' => sprintf( __( 'New %s', 'sk' ), $singular),
        'view_item' => sprintf( __( 'View %s', 'sk' ), $singular),
        'search_items' => sprintf( __( 'Search %s', 'sk' ), $plural),
        'not_found' =>  sprintf( __( 'No %s found', 'sk' ), $plural),
        'not_found_in_trash' => sprintf( __( 'No %s found in Trash', 'sk' ), $plural),
        'parent_item_colon' => ''
    );
}


function register_post_types()
{
	# PROGRAM
	$args = array(
		'labels' => post_type_labels( 'example', 'example' ),
		'public' => true,
		'show_ui' => true,
		'menu_icon' => 'dashicons-palmtree',
		'rewrite' => array( 'slug' => 'example' ),
		'supports' => array('title','thumbnail')
	);
	// register_post_type( 'example', $args );
}
add_action( 'init', 'register_post_types', 1 );
