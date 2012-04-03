<?php
// $Id$

/**
 * Setup default input formats.
 *
 *
 * @param $install_state
 *   An array of information about the current installation state.
 */
function ombuprofile_setup_input_formats($install_state) {
  // Add text formats.
  $default_format = array(
    'format' => 'default',
    'name' => 'OMBU Input',
    'weight' => 0,
    'filters' => array(
      // HTML filter.
      'filter_html' => array(
        'weight' => 0,
        'status' => 1,
        'settings' => array(
          'allowed_html' => '<a><u><em><strong><ul><ol><li><span><img><h2><h3><h4><h5><h6><dl><dt><dd><br><hr><p><blockquote>',
        )
      ),
      // Video filter (must be before the url filter and after the html filter.
      'video_filter' => array(
        'weight' => 1,
        'status' => 1,
        'settings' => array(
          'video_filter_width' => '566',
          'video_filter_height' => '400',
          'video_filter_autoplay' => '0',
          'video_filter_related' => '0',
          'video_filter_html5' => '1',
        ),
      ),
      // URL filter.
      'filter_url' => array(
        'weight' => 2,
        'status' => 1,
      ),
      // Line break filter.
      'filter_autop' => array(
        'weight' => 3,
        'status' => 1,
      ),
      // HTML corrector filter.
      // @todo replace with HTML Purifier once stable
      'filter_htmlcorrector' => array(
        'weight' => 10,
        'status' => 1,
      ),
    ),
  );
  $default_format = (object) $default_format;
  filter_format_save($default_format);

  //-- Setup WYSIWYG/TinyMCE
  $tiny_settings = array (
    'default' => 1,
    'user_choose' => 0,
    'show_toggle' => 0,
    'theme' => 'advanced',
    'language' => 'en',
    'buttons' => array (
      'default' => array (
        'bold' => 1,
        'italic' => 1,
        'bullist' => 1,
        'numlist' => 1,
        'link' => 1,
        'unlink' => 1,
        'removeformat' => 1,
      ),
      'font' => array (
        'formatselect' => 1,
        'styleselect' => 1,
      ),
      'inlinepopups' => array (
        'inlinepopups' => 1,
      ),
      'autoresize' => array (
        'autoresize' => 1,
      ),
      'img_assist' => array (
        'img_assist' => 1,
      ),
      'paste' => array(
        'paste' => 1,
      ),
    ),
    'toolbar_loc' => 'top',
    'toolbar_align' => 'left',
    'path_loc' => 'bottom',
    'resizing' => 1,
    'verify_html' => 1,
    'preformatted' => 0,
    'convert_fonts_to_spans' => 1,
    'remove_linebreaks' => 0,
    'apply_source_formatting' => 0,
    'paste_auto_cleanup_on_paste' => 1,
    'block_formats' => 'p,h2,h3,h4',
    'css_setting' => 'self',

    // CSS to include in TinyMce body, comma separated
    //  vars: %b - base_path(), %t - theme path
    //  Ex: %b%t/css/reset.css,%b%t/css/content.css
    'css_path' => '',

    // Classes to make available in Tiny, separated by \n.  Ex: "Read More=read-more\nImage Left=img-left\n"
    'css_classes' => "",
  );

  db_insert('wysiwyg')
    ->fields(array(
      'format' => $default_format->format,
      'settings' => serialize($tiny_settings),
      'editor' => 'tinymce',
    ))
    ->execute();


  // Comment Format
  $comment_format = array(
    'format' => 'comment',
    'name' => 'Comment',
    'weight' => 0,
    'filters' => array(
      // URL filter.
      'filter_url' => array(
        'weight' => 0,
        'status' => 1,
      ),
      // HTML filter.
      'filter_html' => array(
        'weight' => 1,
        'status' => 1,
        'settings' => array(
          'allowed_html' => '<a><u><em><strong><p>',
        )
      ),
      // Line break filter.
      'filter_autop' => array(
        'weight' => 2,
        'status' => 1,
      ),
      // HTML corrector filter.
      // @todo replace with HTML Purifier once stable
      'filter_htmlcorrector' => array(
        'weight' => 10,
        'status' => 1,
      ),
    ),
  );
  $comment_format = (object) $comment_format;
  filter_format_save($comment_format);

  //-- Setup WYSIWYG/TinyMCE
  $comment_tiny_settings = array (
    'default' => 1,
    'user_choose' => 0,
    'show_toggle' => 0,
    'theme' => 'advanced',
    'language' => 'en',
    'buttons' => array (
      'default' => array (
        'bold' => 1,
        'italic' => 1,
        'link' => 1,
        'unlink' => 1,
        'removeformat' => 1,
      ),
      'inlinepopups' => array (
        'inlinepopups' => 1,
      ),
      'autoresize' => array (
        'autoresize' => 1,
      ),
      'paste' => array(
        'paste' => 1,
      ),
    ),
    'toolbar_loc' => 'top',
    'toolbar_align' => 'left',
    'path_loc' => 'bottom',
    'resizing' => 1,
    'verify_html' => 1,
    'preformatted' => 0,
    'convert_fonts_to_spans' => 1,
    'remove_linebreaks' => 0,
    'apply_source_formatting' => 0,
    'paste_auto_cleanup_on_paste' => 1,
    'block_formats' => 'p',
    'css_setting' => 'self',

    // CSS to include in TinyMce body, comma separated
    //  vars: %b - base_path(), %t - theme path
    //  Ex: %b%t/css/reset.css,%b%t/css/content.css
    'css_path' => '',

    // Classes to make available in Tiny, separated by \n.  Ex: "Read More=read-more\nImage Left=img-left\n"
    'css_classes' => "",
  );

  db_insert('wysiwyg')
    ->fields(array(
      'format' => $comment_format->format,
      'settings' => serialize($comment_tiny_settings),
      'editor' => 'tinymce',
    ))
    ->execute();

}
