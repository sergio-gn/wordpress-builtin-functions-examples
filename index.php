<?php
get_header(); ?>

	<div id="content" role="main">
		<?php if ( have_posts() ) : ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <p><?php the_date(); ?></p>
              <p><?php the_excerpt(); ?></p>
            <?php endwhile;
            wp_reset_postdata(); endif; ?>
			<?php wpforge_content_nav( 'nav-below' ); ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; // end have_posts() check ?>
	</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
