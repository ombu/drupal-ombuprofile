<?php

function _profile_setup_vars() {

    _profile_setup_vars_ombumailer();
    _profile_setup_vars_pathauto();
    _profile_setup_vars_error_reporting();
    _profile_setup_vars_performance();

    variable_set('date_default_timezone_name', 'America/Los_Angeles');

    // No hover links on views
    variable_set('views_no_hover_links', 1);

    // Enabe access logs
    variable_set('statistics_enable_access_log', TRUE);

    // Captcha settings
    db_query('DELETE FROM {captcha_points}');
    db_query("INSERT INTO {captcha_points} (form_id, module, type) VALUES ('form_id', 'captcha_module', 'captcha_type')");
    variable_set('captcha_add_captcha_description', FALSE);
    variable_set('captcha_persistence', 0);

    // File Sizes
    variable_set('upload_uploadsize_default', 20);
    variable_set('upload_usersize_default', 10000);
}

// Ombumailer (admin/siteconfig, test at admin/settings/ombumailer)
function _profile_setup_vars_ombumailer() {

    $ombumailer_settings = array(
        'username' => 'ac40599',
        'password' => '7rzomKKHNYik7rgS',
        'host' => 'mail.authsmtp.com',
        'port' => '2525',
        'use_authentication' => 1,
        'globalfromaddress' => 0,
        'debug' => 0,
        'log' => 1,
    );

    variable_set('ombumailer_settings', $ombumailer_settings);
}

// Pathauto (admin/build/path/pathauto)
function _profile_setup_vars_pathauto() {

    variable_set('ombu_menupath_priority_menu', 'menu-site-nav');

    /**
     * Update Action
     *  0 - Do nothing. Leave the old alias intact.
     *  1 - Create a new alias. Leave the existing alias functioning.
     *  2 - Create a new alias. Delete the old alias.
     */
    variable_set('pathauto_update_action', '2');

    /**
     * Reduce strings to letters and numbers from ASCII-96
     */
    variable_set('pathauto_reduce_ascii', TRUE);

    variable_set('pathauto_node_applytofeeds', '');


    /**
     * Default node pattern
     */
    variable_set('pathauto_node_pattern', '[ombu-menupath]');

    /**
     * Additional node patterns
     *  variable format: 'pathauto_node_{type}_pattern'
     */
    variable_set('pathauto_node_page_pattern', '[ombu-menupath]');

}

// Error Reporting (admin/settings/error-reporting)
function _profile_setup_vars_error_reporting() {

    /**
     * Error reporting:
     *  0 - Write errors to the log
     *  1 - Write errors to the log and to the screen
     */
    variable_set('error_level', "0");

}

// Performance (admin/settings/performance)
function _profile_setup_vars_performance() {

    /**
     * Only setup caching if the environment isn't development
     */
    if (ombu_env('development')) {
        return;
    }

    /**
     * Caching mode:
     *  0 - Disabled
     *  1 - Normal
     *  2 - Aggressive
     */
    variable_set('cache', "0");

    /**
     * Minimum cache lifetime (seconds):
     *  0 - Disabled
     *  1 - Normal
     *  2 - Aggressive
     */
    variable_set('cache_lifetime', "0");

    /**
     * Page Compression (enabled/disabled)
     */
    variable_set('page_compression', '0');

    /**
     * Block Cache (enabled/disabled)
     */
    variable_set('block_cache', "0");

    /**
     * Aggregate CSS (enabled/disabled)
     */
    variable_set('preprocess_css', "0");

    /**
     * Aggregate JS (enabled/disabled)
     */
    variable_set('preprocess_js', "0");
}
