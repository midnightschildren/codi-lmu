<?php
/**
 * The template for Footer.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */
?>
</div>
<div style="clear: both"></div>

<div id="footer">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer1") ) : ?>
    <?php endif; ?>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer2") ) : ?>
    <?php endif; ?>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer3") ) : ?>
    <?php endif; ?>
<div class="social_nav grid-8 pull-right"><a href="http://youtube.com/user/SFTVLMU" id="youtube" class="pull-right">Youtube</a><a href="http://twitter.com/LMUsftv" id="twitter" class="pull-right">Twitter</a><a href="http://facebook.com/LMUSFTV" id="facebook" class="pull-right">Facebook</a></div>
<div style="clear: both"></div>
<div class="black"><a href="http://lmu.edu">&copy;<?php echo date("Y"); ?> Loyola Marymount University</a></div>
</div>


</div>
<div id="footer_bottom" class="grid-12 container"></div>
<?php wp_footer(); ?>
  <script language=javascript>
$(document).ready(function(){
    $('iframe').each(function(){
          var url = $(this).attr("src");
          var char = "?";
          if(url.indexOf("?") != -1){
                  var char = "&";
           }
         
          $(this).attr("src",url+char+"wmode=transparent");
    });
});
  </script>
</body>
</html>