<?php defined( 'ABSPATH' ) || exit; ?>
<footer class="nl-footer"><div class="nl-footer-top"><?php northline_logo(); ?>
<p><?php echo nl2br( esc_html( get_theme_mod( 'northline_footer_statement', "Considered homes.\nLasting connections." ) ) ); ?></p>
<nav aria-label="Footer navigation"><?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'menu_class' => 'nl-menu', 'fallback_cb' => 'northline_menu_fallback', 'depth' => 1 ) ); ?></nav></div>
<div class="nl-footer-bottom"><span><?php echo esc_html( get_theme_mod( 'northline_footer_copyright', '© 2026 Northline Projects' ) ); ?></span><span><?php echo esc_html( get_theme_mod( 'northline_footer_disclosure', 'Fictional brand · Website design concept · All projects are illustrative' ) ); ?></span><a href="<?php echo esc_url( home_url( '/#home' ) ); ?>">BACK TO TOP</a></div></footer>
</div><?php wp_footer(); ?></body></html>
