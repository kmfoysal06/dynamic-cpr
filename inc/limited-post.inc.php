<?php
function limit_total_posts($post_ID, $post, $update) {
    // Check if it's the custom post type you want to limit
    if (!$update && $post->post_type == 'cpr') {
        // Set the maximum allowed posts
        $max_posts = 6;

        // Count the total number of published posts for the custom post type
        $total_post_count = wp_count_posts('cpr')->publish;

        // Check if the total number of posts has reached the limit
        if ($total_post_count >= $max_posts) {
            // If the limit is reached, prevent the post from being inserted
            wp_trash_post($post_ID); // Move the post to trash
            wp_die('Sorry, the maximum number of posts for this custom post type has been reached.');
        }
    }
}

add_action('wp_insert_post', 'limit_total_posts', 10, 3);