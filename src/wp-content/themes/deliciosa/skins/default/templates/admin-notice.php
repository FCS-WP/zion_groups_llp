<?php
/**
 * The template to display Admin notices
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0.1
 */

$deliciosa_theme_slug = get_option( 'template' );
$deliciosa_theme_obj  = wp_get_theme( $deliciosa_theme_slug );
?>
<div class="deliciosa_admin_notice deliciosa_welcome_notice notice notice-info is-dismissible" data-notice="admin">
	<?php
	// Theme image
	$deliciosa_theme_img = deliciosa_get_file_url( 'screenshot.jpg' );
	if ( '' != $deliciosa_theme_img ) {
		?>
		<div class="deliciosa_notice_image"><img src="<?php echo esc_url( $deliciosa_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'deliciosa' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="deliciosa_notice_title">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'deliciosa' ),
				$deliciosa_theme_obj->get( 'Name' ) . ( DELICIOSA_THEME_FREE ? ' ' . __( 'Free', 'deliciosa' ) : '' ),
				$deliciosa_theme_obj->get( 'Version' )
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="deliciosa_notice_text">
		<p class="deliciosa_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $deliciosa_theme_obj->description ) );
			?>
		</p>
		<p class="deliciosa_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'deliciosa' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="deliciosa_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=deliciosa_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'deliciosa' );
			?>
		</a>
	</div>
</div>
