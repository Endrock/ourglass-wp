<?php

function ninetheme_admin_menu() {

    /**
    * Filters the required capability to manage CPTUI settings.
    *
    * @param string $value Capability required.
    */
    $theme_name   = wp_get_theme(get_template())->get( 'Name' );
    $capability   = 'manage_options';
    $parent_slug  = 'ninetheme_theme_manage';
    $parent_title = esc_html__( 'NineTheme', 'wixi' );
    $icon         = 'dashicons-chart-pie';
    $main_panel   = 'ninetheme_panel';
    // Submenu page
    $sub_title1   = sprintf( '%s %s',esc_html__( 'About ', 'wixi' ), $theme_name );
    $sub_slug     = 'ninetheme_about_page';

    // Add parent menu
    add_menu_page( $parent_title, $parent_title, $capability, $parent_slug, $main_panel, $icon, 61 );
    add_submenu_page( $parent_slug, $parent_title, $parent_title, $capability, $parent_slug, $main_panel );

    // Remove the default one so we can add our customized version.
    remove_submenu_page( $parent_slug, $parent_slug );
    // Add new submenu with new parameter
    add_submenu_page( $parent_slug, $sub_title1, $sub_title1, $capability, $sub_slug, $main_panel );
}
add_action( 'admin_menu', 'ninetheme_admin_menu' );

// Move Option Tree admin menu from Appearance to the
function ninetheme_admin_menu_slug() {
    global $pagenow;
    if ( 'themes.php' != $pagenow ) {
        return 'ninetheme_theme_manage';
    }
}
add_filter( 'ninetheme_parent_slug', 'ninetheme_admin_menu_slug' );
add_filter( 'ot_theme_options_parent_slug', 'ninetheme_admin_menu_slug' );

/**
* Display our primary menu page.
*
* @internal
*/
function ninetheme_panel() {
    $theme_name = wp_get_theme(get_template())->get( 'Name' );
    $theme_version = wp_get_theme(get_template())->get( 'Version' );
    $admin_email = get_option( 'admin_email' );
    $my_current_screen = get_current_screen();

    ?>
    <div class="nt-theme">
        <div class="c-container">

            <div class="c-heading">
                <h1><?php echo esc_html( $theme_name ); ?> <?php echo esc_html( $theme_version ); ?></h1>
            </div>

            <div class="c-row">

                <?php if ( $my_current_screen->base == 'ninetheme_page_ninetheme_about_page' ) : ?>

                <div class="c-md-5 c-content">
                    <div class="c-inner">

                        <h2 class="c-title"><?php esc_html_e( 'Support', 'wixi' ); ?></h2>
                        <br>
                        <h4 class="c-title"><?php esc_html_e( 'Help Center', 'wixi' ); ?></h4>
                        <a class="c-link" target="_blank" href="https://ninetheme.com/support/"><?php esc_html_e( 'Help Center', 'wixi' ); ?></a>

                        <p class="c-text"><?php esc_html_e( 'If you need support with using the theme,
                        please visit the links below. If you are having trouble with the installation, please read the documentation.', 'wixi' ); ?></p>

                        <br>
                        <br>
                        <h4 class="c-title"><?php esc_html_e( 'Theme Documentations', 'wixi' ); ?></h4>
                        <a class="c-link" target="_blank" href="https://ninetheme.com/docs/elementor-themes-documentation/"><?php esc_html_e( 'Theme Elementor Documentation', 'wixi' ); ?></a>
                        <a class="c-link" target="_blank" href="https://ninetheme.com/docs/elementor-themes-documentation/"><?php esc_html_e( 'Theme WPBakery Documentation', 'wixi' ); ?></a>

                        <br>
                        <br>
                        <h4 class="c-title"><?php esc_html_e( 'Plugin Documentations', 'wixi' ); ?></h4>
                        <a class="c-link" target="_blank" href="https://elementor.com/help/how-to-use-elementor/"><?php esc_html_e( 'Elementor General Documentation', 'wixi' ); ?></a>
                        <a class="c-link" target="_blank" href="https://kb.wpbakery.com/"><?php esc_html_e( 'WPBakery General Documentation', 'wixi' ); ?></a>
                        <a class="c-link" target="_blank" href="https://docs.pluginize.com/category/126-custom-post-type-ui/"><?php esc_html_e( 'CPTUI General Documentation', 'wixi' ); ?></a>
                        <a class="c-link" target="_blank" href="https://contactform7.com/docs/"><?php esc_html_e( 'Contact Form 7 General Documentation', 'wixi' ); ?></a>

                        <br>
                        <br>
                        <h4 class="c-title"><?php esc_html_e( 'Follow Us', 'wixi' ); ?></h4>
                        <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2F9theme&width=120&layout=button&action=like&size=small&share=true&height=65&appId=433796757824092" width="160" height="65" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                        <a href="https://twitter.com/nine_theme" class="twitter-follow-button" data-show-count="false">Follow @TwitterDev</a>
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

                        <br>
                        <br>
                        <h4 class="c-title">
                            <a class="s-link"  target="_blank" href="https://twitter.com/nine_theme"><span class="dashicons dashicons-twitter"></span></a>
                            <a class="s-link"  target="_blank" href="https://facebook.com/9theme"><span class="dashicons dashicons-facebook"></span></a>
                            <a class="s-link"  target="_blank" href="https://www.instagram.com/9_theme/"><span class="dashicons dashicons-instagram"></span></a>
                            <a class="s-link"  target="_blank" href="https://www.behance.net/ninetheme"><span class="dashicons dashicons-screenoptions"></span></a>
                        </h4>

                    </div>
                </div>

                <div class="c-md-6 c-content">

                    <div class="newsletter">
                        <iframe width="540" height="600" src="https://1c4c229b.sibforms.com/serve/MUIEAAyzZRYnVfBkDisexgjR3cMyO0vPW59zKkgShuGbGDt1dnDiFuUCgfqskRLONTY--CaRrwkOfChWnaxRqCTcLIWW36gNk6I91p1-cjgHgvZA3e62jVLejwIRdR64kHoQ4YK1NKSrOSSsN3_fmz236LTdqoYrbXV9o-Oe1DYxFuDHJAGrBVmfxYXTHhtyyiUCJx_dtR9riZUu" frameborder="0" scrolling="auto" allowfullscreen style="display: block;margin-left: auto;margin-right: auto;max-width: 100%;"></iframe>
                    </div>

                </div>

            <?php endif; ?>

            </div>
        </div>
    </div>
    <style>
        .nt-theme * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }
        .nt-theme {
            padding: 30px 0;
        }
        .nt-theme .c-container {
            width: 100%;
            max-width: calc( 100% - 40px );
            margin-right: auto;
            margin-left: auto;
            position: relative;
            overflow-x: hidden;
        }
        .nt-theme .c-row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .nt-theme .c-content {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }
        .nt-theme .c-content,
        .nt-theme .c-heading {
            margin-bottom: 30px;
        }
        .nt-theme .c-md-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }
        @media (min-width: 992px) {
            .nt-theme .c-md-3 {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%;
            }
            .nt-theme .c-md-4 {
                -ms-flex: 0 0 33%;
                flex: 0 0 33%;
                max-width: 33%;
            }
            .nt-theme .c-md-5 {
                -ms-flex: 0 0 40%;
                flex: 0 0 40%;
                max-width: 40%;
            }
            .nt-theme .c-md-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%;
            }
        }
        .nt-theme .c-inner {
            background-color: #fff;
            border-radius: 3px;
            border: 1px solid #C0CCD9;
            padding: 20px;
        }
        .nt-theme .c-title {
            font-weight: bold;
            margin-top: 0;
        }
        .nt-theme .c-text {
            margin: 15px 0;
        }
        .nt-theme .c-link {
            margin-top: 15px;
            display: block;
        }
        .nt-theme .s-link {
            margin-top: 15px;
            text-decoration: none;
            border: 0;
            padding: 7px;
            border-radius: 100%;
            min-width: 40px;
            height: 76px;
            font-size: 17px;
            vertical-align: revert;
            background: #3e434c;
            color: #fff;
        }
        .nt-theme iframe {
            width: 100%;
        }
        .nt-theme .newsletter iframe {
            margin-left: -20px !important;
            margin-top: -40px !important;
        }
        .custom-control.custom-switch {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin: 20px 0;
            padding: 20px;
            background: #f1f1f1;
            border-radius: 3px;
        }
        input#r_energy_disconnection1 {
            margin: 0;
            margin-right: 10px;
        }
        button.ninetheme-deactivate-licence {
            margin-top: 15px;
        }
        .deactivate-form {
            margin: 15px 0;
        }
        #redux-connect-message{
            display:none;
        }
    </style>
    <?php
}
