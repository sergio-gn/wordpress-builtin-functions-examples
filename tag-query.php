<?php
$args = array(
    'post_type' => 'custom_post',
    'post_status' => 'publish',
    'posts_per_page' => -1,
);

// Get all the tags associated with the 'custom_post' post type
$tags = get_terms(array('taxonomy' => 'post_tag', 'hide_empty' => false));

foreach ($tags as $tag) {
    // Get tag ID, slug, and name
    $tag_id = $tag->term_id;
    $tag_slug = $tag->slug;
    $tag_name = $tag->name;

    // Get all posts under the 'custom_post' post type and the current tag
    $args['tag__in'] = array($tag_id);
    $query = new WP_Query($args);

    // Check if there are any posts for the current tag
    if ($query->have_posts()) {
        // Start displaying the content for the current tag
        echo '<div class="images">';

        // Collect all post IDs under the current tag
        $post_ids = array();
        while ($query->have_posts()) {
            $query->the_post();
            $post_ids[] = get_the_ID();
        }

        // Randomly pick one post ID
        $random_post_id = $post_ids[array_rand($post_ids)];

        // Get the image URL from the randomly selected post
        $image_url = get_the_post_thumbnail_url($random_post_id, 'full');
        $image_alt = get_the_title($random_post_id);
        $image_name = $tag_name;
        $image_link = get_tag_link($tag_id);

        // Display the randomly chosen image and related information
        echo '<a href="' . $image_link . '">';
        echo '<div class="img-wrapper">';
        echo '<img src="' . $image_url . '" alt="' . $image_alt . '"/>';
        echo '<div class="hoverresult">' . $image_name . '</div>';
        echo '</div>';
        echo '<div>' . $image_name . '</div>';
        echo '</a>';
        echo '</div>'; // Close the 'custom-images' div
        wp_reset_postdata(); // Reset the query to prepare for the next tag
    }
}
?>