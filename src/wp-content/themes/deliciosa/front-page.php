<?php
/**
 * The Front Page template file.
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0.31
 */

get_header();

// If front-page is a static page
if ( get_option( 'show_on_front' ) == 'page' ) {

	// If Front Page Builder is enabled - display sections
	if ( deliciosa_is_on( deliciosa_get_theme_option( 'front_page_enabled', false ) ) ) {

		if ( have_posts() ) {
			the_post();
		}

		$deliciosa_sections = deliciosa_array_get_keys_by_value( deliciosa_get_theme_option( 'front_page_sections' ) );
		if ( is_array( $deliciosa_sections ) ) {
			foreach ( $deliciosa_sections as $deliciosa_section ) {
				get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'front-page/section', $deliciosa_section ), $deliciosa_section );
			}
		}

		// Else if this page is a blog archive
	} elseif ( is_page_template( 'blog.php' ) ) {
		get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'blog' ) );

		// Else - display a native page content
	} else {
		get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'page' ) );
	}

	// Else get the template 'index.php' to show posts
} else {
	get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'index' ) );
}

get_footer();
