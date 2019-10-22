<footer class="contentinfo" role="contentinfo">
	<div class="content">
		<?php dynamic_sidebar('sidebar-footer'); ?>
		<h2 id="connect" class="h implied">Connect</h2>
		<address class="entry-aligned">
			<ul class="connect list-clean list-horizontal options full-width">
				<li><a class="ss-mail ss-social-circle" href="mailto:<?php echo get_userdata( 1 )->user_email; ?>">E-mail</a></li>
				<?php echo get_social_html_link( 'twitter', 'ss-twitter ss-social-circle' ); ?>
				<?php echo get_social_html_link( 'facebook', 'ss-facebook ss-social-circle' ); ?>
				<?php echo get_social_html_link( 'googleplus', 'ss-googleplus ss-social-circle', 'Google+' ); ?>
				<?php echo get_social_html_link( 'atom', 'ss-rss ss-social-circle', 'Blog Feed' ); ?>
			</ul>
			<p id="copyright" class="copyright">© <?php echo date('Y'); ?> <span id="author" itemprop="name"><?php bloginfo( 'name' ); ?></span>. All rights reserved.</p><!-- #copyright -->
		</address>
	</div><!-- .content -->
</footer>

<?php wp_footer(); ?>