<?php

/**
 * Helper class
 */

class Helper
{
	static private $themeOptions;
	static private $instance;

	private function __construct()
	{
		self::$themeOptions = get_option(THEME_OPTIONS);
	}

	public static function get_instance()
	{
	  if (self::$instance == null)
	  {
	    self::$instance = new self();
	  }

	  return self::$instance;
	}

	//render template
	public static function function_get_output($fn)
	{
	  $args = func_get_args();unset($args[0]);
	  ob_start();
	  call_user_func_array('self::' . $fn, $args);
	  $output = ob_get_contents();
	  ob_end_clean();
	  return $output;
	}

	public static function display($template, $params = array())
	{
	  extract($params);
	  // require $template;
    if (is_file($template))
	    require_once $template;
	}

  /**
   * @param $template
   * @param array $params
   * @return string
   * !!!!!!!!!!!USE include( locate_template( 'template-part.php' ) ); instead
   */
	public static function render($template, $params = array())
	{
	  return self::function_get_output('display', $template, $params);
	}

  public static function stringLimitWords($string, $word_limit)
  {
    $words = explode(' ', $string, ($word_limit + 1));

    if(count($words) > $word_limit) {
      array_pop($words);
    }

    return implode(' ', $words);
  }

  /**
   * Salamander breadcrumbs function
   */
  public function breadcrumbs() {
    global $post;

    $params = array(
      'post' => $post,
    );

    echo self::render(VIEWS_PATH . 'breadcrumbs.php', $params);
  }

	/**
	 * Drag and drop slides manager
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_slider_function($id, $std, $oldorder, $order, $int) {
    $data = get_option(THEME_OPTIONS);

    $slide = array();
		$slider = '';
    $val = $std;
		if(isset($data[$id]))
		{
	    $slide = $data[$id];
		}

    if ( isset($slide[$oldorder] ) ) {
    	$val = $slide[$oldorder];
    }

		//initialize all vars
		$slidevars = array('title', 'url', 'link', 'description');

		foreach ( $slidevars as $slidevar ) {
			if ( ! isset($val[$slidevar] ) ) {
				$val[$slidevar] = '';
			}
		}

		//begin slider interface
		if ( ! empty($val['title'] ) ) {
			$slider .= '<li><div class="slide_header"><strong>' . stripslashes($val['title']) . '</strong>';
		}
		else {
			$slider .= '<li><div class="slide_header"><strong>Slide ' . $order . '</strong>';
		}

		$slider .= '<input type="hidden" class="slide of-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_slide_order" value="'.$order.'" />';
		$slider .= '<a class="slide_edit_button" href="#">Edit</a></div>';
		$slider .= '<div class="slide_body">';
		$slider .= '<label>Title</label>';
		$slider .= '<input class="slide of-input of-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. stripslashes($val['title']) .'" />';
		$slider .= '<label>Image URL</label>';
		$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][url]" id="'. $id .'_'.$order .'_slide_url" value="'. $val['url'] .'" />';

		$slider .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'_'.$order .'" rel="' . $int . '">Upload</span>';

    $hide = 'hide';
		if(!empty($val['url'])) {
			$hide = '';
		}
		$slider .= '<span class="button mlu_remove_button '. $hide.'" id="reset_'. $id .'_'.$order .'" title="' . $id . '_'.$order .'">Remove</span>';
		$slider .='</div>' . "\n";
    if( ! empty($val['url'] ) ) {
      $slider .= '<div class="screenshot">';
    	$slider .= '<a class="of-uploaded-image" href="'. $val['url'] . '">';
    	$slider .= '<img class="of-option-image" id="image_'.$id.'_'.$order .'" src="'.$val['url'].'" alt="" />';
    	$slider .= '</a></div>';
		}
		$slider .= '<label>Link URL (optional)</label>';
		$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][link]" id="'. $id .'_'.$order .'_slide_link" value="'. $val['link'] .'" />';
		$slider .= '<label>Video Embed Code (optional)</label>';
		$slider .= '<textarea class="slide of-input" name="'. $id .'['.$order.'][description]" id="'. $id .'_'.$order .'_slide_description" cols="8" rows="8">'.stripslashes($val['description']).'</textarea>';
		$slider .= '<a class="slide_delete_button" href="#">Delete</a>';
	  $slider .= '<div class="clear"></div>' . "\n";
		$slider .= '</div></li>';

		return $slider;
	}

	public static function get_silent_post ( $_token ) {
		global $wpdb;
		$_id = 0;

		// Check if the token is valid against a whitelist.
		// $_whitelist = array( 'of_logo', 'of_custom_favicon', 'of_ad_top_image' );
		// Sanitise the token.

		$_token = strtolower( str_replace( ' ', '_', $_token ) );

		// if ( in_array( $_token, $_whitelist ) ) {
		if ( $_token ) {

			// Tell the function what to look for in a post.

			$_args = array( 'post_type' => 'options', 'post_name' => 'of-' . $_token, 'post_status' => 'draft', 'comment_status' => 'closed', 'ping_status' => 'closed' );

			// Look in the database for a "silent" post that meets our criteria.
			$query = 'SELECT ID FROM ' . $wpdb->posts . ' WHERE post_parent = 0';
			foreach ( $_args as $k => $v ) {
				$query .= ' AND ' . $k . ' = "' . $v . '"';
			} // End FOREACH Loop

			$query .= ' LIMIT 1';
			$_posts = $wpdb->get_row( $query );

			// If we've got a post, loop through and get it's ID.
			if ( count( $_posts ) ) {
				$_id = $_posts->ID;
			} else {

				// If no post is present, insert one.
				// Prepare some additional data to go with the post insertion.
				$_words = explode( '_', $_token );
				$_title = join( ' ', $_words );
				$_title = ucwords( $_title );
				$_post_data = array( 'post_title' => $_title );
				$_post_data = array_merge( $_post_data, $_args );
				$_id = wp_insert_post( $_post_data );
			}
		}
		return $_id;
	}

	public static function hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		//return implode(",", $rgb); // returns the rgb values separated by commas
		return $rgb; // returns an array with the rgb values
	}

  public static function renderElement( $element ) {
    $label = $open = $close = $help = '';
    if ( isset( $element['#attributes']['id'] ) && isset( $element['#label'] ) )
    {
      $attributes = '';
      if ( isset( $element['#label']['#attributes'] ) )
      {
        $attributes = self::setAttributes($element['#label']['#attributes']);
      }
      if ( !empty( $element['#label'] ) ) {
        $label = '<label for="' . $element['#attributes']['id'] . '" ' . $attributes . ' >' . __($element['#title'], 'salamander') . '</label>';
      }
    }
    if ( isset( $element['#container'] ) ) {
      $open = '<' . $element['#container']['tag'] . ' ' . self::setAttributes($element['#container']['#attributes']) . '>';
      $close = '</' . $element['#container']['tag'] . '>';
    }
    if ( isset( $element['#help'] ) ) {
      $help = '<span class="help-block explain">' . $element['#help'] . '</span>';
    }
    $method = $element['#type'] . 'Field';

    if ( method_exists( __CLASS__, $method ) ) {
      return $open . $label . self::$method($element) . $close . $help;
    }

    return $open . $label . $close . $help;
  }

  /**
   * Native media library uploader
   *
   * @uses get_option()
   *
   * @access public
   * @since 1.0.0
   *
   * @return string
   */
  public static function media_upload_field( $id, $default, $mod ) {
    $output = '';
    $int = self::get_silent_post( strip_tags( strtolower( $id ) ) );
    $data = get_option(THEME_OPTIONS);
    $upload = isset( $data[$id] ) ? $data[$id] : $default;
    $val = $default;
    $hide = 'hide';
    if( ! empty( $upload ) ) {
      $val = $upload;
      $hide = '';
    }
    if ( $mod == 'min' ) {
      $hide ='hide';
    }

    $output .= '<input class="' . $hide.' upload of-input" name="' . $id . '" id="' . $id . '_upload" value="' . $val . '" />';
    $output .= '<div class="upload_button_div"><span class="button media_upload_button" id="' . $id . '" rel="' . $int . '">Upload</span>';
    $output .= '<span class="button mlu_remove_button ' . $hide . '" id="reset_' . $id . '" title="' . $id . '">Remove</span>';
    $output .='</div>' . "\n";
    $output .= '<div class="screenshot">';
    if ( ! empty( $upload ) ) {
      $output .= '<a class="of-uploaded-image" href="' . $upload . '">';
      $output .= '<img class="of-option-image" id="image_' . $id . '" src="' . $upload . '" alt="" />';
      $output .= '</a>';
    }
    $output .= '</a></div>';
    $output .= '<div class="clear"></div>' . "\n";

    return $output;
  }

  /**
   * Ajax image uploader - supports various types of image types
   *
   * @uses get_option()
   *
   * @access public
   * @since 1.0.0
   *
   * @return string
   */
  static private function upload_field( $id, $default, $mod = '' ) {
    $output = '';
    $data = get_option(THEME_OPTIONS);
    $upload = isset( $data[$id] ) ? $data[$id] : $default;
    $val = $default;
    $hide = 'hide';
    if( ! empty( $upload ) ) {
      $val = $upload;
      $hide = '';
    }
    if ( $mod == 'min' ) {
      $hide = 'hide';
    }

    $output .= '<input class="' . $hide . ' upload of-input" name="' . $id . '" id="'. $id . '_upload" value="' . $val . '" />';
    $output .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'">'._('Upload').'</span>';
    $output .= '<span class="button image_reset_button ' . $hide . '" id="reset_' . $id . '" title="' . $id . '">Remove</span>';
    $output .='</div>' . "\n";
    $output .= '<div class="clear"></div>' . "\n";
    $output .= '<div class="screenshot">';
    if( ! empty( $upload )
      && false === strstr($id, 'font') ) {
      $output .= '<a class="of-uploaded-image" href="' . $upload . '">';
      $output .= '<img class="of-option-image" id="image_' . $id . '" src="' . $upload . '" alt="" />';
      $output .= '</a>';
    }
    $output .= '</div>';
    $output .= '<div class="clear"></div>' . "\n";

    return $output;
  }

  static private function elementSetClass( &$element, $class = array() ) {
	  if (!empty($class)) {
	    if (!isset($element['#attributes']['class'])) {
	      $element['#attributes']['class'] = '';
	    }
	    else {
  	    $element['#attributes']['class'] .= ' ';
	    }
	    $element['#attributes']['class'] .= implode(' ', $class);
	  }
	  if (isset($element['#attributes']['required'])) {
	    $element['#attributes']['class'] = ' required';
	  }
	}

	private static function setAttributes($attributes) {
		if (!$attributes) $attributes = array();
	  foreach ($attributes as $attribute => &$data) {
	    $data = $attribute . '="' . $data . '"';
	  }
	  return $attributes ? ' ' . implode(' ', $attributes) : '';
	}

	private static function textField($element){
		$element['#attributes'] =	array_merge(array('type' => 'text'), $element['#attributes']);
	  self::elementSetClass($element, array('form-text', 'form-control'));
		return '<input' . self::setAttributes($element['#attributes']) . ' />';
	}

	private static function selectField($element){
		$options = '';
	  self::elementSetClass($element, array('form-select', 'form-control'));
	  if (isset($element['#options']) && !empty($element['#options'])) {
	  	$default_value = $element['#default_value'];
	  	foreach ($element['#options'] as $val => $key) {
	  		$options .= '<option value="' . $val . '" ' . selected($default_value, $val, false) . '>'. $key . '</option>' . "\n";
	  	}
	  }
	  return '<select ' . self::setAttributes($element['#attributes']) . '>' . $options .'</select>';
	}

	private static function textareaField( $element ) {
		$value = $element['#attributes']['value'];
		unset($element['#attributes']['value']);
	  self::elementSetClass($element, array('form-textarea', 'form-control'));
		return '<textarea' . self::setAttributes( $element['#attributes'] ) . '>' . $value . '</textarea>';
	}

	private static function radiosField( $element ) {
		$output = '';
	  self::elementSetClass( $element, array('form-radio', 'form-control') );
	  $id = $element['#attributes']['id'];
	  unset($element['#attributes']['id'], $element['#attributes']['value']);
	  if ( isset( $element['#options'] ) && !empty( $element['#options'] ) ) {
	  	$default_value = $element['#default_value'];
	  	foreach ( $element['#options'] as $val => $name ) {
	  		if ( $element['#images'] ) {
          $selected = '';
          if( NULL != checked( $default_value, $val, false ) ) {
            $selected = 'of-radio-img-selected';
          }
          $output .= '<div class="fieldset">';
          $output .= '<input type="radio" id="of-radio-img-' . $id . $val . '"' . self::setAttributes( $element['#attributes'] ) . ' value = "' . $val . '" ' . checked($default_value, $val, false) . ' style="display: none;" />';
          $output .= '<label for="of-radio-img-' . $id . $val . '" class="of-radio-img-label">' . $val . '</label>';
          $output .= '<img src="' . get_bloginfo('template_url') . $name . '" alt="" class="of-radio-img-img ' . $selected . '" onClick="document.getElementById(\'of-radio-img-' . $id . $val .'\').checked = true;" />';
          $output .= '</div>';
        }
        else {
          $output .= '<input type="radio" id="' . $id . '_' . $val . '" ' . self::setAttributes( $element['#attributes'] ) . ' value="' . $val . '" ' . checked($default_value, $val, false) . ' /><label for="' . $id . '_' . $val . '" class="radio">' . $name . '</label><br/>';
        }
      }
    }

	  return $output;
	}

  private static function checkboxField( $element ) {
    self::elementSetClass($element, array('form-checkbox', 'form-control'));
    $default_value = $element['#default_value'];

    return '<input type="checkbox"' . self::setAttributes( $element['#attributes'] )  . checked($default_value, 1, false) . ' />';
  }
}
