<?php

/**
* The template for displaying 404 pages (not found)
*
* @link https://codex.wordpress.org/Creating_an_Error_404_Page
*
* @package WordPress
* @subpackage Wixi
* @since 1.0.0
*/

    get_header();

    // you can use this action for add any content before container element
    do_action( 'wixi_before_404' );

    $wixi_error_page_type = wixi_settings( 'error_page_type', 'default' );

    if ( 'elementor' == $wixi_error_page_type ) {

        if ( class_exists( '\Elementor\Frontend' ) ) {

            if ( !empty( wixi_settings( 'error_page_elementor_templates' ) ) ) {

                $template_id = wixi_settings( 'error_page_elementor_templates' );
                $frontend = new \Elementor\Frontend;
                printf( '%1$s', $frontend->get_builder_content( $template_id, false ) );

            } else {

                echo sprintf('<div class="text-center no-template"><p class="ptb-40">%s</p><a class="button button-slide" href="%s"><span class="button_text">%s</span></a></div>',
                    esc_html__('No template exist for Error Page.', 'wixi'),
                    admin_url( 'edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=page' ),
                    esc_html__('Add new page template.', 'wixi')
                );
            }
        }

    } else {
?>
        <div id="nt-404" class="nt-404 error">
            <div class="call-action" data-overlay-dark="0">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="content text-center">
                                <?php

                                    if ( '0' != wixi_settings( 'error_content_subtitle_visibility', '1' ) ) {
                                        if ( '' != wixi_settings( 'error_content_subtitle' ) ) {
                                            echo wp_kses( wixi_settings( 'error_content_subtitle' ), wixi_allowed_html() );
                                        } else {
                                            echo sprintf( '<h6>%1$s</h6>', esc_html__( 'page not found', 'wixi' ) );
                                        }
                                    }

                                    if ( '0' != wixi_settings( 'error_content_title_visibility', '1' ) ) {
                                        if ( '' != wixi_settings( 'error_content_title' ) ) {
                                            echo wp_kses( wixi_settings( 'error_content_title' ), wixi_allowed_html() );
                                        } else {
                                            echo sprintf( '<h2>%1$s <b>%2$s</b></h2>', esc_html__( '404','wixi' ), esc_html__( 'Page','wixi' ) );
                                        }
                                    }

                                    if ( '0' != wixi_settings('error_content_desc_visibility', '1' ) ) {
                                        if ( '' != wixi_settings( 'error_content_desc' ) ) {
                                            printf( '<p>%1$s</p>',
                                                wp_kses( wixi_settings( 'error_content_desc' ), wixi_allowed_html() )
                                            );
                                        } else {
                                            printf( '<p>%1$s</p>',
                                                esc_html__( 'Sorry, but the page you are looking for does not exist or has been removed', 'wixi' )
                                            );
                                        }
                                    }

                                    if ( '0' != wixi_settings('error_content_btn_visibility', '1' ) ) {
                                        if ( '' != wixi_settings( 'error_content_btn_title' ) ) {
                                            printf( '<a href="%1$s" class="button-slide btn-radius c-light mt-30"><span>%2$s</span></a>',
                                                esc_url( home_url('/') ),
                                                esc_html( wixi_settings( 'error_content_btn_title' ) )
                                            );
                                        } else {
                                            printf( '<a href="%1$s" class="button-slide c-light mt-30"><span>%2$s</span></a>',
                                                esc_url( home_url('/') ),
                                                esc_html__( 'Go to home page', 'wixi' )
                                            );
                                        }
                                    }
                                ?>

                            </div>
                        </div>

                        <?php if ( '0' != wixi_settings( 'error_content_form_visibility', '1' ) ) { ?>
                            <div class="col-md-7">
                                <?php echo wixi_content_custom_search_form(); ?>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    // use this action to add any content after 404 page container element
    do_action( 'wixi_after_404' );

    get_footer();

?>
