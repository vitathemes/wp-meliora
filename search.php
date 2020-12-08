<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package wp_meliora
 */

get_header();
?>

    <main id="primary" class="site-main">
        <div class="site-main__container default-max-width">
            <div class="site-main__content">
				<?php if ( have_posts() ) : ?>

                    <header class="page-header">
                        <h1 class="page-title">
							<?php
							/* translators: %s: search query. */
							printf( esc_html__( 'Search Results for: %s', 'wp-meliora' ), '<span>' . get_search_query() . '</span>' );
							?>
                        </h1>
                    </header><!-- .page-header -->

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );

					endwhile;

					wp_meliora_posts_pagination();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
            </div>
			<?php
			get_sidebar();
			?>
        </div>
    </main><!-- #main -->

<?php
get_footer();
