<?php
/**
 * The Portfolio template to display the content
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

$deliciosa_post_format = get_post_format();
$deliciosa_post_format = empty( $deliciosa_post_format ) ? 'standard' : str_replace( 'post-format-', '', $deliciosa_post_format );

?><div class="
<?php
if ( ! empty( $deliciosa_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( deliciosa_is_blog_style_use_masonry( $deliciosa_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $deliciosa_columns ) : esc_attr( $deliciosa_columns_class ));
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $deliciosa_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $deliciosa_columns )
		. ( 'portfolio' != $deliciosa_blog_style[0] ? ' ' . esc_attr( $deliciosa_blog_style[0] )  . '_' . esc_attr( $deliciosa_columns ) : '' )
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

	$deliciosa_hover   = ! empty( $deliciosa_template_args['hover'] ) && ! deliciosa_is_inherit( $deliciosa_template_args['hover'] )
								? $deliciosa_template_args['hover']
								: deliciosa_get_theme_option( 'image_hover' );

	if ( 'dots' == $deliciosa_hover ) {
		$deliciosa_post_link = empty( $deliciosa_template_args['no_links'] )
								? ( ! empty( $deliciosa_template_args['link'] )
									? $deliciosa_template_args['link']
									: get_permalink()
									)
								: '';
		$deliciosa_target    = ! empty( $deliciosa_post_link ) && false === strpos( $deliciosa_post_link, home_url() )
								? ' target="_blank" rel="nofollow"'
								: '';
	}
	
	// Meta parts
	$deliciosa_components = ! empty( $deliciosa_template_args['meta_parts'] )
							? ( is_array( $deliciosa_template_args['meta_parts'] )
								? $deliciosa_template_args['meta_parts']
								: explode( ',', $deliciosa_template_args['meta_parts'] )
								)
							: deliciosa_array_get_keys_by_value( deliciosa_get_theme_option( 'meta_parts' ) );

	// Featured image
	deliciosa_show_post_featured( apply_filters( 'deliciosa_filter_args_featured',
        array(
			'hover'         => $deliciosa_hover,
			'no_links'      => ! empty( $deliciosa_template_args['no_links'] ),
			'thumb_size'    => ! empty( $deliciosa_template_args['thumb_size'] )
								? $deliciosa_template_args['thumb_size']
								: deliciosa_get_thumb_size(
									deliciosa_is_blog_style_use_masonry( $deliciosa_blog_style[0] )
										? (	strpos( deliciosa_get_theme_option( 'body_style' ), 'full' ) !== false || $deliciosa_columns < 3
											? 'masonry-big'
											: 'masonry'
											)
										: (	strpos( deliciosa_get_theme_option( 'body_style' ), 'full' ) !== false || $deliciosa_columns < 3
											? 'square'
											: 'square'
											)
								),
			'thumb_bg' => deliciosa_is_blog_style_use_masonry( $deliciosa_blog_style[0] ) ? false : true,
			'show_no_image' => true,
			'meta_parts'    => $deliciosa_components,
			'class'         => 'dots' == $deliciosa_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $deliciosa_hover
										? '<div class="post_info"><h5 class="post_title">'
											. ( ! empty( $deliciosa_post_link )
												? '<a href="' . esc_url( $deliciosa_post_link ) . '"' . ( ! empty( $target ) ? $target : '' ) . '>'
												: ''
												)
												. esc_html( get_the_title() ) 
											. ( ! empty( $deliciosa_post_link )
												? '</a>'
												: ''
												)
											. '</h5></div>'
										: '',
            'thumb_ratio'   => 'info' == $deliciosa_hover ?  '100:102' : '',
        ),
        'content-portfolio',
        $deliciosa_template_args
    ) );
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!