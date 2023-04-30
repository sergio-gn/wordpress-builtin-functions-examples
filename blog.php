<?php get_header(); ?>

<main class="main" role="main">
    <div class="container py-2">
        <div class="d-flex gap-1">
            <div class="col-xl-5">
                <?php
                    // set the category slug to retrieve posts from
                    $category_slug = 'principal';
                
                    // set up the arguments for the query to select the main post
                    $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'category_name' => $category_slug,
                        'posts_per_page' => 1 // only retrieve 1 post
                    );
                
                    // create a new WP_Query instance with the arguments
                    $query = new WP_Query( $args );
                
                    // start the loop
                    if ( $query->have_posts() ) : 
                        while ( $query->have_posts() ) : $query->the_post(); 
                    ?>
                    
                            <article>
                                <div class="first-post bg-white">
                                    <?php if(has_post_thumbnail()): ?>
                                        <div class="img-wrapper_first-post">
                                            <div class="post__thumbnail"><?php the_post_thumbnail(); ?></div>
                                        </div>
                                    <?php endif; ?>
                                    <?php 
                                      $tags = get_the_tags();
                                      
                                      if ( $tags ) {
                                        echo '<div class="post-tags">';
                                        foreach ( $tags as $tag ) {
                                          echo '<a href="' . get_tag_link( $tag->term_id ) . '" class="tag-' . $tag->name . '">' . $tag->name . '</a> ';
                                        }
                                        echo '</div>';
                                      }

                                    ?>

                                    <header class="post__header p-2" role="heading">
                                        <h3 class="fs-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <p class="post__date"><time><?php echo human_time_diff(strtotime($post->post_date)) . ' ' . __('ago'); ?></time></p>
                                        <p>
                                            <?php 
                                              $excerpt = get_the_excerpt();
                                              $excerpt = wp_trim_words( $excerpt, 20, '...' );
                                              echo $excerpt;
                                            ?>
                                        </p>
                                    </header>
                                </div>
                            </article>
                    <?php
                        endwhile;
                    endif;
                
                    // reset the query
                    wp_reset_postdata();
                ?>
            </div>
</main>

<?php get_footer(); ?>
