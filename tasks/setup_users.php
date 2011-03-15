<?php

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
