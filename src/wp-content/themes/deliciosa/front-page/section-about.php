<div class="front_page_section front_page_section_about<?php
	$deliciosa_scheme = deliciosa_get_theme_option( 'front_page_about_scheme' );
	if ( ! empty( $deliciosa_scheme ) && ! deliciosa_is_inherit( $deliciosa_scheme ) ) {
		echo ' scheme_' . esc_attr( $deliciosa_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( deliciosa_get_theme_option( 'front_page_about_paddings' ) );
	if ( deliciosa_get_theme_option( 'front_page_about_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$deliciosa_css      = '';
		$deliciosa_bg_image = deliciosa_get_theme_option( 'front_page_about_bg_image' );
		if ( ! empty( $deliciosa_bg_image ) ) {
			$deliciosa_css .= 'background-image: url(' . esc_url( deliciosa_get_attachment_url( $deliciosa_bg_image ) ) . ');';
		}
		if ( ! empty( $deliciosa_css ) ) {
			echo ' style="' . esc_attr( $deliciosa_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$deliciosa_anchor_icon = deliciosa_get_theme_option( 'front_page_about_anchor_icon' );
	$deliciosa_anchor_text = deliciosa_get_theme_option( 'front_page_about_anchor_text' );
if ( ( ! empty( $deliciosa_anchor_icon ) || ! empty( $deliciosa_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_about"'
									. ( ! empty( $deliciosa_anchor_icon ) ? ' icon="' . esc_attr( $deliciosa_anchor_icon ) . '"' : '' )
									. ( ! empty( $deliciosa_anchor_text ) ? ' title="' . esc_attr( $deliciosa_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_about_inner
	<?php
	if ( deliciosa_get_theme_option( 'front_page_about_fullheight' ) ) {
		echo ' deliciosa-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$deliciosa_css           = '';
			$deliciosa_bg_mask       = deliciosa_get_theme_option( 'front_page_about_bg_mask' );
			$deliciosa_bg_color_type = deliciosa_get_theme_option( 'front_page_about_bg_color_type' );
			if ( 'custom' == $deliciosa_bg_color_type ) {
				$deliciosa_bg_color = deliciosa_get_theme_option( 'front_page_about_bg_color' );
			} elseif ( 'scheme_bg_color' == $deliciosa_bg_color_type ) {
				$deliciosa_bg_color = deliciosa_get_scheme_color( 'bg_color', $deliciosa_scheme );
			} else {
				$deliciosa_bg_color = '';
			}
			if ( ! empty( $deliciosa_bg_color ) && $deliciosa_bg_mask > 0 ) {
				$deliciosa_css .= 'background-color: ' . esc_attr(
					1 == $deliciosa_bg_mask ? $deliciosa_bg_color : deliciosa_hex2rgba( $deliciosa_bg_color, $deliciosa_bg_mask )
				) . ';';
			}
			if ( ! empty( $deliciosa_css ) ) {
				echo ' style="' . esc_attr( $deliciosa_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_about_content_wrap content_wrap">
			<?php
			// Caption
			$deliciosa_caption = deliciosa_get_theme_option( 'front_page_about_caption' );
			if ( ! empty( $deliciosa_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_about_caption front_page_block_<?php echo ! empty( $deliciosa_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $deliciosa_caption, 'deliciosa_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$deliciosa_description = deliciosa_get_theme_option( 'front_page_about_description' );
			if ( ! empty( $deliciosa_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_about_description front_page_block_<?php echo ! empty( $deliciosa_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $deliciosa_description ), 'deliciosa_kses_content' ); ?></div>
				<?php
			}

			// Content
			$deliciosa_content = deliciosa_get_theme_option( 'front_page_about_content' );
			if ( ! empty( $deliciosa_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_content front_page_section_about_content front_page_block_<?php echo ! empty( $deliciosa_content ) ? 'filled' : 'empty'; ?>">
					<?php
					$deliciosa_page_content_mask = '%%CONTENT%%';
					if ( strpos( $deliciosa_content, $deliciosa_page_content_mask ) !== false ) {
						$deliciosa_content = preg_replace(
							'/(\<p\>\s*)?' . $deliciosa_page_content_mask . '(\s*\<\/p\>)/i',
							sprintf(
								'<div class="front_page_section_about_source">%s</div>',
								apply_filters( 'the_content', get_the_content() )
							),
							$deliciosa_content
						);
					}
					deliciosa_show_layout( $deliciosa_content );
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
