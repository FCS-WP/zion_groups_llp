<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: //codex.wordpress.org/Template_Hierarchy
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0
 */

$deliciosa_template = apply_filters( 'deliciosa_filter_get_template_part', deliciosa_blog_archive_get_template() );

if ( ! empty( $deliciosa_template ) && 'index' != $deliciosa_template ) {

	get_template_part( $deliciosa_template );

} else {

	deliciosa_storage_set( 'blog_archive', true );

	get_header();

	if ( have_posts() ) {

		// Query params
		$deliciosa_stickies   = is_home()
								|| ( in_array( deliciosa_get_theme_option( 'post_type' ), array( '', 'post' ) )
									&& (int) deliciosa_get_theme_option( 'parent_cat' ) == 0
									)
										? get_option( 'sticky_posts' )
										: false;
		$deliciosa_post_type  = deliciosa_get_theme_option( 'post_type' );
		$deliciosa_args       = array(
								'blog_style'     => deliciosa_get_theme_option( 'blog_style' ),
								'post_type'      => $deliciosa_post_type,
								'taxonomy'       => deliciosa_get_post_type_taxonomy( $deliciosa_post_type ),
								'parent_cat'     => deliciosa_get_theme_option( 'parent_cat' ),
								'posts_per_page' => deliciosa_get_theme_option( 'posts_per_page' ),
								'sticky'         => deliciosa_get_theme_option( 'sticky_style' ) == 'columns'
															&& is_array( $deliciosa_stickies )
															&& count( $deliciosa_stickies ) > 0
															&& get_query_var( 'paged' ) < 1
								);

		deliciosa_blog_archive_start();

		do_action( 'deliciosa_action_blog_archive_start' );

		if ( is_author() ) {
			do_action( 'deliciosa_action_before_page_author' );
			get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'templates/author-page' ) );
			do_action( 'deliciosa_action_after_page_author' );
		}

		if ( deliciosa_get_theme_option( 'show_filters' ) ) {
			do_action( 'deliciosa_action_before_page_filters' );
			deliciosa_show_filters( $deliciosa_args );
			do_action( 'deliciosa_action_after_page_filters' );
		} else {
			do_action( 'deliciosa_action_before_page_posts' );
			deliciosa_show_posts( array_merge( $deliciosa_args, array( 'cat' => $deliciosa_args['parent_cat'] ) ) );
			do_action( 'deliciosa_action_after_page_posts' );
		}

		do_action( 'deliciosa_action_blog_archive_end' );

		deliciosa_blog_archive_end();

	} else {

		if ( is_search() ) {
			get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'templates/content', 'none-search' ), 'none-search' );
		} else {
			get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'templates/content', 'none-archive' ), 'none-archive' );
		}
	}

	get_footer();
}
