<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0
 */

$deliciosa_args = get_query_var( 'deliciosa_logo_args' );

// Site logo
$deliciosa_logo_type   = isset( $deliciosa_args['type'] ) ? $deliciosa_args['type'] : '';
$deliciosa_logo_image  = deliciosa_get_logo_image( $deliciosa_logo_type );
$deliciosa_logo_text   = deliciosa_is_on( deliciosa_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$deliciosa_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $deliciosa_logo_image['logo'] ) || ! empty( $deliciosa_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $deliciosa_logo_image['logo'] ) ) {
			if ( empty( $deliciosa_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric($deliciosa_logo_image['logo']) && (int) $deliciosa_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$deliciosa_attr = deliciosa_getimagesize( $deliciosa_logo_image['logo'] );
				echo '<img src="' . esc_url( $deliciosa_logo_image['logo'] ) . '"'
						. ( ! empty( $deliciosa_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $deliciosa_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $deliciosa_logo_text ) . '"'
						. ( ! empty( $deliciosa_attr[3] ) ? ' ' . wp_kses_data( $deliciosa_attr[3] ) : '' )
						. '>';
			}
		} else {
			deliciosa_show_layout( deliciosa_prepare_macros( $deliciosa_logo_text ), '<span class="logo_text">', '</span>' );
			deliciosa_show_layout( deliciosa_prepare_macros( $deliciosa_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
