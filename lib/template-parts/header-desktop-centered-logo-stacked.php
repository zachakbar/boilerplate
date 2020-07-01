
	<?php get_desktop_logos(); ?>

	<nav id="main_menu" role="navigation" itemscope="" itemtype="https://schema.org/SiteNavigationElement">
		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'main',
					'container_class' => 'main-menu',
				)
			);
		?>
	</nav>
