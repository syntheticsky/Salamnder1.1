<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

header('Content-Type: text/html; charset=utf-8');

require_once 'framework' . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'Krumo' . DIRECTORY_SEPARATOR . 'krumo.php';
/**
 * Define autoload function
 */
function salamanderAutoload($class_name) {
    //class directories
    $directories = array(
        'admin',
        'framework',
        // 'framework' . DIRECTORY_SEPARATOR . 'views',
        'framework' . DIRECTORY_SEPARATOR . 'libs',
        'framework' . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'Yaml',
//        'framework' . DIRECTORY_SEPARATOR . 'widgets',
//        'framework' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'kdMultipleFeaturedImages',
    );

    //for each directory
    foreach ( $directories as $dir ) {
      //see if the file exsists

      $file_name = (false !== strpos($class_name, 'Yaml'))
        ? $class_name . '.php'
        : 'class-' . str_replace('_', '-', strtolower($class_name)) . '.php';

      if( file_exists( get_template_directory() . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $file_name ) ) {
        require_once( get_template_directory() . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $file_name );
        return;
      }
    }
}
// Register autoload function
spl_autoload_register('salamanderAutoload');
//Init theme framework class
$salamander = Salamander::get_instance();
// Registe nav menus
add_action('init', array($salamander, 'registerNavMenus'));
// Register custom post types
add_action('init', array($salamander, 'registerPosts'));
//Register Basic Sidebars (widget zones)
add_action('init', array($salamander, 'registerSidebars'));
//Setup default options when theme enabled
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
  add_action('admin_head', array($salamander->init, 'optionsSetup'));
}
$salamander->setData();

add_action('admin_menu', array($salamander->init, 'initAdmin'));

require_once LIBS_PATH . 'mediauploader.php'; ///////////////////////

add_action('wp_ajax_options_post_action', array($salamander->init, 'ajaxCallback'));

add_action('admin_head', array($salamander->init, 'adminSetJs'));

add_action('init', 'mediauploader_init');

add_action('wp_enqueue_scripts', array($salamander->init, 'stylesheets'), 0, 1);
add_action('wp_enqueue_scripts', array($salamander->init, 'scripts'));

////set latest theme options to theme object
//if (!is_admin())
//{
//// print '<pre>';
//// $data = $salamander->getData();
//// print_r($data);
//// print '<pre>';
//}
//
//if(Salamander::getData('blog_layout') == 'Large Alternate' || Salamander::getData('blog_layout') == 'Medium Alternate') {
//    add_theme_support('post-formats', array('gallery', 'link', 'image', 'quote', 'video', 'audio', 'chat'));
//}
//
//if(class_exists('kdMultipleFeaturedImages')  && !Salamander::getData('legacy_posts_slideshow')) {
//  $i = 2;
//  while($i <= Salamander::getData('posts_slideshow_number')) {
//    $args = array(
//      'id' => 'featured-image-'.$i,
//      'post_type' => 'post',      // Set this to post or page
//      'labels' => array(
//        'name'=> 'Featured image '.$i,
//        'set' => 'Set featured image '.$i,
//        'remove' => 'Remove featured image '.$i,
//        'use' => 'Use as featured image '.$i,
//      )
//    );
//
//    new kdMultipleFeaturedImages($args);
//
//    $args = array(
//      'id' => 'featured-image-'.$i,
//      'post_type' => 'page',      // Set this to post or page
//      'labels' => array(
//        'name' => 'Featured image '.$i,
//        'set' => 'Set featured image '.$i,
//        'remove' => 'Remove featured image '.$i,
//        'use' => 'Use as featured image '.$i,
//      )
//    );
//
//    new kdMultipleFeaturedImages($args);
//
//    $args = array(
//      'id' => 'featured-image-'.$i,
//      'post_type' => 'avada_portfolio',      // Set this to post or page
//      'labels' => array(
//        'name' => 'Featured image '.$i,
//        'set' => 'Set featured image '.$i,
//        'remove' => 'Remove featured image '.$i,
//        'use' => 'Use as featured image '.$i,
//      )
//    );
//
//    new kdMultipleFeaturedImages($args);
//
//    $i++;
//  }
//}
//
////Add custom post views count
//add_action('wp_head', array($salamander->init, 'setPostViews'));
//
// Add post thumbnail functionality
add_theme_support('post-thumbnails');
add_image_size('blog-large', 669, 272, true);
add_image_size('blog-medium', 320, 202, true);
add_image_size('tabs-img', 52, 50, true);
add_image_size('related-img', 180, 138, true);
add_image_size('portfolio-one', 540, 272, true);
add_image_size('portfolio-two', 460, 295, true);
add_image_size('portfolio-three', 300, 214, true);
add_image_size('portfolio-four', 220, 161, true);
add_image_size('portfolio-full', 940, 400, true);
add_image_size('recent-posts', 700, 441, true);
add_image_size('recent-works-thumbnail', 66, 66, true);



/**
 * Menu fallback. Link to the menu editor if that is useful.
 *
 * @param  array $args
 * @return string
 */
function link_to_menu_editor( $args ) {
  if ( ! current_user_can( 'manage_options' ) ) {
    return;
  }
  extract( $args );

  $defaults = array( 'menu' => '', 'container' => 'div', 'container_class' => '', 'container_id' => '', 'menu_class' => 'menu', 'menu_id' => '',
    'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    'depth' => 0, 'walker' => '', 'theme_location' => '' );
  $args = wp_parse_args( $args, $defaults );

  $link = $link_before
    . '<a href="' . home_url() . '">' . $before . __('Home', 'salamander') . $after . '</a>'
    . $link_after;

  // We have a list
  if ( FALSE !== stripos( $items_wrap, '<ul' )
    || FALSE !== stripos( $items_wrap, '<ol' )
  ) {
    $link = "<li>$link</li>";
  }

  $output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
  if ( ! empty ( $container ) ) {
    $output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
  }

  if ( $echo ) {
    echo $output;
  }

  return $output;
}
