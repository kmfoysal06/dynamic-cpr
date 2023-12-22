<?php
// Check if there are any posts of your custom post type
$existing_posts = get_posts(['post_type' => 'cpr', 'posts_per_page' => 1]);

// If no posts are found, add a new one
if (empty($existing_posts)) {
    $new_post = [
        'post_title'   => 'Register Custom Posts Here',
        'post_status'  => 'publish',
        'post_type'    => 'cpr',
    ];

    // Insert the post into the database
    if (is_wp_error(wp_insert_post($new_post))) {
        wp_die('there is an error');
    }
}
