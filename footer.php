<?php
/**
 * The template for Footer.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */
?>

<div style="clear: both"></div>
</div>
<div id="footer">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer1") ) : ?>
    <?php endif; ?>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer2") ) : ?>
    <?php endif; ?>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer3") ) : ?>
    <?php endif; ?>
<div class="social_nav grid_5 pull-right"><div class="youtube pull-right"></div><div class="twitter pull-right"></div><div class="facebook pull-right"></div></div>
<div style="clear: both"></div>
<div class="black"><a href="http://lmu.codisattva.com/copy/">&copy;<?php echo date("Y"); ?> Loyola Marymount University</a></div>
</div>

<div id="footer_bottom"></div>
<?php wp_footer(); ?>

</body>
</html>