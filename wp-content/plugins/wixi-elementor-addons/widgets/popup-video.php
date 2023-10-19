<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Popup_Video extends Widget_Base {
    use Wixi_Helper;
    public function get_name() {
        return 'wixi-popup-video';
    }
    public function get_title() {
        return 'Popup Video (N)';
    }
    public function get_icon() {
        return 'eicon-youtube';
    }
    public function get_categories() {
        return [ 'wixi' ];
    }
    public function get_style_depends() {
        return [ 'youtube-popup' ];
    }
    public function get_script_depends() {
        return [ 'youtube-popup' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wixi_popup_video_settings',
            [
                'label' => esc_html__('Popup Video', 'wixi'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'video',
            [
                'label' => esc_html__( 'Title', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'https://vimeo.com/127203262',
                'label_block' => true
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'wixi_popup_icon_style',
            [
                'label' => esc_html__( 'Icon', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control( 'wixi_popup_icon_alignment',
            [
                'label' => esc_html__( 'Alignment', 'wixi' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .popup-video-wrapper' => 'text-align: {{VALUE}};'],
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
        $this->add_responsive_control( 'wixi_popup_icon_size',
            [
                'label' => esc_html__( 'Size', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popup-video .vid-btn .icon' => 'width:{{SIZE}}px;height:{{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'projects_popup_icon_color',
            [
                'label' => esc_html__( 'Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popup-video .vid-btn .icon' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'projects_popup_icon_brd_color',
            [
                'label' => esc_html__( 'Border Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popup-video .vid-btn .icon' => 'color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'projects_popup_icon_outline_color',
            [
                'label' => esc_html__( 'Outline Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popup-video .vid-btn .icon:after' => 'border-color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'projects_popup_icon_hvrbg_color',
            [
                'label' => esc_html__( 'Background Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popup-video .vid-btn .icon:before' => 'background-color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'projects_popup_icon_hvrbgcolor',
            [
                'label' => esc_html__( 'Hover Background Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popup-video .vid-btn:hover .icon:after' => 'background-color:{{VALUE}};transform: scale(1);-webkit-transform: scale(1);' ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( $settings['video'] ) {
            echo '<div class="popup-video-wrapper">
            <a class="popup-video" href="'.$settings['video'].'">
                <div class="vid-btn">
                    <span class="icon"><i class="fas fa-play"></i></span>
                </div>
            </a>
            </div>';
        }
    }
}
