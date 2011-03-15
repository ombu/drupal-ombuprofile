<?php

$content['type']  = array (
  'name' => 'Page',
  'type' => 'page',
  'description' => 'A page.',
  'title_label' => 'Title',
  'body_label' => 'Body',
  'min_word_count' => '0',
  'help' => '',
  'node_options' => 
  array (
    'status' => true,
    'promote' => true,
    'sticky' => false,
    'revision' => false,
  ),
  'upload' => 1,
  'old_type' => 'page',
  'orig_type' => '',
  'module' => 'node',
  'custom' => '1',
  'modified' => '1',
  'locked' => '0',
);
$content['groups']  = array (
  0 => 
  array (
    'label' => 'Title Options',
    'group_type' => 'standard',
    'settings' => 
    array (
      'form' => 
      array (
        'style' => 'fieldset_collapsed',
        'description' => '',
      ),
      'display' => 
      array (
        'description' => '',
        'teaser' => 
        array (
          'format' => 'fieldset',
          'exclude' => 1,
        ),
        'full' => 
        array (
          'format' => 'fieldset',
          'exclude' => 1,
        ),
        4 => 
        array (
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        'token' => 
        array (
          'format' => 'fieldset',
          'exclude' => 1,
        ),
        'label' => 'above',
      ),
    ),
    'weight' => '32',
    'group_name' => 'group_title',
  ),
);
$content['fields']  = array (
  0 => 
  array (
    'label' => 'Hide Title',
    'field_name' => 'field_hide_title',
    'type' => 'text',
    'widget_type' => 'optionwidgets_onoff',
    'change' => 'Change basic information',
    'weight' => '43',
    'description' => 'Check this to hide the Page title.  This is usually used when the title is in the Banner.  Don\'t worry, this won\'t cause any SEO repercussions.',
    'default_value' => 
    array (
      0 => 
      array (
        'value' => 0,
      ),
    ),
    'default_value_php' => '',
    'default_value_widget' => NULL,
    'group' => 'group_title',
    'required' => 0,
    'multiple' => '0',
    'text_processing' => '0',
    'max_length' => '',
    'allowed_values' => '0|No
1|Hide Title',
    'allowed_values_php' => '',
    'op' => 'Save field settings',
    'module' => 'text',
    'widget_module' => 'optionwidgets',
    'columns' => 
    array (
      'value' => 
      array (
        'type' => 'text',
        'size' => 'big',
        'not null' => false,
        'sortable' => true,
        'views' => true,
      ),
    ),
    'display_settings' => 
    array (
      'weight' => '43',
      'parent' => 'group_title',
      'label' => 
      array (
        'format' => 'above',
      ),
      'teaser' => 
      array (
        'format' => 'default',
        'exclude' => 1,
      ),
      'full' => 
      array (
        'format' => 'default',
        'exclude' => 1,
      ),
      4 => 
      array (
        'format' => 'default',
        'exclude' => 1,
      ),
      'token' => 
      array (
        'format' => 'default',
        'exclude' => 1,
      ),
    ),
  ),
  1 => 
  array (
    'label' => 'Banner',
    'field_name' => 'field_banner',
    'type' => 'filefield',
    'widget_type' => 'imagefield_widget',
    'change' => 'Change basic information',
    'weight' => '44',
    'file_extensions' => 'png gif jpg jpeg',
    'progress_indicator' => 'bar',
    'file_path' => 'banners',
    'max_filesize_per_file' => '',
    'max_filesize_per_node' => '',
    'max_resolution' => 0,
    'min_resolution' => 0,
    'custom_alt' => 0,
    'alt' => '',
    'custom_title' => 0,
    'title_type' => 'textfield',
    'title' => '',
    'use_default_image' => 0,
    'default_image_upload' => '',
    'default_image' => NULL,
    'description' => 'Optional.  Upload an image banner to show on this page.',
    'group' => 'group_title',
    'required' => 0,
    'multiple' => '0',
    'list_field' => '0',
    'list_default' => 1,
    'description_field' => '0',
    'op' => 'Save field settings',
    'module' => 'filefield',
    'widget_module' => 'imagefield',
    'columns' => 
    array (
      'fid' => 
      array (
        'type' => 'int',
        'not null' => false,
        'views' => true,
      ),
      'list' => 
      array (
        'type' => 'int',
        'size' => 'tiny',
        'not null' => false,
        'views' => true,
      ),
      'data' => 
      array (
        'type' => 'text',
        'serialize' => true,
        'views' => true,
      ),
    ),
    'display_settings' => 
    array (
      'weight' => '44',
      'parent' => 'group_title',
      'label' => 
      array (
        'format' => 'above',
      ),
      'teaser' => 
      array (
        'format' => 'image_plain',
        'exclude' => 1,
      ),
      'full' => 
      array (
        'format' => 'image_plain',
        'exclude' => 1,
      ),
      4 => 
      array (
        'format' => 'image_plain',
        'exclude' => 1,
      ),
      'token' => 
      array (
        'format' => 'image_plain',
        'exclude' => 1,
      ),
    ),
  ),
  2 => 
  array (
    'label' => 'Header Banners',
    'field_name' => 'field_header_banner',
    'type' => 'filefield',
    'widget_type' => 'imagefield_widget',
    'change' => 'Change basic information',
    'weight' => '40',
    'file_extensions' => 'png gif jpg jpeg',
    'progress_indicator' => 'bar',
    'file_path' => '',
    'max_filesize_per_file' => '',
    'max_filesize_per_node' => '',
    'max_resolution' => 0,
    'min_resolution' => 0,
    'custom_alt' => 0,
    'alt' => '',
    'custom_title' => 0,
    'title_type' => 'textfield',
    'title' => '',
    'use_default_image' => 0,
    'default_image_upload' => '',
    'default_image' => NULL,
    'description' => 'Upload an image show show in this page\'s header.  If more than one image is uploaded, a cycling slideshow will be shown. ',
    'group' => false,
    'required' => 0,
    'multiple' => '1',
    'list_field' => '0',
    'list_default' => 1,
    'description_field' => '0',
    'op' => 'Save field settings',
    'module' => 'filefield',
    'widget_module' => 'imagefield',
    'columns' => 
    array (
      'fid' => 
      array (
        'type' => 'int',
        'not null' => false,
        'views' => true,
      ),
      'list' => 
      array (
        'type' => 'int',
        'size' => 'tiny',
        'not null' => false,
        'views' => true,
      ),
      'data' => 
      array (
        'type' => 'text',
        'serialize' => true,
        'views' => true,
      ),
    ),
    'display_settings' => 
    array (
      'label' => 
      array (
        'format' => 'above',
        'exclude' => 1,
      ),
      'teaser' => 
      array (
        'format' => 'image_plain',
        'exclude' => 1,
      ),
      'full' => 
      array (
        'format' => 'image_plain',
        'exclude' => 1,
      ),
      4 => 
      array (
        'format' => 'image_plain',
        'exclude' => 1,
      ),
      'token' => 
      array (
        'format' => 'image_plain',
        'exclude' => 1,
      ),
    ),
  ),
  3 => 
  array (
    'label' => 'Body Class',
    'field_name' => 'field_body_class',
    'type' => 'text',
    'widget_type' => 'text_textfield',
    'change' => 'Change basic information',
    'weight' => '41',
    'rows' => 5,
    'size' => '60',
    'description' => '',
    'default_value' => 
    array (
      0 => 
      array (
        'value' => '',
        '_error_element' => 'default_value_widget][field_body_class][0][value',
      ),
    ),
    'default_value_php' => '',
    'default_value_widget' => 
    array (
      'field_body_class' => 
      array (
        0 => 
        array (
          'value' => '',
          '_error_element' => 'default_value_widget][field_body_class][0][value',
        ),
      ),
    ),
    'group' => false,
    'required' => 0,
    'multiple' => '0',
    'text_processing' => '0',
    'max_length' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'op' => 'Save field settings',
    'module' => 'text',
    'widget_module' => 'text',
    'columns' => 
    array (
      'value' => 
      array (
        'type' => 'text',
        'size' => 'big',
        'not null' => false,
        'sortable' => true,
        'views' => true,
      ),
    ),
    'display_settings' => 
    array (
      'weight' => '45',
      'parent' => '',
      'label' => 
      array (
        'format' => 'above',
      ),
      'teaser' => 
      array (
        'format' => 'default',
        'exclude' => 1,
      ),
      'full' => 
      array (
        'format' => 'default',
        'exclude' => 1,
      ),
      4 => 
      array (
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => 
      array (
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
  ),
);
$content['extra']  = array (
  'title' => '31',
  'body_field' => '33',
  'revision_information' => '36',
  'author' => '37',
  'options' => '38',
  'menu' => '35',
  'taxonomy' => '42',
  'path' => '39',
  'attachments' => '34',
  'xmlsitemap' => '30',
);
