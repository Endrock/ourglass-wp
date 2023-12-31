<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Header_Menu_Two extends Widget_Base {
    use Wixi_Helper;

    public function get_name() {
        return 'wixi-header-menu';
    }
    public function get_title() {
        return 'Header Top Menu (N)';
    }
    public function get_icon() {
        return 'eicon-nav-menu';
    }
    public function get_categories() {
        return [ 'wixi' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_register_style( 'header-menu-two', WIXI_PLUGIN_URL. 'assets/front/css/header-menu-two.css');
        wp_register_style( 'wixi-custom', WIXI_PLUGIN_URL. 'assets/front/css/custom.css');
    }
    public function get_style_depends() {
        return [ 'splitting','splitting-cells','wixi-custom','header-menu-two' ];
    }
    public function get_script_depends() {
        return [ 'splitting' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('wixi_header_menu_general_settings',
            [
                'label' => esc_html__( 'General', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'usemenu',
            [
                'label' => esc_html__( 'Use Custom Menu', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no'
            ]
        );
        $this->add_control( 'position',
            [
                'label' => esc_html__( 'Position', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Default', 'wixi' ),
                    'header-fixed' => esc_html__( 'Fixed', 'wixi' )
                ]
            ]
        );
        $this->add_control( 'sticky',
            [
                'label' => esc_html__( 'Sticky Menu?', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no'
            ]
        );
        // Exclude Category
        $this->add_control( 'register_menus',
            [
                'label' => esc_html__( 'Select Menu', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'label_block' => true,
                'options' => $this->nt_registered_nav_menus(),
                'condition' => [ 'usemenu!' => 'yes' ]
            ]
        );
        $this->add_control( 'add_extra',
            [
                'label' => esc_html__( 'Add Extra Menu Item', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('wixi_custom_menu__general_settings',
            [
                'label' => esc_html__( 'Custom Menu', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['usemenu' => 'yes']
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'name',
            [
                'label' => esc_html__( 'Name', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Home',
                'label_block' => true
            ]
        );
        $repeater->add_control( 'link',
            [
                'label' => esc_html__( 'Link', 'wixi' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#sectionid',
                    'is_external' => 'true'
                ],
                'placeholder' => esc_html__( 'Place URL here', 'wixi' )
            ]
        );
        $repeater->add_control( 'linktype',
            [
                'label' => esc_html__( 'Link Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'int',
                'options' => [
                    'int' => esc_html__( 'Internal', 'wixi' ),
                    'ext' => esc_html__( 'External', 'wixi' )
                ]
            ]
        );
        $this->add_control( 'menus',
            [
                'label' => esc_html__( 'Items', 'wixi' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{name}}',
                'default' => [
                    [
                        'name' => 'Home',
                        'link' => '#',
                    ],
                    [
                        'name' => 'Home',
                        'link' => '#',
                    ],
                    [
                        'name' => 'Home',
                        'link' => '#',
                    ],
                ]
            ]
        );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('wixi_menu_extra_general_settings',
            [
                'label' => esc_html__( 'Extra Menu', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['add_extra' => 'yes']
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'menu_item_content',
            [
                'label' => esc_html__( 'Menu Content', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'label_block' => true
            ]
        );
        $repeater->add_control( 'link2',
            [
                'label' => esc_html__( 'Link', 'wixi' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#0',
                    'is_external' => 'true'
                ],
                'placeholder' => esc_html__( 'Place URL here', 'wixi' )
            ]
        );
        $repeater->add_control( 'linktype2',
            [
                'label' => esc_html__( 'Link Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'int',
                'options' => [
                    'int' => esc_html__( 'Internal', 'wixi' ),
                    'ext' => esc_html__( 'External', 'wixi' )
                ]
            ]
        );
        $this->add_control( 'extras',
            [
                'label' => esc_html__( 'Items', 'wixi' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{menu_item_content}}',
                'default' => [
                    [
                        'menu_item_content' => '<i class="fa fa-shopping-cart"></i>',
                        'link2' => '#0',
                    ],
                ],
            ]
        );

		$this->add_control( 'extras_menü_item_style',
			[
				'label' => esc_html__( 'Style', 'plugin-name' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->wixi_style_slider_size( 'extra_menu_item_fontsize',array('{{WRAPPER}} .wixi_nav .header_nav ul li a.header_nav_link.extra_meu_items' => 'display: flex;align-items: center;justify-content: center;font-size: {{SIZE}}px;'), $min=0, $max=100 );
        $this->wixi_style_padding( 'extra_menu_item_padding','{{WRAPPER}} .wixi_nav .header_nav ul li a.header_nav_link.extra_meu_items' );
        $this->wixi_style_margin( 'extra_menu_item_margin','{{WRAPPER}} .wixi_nav .header_nav ul li a.header_nav_link.extra_meu_items' );
        //  Tabs
        $this->start_controls_tabs('extra_menu_item_tabs');
        //  Normal
        $this->start_controls_tab( 'extra_menu_item_hover_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wixi' ) ]
        );
        $this->wixi_style_color( 'extra_menu_item_color','{{WRAPPER}} .wixi_nav .header_nav ul li a.header_nav_link.extra_meu_items' );
        $this->wixi_style_border( 'extra_menu_item_border','{{WRAPPER}} .wixi_nav .header_nav ul li a.header_nav_link.extra_meu_items' );
        $this->end_controls_tab();
        //  Normal

        //  Hover
        $this->start_controls_tab('extra_menu_item_hover_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wixi' ) ]
        );

        $this->wixi_style_color( 'extra_menu_item_hover_color','{{WRAPPER}} .wixi_nav .header_nav:not(.is-active)>ul>li:hover a.header_nav_link.extra_meu_items' );
        $this->wixi_style_border( 'extra_menu_item_hover_border','{{WRAPPER}} .wixi_nav .header_nav ul li:hover a.header_nav_link.extra_meu_items' );
        //  Hover
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   Header General Style   ******/
        $this->start_controls_section( 'header_style_controls_section',
            [
                'label' => esc_html__( 'Header General Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control( 'split',
            [
                'label' => esc_html__( 'Split Word Effect', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->wixi_style_background( 'header_background', '{{WRAPPER}} .header.wixi_nav, {{WRAPPER}} .header.wixi_nav .header_container',array('classic','gradient') );
        $this->wixi_style_flex_alignment( 'header_alignment', '{{WRAPPER}} .header.wixi_nav .header_inner' );
        $this->wixi_style_padding( 'header_padding', '{{WRAPPER}} .header.wixi_nav .header_container' );
        $this->wixi_style_border( 'header_border','{{WRAPPER}} .header.wixi_nav .header_container' );
        $this->wixi_style_box_shadow( 'header_shadow','{{WRAPPER}} .header.wixi_nav .header_container' );

        $this->end_controls_section();
        /*****   Header General Style   ******/

        /*****   Menu Style   ******/
        $this->start_controls_section( 'header_menu_item_style_controls_section',
            [
                'label' => esc_html__( 'Menu Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wixi_style_typo( 'header_menu_item_normal_typo', '{{WRAPPER}} .header.wixi_nav .header_nav:not(.is-active)>ul>li>a,{{WRAPPER}} .header.wixi_nav .header_nav:not(.is-active)>ul>li>a>*' );
        $this->wixi_style_padding( 'header_menu_item_padding', '{{WRAPPER}} .header.wixi_nav .header_nav:not(.is-active)>ul>li>a' );
        $this->wixi_style_margin( 'header_menu_item_margin', '{{WRAPPER}} .header.wixi_nav .header_nav:not(.is-active)>ul>li>a' );

        //  Tabs
        $this->start_controls_tabs('header_menu_item_normal_tabs');
        //  Normal
        $this->start_controls_tab( 'header_menu_item_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wixi' ) ]
        );
        $this->wixi_style_background( 'header_menu_item_normal_bgcolor', '{{WRAPPER}} .header.wixi_nav .header_nav:not(.is-active)>ul>li>a',array('classic','gradient') );
        $this->wixi_style_color( 'header_menu_item_normal_color', '{{WRAPPER}} .header.wixi_nav .header_nav:not(.is-active)>ul>li>a' );
        $this->wixi_style_border( 'header_menu_item_normal_border','{{WRAPPER}} .wixi_nav .header_nav:not(.is-active)>ul>li>a' );
        $this->end_controls_tab();
        //  Normal

        //  Hover
        $this->start_controls_tab('header_menu_item_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wixi' ) ]
        );

        $this->wixi_style_background( 'header_menu_item_hvr_bgcolor', '{{WRAPPER}} .header_nav ul li > a:after',array('classic','gradient') );
        $this->wixi_style_color( 'header_menu_item_hvr_color', '{{WRAPPER}} .header.wixi_nav .header_nav:not(.is-active)>ul>li:hover>a' );
        $this->wixi_style_border( 'header_menu_item_hvr_border','{{WRAPPER}} .wixi_nav .header_nav:not(.is-active)>ul>li:hover>a' );
        $this->end_controls_tab();
        //  Hover
        $this->end_controls_tabs();
        //  Tabs
        $this->end_controls_section();
        /*****   Menu Style   ******/

        /*****   Dropdown General   ******/
        $this->start_controls_section( 'header_dropdown_style_controls_section',
            [
                'label' => esc_html__( 'Dropdown General', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wixi_style_background( 'header_dropdown_background', '{{WRAPPER}} .header.wixi_nav .header_nav:not(.is-active) .header_nav_sub>ul',array('classic','gradient') );
        $this->wixi_style_padding( 'header_dropdown_padding', '{{WRAPPER}} .header.wixi_nav .header_nav:not(.is-active) .header_nav_sub>ul' );
        $this->wixi_style_slider_width( 'header_dropdown_width',array('{{WRAPPER}} .header.wixi_nav .header_nav:not(.is-active) .header_nav_sub>ul'=>'min-width: {{SIZE}}px;'), $min=0, $max=500 );
        $this->wixi_style_border( 'header_dropdown_border','{{WRAPPER}} .header.wixi_nav .header_nav:not(.is-active) .header_nav_sub>ul' );

        $this->end_controls_section();
        /*****   Dropdown General   ******/

        /*****   Dropdown Menu   ******/
        $this->start_controls_section( 'header_dropdown_menu_item_style_controls_section',
            [
                'label' => esc_html__( 'Dropdown Menu', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wixi_style_typo( 'header_dropdown_menu_item_normal_typo', '{{WRAPPER}} .header.wixi_nav .header_nav:not(.is-active) .header_nav_sub ul li a' );
        $this->wixi_style_padding( 'header_dropdown_menu_item_padding', '{{WRAPPER}} .header.wixi_nav .header_nav:not(.is-active) .header_nav_sub ul li a' );
        $this->wixi_style_margin( 'header_dropdown_menu_item_margin', '{{WRAPPER}} .header.wixi_nav .header_nav:not(.is-active) .header_nav_sub ul li a' );

        //  Tabs
        $this->start_controls_tabs('header_dropdown_menu_item_normal_tabs');
        //  Normal
        $this->start_controls_tab( 'header_dropdown_menu_item_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wixi' ) ]
        );
        $this->wixi_style_color( 'header_dropdown_menu_item_normal_color', '{{WRAPPER}} .header.wixi_nav .header_nav .header_nav_sub ul li a' );
        $this->wixi_style_border( 'header_dropdown_menu_item_normal_border', '{{WRAPPER}} .header.wixi_nav .header_nav .header_nav_sub ul li' );
        $this->end_controls_tab();
        //  Normal

        //  Hover
        $this->start_controls_tab('header_dropdown_menu_item_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wixi' ) ]
        );
        $this->wixi_style_background( 'header_dropdown_menu_item_hover_bgcolor', '{{WRAPPER}} .header_nav ul li > a:after',array('classic','gradient') );
        $this->wixi_style_color( 'header_dropdown_menu_item_hover_color', '{{WRAPPER}} .header.wixi_nav .header_nav:not(.is-active) .header_nav_sub ul li:hover a' );
        $this->wixi_style_border( 'header_dropdown_menu_item_hover_border', '{{WRAPPER}} .header.wixi_nav .header_nav:not(.is-active) .header_nav_sub ul li:hover' );
        $this->end_controls_tab();
        //  Hover
        $this->end_controls_tabs();
        //  Tabs
        $this->end_controls_section();
        /*****   Dropdown Menu   ******/

        /*****   Mobile Toggle Bar   ******/
        $this->start_controls_section( 'header_mobile_toggle_style_controls_section',
            [
                'label' => esc_html__( 'Mobile Toggle Bar', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $selector_toggle = array(
            '{{WRAPPER}} .header.wixi_nav .header_nav_toggle' => 'flex: 0 0 {{SIZE}}px;',
            '{{WRAPPER}} .header.wixi_nav .header_container .header_nav_toggle' => 'width: {{SIZE}}px;',
            '{{WRAPPER}} .header.wixi_nav .header_inner .header_nav_toggle' => 'height: {{SIZE}}px;'
        );
        $this->wixi_style_slider_size( 'header_mobile_toggle_hover_width',$selector_toggle, $min=0, $max=500 );
        $this->wixi_style_content_alignment( 'header_mobile_toggle_alignment','{{WRAPPER}} .header.wixi_nav .header_container .header_nav_toggle' );

        //  Tabs
        $this->start_controls_tabs('header_mobile_toggle_normal_tabs');
        //  Normal
        $this->start_controls_tab( 'header_mobile_toggle_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wixi' ) ]
        );
        $this->wixi_style_slider_size( 'header_mobile_toggle_normal_fontsz',array('{{WRAPPER}} .header.wixi_nav .header_nav_toggle,{{WRAPPER}} .header.wixi_nav .header_nav_toggle.menu-toggle .icon i' => 'font-size: {{SIZE}}px;'), $min=0, $max=500 );
        $this->add_control( 'header_mobile_toggle_color',
            [
                'label' => esc_html__( 'Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .header.wixi_nav .header_nav_toggle' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .header.wixi_nav .header_nav_toggle.menu-toggle .icon i' => 'background-color:{{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->wixi_style_bgcolor( 'header_mobile_toggle_bgcolor', '{{WRAPPER}} .header.wixi_nav .header_nav_toggle' );
        $this->wixi_style_border( 'header_mobile_toggle_border', '{{WRAPPER}} .header.wixi_nav .header_nav_toggle' );
        $this->end_controls_tab();
        //  Normal

        //  Hover
        $this->start_controls_tab('header_mobile_toggle_hover_tab',
            [ 'label'           => esc_html__( 'Hover', 'wixi' ) ]
        );
        $this->wixi_style_slider_size( 'header_mobile_toggle_hover_fontsz',array('{{WRAPPER}} .header.wixi_nav .header_nav_toggle:hover' => 'font-size: {{SIZE}}px;'), $min=0, $max=500 );
        $this->wixi_style_color( 'header_mobile_toggle_hover_color','{{WRAPPER}} .header.wixi_nav .header_nav_toggle:hover' );
        $this->wixi_style_bgcolor( 'header_mobile_toggle_hover_bgcolor', '{{WRAPPER}} .header.wixi_nav .header_nav_toggle:hover' );
        $this->wixi_style_border( 'header_mobile_toggle_hover_border', '{{WRAPPER}} .header.wixi_nav .header_nav_toggle:hover' );
        $this->end_controls_tab();
        //  Hover
        $this->end_controls_tabs();
        //  Tabs
        $this->end_controls_section();
        /*****   Mobile Toggle Bar   ******/

        /*****   Mobile Menu Container   ******/
        $this->start_controls_section( 'header_mobile_style_controls_section',
            [
                'label' => esc_html__( 'Mobile Menu Container', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wixi_style_background( 'header_mobile_background', '{{WRAPPER}} .header.wixi_nav .header_nav.is-active',array('classic','gradient') );
        $this->wixi_style_padding( 'header_mobile_padding', '{{WRAPPER}} .header.wixi_nav .header_nav.is-active' );
        $this->wixi_style_slider_width( 'header_mobile_width',array('{{WRAPPER}} .header.wixi_nav .header_nav.is-active' => 'width: {{SIZE}}px;'), $min=0, $max=500 );
        $this->wixi_style_border( 'header_mobile_border', '{{WRAPPER}} .header.wixi_nav .header_nav.is-active' );

        $this->end_controls_section();
        /*****   Mobile Menu Container   ******/

        /*****   Mobile Menu   ******/
        $this->start_controls_section( 'header_mobile_menu_item_style_controls_section',
            [
                'label' => esc_html__( 'Mobile Menu', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wixi_style_typo( 'header_mobile_menu_item_normal_typo', '{{WRAPPER}} .header.wixi_nav .header_nav.is-active ul li>a, {{WRAPPER}} .header.wixi_nav.is-sticky.is-sticky-active .header_nav.is-active ul li>a' );
        $this->wixi_style_padding( 'header_mobile_menu_item_padding', '{{WRAPPER}} .header.wixi_nav .header_nav.is-active ul li>a, {{WRAPPER}} .header.wixi_nav.is-sticky.is-sticky-active .header_nav.is-active ul li>a' );
        $this->wixi_style_margin( 'header_mobile_menu_item_margin', '{{WRAPPER}} .header.wixi_nav .header_nav.is-active ul li>a, {{WRAPPER}} .header.wixi_nav.is-sticky.is-sticky-active .header_nav.is-active ul li>a' );

        //  Tabs
        $this->start_controls_tabs('header_mobile_menu_item_normal_tabs');
        //  Normal
        $this->start_controls_tab( 'header_mobile_menu_item_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wixi' ) ]
        );
        $this->wixi_style_background( 'header_mobile_menu_item_normal_bgcolor', '{{WRAPPER}} .header.wixi_nav .header_nav.is-active ul li>a, {{WRAPPER}} .header.wixi_nav.is-sticky.is-sticky-active .header_nav.is-active ul li>a',array('classic','gradient') );
        $this->wixi_style_color( 'header_mobile_menu_item_normal_color', '{{WRAPPER}} .header.wixi_nav .header_nav.is-active ul li>a, {{WRAPPER}} .header.wixi_nav.is-sticky.is-sticky-active .header_nav.is-active ul li>a' );
        $this->wixi_style_border( 'header_mobile_menu_item_normal_border', '{{WRAPPER}} .header.wixi_nav .header_nav.is-active ul li, {{WRAPPER}} .header.wixi_nav.is-sticky.is-sticky-active .header_nav.is-active ul li' );
        $this->end_controls_tab();
        //  Normal

        //  Hover
        $this->start_controls_tab('header_mobile_menu_item_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wixi' ) ]
        );
        $this->wixi_style_background( 'header_mobile_menu_item_hover_bgcolor', '{{WRAPPER}} .header.wixi_nav .header_nav.is-active ul li:hover>a, {{WRAPPER}} .header.wixi_nav.is-sticky.is-sticky-active .header_nav.is-active ul li:hover>a',array('classic','gradient') );
        $this->wixi_style_color( 'header_mobile_menu_item_hover_color', '{{WRAPPER}} .header.wixi_nav .header_nav.is-active ul li.header_nav_item:hover>a, {{WRAPPER}} .header.wixi_nav .header_nav.is-active ul li:hover>a, {{WRAPPER}} .header.wixi_nav.is-sticky.is-sticky-active .header_nav.is-active ul li:hover>a' );
        $this->wixi_style_border( 'header_mobile_menu_item_hover_border', '{{WRAPPER}} .header.wixi_nav .header_nav.is-active ul li:hover, {{WRAPPER}} .header.wixi_nav.is-sticky.is-sticky-active .header_nav.is-active ul li:hover' );
        $this->end_controls_tab();
        //  Hover
        $this->end_controls_tabs();
        //  Tabs
        $this->end_controls_section();
        /*****   Mobile Menu   ******/

        /*****   Sticky Header Style   ******/
        $this->start_controls_section( 'sticky_header_style_controls_section',
            [
                'label' => esc_html__( 'Sticky Header Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [ 'sticky'   => 'yes' ]
            ]
        );
        $this->wixi_style_flex_alignment( 'header_sticky_alignment', '{{WRAPPER}} .header.wixi_nav.is-sticky-active .header_inner' );
        $this->wixi_style_slider_height( 'sticky_header_height',array('{{WRAPPER}} .header.wixi_nav.is-sticky-active .header_container' => 'height: {{SIZE}}px!important;'), $min=0, $max=500 );
        $this->wixi_style_padding( 'sticky_header_padding', '{{WRAPPER}} .header.wixi_nav.is-sticky-active .header_container' );
        $this->wixi_style_background( 'sticky_header_background', '{{WRAPPER}} .header.wixi_nav.is-sticky-active .header_container',array('classic','gradient') );
        $this->wixi_style_box_shadow( 'sticky_header_shadow', '{{WRAPPER}} .header.wixi_nav.is-sticky-active .header_container' );
        $this->wixi_style_border( 'sticky_header_border', '{{WRAPPER}} .header.wixi_nav.is-sticky-active .header_container' );
        $this->wixi_style_typo( 'sticky_header_menu_item_typo', '{{WRAPPER}} .header.wixi_nav.is-sticky.is-sticky-active .header_nav:not(.is-active) ul li a' );

        //  Tabs
        $this->start_controls_tabs('sticky_header_menu_item_normal_tabs');
        //  Normal
        $this->start_controls_tab( 'sticky_header_menu_item_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wixi' ) ]
        );
        $this->wixi_style_color( 'sticky_header_menu_item_normal_color', '{{WRAPPER}} .header.wixi_nav.is-sticky.is-sticky-active .header_nav:not(.is-active) ul li a' );
        $this->end_controls_tab();
        //  Normal

        //  Hover
        $this->start_controls_tab('sticky_header_menu_item_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wixi' ) ]
        );
        $this->wixi_style_color( 'sticky_header_menu_item_hover_color', '{{WRAPPER}} .header.wixi_nav.is-sticky.is-sticky-active .header_nav:not(.is-active) ul li:hover a' );
        $this->end_controls_tab();
        //  Hover
        $this->end_controls_tabs();
        //  Tabs
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $id       = $this->get_id();
        $sticky   = 'yes' == $settings['sticky'] ? ' is-sticky' : '';
        $split    = 'yes' == $settings['split'] ? ' is-split' : '';
        $position = $settings['position'] ? ' '.$settings['position'] : '';

        echo '<div id="nav-'.$id.'" class="header wixi_nav'.$sticky.$split.$position.'" data-ntr-custom-header>';
            //echo '<div class="header_holder"></div>';
            echo '<div class="header_container">';
                echo '<div class="header_inner">';
                    echo '<nav class="header_nav wixi_nav">';
                        echo '<a class="header_nav_close" href="#">';
                            echo '<span class="header_nav_close_text">'.esc_html__('Close', 'wixi').'</span>';
                            echo '<span class="header_nav_close_icon icon is-close"><i class="fa fa-times" aria-hidden="true"></i></span>';
                        echo '</a>';
                        echo '<ul class="header_nav_items">';
                        if ('yes' == $settings['usemenu']) {
                                foreach ($settings['menus'] as $item) {
                                    $internal = 'int' == $item['linktype'] ? ' data-ntr-scroll' : '';
                                    if ( $item['name'] ) {
                                        echo '<li class="header_nav_item">';
                                            echo '<a class="header_nav_link" href="'.$item['link']['url'].'"'.$internal.'>'.$item['name'].'</a>';
                                        echo '</li>';
                                    }
                                }
                            } else {
                                echo wp_nav_menu(
                                    array(
                                        'menu' => $settings['register_menus'],
                                        'theme_location' => 'header_menu',
                                        'container' => '', // menu wrapper element
                                        'container_class' => '',
                                        'container_id' => '', // default: none
                                        'menu_class' => '', // ul class
                                        'menu_id' => '', // ul id
                                        'items_wrap' => '%3$s',
                                        'before' => '', // before <a>
                                        'after' => '', // after <a>
                                        'link_before' => '', // inside <a>, before text
                                        'link_after' => '', // inside <a>, after text
                                        'depth' => 4, // '0' to display all depths
                                        'echo' => true,
                                        'fallback_cb' => 'Wixi_Wp_Bootstrap_Navwalker::fallback',
                                        'walker' => new \Wixi_Wp_Bootstrap_Navwalker()
                                    )
                                );
                            }
                            if ('yes' == $settings['add_extra']) {
                                foreach ($settings['extras'] as $item) {
                                    if ( $item['menu_item_content'] ) {
                                        $linktype = 'int' == $item['linktype2'] ? ' data-ntr-scroll' : '';
                                        echo '<li class="header_nav_item">';
                                            echo '<a class="header_nav_link extra_meu_items" href="'.$item['link2']['url'].'"'.$linktype.'>'.$item['menu_item_content'].'</a>';
                                        echo '</li>';
                                    }
                                }
                            }
                        echo '</ul>';
                    echo '</nav>';

                    echo '<div class="header_nav_toggle menu-toggle">';
                        echo '<span class="icon"><i></i><i></i></span>';
                        echo '<span class="text" data-splitting>'. esc_html__( 'Menu', 'wixi' ). '</span>';
                    echo '</div>';

                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}
