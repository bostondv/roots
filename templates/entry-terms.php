<p class="entry-terms">
  <?php $categories = get_the_term_list(get_the_id(), 'category', '', ', ', ''); ?>
  <?php $tags = get_the_term_list(get_the_id(), 'post_tag', '', ', ', ''); ?>
  <?php if ($categories) : ?>
    <span class="entry-categories">
      <span class="before"><?php _e('Posted in', 'roots'); ?></span>
      <?php echo $categories; ?>
    </span>
  <?php endif; ?>
  <?php if ($categories && $tags) : ?>
    <span class="separator"><?php _e('|', 'roots'); ?></span>
  <?php endif; ?>
  <?php if ($tags) : ?>
    <span class="entry-tags">
      <span class="before"><?php _e('Tagged', 'roots'); ?></span>
      <?php echo get_the_term_list(get_the_id(), 'post_tag', '', ', ', ''); ?>
    </span>
  <?php endif; ?>
</p>