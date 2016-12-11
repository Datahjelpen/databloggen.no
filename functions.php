<?php 
/*
 * functions
 * semplice.child.theme
 */

// Child style.css
add_action( 'wp_enqueue_scripts', 'enqueue_parent_theme_style' );
function enqueue_parent_theme_style() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

#----------------------------------------#
# portfolio custom post type - update    #
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
		'menu_name' => __('Innlegg', 'semplice')
	];

	// Change args
	$args['rewrite']   = ['slug' => 'innlegg'];
	$args['labels']    = $labels;
	$args['menu_icon'] = 'dashicons-admin-post';
	$args['menu_position'] = 5;
	$args['supports'] = ['title', 'author', 'thumbnail', 'custom-fields', 'comments', 'post-formats', 'excerpt'];

	return $args;
}, 10, 2 );

# Remove normal posts from menu
function custom_menu_page_removing() {
	remove_menu_page('edit.php');
}
add_action( 'admin_menu', 'custom_menu_page_removing' );

#----------------------------------------#
# recent_posts shortcode                 #
#----------------------------------------#

function recent_posts_function($atts) {
	# default options
	extract(shortcode_atts([
			'posts' => 1,
			'offset' => 0,
			'post_type' => 'work',
			'order' => 'DESC' ,
			'orderby' => 'date'
		], $atts)
	);

	# get posts with query
	query_posts([
			'orderby' => $orderby,
			'order' => $order ,
			'showposts' => $posts,
			'offset' => $offset,
			'post_type' => $post_type,
			'category__not_in' => [
				get_cat_ID('page')
			]
		]
	);

	# make output
	if (have_posts()) {
		$post_nr = 0;
		while (have_posts()) {
			$post_nr++;

			the_post();

			ob_start();
			include(__DIR__ . '/includes/templates/recent-posts.php');
			$output = ob_get_contents();
			ob_end_clean();
		}
	}

	wp_reset_query();

	return $output;
}

# Register shortcodes
function register_shortcodes(){
	add_shortcode('recent-posts', 'recent_posts_function');
}
add_action( 'init', 'register_shortcodes');