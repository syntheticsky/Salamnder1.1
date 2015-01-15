<div class="social-links-shortcode clearfix">
  <ul class="social-networks social-networks-<?php print $color; ?> clearfix">
  <?php foreach ( $socials as $key => $link ): ?>
    <li class="<?php print $key; ?>">
      <a class="<?php print $key; ?>" href="<?php print $link; ?>" target="<?php print $target; ?>"><?php ucwords( $key ); ?></a>
      <div class="popup">
        <div class="holder">
          <p><?php print ucwords( $key ); ?></p>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
  </ul>
</div>