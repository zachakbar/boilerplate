<?php $logo = get_field( 'mobile_logo', 'option' ) ? get_field( 'mobile_logo', 'option' ) : get_field( 'desktop_logo', 'option' ); ?>
<div class="spacer"></div>
<a class="logo" href="/"><?php echo wp_get_attachment_image( $logo, 'full' ) ?></a>
<div class="menu-toggle hamburger hamburger--elastic">
  <div class="hamburger-box">
    <div class="hamburger-inner"></div>
  </div>
</div>