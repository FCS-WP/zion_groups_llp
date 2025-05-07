<?php
/**
 * The template to display the widgets area in the header
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0
 */

// Header sidebar
$deliciosa_header_name    = deliciosa_get_theme_option( 'header_widgets' );
$deliciosa_header_present = ! deliciosa_is_off( $deliciosa_header_name ) && is_active_sidebar( $deliciosa_header_name );
if ( $deliciosa_header_present ) {
	deliciosa_storage_set( 'current_sidebar', 'header' );
	$deliciosa_header_wide = deliciosa_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $deliciosa_header_name ) ) {
		dynamic_sidebar( $deliciosa_header_name );
	}
	$deliciosa_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $deliciosa_widgets_output ) ) {
		$deliciosa_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $deliciosa_widgets_output );
		$deliciosa_need_columns   = strpos( $deliciosa_widgets_output, 'columns_wrap' ) === false;
		if ( $deliciosa_need_columns ) {
			$deliciosa_columns = max( 0, (int) deliciosa_get_theme_option( 'header_columns' ) );
			if ( 0 == $deliciosa_columns ) {
				$deliciosa_columns = min( 6, max( 1, deliciosa_tags_count( $deliciosa_widgets_output, 'aside' ) ) );
			}
			if ( $deliciosa_columns > 1 ) {
				$deliciosa_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $deliciosa_columns ) . ' widget', $deliciosa_widgets_output );
			} else {
				$deliciosa_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $deliciosa_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<?php do_action( 'deliciosa_action_before_sidebar_wrap', 'header' ); ?>
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $deliciosa_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $deliciosa_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'deliciosa_action_before_sidebar', 'header' );
				deliciosa_show_layout( $deliciosa_widgets_output );
				do_action( 'deliciosa_action_after_sidebar', 'header' );
				if ( $deliciosa_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $deliciosa_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
			<?php do_action( 'deliciosa_action_after_sidebar_wrap', 'header' ); ?>
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
