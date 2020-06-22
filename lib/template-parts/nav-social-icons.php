<?php if(have_rows( 'social', 'option' )): ?>
<nav class="social-nav">
	<ul>
		<?php while(have_rows( 'social', 'option' )): the_row(); ?>
			<li><a href="<?php the_sub_field( 'url' ); ?>" target="_blank" rel="nofollow noopenner"><i class="fab fa-<?php the_sub_field( 'social_network' ); ?>"></i></a></li>
		<?php endwhile; ?>
	</ul>
</nav>
<?php endif; ?>