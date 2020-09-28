<?php
/**
 * Digital Interface Theme Customizer
 *
 * @package wp_meliora
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wp_meliora_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'wp_meliora_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'wp_meliora_customize_partial_blogdescription',
			)
		);
	}
}

add_action( 'customize_register', 'wp_meliora_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wp_meliora_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wp_meliora_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wp_meliora_customize_preview_js() {
	wp_enqueue_script( 'wp_meliora-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}

add_action( 'customize_preview_init', 'wp_meliora_customize_preview_js' );


// Custom Fields

add_action( 'init', function () {
// Disable Kiriki help notice
	add_filter( 'kirki_telemetry', '__return_false' );


// Add config
	Kirki::add_config( 'wp_meliora', array(
		'option_type' => 'theme_mod'
	) );

// Add sections \\
// <editor-fold desc="Sections">
// Branding
	Kirki::add_section( 'branding', array(
		'title'    => esc_html__( 'Branding', 'wp_meliora' ),
		'panel'    => '',
		'priority' => 3,
	) );


// Home Page
	Kirki::add_section( 'homepage', array(
		'title'    => esc_html__( 'Homepage', 'wp_meliora' ),
		'panel'    => '',
		'priority' => 4,
	) );

	// Home Page
	Kirki::add_section( 'blogpage', array(
		'title'    => esc_html__( 'Blog Settings', 'wp_meliora' ),
		'panel'    => '',
		'priority' => 4,
	) );

// Typography
	Kirki::add_section( 'typography', array(
		'title'    => esc_html__( 'Typography', 'wp_meliora' ),
		'panel'    => '',
		'priority' => 4,
	) );

// Elements
	Kirki::add_section( 'elements', array(
		'title'    => esc_html__( 'Elements', 'wp_meliora' ),
		'panel'    => '',
		'priority' => 5,
	) );

	// Header
	Kirki::add_section( 'header', array(
		'title'    => esc_html__( 'Header', 'wp_meliora' ),
		'panel'    => '',
		'priority' => 6,
	) );


// Footer
	Kirki::add_panel( 'footer', array(
		'priority'    => 10,
		'title'       => esc_html__( 'Footer', 'kirki' ),
	) );


	Kirki::add_section( 'socials', array(
		'title'    => esc_html__( 'Socials', 'wp_meliora' ),
		'panel'    => 'footer',
		'priority' => 6,
	) );

	Kirki::add_section( 'copyright', array(
		'title'    => esc_html__( 'Copyright', 'wp_meliora' ),
		'panel'    => 'footer',
		'priority' => 6,
	) );

// </editor-fold>


// Header
	Kirki::add_field( 'wp_meliora', [
		'type'     => 'toggle',
		'settings' => 'search_icon_header',
		'label'    => esc_html__( 'Search Icon', 'wp_meliora' ),
		'section'  => 'header',
		'default'  => 1,
		'priority' => 10,
	] );
// Header
	// -- Typography Fields --
	// <editor-fold desc="Typography">
	Kirki::add_field( 'wp_meliora', [
		'type'      => 'typography',
		'settings'  => 'headings_typography',
		'label'     => esc_html__( 'Headlines', 'wp_meliora' ),
		'section'   => 'typography',
		'default'   => [
			'font-family'    => 'Roboto Mono',
			'font-size'      => '24px',
			'variant'        => 'regular',
			'line-height'    => '1.5',
			'letter-spacing' => '0'
		],
		'transport' => 'auto',
		'priority'  => 10,
		'output'    => array(
			array(
				'element' => 'h1',
			),
			array(
				'element' => '.h1',
			),
			array(
				'element'       => 'h2',
				'property'      => 'font-size',
				'value_pattern' => 'calc($ - 0.5em)',
				'choice'        => 'font-size',
			),
			array(
				'element'       => 'h2',
				'property'      => 'font-weight',
				'value_pattern' => '$',
				'choice'        => 'variant',
			),
			array(
				'element'       => 'h2',
				'property'      => 'font-family',
				'value_pattern' => '$',
				'choice'        => 'font-family',
			),
			array(
				'element'       => 'h2',
				'property'      => 'letter-spacing',
				'value_pattern' => '$',
				'choice'        => 'letter-spacing',
			),

			array(
				'element'       => '.h2',
				'property'      => 'font-size',
				'value_pattern' => 'calc($ - 0.5em)',
				'choice'        => 'font-size',
			),
			array(
				'element'       => '.h2',
				'property'      => 'font-weight',
				'value_pattern' => '$',
				'choice'        => 'variant',
			),
			array(
				'element'       => '.h2',
				'property'      => 'font-family',
				'value_pattern' => '$',
				'choice'        => 'font-family',
			),
			array(
				'element'       => '.h2',
				'property'      => 'letter-spacing',
				'value_pattern' => '$',
				'choice'        => 'letter-spacing',
			),

			array(
				'element'       => 'h3',
				'property'      => 'font-size',
				'value_pattern' => 'calc($ - 0.75em)',
				'choice'        => 'font-size',
			),
			array(
				'element'       => 'h3',
				'property'      => 'font-weight',
				'value_pattern' => '$',
				'choice'        => 'variant',
			),
			array(
				'element'       => 'h3',
				'property'      => 'font-family',
				'value_pattern' => '$',
				'choice'        => 'font-family',
			),
			array(
				'element'       => 'h3',
				'property'      => 'letter-spacing',
				'value_pattern' => '$',
				'choice'        => 'letter-spacing',
			),

			array(
				'element'       => '.h3',
				'property'      => 'font-size',
				'value_pattern' => 'calc($ - 0.75em)',
				'choice'        => 'font-size',
			),
			array(
				'element'       => '.h3',
				'property'      => 'font-weight',
				'value_pattern' => '$',
				'choice'        => 'variant',
			),
			array(
				'element'       => '.h3',
				'property'      => 'font-family',
				'value_pattern' => '$',
				'choice'        => 'font-family',
			),
			array(
				'element'       => '.h3',
				'property'      => 'letter-spacing',
				'value_pattern' => '$',
				'choice'        => 'letter-spacing',
			),

			array(
				'element'       => 'h4',
				'property'      => 'font-size',
				'value_pattern' => 'calc($ - 0.5208‬‬em)',
				'choice'        => 'font-size',
			),
			array(
				'element'       => 'h4',
				'property'      => 'font-weight',
				'value_pattern' => '$',
				'choice'        => 'variant',
			),
			array(
				'element'       => 'h4',
				'property'      => 'font-family',
				'value_pattern' => '$',
				'choice'        => 'font-family',
			),
			array(
				'element'       => 'h4',
				'property'      => 'letter-spacing',
				'value_pattern' => '$',
				'choice'        => 'letter-spacing',
			),

			array(
				'element'       => '.h4',
				'property'      => 'font-size',
				'value_pattern' => 'calc($ - 0.5208‬em‬)',
				'choice'        => 'font-size',
			),
			array(
				'element'       => '.h4',
				'property'      => 'font-weight',
				'value_pattern' => '$',
				'choice'        => 'variant',
			),
			array(
				'element'       => '.h4',
				'property'      => 'font-family',
				'value_pattern' => '$',
				'choice'        => 'font-family',
			),
			array(
				'element'       => '.h4',
				'property'      => 'letter-spacing',
				'value_pattern' => '$',
				'choice'        => 'letter-spacing',
			),

			array(
				'element'       => 'h5',
				'property'      => 'font-size',
				'value_pattern' => 'calc($ - 1.25em)',
				'choice'        => 'font-size',
			),
			array(
				'element'       => 'h5',
				'property'      => 'font-weight',
				'value_pattern' => '$',
				'choice'        => 'variant',
			),
			array(
				'element'       => 'h5',
				'property'      => 'font-family',
				'value_pattern' => '$',
				'choice'        => 'font-family',
			),
			array(
				'element'       => 'h5',
				'property'      => 'letter-spacing',
				'value_pattern' => '$',
				'choice'        => 'letter-spacing',
			),

			array(
				'element'       => '.h5',
				'property'      => 'font-size',
				'value_pattern' => 'calc($ - 1.25em)',
				'choice'        => 'font-size',
			),
			array(
				'element'       => '.h5',
				'property'      => 'font-weight',
				'value_pattern' => '$',
				'choice'        => 'variant',
			),
			array(
				'element'       => '.h5',
				'property'      => 'font-family',
				'value_pattern' => '$',
				'choice'        => 'font-family',
			),
			array(
				'element'       => '.h5',
				'property'      => 'letter-spacing',
				'value_pattern' => '$',
				'choice'        => 'letter-spacing',
			),

			array(
				'element'       => 'h6',
				'property'      => 'font-size',
				'value_pattern' => 'calc($ - 1.5em)',
				'choice'        => 'font-size',
			),
			array(
				'element'       => 'h6',
				'property'      => 'font-weight',
				'value_pattern' => '$',
				'choice'        => 'variant',
			),
			array(
				'element'       => 'h6',
				'property'      => 'font-family',
				'value_pattern' => '$',
				'choice'        => 'font-family',
			),
			array(
				'element'       => 'h6',
				'property'      => 'letter-spacing',
				'value_pattern' => '$',
				'choice'        => 'letter-spacing',
			),

			array(
				'element'       => '.h6',
				'property'      => 'font-size',
				'value_pattern' => 'calc($ - 1.5em)',
				'choice'        => 'font-size',
			),
			array(
				'element'       => '.h6',
				'property'      => 'font-weight',
				'value_pattern' => '$',
				'choice'        => 'variant',
			),
			array(
				'element'       => '.h6',
				'property'      => 'font-family',
				'value_pattern' => '$',
				'choice'        => 'font-family',
			),
			array(
				'element'       => '.h6',
				'property'      => 'letter-spacing',
				'value_pattern' => '$',
				'choice'        => 'letter-spacing',
			),

		),
	] );

	Kirki::add_field( 'wp_meliora', [
		'type'     => 'color',
		'settings' => 'headings_typography_color',
		'label'    => __( 'Headings Color', 'wp_meliora' ),
		'section'  => 'typography',
		'default'  => '#000',
	] );

	Kirki::add_field( 'wp_meliora', [
		'type'      => 'typography',
		'settings'  => 'text_typography',
		'label'     => esc_html__( 'Texts', 'wp_meliora' ),
		'section'   => 'typography',
		'default'   => [
			'font-family'    => 'Roboto Mono',
			'variant'        => '300',
			'font-size'      => '16px',
			'line-height'    => '1.6',
			'letter-spacing' => '0'
			//'color'       => '#000',
		],
		'transport' => 'auto',
		'priority'  => 10,
		'output'    => array(
			array(
				'element' => 'body',
			),
		),
	] );

	Kirki::add_field( 'wp_meliora', [
		'type'     => 'color',
		'settings' => 'text_typography_color',
		'label'    => __( 'Text Color', 'wp_meliora' ),
		'section'  => 'typography',
		'default'  => '#565656',
	] );
// </editor-fold>
	// -- Typography Fields --

// Footer
	// -- Socials --
	Kirki::add_field( 'wp_meliora', [
		'type'     => 'link',
		'settings' => 'facebook',
		'label'    => esc_html__( 'Facebook', 'wp_meliora' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_meliora', [
		'type'     => 'link',
		'settings' => 'twitter',
		'label'    => esc_html__( 'Twitter', 'wp_meliora' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_meliora', [
		'type'     => 'link',
		'settings' => 'instagram',
		'label'    => esc_html__( 'Instagram', 'wp_meliora' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_meliora', [
		'type'     => 'link',
		'settings' => 'linkedin',
		'label'    => esc_html__( 'Linkedin', 'wp_meliora' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	// -- Socials --

	// -- Copyright --
	Kirki::add_field( 'wp_meliora', [
		'type'     => 'editor',
		'settings' => 'copyright_text',
		'label'    => esc_html__( 'Copyright Text', 'wp_meliora' ),
		'section'  => 'copyright',
		'default' => '<a href="https://wordpress.org/" class="customize-unpreviewable">Proudly powered by WordPress</a><span class="sep"> | </span>Theme: WP-Meliora by <a href="https://vitathemes.com" class="customize-unpreviewable">VitaThemes</a>.',
		'priority' => 10,
	] );
	// -- Copyright --

	// -- Branding Fields --
// <editor-fold desc="branding">

	Kirki::add_field( 'wp-manifest', [
		'type'     => 'color',
		'settings' => 'branding_primary_color',
		'label'    => __( 'Primary Color', 'wp-manifest' ),
		'section'  => 'branding',
		'default'  => '#FFBA9D',
	] );

// </editor-fold>
} );
