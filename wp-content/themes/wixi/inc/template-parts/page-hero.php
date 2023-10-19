<?php

/*************************************************
## HERO FUNCTION
*************************************************/

if ( ! function_exists( 'wixi_hero_section' ) ) {
    function wixi_hero_section()
    {
        $h_s = get_bloginfo( 'description' );
        $h_t = get_bloginfo( 'name' ) . ' ' .esc_html__( 'Blog', 'wixi' );
        $page_id = '';

        if ( is_404() ) { // error page

            $name = 'error';
            $h_t = esc_html__( '404 - Not Found', 'wixi' );

        } elseif ( is_archive() ) { // blog and cpt archive page

            $name = 'archive';
            $h_t = get_the_archive_title();

        } elseif ( is_search() ) { // search page

            $name = 'search';
            $h_t = esc_html__( 'Search results for :', 'wixi' );

        } elseif ( is_home() || is_front_page() ) { // blog post loop page index.php or your choise on settings

            $name = 'blog';
            $h_t = esc_html( wixi_settings( 'blog_title', $h_t ) );

        } elseif ( is_single() && ! is_singular( 'portfolio' ) ) { // blog post single/singular page

            $name = 'single';
            $h_t = esc_html( wixi_settings( 'blog_title', $h_t ) );

        } elseif ( is_singular( 'portfolio' ) ) { // it is cpt and if you want use another clone this condition and add your cpt name as portfolio

            $name = 'single_portfolio';
            $h_t = get_the_title();

        } elseif ( is_page() ) {	// default or custom page

            $name = 'page';
            $h_t = get_the_title();
            $h_s = '';
            $page_id = ' page-'.get_the_ID();

        }

        $h_v = wixi_settings( $name.'_hero_visibility', '1' );
        // site title
        $h_s = wixi_settings( $name.'_site_title', $h_s );
        // page title
        $h_t = wixi_settings( $name.'_title', $h_t ) ? wixi_settings( $name.'_title', $h_t ) : $h_t;
        // page breadcrumbs
        $h_b = wixi_settings( 'breadcrumbs_visibility', '1' );

        do_action( 'wixi_before_hero_action' );

        if ( '0' != $h_v ) { ?>

            <div class="page-header text-center<?php echo esc_attr( $page_id ); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="cont-inner">

                                <?php

                                    do_action( 'wixi_before_page_title' );

                                    if ( $h_t ) {

                                        printf( '<h1 class="nt-hero-title page-title mb-10">%s %s</h1>',
                                            wp_kses( $h_t, wixi_allowed_html()),
                                            strlen( get_search_query() ) > 16 ? substr( get_search_query(), 0, 16 ).'...' : get_search_query()
                                        );

                                    } else {

                                        if ( !is_search() || !is_archive() ) {
                                            the_title('<div class="text-bg">', '</div>');
                                        }

                                        the_title('<h1 class="nt-hero-title page-title mb-10">', '</h1>');
                                    }

                                    do_action( 'wixi_after_page_title' );

                                    if ( $h_s ) {

                                        printf( '<div class="nt-hero-desc">%s</div>', wp_kses( $h_s, wixi_allowed_html() ) );
                                    }

                                    if ( '1' == $h_b ) {
                                        wixi_breadcrumbs();
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } // hide hero area
        do_action( 'wixi_after_hero_action' );
    }
}
