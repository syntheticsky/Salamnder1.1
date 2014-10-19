<?php if ( Salamander::getData( 'footer_widgets' ) ) : ?>
  <div class="footer-top footer-widgets">
    <div class="container">
      <section class="row columns columns-<?php print Salamander::getData( 'footer_widgets_columns' ); ?>">
        <article class="<?php echo Salamander::classes('footer_widgets', 'first'); ?>">
          <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Footer Widget 1' ) ) :
          endif; ?>
        </article>
        <article class="<?php echo Salamander::classes('footer_widgets', 'second'); ?>">
          <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Footer Widget 2' ) ) :
          endif; ?>
        </article>
        <article class="<?php echo Salamander::classes('footer_widgets', 'third'); ?>">
          <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Footer Widget 3' ) ) :
          endif; ?>
        </article>
        <article class="<?php echo Salamander::classes('footer_widgets', 'fourth last'); ?>">
          <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Footer Widget 4' ) ) :
          endif; ?>
        </article>
      </section>
    </div>
  </div>
<?php endif; ?>
<?php if ( Salamander::getData( 'footer_copyright' ) ) : ?>
  <div class="footer-bottom footer-social">
    <div class="container">
      <?php if ( Salamander::getData( 'icons_footer' ) ) : ?>
        <?php get_template_part( 'framework/views/footer-social' ); ?>
      <?php endif; ?>
      <ul class="copyright">
        <li><?php print Salamander::getData( 'footer_text' ) ?></li>
      </ul>
    </div>
  </div>
<?php endif; ?>
