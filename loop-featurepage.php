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

  <div class="grid_8 pull-left bortop featured-home <?php echo $oddClass ?>">
        
      <div class="grid_8 alpha featured-posts">
        <div class="grid_6 alpha featured-text pull-left">
          <h6><?php echo my_entry_published_link(); ?></h6>
          <h1 class="altheader hspacer" id="post-<?php the_ID(); ?>">
              <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
          </h1>
              <?php the_excerpt(); ?> 
          <p class="readmore rmorespacer gray"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">Read More</a> ></p>
          <div class="grid_6 alpha featured-text pull-left">
          <?php if( function_exists('ADDTOANY_SHARE_SAVE_KIT') ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
          <p class="lpotb tagsblock"><?php the_tags(); ?></p>
          </div>
        </div>
        <div class="grid_2">
              <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('page-feature'); ?></a>
        </div>
      </div>  
  
  
      
      
  </div>
  <?php endwhile; ?>
<?php get_template_part( '/inc/nav' );?>  
<?php else : ?>
  
<?php endif; ?> 