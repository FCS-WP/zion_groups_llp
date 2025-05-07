<?php
/**
 * The Header: Logo and main menu
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js<?php
	// Class scheme_xxx need in the <html> as context for the <body>!
	echo ' scheme_' . esc_attr( deliciosa_get_theme_option( 'color_scheme' ) );
?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	do_action( 'deliciosa_action_before_body' );
	?>

	<div class="<?php echo esc_attr( apply_filters( 'deliciosa_filter_body_wrap_class', 'body_wrap' ) ); ?>" <?php do_action('deliciosa_action_body_wrap_attributes'); ?>>

		<?php do_action( 'deliciosa_action_before_page_wrap' ); ?>

		<div class="<?php echo esc_attr( apply_filters( 'deliciosa_filter_page_wrap_class', 'page_wrap' ) ); ?>" <?php do_action('deliciosa_action_page_wrap_attributes'); ?>>

			<?php do_action( 'deliciosa_action_page_wrap_start' ); ?>

			<?php
			$deliciosa_full_post_loading = ( deliciosa_is_singular( 'post' ) || deliciosa_is_singular( 'attachment' ) ) && deliciosa_get_value_gp( 'action' ) == 'full_post_loading';
			$deliciosa_prev_post_loading = ( deliciosa_is_singular( 'post' ) || deliciosa_is_singular( 'attachment' ) ) && deliciosa_get_value_gp( 'action' ) == 'prev_post_loading';

			// Don't display the header elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ! $deliciosa_full_post_loading && ! $deliciosa_prev_post_loading ) {

				// Short links to fast access to the content, sidebar and footer from the keyboard
				?>
				<a class="deliciosa_skip_link skip_to_content_link" href="#content_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'deliciosa_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to content", 'deliciosa' ); ?></a>
				<?php if ( deliciosa_sidebar_present() ) { ?>
				<a class="deliciosa_skip_link skip_to_sidebar_link" href="#sidebar_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'deliciosa_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to sidebar", 'deliciosa' ); ?></a>
				<?php } ?>
				<a class="deliciosa_skip_link skip_to_footer_link" href="#footer_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'deliciosa_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to footer", 'deliciosa' ); ?></a>

				<?php
				do_action( 'deliciosa_action_before_header' );

				// Header
				$deliciosa_header_type = deliciosa_get_theme_option( 'header_type' );
				if ( 'custom' == $deliciosa_header_type && ! deliciosa_is_layouts_available() ) {
					$deliciosa_header_type = 'default';
				}
				get_template_part( apply_filters( 'deliciosa_filter_get_template_part', "templates/header-" . sanitize_file_name( $deliciosa_header_type ) ) );

				// Side menu
				if ( in_array( deliciosa_get_theme_option( 'menu_side' ), array( 'left', 'right' ) ) ) {
					get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'templates/header-navi-side' ) );
				}

				// Mobile menu
				get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'templates/header-navi-mobile' ) );

				do_action( 'deliciosa_action_after_header' );

			}
			?>

			<?php do_action( 'deliciosa_action_before_page_content_wrap' ); ?>

			<div class="page_content_wrap<?php
				if ( deliciosa_is_off( deliciosa_get_theme_option( 'remove_margins' ) ) ) {
					if ( empty( $deliciosa_header_type ) ) {
						$deliciosa_header_type = deliciosa_get_theme_option( 'header_type' );
					}
					if ( 'custom' == $deliciosa_header_type && deliciosa_is_layouts_available() ) {
						$deliciosa_header_id = deliciosa_get_custom_header_id();
						if ( $deliciosa_header_id > 0 ) {
							$deliciosa_header_meta = deliciosa_get_custom_layout_meta( $deliciosa_header_id );
							if ( ! empty( $deliciosa_header_meta['margin'] ) ) {
								?> page_content_wrap_custom_header_margin<?php
							}
						}
					}
					$deliciosa_footer_type = deliciosa_get_theme_option( 'footer_type' );
					if ( 'custom' == $deliciosa_footer_type && deliciosa_is_layouts_available() ) {
						$deliciosa_footer_id = deliciosa_get_custom_footer_id();
						if ( $deliciosa_footer_id ) {
							$deliciosa_footer_meta = deliciosa_get_custom_layout_meta( $deliciosa_footer_id );
							if ( ! empty( $deliciosa_footer_meta['margin'] ) ) {
								?> page_content_wrap_custom_footer_margin<?php
							}
						}
					}
				}
				do_action( 'deliciosa_action_page_content_wrap_class', $deliciosa_prev_post_loading );
				?>"<?php
				if ( apply_filters( 'deliciosa_filter_is_prev_post_loading', $deliciosa_prev_post_loading ) ) {
					?> data-single-style="<?php echo esc_attr( deliciosa_get_theme_option( 'single_style' ) ); ?>"<?php
				}
				do_action( 'deliciosa_action_page_content_wrap_data', $deliciosa_prev_post_loading );
			?>>
				<?php
				do_action( 'deliciosa_action_page_content_wrap', $deliciosa_full_post_loading || $deliciosa_prev_post_loading );

				// Single posts banner
				if ( apply_filters( 'deliciosa_filter_single_post_header', deliciosa_is_singular( 'post' ) || deliciosa_is_singular( 'attachment' ) ) ) {
					if ( $deliciosa_prev_post_loading ) {
						if ( deliciosa_get_theme_option( 'posts_navigation_scroll_which_block' ) != 'article' ) {
							do_action( 'deliciosa_action_between_posts' );
						}
					}
					// Single post thumbnail and title
					$deliciosa_path = apply_filters( 'deliciosa_filter_get_template_part', 'templates/single-styles/' . deliciosa_get_theme_option( 'single_style' ) );
					if ( deliciosa_get_file_dir( $deliciosa_path . '.php' ) != '' ) {
						get_template_part( $deliciosa_path );
					}
				}

				// Widgets area above page
				$deliciosa_body_style   = deliciosa_get_theme_option( 'body_style' );
				$deliciosa_widgets_name = deliciosa_get_theme_option( 'widgets_above_page' );
				$deliciosa_show_widgets = ! deliciosa_is_off( $deliciosa_widgets_name ) && is_active_sidebar( $deliciosa_widgets_name );
				if ( $deliciosa_show_widgets ) {
					if ( 'fullscreen' != $deliciosa_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					deliciosa_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $deliciosa_body_style ) {
						?>
						</div>
						<?php
					}
				}

				// Content area
				do_action( 'deliciosa_action_before_content_wrap' );
				?>
				<div class="content_wrap<?php echo 'fullscreen' == $deliciosa_body_style ? '_fullscreen' : ''; ?>">

					<?php do_action( 'deliciosa_action_content_wrap_start' ); ?>

					<div class="content">
						<?php
						do_action( 'deliciosa_action_page_content_start' );

						// Skip link anchor to fast access to the content from keyboard
						?>
						<a id="content_skip_link_anchor" class="deliciosa_skip_link_anchor" href="#"></a>
						<?php
						// Single posts banner between prev/next posts
						if ( ( deliciosa_is_singular( 'post' ) || deliciosa_is_singular( 'attachment' ) )
							&& $deliciosa_prev_post_loading 
							&& deliciosa_get_theme_option( 'posts_navigation_scroll_which_block' ) == 'article'
						) {
							do_action( 'deliciosa_action_between_posts' );
						}

						// Widgets area above content
						deliciosa_create_widgets_area( 'widgets_above_content' );

						do_action( 'deliciosa_action_page_content_start_text' );
