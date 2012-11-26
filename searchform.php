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
<div class="text-ebrite" style="padding-bottom:16px;">
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

<div class="sidebaritem widget_text text-3">
<div class="textwidget">
<p class="readmore orange"><a href="http://www.eventbrite.com/org/1853301933">all events</a> ></p>
</div>
</div>

<div class="sidebaritem widget_text text-5"> 
    <div class="textwidget"><h3><a href="https://twitter.com/LMUsftv">Twitter</a> 
        <div class="twitimage"><a href="https://twitter.com/LMUsftv" id="twitbut">@LMUsftv</a></div>
    </h3></div>
</div>

<div class="sidebaritem widget_twitter twitter-2">
<ul>
<?php
  $tweets = getTweets(3);

  foreach($tweets as $tweet){
            $pubDate        = $tweet['created_at'];
            $form_date     = date('F d - h:i:s A', strtotime($pubDate));
            $statusid         = $tweet['id_str'];
            $tweet          = $tweet['text'];
            
            # Turn URLs into links
            $tweet = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\./-]*(\?\S+)?)?)?)@', '<a target="blank" title="$1" href="$1">$1</a>', $tweet);
            
            #Turn hashtags into links
            $tweet = preg_replace('/#([0-9a-zA-Z_-]+)/', "<a target='blank' title='$1' href=\"http://twitter.com/search?q=%23$1\">#$1</a>", $tweet);
            
            #Turn @replies into links
            $tweet = preg_replace("/@([0-9a-zA-Z_-]+)/", "<a target='blank' title='$1' href=\"http://twitter.com/$1\">@$1</a>", $tweet);
            $twitter .= "<li><span class='time-meta'><a href=\"http://twitter.com/LMUsftv/statuses/" . $statusid . "\">" . $form_date . "</a></span><span class='entry-content'>" . $tweet . "</span></li>";

  }
  echo $twitter;
?>
</ul>
</div>
