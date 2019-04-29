<?php
if(!defined('ABSPATH')){ exit; }

acf_add_local_field_group(array(
  'key' => 'group_5cc735e045b46',
  'title' => 'Get Started Section',
  'fields' => array(
    array(
      'key' => 'field_5cc735e891554',
      'label' => 'Get Started Section Content',
      'name' => 'get_started_section_content',
      'type' => 'wysiwyg',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'tabs' => 'all',
      'toolbar' => 'full',
      'media_upload' => 1,
      'delay' => 0,
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'options_page',
        'operator' => '==',
        'value' => 'general-settings',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => true,
  'description' => '',
));