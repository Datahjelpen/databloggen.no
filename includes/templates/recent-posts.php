<section id="fp-articles" class="container" style="padding-top: 50px; padding-bottom: 50px;">
	<div class="dh--row">
		<?php
			$image_url = wp_get_attachment_image_src(get_field('thumb_nav_thumbnail'), 'full')[0];

			// Make list of the post's categories
			$categories = '<ul class="fp-article-categories">';
			foreach (get_the_category() as $category) {
				$categories .= '<li class="fp-article-category fp-article-category-' . $category->slug . '"><a href="/category/' . $category->slug . '">' . $category->name . '</a></li>';
			}
			$categories .= '</ul>';

			if ($post_nr === 1) {
				$image_url = (strlen($image_url) ? $image_url : '/wp-content/themes/semplice-child/images/placeholder-wide.png');
		?>
		<article class="fp-article fp-article-most-recent row col s12 m12 l8 c-lightest">
			<div class="fp-article-image-wrapper c-primary">
				<a href="<?= get_permalink(); ?>" class="fp-article-image dh--clear" style="background-image: url('<?= $image_url ?>')"></a>
				<?= $categories; ?>
			</div>
			<a href="<?= get_permalink(); ?>" class="fp-article-content col s12">
				<h3 class="fp-article-title"><?= get_the_title(); ?></h3>
				<p class="fp-article-excerpt">
					<?= get_the_excerpt(); ?>
				</p>
			</a>
		</article>
		<?php
			} else {
				$image_url = (strlen($image_url) ? $image_url : '/wp-content/themes/semplice-child/images/placeholder.png');
		?>
		<article class="row col s6 m4">
			<div class="fp-article-image-wrapper c-primary">
				<a class="fp-article-image-link dh--clear" href="<?= get_permalink(); ?>">
					<img src="<?= $image_url ?>" class="fp-article-image col s12" alt="<?= get_the_title(); ?> bilde">
				</a>
				<?= $categories; ?>
			</div>
			<a href="<?= get_permalink(); ?>" class="fp-article-content col s12">
				<h3 class="fp-article-title"><?= get_the_title(); ?></h3>
				<p class="fp-article-excerpt">
					<?= get_the_excerpt(); ?>
				</p>
			</a>
		</article>
		<?php
			}
		?>
	</div>
</section>