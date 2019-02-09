<?php
/**
 * Custom scripts and styles.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */

namespace AcornTheme\Functions;

/**
 * Enqueue scripts and styles.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */
function init_scripts() {

	// Array of script locations.
	$scripts = array(
		'error'  => is_404(),
		'home'   => ! is_home() && is_front_page(),
		'index'  => is_home() || is_archive(),
		'page'   => is_page(),
		'search' => is_search(),
		'single' => is_single(),
	);

	// Loop through and register dynamically.
	foreach ( $scripts as $script_name => $script_location ) {

		if ( $script_location ) {
			wp_enqueue_style(
				'acorn-theme-' . $script_name . 'style',
				ACORN_STYLE_URL . '/dist/' . $script_name . '.css',
				array(),
				ACORN_VERSION
			);
			wp_enqueue_script(
				'acorn-theme-' . $script_name . 'scripts',
				ACORN_THEME_URL . '/dist/' . $script_name . '.js',
				array(),
				ACORN_VERSION,
				true
			);
		}
	}

	wp_style_add_data( 'acorn-theme-style', 'rtl', 'replace' );

	// Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'AcornTheme\Functions\init_scripts' );
