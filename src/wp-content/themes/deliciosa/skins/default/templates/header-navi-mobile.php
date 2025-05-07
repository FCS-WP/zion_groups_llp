<?php
/**
 * The template to show mobile menu (used only header_style == 'default')
 *
 * @package DELICIOSA
 * @since DELICIOSA 1.0
 */

$deliciosa_show_widgets = deliciosa_get_theme_option( 'widgets_menu_mobile_fullscreen' );
$deliciosa_show_socials = deliciosa_get_theme_option( 'menu_mobile_socials' );

?>
<div class="menu_mobile_overlay scheme_dark"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr( deliciosa_get_theme_option( 'menu_mobile_fullscreen' ) > 0 ? 'fullscreen' : 'narrow' ); ?> scheme_dark">
	<div class="menu_mobile_inner<?php echo esc_attr( $deliciosa_show_widgets == 1  ? ' with_widgets' : '' ); ?>">
        <div class="menu_mobile_header_wrap">
            <?php
            // Logo
            set_query_var( 'deliciosa_logo_args', array( 'type' => 'mobile' ) );
            get_template_part( apply_filters( 'deliciosa_filter_get_template_part', 'templates/header-logo' ) );
            set_query_var( 'deliciosa_logo_args', array() ); ?>

            <a class="menu_mobile_close menu_button_close" tabindex="0"><span class="menu_button_close_text"><?php esc_html_e('Close', 'deliciosa')?></span><span class="menu_button_close_icon"></span></a>
        </div>
        <div class="menu_mobile_content_wrap content_wrap">
            <div class="menu_mobile_content_wrap_inner<?php echo esc_attr($deliciosa_show_socials ? '' : ' without_socials'); ?>"><?php
            // Mobile menu
            $deliciosa_menu_mobile = deliciosa_get_nav_menu( 'menu_mobile' );
            if ( empty( $deliciosa_menu_mobile ) ) {
                $deliciosa_menu_mobile = apply_filters( 'deliciosa_filter_get_mobile_menu', '' );
                if ( empty( $deliciosa_menu_mobile ) ) {
                    $deliciosa_menu_mobile = deliciosa_get_nav_menu( 'menu_main' );
                    if ( empty( $deliciosa_menu_mobile ) ) {
                        $deliciosa_menu_mobile = deliciosa_get_nav_menu();
                    }
                }
            }
            if ( ! empty( $deliciosa_menu_mobile ) ) {
                $deliciosa_menu_mobile = str_replace(
                    array( 'menu_main',   'id="menu-',        'sc_layouts_menu_nav', 'sc_layouts_menu ', 'sc_layouts_hide_on_mobile', 'hide_on_mobile' ),
                    array( 'menu_mobile', 'id="menu_mobile-', '',                    ' ',                '',                          '' ),
                    $deliciosa_menu_mobile
                );
                if ( strpos( $deliciosa_menu_mobile, '<nav ' ) === false ) {
                    $deliciosa_menu_mobile = sprintf( '<nav class="menu_mobile_nav_area" itemscope="itemscope" itemtype="%1$s//schema.org/SiteNavigationElement">%2$s</nav>', esc_attr( deliciosa_get_protocol( true ) ), $deliciosa_menu_mobile );
                }
                deliciosa_show_layout( apply_filters( 'deliciosa_filter_menu_mobile_layout', $deliciosa_menu_mobile ) );
            }
            // Social icons
            if($deliciosa_show_socials) {
                deliciosa_show_layout( deliciosa_get_socials_links(), '<div class="socials_mobile">', '</div>' );
            }            
            ?>
            </div>
		</div><?php

        if ( $deliciosa_show_widgets == 1 )  {
            ?><div class="menu_mobile_widgets_area"><?php
            // Create Widgets Area
            deliciosa_create_widgets_area( 'widgets_additional_menu_mobile_fullscreen' );
            ?></div><?php
        } ?>

    </div>
</div>
