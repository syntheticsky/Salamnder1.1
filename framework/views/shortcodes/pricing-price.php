<li class="pricing-row">
<?php if(!empty($params['currency']) && !empty($params['price'])): ?>
  <div class="price <?php echo $class; ?>">
    <strong><?php echo $currency; ?></strong>
    <em class="exact_price"><?php echo $price[0]; ?></em>
  <?php if($price[1]): ?>
    <sup><?php echo $price[1]; ?></sup>
  <?php endif; ?>
  <?php if($time): ?>
    <em class="time"><?php echo $time; ?></em>
  <?php endif; ?>
  </div>
<?php else: ?>
  <?php echo $content; ?>
<?php endif; ?>
</li>
