<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Digital_Interface
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function digital_interface_body_classes( $classes ) {
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

add_filter( 'body_class', 'digital_interface_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function digital_interface_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'digital_interface_pingback_header' );

function digital_interface_branding() {
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
            <p class="c-header__branding__title site-title">
                <a class="c-header__branding__title__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            </p>
		<?php
		endif;
	}
}

function digital_interface_typography() {
	$digital_interface_text_typography            = get_theme_mod( 'text_typography' );
	$digital_interface_heading_typography         = get_theme_mod( 'headings_typography' );
	$digital_interface_default_heading_typography = array(
		'font-family'    => "Roboto Mono",
		'font-size'      => "24px",
		'variant'        => '400',
		'line-height'    => '1.5',
		'color'          => '#474747',
		'letter-spacing' => '0.05em'
	);
	$digital_interface_text_typography            = array(
		'font-family'    => "Roboto Mono",
		'font-size'      => "16px",
		'variant'        => '300',
		'line-height'    => '1.5',
		'color'          => '#474747',
		'letter-spacing' => '0.05em'
	);

	if ( empty( $digital_interface_heading_typography ) || $digital_interface_heading_typography['font-family'] == "" || $digital_interface_heading_typography['font-size'] == "" || $digital_interface_heading_typography['variant'] == "" ) {
		$digital_interface_heading_typography = $digital_interface_default_heading_typography;
	} else {
		$digital_interface_heading_typography = array_merge( $digital_interface_default_heading_typography, $digital_interface_heading_typography );
	}
	if ( empty( $digital_interface_text_typography ) ) {
		$digital_interface_text_typography = $digital_interface_text_typography;
	} else {
		$digital_interface_text_typography = array_merge( $digital_interface_text_typography, $digital_interface_text_typography );
	}

	//if ( get_theme_mod( 'theme_mode', 'light' ) == 'dark' ) {
	if ( get_theme_mod( 'headings_typography_color' ) == "" ) {
		$digital_interface_tertiary_color = "#FFFFFF";
	} else {
		$digital_interface_tertiary_color = get_theme_mod( 'headings_typography_color', '#FFFFFF' );
	}
	if ( get_theme_mod( 'text_typography_color' ) == "" ) {
		$digital_interface_secondary_color = "#CCCCCC";
	} else {
		$digital_interface_secondary_color = get_theme_mod( 'text_typography_color', '#CCCCCC' );
	}
	//}

	//if ( get_theme_mod( 'theme_mode', 'light' ) == 'light' ) {
	if ( get_theme_mod( 'headings_typography_color' ) == "" ) {
		$digital_interface_tertiary_color = "#474747";
	} else {
		$digital_interface_tertiary_color = get_theme_mod( 'headings_typography_color' );
	}
	if ( get_theme_mod( 'text_typography_color' ) == "" ) {
		$digital_interface_secondary_color = "#474747";
	} else {
		$digital_interface_secondary_color = get_theme_mod( 'text_typography_color' );
	}
	//}

	$html = ':root {
				--heading-typography-font-size: ' . $digital_interface_heading_typography["font-size"] . ';
	            --heading-typography-font-family: ' . $digital_interface_heading_typography["font-family"] . ';
	            --heading-typography-line-height: ' . $digital_interface_heading_typography["line-height"] . ';
	            --heading-typography-variant: ' . $digital_interface_heading_typography["variant"] . ';
	            --heading-typography-letter-spacing: ' . $digital_interface_heading_typography["letter-spacing"] . ';
	            --text-typography-font-size: ' . $digital_interface_text_typography["font-size"] . ';
	            --text-typography-font-family: ' . $digital_interface_text_typography["font-family"] . ';
	            --text-typography-line-height: ' . $digital_interface_text_typography["line-height"] . ';
	            --text-typography-variant: ' . $digital_interface_text_typography["variant"] . ';
	            --text-typography-letter-spacing: ' . $digital_interface_text_typography["letter-spacing"] . ';
	
	            --primary-color: ' . get_theme_mod( "branding_primary_color", "#FFBA9D" ) . ';
	            --secondary-color: ' . $digital_interface_secondary_color . ';
	            --tertiary-color: ' . $digital_interface_tertiary_color . ';
			}';

	return $html;
}

add_action( 'admin_head', 'digital_interface_theme_settings' );
add_action( 'wp_head', 'digital_interface_theme_settings' );
function digital_interface_theme_settings() {
	$digital_interface_theme_typography   = digital_interface_typography();
	?>
    <style>
        <?php echo $digital_interface_theme_typography; ?>
    </style>
	<?php
}


function digital_interface_enqueue_fonts() {
	$digital_interface_text_typography    = get_theme_mod( 'text_typography' );
	$digital_interface_heading_typography = get_theme_mod( 'headings_typography' );

	if ( $digital_interface_heading_typography['font-family'] ) {
		wp_enqueue_style( 'digital-interface-headings-fonts', '//fonts.googleapis.com/css2?family=' . $digital_interface_heading_typography['font-family'] . ':wght@' . $digital_interface_heading_typography['font-weight'] );
	} else {
		wp_enqueue_style( 'digital-interface-headings-fonts', '//fonts.googleapis.com/css2?family=Roboto+Mono:wght@400' );
	}
	if ( $digital_interface_text_typography['font-family'] ) {
		wp_enqueue_style( 'digital-interface-body-font', '//fonts.googleapis.com/css2?family=' . $digital_interface_text_typography['font-family'] . ':wght@' . $digital_interface_text_typography['font-weight'] );
	} else {
		wp_enqueue_style( 'digital-interface-headings-fonts', '//fonts.googleapis.com/css2?family=Roboto+Mono:wght@300' );
	}
}

add_action( 'wp_head', 'digital_interface_enqueue_fonts' );
add_action( 'admin_head', 'digital_interface_enqueue_fonts' );
