<?php
// Check if there are any posts of your custom post type
$existing_posts = get_posts(array('post_type' => 'cpr', 'posts_per_page' => 1));

// If no posts are found, add a new one
if (empty($existing_posts)) {
    $new_post = array(
        'post_title'   => 'Register Custom Post',
        'post_status'  => 'publish',
        'post_type'    => 'cpr',
    );

    // Insert the post into the database
    $new_post_id = wp_insert_post($new_post);

    if (is_wp_error($new_post_id)) {
        wp_die('there is an error');
    }
}
