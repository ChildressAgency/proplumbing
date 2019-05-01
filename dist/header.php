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
    <div class="header-arch">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/header-arch.png" alt="" />
    </div>
  </header>

  <?php 
    $page_id = get_the_ID();
    $hero_img = get_stylesheet_directory_uri() . '/images/wrench-pipe-fitting.jpg';
    $hero_img_css = 'background-position:center center;';
    
    $hero_img_id = get_post_meta($page_id, 'hero_background_image', true);
    if($hero_img_id){
      $hero_img_array = wp_get_attachment_image_src($hero_img_id, 'full');
      $hero_img = $hero_img_array[0];
      $hero_img_css = get_post_meta($page_id, 'hero_background_image_css', true);
    }
  ?>
  <section id="hero" class="<?php if(is_front_page()){ echo 'hp-hero '; } ?>d-flex flex-column justify-content-center" style="background-image:url(<?php echo esc_url($hero_img); ?>); <?php echo esc_attr($hero_img_css); ?>">
    <div class="container">
      <div class="hero-caption d-flex flex-column flex-wrap text-center justify-content-center align-items-center">
        <?php
          if(is_singular('service')){
            $service_icon_type = get_post_meta($page_id, 'service_icon_file_type', true);
            if($service_icon_type == 'SVG'){
              $service_img = proplumbing_esc_svg(get_post_meta($page_id, 'service_icon', true));
              echo $service_img;
            }
            else{
              $service_icon_id = get_post_meta($page_id, 'service_icon', true);
              $service_img_array = wp_get_attachment_image_src($service_icon_id, 'full');
              $service_img = $service_img_array[0];
              echo '<img src="' . esc_url($service_img) . '" class="service-icon img-fluid d-block mx-auto" alt="" />';
            }

          }
          echo apply_filters('the_content', wp_kses_post(get_post_meta($page_id, 'hero_content', true)));
        ?>
      </div>
    </div>
    <div class="dark-overlay"></div>
    <?php if(get_option('options_show_chat_button') == true): ?>
      <a href="<?php echo esc_url(get_option('options_chat_button_link')); ?>" class="btn-hero-chat">
        <i class="fas fa-comment fa-2x fa-border"></i>
      </a>
        <?php endif; ?>
    <div class="hero-bottom-arch">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero-bottom-arch.png" alt="" />
    </div>
  </section>
