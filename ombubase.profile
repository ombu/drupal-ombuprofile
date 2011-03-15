<?php
/**
 * Basic profile for OMBU Drupal sites
 */


/**
 * Return an array of the modules to be enabled when this profile is installed.
 *
 * @return
 *   An array of modules to enable.
 */
function ombubase_profile_modules() {
    return array(
        /* CORE - REQUIRED */
        'block', 'filter', 'node', 'system', 'user',

        /* CORE - OPTIONAL */
        'dblog', 'help', 'menu', 'path', 'statistics', 'upload', 'taxonomy',

        /* DATE */
        'date_api', 'date_timezone', 'date_popup',

        /* CCK */
        'content', 'text', 'filefield', 'imagefield', 'optionwidgets', 'fieldgroup', 'number',

        /* VIEWS */
        'views', 'views_ui', 'views_bulk_operations', 'draggableviews', 'draggableviews_cck',

        /* SYSTEM */
        'token', 'pathauto', 'menu_block',

        /* INSTALL - located in profiles/cambridge_base/modules -- disabled after profile install */
        'install_profile_api', 'node_export', 'content_copy',

        /* INPUT */
        'wysiwyg', 'htmlpurifier', 'image', 'img_assist', 'better_formats',
        'imageapi', 'imageapi_gd', 'imagecache', 'imagecache_ui',

        /* ADMINISTER */

        /* MEDIA */
        'swftools', 'flowplayer3', 'swfobject2',

        /* OMBU */
        'ombuutility', 'ombudashboard', 'ombumailer', 'ombucleanup', 'ombuseo',

        /* SITE SPECIFIC */


        /* XML SITEMAP */
        'xmlsitemap', 'xmlsitemap_node',

        'globalredirect',
    );
}

/**
 * Return a description of the profile for the initial installation screen.
 *
 * @return
 *   An array with keys 'name' and 'description' describing this profile,
 *   and optional 'language' to override the language selection for
 *   language-specific profiles.
 */
function ombubase_profile_details() {
  return array(
    'name' => 'OMBU Base',
    'description' => 'OMBU Web Base Profile',
  );
}

/**
 * Return a list of tasks that this profile supports.
 *
 * @return
 *   A keyed array of tasks the profile will perform during
 *   the final stage. The keys of the array will be used internally,
 *   while the values will be displayed to the user in the installer
 *   task list.
 */
function ombubase_profile_task_list() {
    return array(
        'setup_themes' => st('Setup Themes'),
        'setup_taxonomy' => st('Setup Taxonomy'),
        'setup_content_types' => st('Setup Content Types'),
        'setup_users' => st('Setup Roles & Users'),
        'setup_input_formats' => st('Setup Input Formats'),
        'setup_vars' => st('Setup Site Variables'),
        'add_files' => st('Add Files'),
        'add_content' => st('Add Content'),
        'setup_menus' => st('Setup Menus'),
        'setup_blocks' => st('Setup Blocks'),
        'setup_imagecache' => st('Setup Image Cache'),
        'setup_swftools' => st('Setup SWFTools'),
        'setup_xmlsitemap' => st('Setup XML Sitemap'),
        'cleanup' => st('Clean Up Profile Installation'),
        'run_cron' => st('Run Cron'),
    );
}

/**
 * Perform installation tasks for this profile.
 *
 */
function ombubase_profile_tasks(&$task, $url) {

    // install_profile_api includes
    install_include(ombubase_profile_modules());

    $tasks = ombubase_profile_task_list();
    $task_function_prefix = '_profile_';

    // Initialize our tasks
    if ( $task == 'profile' ) {

        foreach( $tasks as $task_key => $task_title ) {

            $task = $task_key;
            $task_function_name = $task_function_prefix.$task;

            // Require the task file if necessary
            if ( !function_exists($task_function_name) && file_exists( dirname(__file__).'/tasks/'.$task.'.php' ) ) {
                require( dirname(__file__).'/tasks/'.$task.'.php' );
            }

            if ( function_exists($task_function_name) ) {
                // Execute task
                $task_function_name();
            } else {
                return "Whoops, something went wrong with task $task and function $task_function_name.";
            }
        }
        $task = 'profile-finished';
    }
    return;
}

/**
 *  Commented out because it's not needed if using drush installer
 *  Defaults for site config -- update for site-specific profile
function system_form_install_configure_form_alter(&$form, $form_state) {
    $form['site_information']['site_name']['#value'] = '{site name}';
    $form['site_information']['site_mail']['#value'] = 'jon.glick@ombuweb.com';
    $form['admin_account']['account']['name']['#value'] = 'system';
    $form['admin_account']['account']['mail']['#value'] = 'jon.glick@ombuweb.com';
    $form['server_settings']['update_status_module']['#value'] = FALSE;
    $form['server_settings']['#collapsible'] = true;
    $form['server_settings']['#collapsed'] = true;
}
 */
