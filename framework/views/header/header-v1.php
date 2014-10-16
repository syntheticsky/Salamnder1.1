<header>
  <nav class="navbar navbar-default <?php if ( Salamander::getData( 'fixed_menu' ) ) : ?>navbar-fixed-top<?php endif;?>" role="navigation">
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
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'collapse navbar-collapse',
        'container_id'    => '',
        'menu_class'      => 'nav navbar-nav',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'link_to_menu_editor',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 0,
        'walker'          => '',
      );

      wp_nav_menu( $defaults );
      ?>
    </div>
  </nav>
</header>
