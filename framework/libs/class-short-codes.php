<?php

/**
 * Salamander Theme
 */
class Short_Codes {
  private $helper;

  private $short_code_list;

  public function __construct() {
    $this->helper = Helper::get_instance ();
    $this->short_code_list = array("youtube", "vimeo", "soundcloud", "button", "dropcap", "highlight", "checklist", "tabs", "tab", "accordion", "toggle", "one_half", "one_third", "one_fourth", "two_third", "three_fourth", "tagline_box", "pricing_table", "pricing_column", "pricing_price", "pricing_row", "pricing_footer", "content_boxes", "content_box", "slider", "slide", "testimonials", "testimonial", "progress", "person", "recent_posts", "recent_works", "alert", "fontawesome", "social_links", "clients", "client", "title", "separator", "tooltip", "fullwidth", "map", "counters_circle", "counter_circle", "counters_box", "counter_box", "flexslider", "blog", "imageframe", "images", "image", "sharing");
    add_filter ( 'widget_text', 'do_shortcode' );
    add_filter ( 'the_content', array($this, 'shortcodes_formatter') );
    add_filter ( 'widget_text', array($this, 'shortcodes_formatter') );
    // Google Map
    add_shortcode ( 'map', array($this, 'shortcode_gm') );
    // Vimeo short code
    add_shortcode ( 'vimeo', array($this, 'shortcode_vimeo') );
    // YouTube short code
    add_shortcode( 'youtube', array( $this, 'shortcode_youtube' ) );
    //sound cloud short code
    add_shortcode( 'soundcloud', array( $this, 'shortcode_soundcloud' ) );
    // button short code
    add_shortcode( 'button', array( $this, 'shortcode_button' ) );
    // Dropcap short code
    add_shortcode( 'dropcap', array( $this, 'shortcode_dropcap' ) );
    //Highlight shortcode
    add_shortcode( 'highlight', array( $this, 'shortcode_highlight' ) );
    // Check list short code
    add_shortcode('checklist', array( $this, 'shortcode_checklist' ) );
    // Tabs shortcode
    add_shortcode('tabs', array( $this, 'shortcode_tabs' ) );
    add_shortcode('tab', array( $this, 'shortcode_tab' ) );
    // Accordion
    add_shortcode('accordion', array($this, 'shortcode_accordion'));
    // Toggle shortcode
    add_shortcode('toggle', array($this, 'shortcode_toggle'));
    // Column one_half shortcode
    add_shortcode('one_half', array($this, 'shortcode_one_half'));
    // Column one_third shortcode
    add_shortcode('one_third', array($this, 'shortcode_one_third'));
    // Column two_third shortcode
    add_shortcode('two_third', array($this, 'shortcode_two_third'));
    // Column one_fourth shortcode
    add_shortcode('one_fourth', array($this, 'shortcode_one_fourth'));
    // Column three_fourth shortcode
    add_shortcode('three_fourth', array($this, 'shortcode_three_fourth'));
    // Tagline box shortcode
    add_shortcode('tagline_box', array($this, 'shortcode_tagline_box'));
    // Pricing table
    add_shortcode('pricing_table', array($this, 'shortcode_pricing_table'));
    // Pricing Column
    add_shortcode('pricing_column', array($this, 'shortcode_pricing_column'));
    // Pricing price
    add_shortcode('pricing_price', array($this, 'shortcode_pricing_price'));
    // Pricing Row
    add_shortcode('pricing_row', array($this, 'shortcode_pricing_row'));
    // Pricing Footer
    add_shortcode('pricing_footer', array($this, 'shortcode_pricing_footer'));
    // Content box shortcode
    add_shortcode('content_boxes', array($this, 'shortcode_content_boxes'));
    // Content box shortcode
    add_shortcode('content_box', array($this, 'shortcode_content_box'));
    // Testimonials
    add_shortcode('testimonials', array($this, 'shortcode_testimonials'));
    // Testimonial
    add_shortcode('testimonial', array($this, 'shortcode_testimonial'));

    // Add buttons to tinyMCE
    add_action ( 'init', array( $this, 'add_Button' ) );
  }

  public function shortcodes_formatter( $content ) {
    $block = join ( "|", $this->short_code_list );
    // opening tag
    $rep = preg_replace ( "/(<p>|<pre>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>|<\/pre>)?/", "[$2$3]", $content );
    // closing tag
    $rep = preg_replace ( "/(<p>|<pre>)?\[\/($block)](<\/p>|<br \/>|<\/pre>)?/", "[/$2]", $rep );

    return $rep;
  }

  /**
   * @param $params
   * @param null $content
   * @return string
   * Google maps short code
   */
  public function shortcode_gm( $params, $content = null ) {
    wp_enqueue_script ( 'gmaps.api' );
    wp_enqueue_script ( 'jquery.ui.map' );

    $params = shortcode_atts ( array('address' => '', 'type' => 'satellite', 'width' => '100%', 'height' => '300px', 'zoom' => '14', 'scrollwheel' => 'true', 'scale' => 'true', 'zoom_pancontrol' => 'true',), $params );

    static $mapCounter = 1;
    $params['mapCounter'] = $mapCounter;
    $mapCounter++;

    return Helper::render ( VIEWS_PATH . 'shortcodes' . DS . 'map.php', $params );
  }

  /**
   * @param $params
   * @return string
   * Vimeo short code
   */
  public function shortcode_vimeo($params) {
    $params = shortcode_atts(
      array(
        'id' => '',
        'width' => 600,
        'height' => 360
      ), $params);

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'vimeo.php', $params);
  }

  /**
   * @param $params
   * @return string
   * Youtube short code
   */
  public function shortcode_youtube($params) {
    $params = shortcode_atts(
      array(
        'id' => '',
        'width' => 600,
        'height' => 360
      ), $params);

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'youtube.php', $params);
  }

  /**
   * @param $params
   * @return string
   * SoundCloud short code
   */
  public function shortcode_soundcloud($params) {
    $params = shortcode_atts(
      array(
        'url' => '',
        'width' => '100%',
        'height' => 81,
        'comments' => 'false',
        'auto_play' => 'false',
        'color' => 'ff7700',
      ), $params);

    if($params['comments'] == 'yes') {
      $params['comments'] = 'true';
    } elseif($params['comments'] == 'no') {
      $params['comments'] = 'false';
    }

    if($params['auto_play'] == 'yes') {
      $params['auto_play'] = 'true';
    } elseif($params['auto_play'] == 'no') {
      $params['auto_play'] = 'false';
    }

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'soundcloud.php', $params);
  }

  /**
   * @param $params
   * @param null $content
   * @return string
   * Button short code
   */
  public function shortcode_button(	$params, $content = null	) {
    $params = shortcode_atts(
      array(
        'size' => 'bt-md',
        'link' => '',
        'color' => 'default',
        'target' => '_parent',
        'content' => do_shortcode($content),
      ), $params);

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'button.php', $params);
  }

  /**
   * @param $params
   * @param null $content
   * @return string
   * Dropcap shortcode
   */
  public function shortcode_dropcap( $params, $content = null ) {
    $params['content'] = do_shortcode($content);

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'dropcap.php', $params);
  }

  /**
   * @param $params
   * @param null $content
   * @return string
   * Highlight short code
   */
  public function shortcode_highlight($params, $content = null) {
    $params = shortcode_atts(
      array(
        'color' => 'yellow',
      ), $params);
    $params['class'] = 'light-highlight';
    if($params['color'] == 'black') {
      $params['class'] = 'dark-highlight';
    }
    $params['content'] = do_shortcode($content);

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'highlight.php', $params);
  }

  /**
   * @param $params
   * @param null $content
   * @return mixed|string
   *
   * Check list shortcode
   */
  public function shortcode_checklist( $params, $content = null ) {
    static $checklist_counter = 1;

    $params = shortcode_atts(
      array(
        'icon' => 'arrow',
        'color' => '',
        'circle' => 'yes',
      ), $params);

    $class = '';
    if( ! $params['color'] ) {
      $class = 'list-icon-color-' . strtolower( Salamander::getData( 'checklist_icons_color' ) );
    }
    $params['content'] = str_replace('<ul>', '<ul class="list-icon circle-' . $params['circle'] . ' list-icon-' . $params['icon'] . ' ' . $class . '">', $content);
    $checklist_counter++;

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'checklist.php', $params);
  }

  //[tabs tab1=\"Tab 1\" tab2=\"Tab 2\" tab3=\"Tab 3\" layout="horizontal or vertical" backgroundcolor="" inactivecolor=""]<br /><br />[tab id=1]Tab content 1[/tab]<br />[tab id=2]Tab content 2[/tab]<br />[tab id=3]Tab content 3[/tab]<br /><br />[/tabs]
  public function shortcode_tabs( $params, $content = null ) {
    static $tabs_counter = 1;
    $tabs_counter++;
    $tabs = array();
    foreach ( $params as $key => $val) {
      if (substr($key, 0, 3) == 'tab') {
        $tabs[$key] = $val;
      }
    }
    if ( ! empty ( $tabs ) ) {
      $params = shortcode_atts(
        array(
          'layout' => 'horizontal',
          'bg_color' => '',
          'inactive_color' => '',
          'content' => do_shortcode($content),
        ), $params);

      if(!$params['bg_color']) {
        $params['bg_color'] = Salamander::getData( 'tabs_bg_color' );
      }

      if(!$params['inactive_color']) {
        $params['inactive_color'] = Salamander::getData( 'tabs_inactive_color' );
      }
      $params['counter'] = $tabs_counter;
      $params['primary_color'] = Salamander::getData( 'primary_color' );
      $params['body_text_color'] = Salamander::getData( 'body_text_color' );
      $params['tabs'] = $tabs;

      return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'tabs.php', $params);
    }
  }

  public function shortcode_tab( $params, $content = null ) {
    if ( isset( $params['id'] ) ) {
      $params['content'] = do_shortcode($content);
      return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'tab.php', $params);
    }
  }


  /**
   * @param $params
   * @param null $content
   * @return string
   * Accordion short code
   */
  public function shortcode_accordion( $params, $content = null ) {
    $params['content'] = do_shortcode($content);

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'accordion.php', $params);
  }


  /**
   * @param $params
   * @param null $content
   * @return string
   * Toggle short code
   */
  //[accordian][toggle title="Title" open="yes"]...[/toggle][toggle title="Title" open="no"]...[/toggle][toggle title="Title" open="no"]...[/toggle][toggle title="Title" open="no"]...[/toggle][toggle title="Title" open="no"]...[/toggle][/accordian]
  public function shortcode_toggle( $params, $content = null ) {
    $params = shortcode_atts(
      array(
        'title' => '',
        'open' => 'no',
        'content' => do_shortcode($content),
      ), $params);

    $params['toggleclass'] = '';
    $params['toggleclass2'] = '';
    $params['togglestyle'] = '';

    if($params['open'] == 'yes') {
      $params['toggleclass'] = 'active';
      $params['toggleclass2'] = 'default-open';
      $params['togglestyle'] = 'display: block;';
    }

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'toggles.php', $params);
  }

  /**
   * @param $params
   * @param null $content
   * @return string
   * Column one_half shortcode
   */
  //[one_half last="no"]...[/one_half]
  public function shortcode_one_half($params, $content = null) {
    $params = shortcode_atts(
      array(
        'last' => 'no',
        'content' => do_shortcode($content),
      ), $params);

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'one-half.php', $params);
  }

  /**
   * @param $params
   * @param null $content
   * @return string
   * Column one_third shortcode
   */
  //[one_third last="no"]...[/one_third]
  public function shortcode_one_third($params, $content = null) {
    $params = shortcode_atts(
      array(
        'last="no',
        'content' => do_shortcode($content),
      ), $params);

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'one-third.php', $params);
  }

  /**
   * @param $params
   * @param null $content
   * @return string
   * Column two_third shortcode
   */
  //[two_third last="no"]...[/two_third]
  public function shortcode_two_third($params, $content = null) {
    $params = shortcode_atts(
      array(
        'last' => 'no',
        'content' => do_shortcode($content),
      ), $params);

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'two-third.php', $params);
  }

  /**
   * @param $params
   * @param null $content
   * @return string
   * Column one_fourth shortcode
   */
  //[one_fourth last="no"]...[/one_fourth]
  public function shortcode_one_fourth($params, $content = null) {
    $params = shortcode_atts(
      array(
        'last' => 'no',
        'content' => do_shortcode($content),
      ), $params);

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'one-fourth.php', $params);
  }

  /**
   * @param $params
   * @param null $content
   * @return string
   * Column three_fourth shortcode
   */
  //[three_fourth last="no"]...[/three_fourth]
  public function shortcode_three_fourth($params, $content = null) {
    $params = shortcode_atts(
      array(
        'last' => 'no',
        'content' => do_shortcode($content),
      ), $params);

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'three-fourth.php', $params);
  }


  /**
   * @param $params
   * @param null $content
   * @return string
   * Tagline short code
   */
  //[tagline_box backgroundcolor="" shadow="no" border="1px" bordercolor="" highlightposition="right, left, top or bottom" link="http://themeforest.net/user/ThemeFusion" linktarget="" button="Purchase Now" title="Avada is incredibly responsive, with a refreshingly clean design" description="And it has some awesome features, premium sliders, unlimited colors, advanced theme options and so much more!"][/tagline_box]
  public function shortcode_tagline_box($params, $content = null) {
    static $counter = 1;

    $params = shortcode_atts(
      array(
        'link' => '',
        'title' => '',
        'description' => '',
        'button' => '',
        'bg_color' => '',
        'shadow' => 'no',
        'shadow_opacity' => '0.7',
        'border' => '0px',
        'border_color' => '',
        'highlight_position' => 'left',
        'link_target' => '_self',
        'button_color' => 'default'
      ), $params);

    $params['primary_color'] = Salamander::getData( 'primary_color' );
    if( ! $params['bg_color']) {
      $params['bg_color'] = Salamander::getData( 'tagline_bg' );
    }

    if( ! $params['border_color']) {
      $params['border_color'] = Salamander::getData( 'tagline_border_color' );
    }

    if(!$params['button_color']) {
      $params['button_color'] = 'default';
    }

    $params['class'] = '';
    if($params['shadow'] == 'yes') {
      $params['class'] = 'tagline-shadow';
    }
    $params['counter'] = $counter;
    $counter++;

    return Helper::render(VIEWS_PATH. 'shortcodes' . DS . 'tagline-box.php', $params);
  }

  /**
   * @param $params
   * @param null $content
   * @return string
   * Pricing table short code
   * [pricing_table type="e.g. 1 or 2" backgroundcolor="" bordercolor="" dividercolor=""][pricing_column title="Standard"][pricing_price currency="$" price="15.55" time="monthly"][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column][/pricing_table]
   */
	function shortcode_pricing_table($params, $content = null) {
    static $counter = 1;
		$params = shortcode_atts(
      array(
        'bg_color' => '',
        'border_color' => '',
        'divider_color' => '',
        'content' => do_shortcode($content),
      ), $params);

    if ( !$params['bg_color'] ) {
      $params['bg_color'] = Salamander::getData ( 'pricing_bg_color' );
    }

    if ( !$params['border_color'] ) {
      $params['border_color'] = Salamander::getData ( 'pricing_border_color' );
    }

    if ( !$params['divider_color'] ) {
      $params['divider_color'] = Salamander::getData ( 'pricing_divider_color' );
    }

    $params['type'] = 'third';
    if($params['type'] == '2') {
      $params['type'] = 'sep';
    } elseif($params['type'] == '1') {
      $params['type'] = 'full';
    }

    $params['counter'] = $counter;
		$counter++;

		return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'pricing-table.php', $params);
	}

  /**
   * @param $params
   * @param null $content
   * @return string
   * Pricing Column
   */
	public function shortcode_pricing_column($params, $content = null) {
    $params = shortcode_atts(
      array(
        'title' => '',
        'content' => do_shortcode($content),
      ), $params);

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'pricing-column.php', $params);
	}

  /**
   * @param $params
   * @param null $content
   * @return string
   * Pricing price
   */
	function shortcode_pricing_price($params, $content = null) {
    $params = shortcode_atts(
      array(
        'currency' => '',
        'price' => '',
        'time' => '',
        'content' => do_shortcode($content),
      ), $params);

    if(!empty($params['currency']) && !empty($params['price'])) {
      $params['class'] = '';
      $params['price'] = explode('.', $params['price']);
      if($params['price'][1]){
        $params['class'] .= 'price-with-decimal';
      }
    }

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'pricing-price.php', $params);
	}

  /**
   * @param $params
   * @param null $content
   * @return string
   * Pricing Row
   */
	public function shortcode_pricing_row($params, $content = null) {
		$params['content'] = do_shortcode($content);

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'pricing-row.php', $params);
	}

  /**
   * @param $params
   * @param null $content
   * @return string
   * Pricing Footer
   */
	public function shortcode_pricing_footer($params, $content = null) {
    $params['content'] = do_shortcode($content);

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'pricing-footer.php', $params);
	}


  /**
   * @param $params
   * @param null $content
   * @return string
   * Content box shortcode
   */
	function shortcode_content_boxes($params, $content = null) {
    static $counter = 1;
    $params = shortcode_atts(
      array(
			'layout' => 'icon-with-title',
			'icon_color' => '',
			'circle_color' => '',
			'circle_border_color' => '',
			'bg_color' => '',
      'content' => do_shortcode($content),
		), $params);

		if(!$params['icon_color']) {
			$params['icon_color'] = Salamander::getData( 'icon_color' );
		}

		if(!$params['circle_color']) {
      $params['circle_color'] = Salamander::getData( 'icon_circle_color' );
		}

		if(!$params['circle_border_color']) {
      $params['circle_border_color'] = Salamander::getData( 'icon_border_color' );
		}

		if(!$params['bg_color']) {
      $params['bg_color'] = Salamander::getData( 'content_box_bg_color' );
		}
    $params['counter'] = $counter;
		$counter++;

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'content-boxes.php', $params);
	}

	function shortcode_content_box($params, $content = null) {
    $params = shortcode_atts(
      array(
        'last' => 'no',
        'title' => '',
        'icon' => '',
        'image' => '',
        'link_target' => '_self',
        'link_text' => '',
        'link' => '',
        'content' => do_shortcode($content),
      ), $params);

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'content-box.php', $params);
	}

////////////////////////////////////////////////////////////////////
//// Slider
////////////////////////////////////////////////////////////////////
//add_shortcode('slider', 'shortcode_slider');
//	function shortcode_slider($atts, $content = null) {
//		wp_enqueue_script( 'jquery.flexslider' );
//
//		extract(shortcode_atts(array(
//			'width' => '100%',
//			'height' => '100%'
//		), $atts));
//		$str = '';
//		$str .= '<div class="flexslider clearfix" style="max-width:'.$width.';height:'.$height.';">';
//		$str .= '<ul class="slides">';
//		$str .= do_shortcode($content);
//		$str .= '</ul>';
//		$str .= '</div>';
//
//		return $str;
//	}
//
////////////////////////////////////////////////////////////////////
//// Slide
////////////////////////////////////////////////////////////////////
//add_shortcode('slide', 'shortcode_slide');
//	function shortcode_slide($atts, $content = null) {
//		extract(shortcode_atts(array(
//			'linktarget' => '_self',
//			'lightbox' => 'no'
//		), $atts));
//
//		if($lightbox == 'yes') {
//			$rel = 'prettyPhoto';
//		} else {
//			$rel = '';
//		}
//
//		$str = '';
//		if(!empty($atts['type']) && $atts['type'] == 'video') {
//			$str .= '<li class="full-video">';
//		} else {
//			$str .= '<li class="image">';
//		}
//		if(!empty($atts['link']) && $atts['link']):
//			$str .= '<a href="'.$atts['link'].'" target="'.$linktarget.'" rel="'.$rel.'">';
//		endif;
//		if(!empty($atts['type']) && $atts['type'] == 'video') {
//			$str .= do_shortcode($content);
//		} else {
//			$str .= '<img src="'.str_replace('&#215;', 'x', $content).'" alt="" />';
//		}
//		if(!empty($atts['link']) && $atts['link']):
//			$str .= '</a>';
//		endif;
//		$str .= '</li>';
//
//		return $str;
//	}
//


  /**
   * @param $params
   * @param null $content
   * @return string
   * Testimonials
   */
	public function shortcode_testimonials($params, $content = null) {
		global $data;

		wp_enqueue_script( 'jquery.cycle' );

    $params = shortcode_atts(
      array(
			'bg_color' => '',
			'text_color' => '',
      'style_color' => '',
      'content' => do_shortcode($content),
		), $params);

		static $counter = 1;

		if ( ! $params['bg_color'] ) {
			$params['bg_color'] = Salamander::getData( 'testimonial_bg_color' );
		}


		if ( ! $params['text_color'] ) {
			$params['text_color'] = Salamander::getData( 'testimonial_text_color' );
		}

//		$getRgb = Helper::hex2rgb($style_color);

    $params['counter'] = $counter;
		$counter++;

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'testimonials.php', $params);
	}

// Testimonial

	public function shortcode_testimonial($params, $content = null) {
    $params = shortcode_atts(
      array(
        'company' => '',
        'gender' => 'male',
        'name' => '',
        'link' => '',
        'target' => '_blank',
        'content' => do_shortcode($content),
      ), $params);

    return Helper::render(VIEWS_PATH . 'shortcodes' . DS . 'testimonial.php', $params);
	}


////////////////////////////////////////////////////////////////////
//// Progess Bar
////////////////////////////////////////////////////////////////////
//add_shortcode('progress', 'shortcode_progress');
//	function shortcode_progress($atts, $content = null) {
//		global $data;
//
//		wp_enqueue_script( 'jquery.waypoint' );
//
//		extract(shortcode_atts(array(
//			'filledcolor' => '',
//			'unfilledcolor' => '',
//			'value' => '70'
//		), $atts));
//
//		if(!$filledcolor) {
//			$filledcolor = $data['counter_filled_color'];
//		}
//
//		if(!$unfilledcolor) {
//			$unfilledcolor = $data['counter_unfilled_color'];
//		}
//
//		$html = '';
//		$html .= '<div class="progress-bar" style="background-color:'.$unfilledcolor.' !important;border-color:'.$unfilledcolor.' !important;">';
//		$html .= '<div class="progress-bar-content" data-percentage="'.$atts['percentage'].'" style="width: ' . $atts['percentage'] . '%;background-color:'.$filledcolor.' !important;border-color:'.$filledcolor.' !important;">';
//		$html .= '</div>';
//		$html .= '<span class="progress-title">' . $content . ' ' . $atts['percentage'] . '%</span>';
//		$html .= '</div>';
//
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Person
////////////////////////////////////////////////////////////////////
//add_shortcode('person', 'shortcode_person');
//	function shortcode_person($atts, $content = null) {
//		$html = '';
//		$html .= '<div class="person">';
//		if($atts['picture']):
//			$html .= '<img class="person-img" src="' . $atts['picture'] . '" alt="' . $atts['name'] . '" />';
//		endif;
//		if($atts['name'] || $atts['title'] || $atts['facebooklink'] || $atts['twitterlink'] || $atts['linkedinlink'] || $content) {
//			$html .= '<div class="person-desc">';
//			$html .= '<div class="person-author clearfix">';
//			$html .= '<div class="person-author-wrapper"><span class="person-name">' . $atts['name'] . '</span>';
//			$html .= '<span class="person-title">' . $atts['title'] . '</span></div>';
//			if($atts['facebook']) {
//				$html .= '<span class="social-icon"><a href="' . $atts['facebook'] . '" target="'.$atts['linktarget'].'" class="facebook">Facebook</a><div class="popup">
//						<div class="holder">
//							<p>Facebook</p>
//						</div>
//					</div></span>';
//			}
//			if($atts['twitter']) {
//				$html .= '<span class="social-icon"><a href="' . $atts['twitter'] . '" target="'.$atts['linktarget'].'" class="twitter">Twitter</a><div class="popup">
//						<div class="holder">
//							<p>Twitter</p>
//						</div>
//					</div></span>';
//			}
//			if($atts['linkedin']) {
//				$html .= '<span class="social-icon"><a href="' . $atts['linkedin'] . '" target="'.$atts['linktarget'].'" class="linkedin">LinkedIn</a><div class="popup">
//						<div class="holder">
//							<p>LinkedIn</p>
//						</div>
//					</div></span>';
//			}
//			if($atts['dribbble']) {
//				$html .= '<span class="social-icon"><a href="' . $atts['dribbble'] . '" target="'.$atts['linktarget'].'" class="dribbble">Dribbble</a><div class="popup">
//						<div class="holder">
//							<p>Dribbble</p>
//						</div>
//					</div></span>';
//			}
//			$html .= '<div class="clear"></div></div>';
//			$html .= '<div class="person-content">' . do_shortcode($content) . '</div>';
//			$html .= '</div>';
//		}
//		$html .= '</div>';
//
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Recent Posts
////////////////////////////////////////////////////////////////////
//add_shortcode('recent_posts', 'shortcode_recent_posts');
//	function shortcode_recent_posts($atts, $content = null) {
//		global $data;
//
//		wp_enqueue_script( 'jquery.flexslider' );
//
//		extract(shortcode_atts(array(
//			'layout' => 'default',
//			'columns' => 1,
//			'number_posts' => 4,
//			'exclude_cats' =>  ''
//		), $atts));
//
//		if(!isset($atts['columns'])) {
//			$atts['columns'] = 3;
//		}
//
//		if(!isset($atts['excerpt_words'])) {
//			$atts['excerpt_words'] = 15;
//		}
//
//		if(!isset($atts['number_posts'])) {
//			$atts['number_posts'] = 3;
//		}
//
//		if(!isset($atts['strip_html'])) {
//			$atts['strip_html'] = 'true';
//		}
//
//		if($atts['strip_html'] == 'yes') {
//			$atts['strip_html'] = 'true';
//		} elseif($atts['strip_html'] == 'no') {
//			$atts['strip_html'] = 'false';
//		}
//
//		if(!empty($atts['cat_id']) && $atts['cat_id']){
//			$query_atts['category_name'] = $atts['cat_id'];
//		} elseif(!empty($atts['cat_slug']) && $atts['cat_slug']){
//			$query_atts['category_name'] = $atts['cat_slug'];
//		}
//		$query_atts['posts_per_page'] = $atts['number_posts'];
//
//		if($exclude_cats) {
//			$cats_to_exclude = explode(',', $exclude_cats);
//			foreach($cats_to_exclude as $cat_to_exclude) {
//				$idObj = get_category_by_slug($cat_to_exclude);
//				if($idObj) {
//					$cats_id_to_exclude[] = $idObj->term_id;
//				}
//			}
//			if($cats_id_to_exclude) {
//				$query_atts['category__not_in'] = $cats_id_to_exclude;
//			}
//		}
//
//		$recent_posts = new WP_Query($query_atts);
//		if($layout == 'default'):
//			$attachment = '';
//			$html = '<div class="avada-container">';
//			$html .= '<section class="columns columns-'.$atts['columns'].'" style="width:100%">';
//			$html .= '<div class="holder">';
//			$count = 1;
//			while($recent_posts->have_posts()): $recent_posts->the_post();
//				$html .= '<article class="col">';
//				if($atts['thumbnail'] == "yes"):
//					if($data['legacy_posts_slideshow']):
//						$args = array(
//							'post_type' => 'attachment',
//							'numberposts' => $data['posts_slideshow_number']-1,
//							'post_status' => null,
//							'post_mime_type' => 'image',
//							'post_parent' => get_the_ID(),
//							'orderby' => 'menu_order',
//							'order' => 'ASC',
//							'exclude' => get_post_thumbnail_id()
//						);
//						$attachments = get_posts($args);
//						if($attachments || has_post_thumbnail() || get_post_meta(get_the_ID(), 'pyre_video', true)):
//							$html .= '<div class="flexslider floated-post-slideshow">';
//							$html .= '<ul class="slides">';
//							if(get_post_meta(get_the_ID(), 'pyre_video', true)):
//								$html .= '<li class="full-video">';
//								$html .= get_post_meta(get_the_ID(), 'pyre_video', true);
//								$html .= '</li>';
//							endif;
//							if(has_post_thumbnail()):
//								$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'recent-posts');
//								$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
//								$attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id());
//								$html .= '<li>
//					<a href="'.get_permalink(get_the_ID()).'" rel=""><img src="'.$attachment_image[0].'" alt="'.get_the_title().'" /></a>
//				</li>';
//							endif;
//							if($data['posts_slideshow']):
//								foreach($attachments as $attachment):
//									$attachment_image = wp_get_attachment_image_src($attachment->ID, 'recent-posts');
//									$full_image = wp_get_attachment_image_src($attachment->ID, 'full');
//									$attachment_data = wp_get_attachment_metadata($attachment->ID);
//									$html .= '<li>
//					<a href="'.get_permalink(get_the_ID()).'" rel=""><img src="'. $attachment_image[0].'" alt="'.$attachment->post_title.'" /></a>
//				</li>';
//								endforeach;
//							endif;
//							$html .= '</ul>
//		</div>';
//						endif;
//					else:
//						if(has_post_thumbnail() || get_post_meta(get_the_ID(), 'pyre_video', true)):
//							$html .= '<div class="flexslider floated-post-slideshow">';
//							$html .= '<ul class="slides">';
//							if(get_post_meta(get_the_ID(), 'pyre_video', true)):
//								$html .= '<li class="full-video">';
//								$html .= get_post_meta(get_the_ID(), 'pyre_video', true);
//								$html .= '</li>';
//							endif;
//							if(has_post_thumbnail()):
//								$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'recent-posts');
//								$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
//								$attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id());
//								$html .= '<li>
//					<a href="'.get_permalink(get_the_ID()).'" rel=""><img src="'.$attachment_image[0].'" alt="'.get_the_title().'" /></a>
//				</li>';
//							endif;
//							if($data['posts_slideshow']):
//								$i = 2;
//								while($i <= $data['posts_slideshow_number']):
//									$attachment_new_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post');
//									if($attachment_new_id):
//										$attachment_image = wp_get_attachment_image_src($attachment_new_id, 'recent-posts');
//										$full_image = wp_get_attachment_image_src($attachment_new_id, 'full');
//										$attachment_data = wp_get_attachment_metadata($attachment_new_id);
//										$html .= '<li>
//					<a href="'.get_permalink(get_the_ID()).'" rel=""><img src="'. $attachment_image[0].'" alt="" /></a>
//				</li>';
//									endif; $i++; endwhile;
//							endif;
//							$html .= '</ul>
//		</div>';
//						endif;
//					endif;
//				endif;
//				if($atts['title'] == "yes"):
//					$html .= '<h4><a href="'.get_permalink(get_the_ID()).'">'.get_the_title().'</a></h4>';
//				endif;
//				if($atts['meta'] == "yes"):
//					$html .= '<ul class="meta">';
//					$html .= '<li><em class="date">'.get_the_time($data['date_format'], get_the_ID()).'</em></li>';
//					if(get_comments_number(get_the_ID()) >= 1):
//						$html .= '<li><a href="'.get_permalink(get_the_ID()).'">'.get_comments_number(get_the_ID()).' '.__('Comments', 'Avada').'</a></li>';
//					endif;
//					$html .= '</ul>';
//				endif;
//				if($atts['excerpt'] == "yes"):
//					$stripped_content = tf_content( $atts['excerpt_words'], $atts['strip_html'] );
//					$html .= '<p>'.$stripped_content.'</p>';
//				endif;
//				$html .= '</article>';
//				$count++;
//			endwhile;
//			$html .= '</div>';
//			$html .= '</section>';
//			$html .= '</div>';
//		elseif($layout == 'thumbnails-on-side'):
//			$attachment = '';
//			$html = '<div class="avada-container layout-'.$layout.' layout-columns-'.$columns.'">';
//			$html .= '<section class="columns columns-'.$atts['columns'].'" style="width:100%">';
//			$html .= '<div class="holder">';
//			$count = 1;
//			while($recent_posts->have_posts()): $recent_posts->the_post();
//				$html .= '<article class="col clearfix">';
//				if($atts['thumbnail'] == "yes"):
//					if($data['legacy_posts_slideshow']):
//						$args = array(
//							'post_type' => 'attachment',
//							'numberposts' => $data['posts_slideshow_number']-1,
//							'post_status' => null,
//							'post_mime_type' => 'image',
//							'post_parent' => get_the_ID(),
//							'orderby' => 'menu_order',
//							'order' => 'ASC',
//							'exclude' => get_post_thumbnail_id()
//						);
//						$attachments = get_posts($args);
//						if($attachments || has_post_thumbnail() || get_post_meta(get_the_ID(), 'pyre_video', true)):
//							$html .= '<div class="flexslider floated-post-slideshow">';
//							$html .= '<ul class="slides">';
//							if(get_post_meta(get_the_ID(), 'pyre_video', true)):
//								$html .= '<li class="full-video">';
//								$html .= get_post_meta(get_the_ID(), 'pyre_video', true);
//								$html .= '</li>';
//							endif;
//							if(has_post_thumbnail()):
//								$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio-two');
//								$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
//								$attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id());
//								$html .= '<li>
//					<a href="'.get_permalink(get_the_ID()).'" rel=""><img src="'.$attachment_image[0].'" alt="'.get_the_title().'" /></a>
//				</li>';
//							endif;
//							if($data['posts_slideshow']):
//								foreach($attachments as $attachment):
//									$attachment_image = wp_get_attachment_image_src($attachment->ID, 'portfolio-two');
//									$full_image = wp_get_attachment_image_src($attachment->ID, 'full');
//									$attachment_data = wp_get_attachment_metadata($attachment->ID);
//									$html .= '<li>
//					<a href="'.get_permalink(get_the_ID()).'" rel=""><img src="'. $attachment_image[0].'" alt="'.$attachment->post_title.'" /></a>
//				</li>';
//								endforeach;
//							endif;
//							$html .= '</ul>
//		</div>';
//						endif;
//					else:
//						if(has_post_thumbnail() || get_post_meta(get_the_ID(), 'pyre_video', true)):
//							$html .= '<div class="flexslider floated-post-slideshow">';
//							$html .= '<ul class="slides">';
//							if(get_post_meta(get_the_ID(), 'pyre_video', true)):
//								$html .= '<li class="full-video">';
//								$html .= get_post_meta(get_the_ID(), 'pyre_video', true);
//								$html .= '</li>';
//							endif;
//							if(has_post_thumbnail()):
//								$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio-two');
//								$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
//								$attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id());
//								$html .= '<li>
//					<a href="'.get_permalink(get_the_ID()).'" rel=""><img src="'.$attachment_image[0].'" alt="'.get_the_title().'" /></a>
//				</li>';
//							endif;
//							if($data['posts_slideshow']):
//								$i = 2;
//								while($i <= $data['posts_slideshow_number']):
//									$attachment_new_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post');
//									if($attachment_new_id):
//										$attachment_image = wp_get_attachment_image_src($attachment_new_id, 'portfolio-two');
//										$full_image = wp_get_attachment_image_src($attachment_new_id, 'full');
//										$attachment_data = wp_get_attachment_metadata($attachment_new_id);
//										$html .= '<li>
//					<a href="'.get_permalink(get_the_ID()).'" rel=""><img src="'. $attachment_image[0].'" alt="" /></a>
//				</li>';
//									endif; $i++; endwhile;
//							endif;
//							$html .= '</ul>
//		</div>';
//						endif;
//					endif;
//				endif;
//				$html .= '<div class="recent-posts-content">';
//				if($atts['title'] == "yes"):
//					$html .= '<h4><a href="'.get_permalink(get_the_ID()).'">'.get_the_title().'</a></h4>';
//				endif;
//				if($atts['meta'] == "yes"):
//					$html .= '<ul class="meta">';
//					$html .= '<li>'.get_the_time($data['date_format'], get_the_ID()).'</li>';
//					if(get_comments_number(get_the_ID()) >= 1):
//						$html .= '<li><a href="'.get_permalink(get_the_ID()).'">'.get_comments_number(get_the_ID()).' '.__('Comments', 'Avada').'</a></li>';
//					endif;
//					$html .= '</ul>';
//				endif;
//				if($atts['excerpt'] == "yes"):
//					$stripped_content = tf_content( $atts['excerpt_words'], $atts['strip_html'] );
//					$html .= $stripped_content;
//				endif;
//				$html .= '</div>';
//				$html .= '</article>';
//				$count++;
//			endwhile;
//			$html .= '</div>';
//			$html .= '</section>';
//			$html .= '</div>';
//		elseif($layout == 'date-on-side'):
//			$attachment = '';
//			$html = '<div class="avada-container layout-'.$layout.' layout-columns-'.$columns.'">';
//			$html .= '<section class="columns columns-'.$atts['columns'].'" style="width:100%">';
//			$html .= '<div class="holder">';
//			$count = 1;
//			while($recent_posts->have_posts()): $recent_posts->the_post();
//				$html .= '<article class="col clearfix">';
//				$html .= '<div class="date-and-formats">
//			<div class="date-box">
//				<span class="date">'.get_the_time('j').'</span>
//				<span class="month-year">'.get_the_time('m, Y').'</span>
//			</div>';
//				$html .= '<div class="format-box">';
//				switch(get_post_format()) {
//					case 'gallery':
//						$format_class = 'camera-retro';
//						break;
//					case 'link':
//						$format_class = 'link';
//						break;
//					case 'image':
//						$format_class = 'picture';
//						break;
//					case 'quote':
//						$format_class = 'quote-left';
//						break;
//					case 'video':
//						$format_class = 'film';
//						break;
//					case 'audio':
//						$format_class = 'headphones';
//						break;
//					case 'chat':
//						$format_class = 'comments-alt';
//						break;
//					default:
//						$format_class = 'book';
//						break;
//				}
//				$html .= '<i class="icon-'.$format_class.'"></i>
//			</div>
//		</div>';
//				$html .= '<div class="recent-posts-content">';
//				if($atts['title'] == "yes"):
//					$html .= '<h4><a href="'.get_permalink(get_the_ID()).'">'.get_the_title().'</a></h4>';
//				endif;
//				if($atts['meta'] == "yes"):
//					$html .= '<ul class="meta">';
//					$html .= '<li>'.get_the_time($data['date_format'], get_the_ID()).'</li>';
//					if(get_comments_number(get_the_ID()) >= 1):
//						$html .= '<li><a href="'.get_permalink(get_the_ID()).'">'.get_comments_number(get_the_ID()).' '.__('Comments', 'Avada').'</a></li>';
//					endif;
//					$html .= '</ul>';
//				endif;
//				if($atts['excerpt'] == "yes"):
//					$stripped_content = tf_content( $atts['excerpt_words'], $atts['strip_html'] );
//					$html .= $stripped_content;
//				endif;
//				$html .= '</div>';
//				$html .= '</article>';
//				$count++;
//			endwhile;
//			$html .= '</div>';
//			$html .= '</section>';
//			$html .= '</div>';
//		endif;
//
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Recent Works
////////////////////////////////////////////////////////////////////
//add_shortcode('recent_works', 'shortcode_recent_works');
//	function shortcode_recent_works($atts, $content = null) {
//		global $data;
//
//		static $recent_works_counter = 1;
//
//		wp_enqueue_script( 'jquery.isotope' );
//		wp_enqueue_script( 'jquery.carouFredSel' );
//
//		extract(shortcode_atts(array(
//			'layout' => 'carousel',
//			'filters' => 'true',
//			'columns' => 4,
//			'cat_slug' => '',
//			'number_posts' => 10,
//			'excerpt_words' => 15,
//		), $atts));
//
//		if($columns == 1) {
//			$columns_words = 'one';
//			$portfolio_image_size = 'full';
//		} elseif($columns == 2) {
//			$columns_words = 'two';
//			$portfolio_image_size = 'portfolio-two';
//		} elseif($columns == 3) {
//			$columns_words = 'three';
//			$portfolio_image_size = 'portfolio-three';
//		} elseif($columns == 4) {
//			$columns_words = 'four';
//			$portfolio_image_size = 'portfolio-four';
//		}
//
//		if($filters == 'yes') {
//			$filters = 'true';
//		} elseif($filters == 'no') {
//			$filters = 'false';
//		}
//
//		$html = '';
//
//		wp_reset_query();
//
//		if($layout == 'carousel') {
//			$html .= '<div class="related-posts related-projects">';
//			$html .= '<div id="carousel" class="es-carousel-wrapper">';
//			$html .= '<div class="es-carousel">';
//			$html .= '<ul class="">';
//			if(isset($atts['number_posts']) && !empty($atts['number_posts'])) {
//				$number_posts = $atts['number_posts'];
//			} else {
//				$number_posts = 10;
//			}
//			$args = array(
//				'post_type' => 'avada_portfolio',
//				'paged' => 1,
//				'posts_per_page' => $number_posts,
//			);
//			if(isset($atts['cat_id']) && !empty($atts['cat_id'])){
//				$cat_id = explode(',', $atts['cat_id']);
//				$args['tax_query'] = array(
//					array(
//						'taxonomy' => 'portfolio_category',
//						'field' => 'slug',
//						'terms' => $cat_id
//					)
//				);
//			} elseif(isset($atts['cat_slug']) && !empty($atts['cat_slug'])){
//				$cat_id = explode(',', $atts['cat_slug']);
//				$args['tax_query'] = array(
//					array(
//						'taxonomy' => 'portfolio_category',
//						'field' => 'slug',
//						'terms' => $cat_id
//					)
//				);
//			}
//
//			$works = new WP_Query($args);
//			while($works->have_posts()): $works->the_post();
//				if(has_post_thumbnail()):
//					$html .= '<li>';
//					$html .= '<div class="image">';
//					if($data['image_rollover']):
//						$html .= get_the_post_thumbnail(get_the_ID(), 'related-img');
//					else:
//						$html .= '<a href="'.get_permalink(get_the_ID()).'">'.get_the_post_thumbnail(get_the_ID(), 'related-img').'</a>';
//					endif;
//					//$html .= '<a href="'.get_permalink(get_the_ID()).'">'.get_the_post_thumbnail(get_the_ID(), 'related-img').'</a>';
//					if(get_post_meta(get_the_ID(), 'pyre_image_rollover_icons', true) == 'link') {
//						$link_icon_css = 'display:inline-block;';
//						$zoom_icon_css = 'display:none;';
//					} elseif(get_post_meta(get_the_ID(), 'pyre_image_rollover_icons', true) == 'zoom') {
//						$link_icon_css = 'display:none;';
//						$zoom_icon_css = 'display:inline-block;';
//					} elseif(get_post_meta(get_the_ID(), 'pyre_image_rollover_icons', true) == 'no') {
//						$link_icon_css = 'display:none;';
//						$zoom_icon_css = 'display:none;';
//					} else {
//						$link_icon_css = 'display:inline-block;';
//						$zoom_icon_css = 'display:inline-block;';
//					}
//
//					$icon_url_check = get_post_meta(get_the_ID(), 'pyre_link_icon_url', true); if(!empty($icon_url_check)) {
//					$icon_permalink = get_post_meta(get_the_ID(), 'pyre_link_icon_url', true);
//				} else {
//					$icon_permalink = get_permalink(get_the_ID());
//				}
//					$html .= '<div class="image-extras">';
//					$html .= '<div class="image-extras-content">';
//					$html .= '<a style="'.$link_icon_css.'" class="icon link-icon" style="margin-right:3px;" href="'.$icon_permalink.'">';
//					$html .= 'Permalink';
//					$html .= '</a>';
//					$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
//					if(get_post_meta(get_the_ID(), 'pyre_video_url', true)) {
//						$full_image[0] = get_post_meta(get_the_ID(), 'pyre_video_url', true);
//					}
//					$html .= '<a style="'.$zoom_icon_css.'" class="icon gallery-icon" href="'.$full_image[0].'" rel="prettyPhoto[gallery_recent_'.$recent_works_counter.']">Gallery</a>';
//					$html .= '<h3>'.get_the_title().'</h3>';
//					$html .= '</div>
//								</div>
//						</div>
//					</li>';
//				endif; endwhile;
//			$html .= '</ul>
//			</div>
//			<div class="es-nav"><span class="es-nav-prev">Previous</span><span class="es-nav-next">Next</span></div>
//		</div>
//	</div>';
//			wp_reset_query();
//		} elseif($layout == 'grid') {
//			$html .= '<div class="portfolio portfolio-grid clearfix portfolio-'.$columns_words.'" data-columns="'.$columns_words.'">';
//
//			$portfolio_category = get_terms('portfolio_category');
//			if($portfolio_category && $filters == 'true'):
//				$html .= '<ul class="portfolio-tabs clearfix">
//			<li class="active"><a data-filter="*" href="#">'.__('All', 'Avada').'</a></li>';
//				foreach($portfolio_category as $portfolio_cat):
//					if($atts['cat_slug']):
//						$cat_slug = preg_replace('/\s+/', '', $atts['cat_slug']);
//						$cat_slug = explode(',', $cat_slug);
//						if(in_array($portfolio_cat->slug, $cat_slug)):
//							$html .='<li><a data-filter=".'.$portfolio_cat->slug.'" href="#">'.$portfolio_cat->name.'</a></li>';
//						endif;
//					else:
//						$html .= '<li><a data-filter=".'.$portfolio_cat->slug.'" href="#">'.$portfolio_cat->name.'</a></li>';
//					endif;
//				endforeach;
//				$html .= '</ul>';
//			endif;
//
//			$html .= '<div class="portfolio-wrapper">';
//
//			$args = array(
//				'post_type' => 'avada_portfolio',
//				'posts_per_page' => $number_posts
//			);
//			if(isset($atts['cat_id']) && !empty($atts['cat_id'])){
//				$cat_id = explode(',', $atts['cat_id']);
//				$args['tax_query'] = array(
//					array(
//						'taxonomy' => 'portfolio_category',
//						'field' => 'slug',
//						'terms' => $cat_id
//					)
//				);
//			} elseif(isset($atts['cat_slug']) && !empty($atts['cat_slug'])){
//				$cat_id = explode(',', $atts['cat_slug']);
//				$args['tax_query'] = array(
//					array(
//						'taxonomy' => 'portfolio_category',
//						'field' => 'slug',
//						'terms' => $cat_id
//					)
//				);
//			}
//			$gallery = new WP_Query($args);
//			while($gallery->have_posts()): $gallery->the_post();
//				if(has_post_thumbnail() || get_post_meta(get_the_ID(), 'pyre_video', true)):
//					$item_classes = '';
//					$item_cats = get_the_terms(get_the_ID(), 'portfolio_category');
//					if($item_cats):
//						foreach($item_cats as $item_cat) {
//							$item_classes .= $item_cat->slug . ' ';
//						}
//					endif;
//
//					$permalink = get_permalink();
//
//					$html .= '<div class="portfolio-item '.$item_classes.'">';
//					if(has_post_thumbnail()):
//						$html .= '<div class="image">';
//						if($data['image_rollover']):
//							$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $portfolio_image_size);
//							$html .= '<img src="'.$thumbnail[0].'" alt="'.get_post_field('post_excerpt', get_post_thumbnail_id(get_the_ID())).'" />';
//						else:
//							$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $portfolio_image_size);
//							$html .= '<a href="'.$permalink.'">'.'<img src="'.$thumbnail[0].'" alt="'.get_post_field('post_excerpt', get_post_thumbnail_id(get_the_ID())).'" />'.'</a>';
//						endif;
//						if(get_post_meta(get_the_ID(), 'pyre_image_rollover_icons', true) == 'link') {
//							$link_icon_css = 'display:inline-block;';
//							$zoom_icon_css = 'display:none;';
//						} elseif(get_post_meta(get_the_ID(), 'pyre_image_rollover_icons', true) == 'zoom') {
//							$link_icon_css = 'display:none;';
//							$zoom_icon_css = 'display:inline-block;';
//						} elseif(get_post_meta(get_the_ID(), 'pyre_image_rollover_icons', true) == 'no') {
//							$link_icon_css = 'display:none;';
//							$zoom_icon_css = 'display:none;';
//						} else {
//							$link_icon_css = 'display:inline-block;';
//							$zoom_icon_css = 'display:inline-block;';
//						}
//
//						$icon_url_check = get_post_meta(get_the_ID(), 'pyre_link_icon_url', true); if(!empty($icon_url_check)) {
//						$icon_permalink = get_post_meta(get_the_ID(), 'pyre_link_icon_url', true);
//					} else {
//						$icon_permalink = get_permalink(get_the_ID());
//					}
//						$html .= '<div class="image-extras">
//							<div class="image-extras-content">';
//						$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
//						$html .= '<a style="'.$link_icon_css.'" class="icon link-icon" href="'.$icon_permalink.'">Permalink</a>';
//
//						if(get_post_meta(get_the_ID(), 'pyre_video_url', true)) {
//							$full_image[0] = get_post_meta(get_the_ID(), 'pyre_video_url', true);
//						}
//
//						$html .= '<a style="'.$zoom_icon_css.'" class="icon gallery-icon" href="'.$full_image[0].'" rel="prettyPhoto[gallery_recent_'.$recent_works_counter.']" title="'.get_post_field('post_content', get_post_thumbnail_id(get_the_ID())).'"><img style="display:none;" alt="'.get_post_field('post_excerpt', get_post_thumbnail_id(get_the_ID())).'" />Gallery</a>';
//						$html .= '<h3>'.get_the_title().'</h3>';
//						$html .= '<h4>'.get_the_term_list(get_the_ID(), 'portfolio_category', '', ', ', '').'</h4>';
//						$html .= '</div>
//						</div>
//					</div>';
//					endif;
//					$html .= '</div>';
//				endif;
//			endwhile;
//			wp_reset_query();
//
//			$html .= '</div>';
//
//			$html .= '</div>';
//		} elseif($layout == 'grid-with-excerpts') {
//			$html .= '<div class="portfolio clearfix portfolio-'.$columns_words.'-text portfolio-'.$columns_words.'" data-columns="'.$columns_words.'">';
//
//			$portfolio_category = get_terms('portfolio_category');
//			if($portfolio_category && $filters == 'true'):
//				$html .= '<ul class="portfolio-tabs clearfix">
//			<li class="active"><a data-filter="*" href="#">'.__('All', 'Avada').'</a></li>';
//				foreach($portfolio_category as $portfolio_cat):
//					if($atts['cat_slug']):
//						$cat_slug = preg_replace('/\s+/', '', $atts['cat_slug']);
//						$cat_slug = explode(',', $cat_slug);
//						if(in_array($portfolio_cat->slug, $cat_slug)):
//							$html .='<li><a data-filter=".'.$portfolio_cat->slug.'" href="#">'.$portfolio_cat->name.'</a></li>';
//						endif;
//					else:
//						$html .= '<li><a data-filter=".'.$portfolio_cat->slug.'" href="#">'.$portfolio_cat->name.'</a></li>';
//					endif;
//				endforeach;
//				$html .= '</ul>';
//			endif;
//
//			$html .= '<div class="portfolio-wrapper">';
//
//			$args = array(
//				'post_type' => 'avada_portfolio',
//				'posts_per_page' => $number_posts
//			);
//			if(isset($atts['cat_id']) && !empty($atts['cat_id'])){
//				$cat_id = explode(',', $atts['cat_id']);
//				$args['tax_query'] = array(
//					array(
//						'taxonomy' => 'portfolio_category',
//						'field' => 'slug',
//						'terms' => $cat_id
//					)
//				);
//			} elseif(isset($atts['cat_slug']) && !empty($atts['cat_slug'])){
//				$cat_id = explode(',', $atts['cat_slug']);
//				$args['tax_query'] = array(
//					array(
//						'taxonomy' => 'portfolio_category',
//						'field' => 'slug',
//						'terms' => $cat_id
//					)
//				);
//			}
//			$gallery = new WP_Query($args);
//			while($gallery->have_posts()): $gallery->the_post();
//				if(has_post_thumbnail() || get_post_meta(get_the_ID(), 'pyre_video', true)):
//					$item_classes = '';
//					$item_cats = get_the_terms(get_the_ID(), 'portfolio_category');
//					if($item_cats):
//						foreach($item_cats as $item_cat) {
//							$item_classes .= $item_cat->slug . ' ';
//						}
//					endif;
//
//					$permalink = get_permalink();
//
//					$html .= '<div class="portfolio-item '.$item_classes.'">';
//					if(has_post_thumbnail()):
//						$html .= '<div class="image">';
//						if($data['image_rollover']):
//							$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $portfolio_image_size);
//							$html .= '<img src="'.$thumbnail[0].'" alt="'.get_post_field('post_excerpt', get_post_thumbnail_id(get_the_ID())).'" />';
//						else:
//							$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $portfolio_image_size);
//							$html .= '<a href="'.$permalink.'"><img src="'.$thumbnail[0].'" alt="'.get_post_field('post_excerpt', get_post_thumbnail_id(get_the_ID())).'" /></a>';
//						endif;
//						if(get_post_meta(get_the_ID(), 'pyre_image_rollover_icons', true) == 'link') {
//							$link_icon_css = 'display:inline-block;';
//							$zoom_icon_css = 'display:none;';
//						} elseif(get_post_meta(get_the_ID(), 'pyre_image_rollover_icons', true) == 'zoom') {
//							$link_icon_css = 'display:none;';
//							$zoom_icon_css = 'display:inline-block;';
//						} elseif(get_post_meta(get_the_ID(), 'pyre_image_rollover_icons', true) == 'no') {
//							$link_icon_css = 'display:none;';
//							$zoom_icon_css = 'display:none;';
//						} else {
//							$link_icon_css = 'display:inline-block;';
//							$zoom_icon_css = 'display:inline-block;';
//						}
//
//						$icon_url_check = get_post_meta(get_the_ID(), 'pyre_link_icon_url', true); if(!empty($icon_url_check)) {
//						$icon_permalink = get_post_meta(get_the_ID(), 'pyre_link_icon_url', true);
//					} else {
//						$icon_permalink = get_permalink(get_the_ID());
//					}
//						$html .= '<div class="image-extras">
//							<div class="image-extras-content">';
//						$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
//						$html .= '<a style="'.$link_icon_css.'" class="icon link-icon" href="'.$icon_permalink.'">Permalink</a>';
//
//						if(get_post_meta(get_the_ID(), 'pyre_video_url', true)) {
//							$full_image[0] = get_post_meta(get_the_ID(), 'pyre_video_url', true);
//						}
//
//						$html .= '<a style="'.$zoom_icon_css.'" class="icon gallery-icon" href="'.$full_image[0].'" rel="prettyPhoto[gallery_recent_'.$recent_works_counter.']" title="'.get_post_field('post_content', get_post_thumbnail_id(get_the_ID())).'"><img style="display:none;" alt="'.get_post_field('post_excerpt', get_post_thumbnail_id(get_the_ID())).'" />Gallery</a>';
//						$html .= '<h3>'.get_the_title().'</h3>';
//						$html .= '<h4>'.get_the_term_list(get_the_ID(), 'portfolio_category', '', ', ', '').'</h4>';
//						$html .= '</div>
//						</div>
//					</div>';
//						$html .= '<div class="portfolio-content">
//						<h2><a href="'.$permalink.'">'.get_the_title().'</a></h2>
//						<h4>'.get_the_term_list(get_the_ID(), 'portfolio_category', '', ', ', '').'</h4>';
//
//						$excerpt_length = $excerpt_words;
//
//						$stripped_content = strip_shortcodes( tf_content( $excerpt_length, $data['strip_html_excerpt'] ) );
//						$html .= $stripped_content;
//
//						if($columns == 1):
//							$html .= '<div class="buttons">
//							<a href="'.$permalink.'" class="green button small">'.__('Learn More', 'Avada').'</a>';
//							if(get_post_meta(get_the_ID(), 'pyre_project_url', true)):
//								$html .= '<a href="'.get_post_meta(get_the_ID(), 'pyre_project_url', true).'" class="green button small">'.__('View Project', 'Avada').'</a>';
//							endif;
//							$html .= '</div>';
//						endif;
//						$html .= '</div>';
//					endif;
//					$html .= '</div>';
//				endif;
//			endwhile;
//			wp_reset_query();
//
//			$html .= '</div>';
//
//			$html .= '</div>';
//		}
//
//		$recent_works_counter++;
//
//		return $html;
//	}
//
//
////////////////////////////////////////////////////////////////////
//// Alert Message
////////////////////////////////////////////////////////////////////
//add_shortcode('alert', 'shortcode_alert');
//	function shortcode_alert($atts, $content = null) {
//		$html = '';
//		$html .= '<div class="alert '.$atts['type'].'">';
//		$html .= '<div class="msg">'.do_shortcode($content).'</div>';
//		$html .= '<a href="#" class="toggle-alert">Toggle</a>';
//		$html .= '</div>';
//
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// FontAwesome Icons
////////////////////////////////////////////////////////////////////
//add_shortcode('fontawesome', 'shortcode_fontawesome');
//	function shortcode_fontawesome($atts, $content = null) {
//		global $data;
//
//		extract(shortcode_atts(array(
//			'iconcolor' => '',
//			'circlecolor' => '',
//			'circlebordercolor' => '',
//		), $atts));
//
//		if(!$iconcolor) {
//			$iconcolor = $data['icon_color'];
//		}
//
//		if(!$circlecolor) {
//			$circlecolor = $data['icon_circle_color'];
//		}
//
//		if(!$circlebordercolor) {
//			$circlebordercolor = $data['icon_border_color'];
//		}
//
//		$style = 'color:'.$iconcolor.' !important;';
//
//		if($atts['circle'] == 'yes') {
//			$style .= 'background-color:'.$circlecolor.' !important;border:1px solid '.$circlebordercolor.' !important;';
//		}
//
//		$html = '<i style="'.$style.'"class="fontawesome-icon '.$atts['size'].' circle-'.$atts['circle'].' icon-'.$atts['icon'].'"></i>';
//
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Social Links
////////////////////////////////////////////////////////////////////
//add_shortcode('social_links', 'shortcode_social_links');
//	function shortcode_social_links($atts, $content = null) {
//		global $data;
//
//		extract(shortcode_atts(array(
//			'colorscheme' => '',
//			'linktarget' => '_self'
//		), $atts));
//
//		if(!$colorscheme) {
//			$colorscheme = strtolower($data['social_links_color']);
//		}
//
//		$html = '<div class="social_links_shortcode clearfix">';
//		$html .= '<ul class="social-networks social-networks-'.$colorscheme.' clearfix">';
//		foreach($atts as $key => $link) {
//			if($link && $key != 'linktarget' && $key != 'colorscheme') {
//				$html .= '<li class="'.$key.'">
//			<a class="'.$key.'" href="'.$link.'" target="'.$linktarget.'">'.ucwords($key).'</a>
//			<div class="popup">
//				<div class="holder">
//					<p>'.ucwords($key).'</p>
//				</div>
//			</div>
//			</li>';
//			}
//		}
//		$html .= '</ul>';
//		$html .= '</div>';
//
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Clients container
////////////////////////////////////////////////////////////////////
//add_shortcode('clients', 'shortcode_clients');
//	function shortcode_clients($atts, $content = null) {
//		wp_enqueue_script( 'jquery.carouFredSel' );
//
//		$html = '<div class="related-posts related-projects"><div id="carousel" class="clients-carousel es-carousel-wrapper"><div class="es-carousel"><ul>';
//		$html .= do_shortcode($content);
//		$html .= '</ul><div class="es-nav"><span class="es-nav-prev">Previous</span><span class="es-nav-next">Next</span></div></div></div></div>';
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Client
////////////////////////////////////////////////////////////////////
//add_shortcode('client', 'shortcode_client');
//	function shortcode_client($atts, $content = null) {
//		extract(shortcode_atts(array(
//			'linktarget' => '_self',
//		), $atts));
//
//		$html = '<li>';
//		$html .= '<a href="'.$atts['link'].'" target="'.$linktarget.'"><img src="'.$atts['image'].'" alt="" /></a>';
//		$html .= '</li>';
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Title
////////////////////////////////////////////////////////////////////
//add_shortcode('title', 'shortcode_title');
//	function shortcode_title($atts, $content = null) {
//
//		$html = '<div class="title"><h'.$atts['size'].'>'.do_shortcode($content).'</h'.$atts['size'].'><div class="title-sep-container"><div class="title-sep"></div></div></div>';
//
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Separator
////////////////////////////////////////////////////////////////////
//add_shortcode('separator', 'shortcode_separator');
//	function shortcode_separator($atts, $content = null) {
//		extract(shortcode_atts(array(
//			'style' => 'none',
//		), $atts));
//		$html = '';
//		$css = '';
//		if($style != 'none') {
//			$css = 'margin-bottom:'.$atts['top'].'px';
//		}
//		$html .= '<div class="demo-sep sep-'.$style.'" style="margin-top:'.$atts['top'].'px;'.$css.'"></div>';
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Tooltip
////////////////////////////////////////////////////////////////////
//add_shortcode('tooltip', 'shortcode_tooltip');
//	function shortcode_tooltip($atts, $content = null) {
//		extract(shortcode_atts(array(
//			'title' => 'none',
//		), $atts));
//
//		$html = '<span class="tooltip-shortcode">';
//		$html .= $content;
//		$html .= '<span class="popup">
//		<span class="holder">
//			<span>'.$title.'</span>
//		</span>
//	</span>';
//		$html .= '</span>';
//
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Full Width
////////////////////////////////////////////////////////////////////
//add_shortcode('fullwidth', 'shortcode_fullwidth');
//	function shortcode_fullwidth($atts, $content = null) {
//		extract(shortcode_atts(array(
//			'backgroundcolor' => '',
//			'backgroundimage' => '',
//			'backgroundrepeat' => 'no-repeat',
//			'backgroundposition' => 'top left',
//			'backgroundattachment' => 'scroll',
//			'bordersize' => '1px',
//			'bordercolor' => '',
//			'paddingtop' => '20px',
//			'paddingbottom' => '20px'
//		), $atts));
//
//		$css = '';
//		if($backgroundrepeat == 'no-repeat') {
//			$css .= '-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;';
//		}
//
//		$html = '<div class="fullwidth-box" style="background-color:'.$backgroundcolor.';background-image:url('.$backgroundimage.');background-repeat:'.$backgroundrepeat.';background-position:'.$backgroundposition.';background-attachment:'.$backgroundattachment.';border-top:'.$bordersize.' solid '.$bordercolor.';border-bottom:'.$bordersize.' solid '.$bordercolor.';padding-top:'.$paddingtop.';padding-bottom:'.$paddingbottom.';'.$css.'">';
//		$html .= '<div class="avada-row">';
//		$html .= do_shortcode($content);
//		$html .= '</div>';
//		$html .= '</div>';
//
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Google Map
////////////////////////////////////////////////////////////////////
//add_shortcode('map', 'shortcode_google_map');
//	function shortcode_google_map($atts, $content = null) {
//		wp_enqueue_script( 'gmaps.api' );
//		wp_enqueue_script( 'jquery.ui.map' );
//
//		extract(shortcode_atts(array(
//			'address' => '',
//			'type' => 'satellite',
//			'width' => '100%',
//			'height' => '300px',
//			'zoom' => '14',
//			'scrollwheel' => 'true',
//			'scale' => 'true',
//			'zoom_pancontrol' => 'true',
//		), $atts));
//
//		static $avada_map_counter = 1;
//
//		if($scrollwheel == 'yes') {
//			$scrollwheel = 'true';
//		} elseif($scrollwheel == 'no') {
//			$scrollwheel = 'false';
//		}
//
//		if($scale == 'yes') {
//			$scale = 'true';
//		} elseif($scale == 'no') {
//			$scale = 'false';
//		}
//
//		if($zoom_pancontrol == 'yes') {
//			$zoom_pancontrol = 'true';
//		} elseif($zoom_pancontrol == 'no') {
//			$zoom_pancontrol = 'false';
//		}
//
//		$addresses = explode('|', $address);
//
//		$markers = '';
//		foreach($addresses as $address_string) {
//			$markers .= "{
//			address: '{$address_string}',
//			html: {
//				content: '{$address_string}',
//				popup: true
//			}
//		},";
//		}
//
//		if(!$data['status_gmap']) {
//			$html = "<script type='text/javascript'>
//		jQuery(document).ready(function($) {
//			jQuery('#gmap-{$avada_map_counter}').goMap({
//				address: '{$addresses[0]}',
//				zoom: {$zoom},
//				scrollwheel: {$scrollwheel},
//				scaleControl: {$scale},
//				navigationControl: {$zoom_pancontrol},
//				maptype: '{$type}',
//		        markers: [{$markers}]
//			});
//		});
//		</script>";
//		}
//
//		$html .= '<div class="shortcode-map" id="gmap-'.$avada_map_counter.'" style="width:'.$width.';height:'.$height.';">';
//		$html .= '</div>';
//
//		$avada_map_counter++;
//
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Counters (Circle)
////////////////////////////////////////////////////////////////////
//add_shortcode('counters_circle', 'shortcode_counters_circle');
//	function shortcode_counters_circle($atts, $content = null) {
//		$html = '<div class="counters-circle clearfix">';
//		$html .= do_shortcode($content);
//		$html .= '</div>';
//
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Counter (Circle)
////////////////////////////////////////////////////////////////////
//add_shortcode('counter_circle', 'shortcode_counter_circle');
//	function shortcode_counter_circle($atts, $content = null) {
//		global $data;
//
//		wp_enqueue_script( 'jquery.waypoint' );
//		wp_enqueue_script( 'jquery.gauge' );
//
//		extract(shortcode_atts(array(
//			'filledcolor' => '',
//			'unfilledcolor' => '',
//			'value' => '70'
//		), $atts));
//
//		if(!$filledcolor) {
//			$filledcolor = $data['counter_filled_color'];
//		}
//
//		if(!$unfilledcolor) {
//			$unfilledcolor = $data['counter_unfilled_color'];
//		}
//
//		static $avada_counter_circle = 1;
//
//		if(!$data['status_gauge']) {
//			$html = "<script type='text/javascript'>
//		jQuery(document).ready(function() {
//			var opts = {
//			  lines: 12, // The number of lines to draw
//			  angle: 0.5, // The length of each line
//			  lineWidth: 0.05, // The line thickness
//			  colorStart: '{$filledcolor}',   // Colors
//			  colorStop: '{$filledcolor}',    // just experiment with them
//			  strokeColor: '{$unfilledcolor}',   // to see which ones work best for you
//			  generateGradient: false
//			};
//			var gauge_{$avada_counter_circle} = new Donut(document.getElementById('counter-circle-{$avada_counter_circle}')).setOptions(opts); // create sexy gauge!
//			gauge_{$avada_counter_circle}.maxValue = 100; // set max gauge value
//			gauge_{$avada_counter_circle}.animationSpeed = 128; // set animation speed (32 is default value)
//			gauge_{$avada_counter_circle}.set({$value}); // set actual value
//		});
//		</script>";
//		}
//
//		$html .= '<div class="counter-circle-wrapper">';
//		$html .= '<canvas width="220" height="220" class="counter-circle" id="counter-circle-'.$avada_counter_circle.'">';
//		$html .= '</canvas>';
//		$html .= '<div class="counter-circle-content">';
//		$html .= do_shortcode($content);
//		$html .= '</div>';
//		$html .= '</div>';
//
//		$avada_counter_circle++;
//
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Counters Box
////////////////////////////////////////////////////////////////////
//add_shortcode('counters_box', 'shortcode_counters_box');
//	function shortcode_counters_box($atts, $content = null) {
//		$html = '<div class="counters-box">';
//		$html .= do_shortcode($content);
//		$html .= '</div>';
//
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Counter Box
////////////////////////////////////////////////////////////////////
//add_shortcode('counter_box', 'shortcode_counter_box');
//	function shortcode_counter_box($atts, $content = null) {
//		extract(shortcode_atts(array(
//			'value' => '70'
//		), $atts));
//
//		$html = '';
//		$html .= '<div class="counter-box-wrapper">';
//		$html .= '<div class="content-box-percentage">';
//		$html .= '<span class="display-percentage" data-percentage="'.$value.'">0</span><span class="percent">%</span>';
//		$html .= '</div>';
//		$html .= '<div class="counter-box-content">';
//		$html .= do_shortcode($content);
//		$html .= '</div>';
//		$html .= '</div>';
//
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Flexslider
////////////////////////////////////////////////////////////////////
//add_shortcode('flexslider', 'shortcode_flexslider');
//	function shortcode_flexslider($atts, $content = null) {
//		extract(shortcode_atts(array(
//			'layout' => 'posts',
//			'excerpt' => '25',
//			'category' => '',
//			'limit' => '3',
//			'id' => '',
//			'lightbox' => 'no'
//		), $atts));
//
//		$shortcode = '';
//
//		if($layout == 'posts') {
//			if($id) {
//				$shortcode .= 'id="'.$id.'"';
//			}
//			if($category) {
//				$shortcode .= ' category="'.$category.'"';
//			}
//			$html = do_shortcode('[wooslider slider_type="posts" layout="text-bottom" overlay="natural" link_title="true" display_excerpt="false" limit="'.$limit.'" excerpt="'.$excerpt.'" '.$shortcode.']');
//		} elseif($layout == 'posts-with-excerpt') {
//			if($id) {
//				$shortcode .= 'id="'.$id.'"';
//			}
//			if($category) {
//				$shortcode .= ' category="'.$category.'"';
//			}
//			$html = do_shortcode('[wooslider slider_type="posts" layout="text-left" overlay="full" link_title="true" display_excerpt="true" limit="'.$limit.'" excerpt="'.$excerpt.'" '.$shortcode.']');
//		} else {
//			if($id) {
//				$shortcode .= 'id="'.$id.'"';
//			}
//			$html = do_shortcode('[wooslider limit="'.$limit.'" slider_type="attachments" thumbnails="true" '.$shortcode.' lightbox="'.$lightbox.'"]');
//		}
//
//		return $html;
//	}
//
//
////////////////////////////////////////////////////////////////////
//// Blog Shortcode. Credits: media-lounge.at
////////////////////////////////////////////////////////////////////
//	function blog_shortcode($atts) {
//		global $data;
//		global $post;
//
//		wp_enqueue_script( '/js/jquery.flexslider-min' );
//
//
//
//
//		if((is_front_page() || is_home() ) ) {
//			$paged = (get_query_var('paged')) ?get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
//		} else {
//			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
//		}
//
//		// get specified number of posts per page
//		if (isset($atts['number_posts'])) {
//
//			$atts = shortcode_atts( array(
//				'author'              => '',
//				'author_name'		  => '',
//				'category_name'       => '',
//				'cat'      			  => '',
//				'id'                  => false,
//				'p'					  => false,
//				'post__in'			  => false,
//				'order'               => 'DESC',
//				'orderby'             => 'date',
//				'post_status'         => 'publish',
//				'post_type'           => 'post',
//				'posts_per_page'	  => $atts['number_posts'],
//				'nopaging'			  => false,
//				'paged'				  => $paged,
//				'tag'                 => '',
//				'tax_operator'        => 'IN',
//				'tax_term'            => false,
//				'taxonomy'            => 'category',
//				'title_meta'		  => '',
//				'include_shortcodes'  => false,
//				'layout' 			  => 'large',
//
//				'cat_slug'			  => '',
//				'title'				  => true,
//				'meta_all'			  => true,
//				'meta_author' 		  => true,
//				'meta_date' 		  => true,
//				'meta_categories'  	  => true,
//				'meta_comments'  	  => true,
//				'meta_link'  	  	  => true,
//				'thumbnail'			  => true,
//				'excerpt'			  => true,
//				'excerpt_words'		  => '50',
//				'strip_html'		  => true,
//				'paging'			  => true,
//				'scrolling'		      => 'infinite'
//			), $atts );
//
//		} else {
//			// get all posts, i.e. default
//			$atts = shortcode_atts( array(
//				'author'              => '',
//				'author_name'		  => '',
//				'category_name'       => '',
//				'cat'   		   	  => '',
//				'id'                  => false,
//				'p'					  => false,
//				'post__in'			  => false,
//				'order'               => 'DESC',
//				'orderby'             => 'date',
//				'post_status'         => 'publish',
//				'post_type'           => 'post',
//				'nopaging'			  => false,
//				'paged'				  => $paged,
//				'tag'                 => '',
//				'tax_operator'        => 'IN',
//				'tax_term'            => false,
//				'taxonomy'            => 'category',
//				'title_meta'		  => false,
//				'include_shortcodes'  => false,
//				'layout' 			  => 'large',
//
//				'cat_slug'			  => '',
//				'title'				  => true,
//				'meta_all'			  => true,
//				'meta_author' 		  => true,
//				'meta_date' 		  => true,
//				'meta_categories'  	  => true,
//				'meta_comments'  	  => true,
//				'meta_link'  	  	  => true,
//				'thumbnail'			  => true,
//				'excerpt'			  => true,
//				'excerpt_words'		  => '50',
//				'strip_html'		  => true,
//				'paging'			  => true,
//				'scrolling'		      => 'infinite'
//			), $atts );
//		}
//
//		// setting attributes right for the php script
//		($atts['title'] == "yes") ? ($atts['title'] = true) : ($atts['title'] = false);
//		($atts['meta_all'] == "yes") ? ($atts['meta_all'] = true) : ($atts['meta_all'] = false);
//		($atts['meta_author'] == "yes") ? ($atts['meta_author'] = true) : ($atts['meta_author'] = false);
//		($atts['meta_date'] == "yes") ? ($atts['meta_date'] = true) : ($atts['meta_date'] = false);
//		($atts['meta_categories'] == "yes") ? ($atts['meta_categories'] = true) : ($atts['meta_categories'] = false);
//		($atts['meta_comments'] == "yes") ? ($atts['meta_comments'] = true) : ($atts['meta_comments'] = false);
//		($atts['meta_link'] == "yes") ? ($atts['meta_link'] = true) : ($atts['meta_link'] = false);
//
//		//checking if there are categories that are excluded using "-"; transform slugs to ids
//		$cat_ids ='';
//		$categories = explode(', ', $atts['cat_slug']);
//		if ($categories) {
//			foreach ($categories as $category) {
//				if(strpos($category, '-') === 0) {
//					$cat_ids .= '-' .get_category_by_slug( $category )->cat_ID .',';
//				} else {
//					$cat_ids .= get_category_by_slug( $category )->cat_ID .',';
//				}
//			}
//		}
//		$atts['cat'] = substr($cat_ids, 0, -1);
//
//		($atts['thumbnail'] == "yes") ? ($atts['thumbnail'] = true) : ($atts['thumbnail'] = false);
//		($atts['thumbnail'] == "yes") ? ($atts['thumbnail'] = true) : ($atts['thumbnail'] = false);
//		($atts['excerpt'] == "yes") ? ($atts['excerpt'] = true) : ($atts['excerpt'] = false);
//		($atts['strip_html'] == "yes") ? ($atts['strip_html'] = 1) : ($atts['strip_html'] = 0);
//		($atts['paging'] == "yes") ? ($atts['paging'] = true) : ($atts['paging'] = false);
//		($atts['scrolling'] == "infinite") ? ($atts['paging'] = true) : ($atts['paging'] = $atts['paging']);
//
//		$container_class = '';
//		if($atts['layout'] == 'large alternate') {
//			$post_class = 'large-alternate';
//		} elseif($atts['layout'] == 'medium alternate') {
//			$post_class = 'medium-alternate';
//		} elseif($atts['layout'] == 'grid') {
//			$post_class = 'grid-post';
//			$container_class = 'grid-layout';
//			if(get_post_meta($post->ID, 'pyre_full_width', true) == 'yes' || basename( get_page_template() ) == "full-width.php") {
//				$container_class = 'grid-layout grid-full-layout';
//			}
//		} elseif($atts['layout'] == 'timeline') {
//			$post_class = 'timeline-post';
//			$container_class = 'timeline-layout';
//			if(get_post_meta($post->ID, 'pyre_full_width', true) == 'no' && basename( get_page_template() ) != "full-width.php") {
//				$container_class = 'timeline-layout timeline-sidebar-layout';
//			}
//		}
//
//		$ml_query = new WP_Query($atts);
//
//		$html = '</div></div>';
//
//		if ($atts['scrolling'] == "infinite") {
//			$html .= '<div id="blog-infinite">';
//			$posts_container_id = 'posts-container-infinite';
//		} else {
//			$html .= '<div id="blog">';
//			$posts_container_id = 'posts-container-pagination';
//		}
//		if($atts['layout'] == 'timeline') {
//			$html .= '<div class="timeline-icon"><i class="icon-comments-alt"></i></div>';
//		}
//
//		$html .= '<div id="'.$posts_container_id.'" class="' .$container_class .' clearfix">';
//
//		$post_count = 1;
//
//		$prev_post_timestamp = null;
//		$prev_post_month = null;
//		$first_timeline_loop = false;
//
//		while( $ml_query->have_posts() ) :
//			$ml_query->the_post();
//
//			$post_timestamp = strtotime($post->post_date);
//			$post_month = date('n', $post_timestamp);
//			$post_year = get_the_date('o');
//			$current_date = get_the_date('o-n');
//
//			$html .= '<div id="post-' .get_the_ID().'"';
//			ob_start();
//			post_class($post_class.getClassAlign($post_count).' clearfix');
//			$html .= ob_get_clean() .'>';
//
//			if($atts['layout'] == 'timeline') {
//				if(is_null($prev_post_month )) {
//					$html.= '<h3 class="timeline-title">' . get_the_date("F Y") .'</h3>';
//				} elseif($prev_post_month != $post_month) {
//					$html.= '<h3 class="timeline-title">' . get_the_date("F Y") .'</h3>';
//				}
//			}
//
//			if($atts['layout'] == 'medium alternate') {
//				$html.= '<div class="date-and-formats">
//					<div class="date-box">
//						<span class="date">' . get_the_time("j") .'</span>
//						<span class="month-year">' .get_the_time("m, Y") .'</span>
//					</div>
//					<div class="format-box">';
//
//				switch(get_post_format()) {
//					case 'gallery':
//						$format_class = 'camera-retro';
//						break;
//					case 'link':
//						$format_class = 'link';
//						break;
//					case 'image':
//						$format_class = 'picture';
//						break;
//					case 'quote':
//						$format_class = 'quote-left';
//						break;
//					case 'video':
//						$format_class = 'film';
//						break;
//					case 'audio':
//						$format_class = 'headphones';
//						break;
//					case 'chat':
//						$format_class = 'comments-alt';
//						break;
//					default:
//						$format_class = 'book';
//						break;
//				}
//
//				$html.= '<i class="icon-' . $format_class .'"></i>
//					</div>
//				</div>';
//			}
//
//			if($atts['thumbnail']) {
//				if($data['legacy_posts_slideshow']) {
//					ob_start();
//					include(locate_template('legacy-slideshow-blog-shortcode.php', false));
//					//get_template_part('legacy-slideshow');
//					$html .= ob_get_clean();
//				} else {
//					ob_start();
//					include(locate_template('new-slideshow-blog-shortcode.php', false));
//					//get_template_part('new-slideshow-blog-shortcode');
//					$html .= ob_get_clean();
//
//				}
//			}
//
//			$html.= '<div class="post-content-container">';
//			if($atts['layout'] == 'timeline') {
//				$html.= '<div class="timeline-circle"></div>
//				<div class="timeline-arrow"></div>';
//			}
//			if($atts['layout'] != 'large alternate' && $atts['layout'] != 'medium alternate' && $atts['layout'] != 'grid'  && $atts['layout'] != 'timeline') {
//				if($atts['title']) {
//					$html.= '<h2><a href="' . get_permalink() .'">' .get_the_title() .'</a></h2>';
//				}
//			}
//			if($atts['layout'] == 'large alternate') {
//				$html.= '<div class="date-and-formats">
//					<div class="date-box">
//						<span class="date">' .get_the_time("j") .'</span>
//						<span class="month-year">' .get_the_time("m, Y") .'</span>
//					</div>
//					<div class="format-box">';
//
//				switch(get_post_format()) {
//					case 'gallery':
//						$format_class = 'camera-retro';
//						break;
//					case 'link':
//						$format_class = 'link';
//						break;
//					case 'image':
//						$format_class = 'picture';
//						break;
//					case 'quote':
//						$format_class = 'quote-left';
//						break;
//					case 'video':
//						$format_class = 'film';
//						break;
//					case 'audio':
//						$format_class = 'headphones';
//						break;
//					case 'chat':
//						$format_class = 'comments-alt';
//						break;
//					default:
//						$format_class = 'book';
//						break;
//				}
//
//				$html.= '<i class="icon-' .$format_class .'"></i>
//					</div>
//				</div>';
//			}
//
//
//			$html.= '<div class="post-content">';
//			if($atts['layout'] == 'large alternate' || $atts['layout'] == 'medium alternate'  || $atts['layout'] == 'grid' || $atts['layout'] == 'timeline') {
//				if($atts['title']) {
//					$html.= '<h2 class="post-title"><a href="' . get_permalink() .'">' . get_the_title() .'</a></h2>';
//				}
//				if($atts['meta_all']) {
//					if($atts['layout'] == 'grid' || $atts['layout'] == 'timeline') {
//						$html.= '<p class="single-line-meta">';
//						if($atts['meta_author']) {
//							$html .= __('By', 'Avada') .' ';
//							ob_start();
//							the_author_posts_link();
//							$html .= ob_get_clean();
//						}
//						if($atts['meta_date']) {
//							$html .= '<span class="sep">|</span>'.get_the_time($data["date_format"]).'<span class="sep">|</span>';
//						}
//						$html.= '</p>';
//					} else {
//						$html.= '<p class="single-line-meta">';
//						if($atts['meta_author']) {
//							$html .= __('By', 'Avada') .' ';
//							ob_start();
//							the_author_posts_link();
//							$html .= ob_get_clean();
//						}
//						if($atts['meta_date']) {
//							$html .= '<span class="sep">|</span>'.get_the_time($data["date_format"]);
//						}
//						if($atts['meta_categories']) {
//							ob_start();
//							the_category(', ');
//							$html .= '<span class="sep">|</span>'.ob_get_clean();
//						}
//						if($atts['meta_comments']) {
//							ob_start();
//							comments_popup_link(__('0 Comments', 'Avada'), __('1 Comment', 'Avada'), '% '.__('Comments', 'Avada'));
//							$html .= '<span class="sep">|</span>'.ob_get_clean();
//						}
//						$html .= '</p>';
//					}
//				}
//			}
//			$html .= '<div class="content-sep"></div>';
//
//			// get the post content according to the chosen kind of delivery
//			if($atts['excerpt']) {
//				// content of shortcodes should be displayed
//				if (isset($atts['include_shortcodes']) && $atts['include_shortcodes'] == true) {
//					$html .= avada_custom_excerpt();
//				} else {
//					// content of shortcodes will be cut out, i.e. standard
//					$stripped_content = tf_content( $atts['excerpt_words'], $atts['strip_html'] );
//					$html .= $stripped_content;
//				}
//			} else {
//				$content = get_the_content();
//				$content = apply_filters('the_content', $content);
//				$content = str_replace(']]>', ']]&gt;', $content);
//				$html .= $content;
//			}
//
//			$html .= '</div>
//			<div style="clear:both;"></div>';
//
//			if($atts['meta_all']) {
//				$html .= '<div class="meta-info">';
//				if($atts['layout'] == 'grid' || $atts['layout'] == 'timeline') {
//					if($atts['layout'] != 'large alternate' && $atts['layout'] != 'medium alternate') {
//						$html .= '<div class="alignleft">';
//						if($atts['meta_link']) {
//							$html .= '<a href="' .get_permalink() .'" class="read-more">' .__("Read More", "Avada") .'</a>';
//						}
//						$html .= '</div>';
//					}
//					$html .= '<div class="alignright">';
//					if($atts['meta_comments']) {
//						ob_start();
//						comments_popup_link('<i class="icon-comments"></i>&nbsp;'.__('0', 'Avada'), '<i class="icon-comments"></i>&nbsp;'.__('1', 'Avada'), '<i class="icon-comments"></i>&nbsp;'.'%');
//						$html .= ob_get_clean();
//					}
//					$html .= '</div>';
//				} else {
//					if($atts['layout'] != 'large alternate' && $atts['layout'] != 'medium alternate') {
//						$html .= '<div class="alignleft">';
//						if($atts['meta_author']) {
//							$html .= __('By', 'Avada') .' ';
//							ob_start();
//							the_author_posts_link();
//							$html .= ob_get_clean();
//						}
//						if($atts['meta_date']) {
//							$html .= '<span class="sep">|</span>'.get_the_time($data["date_format"]);
//						}
//						if($atts['meta_categories']) {
//							ob_start();
//							the_category(', ');
//							$html .= '<span class="sep">|</span>'.ob_get_clean();
//						}
//						if($atts['meta_comments']) {
//							ob_start();
//							comments_popup_link(__('0 Comments', 'Avada'), __('1 Comment', 'Avada'), '% '.__('Comments', 'Avada'));
//							$html .= '<span class="sep">|</span>'.ob_get_clean();
//						}
//						$html .= '</div>';
//					}
//					$html .= '<div class="alignright">';
//					if($atts['meta_link']) {
//						$html .= '<a href="' .get_permalink() .'" class="read-more">' .__("Read More", "Avada") .'</a>';
//					}
//					$html .= '</div>';
//				}
//				$html .= '</div>';
//			}
//			$html .= '</div>
//		</div>';
//
//			$prev_post_timestamp = $post_timestamp;
//			$prev_post_month = $post_month;
//			$post_count++;
//		endwhile;
//
//		$html .= '</div></div>';
//
//		//no paging if only the latest posts are shown
//		if ($atts['paging']) {
//			$html .= avada_blog_shortcode_pagination($ml_query, $pages = '', $range = 2);
//		}
//		wp_reset_query();
//		$html .= '<div><div>';
//		return $html;
//	}
//add_shortcode( 'blog', 'blog_shortcode' );
//
//if(!function_exists('avada_blog_shortcode_pagination')):
//	function avada_blog_shortcode_pagination($ml_query, $pages = '', $range = 2)
//	{
//		$html = '';
//
//		$showitems = ($range * 2)+1;
//
//		if((is_front_page() || is_home() ) ) {
//			$paged = (get_query_var('paged')) ?get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
//		} else {
//			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
//		}
//
//		if($pages == '') {
//			global $wp_query;
//			$pages = $ml_query->max_num_pages;
//			if(!$pages) {
//				$pages = 1;
//			}
//		}
//
//		if(1 != $pages) {
//			$html .= '<div class="pagination clearfix">';
//			if($paged > 1) $html .= '<a class="pagination-prev" href="'.get_pagenum_link($paged - 1).'"><span class="page-prev"></span>'.__('Previous', 'Avada').'</a>';
//
//			for ($i=1; $i <= $pages; $i++) {
//				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
//					if ($paged == $i) {
//						$html .= '<span class="current">'.$i.'</span>';
//					} else {
//						$html .= '<a href="'.get_pagenum_link($i).'" class="inactive" >'.$i.'</a>';
//					}
//				}
//			}
//
//			if ($paged < $pages) $html .= '<a class="pagination-next" href="'.get_pagenum_link($paged + 1).'">'.__('Next', 'Avada').'<span class="page-next"></span></a>';
//			$html .= '</div>';
//		}
//		return $html;
//	}
//endif;
//
//if(!function_exists('avada_custom_excerpt')):
//	function avada_custom_excerpt($text = '') {
//		global $atts;
//
//		$raw_excerpt = $text;
//		$text = get_the_content('');
//		$text = do_shortcode( $text );
//
//		// strip html tags
//		if($atts['strip_html']) {
//
//			$text = apply_filters('the_content', $text);
//			$text = str_replace(']]>', ']]&gt;', $text);
//			$excerpt_length = apply_filters('excerpt_length', $atts['excerpt_words']);
//			$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
//			$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
//
//			$content = apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
//			//do not strip html tags
//		} else {
//
//			$content = explode(' ', $text, $atts['excerpt_words']);
//			if (count($content)>=$atts['excerpt_words']) {
//				array_pop($content);
//				$content = implode(" ",$content).' <a href="'.get_permalink(). '">&#91;...&#93;</a>';
//			} else {
//				$content = implode(" ",$content);
//			}
//			$content = preg_replace('/\[.+\]/','', $content);
//			$content = apply_filters('the_content', $content);
//			$content = str_replace(']]>', ']]&gt;', $content);
//		}
//		return $content;
//	}
//endif;
//
////////////////////////////////////////////////////////////////////
//// Image Frame
////////////////////////////////////////////////////////////////////
//add_shortcode('imageframe', 'shortcode_imageframe');
//	function shortcode_imageframe($atts, $content = null) {
//		global $data;
//
//		extract(shortcode_atts(array(
//			'style' => 'border',
//			'bordercolor' => '',
//			'bordersize' => '4px',
//			'stylecolor' => '',
//			'align' => ''
//		), $atts));
//
//		static $avada_imageframe_id = 1;
//
//		if(!$bordercolor) {
//			$bordercolor = $data['imgframe_border_color'];
//		}
//
//
//		if(!$stylecolor) {
//			$stylecolor = $data['imgframe_style_color'];
//		}
//
//		$getRgb = avada_hex2rgb($stylecolor);
//
//		$html = "<style type='text/css'>
//	#imageframe-{$avada_imageframe_id}.imageframe{float:{$align};}
//	#imageframe-{$avada_imageframe_id}.imageframe img{border:{$bordersize} solid {$bordercolor};}
//	#imageframe-{$avada_imageframe_id}.imageframe-glow img{
//		-moz-box-shadow: 0 0 3px rgba({$getRgb[0]},{$getRgb[1]},{$getRgb[2]},.3); /* outer glow */
//		-webkit-box-shadow: 0 0 3px rgba({$getRgb[0]},{$getRgb[1]},{$getRgb[2]},.3); /* outer glow */
//		box-shadow: 0 0 3px rgba({$getRgb[0]},{$getRgb[1]},{$getRgb[2]},.3); /* outer glow */
//	}
//	#imageframe-{$avada_imageframe_id}.imageframe-dropshadow img{
//		-moz-box-shadow: 2px 3px 7px rgba({$getRgb[0]},{$getRgb[1]},{$getRgb[2]},.3); /* drop shadow */
//		-webkit-box-shadow: 2px 3px 7px rgba({$getRgb[0]},{$getRgb[1]},{$getRgb[2]},.3); /* drop shadow */
//		box-shadow: 2px 3px 7px rgba({$getRgb[0]},{$getRgb[1]},{$getRgb[2]},.3); /* drop shadow */
//	}
//	</style>
//	";
//
//		$html .= '<span id="imageframe-'.$avada_imageframe_id.'" class="imageframe imageframe-'.$style.'">';
//		$html .= do_shortcode($content);
//		if($style == 'bottomshadow') {
//			$html .= '<span class="imageframe-shadow-left"></span><span class="imageframe-shadow-right"></span>';
//		}
//		$html .= '</span>';
//
//		$avada_imageframe_id++;
//
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Images
////////////////////////////////////////////////////////////////////
//add_shortcode('images', 'shortcode_avada_images');
//	function shortcode_avada_images($atts, $content = null) {
//		wp_enqueue_script( 'jquery.carouFredSel' );
//
//		extract(shortcode_atts(array(
//			'lightbox' => 'no'
//		), $atts));
//
//		$class = '';
//
//		if($lightbox == 'yes') {
//			$class = 'lightbox-enabled';
//		}
//
//		$html = '<div class="related-posts related-projects '.$class.'"><div id="carousel" class="clients-carousel es-carousel-wrapper"><div class="es-carousel"><ul>';
//		$html .= do_shortcode($content);
//		$html .= '</ul><div class="es-nav"><span class="es-nav-prev">Previous</span><span class="es-nav-next">Next</span></div></div></div></div>';
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Image
////////////////////////////////////////////////////////////////////
//add_shortcode('image', 'shortcode_avada_image');
//	function shortcode_avada_image($atts, $content = null) {
//		$html = '<li>';
//		$html .= '<a href="'.$atts['link'].'" target="'.$atts['linktarget'].'"><img src="'.$atts['image'].'" alt="" /></a>';
//		$html .= '</li>';
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Social Sharing Box
////////////////////////////////////////////////////////////////////
//add_shortcode('sharing', 'shortcode_sharing');
//	function shortcode_sharing($atts, $content = null) {
//		global $data;
//
//		extract(shortcode_atts(array(
//			'tagline' => '',
//			'title' => '',
//			'link' => '',
//			'description' => '',
//			'backgroundcolor' => ''
//		), $atts));
//
//		if(!$backgroundcolor) {
//			$backgroundcolor = $data['social_bg_color'];
//		}
//
//		$html = '<div class="share-box" style="background-color:'.$backgroundcolor.';">
//		<h4>'.$tagline.'</h4>
//		<ul class="social-networks social-networks-'.strtolower($data['socialbox_icons_color']).'">';
//		if($data['sharing_facebook']):
//			$html .= '<li class="facebook">
//				<a href="http://www.facebook.com/sharer.php?u='.$link.'&amp;t='.$title.'">
//					Facebook
//				</a>
//				<div class="popup">
//					<div class="holder">
//						<p>Facebook</p>
//					</div>
//				</div>
//			</li>';
//		endif;
//		if($data['sharing_twitter']):
//			$html .= '<li class="twitter">
//				<a href="http://twitter.com/home?status='.$title.' '.$link.'">
//					Twitter
//				</a>
//				<div class="popup">
//					<div class="holder">
//						<p>Twitter</p>
//					</div>
//				</div>
//			</li>';
//		endif;
//		if($data['sharing_linkedin']):
//			$html .= '<li class="linkedin">
//				<a href="http://linkedin.com/shareArticle?mini=true&amp;url='.$link.'&amp;title='.$title.'">
//					LinkedIn
//				</a>
//				<div class="popup">
//					<div class="holder">
//						<p>LinkedIn</p>
//					</div>
//				</div>
//			</li>';
//		endif;
//		if($data['sharing_reddit']):
//			$html .= '<li class="reddit">
//				<a href="http://reddit.com/submit?url='.$link.'&amp;title='.$title.'">
//					Reddit
//				</a>
//				<div class="popup">
//					<div class="holder">
//						<p>Reddit</p>
//					</div>
//				</div>
//			</li>';
//		endif;
//		if($data['sharing_tumblr']):
//			$html .= '<li class="tumblr">
//				<a href="http://www.tumblr.com/share/link?url='.urlencode($link).'&amp;name='.urlencode($title).'&amp;description='.urlencode($description).'">
//					Tumblr
//				</a>
//				<div class="popup">
//					<div class="holder">
//						<p>Tumblr</p>
//					</div>
//				</div>
//			</li>';
//		endif;
//		if($data['sharing_google']):
//			$html .= '<li class="google">
//				<a href="https://plus.google.com/share?url='.$link.'" onclick="javascript:window.open(this.href,
//  \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;">
//					Google +1
//				</a>
//				<div class="popup">
//					<div class="holder">
//						<p>Google +1</p>
//					</div>
//				</div>
//			</li>';
//		endif;
//		if($data['sharing_pinterest']):
//			$html .= '<li class="pinterest">
//				<a href="http://pinterest.com/pin/create/button/?url='.urlencode($link).'&amp;description='.urlencode($title).'">
//					Pinterest
//				</a>
//				<div class="popup">
//					<div class="holder">
//						<p>Pinterest</p>
//					</div>
//				</div>
//			</li>';
//		endif;
//		if($data['sharing_email']):
//			$html .= '<li class="email">
//				<a href="mailto:?subject='.$title.'&amp;body='.$link.'">
//					Email
//				</a>
//				<div class="popup">
//					<div class="holder">
//						<p>Email</p>
//					</div>
//				</div>
//			</li>';
//		endif;
//		$html .= '</ul>
//	</div>';
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Featured Products Slider
////////////////////////////////////////////////////////////////////
//add_shortcode('featured_products_slider', 'avada_featured_products_slider');
//	function avada_featured_products_slider($atts, $content = null) {
//		global $woocommerce, $data;
//
//		$html = '';
//
//		if(class_exists('Woocommerce')):
//
//			$args = array(
//				'post_type' => 'product',
//				'posts_per_page' => -1,
//				'meta_key' => '_featured',
//				'meta_value' => 'yes',
//			);
//
//			$html = '<div class="products-slider es-carousel">';
//
//			$products = new WP_Query($args);
//			if($products->have_posts()) {
//				$html .= '<ul>';
//				while($products->have_posts()): $products->the_post();
//					if(has_post_thumbnail()):
//						$html .= '<li>';
//						$html .= '<div class="image">';
//						if($data['image_rollover']):
//							$html .= get_the_post_thumbnail(get_the_ID(), 'shop_single');
//						else:
//							$html .= '<a href="'.get_permalink(get_the_ID()).'">'.get_the_post_thumbnail(get_the_ID(), 'shop_single').'</a>';
//						endif;
//
//						$html .= '<div class="image-extras">';
//						$html .= '<div class="image-extras-content">';
//						$html .= '<h2><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
//						$html .= get_the_term_list(get_the_ID(), 'product_cat', '<span class="cats">', ', ', '</span>');
//						ob_start();
//						woocommerce_get_template('loop/price.php');
//						$price = ob_get_contents();
//						ob_end_clean();
//						if($price):
//							$html .= $price;
//						endif;
//						$html .= '<div class="product-buttons clearfix">';
//						ob_start();
//						woocommerce_get_template('loop/add-to-cart.php');
//						$cart_button = ob_get_contents();
//						ob_end_clean();
//						$html .= $cart_button;
//						$html .= '<a href="'.get_permalink().'" class="show_details_button">Details</a>';
//						$html .= '</div>';
//
//						$html .= '</div>
//						</div>
//				</div>
//			</li>';
//					endif;
//				endwhile;
//				$html .= '</ul>';
//			}
//
//			$html .= '<div class="es-nav"><span class="es-nav-prev">Previous</span><span class="es-nav-next">Next</span></div>';
//
//			$html .= '</div>';
//
//		endif;
//
//		return $html;
//	}
//
////////////////////////////////////////////////////////////////////
//// Products Slider
////////////////////////////////////////////////////////////////////
//add_shortcode('products_slider', 'avada_products_slider');
//	function avada_products_slider($atts, $content = null) {
//		global $woocommerce, $data;
//
//		extract(shortcode_atts(array(
//			'cat_slug' => '',
//			'number_posts' => 10,
//			'show_cats' => 'yes',
//			'show_price' => 'yes',
//			'show_buttons' => 'yes'
//		), $atts));
//
//		$html = '';
//
//		if(class_exists('Woocommerce')):
//
//			$number_posts = (int) $number_posts;
//
//			$args = array(
//				'post_type' => 'product',
//				'posts_per_page' => 5,
//				'meta_query' => array(
//					array(
//						'key' => '_thumbnail_id',
//						'compare' => '!=',
//						'value' => null
//					)
//				)
//			);
//
//			if($cat_slug){
//				$cat_id = explode(',', $cat_slug);
//				$args['tax_query'] = array(
//					array(
//						'taxonomy' => 'product_cat',
//						'field' => 'slug',
//						'terms' => $cat_id
//					)
//				);
//			}
//
//			$html .= '<div class="related-posts related-projects simple-products-slider">';
//			$html .= '<div id="carousel" class="es-carousel-wrapper">';
//			$html .= '<div class="es-carousel">';
//
//			$products = new WP_Query($args);
//			if($products->have_posts()) {
//				$html .= '<ul>';
//				while($products->have_posts()): $products->the_post();
//					if(has_post_thumbnail()):
//						$html .= '<li>';
//						$html .= '<div class="image">';
//						if($data['image_rollover']):
//							$html .= get_the_post_thumbnail(get_the_ID(), 'shop_catalog');
//						else:
//							$html .= '<a href="'.get_permalink(get_the_ID()).'">'.get_the_post_thumbnail(get_the_ID(), 'shop_catalog').'</a>';
//						endif;
//
//						$html .= '<div class="image-extras">';
//						$html .= '<div class="image-extras-content">';
//						$html .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
//						if($show_cats == 'yes'):
//							$html .= get_the_term_list(get_the_ID(), 'product_cat', '<span class="cats">', ', ', '</span>');
//						endif;
//						ob_start();
//						woocommerce_get_template('loop/price.php');
//						$price = ob_get_contents();
//						ob_end_clean();
//						if($price && $show_price == 'yes'):
//							$html .= $price;
//						endif;
//						if($show_buttons == 'yes'):
//							$html .= '<div class="product-buttons clearfix">';
//							ob_start();
//							woocommerce_get_template('loop/add-to-cart.php');
//							$cart_button = ob_get_contents();
//							ob_end_clean();
//							$html .= $cart_button;
//							$html .= '<a href="'.get_permalink().'" class="show_details_button">Details</a>';
//							$html .= '</div>';
//						endif;
//
//						$html .= '</div>
//						</div>
//				</div>
//			</li>';
//					endif;
//				endwhile;
//				$html .= '</ul>';
//			}
//
//			$html .= '<div class="es-nav"><span class="es-nav-prev">Previous</span><span class="es-nav-next">Next</span></div>';
//
//			$html .= '</div></div></div>';
//
//		endif;
//
//		return $html;
//	}

//////////////////////////////////////////////////////////////////
// Woo Products Shortcode Recode
//////////////////////////////////////////////////////////////////
//if(class_exists('Woocommerce')) {
//	function avada_woo_product($atts, $content = null) {
//		global $woocommerce_loop;
//
//		if (empty($atts)) return;
//
//		$args = array(
//			'post_type' => 'product',
//			'posts_per_page' => 1,
//			'no_found_rows' => 1,
//			'post_status' => 'publish',
//			'meta_query' => array(
//				array(
//					'key' => '_visibility',
//					'value' => array('catalog', 'visible'),
//					'compare' => 'IN'
//				)
//			),
//			'columns' => 1
//		);
//
//		if(isset($atts['sku'])){
//			$args['meta_query'][] = array(
//				'key' => '_sku',
//				'value' => $atts['sku'],
//				'compare' => '='
//			);
//		}
//
//		if(isset($atts['id'])){
//			$args['p'] = $atts['id'];
//		}
//
//		ob_start();
//
//		$woocommerce_loop['columns'] = $columns;
//
//		$products = new WP_Query( $args );
//
//		if ( $products->have_posts() ) :

  //woocommerce_product_loop_start();

  //while ( $products->have_posts() ) : $products->the_post();
  //woocommerce_get_template_part( 'content', 'product' );

  //endwhile; // end of the loop.

  //woocommerce_product_loop_end();

  //endif;
//
//		wp_reset_postdata();
//
//		return '<div class="woocommerce">' . ob_get_clean() . '</div>';
//	}
//
//add_action('wp_loaded', 'remove_product_shortcode');
//	function remove_product_shortcode() {
//		// First remove the shortcode
//		remove_shortcode('product');
//		// Then recode it
//		add_shortcode('product', 'avada_woo_product');
//	}
//}











































  public function add_button()
  {
    if(strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php') || strstr($_SERVER['REQUEST_URI'], 'wp-admin/post.php')) {
      if ( current_user_can('edit_posts') && current_user_can('edit_pages')) {
        add_filter('mce_buttons', array($this, 'register_button'));
        add_filter('mce_external_plugins', array($this, 'add_plugin'));
        add_action('edit_form_after_editor', array($this, 'short_codes_form'));
      }
    }
  }


  public function short_codes_form()
  {
    $params = array(
      'list' => array(
        'vimeo' => 'Vimeo',
        'map' => 'Google Map',
        'youtube' => 'Youtube',
        'soundcloud' => 'Sound Cloud',
        'button' => 'Button',
        'dropcap' => 'Dropcap',
        'highlight' => 'Highlight',
        'checklist' => 'Checklist',
        'tabs' => 'Tabs',
        'accordion' => 'Toggle accordion',
        'one_half' => 'One half',
        'one_third' => 'One third',
        'one_fourth' => 'One fourth',
        'two_third' => 'Two third',
        'three_fourth' => 'Three fourth',
        'tagline_box' => 'Tagline Box',
        'pricing_table' => 'Pricing Table',
        'content_boxes' => 'Content boxes',
        'testimonials' => 'Testimonials',
      ),
    );

    print Helper::render(VIEWS_PATH . 'admin' . DS . 'shortcodes_form.php', $params);
  }

  public function register_button( $buttons )
  {
    array_push($buttons, 'ssc_button');

    return $buttons;
  }

  public function add_plugin( $plugin_array ) {
    $plugin_array['ssc_button'] = ASSETS_DIR . 'js/admin/shortcodes.js';

    return $plugin_array;
  }
}
