<?php
if (Salamander::getData('responsive')) :
  $ipad = (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'iPad');
  ?>

  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/media.css" />
  <?php if (!Salamander::getData('ipad_potrait')) : ?>
  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ipad.css" />
<?php else : ?>
  <style type="text/css">
    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: portrait) {
      #wrapper .ei-slider {
        width:100% !important;
      }
    }
    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) {
      #wrapper .ei-slider {
        width:100% !important;
      }
    }
  </style>
<?php endif; ?>
<?php else: ?>
  <style type="text/css">
    @media only screen and (min-device-width : 768px) and (max-device-width : 1024px) {
      #wrapper .ei-slider {
        width:100% !important;
      }
    }
  </style>
  <?php if((bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPhone')) : ?>
    <style type="text/css">
      @media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
        #wrapper .ei-slider {
          width:100% !important;
        }
      }
    </style>
  <?php endif; ?>
<?php endif; ?>

<style type="text/css">

<?php if($data['pricing_box_color']): ?>
.sep-boxed-pricing ul li.title-row{
  background-color:<?php echo $data['pricing_box_color']; ?> !important;
  border-color:<?php echo $data['pricing_box_color']; ?> !important;
}
.pricing-row .exact_price, .pricing-row sup{
  color:<?php echo $data['pricing_box_color']; ?> !important;
}
<?php endif; ?>



<?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg', true)): ?>
.page-title-container{
  background-image:url(<?php echo get_post_meta($c_pageID, 'pyre_page_title_bar_bg', true); ?>) !important;
}
<?php elseif($data['page_title_bg']): ?>
.page-title-container{
  background-image:url(<?php echo $data['page_title_bg']; ?>) !important;
}
<?php endif; ?>

<?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg_color', true)): ?>
.page-title-container{
  background-color:<?php echo get_post_meta($c_pageID, 'pyre_page_title_bar_bg_color', true); ?>;
}
<?php elseif($data['page_title_bg_color']): ?>
.page-title-container{
  background-color:<?php echo $data['page_title_bg_color']; ?>;
}
<?php endif; ?>

<?php if($data['page_title_border_color']): ?>
.page-title-container{border-color:<?php echo $data['page_title_border_color']; ?> !important;}
<?php endif; ?>

#header{
<?php if($data['header_bg_image']): ?>
  background-image:url(<?php echo $data['header_bg_image']; ?>);
  background-repeat:<?php echo $data['header_bg_repeat']; ?>;
<?php if($data['header_bg_full']): ?>
  background-attachment:fixed;
  background-position:center center;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
<?php endif; ?>
<?php endif; ?>
}

#main{
<?php if($data['content_bg_image']): ?>
  background-image:url(<?php echo $data['content_bg_image']; ?>);
  background-repeat:<?php echo $data['content_bg_repeat']; ?>;
<?php if($data['content_bg_full']): ?>
  background-attachment:fixed;
  background-position:center center;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
<?php endif; ?>
<?php endif; ?>
}

<?php if($data['testimonial_bg_color']): ?>
.review blockquote q,.post-content blockquote{
  background-color:<?php echo $data['testimonial_bg_color']; ?> !important;
}
.review blockquote div:after{
  border-top-color:<?php echo $data['testimonial_bg_color']; ?> !important;
}
<?php endif; ?>

<?php if($data['testimonial_text_color']): ?>
.review blockquote q,.post-content blockquote{
  color:<?php echo $data['testimonial_text_color']; ?> !important;
}
<?php endif; ?>


<?php if($data['headings_color']): ?>
/*.post-content h1, .post-content h2, .post-content h3,
.post-content h4, .post-content h5, .post-content h6,
#sidebar .widget h3,h5.toggle a,
.page-title h1,.full-boxed-pricing ul li.title-row,
.project-content .project-info h4,.project-content h3,.share-box h4,.title h2,.person-author-wrapper,#sidebar .tab-holder .tabs li a,#header .tagline,
.table-1 table th{
  color:<?php echo $data['headings_color']; ?> !important;
  }*/
<?php endif; ?>



<?php if($data['es_title_color']): ?>
.ei-title h2{color:<?php echo $data['es_title_color']; ?> !important;}
<?php endif; ?>

<?php if($data['es_caption_color']): ?>
.ei-title h3{color:<?php echo $data['es_caption_color']; ?> !important;}
<?php endif; ?>



<?php if($data['sep_color']): ?>
.sep-single{background-color:<?php echo $data['sep_color']; ?> !important;}
.sep-double,.sep-dashed,.sep-dotted{border-color:<?php echo $data['sep_color']; ?> !important;}
.ls-avada, .avada-skin-rev,.clients-carousel .es-carousel li,h5.toggle a,.progress-bar,
#small-nav,.portfolio-tabs,.faq-tabs,.single-navigation,.project-content .project-info .project-info-box,
.post .meta-info,.grid-layout .post,.grid-layout .post .content-sep,
.grid-layout .post .flexslider,.timeline-layout .post,.timeline-layout .post .content-sep,
.timeline-layout .post .flexslider,h3.timeline-title,.timeline-arrow,
.counter-box-wrapper,.table-2 table thead,.table-2 tr td,
#sidebar .widget li a,#sidebar .widget .recentcomments,#sidebar .widget_categories li,
.tab-holder,.commentlist .the-comment,
.side-nav,.side-nav li a,h5.toggle.active + .toggle-content,
.side-nav li.current_page_item li a,.tabs-vertical .tabset,
.tabs-vertical .tabs-container .tab_content,.page-title-container,.pagination a.inactive{border-color:<?php echo $data['sep_color']; ?>;}
.side-nav li a{border-color:<?php echo $data['sep_color']; ?> !important;}
<?php endif; ?>

<?php if($data['tagline_font_color']): ?>
#header .tagline{
  color:<?php echo $data['tagline_font_color']; ?> !important;
}
<?php endif; ?>

<?php if($data['tagline_font_size']): ?>
#header .tagline{
  font-size:<?php echo $data['tagline_font_size']; ?>px !important;
  line-height:30px !important;
}
<?php endif; ?>

<?php if($data['page_title_font_size']): ?>
.page-title h1{
  font-size:<?php echo $data['page_title_font_size']; ?>px !important;
  line-height:normal !important;
}
<?php endif; ?>


<?php if($data['dropdown_menu_width']): ?>
#nav ul ul{
  width:<?php echo $data['dropdown_menu_width']; ?> !important;
}
<?php endif; ?>

<?php if($data['page_title_height']): ?>
.page-title-container{
  height:<?php echo $data['page_title_height']; ?> !important;
}
<?php endif; ?>

<?php if($data['sidebar_bg_color']): ?>
#main #sidebar{
  background-color:<?php echo $data['sidebar_bg_color']; ?>;
}
<?php endif; ?>

<?php if($data['content_width']): ?>
#main #content{
  width:<?php echo $data['content_width']; ?>%;
}
<?php endif; ?>

<?php if($data['sidebar_width']): ?>
#main #sidebar{
  width:<?php echo $data['sidebar_width']; ?>%;
}
<?php endif; ?>

<?php if($data['sidebar_padding']): ?>
#main #sidebar{
  padding-left:<?php echo $data['sidebar_padding']; ?>%;
  padding-right:<?php echo $data['sidebar_padding']; ?>%;
}
<?php endif; ?>

<?php if($data['tabs_bg_color'] && $data['tabs_inactive_color']): ?>
#sidebar .tab-holder,#sidebar .tab-holder .news-list li{border-color:<?php echo $data['tabs_inactive_color']; ?> !important;}
.pyre_tabs .tabs-container{background-color:<?php echo $data['tabs_bg_color']; ?> !important;}
body.dark #sidebar .tab-hold .tabs li{border-right:1px solid <?php echo $data['tabs_bg_color']; ?> !important;}
body.dark #sidebar .tab-hold .tabs li a{background:<?php echo $data['tabs_inactive_color']; ?> !important;border-bottom:0 !important;color:<?php echo $data[body_text_color]; ?> !important;}
body.dark #sidebar .tab-hold .tabs li a:hover{background:<?php echo $data['tabs_bg_color']; ?> !important;border-bottom:0 !important;}
body #sidebar .tab-hold .tabs li.active a{background:<?php echo $data['tabs_bg_color']; ?> !important;border-bottom:0 !important;}
body #sidebar .tab-hold .tabs li.active a{border-top-color:<?php echo $data[primary_color]; ?>!important;}
<?php endif; ?>

<?php if($data['social_bg_color']): ?>
.share-box{background-color:<?php echo $data['social_bg_color']; ?>;}
<?php endif; ?>

<?php if($data['scheme_type'] == 'Dark'): $avada_color_scheme = 'dark'; ?>
.meta li{border-color:<?php echo $data['body_text_color']; ?>;}
.error-image{background-image:url(<?php echo get_template_directory_uri(); ?>/images/404_image_dark.png);}
.review blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user_dark.png);}
.review.male blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user_dark.png);}
.review.female blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user-girl_dark.png);}
.timeline-layout{background-image:url(<?php echo get_template_directory_uri(); ?>/images/timeline_line_dark.png);}
.side-nav li a{background-image:url(<?php echo get_template_directory_uri(); ?>/images/side_nav_bg_dark.png);}
@media only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 13/10), only screen and (min-resolution: 120dpi) {
  .error-image{background-image:url(<?php echo get_template_directory_uri(); ?>/images/404_image_dark@2x.png) !important;}
  .review blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user_dark@2x.png) !important;}
  .review.male blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user_dark@2x.png) !important;}
  .review.female blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user-girl_dark@2x.png) !important;}
  .side-nav li a{background-image:url(<?php echo get_template_directory_uri(); ?>/images/side_nav_bg_dark@2x.png) !important;}
}
<?php endif; ?>

<?php if(is_single() && get_post_meta($c_pageID, 'pyre_fimg_width', true)): ?>
<?php if(get_post_meta($c_pageID, 'pyre_fimg_width', true) != 'auto' && get_post_meta($c_pageID, 'pyre_width', true) != 'half'): ?>
#post-<?php echo $c_pageID; ?> .post-slideshow {width:<?php echo get_post_meta($c_pageID, 'pyre_fimg_width', true); ?> !important;}
<?php else: ?>
.post-slideshow .flex-control-nav{position:relative;text-align:left;margin-top:10px;}
<?php endif; ?>
#post-<?php echo $c_pageID; ?> .post-slideshow img{width:<?php echo get_post_meta($c_pageID, 'pyre_fimg_width', true); ?> !important;}
<?php endif; ?>

<?php if(is_single() && get_post_meta($c_pageID, 'pyre_fimg_height', true)): ?>
#post-<?php echo $c_pageID; ?> .post-slideshow, #post-<?php echo $c_pageID; ?> .post-slideshow img{height:<?php echo get_post_meta($c_pageID, 'pyre_fimg_height', true); ?> !important;}
<?php endif; ?>

<?php if(!$data['flexslider_circles']): ?>
.main-flex .flex-control-nav{display:none !important;}
<?php endif; ?>

<?php if(!$data['breadcrumb_mobile']): ?>
@media only screen and (max-width: 940px){
  .breadcrumbs{display:none !important;}
}
@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: portrait){
  .breadcrumbs{display:none !important;}
}
<?php endif; ?>

<?php if(!$data['image_rollover']): ?>
.image-extras{display:none !important;}
<?php endif; ?>

<?php if($data['nav_height']): ?>
#nav > li > a,#nav li.current-menu-ancestor a{height:<?php echo $data['nav_height']; ?>px;line-height:<?php echo $data['nav_height']; ?>px;}
#nav > li > a,#nav li.current-menu-ancestor a{height:<?php echo $data['nav_height']; ?>px;line-height:<?php echo $data['nav_height']; ?>px;}

#nav ul ul{top:<?php echo $data['nav_height']+3; ?>px;}

<?php if(is_page('header-4') || is_page('header-5')) { ?>
#nav > li > a,#nav li.current-menu-ancestor a{height:40px;line-height:40px;}
#nav > li > a,#nav li.current-menu-ancestor a{height:40px;line-height:40px;}

#nav ul ul{top:43px;}
<?php } ?>
<?php endif; ?>

<?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg_retina', true)): ?>
@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {
  .page-title-container {
    background-image: url(<?php echo get_post_meta($c_pageID, 'pyre_page_title_bar_bg_retina', true); ?>) !important;
    -webkit-background-size:cover;
    -moz-background-size:cover;
    -o-background-size:cover;
    background-size:cover;
  }
}
<?php elseif($data['page_title_bg_retina']): ?>
@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {
  .page-title-container {
    background-image: url(<?php echo $data['page_title_bg_retina']; ?>) !important;
    -webkit-background-size:cover;
    -moz-background-size:cover;
    -o-background-size:cover;
    background-size:cover;
  }
}
<?php endif; ?>

<?php if($data['tfes_slider_width']): ?>
.ei-slider{width:<?php echo $data['tfes_slider_width']; ?> !important;}
<?php endif; ?>

<?php if($data['tfes_slider_height']): ?>
.ei-slider{height:<?php echo $data['tfes_slider_height']; ?> !important;}
<?php endif; ?>


<?php if($data['tagline_bg']): ?>
.reading-box{background-color:<?php echo $data['tagline_bg']; ?> !important;}
<?php endif; ?>

.isotope .isotope-item {
  -webkit-transition-property: top, left, opacity;
  -moz-transition-property: top, left, opacity;
  -ms-transition-property: top, left, opacity;
  -o-transition-property: top, left, opacity;
  transition-property: top, left, opacity;
}
</style>