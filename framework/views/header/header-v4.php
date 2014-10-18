<header class="header-<?php echo Salamander::getData( 'header_layout' ); ?>">
  <div class="navbar navbar-default <?php if ( Salamander::getData( 'fixed_menu' ) ) : ?>navbar-fixed-top<?php endif;?>" role="navigation">
    <div class="<?php print Salamander::classes('data', 'layout_type', 'container'); ?>">
      <?php get_template_part( 'framework/views/header/header-top' ); ?>
      <div class="header-branding row">
        <div class="logo col-xs-5 col-sm-4 col-md-4">
          <a href="<?php bloginfo('url'); ?>">
            <img src="<?php echo Salamander::getData( 'logo' ); ?>" alt="<?php bloginfo('name'); ?>" />
          </a>
        </div>
        <div class="branding col-xs-9 col-sm-10 col-md-10">
        <?php if ( Salamander::getData( 'header_v4_content' ) == 'taglinesearch' ) : ?>
          <div class="pull-right"><?php get_search_form(); ?></div>
          <?php if ( Salamander::getData( 'header_tagline' ) ) : ?>
            <div class="hidden-xs pull-left"><h3 class="tagline"><?php echo Salamander::getData( 'header_tagline' ); ?></h3></div>
          <?php endif; ?>
        <?php elseif( Salamander::getData( 'header_v4_content' ) == 'tagline' ) : ?>
          <?php if(Salamander::getData( 'header_tagline' )): ?>
            <div class="hidden-xs pull-left"><h3 class="tagline"><?php echo Salamander::getData( 'header_tagline' ); ?></h3></div>
          <?php endif; ?>
        <?php elseif ( Salamander::getData( 'header_v4_content' ) == 'search' ) : ?>
          <div class="pull-right"><?php get_search_form(); ?></div>
        <?php elseif ( Salamander::getData( 'header_v4_content' ) == 'banner' ) : ?>
          <div id="header-banner" class="hidden-xs">
            <?php echo Salamander::getData( 'header_banner_code' ); ?>
          </div>
        <?php endif; ?>
        </div>
        <div class="col-xs-2">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
      </div>
      <?php
      $defaults = array(
        'theme_location'  => 'main_navigation',
        'container'       => 'nav',
        'container_class' => 'collapse navbar-collapse',
        'container_id'    => (Salamander::getData( 'ubermenu' ) ? 'nav-uber' : 'nav'),
        'menu_class'      => 'nav navbar-nav',
        'echo'            => true,
        'fallback_cb'     => 'link_to_menu_editor',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 0,
      );

      wp_nav_menu( $defaults );
      ?>
    </div>
  </div>
</header>