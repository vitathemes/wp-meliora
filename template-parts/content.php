<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_meliora
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'c-post c-post--archive' ); ?>>
	<?php if ( get_theme_mod( 'show_posts_thumbnail_Archive', false ) ) : ?>
		<?php wp_meliora_post_thumbnail(); ?>
	<?php endif; ?>
    <header class="c-post__header entry-header">
        <div class="c-post__meta entry-meta s-post-meta">
			<?php
			do_action( 'wp_meliora_post_meta_area' );
			?>
        </div><!-- .entry-meta -->
		<?php
		the_title( '<h2 class="c-post__title entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		?>
    </header><!-- .entry-header -->

    <?php do_action( 'wp_meliora_archive_post_main' ); ?>

	<?php if ( is_singular() ): ?>
        <div class="c-post__content entry-content">
			<?php wp_meliora_post_content(); ?>
			<?php


			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-meliora' ),
					'after'  => '</div>',
				)
			);
			?>
        </div><!-- .entry-content -->

        <footer class="c-post__footer entry-footer">
			<?php wp_meliora_entry_footer(); ?>
        </footer><!-- .entry-footer -->
	<?php else:
		do_action( 'wp_meliora_archive_post_tags_area' );
		?>


	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
