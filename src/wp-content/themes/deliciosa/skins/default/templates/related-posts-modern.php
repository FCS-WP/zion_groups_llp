<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0
 */

$deliciosa_link        = get_permalink();
$deliciosa_post_format = get_post_format();
$deliciosa_post_format = empty( $deliciosa_post_format ) ? 'standard' : str_replace( 'post-format-', '', $deliciosa_post_format );
?><div id="post-<?php the_ID(); ?>" <?php post_class( 'related_item post_format_' . esc_attr( $deliciosa_post_format ) ); ?> data-post-id="<?php the_ID(); ?>">
	<?php
	deliciosa_show_post_featured(
		array(
			'thumb_size'    => apply_filters( 'deliciosa_filter_related_thumb_size', deliciosa_get_thumb_size( (int) deliciosa_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'big' ) ),
			'post_info'     => '<div class="post_header entry-header">'
									. '<div class="post_categories">' . wp_kses( deliciosa_get_post_categories( '' ), 'deliciosa_kses_content' ) . '</div>'
									. '<h6 class="post_title entry-title"><a href="' . esc_url( $deliciosa_link ) . '">'
										. wp_kses_data( '' == get_the_title() ? esc_html__( '- No title -', 'deliciosa' ) : get_the_title() )
									. '</a></h6>'
									. ( in_array( get_post_type(), array( 'post', 'attachment' ) )
											? '<div class="post_meta"><a href="' . esc_url( $deliciosa_link ) . '" class="post_meta_item post_date">' . wp_kses_data( deliciosa_get_date() ) . '</a></div>'
											: '' )
								. '</div>',
		)
	);
	?>
</div>
