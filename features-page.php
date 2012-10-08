<?php 
/**
 * Template Name: Features
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */get_header(); ?>

<div class="grid_8 alpha feature-page">
    <h2 class="salmon fpageheader">
      <?php the_title(); ?>
    </h2>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <div class="post" id="post-<?php the_ID(); ?>">

    <div class="entry">
      

<?php // Featured Feature
      $temp_query = clone $wp_query;
                
      $args=array(
        'post_type' => 'feature',
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'order' => 'DESC'
      );
        
      $wp_query = null;
      $wp_query = new WP_Query($args);
      $LOOP_ROW_COUNT = 1;
      get_template_part( 'loop', 'featurepage' );
      
      // now back to our regularly scheduled programming
      $wp_query = $temp_query;
    ?>


      <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
    </div>
    
  </div>
</div>
<?php endwhile; endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
