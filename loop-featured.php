<?php if (have_posts()) : ?>
  <?php 
    // this is set in the parent template before get_template_part() is called
    // but we can't be sure so defaulting to 2
    global $LOOP_ROW_COUNT;
    $rowCount = isset($LOOP_ROW_COUNT) ? $LOOP_ROW_COUNT : 1;
    $count = 0;
  ?>
  <?php while (have_posts()) : the_post(); ?>
  <?php 
    $count++;
    $oddClass = '';
    if( $rowCount == 1
        || $count == 1
        || $count % $rowCount == 1 ) { 
      $oddClass = ' alpha'; 
    } 
  ?>

  <div class="grid_8 pull-left featured-home <?php echo $oddClass ?>">
        
      <div class="grid_8 alpha featured-header">
        <div class="grid_6 alpha featured-text pull-right">
        <h6><?php echo my_entry_published_link(); ?></h6>
        <h3 class="feature_stitle"><a href="<?php echo home_url(); ?>/features/">Feature</a></h3>
        <h2 class="altheader white" id="post-<?php the_ID(); ?>">
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
        </h2>
        </div>
      </div>  
  
  <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('home-feature'); ?></a>
      
      <div class="grid_6 alpha pull-right featured-text extra20r">
	      <?php the_excerpt(); ?> 
        <p class="readmore blue"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">Read More</a> ></p>
      </div>
  </div>
  <?php endwhile; ?>
  
<?php else : ?>
  
<?php endif; ?> 