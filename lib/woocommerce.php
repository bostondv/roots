<?php
/**
 * WooCommerce
 */

// Remove woocommerce css
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Custom action and filter hooks
function roots_woocommerce_hooks() {

  // Remove WooCommerce page header in favour of our own
  add_filter( 'woocommerce_show_page_title', '__return_false' );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

  // Move catalog add to cart inside panel
  remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
  add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );

  // Related products output args
  add_filter( 'woocommerce_output_related_products_args', function() {
    return array(
      'posts_per_page' => 3,
      'columns' => 3,
      'orderby' => 'rand'
    );
  });

}
add_action( 'init', 'roots_woocommerce_hooks' );
