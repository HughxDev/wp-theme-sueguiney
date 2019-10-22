<?php
global $post;
$old_post = $post;

// Upcoming Works
$upcomingWorksQuery = array(
  'post_type' => 'creativework',
  'tax_query' => array(
    'relation' => 'OR',
    array(
      'taxonomy' => 'publishing_status',
      'field' => 'slug',
      'terms' => array( 'upcoming' ),
      //'operator' => 'NOT IN'
    )
  )
);

$creativeWorks = new WP_Query( $upcomingWorksQuery );

if ( $creativeWorks->have_posts() ) {
  get_template_part( 'templates/content', 'creativework' );
}

wp_reset_postdata();

$creativeWorks = $wp_query;

get_template_part( 'templates/content', 'creativework' );
?>