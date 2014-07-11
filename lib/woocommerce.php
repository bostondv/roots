<?php
/**
 * WooCommerce
 **/

/**
 * Remove WooCommerce CSS
 **/
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

/**
 * General woocommerce actions and hooks
 **/
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

/**
 * Override up-sells function to change it to 3 column output
 **/
function woocommerce_upsell_display( $posts_per_page = '-1', $columns = 3, $orderby = 'rand' ) {
  wc_get_template( 'single-product/up-sells.php', array(
    'posts_per_page'    => $posts_per_page,
    'orderby'           => apply_filters( 'woocommerce_upsells_orderby', $orderby ),
    'columns'           => apply_filters( 'woocommerce_upsells_columns', $columns )
  ) );
}

/**
 * Hide sidebar on woocommerce pages
 **/
function roots_woocommerce_sidebar_display( $display ) {
  if ( is_woocommerce() || is_account_page() || is_cart() || is_checkout() {
    return false;
  }
}
add_filter( 'roots/display_sidebar', 'roots_woocommerce_sidebar_display' );
