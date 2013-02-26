<?php 
/**
 * Template Name: Home
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */get_header(); ?>

<div class="grid_8 alpha">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <div class="post" id="post-<?php the_ID(); ?>">

    <div class="entry">
      

<?php // Featured Feature
      $temp_query = clone $wp_query;
      $paged = (get_query_var('page')) ? get_query_var('page') : 1;          
      $args=array(
        'post_type' => 'feature',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'paged' => $paged,
        'order' => 'DESC'
      );
        
      $wp_query = null;
      $wp_query = new WP_Query($args);
      $LOOP_ROW_COUNT = 1;
      get_template_part( 'loop', 'featured' );
      
      // now back to our regularly scheduled programming
      $wp_query = $temp_query;
    ?>

<?php // Recent Posts
      $temp_query = clone $wp_query;
      $paged = (get_query_var('page')) ? get_query_var('page') : 1;          
      $args=array(
        'post_type' => array( 'people', 'internships', 'festivals', 'news', 'videos' ),
        'post_status' => 'publish',
        'posts_per_page' => 2,
        'paged' => $paged,
        'order' => 'DESC'
      );
        
      $wp_query = null;
      $wp_query = new WP_Query($args);
      $LOOP_ROW_COUNT = 1;
      get_template_part( 'loop', 'homepage' );
      
      // now back to our regularly scheduled programming
      $wp_query = $temp_query;
    ?>


      
    </div>
    
  </div>
</div>
<?php endwhile; endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
