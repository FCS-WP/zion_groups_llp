<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0
 */

if ( deliciosa_sidebar_present() ) {
	
	$deliciosa_sidebar_type = deliciosa_get_theme_option( 'sidebar_type' );
	if ( 'custom' == $deliciosa_sidebar_type && ! deliciosa_is_layouts_available() ) {
		$deliciosa_sidebar_type = 'default';
	}
	
	// Catch output to the buffer
	ob_start();
	if ( 'default' == $deliciosa_sidebar_type ) {
		// Default sidebar with widgets
		$deliciosa_sidebar_name = deliciosa_get_theme_option( 'sidebar_widgets' );
		deliciosa_storage_set( 'current_sidebar', 'sidebar' );
		if ( is_active_sidebar( $deliciosa_sidebar_name ) ) {
			dynamic_sidebar( $deliciosa_sidebar_name );
		}
	} else {
		// Custom sidebar from Layouts Builder
		$deliciosa_sidebar_id = deliciosa_get_custom_sidebar_id();
		do_action( 'deliciosa_action_show_layout', $deliciosa_sidebar_id );
	}
	$deliciosa_out = trim( ob_get_contents() );
	ob_end_clean();
	
	// If any html is present - display it
	if ( ! empty( $deliciosa_out ) ) {
		$deliciosa_sidebar_position    = deliciosa_get_theme_option( 'sidebar_position' );
		$deliciosa_sidebar_position_ss = deliciosa_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $deliciosa_sidebar_position );
			echo ' sidebar_' . esc_attr( $deliciosa_sidebar_position_ss );
			echo ' sidebar_' . esc_attr( $deliciosa_sidebar_type );

			$deliciosa_sidebar_scheme = apply_filters( 'deliciosa_filter_sidebar_scheme', deliciosa_get_theme_option( 'sidebar_scheme' ) );
			if ( ! empty( $deliciosa_sidebar_scheme ) && ! deliciosa_is_inherit( $deliciosa_sidebar_scheme ) && 'custom' != $deliciosa_sidebar_type ) {
				echo ' scheme_' . esc_attr( $deliciosa_sidebar_scheme );
			}
			?>
		" role="complementary">
			<?php

			// Skip link anchor to fast access to the sidebar from keyboard
			?>
			<a id="sidebar_skip_link_anchor" class="deliciosa_skip_link_anchor" href="#"></a>
			<?php

			do_action( 'deliciosa_action_before_sidebar_wrap', 'sidebar' );

			// Button to show/hide sidebar on mobile
			if ( in_array( $deliciosa_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$deliciosa_title = apply_filters( 'deliciosa_filter_sidebar_control_title', 'float' == $deliciosa_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'deliciosa' ) : '' );
				$deliciosa_text  = apply_filters( 'deliciosa_filter_sidebar_control_text', 'above' == $deliciosa_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'deliciosa' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $deliciosa_title ); ?>"><?php echo esc_html( $deliciosa_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'deliciosa_action_before_sidebar', 'sidebar' );
				deliciosa_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $deliciosa_out ) );
				do_action( 'deliciosa_action_after_sidebar', 'sidebar' );
				?>
			</div>
			<?php

			do_action( 'deliciosa_action_after_sidebar_wrap', 'sidebar' );

			?>
		</div>
		<div class="clearfix"></div>
		<?php
	}
}
