<?php get_header(); ?>
    <div id="content" class="<?php print Salamander::classes('layout'); ?>">
      <div class="row">
        <div class="<?php print Salamander::classes('main-content', 'main-content'); ?>">
        <?php if ( Salamander::getData( 'blog_layout' ) == 'timeline'): ?>
          <div class="timeline-icon<?php print $timeline_icon_class; ?>">
            <i class="fusionicon-bubbles"></i>
          </div>
        <?php endif; ?>
          <div id="posts-container">
          <?php
            $post_count = 1;
            $prev_timestamp = null;
            $prev_month = null;
            $first_timeline_loop = false;
            while( have_posts() ) : the_post();
              $post_timestamp = strtotime( $post->post_date );
              $post_month = date( 'n', $post_timestamp );
              $post_year = get_the_date( 'o' );
              $current_date = get_the_date( 'o-n' );
          ?>
            <?php if ( Salamander::getData( 'blog_layout' ) == 'timeline'): ?>
              <?php if ( $prev_month != $post_month || $prev_year != $post_year ): ?>
                <div class="timeline-date">
                  <h3 class="timeline-title"><?php print get_the_date( Salamander::getData( 'timeline_date_format' ) ); ?></h3>
                </div>
              <?php endif; ?>
            <?php endif; ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
              <?php if ( Salamander::getData( 'blog_layout' ) == 'medium_alt' ): ?>
              <?php //print avada_post_date_and_format_box(); ?>
              <?php endif; ?>
              <?php
              if ( Salamander::getData( 'featured_images' ) ):
                //get_template_part('new-slideshow');
              endif;
              ?>
              <div class="post-container">
              <?php if ( Salamander::getData( 'blog_layout' ) == 'timeline' ): ?>
                <div class="timeline-circle"></div>
                <div class="timeline-arrow"></div>
              <?php endif; ?>
              <?php if ( ! in_array( Salamander::getData( 'blog_layout' ), array( 'large_alt', 'medium_alt', 'grid', 'timeline' ) ) ): ?>
                <h2<?php if( ! Salamander::getData( 'disable_date_rich_snippet_pages' ) ) print ' class="entry-title"'; ?>>
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
              <?php endif; ?>
              <?php if ( Salamander::getData( 'blog_layout' ) == 'large_alt'): ?>
                <?php //print avada_post_date_and_format_box(); ?>
              <?php endif; ?>
                <div class="post-content">
                <?php if ( in_array( Salamander::getData( 'blog_layout' ), array( 'large_alt', 'medium_alt', 'grid', 'timeline' ) ) ): ?>
                  <h2 class="post-title<?php if( ! Salamander::getData( 'disable_date_rich_snippet_pages' ) ) print ' entry-title'; ?>">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </h2>
                  <?php
                  // if ( in_array( Salamander::getData( 'blog_layout' ), array( 'grid', 'timeline' ) ) )
                    // print avada_render_post_metadata( 'grid_timeline' );
                  // else
                    // print avada_render_post_metadata( 'alternate' );
                  ?>
                <?php endif; ?>
                <?php if( ( ! Salamander::getData( 'post_meta' ) && Salamander::getData( 'excerpt_length_blog' ) == 0 )
                          || ( Salamander::getData( 'post_meta_author' ) && Salamander::getData( 'post_meta_date' )
                              && Salamander::getData( 'post_meta_cats' ) && Salamander::getData( 'post_meta_tags' )
                              && Salamander::getData( 'post_meta_comments' )
                              && Salamander::getData( 'post_meta_read' ) && Salamander::getData( 'excerpt_length_blog' ) == 0 ) ): ?>
                  <?php if( ! Salamander::getData( 'post_meta' ) ): ?>
                  <div class="no-content-sep"></div>
                  <?php endif; ?>
                <?php else: ?>
                  <div class="content-sep"></div>
                <?php endif; ?>
                </div>
                <?php
                // if ( Salamander::getData( 'content_length' ) == 'excerpt' )
                //   print tf_content( Salamander::getData( 'excerpt_length_blog' ), Salamander::getData( 'strip_html_excerpt' ) );
                // else
                  the_content('');
                ?>
              </div>
              <div class="fusion-clearfix"></div>
              <?php if ( Salamander::getData( 'post_meta' ) ): ?>
              <div class="meta-info">
                <?php if ( in_array( Salamander::getData( 'blog_layout' ), array( 'grid', 'timeline' ) ) ): ?>
                  <?php if ( ! in_array( Salamander::getData( 'blog_layout' ), array( 'large_alt', 'medium_alt' ) ) ): ?>
                <div class="alignleft">
                    <?php if ( ! Salamander::getData( 'post_meta_read' ) ): ?>
                  <a href="<?php the_permalink(); ?>" class="read-more"><?php _e('Read More', 'Salamander'); ?></a>
                    <?php endif; ?>
                </div>
                  <?php endif; ?>
                <div class="alignright">
                  <?php if ( ! Salamander::getData( 'post_meta_comments' ) ): ?>
                  <?php comments_popup_link('<i class="fusionicon-bubbles"></i>&nbsp;'.__('0', 'Salamander'), '<i class="fusionicon-bubbles"></i>&nbsp;'.__('1', 'Salamander'), '<i class="fusionicon-bubbles"></i>&nbsp;'.'%'); ?>
                  <?php endif; ?>
                </div>
                <?php else: ?>
                <?php if ( ! in_array( Salamander::getData( 'blog_layout' ), array( 'large_alt', 'medium_alt' ) ) ): ?>
                <?php //echo avada_render_post_metadata( 'standard' ); ?>
                <?php endif; ?>
                <div class="alignright">
                  <?php if ( ! Salamander::getData( 'post_meta_read' ) ): ?>
                  <a href="<?php the_permalink(); ?>" class="read-more"><?php _e('Read More', 'Salamander'); ?></a>
                  <?php endif; ?>
                </div>
                <?php endif; ?>
              </div>
              <?php endif; ?>
            </div>
          <?php
            $prev_timestamp = $post_timestamp;
            $prev_month = $post_month;
            $post_count++;
            endwhile;
          ?>
          </div>
          <?php //themefusion_pagination($pages = '', $range = 2); ?>
        </div>
        <?php if ( Salamander::getData( 'blog_sidebar_position' ) == 'left' || Salamander::getData( 'blog_sidebar_position' ) == 'both' ) : ?>
          <aside id="left-sidebar" class="<?php print Salamander::classes('blog_sidebar_position', 'left-sidebar')?>">
            <?php
            if ( is_home() ) :
              $name = get_post_meta( get_option( 'page_for_posts' ), 'salamander_selected_sidebar_replacement', true );
              if( $name[0] ) :
                $salamander->getSidebar( $name[0] );
              else :
                if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Blog Left Sidebar' ) ) : endif;
              endif;
            endif;
            ?>
          </aside>
        <?php endif;?>
        <?php if ( Salamander::getData( 'blog_sidebar_position' ) == 'right' || Salamander::getData( 'blog_sidebar_position' ) == 'both' ) : ?>
          <aside id="right-sidebar" class="<?php print Salamander::classes( 'blog_sidebar_position', 'right-sidebar' )?>">
            <?php
            if ( is_home() && Salamander::getData( 'blog_sidebar_position' ) != 'both' ) :
              $name = get_post_meta( get_option( 'page_for_posts' ), 'salamander_selected_sidebar_replacement', true );
              if( $name[0] ) :
                $salamander->getSidebar( $name[0] );
              else :
                if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Blog Right Sidebar' ) ): endif;
              endif;
            endif;
            ?>
          </aside>
        <?php endif;?>
      </div>
	  </div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
