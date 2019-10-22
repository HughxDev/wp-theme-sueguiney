<?php
$implied = '';
$dimensions = '';
$featuredImgClasses = '';

while (have_posts()) : the_post();
  $title = html_entity_decode( get_the_title() );
  $quotedTitle = '"' . $title . '"';
  $smartQuotedTitle = '“' . $title . '”';
  $emailSubject = rawurlencode( $quotedTitle . ' on ' . get_bloginfo( 'name' ) . "'s Blog" );
  $encodedPermalink = rawurlencode( get_permalink() );
?>
  <article <?php post_class(); ?>>
    <header>
      <h3 class="h headline entry-title"><?php the_title(); ?></h3>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php if ( has_post_thumbnail() ): ?>
      <img class="header-img<?php echo $featuredImgClasses; ?>" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>"<?php echo $dimensions; ?> alt=" " />
      <?php endif; ?>
      <?php the_content(); ?>
    </div>
    <footer class="blog-footer share">
      <?php /*wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>'));*/ ?>
      <p>Like this post? Share it!</p>
      <ul class="list-clean list-horizontal">
        <li><a class="ss-mail button" href="mailto:?subject=<?php echo $emailSubject; ?>&amp;body=<?php echo $encodedPermalink; ?>">E-mail</a></li>
        <li><a class="ss-twitter button js-tweet" href="https://twitter.com/share?url=<?php echo $encodedPermalink; ?>&amp;text=<?php echo rawurlencode( $smartQuotedTitle ); ?>&amp;via=<?php echo rawurlencode( get_user_twitter() ); ?>">Twitter</a></li>
        <li><a class="ss-facebook button js-fb-share" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $encodedPermalink; ?>" >Facebook</a></li>
        <li><a class="ss-googleplus button js-google-plus" href="https://plus.google.com/share?url=<?php echo $encodedPermalink; ?>">Google+</a></li>
      </ul>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
