<?php

/**
 * Custom template parts for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package wixi
*/


/*************************************************
##  LOGO
*************************************************/

if ( ! function_exists( 'wixi_logo' ) ) {
    function wixi_logo()
    {
        $logo = wixi_settings( 'logo_type', 'sitename' );
        $logo_type = 'img' == $logo ? 'image' : 'text';
        $sticky_logo = wixi_settings( 'img_logo_sticky' );
        $logo_mobile = wixi_settings( 'img_logo_mobile' );
        $logo_attr = $logo_type;
        $logo_attr .= !empty($logo_mobile['url']) ? ' has-mobile-logo' : '';
        $logo_attr .= !empty( $sticky_logo['url'] ) ? ' has-sticky-logo' : '';

        if ( '0' != wixi_settings( 'logo_visibility', '1' ) ) { ?>

            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="nt-logo" class="header-logo logo-type-<?php echo esc_attr( $logo_attr ); ?>">

                <?php if ( 'img' == $logo && '' != wixi_settings( 'img_logo' ) ) { ?>

                    <img class="main-logo" src="<?php echo esc_url( wixi_settings( 'img_logo' )[ 'url' ] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
                    <?php if ( !empty( $sticky_logo['url'] ) ) { ?>
                        <img class="sticky-logo" src="<?php echo esc_url( wixi_settings( 'img_logo_sticky' )[ 'url' ] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
                    <?php } ?>
                    <?php if ( !empty( $logo_mobile['url'] ) ) { ?>
                        <img class="mobile-logo" src="<?php echo esc_url( wixi_settings( 'img_logo_mobile' )[ 'url' ] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
                    <?php } ?>

                <?php } elseif ( 'sitename' == $logo ) {?>

                    <span class="header-text-logo"><?php bloginfo( 'name' ); ?></span>

                <?php } elseif ( 'customtext' == $logo ) { ?>

                    <span class="header-text-logo"><?php echo wixi_settings( 'text_logo' ); ?></span>

                <?php } else { ?>

                    <span class="header-text-logo"> <?php bloginfo( 'name' ); ?> </span>

                <?php } ?>
            </a>
            <?php
        }
    }
}


/*************************************************
##  HEADER NAVIGATION
*************************************************/

if ( ! function_exists( 'wixi_main_header' ) ) {
    add_action( 'wixi_header_action', 'wixi_main_header', 10 );
    function wixi_main_header()
    {

        $nav_template = wixi_settings( 'header_template', 'default' );
        $nav_visibility = wixi_settings( 'nav_visibility', '1' );
        $nav_sticky_visibility = wixi_settings( 'nav_sticky_visibility', '1' );
        $lang_visibility = wixi_settings( 'nav_lang_visibility', '0' );
        $contact_visibility = wixi_settings( 'nav_contact_visibility', '0' );
        $contact_details = wixi_settings( 'nav_contact', '1' );
        $search_visibility = wixi_settings( 'nav_search_visibility', '1' );
        $nav_skin = '';
        $menu_title = wixi_settings( 'nav_menu_title', 'Menu' );
        $close_title = wixi_settings( 'nav_close_title', 'Close' );
        $has_menu_title = $menu_title ? ' has-menu-title' : '';
        $has_close_title = $menu_title ? ' has-close-title' : '';
        $sticky = '0' == $nav_sticky_visibility ? ' sticky-header-off' : '';

        if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {
            $page_settings = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' )->get_model( get_the_ID() );
            $nav_skin = ' '.$page_settings->get_settings( 'wixi_elementor_page_nav_skin' );
        }

        if ( '0' != $nav_visibility ) {

            if ( 'elementor' == $nav_template ) {

                if ( class_exists( '\Elementor\Frontend' ) ) {

                    if ( !empty( wixi_settings( 'header_elementor_templates' ) ) ) {
                        $page_settings = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' )->get_model( get_the_ID() );
                        $pageheader_template = $page_settings->get_settings( 'wixi_elementor_page_header_template' );

                        $template_id = '' != $pageheader_template ? $pageheader_template : wixi_settings( 'header_elementor_templates' );
                        $frontend = new \Elementor\Frontend;
                        printf( '<header class="wixi-elementor-header header-'.$template_id.'">%1$s</header>', $frontend->get_builder_content( $template_id, false ) );

                    } else {

                        echo sprintf('<p class="copyright text-center ptb-40">%s <a class="button button-slide" href="%s"><span class="button_text">%s</span></a></p>',
                            esc_html__('No template exist for header.', 'wixi'),
                            admin_url( 'edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=section' ),
                            esc_html__('Add new section template.', 'wixi')
                        );
                    }
                }

            } elseif ( 'sidebarmenu' == $nav_template ) {
                wp_enqueue_script( 'gsap' );

                wixi_sidebarmenu();

            } else {
                wp_enqueue_script( 'gsap' );
                ?>

                <div class="main-overlaymenu<?php echo esc_attr($sticky.$has_menu_title); ?>" id="main-overlaymenu">

                    <div class="menu-header">
                        <div class="container-fluid">

                            <div class="logo">
                                <?php wixi_logo(); ?>
                            </div>

                            <?php

                            if ( '1' == $lang_visibility ) {
                                if ( has_action( 'wpml_add_language_selector' ) ) {
                                    do_action('wpml_add_language_selector');
                                } else {
                                    wixi_header_lang();
                                }
                            }

                            $burger_type = wixi_settings( 'burger_type', 'default' );

                            if ( 'default' != $burger_type ) { ?>

                                <div class="hamburger <?php echo esc_attr( $burger_type.$has_menu_title.$has_close_title ); ?>">
                                  <div class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                    <?php if ( $menu_title ) { ?>
                                        <span class="text menu-title"><?php echo esc_html( $menu_title ); ?></span>
                                        <span class="close-title"><?php echo esc_html( $close_title ); ?></span>
                                    <?php } ?>
                                  </div>
                                </div>

                            <?php } else { ?>

                                <div class="menu-toggle">
                                    <span class="icon"><i></i><i></i></span>
                                    <?php if ( $menu_title ) { ?>
                                        <span class="text menu-title"><?php echo esc_html( $menu_title ); ?></span>
                                        <span class="text close-title"><?php echo esc_html( $close_title ); ?></span>
                                    <?php } ?>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                    <div class="overlaymenu-content">
                        <div class="container-fluid">
                            <div class="row">
                                <?php if ( '0' != $contact_visibility && $contact_details ) { ?>
                                <div class="col-xl-4 col-lg-7 col-md-7 header-column">
                                <?php } else { ?>
                                <div class="col-12 header-column">
                                <?php } ?>
                                    <div class="menu-wrapper">
                                        <ul class="main-menu">
                                            <?php
                                                wp_nav_menu(
                                                    array(
                                                        'menu' => '',
                                                        'theme_location' => 'header_menu',
                                                        'container' => '',
                                                        'container_class' => '',
                                                        'container_id' => '',
                                                        'menu_class' => '',
                                                        'menu_id' => '',
                                                        'items_wrap' => '%3$s',
                                                        'before' => '',
                                                        'after' => '',
                                                        'link_before' => '',
                                                        'link_after' => '',
                                                        'depth' => 5,
                                                        'echo' => true,
                                                        'fallback_cb' => 'wixi_Menu_Navwalker::fallback',
                                                        'walker' => new wixi_Menu_Navwalker()
                                                    )
                                                );
                                            ?>
                                        </ul>
                                    </div>
                                </div>

                                <?php if ( '0' != $contact_visibility || '0' !=  $search_visibility ) { ?>
                                    <div class="col-xl-8 col-lg-5 col-md-5 header-column">
                                        <div class="menu-info">
                                            <?php echo do_shortcode( $contact_details ); ?>
                                            <?php if ( '0' != $search_visibility ) { ?>
                                                <div class="item">
                                                   <?php echo wixi_content_custom_search_form(); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php
                                    if ( '' != wixi_settings( 'header_copyright' ) ) {

                                        printf( '<div class="col-lg-8 col-md-12"><div class="item header-footer">%1$s</div></div>',
                                            wp_kses( wixi_settings( 'header_copyright' ), wixi_allowed_html() )
                                        );
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
}

if ( ! function_exists( 'wixi_sidebarmenu' ) ) {
    function wixi_sidebarmenu()
    {
        $search_visibility = wixi_settings( 'nav_search_visibility', '1' );
        ?>
        <div class="sidebarmenu--header-wrapper">
            <div class="sidebarmenu--headertop mobile--header">
                <?php wixi_logo(); ?>
                <div class="sidebarmenu--hamburger-menu mobile--hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <aside id="nt--header" class="sidebarmenu--navigation">
                <div class="main-overlaymenu">
                    <div class="menu-wrapper">
                        <ul class="main-menu">
                            <?php wp_nav_menu(
                                array(
                                    'menu' => '',
                                    'theme_location' => 'header_menu',
                                    'container' => '',
                                    'container_class' => '',
                                    'container_id' => '',
                                    'menu_class' => '',
                                    'menu_id' => '',
                                    'items_wrap' => '%3$s',
                                    'before' => '',
                                    'after' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'depth' => 4,
                                    'echo' => true,
                                    'fallback_cb' => 'Wixi_Menu_Navwalker::fallback',
                                    'walker' => new Wixi_Menu_Navwalker()
                                )
                            );
                            ?>
                        </ul>
                    </div>
                </div>

            </aside>

            <?php if ( '0' != $search_visibility ) { ?>
                <div class="sidebarmenu--search-box">
                    <h2><?php esc_html_e('SEARCH', 'wixi'); ?></h2>
                    <?php echo wixi_content_custom_search_form(); ?>
                </div>
            <?php } ?>

            <aside class="sidebarmenu--main-side">
                <div class="sidebarmenu--hamburger-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <ul class="sidebarmenu--social-media">
                <?php echo wixi_settings( 'sidebarmenu_social', '' ); ?>
                </ul>

                <?php if ( '0' != $search_visibility ) { ?>
                    <div class="sidebarmenu--search">
                        <i class="sidebarmenu--search-open">
                            <svg version="1.1"
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 512.005 512.005"
                            style="enable-background:new 0 0 512.005 512.005;"
                            xml:space="preserve">
                            <path d="M508.885,493.784L353.109,338.008c32.341-35.925,52.224-83.285,52.224-135.339c0-111.744-90.923-202.667-202.667-202.667
                            S0,90.925,0,202.669s90.923,202.667,202.667,202.667c52.053,0,99.413-19.883,135.339-52.245l155.776,155.776
                            c2.091,2.091,4.821,3.136,7.552,3.136c2.731,0,5.461-1.045,7.552-3.115C513.045,504.707,513.045,497.965,508.885,493.784z
                            M202.667,384.003c-99.989,0-181.333-81.344-181.333-181.333S102.677,21.336,202.667,21.336S384,102.68,384,202.669
                            S302.656,384.003,202.667,384.003z"/>
                            </svg>
                        </i>
                        <i class="sidebarmenu--search-close">
                            <svg xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            version="1.1" x="0px" y="0px"
                            viewBox="0 0 496.096 496.096"
                            style="enable-background:new 0 0 496.096 496.096;"
                            xml:space="preserve">
                            <path d="M259.41,247.998L493.754,13.654c3.123-3.124,3.123-8.188,0-11.312c-3.124-3.123-8.188-3.123-11.312,0L248.098,236.686
                            L13.754,2.342C10.576-0.727,5.512-0.639,2.442,2.539c-2.994,3.1-2.994,8.015,0,11.115l234.344,234.344L2.442,482.342
                            c-3.178,3.07-3.266,8.134-0.196,11.312s8.134,3.266,11.312,0.196c0.067-0.064,0.132-0.13,0.196-0.196L248.098,259.31
                            l234.344,234.344c3.178,3.07,8.242,2.982,11.312-0.196c2.995-3.1,2.995-8.016,0-11.116L259.41,247.998z"/>
                            </svg>
                        </i>
                    </div>
                <?php } ?>
            </aside>
        </div>
        <?php
    }
}

if ( !function_exists( 'wixi_header_lang' ) ) {
    function wixi_header_lang(){

        if (function_exists('pll_the_languages')) { ?>
            <ul class="lang-select">

                <li class="lang-item active">
                    <i class="fa fa-globe lang-icon"></i>
                    <?php echo pll_current_language('flag') ?>
                    <span class="uppercase"><?php echo pll_current_language('name') ?></span>
                    <i class="fa fa-angle-down lang-arrow"></i>
                </li>
                <li>
                    <ul class="sub-list">
                        <?php
                        pll_the_languages(
                            array(
                                'show_flags'=>1,
                                'show_names'=>1,
                                'dropdown'=>0,
                                'raw'=>0,
                                'hide_current'=>1,
                                'display_names_as'=>'name'
                            )
                        );
                        ?>
                    </ul>
                </li>
            </ul>
        <?php

        } else { ?>

            <ul class="lang-select">
                <li class="lang-item active">
                    <i class="fa fa-globe lang-icon"></i>
                    <span class="uppercase">EN</span>
                    <i class="fa fa-angle-down lang-arrow"></i>
                </li>
                <li>
                    <ul class="sub-list">
                        <li class="sub-lang-item"><a href="#0">TR</a></li>
                        <li class="sub-lang-item"><a href="#0">KD</a></li>
                        <li class="sub-lang-item"><a href="#0">AR</a></li>
                    </ul>
                </li>
            </ul>

        <?php
        }
    }
}
