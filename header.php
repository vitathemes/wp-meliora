<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
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
<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
} else {
	do_action( 'wp_body_open' );
}
?>
<div id="page" class="o-page site <?php wp_meliora_site_layout_class(); ?>">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wp-meliora' ); ?></a>
    <header id="masthead" class="c-header site-header">
        <div class="c-header__main u-default-max-width">
            <div class="c-header__branding">
				<?php
				wp_meliora_branding();
				?>
            </div><!-- .site-branding -->

            <nav id="site-navigation" class="c-header__navigation main-navigation">
                <button aria-label="<?php esc_attr_e('Toggle menu', 'wp-meliora'); ?>" class="c-header__navigation__toggle js-menu-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="dashicons dashicons-menu-alt"></span></button>
				<?php
				if ( has_nav_menu( 'menu-1' ) ) {
					wp_nav_menu(
						array(
							'walker'         => new Wp_meliora_walker_nav_menu(),
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'menu js-primary-menu',
							'container'      => ''
						)
					);
				}
				?>
            </nav><!-- #site-navigation -->
			<?php
			if ( get_theme_mod( 'search_header', true ) ) {
				get_search_form();
			}
			?>
        </div>
    </header><!-- #masthead -->
