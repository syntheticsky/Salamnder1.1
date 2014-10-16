<?php

class RecentWorksWidget extends WP_Widget {

  public function __construct()
  {
    $widget_ops = array('classname' => 'recent-works', 'description' => __('Recent works from the portfolio.', 'salamander'));
    $control_ops = array('id_base' => 'recent-works-widget');
    $this->WP_Widget('recent-works-widget', 'Salamander: Recent Works', $widget_ops, $control_ops);
  }

  public function widget($args, $instance)
  {
    extract($args);
    $title = apply_filters('widget_title', $instance['title']);
    $number = $instance['number'];

    echo $before_widget;

    if($title) {
      echo $before_title . $title . $after_title;
    }
    ?>
    <div class="recent-works-items clearfix">
      <?php
      $args = array(
        'post_type' => 'salamander_portfolio',
        'posts_per_page' => $number
      );
      $portfolio = new WP_Query($args);
      if($portfolio->have_posts()):
        ?>
        <?php while($portfolio->have_posts()): $portfolio->the_post(); ?>
        <?php if(has_post_thumbnail()): ?>
          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php the_post_thumbnail('recent-works-thumbnail'); ?>
          </a>
        <?php endif; endwhile; endif; ?>
    </div>

    <?php echo $after_widget;
  }

  public function update($new_instance, $old_instance)
  {
    $instance = $old_instance;

    $instance['title'] = strip_tags($new_instance['title']);
    $instance['number'] = $new_instance['number'];

    return $instance;
  }

  public function form($instance)
  {
    $defaults = array(
      'title' => __('Recent Works', 'salamander'),
      'number' => 6,
    );
    $instance = wp_parse_args((array) $instance, $defaults); ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
      <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('number'); ?>">Number of items to show:</label>
      <input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" />
    </p>
  <?php
  }
}