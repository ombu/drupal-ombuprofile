<?php

function _profile_setup_content_types() {

    foreach (glob(drupal_get_path('profile', 'ombubase') . '/cck/*.cck.php') as $importfile) {
        install_content_copy_import_from_file($importfile);
    }

    menu_rebuild();

    // Default page to not be promoted and have comments disabled.
    variable_set('node_options_page', array('status'));
    variable_set('comment_page', COMMENT_NODE_DISABLED);
}
