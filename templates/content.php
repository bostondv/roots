<article <?php post_class('clearfix'); ?> itemscope itemtype="http://schema.org/Article">
  <header>
    <h2 class="entry-title">
      <a href="<?php the_permalink(); ?>">
        <span itemprop="name"><?php the_title(); ?></span>
      </a>
    </h2>
    <?php get_template_part('templates/entry', 'byline'); ?>
  </header>
  <div class="entry-summary" itemprop="description">
    <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail'); ?>
    <?php if ($image[0]) : ?>
      <img src="<?php echo $image[0]; ?>" alt="<?php echo get_post(get_post_thumbnail_id())->post_title; ?>" itemprop="image" class="thumbnail alignleft">
    <?php endif; ?>
    <?php the_content(__('Read More &rarr;', 'roots')); ?>
  </div>
  <footer>
    <?php get_template_part('templates/entry', 'terms'); ?>
  </footer>
</article>
