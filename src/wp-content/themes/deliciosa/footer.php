<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0
 */

							do_action( 'deliciosa_action_page_content_end_text' );
							
							// Widgets area below the content
							deliciosa_create_widgets_area( 'widgets_below_content' );
						
							do_action( 'deliciosa_action_page_content_end' );
							?>
						</div>
						<?php
						
						do_action( 'deliciosa_action_after_page_content' );

						// Show main sidebar
						get_sidebar();

						do_action( 'deliciosa_action_content_wrap_end' );
						?>
					</div>
					<?php

					do_action( 'deliciosa_action_after_content_wrap' );

					// Widgets area below the page and related posts below the page
					$deliciosa_body_style = deliciosa_get_theme_option( 'body_style' );
					$deliciosa_widgets_name = deliciosa_get_theme_option( 'widgets_below_page' );
					$deliciosa_show_widgets = ! deliciosa_is_off( $deliciosa_widgets_name ) && is_active_sidebar( $deliciosa_widgets_name );
					$deliciosa_show_related = deliciosa_is_single() && deliciosa_get_theme_option( 'related_position' ) == 'below_page';
					if ( $deliciosa_show_widgets || $deliciosa_show_related ) {
						if ( 'fullscreen' != $deliciosa_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $deliciosa_show_related ) {
							do_action( 'deliciosa_action_related_posts' );
						}

						// Widgets area below page content
						if ( $deliciosa_show_widgets ) {
							deliciosa_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $deliciosa_body_style ) {
							?>
							</div>
							<?php
						}
					}
					do_action( 'deliciosa_action_page_content_wrap_end' );
					?>
			</div>
			<?php
			do_action( 'deliciosa_action_after_page_content_wrap' );

			// Don't display the footer elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ( ! deliciosa_is_singular( 'post' ) && ! deliciosa_is_singular( 'attachment' ) ) || ! in_array ( deliciosa_get_value_gp( 'action' ), array( 'full_post_loading', 'prev_post_loading' ) ) ) {
				
				// Skip link anchor to fast access to the footer from keyboard
				?>
				<a id="footer_skip_link_anchor" class="deliciosa_skip_link_anchor" href="#"></a>
				<?php

				do_action( 'deliciosa_action_before_footer' );

				// Footer
				$deliciosa_footer_type = deliciosa_get_theme_option( 'footer_type' );
				if ( 'custom' == $deliciosa_footer_type && ! deliciosa_is_layouts_available() ) {
					$deliciosa_footer_type = 'default';
				}
				get_template_part( apply_filters( 'deliciosa_filter_get_template_part', "templates/footer-" . sanitize_file_name( $deliciosa_footer_type ) ) );

				do_action( 'deliciosa_action_after_footer' );

			}
			?>

			<?php do_action( 'deliciosa_action_page_wrap_end' ); ?>

		</div>

		<?php do_action( 'deliciosa_action_after_page_wrap' ); ?>

	</div>

	<?php do_action( 'deliciosa_action_after_body' ); ?>

	<?php wp_footer(); ?>

</body>
</html>