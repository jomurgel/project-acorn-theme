<?php
/**
 * Content template for nothing found.
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */
?>

<section class="no-results not-found">

	<header class="post-header">
		<h1 class="post-title"><?php esc_html_e( 'Nothing Found.', 'acorn-theme' ); ?></h1>
	</header><!-- .post-header -->

	<div class="post-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( /* translators: the edit post url */ __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'acorn-theme' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different, whatchamacallit, words.', 'acorn-theme' ); ?></p>

		<?php else : ?>

			<p><?php esc_html_e( 'Hmm. Well, it looks like the content you\'re looking for isn\'t available.', 'acorn-theme' ); ?></p>

		<?php endif; ?>
	</div><!-- .post-content -->
</section><!-- .no-results -->
