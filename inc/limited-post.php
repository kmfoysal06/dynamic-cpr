<?php
function limit_total_posts($data, $postarr) {
    // Check if it's the custom post type you want to limit
    if ($data['post_type'] == 'cpr') {
        // Set the maximum allowed posts
        $max_posts = 2;

        // Count the total number of published posts for the custom post type
        $total_post_count = wp_count_posts('cpr')->publish;

        // Check if the total number of posts has reached the limit
        if ($total_post_count > $max_posts) {
            // If the limit is reached, prevent the post from being inserted
            $data['post_status'] = 'draft';
            wp_die('Sorry, the maximum number of posts for this custom post type has been reached.');
        }
    }

    return $data;
}

add_filter('wp_insert_post_data', 'limit_total_posts', 10, 2);
