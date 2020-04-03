<?php
/**
 * Alcatraz Customizer functionality.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */

namespace AcornTheme\Functions;

/**
 * Enqueue scripts for the customizer.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */
function customizer_preview_js() {

	wp_enqueue_script(
		'acorn-theme-customizer-scripts',
		ACORN_THEME_URL . '/dist/customizer.js',
		array( 'customize-preview' ),
		ACORN_VERSION,
		true
	);
}
add_action( 'customize_preview_init', __NAMESPACE__ . '\customizer_preview_js' );

/**
 * Modify the $wp_customize object.
 * Add live preview support via postMessage.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 *
 * @param array $wp_customize The Customizer object.
 * @link https://codex.wordpress.org/Theme_Customization_API#Part_3:_Configure_Live_Preview_.28Optional.29.
 */
function customize_register( $wp_customize ) {

	$wp_customize->remove_control( 'blogdescription' );

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
	) );

	$wp_customize->selective_refresh->add_partial( 'nav_toggle', array(
		'selector' => '.primary',
	) );

	$wp_customize->selective_refresh->add_partial( 'search_toggle', array(
		'selector' => '.search-toggle',
	) );

	$wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
		'selector' => '.copyright-language',
	) );

	// Footer section.
	$wp_customize->add_section(
		'acorn_theme_footer_section',
		array(
			'title'      => __( 'Footer', 'acorn-theme' ),
			'priority'   => 140,
			'capability' => 'edit_theme_options',
		)
	);

	// Add section.
	$wp_customize->add_setting(
		'footer_copyright',
		array(
			'default'               => '',
			'type'                  => 'theme_mod',
			'capability'            => 'edit_theme_options',
			'sanitization_callback' => 'wp_filter_post_kses',
		)
	);

	// Add field type.
	$wp_customize->add_control(
		'footer_copyright',
		array(
			'type'    => 'textarea',
			'label'   => __( 'Footer Copyright Text', 'acorn-theme' ),
			'section' => 'acorn_theme_footer_section',
		)
	);

	// Search toggle section.
	$wp_customize->add_section(
		'acorn_theme_theme_options',
		array(
			'title'      => __( 'Theme Options', 'acorn-theme' ),
			'priority'   => 140,
			'capability' => 'edit_theme_options',
		)
	);

	// Add section.
	$wp_customize->add_setting(
		'search_toggle',
		array(
			'default'               => false,
			'type'                  => 'theme_mod',
			'capability'            => 'edit_theme_options',
			'sanitization_callback' => 'wp_filter_post_kses',
		)
	);

	// Add field type.
	$wp_customize->add_control(
		'search_toggle',
		array(
			'type'    => 'checkbox',
			'label'   => __( 'Show Search Button and Form Globally?', 'acorn-theme' ),
			'section' => 'acorn_theme_theme_options',
		)
	);

	// Add section.
	$wp_customize->add_setting(
		'nav_toggle',
		array(
			'default'               => true,
			'type'                  => 'theme_mod',
			'capability'            => 'edit_theme_options',
			'sanitization_callback' => 'wp_filter_post_kses',
		)
	);

	// Add field type.
	$wp_customize->add_control(
		'nav_toggle',
		array(
			'type'    => 'checkbox',
			'label'   => __( 'Hide nav in off-screen drawer?', 'acorn-theme' ),
			'section' => 'acorn_theme_theme_options',
		)
	);

}
add_action( 'customize_register', __NAMESPACE__ . '\customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 * @return void
 */
function customize_partial_blogname() {
	bloginfo( 'name' );
}
