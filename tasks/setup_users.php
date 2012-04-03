<?php
// $Id$

/**
 * Setup user roles and permissions.
 *
 * @param $install_state
 *   An array of information about the current installation state.
 */
function ombuprofile_setup_users($install_state) {

  /**
   * User settings (admin/config/people/accounts)
   */

  // Set default contact status (gets added to the users data field)
  variable_set('contact_default_status', 0);

  /**
   * Registration settings:
   *  0 - Only site admins can create new accounts
   *  1 - Visitors can create accounts without admin approval
   *  2 - Visitors can create accounts with admin approval
   */
  variable_set('user_register', 0);

  // Require email varification when a visitor creates an account
  variable_set('user_email_verification', 0);

  /**
   * User roles and permissions.
   */
  $default_format_permission = filter_permission_name(filter_format_load('default'));
  $comment_format_permission = filter_permission_name(filter_format_load('comment'));

  // Enable default permissions for system roles.
  user_role_grant_permissions(DRUPAL_ANONYMOUS_RID, array($comment_format_permission, 'access content', 'view the administration theme', 'search content' /*, 'access comments'*/));
  user_role_grant_permissions(DRUPAL_AUTHENTICATED_RID, array($comment_format_permission, 'access content' /*, 'access comments', 'post comments', 'skip comment approval'*/));

  // Create a default role for site administrators, with all available permissions assigned.
  $admin_role = new stdClass();
  $admin_role->name = 'administrator';
  $admin_role->weight = 2;
  user_role_save($admin_role);
  // Set this as the administrator role.

  $admin_permissions = array(
    $default_format_permission,
    $comment_format_permission,
    'administer blocks',
    'access dashboard',
    'redirect from admin to dashboard',
    'configure ombu site',
    'edit supplementary content',
    'show dashboard toolbar',
    'access content overview',
    'access content',
    'view own unpublished content',
    'administer users',
    'access user profiles',
    'access all views',
    'view the administration theme',
    'access overlay',
    'access statistics',
    'view post access counter',
    'administer site configuration',
    'use tinymce html button',
  );
  user_role_grant_permissions($admin_role->rid, $admin_permissions);

  // Assign user 1 the "administrator" role.
  db_insert('users_roles')
    ->fields(array('uid' => 1, 'rid' => $admin_role->rid))
    ->execute();

  // Create a editor role.
  $editor_role = new stdClass();
  $editor_role->name = 'editor';
  $editor_role->weight = 3;
  user_role_save($editor_role);
  $editor_permissions = array(
    $default_format_permission,
    $comment_format_permission,
    'access content overview',
    'access contextual links',
    'show dashboard toolbar',
    'view the administration theme',
    'access overlay',
    'access dashboard',
    'redirect from admin to dashboard',
    'edit supplementary content',
    'edit views basic settings',
    'administer nodes',
    'create url aliases',
    'administer menu',

    // Content specific permissions
    //'create page content', 'edit any page content', 'delete any page content',

    // Taxonomy specific permissions
    // 'edit terms in 1', 'delete terms in 1',
  );
  user_role_grant_permissions($editor_role->rid, $editor_permissions);

  // Create new users.
  $users = array(
    array(
      'name' => 'test_editor',
      'pass' => 'pass',
      'mail' => 'test@test.com',
      'status' => 1,
      'roles' => array(
        $editor_role->rid => 'editor',
      ),
    ),
    array(
      'name' => 'test_administrator',
      'pass' => 'pass',
      'mail' => 'test2@test.com',
      'status' => 1,
      'roles' => array(
        $admin_role->rid => 'administrator',
        $editor_role->rid => 'editor',
      ),
    ),
  );

  foreach($users as $u) {
    user_save(new stdClass, $u);
  }
}

function _profile_setup_users() {

    // Set default contact status (gets added to the users data field)
    variable_set('contact_default_status', 0);

    /**
     * User settings (admin/user/settings)
     */

    /**
     * Registration settings:
     *  0 - Only site admins can create new accounts
     *  1 - Visitors can create accounts without admin approval
     *  2 - Visitors can create accounts with admin approval
     */
    variable_set('user_register', 0);

    /**
     * Require email varification when a visitor creates an account
     */
    variable_set('user_email_verification', 0);

    /**
     * Text displayed at the top of the user registration form
     */
    variable_set('user_registration_help', '');

    /**
     * User signature support:
     *  0 - Disabled
     *  1 - Enabled
     */
    variable_set('user_signatures', 0);

    /**
     * User picture support:
     *  0 - Disabled
     *  1 - Enabled
     */
    variable_set('user_pictures', 0);

    /**
     * User picture path (Subdirectory in the directory sites/default/files/ where pictures will be stored.)
     */
    variable_set('user_picture_path', 'picture');

    /**
     * URL of picture to display for users with no custom picture selected. Leave blank for none.
     */
    variable_set('user_picture_default', '');

    /**
     * Maximum dimensions for user pictures, in pixels
     */
    variable_set('user_picture_dimensions', '48x48');

    /**
     * Maximum file size for user pictures, in kB
     */
    variable_set('user_picture_file_size', '30');

    /**
     * Email: WELCOME, NO APPROVAL REQUIRED
     */
    variable_set('user_mail_register_no_approval_required_body', <<<HEREDOC
!username,

Thank you for registering at !site. You may log in by clicking this link or copying and pasting it in your browser:

!login_url/login

This is a one-time login, so it can be used only once.

After logging in, you will be redirected to a form to change your password.


--  !site team
HEREDOC
    );

    /**
     * Email: WELCOME, AWAITING ADMINISTRATOR APPROVAL
     */
    variable_set('user_mail_register_pending_approval_subject', "Account details for !username at !site (pending approval)");
    variable_set('user_mail_register_pending_approval_body', <<<HEREDOC
!username,

Thank you for registering at !site. Your application for an account is currently pending approval. Once it has been approved, you will receive another e-mail containing information about how to log in, set your password, and other details.

--  !site team
HEREDOC
    );

    /**
     * Email: ACCOUNT ACTIVATION EMAIL
     */
    variable_set('user_mail_status_activated_subject', "Account details for !username at !site (approved)");
    variable_set('user_mail_status_activated_body', <<<HEREDOC
!username,

Your account at !site has been activated.

You may now log in by clicking on this link or copying and pasting it in your browser:

!login_url/login

This is a one-time login, so it can be used only once.

After logging in, you will be redirected so you can change your password.

Once you have set your own password, you will be able to log in to !login_uri in the future using:

username: !username
HEREDOC
    );

    /**
     * Roles & Permissions
     */
    $role_rids = array(
        'anonymous user' => install_get_rid('anonymous user'),
        'authenticated user' => install_get_rid('authenticated user'),
        'editor' => install_add_role('editor'),
        'administrator' => install_add_role('administrator'),
    );

    $better_formats_permissions = array(
        'show format selection for nodes', 'show format selection for comments',
        'show format selection for blocks', 'show format tips', 'show more format tips link',
        'collapsible format selection', 'collapse format fieldset by default',
    );

    /**
     * anonymous user
     */
    install_add_permissions($role_rids['anonymous user'], array(
        'access content', 'view uploaded files',
    ));
    install_remove_permissions($role_rids['anonymous user'], $better_formats_permissions);

    /**
     * authenticated user
     */
    install_add_permissions($role_rids['authenticated user'], array(
        'access content', 'view uploaded files', 'access administration pages', 'access the dashboard page',
        'redirect from admin to dashboard', 'show dashboard toolbar',
    ));
    install_remove_permissions($role_rids['authenticated user'], $better_formats_permissions);

    /**
     * editor
     */
    install_add_permissions($role_rids['editor'], array(

        'Allow Reordering', 'administer nodes', 'create url aliases', 'administer taxonomy',
        'upload files',

        // Content-specific permissions here
        'create page content', 'edit any page content', 'delete any page content',

    ));

    /**
     * administrator
     */
    install_add_permissions($role_rids['administrator'], array(

        'administer menu', 'configure ombu site', 'access site reports', 'access statistics',
        'access user profiles',
        'administer permissions', // so they can change user's roles
        'administer users', 'use tinymce html button',

    ));

    $users = array(
        array(
            'name' => 'test_editor',
            'pass' => 'pass',
            'mail'    => 'jon.glick+test_editor@ombuweb.com',
            'roles'    => array('editor'),
        ),
        array(
            'name' => 'test_administrator',
            'pass' => 'pass',
            'mail'    => 'jon.glick+test_administrator@ombuweb.com',
            'roles'    => array('administrator', 'editor'),
        ),
    );

    foreach($users as $u) {
        install_add_user($u['name'], $u['pass'], $u['mail'], $u['roles']);
    }

}
