<?php defined( 'ABSPATH' ) || exit; get_header(); ?>
<main id="main" class="<?php echo esc_attr( 'builder' === get_post_meta( get_the_ID(), '_elementor_edit_mode', true ) ? 'nl-builder-page' : 'nl-standard-page' ); ?>">
<?php while ( have_posts() ) : the_post(); if ( 'builder' !== get_post_meta( get_the_ID(), '_elementor_edit_mode', true ) ) { the_title( '<h1>', '</h1>' ); } the_content(); wp_link_pages(); endwhile; ?></main>
<?php get_footer(); ?>
