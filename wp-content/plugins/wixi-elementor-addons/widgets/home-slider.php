<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Home_Slider extends Widget_Base {
    use Wixi_Helper;
    public function get_name() {
        return 'wixi-home-slider';
    }
    public function get_title() {
        return 'Content Slider (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'wixi' ];
    }
    public function get_style_depends() {
        return [ 'swiper' ];
    }
    public function get_script_depends() {
        return [ 'swiper','splitting' ];
    }

    // Registering Controls
    protected function register_controls() {
        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'home_slider_content_section',
            [
                'label' => esc_html__( 'Content', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'slider_position',
            [
                'label' => esc_html__( 'Position Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fixed',
                'options' => [
                    'fixed' => esc_html__( 'Fixed', 'wixi' ),
                    'static' => esc_html__( 'Static', 'wixi' )
                ]
            ]
        );
        $def_image = plugins_url( 'assets/front/img/bg4.jpg', __DIR__ );
        $repeater = new Repeater();
        $repeater->add_control( 'slider_image',
            [
                'label' => esc_html__( 'Image', 'wixi' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => $def_image]
            ]
        );
        $repeater->add_control( 'slider_image_768',
            [
                'label' => esc_html__( 'Responsive Image 768px', 'wixi' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => '']
            ]
        );
        $repeater->add_control( 'slider_image_576',
            [
                'label' => esc_html__( 'Responsive Image 576px', 'wixi' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => '']
            ]
        );
        $repeater->add_control( 'slider_subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'pleaceholder' => esc_html__( 'Enter subtitle here', 'wixi' )
            ]
        );
        $repeater->add_control( 'slider_title',
            [
                'label' => esc_html__( 'Title', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Slider Title',
                'pleaceholder' => esc_html__( 'Enter title here', 'wixi' )
            ]
        );
        $repeater->add_control( 'disable_stroke',
            [
                'label' => esc_html__( 'Default Text Style', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $repeater->add_control( 'slider_desc',
            [
                'label' => esc_html__( 'Description', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'pleaceholder' => esc_html__( 'Enter description here', 'wixi' )
            ]
        );
        $repeater->add_control( 'slider_btn_title',
            [
                'label' => esc_html__( 'Button Title', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Shop Now',
                'pleaceholder' => esc_html__( 'Enter button title here', 'wixi' )
            ]
        );
        $repeater->add_control( 'slider_btn_link',
            [
                'label' => esc_html__( 'Button Link', 'wixi' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#0',
                    'is_external' => 'true'
                ],
                'placeholder' => esc_html__( 'Place URL here', 'wixi' )
            ]
        );
        $repeater->add_control( 'btn_type',
            [
                'label' => esc_html__( 'Button Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'btn-stext',
                'options' => [
                    'btn-stext' => esc_html__( 'Default', 'wixi' ),
                    'button-slide c-light btn-radius mt-30' => esc_html__( 'Button Outline', 'wixi' )
                ]
            ]
        );
        $repeater->add_control( 'use_icon',
            [
                'label' => esc_html__( 'Use Icon', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'wixi' ),
                'label_off' => esc_html__( 'No', 'wixi' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $repeater->add_control( 'icon',
            [
                'label' => esc_html__( 'Button Icon', 'wixi' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => '',
                    'library' => 'solid'
                ],
                'condition' => ['use_icon' => 'yes']
            ]
        );
        $repeater->add_control( 'icon_pos',
            [
                'label' => esc_html__( 'Icon Position', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'btn-icon-right',
                'options' => [
                    'btn-icon-left' => esc_html__( 'Before', 'wixi' ),
                    'btn-icon-right' => esc_html__( 'After', 'wixi' )
                ],
                'condition' => ['use_icon' => 'yes']
            ]
        );
        $repeater->add_responsive_control( 'overlay',
            [
                'label' => esc_html__( 'Overlay Dark Size', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 9,
                'step' => 1,
                'default' => 3
            ]
        );
        $repeater->add_control( 'delay',
            [
                'label' => esc_html__( 'Slide Item Autoplay Delay', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 20000,
                'step' => 100,
                'default' => '',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'slider_items',
            [
                'label' => esc_html__( 'Slide Items', 'wixi' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{slider_title}}',
                'default' => [
                    [
                        'slider_image' => ['url' => $def_image],
                        'slider_title' => 'From <span class="stroke">The</span><br> <span class="stroke">Inside</span> Out',
                        'slider_btn_title' => 'Discover Work',
                        'slider_btn_link' => '#0'
                    ],
                    [
                        'slider_image' => ['url' => $def_image],
                        'slider_title' => 'Luxury <br> <span class="stroke">Real</span>Estate',
                        'slider_btn_title' => 'Discover Work',
                        'slider_btn_link' => '#0'
                    ],
                    [
                        'slider_image' => ['url' => $def_image],
                        'slider_title' => 'Classic <br> <span class="stroke">&</span>Modern',
                        'slider_btn_title' => 'Discover Work',
                        'slider_btn_link' => '#0'
                    ],
                    [
                        'slider_image' => ['url' => $def_image],
                        'slider_title' => 'Explore <br> <span class="stroke">The</span>World',
                        'slider_btn_title' => 'Discover Work',
                        'slider_btn_link' => '#0'
                    ]
                ]
            ]
        );
        $this->add_control( 'home_slider_social_heading',
            [
                'label' => esc_html__( 'SOCIAL MEDIA', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'social_type',
            [
                'label' => esc_html__( 'Social Media Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'text' => esc_html__( 'Text', 'wixi' ),
                    'icon' => esc_html__( 'Icon', 'wixi' )
                ]
            ]
        );
        $repeater2 = new Repeater();
        $repeater2->add_control( 'social_text',
            [
                'label' => esc_html__( 'Social Name', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Behance'
            ]
        );
        $repeater2->add_control( 'link',
            [
                'label' => esc_html__( 'Link', 'wixi' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'Place URL here', 'wixi' )
            ]
        );
        $this->add_control( 'socials',
            [
                'label' => esc_html__( 'Socials', 'wixi' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater2->get_controls(),
                'title_field' => '{{social_text}}',
                'default' => [
                    [
                        'social_text' => 'Facebook'
                    ],
                    [
                        'social_text' => 'Twitter'
                    ],
                    [
                        'social_text' => 'Behance'
                    ]
                ],
                'condition' => ['social_type' => 'text']
            ]
        );
        $repeater3 = new Repeater();
        $repeater3->add_control( 'social',
            [
                'name' => 'social',
                'label' => esc_html__( 'Icon', 'wixi' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-wordpress',
                    'library' => 'fa-brands'
                ]
            ]
        );
        $repeater3->add_control( 'link2',
            [
                'label' => esc_html__( 'Link', 'wixi' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'Place URL here', 'wixi' )
            ]
        );
        $this->add_control( 'social2',
            [
                'label' => esc_html__( 'Socials', 'wixi' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater3->get_controls(),
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
                'condition' => ['social_type' => 'icon']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/


        $this->start_controls_section( 'home_slider_section',
            [
                'label' => esc_html__( 'Slider Options', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'speed',
            [
                'label' => esc_html__( 'Speed', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 100,
                'default' => 1000,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'parallax',
            [
                'label' => esc_html__( 'Parallax', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'loop',
            [
                'label' => esc_html__( 'Loop', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'home_slider_heading_style_section',
            [
                'label' => esc_html__( 'Heading', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->wixi_style_color( 'home_slider_heading_color', '{{WRAPPER}} .swiper-slide .slider_hero_title' );
        $this->add_control( 'home_slider_heading_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .swiper-slide .slider_hero_title:not(.splitting) a:hover,{{WRAPPER}} .swiper-slide .slider_hero_title.splitting a:hover > span:not(.stroke) span' => 'color:{{VALUE}};' ],
            ]
        );
        $this->wixi_style_typo( 'home_slider_heading_typo', '{{WRAPPER}} .swiper-slide .slider_hero_title' );
        $this->wixi_style_text_alignment( 'home_slider_heading_alignment', '{{WRAPPER}} .swiper-slide .caption' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'home_slider_btn_style_section',
            [
                'label' => esc_html__( 'Button', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'label' => esc_html__( 'Typography', 'wixi' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .button-slide'
            ]
        );
        $this->start_controls_tabs('wixi_btn_tabs');
        $this->start_controls_tab( 'wixi_btn_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wixi' ) ]
        );

            $this->add_control( 'btn_color',
                [
                    'label' => esc_html__( 'Color', 'wixi' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => ['{{WRAPPER}} .button-slide, {{WRAPPER}} .slider .parallax-slider .caption .btn-stext' => 'color: {{VALUE}};']
                ]
            );

            $this->add_responsive_control( 'btn_padding',
                [
                    'label' => esc_html__( 'Padding', 'wixi' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors' => ['{{WRAPPER}} .button-slide' => 'padding-top: {{TOP}}{{UNIT}};padding-right: {{RIGHT}}{{UNIT}};padding-bottom: {{BOTTOM}}{{UNIT}};padding-left: {{LEFT}}{{UNIT}};'],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                    ],
                    'separator' => 'before'
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'btn_border',
                    'label' => esc_html__( 'Border', 'wixi' ),
                    'selector' => '{{WRAPPER}} .button-slide',
                    'separator' => 'before'
                ]
            );
            $this->add_responsive_control( 'btn_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'wixi' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors' => ['{{WRAPPER}} .button-slide' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                    ],
                    'separator' => 'before'
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'btn_background',
                    'label' => esc_html__( 'Background', 'wixi' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .button-slide',
                    'separator' => 'before'
                ]
            );
        $this->end_controls_tab();

        $this->start_controls_tab('wixi_btn_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wixi' ) ]
        );
         $this->add_control( 'btn_hvr_color',
            [
                'label' => esc_html__( 'Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .button-slide:hover, {{WRAPPER}} .slider .parallax-slider .caption .btn-stext' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_hvr_border',
                'label' => esc_html__( 'Border', 'wixi' ),
                'selector' => '{{WRAPPER}} .button:hover',
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_hvr_background',
                'label' => esc_html__( 'Background', 'wixi' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .button-slide:after, {{WRAPPER}} .slider .parallax-slider .caption .btn-stext:after',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('home_slider_nav_style_section',
            [
                'label'=> esc_html__( 'Nav Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->start_controls_tabs( 'home_slider_nav_tabs');
        $this->start_controls_tab( 'home_slider_nav_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'wixi' ) ]
        );

		$this->wixi_style_bgcolor( 'home_slider_nav_background','{{WRAPPER}} .slide-controls .swiper-button-next, {{WRAPPER}} .slide-controls .swiper-button-prev' );
		$this->wixi_style_color( 'home_slider_color','{{WRAPPER}} .slide-controls .swiper-button-next, {{WRAPPER}} .slide-controls .swiper-button-prev' );
        $this->wixi_style_border( 'home_slider_border','{{WRAPPER}} .slide-controls .swiper-button-next, {{WRAPPER}} .slide-controls .swiper-button-prev' );
        $this->add_control( 'home_slider_line_color',
            [
                'label' => esc_html__( 'Line Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-next i:after, .slide-controls .swiper-button-prev i:after' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab( 'home_slider_nav_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wixi' ) ]
        );

		$this->wixi_style_bgcolor( 'home_slider_nav_hvr_background','{{WRAPPER}} .slide-controls .swiper-button-next:hover, {{WRAPPER}} .slide-controls .swiper-button-prev:hover' );
		$this->wixi_style_color( 'home_slider_hvr_color','{{WRAPPER}} .slide-controls .swiper-button-next:hover, {{WRAPPER}} .slide-controls .swiper-button-prev:hover' );
        $this->wixi_style_border( 'home_slider_hvr_border','{{WRAPPER}} .slide-controls .swiper-button-next:hover, {{WRAPPER}} .slide-controls .swiper-button-prev:hover' );
        $this->add_control( 'home_slider_line_hvr_color',
            [
                'label' => esc_html__( 'Line Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-next:hover i:after, .slide-controls .swiper-button-prev:hover i:after' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control( 'home_slider_prev_heading',
            [
                'label' => __( 'PREV POSITION', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'home_slider_prev_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-prev' => 'left:{{SIZE}}%;' ],
            ]
        );
        $this->add_responsive_control( 'home_slider_prev_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-prev' => 'top:{{SIZE}}%;' ],
            ]
        );
        $this->add_control( 'home_slider_next_heading',
            [
                'label' => __( 'NEXT POSITION', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'home_slider_next_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-next' => 'left:{{SIZE}}%;' ],
            ]
        );
        $this->add_responsive_control( 'home_slider_next_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-next' => 'top:{{SIZE}}%;' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $settingsid = $this->get_id();

        $speed    = $settings['speed'] ? $settings['speed'] : 1000;
        $parallax = 'yes' == $settings['parallax'] ? 'true' : 'false';
        $autoplay = 'yes' == $settings['autoplay'] ? 'true' : 'false';
        $loop     = 'yes' == $settings['loop'] ? 'true'     : 'false';

        $count1 = 1;
        $count2 = 1;
        $tablet = array();
        $phone = array();

        foreach ( $settings['slider_items'] as $item ) {
            if( !empty( $item['slider_image_768']['url'] ) ){
                $tablet[] .= '.slider-id-'.$settingsid.' .bg-cover.slide-item-'.$count1.'{background-image:url('.$item['slider_image_768']['url'].')!important;}';
            }
            $count1++;
        }
        foreach ( $settings['slider_items'] as $item ) {
            if( !empty( $item['slider_image_576']['url'] ) ){
                $phone[] .= '.slider-id-'.$settingsid.' .bg-cover.slide-item-'.$count2.'{background-image:url('.$item['slider_image_576']['url'].')!important;}';
            }
            $count2++;
        }
        if( !empty( $tablet ) || !empty( $phone ) ){
            echo '<style>';
                if( !empty( $tablet ) ){
                    echo '@media(max-width:768px){';
                        echo implode('', $tablet);
                    echo '}';
                }
                if( !empty( $phone ) ){
                    echo '@media(max-width:576px){';
                        echo implode( '', $phone );
                    echo '}';
                }
            echo '</style>';
        }

        echo '<div class="slider home-slider '.$settings['slider_position'].'-slider slide-controls slider-id-'.$settingsid.'" data-slider-settings=\'{"autoplay":'.$autoplay.',"parallax":'.$parallax.',"loop":'.$loop.',"speed":'.$speed.'}\'>';
            echo '<div class="swiper-container parallax-slider">';
                echo '<div class="swiper-wrapper">';
                    $countt = 1;
                    foreach ( $settings['slider_items'] as $item ) {
                        $res_tablet = !empty( $item['slider_image_768']['url'] ) ? $item['slider_image_768']['url'] : '';
                        $res_phone = !empty( $item['slider_image_576']['url'] ) ? $item['slider_image_576']['url'] : '';
                        $bgimg = ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) ? 'style="background-image:url('.$item['slider_image']['url'].');"' : 'data-wixi-background="'.$item['slider_image']['url'].'"';
                        $target = $item['slider_btn_link']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $item['slider_btn_link']['nofollow'] ? ' rel="nofollow"' : '';
                        $btnhref = $item['slider_btn_link']['url'];
                        $deftitle = 'yes' == $item['disable_stroke'] ? ' clasc' : '';
                        $delay = 'yes' == $settings['autoplay'] && $item['delay'] ? ' data-swiper-autoplay="'.$item['delay'].'"' : '';
                        echo '<div class="swiper-slide"'.$delay.'>';
                            echo '<div class="bg-cover vert-align slide-item-'.$countt.'" '.$bgimg.' data-overlay-dark="'.$item['overlay'].'" data-responsive-img=\'{"phone":"'.$res_phone.'","tablet":"'.$res_tablet.'"}\'>';
                                echo '<div class="container">';
                                    echo '<div class="row">';
                                        echo '<div class="col-lg-12 offset-lg-1">';
                                            echo '<div class="caption'.$deftitle.'">';
                                                if( $item['slider_subtitle'] ){
                                                    echo '<div class="slider_hero_subtitle" data-splitting>'.$item['slider_subtitle'].'</div>';
                                                }
                                                if( $item['slider_title'] ){
                                                    echo '<h1 class="slider_hero_title" data-splitting>'.$item['slider_title'].'</h1>';
                                                }
                                                if( $item['slider_desc'] ){
                                                    echo '<p class="slider_hero_desc">'.$item['slider_desc'].'</p>';
                                                }
                                                if( $item['slider_btn_title'] ){
                                                    if ( $item['btn_type'] == 'btn-stext' ) {
                                                        echo '<a href="'.$btnhref.'" '.$target.$nofollow.' class="btn-stext" data-splitting>'.$item['slider_btn_title'].'</a>';
                                                    } else {
                                                        if ( $item['icon_pos'] == 'btn-icon-left' ) {
                                                            echo '<a href="'.$btnhref.'" '.$target.$nofollow.' class="button-slide c-light btn-radius mt-40 btn-icon-left" '.$splitting.'>';
                                                            if ( !empty($item['icon']['value']) ) { Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); } echo $item['slider_btn_title'].'</a>';
                                                        } else {
                                                            echo '<a href="'.$btnhref.'" '.$target.$nofollow.' class="button-slide c-light btn-radius mt-40 btn-icon-right">'.$item['slider_btn_title'].' ';
                                                            if ( !empty($item['icon']['value']) ) { Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); } echo '</a>';
                                                        }
                                                    }

                                                }
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                        $countt++;
                    }

                echo '</div>';

                if ( 'text' == $settings['social_type'] ) {
                    if ( $settings['socials'] ) {
                        echo '<div class="social"><span class="icon"><i class="fas fa-share-alt"></i></span>';
                        foreach ( $settings['socials'] as $item ) {
                            $target = $item['link']['is_external'] ? ' target="_blank"' : '';
                            echo '<a class="social_link" href="'.esc_attr( $item['link']['url'] ).'"'.$target.'>'.$item['social_text'].'</a>';
                        }
                        echo '</div>';
                    }

                } else {

                    if ( $settings['socials2'] ) {
                        echo '<div class="social"><span class="icon"><i class="fas fa-share-alt"></i></span>';
                        foreach ( $settings['socials2'] as $item ) {
                            $target = $item['link']['is_external'] ? ' target="_blank"' : '';
                            echo '<a class="social_link" href="'.esc_attr( $item['link2']['url'] ).'"'.$target.'>';
                                if ( ! empty($item['social']['value']) ) {
                                    Icons_Manager::render_icon( $item['social'], [ 'aria-hidden' => 'true' ] );
                                }
                            echo '</a>';
                        }
                        echo '</div>';
                    }
                }
                echo '<div class="swiper-button-next swiper-nav-ctrl next-ctrl"><i class="fas fa-caret-right"></i></div>
                <div class="swiper-button-prev swiper-nav-ctrl prev-ctrl"><i class="fas fa-caret-left"></i></div>
                <div class="swiper-pagination"></div>';

            echo '</div>';
        echo '</div>';
    }
}
