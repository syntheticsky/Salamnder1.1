<?php

/**
 * Define autoload function
 */
function salamanderAutoload($class_name) {
    //class directories
    $directories = array(
        'admin',
        'framework',
        // 'framework' . DIRECTORY_SEPARATOR . 'views',
        'framework' . DIRECTORY_SEPARATOR . 'libs',
        'framework' . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'Yaml',
//        'framework' . DIRECTORY_SEPARATOR . 'widgets',
//        'framework' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'kdMultipleFeaturedImages',
    );

    //for each directory
    foreach ( $directories as $dir ) {
      //see if the file exsists

      $file_name = (false !== strpos($class_name, 'Yaml'))
        ? $class_name . '.php'
        : 'class-' . str_replace('_', '-', strtolower($class_name)) . '.php';

      if( file_exists( get_template_directory() . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $file_name ) ) {
        require_once( get_template_directory() . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $file_name );
        return;
      }
    }
}
// Register autoload function
spl_autoload_register('salamanderAutoload');