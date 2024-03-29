<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', get_post_format()); ?>
<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav entry-aligned">
    <ul class="prev-next list-clean list-horizontal">
      <li class="previous"><?php next_posts_link(__('← Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts →', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>
