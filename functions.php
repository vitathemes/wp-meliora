<?php
/**
 * Digital Interface functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wp_meliora
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
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
				'menu-2' => esc_html__( 'Slider Menu', 'wp-meliora' ),
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
		add_theme_support(
			'custom-background',
			apply_filters(
				'wp_meliora_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

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

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_meliora_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wp_meliora_content_width', 640 );
}

add_action( 'after_setup_theme', 'wp_meliora_content_width', 0 );

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
			'before_widget' => '<section id="%1$s" class="c-widget widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="c-widget__title widget-title h1">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'wp_meliora_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wp_meliora_scripts() {
	wp_enqueue_style( 'wp_meliora-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'wp_meliora-style', 'rtl', 'replace' );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_script( 'wp_meliora-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'wp_meliora-carousel', 'https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'wp_meliora-main', get_template_directory_uri() . '/js/main.js', array( 'wp_meliora-carousel' ), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Kirki
 */
require get_template_directory() . '/inc/kirki/kirki.php';

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
