<?php
/**
 * Header
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> dir="ltr">
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <?php get_template_part('parts/seo'); ?>

  <meta name="robots" content="noodp" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" type="text/css" media="all"
        href="<?php bloginfo('stylesheet_url'); echo '?' . filemtime(get_stylesheet_directory() . '/style.css'); ?>" />
        

<!-- FAVICONS -->
<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<meta name="theme-color" content="#ffffff">
    
<!-- Google Consent Mode v2 -->
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('consent', 'default', {
    'ad_storage': 'denied',
    'ad_user_data': 'denied',
    'ad_personalization': 'denied',
    'analytics_storage': 'denied',
    'wait_for_update': 500
  });
</script>
<!-- End Google Consent Mode v2 -->

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> ontouchstart="">
<div id="top"></div>

<div id="outer">

  <header id="header" class="bgwhite">

    <div id="masternav" class="postinfo">
      <?php wp_nav_menu(array('theme_location' => 'menu_master')); ?>
    </div>

    <div class="outer">
      <div class="wrap wide">

        <div class="col-xs-9 col-s-10 col-sm-8 col-m-3 col-ml-3 col-l-3 col-xl-3">
          <div id="logo">
  <div class="logo-title">
    <a rel="home" href="<?php echo esc_url(home_url('/')); ?>">
      <?php the_field('kontakt_name', 'options'); ?>
    </a>
  </div>
</div>

        </div>

        <div class="col-xs-0 col-s-0 col-sm-0 col-m-9 col-ml-9 col-l-9 col-xl-9">
          <nav id="nav">
            <?php wp_nav_menu(array('theme_location' => 'menu_main')); ?>
          </nav>
        </div>

      </div>
    </div>

  </header>

  <div id="headerpadding"></div>

  <?php if (get_field('info_show', 'option')) {
    get_template_part('parts/infobar');
  } ?>