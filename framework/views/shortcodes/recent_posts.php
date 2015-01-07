<?php if( $layout == 'default' ): $attachment = ''; ?>
<div class="avada-container">
	<section class="columns columns-<?php print $columns; ?>" style="width:100%">
		<div class="holder">
<?php	$count = 1;
	while( $recent_posts->have_posts() ): $recent_posts->the_post(); ?>
			<article class="col">
		<?php
		if($thumbnail == "yes"):
			if( Salamander::getData( 'legacy_posts_slideshow' ) ):
				$args = array(
					'post_type' => 'attachment',
					'numberposts' => Salamander::getData( 'posts_slideshow_number' ) - 1,
					'post_status' => null,
					'post_mime_type' => 'image',
					'post_parent' => get_the_ID(),
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'exclude' => get_post_thumbnail_id()
				);
				$attachments = get_posts( $args );
			if( $attachments || has_post_thumbnail() || get_post_meta( get_the_ID(), 'sl_meta_video', true ) ): ?>
				<div class="flexslider floated-post-slideshow">';
					<ul class="slides">
		<?php	if( get_post_meta( get_the_ID(), 'sl_meta_video', true ) ): ?>
						<li class="full-video">
						<?php print get_post_meta(get_the_ID(), 'sl_meta_video', true); ?>
						</li>
		<?php	endif; ?>
		<?php	if( has_post_thumbnail() ):
						$attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'recent-posts' );
						$full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
						$attachment_data = wp_get_attachment_metadata( get_post_thumbnail_id() ); ?>
						<li>
							<a href="<?php print get_permalink( get_the_ID() ); ?>" rel="">
								<img src="<?php print $attachment_image[0]; ?>" alt="<?php print get_the_title(); ?>" />
							</a>
						</li>
		<?php	endif;
					if( Salamander::getData( 'posts_slideshow' ) ):
							foreach( $attachments as $attachment ):
								$attachment_image = wp_get_attachment_image_src( $attachment->ID, 'recent-posts' );
								$full_image = wp_get_attachment_image_src( $attachment->ID, 'full' );
								$attachment_data = wp_get_attachment_metadata( $attachment->ID ); ?>
						<li>
							<a href="<?php print get_permalink( get_the_ID() ); ?>" rel="">
								<img src="<?php print $attachment_image[0]; ?>" alt="<?php print $attachment->post_title; ?>" />
							</a>
						</li>
				<?php endforeach;
					endif; ?>
					</ul>
				</div>
	<?php	endif;
			else:
				if( has_post_thumbnail() || get_post_meta( get_the_ID(), 'sl_meta_video', true ) ): ?>
				<div class="flexslider floated-post-slideshow">
					<ul class="slides">
		<?php	if( get_post_meta( get_the_ID(), 'sl_meta_video', true ) ): ?>
						<li class="full-video">
						<?php print get_post_meta( get_the_ID(), 'sl_meta_video', true ); ?>
						</li>
		<?php endif;
					if( has_post_thumbnail() ):
							$attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'recent-posts' );
							$full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
							$attachment_data = wp_get_attachment_metadata( get_post_thumbnail_id() ); ?>
						<li>
							<a href="<?php print get_permalink( get_the_ID() ); ?>" rel="">
								<img src="<?php print $attachment_image[0]; ?>" alt="<?php print get_the_title(); ?>" />
							</a>
						</li>
		<?php	endif;
					if( Salamander::getData( 'posts_slideshow' ) ):
						$i = 2;
						while( $i <= Salamander::getData( 'posts_slideshow_number' ) ):
							$attachment_new_id = kd_mfi_get_featured_image_id( 'featured-image-' . $i, 'post' );
								if( $attachment_new_id ):
									$attachment_image = wp_get_attachment_image_src( $attachment_new_id, 'recent-posts' );
									$full_image = wp_get_attachment_image_src( $attachment_new_id, 'full' );
									$attachment_data = wp_get_attachment_metadata( $attachment_new_id ); ?>
						<li>
							<a href="<?php print get_permalink( get_the_ID() ); ?>" rel="">
								<img src="<?php print $attachment_image[0]; ?>" alt="" />
							</a>
						</li>
					<?php	endif; $i++;
						endwhile;
					endif; ?>
					</ul>
				</div>
	<?php endif;
			endif;
		endif;
		if($title == "yes"): ?>
				<h4>
					<a href="<?php print get_permalink( get_the_ID() ); ?>"><?php print get_the_title(); ?></a>
				</h4>
<?php
		endif;
		if ( $meta == "yes" ): ?>
				<ul class="meta">
					<li>
						<em class="date"><?php print get_the_time( Salamander::getData( 'date_format' ), get_the_ID() );?> </em>
					</li>
<?php if( get_comments_number( get_the_ID() ) >= 1 ): ?>
					<li>
						<a href="<?php print get_permalink( get_the_ID() ); ?>"><?php print get_comments_number( get_the_ID() ); ?> <?php _e( 'Comments', 'Salamander' ); ?></a>
					</li>
<?php endif; ?>
        </ul>
<?php
		endif;
		if( $excerpt == "yes" ) : ?>
				<p><?php print tf_content( $excerpt_words, $strip_html ); ?></p>
<?php
		endif; ?>
			</article>
	<?php $count++;
	endwhile; ?>
		</div>
	</section>
</div>
<?php elseif( $layout == 'thumbnails-on-side' ): $attachment = ''; ?>
<div class="avada-container layout-<?php print $layout; ?> layout-columns-<?php print $columns; ?>">
	<section class="columns columns-<?php print $columns; ?>" style="width:100%">';
		<div class="holder">
<?php $count = 1;
	while( $recent_posts->have_posts() ): $recent_posts->the_post(); ?>
			<article class="col clearfix">
<?php
		if ( $thumbnail == "yes" ):
			if( Salamander::getData( 'legacy_posts_slideshow' ) ):
				$args = array(
					'post_type' => 'attachment',
					'numberposts' => Salamander::getData( 'posts_slideshow_number' ) - 1,
					'post_status' => null,
					'post_mime_type' => 'image',
					'post_parent' => get_the_ID(),
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'exclude' => get_post_thumbnail_id()
				);
				$attachments = get_posts( $args );
				if ( $attachments || has_post_thumbnail() || get_post_meta(get_the_ID(), 'sl_meta_video', true ) ): ?>
				<div class="flexslider floated-post-slideshow">
					<ul class="slides">
		<?php if ( get_post_meta(get_the_ID(), 'sl_meta_video', true ) ): ?>
						<li class="full-video">
						<?php print get_post_meta( get_the_ID(), 'sl_meta_video', true ); ?>
						</li>
		<?php	endif; ?>
		<?php if ( has_post_thumbnail() ):
						$attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'portfolio-two' );
						$full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
						$attachment_data = wp_get_attachment_metadata( get_post_thumbnail_id() ); ?>
						<li>
							<a href="<?php print get_permalink( get_the_ID() ); ?>" rel="">
								<img src="<?php print $attachment_image[0]; ?>" alt="<?php print get_the_title(); ?>" />
							</a>
						</li>
		<?php endif;
					if ( Salamander::getData( 'posts_slideshow' ) ):
						foreach ( $attachments as $attachment ):
							$attachment_image = wp_get_attachment_image_src( $attachment->ID, 'portfolio-two' );
							$full_image = wp_get_attachment_image_src( $attachment->ID, 'full' );
							$attachment_data = wp_get_attachment_metadata( $attachment->ID ); ?>
						<li>
							<a href="<?php print get_permalink( get_the_ID() ); ?>" rel="">
								<img src="<?php print $attachment_image[0]; ?>" alt="<?php print $attachment->post_title; ?>" />
							</a>
						</li>
			<?php	endforeach;
					endif; ?>
					</ul>
				</div>
	<?php	endif;
			else:
				if ( has_post_thumbnail() || get_post_meta(get_the_ID(), 'sl_meta_video', true ) ): ?>
				<div class="flexslider floated-post-slideshow">
					<ul class="slides">
		<?php	if ( get_post_meta( get_the_ID(), 'sl_meta_video', true ) ): ?>
						<li class="full-video">
						<?php print get_post_meta( get_the_ID(), 'sl_meta_video', true ); ?>
						</li>
		<?php	endif;
					if ( has_post_thumbnail() ):
						$attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'portfolio-two' );
						$full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
						$attachment_data = wp_get_attachment_metadata( get_post_thumbnail_id() ); ?>
						<li>
							<a href="<?php print get_permalink( get_the_ID() ); ?>" rel="">
								<img src="<?php print $attachment_image[0]; ?>" alt="<?php print get_the_title(); ?>" />
							</a>
						</li>
		<?php endif;
					if ( Salamander::getData( 'posts_slideshow' ) ):
						$i = 2;
						while ( $i <= Salamander::getData( 'posts_slideshow_number' ) ):
							$attachment_new_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post');
							if ( $attachment_new_id ):
								$attachment_image = wp_get_attachment_image_src( $attachment_new_id, 'portfolio-two' );
								$full_image = wp_get_attachment_image_src( $attachment_new_id, 'full' );
								$attachment_data = wp_get_attachment_metadata( $attachment_new_id ); ?>
						<li>
							<a href="<?php print get_permalink( get_the_ID() ); ?>" rel="">
								<img src="<?php print $attachment_image[0]; ?>" alt="" />
							</a>
						</li>
				<?php	endif; $i++;
						endwhile;
					endif; ?>
					</ul>
				</div>
	<?php	endif;
			endif;
		endif; ?>
				<div class="recent-posts-content">
<?php
		if ( $title == "yes" ): ?>
					<h4>
						<a href="<?php print get_permalink( get_the_ID() ); ?>"><?php print get_the_title(); ?></a>
					</h4>
<?php
		endif;
		if ( $meta == "yes" ): ?>
					<ul class="meta">
						<li><?php print get_the_time( Salamander::getData( 'date_format' ), get_the_ID() ); ?></li>
<?php if ( get_comments_number( get_the_ID() ) >= 1): ?>
						<li>
							<a href="<?php print get_permalink( get_the_ID() ); ?>"><?php print get_comments_number( get_the_ID() ); ?> <?php _( 'Comments', 'Salamander' ); ?></a>
						</li>
<?php endif; ?>
					</ul>
<?php
		endif;
		if ( $excerpt == "yes" ):
			print tf_content( $excerpt_words, $strip_html );
		endif; ?>
				</div>
			</article>
<?php $count++;
	endwhile; ?>
		</div>
	</section>
</div>
<?php elseif ( $layout == 'date-on-side' ): $attachment = ''; ?>
<div class="avada-container layout-<?php print $layout; ?> layout-columns-<?php print $columns; ?>">
	<section class="columns columns-'.$atts['columns'].'" style="width:100%">
		<div class="holder">
<?php $count = 1;
	while ( $recent_posts->have_posts() ): $recent_posts->the_post(); ?>
			<article class="col clearfix">
				<div class="date-and-formats">
					<div class="date-box">
						<span class="date"><?php print get_the_time( 'j' ); ?></span>
						<span class="month-year"><?php get_the_time( 'm, Y' ); ?></span>
					</div>
					<div class="format-box">
<?php
	$formats = array(
		'gallery' => 'camera-retro',
		'link' => 'link',
	 	'image' => 'picture',
	 	'quote' => 'quote-left',
	 	'video' => 'film',
	 	'audio' => 'headphones',
	 	'chat' => 'comments-alt',
	);
	$post_format = get_post_format();
	if ( in_array( $post_format, $formats ) ) $format_class = $formats[$post_format];
	else $format_class = 'book'; ?>
						<i class="icon-<?php print $format_class; ?>"></i>
					</div>
				</div>
				<div class="recent-posts-content">
<?php
		if( $title == "yes" ): ?>
					<h4>
						<a href="<?php print get_permalink( get_the_ID() ); ?>"><?php print get_the_title(); ?></a>
					</h4>
<?php
		endif;
		if ( $meta == "yes" ): ?>
					<ul class="meta">
						<li><?php print get_the_time( Salamander::getData( 'date_format' ), get_the_ID() ); ?></li>
<?php if ( get_comments_number( get_the_ID() ) >= 1): ?>
						<li>
							<a href="<?php print get_permalink( get_the_ID() ); ?>"><?php print get_comments_number( get_the_ID() ); ?> <?php _e( 'Comments', 'Salamander' ); ?></a>
						</li>
<?php	endif; ?>
					</ul>
<?php
		endif;
		if ( $excerpt == "yes" ):
			print tf_content( $excerpt_words, $strip_html );
		endif; ?>
				</div>
			</article>
<?php $count++;
	endwhile; ?>
		</div>
	</section>
</div>
<?php	endif; ?>
