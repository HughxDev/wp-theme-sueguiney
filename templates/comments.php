<?php 
  if (post_password_required()) {
    return;
  }

 if (have_comments()) : ?>
  <footer id="comments" class="comments p-aligned">
    <h3 class="h section-title">Responses</h3>
    <?php wp_list_comments(array('walker' => new Roots_Walker_Comment)); ?>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
    <nav>
      <ul class="pager">
        <?php if (get_previous_comments_link()) : ?>
          <li class="previous"><?php previous_comments_link(__('← Older comments', 'roots')); ?></li>
        <?php endif; ?>
        <?php if (get_next_comments_link()) : ?>
          <li class="next"><?php next_comments_link(__('Newer comments →', 'roots')); ?></li>
        <?php endif; ?>
      </ul>
    </nav>
    <?php endif; ?>

    <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
    <div class="alert">
      <?php _e('Comments are closed.', 'roots'); ?>
    </div>
    <?php endif; ?>
  </footer><!-- /#comments -->
<?php endif; ?>

<?php if (!have_comments() && !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
  <footer id="comments" class="comments p-aligned">
    <div class="alert">
      <?php _e('Comments are closed.', 'roots'); ?>
    </div>
  </footer><!-- /#comments -->
<?php endif; ?>

<?php if (comments_open()) : ?>
  <section id="respond">
    <h3 class="h section-title"><?php comment_form_title(__('Leave a Reply', 'roots'), __('Leave a Reply to %s', 'roots')); ?></h3>
    <p class="cancel-comment-reply"></p>
    <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
      <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'roots'), wp_login_url(get_permalink())); ?></p>
    <?php else : ?>
      <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        <dl class="sans-serif">
        <?php if (!is_user_logged_in()): ?>
          <dt><label for="comment-author"><?php _e('Name', 'roots'); if ($req) _e('<abbr class="required" title="(required)">*</abbr>', 'roots'); ?></label></dt>
          <dd><input type="text" class="form-control" name="author" id="comment-author" value="<?php echo esc_attr($comment_author); ?>" size="22" <?php if ($req) echo 'required="required"'; ?>></dd>
          <dt><label for="comment-email"><?php _e('Email <span class="note">(will not be published)</span>', 'roots'); if ($req) _e('<abbr class="required" title="(required)">*</abbr>', 'roots'); ?></label></dt>
          <dd><input type="email" class="form-control" name="email" id="comment-email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" <?php if ($req) echo 'required="required"'; ?>></dd>
          <dt><label for="comment-url"><?php _e('Website', 'roots'); ?></label></dt>
          <dd><input type="url" class="form-control" name="url" id="comment-url" value="<?php echo esc_attr($comment_author_url); ?>" size="22"></dd>
        <?php endif; ?>
          <dt>
            <label for="comment-text"><?php _e('Comment', 'roots'); ?>
            <?php if (is_user_logged_in()) :
              printf(__('<span class="note"> as <a href="%s/wp-admin/profile.php">%s</a>', 'roots'), get_option( 'siteurl' ), $user_identity); ?> <small>or <a href="<?php echo wp_logout_url(get_permalink()); ?>"><?php _e('log out', 'roots'); ?></a></small></span>
            <?php endif; ?></label>
          </dt>
          <dd><textarea name="comment" id="comment-text" class="form-control" rows="8" required="required"></textarea></dd>
        </dl>
        <ul class="options">
          <li><input name="submit" class="button" type="submit" id="comment-submit" value="<?php _e('Submit', 'roots'); ?>"></li>
          <li><?php cancel_comment_reply_link('Cancel'); ?></li>
        </ul>
        <?php comment_id_fields(); ?>
        <?php do_action('comment_form', $post->ID); ?>
      </form>
    <?php endif; ?>
  </section><!-- /#respond -->
<?php endif; ?>
<?php /*
<footer class="comments p-aligned">
  <h3 class="h section-title">Responses</h3>
  <article class="comment">
    <img class="avatar" src="http://www.gravatar.com/avatar/575d9674b46beab18c5a76f019d17d35.png" width="80" height="80" alt=" " />
    <h4 class="h"><b>Poster</b> said:</h4>
    <blockquote>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla magna erat, tristique sed quam id, consectetur lacinia lectus. In malesuada ante et sapien tincidunt, in suscipit nunc scelerisque. Nam non placerat ligula. Donec libero justo, molestie id tincidunt in, pellentesque id dolor. Etiam at velit in enim mollis viverra. Phasellus posuere rutrum tristique. Aliquam pretium eros in egestas pulvinar. Aenean ultrices feugiat porttitor. Phasellus a purus et mi dapibus semper. Praesent quis imperdiet dui, non ullamcorper nibh. Suspendisse ac laoreet erat.</p>
    </blockquote>
    <footer>
      <p class="timestamp">
        <a href="/2013/08/how-to-write-a-poetry-play/#comment-123" rel="bookmark">
          <span class="variable-valign">Posted 
            <time datetime="2013-08-22T19:20:05+00:00" pubdate="pubdate">Thu, 22nd Aug, 2013</time>
          </span>
        </a>
      </p>
    </footer>
    </article>
</footer>
*/ ?>