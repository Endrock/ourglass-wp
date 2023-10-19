<?php

/**
* default page template
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

    if ( wixi_check_is_elementor() ) {

        while ( have_posts() ) {

            the_post();

            the_content();

        }

    } else {

        $page_layout = wixi_settings( 'page_layout', 'full-width' );
        $page_sidebar = natrurally_sidebar( 'wixi-page-sidebar' );
        $page_column = $page_sidebar ? 'col-lg-8' : 'col-lg-10';

        do_action( 'wixi_before_page' );
    ?>

        <div id="nt-page-container" class="nt-page-layout">

            <!-- Hero section - this function using on all inner pages -->
            <?php wixi_hero_section(); ?>

            <div id="nt-page" class="nt-theme-inner-container section-padding">
                <div class="container">
                    <div class="row justify-content-center">

                        <!-- Left sidebar -->
                        <?php if ( $page_sidebar && 'left-sidebar' == $page_layout ) { ?>
                            <div id="nt-sidebar" class="nt-sidebar col-12 col-lg-4">
                                <div class="blog-sidebar nt-sidebar-inner">
                                    <?php dynamic_sidebar( $page_sidebar ); ?>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Sidebar control column -->
                        <div class="<?php echo esc_attr( $page_column ); ?>">

                            <?php while ( have_posts() ) : the_post(); ?>

                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="nt-theme-content nt-clearfix content-container">
                                        <?php

                                        /* translators: %s: Name of current post */
                                        the_content( sprintf(
                                            esc_html__( 'Continue reading %s', 'wixi' ),
                                            the_title( '<span class="screen-reader-text">', '</span>', false )
                                        ) );

                                        /* theme page link pagination */
                                        wixi_wp_link_pages();

                                        ?>
                                    </div><!-- End .nt-theme-content -->
                                </div><!--End article -->
                                <?php

                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) {
                                    comments_template();
                                }

                            // End the loop.
                            endwhile;
                            ?>

                        </div>

                        <!-- Right sidebar -->
                        <?php if ( $page_sidebar && 'right-sidebar' == $page_layout ) { ?>
                            <div id="nt-sidebar" class="nt-sidebar col-12 col-lg-4">
                                <div class="blog-sidebar nt-sidebar-inner">
                                    <?php dynamic_sidebar( $page_sidebar ); ?>
                                </div>
                            </div>
                        <?php } ?>

                    </div><!--End row -->
                </div><!--End container -->
            </div><!--End #nt-page -->
        </div><!--End page general div -->
        <?php
        // you can use this action for add any content after container element
        do_action( 'wixi_after_page' );
    }
}
get_footer();

?>
