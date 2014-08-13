<?php

/**
 * Add theme support
 */
add_theme_support('woocommerce');


/**
 * Check if WooCommerce is active before running hooks
 */
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
  add_action('init', 'woocommerce_core_on_init');
  add_action('init', 'woocommerce_image_dimensions', 1);
  add_filter('woocommerce_enqueue_styles', '__return_false');
  add_filter('loop_shop_per_page', create_function('$cols', 'return 12;'), 20);
  add_filter('roots/display_sidebar', 'roots_woocommerce_sidebar_display');
  remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
}


/**
 * Run on init
 */
function woocommerce_core_on_init() {
  add_filter('breadcrumb_trail_items', 'woocommerce_core_breadcrumb_trail_items', 2 , 10);
  add_filter('image_size_names_choose', 'woocommerce_core_remove_image_size_options');
  add_filter('loop_shop_columns', 'loop_columns', 999);
  add_filter('woocommerce_cross_sells_columns', 'loop_columns', 999);
  //add_filter ('woocommerce_product_thumbnails_columns', 'xx_thumb_cols');
  add_filter('woocommerce_related_products_args', 'woo_related_products_limit');
  add_filter('woocommerce_product_related_posts', 'woo_related_products_limit');
  add_filter('woocommerce_show_page_title', '__return_false');
  remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
}


/**
 * Override theme default specification for product # per row
 */
function loop_columns() {
  return 4;
}


/**
 * Override theme default specification for thumbnail # per row
 */
function xx_thumb_cols() {
  return 4;
}


/**
 * Override the number of related products to display
 */
function woo_related_products_limit($args) {
  $args['posts_per_page'] = 4;
  return $args;
}


/**
 * Remove image sizes from the list of available sizes in the media uploader
 */ 
function woocommerce_core_remove_image_size_options($sizes){
  unset($sizes['shop_catalog']);
  unset($sizes['shop_thumbnail']);
  unset($sizes['shop_single']);
  return $sizes;
}


/**
* Define image sizes
*/
function woocommerce_image_dimensions() {

  $catalog = array(
    'width' => '236', // px
    'height'  => '236', // px
    'crop'  => 1 // true
 );
   
  $single = array(
    'width' => '527', // px
    'height'  => '527', // px
    'crop'  => 1 // true
 );

  $thumbnail = array(
    'width' => '153', // px
    'height'  => '153', // px
    'crop'  => 1 // false
 );
 
  // Image sizes
  update_option('shop_catalog_image_size', $catalog); // Product category thumbs
  update_option('shop_single_image_size', $single); // Single product image
  update_option('shop_thumbnail_image_size', $thumbnail); // Image gallery thumbs

}


/**
 * Hide sidebar on woocommerce pages
 */
function roots_woocommerce_sidebar_display($display) {
  if (is_woocommerce() || is_account_page() || is_cart() || is_checkout()) {
    return false;
  }
}

