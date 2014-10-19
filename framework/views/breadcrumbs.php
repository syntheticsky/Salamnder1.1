<?php
$classes  = '';
if ( Salamander::getData( 'breadcrumb_position' ) )
  $classes .= 'pull-' . Salamander::getData( 'breadcrumb_position' );
if ( ! Salamander::getData( 'breadcrumb_mobile' ) )
  $classes .= ' hidden-xs hidden-sm';
?>
<ol class="breadcrumb <?php echo $classes; ?>">
<?php
  if ( !is_front_page() ) :
?>
  <li><?php echo Salamander::getData( 'breacrumb_prefix' ); ?>
    <a href="<?php echo home_url(); ?>"><?php _e('Home', 'salamander'); ?></a>
  </li>
<?php
  endif;

  $link_none = '';
  $separator = '';

  if (is_category() && !is_singular('salamander_portfolio')) :
  $category = get_the_category();
  $ID = $category[0]->cat_ID;
?>
  <?php if ( ! is_wp_error( $cat_parents = get_category_parents($ID, TRUE, '', FALSE ) ) ) : ?>
  <li><?php echo $cat_parents; ?></li>
  <?php endif; ?>
<? endif;

  if(is_singular( 'salamander_portfolio' ) ) :
  echo get_the_term_list($post->ID, 'portfolio_category', '<li>', '&nbsp;/&nbsp;&nbsp;', '</li>');
?>
  <li><?php echo get_the_title(); ?></li>
<?php endif;
  if (is_tax()) :
  $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>
  <li><?php echo $term->name; ?></li>
<?php endif;

  if(is_home()) : ?>
  <li><?php echo Salamander::getData( 'blog_title' ); ?></li>
<?php endif;
  if(is_page() && !is_front_page()) :
    $parents = array();
    $parent_id = $post->post_parent;
    while ( $parent_id ) :
      $page = get_page( $parent_id );
      if ( $link_none )
        $parents[]  = get_the_title( $page->ID );
      else
        $parents[]  = '<li><a href="' . get_permalink( $page->ID ) . '" title="' . get_the_title( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a></li>' . $separator;
      $parent_id  = $page->post_parent;
    endwhile;
  $parents = array_reverse( $parents );
  echo join( ' ', $parents ); ?>
  <li><?php echo get_the_title(); ?></li>
<?php endif;
  if(is_single() && !is_singular('salamander_portfolio')) :
    $categories_1 = get_the_category($post->ID);
    if($categories_1):
      foreach($categories_1 as $cat_1):
        $cat_1_ids[] = $cat_1->term_id;
      endforeach;
      $cat_1_line = implode(',', $cat_1_ids);
    endif;
    $categories = get_categories(array(
      'include' => $cat_1_line,
      'orderby' => 'id'
    ));
    if ( $categories ) :
      foreach ( $categories as $cat ) :
        $cats[] = '<li><a href="' . get_category_link( $cat->term_id ) . '" title="' . $cat->name . '">' . $cat->name . '</a></li>';
      endforeach;
      echo join( ' ', $cats );
    endif;?>
  <li><?php echo get_the_title(); ?></li>
<?php endif;
  if ( is_tag() ) :?>
  <li>Tag: <?php echo single_tag_title( '',FALSE ); ?></li>
<?php endif;
  if ( is_404() ) : ?>
  <li><?php _e( '404 - Page not Found', 'salamander' ); ?></li>
<?php endif;
  if ( is_search() ) : ?>
  <li><?php _e('Search', 'salamander'); ?></li>
<?php endif;
  if ( is_year() ) : ?>
  <li><?php echo get_the_time('Y'); ?></li>
<?php endif; ?>
</ol>