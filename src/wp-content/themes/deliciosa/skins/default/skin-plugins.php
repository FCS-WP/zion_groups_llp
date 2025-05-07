<?php
/**
 * Required plugins
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.76.0
 */

// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$deliciosa_theme_required_plugins_groups = array(
	'core'          => esc_html__( 'Core', 'deliciosa' ),
	'page_builders' => esc_html__( 'Page Builders', 'deliciosa' ),
	'ecommerce'     => esc_html__( 'E-Commerce & Donations', 'deliciosa' ),
	'socials'       => esc_html__( 'Socials and Communities', 'deliciosa' ),
	'events'        => esc_html__( 'Events and Appointments', 'deliciosa' ),
	'content'       => esc_html__( 'Content', 'deliciosa' ),
	'other'         => esc_html__( 'Other', 'deliciosa' ),
);
$deliciosa_theme_required_plugins        = array(
	'trx_addons'                 => array(
		'title'       => esc_html__( 'ThemeREX Addons', 'deliciosa' ),
		'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'deliciosa' ),
		'required'    => true,
		'logo'        => 'trx_addons.png',
		'group'       => $deliciosa_theme_required_plugins_groups['core'],
	),
	'elementor'                  => array(
		'title'       => esc_html__( 'Elementor', 'deliciosa' ),
		'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'deliciosa' ),
		'required'    => false,
		'logo'        => 'elementor.png',
		'group'       => $deliciosa_theme_required_plugins_groups['page_builders'],
	),
	'gutenberg'                  => array(
		'title'       => esc_html__( 'Gutenberg', 'deliciosa' ),
		'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'deliciosa' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gutenberg.png',
		'group'       => $deliciosa_theme_required_plugins_groups['page_builders'],
	),
	'js_composer'                => array(
		'title'       => esc_html__( 'WPBakery PageBuilder', 'deliciosa' ),
		'description' => esc_html__( "Popular PageBuilder which allows you to create excellent pages", 'deliciosa' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'js_composer.jpg',
		'group'       => $deliciosa_theme_required_plugins_groups['page_builders'],
	),
	'woocommerce'                => array(
		'title'       => esc_html__( 'WooCommerce', 'deliciosa' ),
		'description' => esc_html__( "Connect the store to your website and start selling now", 'deliciosa' ),
		'required'    => false,
        	'install'     => false,
        	'logo'        => 'woocommerce.png',
		'group'       => $deliciosa_theme_required_plugins_groups['ecommerce'],
	),
	'elegro-payment'             => array(
		'title'       => esc_html__( 'Elegro Crypto Payment', 'deliciosa' ),
		'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'deliciosa' ),
		'required'    => false,
        	'install'     => false,
        	'logo'        => 'elegro-payment.png',
		'group'       => $deliciosa_theme_required_plugins_groups['ecommerce'],
	),
	'instagram-feed'             => array(
		'title'       => esc_html__( 'Instagram Feed', 'deliciosa' ),
		'description' => esc_html__( "Displays the latest photos from your profile on Instagram", 'deliciosa' ),
		'required'    => false,
        'logo'        => 'instagram-feed.png',
		'group'       => $deliciosa_theme_required_plugins_groups['socials'],
	),
	'mailchimp-for-wp'           => array(
		'title'       => esc_html__( 'MailChimp for WP', 'deliciosa' ),
		'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'deliciosa' ),
		'required'    => false,
		'logo'        => 'mailchimp-for-wp.png',
		'group'       => $deliciosa_theme_required_plugins_groups['socials'],
	),
	'booked'                     => array(
		'title'       => esc_html__( 'Booked Appointments', 'deliciosa' ),
		'description' => '',
		'required'    => false,
        	'install'     => false,
        	'logo'        => 'booked.png',
		'group'       => $deliciosa_theme_required_plugins_groups['events'],
	),
	'the-events-calendar'        => array(
		'title'       => esc_html__( 'The Events Calendar', 'deliciosa' ),
		'description' => '',
		'required'    => false,
        	'install'     => false,
        	'logo'        => 'the-events-calendar.png',
		'group'       => $deliciosa_theme_required_plugins_groups['events'],
	),
	'contact-form-7'             => array(
		'title'       => esc_html__( 'Contact Form 7', 'deliciosa' ),
		'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'deliciosa' ),
		'required'    => false,
		'logo'        => 'contact-form-7.png',
		'group'       => $deliciosa_theme_required_plugins_groups['content'],
	),

	'latepoint'                  => array(
		'title'       => esc_html__( 'LatePoint', 'deliciosa' ),
		'description' => '',
		'required'    => false,
        	'install'     => false,
        	'logo'        => deliciosa_get_file_url( 'plugins/latepoint/latepoint.png' ),
		'group'       => $deliciosa_theme_required_plugins_groups['events'],
	),
	'advanced-popups'                  => array(
		'title'       => esc_html__( 'Advanced Popups', 'deliciosa' ),
		'description' => '',
		'required'    => false,
		'logo'        => deliciosa_get_file_url( 'plugins/advanced-popups/advanced-popups.jpg' ),
		'group'       => $deliciosa_theme_required_plugins_groups['content'],
	),
	'devvn-image-hotspot'                  => array(
		'title'       => esc_html__( 'Image Hotspot by DevVN', 'deliciosa' ),
		'description' => '',
		'required'    => false,
        	'install'     => false,
        	'logo'        => deliciosa_get_file_url( 'plugins/devvn-image-hotspot/devvn-image-hotspot.png' ),
		'group'       => $deliciosa_theme_required_plugins_groups['content'],
	),
	'ti-woocommerce-wishlist'                  => array(
		'title'       => esc_html__( 'TI WooCommerce Wishlist', 'deliciosa' ),
		'description' => '',
		'required'    => false,
        	'install'     => false,
        	'logo'        => deliciosa_get_file_url( 'plugins/ti-woocommerce-wishlist/ti-woocommerce-wishlist.png' ),
		'group'       => $deliciosa_theme_required_plugins_groups['ecommerce'],
	),
	'woo-smart-quick-view'                  => array(
		'title'       => esc_html__( 'WPC Smart Quick View for WooCommerce', 'deliciosa' ),
		'description' => '',
		'required'    => false,
        	'install'     => false,
		'logo'        => deliciosa_get_file_url( 'plugins/woo-smart-quick-view/woo-smart-quick-view.png' ),
		'group'       => $deliciosa_theme_required_plugins_groups['ecommerce'],
	),
	'twenty20'                  => array(
		'title'       => esc_html__( 'Twenty20 Image Before-After', 'deliciosa' ),
		'description' => '',
		'required'    => false,
        	'install'     => false,
        	'logo'        => deliciosa_get_file_url( 'plugins/twenty20/twenty20.png' ),
		'group'       => $deliciosa_theme_required_plugins_groups['content'],
	),
	'essential-grid'             => array(
		'title'       => esc_html__( 'Essential Grid', 'deliciosa' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'essential-grid.png',
		'group'       => $deliciosa_theme_required_plugins_groups['content'],
	),
	'revslider'                  => array(
		'title'       => esc_html__( 'Revolution Slider', 'deliciosa' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'revslider.png',
		'group'       => $deliciosa_theme_required_plugins_groups['content'],
	),
	'sitepress-multilingual-cms' => array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'deliciosa' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'deliciosa' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'sitepress-multilingual-cms.png',
		'group'       => $deliciosa_theme_required_plugins_groups['content'],
	),
	'wp-gdpr-compliance'         => array(
		'title'       => esc_html__( 'Cookie Information', 'deliciosa' ),
		'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'deliciosa' ),
		'required'    => false,
		'logo'        => 'wp-gdpr-compliance.png',
		'group'       => $deliciosa_theme_required_plugins_groups['other'],
	),
	'trx_updater'                => array(
		'title'       => esc_html__( 'ThemeREX Updater', 'deliciosa' ),
		'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'deliciosa' ),
		'required'    => false,
		'logo'        => 'trx_updater.png',
		'group'       => $deliciosa_theme_required_plugins_groups['other'],
	),
);

if ( DELICIOSA_THEME_FREE ) {
	unset( $deliciosa_theme_required_plugins['js_composer'] );
	unset( $deliciosa_theme_required_plugins['booked'] );
	unset( $deliciosa_theme_required_plugins['the-events-calendar'] );
	unset( $deliciosa_theme_required_plugins['calculated-fields-form'] );
	unset( $deliciosa_theme_required_plugins['essential-grid'] );
	unset( $deliciosa_theme_required_plugins['revslider'] );
	unset( $deliciosa_theme_required_plugins['sitepress-multilingual-cms'] );
	unset( $deliciosa_theme_required_plugins['trx_updater'] );
	unset( $deliciosa_theme_required_plugins['trx_popup'] );
}

// Add plugins list to the global storage
deliciosa_storage_set( 'required_plugins', $deliciosa_theme_required_plugins );
