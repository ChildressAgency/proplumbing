<?php
add_action('wp_footer', 'show_template');
function show_template() {
	global $template;
	print_r($template);
}

add_action('wp_enqueue_scripts', 'jquery_cdn');
function jquery_cdn(){
  if(!is_admin()){
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', false, null, true);
    wp_enqueue_script('jquery');
  }
}

add_action('wp_enqueue_scripts', 'proplumbing_scripts');
function proplumbing_scripts(){
  wp_register_script(
    'bootstrap-popper',
    'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',
    array('jquery'),
    '',
    true
  );

  wp_register_script(
    'bootstrap-scripts',
    'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js',
    array('jquery', 'bootstrap-popper'),
    '',
    true
  );

  wp_register_script(
    'proplumbing-scripts',
    get_stylesheet_directory_uri() . '/js/custom-scripts.min.js',
    array('jquery', 'bootstrap-scripts'),
    '',
    true
  );

  wp_enqueue_script('bootstrap-popper');
  wp_enqueue_script('bootstrap-scripts');
  wp_enqueue_script('proplumbing-scripts');
}

add_filter('script_loader_tag', 'proplumbing_add_script_meta', 10, 2);
function proplumbing_add_script_meta($tag, $handle){
  switch($handle){
    case 'jquery':
      $tag = str_replace('></script>', ' integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>', $tag);
      break;

    case 'bootstrap-popper':
      $tag = str_replace('></script>', ' integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>', $tag);
      break;

    case 'bootstrap-scripts':
      $tag = str_replace('></script>', ' integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>', $tag);
      break;
  }

  return $tag;
}

add_action('wp_enqueue_scripts', 'proplumbing_styles');
function proplumbing_styles(){
  wp_register_style(
    'google-fonts',
    '//fonts.googleapis.com/css?family=Oswald:500,700|Raleway:400,500,600i,700,700i'
  );

  wp_register_style(
    'fontawesome',
    '//use.fontawesome.com/releases/v5.6.3/css/all.css'
  );

  wp_register_style(
    'proplumbing-css',
    get_stylesheet_directory_uri() . '/style.css'
  );

  wp_enqueue_style('google-fonts');
  wp_enqueue_style('fontawesome');
  wp_enqueue_style('proplumbing-css');
}

add_filter('style_loader_tag', 'proplumbing_add_css_meta', 10, 2);
function proplumbing_add_css_meta($link, $handle){
  switch($handle){
    case 'fontawesome':
      $link = str_replace('/>', ' integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">', $link);
      break;
  }

  return $link;
}

add_action('after_setup_theme', 'proplumbing_setup');
function proplumbing_setup(){
  add_theme_support('post-thumbnails');
  set_post_thumbnail_size(175, 175);

  register_nav_menus(array(
    'header-nav' => 'Header Navigation',
  ));

  load_theme_textdomain('proplumbing', get_stylesheet_directory_uri() . '/languages');
}

require_once dirname(__FILE__) . '/includes/class-wp-bootstrap-navwalker.php';

function proplumbing_header_fallback_menu(){ ?>
  <div id="header-navbar" class="collapse navbar-collapse justify-content-md-center">
    <ul class="navbar-nav">
      <li class="nav-item dropdown<?php if(is_page('services') || is_singular('service')){ echo ' active'; } ?>">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?php echo esc_html__('Services', 'proplumbing'); ?></a>
        <ul class="dropdown-menu" role="menu">
          <li class="menu-item nav-item<?php if(is_page('services')){ echo ' active'; } ?>">
            <a href="<?php echo esc_url(home_url('services')); ?>" class="dropdown-item"><?php echo esc_html__('All Services', 'proplumbing'); ?></a>
          </li>
          <li class="menu-item nav-item<?php if(is_single('sewer-septic')){ echo ' active'; } ?>">
            <a href="<?php echo esc_url(home_url('sewer-septic')); ?>" class="dropdown-item"><?php echo esc_html__('Sewer & Septic', 'proplumbing'); ?></a>
          </li>
          <li class="menu-item nav-item<?php if(is_single('well-pumps-filtration')){ echo ' active'; } ?>">
            <a href="<?php echo esc_url(home_url('well-pumps-filtration')); ?>" class="dropdown-item"><?php echo esc_html__('Well Pumps & Filtration', 'proplumbing'); ?></a>
          </li>
          <li class="menu-item nav-item<?php if(is_single('drain-cleaning')){ echo ' active'; } ?>">
            <a href="<?php echo esc_url(home_url('drain-cleaning')); ?>" class="dropdown-item"><?php echo esc_html__('Drain Cleaning', 'proplumbing'); ?></a>
          </li>
          <li class="menu-item nav-item<?php if(is_single('camera-inspections')){ echo ' active'; } ?>">
            <a href="<?php echo esc_url(home_url('camera-inspections')); ?>" class="dropdown-item"><?php echo esc_html__('Camera Inspections', 'proplumbing'); ?></a>
          </li>
          <li class="menu-item nav-item<?php if(is_single('well-pump-systems')){ echo ' active'; } ?>">
            <a href="<?php echo esc_url(home_url('well-pump-systems')); ?>" class="dropdown-item"><?php echo esc_html__('Well Pump Systems', 'proplumbing'); ?></a>
          </li>
          <li class="menu-item nav-item<?php if(is_single('location-services')){ echo ' active'; } ?>">
            <a href="<?php echo esc_url(home_url('location-services')); ?>" class="dropdown-item"><?php echo esc_html__('Location Services', 'proplumbing'); ?></a>
          </li>
          <li class="menu-item nav-item<?php if(is_single('emergency-services')){ echo ' active'; } ?>">
            <a href="<?php echo esc_url(home_url('emergency-services')); ?>" class="dropdown-item"><?php echo esc_html__('Emergency Services', 'proplumbing'); ?></a>
          </li>
          <li class="menu-item nav-item<?php if(is_single('water-heater-services')){ echo ' active'; } ?>">
            <a href="<?php echo esc_url(home_url('water-heater-services')); ?>" class="dropdown-item"><?php echo esc_html__('Water Heater Services', 'proplumbing'); ?></a>
          </li>
          <li class="menu-item nav-item<?php if(is_single('troubleshooting-leaks-and-clogs')){ echo ' active'; } ?>">
            <a href="<?php echo esc_url(home_url('troubleshooting-leaks-and-clogs')); ?>" class="dropdown-item"><?php echo esc_html__('Troubleshooting Leaks and Clogs', 'proplumbing'); ?></a>
          </li>
          <li class="menu-item nav-item<?php if(is_single('water-filtration')){ echo ' active'; } ?>">
            <a href="<?php echo esc_url(home_url('water-filtration')); ?>" class="dropdown-item"><?php echo esc_html__('Water Filtration', 'proplumbing'); ?></a>
          </li>
          <li class="menu-item nav-item<?php if(is_single('root-removal')){ echo ' active'; } ?>">
            <a href="<?php echo esc_url(home_url('root-removal')); ?>" class="dropdown-item"><?php echo esc_html__('Root Removal', 'proplumbing'); ?></a>
          </li>
        </ul>
      </li>
      <li class="nav-item<?php if(is_page('financing')){ echo ' active'; } ?>">
        <a href="<?php echo esc_url(home_url('financing')); ?>" class="nav-link"><?php echo esc_html__('Financing', 'proplumbing'); ?></a>
      </li>
      <li class="nav-item<?php if(is_page('gallery')){ echo ' active'; } ?>">
        <a href="<?php echo esc_url(home_url('gallery')); ?>" class="nav-link"><?php echo esc_html__('Gallery', 'proplumbing'); ?></a>
      </li>
      <li class="nav-item<?php if(is_page('our-team')){ echo ' active'; } ?>">
        <a href="<?php echo esc_url(home_url('our-team')); ?>" class="nav-link"><?php echo esc_html__('Our Team', 'proplumbing'); ?></a>
      </li>
      <li class="nav-item<?php if(is_page('contact-us')){ echo ' active'; } ?>">
        <a href="<?php echo esc_url(home_url('contact-us')); ?>" class="nav-link"><?php echo esc_html__('Contact Us', 'proplumbing'); ?></a>
      </li>
    </ul>
  </div>
<?php }

//custom font settings for acf editor
add_filter('mce_buttons_2', 'proplumbing_wp_buttons');
function proplumbing_wp_buttons($buttons){
  array_unshift($buttons, 'fontselect');
  array_unshift($buttons, 'fontsizeselect');
  return $buttons;
}

add_filter('tiny_mce_before_init', 'proplumbing_wp_font_sizes');
function proplumbing_wp_font_sizes($initArray){
  $initArray['fontsize_formats'] = '14px 16px 18px 20px 24px 26px 28px 30px 32px 36px 38px 40px 42px 44px 46px 50px 52px 60px';
  $initArray['font_formats'] = 'Oswald=Oswald;Raleway=Raleway;';
  return $initArray;
}

add_filter('init', 'proplumbing_mce_font_styles');
function proplumbing_mce_font_styles(){
  $font_url = '//fonts.googleapis.com/css?family=Oswald:500,700|Raleway:400,500,600i,700,700i';
  add_editor_style(str_replace(',', '%2C', $font_url));
}

//add formats dropdown to mce
add_filter('mce_buttons', 'proplumbing_style_select');
function proplumbing_style_select($buttons){
  array_push($buttons, 'styleselect');
  return $buttons;
}

//add new styles to mce formats dropdown
add_filter('tiny_mce_before_init', 'proplumbing_styles_dropdown');
function proplumbing_styles_dropdown($settings){
  $new_styles = array(
    array(
      'title' => esc_html__('Custom Styles', 'proplumbing'),
      'items' => array(
        array(
          'title' => esc_html__('Theme Button Yellow', 'proplumbing'),
          'selector' => 'a',
          'classes' => 'btn-main'
        ),
        array(
          'title' => esc_html__('Theme Button Gray', 'proplumbing'),
          'selector' => 'a',
          'classes' => 'btn-main btn-alt'
        ),
      )
    )
  );

  $settings['style_formats_merge'] = true;
  $settings['style_formats'] = json_encode($new_styles);
  return $settings;
}

add_action('admin_head', 'proplumbing_custom_styles');
function proplumbing_custom_styles(){
  echo '<style>
    .btn-contact>a{
      display:inline-block;
      font-family: "Oswald", sans-serif;
      font-weight: 500;
      color: #242424;
      background-color: #f6c626;
      padding:5px 30px;
      /*border: 2px solid #dcd7d4;*/
      position:relative;
      margin-bottom:40px;
      margin-top:40px;
    }

    .btn-contact>a::before{
      content:"";
      position:absolute;
      top:-6%;
      left:-3%;
      height:114%;
      width:106%;
      z-index:-1;
      background-color:#fff;
      background-image:repeating-linear-gradient(90deg, #dcd7d4, #8c888e 25%, #dcd7d4 50%);
    }
    .btn-contact>a:hover,
    .btn-contact>a:focus{
      background-color: #242424;
      color:#fff;
      text-decoration:none;
    }
  </style>';
}
//end custom font settings

function proplumbing_esc_svg($svg){
  $kses_defaults = wp_kses_allowed_html('post');

  $svg_args = array(
    'svg' => array(
      'class' => true,
      'id' => true,
      'xmlns' => true,
      'viewbox' => true,
      'width' => true,
      'height' => true
    ),
    'defs' => array(),
    'title' => array(),
    'g' => array(
      'id' => true
    ),
    'path' => array(
      'class' => true,
      'd' => true,
      'fill' => true
    ),
    'rect' => array(
      'class' => true,
      'x' => true,
      'y' => true,
      'width' => true,
      'height' => true,
      'transform' => true,
      'fill' => true
    ),
    'polygon' => array(
      'class' => true,
      'points' => true,
      'fill' => true
    )
  );

  $allowed_tags = array_merge($kses_defaults, $svg_args);
  echo wp_kses($svg, $allowed_tags);
}
