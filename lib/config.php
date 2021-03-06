<?php
/**
 * Enable theme features
 */
add_theme_support('soil-clean-up');
add_theme_support('soil-relative-urls');
add_theme_support('soil-nice-search');
add_theme_support('soil-disable-trackbacks');
add_theme_support('soil-disable-asset-versioning');
add_theme_support('numbered-pagination');

/**
 * Configuration values
 */
define('GOOGLE_ANALYTICS_ID', ''); // UA-XXXXX-Y (Note: Universal Analytics only, not Classic Analytics)

/**
 * .main classes
 */
function roots_main_class() {
  if (roots_display_sidebar()) {
    // Classes on pages with the sidebar
    $class = 'col-sm-8';
  } else {
    // Classes on full width pages
    $class = 'col-sm-12';
  }

  return apply_filters('roots/main_class', $class);
}

/**
 * .sidebar classes
 */
function roots_sidebar_class() {
  return apply_filters('roots/sidebar_class', 'col-sm-4');
}

/**
 * Define which pages shouldn't have the sidebar
 *
 * See lib/sidebar.php for more details
 */
function roots_display_sidebar() {
  $sidebar_config = new Roots_Sidebar(
    /**
     * Conditional tag checks (http://codex.wordpress.org/Conditional_Tags)
     * Any of these conditional tags that return true won't show the sidebar
     *
     * To use a function that accepts arguments, use the following format:
     *
     * array('function_name', array('arg1', 'arg2'))
     *
     * The second element must be an array even if there's only 1 argument.
     */
    array(
      'is_404',
      'is_front_page'
    ),
    /**
     * Page template checks (via is_page_template())
     * Any of these page templates that return true won't show the sidebar
     */
    array(
      'template-custom.php'
    )
  );

  return apply_filters('roots/display_sidebar', $sidebar_config->display);
}

/**
 * Define which pages should display jumbotron
 */
function roots_display_jumbotron() {
  if (function_exists('is_woocommerce') && is_woocommerce()) {
    $display = false;
  } elseif (is_single()) {
    $display = true;
  } else {
    $display = false;
  }

  return apply_filters('roots/display_jumbotron', $display);
}

/**
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 1140px is the default Bootstrap container width.
 */
if (!isset($content_width)) { $content_width = 1140; }
