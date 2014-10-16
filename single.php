<?php get_header(); ?>
<?php
	$content_css = $sidebar_css = '';

	if(get_post_meta($post->ID, 'sl_meta_full_width', true) == true) {
		$content_css = 'width:100%';
		$sidebar_css = 'display:none';
	}
	elseif (get_post_meta($post->ID, 'sl_meta_sidebar_position', true) == 'left') {
		$content_css = 'float:right;';
		$sidebar_css = 'float:left;';
	} elseif (get_post_meta($post->ID, 'sl_meta_sidebar_position', true) == 'right') {
		$content_css = 'float:left;';
		$sidebar_css = 'float:right;';
	} elseif (get_post_meta($post->ID, 'sl_meta_sidebar_position', true) == 'default') {
		if(Salamander::getData('default_sidebar_pos') == 'Left') {
			$content_css = 'float:right;';
			$sidebar_css = 'float:left;';
		} elseif (Salamander::getData('default_sidebar_pos') == 'Right') {
			$content_css = 'float:left;';
			$sidebar_css = 'float:right;';
		}
	}
	?>
	<div class="container">
		<div class="row">
			<div class="main-content">
				<?php
					wp_reset_query();
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	    		query_posts($query_string . '&paged=' . $paged);
	    	?>
	    	<?php if(!Salamander::getData('blog_pn_nav')): ?>
		    <div class="single-navigation clearfix">
		      <?php previous_post_link( '%link', __( 'Previous', 'salamander' ) ); ?>
		      <?php next_post_link( '%link', __( 'Next', 'salamander' ) ); ?>
		    </div>
		    <?php endif; ?>
		    <?php if(have_posts()): the_post(); ?>
		    <div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
		    	<?php if ((!Salamander::getData('legacy_posts_slideshow') && !Salamander::getData('posts_slideshow')) && get_post_meta($post->ID, 'sl_meta_video', true)): ?>
		  <!--
		  		<div class="flexslider post-slideshow">
		        <ul class="slides">
		          <li class="full-video">
		            <?php print get_post_meta($post->ID, 'sl_meta_video', true); ?>
		          </li>
		        </ul>
		      </div>
		  -->
		    	<?php endif; ?>
  		<?php if ( Salamander::getData( 'featured_images_single' ) ) : ?>
  			<?php if ( Salamander::getData('legacy_posts_slideshow' ) ) : ?>
  				<?php
  					$args = array(
		          'post_type' => 'attachment',
		          'numberposts' => Salamander::getData( 'posts_slideshow_number' ) - 1,
		          'post_status' => null,
		          'post_parent' => $post->ID,
			        'orderby' => 'menu_order',
			        'order' => 'ASC',
			        'post_mime_type' => 'image',
			        'exclude' => get_post_thumbnail_id()
			      );
			      $attachments = get_posts($args);
  				?>
  				<?php if ( ( has_post_thumbnail() || get_post_meta( $post->ID, 'sl_meta_video', true ) ) ) : ?>
  					<div class="flexslider post-slideshow">
			        <ul class="slides">
		          <?php if ( get_post_meta( $post->ID, 'sl_meta_video', true ) ) : ?>
			          <li class="full-video">
			          	<?php print get_post_meta( $post->ID, 'sl_meta_video', true ); ?>
			          </li>
			          <?php endif; ?>
			          <?php if( has_post_thumbnail() && !get_post_meta( $post->ID, 'sl_meta_video', true ) ) : ?>
				          <?php
				          	$attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				          	$full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				          	$attachment_data = wp_get_attachment_metadata( get_post_thumbnail_id() );
				          ?>
			          <li>
			            <a href="<?php print $full_image[0]; ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php print get_post_field('post_content', get_post_thumbnail_id()); ?>">
                    <img src="<?php print $attachment_image[0]; ?>" alt="<?php print get_post_field( 'post_excerpt', get_post_thumbnail_id() ); ?>" />
                  </a>
			          </li>
			          <?php endif; ?>
			          <?php if( Salamander::getData( 'posts_slideshow' ) ) : ?>
			          <?php foreach ( $attachments as $attachment ) : ?>
				          <?php
				          	$attachment_image = wp_get_attachment_image_src( $attachment->ID, 'full' );
				          	$full_image = wp_get_attachment_image_src( $attachment->ID, 'full' );
				          	$attachment_data = wp_get_attachment_metadata( $attachment->ID );
				          ?>
			          <li>
			            <a href="<?php print $full_image[0]; ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php print get_post_field('post_content', $attachment->ID); ?>"><img src="<?php print $attachment_image[0]; ?>" alt="<?php print get_post_field('post_content', $attachment->ID); ?>" /></a>
			          </li>
			          <?php endforeach; ?>
			        <?php endif; ?>
			        </ul>
			      </div>
			    <?php endif; ?>
			  <?php else : ?>
			  	<?php if ( ( has_post_thumbnail() || get_post_meta($post->ID, 'sl_meta_video', true ) ) ) : ?>
			      <div class="flexslider post-slideshow">
			        <ul class="slides">
			          <?php if ( get_post_meta( $post->ID, 'sl_meta_video', true ) ) : ?>
			          <li class="full-video">
			            <?php echo get_post_meta( $post->ID, 'sl_meta_video', true ); ?>
			          </li>
			          <?php endif; ?>
			          <?php if ( has_post_thumbnail() && !get_post_meta( $post->ID, 'sl_meta_video', true ) ) : ?>
			          <?php
			          	$attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			            $full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			            $attachment_data = wp_get_attachment_metadata( get_post_thumbnail_id() );
			          ?>
			          <li>
			            <a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_content', get_post_thumbnail_id()); ?>">
                    <img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_field( 'post_excerpt', get_post_thumbnail_id() ); ?>" />
                  </a>
			          </li>
			          <?php endif; ?>
	          <?php if ( Salamander::getData('posts_slideshow' ) ) : ?>
		          <?php $i = 2; ?>
		          <?php while($i <= Salamander::getData( 'posts_slideshow_number' ) ) : ?>
		          	<?php $attachment_new_id = kd_mfi_get_featured_image_id( 'featured-image-'.$i, 'post' ); ?>
		          	<?php if ( $attachment_new_id ) : ?>
					      	<?php
					      		$attachment_image = wp_get_attachment_image_src( $attachment_new_id, 'full' );
					          $full_image = wp_get_attachment_image_src( $attachment_new_id, 'full' );
					          $attachment_data = wp_get_attachment_metadata( $attachment_new_id );
		          		?>
			          <li>
			            <a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_content', $attachment_new_id); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_field('post_content', $attachment_new_id); ?>" /></a>
			          </li>
		          	<?php endif; ?>
		          	<?php $i++; ?>
		          <?php endwhile; ?>
	          <?php endif; ?>
			        </ul>
			      </div>
			    <?php endif; ?>
			  <?php endif; ?>
			<?php endif; ?>
					<?php if ( Salamander::getData( 'blog_post_title' ) ): ?>
		      	<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		      <?php endif; ?>
		      	<div class="post-content">
			        <?php the_content(); ?>
			        <?php wp_link_pages(); ?>
			      </div>
			    <?php if( Salamander::getData( 'post_meta' ) ) : ?>
		      <div class="meta-info">
		        <div class="alignleft">
		          <?php if ( ! Salamander::getData( 'post_meta_author' ) ) : ?><span class="vcard author"><?php echo __('By', 'Avada'); ?> <?php the_author_posts_link(); ?></span><span class="sep">|</span><?php endif; ?><?php if(!Salamander::getData('post_meta_date')): ?><?php the_time(Salamander::getData('date_format')); ?><span class="sep">|</span><?php endif; ?><?php if(!Salamander::getData('post_meta_cats')): ?><?php the_category(', '); ?><span class="sep">|</span><?php endif; ?><?php if ( ! Salamander::getData( 'post_meta_comments' ) ) : ?><?php comments_popup_link( __( '0 Comments', 'salamander' ), __( '1 Comment', 'salamander' ), '% '.__( 'Comments', 'salamander' ) ); ?><?php endif; ?>
		        </div>
		      </div>
		      <?php endif; ?>
		      <?php if ( Salamander::getData( 'social_sharing_box' ) ) : ?>
		      <div class="share-box">
		        <h4><?php echo __( 'Share This Story, Choose Your Platform!', 'salamander' ); ?></h4>
		        <ul class="social-networks social-networks-<?php echo strtolower( Salamander::getData( 'socialbox_icons_color' ) ); ?>">
		          <?php if ( Salamander::getData( 'sharing_facebook' ) ) : ?>
		          <li class="facebook">
		            <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>">
		              Facebook
		            </a>
		            <div class="popup">
		              <div class="holder">
		                <p>Facebook</p>
		              </div>
		            </div>
		          </li>
		          <?php endif; ?>
		          <?php if ( Salamander::getData( 'sharing_twitter' ) ) : ?>
		          <li class="twitter">
		            <a href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>">
		              Twitter
		            </a>
		            <div class="popup">
		              <div class="holder">
		                <p>Twitter</p>
		              </div>
		            </div>
		          </li>
		          <?php endif; ?>
		          <?php if ( Salamander::getData( 'sharing_linkedin' ) ) : ?>
		          <li class="linkedin">
		            <a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>">
		              LinkedIn
		            </a>
		            <div class="popup">
		              <div class="holder">
		                <p>LinkedIn</p>
		              </div>
		            </div>
		          </li>
		          <?php endif; ?>
		          <?php if( Salamander::getData( 'sharing_reddit' ) ) : ?>
		          <li class="reddit">
		            <a href="http://reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>">
		              Reddit
		            </a>
		            <div class="popup">
		              <div class="holder">
		                <p>Reddit</p>
		              </div>
		            </div>
		          </li>
		          <?php endif; ?>
		          <?php if ( Salamander::getData( 'sharing_tumblr' ) ) : ?>
		          <li class="tumblr">
		            <a href="http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink()); ?>&amp;name=<?php echo urlencode($post->post_title); ?>&amp;description=<?php echo urlencode(get_the_excerpt()); ?>">
		              Tumblr
		            </a>
		            <div class="popup">
		              <div class="holder">
		                <p>Tumblr</p>
		              </div>
		            </div>
		          </li>
		          <?php endif; ?>
		          <?php if ( Salamander::getData('sharing_google' ) ) : ?>
		          <li class="google">
		            <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
		  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
		              Google +1
		            </a>
		            <div class="popup">
		              <div class="holder">
		                <p>Google +1</p>
		              </div>
		            </div>
		          </li>
		          <?php endif; ?>
		          <?php if ( Salamander::getData('sharing_pinterest' ) ) : ?>
		          <li class="pinterest">
		            <?php $full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
		            <a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink() ); ?>&amp;description=<?php echo urlencode($post->post_title); ?>&amp;media=<?php echo urlencode( $full_image[0] ); ?>">
		              Pinterest
		            </a>
		            <div class="popup">
		              <div class="holder">
		                <p>Pinterest</p>
		              </div>
		            </div>
		          </li>
		          <?php endif; ?>
		          <?php if ( Salamander::getData( 'sharing_email' ) ) : ?>
		          <li class="email">
		            <a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>">
		              Email
		            </a>
		            <div class="popup">
		              <div class="holder">
		                <p>Email</p>
		              </div>
		            </div>
		          </li>
		          <?php endif; ?>
		        </ul>
		      </div>
		      <?php endif; ?>
		      <?php if ( Salamander::getData( 'author_info' ) ) : ?>
		      <div class="about-author">
		        <div class="title"><h2><?php echo __( 'About the Author:', 'salamander' ); ?> <?php the_author_posts_link(); ?></h2><div class="title-sep-container"><div class="title-sep"></div></div></div>
		        <div class="about-author-container">
		          <div class="avatar">
		            <?php echo get_avatar( get_the_author_meta( 'email' ), '72' ); ?>
		          </div>
		          <div class="description">
		            <?php the_author_meta( 'description' ); ?>
		          </div>
		        </div>
		      </div>
		      <?php endif; ?>
		      <?php if ( Salamander::getData( 'related_posts' ) ) : ?>
<!-- page-part.php -->
		      <?php endif; ?>
		    	<?php if( Salamander::getData( 'blog_comments' ) ) : ?>
		        <?php wp_reset_query(); ?>
		        <?php comments_template(); ?>
		      <?php endif; ?>
		    </div>
		    <?php endif; ?>
			</div>
      <?php if ( Salamander::getData( 'blog_sidebar_position' ) == 'left' || Salamander::getData( 'blog_sidebar_position' ) == 'both' ) : ?>
        <aside id="left-sidebar" class="<?php print Salamander::classes( 'data', 'blog_sidebar_position', 'left-sidebar' ); ?>">
          <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Blog Left Sidebar' ) ) : endif; ?>
        </aside>
      <?php endif;?>
			<?php if ( Salamander::getData( 'blog_sidebar_position' ) == 'right' || Salamander::getData ( 'blog_sidebar_position' ) == 'both' ) : ?>
			<aside id="right-sidebar" class="<?php print Salamander::classes( 'data', 'blog_sidebar_position', 'right-sidebar' ); ?>">
        <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Blog Right Sidebar' ) ) : endif; ?>
      </aside>
			<?php endif;?>
		</div>
	</div>
<?php get_footer(); ?>
