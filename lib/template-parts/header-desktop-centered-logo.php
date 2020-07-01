<nav id="main_menu_left" role="navigation" itemscope="" itemtype="https://schema.org/SiteNavigationElement">
	<?php
		wp_nav_menu(
			array(
				'theme_location' => 'main-left',
				'container_class' => 'main-menu',
			)
		);
	?>
</nav>
<?php get_desktop_logos(); ?>
<nav id="main_menu_right" role="navigation" itemscope="" itemtype="https://schema.org/SiteNavigationElement">
	<?php
		wp_nav_menu(
			array(
				'theme_location' => 'main-right',
				'container_class' => 'main-menu',
			)
		);
	?>
</nav>
