<div style="max-width: <?php print $width; ?>px; max-height: <?php print $height; ?>px;">
        <div class="soundcloud-shortcode">
        <iframe width="<?php echo $width; ?>"
                height="<?php echo $height; ?>"
                scrolling="no"
                frameborder="no"
                src="https://w.soundcloud.com/player/?url=<?php echo urlencode($url); ?>&amp;show_comments=<?php echo $comments; ?>&amp;auto_play=<?php echo  $auto_play; ?>&amp;color=<?php echo $color; ?>"></iframe>
        </div>
</div>