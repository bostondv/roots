<?php
/**
 * Roots includes
 *
 * The $roots_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/roots/pull/1042
 */
$roots_includes = array(
  'lib/utils.php',           // Utility functions
  'lib/init.php',            // Initial theme setup and constants
  'lib/wrapper.php',         // Theme wrapper class
  'lib/sidebar.php',         // Sidebar class
  'lib/config.php',          // Configuration
  'lib/titles.php',          // Page titles
  'lib/scripts.php',         // Scripts and stylesheets
  'lib/extras.php',          // Custom functions
  'lib/extensions/breadcrumbs.php',
  'lib/extensions/bootstrap-comments.php',
  'lib/extensions/bootstrap-breadcrumbs.php',
  'lib/extensions/bootstrap-gravity-forms.php',
  'lib/extensions/bootstrap-nav-walker.php',
  'lib/extensions/bootstrap-pagination.php',
  'lib/extensions/bootstrap-woocommerce.php',
  'lib/extensions/bootstrap-media.php',
  'lib/extensions/gravity-forms-multi-column.php',
  'lib/extensions/woocommerce-core.php',
  'lib/extensions/wp-link-pages-extended.php'
);

foreach ($roots_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'roots'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
