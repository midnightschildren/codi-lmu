<?php 
/**
 * Template Name: Tag
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */get_header(); ?>

<div class="grid_8 alpha feature-page">
    <h1 class="salmon fpageheader">
      Tag: <?php single_tag_title(); ?>
    </h1>
  <?php 
    // attempt to guess the loop type we want to use
    // post_type > category > default
    $template = '';
    if( $_GET['post_type']) {
      $template = $_GET['post_type'];
    } else if ( $_GET['category_name'] ) {
      $template = $_GET['category_name'];
    } 
    echo get_template_part('loop', $template); 
  ?>
</div>
<?php get_sidebar($template); ?>
<?php get_footer(); ?>