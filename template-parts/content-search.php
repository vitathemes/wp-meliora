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
    <header class="c-post__header entry-header">
		<?php
		if ( 'post' === get_post_type() ) :
			?>
            <div class="c-post__meta entry-meta">
				<?php
				do_action('wp_meliora_post_meta_area');
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

	<?php do_action('wp_meliora_archive_post_tags_area'); ?>

</article><!-- #post-<?php the_ID(); ?> -->
