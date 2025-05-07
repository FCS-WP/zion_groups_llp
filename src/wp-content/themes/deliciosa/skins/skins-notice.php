<?php
/**
 * The template to display Admin notices
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0.64
 */

$deliciosa_skins_url  = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$deliciosa_skins_args = get_query_var( 'deliciosa_skins_notice_args' );
?>
<div class="deliciosa_admin_notice deliciosa_skins_notice notice notice-info is-dismissible" data-notice="skins">
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
		<?php esc_html_e( 'New skins are available', 'deliciosa' ); ?>
	</h3>
	<?php

	// Description
	$deliciosa_total      = $deliciosa_skins_args['update'];	// Store value to the separate variable to avoid warnings from ThemeCheck plugin!
	$deliciosa_skins_msg  = $deliciosa_total > 0
							// Translators: Add new skins number
							? '<strong>' . sprintf( _n( '%d new version', '%d new versions', $deliciosa_total, 'deliciosa' ), $deliciosa_total ) . '</strong>'
							: '';
	$deliciosa_total      = $deliciosa_skins_args['free'];
	$deliciosa_skins_msg .= $deliciosa_total > 0
							? ( ! empty( $deliciosa_skins_msg ) ? ' ' . esc_html__( 'and', 'deliciosa' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d free skin', '%d free skins', $deliciosa_total, 'deliciosa' ), $deliciosa_total ) . '</strong>'
							: '';
	$deliciosa_total      = $deliciosa_skins_args['pay'];
	$deliciosa_skins_msg .= $deliciosa_skins_args['pay'] > 0
							? ( ! empty( $deliciosa_skins_msg ) ? ' ' . esc_html__( 'and', 'deliciosa' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d paid skin', '%d paid skins', $deliciosa_total, 'deliciosa' ), $deliciosa_total ) . '</strong>'
							: '';
	?>
	<div class="deliciosa_notice_text">
		<p>
			<?php
			// Translators: Add new skins info
			echo wp_kses_data( sprintf( __( "We are pleased to announce that %s are available for your theme", 'deliciosa' ), $deliciosa_skins_msg ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="deliciosa_notice_buttons">
		<?php
		// Link to the theme dashboard page
		?>
		<a href="<?php echo esc_url( $deliciosa_skins_url ); ?>" class="button button-primary"><i class="dashicons dashicons-update"></i> 
			<?php
			// Translators: Add theme name
			esc_html_e( 'Go to Skins manager', 'deliciosa' );
			?>
		</a>
	</div>
</div>
