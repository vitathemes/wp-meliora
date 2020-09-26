<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_meliora
 */

get_header();
?>

    <main id="primary" class="site-main">
        <div class="site-main__container default-max-width">
            <div class="site-main__content">
                <div class="c-categories-list">
                    <ul class="c-categories-list__list js-categories-list s-categories-list" data-slick='{"slidesToShow": 4, "slidesToScroll": 4, "variableWidth": true}'>
	                    <?php wp_meliora_categories_list(); ?>
                    </ul>
                </div>
				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) :
						?>
					<?php
					endif;

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

					the_posts_pagination( array(
						'screen_reader_text' => ' ',
						'mid_size'           => 2,
						'prev_text'          => __( '←', 'wp-manifest' ),
						'next_text'          => __( '→', 'wp-manifest' ),
					) );

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
            </div>
			<?php
			get_sidebar();
			?>
        </div>
    </main><!-- #main -->

<?php
get_footer();
