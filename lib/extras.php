<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more($more) {
  return '&hellip; <a href="' . get_permalink() . '">' . __('Read More &rarr;', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Custom excerpt length
 */
function roots_excerpt_length($length) {
  return 20;
}
add_filter('excerpt_length', 'roots_excerpt_length');

/**
 * Change .hentry to .entry from post_class() because we use microdata
 */
function roots_post_class($classes) {
  $key = array_search('hentry', $classes);
  if ($key) $classes[$key] = 'entry';
  return $classes;
}
add_filter('post_class', 'roots_post_class');

/**
 * Set low priorty for WordPress SEO metabox
 */
add_filter('wpseo_metabox_prio', function() {
  return 'low';
});

/**
 * Remove WordPress SEO columns
 */
add_filter('wpseo_use_page_analysis', '__return_false');

/**
 * Remove TablePress CSS
 **/
add_filter('tablepress_use_default_css', '__return_false');

/**
 * Hide ACF admin on production and staging
 **/
function roots_remove_acf_menu() {
  if (defined('WP_ENV') && (WP_ENV === 'production' || WP_ENV === 'staging')) {
    remove_menu_page('edit.php?post_type=acf-field-group');
  }
}
add_action('admin_menu', 'roots_remove_acf_menu', 999);
