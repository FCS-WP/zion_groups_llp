<?php
/**
 * The template to display single post
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0
 */

// Full post loading
$full_post_loading          = deliciosa_get_value_gp( 'action' ) == 'full_post_loading';

// Prev post loading
$prev_post_loading          = deliciosa_get_value_gp( 'action' ) == 'prev_post_loading';
$prev_post_loading_type     = deliciosa_get_theme_option( 'posts_navigation_scroll_which_block' );

// Position of the related posts
$deliciosa_related_position   = deliciosa_get_theme_option( 'related_position' );

// Type of the prev/next post navigation
$deliciosa_posts_navigation   = deliciosa_get_theme_option( 'posts_navigation' );
$deliciosa_prev_post          = false;
$deliciosa_prev_post_same_cat = deliciosa_get_theme_option( 'posts_navigation_scroll_same_cat' );

// Rewrite style of the single post if current post loading via AJAX and featured image and title is not in the content
if ( ( $full_post_loading 
		|| 
		( $prev_post_loading && 'article' == $prev_post_loading_type )
	) 
	&& 
	! in_array( deliciosa_get_theme_option( 'single_style' ), array( 'style-6' ) )
) {
	deliciosa_storage_set_array( 'options_meta', 'single_style', 'style-6' );
}

do_action( 'deliciosa_action_prev_post_loading', $prev_post_loading, $prev_post_loading_type );

get_header();

while ( have_posts() ) {

	the_post();

	// Type of the prev/next post navigation
	if ( 'scroll' == $deliciosa_posts_navigation ) {
		$deliciosa_prev_post = get_previous_post( $deliciosa_prev_post_same_cat );  // Get post from same category
		if ( ! $deliciosa_prev_post && $deliciosa_prev_post_same_cat ) {
			$deliciosa_prev_post = get_previous_post( false );                    // Get post from any category
		}
		if ( ! $deliciosa_prev_post ) {
			$deliciosa_posts_navigation = 'links';
		}
	}

	// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
	if ( $full_post_loading || ( $prev_post_loading && $deliciosa_prev_post ) ) {
		deliciosa_sc_layouts_showed( 'featured', false );
		deliciosa_sc_layouts_showed( 'title', false );
		deliciosa_sc_layouts_showed( 'postmeta', false );
	}

	// If related posts should be inside the content
	if ( strpos( $deliciosa_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'templates/content', 'single-' . deliciosa_get_theme_option( 'single_style' ) ), 'single-' . deliciosa_get_theme_option( 'single_style' ) );

	// If related posts should be inside the content
	if ( strpos( $deliciosa_related_position, 'inside' ) === 0 ) {
		$deliciosa_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'deliciosa_action_related_posts' );
		$deliciosa_related_content = ob_get_contents();
		ob_end_clean();

		if ( ! empty( $deliciosa_related_content ) ) {
			$deliciosa_related_position_inside = max( 0, min( 9, deliciosa_get_theme_option( 'related_position_inside' ) ) );
			if ( 0 == $deliciosa_related_position_inside ) {
				$deliciosa_related_position_inside = mt_rand( 1, 9 );
			}

			$deliciosa_p_number         = 0;
			$deliciosa_related_inserted = false;
			$deliciosa_in_block         = false;
			$deliciosa_content_start    = strpos( $deliciosa_content, '<div class="post_content' );
			$deliciosa_content_end      = strrpos( $deliciosa_content, '</div>' );

			for ( $i = max( 0, $deliciosa_content_start ); $i < min( strlen( $deliciosa_content ) - 3, $deliciosa_content_end ); $i++ ) {
				if ( $deliciosa_content[ $i ] != '<' ) {
					continue;
				}
				if ( $deliciosa_in_block ) {
					if ( strtolower( substr( $deliciosa_content, $i + 1, 12 ) ) == '/blockquote>' ) {
						$deliciosa_in_block = false;
						$i += 12;
					}
					continue;
				} else if ( strtolower( substr( $deliciosa_content, $i + 1, 10 ) ) == 'blockquote' && in_array( $deliciosa_content[ $i + 11 ], array( '>', ' ' ) ) ) {
					$deliciosa_in_block = true;
					$i += 11;
					continue;
				} else if ( 'p' == $deliciosa_content[ $i + 1 ] && in_array( $deliciosa_content[ $i + 2 ], array( '>', ' ' ) ) ) {
					$deliciosa_p_number++;
					if ( $deliciosa_related_position_inside == $deliciosa_p_number ) {
						$deliciosa_related_inserted = true;
						$deliciosa_content = ( $i > 0 ? substr( $deliciosa_content, 0, $i ) : '' )
											. $deliciosa_related_content
											. substr( $deliciosa_content, $i );
					}
				}
			}
			if ( ! $deliciosa_related_inserted ) {
				if ( $deliciosa_content_end > 0 ) {
					$deliciosa_content = substr( $deliciosa_content, 0, $deliciosa_content_end ) . $deliciosa_related_content . substr( $deliciosa_content, $deliciosa_content_end );
				} else {
					$deliciosa_content .= $deliciosa_related_content;
				}
			}
		}

		deliciosa_show_layout( $deliciosa_content );
	}

	// Comments
	do_action( 'deliciosa_action_before_comments' );
	comments_template();
	do_action( 'deliciosa_action_after_comments' );

	// Related posts
	if ( 'below_content' == $deliciosa_related_position
		&& ( 'scroll' != $deliciosa_posts_navigation || deliciosa_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 )
		&& ( ! $full_post_loading || deliciosa_get_theme_option( 'open_full_post_hide_related' ) == 0 )
	) {
		do_action( 'deliciosa_action_related_posts' );
	}

	// Post navigation: type 'scroll'
	if ( 'scroll' == $deliciosa_posts_navigation && ! $full_post_loading ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $deliciosa_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $deliciosa_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $deliciosa_prev_post ) ); ?>"
			<?php do_action( 'deliciosa_action_nav_links_single_scroll_data', $deliciosa_prev_post ); ?>
		></div>
		<?php
	}
}

get_footer();
