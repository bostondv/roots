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
 * Add .thumbnail class to captions
 */
function roots_caption($output, $attr, $content) {
  return str_replace('class="wp-caption', 'class="wp-caption thumbnail', $output);
}
add_filter('img_caption_shortcode', 'roots_caption', 15, 3);

/**
 * Wrap embedded media using Bootstrap responsive embeds
 *
 * @link http://getbootstrap.com/components/#responsive-embed
 */
function roots_embed_wrap($cache, $url, $attr = '', $post_ID = '') {
  $cache = str_replace('<iframe', '<iframe class="embed-responsive-item"', $cache);
  return '<div class="embed-responsive embed-responsive-16by9">' . $cache . '</div>';
}
add_filter('embed_oembed_html', 'roots_embed_wrap', 20, 4);

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
add_action( 'admin_menu', 'roots_remove_acf_menu', 999 );