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

<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/favicon.ico" type="image/x-icon" />


<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head><body <?php body_class(); ?>>
<div class="shadow_body" id="options-wrapper"> 
<div id="logline" class="container">
<div id="header" class="container">
<div class="grid-12">
<div class="row">
<div class="grid-7">
  <a href="http://sftv.lmu.edu/" id="LMUSofFilm">LMU School of Film and Television</a>
</div>
<div class="newsletter grid-4 pull-right">
  
  
  <div id="load_check" class="signup_form_message" >This form needs Javascript to display, which your browser doesn't support. 
  <a href="https://app.e2ma.net/app2/audience/signup/1721952/1715422/?v=a"> Sign up here</a> instead </div>
  <script type="text/javascript">signupFormObj.drawForm();</script>
  <script language=javascript>
$('.e2ma_signup_form_element input').val(' Enter your email address');
$('.e2ma_signup_form_element input').focus(function() {
if ($('.e2ma_signup_form_element input').val() == ' Enter your email address') $('.e2ma_signup_form_element input').val('');
});
</script>
 </div> 
</div>
<div class="row logo_spacer_header">
  <h1 class="grid-4"><a href="<?php echo home_url(); ?>/" id="Loglines_logo">Loglines</a></h1>
  <div id="navigation" class="grid-7 pull-right">
    <?php wp_nav_menu(); ?>  
  </div>
  <div id="navigationline" class="grid-8 pull-right"></div>
</div>
</div>  
</div>
<div id="moveablefeast">
  
