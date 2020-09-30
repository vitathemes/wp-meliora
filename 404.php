<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package wp_meliora
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<main id="primary" class="site-main">
    <div class="site-main__container default-max-width">
        <div class="c-header--404">
            <div class="c-header__branding">
				<?php
				wp_meliora_branding();
				?>
            </div><!-- .site-branding -->
        </div>
        <section class="error-404 not-found">
            <div>
                <span class="not-found__error"><?php esc_html_e( '404', 'wp-meliora' ); ?></span>
            </div>
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'Page not found - 404', 'wp-meliora' ); ?></h1>
            </header><!-- .page-header -->
            <div class="page-content">
                <p><?php esc_html_e( 'This page not found (deleted or never exists). try a phrase in search box or back to home and start again.', 'wp-meliora' ); ?></p>
                <div class="not-found__actions">
                    <a href="<?php echo site_url(); ?>" class="not-found__actions__link"><?php esc_html_e( 'Take me home', 'wp-meliora' ); ?>
                        <span class="dashicons dashicons-arrow-right-alt2"></span></a>
                </div>
				<?php
				get_search_form();
				?>

            </div><!-- .page-content -->
        </section><!-- .error-404 -->
    </div>
</main><!-- #main -->

<?php wp_footer(); ?>

</body>
</html>
