<?php

function _profile_setup_imagecache() {

    $presets = array(
//         '{preset_name}' => array(
//             array(
//                 'action' => 'imagecache_scale',
//                 'width' => '121',
//                 'height' => '53',
//             ),
//         ),
    );

    foreach($presets as $name => $actions) {
        install_imagecache_add_preset($name, $actions);
    }
}
