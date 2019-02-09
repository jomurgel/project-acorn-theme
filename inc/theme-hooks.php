<?php
/**
 * Action hooks and filters. Functions which enhance the theme by hooking into WordPress
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */

namespace AcornTheme\Functions;

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @package Acorn_Theme
 * @since 1.0.0
 * @return array
 */
function body_classes( $classes ) {

	// Give all pages a unique class.
	if ( is_page() ) {
		$classes[] = 'page-' . basename( get_permalink() );
	}

	// Single post has featured image.
	if ( is_singular() && has_post_thumbnail() ) {
		$classes[] = 'has-featured-image';
	}

	return $classes;
}
add_filter( 'body_class', 'AcornTheme\Functions\body_classes' );

/**
 * Disable the "Cancel reply" link. It doesn't seem to work anyway, and it only makes the "Leave Reply" heading confusing.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */
add_filter( 'cancel_comment_reply_link', '__return_false' );

/**
 * Remove jQuery from the front end, unless required by WP.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 * @return void
 */
function remove_front_end_jquery() {

	if ( ! is_admin_bar_showing() && ! is_customize_preview() ) {
		wp_deregister_script( 'jquery' );
	}
}
add_action( 'wp_enqueue_scripts', 'AcornTheme\Functions\remove_front_end_jquery' );

/**
 * Adds OG tags to the head for better social sharing.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 * @return string Just an empty string if Yoast is found.
 */
function add_og_tags() {

	// Bail if Yoast is installed, since it will handle things.
	if ( class_exists( 'WPSEO_Options' ) ) {
		return '';
	}

	// Set a post global on single posts. This avoids grabbing content from the first post on an archive page.
	if ( is_singular() ) {
		global $post;
	}

	// Get the post content.
	$post_content = ! empty( $post ) ? $post->post_content : '';

	// Strip all tags from the post content we just grabbed.
	$default_content = ( $post_content ) ? wp_strip_all_tags( strip_shortcodes( $post_content ) ) : $post_content;

	// Set our default title.
	$default_title = get_bloginfo( 'name' );

	// Set our default URL.
	$default_url = get_permalink();

	// Set our base description.
	$default_base_description = ( get_bloginfo( 'description' ) ) ? get_bloginfo( 'description' ) : esc_html__( 'Visit our website to learn more.', 'acorn-theme' );

	// Set the card type.
	$default_type = 'article';

	// Get our custom logo URL. We'll use this on archives and when no featured image is found.
	$logo_id    = get_theme_mod( 'custom_logo' );
	$logo_image = ( $logo_id ) ? wp_get_attachment_image_src( $logo_id, 'full' ) : '';
	$logo_url   = ( $logo_id ) ? $logo_image[0] : '';

	// Set our final defaults.
	$card_title            = $default_title;
	$card_description      = $default_base_description;
	$card_long_description = $default_base_description;
	$card_url              = $default_url;
	$card_image            = $logo_url;
	$card_type             = $default_type;

	// Let's start overriding!
	// All singles.
	if ( is_singular() ) {

		if ( has_post_thumbnail() ) {
			$card_image = get_the_post_thumbnail_url();
		}
	}

	// Single posts/pages that aren't the front page.
	if ( is_singular() && ! is_front_page() ) {

		$card_title            = get_the_title() . ' - ' . $default_title;
		$card_description      = ( $default_content ) ? wp_trim_words( $default_content, 53, '...' ) : $default_base_description;
		$card_long_description = ( $default_content ) ? wp_trim_words( $default_content, 140, '...' ) : $default_base_description;
	}

	// Categories, Tags, and Custom Taxonomies.
	if ( is_category() || is_tag() || is_tax() ) {

		$term_name      = single_term_title( '', false );
		$card_title     = $term_name . ' - ' . $default_title;
		$specify        = ( is_category() ) ? esc_html__( 'categorized in', 'acorn-theme' ) : esc_html__( 'tagged with', 'acorn-theme' );
		$queried_object = get_queried_object();
		$card_url       = get_term_link( $queried_object );
		$card_type      = 'website';

		// Translators: get the term name.
		$card_long_description = $card_description = sprintf( esc_html__( 'Posts %1$s %2$s.', 'acorn-theme' ), $specify, $term_name ); // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found
	}

	// Search results.
	if ( is_search() ) {

		$search_term = get_search_query();
		$card_title  = $search_term . ' - ' . $default_title;
		$card_url    = get_search_link( $search_term );
		$card_type   = 'website';

		// Translators: get the search term.
		$card_long_description = $card_description = sprintf( esc_html__( 'Search results for %s.', 'acorn-theme' ), $search_term ); // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found
	}

	if ( is_home() ) {

		$posts_page = get_option( 'page_for_posts' );
		$card_title = get_the_title( $posts_page ) . ' - ' . $default_title;
		$card_url   = get_permalink( $posts_page );
		$card_type  = 'website';
	}

	// Front page.
	if ( is_front_page() ) {

		$front_page = get_option( 'page_on_front' );
		$card_title = ( $front_page ) ? get_the_title( $front_page ) . ' - ' . $default_title : $default_title;
		$card_url   = get_home_url();
		$card_type  = 'website';
	}

	// Post type archives.
	if ( is_post_type_archive() ) {

		$post_type_name = get_post_type();
		$card_title     = $post_type_name . ' - ' . $default_title;
		$card_url       = get_post_type_archive_link( $post_type_name );
		$card_type      = 'website';
	}

	// Media page.
	if ( is_attachment() ) {
		$attachment_id = get_the_ID();
		$card_image    = ( wp_attachment_is_image( $attachment_id ) ) ? wp_get_attachment_image_url( $attachment_id, 'full' ) : $card_image;
	}

	?>
	<meta property="og:title" content="<?php echo esc_attr( $card_title ); ?>" />
	<meta property="og:description" content="<?php echo esc_attr( $card_description ); ?>" />
	<meta property="og:url" content="<?php echo esc_url( $card_url ); ?>" />
	<meta property="og:image" content="<?php echo esc_url( $card_image ); ?>" />
	<meta property="og:site_name" content="<?php echo esc_attr( $default_title ); ?>" />
	<meta property="og:type" content="<?php echo esc_attr( $card_type ); ?>" />
	<meta name="description" content="<?php echo esc_attr( $card_long_description ); ?>" />
	<?php
}
add_action( 'wp_head', 'AcornTheme\Functions\add_og_tags' );

/**
 * Removes or Adjusts the prefix on category archive page titles.
 *
 * @param string $title The default $title of the page.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 * @return string The updated $title.
 */
function remove_archive_title_prefix( $title ) {

	// Get the single category title with no prefix.
	$single_cat_title = single_term_title( '', false );

	if ( is_category() || is_tag() || is_tax() ) {
		return esc_html( $single_cat_title );
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'AcornTheme\Functions\remove_archive_title_prefix' );

/**
 * Flush out the transients used in _s_categorized_blog.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 * @return string
 */
function category_transient_flusher() {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return false;
	}

	// Like, beat it. Dig?
	delete_transient( 'acorn_theme_categories' );
}
add_action( 'delete_category', 'AcornTheme\Functions\category_transient_flusher' );
add_action( 'save_post', 'AcornTheme\Functions\category_transient_flusher' );

/**
 * Filters WYSIWYG content with the_content filter.
 *
 * @param string $content content dump from WYSIWYG.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 * @return mixed $content.
 */
function get_new_content( $content ) {

	// Bail if no content exists.
	if ( empty( $content ) ) {
		return;
	}

	// Returns the content.
	return $content;
}
add_filter( 'the_content', 'AcornTheme\Functions\get_new_content', 20 );
