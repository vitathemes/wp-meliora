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
            <a aria-label="Back to Top" class="c-footer__top__back-to-top__link" href="#masthead">
                <span class="dashicons dashicons-arrow-up-alt2"></span>
            </a>
        </div>
    </div>
    <div class="c-footer__bottom site-info">
        <div class="u-default-max-width">
            <div class="c-footer__grid">
                <div class="c-footer__copyright">
	                <?php if ( get_theme_mod( 'show_branding_in_footer', true ) ) : ?>
                        <div class="c-footer__branding s-footer-branding">
                            <?php wp_meliora_branding(true); ?>
                        </div>
	                <?php endif; ?>
                    <p>
					<?php $allowed_html = [
						'a'      => [
							'href'  => [],
							'title' => [],
						],
						'br'     => [],
						'em'     => [],
						'strong' => [],
						'p'      => [],
					];
					echo wp_kses( get_theme_mod( 'copyright_text', sprintf( '</span>%s <a href="%s" class="customize-unpreviewable">%s</a>.', esc_html__( 'Designed by ', 'wp-meliora' ), esc_url( 'https://vitathemes.com' ), esc_html__( 'VitaThemes', 'wp-meliora' ) ) ), $allowed_html );
					?>
                    </p>
                </div>
                <?php wp_meliora_footer_socials(); ?>
            </div>
        </div><!-- .site-info -->
    </div>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
