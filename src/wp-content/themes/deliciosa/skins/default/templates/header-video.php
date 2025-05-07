<?php
/**
 * The template to display the background video in the header
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0.14
 */
$deliciosa_header_video = deliciosa_get_header_video();
$deliciosa_embed_video  = '';
if ( ! empty( $deliciosa_header_video ) && ! deliciosa_is_from_uploads( $deliciosa_header_video ) ) {
	if ( deliciosa_is_youtube_url( $deliciosa_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $deliciosa_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php deliciosa_show_layout( deliciosa_get_embed_video( $deliciosa_header_video ) ); ?></div>
		<?php
	}
}
