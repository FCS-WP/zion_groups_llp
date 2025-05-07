<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
$deliciosa_copyright_scheme = deliciosa_get_theme_option( 'copyright_scheme' );
if ( ! empty( $deliciosa_copyright_scheme ) && ! deliciosa_is_inherit( $deliciosa_copyright_scheme  ) ) {
	echo ' scheme_' . esc_attr( $deliciosa_copyright_scheme );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$deliciosa_copyright = deliciosa_get_theme_option( 'copyright' );
			if ( ! empty( $deliciosa_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$deliciosa_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $deliciosa_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$deliciosa_copyright = deliciosa_prepare_macros( $deliciosa_copyright );
				// Display copyright
				echo wp_kses( nl2br( $deliciosa_copyright ), 'deliciosa_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
