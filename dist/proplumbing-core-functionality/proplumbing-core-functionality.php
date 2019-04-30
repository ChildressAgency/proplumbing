<?php
/**
 * Plugin Name: Professional Plumbing Solutions Theme Core Functionality
 * Description: This contains all your site's core functionality so that it is theme independent. <strong>It should always be activated.</strong>
 * Author: The Childress Agency
 * Author URI: https://childressagency.com
 * Version: 1.0
 * Text Domain: proplumbing
 */
if(!defined('ABSPATH')){ exit; }

define('PROPLUMBING_PLUGIN_DIR', dirname(__FILE__));
define('PROPLUMBING_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Load acf if not already loaded
 */
if(!class_exists('acf')){
  require_once PROPLUMBING_PLUGIN_DIR . '/vendors/advanced-custom-fields-pro/acf.php';
  add_filter('acf/settings/path', 'proplumbing_acf_settings_path');
  add_filter('acf/settings/dir', 'proplumbing_acf_settings_dir');
}

function proplumbing_acf_settings_path($path){
  $path = plugin_dir_path(__FILE__) . 'vendors/advanced-custom-fields-pro/';
  return $path;
}

function proplumbing_acf_settings_dir($dir){
  $dir = plugin_dir_url(__FILE__) . 'vendors/advanced-custom-fields-pro/';
  return $dir;
}

add_action('plugins_loaded', 'proplumbing_load_textdomain');
function proplumbing_load_textdomain(){
  load_plugin_textdomain('proplumbing', false, basename(PROPLUMBING_PLUGIN_DIR) . '/languages');
}

require_once PROPLUMBING_PLUGIN_DIR . '/includes/proplumbing-create-post-types.php';
add_action('init', 'proplumbing_create_post_types');

add_action('acf/init', 'proplumbing_options_page');
function proplumbing_options_page(){
  acf_add_options_page(array(
    'page_title' => esc_html__('General Settings', 'proplumbing'),
    'menu_title' => esc_html__('General Settings', 'proplumbing'),
    'menu_slug' => 'general-settings',
    'capability' => 'edit_posts',
    'redirect' => false
  ));
}

require_once PROPLUMBING_PLUGIN_DIR . '/includes/custom-fields/proplumbing-acf-hero.php';
require_once PROPLUMBING_PLUGIN_DIR . '/includes/custom-fields/proplumbing-acf-home.php';
require_once PROPLUMBING_PLUGIN_DIR . '/includes/custom-fields/proplumbing-acf-get-started-section.php';
require_once PROPLUMBING_PLUGIN_DIR . '/includes/custom-fields/proplumbing-acf-our-team.php';
require_once PROPLUMBING_PLUGIN_DIR . '/includes/custom-fields/proplumbing-acf-service-icon.php';
require_once PROPLUMBING_PLUGIN_DIR . '/includes/custom-fields/proplumbing-acf-contact-info.php';
require_once PROPLUMBING_PLUGIN_DIR . '/includes/custom-fields/proplumbing-acf-footer-disclaimer.php';
require_once PROPLUMBING_PLUGIN_DIR . '/includes/custom-fields/proplumbing-acf-service-gallery.php';