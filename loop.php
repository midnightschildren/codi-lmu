<?php if (have_posts()) : ?>
  <?php 
    // this is set in the parent template before get_template_part() is called
    // but we can't be sure so defaulting to 2
    global $LOOP_ROW_COUNT;
    $rowCount = isset($LOOP_ROW_COUNT) ? $LOOP_ROW_COUNT : 2;
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
  <div <?php post_class($oddClass) ?>>
    <div class="postdate">
      <div class="postmonth">
        <?php the_time('M') ?>
      </div>
      <div class="postday">
        <?php the_time('d') ?>
      </div>
    </div>
    <h1 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
      <?php the_title(); ?>
      </a></h1>
    <div class="entry">
      <?php the_post_thumbnail(); ?>
      <?php the_excerpt(); ?>
      <div class="clear"></div>
    </div>
    <div class="postmetadata">
      <?php get_template_part( '/inc/meta' );?>
      <span class="categories">Filed Under:
      <?php the_category(', '); ?>
      </span>
      <?php the_tags('<span class="tags">Tags: ', ', ', '</span>'); ?>
      <?php comments_popup_link( 'No comments yet', '1 comment', '% comments', 'post-comments', 'Comments are off for this post'); ?>
    </div>
  </div>
  <?php endwhile; ?>
  <?php get_template_part( '/inc/nav' );?>
<?php else : ?>
  <h1>Nothing found</h1>
<?php endif; ?> 