<?php
/**
 * The template for Archive.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */

get_header(); ?>

<div class="grid_8 alpha">
  <?php 
    // Ask for the category loop if we're in a single category view
    // this is so that we don't duplicate templates so that we can call
    // different loops
    $template = 'archives';
    $queryCats = get_query_var('cat');
    $queryCats = explode(',', $queryCats);
    $singleCategory = false;
    if ( count($queryCats) == 1 ) {
      $singleCategory = get_category(intval($queryCats[0]));
      $template = $singleCategory->slug;
    } 
  ?>
  <?php if($template != 'archives') : ?>
    <h2 class="page-title">
      <?php echo $singleCategory->name;?> 
    </h2>
    <h3 class="page-subtitle">
      <?php if(isset($singleCategory->description)): ?>
      <span><?php echo $singleCategory->description?></span>
      <?php endif; ?>
    </h3>  
  <?php endif; ?>
  <?php 
    // since we can't pass parameters, setting this global for use in the
    // template part
    global $LOOP_ROW_COUNT;
    $LOOP_ROW_COUNT = 3;

    get_template_part('loop', $template); 
  ?>
</div>
<?php get_sidebar($template); ?>
<?php get_footer(); ?>
