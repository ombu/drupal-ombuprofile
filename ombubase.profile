<?php

// $Id$

/**
 * Implements hook_install_tasks().
 */
function ombubase_install_tasks() {
  return array(
    'setup_themes' => array(
      'display_name' => st('Setup Themes'),
      'function' => 'ombubase_install_task_router',
    ),
    'setup_content_types' => array(
      'display_name' => st('Setup Content Types'),
      'function' => 'ombubase_install_task_router',
    ),
    'setup_vars' => array(
      'display_name' => st('Setup Site Variables'),
      'function' => 'ombubase_install_task_router',
    ),
    'setup_taxonomy' => array(
      'display_name' => st('Setup Taxonomy'),
      'function' => 'ombubase_install_task_router',
    ),
    'setup_menus' => array(
      'display_name' => st('Setup Menus'),
      'function' => 'ombubase_install_task_router',
    ),
    'setup_blocks' => array(
      'display_name' => st('Setup Blocks'),
      'function' => 'ombubase_install_task_router',
    ),
    'setup_input_formats' => array(
      'display_name' => st('Setup Input Formats'),
      'function' => 'ombubase_install_task_router',
    ),
    'setup_users' => array(
      'display_name' => st('Setup Roles & Users'),
      'function' => 'ombubase_install_task_router',
    ),
    'add_files' => array(
      'display_name' => st('Add Files'),
      'function' => 'ombubase_install_task_router',
    ),
    'add_content' => array(
      'display_name' => st('Add Content'),
      'function' => 'ombubase_install_task_router',
    ),
    'post_setup' => array(
      'display_name' => st('Post Setup'),
      'function' => 'ombubase_install_task_router',
    ),
    /*
      'setup_xmlsitemap' => array(
      'display_name' => st('Setup XML Sitemap'),
      'function' => 'ombubase_install_task_router',
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
function ombubase_install_task_router($install_state) {
  $path = drupal_get_path('module', 'ombubase');

  $task = $install_state['active_task'];
  $task_function = 'ombubase_' . $task;

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
function ombubase_image_default_styles() {
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
function ombubase_block_info() {
  // Define site specific blocks here.
  $blocks = array();
  return $blocks;
}

/**
 * Implements hook_block_view().
 */
function ombubase_block_view($delta = '') {
  $block = array();
  return $block;
}
