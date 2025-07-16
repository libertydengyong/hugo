<?php
// Small Tools Settings File - DO NOT EDIT DIRECTLY
// Generated on: 2025-05-04 15:56:03

define('SMALL_TOOLS_DISABLE_RIGHT_CLICK', 'no');
define('SMALL_TOOLS_PREVENT_COPYING', 'no');
define('SMALL_TOOLS_REMOVE_IMAGE_THRESHOLD', 'no');
define('SMALL_TOOLS_DISABLE_LAZY_LOAD', 'no');
define('SMALL_TOOLS_DISABLE_EMOJIS', 'no');
define('SMALL_TOOLS_REMOVE_JQUERY_MIGRATE', 'no');
define('SMALL_TOOLS_BACK_TO_TOP', 'no');
define('SMALL_TOOLS_BACK_TO_TOP_POSITION', 'right');
define('SMALL_TOOLS_BACK_TO_TOP_BG_COLOR', 'rgba(0, 0, 0, 0.7)');
define('SMALL_TOOLS_BACK_TO_TOP_SIZE', '40');
define('SMALL_TOOLS_FORCE_STRONG_PASSWORDS', 'no');
define('SMALL_TOOLS_DISABLE_XMLRPC', 'no');
define('SMALL_TOOLS_HIDE_WP_VERSION', 'no');
define('SMALL_TOOLS_WC_VARIATION_THRESHOLD', '30');
define('SMALL_TOOLS_ADMIN_FOOTER_TEXT', 'Thank you for using <a href=\"https://smalltools.io\" target=\"_blank\">Small Tools</a>');
define('SMALL_TOOLS_DARK_MODE_ENABLED', 'no');
define('SMALL_TOOLS_ENABLE_MEDIA_REPLACE', 'yes');
define('SMALL_TOOLS_ENABLE_SVG_UPLOAD', 'no');
define('SMALL_TOOLS_ENABLE_AVIF_UPLOAD', 'no');
define('SMALL_TOOLS_ENABLE_DUPLICATION', 'yes');
define('SMALL_TOOLS_REMOVE_WP_LOGO', 'no');
define('SMALL_TOOLS_REMOVE_SITE_NAME', 'no');
define('SMALL_TOOLS_REMOVE_CUSTOMIZE_MENU', 'no');
define('SMALL_TOOLS_REMOVE_UPDATES_MENU', 'no');
define('SMALL_TOOLS_REMOVE_COMMENTS_MENU', 'no');
define('SMALL_TOOLS_REMOVE_NEW_CONTENT', 'no');
define('SMALL_TOOLS_REMOVE_HOWDY', 'no');
define('SMALL_TOOLS_REMOVE_HELP', 'no');
define('SMALL_TOOLS_HIDE_ADMIN_NOTICES', 'no');
define('SMALL_TOOLS_DISABLE_DASHBOARD_WELCOME', 'no');
define('SMALL_TOOLS_DISABLE_DASHBOARD_ACTIVITY', 'no');
define('SMALL_TOOLS_DISABLE_DASHBOARD_QUICK_PRESS', 'no');
define('SMALL_TOOLS_DISABLE_DASHBOARD_NEWS', 'no');
define('SMALL_TOOLS_DISABLE_DASHBOARD_SITE_HEALTH', 'no');
define('SMALL_TOOLS_DISABLE_DASHBOARD_AT_A_GLANCE', 'no');
define('SMALL_TOOLS_HIDE_ADMIN_BAR', 'no');
define('SMALL_TOOLS_WIDER_ADMIN_MENU', 'no');
define('SMALL_TOOLS_LOGIN_LOGO_URL', 'https://973524.xyz');
define('SMALL_TOOLS_ENABLE_USER_COLUMNS', 'yes');
define('SMALL_TOOLS_ENABLE_LAST_LOGIN', 'yes');
define('SMALL_TOOLS_DISABLE_GUTENBERG', 'no');
define('SMALL_TOOLS_DISABLE_COMMENTS', 'no');
define('SMALL_TOOLS_DISABLE_REST_API', 'no');
define('SMALL_TOOLS_DISABLE_FEEDS', 'no');
define('SMALL_TOOLS_DISABLE_JQUERY_MIGRATE', 'no');
define('SMALL_TOOLS_DISABLE_CORE_UPDATES', 'no');
define('SMALL_TOOLS_DISABLE_PLUGIN_UPDATES', 'no');
define('SMALL_TOOLS_DISABLE_THEME_UPDATES', 'no');
define('SMALL_TOOLS_DISABLE_TRANSLATION_UPDATES', 'no');
define('SMALL_TOOLS_DISABLE_UPDATE_EMAILS', 'no');
define('SMALL_TOOLS_DISABLE_UPDATE_PAGE', 'no');

// Apply settings
// Gutenberg Settings

// WordPress General Features

// Media Features
add_filter('media_row_actions', function($actions, $post) {
                if (current_user_can('upload_files')) {
                    $actions['replace_media'] = sprintf(
                        '<a href="#" class="small-tools-replace-media" data-id="%d">%s</a>',
                        $post->ID,
                        esc_html__('Replace Media', 'small-tools')
                    );
                }
                return $actions;
            }, 10, 2);

// Content Duplication
add_filter('post_row_actions', function($actions, $post) {
                if (current_user_can('edit_posts')) {
                    $actions['duplicate'] = sprintf(
                        '<a href="%s" title="%s">%s</a>',
                        esc_url(wp_nonce_url(
                            add_query_arg(
                                array(
                                    'action' => 'small_tools_duplicate',
                                    'post' => $post->ID
                                ),
                                admin_url('admin.php')
                            ),
                            'small_tools_duplicate_post_' . $post->ID,
                            'nonce'
                        )),
                        esc_attr__('Duplicate this item', 'small-tools'),
                        esc_html__('Duplicate', 'small-tools')
                    );
                }
                return $actions;
            }, 10, 2);
add_filter('page_row_actions', function($actions, $post) {
                return apply_filters('post_row_actions', $actions, $post);
            }, 10, 2);

// Security Features

// Admin Features
add_filter('admin_footer_text', function() {
    return 'Thank you for using <a href="https://smalltools.io" target="_blank">Small Tools</a>';
});

// Admin Bar Cleanup
function small_tools_clean_admin_bar() {
    global $wp_admin_bar;

}
add_action('wp_before_admin_bar_render', 'small_tools_clean_admin_bar');


// Login Customization
add_filter('login_headerurl', function() {
    return 'https://973524.xyz';
});

// User Columns
add_filter('manage_users_columns', function($columns) {
    $columns['registered'] = __('Registration Date', 'small-tools');
    if (defined('SMALL_TOOLS_ENABLE_LAST_LOGIN') && SMALL_TOOLS_ENABLE_LAST_LOGIN === 'yes') {
        $columns['last_login'] = __('Last Login', 'small-tools');
    }
    return $columns;
});

add_action('manage_users_custom_column', function($value, $column_name, $user_id) {
    switch ($column_name) {
        case 'registered':
            $user = get_userdata($user_id);
            return date_i18n(get_option('date_format'), strtotime($user->user_registered));
        case 'last_login':
            if (defined('SMALL_TOOLS_ENABLE_LAST_LOGIN') && SMALL_TOOLS_ENABLE_LAST_LOGIN === 'yes') {
                $last_login = get_user_meta($user_id, 'last_login', true);
                return $last_login ? date_i18n(get_option('date_format') . ' ' . get_option('time_format'), $last_login) : __('Never', 'small-tools');
            }
    }
    return $value;
}, 10, 3);

// Update last login timestamp when user logs in
add_action('wp_login', function($user_login, $user) {
    update_user_meta($user->ID, 'last_login', time());
}, 10, 2);


// Login/Logout Redirects
add_filter('login_redirect', function($redirect_to, $requested_redirect_to, $user) {
    if (!$user || is_wp_error($user)) {
        return $redirect_to;
    }

    $user_roles = $user->roles;
    if (!empty($user_roles)) {
        $primary_role = $user_roles[0];
        $role_redirects = maybe_unserialize(stripslashes(SMALL_TOOLS_LOGIN_REDIRECT_ROLES));
        
        // Check if role redirects is an array and has the user's role
        if (is_array($role_redirects) && !empty($role_redirects[$primary_role])) {
            return stripslashes($role_redirects[$primary_role]);
        }
        
        // If no role-specific URL is set, use the default URL
        if (defined('SMALL_TOOLS_LOGIN_REDIRECT_DEFAULT_URL') && !empty(SMALL_TOOLS_LOGIN_REDIRECT_DEFAULT_URL)) {
            return stripslashes(SMALL_TOOLS_LOGIN_REDIRECT_DEFAULT_URL);
        }
    }

    return $redirect_to;
}, 10, 3);

add_filter('logout_redirect', function($redirect_to, $requested_redirect_to, $user) {
    if ($user instanceof WP_User) {
        $user_roles = $user->roles;
        if (!empty($user_roles)) {
            $primary_role = $user_roles[0];
            $role_redirects = maybe_unserialize(stripslashes(SMALL_TOOLS_LOGOUT_REDIRECT_ROLES));
            
            // Check if role redirects is an array and has the user's role
            if (is_array($role_redirects) && !empty($role_redirects[$primary_role])) {
                return stripslashes($role_redirects[$primary_role]);
            }
            
            // If no role-specific URL is set, use the default URL
            if (defined('SMALL_TOOLS_LOGOUT_REDIRECT_DEFAULT_URL') && !empty(SMALL_TOOLS_LOGOUT_REDIRECT_DEFAULT_URL)) {
                return stripslashes(SMALL_TOOLS_LOGOUT_REDIRECT_DEFAULT_URL);
            }
        }
    }

    return $redirect_to;
}, 10, 3);


// Frontend Features

// WordPress Components
