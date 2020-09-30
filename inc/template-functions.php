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

function wp_meliora_branding() {
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
	$wp_meliora_text_typography            = get_theme_mod( 'text_typography' );
	$wp_meliora_heading_typography         = get_theme_mod( 'headings_typography' );
	$wp_meliora_default_heading_typography = array(
		'font-family'    => "Roboto Mono",
		'font-size'      => "24px",
		'variant'        => '400',
		'line-height'    => '1.5',
		'color'          => '#474747',
		'letter-spacing' => '0.05em'
	);
	$wp_meliora_text_typography            = array(
		'font-family'    => "Roboto Mono",
		'font-size'      => "16px",
		'variant'        => '300',
		'line-height'    => '1.5',
		'color'          => '#474747',
		'letter-spacing' => '0.05em'
	);

	if ( empty( $wp_meliora_heading_typography )) {
		$wp_meliora_heading_typography = $wp_meliora_default_heading_typography;
	} else {
		$wp_meliora_heading_typography = array_merge( $wp_meliora_default_heading_typography, $wp_meliora_heading_typography );
	}
	if ( empty( $wp_meliora_text_typography ) ) {
		$wp_meliora_text_typography = $wp_meliora_text_typography;
	} else {
		$wp_meliora_text_typography = array_merge( $wp_meliora_text_typography, $wp_meliora_text_typography );
	}

	//if ( get_theme_mod( 'theme_mode', 'light' ) == 'dark' ) {
	if ( get_theme_mod( 'headings_typography_color' ) == "" ) {
		$wp_meliora_tertiary_color = "#FFFFFF";
	} else {
		$wp_meliora_tertiary_color = get_theme_mod( 'headings_typography_color', '#FFFFFF' );
	}
	if ( get_theme_mod( 'text_typography_color' ) == "" ) {
		$wp_meliora_secondary_color = "#CCCCCC";
	} else {
		$wp_meliora_secondary_color = get_theme_mod( 'text_typography_color', '#CCCCCC' );
	}
	//}

	//if ( get_theme_mod( 'theme_mode', 'light' ) == 'light' ) {
	if ( get_theme_mod( 'headings_typography_color' ) == "" ) {
		$wp_meliora_tertiary_color = "#474747";
	} else {
		$wp_meliora_tertiary_color = get_theme_mod( 'headings_typography_color' );
	}
	if ( get_theme_mod( 'text_typography_color' ) == "" ) {
		$wp_meliora_secondary_color = "#474747";
	} else {
		$wp_meliora_secondary_color = get_theme_mod( 'text_typography_color' );
	}
	if ( get_theme_mod( 'secondary_typography_color' ) == "" ) {
		$wp_meliora_quaternary_color = "#8A8A8A";
	} else {
		$wp_meliora_quaternary_color = get_theme_mod( 'text_typography_color' );
	}
	//}

	$html = ':root {
				--heading-typography-font-size: ' . $wp_meliora_heading_typography["font-size"] . ';
	            --heading-typography-font-family: ' . $wp_meliora_heading_typography["font-family"] . ';
	            --heading-typography-line-height: ' . $wp_meliora_heading_typography["line-height"] . ';
	            --heading-typography-variant: ' . $wp_meliora_heading_typography["variant"] . ';
	            --heading-typography-letter-spacing: ' . $wp_meliora_heading_typography["letter-spacing"] . ';
	            --text-typography-font-size: ' . $wp_meliora_text_typography["font-size"] . ';
	            --text-typography-font-family: ' . $wp_meliora_text_typography["font-family"] . ';
	            --text-typography-line-height: ' . $wp_meliora_text_typography["line-height"] . ';
	            --text-typography-variant: ' . $wp_meliora_text_typography["variant"] . ';
	            --text-typography-letter-spacing: ' . $wp_meliora_text_typography["letter-spacing"] . ';
	
	            --primary-color: ' . get_theme_mod( "branding_primary_color", "#FFBA9D" ) . ';
	            --secondary-color: ' . $wp_meliora_secondary_color . ';
	            --tertiary-color: ' . $wp_meliora_tertiary_color . ';
	            --quaternary-color: ' . $wp_meliora_quaternary_color . ';
			}';

	return $html;
}

add_action( 'admin_head', 'wp_meliora_theme_settings' );
add_action( 'wp_head', 'wp_meliora_theme_settings' );
function wp_meliora_theme_settings() {
	$wp_meliora_theme_typography   = wp_meliora_typography();
	?>
    <style>
        <?php echo esc_html($wp_meliora_theme_typography); ?>
    </style>
	<?php
}


function wp_meliora_enqueue_fonts() {
	$wp_meliora_text_typography    = get_theme_mod( 'text_typography' );
	$wp_meliora_heading_typography = get_theme_mod( 'headings_typography' );

	if ( $wp_meliora_heading_typography['font-family'] ) {
		wp_enqueue_style( 'wp-meliora-headings-fonts', '//fonts.googleapis.com/css2?family=' . $wp_meliora_heading_typography['font-family'] . ':wght@' . $wp_meliora_heading_typography['font-weight'] );
	} else {
		wp_enqueue_style( 'wp-meliora-headings-fonts', '//fonts.googleapis.com/css2?family=Roboto+Mono:wght@400' );
	}
	if ( $wp_meliora_text_typography['font-family'] ) {
		wp_enqueue_style( 'wp-meliora-body-font', '//fonts.googleapis.com/css2?family=' . $wp_meliora_text_typography['font-family'] . ':wght@' . $wp_meliora_text_typography['font-weight'] );
	} else {
		wp_enqueue_style( 'wp-meliora-headings-fonts', '//fonts.googleapis.com/css2?family=Roboto+Mono:wght@300' );
	}
}

add_action( 'wp_head', 'wp_meliora_enqueue_fonts' );
add_action( 'admin_head', 'wp_meliora_enqueue_fonts' );
