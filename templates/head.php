<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <title><?php wp_title(''); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/build/img/favicon.png">
  <link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/build/img/apple-touch-icon.png">
  
  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo esc_url(get_feed_link()); ?>">

  <?php wp_head(); ?>
</head>
