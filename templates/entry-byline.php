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
    <?php (int) $num = get_comments_number(); ?>
    <span class="separator">|</span>
    <a href="<?php comments_link(); ?>" class="entry-link" itemprop="url">
      <?php
      if ($num === 0) {
        echo __('Leave a response', 'roots');
      } elseif ($num === 1) {
        echo sprintf(__('%1$s Response', 'roots'), $num);
      } elseif ($num > 1) {
        echo sprintf(__('%1$s Responses', 'roots'), $num);
      }
      ?>
    </a>
  <?php endif; ?>
</p>
