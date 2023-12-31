<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Odometer extends Widget_Base {
    use Wixi_Helper;
    public function get_name() {
        return 'wixi-odometer';
    }
    public function get_title() {
        return 'Counter Odometer (N)';
    }
    public function get_icon() {
        return 'eicon-counter';
    }
    public function get_categories() {
        return [ 'wixi' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_register_style( 'wixi-odometer', WIXI_PLUGIN_URL. 'assets/front/js/odometer/odometer.css');
        wp_register_script( 'odometer', WIXI_PLUGIN_URL. 'assets/front/js/odometer/odometer.min.js', [ 'jquery' ], '1.0.0', true);
        wp_register_script( 'wixi-odometer', WIXI_PLUGIN_URL. 'assets/front/js/odometer/script.js', [ 'elementor-frontend' ], '1.0.0', true);
    }
    public function get_style_depends() {
        return [ 'wixi-odometer' ];
    }
    public function get_script_depends() {

        return ['wow', 'odometer', 'wixi-odometer' ];

    }
    // Registering Controls
    protected function register_controls() {
        $this->start_controls_section('wixi_odometer_settings',
            [
                'label' => esc_html__( 'Odometer General', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'theme',
            [
                'label' => esc_html__( 'Theme', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'default', 'wixi' ),
                    'digital' => esc_html__( 'dijital', 'wixi' ),
                    'minimal' => esc_html__( 'minimal', 'wixi' ),
                    'car' => esc_html__( 'car', 'wixi' ),
                    'plaza' => esc_html__( 'plaza', 'wixi' ),
                    'slot-machine' => esc_html__( 'slot-machine', 'wixi' ),
                    'train-station' => esc_html__( 'train-station', 'wixi' ),
                ]
            ]
        );
        $this->add_control( 'format',
            [
                'label' => esc_html__( 'Format', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'd' => esc_html__( 'd -  12345678', 'wixi' ),
                    '(,ddd)' => esc_html__( '(,ddd) -  12,345,678', 'wixi' ),
                    '(,ddd).dd' => esc_html__( '(,ddd).dd -  12,345,678.09', 'wixi' ),
                    '(.ddd),dd' => esc_html__( '(.ddd),dd -  12.345.678,09', 'wixi' ),
                    '( ddd),dd' => esc_html__( '( ddd),dd -  12 345 678,09', 'wixi' )
                ]
            ]
        );
        $this->add_control( 'number',
            [
                'label' => esc_html__( 'Number', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => '',
                'step' => 1,
                'default' => 123,
            ]
        );
        $this->add_control( 'number2',
            [
                'label' => esc_html__( 'Number Update', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => '',
                'step' => 1,
                'default' => 555,
            ]
        );
        $this->add_control( 'before',
            [
                'label' => esc_html__( 'Before', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );
        $this->add_control( 'after',
            [
                'label' => esc_html__( 'After', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );
        $this->end_controls_section();
        /*****   Style   ******/
        $this->start_controls_section( 'animated_odometer_style_section',
            [
                'label' => esc_html__( 'Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'odometer_general_heading',
            [
                'label' => esc_html__( 'General', 'wixi' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $space = '{{WRAPPER}} .theme-default .odometer.odometer-auto-theme .odometer-digit + .odometer-digit,
        {{WRAPPER}} .theme-default .odometer.odometer-theme-default .odometer-digit + .odometer-digit,
        {{WRAPPER}} .theme-digital .odometer.odometer-auto-theme .odometer-digit + .odometer-digit,
        {{WRAPPER}} .theme-digital .odometer.odometer-theme-digital .odometer-digit + .odometer-digit,
        {{WRAPPER}} .theme-minimal .odometer.odometer-auto-theme .odometer-digit + .odometer-digit,
        {{WRAPPER}} .theme-minimal .odometer.odometer-theme-minimal .odometer-digit + .odometer-digit,
        {{WRAPPER}} .theme-car .odometer.odometer-auto-theme .odometer-digit + .odometer-digit,
        {{WRAPPER}} .theme-car .odometer.odometer-theme-car .odometer-digit + .odometer-digit,
        {{WRAPPER}} .theme-plaza .odometer.odometer-auto-theme .odometer-digit + .odometer-digit,
        {{WRAPPER}} .theme-plaza .odometer.odometer-theme-plaza .odometer-digit + .odometer-digit,
        {{WRAPPER}} .theme-slot-machine .odometer.odometer-auto-theme .odometer-digit + .odometer-digit,
        {{WRAPPER}} .theme-slot-machine .odometer.odometer-theme-slot-machine .odometer-digit + .odometer-digit,
        {{WRAPPER}} .theme-train-station .odometer.odometer-auto-theme .odometer-digit + .odometer-digit,
        {{WRAPPER}} .theme-train-station .odometer.odometer-theme-train-station .odometer-digit + .odometer-digit';

        $this->add_control( 'space',
            [
                'label' => esc_html__( 'Space Between', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ $space => 'margin-left:{{SIZE}}px;'],
            ]
        );

        $selector = '{{WRAPPER}} .theme-car .odometer.odometer-auto-theme,
        {{WRAPPER}} .theme-car .odometer.odometer-theme-car,
        {{WRAPPER}} .theme-default .odometer.odometer-auto-theme,
        {{WRAPPER}} .theme-default .odometer.odometer-theme-default,
        {{WRAPPER}} .theme-digital .odometer.odometer-auto-theme,
        {{WRAPPER}} .theme-digital .odometer.odometer-theme-digital,
        {{WRAPPER}} .theme-minimal .odometer.odometer-auto-theme,
        {{WRAPPER}} .theme-minimal .odometer.odometer-theme-minimal,
        {{WRAPPER}} .theme-plaza .odometer.odometer-auto-theme,
        {{WRAPPER}} .theme-plaza .odometer.odometer-theme-plaza,
        {{WRAPPER}} .theme-slot-machine .odometer.odometer-auto-theme,
        {{WRAPPER}} .theme-slot-machine .odometer.odometer-theme-slot-machine,
        {{WRAPPER}} .theme-train-station .odometer.odometer-auto-theme .odometer-digit,
        {{WRAPPER}} .theme-train-station .odometer.odometer-theme-train-station .odometer-digit,
        {{WRAPPER}} .odometer_extra';

        $this->add_control( 'color',
            [
                'label' => esc_html__( 'Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ $selector => 'color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'before_color',
            [
                'label' => esc_html__( 'Before After Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .odometer_extra' => 'color: {{VALUE}};' ],
                'conditions' => [
    				'relation' => 'or',
    				'terms' => [
    					[
    						'name' => 'before',
    						'operator' => '!=',
    						'value' => ''
    					],
    					[
    						'name' => 'after',
    						'operator' => '!=', // it accepts:  =,==, !=,!==,  in, !in etc.
    						'value' => ''
    					]
    				]
    			]
            ]
        );
        $this->add_control( 'color2',
            [
                'label' => esc_html__( 'Last Digit Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .theme-car .odometer.odometer-auto-theme .odometer-digit:last-child'=> 'color: {{VALUE}};',
                    '{{WRAPPER}} .theme-car .odometer.odometer-theme-car .odometer-digit:last-child'=> 'color: {{VALUE}};',
                ],
                'conditions' => [
    				'relation' => 'and',
    				'terms' => [
    					[
    						'name' => 'theme',
    						'operator' => '==',
    						'value' => 'digital'
    					],
    					[
    						'name' => 'theme',
    						'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
    						'value' => 'car'
    					]
    				]
    			]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typo',
                'label' => esc_html__( 'Typography', 'wixi' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => $selector
            ]
        );
        $this->add_control( 'use_stroke',
            [
                'label' => esc_html__( 'Use Stroke', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'stroke_w',
            [
                'label' => esc_html__( 'Stroke Width', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 2,
                'selectors' => [ $selector => '-webkit-text-stroke-width:{{SIZE}}px;color:transparent;'],
                'condition' => ['use_stroke' => 'yes']
            ]
        );
        $this->add_control( 'stroke_color',
            [
                'label' => esc_html__( 'Stroke Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ $selector => '-webkit-text-stroke-color:{{VALUE}}'],
                'condition' => ['use_stroke' => 'yes']
            ]
        );
        $this->add_control( 'fill_color',
            [
                'label' => esc_html__( 'Fill Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ $selector => '-webkit-text-fill-color:{{VALUE}}'],
                'condition' => ['use_stroke' => 'yes']
            ]
        );
        $bgcolor = '{{WRAPPER}} .theme-car .odometer.odometer-auto-theme .odometer-digit,
        {{WRAPPER}} .theme-car .odometer.odometer-theme-car .odometer-digit,
        {{WRAPPER}} .theme-car .odometer.odometer-auto-theme .odometer-digit:last-child,
        {{WRAPPER}} .theme-car .odometer.odometer-theme-car .odometer-digit:last-child,
        {{WRAPPER}} .theme-default .odometer.odometer-auto-theme .odometer-digit .odometer-value,
        {{WRAPPER}} .theme-default .odometer.odometer-theme-default .odometer-digit .odometer-value,
        {{WRAPPER}} .theme-digital .odometer.odometer-auto-theme,
        {{WRAPPER}} .theme-digital .odometer.odometer-theme-digital,
        {{WRAPPER}} .theme-minimal .odometer.odometer-auto-theme .odometer-digit .odometer-value,
        {{WRAPPER}} .theme-minimal .odometer.odometer-theme-minimal .odometer-digit .odometer-value,
        {{WRAPPER}} .theme-plaza .odometer.odometer-auto-theme .odometer-digit,
        {{WRAPPER}} .theme-plaza .odometer.odometer-theme-plaza .odometer-digit,
        {{WRAPPER}} .theme-slot-machine .odometer.odometer-auto-theme,
        {{WRAPPER}} .theme-slot-machine .odometer.odometer-theme-slot-machine,
        {{WRAPPER}} .theme-train-station .odometer.odometer-auto-theme .odometer-digit,
        {{WRAPPER}} .theme-train-station .odometer.odometer-theme-train-station .odometer-digit';
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'wixi' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => $bgcolor,
                'separator' => 'before',
            ]
        );

        $bgcolor2 = '{{WRAPPER}} .theme-slot-machine .odometer.odometer-auto-theme .odometer-digit:first-child,
        {{WRAPPER}} .theme-slot-machine .odometer.odometer-theme-slot-machine .odometer-digit:first-child';
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background2',
                'label' => esc_html__( 'Slot Machine Number First', 'wixi' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => $bgcolor2,
                'separator' => 'before',
                'condition' => ['theme' => 'slot-machine']
            ]
        );

        $bgcolor3 = '{{WRAPPER}} .theme-slot-machine .odometer.odometer-auto-theme .odometer-digit:last-child,
        {{WRAPPER}} .theme-slot-machine .odometer.odometer-theme-slot-machine .odometer-digit:last-child';
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background3',
                'label' => esc_html__( 'Slot Machine Number Last', 'wixi' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => $bgcolor3,
                'separator' => 'before',
                'condition' => ['theme' => 'slot-machine']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__( 'Border', 'wixi' ),
                'selector' => $selector,
                'separator' => 'before'
            ]
        );

        $border2 = '{{WRAPPER}} .theme-slot-machine .odometer.odometer-auto-theme .odometer-digit,
        {{WRAPPER}} .theme-slot-machine .odometer.odometer-theme-slot-machine .odometer-digit';
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border2',
                'label' => esc_html__( 'Inner Border', 'wixi' ),
                'selector' => $border2,
                'separator' => 'before',
                'condition' => ['theme' => 'slot-machine']
            ]
        );
        $this->add_responsive_control( 'padding',
            [
                'label' => esc_html__( 'Padding', 'wixi' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    $selector => 'padding-top: {{TOP}}{{UNIT}};padding-right: {{RIGHT}}{{UNIT}};padding-bottom: {{BOTTOM}}{{UNIT}};padding-left: {{LEFT}}{{UNIT}};'
                ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'alignment',
            [
                'label' => esc_html__( 'Alignment', 'wixi' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .odometer_wrapper' => 'text-align: {{VALUE}};'],
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
                'default' => '',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'before',
                            'operator' => '==',
                            'value' => ''
                        ],
                        [
                            'name' => 'after',
                            'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => ''
                        ]
                    ]
                ]
            ]
        );
        $this->add_responsive_control( 'alignment2',
            [
                'label' => esc_html__( 'Alignment', 'wixi' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .odometer_wrapper' => 'justify-content: {{VALUE}};'],
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'wixi' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'wixi' ),
                        'icon' => 'fa fa-align-center'
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'wixi' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => 'left',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'before',
                            'operator' => '!=',
                            'value' => ''
                        ],
                        [
                            'name' => 'after',
                            'operator' => '!=', // it accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => ''
                        ]
                    ]
                ]
            ]
        );
        $selector2 = '{{WRAPPER}} .theme-plaza .odometer.odometer-auto-theme .odometer-digit,
        {{WRAPPER}} .theme-plaza .odometer.odometer-theme-plaza .odometer-digit,
        {{WRAPPER}} .theme-slot-machine .odometer.odometer-auto-theme .odometer-digit,
        {{WRAPPER}} .theme-slot-machine .odometer.odometer-theme-slot-machine .odometer-digit';
        $this->add_responsive_control( 'padding2',
            [
                'label' => esc_html__( 'Padding Dijit', 'wixi' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    $selector2 => 'padding-top: {{TOP}}{{UNIT}};padding-right: {{RIGHT}}{{UNIT}};padding-bottom: {{BOTTOM}}{{UNIT}};padding-left: {{LEFT}}{{UNIT}};'
                ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                ],
                'separator' => 'before',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'theme',
                            'operator' => '==',
                            'value' => 'plaza'
                        ],
                        [
                            'name' => 'theme',
                            'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => 'slot-machine'
                        ]
                    ]
                ]
            ]
        );
        $this->end_controls_section();
        /*****   Style   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id       = $this->get_id();
        $number   = $settings['number'] ? $settings['number'] : 000;
        $number2  = $settings['number2'] ? $settings['number2'] : 555;
        $theme    = $settings['theme'] ? $settings['theme'] : 'default';
        $format   = $settings['format'] ? $settings['format'] : 'd';
        $before   = $settings['before'] ? '<span class="odometer_extra odometer_before">'.$settings['before'].' </span>' : '';
        $after   = $settings['after'] ? '<span class="odometer_extra odometer_after"> '.$settings['after'].'</span>' : '';
        $flex   = $settings['after'] || $settings['before'] ? ' odometer-flex' : '';

        echo '<div class="odometer_wrapper theme-'.$theme.$flex.'">';
            echo $before.'<div id="odometer_'.$id.'" class="odometer wow3" data-wixi-odometer=\'{"theme":"'.$theme.'","format":"'.$format.'","number":'.$number.',"number2":'.$number2.'}\'>'.$settings['number'].'</div>'.$after;
        echo '</div>';
    }
}
