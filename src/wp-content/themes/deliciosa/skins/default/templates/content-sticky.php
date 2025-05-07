<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0
 */

$deliciosa_columns     = max( 1, min( 3, count( get_option( 'sticky_posts' ) ) ) );
$deliciosa_post_format = get_post_format();
$deliciosa_post_format = empty( $deliciosa_post_format ) ? 'standard' : str_replace( 'post-format-', '', $deliciosa_post_format );

?><div class="column-1_<?php echo esc_attr( $deliciosa_columns ); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class( 'post_item post_layout_sticky post_format_' . esc_attr( $deliciosa_post_format ) );
	deliciosa_add_blog_animation( $deliciosa_template_args );
	?>
>

	<?php
	if ( is_sticky() && is_home() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	deliciosa_show_post_featured(
		array(
			'thumb_size' => deliciosa_get_thumb_size( 1 == $deliciosa_columns ? 'big' : ( 2 == $deliciosa_columns ? 'med' : 'avatar' ) ),
		)
	);

	if ( ! in_array( $deliciosa_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h5 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			deliciosa_show_post_meta( apply_filters( 'deliciosa_filter_post_meta_args', array(), 'sticky', $deliciosa_columns ) );
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div><?php

// div.column-1_X is a inline-block and new lines and spaces after it are forbidden
