<article <?php post_class(); ?>>
  <header>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="panel-body entry-summary">
    <?php the_content( __('Continued', 'roots') ); ?>
  </div>
</article>
