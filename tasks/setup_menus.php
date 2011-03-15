<?php

function _profile_setup_menus() {

    // Create Menu
    $menu_name = install_menu_create_menu('Main Navigation', 'site-nav', 'The main navigation menu for the website');

    $menu = array(
//         array(
//             'path' => 'home',
//             'title' => 'Home',
//             'description' => 'Home',
//             'menu' => $menu_name,
//             'weight' => -49,
//             'children' => array(
//                 array(
//                     'path' => 'node/2',
//                     'title' => 'Nested menu item',
//                     'description' => '',
//                     'menu' => $menu_name,
//                     'weight' => -50,
//                 ),
//             ),
//         ),
    );

    install_menu_create_menu_items($menu, 0);

    menu_rebuild();
}