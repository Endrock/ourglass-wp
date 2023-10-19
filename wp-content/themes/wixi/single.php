<?php

/**
* The template for displaying all single posts
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package WordPress
* @subpackage Wixi
* @since 1.0.0
*/

    if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {
        $page_settings = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' )->get_model( get_the_ID() );
        $header = $page_settings->get_settings( 'wixi_elementor_hide_page_header' );
        $footer = $page_settings->get_settings( 'wixi_elementor_hide_page_footer' );
        if ( 'yes' == $header ) {
            remove_action( 'wixi_header_action', 'wixi_main_header', 10 );
        }
        if ( 'yes' == $footer ) {
            remove_action( 'wixi_footer_action', 'wixi_footer', 10 );
        }
    }

    get_header();

    // Elementor `single` location
    if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
        // you can use this action to add any content before single page
        do_action( 'wixi_before_post_single' );

        if ( wixi_check_is_elementor() ) {

            while ( have_posts() ) {

                the_post();

                the_content();

            }

        } else {

            $wixi_layout  = wixi_settings( 'single_layout', 'full-width' );

            if ( 'full-width' != $wixi_layout ) {

                wixi_single_layout_sidebar();

            } else {

                wixi_single_layout_fullwidth();

            }
        }

        // you can use this action to add any content before single page
        do_action( 'wixi_after_post_single' );
    }

    get_footer();
?>
