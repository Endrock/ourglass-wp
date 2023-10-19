<?php

if( !defined( 'ABSPATH' ) ) exit;

use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Element_Base;
use Elementor\Elementor_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Responsive\Responsive;
use Elementor\Widget_Base;
use Elementor\Group_Control_Background;

class Wixi_Section_Parallax {

    private static $instance = null;

    public function __construct(){
        // section register settings
        add_action('elementor/element/section/section_structure/after_section_end',array($this,'section_locomotive_controls'), 10 );
        add_action('elementor/element/section/section_structure/after_section_end',array($this,'section_parallax_controls'), 10 );
        add_action('elementor/element/section/section_structure/after_section_end',array($this,'wixi_add_particle_effect_to_section'), 10 );
        add_action('elementor/element/section/section_structure/after_section_end',array($this,'wixi_add_vegas_slider_to_section'), 10 );
        add_action('elementor/element/section/section_layout/before_section_end',array($this,'register_change_section_indent_structure'), 10 );
        add_action('elementor/element/section/section_background/before_section_end',array($this,'register_add_section_background_size'), 10 );
        add_action('elementor/element/section/section_background_overlay/before_section_end',array($this,'register_add_section_overlay_width'), 10 );
        add_action('elementor/frontend/section/before_render',array($this,'wixi_custom_attr_to_section'), 10);
        add_action('elementor/frontend/column/before_render',array($this,'wixi_custom_attr_to_column'), 10);

        // column register settings and before render column functions
        add_action('elementor/element/column/layout/before_section_end',array($this,'wixi_custom_height_to_column'), 10);
        add_action('elementor/element/column/layout/after_section_end',array($this,'register_change_column_width'), 10 );
    }
    /*****   START PARALLAX CONTROLS   ******/
    public function section_locomotive_controls( $element ) {
        $template = basename( get_page_template() );

        if ( $template == 'locomotive-page.php' ) {
            $element->start_controls_section( 'wixi_locomotive_section',
                [
                    'label' => esc_html__( 'Wixi Locomotive', 'wixi' ),
                    'tab' => Controls_Manager::TAB_LAYOUT
                ]
            );
            $element->add_control( 'wixi_locomotive_switcher',
                [
                    'label' => esc_html__( 'Inner Section Locomotive Effect', 'wixi' ),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );
            $element->add_control( 'wixi_locomotive_speed',
                [
                    'label' => esc_html__( 'Speed', 'wixi' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => -10,
                    'max' => 10,
                    'step' => 0.1,
                    'default' => '',
                    'description' => esc_html__( 'Element parallax speed. A negative value will reverse the direction.', 'wixi' ),
                    'condition' => ['wixi_locomotive_switcher' => 'yes']
                ]
            );
            $element->add_control( 'wixi_locomotive_delay',
                [
                    'label' => esc_html__( 'Lerp Delay', 'wixi' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 10,
                    'step' => 0.1,
                    'default' => '',
                    'description' => esc_html__( 'Element parallax lerp delay.', 'wixi' ),
                    'condition' => ['wixi_locomotive_switcher' => 'yes']
                ]
            );
            $element->add_control( 'wixi_locomotive_direction',
                [
                    'label' => esc_html__( 'Direction', 'wixi' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'vertical',
                    'options' => [
                        'vertical' => esc_html__( 'Vertical', 'wixi' ),
                        'horizontal' => esc_html__( 'Horizontal', 'wixi' ),
                    ],
                    'condition' => [ 'wixi_locomotive_switcher' => 'yes' ],
                ]
            );
            $element->add_control( 'wixi_locomotive_entrance_animation',
                [
                    'label' => esc_html__( 'Entrance Animation', 'wixi' ),
                    'type' => Controls_Manager::ANIMATION,
                    'separator' => 'before',
                    'condition' => ['wixi_locomotive_switcher' => 'yes']
                ]
            );
            $element->add_control( 'wixi_locomotive_entrance_animation_repeat',
                [
                    'label' => esc_html__( 'Entrance Animation Repeat', 'wixi' ),
                    'type' => Controls_Manager::SWITCHER,
                    'condition' => ['wixi_locomotive_switcher' => 'yes']
                ]
            );
            $element->add_control( 'wixi_locomotive_fixedbg',
                [
                    'label' => esc_html__( 'Fullscreen Fixed BG', 'wixi' ),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );
            $element->end_controls_section();
        }
    }

    /*****   START PARALLAX CONTROLS   ******/
    public function section_parallax_controls( $element ) {

        $template = basename( get_page_template() );
        if ( $template != 'locomotive-page.php' ) {

            $element->start_controls_section( 'wixi_parallax_section',
                [
                    'label'        => esc_html__( 'Wixi Parallax', 'wixi' ),
                    'tab'          => Controls_Manager::TAB_LAYOUT
                ]
            );
            $element->add_control( 'wixi_parallax_switcher',
                [
                    'label'        => esc_html__( 'Enable Parallax', 'wixi' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'prefix_class' => 'wixi-parallax jarallax parallax-',
                ]
            );
            $element->add_control( 'wixi_parallax_update',
                [
                    'label'       => '<div class="elementor-update-preview" style="background-color: #fff;display: block;"><div class="elementor-update-preview-button-wrapper" style="display:block;"><button class="elementor-update-preview-button elementor-button elementor-button-success" style="background: #d30c5c; margin: 0 auto; display:block;">Apply Changes</button></div><div class="elementor-update-preview-title" style="display:block;text-align:center;margin-top: 10px;">Update changes to pages</div></div>',
                    'type'        => Controls_Manager::RAW_HTML,
                    'condition'   => ['wixi_parallax_switcher' => 'yes'],
                ]
            );
            $element->add_control( 'wixi_parallax_type',
                [
                    'label'       => esc_html__( 'Type', 'wixi' ),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => 'true',
                    'condition'   => ['wixi_parallax_switcher' => 'yes'],
                    'default'     => 'scroll',
                    'options'     => [
                        'scroll'         => esc_html__( 'Scroll', 'wixi' ),
                        'scroll-opacity' => esc_html__( 'Scroll with Opacity', 'wixi' ),
                        'opacity'        => esc_html__( 'Fade', 'wixi' ),
                        'scale'          => esc_html__( 'Zoom', 'wixi' ),
                        'scale-opacity'  => esc_html__( 'Zoom with Fade', 'wixi' )
                    ]
                ]
            );
            $element->add_control( 'wixi_parallax_bg_size',
                [
                    'label'       => esc_html__( 'Image Size', 'wixi' ),
                    'type'        => Controls_Manager::SELECT,
                    'default'     => 'auto',
                    'condition'   => ['wixi_parallax_switcher' => 'yes'],
                    'options'     => [
                        'auto'        => esc_html__( 'Auto', 'wixi' ),
                        'cover'       => esc_html__( 'Cover', 'wixi' ),
                        'contain'     => esc_html__( 'Contain', 'wixi' )
                    ]
                ]
            );
            $element->add_control( 'wixi_parallax_speed',
                [
                    'label'      => esc_html__( 'Parallax Speed', 'wixi' ),
                    'type'       => Controls_Manager::NUMBER,
                    'min'        => -1,
                    'max'        => 2,
                    'step'       => 0.1,
                    'default'    => 0.2,
                    'condition'  => ['wixi_parallax_switcher' => 'yes']
                ]
            );
            $element->add_control( 'wixi_parallax_mobile_support',
                [
                    'label'      => esc_html__( 'Parallax on Mobile Devices', 'wixi' ),
                    'type'       => Controls_Manager::SWITCHER,
                    'prefix_class' => 'wixi-mobile-parallax-',
                    'condition'  => ['wixi_parallax_switcher' => 'yes']
                ]
            );
            $element->add_control( 'wixi_add_parallax_video',
                [
                    'label' => esc_html__( 'Use Background Video', 'wixi' ),
                    'type' => Controls_Manager::SWITCHER,
                    'prefix_class' => 'wixi-parallax-video-',
                    'condition'  => ['wixi_parallax_switcher' => 'yes']
                ]
            );
            $element->add_control( 'wixi_local_video_format',
                [
                    'label' => esc_html__( 'Video Format', 'wixi' ),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => 'true',
                    'default' => 'external',
                    'options' => [
                        'external' => esc_html__( 'External (Youtube,Vimeo)', 'wixi' ),
                        'mp4' => esc_html__( 'Local MP4', 'wixi' ),
                        'webm' => esc_html__( 'Local Webm', 'wixi' ),
                        'ogv' => esc_html__( 'Local Ogv', 'wixi' ),
                    ],
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'wixi_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'wixi_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->add_control( 'wixi_parallax_video_url',
                [
                    'label' => esc_html__( 'Video URL', 'wixi' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'placeholder' => 'https://www.youtube.com/watch?v=AeeE6PyU-dQ',
                    'description' => esc_html__( 'YouTube/Vimeo link, or link to video file (mp4 is recommended).', 'wixi' ),
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'wixi_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'wixi_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->add_control( 'wixi_parallax_video_start_time',
                [
                    'label' => esc_html__( 'Start Time', 'wixi' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'placeholder' => '10',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'wixi_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'wixi_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->add_control( 'wixi_parallax_video_end_time',
                [
                    'label' => esc_html__( 'End Time', 'wixi' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'placeholder' => '70',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'wixi_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'wixi_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->add_control( 'wixi_parallax_video_volume',
                [
                    'label' => esc_html__( 'Video Volume', 'wixi' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                    'default' => '',
                    'placeholder' => '0',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'wixi_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'wixi_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->add_control( 'wixi_parallax_video_play_once',
                [
                    'label' => esc_html__( 'Play Once', 'wixi' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'wixi' ),
                    'label_off' => esc_html__( 'No', 'wixi' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'wixi_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'wixi_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->end_controls_section();
        }
    }
    /*****   START COLUMN CONTROLS   ******/
    public function wixi_custom_height_to_column( $element ) {
        $element->add_responsive_control( 'wixi_column_custom_height',
            [
                'label' => esc_html__( 'Wixi Column Min Height', 'wixi' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
                'default' => [''],
                'selectors' => ['{{WRAPPER}}' => 'min-height: {{SIZE}}{{UNIT}};'],
            ]
        );
    }
    /*****   START COLUMN CONTROLS   ******/
    public function register_change_column_width( $element ) {
        $element->start_controls_section( 'wixi_tilt_effect_section',
            [
                'label' => esc_html__( 'Wixi Tilt Effect', 'wixi' ),
                'tab' => Controls_Manager::TAB_LAYOUT,
            ]
        );
        $element->add_control( 'wixi_tilt_effect_switcher',
            [
                'label' => esc_html__( 'Enable Tilt Effect', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'You can use this option if you want to use tilt effect for the elementor heading and image in the column when the mouse is over the column.', 'wixi' ),
            ]
        );
        $element->add_control( 'wixi_tilt_effect_maxtilt',
            [
                'label' => esc_html__( 'Max Tilt', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 500,
                'step' => 1,
                'default' => 20,
                'condition' => ['wixi_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'wixi_tilt_effect_perspective',
            [
                'label' => esc_html__( 'Perspective', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10000,
                'step' => 100,
                'default' => 1000,
                'description' => esc_html__( 'Transform perspective, the lower the more extreme the tilt gets.', 'wixi' ),
                'condition' => ['wixi_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'wixi_tilt_effect_easing',
            [
                'label' => esc_html__( 'Custom Easing', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'cubic-bezier(.03,.98,.52,.99)',
                'label_block' => true,
                'condition' => ['wixi_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'wixi_tilt_effect_scale',
            [
                'label' => esc_html__( 'Scale', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 1,
                'description' => esc_html__( '2 = 200%, 1.5 = 150%, etc..', 'wixi' ),
                'condition' => ['wixi_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'wixi_tilt_effect_speed',
            [
                'label' => esc_html__( 'Speed', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 10,
                'default' => 300,
                'description' => esc_html__( 'Speed of the enter/exit transition.', 'wixi' ),
                'condition' => ['wixi_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'wixi_tilt_effect_transition',
            [
                'label' => esc_html__( 'Transition', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'Set a transition on enter/exit.', 'wixi' ),
                'condition' => ['wixi_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'wixi_tilt_effect_disableaxis',
            [
                'label' => esc_html__( 'Disable Axis', 'wixi' ),
                'description' => esc_html__( 'What axis should be disabled. Can be X or Y.', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'None', 'wixi' ),
                    'vertical' => esc_html__( 'X Axis', 'wixi' ),
                    'horizontal' => esc_html__( 'Y Axis', 'wixi' ),
                ],
                'condition' => [ 'wixi_tilt_effect_switcher' => 'yes' ],
            ]
        );
        $element->add_control( 'wixi_tilt_effect_reset',
            [
                'label' => esc_html__( 'Reset', 'wixi' ),
                'description' => esc_html__( 'If the tilt effect has to be reset on exit.', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['wixi_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'wixi_tilt_effect_glare',
            [
                'label' => esc_html__( 'Glare Effect', 'wixi' ),
                'description' => esc_html__( 'Enables glare effect', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['wixi_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'wixi_tilt_effect_maxglare',
            [
                'label' => esc_html__( 'Max Glare', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => 1,
                'description' => esc_html__( 'From 0 - 1.', 'wixi' ),
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'wixi_tilt_effect_switcher',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'wixi_tilt_effect_glare',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );
        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'wixi_tilt_effect_glareclr',
                'label' => esc_html__( 'Background', 'wixi' ),
                'types' => ['gradient'],
                'selector' => '{{WRAPPER}} .js-tilt-glare-inner',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'wixi_tilt_effect_switcher',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'wixi_tilt_effect_glare',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'wixi_tilt_effect_parallax',
            [
                'label' => esc_html__( 'Parallax Effect', 'wixi' ),
                'description' => esc_html__( 'Enables parallax effect', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['wixi_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'wixi_tilt_effect_parallax_depth',
            [
                'label' => esc_html__( 'Parallax Depth', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 20,
                'selectors' => ['{{WRAPPER}}[data-tilt-parallax="true"] .elementor-widget-wrap > div' => 'transform: translateZ({{SIZE}}px)'],
                'description' => esc_html__( 'From 0 - 100', 'wixi' ),
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'wixi_tilt_effect_switcher',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'wixi_tilt_effect_parallax',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );
        $element->end_controls_section();
    }
    /*****   END COLUMN CONTROLS   ******/

    /*****   START CONTROLS SECTION   ******/
    public function register_change_section_indent_structure( $element ) {
        $element->add_control( 'wixi_make_fixed_section_switcher',
            [
                'label' => esc_html__( 'Make Fixed On Scroll', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'prefix_class' => 'wixi-section-fixed-',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'html_tag',
                            'operator' => '==',
                            'value' => 'nav'
                        ],
                        [
                            'name' => 'html_tag',
                            'operator' => '=',
                            'value' => 'header'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'wixi_fixed_section_bgcolor',
            [
                'label' => esc_html__( 'On Scroll BG Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    'body .section-fixed-active{{WRAPPER}}' => 'background-color:{{VALUE}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'html_tag',
                            'operator' => '==',
                            'value' => 'nav'
                        ],
                        [
                            'name' => 'html_tag',
                            'operator' => '=',
                            'value' => 'header'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'wixi_fixed_section_heading_color',
            [
                'label' => esc_html__( 'On Scroll Text Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    'body .section-fixed-active{{WRAPPER}} .elementor-widget-wrap .elementor-element .elementor-widget-container .elementor-heading-title' => 'color:{{VALUE}};',
                    'body .section-fixed-active{{WRAPPER}} .elementor-widget-wrap .elementor-element .elementor-widget-container .elementor-icon' => 'color:{{VALUE}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'html_tag',
                            'operator' => '==',
                            'value' => 'nav'
                        ],
                        [
                            'name' => 'html_tag',
                            'operator' => '=',
                            'value' => 'header'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'wixi_fixed_section_link_color',
            [
                'label' => esc_html__( 'On Scroll Link Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    'body .section-fixed-active{{WRAPPER}} .elementor-widget-wrap .elementor-element .elementor-widget-container a' => 'color: {{VALUE}} !important;',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'html_tag',
                            'operator' => '==',
                            'value' => 'nav'
                        ],
                        [
                            'name' => 'html_tag',
                            'operator' => '=',
                            'value' => 'header'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'wixi_fixed_section_link_hvrcolor',
            [
                'label' => esc_html__( 'On Scroll Link Hover', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    'body .section-fixed-active{{WRAPPER}} .elementor-widget-wrap .elementor-element .elementor-widget-container a:hover' => 'color: {{VALUE}} !important;',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'html_tag',
                            'operator' => '==',
                            'value' => 'nav'
                        ],
                        [
                            'name' => 'html_tag',
                            'operator' => '=',
                            'value' => 'header'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'wixi_section_indent',
            [
                'label' => esc_html__( 'Section Indent', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'label_block'  => 'true',
                'default' => '',
                'prefix_class' => 'nt-section ',
                'separator' => 'before',
                'options' => [
                    '' => esc_html__( 'Default', 'wixi' ),
                    'section-padding' => esc_html__( 'Indent Top and Bottom', 'wixi' ),
                    'section-padding pt-0' => esc_html__( 'Indent Bottom No Top', 'wixi' ),
                    'section-padding pb-0' => esc_html__( 'Indent Top No Bottom', 'wixi' ),
                ]
            ]
        );
    }

    /*****   START CONTROLS SECTION   ******/
    public function register_add_section_background_size( $element ) {
        $element->add_responsive_control( 'wixi_section_background_size',
            [
                'label' => esc_html__( 'Wixi Background Size ( X-Y)', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'default' =>'',
                'placeholder' => '30px 100%',
                'label_block' => true,
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}}' => 'background-size: {{VALUE}};' ]
            ]
        );
    }
    /*****   END COLUMN CONTROLS   ******/

    /*****   START CONTROLS SECTION   ******/
    public function register_add_section_overlay_width( $element )
    {
        $element->add_responsive_control( 'wixi_section_overlay_width',
            [
                'label' => esc_html__( 'Wixi Overlay Width', 'wixi' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 4000,
                        'step' => 5
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-background-overlay' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator'     => 'before'
            ]
        );

        $element->add_responsive_control( 'wixi_section_overlay_height',
            [
                'label' => esc_html__( 'Wixi Overlay Height', 'wixi' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 4000,
                        'step' => 5
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-background-overlay' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator'     => 'before'
            ]
        );
    }

    // Registering Controls
    public function wixi_add_particle_effect_to_section( $element ) {
        $element->start_controls_section('wixi_particles_settings',
            [
                'label' => esc_html__( 'Wixi Particles Effect', 'wixi' ),
                'tab' => Controls_Manager::TAB_LAYOUT,
            ]
        );
        $element->add_control( 'wixi_particles_type',
            [
                'label' => esc_html__( 'Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__( 'None', 'wixi' ),
                    'default' => esc_html__( 'default', 'wixi' ),
                    'nasa' => esc_html__( 'nasa', 'wixi' ),
                    'bubble' => esc_html__( 'bubble', 'wixi' ),
                    'snow' => esc_html__( 'snow', 'wixi' ),
                ]
            ]
        );
        $element->add_control( 'wixi_particles_options_heading',
            [
                'label' => esc_html__( 'Particles Options', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'  => ['wixi_particles_type!' => 'none']
            ]
        );

        $element->add_control( 'wixi_particles_shape',
            [
                'label' => esc_html__( 'Shape Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'circle',
                'options' => [
                    'circle' => esc_html__( 'circle', 'wixi' ),
                    'edge' => esc_html__( 'edge', 'wixi' ),
                    'triangle' => esc_html__( 'triangle', 'wixi' ),
                    'polygon' => esc_html__( 'polygon', 'wixi' ),
                    'star' => esc_html__( 'star', 'wixi' ),
                ],
                'condition'  => ['wixi_particles_type!' => 'none']
            ]
        );
        $element->add_control( 'wixi_particles_number',
            [
                'label' => esc_html__( 'Number', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 60,
                'condition'  => ['wixi_particles_type!' => 'none']
            ]
        );
        $element->add_control( 'wixi_particles_color',
            [
                'label' => esc_html__( 'Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'condition'  => ['wixi_particles_type!' => 'none']
            ]
        );
        $element->add_control( 'wixi_particles_opacity',
            [
                'label' => esc_html__( 'Opacity', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0.1,
                'max' => 1,
                'step' => 0.1,
                'default' => 0.4,
                'condition'  => ['wixi_particles_type!' => 'none']
            ]
        );
        $element->add_control( 'wixi_particles_size',
            [
                'label' => esc_html__( 'Size', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'step' => 1,
                'default' => 6,
                'condition'  => ['wixi_particles_type!' => 'none']
            ]
        );
        $element->end_controls_section();
    }

    // Registering Controls
    public function wixi_add_vegas_slider_to_section( $element ) {
        $element->start_controls_section('wixi_vegas_settings',
            [
                'label' => esc_html__( 'Wixi Vegas Slider', 'wixi' ),
                'tab' => Controls_Manager::TAB_LAYOUT,
            ]
        );
        $element->add_control( 'wixi_vegas_switcher',
            [
                'label'        => esc_html__( 'Enable Background Slider', 'wixi' ),
                'type'         => Controls_Manager::SWITCHER,
            ]
        );
        $element->add_control( 'wixi_vegas_images',
            [
                'label' => __( 'Add Images', 'wixi' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
                'condition'  => ['wixi_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'wixi_vegas_options_heading',
            [
                'label' => esc_html__( 'Slider Options', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'  => ['wixi_vegas_images!' => '']
            ]
        );
        $element->add_control( 'wixi_vegas_animation_type',
            [
                'label' => esc_html__( 'Animation Type', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => ['kenburns'],
                'options' => [
                    'kenburns' => esc_html__( 'kenburns', 'wixi' ),
                    'kenburnsUp' => esc_html__( 'kenburnsUp', 'wixi' ),
                    'kenburnsDown' => esc_html__( 'kenburnsDown', 'wixi' ),
                    'kenburnsLeft' => esc_html__( 'kenburnsLeft', 'wixi' ),
                    'kenburnsRight' => esc_html__( 'kenburnsRight', 'wixi' ),
                    'kenburnsUpLeft' => esc_html__( 'kenburnsUpLeft', 'wixi' ),
                    'kenburnsUpRight' => esc_html__( 'kenburnsUpRight', 'wixi' ),
                    'kenburnsDownLeft' => esc_html__( 'kenburnsDownLeft', 'wixi' ),
                    'kenburnsDownRight' => esc_html__( 'kenburnsDownRight', 'wixi' ),
                ],
                'condition'  => ['wixi_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'wixi_vegas_transition_type',
            [
                'label' => esc_html__( 'Transition Type', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => ['zoomIn','slideLeft','slideRight'],
                'options' => [
                    'fade' => esc_html__( 'fade', 'wixi' ),
                    'fade2' => esc_html__( 'fade2', 'wixi' ),
                    'slideLeft' => esc_html__( 'slideLeft', 'wixi' ),
                    'slideLeft2' => esc_html__( 'slideLeft2', 'wixi' ),
                    'slideRight' => esc_html__( 'slideRight', 'wixi' ),
                    'slideRight2' => esc_html__( 'slideRight2', 'wixi' ),
                    'slideUp' => esc_html__( 'slideUp', 'wixi' ),
                    'slideUp2' => esc_html__( 'slideUp2', 'wixi' ),
                    'slideDown' => esc_html__( 'slideDown', 'wixi' ),
                    'slideDown2' => esc_html__( 'slideDown2', 'wixi' ),
                    'zoomIn' => esc_html__( 'zoomIn', 'wixi' ),
                    'zoomIn2' => esc_html__( 'zoomIn2', 'wixi' ),
                    'zoomOut' => esc_html__( 'zoomOut', 'wixi' ),
                    'zoomOut2' => esc_html__( 'zoomOut2', 'wixi' ),
                    'swirlLeft' => esc_html__( 'swirlLeft', 'wixi' ),
                    'swirlLeft2' => esc_html__( 'swirlLeft2', 'wixi' ),
                    'swirlRight' => esc_html__( 'swirlRight', 'wixi' ),
                    'swirlRight2' => esc_html__( 'swirlRight2', 'wixi' ),
                    'burn' => esc_html__( 'burn', 'wixi' ),
                    'burn2' => esc_html__( 'burn2', 'wixi' ),
                    'blur' => esc_html__( 'blur', 'wixi' ),
                    'blur2' => esc_html__( 'blur2', 'wixi' ),
                    'flash' => esc_html__( 'flash', 'wixi' ),
                    'flash2' => esc_html__( 'flash2', 'wixi' ),
                ],
                'condition'  => ['wixi_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'wixi_vegas_overlay_type',
            [
                'label' => esc_html__( 'Overlay Image Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'prefix_class' => 'wixi-vegas-overlay vegas-overlay-',
                'options' => [
                    'none' => esc_html__( 'None', 'wixi' ),
                    '01' => esc_html__( 'Overlay 1', 'wixi' ),
                    '02' => esc_html__( 'Overlay 2', 'wixi' ),
                    '03' => esc_html__( 'Overlay 3', 'wixi' ),
                    '04' => esc_html__( 'Overlay 4', 'wixi' ),
                    '05' => esc_html__( 'Overlay 5', 'wixi' ),
                    '06' => esc_html__( 'Overlay 6', 'wixi' ),
                    '07' => esc_html__( 'Overlay 7', 'wixi' ),
                    '08' => esc_html__( 'Overlay 8', 'wixi' ),
                    '09' => esc_html__( 'Overlay 9', 'wixi' ),
                ],
                'condition'  => ['wixi_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'wixi_vegas_delay',
            [
                'label' => esc_html__( 'Delay', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 7000,
                'condition'  => ['wixi_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'wixi_vegas_duration',
            [
                'label' => esc_html__( 'Transition Duration', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2000,
                'condition'  => ['wixi_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'wixi_vegas_shuffle',
            [
                'label' => esc_html__( 'Enable Shuffle', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'condition'  => ['wixi_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'wixi_vegas_timer',
            [
                'label' => esc_html__( 'Enable Timer', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'condition'  => ['wixi_vegas_switcher' => 'yes'],
                'selectors'  => ['{{WRAPPER}} .vegas-timer' => 'display:block!important;'],
            ]
        );
        $element->add_control( 'wixi_vegas_timer_size',
            [
                'label' => esc_html__( 'Timer Height', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 5,
                'selectors'  => ['{{WRAPPER}} .vegas-timer' => 'height:{{VALUE}};'],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'wixi_vegas_switcher',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'wixi_vegas_timer',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'wixi_vegas_timer_color',
            [
                'label' => esc_html__( 'Timer Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors'  => ['{{WRAPPER}} .vegas-timer-progress' => 'background-color:{{VALUE}};'],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'wixi_vegas_switcher',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'wixi_vegas_timer',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );
        $element->end_controls_section();
    }

    public function wixi_custom_attr_to_column( $element ) {
        $data     = $element->get_data();
        $type     = $data['elType'];
        $settings = $data['settings'];
        $isInner  = $data['isInner'];// inner section

        if ( 'column' === $element->get_name() && 'yes' === $element->get_settings('wixi_tilt_effect_switcher') ) {
            $transition = 'yes' === $element->get_settings('wixi_tilt_effect_transition') ? 'true' : 'false';
            $reset = 'yes' === $element->get_settings('wixi_tilt_effect_reset') ? 'true' : 'false';
            $glare = 'yes' === $element->get_settings('wixi_tilt_effect_glare') ? 'true' : 'false';
            $parallax = 'yes' === $element->get_settings('wixi_tilt_effect_parallax') ? 'true' : 'false';
            $element->add_render_attribute( '_wrapper', 'data-tilt', '' );
            $element->add_render_attribute( '_wrapper', 'data-tilt-max', $element->get_settings('wixi_tilt_effect_maxtilt') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-perspective', $element->get_settings('wixi_tilt_effect_perspective') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-easing', $element->get_settings('wixi_tilt_effect_easing') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-scale', $element->get_settings('wixi_tilt_effect_scale') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-speed', $element->get_settings('wixi_tilt_effect_speed') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-disableaxis', $element->get_settings('wixi_tilt_effect_disableaxis') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-maxglare', $element->get_settings('wixi_tilt_effect_maxglare') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-transition', $transition );
            $element->add_render_attribute( '_wrapper', 'data-tilt-reset', 'true' );
            $element->add_render_attribute( '_wrapper', 'data-tilt-glare', $glare );
            $element->add_render_attribute( '_wrapper', 'data-tilt-parallax', $parallax );
            wp_enqueue_script( 'tilt' );
        }
    }

    public function wixi_custom_attr_to_section( $element ) {
        $data     = $element->get_data();
        $type     = $data['elType'];
        $settings = $data['settings'];
        $isInner  = $data['isInner'];// inner section

        $template = basename( get_page_template() );

        if( 'section' === $element->get_name() ) {

            $element->add_render_attribute( 'wrapper', 'class', $element->get_settings('wixi_section_indent') );
            $element->add_render_attribute( 'wrapper', 'class', $element->get_settings('wixi_section_outdent') );

            if( '0' !== $element->get_settings('wixi_section_column_structure_switcher') ) {
                $element->add_render_attribute( 'wrapper', 'class', $element->get_settings('wixi_section_change_column_structure') );
            }

            // Particles Effect Options
            if( 'none' !== $element->get_settings('wixi_particles_type') ) {

                $color = $element->get_settings('wixi_particles_color');
                $type = $element->get_settings('wixi_particles_type');
                $shape = $element->get_settings('wixi_particles_shape');
                $number = $element->get_settings('wixi_particles_number');
                $opacity = $element->get_settings('wixi_particles_opacity');
                $size = $element->get_settings('wixi_particles_size');
                $size = $size ? $size : 100;

                $element->add_render_attribute( '_wrapper', 'class', 'wixi-particles' );
                $element->add_render_attribute( '_wrapper', 'data-particles-settings', '{"type":"'.$type.'","color":"'.$color.'","shape":"'.$shape.'","number":'.$number.',"opacity":'.$opacity.',"size":'.$size.'}' );
                $element->add_render_attribute( '_wrapper', 'data-particles-id', $data['id'] );
            }

            // Vegas Slider Options
            if( 'yes' === $element->get_settings('wixi_vegas_switcher') ) {
                $delay = $element->get_settings('wixi_vegas_delay');
                $duration = $element->get_settings('wixi_vegas_duration');
                $timer = $element->get_settings('wixi_vegas_timer');
                $shuffle = $element->get_settings('wixi_vegas_shuffle');
                $overlay = $element->get_settings('wixi_vegas_overlay_type');
                $images = $element->get_settings('wixi_vegas_images');

                $transitions = $element->get_settings('wixi_vegas_transition_type');
                $transition = array();
                foreach ( $transitions as $trans ) {
                    $transition[] =  '"'.$trans.'"';
                }
                $transition = implode(',', $transition);

                $animations = $element->get_settings('wixi_vegas_animation_type');
                $animation = array();
                foreach ( $animations as $anim ) {
                    $animation[] =  '"'.$anim.'"';
                }
                $animation = implode(',', $animation);

                $slides = array();
                foreach ( $images as $image ) {
                    $slides[] =  '{"src":"'.$image['url'].'"}';
                }

                $element->add_render_attribute( '_wrapper', 'data-vegas-settings',  '{"slides":['.implode(',', $slides).'],"animation":['.$animation.'],"transition":['.$transition.'],"delay":'.$delay.',"duration":'.$duration.',"timer":"'.$timer.'","shuffle":"'.$shuffle.'","overlay":"'.$overlay.'"}' );

                $element->add_render_attribute( '_wrapper', 'data-vegas-id', $data['id'] );

            }

            // Parallax Effect Options
            if( 'yes' === $element->get_settings('wixi_parallax_switcher') && $template != 'locomotive-page.php' ) {

                // Parallax attr
                $type = $element->get_settings('wixi_parallax_type');
                $speed = $element->get_settings('wixi_parallax_speed');
                $bgsize = $element->get_settings('wixi_parallax_bg_size');
                $mobile = $element->get_settings('wixi_parallax_mobile_support');
                $bgimg = $element->get_settings('background_image');
                $bgimg = $bgimg['url'];

                if ( 'yes' === $element->get_settings('wixi_add_parallax_video') && $element->get_settings('wixi_parallax_video_url') ) {

                    if ( 'mp4' === $element->get_settings('wixi_local_video_format')) {
                        $videosrc = 'mp4:'.$element->get_settings('wixi_parallax_video_url');
                    } elseif ( 'webm' === $element->get_settings('wixi_local_video_format')) {
                        $videosrc = 'webm:'.$element->get_settings('wixi_parallax_video_url');
                    } elseif ( 'ogv' === $element->get_settings('wixi_local_video_format')) {
                        $videosrc = 'ogv:'.$element->get_settings('wixi_parallax_video_url');
                    } else {
                        //$settings['background_video_link'] // elementor background video link
                        $videosrc = $element->get_settings('wixi_parallax_video_url');
                    }

                    $element->add_render_attribute( '_wrapper', 'data-jarallax data-video-src', $videosrc);

                    if ( $element->get_settings('wixi_parallax_video_start_time') ) {
                        $element->add_render_attribute( '_wrapper', 'data-video-start-time', $element->get_settings('wixi_parallax_video_start_time'));
                    }
                    if ( $element->get_settings('wixi_parallax_video_end_time') ) {
                        $element->add_render_attribute( '_wrapper', 'data-video-end-time', $element->get_settings('wixi_parallax_video_end_time'));
                    }
                    if ( 'yes' === $element->get_settings('wixi_parallax_video_play_once') ) {
                        $element->add_render_attribute( '_wrapper', 'data-jarallax-video-loop', 'false' );
                    }
                    if ( $element->get_settings('wixi_parallax_video_volume') ) {
                        $element->add_render_attribute( '_wrapper', 'data-video-volume', $element->get_settings('wixi_parallax_video_volume') );
                    }

                } else {
                    $parallaxattr = '{"type":"'.$type.'","speed":"'.$speed.'","imgsize":"'.$bgsize.'","imgsrc":"'.$bgimg.'","mobile":"'.$mobile.'"}';
                    $element->add_render_attribute( '_wrapper', 'data-wixi-parallax', $parallaxattr);
                }
            }

            if ( $template == 'locomotive-page.php' ) {
                if ( true == $isInner ) {
                    $lrepeat = 'yes' === $element->get_settings('wixi_locomotive_entrance_animation_repeat') ? 'true' : 'false';
                    $element->add_render_attribute( '_wrapper', 'data-scroll', '' );
                    $element->add_render_attribute( '_wrapper', 'data-scroll-speed', $element->get_settings('wixi_locomotive_speed') );
                    $element->add_render_attribute( '_wrapper', 'data-scroll-delay', $element->get_settings('wixi_locomotive_delay') );
                    $element->add_render_attribute( '_wrapper', 'data-scroll-direction', $element->get_settings('wixi_locomotive_direction') );
                    $element->add_render_attribute( '_wrapper', 'data-scroll-class', $element->get_settings('wixi_locomotive_entrance_animation') );
                    //$element->add_render_attribute( '_wrapper', 'data-scroll-sticky', $element->get_settings('wixi_locomotive_sticky') );
                    $element->add_render_attribute( '_wrapper', 'data-scroll-repeat', $lrepeat );
                } else {
                    $element->add_render_attribute( '_wrapper', 'data-scroll-section', '' );
                    if ( 'yes' === $element->get_settings('wixi_locomotive_fixedbg') ) {
                        $element->add_render_attribute( '_wrapper', 'data-wixi-locomotive-fixedbg', 'yes' );
                    }
                }
            }
        } // end if section
    }

    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
Wixi_Section_Parallax::get_instance();
