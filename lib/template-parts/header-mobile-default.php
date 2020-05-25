<nav id="mobile_main_menu" class="main-menu-mobile" role="navigation">
	<?php 
		wp_nav_menu(
			array(
				'theme_location' => 'main',
				'container_class' => 'main-menu',
			)
		);
	?>
</nav>
<header role="banner" class="mobile">
	<div class="wrap">
		<a class="logo" href="/"><?php echo wp_get_attachment_image( get_field( 'desktop_logo', 'option' ), 'full' ) ?></a>
		<div class="menu-toggle hamburger hamburger--elastic">
	    <div class="hamburger-box">
	      <div class="hamburger-inner"></div>
	    </div>
	    <span>MENU</span>
	  </div>
	</div>
</header>