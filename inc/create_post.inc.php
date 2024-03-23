<?php
/**
 * Create a new post of the custom post type if no posts exist
 *
 * @package dynamic-cpr
 */

if(!defined('ABSPATH')){
    exit;
    // exit if accessed directly
}
function kmfdcpr_post(){
    if(post_type_exists('cpr')){
    // Check if there are any posts of your custom post type
    $existing_posts = get_posts(['post_type' => 'cpr', 'posts_per_page' => -1]);

    // If no posts are found, add a new one
    if (empty($existing_posts)) {
        $new_post = [
            'post_title'   => 'Demo Post',
            'post_status'  => 'publish',
            'post_type'    => 'cpr',
        ];

        // Insert the post into the database
        if (is_wp_error(wp_insert_post($new_post))) {
            wp_die('there is an error');
        }
    }
    }
}

if(function_exists('kmfdcpr_post')){
    add_action('init', 'kmfdcpr_post');
}