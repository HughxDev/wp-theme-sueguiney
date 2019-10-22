<?php
	$implied = '';
	$dimensions = '';
	$featuredImgClasses = '';
	$isFrontPage = is_front_page();

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$customFieldsActive = is_plugin_active( 'advanced-custom-fields/acf.php' );

	if ( $customFieldsActive ) {
		$implied = ( get_field( 'show_title' ) != true ? ' implied' : $implied );
		$featuredImgClasses =
			( get_field( 'tilt' ) == true ? ' tilt' : '' ) .
			( get_field( 'shadow' ) == true ? ' shadow' : '' ) .
			( get_field( 'rounded' ) == true ? ' rounded' : '' )
		;
	}

	if ( $isFrontPage ) {
		$featuredImgClasses .= ' avatar';
		$dimensions = ' width="150"';
	}
?>
<?php while ( have_posts() ) : the_post(); ?>
	<?php if ( $isFrontPage ) : ?>
	<div class="about blurb clearfix">
	<?php else : ?>
	<div <?php post_class( 'entry-content' ); ?>>
	<h2 class="h headline entry-title<?php echo $implied; ?>"><?php the_title(); ?></h2>
	<?php endif; ?>
	<?php if ( has_post_thumbnail() ): ?>
	<img class="header-img<?php echo $featuredImgClasses; ?>" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>"<?php echo $dimensions; ?> alt=" " />
	<?php endif; ?>
  <?php the_content(); ?>
	</div>
  <?php wp_link_pages(array('before' => '<nav class="pagination post-nav entry-aligned">', 'after' => '</nav>')); ?>
<?php endwhile; ?>
<?php
if (is_front_page()) :
	$args = 'posts_per_page=3';
	$the_query = new WP_Query( $args );

	// The Loop
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		get_template_part('templates/content');
	}
endif; ?>