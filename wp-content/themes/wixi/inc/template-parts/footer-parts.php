<?php


/**
* Custom template parts for this theme.
*
* Eventually, some of the functionality here could be replaced by core features.
*
* @package wixi
*/


add_action( 'wixi_footer_action', 'wixi_footer', 10 );

if ( ! function_exists( 'wixi_footer' ) ) {
    function wixi_footer()
    {

        if ( '0' != wixi_settings( 'footer_visibility', '1' ) ) {

            if ( 'elementor' == wixi_settings( 'footer_type', 'default' ) ) {

                if ( class_exists( '\Elementor\Frontend' ) ) {

                    if ( !empty( wixi_settings( 'footer_elementor_templates' ) ) ) {

                        $template_id = wixi_settings( 'footer_elementor_templates' );
                        $frontend = new \Elementor\Frontend;
                        printf( '<footer class="wixi-elementor-footer footer-'.$template_id.'">%1$s</footer>', $frontend->get_builder_content( $template_id, false ) );

                    } else {

                        echo sprintf('<p class="copyright text-center ptb-40">%s <a class="button button-slide" href="%s"><span class="button_text">%s</span></a></p>',
                            esc_html__('No template exist for footer.', 'wixi'),
                            admin_url( 'edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=section' ),
                            esc_html__('Add new section template.', 'wixi')
                        );
                    }
                }

            } else {

                wixi_copyright();

            }
        }
    }
}



/*************************************************
##  FOOTER COPYRIGHT
*************************************************/

if ( ! function_exists( 'wixi_copyright' ) ) {
    function wixi_copyright()
    {
        $left_visibility = wixi_settings( 'footer_copyright_left_visibility', '1' );
        $right_visibility = wixi_settings( 'footer_copyright_right_visibility', '1' );
        $left_align = '0' == $right_visibility ? wixi_settings( 'footer_copyright_left_align', 'left' ) : 'left';
        $right_align = '0' == $left_visibility ? wixi_settings( 'footer_copyright_right_align', 'right' ) : 'right';
        $left_attr = '0' != $right_visibility ? 'col-lg-6 col-md-4' : 'col-sm-12';
        $right_attr = '0' != $left_visibility ? 'col-lg-6 col-md-8' : 'col-sm-12';
        ?>
        <footer id="nt-footer" class="footer-sm">
            <div class="container">
                <div class="row">

                    <?php if ( '0' != $left_visibility ) { ?>
                        <div class="<?php echo esc_attr( $left_attr ); ?>">
                            <div class="<?php echo esc_attr( $left_align ); ?>">
                                <?php if ( '' != wixi_settings( 'footer_copyright_left' ) ) { ?>

                                    <p><?php echo wp_kses( wixi_settings( 'footer_copyright_left' ), wixi_allowed_html() ); ?></p>

                                <?php } else { ?>

                                    <p><?php esc_html_e('All rights reserved', 'wixi'); ?></p>

                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ( '0' != $right_visibility ) { ?>
                        <div class="<?php echo esc_attr( $right_attr ); ?>">
                            <div class="<?php echo esc_attr( $right_align ); ?>">

                                <?php if ( '' != wixi_settings( 'footer_copyright_right' ) ) { ?>

                                    <?php echo wp_kses( wixi_settings( 'footer_copyright_right' ), wixi_allowed_html() ); ?>

                                <?php } else {
                                    echo sprintf( '<p>&copy; %1$s, <a class="theme" href="%2$s">%3$s</a> Template. %4$s <a class="dev" href="https://ninetheme.com/contact/"> %5$s</a></p>',
                                        date_i18n( _x( 'Y', 'copyright date format', 'wixi' ) ),
                                        esc_url( home_url( '/' ) ),
                                        get_bloginfo( 'name' ),
                                        esc_html__( 'Made with passion by', 'wixi' ),
                                        esc_html__( 'Ninetheme.', 'wixi' )
                                    );
                                } ?>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </footer>

        <?php
    }
}
