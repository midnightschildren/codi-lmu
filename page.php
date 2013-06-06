<?php 
/**
 * The template for displaying Single Page.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */get_header(); ?>

<div class="grid-8 alpha feature-page">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <div class="post" id="post-<?php the_ID(); ?>">
    <h1 class="salmon fpageheader">
      <?php the_title(); ?>
    </h1>
    <div class="entry">
      <?php the_content(); ?>
      
    </div>

  </div>
</div>
<?php endwhile; endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
