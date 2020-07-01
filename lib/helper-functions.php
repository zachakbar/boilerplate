<?php
/**
 * Genesis Child.
 *
 * This file adds the required helper functions used in the Genesis Child Theme.
 */

/**
 * Calculates if white or gray would contrast more with the provided color.
 *
 * @since 2.2.3
 *
 * @param string $color A color in hex format.
 * @return string The hex code for the most contrasting color: dark grey or white.
 */
function tdc_color_contrast( $color ) {

	$hexcolor = str_replace( '#', '', $color );
	$red      = hexdec( substr( $hexcolor, 0, 2 ) );
	$green    = hexdec( substr( $hexcolor, 2, 2 ) );
	$blue     = hexdec( substr( $hexcolor, 4, 2 ) );

	$luminosity = ( ( $red * 0.2126 ) + ( $green * 0.7152 ) + ( $blue * 0.0722 ) );

	return ( $luminosity > 128 ) ? '#333333' : '#ffffff';

}

/**
 * Generates a lighter or darker color from a starting color.
 * Used to generate complementary hover tints from user-chosen colors.
 *
 * @since 2.2.3
 *
 * @param string $color A color in hex format.
 * @param int    $change The amount to reduce or increase brightness by.
 * @return string Hex code for the adjusted color brightness.
 */
function tdc_color_brightness( $color, $change ) {

	$hexcolor = str_replace( '#', '', $color );

	$red   = hexdec( substr( $hexcolor, 0, 2 ) );
	$green = hexdec( substr( $hexcolor, 2, 2 ) );
	$blue  = hexdec( substr( $hexcolor, 4, 2 ) );

	$red   = max( 0, min( 255, $red + $change ) );
	$green = max( 0, min( 255, $green + $change ) );
	$blue  = max( 0, min( 255, $blue + $change ) );

	return '#' . dechex( $red ) . dechex( $green ) . dechex( $blue );

}


/*
 *  Get Desktop Logos
 */
function get_desktop_logos(){
	$desktop_logo = get_field( 'desktop_logo', 'option' );
	$stickyscroll_behavior = get_field( 'stickyscroll_behavior', 'option' );
	$sticky_header_styles = get_field( 'sticky_header_styles', 'option' );
	$logo_output = "";

	if($stickyscroll_behavior == "sticky-scroll" && isset($sticky_header_styles['sticky_logo'])):
		$sticky_logo = $sticky_header_styles['sticky_logo'];
		$logo_output .= "<a class='logo desktop' href='/'>".wp_get_attachment_image( $desktop_logo, 'full' )."</a>";
		$logo_output .= "<a class='logo sticky' href='/'>".wp_get_attachment_image( $sticky_logo, 'full' )."</a>";
	else:
		$logo_output .= "<a class='logo desktop sticky' href='/'>".wp_get_attachment_image( $desktop_logo, 'full' )."</a>";
	endif;

	echo $logo_output;
}
