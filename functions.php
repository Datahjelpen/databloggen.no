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

	// Change args
	$args['rewrite'] = ['slug' => 'innlegg'];

	return $args;
}, 10, 2 );