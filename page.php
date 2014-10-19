<?php get_header(); ?>
	<?php
    if( class_exists( 'Woocommerce' ) ) :
	 	  if ( is_cart() || is_checkout() || is_account_page() || is_page( get_option( 'woocommerce_thanks_page_id' ) ) ) :
	 		  $content_css = 'width:100%';
	 		  $sidebar_css = 'display:none';
	 	  endif;
	  endif;
	?>
<div class="container">
  <div class="row">
    <div class="main-content">
			<?php if( have_posts() ): the_post(); ?>
      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php if ( !Salamander::getData( 'featured_images_pages' ) && has_post_thumbnail() ): ?>
        <div class="image">
          <?php the_post_thumbnail( 'blog-large' ); ?>
        </div>
        <?php endif; ?>
        <div class="post-content">
          <?php the_content(); ?>
          <?php wp_link_pages(); ?>
        </div>
        <?php if ( class_exists( 'Woocommerce' ) ) : ?>
          <?php if ( Salamander::getData( 'comments_pages' ) && !is_cart() && !is_checkout() && !is_account_page() && !is_page( get_option( 'woocommerce_thanks_page_id' ) ) ): ?>
            <?php wp_reset_query(); ?>
            <?php comments_template(); ?>
          <?php endif; ?>
        <?php else: ?>
          <?php if ( Salamander::getData( 'comments_pages' ) ) : ?>
            <?php wp_reset_query(); ?>
            <?php comments_template(); ?>
          <?php endif; ?>
        <?php endif; ?>
      </div>
      <?php endif; ?>
			</div>
      <?php if ( Salamander::getData( 'blog_sidebar_position' ) == 'left' || Salamander::getData( 'blog_sidebar_position' ) == 'both' ) : ?>
        <aside id="left-sidebar" class="<?php print Salamander::classes( 'blog_sidebar_position', 'left-sidebar' )?>">
          <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Blog Left Sidebar' ) ): endif; ?>
        </aside>
      <?php endif;?>
      <?php if ( Salamander::getData( 'blog_sidebar_position' ) == 'right' || Salamander::getData( 'blog_sidebar_position' ) == 'both' ) : ?>
        <aside id="right-sidebar" class="<?php print Salamander::classes( 'blog_sidebar_position', 'right-sidebar' )?>">
          <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Blog Right Sidebar' ) ): endif; ?>
        </aside>
      <?php endif;?>
		</div>
	</div>
<?php get_footer(); ?>
