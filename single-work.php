<?php 
/*
 * single work
 * semplice.theme
 */
?>
<?php get_header(); # inlude header ?>

<?php if ( post_password_required() ) { ?>

	<div class="container">
		<div class="row">
			<div class="span12">
				<?php echo get_the_password_form(); ?>
			</div>
		</div>
	</div>
 
<?php } else { ?>
	
	<?php if(get_field('cover_visibility') === 'visible') : ?>
	<?php get_template_part('partials/fullscreen-cover'); ?>
	<?php endif; ?>
	
	<?php if(!isset($_GET['cover-slider'])) : # if cover slider display no content ?>
		<!-- content fade -->
		<div class="fade-content">
			<?php
				// Remove wpautop
				remove_filter('the_content', 'wpautop');

				// get content
				$content = get_post_meta( get_the_ID(), 'semplice_ce_content', true );

				// strip out double quotes on bg images
				$content = remove_esc_bg_quotes($content);

				// output content
				$output = apply_filters('the_content', $content);

				$show_extra = true;
				if (strlen($content) != 0) {
					$show_extra = false;
					echo $output;
				}


				if(trim(get_the_content) != '') {
					if (has_post_thumbnail( $loop->post->ID )) {
						$image_id = get_post_thumbnail_id($loop->post->ID);
						$image_size = 'large';

						// Smaller files for mobile phones
						if (wp_is_mobile()) {
							$image_size = 'medium';
						}

						$image_url = wp_get_attachment_image_src( $image_id, $image_size )[0];
					} else {
						$image_url = get_stylesheet_directory_uri() . '/images/placeholder.png';
					}
			?>
			<?php if ($show_extra) { echo '<div id="content-holder"></div>'; } ?>
			<div class="container dh--row">
				<div class="col s12 offset-m2 m8">
					<div class="post-header">
						<?php
							if ( 'post' === get_post_type() ) :
								echo '<div class="entry-meta">';
									if ( is_single() ) :
										twentyseventeen_posted_on();
									else :
										echo twentyseventeen_time_link();
										twentyseventeen_edit_link();
									endif;
								echo '</div><!-- .entry-meta -->';
							endif;

							if ($show_extra) {
								the_title( '<h1 class="entry-title">', '</h1>' );
							}
						?>
					</div><!-- .post-header -->
				</div>
			</div>
			<?php
				if ($show_extra) {
			?>
			<div class="post-thumbnail">
				<div class="bg-image" style="background-image: url('<?= $image_url; ?>');"></div>
			</div><!-- .post-thumbnail -->
			<?php
				}
			?>
			<div class="container dh--row">
				<div class="col s12 offset-m2 m8">
					<div class="post-content">
						<?php the_content(); ?>
					</div><!-- .post-content -->
				</div>
			</div>
			<?php	
				}
				// reset postdata
				wp_reset_postdata();
			?>
		</div>		
		<?php if(get_field('share_visibility') === 'visible' && get_field('global_share_visbility', 'options') !== 'hidden') : ?>
			<div class="share-box fade-content">
				<div class="container">
					<?php get_template_part('partials/share'); ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="fade-content c-lightest dh--comments">
			<div class="container dh--row">
				<div class="col s12 offset-m2 m8">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>
				</div>
			</div>
		</div>
		<div id="project-panel-footer" class="fade-content">
			<?php 
				// quick nav thumb
				$tn_transition = '';
				get_template_part('partials/project', 'panel');
			?>
		</div>

	<?php endif; ?>
	
<?php } ?>

<?php get_footer(); # inlude footer ?>