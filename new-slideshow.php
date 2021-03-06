  <?php if(Salamander::getData('blog_layout') != 'Grid' && Salamander::getData('blog_layout') != 'Timeline'): ?>
    <style type="text/css">
    <?php if(get_post_meta($post->ID, 'sl_meta_fimg_width', true) && get_post_meta($post->ID, 'sl_meta_fimg_width', true) != 'auto'): ?>
    #post-<?php echo $post->ID; ?> .post-slideshow,
    #post-<?php echo $post->ID; ?> .floated-post-slideshow,
    #post-<?php echo $post->ID; ?> .post-slideshow .image > img,
    #post-<?php echo $post->ID; ?> .floated-post-slideshow .image > img,
    #post-<?php echo $post->ID; ?> .post-slideshow .image > a > img,
    #post-<?php echo $post->ID; ?> .floated-post-slideshow .image > a > img
    {width:<?php echo get_post_meta($post->ID, 'sl_meta_fimg_width', true); ?> !important;}
    <?php endif; ?>

    <?php if(get_post_meta($post->ID, 'sl_meta_fimg_height', true) && get_post_meta($post->ID, 'sl_meta_fimg_height', true) != 'auto'): ?>
    #post-<?php echo $post->ID; ?> .post-slideshow,
    #post-<?php echo $post->ID; ?> .floated-post-slideshow,
    #post-<?php echo $post->ID; ?> .post-slideshow .image > img,
    #post-<?php echo $post->ID; ?> .floated-post-slideshow .image > img,
    #post-<?php echo $post->ID; ?> .post-slideshow .image > a > img,
    #post-<?php echo $post->ID; ?> .floated-post-slideshow .image > a > img
    {height:<?php echo get_post_meta($post->ID, 'sl_meta_fimg_height', true); ?> !important;}
    <?php endif; ?>

    <?php if(
      get_post_meta($post->ID, 'sl_meta_fimg_height', true) && get_post_meta($post->ID, 'sl_meta_fimg_width', true) &&
      get_post_meta($post->ID, 'sl_meta_fimg_height', true) != 'auto' && get_post_meta($post->ID, 'sl_meta_fimg_width', true) != 'auto'
    ) : ?>
    @media only screen and (max-width: 479px){
      #post-<?php echo $post->ID; ?> .post-slideshow,
      #post-<?php echo $post->ID; ?> .floated-post-slideshow,
      #post-<?php echo $post->ID; ?> .post-slideshow .image > img,
      #post-<?php echo $post->ID; ?> .floated-post-slideshow .image > img,
      #post-<?php echo $post->ID; ?> .post-slideshow .image > a > img,
      #post-<?php echo $post->ID; ?> .floated-post-slideshow .image > a > img{
        width:auto !important;
        height:auto !important;
      }
    }
    <?php endif; ?>
    </style>
    <?php endif; ?>

    <?php
    if(get_post_meta($post->ID, 'sl_meta_image_rollover_icons', true) == 'link') {
      $link_icon_css = '';
      $zoom_icon_css = 'display:none;';
    } elseif(get_post_meta($post->ID, 'sl_meta_image_rollover_icons', true) == 'zoom') {
      $link_icon_css = 'display:none;';
      $zoom_icon_css = '';
    } elseif(get_post_meta($post->ID, 'sl_meta_image_rollover_icons', true) == 'no') {
      $link_icon_css = 'display:none;';
      $zoom_icon_css = 'display:none;';
    } else {
      $link_icon_css = '';
      $zoom_icon_css = '';
    }

    $icon_url_check = get_post_meta(get_the_ID(), 'sl_meta_link_icon_url', true); if(!empty($icon_url_check)) {
      $permalink = get_post_meta($post->ID, 'sl_meta_link_icon_url', true);
    } else {
      $permalink = get_permalink($post->ID);
    }
    ?>

    <?php
    if(Salamander::getData('blog_full_width')) {
      $size = 'full';
    } else {
      $size = 'blog-large';
    }

    if(Salamander::getData('blog_layout') == 'Medium' || Salamander::getData('blog_layout') == 'Medium Alternate') {
      $size = 'blog-medium';
    }

    if(
      get_post_meta($post->ID, 'sl_meta_fimg_height', true) && get_post_meta($post->ID, 'sl_meta_fimg_width', true) &&
      get_post_meta($post->ID, 'sl_meta_fimg_height', true) != 'auto' && get_post_meta($post->ID, 'sl_meta_fimg_width', true) != 'auto'
    ) {
      $size = 'full';
    }

    if(Salamander::getData('blog_layout') == 'Grid' || Salamander::getData('blog_layout') == 'Timeline') {
      $size = 'full';
    }
    ?>

    <?php if(Salamander::getData('blog_layout') == 'large' || Salamander::getData('blog_layout') == 'Large Alternate' || Salamander::getData('blog_layout') == 'Grid' || Salamander::getData('blog_layout') == 'Timeline'): ?>
    <?php
    if(has_post_thumbnail() ||
    get_post_meta(get_the_ID(), 'sl_meta_video', true)
    ):
    ?>
    <div class="flexslider post-slideshow">
      <ul class="slides">
        <?php if(get_post_meta(get_the_ID(), 'sl_meta_video', true)): ?>
        <li class="full-video">
          <?php echo get_post_meta(get_the_ID(), 'sl_meta_video', true); ?>
        </li>
        <?php endif; ?>
        <?php if(has_post_thumbnail()): ?>
        <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
        <?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
        <li>
          <div class="image">
              <?php if(Salamander::getData('image_rollover')): ?>
              <?php the_post_thumbnail($size); ?>
              <?php else: ?>
              <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($size); ?></a>
              <?php endif; ?>
              <div class="image-extras">
                <div class="image-extras-content">
                  <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                  <a style="<?php echo $link_icon_css; ?>" class="icon link-icon" href="<?php echo $permalink; ?>">Permalink</a>
                  <?php
                  if(get_post_meta($post->ID, 'sl_meta_video_url', true)) {
                    $full_image[0] = get_post_meta($post->ID, 'sl_meta_video_url', true);
                  }
                  ?>
                  <a style="<?php echo $zoom_icon_css; ?>" class="icon gallery-icon" href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php echo $post->ID; ?>]" title="<?php echo get_post_field('post_content', get_post_thumbnail_id()); ?>"><img style="display:none;" alt="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>" />Gallery</a>
                  <h3><?php the_title(); ?></h3>
                </div>
              </div>
          </div>
        </li>
        <?php endif; ?>
        <?php if(Salamander::getData('posts_slideshow')): ?>
        <?php
        $i = 2;
        while($i <= Salamander::getData('posts_slideshow_number')):
        $attachment_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post');
        if($attachment_id):
        ?>
        <?php $attachment_image = wp_get_attachment_image_src($attachment_id, $size); ?>
        <?php $full_image = wp_get_attachment_image_src($attachment_id, 'full'); ?>
        <?php $attachment_data = wp_get_attachment_metadata($attachment_id); ?>
        <li>
          <div class="image">
              <a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo $attachment_data['image_meta']['title']; ?>" /></a>
              <a style="display:none;" href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php echo $post->ID; ?>]" alt="<?php echo get_post_field('post_excerpt', $attachment_id); ?>" title="<?php echo get_post_field('post_content', $attachment_id); ?>"><img style="display:none;" alt="<?php echo get_post_field('post_excerpt', $attachment_id); ?>" /></a>
          </div>
        </li>
        <?php endif; $i++; endwhile; ?>
        <?php endif; ?>
      </ul>
    </div>
    <?php endif; ?>
    <?php endif; ?>

    <?php if(Salamander::getData('blog_layout') == 'Medium' || Salamander::getData('blog_layout') == 'Medium Alternate'): ?>
    <?php
    if(has_post_thumbnail() ||
    get_post_meta(get_the_ID(), 'sl_meta_video', true)
    ):
    ?>
    <div class="flexslider blog-medium-image floated-post-slideshow">
      <ul class="slides">
        <?php if(get_post_meta(get_the_ID(), 'sl_meta_video', true)): ?>
        <li class="full-video">
          <?php echo get_post_meta(get_the_ID(), 'sl_meta_video', true); ?>
        </li>
        <?php endif; ?>
        <?php if(has_post_thumbnail()): ?>
        <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
        <?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
        <li>
          <div class="image">
              <?php if(Salamander::getData('image_rollover')): ?>
              <?php the_post_thumbnail($size); ?>
              <?php else: ?>
              <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($size); ?></a>
              <?php endif; ?>
              <div class="image-extras">
                <div class="image-extras-content">
                  <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                  <a style="<?php echo $link_icon_css; ?>" class="icon link-icon" href="<?php echo $permalink; ?>">Permalink</a>
                  <?php
                  if(get_post_meta($post->ID, 'sl_meta_video_url', true)) {
                    $full_image[0] = get_post_meta($post->ID, 'sl_meta_video_url', true);
                  }
                  ?>
                  <a style="<?php echo $zoom_icon_css; ?>" class="icon gallery-icon" href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php echo $post->ID; ?>]" title="<?php echo get_post_field('post_content', get_post_thumbnail_id()); ?>"><img style="display:none;" alt="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>" />Gallery</a>
                  <h3><?php the_title(); ?></h3>
                </div>
              </div>
          </div>
        </li>
        <?php endif; ?>
        <?php if(Salamander::getData('posts_slideshow')): ?>
        <?php
        $i = 2;
        while($i <= Salamander::getData('posts_slideshow_number')):
        $new_attachment_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post');
        if($new_attachment_id):
        ?>
        <?php $attachment_image = wp_get_attachment_image_src($new_attachment_id, 'blog-medium'); ?>
        <?php $full_image = wp_get_attachment_image_src($new_attachment_id, 'full'); ?>
        <?php $attachment_data = wp_get_attachment_metadata($new_attachment_id); ?>
        <li>
          <div class="image">
              <a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo $attachment_data['image_meta']['title']; ?>" /></a>
              <a style="display:none;" href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php echo $post->ID; ?>]" alt="<?php echo get_post_field('post_excerpt', $new_attachment_id); ?>" title="<?php echo get_post_field('post_content', $new_attachment_id); ?>"><img style="display:none;" alt="<?php echo get_post_field('post_excerpt', $new_attachment_id); ?>" /></a>
          </div>
        </li>
        <?php endif; $i++; endwhile; ?>
        <?php endif; ?>
      </ul>
    </div>
    <?php endif; ?>
  <?php endif; ?>