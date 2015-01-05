<div class="header-top row">
  <div class="col-xs-12 col-sm-6 col-md-6">
    <div class="pull-left">
      <?php
      get_template_part( 'framework/views/header/' . Salamander::getData( 'header_left_content' ) );
      ?>
    </div>
  </div>
  <div class="hidden-xs col-sm-6 col-md-6">
    <div class="pull-right">
      <?php
      get_template_part( 'framework/views/header/' . Salamander::getData( 'header_right_content' ) );
      ?>
    </div>
  </div>
</div>