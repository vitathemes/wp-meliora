<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package wp_meliora
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function wp_meliora_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter( 'body_class', 'wp_meliora_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wp_meliora_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'wp_meliora_pingback_header' );

function wp_meliora_branding( $is_footer = false ) {
	if ( $is_footer ) {
		if ( has_custom_logo() ) {
			the_custom_logo();
		} else { ?>
            <a class="c-footer__branding__title h1" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		<?php }

		return;
	}
	if ( has_custom_logo() ) {
		the_custom_logo();
	} else {
		if ( is_front_page() && is_home() ) :
			?>
            <h1 class="c-header__branding__title site-title">
                <a class="c-header__branding__title__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            </h1>
		<?php
		else :
			?>
            <p class="c-header__branding__title site-title h1">
                <a class="c-header__branding__title__link h1" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            </p>
		<?php
		endif;
	}
}

function wp_meliora_typography() {

	$wp_meliora_heading_color    = get_theme_mod( 'headings_typography_color', '#474747' );
	$wp_meliora_base_font_color  = get_theme_mod( 'text_typography_color', '#777777' );

	$defaults                = array(
		'normal' => '#0088cc',
		'hover'  => '#00aaff',
	);
	$wp_meliora_links_colors = get_theme_mod( 'links_colors', $defaults );

	$html = ':root {	
	            --primary-color: ' . get_theme_mod( "branding_primary_color", "#FFBA9D" ) . ';
	            --base-font-color: ' . $wp_meliora_base_font_color . ';
	            --heading-color: ' . $wp_meliora_heading_color . ';
	            
	            --link-normal-color: ' . $wp_meliora_links_colors['normal'] . ' ;
	            --link-hover-color: ' . $wp_meliora_links_colors['hover'] . ' ;
			}';

	return $html;
}

add_action( 'admin_head', 'wp_meliora_theme_settings' );
add_action( 'wp_head', 'wp_meliora_theme_settings' );

function wp_meliora_theme_settings() {
	$wp_meliora_theme_typography = wp_meliora_typography();

	?>
    <style>
        <?php echo esc_html($wp_meliora_theme_typography); ?>
    </style>
	<?php
}
