<?php get_header(); ?>
    <div id="content" class="<?php echo Salamander::classes('layout'); ?>">
      <div class="row">
        <div class="<?php echo Salamander::classes('main-content', 'main-content'); ?>">
          <div id="posts-container">
          <?php
            $post_count = 1;
            $prev_post_timestamp = null;
            $prev_post_month = null;
            $first_timeline_loop = false;
            while( have_posts() ) : the_post();
              $post_timestamp = strtotime( $post->post_date );
              $post_month = date( 'n', $post_timestamp );
              $post_year = get_the_date( 'o' );
              $current_date = get_the_date( 'o-n' );
          ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
              <?php
              if( Salamander::getData( 'featured_images' ) ):
                if( Salamander::getData( 'legacy_posts_slideshow' ) ) :
//                  get_template_part('legacy-slideshow');
                else :
//                  get_template_part('new-slideshow');
                endif;
              endif;
              ?>
              <div class="post-content-container">
              <?php if( Salamander::getData( 'blog_layout' ) != 'Large Alternate' && Salamander::getData( 'blog_layout' ) != 'Medium Alternate' && Salamander::getData( 'blog_layout' ) != 'Grid'  && Salamander::getData( 'blog_layout' ) != 'Timeline' ): ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <?php endif; ?>
                <div class="date-and-formats">
                  <div class="date-box">
                    <span class="date"><?php the_time('j'); ?></span>
                    <span class="month-year"><?php the_time('m, Y'); ?></span>
                  </div>
                  <div class="format-box">
                    <?php
                    switch(get_post_format()) {
                      case 'gallery':
                        $format_class = 'camera-retro';
                        break;
                      case 'link':
                        $format_class = 'link';
                        break;
                      case 'image':
                        $format_class = 'picture';
                        break;
                      case 'quote':
                        $format_class = 'quote-left';
                        break;
                      case 'video':
                        $format_class = 'film';
                        break;
                      case 'audio':
                        $format_class = 'headphones';
                        break;
                      case 'chat':
                        $format_class = 'comments-alt';
                        break;
                      default:
                        $format_class = 'book';
                        break;
                    }
                    ?>
                    <i class="icon-<?php echo $format_class; ?>"></i>
                  </div>
                </div>
                <div class="post-content">
                <?php if(Salamander::getData( 'blog_layout' ) == 'Large Alternate' || Salamander::getData( 'blog_layout' ) == 'Medium Alternate'  || Salamander::getData( 'blog_layout' ) == 'Grid' || Salamander::getData( 'blog_layout' ) == 'Timeline'): ?>
                  <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php endif; ?>
                <?php
                  if( Salamander::getData( 'content_length' ) == 'Excerpt' ) :
                    the_excerpt();
                   else :
                    the_content( '' );
                  endif;
                ?>
                </div>
              <?php if( Salamander::getData( 'post_meta' ) ): ?>
                <div class="meta-info">
                <?php if ( Salamander::getData( 'blog_layout' ) == 'Grid' || Salamander::getData( 'blog_layout' ) == 'Timeline' ): ?>
                  <div class="alignright">
                    <?php if ( !Salamander::getData( 'post_meta_comments' ) ): ?><?php comments_popup_link( '<i class="icon-comments"></i>&nbsp;'.__( '0', 'Avada' ), '<i class="icon-comments"></i>&nbsp;'.__('1', 'salamander'), '<i class="icon-comments"></i>&nbsp;'.'% '.__( '', 'salamander' ) ); ?><?php endif; ?>
                  </div>
                <?php else: ?>
                  <?php if(Salamander::getData( 'blog_layout' ) != 'Large Alternate' && Salamander::getData( 'blog_layout' ) != 'Medium Alternate'): ?>
                    <div class="alignleft">
                      <?php if( !Salamander::getData( 'post_meta_author' ) ): ?><?php echo __('By', 'Avada'); ?> <?php the_author_posts_link(); ?><span class="sep">|</span><?php endif; ?><?php if ( !Salamander::getData( 'post_meta_date' ) ): ?><?php the_time(Salamander::getData( 'date_format' ) ); ?><span class="sep">|</span><?php endif; ?><?php if(!Salamander::getData( 'post_meta_cats' )): ?><?php the_category(', '); ?><span class="sep">|</span><?php endif; ?><?php if(!Salamander::getData( 'post_meta_comments' )): ?><?php comments_popup_link(__('0 Comments', 'Avada'), __('1 Comment', 'Avada'), '% '.__('Comments', 'Avada')); ?><?php endif; ?>
                    </div>
                  <?php endif; ?>
                  <div class="alignright">
                    <?php if( !Salamander::getData( 'post_meta_read' ) ): ?><a href="<?php the_permalink(); ?>" class="read-more"><?php echo __('Read More', 'Avada'); ?></a><?php endif; ?>
                  </div>
                <?php endif; ?>
                </div>
              <?php endif; ?>
              </div>
            </div>
          <?php
            $prev_post_timestamp = $post_timestamp;
            $prev_post_month = $post_month;
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
