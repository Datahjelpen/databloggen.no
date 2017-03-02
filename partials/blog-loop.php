
<?php
	$args = [
		'post_type' => ['post', 'work'],
		'posts_per_page' => 10,
		'post_status' => 'publish, private',
		'orderby' => 'date'
	];
	$loop = new WP_Query( $args );

	if($loop->have_posts()) {
		while($loop->have_posts()) {
			$loop->the_post();
?>
		<article class="blog-post">
			<div class="container">
				<?php
					
					/* Post formats that will use the standard post format layout */
					$formats = array('aside', 'chat', 'status', 'link');
					
					if(!get_post_format() || in_array(get_post_format(), $formats)) { 
						get_template_part('partials/format', 'standard');
					} else {
						get_template_part('partials/format', get_post_format());
					}
				?>
			</div>
		</article>
<?php
		if(!is_single()) {
?>
		<div class="post-divider search-divider"></div>
<?php
			} 
		} // End while
	} else {
		if(is_search()) {
?>
	<div class="container">
		<div class="row">
			<div class="span12"><p class="no-results"><?php echo __('No results were found. Please try a different search.', 'semplice'); ?></p></div>
		</div>
	</div>
<?php
		}
	}
?>