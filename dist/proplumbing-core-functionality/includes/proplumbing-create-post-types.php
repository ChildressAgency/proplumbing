<?php
if(!defined('ABSPATH')){ exit; }

function proplumbing_create_post_types(){
  $service_labels = array(
    'name' =>  esc_html_x('Services', 'post type name', 'proplumbing'),
    'singular_name' => esc_html_x('Service', 'post type singular name', 'proplumbing'),
    'menu_name' => esc_html_x('Services', 'post type menu name', 'proplumbing'),
    'add_new_item' => esc_html__('Add New Service', 'proplumbing'),
    'search_items' => esc_html__('Search Services', 'proplumbing'),
    'edit_item' => esc_html__('Edit Service', 'proplumbing'),
    'view_item' => esc_html__('View Service', 'proplumbing'),
    'all_items' => esc_html__('All Services', 'proplumbing'),
    'new_item' => esc_html__('New Service', 'proplumbing'),
    'not_found' => esc_html__('No Services Found', 'proplumbing')
  );
  $service_args = array(
    'labels' => $service_labels,
    'capability_type' => 'post',
    'public' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-hammer',
    'query_var' => 'service',
    'has_archive' => false,
    'show_in_rest' => true,
    'supports' => array(
      'title',
      'editor',
      'custom-fields',
      'revisions', 
      'thumbnail'
    )
  );
  register_post_type('service', $service_args);
}