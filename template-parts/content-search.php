<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */

use function AcornTheme\Functions\display_post_thumbnail;
use function AcornTheme\Functions\display_posted_on;
use function AcornTheme\Functions\display_read_more;
use function AcornTheme\Functions\get_new_content;
use function AcornTheme\Functions\get_new_excerpt;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>

	<header class="post-header display-flex">
		<div class="post-meta">
			<?php echo wp_kses_post( ucfirst( get_post_type() . ' &mdash; ' ) ); ?>
			<?php display_posted_on(); ?>
		</div><!-- .post-meta -->

		<?php
		display_post_thumbnail();

		if ( is_singular() ) :
			the_title( '<h1 class="post-title">', '</h1>' );
		else :
			the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		endif;
		?>
	</header><!-- .post-header -->

	<div class="post-excerpt">
		<?php
		echo get_new_content(
			get_new_excerpt(
				array(
					'length' => 15,
					'more'   => '.',
				)
			)
		); // WPCS: XSS ok — filtered.
		?>
	</div><!-- .post-content -->
</article><!-- .post -->
