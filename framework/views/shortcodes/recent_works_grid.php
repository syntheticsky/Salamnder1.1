<div class="portfolio portfolio-grid clearfix portfolio-<?php print $columns_words; ?>" data-columns="<?php print $columns_words; ?>">
<?php
	$portfolio_category = get_terms( 'portfolio_category' );
	if ( $portfolio_category && $filters == true ): ?>
	<ul class="portfolio-tabs clearfix">
		<li class="active"><a data-filter="*" href="#"><?php _e( 'All', 'Salamander' ); ?></a></li>
<?php
		foreach ( $portfolio_category as $portfolio_cat ):
			if ( $cat_slug ):
				$cat_slug = explode(',', $cat_slug);
				$cat_slug = array_map( 'trim', $cat_slug );
				if ( in_array( $portfolio_cat->slug, $cat_slug ) ): ?>
		<li>
			<a data-filter=".<?php print $portfolio_cat->slug; ?>" href="#"><?php print $portfolio_cat->name; ?></a>
		</li>
	<?php	endif;
			else: ?>
		<li>
			<a data-filter=".<?php print $portfolio_cat->slug; ?>" href="#"><?php print $portfolio_cat->name; ?></a>
		</li>
<?php
			endif;
		endforeach;
?>
	</ul>
<?php
	endif; ?>
	<div class="portfolio-wrapper">
<?php
	while($gallery->have_posts()): $gallery->the_post();
		if ( has_post_thumbnail() || get_post_meta( get_the_ID(), 'sl_meta_video', true ) ):
			$item_classes = '';
			$item_cats = get_the_terms( get_the_ID(), 'portfolio_category' );
			if($item_cats)
				foreach($item_cats as $item_cat)
					$item_classes .= $item_cat->slug . ' ';
			$permalink = get_permalink(); ?>

		<div class="portfolio-item <?php print $item_classes; ?>">
<?php if(has_post_thumbnail()): ?>
			<div class="image">
	<?php if ( Salamander::getData( 'image_rollover' ) ):
					$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ), $portfolio_image_size ); ?>
				<img src="<?php print $thumbnail[0]; ?>" alt="<?php print get_post_field( 'post_excerpt', get_post_thumbnail_id( get_the_ID() ) ); ?>" />
	<?php else:
					$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $portfolio_image_size); ?>
				<a href="<?php print $permalink; ?>">
					<img src="<?php print $thumbnail[0]; ?>" alt="<?php print get_post_field( 'post_excerpt', get_post_thumbnail_id( get_the_ID() ) ); ?>" />
				</a>
	<?php endif;
				if ( get_post_meta( get_the_ID(), 'sl_meta_image_rollover_icons', true ) == 'link' ):
					$link_icon_css = 'display:inline-block;';
					$zoom_icon_css = 'display:none;';
				elseif(get_post_meta( get_the_ID(), 'sl_meta_image_rollover_icons', true ) == 'zoom'):
					$link_icon_css = 'display:none;';
					$zoom_icon_css = 'display:inline-block;';
				elseif(get_post_meta( get_the_ID(), 'sl_meta_image_rollover_icons', true ) == 'no'):
					$link_icon_css = 'display:none;';
					$zoom_icon_css = 'display:none;';
				else:
					$link_icon_css = 'display:inline-block;';
					$zoom_icon_css = 'display:inline-block;';
				endif;

				$icon_url_check = get_post_meta( get_the_ID(), 'sl_meta_link_icon_url', true );
				if(!empty($icon_url_check)):
					$icon_permalink = get_post_meta( get_the_ID(), 'sl_meta_link_icon_url', true );
				else:
					$icon_permalink = get_permalink(get_the_ID());
				endif; ?>
				<div class="image-extras">
					<div class="image-extras-content">
					<?php $full_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID() ), 'full' ); ?>
						<a style="<?php print $link_icon_css; ?>" class="icon link-icon" href="<?php print $icon_permalink; ?>"><?php _e( 'Permalink', 'Salamander' ); ?></a>
			<?php if ( get_post_meta( get_the_ID(), 'sl_meta_video_url', true ) ):
					$full_image[0] = get_post_meta( get_the_ID(), 'sl_meta_video_url', true );
						endif;
			?>
						<a style="<?php print $zoom_icon_css; ?>" class="icon gallery-icon" href="<?php print $full_image[0]; ?>" rel="prettyPhoto[gallery_recent_<?php print $recent_works_counter; ?>]" title="<?php print get_post_field( 'post_content', get_post_thumbnail_id( get_the_ID() ) ); ?>">
							<img style="display:none;" alt="<?php print get_post_field( 'post_excerpt', get_post_thumbnail_id( get_the_ID() ) ); ?>" />
							<?php _e( 'Gallery', 'Salamander' ); ?>
						</a>
						<h3><?php print get_the_title(); ?></h3>
						<h4><?php print get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?></h4>
					</div>
				</div>
			</div>
<?php
			endif; ?>
		</div>
<?php
		endif;
	endwhile; wp_reset_query(); ?>
	</div>
</div>
