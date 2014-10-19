<?php $c_pageID = 0;
  if ( ( ( is_page() || is_single() || is_singular( 'salamander_portfolio' ) )
          && get_post_meta( $c_pageID, 'sl_meta_page_title', true ) != 'show' )
          || ( is_home() && !is_front_page() && get_post_meta( $slider_page_id, 'sl_meta_page_title', true) == 'show' ) ) : ?>
<div class="page-title-container container-fluid">
  <div class="page-title row">
    <div class="page-title-wrapper">
      <?php if( get_post_meta( $c_pageID, 'sl_meta_page_title_text', true) == 'show' ) : ?>
        <h1><?php the_title(); ?></h1>
      <?php endif; ?>
      <?php if ( Salamander::getData( 'breadcrumb' ) ): ?>
        <?php if ( Salamander::getData( 'page_title_bar_content' )  == 'breadcrumbs'): ?>
          <?php Salamander::breadcrumbs(); ?>
        <?php else: ?>
          <?php get_search_form(); ?>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if( is_search() ) : ?>
  <div class="page-title-container container-fluid">
    <div class="page-title row"
      <div class="page-title-wrapper">
        <h1><?php echo __('Search results for:', 'salamander'); ?> <?php echo get_search_query(); ?></h1>
        <?php get_search_form(); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if ( is_404() ) : ?>
  <div class="page-title-container container-fluid">
    <div class="page-title row"
      <div class="page-title-wrapper">
        <h1><?php echo __('Error 404 Page', 'salamander'); ?></h1>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if( is_archive() ) : ?>
  <div class="page-title-container container-fluid">
    <div class="page-title row"
      <div class="page-title-wrapper">
        <h1>
          <?php if ( is_day() ) : ?>
            <?php printf( __( 'Daily Archives: %s', 'salamander' ), '<span>' . get_the_date() . '</span>' ); ?>
          <?php elseif ( is_month() ) : ?>
            <?php printf( __( 'Monthly Archives: %s', 'salamander' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'salamander' ) ) . '</span>' ); ?>
          <?php elseif ( is_year() ) : ?>
            <?php printf( __( 'Yearly Archives: %s', 'salamander' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'salamander' ) ) . '</span>' ); ?>
          <?php elseif ( is_author() ) : ?>
            <?php echo get_query_var('author_name'); ?>
          <?php else : ?>
            <?php single_cat_title(); ?>
          <?php endif; ?>
        </h1>
        <?php if(Salamander::getData( 'breadcrumb' ) ): ?>
          <?php if(Salamander::getData( 'page_title_bar_content' )  == 'Breadcrumbs'): ?>
            <?php Salamander::breadcrumbs(); ?>
          <?php else: ?>
            <?php get_search_form(); ?>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php endif; ?>
