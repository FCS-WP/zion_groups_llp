<?php
/**
 * 'Band' template to display the content
 *
 * Used for index/archive/search.
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.71.0
 */

$deliciosa_template_args = get_query_var( 'deliciosa_template_args' );
if ( ! is_array( $deliciosa_template_args ) ) {
	$deliciosa_template_args = array(
								'type'    => 'band',
								'columns' => 1
								);
}

$deliciosa_columns       = 1;

$deliciosa_expanded      = ! deliciosa_sidebar_present() && deliciosa_get_theme_option( 'expand_content' ) == 'expand';

$deliciosa_post_format   = get_post_format();
$deliciosa_post_format   = empty( $deliciosa_post_format ) ? 'standard' : str_replace( 'post-format-', '', $deliciosa_post_format );

if ( is_array( $deliciosa_template_args ) ) {
	$deliciosa_columns    = empty( $deliciosa_template_args['columns'] ) ? 1 : max( 1, $deliciosa_template_args['columns'] );
	$deliciosa_blog_style = array( $deliciosa_template_args['type'], $deliciosa_columns );
	if ( ! empty( $deliciosa_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $deliciosa_columns > 1 ) {
	    $deliciosa_columns_class = deliciosa_get_column_class( 1, $deliciosa_columns, ! empty( $deliciosa_template_args['columns_tablet']) ? $deliciosa_template_args['columns_tablet'] : '', ! empty($deliciosa_template_args['columns_mobile']) ? $deliciosa_template_args['columns_mobile'] : '' );
				?><div class="<?php echo esc_attr( $deliciosa_columns_class ); ?>"><?php
	}
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_band post_format_' . esc_attr( $deliciosa_post_format ) );
	deliciosa_add_blog_animation( $deliciosa_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$deliciosa_hover      = ! empty( $deliciosa_template_args['hover'] ) && ! deliciosa_is_inherit( $deliciosa_template_args['hover'] )
							? $deliciosa_template_args['hover']
							: deliciosa_get_theme_option( 'image_hover' );
	$deliciosa_components = ! empty( $deliciosa_template_args['meta_parts'] )
							? ( is_array( $deliciosa_template_args['meta_parts'] )
								? $deliciosa_template_args['meta_parts']
								: array_map( 'trim', explode( ',', $deliciosa_template_args['meta_parts'] ) )
								)
							: deliciosa_array_get_keys_by_value( deliciosa_get_theme_option( 'meta_parts' ) );
	deliciosa_show_post_featured( apply_filters( 'deliciosa_filter_args_featured',
		array(
			'no_links'   => ! empty( $deliciosa_template_args['no_links'] ),
			'hover'      => $deliciosa_hover,
			'meta_parts' => $deliciosa_components,
			'thumb_bg'   => true,
			'thumb_ratio'   => '1:1',
			'thumb_size' => ! empty( $deliciosa_template_args['thumb_size'] )
								? $deliciosa_template_args['thumb_size']
								: deliciosa_get_thumb_size( 
								in_array( $deliciosa_post_format, array( 'gallery', 'audio', 'video' ) )
									? ( strpos( deliciosa_get_theme_option( 'body_style' ), 'full' ) !== false
										? 'full'
										: ( $deliciosa_expanded 
											? 'big' 
											: 'medium-square'
											)
										)
									: 'masonry-big'
								)
		),
		'content-band',
		$deliciosa_template_args
	) );

	?><div class="post_content_wrap"><?php

		// Title and post meta
		$deliciosa_show_title = get_the_title() != '';
		$deliciosa_show_meta  = count( $deliciosa_components ) > 0 && ! in_array( $deliciosa_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );
		if ( $deliciosa_show_title ) {
			?>
			<div class="post_header entry-header">
				<?php
				// Categories
				if ( apply_filters( 'deliciosa_filter_show_blog_categories', $deliciosa_show_meta && in_array( 'categories', $deliciosa_components ), array( 'categories' ), 'band' ) ) {
					do_action( 'deliciosa_action_before_post_category' );
					?>
					<div class="post_category">
						<?php
						deliciosa_show_post_meta( apply_filters(
															'deliciosa_filter_post_meta_args',
															array(
																'components' => 'categories',
																'seo'        => false,
																'echo'       => true,
																'cat_sep'    => false,
																),
															'hover_' . $deliciosa_hover, 1
															)
											);
						?>
					</div>
					<?php
					$deliciosa_components = deliciosa_array_delete_by_value( $deliciosa_components, 'categories' );
					do_action( 'deliciosa_action_after_post_category' );
				}
				// Post title
				if ( apply_filters( 'deliciosa_filter_show_blog_title', true, 'band' ) ) {
					do_action( 'deliciosa_action_before_post_title' );
					if ( empty( $deliciosa_template_args['no_links'] ) ) {
						the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
					} else {
						the_title( '<h4 class="post_title entry-title">', '</h4>' );
					}
					do_action( 'deliciosa_action_after_post_title' );
				}
				?>
			</div><!-- .post_header -->
			<?php
		}

		// Post content
		if ( ! isset( $deliciosa_template_args['excerpt_length'] ) && ! in_array( $deliciosa_post_format, array( 'gallery', 'audio', 'video' ) ) ) {
			$deliciosa_template_args['excerpt_length'] = 13;
		}
		if ( apply_filters( 'deliciosa_filter_show_blog_excerpt', empty( $deliciosa_template_args['hide_excerpt'] ) && deliciosa_get_theme_option( 'excerpt_length' ) > 0, 'band' ) ) {
			?>
			<div class="post_content entry-content">
				<?php
				// Post content area
				deliciosa_show_post_content( $deliciosa_template_args, '<div class="post_content_inner">', '</div>' );
				?>
			</div><!-- .entry-content -->
			<?php
		}
		// Post meta
		if ( apply_filters( 'deliciosa_filter_show_blog_meta', $deliciosa_show_meta, $deliciosa_components, 'band' ) ) {
			if ( count( $deliciosa_components ) > 0 ) {
				do_action( 'deliciosa_action_before_post_meta' );
				deliciosa_show_post_meta(
					apply_filters(
						'deliciosa_filter_post_meta_args', array(
							'components' => join( ',', $deliciosa_components ),
							'seo'        => false,
							'echo'       => true,
						), 'band', 1
					)
				);
				do_action( 'deliciosa_action_after_post_meta' );
			}
		}
		// More button
		if ( apply_filters( 'deliciosa_filter_show_blog_readmore', ! $deliciosa_show_title || ! empty( $deliciosa_template_args['more_button'] ), 'band' ) ) {
			if ( empty( $deliciosa_template_args['no_links'] ) ) {
				do_action( 'deliciosa_action_before_post_readmore' );
				deliciosa_show_post_more_link( $deliciosa_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'deliciosa_action_after_post_readmore' );
			}
		}
		?>
	</div>
</article>
<?php

if ( is_array( $deliciosa_template_args ) ) {
	if ( ! empty( $deliciosa_template_args['slider'] ) || $deliciosa_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
