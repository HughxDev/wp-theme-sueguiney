<?php get_template_part('templates/page', 'header'); ?>
  <div class="entry page type-page">
    <div class="alert">
      <p><?php _e('Sorry, but the page you were trying to view does not exist.', 'roots'); ?></p>
    </div>

    <p><?php _e('It looks like this was the result of either:', 'roots'); ?></p>
    <ul class="p-aligned">
      <li><?php _e('a mistyped address', 'roots'); ?></li>
      <li><?php _e('an out-of-date link', 'roots'); ?></li>
    </ul>

    <div class="p">
      <?php get_search_form(); ?>
    </div>
</div>