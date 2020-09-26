<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Digital_Interface
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
<div id="page" class="o-page site is-sidebar-content">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'digital_interface' ); ?></a>

    <header id="masthead" class="c-header site-header">
        <div class="c-header__main u-default-max-width">
            <div class="c-header__branding">
				<?php
				digital_interface_branding();
				?>
            </div><!-- .site-branding -->

            <nav id="site-navigation" class="c-header__navigation main-navigation">
                <button class="c-header__navigation__toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="dashicons dashicons-menu-alt"></span></button>
				<?php
				if ( has_nav_menu( 'menu-1' ) ) {
					wp_nav_menu(
						array(
							'walker'         => new Di_walker_nav_menu(),
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'container'      => ''
						)
					);
				}
				?>
            </nav><!-- #site-navigation -->
			<?php get_search_form(); ?>
        </div>
    </header><!-- #masthead -->
