<p class="entry-byline">
  <span class="published">Published</span>
  <span class="author" itemprop="author" itemscope itemtype="http://schema.org/Person">
    <span class="by"><?php echo __('by', 'roots'); ?></span>
    <span itemprop="name"><?php echo get_the_author(); ?></span>
  </span>
  <span class="on">on</span>
  <time class="published" datetime="<?php echo get_the_time('c'); ?>" itemprop="datePublished">
    <?php echo get_the_date(); ?>
  </time>
  <?php if (comments_open()) : ?>
    <span class="separator">|</span>
    <a href="<?php comments_link(); ?>" class="entry-link" itemprop="url">
      <?php comments_number(__('No responses', 'roots'), __('One response', 'roots'), __('% responses', 'roots')); ?>
    </a>
  <?php endif; ?>
</p>
