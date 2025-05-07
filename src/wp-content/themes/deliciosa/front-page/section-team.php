<div class="front_page_section front_page_section_team<?php
	$deliciosa_scheme = deliciosa_get_theme_option( 'front_page_team_scheme' );
	if ( ! empty( $deliciosa_scheme ) && ! deliciosa_is_inherit( $deliciosa_scheme ) ) {
		echo ' scheme_' . esc_attr( $deliciosa_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( deliciosa_get_theme_option( 'front_page_team_paddings' ) );
	if ( deliciosa_get_theme_option( 'front_page_team_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$deliciosa_css      = '';
		$deliciosa_bg_image = deliciosa_get_theme_option( 'front_page_team_bg_image' );
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
	$deliciosa_anchor_icon = deliciosa_get_theme_option( 'front_page_team_anchor_icon' );
	$deliciosa_anchor_text = deliciosa_get_theme_option( 'front_page_team_anchor_text' );
if ( ( ! empty( $deliciosa_anchor_icon ) || ! empty( $deliciosa_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_team"'
									. ( ! empty( $deliciosa_anchor_icon ) ? ' icon="' . esc_attr( $deliciosa_anchor_icon ) . '"' : '' )
									. ( ! empty( $deliciosa_anchor_text ) ? ' title="' . esc_attr( $deliciosa_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_team_inner
	<?php
	if ( deliciosa_get_theme_option( 'front_page_team_fullheight' ) ) {
		echo ' deliciosa-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$deliciosa_css      = '';
			$deliciosa_bg_mask  = deliciosa_get_theme_option( 'front_page_team_bg_mask' );
			$deliciosa_bg_color_type = deliciosa_get_theme_option( 'front_page_team_bg_color_type' );
			if ( 'custom' == $deliciosa_bg_color_type ) {
				$deliciosa_bg_color = deliciosa_get_theme_option( 'front_page_team_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_team_content_wrap content_wrap">
			<?php
			// Caption
			$deliciosa_caption = deliciosa_get_theme_option( 'front_page_team_caption' );
			if ( ! empty( $deliciosa_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_team_caption front_page_block_<?php echo ! empty( $deliciosa_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $deliciosa_caption, 'deliciosa_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$deliciosa_description = deliciosa_get_theme_option( 'front_page_team_description' );
			if ( ! empty( $deliciosa_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_team_description front_page_block_<?php echo ! empty( $deliciosa_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $deliciosa_description ), 'deliciosa_kses_content' ); ?></div>
				<?php
			}

			// Content (widgets)
			?>
			<div class="front_page_section_output front_page_section_team_output">
				<?php
				if ( is_active_sidebar( 'front_page_team_widgets' ) ) {
					dynamic_sidebar( 'front_page_team_widgets' );
				} elseif ( current_user_can( 'edit_theme_options' ) ) {
					if ( ! deliciosa_exists_trx_addons() ) {
						deliciosa_customizer_need_trx_addons_message();
					} else {
						deliciosa_customizer_need_widgets_message( 'front_page_team_caption', 'ThemeREX Addons - Team' );
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
