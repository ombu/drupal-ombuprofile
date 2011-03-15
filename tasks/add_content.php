<?php

function _profile_add_content() {

    // Set node_export import settings. Possible Settings:
    //   Publishing options (status, moderate, promote, sticky, and revision), always set first for a node type.
    //     node_export_reset_{node_type}
    //   Changed time (Last updated date/time)
    //     node_export_reset_changed_{node_type}
    //   Created time (Authored on date/time)
    //     node_export_reset_created_{node_type}
    //   Menu Link
    //     node_export_reset_menu_{node_type}
    //   URL Path
    //     node_export_reset_path_{node_type}
    variable_set('node_export_reset_page', FALSE); // Always set this first for a node type
    variable_set('node_export_reset_path_page', FALSE);
    variable_set('node_export_reset_path_school', FALSE);

    $u = user_load(1); // system
    foreach (glob(drupal_get_path('profile', 'ombubase') . '/node_export_data/*.export.php') as $importfile) {

        $nodes = install_node_export_import_from_file($importfile, array(), $u);

    }

}
