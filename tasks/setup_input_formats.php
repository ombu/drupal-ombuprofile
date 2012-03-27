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
  $ombu_format = array(
    'format' => 'ombu_input',
    'name' => 'OMBU Input',
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
          'allowed_html' => '<a><u><em><strong><ul><ol><li><span><img><h2><h3><h4><h5><h6><dl><dt><dd><br><hr><p><blockquote>',
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
  $ombu_format = (object) $ombu_format;
  filter_format_save($ombu_format);

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
      'format' => $ombu_format->format,
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

// @todo: make sure this is fully migrated to D7
function _profile_setup_input_formats() {

    /**
     * Input formats
     */

    // Remove "Filtered HTML" (1) & "Full HTML" (2) formats
    db_query("DELETE FROM {filter_formats} WHERE format in (%d,%d)", array(1, 2));
    db_query("DELETE FROM {filters} WHERE format in (%d,%d)", array(1, 2));

    $ombu_format_id = install_add_format('OMBU Input');

    $ombu_format_rids[] = install_get_rid('editor');
    $ombu_format_rids[] = install_get_rid('administrator');

    install_format_set_roles($ombu_format_rids, $ombu_format_id);

    install_set_filter($ombu_format_id, 'filter', 2); // URL Filter
    install_set_filter($ombu_format_id, 'filter', 3); // HTML Corrector
    install_set_filter($ombu_format_id, 'htmlpurifier', 0); // HTML Purifier
    install_set_filter($ombu_format_id, 'img_assist', 0); // IMG Assist

    // Set OMBU Input as default input format
    variable_set('filter_default_format', $ombu_format_id);

    //-- HTMLPurifier settings
    $htmlpurifier_settings = array(
      'Attr.EnableID' => '0',   // Allow IDs
      'Attr.AllowedFrameTargets' => array('_blank', '_self'), // Needed to allow title attributes to work
      'AutoFormat.AutoParagraph' => '0', // TinyMCE does paragraphs / linebreaks
      'AutoFormat.Linkify' => '0',
      'AutoFormat.RemoveEmpty' => '0',
      'Filter.YouTube' => '0',
      'HTML.Allowed' => 'a[href|target|title|style|class],u[style|class],em[style|class],strong[style|class],ul[style|class],ol[style|class],li[style|class],span[style|class],img[src|style|class],h1[style|class],h2[style|class],h3[style|class],h4[style|class],h5[style|class],h6[style|class],dl[style|class],dt[style|class],dd[style|class],br[style|class],hr[style|class],p[style|class]',
      'HTML.ForbiddenAttributes' => '',
      'HTML.ForbiddenElements' => '',
      'URI.DisableExternalResources' => '0',
      'URI.DisableResources' => '0',
      'Null_URI.Munge' => '1',
    );
    variable_set('htmlpurifier_config_'.$ombu_format_id, $htmlpurifier_settings);

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

    db_query("INSERT INTO {wysiwyg} (format, settings, editor) VALUES (%d, '%s', '%s')", $ombu_format_id, serialize($tiny_settings), 'tinymce');


    /**
     * Image Assist Settings (admin/settings/img_assist)
     */

    /**
     * Display Image assist on paths:
     *  0 - On specific paths
     *  1 - Not on specific paths
     *  2 - All paths
     */
    variable_set('img_assist_paths_type', '2');

    /**
     * Display Image assist on text areas:
     *  0 - Show on every textarea except for the listed textareas
     *  1 - Show on only the listed textareas
     *  2 - Show on all textareas
     */
    variable_set('img_assist_textareas_type', '1');
    variable_set('img_assist_textareas', '');

    /**
     * Textarea image link (what to show under img_assist enabled textareas)
     *  icon - Icon
     *  text - Text link
     *  none - Do not show link
     */
    variable_set('img_assist_link', 'none');

    /**
     * Default link behavior
     *  url - Go to url
     *  popup - Open in popup window
     *  node - Link to image page
     *  none - Not a link
     */
    variable_set('img_assist_default_link_behavior', 'none');

    /**
     * Default insert mode
     *  filtertag - Filter Tag
     *  html - HTML Code
     */
    variable_set('img_assist_default_insert_mode', 'html');

    /**
     * Preset caption title (if enabled, image title will be loaded as default caption)
     */
    variable_set('img_assist_load_title', '0');

    /**
     * Preset caption text (if enabled, image body text will be loaded as default caption text)
     */
    variable_set('img_assist_load_description', '0');

    /**
     * Creation of image derivatives
     * - properties
     * - custom_all
     * - custom_advanced
     */
    variable_set('img_assist_create_derivatives', array(
        'custom_advanced' => 'custom_advanced',
        'custom_all' => 'custom_all',
    ));

    // Image path (relative from files/)
    variable_set('image_default_path', 'images');
}
