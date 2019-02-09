<?php
/**
 * Theme functions to return validation checks.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */

namespace AcornTheme\Functions;

/**
 * Determines if post thumbnail can be displayed.
 */
function show_post_thumbnail() {
	return ! post_password_required() && ! is_attachment() && has_post_thumbnail();
}

/**
 * Returns true if a blog has more than 1 category, else false.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 * @return bool Whether the blog has more than one category.
 */
function categorized_blog() {

	// Set transient key.
	$transient_key = 'acorn_theme_categories';

	// Fetch transient.
	$category_count = get_transient( $transient_key );

	// If it exists, return value.
	if ( false !== $category_count && ! isset( $_GET['delete-transients'] ) ) { // WPCS: CSRF OK.
		return $category_count > 1;
	}

	// Otherwise get count.
	$category_count_query = get_categories( array(
		'fields' => 'count',
	) );

	// Get value as int.
	$category_count = (int) $category_count_query[0];

	// Set transient, and expire after a max of 12 hours.
	set_transient( $transient_key, $category_count, 12 * HOUR_IN_SECONDS );

	// Return bool.
	return $category_count > 1;
}
