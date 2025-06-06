<article <?php post_class( 'post_item_single post_item_404 post_item_none_archive' ); ?>>
	<div class="post_content">
		<h1 class="page_title"><?php esc_html_e( 'No results', 'deliciosa' ); ?></h1>
		<div class="page_info">
			<h3 class="page_subtitle"><?php esc_html_e( "We're sorry, but your query did not match", 'deliciosa' ); ?></h3>
			<p class="page_description">
			<?php
			// Translators: Add the site URL to the link
			echo wp_kses_data( sprintf( __( "Can't find what you need? Take a moment and do a search below or start from <a href='%s'>our homepage</a>.", 'deliciosa' ), esc_url( home_url( '/' ) ) ) );
			?>
			</p>
			<?php
			do_action(
				'deliciosa_action_search',
				array(
					'style' => 'normal',
					'class' => 'page_search',
					'ajax'  => false
				)
			);
			?>
		</div>
	</div>
</article>
