<?php
$deliciosa_woocommerce_sc = deliciosa_get_theme_option( 'front_page_woocommerce_products' );
if ( ! empty( $deliciosa_woocommerce_sc ) ) {
	?><div class="front_page_section front_page_section_woocommerce<?php
		$deliciosa_scheme = deliciosa_get_theme_option( 'front_page_woocommerce_scheme' );
		if ( ! empty( $deliciosa_scheme ) && ! deliciosa_is_inherit( $deliciosa_scheme ) ) {
			echo ' scheme_' . esc_attr( $deliciosa_scheme );
		}
		echo ' front_page_section_paddings_' . esc_attr( deliciosa_get_theme_option( 'front_page_woocommerce_paddings' ) );
		if ( deliciosa_get_theme_option( 'front_page_woocommerce_stack' ) ) {
			echo ' sc_stack_section_on';
		}
	?>"
			<?php
			$deliciosa_css      = '';
			$deliciosa_bg_image = deliciosa_get_theme_option( 'front_page_woocommerce_bg_image' );
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
		$deliciosa_anchor_icon = deliciosa_get_theme_option( 'front_page_woocommerce_anchor_icon' );
		$deliciosa_anchor_text = deliciosa_get_theme_option( 'front_page_woocommerce_anchor_text' );
		if ( ( ! empty( $deliciosa_anchor_icon ) || ! empty( $deliciosa_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
			echo do_shortcode(
				'[trx_sc_anchor id="front_page_section_woocommerce"'
											. ( ! empty( $deliciosa_anchor_icon ) ? ' icon="' . esc_attr( $deliciosa_anchor_icon ) . '"' : '' )
											. ( ! empty( $deliciosa_anchor_text ) ? ' title="' . esc_attr( $deliciosa_anchor_text ) . '"' : '' )
											. ']'
			);
		}
	?>
		<div class="front_page_section_inner front_page_section_woocommerce_inner
			<?php
			if ( deliciosa_get_theme_option( 'front_page_woocommerce_fullheight' ) ) {
				echo ' deliciosa-full-height sc_layouts_flex sc_layouts_columns_middle';
			}
			?>
				"
				<?php
				$deliciosa_css      = '';
				$deliciosa_bg_mask  = deliciosa_get_theme_option( 'front_page_woocommerce_bg_mask' );
				$deliciosa_bg_color_type = deliciosa_get_theme_option( 'front_page_woocommerce_bg_color_type' );
				if ( 'custom' == $deliciosa_bg_color_type ) {
					$deliciosa_bg_color = deliciosa_get_theme_option( 'front_page_woocommerce_bg_color' );
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
			<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
				<?php
				// Content wrap with title and description
				$deliciosa_caption     = deliciosa_get_theme_option( 'front_page_woocommerce_caption' );
				$deliciosa_description = deliciosa_get_theme_option( 'front_page_woocommerce_description' );
				if ( ! empty( $deliciosa_caption ) || ! empty( $deliciosa_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					// Caption
					if ( ! empty( $deliciosa_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo ! empty( $deliciosa_caption ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( $deliciosa_caption, 'deliciosa_kses_content' );
						?>
						</h2>
						<?php
					}

					// Description (text)
					if ( ! empty( $deliciosa_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo ! empty( $deliciosa_description ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( wpautop( $deliciosa_description ), 'deliciosa_kses_content' );
						?>
						</div>
						<?php
					}
				}

				// Content (widgets)
				?>
				<div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs">
					<?php
					if ( 'products' == $deliciosa_woocommerce_sc ) {
						$deliciosa_woocommerce_sc_ids      = deliciosa_get_theme_option( 'front_page_woocommerce_products_per_page' );
						$deliciosa_woocommerce_sc_per_page = count( explode( ',', $deliciosa_woocommerce_sc_ids ) );
					} else {
						$deliciosa_woocommerce_sc_per_page = max( 1, (int) deliciosa_get_theme_option( 'front_page_woocommerce_products_per_page' ) );
					}
					$deliciosa_woocommerce_sc_columns = max( 1, min( $deliciosa_woocommerce_sc_per_page, (int) deliciosa_get_theme_option( 'front_page_woocommerce_products_columns' ) ) );
					echo do_shortcode(
						"[{$deliciosa_woocommerce_sc}"
										. ( 'products' == $deliciosa_woocommerce_sc
												? ' ids="' . esc_attr( $deliciosa_woocommerce_sc_ids ) . '"'
												: '' )
										. ( 'product_category' == $deliciosa_woocommerce_sc
												? ' category="' . esc_attr( deliciosa_get_theme_option( 'front_page_woocommerce_products_categories' ) ) . '"'
												: '' )
										. ( 'best_selling_products' != $deliciosa_woocommerce_sc
												? ' orderby="' . esc_attr( deliciosa_get_theme_option( 'front_page_woocommerce_products_orderby' ) ) . '"'
													. ' order="' . esc_attr( deliciosa_get_theme_option( 'front_page_woocommerce_products_order' ) ) . '"'
												: '' )
										. ' per_page="' . esc_attr( $deliciosa_woocommerce_sc_per_page ) . '"'
										. ' columns="' . esc_attr( $deliciosa_woocommerce_sc_columns ) . '"'
						. ']'
					);
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
