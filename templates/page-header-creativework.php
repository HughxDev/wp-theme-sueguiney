<?php
  global $post;
?>
<h2 class="h headline section-title"><?php echo wp_get_post_terms( $post->ID, 'publishing_status' )[0]->name; ?></h2>