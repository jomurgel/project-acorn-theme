<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */

use function AcornTheme\Functions\display_numeric_pagination;
use function AcornTheme\Functions\display_page_title;

get_header();
?>

		<section class="post-river">

			<?php
			if ( have_posts() ) :

				display_page_title();

				// Load posts loop.
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content' );
				endwhile;

				display_numeric_pagination();
			else :

				// If no content, include the "No posts found" template.
				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</section>

<?php
get_footer();
