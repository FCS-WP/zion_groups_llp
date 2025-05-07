<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0
 */

// Page (category, tag, archive, author) title

if ( deliciosa_need_page_title() ) {
	deliciosa_sc_layouts_showed( 'title', true );
	deliciosa_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								deliciosa_show_post_meta(
									apply_filters(
										'deliciosa_filter_post_meta_args', array(
											'components' => join( ',', deliciosa_array_get_keys_by_value( deliciosa_get_theme_option( 'meta_parts' ) ) ),
											'counters'   => join( ',', deliciosa_array_get_keys_by_value( deliciosa_get_theme_option( 'counters' ) ) ),
											'seo'        => deliciosa_is_on( deliciosa_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$deliciosa_blog_title           = deliciosa_get_blog_title();
							$deliciosa_blog_title_text      = '';
							$deliciosa_blog_title_class     = '';
							$deliciosa_blog_title_link      = '';
							$deliciosa_blog_title_link_text = '';
							if ( is_array( $deliciosa_blog_title ) ) {
								$deliciosa_blog_title_text      = $deliciosa_blog_title['text'];
								$deliciosa_blog_title_class     = ! empty( $deliciosa_blog_title['class'] ) ? ' ' . $deliciosa_blog_title['class'] : '';
								$deliciosa_blog_title_link      = ! empty( $deliciosa_blog_title['link'] ) ? $deliciosa_blog_title['link'] : '';
								$deliciosa_blog_title_link_text = ! empty( $deliciosa_blog_title['link_text'] ) ? $deliciosa_blog_title['link_text'] : '';
							} else {
								$deliciosa_blog_title_text = $deliciosa_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $deliciosa_blog_title_class ); ?>">
								<?php
								$deliciosa_top_icon = deliciosa_get_term_image_small();
								if ( ! empty( $deliciosa_top_icon ) ) {
									$deliciosa_attr = deliciosa_getimagesize( $deliciosa_top_icon );
									?>
									<img src="<?php echo esc_url( $deliciosa_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'deliciosa' ); ?>"
										<?php
										if ( ! empty( $deliciosa_attr[3] ) ) {
											deliciosa_show_layout( $deliciosa_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_data( $deliciosa_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $deliciosa_blog_title_link ) && ! empty( $deliciosa_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $deliciosa_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $deliciosa_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( ! is_paged() && ( is_category() || is_tag() || is_tax() ) ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						ob_start();
						do_action( 'deliciosa_action_breadcrumbs' );
						$deliciosa_breadcrumbs = ob_get_contents();
						ob_end_clean();
						deliciosa_show_layout( $deliciosa_breadcrumbs, '<div class="sc_layouts_title_breadcrumbs">', '</div>' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
