<aside class="sidebar" role="complementary">
	<?php if ( is_active_sidebar( 'Default Sidebar' ) ) : ?>
		<?php dynamic_sidebar( 'Default Sidebar' ); ?>
	<?php else : ?>
		<p>This theme has sidebar widget support, but there are no active widgets :(</p>
	<?php endif; ?>
</aside>
		