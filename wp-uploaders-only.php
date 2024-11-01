<?php
    /*
    * Plugin Name:       WP Uploaders Only
    * Plugin URI:        http://joychetry.com/wp-uploaders-only/
    * Description:       Restricts users to access only self uploaded content on the front end. This plugin is coded to works best with plugins like BuddyUpload, etc. It fixes the bug of allowing users to access and delete other users uploaded content.
    * Version:           1.0.1
    * Author:            Joy Chetry
    * Author URI:        http://joychetry.com/
    * License:           GPLv2
    * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
    */
    /*
    Restricts users to access only self uploaded content on the front end. This plugin is coded to works best with plugins like BuddyUpload, etc. It fixes the bug of allowing users to access and delete other users uploaded content.
    */
    function joy_uploaders_only($query) {
        //get current user info to see if they are allowed to access ANY posts and pages
        $current_user = wp_get_current_user();
        // set current user to $is_user
        $is_user = $current_user->user_login;
        //if is admin or 'is_user' does not equal #username
        if (!current_user_can('manage_options')){
            //if in the admin panel
            if($query->is_admin) {

                global $user_ID;
                $query->set('author',  $user_ID);

            }
            return $query;
        }
        return $query;
    }
    add_filter('pre_get_posts', 'joy_uploaders_only');
?>