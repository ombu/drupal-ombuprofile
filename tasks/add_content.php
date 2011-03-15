<?php
// $Id$

/**
 * Add site specific content.
 *
 * Creates node content structured as hierarchical menu
 *
 * @param $install_state
 *   An array of information about the current installation state.
 */
function ombubase_add_content($install_state) {
  // Create homepage node and set to front
  $node = _ombubase_setup_new_node();
  $node->title = 'Home';
  $node->body[$node->language][0]['value'] = _ombubase_lorem();
  node_save($node);
  variable_set('site_frontpage', 'node/' . $node->nid);


  // Build structured nodes into the main menu
  /* Example structured node menu.
  $nodes = array(
    'About Us' => array(
      '#children' => array(
        'Our History' => array(),
        'Our Culture' => array(),
        'Our Team' => array(
          '#children' => array(
            'How We Work' => array(),
            // Handle special case of views and taxonomy terms underneath a node 
            // menu item.
            'Our Departments' => array(
              '#link' => array(
                'link_path' => 'about-us/our-team/our-departments',
              ),
              '#callback' => '_ombubase_build_taxonomy_menu',
            ),
            'Work With Us' => array(),
          ),
        ),
        //'News/Blog' => array(),
      ),
    ),
  );
  _ombubase_build_structured_menu_nodes($nodes, 'main-menu');
   */
}

/**
 * Build structured nodes into a menu system.
 */
function _ombubase_build_structured_menu_nodes($nodes, $menu_name, $parent = NULL) {
  static $weight = -50;
  foreach ($nodes as $title => $content) {
    // Check if a defined link exists
    if (isset($content['#link'])) {
      $menu_link = $content['#link'] + array(
        'menu_name' => $menu_name,
        'weight' => ++$weight,
        'link_title' => $title,
      );
      if ($parent) {
        $menu_link['plid'] = $parent['mlid'];
      }
      menu_link_save($menu_link);
      if ($content['#callback']) {
        call_user_func($content['#callback'], $menu_name, $menu_link);
      }

      if (!empty($content['#children'])) {
        _ombubase_build_structured_menu_nodes($content['#children'], $menu_name, $menu_link);
      }
    }
    // Otherwise treat as a regular node with possible children.
    else {
      $node = _ombubase_setup_new_node();
      $node->title = $title;
      $node->body[$node->language][0]['value'] = _ombubase_lorem();
      $node->body[$node->language][0]['format'] = 'ombu_input';
      $node->field_secondary_content[$node->language][0]['value'] = '<h2>Subheadline</h2>' . _ombubase_lorem() . '<a href="#" class="more-link">read more</a>';
      $node->field_secondary_content[$node->language][0]['format'] = 'ombu_input';
      $node->menu = array(
        'menu_name' => $menu_name,
        'enabled' => TRUE,
        'link_title' => $node->title,
        'weight' => ++$weight, // Maintain correct order.
      );
      if ($parent) {
        $node->menu['plid'] = $parent['mlid'];
      }
      node_save($node);

      if (!empty($content['#children'])) {
        _ombubase_build_structured_menu_nodes($content['#children'], $menu_name, $node->menu);
      }
    }
  }
}

/**
 * Insert taxonomy into menu system.
 */
function _ombubase_build_taxonomy_menu($menu_name, $parent) {
  $weight = 0;
  $vocab = taxonomy_vocabulary_machine_name_load('department');
  $terms = taxonomy_get_tree($vocab->vid);
  foreach ($terms as $term) {
    $term_menu = array(
      'menu_name' => $menu_name,
      'weight' => ++$weight,
      'plid' => $parent['mlid'],
      'link_title' => $term->name,
      'link_path' => 'taxonomy/term/' . $term->tid,
    );
    menu_link_save($term_menu);
  }
}

/**
 * Setup a new node object.
 */
function _ombubase_setup_new_node($type = 'page') {
  $node = new stdClass;
  $node->type = $type;
  node_object_prepare($node);
  $node->language = LANGUAGE_NONE;
  $node->uid = 1;

  return $node;
}

/**
 * Lorem ipsum generator.
 *
 * For now, this is just a static text block.  In the future, it'd be cool to 
 * make this dynamic and configurable.
 */
function _ombubase_lorem() {
  return 'Urna dolor, dolor lectus porttitor cum? Scelerisque scelerisque rhoncus nec. Arcu proin. Nunc elit ultricies et tristique et mauris aliquet dolor ultrices cras eu lorem adipiscing? Sed cras, aenean sit eros a, pulvinar, placerat aenean ultrices nascetur nunc adipiscing porta! Platea velit. Odio augue, tempor cursus? Pellentesque eu, lorem sagittis, ut elementum sit tempor lorem natoque? Facilisis magna rhoncus turpis? Ut scelerisque mid porttitor dignissim. Vel! Massa scelerisque quis ultricies natoque magna, et odio elementum. Risus, urna proin dis parturient! Risus. Nunc vut tempor, arcu, natoque ac cras scelerisque duis. In lundium nunc turpis tempor odio scelerisque tempor, natoque vel, sagittis dignissim, ac odio. Dictumst in vel natoque, eros dictumst tincidunt aliquet? Sit velit, nunc dapibus porttitor vel porta porta.';
}
