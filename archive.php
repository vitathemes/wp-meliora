<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Digital_Interface
 */

get_header();
?>

    <main id="primary" class="site-main">
        <div class="site-main__container default-max-width">
            <div class="site-main__content">
                <div class="c-categories-list">
                    <ul class="c-categories-list__list js-categories-list s-categories-list">
                        <?php digital_interface_categories_list(); ?>
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
