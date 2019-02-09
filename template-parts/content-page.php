<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */

use function AcornTheme\Functions\display_post_thumbnail;
use function AcornTheme\Functions\display_post_footer;
use function AcornTheme\Functions\display_page_title;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	display_post_thumbnail();
	display_page_title();
	?>

	<div class="post-content">
		<?php the_content(); ?>
	</div><!-- .post-content -->

	<footer class="post-footer">
		<?php display_post_footer(); ?>
	</footer><!-- .post-footer -->
</article><!-- .post -->
