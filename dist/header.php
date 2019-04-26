<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta http-equiv="cache-control" content="public">
  <meta http-equiv="cache-control" content="private">

  <title><?php echo esc_html(bloginfo('name')); ?></title>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header id="header">
    <div id="masthead">
      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <div class="left-masthead d-flex justify-content-start">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/veteran-owned.png" class="img-fluid align-self-start" alt="Veteran Owned" />
            <div class="em-service align-self-center d-none d-lg-block">
              <h2>24/7<span>Emergency<br />Service</span></h2>
            </div>
          </div>
          <div class="right-masthead ml-auto d-none d-lg-block">
            <p>Call Us Today to Resolve Your Plumbing Problem Quickly</p>
            <?php
              $phone = get_option('options_phone');
            ?>
            <a href="tel:<?php echo esc_html($phone); ?>"><?php echo esc_html($phone); ?></a>
          </div>
        </div>
      </div>
    </div>
    <div class="logo-pipe">
      <a href="<?php echo esc_url(home_url('home')); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" class="d-block mx-auto" alt="Professional Plumbing Services Inc Logo" /></a>
    </div>
    <nav id="header-nav" class="navbar navbar-expand-md">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-navbar" aria-controls="header-navbar" aria-expanded="false" aria-label="Toggle Navigation">
        <i class="fas fa-bars"></i>
      </button>
      <?php 
        $header_nav_args = array(
          'theme_location' => 'header-nav',
          'menu' => '',
          'container' => 'div',
          'container_id' => 'navbar',
          'container_class' => 'collapse navbar-collapse justify-content-md-center',
          'menu_id' => '',
          'menu_class' => 'navbar-nav',
          'echo' => true,
          'fallback_cb' => 'proplumbing_header_fallback_menu',
          'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
          'depth' => 2,
          'walker' => new WP_Bootstrap_Navwalker()
        );
        wp_nav_menu($header_nav_args);
      ?>
    </nav>
    <div class="header-arch"></div>
  </header>

  <section id="hero" class="hp-hero d-flex flex-column justify-content-center" style="background-image:url(../dist/images/van-truck.jpg); background-position:center center;">
    <div class="container">
      <div class="hero-caption d-flex flex-wrap text-center justify-content-center align-items-center">
        <h1>Reliable Plumbing Repair in Fredericksburg and King George, VA</h1>
        <p>Professional Plumbing Solutions Inc. is a Virginia-based company that offers over 30 years of experience to resolve your drain cleaning and plumbing problems.</p>
        <div class="mt-5">
          <a href="#" class="btn-main">Contact Us</a>
          <a href="#" class="btn-main">Services</a>
        </div>
      </div>
    </div>
    <div class="dark-overlay"></div>
    <a href="#" class="btn-hero-chat">
      <!--<img src="../dist/images/chat-icon.png" alt="Contact Us" />-->
      <i class="fas fa-comment fa-2x fa-border"></i>
    </a>
    <div class="hero-bottom-arch"></div>
  </section>
