<style type="text/css">
  #pricing-table-<?php echo $counter; ?>.full-boxed-pricing{background-color:<?php echo $border_color; ?> !important;}
  #pricing-table-<?php echo $counter; ?> .column{background-color:<?php echo $bg_color; ?> !important;border-color:<?php echo $divider_color; ?> !important;}
  #pricing-table-<?php echo $counter; ?>.sep-boxed-pricing .column{background-color:<?php echo $border_color; ?> !important;}
  #pricing-table-<?php echo $counter; ?> .column li{border-color:<?php echo $divider_color; ?> !important;}
  #pricing-table-<?php echo $counter; ?> li.normal-row{background-color:<?php echo $bg_color; ?> !important;}
  #pricing-table-<?php echo $counter; ?>.full-boxed-pricing li.title-row{background-color:<?php echo $bg_color; ?> !important;}
  #pricing-table-<?php echo $counter; ?> li.pricing-row,#pricing-table-<?php echo $counter; ?> li.footer-row{background-color:<?php echo $border_color; ?> !important;}
</style>
<div id="pricing-table-<?php $counter; ?>" class="<?php echo $type; ?>-boxed-pricing">
  <?php echo $content; ?>
</div>
<div class="clearfix"></div>