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
          <div class="c-footer__grid">
              <div class="c-footer__copyright">
                  <?php echo get_theme_mod('copyright_text', '<a href="https://wordpress.org/" class="customize-unpreviewable">Proudly powered by WordPress</a><span class="sep"> | </span>Theme: WP-Meliora by <a href="https://vitathemes.com" class="customize-unpreviewable">VitaThemes</a>.'); ?>
              </div>
              <div class="c-footer__socials s-footer-socials">
                  <?php wp_meliora_socials_links(); ?>
              </div>
          </div>
        </div><!-- .site-info -->
    </div>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
