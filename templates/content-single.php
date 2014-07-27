<article <?php post_class('clearfix'); ?>>
  <header>
    <?php get_template_part('templates/entry', 'byline'); ?>
  </header>
  <div class="entry-content" itemprop="articleBody">
    <?php the_content(); ?>
  </div>
  <footer>
    <?php get_template_part('templates/pagination'); ?>
    <?php get_template_part('templates/entry', 'terms'); ?>
  </footer>
  <?php comments_template('/templates/comments.php'); ?>
</article>
