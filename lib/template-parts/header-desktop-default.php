<a class="logo" href="/"><?php echo wp_get_attachment_image( get_field( 'desktop_logo', 'option' ), 'full' ) ?></a>
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
