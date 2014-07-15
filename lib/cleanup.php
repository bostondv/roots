<?php
/**
 * Clean up wp_head()
 *
 * Remove unnecessary <link>'s
 * Remove inline CSS used by Recent Comments widget
 * Remove inline CSS used by posts with galleries
 * Remove self-closing tag and change ''s to "'s on rel_canonical()
 */
function roots_head_cleanup() {
  // Originally from http://wpengineer.com/1438/wordpress-header/
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

  global $wp_widget_factory;
  remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));

  if (!class_exists('WPSEO_Frontend')) {
    remove_action('wp_head', 'rel_canonical');
    add_action('wp_head', 'roots_rel_canonical');
  }
}

function roots_rel_canonical() {
  global $wp_the_query;

  if (!is_singular()) {
    return;
  }

  if (!$id = $wp_the_query->get_queried_object_id()) {
    return;
  }

  $link = get_permalink($id);
  echo "\t<link rel=\"canonical\" href=\"$link\">\n";
}
add_action('init', 'roots_head_cleanup');

/**
 * Remove the WordPress version from RSS feeds
 */
add_filter('the_generator', '__return_false');

/**
 * Clean up language_attributes() used in <html> tag
 *
 * Remove dir="ltr"
 */
function roots_language_attributes() {
  $attributes = array();
  $output = '';

  if (is_rtl()) {
    $attributes[] = 'dir="rtl"';
  }

  $lang = get_bloginfo('language');

  if ($lang) {
    $attributes[] = "lang=\"$lang\"";
  }

  $output = implode(' ', $attributes);
  $output = apply_filters('roots_language_attributes', $output);

  return $output;
}
add_filter('language_attributes', 'roots_language_attributes');

/**
 * Clean up output of stylesheet <link> tags
 */
function roots_clean_style_tag($input) {
  preg_match_all("!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches);
  // Only display media if it is meaningful
  $media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
  return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}
add_filter('style_loader_tag', 'roots_clean_style_tag');

/**
 * Add and remove body_class() classes
 */
function roots_body_class($classes) {
  // Add post/page slug
  if (is_single() || is_page() && !is_front_page()) {
    $classes[] = basename(get_permalink());
  }

  // Remove unnecessary classes
  $home_id_class = 'page-id-' . get_option('page_on_front');
  $remove_classes = array(
    'page-template-default',
    $home_id_class
  );
  $classes = array_diff($classes, $remove_classes);

  return $classes;
}
add_filter('body_class', 'roots_body_class');

/**
 * Wrap embedded media as suggested by Readability
 *
 * @link https://gist.github.com/965956
 * @link http://www.readability.com/publishers/guidelines#publisher
 */
function roots_embed_wrap($cache, $url, $attr = '', $post_ID = '') {
  return '<div class="entry-content-asset">' . $cache . '</div>';
}
add_filter('embed_oembed_html', 'roots_embed_wrap', 10, 4);

/**
 * Add Bootstrap thumbnail styling to images with captions
 * Use <figure> and <figcaption>
 *
 * @link http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
 */
function roots_caption($output, $attr, $content) {
  if (is_feed()) {
    return $output;
  }

  $defaults = array(
    'id'      => '',
    'align'   => 'alignnone',
    'width'   => '',
    'caption' => ''
  );

  $attr = shortcode_atts($defaults, $attr);

  // If the width is less than 1 or there is no caption, return the content wrapped between the [caption] tags
  if ($attr['width'] < 1 || empty($attr['caption'])) {
    return $content;
  }

  // Set up the attributes for the caption <figure>
  $attributes  = (!empty($attr['id']) ? ' id="' . esc_attr($attr['id']) . '"' : '' );
  $attributes .= ' class="thumbnail wp-caption ' . esc_attr($attr['align']) . '"';
  $attributes .= ' style="width: ' . (esc_attr($attr['width']) + 10) . 'px"';

  $output  = '<figure' . $attributes .'>';
  $output .= do_shortcode($content);
  $output .= '<figcaption class="caption wp-caption-text">' . $attr['caption'] . '</figcaption>';
  $output .= '</figure>';

  return $output;
}
add_filter('img_caption_shortcode', 'roots_caption', 10, 3);

/**
 * Remove unnecessary dashboard widgets
 *
 * @link http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
 */
function roots_remove_dashboard_widgets() {
  remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
  remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
  remove_meta_box('dashboard_primary', 'dashboard', 'normal');
  remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
}
add_action('admin_init', 'roots_remove_dashboard_widgets');

/**
 * Remove unnecessary self-closing tags
 */
function roots_remove_self_closing_tags($input) {
  return str_replace(' />', '>', $input);
}
add_filter('get_avatar',          'roots_remove_self_closing_tags'); // <img />
add_filter('comment_id_fields',   'roots_remove_self_closing_tags'); // <input />
add_filter('post_thumbnail_html', 'roots_remove_self_closing_tags'); // <img />

/**
 * Don't return the default description in the RSS feed if it hasn't been changed
 */
function roots_remove_default_description($bloginfo) {
  $default_tagline = 'Just another WordPress site';
  return ($bloginfo === $default_tagline) ? '' : $bloginfo;
}
add_filter('get_bloginfo_rss', 'roots_remove_default_description');

/**
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 *
 * @link http://txfx.net/wordpress-plugins/nice-search/
 */
function roots_nice_search_redirect() {
  global $wp_rewrite;
  if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->using_permalinks()) {
    return;
  }

  $search_base = $wp_rewrite->search_base;
  if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {
    wp_redirect(home_url("/{$search_base}/" . urlencode(get_query_var('s'))));
    exit();
  }
}
if (current_theme_supports('nice-search')) {
  add_action('template_redirect', 'roots_nice_search_redirect');
}

/**
 * Fix for empty search queries redirecting to home page
 *
 * @link http://wordpress.org/support/topic/blank-search-sends-you-to-the-homepage#post-1772565
 * @link http://core.trac.wordpress.org/ticket/11330
 */
function roots_request_filter($query_vars) {
  if (isset($_GET['s']) && empty($_GET['s'])) {
    $query_vars['s'] = ' ';
  }

  return $query_vars;
}
add_filter('request', 'roots_request_filter');

/**
 * Disable pingback XMLRPC method
 */
function roots_filter_xmlrpc_method( $methods ) {
  unset( $methods['pingback.ping'] );
  return $methods;
}
add_filter( 'xmlrpc_methods', 'roots_filter_xmlrpc_method', 10, 1 );

/**
 * Remove pingback header
 */
function roots_filter_headers( $headers ) {
  if( isset( $headers['X-Pingback'] ) ) {
    unset( $headers['X-Pingback'] );
  }
  return $headers;
}
add_filter( 'wp_headers', 'roots_filter_headers', 10, 1 );
 
/**
 * Kill trackback rewrite rule
 */
function roots_filter_rewrites( $rules ) {
  foreach( $rules as $rule => $rewrite ) {
    if( preg_match( '/trackback\/\?\$$/i', $rule ) )
    {
      unset( $rules[$rule] );
    }
  }
  return $rules;
}
add_filter( 'rewrite_rules_array', 'roots_filter_rewrites' );
 
/**
 * Kill bloginfo( 'pingback_url' )
 */
function roots_kill_pingback_url( $output, $show ) {
  if( $show == 'pingback_url' ) {
    $output = '';
  }
  return $output;
}
add_filter( 'bloginfo_url', 'roots_kill_pingback_url', 10, 2 );

/**
 * hijack options updating for XMLRPC
 */
add_filter( 'pre_update_option_enable_xmlrpc', '__return_false' );
add_filter( 'pre_option_enable_xmlrpc', '__return_zero' );
 
/**
 * Disable XMLRPC call
 */
function roots_kill_xmlrpc( $action ) {
  if( 'pingback.ping' === $action ) {
    wp_die( 
      'Pingbacks are not supported', 
      'Not Allowed!', 
      array( 'response' => 403 )
    );
  }
}
add_action( 'xmlrpc_call', 'roots_kill_xmlrpc' );