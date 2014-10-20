<?php

/**
 * Main theme framework class
 */

class Salamander {
	public $init;
	public $multiSidebars;
	public $metaBoxes;
	public $shortCodes;

	private static $instance;
	private static $data;
	private static $helper;


	private function __construct() {
		//SalamanderInit class defined in framwork folder
    $this->init = Salamander_Init::get_instance( is_admin() );
    //Init multipleSidebars
    //Register Custom Sidebars (widget zones)
//    $this->multiSidebars = MultipleSidebars::getInstance();
//    //Add metaboxes to posts and pages
//    $this->metaBoxes = new Metaboxes();
//    //Init Shortcodes
//    $this->shortCodes = new ShortCodes();
    //Initialze Helper
    self::$helper = Helper::get_instance();
	}

  public static function get_instance()
  {
    if (self::$instance == null)
    {
      self::$instance = new self();
    }

    return self::$instance;
  }

  public static function __callStatic( $method, $args ) {
    if ( $args ) {
      $cols = '';
      if ( ! isset($args[1]) ) {
        $args[1] = '';
      }
      switch ( $method ) {
        case 'classes':
          if ($args[0] == 'layout') {
            return (self::getData( $args[0] ) == 'wide' ? 'container-fluid' : 'container');
          }
          if ( $args[0] == 'layout' ) {
            return (self::getData( $args[0] ) == 'wide') ? $args[1] . '-fluid' : $args[1];
          }
          if ( $args[0] == 'blog_sidebar_position' ) {
            //Left Sidebar
            if ( $args[1] == 'left-sidebar' ) {
              $cols = (self::getData( $args[0] ) == 'both') ? 'col-xs-16 col-sm-4 col-sm-pull-8 col-md-4 col-md-pull-8' : 'col-xs-16 col-sm-4 col-sm-pull-12 col-md-4 col-md-pull-12';
            }
            //Right Sidebar
            if ( $args[1] == 'right-sidebar' ) {
              $cols = (self::getData( $args[0] ) == 'both') ? 'col-xs-16 col-sm-4 col-md-4' : 'col-xs-16 col-sm-4 col-sm-4 col-md-4 col-md-4';
            }
            //content
            if ( $args[1] == 'main-content' ) {
              if ( self::getData( $args[0] ) == 'both' ) {
                $cols = 'col-xs-16 col-sm-8 col-sm-push-4 col-md-8 col-md-push-4';
              }
              if ( self::getData( $args[0] ) == 'left' ) {
                $cols = 'col-xs-16 col-sm-12 col-sm-push-4 col-md-12 col-md-push-4';
              }
              if ( self::getData( $args[0] ) == 'right' ) {
                $cols = 'col-xs-16 col-sm-12 col-md-12';
              }
            }
            return $args[1] . ' ' . $cols;
          }
          if ( $args[0] == 'footer_widgets' ) {
            static $i = 0;
            $columns = (int) self::getData( 'footer_widgets_columns' );
            switch ( $columns ) {
              case 1:
                if ( $i < $columns )
                  $cols = 'col-xs-16 col-sm-16 col-md-16';
                else
                  $cols = 'hidden';
                break;
              case 2:
                if ( $i < $columns )
                  $cols = 'col-xs-16 col-sm-16 col-md-8';
                else
                  $cols = 'hidden';
                break;
              case 3:
                if ( $i < $columns ) {
                  if ( $i == 1 )
                    $cols = 'col-xs-16 col-sm-16 col-md-6';
                  else
                    $cols = 'col-xs-16 col-sm-16 col-md-5';
                }
                else
                  $cols = 'hidden';
                break;
              case 4:
                $cols = 'col-xs-16 col-sm-16 col-md-4';
                break;
            }
            $i++;
            return $args[1] . ' ' . $cols;
          }
          break;
        default:
          return self::getData( $method );
          break;
      }
    }

    return '';
  }

	public function registerNavMenus()
	{
		$this->init->registerNavMenus();
	}

	public function registerPosts()
	{
		// Register custom post types
		$this->init->registerPosts();
	}

	public function registerSidebars()
	{
		// Register widgetized zones
		$this->init->registerSidebars();
	}

	public function setData()
	{
		self::$data = get_option(THEME_OPTIONS);
	}

	public static function getData($name = null)
	{
		if ($name)
		{
			return isset(self::$data[$name]) ? self::$data[$name] : false;
		}

		return self::$data;
	}

	public function getSidebar($name = 0)
	{
		$this->multiSidebars->getSidebar($name);
	}

	public static function getHtml($section)
	{
		$filePath = '';
		switch ($section)
		{
			case 'favicon':
				$filePath = VIEWS_PATH . 'head' . DS . $section	. '.php';
				break;
			case 'css':
				$filePath = VIEWS_PATH . 'head' . DS . $section	. '.php';
				break;
			case 'javascripts':
				$filePath = VIEWS_PATH . 'head' . DS . $section	. '.php';
				break;
			case 'header':
				$filePath = VIEWS_PATH . $section . DS . $section . '-' . Salamander::getData('header_layout')	. '.php';
				break;
			default:
				$filePath = VIEWS_PATH . $section . DS . $section	. '.php';
				break;
		}
		if ($filePath && file_exists($filePath))
		{
			return self::$helper->render($filePath);
		}
		if ($filePath && !file_exists($filePath))
		{
			return 'Error! Can\'t find file to include ' . $filePath;
		}
		return false;
	}

  static public function breadcrumbs() {
    return self::$helper->breadcrumbs();
  }
}
