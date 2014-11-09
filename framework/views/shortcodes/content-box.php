<article class="col">
  <?php if ( ( isset( $image ) && $image ) || ( isset( $title ) && $title ) ): ?>
    <?php if ( ! empty( $image ) || ! empty( $icon ) ) : ?>
  <div class="heading heading-and-icon">
    <?php else: ?>
  <div class="heading">
    <?php endif; ?>
    <?php if ( isset( $image ) && $image ): ?>
    <img src="<?php echo $image; ?>" width="35" height="35" alt="" />
    <?php endif; ?>
    <?php if ( ! empty( $icon ) && $icon ): ?>
    <i class="fontawesome-icon medium circle-yes icon-<?php echo $icon; ?>"></i>
    <?php endif; ?>
    <?php if ( $title ): ?>
    <h2><?php echo $title; ?></h2>
    <?php endif; ?>
  </div>
  <?php endif; ?>

  <div class="col-content-container">
    <?php echo $content; ?>
    <?php if ( isset( $link ) && $link && isset( $link_text ) && $link_text ): ?>
    <span class="more">
      <a href="<?php echo $link; ?>" target="<?php echo $link_target; ?>"><?php echo $link_text; ?></a>
    </span>
    <?php endif; ?>
  </div>
</article>
<?php if ($last == 'yes'): ?>
<div class="clearfix"></div>
<?php endif; ?>