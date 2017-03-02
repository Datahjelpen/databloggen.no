<?php

$share_options = 'options';

// content width
if(get_field('skinoptions_content_width', 'options')) {
	$content_width = explode(' ', get_field('skinoptions_content_width', 'options'));
	$content_width = $content_width[0];
} else {
	$content_width = 'span8';
}

// Buttons
if(get_field('share_box_style', $share_options) !== 'icons') : ?>
	<div class="row">
		<div class="<?php if(get_post_type($post->ID) === 'work' || get_post_type($post->ID) === 'page') : echo 'span12'; else : echo $content_width; endif; ?>">
			<div class="semplice-share first">
				<div class="text">Facebook</div>
				<div class="button button-facebook">
					<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank">Share on Facebook</a>
				</div>
			</div>
			<div class="semplice-share">
				<div class="text">Twitter</div>
				<div class="button button-twitter">
					<a href="http://twitter.com/intent/tweet?text=<?php echo str_replace(' ', '%20', get_the_title()); ?> <?php the_permalink(); ?>" target="_blank">Share on Twitter</a>
				</div>
			</div>
			<div class="semplice-share">
				<div class="text">Google+</div>
				<div class="button button-gplusone">
					<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank">Share on Google+</a>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>