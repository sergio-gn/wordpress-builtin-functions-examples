<section>
    <div class="container">
        <div class="row">
            <h3>Find your page</h3>
            <h5>Search by alphabetical order:</h5>
        </div>
        <div>
        <?php
            for ($i = ord('a'); $i <= ord('z'); $i++) {
                $letter = chr($i);
        ?>
            <div role="button" data-char="<?=strtoupper($letter)?>">
                <?=$letter?>
            </div>
        <?php
            }
        ?>
        </div>
    </div>
</section>

<section class="areas py-lg-5">
    <div class="container">
        <?php
        $template = 'templates/templatename.php';

        $args = array(
            'posts_per_page'   => -1,
            'post_type' => 'page',
            'order' => 'ASC',
            'orderby' => 'title',
            'meta_query' => array(
                array(
                    'key' => '_wp_page_template',
                    'value' => $template
                )
            )
        );
        $pages_with_template = get_posts( $args );
        ?>
        <ul class="row">
            <?php foreach ( $pages_with_template as $page ) :
                $parent_id = wp_get_post_parent_id( $page->ID );
                $areaname = get_the_title( $page->ID );
            ?>
            <li class="char-<?=strtoupper($areaname[0])?> parent-<?=$parent_id?>">
                <a href="<?php echo get_permalink( $page->ID ); ?>">
                    <?php echo $areaname; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>