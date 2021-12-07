<?php
/**
 * Digital Interface functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wp_meliora
 */

if ( ! defined( 'WP_MELIORA_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	$wp_meliora_theme_data = wp_get_theme();
	define( 'WP_MELIORA_VERSION', $wp_meliora_theme_data->get( 'Version' ));
}

if ( ! function_exists( 'wp_meliora_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wp_meliora_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Digital Interface, use a find and replace
		 * to change 'wp-meliora' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wp-meliora', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'wp-meliora' ),
				'menu-2' => esc_html__( 'Secondary', 'wp-meliora' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		//add_theme_support( 'custom-background' );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 50,
				'width'       => 100,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'wp_meliora_setup' );

if ( ! function_exists( 'wp_meliora_content_width' ) ) {
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function wp_meliora_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'wp_meliora_content_width', 1120 );
	}
}
add_action( 'after_setup_theme', 'wp_meliora_content_width', 0 );

if ( ! function_exists( 'wp_meliora_widgets_init' ) ) {
	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function wp_meliora_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'wp-meliora' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', 'wp-meliora' ),
				'before_widget' => '<div id="%1$s" class="c-widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="c-widget__title widget-title h1">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer #1', 'wp-meliora' ),
				'id'            => 'sidebar-2',
				'description'   => esc_html__( 'Add widgets here.', 'wp-meliora' ),
				'before_widget' => '<div id="%1$s" class="c-widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="c-widget__title widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer #2', 'wp-meliora' ),
				'id'            => 'sidebar-3',
				'description'   => esc_html__( 'Add widgets here.', 'wp-meliora' ),
				'before_widget' => '<div id="%1$s" class="c-widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="c-widget__title widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
}
add_action( 'widgets_init', 'wp_meliora_widgets_init' );


if ( ! function_exists( 'wp_meliora_scripts' ) ) {
	/**
	 * Enqueue scripts and styles.
	 */
	function wp_meliora_scripts() {
		wp_enqueue_style( 'wp_meliora-style', get_stylesheet_uri(), array(), WP_MELIORA_VERSION );
		wp_style_add_data( 'wp_meliora-style', 'rtl', 'replace' );
		wp_enqueue_style( 'dashicons' );
		wp_enqueue_script( 'wp_meliora-navigation',
			get_template_directory_uri() . '/js/navigation.js',
			array(),
			WP_MELIORA_VERSION,
			true );
		wp_enqueue_script( 'wp_meliora-carousel',
			get_template_directory_uri() . '/js/vendor.min.js',
			array(),
			WP_MELIORA_VERSION,
			true );
		wp_enqueue_script( 'wp_meliora-main',
			get_template_directory_uri() . '/js/main.js',
			array( 'wp_meliora-carousel' ),
			WP_MELIORA_VERSION,
			true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'wp_meliora_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Hooks
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Nav menu walker
 */
require get_template_directory() . '/classes/class_wp_meliora_walker_nav_menu.php';

/**
 * Comments walker
 */
require get_template_directory() . '/classes/class_wp_meliora_walker_comment.php';

/**
 * Load TGMPA file
 */
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/tgmpa-config.php';


// OCDI - Demo Importer Config
function wp_meliora_register_plugins( $plugins ) {
	$theme_plugins = [
		[
			'name'     => __( 'Kirki Customizer Framework', 'wp-indigo' ),
			'slug'     => 'kirki',
			'required' => false,
		]
	];

	return array_merge( $plugins, $theme_plugins );
}
add_filter( 'ocdi/register_plugins', 'wp_meliora_register_plugins' );


function wp_meliora_import_files() {
	return [
		[
			'import_file_name'           => 'Default Demo',
			'import_file_url'            => 'https://demo.vitathemes.com/ocdi/meliora/meliora.xml',
			'import_widget_file_url'     => 'https://demo.vitathemes.com/ocdi/meliora/meliora-widgets.wie',
			'import_customizer_file_url' => 'https://demo.vitathemes.com/ocdi/meliora/meliora-customizer.dat',
			'import_preview_image_url'   => 'https://demo.vitathemes.com/ocdi/meliora/screenshot.png',
			'preview_url'                => 'https://demo.vitathemes.com/meliora',
		],
	];
}
add_filter( 'ocdi/import_files', 'wp_meliora_import_files' );

function wp_meliora_after_import_setup() {
	// Assign menus to their locations.
	$primary_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
	$slider_menu = get_term_by( 'name', 'Slider-Menu', 'nav_menu' );
	set_theme_mod( 'nav_menu_locations', [
			'menu-1' => $primary_menu->term_id,
			'menu-2' => $slider_menu->term_id,
		]
	);

	// Unset Logo
	set_theme_mod( 'custom_logo', 0);

	// Social Networks
	set_theme_mod( 'facebook', '#' );
	set_theme_mod( 'twitter', 'https://twitter.com/veronalabs' );
	set_theme_mod( 'instagram', 'https://www.instagram.com/veronalabs/' );
	set_theme_mod( 'linkedin', 'https://www.linkedin.com/company/veronalabs/' );
}
add_action( 'ocdi/after_import', 'wp_meliora_after_import_setup' );

