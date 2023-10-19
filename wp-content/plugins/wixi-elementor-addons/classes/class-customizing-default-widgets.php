<?php

namespace Elementor;

if( !defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Core\Base\Document;
use Elementor\Core\Base\Module as BaseModule;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Element_Base;
use Elementor\Core\DocumentTypes\PageBase as PageBase;
use Elementor\Modules\Library\Documents\Page as LibraryPageDocument;

class wixi_Customizing_Default_Widgets {

    private static $instance = null;

    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new wixi_Customizing_Default_Widgets();
        }
        return self::$instance;
    }

    public function __construct(){
        add_action( 'elementor/element/heading/section_title/after_section_end', [ $this, 'wixi_add_transform_to_heading' ] );
        add_action( 'elementor/element/heading/section_title/before_section_end', [ $this, 'wixi_add_line_to_before_heading' ] );
        add_action( 'elementor/element/spacer/section_spacer/before_section_end', [ $this, 'wixi_add_border_radius_to_spacer' ] );
        add_action( 'elementor/element/image/section_style_image/before_section_end', [ $this, 'wixi_add_border_radius_to_image' ] );
        add_action( 'elementor/element/image/section_image/after_section_end', [ $this, 'wixi_add_custom_controls_to_image' ] );
        add_action( 'elementor/frontend/widget/before_render',[ $this, 'wixi_add_custom_attr_to_widget' ], 10 );
        add_action( 'elementor/frontend/widget/after_render',[ $this, 'wixi_after_render_widget' ], 10 );

        $locoelements = array(
            'image' => 'section_image',
            'heading' => 'section_title',
            'video' => 'section_image_overlay',
            'text-editor' => 'section_editor',
            'button' => 'section_button',
            'google_maps' => 'section_map',
            'icon' => 'section_icon',
            'image-box' => 'section_image',
            'icon-box' => 'section_icon',
            'star-rating' => 'section_rating',
            'image-carousel' => 'section_additional_options',
            'image-gallery' => 'section_gallery',
            'icon-list' => 'section_icon',
            'counter' => 'section_counter',
            'progress' => 'section_progress',
            'testimonial' => 'section_testimonial',
            'tabs' => 'section_tabs',
            'accordion' => 'section_title',
            'toggle' => 'section_toggle',
            'social-icons' => 'section_social_icon',
            'alert' => 'section_alert',
            'audio' => 'section_audio',
            'shortcode' => 'section_shortcode',
            'html' => 'section_title',
            'sidebar' => 'section_sidebar',
            'spacer' => 'section_spacer',
            'divider' => 'section_divider',
            'wixi-button' => 'wixi_btn_settings',
            'wixi-button2' => 'wixi_btn_animation',
            'wixi-team-member' => 'team_info_style_section',
            'wixi-animated-headline' => 'animated_headline_style_section',
            'wixi-services-item' => 'wixi_services_one_items_settings',
            'wixi-flip-card' => 'flip_card_back_extra_settings',
            'wixi-svg-animation' => 'wixi_flip_card_general_settings',
            'wixi-odometer' => 'animated_odometer_style_section',
        );
        foreach ( $locoelements as $el => $section ) {
            add_action( 'elementor/element/'.$el.'/'.$section.'/after_section_end', [ $this,'wixi_add_locomotive_effect_to_element']);
        }

        $tiltelements = array(
            'image-box' => 'section_image',
            'wixi-team-member' => 'team_info_style_section',
            'wixi-services-item' => 'wixi_services_one_items_settings',
        );
        foreach ( $tiltelements as $el => $section ) {
            add_action( 'elementor/element/'.$el.'/'.$section.'/after_section_end', [ $this,'wixi_add_tilt_effect_to_element']);
        }

    }
    public function wixi_add_border_radius_to_spacer( $widget )
    {
        $widget->add_responsive_control( 'wixi_advanced_border_radius',
            [
                'label' => esc_html__( 'Wixi Advanced Border Radius', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'separator' => 'before',
                'label_block' => true,
                'placeholder' => 'e.g: 30% 70% 70% 30% / 30% 30% 70% 70%',
                'selectors' => [ '{{WRAPPER}} .elementor-widget-container' => '-webkit-border-radius:{{VALUE}};-moz-border-radius:{{VALUE}};border-radius:{{VALUE}};' ],
            ]
        );
        $widget->add_control( 'wixi_advanced_border_radius_ref',
            [
                'label' => '<a href="https://9elements.github.io/fancy-border-radius/" target="_blank">Find More Details</a>',
                'type' => Controls_Manager::RAW_HTML,
            ]
        );
    }
    public function wixi_add_border_radius_to_image( $widget )
    {
        $widget->add_responsive_control( 'wixi_advanced_border_radius',
            [
                'label' => esc_html__( 'Wixi Advanced Border Radius', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'separator' => 'before',
                'label_block' => true,
                'placeholder' => 'e.g: 30% 70% 70% 30% / 30% 30% 70% 70%',
                'selectors' => [ '{{WRAPPER}} .elementor-image img' => '-webkit-border-radius:{{VALUE}};-moz-border-radius:{{VALUE}};border-radius:{{VALUE}};' ],
            ]
        );
        $widget->add_control( 'wixi_advanced_border_radius_ref',
            [
                'label' => '<a href="https://9elements.github.io/fancy-border-radius/" target="_blank">Find More Details</a>',
                'type' => Controls_Manager::RAW_HTML,
            ]
        );
    }
    public function wixi_add_locomotive_effect_to_element( $widget )
    {

        $template = basename( get_page_template() );

        if ( $template == 'locomotive-page.php' ) {
            $widget->start_controls_section( 'wixi_locomotive_section',
                [
                    'label' => esc_html__( 'Wixi Locomotive', 'wixi' ),
                    'tab' => Controls_Manager::TAB_CONTENT
                ]
            );
            $widget->add_control( 'wixi_locomotive_switcher',
                [
                    'label' => esc_html__( 'Enable Locomotive Effect', 'wixi' ),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );
            if ( 'image' == $widget->get_name() ) {
                $widget->add_control( 'wixi_locomotive_image_parallax_switcher',
                    [
                        'label' => esc_html__( 'Enable Parallax', 'wixi' ),
                        'type' => Controls_Manager::SWITCHER,
                        'condition' => [ 'wixi_locomotive_switcher' => 'yes' ],
                    ]
                );
                $widget->add_control( 'wixi_locomotive_image_parallax_speed',
                    [
                        'label' => esc_html__( 'Parallax Speed', 'wixi' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => '4',
                        'options' => [
                            '2' => esc_html__( '2X', 'wixi' ),
                            '3' => esc_html__( '3X', 'wixi' ),
                            '4' => esc_html__( '4X', 'wixi' ),
                            '5' => esc_html__( '5X', 'wixi' ),
                            '6' => esc_html__( '6X', 'wixi' ),
                        ],
                        'conditions' => [
                            'relation' => 'and',
                            'terms' => [
                                [
                                    'name' => 'wixi_locomotive_switcher',
                                    'operator' => '==',
                                    'value' => 'yes'
                                ],
                                [
                                    'name' => 'wixi_locomotive_image_parallax_switcher',
                                    'operator' => '==',
                                    'value' => 'yes'
                                ]
                            ]
                        ]
                    ]
                );
                $widget->add_control( 'wixi_locomotive_speed',
                    [
                        'label' => esc_html__( 'Speed', 'wixi' ),
                        'type' => Controls_Manager::NUMBER,
                        'min' => -10,
                        'max' => 10,
                        'step' => 0.1,
                        'default' => '',
                        'description' => esc_html__( 'Element parallax speed. A negative value will reverse the direction.', 'wixi' ),
                        'conditions' => [
                            'relation' => 'and',
                            'terms' => [
                                [
                                    'name' => 'wixi_locomotive_switcher',
                                    'operator' => '==',
                                    'value' => 'yes'
                                ],
                                [
                                    'name' => 'wixi_locomotive_image_parallax_switcher',
                                    'operator' => '!=',
                                    'value' => 'yes'
                                ]
                            ]
                        ]
                    ]
                );
                $widget->add_control( 'wixi_locomotive_delay',
                    [
                        'label' => esc_html__( 'Lerp Delay', 'wixi' ),
                        'type' => Controls_Manager::NUMBER,
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                        'default' => '',
                        'description' => esc_html__( 'Element parallax lerp delay.', 'wixi' ),
                        'conditions' => [
                            'relation' => 'and',
                            'terms' => [
                                [
                                    'name' => 'wixi_locomotive_switcher',
                                    'operator' => '==',
                                    'value' => 'yes'
                                ],
                                [
                                    'name' => 'wixi_locomotive_image_parallax_switcher',
                                    'operator' => '!=',
                                    'value' => 'yes'
                                ]
                            ]
                        ]
                    ]
                );
            } else {
                $widget->add_control( 'wixi_locomotive_speed',
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
                $widget->add_control( 'wixi_locomotive_delay',
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
            }
            $widget->add_control( 'wixi_locomotive_direction',
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
            $widget->add_control( 'wixi_locomotive_entrance_animation',
                [
                    'label' => esc_html__( 'Entrance Animation', 'wixi' ),
                    'type' => Controls_Manager::ANIMATION,
                    'separator' => 'before',
                    'condition' => ['wixi_locomotive_switcher' => 'yes']
                ]
            );
            $widget->add_control( 'wixi_locomotive_entrance_animation_repeat',
                [
                    'label' => esc_html__( 'Entrance Animation Repeat', 'wixi' ),
                    'type' => Controls_Manager::SWITCHER,
                    'condition' => ['wixi_locomotive_switcher' => 'yes']
                ]
            );

            $widget->end_controls_section();
        }
    }
    public function wixi_add_tilt_effect_to_element( $widget )
    {
        $widget->start_controls_section( 'wixi_tilt_effect_section',
            [
                'label' => esc_html__( 'Wixi Tilt Effect', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $widget->add_control( 'wixi_tilt_effect_switcher',
            [
                'label' => esc_html__( 'Enable Tilt Effect', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $widget->add_control( 'wixi_tilt_effect_maxtilt',
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
        $widget->add_control( 'wixi_tilt_effect_perspective',
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
        $widget->add_control( 'wixi_tilt_effect_easing',
            [
                'label' => esc_html__( 'Custom Easing', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'cubic-bezier(.03,.98,.52,.99)',
                'label_block' => true,
                'condition' => ['wixi_tilt_effect_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wixi_tilt_effect_scale',
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
        $widget->add_control( 'wixi_tilt_effect_speed',
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
        $widget->add_control( 'wixi_tilt_effect_transition',
            [
                'label' => esc_html__( 'Transition', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'Set a transition on enter/exit.', 'wixi' ),
                'condition' => ['wixi_tilt_effect_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wixi_tilt_effect_disableaxis',
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
        $widget->add_control( 'wixi_tilt_effect_reset',
            [
                'label' => esc_html__( 'Reset', 'wixi' ),
                'description' => esc_html__( 'If the tilt effect has to be reset on exit.', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['wixi_tilt_effect_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wixi_tilt_effect_glare',
            [
                'label' => esc_html__( 'Glare Effect', 'wixi' ),
                'description' => esc_html__( 'Enables glare effect', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['wixi_tilt_effect_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wixi_tilt_effect_maxglare',
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
        $widget->add_group_control(
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
        $widget->end_controls_section();
    }

    public function wixi_add_line_to_before_heading( $widget )
    {
        $rtl = is_rtl() ? 'right' : 'left';
        $widget->add_control( 'wixi_heading_before_line_switcher',
            [
                'label' => esc_html__( 'Wixi Line Before', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'wixi-headig-line heading-has-line-',
                'selectors' => ['{{WRAPPER}}.wixi-headig-line .elementor-heading-title' => 'padding-'.$rtl.': 70px;' ],
                'separator' => 'before'
            ]
        );
        $widget->add_responsive_control( 'wixi_heading_before_line_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 45,
                'selectors' => [ '{{WRAPPER}}.wixi-headig-line .elementor-heading-title::after' => 'bottom:{{SIZE}}%;' ],
                'condition' => [ 'wixi_heading_before_line_switcher' => 'yes' ],
            ]
        );
        $widget->add_control( 'wixi_heading_before_line_color',
            [
                'label' => esc_html__( 'Line Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}.wixi-headig-line .elementor-heading-title::after' => 'background-color: {{VALUE}};' ],
                'condition'  => ['wixi_heading_before_line_switcher' => 'yes']
            ]
        );
    }
    public function wixi_add_transform_to_heading( $widget )
    {
        $widget->start_controls_section( 'heading_css_transform_controls_section',
            [
                'label' => esc_html__( 'Wixi CSS Transform', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $widget->add_control( 'heading_vertical_mode_switcher',
            [
                'label' => esc_html__( 'Text Vertical Mode', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $widget->add_responsive_control( 'heading_vertical_mode',
            [
                'label' => esc_html__( 'Vertical Mode', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'translate',
                'options' => [
                    'rl' => esc_html__( 'vertical-rl', 'wixi' ),
                    'lr' => esc_html__( 'vertical-lr', 'wixi' ),
                ],
                'prefix_class' => 'wixi-vertical-mode vertical-',
                'condition' => [ 'heading_vertical_mode_switcher' => 'yes' ],
            ]
        );
        $widget->add_control( 'heading_css_transform_type',
            [
                'label' => esc_html__( 'Transform Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'translate',
                'options' => [
                    'translate' => esc_html__( 'translate', 'wixi' ),
                    'scale' => esc_html__( 'scale', 'wixi' ),
                    'rotate' => esc_html__( 'rotate', 'wixi' ),
                    'skew' => esc_html__( 'skew', 'wixi' ),
                    'custom' => esc_html__( 'custom', 'wixi' ),
                ],
                'prefix_class' => 'wixi-transform transform-type-',
            ]
        );
        $widget->add_control( 'heading_css_transform_translate_heading',
            [
                'label' => esc_html__( 'Translate', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [ 'heading_css_transform_type' => 'translate' ]
            ]
        );
        $widget->add_responsive_control( 'heading_css_transform_translate_xy',
            [
                'label' => esc_html__( 'Translate 2D ( X,Y )', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Xpx,Ypx',
                'selectors' => [ '{{WRAPPER}}.wixi-transform.transform-type-translate .elementor-heading-title' => 'transform:translate( {{VALUE}} );'],
                'condition' => [ 'heading_css_transform_type' => 'translate' ]
            ]
        );
        $widget->add_responsive_control( 'heading_css_transform_translate_xyz',
            [
                'label' => esc_html__( 'Translate 3D ( X,Y,Z )', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Xpx,Ypx,Zpx',
                'selectors' => [ '{{WRAPPER}}.wixi-transform.transform-type-translate.has-translate-xyz .elementor-heading-title' => 'transform:translate3d( {{VALUE}} );'],
                'prefix_class' => 'has-translate-xyz translate-xyz-',
                'condition' => [ 'heading_css_transform_type' => 'translate' ]
            ]
        );
        // Scale
        $widget->add_control( 'heading_css_transform_scale_heading',
            [
                'label' => esc_html__( 'Scale', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [ 'heading_css_transform_type' => 'scale' ],
                'separator' => 'before'
            ]
        );
        $widget->add_responsive_control( 'heading_css_transform_scale_xy',
            [
                'label' => esc_html__( 'Scale 2D ( X,Y )', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Xpx,Ypx',
                'selectors' => [ '{{WRAPPER}}.wixi-transform.transform-type-translate .elementor-heading-title' => 'transform:scale( {{VALUE}} );'],
                'condition' => [ 'heading_css_transform_type' => 'scale' ]
            ]
        );
        $widget->add_responsive_control( 'heading_css_transform_scale_xyz',
            [
                'label' => esc_html__( 'Scale 3D ( X,Y,Z )', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Xpx,Ypx,Zpx',
                'selectors' => [ '{{WRAPPER}}.wixi-transform.transform-type-scale.has-scale-xyz .elementor-heading-title' => 'transform:scale3d( {{VALUE}} );'],
                'prefix_class' => 'has-scale-xyz scale-xyz-',
                'condition' => [ 'heading_css_transform_type' => 'scale' ]
            ]
        );
        // Rotate
        $widget->add_control( 'heading_css_transform_rotate_heading',
            [
                'label' => esc_html__( 'Rotate', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [ 'heading_css_transform_type' => 'scale' ],
                'separator' => 'before'
            ]
        );
        $widget->add_responsive_control( 'heading_css_transform_rotate_xy',
            [
                'label' => esc_html__( 'Rotate 2D ( X,Y )', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Xdeg,Ydeg',
                'selectors' => [ '{{WRAPPER}}.wixi-transform.transform-type-rotate .elementor-heading-title' => 'transform:rotate( {{VALUE}} );'],
                'condition' => [ 'heading_css_transform_type' => 'rotate' ]
            ]
        );
        $widget->add_responsive_control( 'heading_css_transform_rotate_xyz',
            [
                'label' => esc_html__( 'Rotate 3D ( X,Y,Z )', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => '0,0,0',
                'selectors' => [ '{{WRAPPER}}.wixi-transform.transform-type-rotate.has-rotate-xyz .elementor-heading-title' => 'transform:translate3d( {{VALUE}}deg );'],
                'prefix_class' => 'has-rotate-xyz rotate-xyz-',
                'condition' => [ 'heading_css_transform_type' => 'rotate' ]
            ]
        );
		// Skew
        $widget->add_control( 'heading_css_transform_skew_heading',
            [
                'label' => esc_html__( 'Skew', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [ 'heading_css_transform_type' => 'skew' ]
            ]
        );
        $widget->add_responsive_control( 'heading_css_transform_skew_xy',
            [
                'label' => esc_html__( 'Skew 2D ( X,Y )', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Xdeg,Ydeg',
                'selectors' => [ '{{WRAPPER}}.wixi-transform.transform-type-skew .elementor-heading-title' => 'transform:skew( {{VALUE}} );'],
                'condition' => [ 'heading_css_transform_type' => 'skew' ]
            ]
        );
        // Custom
        $widget->add_control( 'heading_css_transform_custom_heading',
            [
                'label' => esc_html__( 'Custom Transform', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [ 'heading_css_transform_type' => 'custom' ]
            ]
        );
        $widget->add_responsive_control( 'heading_css_transform_custom_xy',
            [
                'label' => esc_html__( 'Transform', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => 'rotate(Xdeg,Ydeg) translate(Xpx,Ypx) scale(X,Y)',
                'selectors' => [ '{{WRAPPER}}.wixi-transform.transform-type-custom .elementor-heading-title' => 'transform:( {{VALUE}} );'],
                'condition' => [ 'heading_css_transform_type' => 'custom' ]
            ]
        );
        $widget->end_controls_section();

        $widget->start_controls_section( 'wixi_heading_css_stroke_controls_section',
            [
                'label' => esc_html__( 'Wixi CSS Stroke', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $widget->add_control( 'wixi_heading_css_stroke_switcher',
            [
                'label' => esc_html__( 'Enable Stroke', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'wixi-stroke wixi-has-stroke-',
            ]
        );
        $widget->add_control( 'wixi_heading_css_stroke_type',
            [
                'label' => esc_html__( 'Stroke Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'full',
                'options' => [
                    'full' => esc_html__( 'Full Text', 'wixi' ),
                    'part' => esc_html__( 'Part of Text', 'wixi' ),
                ],
                'prefix_class' => 'wixi-has-stroke-type stroke-type-',
                'condition'  => ['wixi_heading_css_stroke_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wixi_heading_css_stroke_note',
            [
                'label' => esc_html__( 'Important Note', 'wixi' ),
                'type' => Controls_Manager::RAW_HTML,
                'raw' => esc_html__( 'Please add part of text in <b> your text </b>', 'wixi' ),
                'content_classes' => 'wixi-message',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'wixi_heading_css_stroke_switcher',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'wixi_heading_css_stroke_type',
                            'operator' => '==',
                            'value' => 'part'
                        ]
                    ]
                ]
            ]
        );
        $widget->add_control( 'wixi_heading_css_stroke_width',
            [
                'label' => esc_html__( 'Stroke Width', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 20,
                'step' => 1,
                'default' => 1,
                'selectors' => [
                    '{{WRAPPER}}.wixi-stroke.stroke-type-full .elementor-heading-title' => '-webkit-text-stroke-width: {{SIZE}}px;color:transparent;',
                    '{{WRAPPER}}.wixi-stroke.stroke-type-part .elementor-heading-title b' => '-webkit-text-stroke-width: {{SIZE}}px;color:transparent;',
                ],
                'condition'  => ['wixi_heading_css_stroke_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wixi_heading_css_stroke_color',
            [
                'label' => esc_html__( 'Stroke Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}}.wixi-stroke.stroke-type-full .elementor-heading-title' => '-webkit-text-stroke-color: {{VALUE}};',
                    '{{WRAPPER}}.wixi-stroke.stroke-type-part .elementor-heading-title b' => '-webkit-text-stroke-color: {{VALUE}};',
                ],
                'condition'  => ['wixi_heading_css_stroke_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wixi_heading_css_stroke_fill_color',
            [
                'label' => esc_html__( 'Fill Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}}.wixi-stroke.stroke-type-full .elementor-heading-title' => '-webkit-text-fill-color: {{VALUE}};',
                    '{{WRAPPER}}.wixi-stroke.stroke-type-part .elementor-heading-title b' => '-webkit-text-fill-color: {{VALUE}};',
                ],
                'condition'  => ['wixi_heading_css_stroke_switcher' => 'yes']
            ]
        );
        $widget->end_controls_section();

        $template = basename( get_page_template() );

        if ( $template != 'locomotive-page.php' ) {
            $widget->start_controls_section( 'wixi_heading_parallax_controls_section',
                [
                    'label' => esc_html__( 'Wixi Parallax', 'wixi' ),
                    'tab' => Controls_Manager::TAB_CONTENT
                ]
            );
            $widget->add_control( 'wixi_heading_parallax_switcher',
                [
                    'label' => esc_html__( 'Enable Parallax', 'wixi' ),
                    'type' => Controls_Manager::SWITCHER,
                    'prefix_class' => 'wixi-headig-parallax heading-has-parallax-',
                ]
            );
            $widget->add_control( 'wixi_heading_parallax_note',
                [
                    'label' => esc_html__( 'Important Note', 'wixi' ),
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => esc_html__( 'This option only works if there is a background image.Please add background image before.', 'wixi' ),
                    'content_classes' => 'wixi-message',
                    'condition'  => ['wixi_heading_parallax_switcher' => 'yes']
                ]
            );
            $widget->end_controls_section();
        }

        $widget->start_controls_section( 'wixi_heading_split_controls_section',
            [
                'label' => esc_html__( 'Wixi Split Text', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $widget->add_control( 'wixi_heading_split_switcher',
            [
                'label' => esc_html__( 'Enable Split', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'wixi-headig-split heading-has-split-',
            ]
        );
        $widget->add_control( 'wixi_heading_split_type',
            [
                'label' => esc_html__( 'Split Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'chars',
                'options' => [
                    'chars' => esc_html__( 'Chars', 'wixi' ),
                    'words' => esc_html__( 'Words', 'wixi' ),
                ],
                'condition' => ['wixi_heading_split_switcher' => 'yes'],
            ]
        );
        $widget->add_control( 'wixi_heading_split_entrance_animation',
            [
                'label' => esc_html__( 'Entrance Animation', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fadeInUp2',
                'options' => [
                    'fadeIn2' => esc_html__( 'fadeIn', 'wixi' ),
                    'fadeInUp2' => esc_html__( 'fadeInUp', 'wixi' ),
                    'fadeInRight2' => esc_html__( 'fadeInRight', 'wixi' ),
                    'fadeInLeft2' => esc_html__( 'fadeInLeft', 'wixi' ),
                    'fadeInDown2' => esc_html__( 'fadeInDown', 'wixi' ),
                    'bounceIn2' => esc_html__( 'bounceIn', 'wixi' ),
                    'bounceInUp2' => esc_html__( 'bounceInUp', 'wixi' ),
                    'bounceInRight2' => esc_html__( 'bounceInRight', 'wixi' ),
                    'bounceInLeft2' => esc_html__( 'bounceInLeft', 'wixi' ),
                    'bounceInDown2' => esc_html__( 'bounceInDown', 'wixi' ),
                    'slideIn' => esc_html__( 'slideIn', 'wixi' ),
                    'slideInDown' => esc_html__( 'slideInDown', 'wixi' ),
                    'slideInUp' => esc_html__( 'slideInUp', 'wixi' ),
                    'slideInLeft' => esc_html__( 'slideInLeft', 'wixi' ),
                    'slideInRight' => esc_html__( 'slideInRight', 'wixi' ),
                    'zoomIn' => esc_html__( 'zoomIn', 'wixi' ),
                    'zoomInDown' => esc_html__( 'zoomInDown', 'wixi' ),
                    'zoomInUp' => esc_html__( 'zoomInUp', 'wixi' ),
                    'zoomInLeft' => esc_html__( 'zoomInLeft', 'wixi' ),
                    'zoomInRight' => esc_html__( 'zoomInRight', 'wixi' ),
                    'rotateIn' => esc_html__( 'rotateIn', 'wixi' ),
                    'rotateInDownRight' => esc_html__( 'rotateInDownRight', 'wixi' ),
                    'rotateInUpLeft' => esc_html__( 'rotateInUpLeft', 'wixi' ),
                    'rotateInUpRight' => esc_html__( 'rotateInUpRight', 'wixi' ),
                ],
                'condition' => ['wixi_heading_split_switcher' => 'yes'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title.animated .char' => '-webkit-animation: {{VALUE}} 0.4s cubic-bezier(0.3, 0, 0.7, 1) both; animation: {{VALUE}} 0.4s cubic-bezier(0.3, 0, 0.7, 1) both;',
                    '{{WRAPPER}} .elementor-heading-title.animated .word' => '-webkit-animation: {{VALUE}} 0.4s cubic-bezier(0.3, 0, 0.7, 1) both; animation: {{VALUE}} 0.4s cubic-bezier(0.3, 0, 0.7, 1) both;',
                ]
            ]
        );
        $widget->add_control( 'wixi_heading_split_delay',
            [
                'label' => esc_html__( 'Delay', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 500,
                'step' => 1,
                'default' => 30,
                'description'=> esc_html__( 'the delay is in millisecond', 'wixi' ),
                'condition' => ['wixi_heading_split_switcher' => 'yes'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title.animated .char' => '-webkit-animation-delay: calc({{VALUE}}ms * var(--char-index)); animation-delay: calc({{VALUE}}ms * var(--char-index));',
                    '{{WRAPPER}} .elementor-heading-title.animated .word' => '-webkit-animation-delay: calc({{VALUE}}ms * var(--word-index)); animation-delay: calc({{VALUE}}ms * var(--word-index));',
                ]
            ]
        );
        $widget->add_control( 'wixi_heading_split_space',
            [
                'label' => esc_html__( 'Space Between Word', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'default' => 10,
                'condition' => ['wixi_heading_split_switcher' => 'yes'],
                'selectors' => ['{{WRAPPER}} .elementor-heading-title.splitting .whitespace' => 'width:{{VALUE}}px;']
            ]
        );
        $widget->end_controls_section();
    }

    public function wixi_add_custom_controls_to_image( $widget )
    {
        $template = basename( get_page_template() );

        if ( $template != 'locomotive-page.php' ) {
            $widget->start_controls_section( 'wixi_image_parallax_controls_section',
                [
                    'label' => esc_html__( 'Wixi Parallax', 'wixi' ),
                    'tab' => Controls_Manager::TAB_CONTENT,
                    'condition' => [ 'image[url]!' => '' ],
                ]
            );
            $widget->add_control( 'wixi_image_parallax_switcher',
                [
                    'label' => esc_html__( 'Enable Parallax', 'wixi' ),
                    'type' => Controls_Manager::SWITCHER,
                    'prefix_class' => 'wixi-image-parallax image-has-parallax-',
                ]
            );
            $widget->add_control( 'wixi_image_parallax_overflow',
                [
                    'label' => esc_html__( 'Overflow', 'wixi' ),
                    'type' => Controls_Manager::SWITCHER,
                    'condition'  => ['wixi_image_parallax_switcher' => 'yes']
                ]
            );
            $widget->add_control( 'wixi_image_parallax_orientation',
                [
                    'label' => esc_html__( 'Orientation', 'wixi' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'up',
                    'options' => [
                        'up' => esc_html__( 'up', 'wixi' ),
                        'right' => esc_html__( 'right', 'wixi' ),
                        'down' => esc_html__( 'down', 'wixi' ),
                        'left' => esc_html__( 'left', 'wixi' ),
                        'up left' => esc_html__( 'up left', 'wixi' ),
                        'up right' => esc_html__( 'up right', 'wixi' ),
                        'down left' => esc_html__( 'down left', 'wixi' ),
                        'left right' => esc_html__( 'left right', 'wixi' ),
                    ],
                    'condition'  => ['wixi_image_parallax_switcher' => 'yes']
                ]
            );
            $widget->add_control( 'wixi_image_parallax_scale',
                [
                    'label' => esc_html__( 'Scale', 'wixi' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 10,
                    'step' => 0.1,
                    'default' => 1.2,
                    'description'=> esc_html__( 'need to be above 1.0', 'wixi' ),
                    'condition'  => ['wixi_image_parallax_switcher' => 'yes']
                ]
            );
            $widget->add_control( 'wixi_image_parallax_delay',
                [
                    'label' => esc_html__( 'Delay', 'wixi' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 10,
                    'step' => 0.1,
                    'default' => 0.4,
                    'description'=> esc_html__( 'the delay is in second', 'wixi' ),
                    'condition'  => ['wixi_image_parallax_switcher' => 'yes']
                ]
            );
            $widget->add_control( 'wixi_image_parallax_maxtransition',
                [
                    'label' => esc_html__( 'Max Transition ( % )', 'wixi' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 99,
                    'step' => 1,
                    'default' => 0,
                    'description'=> esc_html__( 'it should be a percentage between 1 and 99', 'wixi' ),
                    'condition'  => ['wixi_image_parallax_switcher' => 'yes']
                ]
            );
            $widget->end_controls_section();

            $widget->start_controls_section( 'wixi_image_reveal_effects_controls_section',
                [
                    'label' => esc_html__( 'Reveal Effects', 'wixi' ),
                    'tab' => Controls_Manager::TAB_CONTENT,
                    'condition' => [ 'image[url]!' => '' ],
                ]
            );
            $widget->add_control( 'wixi_image_reveal_switcher',
                [
                    'label' => esc_html__( 'Enable Reveal', 'wixi' ),
                    'type' => Controls_Manager::SWITCHER,
                    'prefix_class' => 'wixi-image-reveal image-has-reveal-',
                ]
            );
            $widget->add_control( 'wixi_image_reveal_orientation',
                [
                    'label' => esc_html__( 'Orientation', 'wixi' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => [
                        'top' => esc_html__( 'up', 'wixi' ),
                        'right' => esc_html__( 'right', 'wixi' ),
                        'bottom' => esc_html__( 'down', 'wixi' ),
                        'left' => esc_html__( 'left', 'wixi' ),
                    ],
                    'condition' => ['wixi_image_reveal_switcher' => 'yes']
                ]
            );
            $widget->add_control( 'wixi_image_reveal_delay',
                [
                    'label' => esc_html__( 'Delay ( ms )', 'wixi' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 10000,
                    'step' => 1,
                    'default' => '',
                    'description' => esc_html__( 'the delay is in second', 'wixi' ),
                    'condition' => ['wixi_image_reveal_switcher' => 'yes']
                ]
            );
            $widget->add_control( 'wixi_image_reveal_offset',
                [
                    'label' => esc_html__( 'Offset ( px )', 'wixi' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => -1000,
                    'max' => 1000,
                    'step' => 1,
                    'default' => '',
                    'condition' => ['wixi_image_reveal_switcher' => 'yes']
                ]
            );
            $widget->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'wixi_image_reveal_color',
                    'label' => esc_html__( 'Background', 'wixi' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .reveal-holder .reveal-block::before',
                    'separator' => 'before',
                    'condition' => ['wixi_image_reveal_switcher' => 'yes']
                ]
            );
            $widget->add_control( 'wixi_image_reveal_once',
                [
                    'label' => esc_html__( 'Animate Once?', 'wixi' ),
                    'type' => Controls_Manager::SWITCHER,
                    'condition' => ['wixi_image_reveal_switcher' => 'yes']
                ]
            );
            $widget->end_controls_section();
        }
    }
    public function wixi_after_render_widget( $widget )
    {
        $tilt_elements_attr = array(
            'image-box',
            'wixi-team-member',
            'wixi-services-item',
        );
        foreach ( $tilt_elements_attr as $w ) {
            if ( $w === $widget->get_name() && 'yes' === $widget->get_settings('wixi_tilt_effect_switcher') ) {
                wp_enqueue_script( 'tilt' );
            }
        }
        if ( 'image' === $widget->get_name() && 'yes' == $widget->get_settings('wixi_image_parallax_switcher') ) {
            wp_enqueue_script( 'simple-parallax' );
        }
        if ( 'image' === $widget->get_name() && 'yes' == $widget->get_settings('wixi_image_reveal_switcher') ) {
            wp_enqueue_style( 'aos' );
            wp_enqueue_script( 'aos' );
        }
        if( 'heading' === $widget->get_name() && 'yes' == $widget->get_settings('wixi_heading_split_switcher') ) {
            wp_enqueue_style( 'splitting' );
            wp_enqueue_style( 'splitting-cells' );
            wp_enqueue_script( 'splitting' );
            wp_enqueue_script( 'wow' );
        }
    }
    public function wixi_add_custom_attr_to_widget( $widget )
    {
        $template = basename( get_page_template() );

        if ( $template != 'locomotive-page.php' ) {
            if( 'image' === $widget->get_name() ) {

                if( 'yes' == $widget->get_settings('wixi_image_parallax_switcher') ) {
                    $mydata = array();
                    $overflow = $widget->get_settings('wixi_image_parallax_overflow');
                    $orientation = $widget->get_settings('wixi_image_parallax_orientation');
                    $scale = $widget->get_settings('wixi_image_parallax_scale');
                    $delay = $widget->get_settings('wixi_image_parallax_delay');
                    $maxtrans = $widget->get_settings('wixi_image_parallax_maxtransition');

                    $mydata[] .= $orientation ? '"orientation":"'.$orientation.'"' : '"orientation":"up"';
                    $mydata[] .= 'yes' == $overflow ? '"overflow": true' : '"overflow": false';
                    $mydata[] .= '' != $scale ? '"scale":'.$scale : '"scale":1.2';
                    $mydata[] .= '' != $delay ? '"delay":'.$delay : '"delay":0.4';
                    $mydata[] .= '' != $maxtrans ? '"maxtrans":'.$maxtrans : '"maxtrans":0';
                    $parallaxattr = '{'.implode(',', $mydata ).'}';
                    $widget->add_render_attribute( '_wrapper', 'data-image-parallax-settings', $parallaxattr);
                }
                if( 'yes' == $widget->get_settings('wixi_image_reveal_switcher') ) {
                    $mydata = array();
                    $orientation = $widget->get_settings('wixi_image_reveal_orientation');
                    $delay = $widget->get_settings('wixi_image_reveal_delay');
                    $offset = $widget->get_settings('wixi_image_reveal_offset');
                    $once = $widget->get_settings('wixi_image_reveal_once');

                    $mydata[] .= $orientation ? '"orientation":"'.$orientation.'"' : '"orientation":"left"';
                    $mydata[] .= '' != $delay ? '"delay":'.$delay : '"delay":""';
                    $mydata[] .= '' != $offset ? '"offset":'.$offset : '"offset":""';
                    $mydata[] .= '' != $once ? '"once": "true"' : '"once":"false"';
                    $revealattr = '{'.implode(',', $mydata ).'}';
                    $widget->add_render_attribute( '_wrapper', 'data-image-reveal-settings', $revealattr);
                }
            }

            if( 'heading' === $widget->get_name() ) {

                if( 'yes' == $widget->get_settings('wixi_heading_split_switcher') ) {

                    $animation = $widget->get_settings('wixi_heading_split_entrance_animation');
                    $animation = $animation ? $animation : 'fadeInUp';
                    $split_type = $widget->get_settings('wixi_heading_split_type');
                    $mydata = '{"type":"'.$split_type.'","animation":"'.$animation.'"}';
                    $widget->add_render_attribute( '_wrapper', 'data-split-settings', $mydata );
                }
            }
        }

        if ( $template == 'locomotive-page.php' ) {
            $loco_elements_attr = array(
                'image',
                'heading',
                'video',
                'text-editor',
                'button',
                'google_maps',
                'icon',
                'image-box',
                'icon-box',
                'star-rating',
                'image-carousel',
                'image-gallery',
                'icon-list',
                'counter',
                'progress',
                'testimonial',
                'tabs',
                'accordion',
                'toggle',
                'social-icons',
                'alert',
                'audio',
                'shortcode',
                'html',
                'sidebar',
                'spacer',
                'divider',
                'wixi-button',
                'wixi-button2',
                'wixi-team-member',
                'wixi-animated-headline',
                'wixi-services-item',
                'wixi-flip-card',
                'wixi-svg-animation',
                'wixi-odometer',
            );
            foreach ( $loco_elements_attr as $w ) {
                if ( $w === $widget->get_name() ) {

                    $widget->add_render_attribute( '_wrapper', 'data-scroll', '' );
                    if ( 'yes' === $widget->get_settings('wixi_locomotive_switcher') ) {

                        $lrepeat = 'yes' === $widget->get_settings('wixi_locomotive_entrance_animation_repeat') ? 'true' : 'false';

                        if ( 'image' === $widget->get_name() ) {
                            if ( 'yes' === $widget->get_settings('wixi_locomotive_image_parallax_switcher') ) {
                                $lspeed = $widget->get_settings('wixi_locomotive_image_parallax_speed');
                                $ldelay = '';
                            } else {
                                $lspeed = $widget->get_settings('wixi_locomotive_speed');
                                $ldelay = $widget->get_settings('wixi_locomotive_delay');
                            }
                        } else {
                            $lspeed = $widget->get_settings('wixi_locomotive_speed');
                            $ldelay = $widget->get_settings('wixi_locomotive_delay');
                        }
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-speed', $lspeed );
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-delay', $ldelay );
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-direction', $widget->get_settings('wixi_locomotive_direction') );
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-class', $widget->get_settings('wixi_locomotive_entrance_animation') );
                        //$widget->add_render_attribute( '_wrapper', 'data-scroll-sticky', $widget->get_settings('wixi_locomotive_sticky') );
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-repeat', $lrepeat );
                    }
                    if ( 'progress' === $widget->get_name() ) {
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-call', 'locoProgressBar' );
                    }
                    if ( 'counter' === $widget->get_name() ) {
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-call', 'locoCounterUp' );
                    }
                    if ( 'wixi-odometer' === $widget->get_name() ) {
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-call', 'locoOdometer' );
                    }
                    if ( 'image' === $widget->get_name() && 'yes' == $widget->get_settings('wixi_locomotive_image_parallax_switcher') ) {
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-call', 'locoParallaxImage' );
                    }
                }
            }
        }
        $tilt_elements_attr = array(
            'image-box',
            'wixi-team-member',
            'wixi-services-item',
        );
        foreach ( $tilt_elements_attr as $w ) {
            if ( $w === $widget->get_name() && 'yes' === $widget->get_settings('wixi_tilt_effect_switcher') ) {
                $transition = 'yes' === $widget->get_settings('wixi_tilt_effect_transition') ? 'true' : 'false';
                $reset = 'yes' === $widget->get_settings('wixi_tilt_effect_reset') ? 'true' : 'false';
                $glare = 'yes' === $widget->get_settings('wixi_tilt_effect_glare') ? 'true' : 'false';
                $widget->add_render_attribute( '_wrapper', 'data-tilt', '' );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-max', $widget->get_settings('wixi_tilt_effect_maxtilt') );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-perspective', $widget->get_settings('wixi_tilt_effect_perspective') );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-easing', $widget->get_settings('wixi_tilt_effect_easing') );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-scale', $widget->get_settings('wixi_tilt_effect_scale') );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-speed', $widget->get_settings('wixi_tilt_effect_speed') );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-disableaxis', $widget->get_settings('wixi_tilt_effect_disableaxis') );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-maxglare', $widget->get_settings('wixi_tilt_effect_maxglare') );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-transition', $transition );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-reset', $reset );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-glare', $glare );
            }
        }
    }

}
wixi_Customizing_Default_Widgets::get_instance();
