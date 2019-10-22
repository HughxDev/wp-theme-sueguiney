<?php echo get_avatar($comment, $size = '64'); ?>
<h4 class="h"><b><?php echo get_comment_author_link(); ?></b> said:</h4>

<?php if ($comment->comment_approved == '0') : ?>
  <div class="alert">
    <?php _e('Your comment is awaiting moderation.', 'roots'); ?>
  </div>
<?php endif; ?>

<blockquote>
  <?php comment_text(); ?>    
</blockquote>

<p class="timestamp">
  <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>" rel="bookmark">
    <span class="variable-valign">Posted 
      <time datetime="<?php echo comment_date('c'); ?>"><?php printf(__('%1$s', 'roots'), get_comment_date(),  get_comment_time()); ?></time>
    </span>
  </a>
  <?php edit_comment_link(__('(Edit)', 'roots'), '', ''); ?>
</p>
<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
