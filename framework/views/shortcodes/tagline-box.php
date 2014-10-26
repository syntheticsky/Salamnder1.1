<style type='text/css'>#reading-box-container-<?php echo $counter; ?> .tagline-shadow:before,#reading-box-container-<?php echo $counter; ?> .tagline-shadow:after{opacity:<?php echo $shadow_opacity; ?>;}</style>
<div class="reading-box-container" id="reading-box-container-<?php echo $counter; ?>">
  <section class="reading-box <?php echo $class; ?>" style="background-color:<?php echo $bg_color; ?> !important;border-width:<?php echo $border; ?>;border-color:<?php echo $border_color; ?> !important;border-<?php echo $highlight_position; ?>-width:3px !important;border-<?php echo $highlight_position; ?>-color:<?php echo $primary_color; ?> !important;border-style:solid;">
    <?php if ( ( isset( $link ) && $link ) && ( isset( $button ) && $button ) ): ?>
    <a href="<?php echo $link; ?>" target="<?php echo $link_target; ?>" class="continue btn-lg <?php echo $button_color; ?>"><?php echo $button; ?></a>
    <?php endif; ?>
    <?php if ( isset( $title ) && $title ): ?>
    <h2><?php echo $title; ?></h2>
    <?php endif; ?>
    <?php if( isset( $description ) && $description ): ?>
    <p><?php echo $description; ?></p>
    <?php endif; ?>
    <?php if( isset( $link ) && $link && isset( $button ) && $button ): ?>
    <a href="<?php echo $link; ?>" target="<?php echo $link_target; ?>" class="continue mobile-button btn-lg <?php echo $button_color; ?>"><?php echo $button; ?></a>
    <?php endif; ?>
  </section>
</div>
<div class="clearfix"></div>