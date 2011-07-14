<?php

// Main theme for site.
define('OMBUBASE_DEFAULT_THEME', 'bartik');

/**
 * Implements hook_install_tasks().
 */
function ombuprofile_install_tasks() {
  return array(
    'setup_themes' => array(
      'display_name' => st('Setup Themes'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'setup_content_types' => array(
      'display_name' => st('Setup Content Types'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'setup_vars' => array(
      'display_name' => st('Setup Site Variables'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'setup_taxonomy' => array(
      'display_name' => st('Setup Taxonomy'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'setup_menus' => array(
      'display_name' => st('Setup Menus'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'setup_blocks' => array(
      'display_name' => st('Setup Blocks'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'setup_input_formats' => array(
      'display_name' => st('Setup Input Formats'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'setup_users' => array(
      'display_name' => st('Setup Roles & Users'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'add_files' => array(
      'display_name' => st('Add Files'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'add_content' => array(
      'display_name' => st('Add Content'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'post_setup' => array(
      'display_name' => st('Post Setup'),
      'function' => 'ombuprofile_install_task_router',
    ),
    /*
      'setup_xmlsitemap' => array(
      'display_name' => st('Setup XML Sitemap'),
      'function' => 'ombuprofile_install_task_router',
      ),
     */
  );
}

/**
 * Routes install task to appropriate file and/or function.
 *
 * @param $install_state
 *   An array of information about the current installation state.
 */
function ombuprofile_install_task_router($install_state) {
  $path = drupal_get_path('module', 'ombuprofile');

  $task = $install_state['active_task'];
  $task_function = 'ombuprofile_' . $task;

  if (!function_exists($task_function) && file_exists($path . '/tasks/' . $task . '.php')) {
    require($path . '/tasks/' . $task . '.php');
  }

  if (function_exists($task_function)) {
    return call_user_func($task_function, $install_state);
  } else {
    return st('Something went wront with task @task and function @function', array('@task' => $task, '@function' => $task_function));
  }
}

/**
 * Implementation of hook_image_default_styles().
 */
function ombuprofile_image_default_styles() {
  $styles = array();

  /*
  $styles['ombu_thumbnail'] = array(
    'effects' => array(
      array(
        'name' => 'image_scale',
        'data' => array('width' => 141, 'height' => 116, 'upscale' => 0),
        'weight' => 0,
      ),
    )
  );
  */

  return $styles;
}

/**
 * Implements hook_block_info().
 */
function ombuprofile_block_info() {
  // Define site specific blocks here.
  $blocks = array();
  return $blocks;
}

/**
 * Implements hook_block_view().
 */
function ombuprofile_block_view($delta = '') {
  $block = array();
  return $block;
}
