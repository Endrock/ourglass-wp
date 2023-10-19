<?php

/*
 *Template name: Wixi Elementor
 *Template Post Type: post, page, projects
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

// start page content
if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        the_content();
    endwhile;
endif;

get_footer();
