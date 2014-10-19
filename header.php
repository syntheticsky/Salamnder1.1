<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?> <?php wp_title(' | ', true, 'left'); ?></title>
  <?php wp_head(); ?>
  <?php echo Salamander::getHtml('favicon'); ?>
  <!-- include googlefonts -->
<?php if (Salamander::getData('google_body') && Salamander::getData('google_body') != 'Select Font'): ?>
  <link href='http://fonts.googleapis.com/css?family=<?php echo urlencode(Salamander::getData('google_body')); ?>:300,400,400italic,500,600,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese' rel='stylesheet' type='text/css' />
<?php endif; ?>
<?php if (Salamander::getData('google_nav') && Salamander::getData('google_nav') != 'Select Font'): ?>
  <link href='http://fonts.googleapis.com/css?family=<?php echo urlencode(Salamander::getData('google_nav')); ?>:300,400,400italic,500,600,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese' rel='stylesheet' type='text/css' />
<?php endif; ?>
<?php if (Salamander::getData('google_headings') && Salamander::getData('google_headings') != 'Select Font'): ?>
  <link href='http://fonts.googleapis.com/css?family=<?php echo urlencode(Salamander::getData('google_headings')); ?>:300,400,400italic,500,600,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese' rel='stylesheet' type='text/css' />
<?php endif; ?>
<?php if (Salamander::getData('google_footer_headings') && Salamander::getData('google_footer_headings') != 'Select Font'): ?>
  <link href='http://fonts.googleapis.com/css?family=<?php echo urlencode(Salamander::getData('google_footer_headings')); ?>:300,400,400italic,500,600,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese' rel='stylesheet' type='text/css' />
<?php endif; ?>
  <!--[if lt IE 9]>
  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" />
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- include css -->
  <?php echo Salamander::getHtml('css'); ?>
  <!-- include javascript -->
  <?php //echo Salamander::getHtml('javascripts'); ?>
  <!-- Google analitics -->
  <?php echo Salamander::getData('google_analytics'); ?>
  <!-- include custom code -->
  <?php echo Salamander::getData('head_after'); ?>
</head>
<body <?php body_class(strtolower(Salamander::getData('scheme_type'))); ?>>
  <div id="wrapper">
    <?php echo Salamander::getHtml('header'); ?>
  <?php if ( Salamander::getData( 'page_title_bar' ) ) : ?>
      <?php get_template_part( 'framework/views/page-title' ); ?>
  <?php endif; ?>

