<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

    <!-- Meta UTF8 charset -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="initial-scale=1.0" />

    <?php wp_head(); ?>

</head>

<!-- BODY START -->
<body <?php body_class(); ?>>

    <?php
        if ( function_exists( 'wp_body_open' ) ) {
            wp_body_open();
        }

        do_action( 'wixi_after_body_open' );

        // theme preloader
        wixi_preloader();

        // Elementor `header` location
        if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {

            // include logo, menu and more contents
            do_action('wixi_header_action');

        }

        // theme back to top button
        wixi_backtop();

    ?>
