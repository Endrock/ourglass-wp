<?php
        /**
        * The template for displaying the footer.
        *
        * Contains the closing of the #content div and all content after
        *
        * @package wixi
        */

        do_action( 'wixi_before_main_footer' );


        // Elementor `footer` location
        if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
            /**
            * Hook: wixi_footer_action.
            *
            * @hooked wixi_footer_widgetize - 10
            * @hooked wixi_copyright - 20
            */
            do_action( 'wixi_footer_action' );
        }

        do_action( 'wixi_after_main_footer' );

        do_action( 'wixi_before_wp_footer' );

        wp_footer();

    ?>

    </body>
</html>
