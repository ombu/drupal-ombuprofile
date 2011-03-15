<?php

function _profile_setup_blocks() {

    // this refreshed the blocks table for themes
    install_init_blocks();

    // Blocks
    $themes = array('theme_name');
    $admin_themes = array('ombuadmin');
    $blocks = array(

        // Admin
        array( // Devel Menu
            'module' => 'menu',
            'delta' => 'devel',
            'region' => 'left',
            'weight' => 1,
            'visibility' => 0,
            'pages' => NULL,
            'themes' => $admin_themes,
        ),
        array( // Execute PHP
            'module' => 'devel',
            'delta' => '2',
            'region' => 'left',
            'weight' => 2,
            'visibility' => 0,
            'pages' => NULL,
            'themes' => $admin_themes,
        ),
    );

    foreach( $blocks as $b ) {
        foreach( $b['themes'] as $theme ) {
            $exists = db_result(db_query("SELECT bid FROM {blocks} WHERE module = '%s' AND delta = '%s' AND theme = '%s'", $b['module'], $b['delta'], $theme));
            if ( is_numeric($exists) ) {
                install_set_block($b['module'], $b['delta'], $theme, $b['region'], $b['weight'], $b['visibility'], $b['pages']);
            } else {
                install_add_block($b['module'], $b['delta'], $theme, 1, $b['weight'], $b['region'], $b['visibility'], $b['pages']);
            }
        }
    }

    // Disable these blocks
    $blocks = array(
        array(
            'module' => 'user',
            'delta' => 0,  // User Login block
        ),
        array(
            'module' => 'user',
            'delta' => 1,  // Default Navigation
        ),
        array(
            'module' => 'system',
            'delta' => 0,  // Powered by Drupal
        ),
    );
    foreach( $blocks as $b ) {
        foreach( array_merge($themes, $admin_themes) as $theme ) {
            install_disable_block($b['module'], $b['delta'], $theme);
        }
    }

}
