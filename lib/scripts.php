<?php
/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/build/css/main.css
 *
 * Enqueue scripts in the following order:
 * 1. jQuery
 * 2. /theme/build/js/main.js (in footer)
 */
function roots_scripts() {
  wp_enqueue_style('roots_styles', get_template_directory_uri() . '/build/css/main.css', false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_deregister_script('jquery');
  wp_register_script('jquery', '/wp-includes/js/jquery/jquery.js', false, null, true);
  wp_enqueue_script('jquery');

  wp_register_script('roots_scripts', get_template_directory_uri() . '/build/js/main.js', array('jquery'), null, true);
  wp_enqueue_script('roots_scripts');
}
add_action('wp_enqueue_scripts', 'roots_scripts', 100);

function roots_admin_scripts() {
  wp_register_script('admin_scripts', get_template_directory_uri() . '/build/js/admin.js', array('jquery'), false, true);
  wp_enqueue_script('admin_scripts');
}
add_action('admin_enqueue_scripts', 'roots_admin_scripts', 100);

/**
 * Google Analytics snippet from HTML5 Boilerplate
 */
function roots_google_analytics() { ?>
<script>
  (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
  function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
  e=o.createElement(i);r=o.getElementsByTagName(i)[0];
  e.src='//www.google-analytics.com/analytics.js';
  r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
  ga('create','<?php echo GOOGLE_ANALYTICS_ID; ?>');ga('send','pageview');
</script>

<?php }
if (GOOGLE_ANALYTICS_ID && !current_user_can('manage_options')) {
  add_action('wp_footer', 'roots_google_analytics', 20);
}
