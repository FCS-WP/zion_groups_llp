<?php
/**
 * The template to display default site footer
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0.10
 */

$deliciosa_footer_id = deliciosa_get_custom_footer_id();
$deliciosa_footer_meta = get_post_meta( $deliciosa_footer_id, 'trx_addons_options', true );
if ( ! empty( $deliciosa_footer_meta['margin'] ) ) {
	deliciosa_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( deliciosa_prepare_css_value( $deliciosa_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $deliciosa_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $deliciosa_footer_id ) ) ); ?>
						<?php
						$deliciosa_footer_scheme = deliciosa_get_theme_option( 'footer_scheme' );
						if ( ! empty( $deliciosa_footer_scheme ) && ! deliciosa_is_inherit( $deliciosa_footer_scheme  ) ) {
							echo ' scheme_' . esc_attr( $deliciosa_footer_scheme );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'deliciosa_action_show_layout', $deliciosa_footer_id );
	?>
</footer><!-- /.footer_wrap -->
