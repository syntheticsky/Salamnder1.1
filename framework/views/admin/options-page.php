<script type="text/javascript" language="javascript">
jQuery.noConflict();
jQuery(document).ready(function($)
{
	// COLOR Picker
	$('.colorSelector').each(function()
	{
		var replica = this; //cache a copy of the this variable for use inside nested function
		$(this).ColorPicker(
		{
				color: '<?php if(isset($color)) print $color; ?>',
				onShow: function (pkr)
				{
					$(pkr).fadeIn(500);
					return false;
				},
				onHide: function (pkr)
				{
					$(pkr).fadeOut(500);
					return false;
				},
				onChange: function (hsb, hex, rgb)
				{
					$(replica).children('div').css('backgroundColor', '#' + hex);
					$(replica).next('input').attr('value','#' + hex);
				}
		});
	}); //end color picker
}); //end doc ready
var tb_pathToImage = "<?php print SITE_URL . '/' . WPINC . '/js/thickbox/loadingAnimation.gif'; ?>";
var tb_closeImage = "<?php print SITE_URL . '/' . WPINC . '/js/thickbox/tb-close.png'; ?> ";
</script>
<link rel="stylesheet" href="<?php print SITE_URL . '/' . WPINC . '/js/thickbox/thickbox.css'; ?>" type="text/css" media="screen" />

<div class="wrapper" id="container">
	<div id="actions-save" class="actions-save">
		<div class="actions-save-save">Options Updated</div>
	</div>
	<div id="actions-reset" class="actions-save">
		<div class="actions-save-reset">Options Reset</div>
	</div>

	<div id="actions-fail" class="actions-save">
		<div class="actions-save-fail">Error!</div>
	</div>

	<span style="display: none;" id="hooks"><?php print json_encode( $headerClassesArray ); ?></span>

  <!-- NEW -->
  <form id="options-form" method="post" action="<?php print esc_attr( $_SERVER['REQUEST_URI'] ) ?>" enctype="multipart/form-data" >
    <input type="hidden" id="reset" value="<?php if(isset($_REQUEST['reset'])) print $_REQUEST['reset']; ?>" />
    <input type="hidden" id="security" name="security" value="<?php print wp_create_nonce('ajax_nonce'); ?>" />
    <div id="header">
      <div class="logo">
        <h3><?php print THEMENAME; ?></h3>
        <span><?php print ('v'. THEMEVERSION); ?></span>
      </div>
      <div id="no-js">Warning - This options panel will not work properly without javascript!</div>
      <div class="icon-option"></div>
      <div class="clear"></div>
    </div>
    <div id="actions-top">
      <a>
        <div id="options-to-list" class="options-expand">Expand</div>
      </a>
      <img style="display:none" src="<?php print ASSETS_DIR; ?>images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
      <button id="options-save-upper" type="button" name="save" class="button-primary">
        <?php print __('Save All Changes', 'optionsframework');?>
      </button>
    </div>
    <div id="options-content">
      <div id="tab-nav">
        <ul>
          <?php foreach ( $default_options as $key => $values ) : ?>
          <li class="<?php echo str_replace( ' ', '', strtolower( $values['name'] ) ); ?>">
            <a title="<?php echo $values['name']; ?>" href="#<?php echo 'of-option-' . str_replace(' ', '', strtolower( $values['name'] ) ); ?>"><?php echo $values['name']; ?></a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div id="tab-content">
      <?php foreach ( $default_options as $values ) : ?>
        <div class="group" id="<?php echo 'of-option-' . str_replace(' ', '', strtolower( $values['name'] ) ); ?>">
          <h2><?php echo $values['name']; ?></h2>
        <?php foreach ( $values['children'] as $value ) : ?>
          <?php
          $mode = isset( $value['mode'] )
            ? $value['mode'] : '';
          $fold = ( array_key_exists( 'fold', $value ) ) ? ' fold' : '';
          ( !isset( $options[$value['id']] ) ) ? $options[$value['id']] = '' : '';
          $field = array(
            '#label' => '',
            '#type' => $value['type'],
            '#title' => '',
            '#attributes' => array(
              'id' => $value['id'],
              'name' => $value['id'],
              'class' => $value['type'] . $fold,
              'value' => ( !empty( $options[$value['id']] ) ? $options[$value['id']] : $default_values[$value['id']] )
            ),
            '#default_value' => ( !empty($options[$value['id']]) ? $options[$value['id']] : $default_values[$value['id']] ),
            '#options' => (isset( $value['options'] ) ? $value['options']: array()),
            '#container' => array(
              'tag' => 'div',
              '#attributes' => array(
                'class' => 'form-group sl-field ' . $value['type'] . '-wrapper '. $mode,
              ),
            ),
          );
          ?>
          <div id="section-<?php echo $value['id']; ?>" class="$fold section section-<?php echo $value['type']; echo ( isset( $value['class'] ) ) ? $value['class'] : ''; ?>">
            <h3 class="heading"><?php echo $value['name']; ?></h3>
            <div class="option">
              <div class="controls">
              <?php switch ($value['type']) :
                case 'upload':
                  echo $helper::upload_field( $value['id'], $default_values[$value['id']], $mode );
                  break;
                case 'media':
                  echo $helper::media_upload_field( $value['id'], $default_values[$value['id']], $mode );
                  break;
                case 'color':
                  $default_value = ( !empty($options[$value['id']]) ? $options[$value['id']] : $default_values[$value['id']] );
                  $output = '<div id="' . $value['id'] . '_picker" class="colorSelector"><div style="background-color: ' . $default_value .'"></div></div>';
                  $output .= '<input class="of-color" name="'.$value['id'].'" id="'. $value['id'] .'" type="text" value="' . $default_value .'" />';
                  echo $output;
                  break;
                case 'info':
                  echo '<div class="info-title">' . $value['default'] . '</div>';
                  break;
                case 'radios':
                  $field['#images'] = ( isset( $value['img'] ) ) ? $value['img'] : '';
                case 'checkbox':
                  $field['#attributes']['value'] = ( isset($options[$value['id']]) ? 1 : 0 );
                default :
                  echo Helper::renderElement($field);
              ?>

              <?php endswitch; ?>
              </div>
              <?php
              echo ( isset($value['desc'])
                  ? '<div class="explain">' . $value['desc'] . '</div>' . "\n"
                  : '' );
              ?>
            </div>
          </div>
      <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="clear"></div>
    </div>
    <div class="actions">
      <img style="display:none" src="<?php print ASSETS_DIR; ?>images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
      <button id ="options-save" type="button" name="save" class="button-primary"><?php print __('Save All Changes', 'optionsframework');?></button>
      <button id ="options-reset" type="button" class="button submit-button reset-button" ><?php print __('Options Reset', 'optionsframework');?></button>
      <img style="display:none" src="<?php print ASSETS_DIR; ?>images/loading-bottom.gif" class="ajax-reset-loading-img ajax-loading-img-bottom" alt="Working..." />
    </div>
</div><!--wrapper-->
