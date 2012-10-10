<?php
/**
 * Template for displaying single Internship posts.
 * 
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php
    // Storing this before we start mucking up the loop
    $postID = $post->ID; ?>

 <div class="grid_8 pull-left bortop alpha featured-home <?php echo $oddClass ?>">
        
      <div class="grid_8 alpha featured-posts">
        <div class="grid_6 alpha featured-text pull-left">
          <h6><?php echo my_entry_published_link(); ?></h6>
          <h3 class="people_stitle"><a href="<?php echo home_url(); ?>/sftvinternships/">Internships</a></h3>
          <h1 class="altheader hspacer2" id="post-<?php the_ID(); ?>">
              <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
          </h1>
              <?php the_content(); ?> 
          

          <?php // Link More
          $linkurl = get_custom_field('post_link');
          if( !empty($linkurl) ) :
        ?>
              <p class="readmore peoplespacer gray">
              <a href="<?php print_custom_field('post_link'); ?>"><?php print_custom_field('post_link_label'); ?></a> ></p>
              <?php endif; ?>

          <div class="grid_6 alpha featured-text pull-left">
          <?php if( function_exists('ADDTOANY_SHARE_SAVE_KIT') ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
          <p class="lpotb tagsblock"><?php the_tags(); ?></p>
          </div>
        </div>
        <div class="grid_2">
              <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('page-people'); ?></a>
        </div>
      </div>  
  
  
      
      
  </div>
  
	
		
		

<?php endwhile; // end of the loop. ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>