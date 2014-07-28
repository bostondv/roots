<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); ?>
<?php if (roots_display_jumbotron() && $image[0]) : ?>
  <div class="jumbotron">
    <div class="container">
      <img src="<?php echo $image[0]; ?>" alt="<?php echo get_post(get_post_thumbnail_id())->post_title; ?>" itemprop="image">
    </div>
  </div>
<?php endif; ?>