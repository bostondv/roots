<article <?php post_class('clearfix'); ?> itemprop="articleBody">
  <?php the_content(); ?>
  <footer>
    <?php get_template_part('templates/pagination'); ?>
  </footer>
  <?php comments_template('/templates/comments.php'); ?>
</article>
