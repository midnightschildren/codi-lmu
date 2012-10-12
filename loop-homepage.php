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
        <div class="grid_2 alpha">
              <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('page-feature'); ?></a>
        </div>
        <div class="grid_6 featured-text pull-left">
          <h6><?php echo my_entry_published_link(); ?></h6>

          <h3 class="people_stitle">
          <?php 
                $ptype = get_post_type( $post->ID );
                if($ptype == people){
                echo '<a href="'.get_home_url(); 
                echo '/sftvpeople/">SFTV '.get_post_type( $post->ID ); } 
                else { 
                echo '<a href="'.get_home_url(); 
                echo '/sftv'.get_post_type( $post->ID );
                echo '">'.get_post_type( $post->ID );
                 }
                
          ?></a></h3>


          
          <h2 class="altheader hspacer3" id="post-<?php the_ID(); ?>">
              <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
          </h2>
              <?php the_excerpt(); ?> 
          

          <?php // Link More
          $linkurl = get_custom_field('post_link');
          if( !empty($linkurl) ) :
        ?>
              <p class="readmore peoplespacer gray"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">Read More</a> ></p>
              <?php endif; ?>

        </div>
        
      </div>  
  
  
      
      
  </div>
  <?php endwhile; ?>
<?php //get_template_part( '/inc/nav' );?>  
<?php else : ?>
  
<?php endif; ?> 