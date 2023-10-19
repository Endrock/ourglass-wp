<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( class_exists( 'Redux' ) && class_exists( 'WooCommerce' ) ) {

    if ( ! function_exists( 'wixi_dynamic_section' ) ) {
        function wixi_dynamic_section($sections)
        {

            global $wixi_pre;

            /*************************************************
            ## SINGLE PAGE SECTION
            *************************************************/
            // create sections in the theme options
            $sections[] = array(
                'title' => esc_html__('Shop Page', 'wixi'),
                'id' => 'shopsection',
                'icon' => 'el el-shopping-cart-sign',
            );
            // SHOP PAGE SECTION
            $sections[] = array(
                'title' => esc_html__( 'Shop Page Layout', 'wixi' ),
                'id' => 'shoplayoutsection',
                'subsection'=> true,
                'icon' => 'el el-website',
                'fields'	=> array(
                    array(
                        'title' => esc_html__( 'Page Layout', 'wixi' ),
                        'subtitle' => esc_html__( 'Choose the shop page layout.', 'wixi' ),
                        'id' => 'shop_layout',
                        'type' => 'image_select',
                        'options' => array(
                            'left-sidebar' => array(
                                'alt' => 'Left Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                            ),
                            'full-width' => array(
                                'alt' => 'Full Width',
                                'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                            ),
                            'right-sidebar' => array(
                                'alt' => 'Right Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                            ),
                        ),
                        'default' => 'right-sidebar'
                    )
                )
            );
            // SINGLE HERO SUBSECTION
            $sections[] = array(
                'title' => esc_html__('Shop Page Hero', 'wixi'),
                'desc' => esc_html__('These are shop page hero section settings', 'wixi'),
                'id' => 'shopherosubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__('Hero display', 'wixi'),
                        'subtitle' => esc_html__('You can enable or disable the site shop page hero section with switch option.', 'wixi'),
                        'id' => 'shop_hero_visibility',
                        'type' => 'switch',
                        'default' => 1,
                        'on' => 'On',
                        'off' => 'Off',
                    ),
                    array(
                        'title' => esc_html__( 'Hero Template', 'wixi' ),
                        'subtitle' => esc_html__( 'Select your header template.', 'wixi' ),
                        'id' => 'shop_hero_template',
                        'type' => 'select',
                        'customizer' => true,
                        'options' => array(
                            'default' => esc_html__( 'Deafult Site Hero', 'wixi' ),
                            'elementor' => esc_html__( 'Elementor Templates', 'wixi' ),
                        ),
                        'default' => 'default',
                        'required' => array( 'shop_hero_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Elementor Templates', 'wixi' ),
                        'subtitle' => esc_html__( 'Select a template from elementor templates.', 'wixi' ),
                        'id' => 'shop_hero_elementor_templates',
                        'type' => 'select',
                        'customizer' => true,
                        'options' => wixi_get_elementorTemplates(),
                        'required' => array(
                            array( 'shop_hero_visibility', '=', '1' ),
                            array( 'shop_hero_template', '=', 'elementor' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Hero Background', 'wixi'),
                        'id' => 'shop_hero_bg',
                        'type' => 'background',
                        'output' => array( '#nt-shop-page .page-header__bg' ),
                        'required' => array(
                            array( 'shop_hero_visibility', '=', '1' ),
                            array( 'shop_hero_template', '=', 'default' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Page Hero Padding', 'wixi'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page Hero Section', 'wixi'),
                        'id' =>'shop_hero_pad',
                        'type' => 'spacing',
                        'output' => array('#nt-shop-page .page-header .container'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'padding-top' => '',
                            'padding-right' => '',
                            'padding-bottom' => '',
                            'padding-left' => '',
                            'units' => 'px',
                        ),
                        'required' => array(
                            array( 'shop_hero_visibility', '=', '1' ),
                            array( 'shop_hero_template', '=', 'default' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Custom Page Title', 'wixi'),
                        'subtitle' => esc_html__('Add your shop page custom title here.', 'wixi'),
                        'id' => 'shop_title',
                        'type' => 'text',
                        'default' => 'Shop',
                        'required' => array(
                            array( 'shop_hero_visibility', '=', '1' ),
                            array( 'shop_hero_template', '=', 'default' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Page Title Typography', 'wixi'),
                        'id' => 'shop_title_typo',
                        'type' => 'typography',
                        'font-backup' => false,
                        'letter-spacing' => true,
                        'text-transform' => true,
                        'all_styles' => true,
                        'output' => array( '#nt-shop-page .nt-hero-title' ),
                        'units' => 'px',
                        'default' => array(
                            'color' => '',
                            'font-style' => '',
                            'font-family' => '',
                            'google' => true,
                            'font-size' => '',
                            'line-height' => ''
                        ),
                        'required' => array(
                            array( 'shop_hero_visibility', '=', '1' ),
                            array( 'shop_hero_template', '=', 'default' )
                        )
                    ),
                )
            );
            // SINGLE CONTENT SUBSECTION
            $sections[] = array(
                'title' => esc_html__('Shop Page Content', 'wixi'),
                'id' => 'shopcontentsubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__( 'Page Container Width', 'wixi' ),
                        'subtitle' => esc_html__( 'Choose the shop page container width.', 'wixi' ),
                        'id' => 'shop_container_width',
                        'type' => 'select',
                        'customizer' => true,
                        'options' => array(
                            '' => esc_html__('Default ( Container )', 'wixi'),
                            '-fluid' => esc_html__('Container Fluid', 'wixi'),
                            '-off' => esc_html__('Full Width', 'wixi'),
                        ),
                        'default' => '',
                    ),
                    array(
                        'title' => esc_html__('Page Content Padding', 'wixi'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page content.', 'wixi'),
                        'id' =>'shop_content_pad',
                        'type' => 'spacing',
                        'output' => array('#nt-shop-page .nt-theme-inner-container'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'padding-top' => '',
                            'padding-right' => '',
                            'padding-bottom' => '',
                            'padding-left' => '',
                            'units' => 'px'
                        )
                    ),
                    array(
                        'title' => esc_html__('Post Column', 'wixi'),
                        'subtitle' => esc_html__('You can control post column with this option.', 'wixi'),
                        'id' => 'shop_colxl',
                        'type' => 'slider',
                        'default' => 3,
                        'min' => 1,
                        'step' => 1,
                        'max' => 4,
                        'display_value' => 'text',
                    ),
                    array(
                        'title' => esc_html__('Post 992px Column ( Responsive: Desktop, Tablet )', 'wixi'),
                        'subtitle' => esc_html__('You can control post column on max-device width 992px with this option.', 'wixi'),
                        'id' => 'shop_collg',
                        'type' => 'slider',
                        'default' =>2,
                        'min' => 1,
                        'step' => 1,
                        'max' => 3,
                        'display_value' => 'text',
                    ),
                    array(
                        'title' => esc_html__('Post 768px Column ( Responsive: Tablet, Phone )', 'wixi'),
                        'subtitle' => esc_html__('You can control post column on max-device-width 768px with this option.', 'wixi'),
                        'id' => 'shop_colsm',
                        'type' => 'slider',
                        'default' =>2,
                        'min' => 1,
                        'step' => 1,
                        'max' => 2,
                        'display_value' => 'text',
                    ),
                    array(
                        'title' => esc_html__('Post Count', 'wixi'),
                        'subtitle' => esc_html__('You can control show post count with this option.', 'wixi'),
                        'id' => 'shop_perpage',
                        'type' => 'slider',
                        'default' => 6,
                        'min' => 1,
                        'step' => 1,
                        'max' => 100,
                        'display_value' => 'text'
                    )
                )
            );
            // SINGLE CONTENT SUBSECTION
            $sections[] = array(
                'title' => esc_html__('Shop Page After Content', 'wixi'),
                'id' => 'shopaftercontentsubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__( 'Elementor Templates', 'wixi' ),
                        'subtitle' => esc_html__( 'Select a template from elementor templates, If you want to show any content after products.', 'wixi' ),
                        'id' => 'shop_after_page_elementor_templates',
                        'type' => 'select',
                        'customizer' => true,
                        'options' => wixi_get_elementorTemplates()
                    )
                )
            );
            $sections[] = array(
                'title' => esc_html__('Shop Page Post Style', 'wixi'),
                'id' => 'shoppoststylesubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__('Custom Color', 'wixi'),
                        'subtitle' => esc_html__('Change post color.', 'wixi'),
                        'id' => 'shop_custom_color',
                        'type' => 'color',
                        'default' => '#30aafc',
                        'required' => array( 'shop_theme_color', '=', 'custom' )
                    ),
                    // post button ( view cart )
                    array(
                        'title' => esc_html__('Background Color', 'wixi'),
                        'subtitle' => esc_html__('Change post background color.', 'wixi'),
                        'id' => 'shop_post_bgcolor',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'default' => '',
                        'output' => array('.woocommerce ul.products li.product .product-content-wrap, .woocommerce-page ul.products li.product .product-content-wrap')
                    ),
                    array(
                        'title' => esc_html__('Border', 'wixi'),
                        'subtitle' => esc_html__('Set your custom border styles for the posts.', 'wixi'),
                        'id' => 'shop_post_brd',
                        'type' => 'border',
                        'all' => false,
                        'output' => array('.woocommerce ul.products li.product .product-content-wrap, .woocommerce-page ul.products li.product .product-content-wrap')
                    ),
                    array(
                        'title' => esc_html__('Padding', 'wixi'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page post.', 'wixi'),
                        'id' =>'shop_post_pad',
                        'type' => 'spacing',
                        'output' => array('.woocommerce ul.products li.product .product-content-wrap, .woocommerce-page ul.products li.product .product-content-wrap'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'units' => 'px'
                        )
                    ),
                    array(
                        'title' => esc_html__('Margin', 'wixi'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page post.', 'wixi'),
                        'id' =>'shop_post_margin',
                        'type' => 'spacing',
                        'output' => array('.woocommerce ul.products li.product .product-content-wrap, .woocommerce-page ul.products li.product .product-content-wrap'),
                        'mode' => 'margin',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'units' => 'px'
                        )
                    ),
                    // post itle
                    array(
                        'title' => esc_html__('Title Typography', 'wixi'),
                        'id' => 'shop_post_title_typo',
                        'type' => 'typography',
                        'font-backup' => false,
                        'letter-spacing' => true,
                        'text-transform' => true,
                        'all_styles' => true,
                        'output' => array( '.woocommerce ul.products li.product .woocommerce-loop-product__title' ),
                        'units' => 'px',
                        'default' => array(
                            'color' => '',
                            'font-style' => '',
                            'font-family' => '',
                            'google' => true,
                            'font-size' => '',
                            'line-height' => ''
                        )
                    ),
                    array(
                        'title' => esc_html__('Title Padding', 'wixi'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page post title.', 'wixi'),
                        'id' =>'shop_post_title_pad',
                        'type' => 'spacing',
                        'output' => array('.woocommerce ul.products li.product .woocommerce-loop-product__title'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'padding-top' => '',
                            'padding-right' => '',
                            'padding-bottom' => '',
                            'padding-left' => '',
                            'units' => 'px'
                        )
                    ),
                    array(
                        'title' => esc_html__('Title Margin', 'wixi'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page post title.', 'wixi'),
                        'id' =>'shop_post_title_margin',
                        'type' => 'spacing',
                        'output' => array('.woocommerce ul.products li.product .woocommerce-loop-product__title'),
                        'mode' => 'margin',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'padding-top' => '',
                            'padding-right' => '',
                            'padding-bottom' => '',
                            'padding-left' => '',
                            'units' => 'px'
                        )
                    ),
                    array(
                        'title' => esc_html__('Price Typography', 'wixi'),
                        'id' => 'shop_post_price_typo',
                        'type' => 'typography',
                        'font-backup' => false,
                        'letter-spacing' => true,
                        'text-transform' => true,
                        'all_styles' => true,
                        'output' => array( '.woocommerce ul.products li.product .price' ),
                        'units' => 'px',
                        'default' => array(
                            'color' => '',
                            'font-style' => '',
                            'font-family' => '',
                            'google' => true,
                            'font-size' => '',
                            'line-height' => ''
                        )
                    ),
                    array(
                        'title' => esc_html__('Price Padding', 'wixi'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page post title.', 'wixi'),
                        'id' =>'shop_post_price_pad',
                        'type' => 'spacing',
                        'output' => array('.woocommerce ul.products li.product .price'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'units' => 'px'
                        )
                    ),
                    array(
                        'title' => esc_html__('Price Margin', 'wixi'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page post title.', 'wixi'),
                        'id' =>'shop_post_price_margin',
                        'type' => 'spacing',
                        'output' => array('.woocommerce ul.products li.product .price'),
                        'mode' => 'margin',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'units' => 'px'
                        )
                    ),
                    // post button ( Add to cart )
                    array(
                        'title' => esc_html__('Button Background ( Add to cart )', 'wixi'),
                        'subtitle' => esc_html__('Change theme main color.', 'wixi'),
                        'id' => 'shop_addtocartbtn_bgcolor',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'default' => '',
                        'output' => array('.woocommerce ul.products li.product .button, .woocommerce.single-product .entry-summary button.button.alt')
                    ),
                    array(
                        'title' => esc_html__('Hover Button Background ( Add to cart )', 'wixi'),
                        'subtitle' => esc_html__('Change theme main color.', 'wixi'),
                        'id' => 'shop_addtocartbtn_hvrbgcolor',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'default' => '',
                        'output' => array('.woocommerce ul.products li.product .button:hover, .woocommerce.single-product .entry-summary button.button.alt:hover')
                    ),
                    array(
                        'title' => esc_html__('Button Title ( Add to cart )', 'wixi'),
                        'subtitle' => esc_html__('Change theme main color.', 'wixi'),
                        'id' => 'shop_addtocartbtn_color',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce ul.products li.product .button, .woocommerce.single-product .entry-summary button.button.alt')
                    ),
                    array(
                        'title' => esc_html__('Hover Button Title ( Add to cart )', 'wixi'),
                        'subtitle' => esc_html__('Change theme main color.', 'wixi'),
                        'id' => 'shop_addtocartbtn_hvrcolor',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce ul.products li.product .button:hover, .woocommerce.single-product .entry-summary button.button.alt:hover')
                    ),
                    array(
                        'title' => esc_html__('Button Border ( Add to cart )', 'wixi'),
                        'subtitle' => esc_html__('Change theme main color.', 'wixi'),
                        'id' => 'shop_addtocartbtn_brd',
                        'type' => 'border',
                        'output' => array('.woocommerce ul.products li.product .button, .woocommerce.single-product .entry-summary button.button.alt')
                    ),
                    array(
                        'title' => esc_html__('Hover Button Border ( Add to cart )', 'wixi'),
                        'subtitle' => esc_html__('Change theme main color.', 'wixi'),
                        'id' => 'shop_addtocartbtn_hvrbrd',
                        'type' => 'border',
                        'output' => array('.woocommerce ul.products li.product .button:hover, .woocommerce.single-product .entry-summary button.button.alt:hover')
                    ),
                    // post button ( view cart )
                    array(
                        'title' => esc_html__('Button Background ( View cart )', 'wixi'),
                        'subtitle' => esc_html__('Change button background color.', 'wixi'),
                        'id' => 'shop_viewcartbtn_bgcolor',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'default' => '',
                        'output' => array('.woocommerce a.added_to_cart')
                    ),
                    array(
                        'title' => esc_html__('Hover Button Background ( View cart )', 'wixi'),
                        'subtitle' => esc_html__('Change button hover background color.', 'wixi'),
                        'id' => 'shop_viewcartbtn_hvrbgcolor',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'default' => '',
                        'output' => array('.woocommerce a.added_to_cart')
                    ),
                    array(
                        'title' => esc_html__('Button Title ( View cart )', 'wixi'),
                        'subtitle' => esc_html__('Change button title color.', 'wixi'),
                        'id' => 'shop_viewcartbtn_color',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce a.added_to_cart')
                    ),
                    array(
                        'title' => esc_html__('Hover Button Title ( View cart )', 'wixi'),
                        'subtitle' => esc_html__('Change button hover title color.', 'wixi'),
                        'id' => 'shop_viewcartbtn_hvrcolor',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce a.added_to_cart')
                    ),
                    array(
                        'title' => esc_html__('Button Border ( View cart )', 'wixi'),
                        'subtitle' => esc_html__('Change hover button border style.', 'wixi'),
                        'id' => 'shop_viewcartbtn_brd',
                        'type' => 'border',
                        'output' => array('.woocommerce a.added_to_cart')
                    ),
                    array(
                        'title' => esc_html__('Hover Button Border ( View cart )', 'wixi'),
                        'subtitle' => esc_html__('Change hover button border style.', 'wixi'),
                        'id' => 'shop_viewcartbtn_hvrbrd',
                        'type' => 'border',
                        'output' => array('.woocommerce a.added_to_cart')
                    ),
                    array(
                        'title' => esc_html__('Buttons Padding', 'wixi'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page post buttons.', 'wixi'),
                        'id' =>'shop_postbtn_pad',
                        'type' => 'spacing',
                        'output' => array('.woocommerce ul.products li.product .button,.woocommerce a.added_to_cart'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'units' => 'px'
                        )
                    ),
                    array(
                        'title' => esc_html__('Buttons Margin', 'wixi'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page post buttons.', 'wixi'),
                        'id' =>'shop_postbtn_margin',
                        'type' => 'spacing',
                        'output' => array('.woocommerce ul.products li.product .button,.woocommerce a.added_to_cart'),
                        'mode' => 'margin',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'units' => 'px'
                        )
                    ),
                    array(
                        'title' => esc_html__('Sale Label Background Color', 'wixi'),
                        'subtitle' => esc_html__('Change sale label background color.', 'wixi'),
                        'id' => 'shop_sale_bgcolor',
                        'type' => 'color',
                        'mode' => 'background',
                        'default' => '',
                        'output' => array('.woocommerce span.onsale,.woocommerce ul.products li.product .onsale, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle')
                    ),
                    array(
                        'title' => esc_html__('Sale Label Text Color', 'wixi'),
                        'subtitle' => esc_html__('Change sale label text color.', 'wixi'),
                        'id' => 'shop_sale_color',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce span.onsale,.woocommerce ul.products li.product .onsale')
                    ),
                    array(
                        'title' => esc_html__('Pagination Background Color', 'wixi'),
                        'subtitle' => esc_html__('Change shop page pagination background color.', 'wixi'),
                        'id' => 'shop_pagination_bgcolor',
                        'type' => 'color',
                        'mode' => 'background',
                        'default' => '',
                        'output' => array('.woocommerce .nt-pagination .nt-pagination-inner .nt-pagination-item .nt-pagination-link')
                    ),
                    array(
                        'title' => esc_html__('Active Pagination Background Color', 'wixi'),
                        'subtitle' => esc_html__('Change shop page pagination hover and active item background color.', 'wixi'),
                        'id' => 'shop_pagination_hvrbgcolor',
                        'type' => 'color',
                        'mode' => 'background',
                        'default' => '',
                        'output' => array('.woocommerce .nt-pagination .nt-pagination-inner .nt-pagination-item.active .nt-pagination-link')
                    ),
                    array(
                        'title' => esc_html__('Pagination Text Color', 'wixi'),
                        'subtitle' => esc_html__('Change shop page pagination text color.', 'wixi'),
                        'id' => 'shop_pagination_color',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce .nt-pagination .nt-pagination-inner .nt-pagination-item .nt-pagination-link')
                    ),
                    array(
                        'title' => esc_html__('Active Pagination Text Color', 'wixi'),
                        'subtitle' => esc_html__('Change shop page pagination hover and active item text color.', 'wixi'),
                        'id' => 'shop_pagination_hvrcolor',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce .nt-pagination .nt-pagination-inner .nt-pagination-item.active .nt-pagination-link')
                    ),
                    array(
                        'title' => esc_html__('Pagination Border', 'wixi'),
                        'subtitle' => esc_html__('Change pagination item border style.', 'wixi'),
                        'id' => 'shop_pagination_brd',
                        'type' => 'border',
                        'output' => array('.woocommerce .nt-pagination .nt-pagination-inner .nt-pagination-item .nt-pagination-link')
                    ),
                    array(
                        'title' => esc_html__('Active Pagination Border', 'wixi'),
                        'subtitle' => esc_html__('Change pagination active item border style.', 'wixi'),
                        'id' => 'shop_pagination_hvrbrd',
                        'type' => 'border',
                        'output' => array('.woocommerce .nt-pagination .nt-pagination-inner .nt-pagination-item.active .nt-pagination-link')
                    ),
                )
            );


            /*************************************************
            ## SINGLE PAGE SECTION
            *************************************************/
            // create sections in the theme options
            $sections[] = array(
                'title' => esc_html__('Shop Single Page', 'wixi'),
                'id' => 'singleshopsection',
                'icon' => 'el el-shopping-cart-sign',
            );
            // SHOP PAGE SECTION
            $sections[] = array(
                'title' => esc_html__('General', 'wixi'),
                'id' => 'singleshopgeneral',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__( 'Page Layout', 'wixi' ),
                        'subtitle' => esc_html__( 'Choose the single page layout.', 'wixi' ),
                        'id' => 'single_shop_layout',
                        'type' => 'image_select',
                        'options' => array(
                            'left-sidebar' => array(
                                'alt' => 'Left Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                            ),
                            'full-width' => array(
                                'alt' => 'Full Width',
                                'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                            ),
                            'right-sidebar' => array(
                                'alt' => 'Right Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                            ),
                        ),
                        'default' => 'full-width'
                    ),
                    array(
                        'id' => 'shop_related_section_start',
                        'type' => 'section',
                        'title' => esc_html__('Related Post Options', 'wixi'),
                        'indent' => true
                    ),
                    array(
                        'title' => esc_html__('Related Title', 'wixi'),
                        'subtitle' => esc_html__('Add your single shop page related section title here.', 'wixi'),
                        'id' => 'single_shop_related_title',
                        'type' => 'text',
                        'default' => ''
                    ),
                    array(
                        'title' => esc_html__('Post Count ( Per Page )', 'wixi'),
                        'subtitle' => esc_html__('You can control show related post count with this option.', 'wixi'),
                        'id' => 'single_shop_related_count',
                        'type' => 'slider',
                        'default' => 10,
                        'min' => 1,
                        'step' => 1,
                        'max' => 24,
                        'display_value' => 'text'
                    ),
                    array(
                        'id' => 'shop_related_section_slider_start',
                        'type' => 'section',
                        'title' => esc_html__('Related Slider Options', 'wixi'),
                        'indent' => true
                    ),
                    array(
                        'title' => esc_html__( 'Perview ( Min 1024px )', 'wixi' ),
                        'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'wixi' ),
                        'id' => 'shop_related_perview',
                        'type' => 'slider',
                        'default' => 4,
                        'min' => 1,
                        'step' => 1,
                        'max' => 10,
                        'display_value' => 'text',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Perview ( Min 768px )', 'wixi' ),
                        'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'wixi' ),
                        'id' => 'shop_related_mdperview',
                        'type' => 'slider',
                        'default' => 3,
                        'min' => 1,
                        'step' => 1,
                        'max' => 10,
                        'display_value' => 'text',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Perview ( Min 480px )', 'wixi' ),
                        'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'wixi' ),
                        'id' => 'shop_related_smperview',
                        'type' => 'slider',
                        'default' => 2,
                        'min' => 1,
                        'step' => 1,
                        'max' => 10,
                        'display_value' => 'text',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Speed', 'wixi' ),
                        'subtitle' => esc_html__( 'You can control related post slider item gap.', 'wixi' ),
                        'id' => 'shop_related_speed',
                        'type' => 'slider',
                        'default' => 1000,
                        'min' => 100,
                        'step' => 1,
                        'max' => 10000,
                        'display_value' => 'text',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Gap', 'wixi' ),
                        'subtitle' => esc_html__( 'You can control related post slider item gap.', 'wixi' ),
                        'id' => 'shop_related_gap',
                        'type' => 'slider',
                        'default' => 30,
                        'min' => 0,
                        'step' => 1,
                        'max' => 100,
                        'display_value' => 'text',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Centered', 'wixi' ),
                        'id' => 'shop_related_centered',
                        'type' => 'switch',
                        'default' => 0,
                        'on' => 'On',
                        'off' => 'Off',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Autoplay', 'wixi' ),
                        'id' => 'shop_related_autoplay',
                        'type' => 'switch',
                        'default' => 1,
                        'on' => 'On',
                        'off' => 'Off',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Loop', 'wixi' ),
                        'id' => 'shop_related_loop',
                        'type' => 'switch',
                        'default' => 0,
                        'on' => 'On',
                        'off' => 'Off',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Mousewheel', 'wixi' ),
                        'id' => 'shop_related_mousewheel',
                        'type' => 'switch',
                        'default' => 0,
                        'on' => 'On',
                        'off' => 'Off',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'id' => 'shop_related_section_slider_end',
                        'type' => 'section',
                        'indent' => false
                    ),
                    array(
                        'id' => 'shop_related_section_end',
                        'type' => 'section',
                        'indent' => false
                    ),
                    array(
                        'id' => 'shop_upsells_section_start',
                        'type' => 'section',
                        'title' => esc_html__('Upsells Post Options', 'wixi'),
                        'indent' => true
                    ),
                    array(
                        'title' => esc_html__('Upsells Title', 'wixi'),
                        'subtitle' => esc_html__('Add your single shop page upsells section title here.', 'wixi'),
                        'id' => 'single_shop_upsells_title',
                        'type' => 'text',
                        'default' => ''
                    ),
                    array(
                        'title' => esc_html__('Post Column', 'wixi'),
                        'subtitle' => esc_html__('You can control upsells post column with this option.', 'wixi'),
                        'id' => 'single_shop_upsells_colxl',
                        'type' => 'slider',
                        'default' => 4,
                        'min' => 1,
                        'step' => 1,
                        'max' => 6,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post Column ( Desktop/Tablet )', 'wixi'),
                        'subtitle' => esc_html__('You can control upsells post column for tablet device with this option.', 'wixi'),
                        'id' => 'single_shop_upsells_collg',
                        'type' => 'slider',
                        'default' => 3,
                        'min' => 1,
                        'step' => 1,
                        'max' => 4,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post Column ( Phone )', 'wixi'),
                        'subtitle' => esc_html__('You can control upsells post column for phone device with this option.', 'wixi'),
                        'id' => 'single_shop_upsells_colsm',
                        'type' => 'slider',
                        'default' => 1,
                        'min' => 1,
                        'step' => 1,
                        'max' => 3,
                        'display_value' => 'text'
                    ),
                    array(
                        'id' => 'shop_upsells_section_end',
                        'type' => 'section',
                        'indent' => false
                    ),
                    array(
                        'id' => 'shop_crosssells_section_start',
                        'type' => 'section',
                        'title' => esc_html__('Cross-Sells Post Options', 'wixi'),
                        'indent' => true
                    ),
                    array(
                        'title' => esc_html__('Cross-Sells Title', 'wixi'),
                        'subtitle' => esc_html__('Add your cart page cross-sells section title here.', 'wixi'),
                        'id' => 'single_shop_crosssells_title',
                        'type' => 'text',
                        'default' => ''
                    ),
                    array(
                        'title' => esc_html__('Post Column', 'wixi'),
                        'subtitle' => esc_html__('You can control cross-sells post column with this option.', 'wixi'),
                        'id' => 'single_shop_crosssells_colxl',
                        'type' => 'slider',
                        'default' => 2,
                        'min' => 1,
                        'step' => 1,
                        'max' => 3,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post Column ( Desktop/Tablet )', 'wixi'),
                        'subtitle' => esc_html__('You can control cross-sells post column for tablet device with this option.', 'wixi'),
                        'id' => 'single_shop_crosssells_collg',
                        'type' => 'slider',
                        'default' => 2,
                        'min' => 1,
                        'step' => 1,
                        'max' => 2,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post Column ( Phone )', 'wixi'),
                        'subtitle' => esc_html__('You can control cross-sells post column for phone device with this option.', 'wixi'),
                        'id' => 'single_shop_crosssells_colsm',
                        'type' => 'slider',
                        'default' => 1,
                        'min' => 1,
                        'step' => 1,
                        'max' => 2,
                        'display_value' => 'text'
                    ),
                    array(
                        'id' => 'shop_crosssells_section_end',
                        'type' => 'section',
                        'indent' => false
                    ),
                )
            );
            // SINGLE HERO SUBSECTION
            $sections[] = array(
                'title' => esc_html__('Single Hero', 'wixi'),
                'desc' => esc_html__('These are single page hero section settings!', 'wixi'),
                'id' => 'singleshopherosubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__('Hero display', 'wixi'),
                        'subtitle' => esc_html__('You can enable or disable the site single page hero section with switch option.', 'wixi'),
                        'id' => 'single_shop_hero_visibility',
                        'type' => 'switch',
                        'default' => 1,
                        'on' => 'On',
                        'off' => 'Off',
                    ),
                    array(
                        'title' => esc_html__( 'Hero Template', 'wixi' ),
                        'subtitle' => esc_html__( 'Select your header template.', 'wixi' ),
                        'id' => 'single_shop_hero_template',
                        'type' => 'select',
                        'customizer' => true,
                        'options' => array(
                            'default' => esc_html__( 'Deafult Site Hero', 'wixi' ),
                            'elementor' => esc_html__( 'Elementor Templates', 'wixi' ),
                        ),
                        'default' => 'default',
                        'required' => array( 'single_shop_hero_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Elementor Templates', 'wixi' ),
                        'subtitle' => esc_html__( 'Select a template from elementor templates.', 'wixi' ),
                        'id' => 'single_shop_hero_elementor_templates',
                        'type' => 'select',
                        'customizer' => true,
                        'options' => wixi_get_elementorTemplates(),
                        'required' => array(
                            array( 'single_shop_hero_visibility', '=', '1' ),
                            array( 'single_shop_hero_template', '=', 'elementor' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Hero Background', 'wixi'),
                        'id' => 'single_shop_hero_bg',
                        'type' => 'background',
                        'output' => array( '#nt-woo-single .page-header__bg' ),
                        'required' => array(
                            array( 'single_shop_hero_visibility', '=', '1' ),
                            array( 'single_shop_hero_template', '=', 'default' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Page Title', 'wixi'),
                        'subtitle' => esc_html__('Add your single shop page title here.', 'wixi'),
                        'id' => 'single_shop_title',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_hero_visibility', '=', '1' ),
                            array( 'single_shop_hero_template', '=', 'default' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Title Typography', 'wixi'),
                        'id' => 'single_shop_title_typo',
                        'type' => 'typography',
                        'font-backup' => false,
                        'letter-spacing' => true,
                        'text-transform' => true,
                        'all_styles' => true,
                        'output' => array( '#nt-woo-single .nt-hero-title' ),
                        'units' => 'px',
                        'default' => array(
                            'color' => '',
                            'font-style' => '',
                            'font-family' => '',
                            'google' => true,
                            'font-size' => '',
                            'line-height' => ''
                        ),
                        'required' => array(
                            array( 'single_shop_hero_visibility', '=', '1' ),
                            array( 'single_shop_hero_template', '=', 'default' )
                        )
                    )
                )
            );
            // SINGLE CONTENT SUBSECTION
            $sections[] = array(
                'title' => esc_html__('Single Content', 'wixi'),
                'id' => 'singleshopcontentsubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__('Single Content Padding', 'wixi'),
                        'subtitle' => esc_html__('You can set the top spacing of the site single page content.', 'wixi'),
                        'id' =>'single_shop_content_pad',
                        'type' => 'spacing',
                        'output' => array('#nt-woo-single .nt-theme-inner-container'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'padding-top' => '',
                            'padding-right' => '',
                            'padding-bottom' => '',
                            'padding-left' => '',
                            'units' => 'px'
                        )
                    )
                )
            );
            return $sections;
        }
        add_filter('redux/options/'.$wixi_pre.'/sections', 'wixi_dynamic_section');
    }
}

/*************************************************
## WOOCOMMERCE HERO FUNCTION
*************************************************/

if(! function_exists('wixi_woo_hero_section')) {
    function wixi_woo_hero_section()
    {

        if (class_exists( 'WooCommerce' )) {

            if (is_archive() || is_shop()) {
                $name = 'shop';
                $h_t  = '' != wixi_settings('shop_title') ? wixi_settings('shop_title') : '';
            } elseif (is_product()) { // blog and cpt archive page
                $name = 'single_shop';
                $h_t  = '' != wixi_settings('single_shop_title') ? wixi_settings('single_shop_title') : '';
            } else {
                $name = 'shop';
                $h_t  = 'Shop';
            }
            $has_bg = $bg_attr = '';
            $def_bg = ' default-bg';


            // page breadcrumbs
            $h_b = wixi_settings('breadcrumbs_visibility', '0');
            // page hero text alignment
            $h_a = wixi_settings($name.'_hero_alignment', 'text-center');
            // page hero background image overlay
            $h_o = wixi_settings($name.'_hero_overlay') != '' ? ' hero-overlay': '';

            if ( '0' != wixi_settings('shop_hero', '1')) {

                if ( 'elementor' == wixi_settings($name.'_hero_template', 'default') ) {

                    if ( class_exists( '\Elementor\Frontend' ) ) {
                        $template_id = wixi_settings( $name.'_hero_elementor_templates' );
                        if ( !empty( $template_id ) ) {

                            $frontend = new \Elementor\Frontend;
                            printf( '%1$s', $frontend->get_builder_content( $template_id, false ) );

                        }
                    }

                } else {

                    echo '<div id="nt-hero" class="page-header text-center page-id-'.get_the_ID().' '. esc_attr($h_o) .$has_bg.$def_bg.'"'.$bg_attr.'>
                    <div class="container">
                    <div class="row">
                    <div class="col-sm-12">
                    <div class="cont-inner">
                    <div class="hero-innner-last-child">';

                    // page hero slogan
                    if ( '' != wixi_settings($name.'_slogan')) {
                        echo '<h6 class="nt-hero-subtitle __subtitle">'.wp_kses(wixi_settings($name.'_slogan'), wixi_allowed_html()).'</h6>';
                    }

                    // page hero title
                    if ( $h_t ) {
                        echo '<h1 class="nt-hero-title hero__title"><span>'.wp_kses($h_t, wixi_allowed_html()).'</span></h1>';
                    } else {
                        echo '<h1 class="nt-hero-title hero__title"><span>';
                        woocommerce_page_title();
                        echo '</span></h1>';
                    }

                    // page hero description
                    if ( '' != wixi_settings($name.'_desc')) {
                        echo '<p class="nt-hero-description">'.wp_kses(wixi_settings($name.'_desc'), wixi_allowed_html()).'</p>';
                    }

                    // page breadcrumbs
                    if ( '1' == wixi_settings('breadcrumbs_visibility', '0')) {
                        wixi_breadcrumbs();
                    }

                    echo '</div><!-- End hero-innner-last-child -->
                    </div><!-- End hero-content -->
                    </div><!-- End column -->
                    </div><!-- End row -->
                    </div><!-- End container -->
                    </div><!-- End hero-container -->';
                }
            } // hide hero area
        }
    }
}

if ( !function_exists( 'wixi_after_shop_page' ) ) {
    function wixi_after_shop_page() {
        if ( class_exists( '\Elementor\Frontend' ) ) {
            $template_id = wixi_settings( 'shop_after_page_elementor_templates' );
            if ( !empty( $template_id ) ) {

                $frontend = new \Elementor\Frontend;
                printf( '%1$s', $frontend->get_builder_content( $template_id, false ) );

            }
        }
    }
    add_action('wixi_after_woo_shop_page', 'wixi_after_shop_page', 10);
}

/*************************************************
## ADD CUSTOM CSS FOR WOOCOMMERCE
*************************************************/


if ( !function_exists( 'wixi_woo_scripts' ) ) {
    function wixi_woo_scripts()
    {
        wp_enqueue_style( 'wixi-woocommerce-custom', get_template_directory_uri() . '/woocommerce/woocommerce-custom.css',false, '1.0');
        wp_enqueue_script('wixi-woocommerce-custom', get_template_directory_uri() . '/woocommerce/woocommerce-custom.js', array('jquery'), '1.0', true);
    }
    add_action( 'wp_enqueue_scripts', 'wixi_woo_scripts' );
}


/*************************************************
## REMOVE WOOCOMMERCE DEFAULT PAGINATION
*************************************************/

remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );


/*************************************************
## ADD THEME SUPPORT FOR WOOCOMMERCE
*************************************************/


function wixi_woo_theme_setup() {

    add_theme_support( 'woocommerce'  );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

}
add_action( 'after_setup_theme', 'wixi_woo_theme_setup' );

/**
* Change number of products that are displayed per page (shop page)
*/
if (!function_exists('wixi_wc_shop_per_page')) {
    add_filter( 'loop_shop_per_page', 'wixi_wc_shop_per_page', 20 );
    function wixi_wc_shop_per_page( $cols ) {

        $cols = wixi_settings( 'shop_perpage', '6' );

        return $cols;
    }
}

/**
* Change custom product type column
*/
if ( !function_exists('wixi_wc_product_column') ) {

    function wixi_wc_product_column() {

        $col[] = 'row-cols-1';
        $col[] = 'row-cols-sm-' . wixi_settings('shop_colsm', '2');
        $col[] = 'row-cols-lg-' . wixi_settings('shop_collg', '3');
        $col[] = 'row-cols-xl-' . wixi_settings('shop_colxl', '4');
        $col = implode( ' ', $col );

        return $col;
    }
}

/**
* Change number of upsells products column
*/
if ( !function_exists('wixi_wc_sells_product_column') ) {

    function wixi_wc_sells_product_column() {
        $sells = is_cart() ? 'crosssells' : 'upsells';
        $col[] = 'row-cols-1 cart';
        $col[] = 'row-cols-sm-' . wixi_settings('single_shop_'.$sells.'_colsm', '2');
        $col[] = 'row-cols-lg-' . wixi_settings('single_shop_'.$sells.'_collg', '3');
        $col[] = 'row-cols-xl-' . wixi_settings('single_shop_'.$sells.'_colxl', '4');
        $col   = implode( ' ', $col );
        return apply_filters( 'wixi_wc_sells_column', $col );
    }
}

/**
* Change number of related products output
*/
if (!function_exists('wixi_woo_related_products_limit')) {

    add_filter( 'woocommerce_output_related_products_args', 'wixi_woo_related_products_limit', 20 );
    function wixi_woo_related_products_limit( $args ) {
        $args['posts_per_page'] = wixi_settings('single_shop_related_count', '4'); // 4 related products
        $args['columns'] = wixi_settings('single_shop_related_column', '1'); // arranged in 2 columns
        return $args;
    }
}

/*************************************************
## REGISTER SIDEBAR FOR WOOCOMMERCE
*************************************************/


if ( !function_exists( 'wixi_woo_widgets_init' ) ) {
    function wixi_woo_widgets_init() {
        //Shop page sidebar
        register_sidebar( array(
            'name' => esc_html__( 'Shop Page Sidebar', 'wixi' ),
            'id' => 'shop-page-sidebar',
            'description' => esc_html__( 'These widgets for the Shop page.','wixi' ),
            'before_widget' => '<div class="nt-sidebar-inner-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="nt-sidebar-inner-widget-title widget-title">',
            'after_title' => '</h4>'
        ) );
        //Single product sidebar
        register_sidebar( array(
            'name' => esc_html__( 'Shop Single Page Sidebar', 'wixi' ),
            'id' => 'shop-single-sidebar',
            'description' => esc_html__( 'These widgets for the Shop Single page.','wixi' ),
            'before_widget' => '<div class="nt-sidebar-inner-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="nt-sidebar-inner-widget-title widget-title">',
            'after_title' => '</h4>'
        ) );
    }
    add_action( 'widgets_init', 'wixi_woo_widgets_init' );
}

add_filter( 'woocommerce_prevent_automatic_wizard_redirect', '__return_true' );

