<nav class="pagination-wrapper" role="navigation">
  <?php if (is_single()) : ?>
    <?php 
    if (function_exists('wp_link_pages_extended')) {
      wp_link_pages_extended(array('<ul class="pagination">', 'after' => '</ul>', 'before_page' => '<li>', 'before_current_page' => '<li class="active">', 'after_page' => '</li>')); 
    } else {
      wp_link_pages();
    }
    ?>
  <?php else : ?>
    <?php if ($wp_query->max_num_pages > 1) : ?>
      <?php if (current_theme_supports('numbered-pagination') && function_exists('bootstrap_loop_pagination')) : ?>
        <?php bootstrap_loop_pagination(array('type' => 'list', 'prev_text' => __('&larr; Previous', 'roots'), 'next_text' => __('Next &rarr;', 'roots'), 'echo' => true)); ?>
      <?php else : ?>
        <ul class="pager">
          <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
          <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
        </ul>
      <?php endif; ?>
    <?php endif; ?>
  <?php endif; ?>
</nav>