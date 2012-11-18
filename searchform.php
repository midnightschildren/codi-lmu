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
<div class="text-5">
<h3>
<a class="sftvrss" title="Syndicate this content" href="http://www.eventbrite.com/rss/organizer_list_events/1853301933">
<img width="20" height="20" alt="RSS" src="http://lmu.codisattva.com/wp-content/themes/codi-lmu/rss_sq.gif" style="border:0">
</a>
<a class="sftvrss" title="SFTV Events" href="http://www.eventbrite.com/org/1853301933">SFTV Events</a>
</h3>

<?php
    include "Eventbrite.php"; 

    $authentication_tokens = array(
        'app_key'  => 'VX23MMK3JJA6N3THCK',
        'user_key' => '132701494826014481013');

    $eb_client = new Eventbrite( $authentication_tokens );

    try {
        $events = $eb_client->user_list_events(array('event_statuses'=>'live'));
    } catch ( Exception $e ) {
        // Be sure to plan for potential error cases 
        // so that your application can respond appropriately

        //var_dump($e);
        $events = array();
    }

?>

<?= Eventbrite::eventList( $events, 'eventListRow'); ?>	</div>