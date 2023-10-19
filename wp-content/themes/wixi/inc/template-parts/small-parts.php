<?php


/**
 * Custom template parts for this theme.
 *
 * preloader, backtotop, conten-none
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package wixi
*/


/*************************************************
## START PRELOADER
*************************************************/

if ( ! function_exists( 'wixi_preloader' ) ) {
    function wixi_preloader()
    {
        $loading = wixi_settings( 'preloader_text', 'Loading' );
        $loading = $loading ? $loading : esc_html__( 'Loading', 'wixi' );
        $type = wixi_settings('pre_type', 'default');

        if ( '0' != wixi_settings('preloader_visibility', '1') ) {

            if ( 'default' == $type ) {
            wp_enqueue_script( 'pace' );

            ?>

                <div id="preloader">
                    <div class="loading-text">
                        <?php echo esc_html( $loading ); ?>
                        <div class="loading-text-overlay"><?php echo esc_html( $loading ); ?></div>
                    </div>
                </div>

            <?php } else { ?>

                <div id="nt-preloader" class="preloader">
                    <div class="loader<?php echo esc_attr( $type );?>"></div>
                </div>

                <?php
            }
        }
    }
}
add_action( 'wixi_preloader_action', 'wixi_preloader', 10 );
add_action( 'elementor/page_templates/canvas/before_content', 'wixi_preloader', 10 );

/*************************************************
##  BACKTOP
*************************************************/

if ( ! function_exists( 'wixi_backtop' ) ) {
    function wixi_backtop() {
        if ( '1' == wixi_settings('backtotop_visibility', '1') ) { ?>
            <div class="backtotop-wrap">
                <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                    <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
                </svg>
            </div>
            <?php
        }
    }
}

/*************************************************
##  CURSOR
*************************************************/

if ( ! function_exists( 'wixi_cursor' ) ) {
    function wixi_cursor() {

        if ( '1' == wixi_settings( 'theme_cursor', '1' ) ) {
            echo '<div id="cursor1" class="cursor cursor1 cursor-type-1 wixi-cursor"></div>';
        }

        if ( '2' == wixi_settings( 'theme_cursor', '1' ) ) {
            echo '<div class="cursor2 cursor-type-2 wixi-cursor"></div>';
        }

        if ( '3' == wixi_settings( 'theme_cursor', '1' ) ) {
            echo '<div class="mouse-cursor cursor-outer cursor-type-3 wixi-cursor"></div>';
            echo '<div class="mouse-cursor cursor-inner wixi-cursor"></div>';
        }
        if ( '4' == wixi_settings( 'theme_cursor', '1' ) ) {
            echo '<div class="cursor4 cursor-type-4 wixi-cursor custom-img-cursor"><img src="'.esc_url( wixi_settings( 'theme_custom_cursor' )[ 'url' ] ).'" /></div>';
        }

    }
}
add_action( 'wixi_after_main_footer', 'wixi_cursor' );
add_action( 'elementor/page_templates/canvas/after_content', 'wixi_cursor', 10 );

/*************************************************
##  CONTENT NONE
*************************************************/

if ( ! function_exists( 'wixi_content_none' ) ) {
    function wixi_content_none() {
        $wixi_centered = is_search() && 'full-width' == wixi_settings( 'search_layout') ? ' text-center' : '';
    ?>
        <div class="content-none-container text-center">
            <h3 class="__title mb-20 fw-900"><?php esc_html_e( 'Nothing', 'wixi' ); ?> <span class="stroke-text"><?php esc_html_e( 'Found', 'wixi' ); ?></span></h3>
            <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
                <p><?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wixi' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
            <?php elseif ( is_search() ) : ?>
                <p class="__nothing"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wixi' ); ?></p>
                <?php echo wixi_content_custom_search_form(); ?>
            <?php else : ?>
                <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wixi' ); ?></p>
                <?php wixi_content_custom_search_form(); ?>
            <?php endif; ?>
        </div>
    <?php
    }
}
