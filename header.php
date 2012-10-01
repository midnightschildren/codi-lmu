<?php
/**
 * The template for Header.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>><head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php if (is_search()) { ?>
<meta name="robots" content="noindex, nofollow" />
<?php } ?>
<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>

<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicon.ico" type="image/x-icon" />


<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head><body <?php body_class(); ?>>
<div class="shadow_body" id="options-wrapper"> 
<div id="logline" class="container">
<div id="header" class="container">
  <a href="http://sftv.lmu.edu/"><div class="LMUSofFilm"></div></a>
  <h1><a href="<?php echo home_url(); ?>/">
    <div class="Loglines_logo"></div>
    </a></h1>
  <div id="navigation" class="grid_7 pull-right">
    <?php wp_nav_menu(); ?>  
  </div>
</div>
