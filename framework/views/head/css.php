<!-- Styleshhet -->
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet">

<?php /**************************  Salamander  Style ***************************/ ?>
<?php
if((get_option('show_on_front') && get_option('page_for_posts') && is_home()) ||
  (get_option('page_for_posts') && is_archive() && !is_post_type_archive())) {
  $c_pageID = get_option('page_for_posts');
} else {
  global $post;
  $c_pageID = $post->ID;
}
?>
<?php if ( ! Salamander::getData( 'responsive' ) ) : ?>
  <link rel="stylesheet" href="<?php echo get_bloginfo( 'template_directory' ); ?>/css/non-responsive.css" />
<?php endif; ?>

<style type="text/css">

/*** Fonts ***/
<?php $custom_font = false;?>
<?php if ( Salamander::getData ( 'custom_font_woff' )
            && Salamander::getData ( 'custom_font_ttf' )
            && Salamander::getData ( 'custom_font_svg' )
            && Salamander::getData ( 'custom_font_eot' ) ): ?>
@font-face {
    font-family: 'MuseoSlab500Regular';
    src: url('<?php echo Salamander::getData ( 'custom_font_eot' ); ?>');
    src:
    url('<?php echo Salamander::getData ( 'custom_font_eot' ); ?>?#iefix') format('eot'),
    url('<?php echo Salamander::getData ( 'custom_font_woff' ); ?>') format('woff'),
    url('<?php echo Salamander::getData ( 'custom_font_ttf' ); ?>') format('truetype'),
    url('<?php echo Salamander::getData ( 'custom_font_svg' ); ?>#MuseoSlab500Regular') format('svg');
    font-weight: 400;
    font-style: normal;
}
<?php $custom_font = true; ?>
<?php endif; ?>

<?php
if ( Salamander::getData ( 'google_body' ) )
  $font = '"' . Salamander::getData ( 'google_body' ) . '", Arial, Helvetica, sans-serif !important';
elseif ( Salamander::getData ( 'standard_body' ) )
  $font = Salamander::getData ( 'standard_body' ) . ' !important';
?>
<?php if ( isset( $font ) ): ?>
/* body fonts */
body,
#nav ul li ul li a,
.more,
.container h3,
.meta .date,
.review blockquote q,
.review blockquote div strong,
.image .image-extras .image-extras-content h4,
.project-content .project-info h4,
.post-content blockquote,
.button.large,
.button.small,
.ei-title h3{
    font-family:<?php echo $font; ?>;
}
<?php endif; ?>
/** Nav font **/
<?php if ( ! $custom_font && Salamander::getData ( 'google_nav' ) )
  $nav_font = '"' . Salamander::getData ( 'google_nav' ) . '", Arial, Helvetica, sans-serif !important';
elseif ( ! $custom_font && Salamander::getData ( 'standard_nav' ) )
  $nav_font = Salamander::getData ( 'standard_nav' ) . ' !important';
?>
<?php if ( isset( $nav_font ) ): ?>
#nav,
.side-nav li a{
    font-family:<?php echo $nav_font; ?>;
}
<?php endif; ?>

/** Heading font **/
<?php if ( ! $custom_font && Salamander::getData ( 'google_headings' ) )
  $headings_font = '"' . Salamander::getData ( 'google_headings' ) . '", Arial, Helvetica, sans-serif !important';
elseif ( ! $custom_font && Salamander::getData ( 'standard_headings' ) )
  $headings_font = Salamander::getData ( 'standard_headings' ) . ' !important';
?>
<?php if ( isset( $headings_font ) ): ?>
#content .reading-box h2,
#content h2,
.page-title h1,
.image .image-extras .image-extras-content h3,
#content .post h2,
#right-sidebar .widget h3,
#left-sidebar .widget h3,
.tab-holder .tabs li a,
.share-box h4,
.project-content h3,
h5.toggle a,
.full-boxed-pricing ul li.title-row,
.full-boxed-pricing ul li.pricing-row,
.sep-boxed-pricing ul li.title-row,
.sep-boxed-pricing ul li.pricing-row,
.person-author-wrapper,
.post-content h1, .post-content h2, .post-content h3, .post-content h4, .post-content h5, .post-content h6,
.ei-title h2, header .tagline,
table th{
    font-family:<?php echo $headings_font; ?>;
}
<?php endif; ?>

<?php if ( Salamander::getData ( 'google_footer_headings' ) )
  $footer_headings_font = '"' . Salamander::getData ( 'google_footer_headings' ) . '", Arial, Helvetica, sans-serif !important';
elseif ( Salamander::getData ( 'standard_footer_headings' ) )
  $footer_headings_font = Salamander::getData ( 'standard_footer_headings' ) . ' !important';
?>
<?php if ( isset( $footer_headings_font ) ): ?>
.footer-area  h3 {
    font-family:<?php echo $footer_headings_font; ?>;
}
<?php endif; ?>

<?php if ( Salamander::getData ( 'body_font_size' ) ): ?>
<?php $line_height = round ( ( 1.5 * Salamander::getData ( 'body_font_size' ) ) ); ?>
body,
#right-sidebar .slide-excerpt h2,
#left-sidebar .slide-excerpt h2,
.footer-area .slide-excerpt h2 {
    font-size:<?php echo Salamander::getData ( 'body_font_size' ); ?>px;
    line-height:<?php echo $line_height; ?>px;
}
.project-content .project-info h4{
    font-size:<?php echo Salamander::getData ( 'body_font_size' ); ?>px !important;
    line-height:<?php echo $line_height; ?>px !important;
}
<?php endif; ?>

<?php if ( Salamander::getData ( 'body_font_lh' ) ): ?>
body,
#right-sidebar .slide-excerpt h2,
#left-sidebar .slide-excerpt h2,
.footer-area .slide-excerpt h2 {
    line-height:<?php echo Salamander::getData ( 'body_font_lh' ); ?>px !important;
}
.project-content .project-info h4 {
    line-height:<?php echo Salamander::getData ( 'body_font_lh' ); ?>px !important;
}
<?php endif; ?>

<?php if ( Salamander::getData ( 'nav_font_size' ) ): ?>
#nav {
    font-size:<?php echo Salamander::getData ( 'nav_font_size' ); ?>px !important;
}
<?php endif; ?>

<?php if ( Salamander::getData ( 'snav_font_size' ) ): ?>
.top-nav * {
    font-size:<?php echo Salamander::getData ( 'snav_font_size' ); ?>px !important;
}
<?php endif; ?>

<?php if ( Salamander::getData ( 'breadcrumbs_font_size' ) ): ?>
.breadcrumb li,
.breadcrumb li a {
    font-size:<?php echo Salamander::getData ( 'breadcrumbs_font_size' ); ?>px !important;
}
<?php endif; ?>

<?php if ( Salamander::getData ( 'side_nav_font_size' ) ): ?>
.side-nav li a {
    font-size:<?php echo Salamander::getData ( 'side_nav_font_size' ); ?>px !important;
}
<?php endif; ?>

<?php if ( Salamander::getData ( 'sidebar_w_font_size' ) ): ?>
#right-sidebar .widget h3,
#left-sidebar .widget h3 {
    font-size:<?php echo Salamander::getData ( 'sidebar_w_font_size' ); ?>px !important;
}
<?php endif; ?>

<?php if ( Salamander::getData ( 'footer_w_font_size' ) ): ?>
#footer h3 {
    font-size:<?php echo Salamander::getData ( 'footer_w_font_size' ); ?>px !important;
}
<?php endif; ?>

<?php if ( Salamander::getData ( 'copyright_font_size' ) ): ?>
.copyright {
    font-size:<?php echo Salamander::getData ( 'copyright_font_size' ); ?>px !important;
}
<?php endif; ?>

<?php if ( Salamander::getData ( 'responsive' ) ): ?>
header .avada-row,
#content .avada-row,
.footer-area .avada-row,
#footer .avada-row {
    max-width:940px;
}
<?php endif; ?>

<?php if ( Salamander::getData ( 'h1_font_size' ) ): ?>
.post-content h1 {
    font-size:<?php echo Salamander::getData ( 'h1_font_size' ); ?>px !important;
<?php $line_height = round ( ( 1.5 * Salamander::getData ( 'h1_font_size' ) ) ); ?>
    line-height:<?php echo $line_height; ?>px !important;
}
<?php endif; ?>
<?php if ( Salamander::getData ( 'h1_font_lh' ) ): ?>
.post-content h1{
    line-height:<?php echo Salamander::getData ( 'h1_font_lh' ); ?>px !important;
}
<?php endif; ?>
<?php if ( Salamander::getData ( 'h2_font_size' ) ): ?>
.post-content h2,
.title h2,
#content .post-content .title h2,
.page-title h1,#content .post h2 a {
    font-size:<?php echo Salamander::getData ( 'h2_font_size' ); ?>px !important;
<?php $line_height = round ( ( 1.5 * Salamander::getData ( 'h2_font_size' ) ) ); ?>
    line-height:<?php echo $line_height; ?>px !important;
}
<?php endif; ?>
<?php if ( Salamander::getData ( 'h2_font_lh' ) ): ?>
.post-content h2,
.title h2,
#content .post-content .title h2,
.page-title h1,
#content .post h2 a {
    line-height:<?php echo Salamander::getData ( 'h2_font_lh' ); ?>px !important;
}
<?php endif; ?>
<?php if ( Salamander::getData ( 'h3_font_size' ) ): ?>
.post-content h3,
.project-content h3,
header .tagline {
    font-size:<?php echo Salamander::getData ( 'h3_font_size' ); ?>px !important;
<?php $line_height = round ( ( 1.5 * Salamander::getData ( 'h3_font_size' ) ) ); ?>
    line-height:<?php echo $line_height; ?>px !important;
}
<?php endif; ?>

<?php if ( Salamander::getData ( 'h3_font_lh' ) ): ?>
.post-content h3,
.project-content h3,
header .tagline {
    line-height:<?php echo Salamander::getData ( 'h3_font_lh' ); ?>px !important;
}
<?php endif; ?>

<?php if ( Salamander::getData ( 'h4_font_size' ) ): ?>
.post-content h4 {
    font-size:<?php echo Salamander::getData ( 'h4_font_size' ); ?>px !important;
<?php $line_height = round ( ( 1.5 * Salamander::getData ( 'h4_font_size' ) ) ); ?>
    line-height:<?php echo $line_height; ?>px !important;
}
h5.toggle a,
.tab-holder .tabs li a,
.share-box h4,
.person-author-wrapper {
    font-size:<?php echo Salamander::getData ( 'h4_font_size' ); ?>px !important;
}
<?php endif; ?>

<?php if ( Salamander::getData ( 'h4_font_lh' ) ): ?>
.post-content h4 {
    line-height:<?php echo Salamander::getData ( 'h4_font_lh' ); ?>px !important;
}
<?php endif; ?>
<?php if ( Salamander::getData ( 'h5_font_size' ) ): ?>
.post-content h5 {
    font-size:<?php echo Salamander::getData ( 'h5_font_size' ); ?>px !important;
<?php $line_height = round ( ( 1.5 * Salamander::getData ( 'h5_font_size' ) ) ); ?>
    line-height:<?php echo $line_height; ?>px !important;
}
<?php endif; ?>
<?php if ( Salamander::getData ( 'h5_font_lh' ) ): ?>
.post-content h5 {
    line-height:<?php echo Salamander::getData ( 'h5_font_lh' ); ?>px !important;
}
<?php endif; ?>
<?php if ( Salamander::getData ( 'h6_font_size' ) ): ?>
.post-content h6{
    font-size:<?php echo Salamander::getData ( 'h6_font_size' ); ?>px !important;
<?php $line_height = round ( ( 1.5 * Salamander::getData ( 'h6_font_size' ) ) ); ?>
    line-height:<?php echo $line_height; ?>px !important;
}
<?php endif; ?>
<?php if ( Salamander::getData ( 'h6_font_lh' ) ): ?>
.post-content h6{
    line-height:<?php echo Salamander::getData ( 'h6_font_lh' ); ?>px !important;
}
<?php endif; ?>
<?php //if ( Salamander::getData ( 'es_title_font_size' ) ): ?>
<!--  .ei-title h2{-->
      <!--  font-size:--><?php //echo Salamander::getData ( 'es_title_font_size' ); ?><!--px !important;-->
      <!--  --><?php
//  $line_height = round ( ( 1.5 * Salamander::getData ( 'es_title_font_size' ) ) );
//  ?>
      <!--  line-height:--><?php //echo $line_height; ?><!--px !important;-->
      <!--  }-->
<?php //endif; ?>
<!---->
<?php //if ( Salamander::getData ( 'es_caption_font_size' ) ): ?>
<!--  .ei-title h3{-->
      <!--  font-size:--><?php //echo Salamander::getData ( 'es_caption_font_size' ); ?><!--px !important;-->
      <!--  --><?php
//  $line_height = round ( ( 1.5 * Salamander::getData ( 'es_caption_font_size' ) ) );
//  ?>
      <!--  line-height:--><?php //echo $line_height; ?><!--px !important;-->
      <!--  }-->
<?php //endif; ?>

/*** ! Fonts ***/

/*** Styling options ***/
<?php if ( Salamander::getData( 'scheme_type' ) == 'dark' ): ?>
.meta li{border-color:<?php echo Salamander::getData( 'body_text_color' ); ?>;}
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
<?php if ( Salamander::getData( 'color_scheme' ) != 'default' ): ?>
/** add Color scheme css **/
<?php endif; ?>

<?php if ( Salamander::getData( 'primary_color' ) ): ?>
a:hover,
#nav ul .current_page_item a, #nav ul .current-menu-item a, #nav ul > .current-menu-parent a,
.footer-area ul li a:hover,
.side-nav li.current_page_item a,
.portfolio-tabs li.active a, .faq-tabs li.active a,
.project-content .project-info .project-info-box a:hover,
.about-author .title a,
span.dropcap,.footer-area a:hover,.copyright a:hover,
#left-sidebar .widget_categories li a:hover,
#right-sidebar .widget_categories li a:hover,
#content .post h2 a:hover,
#left-sidebar .widget li a:hover,
#right-sidebar .widget li a:hover,
#nav ul a:hover,
.date-and-formats .format-box i,
h5.toggle:hover a,
.tooltip-shortcode,.content-box-percentage,
.more a:hover:after,.read-more:hover:after,.pagination-prev:hover:before,.pagination-next:hover:after,
.single-navigation a[rel=prev]:hover:before,.single-navigation a[rel=next]:hover:after,
#left-sidebar .widget_nav_menu li a:hover:before,
#right-sidebar .widget_nav_menu li a:hover:before,
#left-sidebar .widget_categories li a:hover:before,
#right-sidebar .widget_categories li a:hover:before,
#left-sidebar .widget .recentcomments:hover:before,
#right-sidebar .widget .recentcomments:hover:before,
#left-sidebar .widget_recent_entries li a:hover:before,
#right-sidebar .widget_recent_entries li a:hover:before,
#left-sidebar .widget_archive li a:hover:before,
#right-sidebar .widget_archive li a:hover:before,
#left-sidebar .widget_pages li a:hover:before,
#right-sidebar .widget_pages li a:hover:before,
#left-sidebar .widget_links li a:hover:before,.side-nav .arrow:hover:after {
#right-sidebar .widget_links li a:hover:before,.side-nav .arrow:hover:after {
    color:<?php echo Salamander::getData( 'primary_color' ); ?> !important;
}
#nav ul .current_page_item a, #nav ul .current-menu-item a, #nav ul > .current-menu-parent a,
#nav ul ul,#nav li.current-menu-ancestor a,
.reading-box,
.portfolio-tabs li.active a, .faq-tabs li.active a,
.tab-holder .tabs li.active a,
.post-content blockquote,
.progress-bar-content,
.pagination .current,
.pagination a.inactive:hover,
#nav ul a:hover{
    border-color:<?php echo Salamander::getData( 'primary_color' ); ?> !important;
}
.side-nav li.current_page_item a{
    border-right-color:<?php echo Salamander::getData( 'primary_color' ); ?> !important;
}
.header-v2 .header-social, .header-v3 .header-social, .header-v4 .header-social,.header-v5 .header-social,.header-v2{
    border-top-color:<?php echo Salamander::getData( 'primary_color' ); ?> !important;
}
h5.toggle.active span.arrow,
.post-content ul.circle-yes li:before,
.progress-bar-content,
.pagination .current,
.header-v3 .header-social,.header-v4 .header-social,.header-v5 .header-social,
.date-and-formats .date-box,.table-2 table thead{
    background-color:<?php echo Salamander::getData( 'primary_color' ); ?> !important;
}
<?php endif; ?>

<?php if ( Salamander::getData( 'header_bg_color' ) ): ?>
header,
#small-nav {
    background-color:<?php echo Salamander::getData( 'header_bg_color' ); ?> !important;
}
#nav ul a {
    border-color:<?php echo Salamander::getData( 'header_bg_color' ); ?> !important;
}
<?php endif; ?>
<?php if ( Salamander::getData( 'header_border_color' ) ): ?>
header,
.header-social {
    border-bottom-color:<?php echo Salamander::getData( 'header_border_color' ); ?> !important;
}
<?php endif; ?>
<?php if ( Salamander::getData( 'header_top_bg_color' ) ): ?>
#wrapper .header-social {
    background-color:<?php echo Salamander::getData( 'header_top_bg_color' ); ?> !important;
}
<?php endif; ?>
<?php if ( Salamander::getData( 'content_bg_color') ): ?>
#content,
#wrapper {
    background-color:<?php echo Salamander::getData( 'content_bg_color' ); ?> !important;
}
<?php endif; ?>
<?php if ( Salamander::getData( 'footer_bg_color' ) ): ?>
#footer {
    background-color:<?php echo Salamander::getData( 'footer_bg_color' ); ?> !important;
}
<?php endif; ?>
<?php if ( Salamander::getData( 'footer_border_color' ) ): ?>
#footer {
    border-color:<?php echo Salamander::getData( 'footer_border_color' ); ?> !important;
}
<?php endif; ?>
<?php if ( Salamander::getData( 'copyright_bg_color' ) ): ?>
#footer {
    background-color:<?php echo Salamander::getData( 'copyright_bg_color' ); ?> !important;
}
<?php endif; ?>
<?php if ( Salamander::getData( 'copyright_border_color' ) ): ?>
#footer {
    border-color:<?php echo Salamander::getData( 'copyright_border_color' ); ?> !important;
}
<?php endif; ?>
<?php if ( Salamander::getData( 'image_gradient_top_color' ) && Salamander::getData( 'image_gradient_bottom_color' ) ): ?>
<?php
$imgr_gtop = Helper::hex2rgb( Salamander::getData( 'image_gradient_top_color' ) );
$imgr_gbot = Helper::hex2rgb( Salamander::getData( 'image_gradient_bottom_color' ) );
$opacity = '1';
if ( Salamander::getData( 'image_rollover_opacity' ) )
  $opacity = Salamander::getData( 'image_rollover_opacity' );
$imgr_gtop_string = 'rgba('.$imgr_gtop[0].','.$imgr_gtop[1].','.$imgr_gtop[2].','.$opacity.')';
$imgr_gbot_string = 'rgba('.$imgr_gbot[0].','.$imgr_gbot[1].','.$imgr_gbot[2].','.$opacity.')';
?>
.image .image-extras{
    background-image: linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);
    background-image: -o-linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);
    background-image: -moz-linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);
    background-image: -webkit-linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);
    background-image: -ms-linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);

    background-image: -webkit-gradient(
        linear,
        left top,
        left bottom,
        color-stop(0, <?php echo $imgr_gtop_string; ?>),
        color-stop(1, <?php echo $imgr_gbot_string; ?>)
    );
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo Salamander::getData( 'image_gradient_top_color' ); ?>', endColorstr='<?php echo Salamander::getData( 'image_gradient_bottom_color' ); ?>');
}
.no-cssgradients .image .image-extras{
    background:<?php echo Salamander::getData( 'image_gradient_top_color' ); ?>;
}
<?php endif; ?>

<?php if ( Salamander::getData( 'button_gradient_top_color' )
        && Salamander::getData( 'button_gradient_bottom_color' )
        && Salamander::getData( 'button_gradient_text_color' ) ): ?>
#content .reading-box .button,
#content .continue.button,
#content .portfolio-one .button,
#content .comment-submit,
.button.default{
    color: <?php echo Salamander::getData( 'button_gradient_text_color' ); ?> !important;
    background-image: linear-gradient(top, <?php echo Salamander::getData( 'button_gradient_top_color' ); ?> 0%, <?php echo Salamander::getData( 'button_gradient_bottom_color' ); ?> 100%);
    background-image: -o-linear-gradient(top, <?php echo Salamander::getData( 'button_gradient_top_color' ); ?> 0%, <?php echo Salamander::getData( 'button_gradient_bottom_color' ); ?> 100%);
    background-image: -moz-linear-gradient(top, <?php echo Salamander::getData( 'button_gradient_top_color' ); ?> 0%, <?php echo Salamander::getData( 'button_gradient_bottom_color' ); ?> 100%);
    background-image: -webkit-linear-gradient(top, <?php echo Salamander::getData( 'button_gradient_top_color' ); ?> 0%, <?php echo Salamander::getData( 'button_gradient_bottom_color' ); ?> 100%);
    background-image: -ms-linear-gradient(top, <?php echo Salamander::getData( 'button_gradient_top_color' ); ?> 0%, <?php echo Salamander::getData( 'button_gradient_bottom_color' ); ?> 100%);

    background-image: -webkit-gradient(
        linear,
        left top,
        left bottom,
        color-stop(0, <?php echo Salamander::getData( 'button_gradient_top_color' ); ?>),
        color-stop(1, <?php echo Salamander::getData( 'button_gradient_bottom_color' ); ?>)
    );
    border:1px solid <?php echo Salamander::getData( 'button_gradient_bottom_color' ); ?>;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo Salamander::getData( 'button_gradient_top_color' ); ?>', endColorstr='<?php echo Salamander::getData( 'button_gradient_bottom_color' ); ?>');
}
.no-cssgradients #content .reading-box .button,
.no-cssgradients #content .continue.button,
.no-cssgradients #content .portfolio-one .button,
.no-cssgradients #content .comment-submit,
.no-cssgradients .button.default{
   background:<?php echo Salamander::getData( 'button_gradient_top_color' ); ?>;
}
#content .reading-box .button:hover,
#content .continue.button:hover,
#content .portfolio-one .button:hover,
#content .comment-submit:hover,
.button.default:hover{
    color: <?php echo Salamander::getData( 'button_gradient_text_color' ); ?> !important;
    background-image: linear-gradient(top, <?php echo Salamander::getData( 'button_gradient_bottom_color' ); ?> 0%, <?php echo Salamander::getData( 'button_gradient_top_color' ); ?> 100%);
    background-image: -o-linear-gradient(top, <?php echo Salamander::getData( 'button_gradient_bottom_color' ); ?> 0%, <?php echo Salamander::getData( 'button_gradient_top_color' ); ?> 100%);
    background-image: -moz-linear-gradient(top, <?php echo Salamander::getData( 'button_gradient_bottom_color' ); ?> 0%, <?php echo Salamander::getData( 'button_gradient_top_color' ); ?> 100%);
    background-image: -webkit-linear-gradient(top, <?php echo Salamander::getData( 'button_gradient_bottom_color' ); ?> 0%, <?php echo Salamander::getData( 'button_gradient_top_color' ); ?> 100%);
    background-image: -ms-linear-gradient(top, <?php echo Salamander::getData( 'button_gradient_bottom_color' ); ?> 0%, <?php echo Salamander::getData( 'button_gradient_top_color' ); ?> 100%);

    background-image: -webkit-gradient(
        linear,
        left top,
        left bottom,
        color-stop(0, <?php echo Salamander::getData( 'button_gradient_bottom_color' ); ?>),
        color-stop(1, <?php echo Salamander::getData( 'button_gradient_top_color' ); ?>)
    );
    border:1px solid <?php echo Salamander::getData( 'button_gradient_bottom_color' ); ?>;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo Salamander::getData( 'button_gradient_bottom_color' ); ?>', endColorstr='<?php echo Salamander::getData( 'button_gradient_top_color' ); ?>');
}
.no-cssgradients #content .reading-box .button:hover,
.no-cssgradients #content .continue.button:hover,
.no-cssgradients #content .portfolio-one .button:hover,
.no-cssgradients #content .comment-submit:hover,
.no-cssgradients .button.default{
    background:<?php echo Salamander::getData( 'button_gradient_bottom_color' ); ?>;
}
<?php endif; ?>
<?php if ( Salamander::getData( 'form_bg_color' ) ): ?>
input#s,
#comment-input input,
#comment-textarea textarea {
    background-color:<?php echo Salamander::getData( 'form_bg_color' ); ?> !important;
}
<?php endif; ?>
<?php if ( Salamander::getData( 'form_text_color' ) ): ?>
input#s,
input#s,
.placeholder,
#comment-input input,
#comment-textarea textarea,
#comment-input .placeholder,
#comment-textarea .placeholder {
    color:<?php echo Salamander::getData( 'form_text_color' ); ?> !important;
}
input#s::webkit-input-placeholder,
#comment-input input::-webkit-input-placeholder,
#comment-textarea textarea::-webkit-input-placeholder {
    color:<?php echo Salamander::getData( 'form_text_color' ); ?> !important;
}
input#s:moz-placeholder,
#comment-input input:-moz-placeholder,
#comment-textarea textarea:-moz-placeholder {
    color:<?php echo Salamander::getData( 'form_text_color' ); ?> !important;
}
input#s:-ms-input-placeholder,
#comment-input input:-ms-input-placeholder,
#comment-textarea textarea:-moz-placeholder {
    color:<?php echo Salamander::getData( 'form_text_color' ); ?> !important;
}
<?php endif; ?>
<?php if( Salamander::getDtata( 'form_border_color' ) ): ?>
input#s,
#comment-input input,
#comment-textarea textarea {
    border-color:<?php echo  Salamander::getDtata( 'form_border_color' ) ; ?> !important;
}
<?php endif; ?>
<?php if(Salamander::getData( 'timeline_color' )): ?>
.grid-layout .post .flexslider,
.timeline-layout .post,
.timeline-layout .post .content-sep,
.timeline-layout .post .flexslider,
h3.timeline-title,
.grid-layout .post,
.grid-layout .post .content-sep {
    border-color:<?php echo Salamander::getData( 'timeline_color' ); ?> !important;
}
.align-left .timeline-arrow:before,
.align-left .timeline-arrow:after {
    border-left-color:<?php echo Salamander::getData( 'timeline_color' ); ?> !important;
}
.align-right .timeline-arrow:before,
.align-right .timeline-arrow:after {
    border-right-color:<?php echo Salamander::getData( 'timeline_color' ); ?> !important;
}
.timeline-circle,
.timeline-title {
    background-color:<?php echo Salamander::getData( 'timeline_color' ); ?> !important;
}
.timeline-icon {
    color:<?php echo Salamander::getData( 'timeline_color' ); ?>;
}
<?php endif; ?>

<?php if ( Salamander::getData( 'button_text_shadow' )): ?>
.button {
    text-shadow:none !important;
}
<?php endif; ?>
<?php if ( Salamander::getData( 'footer_text_shadow' ) ): ?>
#footer a,
.copyright {
    text-shadow:none !important;
}
<?php endif; ?>
<?php if ( Salamander::getData( 'tagline_font_color' ) ): ?>
header .tagline {
  color:<?php echo Salamander::getData( 'tagline_font_color' ); ?> !important;
}
<?php endif; ?>
<?php if ( Salamander::getData( 'page_title_color' ) ): ?>
.page-title h1 {
  color:<?php echo Salamander::getData( 'page_title_color' ); ?> !important;
}
<?php endif; ?>
<?php if ( Salamander::getData( 'h1_color' ) ): ?>
.post-content h1,.title h1{
  color:<?php echo Salamander::getData( 'h1_color' ); ?> !important;
}
<?php endif; ?>

<?php if(Salamander::getData( 'h2_color' )): ?>
.post-content h2,.title h2{
  color:<?php echo Salamander::getData( 'h2_color' ); ?> !important;
}
<?php endif; ?>

<?php if(Salamander::getData( 'h3_color' )): ?>
.post-content h3,#sidebar .widget h3,.project-content h3,.title h3,#header .tagline,.person-author-wrapper span{
  color:<?php echo Salamander::getData( 'h3_color' ); ?> !important;
}
<?php endif; ?>

<?php if(Salamander::getData( 'h4_color' )): ?>
.post-content h4,.project-content .project-info h4,.share-box h4,.title h4{
  color:<?php echo Salamander::getData( 'h4_color' ); ?> !important;
}
<?php endif; ?>

<?php if(Salamander::getData( 'h5_color' )): ?>
.post-content h5,h5.toggle a,.title h5{
  color:<?php echo Salamander::getData( 'h5_color' ); ?> !important;
}
<?php endif; ?>

<?php if(Salamander::getData( 'h6_color' )): ?>
.post-content h6,.title h6{
  color:<?php echo Salamander::getData( 'h6_color' ); ?> !important;
}
<?php endif; ?>
<?php if(Salamander::getData( 'body_text_color' ) ): ?>
body,
.post .post-content,
.post-content blockquote,
.tab-holder .news-list li .post-holder .meta,
#left-sidebar #jtwt,
#right-sidebar #jtwt,
.meta,
.review blockquote div,
.search input,
.project-content .project-info h4,
.title-row {
  color:<?php echo Salamander::getData( 'body_text_color' ); ?> !important;
}
<?php endif; ?>
<?php if(Salamander::getData( 'link_color' ) ): ?>
body a,
.project-content .project-info .project-info-box a,
#left-sidebar .widget li a,
#right-sidebar .widget li a,
#left-sidebar .widget .recentcomments,
#right-sidebar .widget .recentcomments,
#left-sidebar .widget_categories li,
#right-sidebar .widget_categories li,
#content .post h2 a {
    color:<?php echo Salamander::getData( 'link_color' ); ?> !important;
}
<?php endif; ?>
<?php if(Salamander::getData( 'breadcrumbs_text_color' )): ?>
.page-title ul li,
.page-title ul li a {
    color:<?php echo Salamander::getData( 'breadcrumbs_text_color' ); ?> !important;}
}
<?php endif; ?>

<?php if(Salamander::getData( 'footer_headings_color' )): ?>
#footer h3 {
  color:<?php echo Salamander::getData( 'footer_headings_color' ); ?> !important;
<?php endif; ?>

<?php if(Salamander::getData( 'footer_text_color' )): ?>
#footer,
#footer #jtwt,
.copyright {
    color:<?php echo Salamander::getData( 'footer_text_color' ); ?> !important;
}
<?php endif; ?>

<?php if(Salamander::getData( 'footer_link_color' )): ?>
#footer a,
.copyright a {
    color:<?php echo Salamander::getData( 'footer_link_color' ); ?> !important;
}
<?php endif; ?>
<?php if(Salamander::getData( 'menu_first_color' )): ?>
#nav ul a,.side-nav li a{color:<?php echo Salamander::getData( 'menu_first_color' ); ?> !important;}
<?php endif; ?>

<?php if(Salamander::getData( 'menu_sub_bg_color' )): ?>
#nav ul ul{background-color:<?php echo Salamander::getData( 'menu_sub_bg_color' ); ?>;}
<?php endif; ?>

<?php if(Salamander::getData( 'menu_sub_color' )): ?>
#wrapper #nav ul li ul li a,.side-nav li li a,.side-nav li.current_page_item li a{color:<?php echo Salamander::getData( 'menu_sub_color' ); ?> !important;}
<?php endif; ?>
<?php if(Salamander::getData( 'menu_sub_sep_color' )): ?>
#wrapper #nav ul li ul li a{border-bottom:1px solid <?php echo Salamander::getData( 'menu_sub_sep_color' ); ?> !important;}
<?php endif; ?>

<?php if(Salamander::getData( 'menu_bg_hover_color' )): ?>
#wrapper #nav ul li ul li a:hover, #wrapper #nav ul li ul li.current-menu-item a{background-color:<?php echo Salamander::getData( 'menu_bg_hover_color' ); ?> !important;}
<?php endif; ?>

<?php if(Salamander::getData( 'snav_color' )): ?>
#wrapper .header-social *{color:<?php echo Salamander::getData( 'snav_color' ); ?> !important;}
<?php endif; ?>
<?php if(Salamander::getData( 'header_top_first_border_color' )): ?>
#wrapper .header-social .menu > li{
  border-color:<?php echo Salamander::getData( 'header_top_first_border_color' ); ?> !important;
}
<?php endif; ?>

<?php if(Salamander::getData( 'header_top_sub_bg_color' )): ?>
#wrapper .header-social .menu .sub-menu{
  background-color:<?php echo Salamander::getData( 'header_top_sub_bg_color' ); ?> !important;
}
<?php endif; ?>

<?php if(Salamander::getData( 'header_top_menu_sub_color' )): ?>
#wrapper .header-social .menu .sub-menu li, #wrapper .header-social .menu .sub-menu li a{
  color:<?php echo Salamander::getData( 'header_top_menu_sub_color' ); ?> !important;
}
<?php endif; ?>

<?php if(Salamander::getData( 'header_top_menu_bg_hover_color' )): ?>
#wrapper .header-social .menu .sub-menu li a:hover{
  background-color:<?php echo Salamander::getData( 'header_top_menu_bg_hover_color' ); ?> !important;
}
<?php endif; ?>

<?php if(Salamander::getData( 'header_top_menu_sub_hover_color' )): ?>
#wrapper .header-social .menu .sub-menu li a:hover{
  color:<?php echo Salamander::getData( 'header_top_menu_sub_hover_color' ); ?> !important;
}
<?php endif; ?>

<?php if(Salamander::getData( 'header_top_menu_sub_sep_color' )): ?>
#wrapper .header-social .menu .sub-menu,#wrapper .header-social .menu .sub-menu li{
  border-color:<?php echo Salamander::getData( 'header_top_menu_sub_sep_color' ); ?> !important;
}
<?php endif; ?>


/*** ! Styling options ***/

<?php if(Salamander::getData( 'layout' )  == 'boxed'): ?>
body{
  <?php if(get_post_meta($c_pageID, 'pyre_page_bg_color', true)): ?>
    background-color:<?php echo get_post_meta($c_pageID, 'sl_meta_page_bg_color', true); ?>;
  <?php else: ?>
    background-color:<?php echo Salamander::getData( 'bg_color' ) ;  ?>;
  <?php endif; ?>
  <?php if(get_post_meta($c_pageID, 'sl_meta_page_bg', true)): ?>
    background-image:url(<?php echo get_post_meta($c_pageID, 'sl_meta_page_bg', true); ?>);
    background-repeat:<?php echo get_post_meta($c_pageID, 'sl_meta_page_bg_repeat', true); ?>;
    <?php if(get_post_meta($c_pageID, 'sl_meta_page_bg_full', true) == 'yes'): ?>
    background-attachment:fixed;
    background-position:center center;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    <?php endif; ?>
  <?php elseif(Salamander::getData( 'bg_image' ) ) : ?>
    background-image:url(<?php echo Salamander::getData( 'bg_image' ) ;  ?>);
    background-repeat:<?php echo Salamander::getData( 'bg_repeat' ) ;  ?>;
    <?php if(Salamander::getData( 'bg_full' ) ) : ?>
    background-attachment:fixed;
    background-position:center center;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    <?php endif; ?>
  <?php endif; ?>

  <?php if(Salamander::getData( 'bg_pattern_option' )   && Salamander::getData( 'bg_pattern' )   && !(get_post_meta($c_pageID, 'sl_meta_page_bg_color', true) || get_post_meta($c_pageID, 'sl_meta_page_bg', true))): ?>
    background-image:url("<?php echo get_bloginfo('template_directory') . '/images/patterns/' . Salamander::getData( 'bg_pattern' )   . '.png'; ?>");
    background-repeat:repeat;
<?php endif; ?>
}
<?php endif; ?>

<?php if ( Salamander::getData( 'fixed_menu' ) ) : ?>
body {
    min-height: 2000px;
    padding-top: 70px;
}
<?php endif; ?>
<?php if ( Salamander::getData( 'nav_height' ) ) : ?>
#nav > ul > li > a,
#nav > ul > li.current-menu-ancestor > a {
    height:<?php echo Salamander::getData( 'nav_height' ); ?>px;
    line-height:<?php echo Salamander::getData( 'nav_height' ); ?>px;
}
#nav ul {
    top:<?php echo Salamander::getData( 'nav_height' )+3; ?>px;
}

    /* Preview CSS for DEMO
<?php if(is_page('header-4') || is_page('header-5')) : ?>
#nav > li > a,#nav li.current-menu-ancestor a{height:40px;line-height:40px;}
#nav > li > a,#nav li.current-menu-ancestor a{height:40px;line-height:40px;}
#nav ul ul{top:43px;}
<?php endif; ?>
    */
<?php endif; ?>
#nav.nav-center {
    margin: 0 auto;
    width: 970px;
}
#content{
  <?php if ( get_post_meta($c_pageID, 'sl_meta_page_bg_color', true) ) : ?>
    background-image:url(<?php echo get_post_meta($c_pageID, 'sl_meta_page_bg_color', true); ?>);
    background-repeat:<?php echo get_post_meta($c_pageID, 'sl_meta_page_bg_repeat', true) ; ?>;
  <?php else: ?>
    background-image:url(<?php echo Salamander::getData( 'content_bg_image' ) ; ?>);
    background-repeat:<?php echo Salamander::getData( 'content_bg_repeat' ) ; ?>;
  <?php endif; ?>
  <?php if(Salamander::getData( 'content_bg_full' ) ): ?>
    background-attachment:fixed;
    background-position:center center;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  <?php endif; ?>
}
<?php if ( Salamander::getData( 'header_bg_image' ) ) : ?>
header {
    background-image:url(<?php echo Salamander::getData( 'header_bg_image' ); ?>);
    background-repeat:<?php echo Salamander::getData( 'header_bg_repeat' ); ?>;
  <?php if( Salamander::getData( 'header_bg_full' ) ) : ?>
    background-attachment:fixed;
    background-position:center center;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  <?php endif; ?>
}
.navbar-default {
    background: none;
}
<?php endif; ?>

<?php if ( get_post_meta($c_pageID, 'sl_mets_page_title_bar_bg', true ) ) : ?>
    .page-title-container{
      background-image:url(<?php echo get_post_meta($c_pageID, 'sl_mets_page_title_bar_bg', true ); ?>) !important;
    }
<?php elseif ( Salamander::getData( 'page_title_bg' ) ) : ?>
    .page-title-container {
      background-image:url(<?php echo Salamander::getData( 'page_title_bg' ); ?>) !important;
    }
<?php endif; ?>
<?php if(get_post_meta($c_pageID, 'sl_meta_page_title_bar_bg_retina', true)): ?>
    @media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {
        .page-title-container {
            background-image: url(<?php echo get_post_meta($c_pageID, 'sl_meta_page_title_bar_bg_retina', true); ?>) !important;
            -webkit-background-size:cover;
            -moz-background-size:cover;
            -o-background-size:cover;
            background-size:cover;
        }
    }
<?php elseif( Salamander::getData( 'page_title_bg_retina' ) ) : ?>
    @media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {
        .page-title-container {
            background-image: url(<?php echo Salamander::getData( 'page_title_bg_retina' ); ?>) !important;
            -webkit-background-size:cover;
            -moz-background-size:cover;
            -o-background-size:cover;
            background-size:cover;
        }
    }
<?php endif; ?>
<?php if ( Salamander::getData( 'page_title_height') ): ?>
    .page-title-container {
        height:<?php echo Salamander::getData( 'page_title_height' ); ?> !important;
    }
<?php endif; ?>
<?php if ( get_post_meta( $c_pageID, 'sl_meta_page_title_bar_bg', true ) ) : ?>
    .page-title-container{
        background-image:url(<?php echo get_post_meta($c_pageID, 'sl_meta_page_title_bar_bg', true); ?>) !important;
    }
<?php elseif ( Salamander::getData( 'page_title_bg' ) ) : ?>
    .page-title-container{
        background-image:url(<?php echo Salamander::getData( 'page_title_bg' ); ?>) !important;
    }
<?php endif; ?>
<?php if ( get_post_meta($c_pageID, 'sl_meta_page_title_bar_bg_color', true ) ) : ?>
    .page-title-container{
        background-color:<?php echo get_post_meta( $c_pageID, 'sl_meta_page_title_bar_bg_color', true ); ?>;
    }
<?php elseif ( Salamander::getData( 'page_title_bg_color' ) ): ?>
    .page-title-container{
        background-color:<?php echo Salamander::getData( 'page_title_bg_color' ); ?>;
    }
<?php endif; ?>
<?php if ( Salamander::getData( 'page_title_border_color' ) ) : ?>
    .page-title-container {
        border-color:<?php echo Salamander::getData( 'page_title_border_color' ); ?> !important;
    }
<?php endif; ?>

    .logo {
        margin-right: <?php echo Salamander::getData( 'margin_right_logo' ); ?>;
        margin-top: <?php echo Salamander::getData( 'margin_top_logo' ); ?>;
        margin-left: <?php echo Salamander::getData( 'margin_left_logo' ); ?>;
        margin-bottom: <?php echo Salamander::getData( 'margin_bottom_logo' ); ?>;
    }
</style>

<style type="text/css">
  <?php print Salamander::getData('custom_css'); ?>
</style>
<style type="text/css" id="ss"></style>
<link rel="stylesheet" id="style_selector_ss" href="#" />