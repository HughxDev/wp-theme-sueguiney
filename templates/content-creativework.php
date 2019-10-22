<?php
// WPAlchemy MetaBox
global $creativework_marketing;
global $creativeWorks;

$isArchive = is_archive();

if ( !$isArchive || !isset( $creativeWorks ) || !$creativeWorks->have_posts() ) {
  $creativeWorks = $post;
}

while ( $creativeWorks->have_posts() ) : $creativeWorks->the_post();

$creativework_marketing->the_meta();

//$purchaseUrl = !empty(
$purchaseUrl = $creativework_marketing->get_the_value( 'url' );
$merchantName = $creativework_marketing->get_the_value( 'merchant_name' );
//);

if ( $creativeWorks->current_post == 0 && !is_paged() ) {
  get_template_part( 'templates/page', 'header-creativework' );
}
?>
<article id="<?php the_slug(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/Book">
  <div class="content">
    <header class="book-header">
      <?php if ( has_post_thumbnail() ): ?>
      <img class="book-cover" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>" width="150" alt=" " itemprop="image" />
    <?php else: ?>
      <div class="book-cover no-artwork" title="Artwork TBD">
        <span class="question-mark">?</span>
      </div>
    <?php endif; ?>
      <h3 class="h blurb-title">
        <cite class="entry-title" itemprop="name"><?php the_title(); ?></cite>
      </h3>
      <span itemtype="http://schema.org/Person" itemscope="itemscope" itemprop="author" itemref="author" hidden="hidden"></span>
    </header><!--/.book-header-->
    <div itemprop="description">
      <?php the_content(); ?>
    </div><!--/.entry-content-->
    <?php if ( $purchaseUrl ): ?>
      <a class="button cta" href="<?php $creativework_marketing->the_value( 'url' ); ?>">Buy<?php echo ( $merchantName ? ' from ' . $merchantName : ' Now' ); ?></a>
    <?php endif; ?>
    <?php while ( $creativework_marketing->have_fields( 'quotes' ) ): ?>
    <?php if ( !$creativework_marketing->get_the_value( 'hide' ) ): ?>
      <div class="quotation" itemprop="review" itemscope="itemscope" itemtype="http://schema.org/Review">
        <blockquote itemprop="reviewBody">
          <p><?php $creativework_marketing->the_value( 'text' ); ?></p>
        </blockquote>
        <p class="attrib"><?php
          $attribName = trim( $creativework_marketing->get_the_value( 'attribution_name' ) );
          $attribPub = trim( $creativework_marketing->get_the_value( 'attribution_publication' ) );
          $attribNamePubRel = trim( $creativework_marketing->get_the_value( 'attribution_publication_format' ) );

          if ( !empty( $attribName ) ) {
            if ( !empty( $attribPub ) ) {
              if ( !empty( $attribNamePubRel ) ) {
                $attrib = "<span itemprop=\"author\">$attribName</span>, $attribNamePubRel <cite>$attribPub</cite>";
              } else {
                $attrib = "<span itemprop=\"author\">$attribName</span>, <cite itemprop=\"publisher\">$attribPub</cite>";
              }
            } else {
              $attrib = "<span itemprop=\"author\">$attribName</span>";
            }
          } elseif ( !empty( $attribPub ) ) {
            $attrib = "<cite itemprop=\"publisher\">$attribPub</cite>";
          } else {
            $attrib = false;
          }

          echo $attrib;
        ?></p>
      </div><!--/.quotation-->
    <?php endif; ?>
    <?php endwhile; ?>
  </div><!--/.content-->
</article>
<?php endwhile; ?>