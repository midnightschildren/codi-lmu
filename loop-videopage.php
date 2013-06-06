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

  <div class="grid-8 pull-left bortop featured-home <?php echo $oddClass ?>">
        
      <div class="grid-8 alpha featured-posts">
        
          <h6><?php echo my_entry_published_link(); ?></h6>
          <h1 class="altheader vspacer" id="post-<?php the_ID(); ?>">
              <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
          </h1>
          <div class="video_spacer">
              <?php print_custom_field('videoiframe'); ?>
          </div>
              <?php the_content(); ?> 
          
          <div class="grid-8 alpha featured-text pull-left"><div class="lpotbvid tagsblock">
          <?php if( function_exists('ADDTOANY_SHARE_SAVE_KIT') ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
          <?php the_tags(); ?></div>
          </div>
        
        
      </div>  
  
  
      
      
  </div>
  <?php endwhile; ?>
<?php get_template_part( '/inc/nav' );?>  
<?php else : ?>
  
<?php endif; ?> 