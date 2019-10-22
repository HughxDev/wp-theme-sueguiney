<p class="timestamp">
	<a href="<?php the_permalink(); ?>" rel="bookmark">
		<span class="variable-valign">Posted 
			<time datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(); ?></time>
		</span>
	</a>
</p>
<?php /*<p class="byline author vcard"><?php echo __('By', 'roots'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a></p>*/ ?>
