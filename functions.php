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
  'lib/utils.php',
  'lib/init.php',
  'lib/wrapper.php',
  'lib/sidebar.php',
  'lib/config.php',
  'lib/titles.php',
  'lib/scripts.php',
  'lib/extras.php',
  'lib/breadcrumbs.php',
  'lib/link-pages.php',
  'lib/bootstrap/comments.php',
  'lib/bootstrap/breadcrumbs.php',
  'lib/bootstrap/nav-walker.php',
  'lib/bootstrap/pagination.php',
  'lib/bootstrap/media.php',
  'lib/bootstrap/gravity-forms.php',
  'lib/bootstrap/woocommerce.php',
  'lib/gravity-forms/multi-column.php',
  'lib/woocommerce/core.php',
  'lib/woocommerce/breadcrumbs.php',
  'lib/woocommerce/custom.php'
);

foreach ($roots_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'roots'), $file), E_USER_ERROR);
  }
  require_once $filepath;
}
unset($file, $filepath);
