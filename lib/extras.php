<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more($more) {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
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
 * Manage output of wp_title()
 */
function roots_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  return $title;
}
add_filter('wp_title', 'roots_wp_title', 10);

/**
 * Set low priorty for WordPress SEO metabox
 */
add_filter( 'wpseo_metabox_prio', function() {
  return 'low';
});

/**
 * Remove WordPress SEO columns
 */
add_filter( 'wpseo_use_page_analysis', '__return_false' );

/**
 * Remove TablePress CSS
 **/
add_filter('tablepress_use_default_css', '__return_false');

/**
 * Hide ACF admin on production and staging
 **/
function my_remove_acf_menu() {
  if ( WP_ENV === 'production' || WP_ENV === 'staging' ) {
    remove_menu_page('edit.php?post_type=acf-field-group');
  }
}
add_action( 'admin_menu', 'my_remove_acf_menu', 999 );