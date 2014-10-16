<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-default" role="navigation">
    <div class="<?php print Salamander::classes('data', 'layout_type', 'container'); ?>">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <?php
      $defaults = array(
        'theme_location'  => 'main_navigation',
        'container'       => 'div',
        'container_class' => 'collapse navbar-collapse',
        'menu_class'      => 'nav navbar-nav',
        'echo'            => true,
        'menu_id'         => 'nav',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 0,
      );

      wp_nav_menu( $defaults );
      ?>
    </div>
  </nav>
</header>
