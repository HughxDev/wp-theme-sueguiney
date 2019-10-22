<article <?php post_class(); ?>>
  <header>
    <h3 class="h headline entry-title"><?php the_title(); ?></h3>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</article>
