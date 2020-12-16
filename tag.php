<?php
/**
 * The template for displaying archive pages
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
                <h2 class="site-main__content__title h1"><?php echo wp_kses_post(get_the_archive_title()); ?></h2>
	            <?php if ( has_nav_menu( 'menu-2' ) &&  get_theme_mod( 'show_slider_menu_tags', true ) == true ) : ?>
                    <div class="c-categories-list">
                        <ul class="c-categories-list__list js-categories-list s-categories-list" data-slick='{"slidesToShow": 4, "slidesToScroll": 4, "variableWidth": true}'>
				            <?php wp_meliora_slider_menu(); ?>
                        </ul>
                    </div>
	            <?php endif; ?>
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

					wp_meliora_posts_pagination();

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
