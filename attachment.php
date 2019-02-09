<?php
/**
 * The template for displaying media/attachements.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */

use function AcornTheme\Functions\display_page_title;

get_header();
?>

		<section class="post-single-attachement">

			<?php
			while ( have_posts() ) :

				the_post();

				display_page_title();

				echo wp_get_attachment_image( get_the_ID(), 'full' );

				if ( has_excerpt() ) :
					?>

					<div class="entry-caption">
						<?php the_excerpt(); ?>
					</div><!-- .entry-caption -->

					<?php
				endif;

			endwhile; // End of the loop.
			?>

	</section><!-- .post-single -->

<?php
get_footer();
