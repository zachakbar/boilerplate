<header role="banner" class="desktop centered stacked">
	<div class="wrap">
		<a class="logo" href="/"><?php echo wp_get_attachment_image( get_field( 'desktop_logo', 'option' ), 'full' ) ?></a>
	</div>
	
	<nav id="main_menu" role="navigation">
		<div class="wrap">
			<?php 
				wp_nav_menu(
					array(
						'theme_location' => 'main',
						'container_class' => 'main-menu',
					)
				);
			?>
		</div>
	</nav>
</header>