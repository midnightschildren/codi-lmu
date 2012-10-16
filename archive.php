<?php
/**
 * The template for Archive.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */

get_header(); ?>

<div class="grid_8 alpha feature-page">
    <h1 class="salmon fpageheader">
      
    <?php if ( is_day() ) : ?>
        <?php printf( __( 'Daily Archives: <span>%s</span>', 'twentyten' ), get_the_date() ); ?>
    <?php elseif ( is_month() ) : ?>
        <?php printf( __( 'Monthly Archives: <span>%s</span>', 'twentyten' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyten' ) ) ); ?>
    <?php elseif ( is_year() ) : ?>
        <?php printf( __( 'Yearly Archives: <span>%s</span>', 'twentyten' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentyten' ) ) ); ?>
    <?php else : ?>
        <?php _e( 'Blog Archives', 'twentyten' ); ?>
    <?php endif; ?>


    </h1>
  <?php get_template_part('loop', 'archives'); ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
