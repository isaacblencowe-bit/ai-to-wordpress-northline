<?php
/** Explicit, nonce-protected starter import. Never runs on theme activation. */
defined( 'ABSPATH' ) || exit;
function northline_import_homepage() {
 if ( ! current_user_can( 'manage_options' ) || ! current_user_can( 'edit_theme_options' ) || ! current_user_can( 'upload_files' ) ) { return new WP_Error( 'forbidden', 'Administrator permissions required.' ); }
 if ( ! did_action( 'elementor/loaded' ) ) { return new WP_Error( 'missing_elementor', 'Install and activate Elementor Free first.' ); }
 $existing = absint( get_option( 'northline_homepage_id' ) );
 if ( $existing && get_post( $existing ) && 'trash' !== get_post_status( $existing ) ) { return $existing; }
 /* Educational release: supply rights-cleared images before importing. */
 foreach ( array( 'exterior', 'hero', 'interior', 'residence' ) as $asset ) {
  if ( ! is_readable( get_theme_file_path( '/assets/images/' . $asset . '.jpg' ) ) ) {
   return new WP_Error( 'missing_release_images', 'Photographs are not included. Add licensed exterior.jpg, hero.jpg, interior.jpg and residence.jpg files to this theme’s assets/images folder before running setup. See the replacement-image instructions below.' );
  }
 }
 require_once ABSPATH . 'wp-admin/includes/file.php';
 require_once ABSPATH . 'wp-admin/includes/media.php';
 require_once ABSPATH . 'wp-admin/includes/image.php';
 $alts = array(
  'exterior' => 'Contemporary dark-clad home with warm interior lighting, broad glazing and a mature tree. Illustrative architecture.',
  'hero' => 'Steel stair beside a concrete wall, timber joinery and dining table in a daylit interior. Illustrative interior.',
  'interior' => 'Sunlit neutral living room with leather sofa, plants and large windows. Illustrative interior.',
  'residence' => 'White rectilinear two-storey residence with dark-framed windows, timber deck and lawn under a blue sky. Illustrative architecture.',
 );
 $media = get_option( 'northline_media', array() );
 foreach ( $alts as $key => $alt ) {
  if ( ! empty( $media[$key]['id'] ) && wp_attachment_is_image( $media[$key]['id'] ) ) { continue; }
  $file = get_theme_file_path( '/assets/images/' . $key . '.jpg' );
  $tmp = wp_tempnam( $key . '.jpg' );
  if ( ! $tmp || ! copy( $file, $tmp ) ) { return new WP_Error( 'image_copy', 'Could not prepare the supplied replacement image.' ); }
  $id = media_handle_sideload( array( 'name' => 'northline-' . $key . '.jpg', 'tmp_name' => $tmp ), 0, $alt );
  if ( is_wp_error( $id ) ) { wp_delete_file( $tmp ); return $id; }
  update_post_meta( $id, '_wp_attachment_image_alt', $alt );
  update_post_meta( $id, '_northline_asset', $key );
  $media[$key] = array( 'id' => $id, 'url' => wp_get_attachment_url( $id ) );
  update_option( 'northline_media', $media, false );
 }
 $template = json_decode( file_get_contents( get_theme_file_path( '/inc/homepage.json' ) ), true );
 if ( empty( $template['content'] ) ) { return new WP_Error( 'template', 'Bundled homepage template is invalid.' ); }
 $remap = function ( &$elements ) use ( &$remap, $media ) {
  foreach ( $elements as &$element ) {
   if ( isset( $element['settings']['image'] ) ) {
    $name = pathinfo( wp_parse_url( $element['settings']['image']['url'], PHP_URL_PATH ), PATHINFO_FILENAME );
    $name = preg_replace( '/^northline-/', '', $name );
    if ( isset( $media[$name] ) ) { $element['settings']['image'] = $media[$name]; }
   }
   if ( ! empty( $element['elements'] ) ) { $remap( $element['elements'] ); }
  }
 };
 $remap( $template['content'] );
 $doc = \Elementor\Plugin::$instance->documents->create( 'wp-page', array( 'post_title' => 'Northline Projects — Home', 'post_type' => 'page', 'post_status' => 'draft' ) );
 if ( is_wp_error( $doc ) ) { return $doc; }
 $id = $doc->get_main_id();
 $saved = $doc->save( array( 'elements' => $template['content'], 'settings' => array( 'hide_title' => 'yes', 'template' => 'default', 'post_status' => 'publish' ) ) );
 if ( ! $saved ) { return new WP_Error( 'save', 'Elementor could not save the homepage. A draft has been retained.' ); }
 update_option( 'northline_previous_home', array( 'show_on_front' => get_option( 'show_on_front' ), 'page_on_front' => get_option( 'page_on_front' ), 'menus' => get_theme_mod( 'nav_menu_locations', array() ) ), false );
 update_option( 'northline_homepage_id', $id, false );
 update_option( 'show_on_front', 'page' ); update_option( 'page_on_front', $id );
 $locations = get_theme_mod( 'nav_menu_locations', array() );
 foreach ( array( 'primary' => 'Northline Header', 'footer' => 'Northline Footer' ) as $location => $label ) {
  if ( ! empty( $locations[$location] ) ) { continue; }
  $menu = wp_get_nav_menu_object( $label );
  $menu_id = $menu ? $menu->term_id : wp_create_nav_menu( $label );
  if ( is_wp_error( $menu_id ) ) { continue; }
  if ( ! wp_get_nav_menu_items( $menu_id ) ) {
   foreach ( array( 'home' => 'Home', 'about' => 'About', 'services' => 'Services', 'projects' => 'Projects', 'contact' => 'Contact' ) as $anchor => $text ) {
    if ( 'footer' === $location && 'home' === $anchor ) { continue; }
    wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => $text, 'menu-item-url' => home_url( '/#' . $anchor ), 'menu-item-status' => 'publish', 'menu-item-type' => 'custom' ) );
   }
  }
  $locations[$location] = $menu_id;
 }
 set_theme_mod( 'nav_menu_locations', $locations );
 /* Use the installed Elementor kit controls for matching responsive breakpoints. */
 $kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit();
 $settings = $kit->get_settings();
 update_option( 'northline_previous_kit', get_post_meta( $kit->get_id(), '_elementor_page_settings', true ), false );
 $settings['viewport_mobile'] = 760; $settings['viewport_tablet'] = 1100;
 $settings['system_colors'] = array(
  array( '_id' => 'primary', 'title' => 'Charcoal', 'color' => '#202222' ), array( '_id' => 'secondary', 'title' => 'Stone', 'color' => '#E8E5DF' ),
  array( '_id' => 'text', 'title' => 'Body', 'color' => '#595C59' ), array( '_id' => 'accent', 'title' => 'Bronze', 'color' => '#B3A48E' ),
 );
 foreach ( $settings['system_typography'] as &$type ) { $type['typography_font_family'] = 'Arial'; $type['typography_font_weight'] = '400'; }
 unset( $type );
 $settings['body_typography_typography'] = 'custom'; $settings['body_typography_font_family'] = 'Arial';
 $kit->save( array( 'settings' => $settings ) );
 \Elementor\Plugin::$instance->files_manager->clear_cache();
 return $id;
}
add_action( 'admin_menu', function () { add_theme_page( 'Northline Setup', 'Northline Setup', 'manage_options', 'northline-setup', 'northline_setup_screen' ); } );
function northline_setup_screen() {
 if ( ! current_user_can( 'manage_options' ) ) { return; }
 $message = '';
 if ( isset( $_POST['northline_import'] ) ) {
  check_admin_referer( 'northline_import' );
  $result = northline_import_homepage();
  $message = is_wp_error( $result ) ? $result->get_error_message() : 'Homepage ready. Open Pages and choose Edit with Elementor.';
 }
 ?><div class="wrap"><h1>Northline Projects Setup</h1><?php if ( $message ) { echo '<div class="notice notice-info"><p>' . esc_html( $message ) . '</p></div>'; } ?><p>Photographs are not included in this educational release. Supply four licensed replacement JPEGs in this theme’s <code>assets/images/</code> folder: <code>exterior.jpg</code>, <code>hero.jpg</code>, <code>interior.jpg</code> and <code>residence.jpg</code>. Setup imports those images into the Media Library, together with the native Elementor homepage and menus. Set the new page as the homepage and apply the approved typography, palette and responsive breakpoints to Elementor’s global kit. Existing pages remain intact. Running this again will return the existing imported page without overwriting edits.</p><p>Replacement-image instructions: <a href="<?php echo esc_url( 'https://github.com/isaacblencowe-bit/ai-to-wordpress-northline/blob/main/docs/assets-and-licensing.md' ); ?>">Northline asset and licensing guide</a>. While the repository is private, sign in to GitHub with an account that has access. The same guide is included in the repository download under <code>docs/assets-and-licensing.md</code>. After import, update image alternative text to describe your replacements.</p><p>Requires Elementor Free. All content is fictional. The enquiry interaction is a demonstration.</p><form method="post"><?php wp_nonce_field( 'northline_import' ); ?><p><button class="button button-primary" name="northline_import" value="1">Set up Northline homepage</button></p></form></div><?php
}
