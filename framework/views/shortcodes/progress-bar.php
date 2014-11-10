<div class="progress progress-bar" style="background-color:<?php echo $unfilled_color; ?> !important;border-color:<?php echo $unfilled_color; ?> !important;">
  <div class="progress-bar-content" data-percentage="<?php echo $value; ?>" style="width: <?php echo $value; ?>%;background-color:<?php echo $filled_color; ?> !important;border-color:<?php echo $filled_color; ?> !important;"></div>
  <span class="progress-title"><?php echo $content; ?> <?php echo $value; ?>%</span>
</div>
<div class="progress" style="background-color:<?php echo $unfilled_color; ?> !important;border-color:<?php echo $unfilled_color; ?> !important;">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value; ?>%;background-color:<?php echo $filled_color; ?> !important;border-color:<?php echo $filled_color; ?> !important;">
    <span><?php echo $content; ?> <?php echo $value; ?>%</span>
  </div>
</div>