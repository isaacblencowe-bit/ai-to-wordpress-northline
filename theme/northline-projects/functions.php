<?php
/** Northline theme integration. */
defined( 'ABSPATH' ) || exit;
add_action( 'after_setup_theme', function () {
 load_theme_textdomain( 'northline-projects', get_template_directory() . '/languages' );
 add_theme_support( 'title-tag' );
 add_theme_support( 'post-thumbnails' );
 add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 300, 'flex-height' => true, 'flex-width' => true ) );
 add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
 add_theme_support( 'responsive-embeds' );
 register_nav_menus( array( 'primary' => __( 'Header navigation', 'northline-projects' ), 'footer' => __( 'Footer navigation', 'northline-projects' ) ) );
} );
add_action( 'wp_enqueue_scripts', function () {
 wp_enqueue_style( 'northline', get_theme_file_uri( '/assets/theme.css' ), array(), filemtime( get_theme_file_path( '/assets/theme.css' ) ) );
 wp_enqueue_script( 'northline', get_theme_file_uri( '/assets/theme.js' ), array(), filemtime( get_theme_file_path( '/assets/theme.js' ) ), array( 'strategy' => 'defer', 'in_footer' => true ) );
}, 20 );
function northline_logo() {
 if ( has_custom_logo() ) { the_custom_logo(); return; }
 ?><a class="nl-logo" href="<?php echo esc_url( home_url( '/#home' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) . ' home' ); ?>"><span class="nl-monogram" aria-hidden="true">N</span><span class="nl-wordmark"><?php echo esc_html( get_theme_mod( 'northline_wordmark', 'NORTHLINE' ) ); ?><small><?php echo esc_html( get_theme_mod( 'northline_submark', 'PROJECTS' ) ); ?></small></span></a><?php
}
function northline_menu_fallback( $args ) {
 echo '<ul class="nl-menu">';
 foreach ( array( 'home' => 'Home', 'about' => 'About', 'services' => 'Services', 'projects' => 'Projects', 'contact' => 'Contact' ) as $id => $label ) {
  if ( 'footer' === $args['theme_location'] && 'home' === $id ) { continue; }
  echo '<li><a href="' . esc_url( home_url( '/#' . $id ) ) . '">' . esc_html( $label ) . '</a></li>';
 }
 echo '</ul>';
}
add_action( 'customize_register', function ( $wp_customize ) {
 $wp_customize->add_section( 'northline_identity', array( 'title' => __( 'Northline header and footer', 'northline-projects' ), 'priority' => 30 ) );
 $fields = array(
  'wordmark' => array( 'Wordmark', 'NORTHLINE' ), 'submark' => array( 'Small wordmark', 'PROJECTS' ),
  'header_cta' => array( 'Header link label', 'Discuss your project' ),
  'header_url' => array( 'Header link URL (blank uses homepage contact)', '' ),
  'footer_statement' => array( 'Footer statement (one sentence per line)', "Considered homes.\nLasting connections." ),
  'footer_copyright' => array( 'Copyright label', '© 2026 Northline Projects' ),
  'footer_disclosure' => array( 'Demonstration disclosure', 'Fictional brand · Website design concept · All projects are illustrative' ),
 );
 foreach ( $fields as $key => $field ) {
  $id = 'northline_' . $key;
  $wp_customize->add_setting( $id, array( 'default' => $field[1], 'sanitize_callback' => 'header_url' === $key ? 'esc_url_raw' : 'sanitize_textarea_field' ) );
  $wp_customize->add_control( $id, array( 'label' => $field[0], 'section' => 'northline_identity', 'type' => 'footer_statement' === $key ? 'textarea' : 'text' ) );
 }
} );
/* Native widgets remain native. Only the two demo actions become real buttons. */
add_filter( 'elementor/widget/render_content', function ( $content, $widget ) {
 $id = $widget->get_settings( '_element_id' );
 if ( 'button' === $widget->get_name() && in_array( $id, array( 'enquiry-open', 'enquiry-close' ), true ) ) {
  $extra = 'enquiry-open' === $id ? ' aria-expanded="false" aria-controls="enquiry-panel"' : '';
  $content = preg_replace( '/<a\b([^>]*)>/', '<button type="button"$1' . $extra . '>', $content, 1 );
  $content = preg_replace( '/\s+href="[^"]*"/', '', $content );
  $content = str_replace( '</a>', '</button>', $content );
 }
 if ( 'image' === $widget->get_name() ) {
  $hero = str_contains( (string) $widget->get_settings( '_css_classes' ), 'nl-hero-image' );
  $p = new WP_HTML_Tag_Processor( $content );
  while ( $p->next_tag( 'IMG' ) ) {
   $p->set_attribute( 'loading', $hero ? 'eager' : 'lazy' );
   if ( $hero ) { $p->set_attribute( 'fetchpriority', 'high' ); }
  }
  $content = $p->get_updated_html();
 }
 return $content;
}, 10, 2 );
/* Hidden at first paint on the frontend, still visible while editing. */
add_action( 'elementor/frontend/container/before_render', function ( $element ) {
 if ( 'enquiry-panel' === $element->get_settings( '_element_id' ) && ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
  $element->add_render_attribute( '_wrapper', 'hidden', 'hidden' );
 }
} );
require get_theme_file_path( '/inc/setup.php' );
