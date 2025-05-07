<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0
 */

$deliciosa_template_args = get_query_var( 'deliciosa_template_args' );

if ( is_array( $deliciosa_template_args ) ) {
	$deliciosa_columns    = empty( $deliciosa_template_args['columns'] ) ? 2 : max( 1, $deliciosa_template_args['columns'] );
	$deliciosa_blog_style = array( $deliciosa_template_args['type'], $deliciosa_columns );
    $deliciosa_columns_class = deliciosa_get_column_class( 1, $deliciosa_columns, ! empty( $deliciosa_template_args['columns_tablet']) ? $deliciosa_template_args['columns_tablet'] : '', ! empty($deliciosa_template_args['columns_mobile']) ? $deliciosa_template_args['columns_mobile'] : '' );
} else {
	$deliciosa_template_args = array();
	$deliciosa_blog_style = explode( '_', deliciosa_get_theme_option( 'blog_style' ) );
	$deliciosa_columns    = empty( $deliciosa_blog_style[1] ) ? 2 : max( 1, $deliciosa_blog_style[1] );
    $deliciosa_columns_class = deliciosa_get_column_class( 1, $deliciosa_columns );
}
$deliciosa_expanded   = ! deliciosa_sidebar_present() && deliciosa_get_theme_option( 'expand_content' ) == 'expand';

$deliciosa_post_format = get_post_format();
$deliciosa_post_format = empty( $deliciosa_post_format ) ? 'standard' : str_replace( 'post-format-', '', $deliciosa_post_format );

?><div class="<?php
	if ( ! empty( $deliciosa_template_args['slider'] ) ) {
		echo ' slider-slide swiper-slide';
	} else {
		echo ( deliciosa_is_blog_style_use_masonry( $deliciosa_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $deliciosa_columns ) : esc_attr( $deliciosa_columns_class ) );
	}
?>"><article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $deliciosa_post_format )
				. ' post_layout_classic post_layout_classic_' . esc_attr( $deliciosa_columns )
				. ' post_layout_' . esc_attr( $deliciosa_blog_style[0] )
				. ' post_layout_' . esc_attr( $deliciosa_blog_style[0] ) . '_' . esc_attr( $deliciosa_columns )
	);
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
								: explode( ',', $deliciosa_template_args['meta_parts'] )
								)
							: deliciosa_array_get_keys_by_value( deliciosa_get_theme_option( 'meta_parts' ) );

	deliciosa_show_post_featured( apply_filters( 'deliciosa_filter_args_featured',
		array(
			'thumb_size' => ! empty( $deliciosa_template_args['thumb_size'] )
				? $deliciosa_template_args['thumb_size']
				: deliciosa_get_thumb_size(
					'classic' == $deliciosa_blog_style[0]
						? ( strpos( deliciosa_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $deliciosa_columns > 2 ? 'big' : 'huge' )
								: ( $deliciosa_columns > 2
									? ( $deliciosa_expanded ? 'square' : 'square' )
									: ($deliciosa_columns > 1 ? 'square' : ( $deliciosa_expanded ? 'huge' : 'big' ))
									)
							)
						: ( strpos( deliciosa_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $deliciosa_columns > 2 ? 'masonry-big' : 'full' )
								: ($deliciosa_columns === 1 ? ( $deliciosa_expanded ? 'huge' : 'big' ) : ( $deliciosa_columns <= 2 && $deliciosa_expanded ? 'masonry-big' : 'masonry' ))
							)
			),
			'hover'      => $deliciosa_hover,
			'meta_parts' => $deliciosa_components,
			'no_links'   => ! empty( $deliciosa_template_args['no_links'] ),
        ),
        'content-classic',
        $deliciosa_template_args
    ) );

	// Title and post meta
	$deliciosa_show_title = get_the_title() != '';
	$deliciosa_show_meta  = count( $deliciosa_components ) > 0 && ! in_array( $deliciosa_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $deliciosa_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php

			// Post meta
			if ( apply_filters( 'deliciosa_filter_show_blog_meta', $deliciosa_show_meta, $deliciosa_components, 'classic' ) ) {
				if ( count( $deliciosa_components ) > 0 ) {
					do_action( 'deliciosa_action_before_post_meta' );
					deliciosa_show_post_meta(
						apply_filters(
							'deliciosa_filter_post_meta_args', array(
							'components' => join( ',', $deliciosa_components ),
							'seo'        => false,
							'echo'       => true,
						), $deliciosa_blog_style[0], $deliciosa_columns
						)
					);
					do_action( 'deliciosa_action_after_post_meta' );
				}
			}

			// Post title
			if ( apply_filters( 'deliciosa_filter_show_blog_title', true, 'classic' ) ) {
				do_action( 'deliciosa_action_before_post_title' );
				if ( empty( $deliciosa_template_args['no_links'] ) ) {
					the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
				} else {
					the_title( '<h4 class="post_title entry-title">', '</h4>' );
				}
				do_action( 'deliciosa_action_after_post_title' );
			}

			if( !in_array( $deliciosa_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
				// More button
				if ( apply_filters( 'deliciosa_filter_show_blog_readmore', ! $deliciosa_show_title || ! empty( $deliciosa_template_args['more_button'] ), 'classic' ) ) {
					if ( empty( $deliciosa_template_args['no_links'] ) ) {
						do_action( 'deliciosa_action_before_post_readmore' );
						deliciosa_show_post_more_link( $deliciosa_template_args, '<div class="more-wrap">', '</div>' );
						do_action( 'deliciosa_action_after_post_readmore' );
					}
				}
			}
			?>
		</div><!-- .entry-header -->
		<?php
	}

	// Post content
	if( in_array( $deliciosa_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
		ob_start();
		if (apply_filters('deliciosa_filter_show_blog_excerpt', empty($deliciosa_template_args['hide_excerpt']) && deliciosa_get_theme_option('excerpt_length') > 0, 'classic')) {
			deliciosa_show_post_content($deliciosa_template_args, '<div class="post_content_inner">', '</div>');
		}
		// More button
		if(! empty( $deliciosa_template_args['more_button'] )) {
			if ( empty( $deliciosa_template_args['no_links'] ) ) {
				do_action( 'deliciosa_action_before_post_readmore' );
				deliciosa_show_post_more_link( $deliciosa_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'deliciosa_action_after_post_readmore' );
			}
		}
		$deliciosa_content = ob_get_contents();
		ob_end_clean();
		deliciosa_show_layout($deliciosa_content, '<div class="post_content entry-content">', '</div><!-- .entry-content -->');
	}
	?>

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
