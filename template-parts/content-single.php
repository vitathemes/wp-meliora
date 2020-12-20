<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_meliora
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'c-post c-post--single' ); ?>>
    <header class="c-post__header entry-header">
        <div class="c-post__meta entry-meta">
			<?php
			wp_meliora_entry_category();
			?>
        </div><!-- .entry-meta -->
		<?php
		the_title( '<h1 class="c-post__title entry-title">', '</h1>' );
		?>
        <div class="c-post__meta c-post__meta--date-author entry-meta s-post-meta">
			<?php
			wp_meliora_posted_on();
			wp_meliora_posted_by();
			?>
        </div><!-- .entry-meta -->

		<?php if ( get_theme_mod( 'show_posts_thumbnail', true ) ) : ?>
            <div class="c-post__thumbnail">
				<?php wp_meliora_post_thumbnail(); ?>
            </div>
		<?php endif; ?>
    </header><!-- .entry-header -->

    <div class="c-post__content entry-content">
        <div class="c-post__content__main">
			<?php wp_meliora_post_content(); ?>
        </div>
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-meliora' ),
				'after'  => '</div>',
			)
		);
		?>
    </div><!-- .entry-content -->
	<?php wp_meliora_post_tags_single();

	do_action('wp_meliora_share_socials_area');
	?>
</article><!-- #post-<?php the_ID(); ?> -->
