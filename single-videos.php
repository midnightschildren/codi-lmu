<?php
/**
 * Template for displaying single Feature posts.
 * 
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php
    // Storing this before we start mucking up the loop
    $postID = $post->ID; ?>

 <div class="grid-8 alpha pull-left featured-home <?php echo $oddClass ?>">
        
      <div class="grid-8 alpha">
        
        <h6><?php echo my_entry_published_link(); ?></h6>
        <h3 class="people_stitle"><a href="<?php echo home_url(); ?>/sftvvideos/">Press Play</a></h3>
        <h1 class="altheader vspacer2" id="post-<?php the_ID(); ?>">
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
        </h1>
        
      </div>  
        <div class="video_spacer">
              <?php print_custom_field('videoiframe'); ?>
        </div>
        <?php the_content(); ?> 
        <div class="grid-8 alpha featured-text pull-left"><div class="lpotb tagsblock">
          <?php if( function_exists('ADDTOANY_SHARE_SAVE_KIT') ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
          <?php the_tags(); ?></div>
          </div>
      
  
	
		
		

<?php endwhile; // end of the loop. ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>