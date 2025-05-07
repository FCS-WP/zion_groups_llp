<div class="front_page_section front_page_section_contacts<?php
	$deliciosa_scheme = deliciosa_get_theme_option( 'front_page_contacts_scheme' );
	if ( ! empty( $deliciosa_scheme ) && ! deliciosa_is_inherit( $deliciosa_scheme ) ) {
		echo ' scheme_' . esc_attr( $deliciosa_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( deliciosa_get_theme_option( 'front_page_contacts_paddings' ) );
	if ( deliciosa_get_theme_option( 'front_page_contacts_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$deliciosa_css      = '';
		$deliciosa_bg_image = deliciosa_get_theme_option( 'front_page_contacts_bg_image' );
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
	$deliciosa_anchor_icon = deliciosa_get_theme_option( 'front_page_contacts_anchor_icon' );
	$deliciosa_anchor_text = deliciosa_get_theme_option( 'front_page_contacts_anchor_text' );
if ( ( ! empty( $deliciosa_anchor_icon ) || ! empty( $deliciosa_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_contacts"'
									. ( ! empty( $deliciosa_anchor_icon ) ? ' icon="' . esc_attr( $deliciosa_anchor_icon ) . '"' : '' )
									. ( ! empty( $deliciosa_anchor_text ) ? ' title="' . esc_attr( $deliciosa_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_contacts_inner
	<?php
	if ( deliciosa_get_theme_option( 'front_page_contacts_fullheight' ) ) {
		echo ' deliciosa-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$deliciosa_css      = '';
			$deliciosa_bg_mask  = deliciosa_get_theme_option( 'front_page_contacts_bg_mask' );
			$deliciosa_bg_color_type = deliciosa_get_theme_option( 'front_page_contacts_bg_color_type' );
			if ( 'custom' == $deliciosa_bg_color_type ) {
				$deliciosa_bg_color = deliciosa_get_theme_option( 'front_page_contacts_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$deliciosa_caption     = deliciosa_get_theme_option( 'front_page_contacts_caption' );
			$deliciosa_description = deliciosa_get_theme_option( 'front_page_contacts_description' );
			if ( ! empty( $deliciosa_caption ) || ! empty( $deliciosa_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				// Caption
				if ( ! empty( $deliciosa_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo ! empty( $deliciosa_caption ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( $deliciosa_caption, 'deliciosa_kses_content' );
					?>
					</h2>
					<?php
				}

				// Description
				if ( ! empty( $deliciosa_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo ! empty( $deliciosa_description ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( wpautop( $deliciosa_description ), 'deliciosa_kses_content' );
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$deliciosa_content = deliciosa_get_theme_option( 'front_page_contacts_content' );
			$deliciosa_layout  = deliciosa_get_theme_option( 'front_page_contacts_layout' );
			if ( 'columns' == $deliciosa_layout && ( ! empty( $deliciosa_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ( ( ! empty( $deliciosa_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo ! empty( $deliciosa_content ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( $deliciosa_content, 'deliciosa_kses_content' );
					?>
				</div>
				<?php
			}

			if ( 'columns' == $deliciosa_layout && ( ! empty( $deliciosa_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div><div class="column-2_3">
				<?php
			}

			// Shortcode output
			$deliciosa_sc = deliciosa_get_theme_option( 'front_page_contacts_shortcode' );
			if ( ! empty( $deliciosa_sc ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo ! empty( $deliciosa_sc ) ? 'filled' : 'empty'; ?>">
					<?php
					deliciosa_show_layout( do_shortcode( $deliciosa_sc ) );
					?>
				</div>
				<?php
			}

			if ( 'columns' == $deliciosa_layout && ( ! empty( $deliciosa_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>

		</div>
	</div>
</div>
