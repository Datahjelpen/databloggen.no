<?php 
/*
 * functions
 * semplice.child.theme
 */

#----------------------------------------#
# portfolio custom post type             #
# semplice.theme                         #
#----------------------------------------#

add_filter( 'register_post_type_args', function ( $args, $post_type ) {
	// Only target our specific post type
	if ( 'work' !== $post_type )
		return $args;

	$labels = [
		'name' => __('Innlegg', 'semplice'),
		'singular_name' => __('Innlegg', 'semplice'),
		'add_new' => __('Lag nytt innlegg', 'semplice'),
		'add_new_item' => __('Lag nytt innlegg', 'semplice'),
		'edit_item' => __('Rediger innlegg', 'semplice'),
		'new_item' => __('Nytt innlegg', 'semplice'),
		'view_item' => __('Se innlegg', 'semplice'),
		'search_items' => __('Søk innlegg', 'semplice'),
		'not_found' => __('Ingen innlegg funnet', 'semplice'),
		'not_found_in_trash' => __('Ingen innlegg i søppla', 'semplice'),
		'parent_item_colon' => __('Forelder innlegg:', 'semplice'),
		'menu_name' => __('Innlegg', 'semplice'),
	];

	// Change args
	$args['rewrite']   = ['slug' => 'innlegg'];
	$args['labels']    = $labels;
	$args['menu_icon'] = 'dashicons-admin-post';

	return $args;
}, 10, 2 );