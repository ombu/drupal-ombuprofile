<?php

function _profile_cleanup() {

    // Disable modules used to install profile
    module_disable(array('node_export', 'install_profile_api', 'locale'));
}