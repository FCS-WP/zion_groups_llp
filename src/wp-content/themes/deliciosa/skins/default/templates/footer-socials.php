<?php
/**
 * The template to display the socials in the footer
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0.10
 */


// Socials
if ( deliciosa_is_on( deliciosa_get_theme_option( 'socials_in_footer' ) ) ) {
	$deliciosa_output = deliciosa_get_socials_links();
	if ( '' != $deliciosa_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php deliciosa_show_layout( $deliciosa_output ); ?>
			</div>
		</div>
		<?php
	}
}
