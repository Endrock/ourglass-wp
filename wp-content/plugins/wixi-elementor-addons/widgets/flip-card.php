<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Flip_Card extends Widget_Base {
    use Wixi_Helper;
    public function get_name() {
        return 'wixi-flip-card';
    }
    public function get_title() {
        return 'Flip Box (N)';
    }
    public function get_icon() {
        return 'eicon-flip-box';
    }
    public function get_categories() {
        return [ 'wixi' ];
    }
    // Registering Controls
    protected function register_controls() {

        $this->start_controls_section('flip_card_general_settings',
            [
                'label' => esc_html__( 'General Settings', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'flip',
            [
                'label' => esc_html__( 'Flip Rotate', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'flip-left',
                'options' => [
                    'flip-left' => esc_html__( 'flip-left', 'wixi' ),
                    'flip-right' => esc_html__( 'flip-right', 'wixi' ),
                    'flip-up' => esc_html__( 'flip-up', 'wixi' ),
                    'flip-down' => esc_html__( 'flip-down', 'wixi' ),
                ]
            ]
        );
        $this->add_responsive_control( 'minheight',
            [
                'label' => esc_html__( 'Min Height ( px )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 50,
                'max' => 1000,
                'step' => 1,
                'default' => 300,
                'selectors' => ['{{WRAPPER}} .nt-flip-col' => 'height: {{SIZE}}px;min-height: {{SIZE}}px;'],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section('flip_card_front_settings',
            [
                'label' => esc_html__( 'Front Content', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'ficon',
            [
                'label' => esc_html__( 'Icon', 'wixi' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid'
                ]
            ]
        );
        $this->add_control( 'ftitle',
            [
                'label' => esc_html__( 'Title', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'pleaceholder' => esc_html__( 'Enter name or title here', 'wixi' ),
                'default' => 'Alex Smith',
                'label_block' => true,
            ]
        );
        $this->add_control( 'ftag',
            [
                'label' => esc_html__( 'Tag', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => esc_html__( 'h1', 'wixi' ),
                    'h2' => esc_html__( 'h2', 'wixi' ),
                    'h3' => esc_html__( 'h3', 'wixi' ),
                    'h4' => esc_html__( 'h4', 'wixi' ),
                    'h5' => esc_html__( 'h5', 'wixi' ),
                    'h6' => esc_html__( 'h6', 'wixi' ),
                    'div' => esc_html__( 'div', 'wixi' ),
                    'p' => esc_html__( 'p', 'wixi' )
                ]
            ]
        );
        $this->add_control( 'fdesc',
            [
                'label' => esc_html__( 'Short Description', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'pleaceholder' => esc_html__( 'Enter description here', 'wixi' ),
                'default' => 'The Creative Multipurpose WordPress theme.',
                'label_block' => true,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section('flip_card_back_settings',
            [
                'label' => esc_html__( 'Back Content', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'bicon',
            [
                'label' => esc_html__( 'Icon', 'wixi' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid'
                ]
            ]
        );
        $this->add_control( 'btitle',
            [
                'label' => esc_html__( 'Title', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'pleaceholder' => esc_html__( 'Enter name or title here', 'wixi' ),
                'default' => 'Alex Smith',
                'label_block' => true,
            ]
        );
        $this->add_control( 'btag',
            [
                'label' => esc_html__( 'Tag', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => esc_html__( 'h1', 'wixi' ),
                    'h2' => esc_html__( 'h2', 'wixi' ),
                    'h3' => esc_html__( 'h3', 'wixi' ),
                    'h4' => esc_html__( 'h4', 'wixi' ),
                    'h5' => esc_html__( 'h5', 'wixi' ),
                    'h6' => esc_html__( 'h6', 'wixi' ),
                    'div' => esc_html__( 'div', 'wixi' ),
                    'p' => esc_html__( 'p', 'wixi' )
                ]
            ]
        );
        $this->add_control( 'bdesc',
            [
                'label' => esc_html__( 'Short Description', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'pleaceholder' => esc_html__( 'Enter description here', 'wixi' ),
                'default' => 'The Creative Multipurpose WordPress theme.',
                'label_block' => true,
            ]
        );
        $this->add_control( 'btntitle',
            [
                'label' => esc_html__( 'Button Title', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'pleaceholder' => esc_html__( 'Enter title here', 'wixi' ),
                'default' => '',
                'label_block' => true,
            ]
        );
        $this->add_control( 'link',
            [
                'label' => esc_html__( 'Button', 'wixi' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#0',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'Place URL here', 'wixi' )
            ]
        );
        $this->end_controls_section();

        /*****   Style   ******/
        $this->start_controls_section( 'flip_card_front_style_section',
            [
                'label' => esc_html__( 'Front Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'flip_card_front_general_heading',
            [
                'label' => esc_html__( 'GENERAL', 'wixi' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->wixi_style_background( 'flip_card_front_bg','{{WRAPPER}} .nt-flip-front',['classic','gradient'] );
        $this->add_control( 'flip_card_front_overlay_bg',
            [
                'label' => esc_html__( 'BG Image Overlay Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .nt-flip-front:after' => 'background-color: {{VALUE}};']
            ]
        );
        $this->wixi_style_padding( 'flip_card_front_padding','{{WRAPPER}} .nt-flip-front' );
        $this->wixi_style_border( 'flip_card_front_border','{{WRAPPER}} .nt-flip-front' );
        $this->add_responsive_control( 'flip_card_front_vertical_alignment',
            [
                'label' => esc_html__( 'Vertical Alignment', 'wixi' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .nt-flip-front' => 'justify-content: {{VALUE}};'],
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Top', 'wixi' ),
                        'icon' => 'eicon-v-align-top'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'wixi' ),
                        'icon' => 'eicon-v-align-middle'
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'wixi' ),
                        'icon' => 'eicon-v-align-bottom'
                    ]
                ],
                'toggle' => true,
                'default' => ''
            ]
        );
        $this->add_responsive_control( 'flip_card_front_text_alignment',
            [
                'label' => esc_html__( 'Text Alignment', 'wixi' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .nt-flip-front' => 'text-align: {{VALUE}};'],
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'wixi' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'wixi' ),
                        'icon' => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'wixi' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => ''
            ]
        );
        $this->wixi_style_box_shadow( 'flip_card_front_box_shadow', '{{WRAPPER}} .nt-flip-front' );
        $this->add_control( 'flip_card_front_icon_heading',
            [
                'label' => esc_html__( 'ICON', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'flip_card_front_icon_fs',
            [
                'label' => esc_html__( 'Size ( px )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .nt-flip-front .nt-flip-icon' => 'font-size: {{SIZE}}px;'],
            ]
        );
        $this->wixi_style_border( 'flip_card_front_icon_border', '{{WRAPPER}} .nt-flip-icon' );
        $this->wixi_style_padding( 'flip_card_front_icon_padding', '{{WRAPPER}} .nt-flip-icon' );
        $this->wixi_style_margin( 'flip_card_front_icon_margin', '{{WRAPPER}} .nt-flip-icon' );
        $this->add_control( 'flip_card_front_title_heading',
            [
                'label' => esc_html__( 'HEADING', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wixi_style_color( 'flip_card_front_title_color', '{{WRAPPER}} .nt-flip-title' );
        $this->wixi_style_typo( 'flip_card_front_title_typo', '{{WRAPPER}} .nt-flip-title' );
        $this->wixi_style_text_shadow( 'flip_card_front_title_text_shadow', '{{WRAPPER}} .nt-flip-title' );
        $this->wixi_style_border( 'flip_card_front_title_border', '{{WRAPPER}} .nt-flip-title' );
        $this->wixi_style_padding( 'flip_card_front_title_padding', '{{WRAPPER}} .nt-flip-title' );
        $this->wixi_style_margin( 'flip_card_front_title_margin', '{{WRAPPER}} .nt-flip-title' );

        $this->add_control( 'flip_card_front_desc_heading',
            [
                'label' => esc_html__( 'DESCRIPTION', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wixi_style_color( 'flip_card_front_desc_color', '{{WRAPPER}} .nt-flip-desc' );
        $this->wixi_style_typo( 'flip_card_front_desc_typo', '{{WRAPPER}} .nt-flip-desc' );
        $this->wixi_style_text_shadow( 'flip_card_front_desc_text_shadow', '{{WRAPPER}} .nt-flip-desc' );
        $this->wixi_style_border( 'flip_card_front_desc_border', '{{WRAPPER}} .nt-flip-desc' );
        $this->wixi_style_padding( 'flip_card_front_desc_padding', '{{WRAPPER}} .nt-flip-desc' );
        $this->wixi_style_margin( 'flip_card_front_desc_margin', '{{WRAPPER}} .nt-flip-desc' );

        $this->end_controls_section();

        /*****   Style   ******/
        $this->start_controls_section( 'flip_card_back_style_section',
            [
                'label' => esc_html__( 'Back Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'flip_card_back_general_heading',
            [
                'label' => esc_html__( 'GENERAL', 'wixi' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->wixi_style_background( 'flip_card_back_bg','{{WRAPPER}} .nt-flip-back',['classic','gradient'] );
        $this->add_control( 'flip_card_back_overlay_bg',
            [
                'label' => esc_html__( 'BG Image Overlay Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .nt-flip-back:after' => 'background-color: {{VALUE}};']
            ]
        );
        $this->wixi_style_padding( 'flip_card_back_padding','{{WRAPPER}} .nt-flip-back' );
        $this->wixi_style_border( 'flip_card_back_border','{{WRAPPER}} .nt-flip-back' );
        $this->add_responsive_control( 'flip_card_back_vertical_alignment',
            [
                'label' => esc_html__( 'Vertical Alignment', 'wixi' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .nt-flip-back' => 'justify-content: {{VALUE}};'],
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Top', 'wixi' ),
                        'icon' => 'eicon-v-align-top'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'wixi' ),
                        'icon' => 'eicon-v-align-middle'
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'wixi' ),
                        'icon' => 'eicon-v-align-bottom'
                    ]
                ],
                'toggle' => true,
                'default' => ''
            ]
        );
        $this->add_responsive_control( 'flip_card_back_text_alignment',
            [
                'label' => esc_html__( 'Text Alignment', 'wixi' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .nt-flip-back' => 'text-align: {{VALUE}};'],
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'wixi' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'wixi' ),
                        'icon' => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'wixi' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => ''
            ]
        );
        $this->wixi_style_box_shadow( 'flip_card_back_box_shadow', '{{WRAPPER}} .nt-flip-back' );

        $this->add_control( 'flip_card_back_icon_heading',
            [
                'label' => esc_html__( 'ICON', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'flip_card_back_icon_fs',
            [
                'label' => esc_html__( 'Size ( px )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .nt-flip-back .nt-flip-icon' => 'font-size: {{SIZE}}px;'],
            ]
        );
        $this->wixi_style_border( 'flip_card_back_icon_border', '{{WRAPPER}} .nt-flip-icon' );
        $this->wixi_style_padding( 'flip_card_back_icon_padding', '{{WRAPPER}} .nt-flip-icon' );
        $this->wixi_style_margin( 'flip_card_back_icon_margin', '{{WRAPPER}} .nt-flip-icon' );
        $this->add_control( 'flip_card_back_title_heading',
            [
                'label' => esc_html__( 'HEADING', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wixi_style_color( 'flip_card_back_title_color', '{{WRAPPER}} .nt-flip-title' );
        $this->wixi_style_typo( 'flip_card_back_title_typo', '{{WRAPPER}} .nt-flip-title' );
        $this->wixi_style_text_shadow( 'flip_card_back_title_text_shadow', '{{WRAPPER}} .nt-flip-title' );
        $this->wixi_style_border( 'flip_card_back_title_border', '{{WRAPPER}} .nt-flip-title' );
        $this->wixi_style_padding( 'flip_card_back_title_padding', '{{WRAPPER}} .nt-flip-title' );
        $this->wixi_style_margin( 'flip_card_back_title_margin', '{{WRAPPER}} .nt-flip-title' );

        $this->add_control( 'flip_card_back_desc_heading',
            [
                'label' => esc_html__( 'DESCRIPTION', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wixi_style_color( 'flip_card_back_desc_color', '{{WRAPPER}} .nt-flip-desc' );
        $this->wixi_style_typo( 'flip_card_back_desc_typo', '{{WRAPPER}} .nt-flip-desc' );
        $this->wixi_style_text_shadow( 'flip_card_back_desc_text_shadow', '{{WRAPPER}} .nt-flip-desc' );
        $this->wixi_style_border( 'flip_card_back_desc_border', '{{WRAPPER}} .nt-flip-desc' );
        $this->wixi_style_padding( 'flip_card_back_desc_padding', '{{WRAPPER}} .nt-flip-desc' );
        $this->wixi_style_margin( 'flip_card_back_desc_margin', '{{WRAPPER}} .nt-flip-desc' );

        $this->add_control( 'flip_card_back_btn_heading',
            [
                'label' => esc_html__( 'BUTTON', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wixi_style_typo( 'flip_card_back_btn_typo', '{{WRAPPER}} .nt-flip-back .nt-flip-button' );
        $this->wixi_style_padding( 'flip_card_back_btn_padding', '{{WRAPPER}} .nt-flip-back .nt-flip-button' );
        $this->wixi_style_margin( 'flip_card_back_btn_margin', '{{WRAPPER}} .nt-flip-back .nt-flip-button' );

        $this->start_controls_tabs('flip_card_back_btn_tabs');
        $this->start_controls_tab( 'flip_card_back_btn_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wixi' ) ]
        );
        $this->wixi_style_background( 'flip_card_btn_back_bg', '{{WRAPPER}} .nt-flip-back .nt-flip-button', ['classic','gradient'] );
        $this->wixi_style_color( 'flip_card_back_btn_color', '{{WRAPPER}} .nt-flip-back .nt-flip-button' );
        $this->wixi_style_border( 'flip_card_back_btn_border', '{{WRAPPER}} .nt-flip-back .nt-flip-button' );
        $this->end_controls_tab();
        $this->start_controls_tab('flip_card_back_btn_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wixi' ) ]
        );
        $this->wixi_style_background( 'flip_card_back_hvrbg', '{{WRAPPER}} .nt-flip-back .nt-flip-button:hover', ['classic','gradient'] );
        $this->wixi_style_color( 'flip_card_back_btn_hvrcolor', '{{WRAPPER}} .nt-flip-back .nt-flip-button:hover' );
        $this->wixi_style_border( 'flip_card_back_btn_hvrborder', '{{WRAPPER}} .nt-flip-back .nt-flip-button:hover' );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section('flip_card_back_extra_settings',
            [
                'label' => esc_html__( 'Back Extra', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'use_icons',
            [
                'label' => esc_html__( 'Add Social Icons?', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'social',
            [
                'name' => 'social',
                'label' => esc_html__( 'Icon', 'awam' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-wordpress',
                    'library' => 'fa-brands'
                ]
            ]
        );
        $repeater->add_control( 'link',
            [
                'label' => esc_html__( 'Link', 'awam' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'Place URL here', 'awam' )
            ]
        );
        $this->add_control( 'socials',
            [
                'label' => esc_html__( 'Socials', 'awam' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<i class="{{social.value}}"></i>',
                'default' => [
                    [
                        'social' => [
                            'value' => 'fab fa-facebook',
                            'library' => 'fa-brands'
                        ]
                    ],
                    [
                        'social' => [
                            'value' => 'fab fa-twitter',
                            'library' => 'fa-brands'
                        ]
                    ],
                    [
                        'social' => [
                            'value' => 'fab fa-instagram',
                            'library' => 'fa-brands'
                        ]
                    ]
                ],
                'condition' => ['use_icons' => 'yes']
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section('wixi_flip_card_back_extra_style',
            [
                'label' => esc_html__( 'Back Extra Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['use_icons' => 'yes']
            ]
        );
        $this->add_responsive_control( 'flip_card_back_extra_icon_fs',
            [
                'label' => esc_html__( 'Size ( px )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .nt-flip-back .nt-flip-social-link' => 'font-size: {{SIZE}}px;'],
            ]
        );
        $this->wixi_style_padding( 'flip_card_back_extra_btn_padding', '{{WRAPPER}} .nt-flip-back .nt-flip-social-link' );
        $this->wixi_style_margin( 'flip_card_back_extra_btn_margin', '{{WRAPPER}} .nt-flip-back .nt-flip-social-link' );
        $this->start_controls_tabs('flip_card_back_extra_tabs');
        $this->start_controls_tab( 'flip_card_back_extra_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wixi' ) ]
        );
        $this->wixi_style_background( 'flip_card_back_extra_btn_bg', '{{WRAPPER}} .nt-flip-back .nt-flip-social-link', ['classic','gradient'] );
        $this->wixi_style_color( 'flip_card_back_extra_btn_color', '{{WRAPPER}} .nt-flip-back .nt-flip-social-link' );
        $this->wixi_style_border( 'flip_card_back_extra_btn_border', '{{WRAPPER}} .nt-flip-back .nt-flip-social-link' );
        $this->end_controls_tab();
        $this->start_controls_tab('flip_card_back_extra_btn_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wixi' ) ]
        );
        $this->wixi_style_background( 'flip_card_back_extra_btn_hvrbg', '{{WRAPPER}} .nt-flip-back .nt-flip-social-link:hover', ['classic','gradient'] );
        $this->wixi_style_color( 'flip_card_back_extra_btn_hvrcolor', '{{WRAPPER}} .nt-flip-back .nt-flip-social-link:hover' );
        $this->wixi_style_border( 'flip_card_back_extra_btn_hvrborder', '{{WRAPPER}} .nt-flip-back .nt-flip-social-link:hover' );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   Style   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<div class="nt-flip-col '.$settings['flip'].'" >';
            echo '<div class="nt-flip-container">';
                echo '<div class="nt-flip-front">';
                    echo '<div class="nt-flip-inner">';
                        if ( ! empty($settings['ficon']['value']) ) {
                            echo '<span class="nt-flip-icon">';
                                Icons_Manager::render_icon( $settings['ficon'], [ 'aria-hidden' => 'true' ] );
                            echo '</span>';
                        }
                        if ( $settings['ftitle'] ) {
                            echo '<'.$settings['ftag'].' class="nt-flip-title">'.$settings['ftitle'].'</'.$settings['ftag'].'>';
                        }
                        if ( $settings['fdesc'] ) {
                            echo '<p class="nt-flip-desc">'.$settings['fdesc'].'</p>';
                        }
                    echo '</div>';
                echo '</div>';
                echo '<div class="nt-flip-back">';
                    echo '<div class="nt-flip-inner">';
                        if ( ! empty($settings['bicon']['value']) ) {
                            echo '<span class="nt-flip-icon">';
                                Icons_Manager::render_icon( $settings['bicon'], [ 'aria-hidden' => 'true' ] );
                            echo '</span>';
                        }
                        if ( $settings['btitle'] ) {
                            echo '<'.$settings['btag'].' class="nt-flip-title">'.$settings['btitle'].'</'.$settings['btag'].'>';
                        }
                        if ( $settings['bdesc'] ) {
                            echo '<p class="nt-flip-desc">'.$settings['bdesc'].'</p>';
                        }
                        if ( $settings['btntitle'] ) {
                            $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
                            echo '<a class="nt-flip-button" href="'.esc_attr( $settings['link']['url'] ).'"'.$target.'>'.$settings['btntitle'].'</a>';
                        }
                        if ( 'yes' == $settings['use_icons'] ) {
                            echo '<ul class="nt-flip-socials">';
                                foreach ( $settings['socials'] as $item ) {
                                    $target = $item['link']['is_external'] ? ' target="_blank"' : '';
                                    echo '<li><a class="nt-flip-social-link" href="'.esc_attr( $item['link']['url'] ).'"'.$target.'>';
                                        if ( ! empty($item['social']['value']) ) {
                                            Icons_Manager::render_icon( $item['social'], [ 'aria-hidden' => 'true' ] );
                                        }
                                    echo '</a></li>';
                                }
                            echo '</ul>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}
