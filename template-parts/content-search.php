<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_meliora
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('c-post c-post--archive'); ?>>
    <header class="c-post__header entry-header">
		<?php
		if ( 'post' === get_post_type() ) :
			?>
            <div class="c-post__meta entry-meta">
				<?php
				wp_meliora_posted_on();
				//wp_meliora_posted_by();
				?>
            </div><!-- .entry-meta -->
		<?php endif;
		if ( is_singular() ) :
			the_title( '<h1 class="c-post__title entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="c-post__title entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
    </header><!-- .entry-header -->

	<?php if (is_singular()): ?>
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
	<?php else: ?>

		<?php wp_meliora_post_tags_archive(); ?>

	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
