<?php
/**
 * The template to display the site logo in the footer
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0.10
 */

// Logo
if ( deliciosa_is_on( deliciosa_get_theme_option( 'logo_in_footer' ) ) ) {
	$deliciosa_logo_image = deliciosa_get_logo_image( 'footer' );
	$deliciosa_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $deliciosa_logo_image['logo'] ) || ! empty( $deliciosa_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $deliciosa_logo_image['logo'] ) ) {
					$deliciosa_attr = deliciosa_getimagesize( $deliciosa_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $deliciosa_logo_image['logo'] ) . '"'
								. ( ! empty( $deliciosa_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $deliciosa_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'deliciosa' ) . '"'
								. ( ! empty( $deliciosa_attr[3] ) ? ' ' . wp_kses_data( $deliciosa_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $deliciosa_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $deliciosa_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
