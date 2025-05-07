<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0.50
 */

$deliciosa_template_args = get_query_var( 'deliciosa_template_args' );
if ( is_array( $deliciosa_template_args ) ) {
	$deliciosa_columns    = empty( $deliciosa_template_args['columns'] ) ? 2 : max( 1, $deliciosa_template_args['columns'] );
	$deliciosa_blog_style = array( $deliciosa_template_args['type'], $deliciosa_columns );
} else {
	$deliciosa_template_args = array();
	$deliciosa_blog_style = explode( '_', deliciosa_get_theme_option( 'blog_style' ) );
	$deliciosa_columns    = empty( $deliciosa_blog_style[1] ) ? 2 : max( 1, $deliciosa_blog_style[1] );
}
$deliciosa_blog_id       = deliciosa_get_custom_blog_id( join( '_', $deliciosa_blog_style ) );
$deliciosa_blog_style[0] = str_replace( 'blog-custom-', '', $deliciosa_blog_style[0] );
$deliciosa_expanded      = ! deliciosa_sidebar_present() && deliciosa_get_theme_option( 'expand_content' ) == 'expand';
$deliciosa_components    = ! empty( $deliciosa_template_args['meta_parts'] )
							? ( is_array( $deliciosa_template_args['meta_parts'] )
								? join( ',', $deliciosa_template_args['meta_parts'] )
								: $deliciosa_template_args['meta_parts']
								)
							: deliciosa_array_get_keys_by_value( deliciosa_get_theme_option( 'meta_parts' ) );
$deliciosa_post_format   = get_post_format();
$deliciosa_post_format   = empty( $deliciosa_post_format ) ? 'standard' : str_replace( 'post-format-', '', $deliciosa_post_format );

$deliciosa_blog_meta     = deliciosa_get_custom_layout_meta( $deliciosa_blog_id );
$deliciosa_custom_style  = ! empty( $deliciosa_blog_meta['scripts_required'] ) ? $deliciosa_blog_meta['scripts_required'] : 'none';

if ( ! empty( $deliciosa_template_args['slider'] ) || $deliciosa_columns > 1 || ! deliciosa_is_off( $deliciosa_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $deliciosa_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo esc_attr( ( deliciosa_is_off( $deliciosa_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $deliciosa_custom_style ) ) . "-1_{$deliciosa_columns}" );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
			'post_item post_item_container post_format_' . esc_attr( $deliciosa_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $deliciosa_columns )
					. ' post_layout_' . esc_attr( $deliciosa_blog_style[0] )
					. ' post_layout_' . esc_attr( $deliciosa_blog_style[0] ) . '_' . esc_attr( $deliciosa_columns )
					. ( ! deliciosa_is_off( $deliciosa_custom_style )
						? ' post_layout_' . esc_attr( $deliciosa_custom_style )
							. ' post_layout_' . esc_attr( $deliciosa_custom_style ) . '_' . esc_attr( $deliciosa_columns )
						: ''
						)
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
	// Custom layout
	do_action( 'deliciosa_action_show_layout', $deliciosa_blog_id, get_the_ID() );
	?>
</article><?php
if ( ! empty( $deliciosa_template_args['slider'] ) || $deliciosa_columns > 1 || ! deliciosa_is_off( $deliciosa_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
