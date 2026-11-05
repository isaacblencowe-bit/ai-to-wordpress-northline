<?php defined( 'ABSPATH' ) || exit; get_header(); ?>
<main id="main" class="nl-standard-page"><?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?><article <?php post_class(); ?>><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1><?php if ( is_singular() ) { the_content(); } else { the_excerpt(); } ?></article><?php endwhile; the_posts_navigation(); else : ?><h1><?php esc_html_e( 'Nothing found', 'northline-projects' ); ?></h1><?php endif; ?></main>
<?php get_footer(); ?>
