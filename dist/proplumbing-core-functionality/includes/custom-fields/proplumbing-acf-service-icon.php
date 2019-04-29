<?php
if(!defined('ABSPATH')){ exit; }

acf_add_local_field_group(array(
  'key' => 'group_5cc72ab16c669',
  'title' => 'Service Icon',
  'fields' => array(
    array(
      'key' => 'field_5cc72ab95e4b6',
      'label' => 'Service Icon File Type',
      'name' => 'service_icon_file_type',
      'type' => 'radio',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array(
        'JPG/PNG' => 'JPG/PNG',
        'SVG' => 'SVG',
      ),
      'allow_null' => 0,
      'other_choice' => 0,
      'default_value' => '',
      'layout' => 'vertical',
      'return_format' => 'value',
      'save_other_choice' => 0,
    ),
    array(
      'key' => 'field_5cc72b005e4b7',
      'label' => 'Service Icon',
      'name' => 'service_icon',
      'type' => 'image',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => array(
        array(
          array(
            'field' => 'field_5cc72ab95e4b6',
            'operator' => '==',
            'value' => 'JPG/PNG',
          ),
        ),
      ),
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'return_format' => 'id',
      'preview_size' => 'full',
      'library' => 'all',
      'min_width' => '',
      'min_height' => '',
      'min_size' => '',
      'max_width' => '',
      'max_height' => '',
      'max_size' => '',
      'mime_types' => '',
    ),
    array(
      'key' => 'field_5cc72b165e4b8',
      'label' => 'Service Icon',
      'name' => 'service_icon',
      'type' => 'textarea',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => array(
        array(
          array(
            'field' => 'field_5cc72ab95e4b6',
            'operator' => '==',
            'value' => 'SVG',
          ),
        ),
      ),
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'maxlength' => '',
      'rows' => '',
      'new_lines' => '',
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'service',
      ),
    ),
  ),
  'menu_order' => 1,
  'position' => 'acf_after_title',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => true,
  'description' => '',
));