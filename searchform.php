<?php
/**
 * The template for Search Form.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */
?>
<form action="<?php echo site_url(); ?>" id="searchform" method="get">
  <div id="searching">
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="searchbox" align="center" valign="middle"><input type="text" id="s" name="s" onfocus="if (this.value=='Search') this.value = ''" value="Search" /></td>
        <td align="center" valign="middle"><input type="submit" value="" id="searchsubmit" /></td>
      </tr>
    </table>
  </div>
</form>
	