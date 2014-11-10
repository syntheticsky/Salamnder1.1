<div class="review <?php echo $gender; ?>">
  <blockquote>
    <q><?php echo $content; ?></q>
  <?php if ( $name ): ?>
    <div class="clearfix">
      <span class="company-name">
        <strong><?php echo $name; ?></strong>,
    <?php if ( $company ): ?>
			<?php if ( ! empty( $link ) ): ?>
				<a href="<?php echo $link; ?>" target="<?php echo $target; ?>">
      <?php endif; ?>
          <span> <?php echo $company; ?></span>
      <?php if ( ! empty( $link ) ): ?>
        </a>
			<?php	endif; ?>
		<?php	endif; ?>
			</span>
    </div>
  <?php endif; ?>
  </blockquote>
</div>