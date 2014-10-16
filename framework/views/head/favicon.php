    <?php if (Salamander::getData('favicon')): ?>
    <link rel="shortcut icon" href="<?php print Salamander::getData('favicon'); ?>" type="image/x-icon" />
    <?php endif; ?>

    <?php if (Salamander::getData('iphone_icon')): ?>
    <!-- For iPhone -->
    <link rel="apple-touch-icon-precomposed" href="<?php print Salamander::getData('iphone_icon'); ?>">
    <?php endif; ?>

    <?php if (Salamander::getData('iphone_icon_retina')): ?>
    <!-- For iPhone 4 Retina display -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php print Salamander::getData('iphone_icon_retina'); ?>">
    <?php endif; ?>

    <?php if (Salamander::getData('ipad_icon')): ?>
    <!-- For iPad -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php print Salamander::getData('ipad_icon'); ?>">
    <?php endif; ?>

    <?php if (Salamander::getData('ipad_icon_retina')): ?>
    <!-- For iPad Retina display -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php print Salamander::getData('ipad_icon_retina'); ?>">
    <?php endif; ?>

<!--    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">-->
<!--    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">-->
<!--    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">-->
<!--    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">-->
<!--    <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">-->
<!--    <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">-->
<!--    <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">-->
<!--    <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">-->
<!--    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">-->
<!--    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">-->
<!--    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">-->
<!--    <meta name="msapplication-TileColor" content="#da532c">-->
<!--    <meta name="msapplication-TileImage" content="/mstile-144x144.png">-->