<?php
// $Id$

/**
 * Setup content types.
 *
 * Content type definitions are handled by features.
 *
 * @param $install_state
 *   An array of information about the current installation state.
 */
function ombubase_setup_content_types($install_state) {
  // Default "Basic page" and "Products" to not be promoted and have comments disabled.
  variable_set('node_options_page', array('status'));
  variable_set('comment_page', COMMENT_NODE_HIDDEN);

  // Don't display date and author information for "Basic page" and "Product" nodes by default.
  variable_set('node_submitted_page', FALSE);

  // Setup available menus.
  // Set to empty array to hide menu from page.
  variable_set('menu_options_page', array('main-menu'));
}
