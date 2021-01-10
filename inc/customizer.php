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
	wp_enqueue_script( 'wp_meliora-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), WP_MELIORA_VERSION, true );
}

add_action( 'customize_preview_init', 'wp_meliora_customize_preview_js' );


// Custom Fields
if ( function_exists( 'Kirki' ) ) {
	add_action( 'init', function () {
// Disable Kiriki help notice
		add_filter( 'kirki_telemetry', '__return_false' );


// Add config
		Kirki::add_config( 'wp-meliora', array(
			'option_type' => 'theme_mod'
		) );

		// Add Panels
		Kirki::add_panel( 'elements', array(
			'priority'    => 10,
			'title'       => esc_html__( 'Elements', 'kirki' ),
			'description' => esc_html__( 'My panel description', 'kirki' ),
		) );

// Add sections \\
// <editor-fold desc="Sections">
		// Header
		Kirki::add_section( 'header', array(
			'title'    => esc_html__( 'Header', 'wp-meliora' ),
			'panel'    => '',
			'priority' => 1,
		) );

		// Footer
		Kirki::add_section( 'footer', array(
			'title'    => esc_html__( 'Footer', 'wp-meliora' ),
			'panel'    => '',
			'priority' => 2,
		) );


// Branding
		Kirki::add_section( 'colors', array(
			'title'    => esc_html__( 'Colors', 'wp-meliora' ),
			'panel'    => '',
			'priority' => 3,
		) );


// Home Page
		Kirki::add_section( 'homepage', array(
			'title'    => esc_html__( 'Homepage', 'wp-meliora' ),
			'panel'    => '',
			'priority' => 4,
		) );

// Typography
		Kirki::add_section( 'typography', array(
			'title'      => esc_html__( 'Typography', 'wp-meliora' ),
			'panel'      => '',
			'priority'   => 4,
			'capability' => 'edit_theme_options',
		) );

// Elements
		Kirki::add_section( 'layout', array(
			'title'    => esc_html__( 'Layout', 'wp-meliora' ),
			'panel'    => '',
			'priority' => 3,
		) );

		// Posts
		Kirki::add_section( 'single_opts', array(
			'title'    => esc_html__( 'Single Options', 'wp-meliora' ),
			'panel'    => 'elements',
			'priority' => 6,
		) );

		Kirki::add_section( 'archive_opts', array(
			'title'    => esc_html__( 'Archive Options', 'wp-meliora' ),
			'panel'    => 'elements',
			'priority' => 6,
		) );

		Kirki::add_section( 'secondary_menu', array(
			'title'    => esc_html__( 'Secondary Menu', 'wp-meliora' ),
			'panel'    => 'elements',
			'priority' => 7,
		) );

		Kirki::add_section( 'socials', array(
			'title'    => esc_html__( 'Social Networks', 'wp-meliora' ),
			'panel'    => '',
			'priority' => 6,
		) );

// </editor-fold>


// Header
		Kirki::add_field( 'wp-meliora', [
			'type'     => 'toggle',
			'settings' => 'search_header',
			'label'    => esc_html__( 'Display Search', 'wp-meliora' ),
			'section'  => 'header',
			'default'  => 1,
			'priority' => 10,
		] );
// Header
		// -- Typography Fields --
		// <editor-fold desc="Typography">
		Kirki::add_field( 'wp-meliora', [
			'type'     => 'toggle',
			'settings' => 'use_google_fonts',
			'label'    => esc_html__( 'Use google Fonts', 'wp-meliora' ),
			'section'  => 'typography',
			'default'  => 1,
			'priority' => 10,
		] );

		Kirki::add_field( 'wp-meliora', [
			'active_callback' => [
				[
					'setting'  => 'use_google_fonts',
					'operator' => '==',
					'value'    => true,
				]
			],
			'type'            => 'typography',
			'settings'        => 'headings_typography',
			'label'           => esc_html__( 'Headlines', 'wp-meliora' ),
			'section'         => 'typography',
			'default'         => [
				'font-family'    => 'Roboto Mono',
				'font-size'      => '24px',
				'font-weight'    => '300',
				'line-height'    => '1.5',
				'letter-spacing' => '0'
			],
			'choices'         => [
				'fonts' => [
					'standard' => [
						'Arial',
						'sans-serif',
						'sans',
						'Helvetica',
						'Verdana',
						'Trebuchet',
						'Georgia',
						'Times New Roman',
						'Palatino',
						'Myriad Pro',
						'Lucida',
						'Gill Sans',
						'Impact',
						'monospace',
						'Tahoma'
					],
				],
			],
			'transport'       => 'auto',
			'priority'        => 10,
			'output'          => array(
				array(
					'element' => array( 'h1', '.h1' ),
				),
				array(
					'element'       => array( 'h2', '.h2' ),
					'property'      => 'font-size',
					'value_pattern' => 'calc($ - 0.3125rem)',
					'choice'        => 'font-size',
				),
				array(
					'element'       => array( 'h2', '.h2' ),
					'property'      => 'font-weight',
					'value_pattern' => '$',
					'choice'        => 'font-weight',
				),
				array(
					'element'       => array( 'h2', '.h2' ),
					'property'      => 'font-family',
					'value_pattern' => '$',
					'choice'        => 'font-family',
				),
				array(
					'element'       => array( 'h2', '.h2' ),
					'property'      => 'letter-spacing',
					'value_pattern' => '$',
					'choice'        => 'letter-spacing',
				),
				array(
					'element'       => array( 'h2', '.h2' ),
					'property'      => 'line-height',
					'value_pattern' => '$',
					'choice'        => 'line-height',
				),

				array(
					'element'       => array( 'h3', '.h3' ),
					'property'      => 'font-size',
					'value_pattern' => 'calc($ - 0.38rem)',
					'choice'        => 'font-size',
				),
				array(
					'element'       => array( 'h3', '.h3' ),
					'property'      => 'font-weight',
					'value_pattern' => '$',
					'choice'        => 'font-weight',
				),
				array(
					'element'       => array( 'h3', '.h3' ),
					'property'      => 'font-family',
					'value_pattern' => '$',
					'choice'        => 'font-family',
				),
				array(
					'element'       => array( 'h3', '.h3' ),
					'property'      => 'letter-spacing',
					'value_pattern' => '$',
					'choice'        => 'letter-spacing',
				),

				array(
					'element'       => array( 'h4', '.h4' ),
					'property'      => 'font-size',
					'value_pattern' => 'calc($ - 0.44rem)',
					'choice'        => 'font-size',
				),
				array(
					'element'       => array( 'h4', '.h4' ),
					'property'      => 'font-weight',
					'value_pattern' => '$',
					'choice'        => 'font-weight',
				),
				array(
					'element'       => array( 'h4', '.h4' ),
					'property'      => 'font-family',
					'value_pattern' => '$',
					'choice'        => 'font-family',
				),
				array(
					'element'       => array( 'h4', '.h4' ),
					'property'      => 'letter-spacing',
					'value_pattern' => '$',
					'choice'        => 'letter-spacing',
				),

				array(
					'element'       => array( 'h5', '.h5' ),
					'property'      => 'font-size',
					'value_pattern' => 'calc($ - 0.52rem)',
					'choice'        => 'font-size',
				),
				array(
					'element'       => array( 'h5', '.h5' ),
					'property'      => 'font-weight',
					'value_pattern' => '$',
					'choice'        => 'font-weight',
				),
				array(
					'element'       => array( 'h5', '.h5' ),
					'property'      => 'font-family',
					'value_pattern' => '$',
					'choice'        => 'font-family',
				),
				array(
					'element'       => array( 'h5', '.h5' ),
					'property'      => 'letter-spacing',
					'value_pattern' => '$',
					'choice'        => 'letter-spacing',
				),

				array(
					'element'       => array( 'h6', '.h6' ),
					'property'      => 'font-size',
					'value_pattern' => 'calc($ - 0.6rem)',
					'choice'        => 'font-size',
				),
				array(
					'element'       => array( 'h6', '.h6' ),
					'property'      => 'font-weight',
					'value_pattern' => '$',
					'choice'        => 'font-weight',
				),
				array(
					'element'       => array( 'h6', '.h6' ),
					'property'      => 'font-family',
					'value_pattern' => '$',
					'choice'        => 'font-family',
				),
				array(
					'element'       => array( 'h6', '.h6' ),
					'property'      => 'letter-spacing',
					'value_pattern' => '$',
					'choice'        => 'letter-spacing',
				),
			),
		] );

		Kirki::add_field( 'wp-meliora', [
			'active_callback' => [
				[
					'setting'  => 'use_google_fonts',
					'operator' => '==',
					'value'    => true,
				]
			],
			'type'            => 'typography',
			'settings'        => 'text_typography',
			'label'           => esc_html__( 'Base font', 'wp-meliora' ),
			'section'         => 'typography',
			'default'         => [
				'font-family'    => 'Roboto Mono',
				'variant'        => '300',
				'font-size'      => '16px',
				'line-height'    => '1.5',
				'letter-spacing' => '0'
				//'color'       => '#000',
			],
			'choices'         => [
				'fonts' => [
					'standard' => [
						'Arial',
						'sans-serif',
						'sans',
						'Helvetica',
						'Verdana',
						'Trebuchet',
						'Georgia',
						'Times New Roman',
						'Palatino',
						'Myriad Pro',
						'Lucida',
						'Gill Sans',
						'Impact',
						'monospace',
						'Tahoma'
					],
				],
			],
			'transport'       => 'auto',
			'priority'        => 10,
			'output'          => array(
				array(
					'element'       => 'body',
					'property'      => 'font-size',
					'value_pattern' => '$',
					'choice'        => 'font-size',
				),
				array(
					'element'       => 'body',
					'property'      => 'line-height',
					'value_pattern' => '$',
					'choice'        => 'line-height',
				),
				array(
					'element'       => 'body',
					'property'      => 'font-weight',
					'value_pattern' => '$',
					'choice'        => 'font-weight',
				),
				array(
					'element'       => 'body',
					'property'      => 'font-family',
					'value_pattern' => '$',
					'choice'        => 'font-family',
				),
				array(
					'element'       => 'body',
					'property'      => 'letter-spacing',
					'value_pattern' => '$',
					'choice'        => 'letter-spacing',
				),
			),
		] );

		Kirki::add_field( 'wp-meliora', [
			'active_callback' => [
				[
					'setting'  => 'use_google_fonts',
					'operator' => '==',
					'value'    => true,
				]
			],
			'type'            => 'typography',
			'settings'        => 'links_typography',
			'label'           => esc_html__( 'Links styles', 'wp-meliora' ),
			'section'         => 'typography',
			'default'         => [
				'font-family'    => 'Roboto Mono',
				'variant'        => '300',
				'font-size'      => '16px',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				//	'color'          => '#000',
			],
			'choices'         => [
				'fonts' => [
					'standard' => [
						'Arial',
						'sans-serif',
						'sans',
						'Helvetica',
						'Verdana',
						'Trebuchet',
						'Georgia',
						'Times New Roman',
						'Palatino',
						'Myriad Pro',
						'Lucida',
						'Gill Sans',
						'Impact',
						'monospace',
						'Tahoma'
					],
				],
			],
			'transport'       => 'auto',
			'priority'        => 10,
			'output'          => array(
				array(
					'element' => '.c-post__content__main a',
				),

			),
		] );
// </editor-fold>
		// -- Typography Fields --

// Footer
		// -- Socials --
		Kirki::add_field( 'wp-meliora', [
			'type'     => 'link',
			'settings' => 'facebook',
			'label'    => esc_html__( 'Facebook', 'wp-meliora' ),
			'section'  => 'socials',
			'priority' => 10,
		] );

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'link',
			'settings' => 'twitter',
			'label'    => esc_html__( 'Twitter', 'wp-meliora' ),
			'section'  => 'socials',
			'priority' => 10,
		] );

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'link',
			'settings' => 'instagram',
			'label'    => esc_html__( 'Instagram', 'wp-meliora' ),
			'section'  => 'socials',
			'priority' => 10,
		] );

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'link',
			'settings' => 'linkedin',
			'label'    => esc_html__( 'Linkedin', 'wp-meliora' ),
			'section'  => 'socials',
			'priority' => 10,
		] );

		// -- Socials --

		// -- Copyright --

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'toggle',
			'settings' => 'show_branding_in_footer',
			'label'    => esc_html__( 'Show site logo/title in footer', 'wp-meliora' ),
			'section'  => 'footer',
			'default'  => 1,
			'priority' => 10,
		] );

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'textarea',
			'settings' => 'copyright_text',
			'label'    => esc_html__( 'Copyright Text', 'wp-meliora' ),
			'section'  => 'footer',
			'default'  => sprintf( '%s <a href="%s" target="_blank">%s</a>.', esc_html__( 'Designed by ', 'wp-meliora' ), esc_url( 'https://vitathemes.com' ), esc_html__( 'VitaThemes', 'wp-meliora' ) ),
			'priority' => 10,
		] );
		// -- Copyright --

		// -- Branding Fields --
// <editor-fold desc="colors">

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'color',
			'settings' => 'colors_primary_color',
			'label'    => __( 'Primary Color', 'wp-meliora' ),
			'section'  => 'colors',
			'default'  => '#FFBA9D',
		] );

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'color',
			'settings' => 'headings_typography_color',
			'label'    => __( 'Heading Color (H1 - H6)', 'wp-meliora' ),
			'section'  => 'colors',
			'default'  => '#000',
		] );

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'color',
			'settings' => 'text_typography_color',
			'label'    => __( 'Font Base Color', 'wp-meliora' ),
			'section'  => 'colors',
			'default'  => '#474747',
		] );

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'multicolor',
			'settings' => 'links_colors',
			'label'    => esc_html__( 'Links Colors', 'kirki' ),
			'section'  => 'colors',
			'priority' => 10,
			'choices'  => [
				'normal' => esc_html__( 'Normal', 'kirki' ),
				'hover'  => esc_html__( 'Hover', 'kirki' ),
			],
			'default'  => [
				'normal' => '#000',
				'hover'  => '#FFBA9D',
			],
		] );

// </editor-fold>

		// -- Layout Fields --
// <editor-fold desc="colors">

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'radio-image',
			'settings' => 'site_layout',
			'label'    => __( 'Layout', 'wp-meliora' ),
			'section'  => 'layout',
			'default'  => 'left',
			'priority' => 10,
			'choices'  => [
				'left'   => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqAgMAAAAjP0ATAAAACVBMVEX///8+yP/V1dXG9YqxAAAAWElEQVR42mNgGAXDE4RCQMDAKONaBQINWqtWrWBatQDIaxg8ygYqQIAOYwC6bwHUmYNH2eBPSMhgBQXKRr0w6oVRL4x6YdQLo14Y9cKoF0a9QCO3jYLhBADvmFlNY69qsQAAAABJRU5ErkJggg==',
				'center' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqAQMAAABknzrDAAAABlBMVEX////V1dXUdjOkAAAAPUlEQVRIx2NgGAUkAcb////Y/+d/+P8AdcQoc8vhH/X/5P+j2kG+GA3CCgrwi43aMWrHqB2jdowEO4YpAACyKSE0IzIuBgAAAABJRU5ErkJggg==',
				'right'  => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqAgMAAAAjP0ATAAAACVBMVEX///8+yP/V1dXG9YqxAAAAWUlEQVR42mNgGAUjB4iGgkEIzZStAoEVTECiQWsVkLdiECkboAABOmwBF9BtUGcOImUDEiCkJCQU0ECBslEvjHph1AujXhj1wqgXRr0w6oVRLwyEF0bBUAUAz/FTNXm+R/MAAAAASUVORK5CYII=',
			],
		] );

// </editor-fold>

		// Posts
		Kirki::add_field( 'wp-meliora', [
			'type'     => 'toggle',
			'settings' => 'show_posts_thumbnail_Archive',
			'label'    => esc_html__( 'Show posts thumbnail', 'wp-meliora' ),
			'section'  => 'archive_opts',
			'default'  => 0,
			'priority' => 10,
		] );

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'toggle',
			'settings' => 'show_posts_thumbnail',
			'label'    => esc_html__( 'Show posts thumbnail', 'wp-meliora' ),
			'section'  => 'single_opts',
			'default'  => 1,
			'priority' => 10,
		] );

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'toggle',
			'settings' => 'show_share_icons',
			'label'    => esc_html__( 'Show share buttons', 'wp-meliora' ),
			'section'  => 'single_opts',
			'default'  => 1,
			'priority' => 10,
		] );

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'toggle',
			'settings' => 'show_post_date',
			'label'    => esc_html__( 'Show Published Date', 'wp-meliora' ),
			'section'  => 'single_opts',
			'default'  => 1,
			'priority' => 10,
		] );

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'toggle',
			'settings' => 'show_post_author',
			'label'    => esc_html__( 'Show Author Name', 'wp-meliora' ),
			'section'  => 'single_opts',
			'default'  => 1,
			'priority' => 10,
		] );

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'toggle',
			'settings' => 'show_tags_archive',
			'label'    => esc_html__( 'Show tags', 'wp-meliora' ),
			'section'  => 'archive_opts',
			'default'  => 1,
			'priority' => 10,
		] );

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'toggle',
			'settings' => 'show_post_excerpt',
			'label'    => esc_html__( 'Show posts excerpt', 'wp-meliora' ),
			'section'  => 'archive_opts',
			'default'  => 0,
			'priority' => 10,
		] );
		// Posts

		// Secondary Menu
		Kirki::add_field( 'wp-meliora', [
			'type'     => 'toggle',
			'settings' => 'show_slider_menu_index',
			'label'    => esc_html__( 'Show Slider Menu on Home/Blog page', 'wp-meliora' ),
			'section'  => 'secondary_menu',
			'default'  => 1,
			'priority' => 10,
		] );

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'toggle',
			'settings' => 'show_slider_menu_cats',
			'label'    => esc_html__( 'Show Slider Menu on Category pages', 'wp-meliora' ),
			'section'  => 'secondary_menu',
			'default'  => 1,
			'priority' => 10,
		] );

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'toggle',
			'settings' => 'show_slider_menu_tags',
			'label'    => esc_html__( 'Show Slider Menu on Tags pages', 'wp-meliora' ),
			'section'  => 'secondary_menu',
			'default'  => 1,
			'priority' => 10,
		] );

		Kirki::add_field( 'wp-meliora', [
			'type'     => 'toggle',
			'settings' => 'show_slider_menu_author',
			'label'    => esc_html__( 'Show Slider Menu on Author pages', 'wp-meliora' ),
			'section'  => 'secondary_menu',
			'default'  => 1,
			'priority' => 10,
		] );
		// Slider Menu
	} );


	function wp_indigo_add_edit_icons( $wp_customize ) {
		$wp_customize->selective_refresh->add_partial( 'show_slider_menu_index', array(
			'selector' => '.c-categories-list',
		) );

		$wp_customize->selective_refresh->add_partial( 'search_header', array(
			'selector' => '.c-header .c-search-form',
		) );

		$wp_customize->selective_refresh->add_partial( 'copyright_text', array(
			'selector' => '.c-footer__copyright',
		) );

		$wp_customize->selective_refresh->add_partial( 'facebook', array(
			'selector' => '.c-footer__socials',
		) );

		$wp_customize->selective_refresh->add_partial( 'show_posts_thumbnail', array(
			'selector' => '.c-post__thumbnail',
		) );

		$wp_customize->selective_refresh->add_partial( 'show_post_date', array(
			'selector' => '.c-post--single .c-post__meta__date',
		) );

		$wp_customize->selective_refresh->add_partial( 'show_post_author', array(
			'selector' => '.byline .author',
		) );

		$wp_customize->selective_refresh->add_partial( 'show_share_icons', array(
			'selector' => '.c-social-share',
		) );
	}

	add_action( 'customize_preview_init', 'wp_indigo_add_edit_icons' );
}
