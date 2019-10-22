<?php get_template_part('templates/head'); ?>
<body id="top" <?php body_class('serif'); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">

  <!--[if lt IE 7]><div class="alert"><?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?></div><![endif]-->

  <div class="container">

  <?php
    do_action( 'get_header' );
    get_template_part( 'templates/header' );
  ?>

  <main id="content" class="content main<?php echo ' ' . roots_main_class(); ?>" role="main">
    <?php include roots_template_path(); ?>
    <?php if ( roots_display_sidebar() ) { ?>
    <?php
      // widget_logic
      ob_start();
      include roots_sidebar_path();
      $sidebar = ob_get_clean();  
      
      if ( !empty( $sidebar ) ) {
    ?>
    <aside class="sidebar <?php echo roots_sidebar_class(); ?>" role="complementary">
      <?php echo $sidebar; ?>
    </aside><!-- /.sidebar -->
    <?php
      } //endif
    } //endif
    ?>
  </main>

  <?php get_template_part('templates/footer'); ?>

  </div><!--/.container-->
</body>
</html>
