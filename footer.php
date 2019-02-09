<?php
/**
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */

use function AcornTheme\Functions\display_category_list;
use function AcornTheme\Functions\display_footer_copyright;
use function AcornTheme\Functions\display_social_menu;

?>

	<?php display_category_list(); ?>

	</main><!-- .site-content -->

	<footer class="site-footer">
		<div class="copyright">
			<?php display_footer_copyright(); ?>
		</div><!-- .copyright -->
		<?php display_social_menu(); ?>
	</footer><!-- .site-footer -->

<?php wp_footer(); ?>

</body>
</html>
