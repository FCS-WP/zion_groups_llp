<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'deliciosa_cf7_get_css' ) ) {
	add_filter( 'deliciosa_filter_get_css', 'deliciosa_cf7_get_css', 10, 2 );
	function deliciosa_cf7_get_css( $css, $args ) {
		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS

		.wpcf7 span.wpcf7-not-valid-tip,
		div.wpcf7-response-output {
			{$fonts['p_font-family']}
		}

CSS;
		}

		return $css;
	}
}

