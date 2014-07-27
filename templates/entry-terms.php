<p class="entry-terms">
  <span class="entry-categories">
    <span class="before"><?php _e('Posted in', 'roots'); ?></span>
    <?php echo get_the_term_list(get_the_id(), 'category', '', ', ', ''); ?>
  </span>
  <span class="separator">|</span>
  <span class="entry-tags">
    <span class="before"><?php _e('Tagged', 'roots'); ?></span>
    <?php echo get_the_term_list(get_the_id(), 'post_tag', '', ', ', ''); ?>
  </span>
</p>