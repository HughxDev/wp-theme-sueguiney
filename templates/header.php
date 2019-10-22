<header role="banner">
  <div class="content">
    <a class="nameplate ornaments block stay-fresh" href="<?php echo home_url(); ?>/" title="Home">
      <!--span class="ornament left" aria-hidden="true">{</span-->
      <h1 class="h headline serif"><?php bloginfo('name'); ?></h1>
      <p class="h sub serif"><?php bloginfo('description'); ?></p>
      <!--span class="ornament right" aria-hidden="true">}</span-->
    </a>
    <?php
      if (has_nav_menu('primary_navigation')) :
    ?>
    <nav role="navigation">
      <h2 class="implied">Primary Navigation</h2>
      <?php wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'list-clean list-horizontal sans-serif full-width split-4')); ?>
    </nav><!-- navigation -->
    <?php endif; ?>
  </div><!-- .content -->
</header>