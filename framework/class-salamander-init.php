<?php
/**
 *
 */

class Salamander_Init
{
  public $post;
  public $pageNow;

  private static $instance;
  private $helper;
  private $options; //default
  private $default_options; //default
  private $default_values;
  private $optionsMachine = array(); //default

  private function __construct($is_admin) {
    global $pagenow;
    $this->pageNow = $pagenow;
		//Define site constants
		$this->defineConstants();
		$this->helper = Helper::get_instance();
    $this->options = get_option(THEME_OPTIONS);
    if ( $is_admin ) {
      $this->get_default_options();
      $this->parse_options($this->default_options);
    }
//		new Widgets();
	}

	public static function get_instance($is_admin = true)
	{
	  if (self::$instance == null)
	  {
	    self::$instance = new self($is_admin);
	  }

	  return self::$instance;
	}

	public function defineConstants()
	{
		if( function_exists('wp_get_theme'))
		{
			if(is_child_theme())
			{
				$temp_obj = wp_get_theme();
				$theme_obj = wp_get_theme( $temp_obj->get('Template') );
			}
			else
			{
				$theme_obj = wp_get_theme();
			}

			$theme_version = $theme_obj->get('Version');
			$theme_name = $theme_obj->get('Name');
			$theme_uri = $theme_obj->get('ThemeURI');
			$author_uri = $theme_obj->get('AuthorURI');
		}
		else
		{
			$theme_data = get_theme_data( TEMPLATEPATH.'/style.css' );
			$theme_version = $theme_data['Version'];
			$theme_name = $theme_data['Name'];
			$theme_uri = $theme_data['ThemeURI'];
			$author_uri = $theme_data['AuthorURI'];
		}

		define('DS', DIRECTORY_SEPARATOR);
		define('SMOF_VERSION', '1.0');
		define('TEMPLATE_DIR', get_template_directory_uri());
		define('ADMIN_PATH', TEMPLATEPATH . DS . 'admin' .DS); // ??
		define('ADMIN_DIR', TEMPLATE_DIR . DS . 'admin' . DS); //??
		define('FRAMEWORK_DIR', TEMPLATE_DIR . '/framework/');
		define('FRAMEWORK_PATH', TEMPLATEPATH . DS . 'framework' . DS);
		define('VIEWS_PATH', TEMPLATEPATH . DS . 'framework' . DS . 'views' . DS);
		define('VIEWS_DIR', TEMPLATE_DIR . '/framework/views/');
    define('WIDGETS_PATH', TEMPLATEPATH . DS . 'framework' . DS . 'widgets' . DS);
		define('WIDGETS_DIR', TEMPLATE_DIR . '/framework/widgets/');
		define('ASSETS_PATH', TEMPLATEPATH . DS . 'framework' . DS . 'assets' . DS);
		define('ASSETS_DIR', TEMPLATE_DIR . '/framework/assets/');
		define('LIBS_PATH', TEMPLATEPATH . DS . 'framework' . DS . 'libs' . DS);
		define('LIBS_DIR', TEMPLATE_DIR . '/framework/libs/');
		define('LAYOUT_PATH', ADMIN_PATH . DS . 'layouts' . DS);
		define('THEMENAME', $theme_name);
		define('SITE_URL', get_option('siteurl'));
		/* Theme version, uri, and the author uri are not completely necessary, but may be helpful in adding functionality */
		define('THEMEVERSION', $theme_version);
		define('THEMEURI', $theme_uri);
		define('THEMEAUTHORURI', $author_uri);

		define('THEME_OPTIONS', strtolower($theme_name) . '_options');
		define('THEME_OPTIONS_BACKUPS', strtolower($theme_name) . '_backups');
	}

	public function registerNavMenus()
	{
		$menus = array(
			'main_navigation' => 'Main Navigation',
			'top_navigation' => 'Top Navigation',
			'footer_navigation' => 'Boottom Navigation',
			'404_pages' => '404 Ustful Pages',
		);
		register_nav_menus($menus);
	}

	public function registerPosts()
	{
		// Register custom post types
		register_post_type(
			'salamander_portfolio',
			array(
				'labels' => array(
					'name' => 'Portfolio',
					'singular_name' => 'Portfolio'
				),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'portfolio_items'),
				'supports' => array('title', 'editor', 'thumbnail', 'comments'),
				'can_export' => true,
			)
		);
		$params = array('hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true);
		register_taxonomy('portfolio_category', 'salamander_portfolio', $params);
		$params = array('hierarchical' => true, 'label' => 'Skills', 'query_var' => true, 'rewrite' => true);
		register_taxonomy('portfolio_skills', 'salamander_portfolio', $params);

		register_post_type(
			'salamander_faq',
			array(
				'labels' => array(
					'name' => 'FAQs',
					'singular_name' => 'FAQ'
				),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'faq-items'),
				'supports' => array('title', 'editor', 'thumbnail', 'comments'),
				'can_export' => true,
			)
		);

    $params = array(
      'hierarchical' => true,
      'label' => 'Categories',
      'query_var' => true,
      'rewrite' => true
    );
		register_taxonomy('faq_category', 'salamander_faq', $params);

		register_post_type(
			'salamander_elastic',
			array(
				'labels' => array(
					'name' => 'Elastic Slider',
					'singular_name' => 'Elastic Slide'
				),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'elastic-slide'),
				'supports' => array('title', 'thumbnail'),
				'can_export' => true,
				'menu_position' => 100,
			)
		);
    $params = array(
      'hierarchical' => false,
      'label' => 'Groups',
      'query_var' => true,
      'rewrite' => true
    );
		register_taxonomy('salamander_egroups', 'salamander_elastic', $params);
	}

	public function registerSidebars()
	{
		// Register widgetized zones
		if(function_exists('register_sidebar')) {
			register_sidebar(array(
				'name' => 'Blog Right Sidebar',
				'id' => 'right-blog-sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Blog Left Sidebar',
				'id' => 'left-blog-sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Header Widget 1',
				'id' => 'header-widget-1',
				'before_widget' => '<div id="%1$s" class="header-widget-col %2$s">',
				'after_widget' => '<div style="clear:both;"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Header Widget 2',
				'id' => 'header-widget-2',
				'before_widget' => '<div id="%1$s" class="header-widget-col %2$s">',
				'after_widget' => '<div style="clear:both;"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Header Widget 3',
				'id' => 'header-widget-3',
				'before_widget' => '<div id="%1$s" class="header-widget-col %2$s">',
				'after_widget' => '<div style="clear:both;"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Header Widget 4',
				'id' => 'header-widget-4',
				'before_widget' => '<div id="%1$s" class="header-widget-col %2$s">',
				'after_widget' => '<div style="clear:both;"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Footer Widget 1',
				'id' => 'footer-widget-1',
				'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
				'after_widget' => '<div style="clear:both;"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Footer Widget 2',
				'id' => 'footer-widget-2',
				'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
				'after_widget' => '<div style="clear:both;"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Footer Widget 3',
				'id' => 'footer-widget-3',
				'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
				'after_widget' => '<div style="clear:both;"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));

			register_sidebar(array(
				'name' => 'Footer Widget 4',
				'id' => 'footer-widget-4',
				'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
				'after_widget' => '<div style="clear:both;"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));
		}
	}

	public function initAdmin()
	{
    add_menu_page( THEMENAME,
      __('Theme Options', 'salamander_admin'),
      'manage_options',
      'salamander-options',
      array($this ,'admin_options_page'),
      '',
      '60.1' );
	}

	/**
	 * Change activation message
	 *
	 * @since 1.0.0
	 */
	function adminSetJs()
	{
    print '<script type="text/javascript">
    				var templateDir = "' . TEMPLATE_DIR . '";
	  				var frameworkDir = "' . FRAMEWORK_DIR . '";
	  				var viewsDir = "' . VIEWS_DIR . '";
	  				var assetsDir = "' . ASSETS_DIR . '";
	  				var libsDir = "' . LIBS_DIR . '";
		        jQuery(function(){
		          var message = \'<p>This theme comes with an <a href="' . admin_url("admin.php?page=slthemeoptions") . '">options panel</a> to configure settings. This theme also supports widgets, please visit the <a href="' . admin_url("widgets.php") . '">widgets settings page</a> to configure them.</p>\';
		        	jQuery(".themes-php #message2").html(message);
		        });
        	</script>';
	}

	public function admin_options_page()
	{
    foreach ( $this->default_options as $values ) {
      $classes[] = str_replace(' ','',strtolower($values['name']));
    }
		wp_enqueue_style('admin-style', ASSETS_DIR . 'css/admin-style.css');
		wp_enqueue_style('color-picker', ASSETS_DIR . 'css/colorpicker.css');

		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-input-mask', ASSETS_DIR . 'js/jquery.maskedinput-1.2.2.js', array('jquery'));
		wp_enqueue_script('tipsy', ASSETS_DIR . 'js/jquery.tipsy.js', array('jquery'));
		wp_enqueue_script('color-picker', ASSETS_DIR . 'js/colorpicker.js', array('jquery'));
		wp_enqueue_script('ajaxupload', ASSETS_DIR . 'js/ajaxupload.js', array('jquery'));
		wp_enqueue_script('cookie', ASSETS_DIR . 'js/cookie.js', array('jquery'));
		wp_enqueue_script('scf', ASSETS_DIR . 'js/admin/theme-options.js', array('jquery'));

		wp_register_script('medialibrary-uploader', ASSETS_DIR . 'js/medialibrary-uploader.js', array('jquery', 'thickbox') );
		wp_enqueue_script('medialibrary-uploader');
		wp_enqueue_script('media-upload');

		$params = array(
			'headerClassesArray' => $classes,
      'default_options' => $this->default_options,
      'default_values' => $this->default_values,
      'options' => $this->options,
      'helper' => $this->helper,
		);
		print Helper::render(VIEWS_PATH . 'admin' . DS . 'options-page.php', $params);
	}

	/**
	 * Ajax Save Options
	 *
	 * @uses get_option()
	 * @uses update_option()
	 *
	 * @since 1.0.0
	 */
	public function ajaxCallback()
	{
		if (!wp_verify_nonce($_POST['security'], 'ajax_nonce')) die('-1');
		//get options array from db
		$currentOptions = get_option(THEME_OPTIONS);

		$operation = $_POST['type'];

		//echo $_POST['data'];

		//Uploads
		switch ($operation) {
			case 'upload':
				$cID = $_POST['data']; // Acts as the name
				$filename = $_FILES[$cID];
	     	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']);
				$override['test_form'] = false;
				$override['action'] = 'wp_handle_upload';
				$uploaded_file = wp_handle_upload($filename, $override);
				$upload_tracking[] = $cID;
				$currentOptions[$cID] = $uploaded_file['url'];
				update_option(THEME_OPTIONS, $currentOptions ) ;

				if(!empty($uploaded_file['error'])) {
					echo 'Upload Error: ' . $uploaded_file['error'];
				}
				else {
					echo $uploaded_file['url'];
				}
				break;
			case 'image_reset':
				$id = $_POST['data']; // Acts as the name
				$currentOptions[$id] = ''; //update array key with empty value
				update_option(THEME_OPTIONS, $currentOptions) ;
				break;
			case 'backup_options':
				$currentOptions['backup_log'] = date('r');
				update_option(THEME_OPTIONS_BACKUPS, $currentOptions) ;
				die('1');
				break;
			case 'restore_options':
				$data = get_option(THEME_OPTIONS_BACKUPS);
				update_option(THEME_OPTIONS, $data);
				die('1');
				break;
			case 'import_options':
				$data = unserialize(base64_decode($data)); //100% safe - ignore theme check nag
				update_option(THEME_OPTIONS, $data);
				die('1');
				break;
			case 'save':
				wp_parse_str(stripslashes($_POST['data']), $data);
				unset($data['security']);
				unset($data['save']);
				update_option(THEME_OPTIONS, $data);
				die('1');
				break;
			case 'reset':
				update_option(THEME_OPTIONS, $this->default_values);
				die('1');
				break;
		}
  	die();
	}

	public function optionsSetup()
	{
		if ( ! get_option(THEME_OPTIONS) ) {
			update_option( THEME_OPTIONS, $this->default_values );
		}
		if ( ! get_option(THEME_OPTIONS_BACKUPS ) ) {
			update_option( THEME_OPTIONS_BACKUPS, $this->default_values );
		}
	}

	public function stylesheets()
	{
		if ( ! is_admin() && ! in_array($this->pageNow, array('wp-login.php', 'wp-register.php' ) ) ) {
//    	wp_deregister_style('normalize');
//	    wp_register_style('normalize', TEMPLATE_DIR . '/css/normalize.css', array(), false, 'all');
//	    wp_enqueue_style('normalize');
    }
	}

	public function scripts() {
    global $post;
    if (!is_admin() && !in_array($this->pageNow, array('wp-login.php', 'wp-register.php'))) {
    wp_reset_query();

    $slider_page_id = $post->ID;
    if(is_home() && !is_front_page()){
        $slider_page_id = get_option('page_for_posts');
    }

    wp_enqueue_script( 'jquery', false, array(), false, false);

    wp_deregister_script( 'bootstrap' );
    wp_register_script( 'bootstrap', get_bloginfo('template_directory').'/js/bootstrap.js', array(), false, true);
    wp_enqueue_script( 'bootstrap' );

    wp_deregister_script('ccgallery_modernizr');

    wp_deregister_script( 'modernizr' );
    wp_register_script( 'modernizr', get_bloginfo('template_directory').'/js/modernizr.js', array(), false, true);
    wp_enqueue_script( 'modernizr' );

    wp_deregister_script( 'jquery.carouFredSel' );
    wp_register_script( 'jquery.carouFredSel', get_bloginfo('template_directory').'/js/jquery.carouFredSel-6.2.1-packed.js', array(), false, true);
    //if(is_single()) {
        wp_enqueue_script( 'jquery.carouFredSel' );
    //}

    wp_deregister_script( 'jquery.prettyPhoto' );
    wp_register_script( 'jquery.prettyPhoto', get_bloginfo('template_directory').'/js/jquery.prettyPhoto.js', array(), false, true);
    wp_enqueue_script( 'jquery.prettyPhoto' );

//    wp_deregister_script( 'jquery.isotope' );
//    wp_register_script( 'jquery.isotope', get_bloginfo('template_directory').'/js/jquery.isotope.min.js', array(), false, true);
    /*if(
        is_page_template('portfolio-one-column.php') || is_page_template('portfolio-one-column-text.php') ||
        is_page_template('portfolio-two-column.php') || is_page_template('portfolio-two-column-text.php') ||
        is_page_template('portfolio-three-column.php') || is_page_template('portfolio-three-column-text.php') ||
        is_page_template('portfolio-four-column.php') || is_page_template('portfolio-four-column-text.php') ||
        (is_home() && $data['blog_layout'] == 'Grid') || is_page_template('demo-gridblog.php') ||
        is_page_template('demo-timelineblog.php')
    ) {*/
//        wp_enqueue_script( 'jquery.isotope' );
    //}

    wp_deregister_script( 'jquery.flexslider' );
    wp_register_script( 'jquery.flexslider', get_bloginfo('template_directory').'/js/jquery.flexslider-min.js', array(), false, true);
    //if(is_home() || is_single() || is_search() || is_archive() || get_post_meta($slider_page_id, 'pyre_slider_type', true) == 'flex2') {
        wp_enqueue_script( 'jquery.flexslider' );
    //}

    wp_deregister_script( 'jquery.cycle' );
    wp_register_script( 'jquery.cycle', get_bloginfo('template_directory').'/js/jquery.cycle.lite.js', array(), false, true);
    //wp_enqueue_script( 'jquery.cycle' );

    wp_deregister_script( 'jquery.fitvids' );
    wp_register_script( 'jquery.fitvids', get_bloginfo('template_directory').'/js/jquery.fitvids.js', array(), false, true);
    wp_enqueue_script( 'jquery.fitvids' );

    wp_deregister_script( 'jquery.hoverIntent' );
    wp_register_script( 'jquery.hoverIntent', get_bloginfo('template_directory').'/js/jquery.hoverIntent.minified.js', array(), false, true);
    wp_enqueue_script( 'jquery.hoverIntent' );

    wp_deregister_script( 'jquery.easing' );
    wp_register_script( 'jquery.easing', get_bloginfo('template_directory').'/js/jquery.easing.js', array(), false, false);
    //wp_enqueue_script( 'jquery.easing' );

    wp_deregister_script( 'jquery.eislideshow' );
    wp_register_script( 'jquery.eislideshow', get_bloginfo('template_directory').'/js/jquery.eislideshow.js', array(), false, true);
    //if(get_post_meta($slider_page_id, 'pyre_slider_type', true) == 'elastic') {
        wp_enqueue_script( 'jquery.eislideshow' );
    //}

    wp_deregister_script( 'froogaloop' );
    wp_register_script( 'froogaloop', get_bloginfo('template_directory').'/js/froogaloop.js', array(), false, true);
    wp_enqueue_script( 'froogaloop' );

    wp_deregister_script( 'jquery.placeholder' );
    wp_register_script( 'jquery.placeholder', get_bloginfo('template_directory').'/js/jquery.placeholder.js', array(), false, true);
    wp_enqueue_script( 'jquery.placeholder' );

    wp_deregister_script( 'jquery.waypoint' );
    wp_register_script( 'jquery.waypoint', get_bloginfo('template_directory').'/js/jquery.waypoint.js', array(), false, true);
    wp_enqueue_script( 'jquery.waypoint' );

    wp_deregister_script('gmaps.api');
    wp_register_script('gmaps.api', 'http://maps.google.com/maps/api/js?sensor=false&amp;language=' . substr(get_locale(), 0, 2), array(), false, false);
//    if(is_page_template('contact.php') || is_page_template('contact-2.php')) {
        wp_enqueue_script( 'gmaps.api' );
//    }

    wp_deregister_script( 'jquery.ui.map' );
    wp_register_script( 'jquery.ui.map', get_bloginfo('template_directory').'/js/gmap.js', array(), false, false);
    //if(is_page_template('contact.php') || is_page_template('contact-2.php')) {
        wp_enqueue_script( 'jquery.ui.map' );
    //}

    wp_deregister_script( 'jquery.gauge' );
    wp_register_script( 'jquery.gauge', get_bloginfo('template_directory').'/js/gauge.js', array(), false, true);
    wp_enqueue_script( 'jquery.gauge' );

    wp_deregister_script( 'jquery.ddslick.' );
    wp_register_script( 'jquery.ddslick', get_bloginfo('template_directory').'/js/jquery.ddslick.min.js', array(), false, true);
    wp_enqueue_script( 'jquery.ddslick' );

    //if($data['blog_pagination_type'] == 'Infinite Scroll' || is_page_template('demo-gridblog.php') || is_page_template('demo-timelineblog.php')) {
        wp_deregister_script( 'jquery.infinitescroll' );
        wp_register_script( 'jquery.infinitescroll', get_bloginfo('template_directory').'/js/jquery.infinitescroll.min.js', array(), false, true);
        wp_enqueue_script( 'jquery.infinitescroll' );
    //}

    wp_deregister_script( 'salamander' );
    wp_register_script( 'salamander', get_bloginfo('template_directory').'/js/main.js', array(), false, true);
    wp_enqueue_script( 'salamander' );
    }
	}

  public function setPostViews() {
    global $post;

    if('post' == get_post_type() && is_single()) {
      $postID = $post->ID;

      if(!empty($postID)) {
        $count_key = 'sl_post_views_count';
        $count = get_post_meta($postID, $count_key, true);

        if($count == '') {
          $count = 0;
          delete_post_meta($postID, $count_key);
          add_post_meta($postID, $count_key, '0');
        } else {
          $count++;
          update_post_meta($postID, $count_key, $count);
        }
      }
    }
  }

  public static function salamanderComment($comment, $args, $depth)
  {
    $GLOBALS['comment'] = $comment; ?>
    <?php $add_below = ''; ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

    <div class="the-comment">
      <div class="avatar">
        <?php echo get_avatar($comment, 54); ?>
      </div>

      <div class="comment-box">

        <div class="comment-author meta">
          <strong><?php echo get_comment_author_link() ?></strong>
          <?php printf(__('%1$s at %2$s', 'salamander'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__(' - Edit', 'salamander'),'  ','') ?><?php comment_reply_link(array_merge( $args, array('reply_text' => __(' - Reply', 'salamander'), 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>

        <div class="comment-text">
          <?php if ($comment->comment_approved == '0') : ?>
            <em><?php echo __('Your comment is awaiting moderation.', 'Avada') ?></em>
            <br />
          <?php endif; ?>
          <?php comment_text() ?>
        </div>

      </div>

    </div>
    <?php
  }

  private function get_default_options() {
    $options = Yaml::parse(FRAMEWORK_PATH . 'options.yml');

    $this->default_options = ( is_array( $options ) &&  isset( $options['options'] ) )
      ? $options['options']
      : array();
  }

  private function parse_options( $default_options ) {
    if ( is_array($default_options) && !empty( $default_options )) {
       foreach ( $default_options as $values ) {
         foreach ( $values['children'] as $value ) {
           if ( $value['type'] == 'checkboxes' ) {
             foreach ( $value['default'] as $k => $v ) {
               $this->default_values[$value['id']][$k] = true;
             }
           }
           elseif ( $value['type'] == 'upload' && ! empty( $value['default'] )
           || ( $value['type'] == 'media' && ! empty( $value['default'] ) ) ) {
             $this->default_values[$value['id']] = get_bloginfo( 'template_directory' ) . $value['default'];
           }
           else {
             $this->default_values[$value['id']] = $value['default'];
           }
         }
       }
    }
    else {
      $this->default_values = array();
    }
  }
}




