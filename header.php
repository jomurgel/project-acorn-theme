<?php
/**
 * This is the template that displays all of the <head> section and everything up until <div id="page">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acorn_Theme
 * @since 1.0.0
 */

use function AcornTheme\Functions\display_site_branding;
use function AcornTheme\Functions\display_search_toggle;

?><!doctype html>

<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />

	<?php wp_head(); ?>
</head>

<body id="site" <?php body_class(); ?>>
	<a class="skip-link screen-reader-text" href="#site-content"><?php esc_html_e( 'Skip to Content', 'acorn-theme' ); ?></a>

	<header class="site-header">

		<div class="site-branding"><?php display_site_branding(); ?></div><!-- .site-branding -->

		<?php if ( has_nav_menu( 'primary' ) ) : ?>

			<button id="menu-toggle" aria-label="<?php esc_attr_e( 'Toggle Menu Visibility' ); ?>"><span></span></button><!-- #menu-toggle -->

			<nav id="primary" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'acorn-theme' ); ?>" aria-hidden="true">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-navigation',
					'menu_class'     => 'menu primary-menu',
					'container'      => '',
					'depth'          => 1,
				) );
				?>
			</nav><!-- #primary -->

		<?php endif; ?>

		<?php display_search_toggle(); ?>
	</header><!-- .site-header-->

	<main id="site-content" class="site-content container" role="main">
