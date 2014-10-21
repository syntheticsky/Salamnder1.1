<div class="top-nav">
<?php
  $defaults = array(
    'theme_location'  => 'top_navigation',
    'echo'            => true,
    'fallback_cb'     => false,
    'depth'           => 2,
  );

  wp_nav_menu( $defaults );
?>
</div>