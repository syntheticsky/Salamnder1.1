<style type='text/css'>
  #tabs-<?php echo $counter; ?>,#tabs-<?php echo $counter; ?>.tabs-vertical .tabs,#tabs-<?php echo $counter; ?>.tabs-vertical .tab_content{border-color:<?php echo $inactive_color; ?> !important;}
  #main #tabs-<?php echo $counter; ?>.tabs-horizontal,#tabs-<?php echo $counter; ?>.tabs-vertical .tab_content,.pyre_tabs .tabs-container{background-color:<?php echo $bg_color; ?> !important;}
  body.dark #tabs-<?php echo $counter; ?>.shortcode-tabs .tab-hold .tabs li,body.dark #sidebar .tab-hold .tabs li{border-right:1px solid {<?php echo $bg_color; ?>} !important;}
  body.dark #tabs-<?php echo $counter; ?>.shortcode-tabs .tab-hold .tabs li:last-child{border-right:0 !important;}
  body.dark #main #tabs-<?php echo $counter; ?> .tab-hold .tabs li a{background:<?php echo $inactive_color; ?> !important;border-bottom:0 !important;color:<?php echo $body_text_color; ?> !important;}
  body.dark #main #tabs-<?php echo $counter; ?> .tab-hold .tabs li a:hover{background:<?php echo $bg_color; ?> !important;border-bottom:0 !important;}
  body #main #tabs-<?php echo $counter; ?> .tab-hold .tabs li.active a,body #main #tabs-<?php echo $counter; ?> .tab-hold .tabs li.active{background:<?php echo $bg_color; ?> !important;border-bottom:0 !important;}
  #sidebar .tab-hold .tabs li.active a{border-top-color:<?php echo $primary_color; ?> !important;}
</style>

<div id="tabs-<?php echo $counter; ?>" class="tab-holder shortcode-tabs clearfix tabs-<?php echo $layout; ?>">
  <div class="tab-hold tabs-wrapper">
    <ul id="tabs" class="tabset tabs">
    <?php foreach ($tabs as $key => $tab) : ?>
      <li><a href="#<?php echo $key; ?>"><?php echo $tab; ?></a></li>
    <?php endforeach; ?>
    </ul>
    <div class="tab-box tabs-container">
      <?php echo $content; ?>
    </div>
  </div>
</div>