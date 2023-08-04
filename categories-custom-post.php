<?php
    // Get all the categories from the 'peach_category' taxonomy associated with the 'peaches' post type
    $categories = get_terms( array(
        'taxonomy' => 'example_category',
    ) );

    if ( ! empty( $categories ) ) {
        echo '<ul>';
        foreach ( $categories as $category ) {
            echo '<li><a href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo 'No categories found for peaches.';
    }
?>