<?php
/**
 * The template to display default site header
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0
 */

$deliciosa_header_css   = '';
$deliciosa_header_image = get_header_image();
$deliciosa_header_video = deliciosa_get_header_video();
if ( ! empty( $deliciosa_header_image ) && deliciosa_trx_addons_featured_image_override( is_singular() || deliciosa_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$deliciosa_header_image = deliciosa_get_current_mode_image( $deliciosa_header_image );
}

?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $deliciosa_header_image ) || ! empty( $deliciosa_header_video ) ? ' with_bg_image' : ' without_bg_image';
	if ( '' != $deliciosa_header_video ) {
		echo ' with_bg_video';
	}
	if ( '' != $deliciosa_header_image ) {
		echo ' ' . esc_attr( deliciosa_add_inline_css_class( 'background-image: url(' . esc_url( $deliciosa_header_image ) . ');' ) );
	}
	if ( is_single() && has_post_thumbnail() ) {
		echo ' with_featured_image';
	}
	if ( deliciosa_is_on( deliciosa_get_theme_option( 'header_fullheight' ) ) ) {
		echo ' header_fullheight deliciosa-full-height';
	}
	$deliciosa_header_scheme = deliciosa_get_theme_option( 'header_scheme' );
	if ( ! empty( $deliciosa_header_scheme ) && ! deliciosa_is_inherit( $deliciosa_header_scheme  ) ) {
		echo ' scheme_' . esc_attr( $deliciosa_header_scheme );
	}
	?>
">
	<?php

	// Background video
	if ( ! empty( $deliciosa_header_video ) ) {
		get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'templates/header-video' ) );
	}

	// Main menu
	get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'templates/header-navi' ) );

	// Mobile header
	if ( deliciosa_is_on( deliciosa_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'templates/header-mobile' ) );
	}

	// Page title and breadcrumbs area
	if ( ! is_single() ) {
		get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'templates/header-title' ) );
	}

	// Header widgets area
	get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'templates/header-widgets' ) );
	?>
</header>
