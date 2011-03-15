<?php

function _profile_setup_themes() {

    // Site's main theme
    install_default_theme('garland');

    // Admin theme
    install_enable_theme('ombuadmin');
    install_admin_theme('ombuadmin');

    // Don't display date and author information for page nodes by default.
    $theme_settings = variable_get('theme_settings', array());
    $theme_settings['toggle_node_info_page'] = FALSE;
    variable_set('theme_settings', $theme_settings);
}
