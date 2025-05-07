<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0.10
 */

// Footer sidebar
$deliciosa_footer_name    = deliciosa_get_theme_option( 'footer_widgets' );
$deliciosa_footer_present = ! deliciosa_is_off( $deliciosa_footer_name ) && is_active_sidebar( $deliciosa_footer_name );
if ( $deliciosa_footer_present ) {
	deliciosa_storage_set( 'current_sidebar', 'footer' );
	$deliciosa_footer_wide = deliciosa_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $deliciosa_footer_name ) ) {
		dynamic_sidebar( $deliciosa_footer_name );
	}
	$deliciosa_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $deliciosa_out ) ) {
		$deliciosa_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $deliciosa_out );
		$deliciosa_need_columns = true;   //or check: strpos($deliciosa_out, 'columns_wrap')===false;
		if ( $deliciosa_need_columns ) {
			$deliciosa_columns = max( 0, (int) deliciosa_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $deliciosa_columns ) {
				$deliciosa_columns = min( 4, max( 1, deliciosa_tags_count( $deliciosa_out, 'aside' ) ) );
			}
			if ( $deliciosa_columns > 1 ) {
				$deliciosa_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $deliciosa_columns ) . ' widget', $deliciosa_out );
			} else {
				$deliciosa_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $deliciosa_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<?php do_action( 'deliciosa_action_before_sidebar_wrap', 'footer' ); ?>
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $deliciosa_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $deliciosa_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'deliciosa_action_before_sidebar', 'footer' );
				deliciosa_show_layout( $deliciosa_out );
				do_action( 'deliciosa_action_after_sidebar', 'footer' );
				if ( $deliciosa_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $deliciosa_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
			<?php do_action( 'deliciosa_action_after_sidebar_wrap', 'footer' ); ?>
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
