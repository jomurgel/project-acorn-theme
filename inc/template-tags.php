<?php
/**
 * Custom template tags for this theme
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */

namespace AcornTheme\Functions;

use function AcornTheme\SocialIcons\get_social_icon_array;

/**
 * Display post publish on time.
 *
 * @param bool $relative default, false, show relative time instead of typical MM DD, YYYY.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */
function display_posted_on( $relative = true ) {

	// If $relative is true, utilize relative timestamp function.
	if ( $relative ) {
		display_relative_time();
		return;
	}

	// Set post id string.
	$id = get_the_ID();

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U', $id ) !== get_post_modified_time( 'U', false, $id ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( 'c', $id ) ),
		esc_html( get_the_date( '', $id ) ),
		esc_attr( get_post_modified_time( 'c', false, $id ) ),
		esc_html( get_post_modified_time( '', false, $id ) )
	);

	$posted_on = sprintf(
		/* translators: the date the post was published */
		esc_html_x( 'Posted on %s', 'post date', 'acorn-theme' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo wp_kses_post( '<span class="posted-on">' . $posted_on . '</span>' );

}

/**
 * Return relative time string from unix timestamp.
 *
 * @param array $args parse args, `timestamp` expects @136736775.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */
function display_relative_time( $args = array() ) {

	// Defaults.
	$defaults = array(
		'timestamp' => '@' . get_post_time( 'U', true ), // Get unix timestamp.
	);

	$args = wp_parse_args( $args, $defaults );

	// Setup new time.
	$now  = new \DateTime();
	$ago  = new \DateTime( $args['timestamp'] );
	$diff = $now->diff( $ago );

	// Round week down to nearest int.
	$diff->w = intval( floor( $diff->d / 7 ) );

	// Subtract day from week and set to var.
	$diff->d -= $diff->w * 7;

	// Set potential string output to array.
	$time_string_array = array(
		'y' => 'year',
		'm' => 'month',
		'w' => 'week',
		'd' => 'day',
		'h' => 'hour',
		'i' => 'minute',
		's' => 'second',
	);

	// Loop through each time.
	foreach ( $time_string_array as $key => &$time ) {

		// Set $spacetime key as plural,
		// else remove key from array if key isn't valid.
		if ( $diff->$key ) {
			$time = $diff->$key . ' ' . $time . ( $diff->$key > 1 ? 's' : '' );
		} else {
			unset( $time_string_array[ $key ] );
		}
	}

	// Get first element from array.
	$time_space = array_slice( $time_string_array, 0, 1 );

	// If we have a value assume past, and attache 'ago', else just now.
	$time_string = $time_space ? implode( ', ', $time_space ) . esc_html__( ' ago', 'acorn-theme' ) : esc_html__( 'just now', 'acorn-theme' );

	if ( is_singular() ) {
		// Construct markup.
		$posted_on = sprintf(
			/* translators: the date the post was published */
			esc_html( '%s' ),
			$time_string
		);
	} else {
		// Construct markup.
		$posted_on = sprintf(
			/* translators: the date the post was published */
			esc_html( '%s' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
	}

	// Output markup.
	echo wp_kses_post( '<span class="posted-on">' . $posted_on . '</span>' );
}

/**
 * Displays site branding markup.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 * @return void
 */
function display_site_branding() {

	$blog_info = get_bloginfo( 'name' );

	// Bail if we don't have a blog name.
	if ( empty( $blog_info ) && ! has_custom_logo() ) {
		return;
	}

	$logo = wp_get_attachment_image(
		get_theme_mod( 'custom_logo' ), 'full', false, array(
			'alt' => $blog_info,
		)
	);

	// Define markup tag.
	$title_heading = is_front_page() && is_home() ? 'h1' : 'p';

	// Set branding output value.
	$site_heading = has_custom_logo() ? $logo : $blog_info;

	// Construct markup.
	echo sprintf(
		'<%1$s class="h1 site-title"><a href="%2$s" rel="home">%3$s</a></%1$s>', esc_attr( $title_heading ), esc_url( home_url( '/' ) ), wp_kses_post( $site_heading )
	);
}

/**
 * Limit the excerpt length.
 *
 * @param array $args Parameters include length and more.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 * @return string
 */
function get_new_excerpt( $args = array() ) {

	// Set defaults.
	$defaults = array(
		'length' => 35,
		'more'   => '.',
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Trim the excerpt.
	return wpautop( wp_trim_words( get_the_excerpt(), absint( $args['length'] ), esc_html( $args['more'] ) ) );
}

/**
 * Display Page Titles.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */
function display_page_title() {

	$heading = '';

	if ( is_singular() ) {
		$heading = get_the_title();
	} elseif ( is_archive() || is_category() || is_tag() ) {
		$heading = get_the_archive_title();
	} elseif ( is_search() ) {
		$heading = /* translators: the term(s) searched */ sprintf( esc_html__( 'Search Results for: %s', 'acorn-theme' ), '<span class="query-term">' . get_search_query() . '</span>' );
	} elseif ( is_404() ) {
		$heading = esc_html__( '¯\_(ツ)_/¯', 'acorn-theme' );
	} elseif ( is_attachment() && get_post_meta( get_the_ID(), '_wp_attachment_image_alt', true ) ) {
		$heading = get_post_meta( get_the_ID(), '_wp_attachment_image_alt', true );
	} else {
		return;
	}

	// Construct markup.
	echo sprintf(
		'<header class="page-header"><h1 class="page-title">%1$s</h1></header>', wp_kses_post( $heading )
	);
}

/**
 * Display search toggle and modal.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 * @return void
 */
function display_search_toggle() {

	if ( true !== get_theme_mod( 'search_toggle' ) ) {
		return;
	}
	?>

	<div class="search-toggle">
		<button id="search-toggle" aria-label="<?php esc_attr_e( 'Toggle Search Visibility' ); ?>"></button><!-- #search-toggle -->
	</div><!-- .search-toggle -->

	<div id="search-form-container" class="search-form-container" role="search" aria-label="<?php esc_attr_e( 'Sitewide Search', 'acorn-theme' ); ?>" aria-hidden="true">
		<?php get_search_form(); ?>
	</div><!-- #search-form-toggle -->

	<?php
}

/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @param array $args Array of params to customize output.
 * @package Acorn_Theme
 * @since 1.0.0
 */
function display_post_thumbnail( $args = array() ) {

	// Defaults.
	$defaults = array(
		'thumbnail'        => 'full',
		'thumbnail_linked' => 'river-thumbnail-retina',
	);

	$args = wp_parse_args( $args, $defaults );

	if ( ! show_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
		?>

		<figure class="single-post-thumbnail post-thumbnail">
			<?php
			the_post_thumbnail( $args['thumbnail'] );

			$caption = get_the_post_thumbnail_caption();
			if ( ! empty( $caption ) ) :
				?>
				<figcaption><?php echo esc_html( $caption ); ?></figcaption>
			<?php endif; ?>
		</figure><!-- .post-thumbnail -->

	<?php else : ?>

		<figure class="post-thumbnail">
			<a class="post-thumbnail-inner" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail( $args['thumbnail_linked'] );
				?>
			</a>
		</figure>

		<?php
	endif;
}

/**
 * Display Read More Link for Posts.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */
function display_read_more() {

	// Construct markup.
	echo sprintf(
		'<div class="read-more"><a href="%1$s" rel="bookmark" aria-label="%2$s">%3$s</a></div>', esc_url( get_the_permalink() ), esc_html__( 'Continue Reading ', 'acorn-theme' ) . esc_html( get_the_title() ), esc_html__( '. . .', 'acorn-theme' )
	);
}

/**
 * Displays numeric pagination on archive pages.
 *
 * @param array $args Array of params to customize output.
 * @package Acorn_Theme
 * @since 1.0.0
 */
function display_numeric_pagination( $args = array() ) {

	// Set defaults.
	$defaults = array(
		'mid_size'  => 4,
		'prev_text' => __( 'Previous', 'acorn-theme' ),
		'next_text' => __( 'Next', 'acorn-theme' ),
		'type'      => 'list',
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );
	?>

	<nav class="pagination-container">
		<?php echo paginate_links( $args ); // WPCS: XSS OK. ?>
	</nav>
	<?php
}

/**
 * Validat WP Comment Form by Default.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */
function validated_comment_form() {
	ob_start();
	comment_form();
	echo str_replace(
		'novalidate',
		'data-toggle="validator"',
		ob_get_clean()
	); // WPCS: XSS Ok.
}

/**
 * Display Singular Footer.
 * Prepend Facebook and Twitter social share buttons to the post's content.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */
function display_post_footer() {

	// Post id.
	$id = get_the_ID();

	// Get the post's URL that will be shared.
	$post_url = rawurlencode( esc_url( get_permalink( $id ) ) );

	// Get the post's title.
	$post_title = rawurlencode( get_the_title( $id ) );

	// Compose the share links for Facebook, Twitter and Google+.
	$links = array(
		'facebook' => sprintf( 'https://www.facebook.com/sharer/sharer.php?u=%1$s', $post_url ),
		'twitter'  => sprintf( 'https://twitter.com/intent/tweet?text=%2$s&url=%1$s', $post_url, $post_title ),
	);

	// Wrap the buttons.
	$output = '<ul id="share-buttons" class="share-buttons">';

	$output .= '<li><span class="share-to">' . esc_html__( 'Share on: ', 'acorn-theme' ) . '</span></li>';

	// Add the links inside the wrapper.
	foreach ( $links as $key => $link ) {
		$output .= '<li class="share-button ' . esc_attr( $key ) . '"><a target="_blank" href="' . esc_url( $link ) . '">' . esc_html( ucfirst( $key ) ) . '</a></li>';
	}

	$output .= '</ul>';

	// Return the buttons and the original content.
	echo get_new_content( $output ); // phpcs:xss ok.
}

/**
 * Adds social media icons to social menu.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 *
 * @return string $output html markup for social media.
 */
function social_menu() {

	// Get all nav locations.
	$menus = get_nav_menu_locations();

	// Bail if we don't have a social media menu.
	if ( ! array_key_exists( 'social', $menus ) ) {
		return;
	}

	// Return social menu and items.
	$menu_id    = $menus['social'];
	$menu_items = wp_get_nav_menu_items( $menu_id );

	if ( ! $menu_items ) {
		return;
	}

	require_once ACORN_THEME_PATH . '/inc/social-icons.php';

	// Social media SVG icons.
	$social_icons = apply_filters(
		'social_icons',
		get_social_icon_array()
	);

	// Bail if we don't have an array of icons.
	if ( ! is_array( $social_icons ) ) {
		return;
	}

	$output = '<nav class="social-menu"><ul>';

	foreach ( $menu_items as $item ) {

		$name   = $item->post_name;
		$title  = $item->post_title;
		$url    = $item->url;
		$target = $item->target ?: '_blank';

		$icon_svg = array_key_exists( $name, $social_icons ) ? $social_icons[ $name ] : esc_html( $title );

		$output .= sprintf( '<li class="icon %1$s"><a href="%2$s" target="%3$s">%4$s</a></li>', esc_attr( $name ), esc_url( $url ), esc_attr( $target ), $icon_svg );
	}

	$output .= '</ul></nav>';

	return $output;
}

/**
 * Display html for social_menu.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */
function display_social_menu() {
	echo social_menu(); // WPCS: XSS Ok.
}

/**
 * Display footer copyright.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */
function display_footer_copyright() {

	$default_string = sprintf( '<a href="%s">%s</a>. %s <a href="%s" target="_blank">%s</a> %s.', esc_url( 'https://jomurgel.com' ), esc_html__( 'jomurgel', 'acorn-theme' ), esc_html__( 'Made with &hearts; for the', 'acorn-theme' ), esc_url( 'https://opensource.org', 'acorn-theme' ), esc_html__( 'open source', 'acorn-theme' ), esc_html__( 'community', 'acorn-theme' ) );

	$copy_language = ! empty( get_theme_mod( 'footer_copyright' ) ) ? get_theme_mod( 'footer_copyright' ) : $default_string;

	echo sprintf( '&copy; %s <span class="copyright-language">%s</span>', esc_html( date( 'Y' ) ), wp_kses_post( $copy_language ) );
}

/**
 * Override comments as callback.
 *
 * @param array $comment comment output.
 * @param array $args comment settings.
 * @param int   $depth depth int.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */
function custom_comment_list( $comment, $args, $depth ) {

	switch ( $comment->comment_type ) {
		case 'pingback':
		case 'trackback':
			?>
			<li <?php comment_class(); ?> id="comment<?php comment_ID(); ?>">
				<div class="back-link">< ?php comment_author_link(); ?></div>
			<?php
			break;

		default:
			?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<article <?php comment_class(); ?> class="comment">

				<header class="comment-meta">
					<div class="author vcard">
						<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
						<span class="author-name"><?php comment_author(); ?></span>
					</div><!-- .vcard -->
				</header><!-- comment-body -->

				<div class="comment-body">
					<?php comment_text(); ?>
				</div><!-- .comment-body -->

				<footer class="comment-footer">
					<time <?php comment_time( 'c' ); ?> class="comment-time">
						<span class="date">
							<?php
							display_posted_on(
								array(
									'timestamp' => '@' . get_comment_date( 'U' ), // Get unix timestamp.
								)
							);
							?>
						</span>
					</time>
					<div class="reply">
						<?php
						comment_reply_link(
							array_merge( $args,
								array(
									'reply_text' => 'Reply',
									'depth'      => $depth,
									'max_depth'  => $args['max_depth'],
								)
							)
						);
						?>
					</div><!-- .reply -->
				</footer><!-- .comment-footer -->

			</article><!-- #comment-<?php comment_ID(); ?> -->

			<?php
			// End the default styling of comment.
			break;
	}
}

/**
 * Display list of categories above footer.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 * @return void
 */
function display_category_list() {

	// get all terms.
	$categories = get_terms();

	// Bail if we have no terms, or if we're on a list of pages we don't need it.
	if ( ! $categories || is_search() || is_404()|| is_home() || is_front_page() ) {
		return;
	}
	?>

	<aside class="category-list">
		<h4><?php esc_html_e( 'Additional Content', 'acorn-theme' ); ?></h4>
		<ul>
		<?php
		foreach ( $categories as $term ) :

			// Only show categories.
			if ( 'category' !== $term->taxonomy ) {
				continue;
			}
			?>

			<li class="term <?php echo esc_attr( $term->slug ); ?>">
				<a href="<?php echo esc_url( get_permalink( $term->term_id ) ); ?>">
					<?php echo wp_kses_post( $term->name . ' <span>' . $term->count . '</span>' ); ?>
				</a>
			</li>

		<?php endforeach; ?>
		</ul>
	</aside><!-- .category-list -->
	<?php
}
