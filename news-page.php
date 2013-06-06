<?php 
/**
 * Template Name: News
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */get_header(); ?>

<div class="grid-8 alpha feature-page">
    <h1 class="salmon fpageheader">
      SFTV <?php the_title(); ?>
    </h1>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <div class="post" id="post-<?php the_ID(); ?>">

    <div class="entry">
      

<?php // Featured Feature
      $temp_query = clone $wp_query;
                
      $args=array(
        'post_type' => 'news',
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'paged' => get_query_var('paged'),
        'order' => 'DESC'
      );
        
      $wp_query = null;
      $wp_query = new WP_Query($args);
      $LOOP_ROW_COUNT = 1;
      get_template_part( 'loop', 'peoplepage' );
      
      // now back to our regularly scheduled programming
      $wp_query = $temp_query;
    ?>


      
    </div>
    
  </div>
</div>
<?php endwhile; endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
