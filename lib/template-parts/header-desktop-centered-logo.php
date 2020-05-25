<header role="banner" class="desktop centered">
	<div class="wrap">
		<nav id="main_menu_left" role="navigation">
			<?php 
				wp_nav_menu(
					array(
						'theme_location' => 'main-left',
						'container_class' => 'main-menu',
					)
				);
			?>
		</nav>
		<a class="logo" href="/"><?php echo wp_get_attachment_image( get_field( 'desktop_logo', 'option' ), 'full' ) ?></a>
		<nav id="main_menu_right" role="navigation">
			<?php 
				wp_nav_menu(
					array(
						'theme_location' => 'main-right',
						'container_class' => 'main-menu',
					)
				);
			?>
		</nav>
	</div>
</header>