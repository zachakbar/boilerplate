<?php

/**
 * Text with Media Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'text-media-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'page-block text-media';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$module_color_mode = get_field( 'module_color_mode' ) ?: 'dark';
//$background_class = get_field( 'section_bg_color_'.$module_color_mode ) ?: 'dark-teal';
$background_class = "has-".get_field( 'background_theme_color' )."-background-color";

$className .= ' '.$module_color_mode.' '.$background_class;

$section_layout = get_field( 'layout' );
$media_split = get_field( 'module_split' );
$section_media_type = get_field( 'media_type' );
$section_media_align = get_field( 'media_align' );
$this_video_count = isset($GLOBALS['video_count']) ? $GLOBALS['video_count'] : 0;

$aos_text_animation = $section_layout == "media-left" ? "fade-left" : "fade-right";
$aos_media_animation = $section_layout == "media-left" ? "fade-right" : "fade-left";
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
  <div class="wrap">
	  <div class="section-content <?php echo $section_layout.' '.$media_split.' media-'.$section_media_type; ?>">
			<div class="section-media <?php echo $section_media_type; ?> <?php echo $section_media_align; ?>">
				<?php
				if($section_media_type == 'image'):
					$section_img = get_field( 'image' );
					echo wp_get_attachment_image( $section_img['id'], 'full' );
				else:
					$video_player = get_field( 'video_player' );
					$add_video_ga_tracking = get_field( 'add_video_ga_tracking' );

					$video_ga_tracking = "";
					if($add_video_ga_tracking == 1):
						$video_tracking = get_field( 'video_ga_tracking' );
						$video_ga_tracking = "data-category='".$video_tracking[0]['event_category']."' data-action='".$video_tracking[0]['event_action']."' data-label='".$video_tracking[0]['event_label']."'";
					endif;

					$video_url = get_field( 'video_url' );
					$video_preview = get_field( 'video_preview_image' );

					$src = str_replace("https://", "", $video_url);
					$src_array = explode("/", $src);

					$provider = str_replace(".", "", str_replace("www.", "", str_replace("player.", "", str_replace(".com", "", $src_array[0]))));

					if(strpos($src, "v=") > 0):
						parse_str( parse_url( $src, PHP_URL_QUERY ), $video_url_vars );
						$video_id = $video_url_vars['v'];
					elseif($src_array[1] == "embed"):
						$video_id = $src_array[2];
					else:
						$video_id = $src_array[1];
					endif;

					echo "<div class='video-wrapper'><div id='video_$this_video_count' class='plyr' data-plyr-provider='$provider' data-plyr-embed-id='$video_id'></div></div>";

					if($video_preview): ?>

					<div class="preview-image">
						<img src="<?php echo $video_preview['url']; ?>" />

						<button type="button" class="plyr__control plyr__control--overlaid plyr-launch custom-tracking" <?php echo $video_ga_tracking; ?> data-target="#video_<?php echo $this_video_count; ?>"></button>
					</div>

					<?php endif;
				endif;
				?>
 			</div>
			<article>
				<?php
					echo "<h3>".get_field( 'subtitle' )."</h3>";
					echo "<h1>".get_field( 'title' )."</h1>";
					echo "<div class='intro'>".get_field( 'module_content' )."</div>";
					echo "background theme color = ".get_theme_color( 'background_theme_color', null, 'background' );
					echo "<br>text theme color = ".get_theme_color( 'background_theme_color', null, 'text' );
					echo "<br>theme color hex = ".get_theme_color( 'background_theme_color', null, 'color' );
					echo "<br>theme color value = ".get_theme_color( 'background_theme_color', null );

					$include_cta = get_field( 'include_cta_button' );
					if($include_cta):
						dynamic_button('cta_button');
					endif;
				?>
			</article>
		</div>
  </div>
</section>
<?php
	$this_video_count++;
	$GLOBALS['video_count'] = $this_video_count;
?>
