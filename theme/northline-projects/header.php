<?php defined( 'ABSPATH' ) || exit; ?><!doctype html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo( 'charset' ); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class( is_front_page() ? 'northline-front' : 'northline-inner' ); ?>>
<?php wp_body_open(); ?><a class="nl-skip" href="#main">Skip to content</a><div class="nl-site-shell">
<header class="nl-header">
<?php northline_logo(); ?>
<button class="nl-menu-button" type="button" aria-expanded="false" aria-controls="northline-navigation">Menu</button>
<nav id="northline-navigation" aria-label="Main navigation"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'nl-menu', 'fallback_cb' => 'northline_menu_fallback', 'depth' => 1 ) ); ?></nav>
<a class="nl-text-link nl-header-cta" href="<?php echo esc_url( get_theme_mod( 'northline_header_url' ) ?: home_url( '/#contact' ) ); ?>"><?php echo esc_html( get_theme_mod( 'northline_header_cta', 'Discuss your project' ) ); ?></a>
</header>
