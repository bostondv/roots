<?php

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