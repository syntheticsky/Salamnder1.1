<div class="related-posts related-projects">
	<div id="carousel" class="es-carousel-wrapper">
		<div class="es-carousel">
			<ul class="">
<?php while( $gallery->have_posts() ): $gallery->the_post(); ?>
	<?php if ( has_post_thumbnail() ): ?>
				<li>
					<div class="image">
		<?php if ( Salamander::getData( 'image_rollover' ) ):
					print get_the_post_thumbnail( get_the_ID(), 'related-img' );
					else: ?>
					<a href="<?php prnt get_permalink( get_the_ID() ); ?>"><?php print get_the_post_thumbnail( get_the_ID(), 'related-img' ); ?></a>
		<?php endif;
					if ( get_post_meta( get_the_ID(), 'sl_meta_image_rollover_icons', true ) == 'link' ):
						$link_icon_css = 'display:inline-block;';
						$zoom_icon_css = 'display:none;';
					elseif(get_post_meta(get_the_ID(), 'sl_meta_image_rollover_icons', true) == 'zoom'):
						$link_icon_css = 'display:none;';
						$zoom_icon_css = 'display:inline-block;';
					elseif(get_post_meta(get_the_ID(), 'sl_meta_image_rollover_icons', true) == 'no'):
						$link_icon_css = 'display:none;';
						$zoom_icon_css = 'display:none;';
					else:
						$link_icon_css = 'display:inline-block;';
						$zoom_icon_css = 'display:inline-block;';
					endif;

					$icon_url_check = get_post_meta( get_the_ID(), 'sl_meta_link_icon_url', true );
					if ( ! empty( $icon_url_check ) ):
						$icon_permalink = get_post_meta( get_the_ID(), 'sl_meta_link_icon_url', true );
					else:
						$icon_permalink = get_permalink( get_the_ID() );
					endif; ?>
						<div class="image-extras">
							<div class="image-extras-content">
								<a style="<?php print $link_icon_css; ?>" class="icon link-icon" style="margin-right:3px;" href="<?php print $icon_permalink; ?>">
								<?php _e('Permalink', 'Salamander' ); ?>
								</a>
		<?php $full_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
					if ( get_post_meta(get_the_ID(), 'sl_meta_video_url', true ) )
						$full_image[0] = get_post_meta( get_the_ID(), 'sl_meta_video_url', true ); ?>
								<a style="<?php print $zoom_icon_css; ?>" class="icon gallery-icon" href="<?php print $full_image[0]; ?>" rel="prettyPhoto[gallery_recent_<?php print $recent_works_counter; ?>]"><?php _e( 'Gallery', 'Salamander' ); ?></a>
								<h3><?php print get_the_title(); ?></h3>
							</div>
						</div>
					</div>
				</li>
		<?php
				endif;
			endwhile; wp_reset_query(); ?>
			</ul>
		</div>
		<div class="es-nav">
			<span class="es-nav-prev"><?php _e( 'Previous', 'Salamander' ); ?></span>
			<span class="es-nav-next"><?php _e( 'Next', 'Salamander' ); ?></span>
		</div>
	</div>
</div>
