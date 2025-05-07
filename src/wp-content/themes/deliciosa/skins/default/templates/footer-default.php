<?php
/**
 * The template to display default site footer
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
$deliciosa_footer_scheme = deliciosa_get_theme_option( 'footer_scheme' );
if ( ! empty( $deliciosa_footer_scheme ) && ! deliciosa_is_inherit( $deliciosa_footer_scheme  ) ) {
	echo ' scheme_' . esc_attr( $deliciosa_footer_scheme );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'templates/footer-socials' ) );

	// Copyright area
	get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
