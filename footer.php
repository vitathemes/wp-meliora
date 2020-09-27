<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp_meliora
 */

?>

<footer id="colophon" class="c-footer site-footer">
    <div class="c-footer__top">
        <div class="c-footer__top__back-to-top">
            <a class="c-footer__top__back-to-top__link" href="#masthead">
                <span class="dashicons dashicons-arrow-up-alt2"></span>
            </a>
        </div>
    </div>
    <div class="c-footer__bottom site-info">
        <div class="u-default-max-width">
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'wp_meliora' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'wp_meliora' ), 'WordPress' );
				?>
            </a>
            <span class="sep"> | </span>
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Theme: %1$s by %2$s.', 'wp_meliora' ), 'WP-Meliora', '<a href="https://vitathemes.com">VitaThemes</a>' );
			?>
        </div><!-- .site-info -->
    </div>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
