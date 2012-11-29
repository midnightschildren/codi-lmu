<?php
/**
 * The template for Function. Make changes at your own risk.
 *
 * @package WordPress
 * @subpackage Simon_WP_Framework
 * @since Simon WP Framework 1.0
 */

// Includes
// -----------------------------------------------------------------------------
require_once locate_template('config.php');
require_once locate_template('/inc/nav-walker.php');

// Theme Options
if ( !function_exists( 'optionsframework_init' ) ) {

// define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
// define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/');

// require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

}

// Register Styles
// -----------------------------------------------------------------------------

add_action('get_header', 'registerstyles');
function registerstyles() {
	$theme  = get_theme( get_current_theme());
	$version = $theme['Version'];
    if(ENV_DEVELOPMENT) {
      $stylesheets .= wp_enqueue_style('theme', get_bloginfo('stylesheet_directory').'/css/less.php?file=custom', 'skeleton', $version, 'screen, projection');
    } else {
      $stylesheets .= wp_enqueue_style('theme', get_bloginfo('stylesheet_directory').'/style.css', 'skeleton', $version, 'screen, projection');
    }
		echo apply_filters ('child_add_stylesheets',$stylesheets);
}

// Register Scripts
// -----------------------------------------------------------------------------
// Load jQuery 
    if ( !is_admin() ) {
       wp_deregister_script('jquery');
       wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"), false);
       wp_enqueue_script('jquery');
       wp_register_script('emma', ("https://app.e2ma.net/app2/audience/tts_signup/1721952/c542369f5557e2325dad8adb7bb01746/1715422/?v=a"), false);
       wp_enqueue_script('emma');
       wp_register_script('eventbrite', ("http://evbdn.eventbrite.com/s3-s3/static/js/platform/Eventbrite.jquery.js"), false);
       wp_enqueue_script('eventbrite');
    }

    wp_register_script('custom', get_bloginfo('stylesheet_directory').'/js/custom.js', array('jquery'), null, true);

    wp_enqueue_script('custom');



// Set Content Width
	$content_width = 728;
	
// Add RSS links to <head> section
    add_theme_support( 'automatic-feed-links' );
	
// Add Custom BG Support
    add_custom_background();
	
// Enable post thumbnails
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(140, 100, true);

// Custom Image Sizes
// -----------------------------------------------------------------------------
    // Features
    add_image_size( "home-feature", 600, 9999);
    add_image_size( "page-feature", 140, 100, true);
    add_image_size( "page-people", 140, 9999);

// ADD POST FORMATS
	add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'audio', 'feature', 'festivals', 'internships', 'people' ) );

// Editor Support
	add_editor_style();
	
// Add Thumnail Support
	add_theme_support( 'post-thumbnails' );
	

	
// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');

// Archive Links

add_shortcode( 'entry-link-published', 'my_entry_published_link' );

function my_entry_published_link() {

    /* Get the year, month, and day of the current post. */
    $year = get_the_time( 'Y' );
    $month = get_the_time( 'm' );
    $day = get_the_time( 'd' );
    $out = '';

    /* Add a link to the monthly archive. */
    $out .= '<a href="' . get_month_link( $year, $month ) . '" title="Archive for ' . esc_attr( get_the_time( 'F Y' ) ) . '">' . get_the_time( 'F' ) . '</a>';

    /* Add a link to the daily archive. */
    $out .= ' <a href="' . get_day_link( $year, $month, $day ) . '" title="Archive for ' . esc_attr( get_the_time( 'F d, Y' ) ) . '">' . $day . '</a>';

    /* Add a link to the yearly archive. */
    $out .= ', ' . $year . '';

    return $out;
}

// Next and Previous Links

/**
 * Return the next posts page link.
 *
 * @since 2.7.0
 *
 * @param string $label Content for link text.
 * @param int $max_page Optional. Max pages.
 * @return string|null
 */
function lmu_get_next_posts_link( $label = null, $max_page = 0 ) {
    global $paged, $wp_query;

    if ( !$max_page )
        $max_page = $wp_query->max_num_pages;

    if ( !$paged )
        $paged = 1;

    $nextpage = intval($paged) + 1;

    if ( null === $label )
        $label = __( 'Next Page &raquo;' );

    if ( !is_single() && ( $nextpage <= $max_page ) ) {
        $attr = apply_filters( 'next_posts_link_attributes', '' );
        return '<a href="' . next_posts( $max_page, false ) . "\" $attr>" . preg_replace('/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label) . '</a> >';
    }
}

/**
 * Display the next posts page link.
 *
 * @since 0.71
 * @uses get_next_posts_link()
 *
 * @param string $label Content for link text.
 * @param int $max_page Optional. Max pages.
 */
function lmu_next_posts_link( $label = null, $max_page = 0 ) {
    echo lmu_get_next_posts_link( $label, $max_page );
}

/**
 * Return the previous posts page link.
 *
 * @since 2.7.0
 *
 * @param string $label Optional. Previous page link text.
 * @return string|null
 */
function lmu_get_previous_posts_link( $label = null ) {
    global $paged;

    if ( null === $label )
        $label = __( '&laquo; Previous Page' );

    if ( !is_single() && $paged > 1 ) {
        $attr = apply_filters( 'previous_posts_link_attributes', '' );
        return '< <a href="' . previous_posts( false ) . "\" $attr>". preg_replace( '/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label ) .'</a>';
    }
}

/**
 * Display the previous posts page link.
 *
 * @since 0.71
 * @uses get_previous_posts_link()
 *
 * @param string $label Optional. Previous page link text.
 */
function lmu_previous_posts_link( $label = null ) {
    echo lmu_get_previous_posts_link( $label );
}

/**
 * Return post pages link navigation for previous and next pages.
 *
 * @since 2.8
 *
 * @param string|array $args Optional args.
 * @return string The posts link navigation.
 */
function lmu_get_posts_nav_link( $args = array() ) {
    global $wp_query;

    $return = '';

    if ( !is_singular() ) {
        $defaults = array(
            'sep' => ' &#8212; ',
            'prelabel' => __('&laquo; Previous Page'),
            'nxtlabel' => __('Next Page &raquo;'),
        );
        $args = wp_parse_args( $args, $defaults );

        $max_num_pages = $wp_query->max_num_pages;
        $paged = get_query_var('paged');

        //only have sep if there's both prev and next results
        if ($paged < 2 || $paged >= $max_num_pages) {
            $args['sep'] = '';
        }

        if ( $max_num_pages > 1 ) {
            $return = lmu_get_previous_posts_link($args['prelabel']);
            $return .= preg_replace('/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $args['sep']);
            $return .= lmu_get_next_posts_link($args['nxtlabel']);
        }
    }
    return $return;

}

/**
 * Display post pages link navigation for previous and next pages.
 *
 * @since 0.71
 *
 * @param string $sep Optional. Separator for posts navigation links.
 * @param string $prelabel Optional. Label for previous pages.
 * @param string $nxtlabel Optional Label for next pages.
 */
function lmu_posts_nav_link( $sep = '', $prelabel = '', $nxtlabel = '' ) {
    $args = array_filter( compact('sep', 'prelabel', 'nxtlabel') );
    echo lmu_get_posts_nav_link($args);
}

	
// Add Bread Crumbs
function the_breadcrumb() {
	echo bloginfo('name');
	if (!is_front_page()) {
		echo ' <a href="';
		echo home_url();
		echo '">Home';
		echo "</a> / ";
		if (is_category() || is_single()) {
			the_category(' ');
			if (is_single()) {
				echo " / ";
				the_title();
			}
		} elseif (is_page()) {
			echo the_title();
		}
	}
	else {
		echo 'Home';
	}
}

// TinyMCE Tyranny

function make_mce_awesome( $init ) {
    $init['theme_advanced_blockformats'] = 'h4,p';
    $init['theme_advanced_disable'] = 'underline,spellchecker,wp_help';
    $init['theme_advanced_more_colors'] = false;
    $init['theme_advanced_text_colors'] = 'ffb37c,000000,777777';
    return $init;
}
 
add_filter('tiny_mce_before_init', 'make_mce_awesome');




// WIdgets
	if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar',
		'before_widget' => '<div class="sidebaritem %2$s %1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer1',
		'before_widget' => '<div class="grid_3 %2$s %1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer2',
		'before_widget' => '<div class="grid_3">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer3',
		'before_widget' => '<div class="grid_3">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

// Add Filter to Widgets for Shortcodes

    add_filter('widget_text', 'do_shortcode');




// Template for comments and pingbacks.

	if ( ! function_exists( 'swpf_comment' ) ) :

function simonwordpressframework_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
  <div id="comment-<?php comment_ID(); ?>">
    <div class="comment-author vcard"> <?php echo get_avatar( $comment, 40 ); ?> <?php printf( __( '%s <span class="says">says:</span>', 'simonwordpressframework' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?> </div>
    <!-- .comment-author .vcard -->
    <?php if ( $comment->comment_approved == '0' ) : ?>
    <em class="comment-awaiting-moderation">
    <?php _e( 'Your comment is awaiting moderation.', 'simonwordpressframework' ); ?>
    </em> <br />
    <?php endif; ?>
    <div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
      <?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'simonwordpressframework' ), get_comment_date(),  get_comment_time() ); ?>
      </a>
      <?php edit_comment_link( __( '(Edit)', 'simonwordpressframework' ), ' ' );
			?>
    </div>
    <!-- .comment-meta .commentmetadata -->
    
    <div class="comment-body">
      <?php comment_text(); ?>
    </div>
    <div class="reply">
      <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <!-- .reply --> 
  </div>
  <!-- #comment-##  -->
  
  <?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
<li class="post pingback">
  <p>
    <?php _e( 'Pingback:', 'simonwordpressframework' ); ?>
    <?php comment_author_link(); ?>
    <?php edit_comment_link( __( '(Edit)', 'simonwordpressframework' ), ' ' ); ?>
  </p>
  <?php
			break;
	endswitch;
}
endif;
	

// Pagination
 
/* Function that Rounds To The Nearest Value.
   Needed for the pagenavi() function */
function round_num($num, $to_nearest) {
   /*Round fractions down (http://php.net/manual/en/function.floor.php)*/
   return floor($num/$to_nearest)*$to_nearest;
}
 
function pagenavi($before = '', $after = '') {
    global $wpdb, $wp_query;
    $pagenavi_options = array();
    $pagenavi_options['pages_text'] = ('Page %CURRENT_PAGE% of %TOTAL_PAGES%:');
    $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['first_text'] = ('First');
    $pagenavi_options['last_text'] = ('Last');
    $pagenavi_options['next_text'] = '&raquo;';
    $pagenavi_options['prev_text'] = '&laquo;';
    $pagenavi_options['dotright_text'] = '...';
    $pagenavi_options['dotleft_text'] = '...';
    $pagenavi_options['num_pages'] = 5; //continuous block of page numbers
    $pagenavi_options['always_show'] = 0;
    $pagenavi_options['num_larger_page_numbers'] = 0;
    $pagenavi_options['larger_page_numbers_multiple'] = 5;
 
    //If NOT a single Post is being displayed
    /*http://codex.wordpress.org/Function_Reference/is_single)*/
    if (!is_single()) {
        $request = $wp_query->request;
        $posts_per_page = intval(get_query_var('posts_per_page'));
        //Retrieve variable in the WP_Query class.
        /*http://codex.wordpress.org/Function_Reference/get_query_var*/
        $paged = intval(get_query_var('paged'));
        $numposts = $wp_query->found_posts;
        $max_page = $wp_query->max_num_pages;
        //empty - Determine whether a variable is empty
        if(empty($paged) || $paged == 0) {
            $paged = 1;
        }
 
        $pages_to_show = intval($pagenavi_options['num_pages']);
        $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
        $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
        $pages_to_show_minus_1 = $pages_to_show - 1;
        $half_page_start = floor($pages_to_show_minus_1/2);
        //ceil - Round fractions up (http://us2.php.net/manual/en/function.ceil.php)
        $half_page_end = ceil($pages_to_show_minus_1/2);
        $start_page = $paged - $half_page_start;
 
        if($start_page <= 0) {
            $start_page = 1;
        }
 
        $end_page = $paged + $half_page_end;
        if(($end_page - $start_page) != $pages_to_show_minus_1) {
            $end_page = $start_page + $pages_to_show_minus_1;
        }
        if($end_page > $max_page) {
            $start_page = $max_page - $pages_to_show_minus_1;
            $end_page = $max_page;
        }
        if($start_page <= 0) {
            $start_page = 1;
        }
 
        $larger_per_page = $larger_page_to_show*$larger_page_multiple;
        //round_num() custom function - Rounds To The Nearest Value.
        $larger_start_page_start = (round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
        $larger_start_page_end = round_num($start_page, 10) + $larger_page_multiple;
        $larger_end_page_start = round_num($end_page, 10) + $larger_page_multiple;
        $larger_end_page_end = round_num($end_page, 10) + ($larger_per_page);
 
        if($larger_start_page_end - $larger_page_multiple == $start_page) {
            $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
            $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
        }
        if($larger_start_page_start <= 0) {
            $larger_start_page_start = $larger_page_multiple;
        }
        if($larger_start_page_end > $max_page) {
            $larger_start_page_end = $max_page;
        }
        if($larger_end_page_end > $max_page) {
            $larger_end_page_end = $max_page;
        }
        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
            /*http://php.net/manual/en/function.str-replace.php */
            /*number_format_i18n(): Converts integer number to format based on locale (wp-includes/functions.php*/
            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
            echo $before.'<div class="pagenavi">'."\n";
 
            if(!empty($pages_text)) {
                echo '<span class="pages">'.$pages_text.'</span>';
            }
            //Displays a link to the previous post which exists in chronological order from the current post.
            /*http://codex.wordpress.org/Function_Reference/previous_post_link*/
            previous_posts_link($pagenavi_options['prev_text']);
 
            if ($start_page >= 2 && $pages_to_show < $max_page) {
                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
                //esc_url(): Encodes < > & " ' (less than, greater than, ampersand, double quote, single quote).
                /*http://codex.wordpress.org/Data_Validation*/
                //get_pagenum_link():(wp-includes/link-template.php)-Retrieve get links for page numbers.
                echo '<a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">1</a>';
                if(!empty($pagenavi_options['dotleft_text'])) {
                    echo '<span class="expand">'.$pagenavi_options['dotleft_text'].'</span>';
                }
            }
 
            if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
                for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
 
            for($i = $start_page; $i  <= $end_page; $i++) {
                if($i == $paged) {
                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
                    echo '<span class="current">'.$current_page_text.'</span>';
                } else {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
 
            if ($end_page < $max_page) {
                if(!empty($pagenavi_options['dotright_text'])) {
                    echo '<span class="expand">'.$pagenavi_options['dotright_text'].'</span>';
                }
                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
                echo '<a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$max_page.'</a>';
            }
            next_posts_link($pagenavi_options['next_text'], $max_page);
 
            if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
                for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
            echo '</div>'.$after."\n";
        }
    }
}

class Eventbrite {
    /**
     * Eventbrite API endpoint
     */
    var $api_endpoint = "https://www.eventbrite.com/json/";


    /**
     * Eventbrite API key (REQUIRED)
     *    http://www.eventbrite.com/api/key/
     * Eventbrite user_key (OPTIONAL, only needed for reading/writing private user data)
     *     http://www.eventbrite.com/userkeyapi
     *
     * Alternate authorization parameters (instead of user_key):
     *   Eventbrite user email
     *   Eventbrite user password
     */
    function Eventbrite( $tokens = null, $user = null, $password = null ) {
        $this->api_url = parse_url($this->api_endpoint);
        $this->auth_tokens = array();
        if(is_array($tokens)){
            if(array_key_exists('access_code', $tokens)){
                $this->auth_tokens = $this->oauth_handshake( $tokens );
            }else{
                $this->auth_tokens = $tokens;
            }
        }else{
            $this->auth_tokens['app_key'] = $tokens;
            if( $password ){
                $this->auth_tokens['user'] = $user;
                $this->auth_tokens['password'] = $password;
            }
            else {
              $this->auth_tokens['user_key'] = $user;
            }
        }
    }

    function oauth_handshake( $tokens ){
        $params = array( 
            'grant_type'=>'authorization_code', 
            'client_id'=> $tokens['app_key'], 
            'client_secret'=> $tokens['client_secret'], 
            'code'=> $tokens['access_code'] );

        $request_url = $this->api_url['scheme'] . "://" . $this->api_url['host'] . '/oauth/token';
        
        // TODO: Replace the cURL code with something a bit more modern - 
        //$context = stream_context_create(array('http' => array( 
        //    'method'  => 'POST', 
        //    'header'  => "Content-type: application/x-www-form-urlencoded\r\n", 
        //    'content' => http_build_query($params)))); 
        //$json_data = file_get_contents( $request_url, false, $context );

        // CURL-POST implementation - 
        // WARNING: This code may require you to install the php5-curl package
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_URL, $request_url); 
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $json_data = curl_exec($ch);
        $resp_info = curl_getinfo($ch);
        curl_close($ch); 

        $response = get_object_vars(json_decode($json_data));
        if( !array_key_exists('access_token', $response) || array_key_exists('error', $response) ){
            throw new Exception( $response['error_description'] );
        }
        return array_merge($tokens, $response);
    }

    // For information about available API methods, see: http://developer.eventbrite.com/doc/
    function __call( $method, $args ) {  
        // Unpack our arguments
        if( is_array( $args ) && array_key_exists( 0, $args ) && is_array( $args[0]) ){
            $params = $args[0];
        }else{
            $params = array();
        }
        
        // Add authentication tokens to querystring
        if(!isset($this->auth_tokens['access_token'])){
            $params = array_merge($params, $this->auth_tokens);
        }
        
        // Build our request url, urlencode querystring params 
        $request_url = $this->api_url['scheme']."://".$this->api_url['host'].$this->api_url['path'].$method.'?'.http_build_query( $params,'','&');
        
        // Call the API
        if(!isset($this->auth_tokens['access_token'])){
            $resp = file_get_contents( $request_url );
        }else{
            $options = array(
                'http'=>array( 'method'=> 'GET',
                               'header'=> "Authorization: Bearer " . $this->auth_tokens['access_token'])
            );
            $resp = file_get_contents( $request_url, false, stream_context_create($options));
        }
        
        // parse our response
        if($resp){
            $resp = json_decode( $resp );
        
            if( isset( $resp->error ) && isset($resp->error->error_message) ){
                throw new Exception( $resp->error->error_message );
            }
        }
        return $resp;
    }

    /*
     * Helpers:
     */
    public static function OAuthLogin($auth_tokens, $get_token='getAccessToken', $save_token='saveAccessToken', $delete_token='deleteAccessToken'){
        $user = false;
        $response = array();
        # Attempt to authenticate this user using an access_token, if available
        if(!isset($auth_tokens['access_token'])){
            if(is_callable($get_token)){
                $auth_tokens['access_token'] = $get_token();
            }elseif(is_callable(array('self',$get_token))){
                $auth_tokens['access_token'] = self::$get_token();
            }
        }
        if( isset($auth_tokens['access_token']) ){
            try{
                // Example using an access_token to initialize the API client:
                $eb = new Eventbrite(array('access_token' => $auth_tokens['access_token']));
                $user = $eb->user_get()->user;
            }catch(Exception $e){
                $user = false;
                // This token may no longer be valid
                //   refresh it, or clear it
                $response['login_error'] = $e->getMessage();
                if(is_callable($delete_token)){
                    $delete_token( $auth_tokens['access_token'] );
                }elseif(is_callable(array('self',$delete_token))){
                    self::$delete_token( $auth_tokens['access_token'] );
                }
            }
        }

        # We do not have a valid access token for this user so far
        if( $user == false ){
            # This user is not yet authenticated - 
            #    it is their first visit, 
            #    or they are returning with an access_code that we will exchange for an access_token,
            #    or they were redirected here after logout
            if( isset($auth_tokens['access_code']) ){
                # This user has just authenticated, get their access token and store it
                try{
                    $eb = new Eventbrite($auth_tokens );
                    $response['access_token'] = $eb->auth_tokens['access_token'];
                    // save this access_token for future use!
                    if(is_callable($save_token)){
                        $save_token( $response['access_token'] );
                    }elseif(is_callable(array('self',$save_token))){
                        self::$save_token( $response['access_token'] );
                    }
                    header('Location: ' . $_SERVER['PHP_SELF'] );
                    exit;
                }catch (Exception $e){
                    $response['login_error'] = $e->getMessage();
                }
            }else if( isset($auth_tokens['error_message'] )){
                if($auth_tokens['error_message'] == 'access_denied'){
                    $response['login_error'] = "Account access denied.";
                }else{
                    $response['login_error'] = $auth_tokens['error_message'];
                }
            }
        }else if(is_object($user)){
            $response['user_email'] = $user->email;
            $response['user_name'] = $user->first_name . ' ' . $user->last_name;
        }
        return $response;
    }

    public static function widgetHTML( $params ){
    // Replace this example with something that works with your Application's templating engine
        $html = "<div class='eb_login_widget'> <h2>Eventbrite Account Access</h2>";
        if( isset($params['user_name']) && isset($params['user_email']) && isset($params['logout_link']) ){
            $html .= "<div><h3>Welcome Back!</h3>";
            $html .= "<p>You are logged in as:<br/>{$params['user_name']}<br/><i>({$params['user_email']})</i></p>";
            $html .= "<p><a class='button' href='{$params['logout_link']}'>Logout</a></p></div>";
      
        }elseif( isset($params['oauth_link']) ){
            if(isset($params['login_error'])){
                $html .= "<p class='error'>{$params['login_error']}</p>";
            }
            $html .= "<p><a class='button' href='{$params['oauth_link']}'>Login with Eventbrite</a></p></div>";
        }else{
            $html .= "<div><h2>Eventbrite widgetHTML template example fail :(</h2></div>";
        }  
        $html .= "</div>";
        return $html;
    }

    public static function oauthNextStep( $key ) {
        return 'https://www.eventbrite.com/oauth/authorize?response_type=code&client_id='.$key;
    }

    public static function eventList($evnts= array(), $callback='eventListRow', $options=false) {
        $html='<div class="eb_event_list">';
        if( isset($evnts->events)){
            foreach( $evnts->events as $evnt ){
                if( isset($evnt->event ) ){
                     if(is_callable($callback)){
                         if($options){
                             $html .= $callback($evnt->event, $options);
                         }else{
                             $html .= $callback($evnt->event);
                         }
                     }else if(is_callable( array('self', $callback))){
                         if($options){
                             $html .= self::$callback($evnt->event, $options);
                         }else{
                             $html .= self::$callback($evnt->event);
                         }
                     }
                }
            }
        }else{
            $html .= "<span class='events_empty'>Stay tuned! Exciting SFTV events are around the corner...</span>";
        }
        return $html . "</div>";
    }

    public static function getAccessToken( ) {
        if(isset($_SESSION['EB_OAUTH_ACCESS_TOKEN'])){
            return $_SESSION['EB_OAUTH_ACCESS_TOKEN'];
        }else{
            return null;
        }
    }

    public static function saveAccessToken( $access_token ) {
        // this function should save the existing user's access_token.
        $_SESSION['EB_OAUTH_ACCESS_TOKEN'] = $access_token;
    }

    public static function deleteAccessToken( ) {
        // this function should remove the existing user's access_token.
        unset($_SESSION['EB_OAUTH_ACCESS_TOKEN']);
    }

    public static function eventListRow( $evnt ) {
        $time = strtotime($evnt->start_date);
        $venue_name = 'online';
        if( isset($evnt->venue) && isset( $evnt->venue->name )){
            $venue_name = $evnt->venue->name;
        }

        return "<div class='eb_event_list_item' id='evnt_div_" . $evnt->id ."'><span class='eb_event_list_date'>" . strftime('%B %e, %Y', $time) . " - </span><span class='eb_event_list_time'>" . strftime('%l:%M %p', $time) . "</span><br/>" ."<a class='eb_event_list_title' href='".$evnt->url."'>".$evnt->title."</a></div>\n";
    }
    /*
     * Widgets:
     */
    public static function loginWidget( $options, $get_token='getAccessToken', $save_token='saveAccessToken', $delete_token='deleteAccessToken', $render_login_box='widgetHTML' ){
        if(  ( isset($options['logout_link']) 
               && $options['logout_link'] == $_SERVER['REQUEST_URI'] )
          // TODO: add a way to disable this default:
          || ( isset($_GET['eb_logout'])
               && $_GET['eb_logout']=="true" )) { 

            // clear this user's access_token -
            Eventbrite::deleteAccessToken(); 
            // remove our "logout=true" trigger from the querystring-
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
        
        // automatically pull the access_code from the querysting?
        // TODO: add a way to disable this:
        if(!isset($options['access_code'] )){
            $options['access_code'] = isset($_REQUEST['code']) ? $_REQUEST['code'] : null;
        }
        // automatically grab errors from the querystring?
        // TODO: add a way to disable this:
        if(!isset($options['error_message'])){
            $options['error_message'] = isset($_REQUEST['error']) ? $_REQUEST['error'] : null;
        }

        //  Check to see if we have a valid user account
        //  and Proccess any data-related work:
        $response = Eventbrite::OAuthLogin($options, $get_token, $save_token, $delete_token);
        
        //  package up the data for our view / template:
        $login_params = array();
        if( is_array($response)){
            if( isset( $response['user_email']) ){
                $login_params = array('user_name'  => $response['user_name'],
                                      'user_email' => $response['user_email']);
            }
            $login_params['oauth_link'] = Eventbrite::oauthNextStep($options['app_key']);
            if(isset( $response['login_error'])){
                $login_params['login_error'] = $response['login_error'];
            }
            if(isset( $options['logout_link'])){
                $login_params['logout_link'] = $options['logout_link'];
            }else{
                $login_params['logout_link'] = $_SERVER['PHP_SELF'] . '?eb_logout=true';
            }
        }
        
        // view related work:
        //  render your "template"
        if(is_callable($render_login_box)){
            return $render_login_box( $login_params );
        }elseif(is_callable(array('self',$render_login_box))){
            return self::$render_login_box( $login_params );  
        }else{
            //the templating callback was not valid, 
            //return the raw data for use with an external template
            return $login_params;
        }
    }

    public static function ticketWidget( $evnt, $height='650px', $width='100%' ) {
        return '<div style="width:100%; text-align:left;" ><iframe src="http://www.eventbrite.com/tickets-external?eid=' . $evnt->id . '&ref=etckt" frameborder="0" height="'.$height.'" width="'.$width.'" vspace="0" hspace="0" marginheight="5" marginwidth="5" scrolling="auto" allowtransparency="true"></iframe><div style="font-family:Helvetica, Arial; font-size:10px; padding:5px 0 5px; margin:2px; width:100%; text-align:left;" ><a style="color:#ddd; text-decoration:none;" target="_blank" href="http://www.eventbrite.com/r/etckt" >Online Ticketing</a><span style="color:#ddd;" > for </span><a style="color:#ddd; text-decoration:none;" target="_blank" href="http://www.eventbrite.com/event/' . $evnt->id . '?ref=etckt" >' . $evnt->title . '</a><span style="color:#ddd;" > powered by </span><a style="color:#ddd; text-decoration:none;" target="_blank" href="http://www.eventbrite.com?ref=etckt" >Eventbrite</a></div></div>';
    }

    public static function registrationWidget( $evnt ) {
        return '<div style="width:100%; text-align:left;" ><iframe src="http://www.eventbrite.com/event/' . $evnt->id . '?ref=eweb" frameborder="0" height="1000" width="100%" vspace="0" hspace="0" marginheight="5" marginwidth="5" scrolling="auto" allowtransparency="true"></iframe><div style="font-family:Helvetica, Arial; font-size:10px; padding:5px 0 5px; margin:2px; width:100%; text-align:left;" ><a style="color:#ddd; text-decoration:none;" target="_blank" href="http://www.eventbrite.com/r/eweb" >Online Ticketing</a><span style="color:#ddd;" > for </span><a style="color:#ddd; text-decoration:none;" target="_blank" href="http://www.eventbrite.com/event/' . $evnt->id . '?ref=eweb" >' . $evnt->title . '</a><span style="color:#ddd;" > powered by </span><a style="color:#ddd; text-decoration:none;" target="_blank" href="http://www.eventbrite.com?ref=eweb" >Eventbrite</a></div></div>';

    }

    public static function calendarWidget( $evnt ) {
        return '<div style="width:195px; text-align:center;" ><iframe src="http://www.eventbrite.com/calendar-widget?eid=' . $evnt->id . '" frameborder="0" height="382" width="195" marginheight="0" marginwidth="0" scrolling="no" allowtransparency="true"></iframe><div style="font-family:Helvetica, Arial; font-size:10px; padding:5px 0 5px; margin:2px; width:195px; text-align:center;" ><a style="color:#ddd; text-decoration:none;" target="_blank" href="http://www.eventbrite.com/r/ecal">Online event registration</a><span style="color:#ddd;" > powered by </span><a style="color:#ddd; text-decoration:none;" target="_blank" href="http://www.eventbrite.com?ref=ecal" >Eventbrite</a></div></div>';
    }

    public static function countdownWidget( $evnt ) {
        return '<div style="width:195px; text-align:center;" ><iframe src="http://www.eventbrite.com/countdown-widget?eid=' . $evnt->id . '" frameborder="0" height="479" width="195" marginheight="0" marginwidth="0" scrolling="no" allowtransparency="true"></iframe><div style="font-family:Helvetica, Arial; font-size:10px; padding:5px 0 5px; margin:2px; width:195px; text-align:center;" ><a style="color:#ddd; text-decoration:none;" target="_blank" href="http://www.eventbrite.com/r/ecount" >Online event registration</a><span style="color:#ddd;" > for </span><a style="color:#ddd; text-decoration:none;" target="_blank" href="http://www.eventbrite.com/event/' . $evnt->id . '?ref=ecount" >' . $evnt->title . '</a></div></div>'; 
    }

    public static function buttonWidget( $evnt ) {
        return '<a href="http://www.eventbrite.com/event/' . $evnt->id . '?ref=ebtn" target="_blank"><img border="0" src="http://www.eventbrite.com/custombutton?eid=' . $evnt->id . '" alt="Register for ' . $evnt->title . ' on Eventbrite" /></a>';
    }

    public static function linkWidget( $evnt, $text=null, $color=null ) {
        return '<a href="http://www.eventbrite.com/event/' . $evnt->id . '?ref=elink" target="_blank" style="color:' . ( $color ? $color : "#000000" ) . ';">' . ( $text ? $text : $evnt->title ) . '</a>';
    }
};


?>
