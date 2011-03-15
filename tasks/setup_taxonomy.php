<?php

function _profile_setup_taxonomy() {

    // Taxonomy Vocabulary
    $vid = install_taxonomy_add_vocabulary("Vocabulary name", array('page' => 1,), array('required' => TRUE));

    install_taxonomy_add_term($vid, 'Term name', 'Term description');

}