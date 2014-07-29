<?php

/**
 * Add theme support
 */
add_theme_support('woocommerce');

/**
 * Check if WooCommerce is active
 **/
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

  /**
   * Run on init
   */
  function woocommerce_core_on_init() {
    add_filter('breadcrumb_trail_items', 'woocommerce_core_breadcrumb_trail_items', 2 , 10);
    add_filter('image_size_names_choose', 'woocommerce_core_remove_image_size_options');

    add_filter('loop_shop_columns', 'loop_columns', 999);
    add_filter('woocommerce_cross_sells_columns', 'loop_columns', 999);
    //add_filter ('woocommerce_product_thumbnails_columns', 'xx_thumb_cols');
    
    /**
     * Set limit for number of related products to show
     */
    add_filter('woocommerce_related_products_args', 'woo_related_products_limit');
    add_filter('woocommerce_product_related_posts', 'woo_related_products_limit');

    /**
     * Remove WooCommerce page header in favour of our own
     **/
    add_filter('woocommerce_show_page_title', '__return_false');
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
  }

  add_action('init', 'woocommerce_core_on_init');
  add_action('init', 'woocommerce_image_dimensions', 1);

  remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

  add_filter('woocommerce_enqueue_styles', '__return_false');

  add_filter('loop_shop_per_page', create_function('$cols', 'return 12;'), 20);
  add_filter('roots/display_sidebar', 'roots_woocommerce_sidebar_display');
  
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
 * Gets the items for the breadcrumb trail if woocommerce is installed.
 */
function woocommerce_core_breadcrumb_trail_items($trail = array() , $args = array()) {

  global $post, $wp_query;

  $permalinks   = get_option('woocommerce_permalinks');
  $shop_page_id = woocommerce_get_page_id('shop');
  $shop_page    = get_post($shop_page_id);
  
  if (is_woocommerce()) {

    /* Set up a new items */
    $trail = array();
    
    if (!is_front_page())
      $trail[] = '<a href="' . home_url() . '" title="' . esc_attr(get_bloginfo('name')) . '" rel="home" class="trail-begin">Home</a>';

    /* If permalinks contain the shop page in the URI prepend the breadcrumb with shop */
    if ($shop_page_id && strstr($permalinks['product_base'],  '/' . $shop_page->post_name) && get_option('page_on_front') !== $shop_page_id) {

      if (is_product_category() || is_product_tag() || is_product()) {
        $trail[] = '<a href="' . get_permalink($shop_page) . '">' . $shop_page->post_title . '</a>';
      } else {
        $trail[] = $shop_page->post_title;
      }
    
    }
  
  }
  
  /* If is product category archive */    
  if (is_product_category()) {

    $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

    $ancestors = array_reverse(get_ancestors($current_term->term_id, get_query_var('taxonomy')));

    foreach ($ancestors as $ancestor) {

      $ancestor = get_term($ancestor, get_query_var('taxonomy'));

      $trail[] = '<a href="' . get_term_link($ancestor->slug, get_query_var('taxonomy')) . '">' . esc_html($ancestor->name) . '</a>';

    }

    $queried_object = $wp_query->get_queried_object();
    
    $trail[] = $queried_object->name;

  }   

  /* If is product tag archive */
  if (is_product_tag()) {

    $queried_object = $wp_query->get_queried_object();
        
    $trail[] =  __('Products tagged &ldquo;', 'woocommerce') . $queried_object->name . '&rdquo;' ;

  }

  /* If is single product */
  if (is_product()) {

    if ($terms = wp_get_object_terms($post->ID, 'product_cat')) {
    
      $term = current($terms);
      $parents = array();
      $parent = $term->parent;
      
      while ($parent) {
        $parents[] = $parent;
        $new_parent = get_term_by('id', $parent, 'product_cat');
        $parent = $new_parent->parent;
      }
      
      if (! empty($parents)) {
        $parents = array_reverse($parents);
        foreach ($parents as $parent) {
          $item = get_term_by('id', $parent, 'product_cat');
          $trail[] = '<a href="' . get_term_link($item->slug, 'product_cat') . '">' . $item->name . '</a>';
        }
      }
      
      $trail[] = '<a href="' . get_term_link($term->slug, 'product_cat') . '">' . $term->name . '</a>';
    
    }

    $trail[] =  get_the_title() ;

  }
    
  /* Return the woocommerce breadcrumb trail items. */
  return apply_filters('woocommerce_core_breadcrumb_trail_items', $trail, $args);
  
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
 **/
function roots_woocommerce_sidebar_display($display) {
  if (is_woocommerce() || is_account_page() || is_cart() || is_checkout()) {
    return false;
  }
}

