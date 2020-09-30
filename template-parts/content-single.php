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
		<?php
		if ( 'post' === get_post_type() ) :
			?>
            <div class="c-post__meta entry-meta">
				<?php
				wp_meliora_entry_category();
				?>
            </div><!-- .entry-meta -->
		<?php endif;
			the_title( '<h1 class="c-post__title entry-title">', '</h1>' );
		?>
        <div class="c-post__meta c-post__meta--date-author entry-meta s-post-meta">
			<?php
			wp_meliora_posted_on();
			esc_html_e( '|', 'wp-meliora' );
			wp_meliora_posted_by();
			?>
        </div><!-- .entry-meta -->

        <div class="c-post__thumbnail">
			<?php wp_meliora_post_thumbnail(); ?>
        </div>
    </header><!-- .entry-header -->

	<?php if ( is_singular() ): ?>
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
		<?php wp_meliora_post_tags_single(); ?>
	<?php endif; ?>
	<?php if ( get_theme_mod( 'show_share_icons', true ) == true ): ?>
        <div class="c-social-share">
			<?php
			$wp_meliora_linkedin_url = "https://www.linkedin.com/shareArticle?mini=true&url=" . get_permalink() . "&title=" . get_the_title();
			$wp_meliora_twitter_url  = "https://twitter.com/intent/tweet?url=" . get_permalink() . "&title=" . get_the_title();
			$wp_meliora_facebook_url = "https://www.facebook.com/sharer.php?u=" . get_permalink();
			?>
            <span class="c-social-share__title"><?php esc_html_e( 'Share', 'wp-meliora' ); ?></span>
            <a class="c-social-share__link" target="_blank" href="<?php echo esc_url( $wp_meliora_facebook_url ); ?>">
                <span class="dashicons dashicons-facebook-alt c-social-share__link__icon"></span>
            </a>

            <a class="c-social-share__link" target="_blank" href="<?php echo esc_url( $wp_meliora_twitter_url ); ?>">
                <span class="dashicons dashicons-twitter c-social-share__link__icon"></span>
            </a>

            <a class="c-social-share__link" target="_blank" href="<?php echo esc_url( $wp_meliora_linkedin_url ); ?>">
                <span class="dashicons dashicons-linkedin c-social-share__link__icon"></span>
            </a>

        </div>
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
