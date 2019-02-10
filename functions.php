<?php
/**
 * Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */

namespace AcornTheme\Functions;

define( 'ACORN_VERSION', wp_get_theme()->get( 'Version' ) );
define( 'ACORN_THEME_PATH', trailingslashit( get_template_directory() ) );
define( 'ACORN_THEME_URL', trailingslashit( get_template_directory_uri() ) );
define( 'ACORN_STYLE_PATH', trailingslashit( get_stylesheet_directory() ) );
define( 'ACORN_STYLE_URL', trailingslashit( get_stylesheet_directory_uri() ) );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function setup() {
	/*
	* Make theme available for translation.
	* Translations can be filed in the /languages/ directory.
	* If you're building a theme based on Twenty Nineteen, use a find and replace
	* to change 'acorn-theme' to the name of your theme in all the template files.
	*/
	load_theme_textdomain( 'acorn-theme', ACORN_THEME_PATH . '/languages' );

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

	/*
	* Custom Thumbnails.
	*/
	add_image_size( 'river-thumbnail-retina', 160, 160, array( 'center', 'center' ) );
	add_image_size( 'river-thumbnail', 80, 80, array( 'center', 'center' ) );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'acorn-theme' ),
			'social'  => __( 'Social Menu', 'acorn-theme' ),
		)
	);

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 75,
			'width'       => 205,
			'flex-width'  => false,
			'flex-height' => false,
		)
	);

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( 'dist/editor.css' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	* Let's support the Goots™
	*
	* @link https://wordpress.org/gutenberg/handbook/
	*/

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Add custom editor font sizes.
	add_theme_support( 'editor-font-sizes',
		array(
			array(
				'name'      => __( 'Small', 'acorn-theme' ),
				'shortName' => __( 'S', 'acorn-theme' ),
				'size'      => 18,
				'slug'      => 'small',
			),
			array(
				'name'      => __( 'Normal', 'acorn-theme' ),
				'shortName' => __( 'M', 'acorn-theme' ),
				'size'      => 20,
				'slug'      => 'normal',
			),
			array(
				'name'      => __( 'Large', 'acorn-theme' ),
				'shortName' => __( 'L', 'acorn-theme' ),
				'size'      => 28,
				'slug'      => 'large',
			),
			array(
				'name'      => __( 'Huge', 'acorn-theme' ),
				'shortName' => __( 'XL', 'acorn-theme' ),
				'size'      => 48,
				'slug'      => 'huge',
			),
		)
	);

	// Editor color palette.
	add_theme_support( 'editor-color-palette',
		array(
			array(
				'name'  => __( 'Primary Rose', 'acorn-theme' ),
				'slug'  => 'primary-rose',
				'color' => 'rgba(215, 4, 107, 1)',
			),
			array(
				'name'  => __( 'Secondary Orange', 'acorn-theme' ),
				'slug'  => 'secondary-orange',
				'color' => 'rgba(254, 79, 69, 1)',
			),
			array(
				'name'  => __( 'Tertiary Plum', 'acorn-theme' ),
				'slug'  => 'Tertiary Plum',
				'color' => 'rgba(144, 10, 170, 1)',
			),
			array(
				'name'  => __( 'Accent Cerulean', 'acorn-theme' ),
				'slug'  => 'Accent Cerulean',
				'color' => 'rgba(49, 191, 199, 1)',
			),
		)
	);
}
add_action( 'after_setup_theme', 'AcornTheme\Functions\setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'acorn_theme_content_width', 720 );
}
add_action( 'after_setup_theme', 'AcornTheme\Functions\content_width', 0 );

/**
 * Customizer Functions.
 */
require ACORN_THEME_PATH . '/inc/customizer.php';

/**
 * Enqueue scripts and styles.
 */
require ACORN_THEME_PATH . '/inc/scripts.php';

/**
 * Custom template tags for this theme
 */
require ACORN_THEME_PATH . '/inc/template-tags.php';

/**
 * Helper functions to return validation.
 */
require ACORN_THEME_PATH . '/inc/theme-hooks.php';

/**
 * Helper functions to return validation.
 */
require ACORN_THEME_PATH . '/inc/validators.php';
