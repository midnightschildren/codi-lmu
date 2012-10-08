<?php
/**
 * The template for Pagination.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */
 ?>
 <div class="navigation featured-home alpha grid_8">
    <div class="nav-previous pull-left"><?php next_posts_link( __( '<span class="meta-nav"><</span> Older posts', 'twentyeleven' ) ); ?></div>
    <div class="nav-next pull-right"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">></span>', 'twentyeleven' ) ); ?></div>
    <?php //if(function_exists('pagenavi')) { pagenavi(); } ?>
 </div> 