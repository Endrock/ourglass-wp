<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Vegas_Slider extends Widget_Base {
    use Wixi_Helper;
    public function get_name() {
        return 'wixi-vegas-slider';
    }
    public function get_title() {
        return 'Vegas Slider (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'wixi' ];
    }
    public function get_style_depends() {
        return [ 'vegas' ];
    }
    public function get_script_depends() {
        return [ 'vegas','splitting' ];
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
        $this->add_control( 'header',
            [
                'label' => esc_html__( 'Show Header', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'header_type',
            [
                'label' => esc_html__( 'Header Template', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'overlay',
                'options' => [
                    'overlay' => esc_html__( 'Default Overlay Menu', 'wixi' ),
                    'template' => esc_html__( 'Elementor Template', 'wixi' )
                ],
                'condition' => [ 'header' => 'yes' ]
            ]
        );
        $this->add_control( 'template',
            [
                'label' => esc_html__( 'Select Template', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => false,
                'options' => $this->wixi_get_elementor_templates(),
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'header',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'header_type',
                            'operator' => '==',
                            'value' => 'template'
                        ]
                    ]
                ]
            ]
        );
        $this->add_responsive_control( 'minheight',
            [
                'label' => esc_html__( 'Min Height ( vh )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 100,
                'selectors' => ['{{WRAPPER}} .home-slider-vegas-wrapper' => 'height: {{SIZE}}vh;min-height: {{SIZE}}vh;'],
                'separator' => 'before',
            ]
        );
        $def_image = plugins_url( 'assets/front/img/bg4.jpg', __DIR__ );
        $repeater = new Repeater();
        $repeater->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'wixi' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => $def_image],
            ]
        );
        $repeater->add_control( 'vurl',
            [
                'label' => esc_html__( 'Hosted Video URL', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '',
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'mute',
            [
                'label' => esc_html__( 'Video Mute', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['vurl!' => '']
            ]
        );
        $repeater->add_responsive_control( 'sdelay',
            [
                'label' => esc_html__( 'Delay ( ms )', 'wixi' ),
                'description' => esc_html__( 'Delay beetween slides in milliseconds.', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'step' => 100,
                'default' => '',
            ]
        );
        $repeater->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Slider Title',
                'pleaceholder' => esc_html__( 'Enter title here', 'wixi' ),
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'titleclr',
            [
                'label' => esc_html__( 'Title Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} {{CURRENT_ITEM}} .slider_hero_title' => 'color:{{VALUE}};' ]
            ]
        );
        $repeater->add_control( 'desc',
            [
                'label' => esc_html__( 'Description', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'pleaceholder' => esc_html__( 'Enter description here', 'wixi' ),
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'descclr',
            [
                'label' => esc_html__( 'Description Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} {{CURRENT_ITEM}} .slider_hero_desc' => 'color:{{VALUE}};' ]
            ]
        );
        $repeater->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Shop Now',
                'pleaceholder' => esc_html__( 'Enter button title here', 'wixi' ),
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'btn_link',
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
        $repeater->add_control( 'btnclr',
            [
                'label' => esc_html__( 'Button Title Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => ['btn_type' => 'btn-stext'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .btn-stext' => 'color:{{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .line' => 'background-color:{{VALUE}};',
                ]
            ]
        );
        $repeater->add_control( 'overlayclr',
            [
                'label' => esc_html__( 'Overlay Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'bgcolor',
            [
                'label' => esc_html__( 'Slide Background Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $repeater->add_control( 'text_alignment',
            [
                'label' => esc_html__( 'Text Alignment', 'wixi' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'wixi' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'wixi' ),
                        'icon' => 'fa fa-align-center'
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'wixi' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => 'text-left',
                'separator' => 'before'
            ]
        );
        $repeater->add_control( 'vertical_alignment',
            [
                'label' => esc_html__( 'Vertical Alignment', 'wixi' ),
                'type' => Controls_Manager::CHOOSE,
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
                'default' => '',
                'selectors' => [ '{{WRAPPER}} {{CURRENT_ITEM}}' => 'align-items:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'slides',
            [
                'label' => esc_html__( 'Slide Items', 'wixi' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'separator' => 'before',
                'default' => [
                    [
                        'image' => ['url' => $def_image],
                        'title' => 'From <span class="stroke">The</span><br> <span class="stroke">Inside</span> Out',
                        'btn_title' => 'Discover Work',
                        'btn_link' => '#0'
                    ],
                    [
                        'image' => ['url' => $def_image],
                        'title' => 'Luxury <br> <span class="stroke">Real</span>Estate',
                        'btn_title' => 'Discover Work',
                        'btn_link' => '#0'
                    ],
                    [
                        'image' => ['url' => $def_image],
                        'title' => 'Classic <br> <span class="stroke">&</span>Modern',
                        'btn_title' => 'Discover Work',
                        'btn_link' => '#0'
                    ],
                    [
                        'image' => ['url' => $def_image],
                        'title' => 'Explore <br> <span class="stroke">The</span>World',
                        'btn_title' => 'Discover Work',
                        'btn_link' => '#0'
                    ]
                ]
            ]
        );
        $this->add_control( 'home_slider_splitting_heading',
            [
                'label' => esc_html__( 'SPLITTING TEXT', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'splitting',
            [
                'label' => esc_html__( 'Splitting Heading and Button Text', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_responsive_control( 'split_spacing',
            [
                'label' => esc_html__( 'Heading Splitting Spacing', 'wixi' ),
                'description' => esc_html__( 'Spacing beetween words in px.', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'step' => 100,
                'default' => '',
                'selectors'  => ['{{WRAPPER}} .nt-vegas-slide-content .slider_hero_title span.whitespace' => 'margin-right:{{SIZE}}px;'],
                'condition' => ['splitting' => 'yes']
            ]
        );
        $this->add_responsive_control( 'split_btn_spacing',
            [
                'label' => esc_html__( 'Button Splitting Spacing', 'wixi' ),
                'description' => esc_html__( 'Spacing beetween words in px.', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'step' => 100,
                'default' => '',
                'selectors'  => ['{{WRAPPER}} .nt-vegas-slide-content .btn-stext span.whitespace' => 'margin-right:{{SIZE}}px;'],
                'condition' => ['splitting' => 'yes']
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

        $this->start_controls_section( 'slider_options_section',
            [
                'label' => esc_html__( 'Slider Options', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'animation',
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
                ]
            ]
        );
        $this->add_control( 'transition',
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
                ]
            ]
        );
        $this->add_control( 'overlay',
            [
                'label' => esc_html__( 'Overlay Image Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
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
                ]
            ]
        );
        $this->add_control( 'delay',
            [
                'label' => esc_html__( 'Delay ( ms )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 7000,
            ]
        );
        $this->add_control( 'duration',
            [
                'label' => esc_html__( 'Transition Duration ( ms )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2000,
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control( 'shuffle',
            [
                'label' => esc_html__( 'Shuffle', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'timer',
            [
                'label' => esc_html__( 'Timer', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'selectors'  => ['{{WRAPPER}} .vegas-timer' => 'display:block!important;'],
            ]
        );
        $this->add_control( 'timer_size',
            [
                'label' => esc_html__( 'Timer Height', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 5,
                'selectors'  => ['{{WRAPPER}} .vegas-timer' => 'height:{{VALUE}};'],
                'condition'  => ['timer' => 'yes'],
            ]
        );
        $this->add_control( 'timer_color',
            [
                'label' => esc_html__( 'Timer Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors'  => ['{{WRAPPER}} .vegas-timer-progress' => 'background-color:{{VALUE}};'],
                'condition'  => ['timer' => 'yes'],
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

        $this->wixi_style_color( 'home_slider_heading_color', '{{WRAPPER}} .nt-vegas-slide-content .slider_hero_title' );
        $this->wixi_style_typo( 'home_slider_heading_typo', '{{WRAPPER}} .nt-vegas-slide-content .slider_hero_title' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'home_slider_btn_style_section',
            [
                'label' => esc_html__( 'Button', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->wixi_style_color( 'home_slider_btn_color', '{{WRAPPER}} .nt-vegas-slide-content .btn-stext' );
        $this->wixi_style_typo( 'home_slider_btn_typo', '{{WRAPPER}} .nt-vegas-slide-content .btn-stext' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $settingsid = $this->get_id();
        $sliderattr = '';

        $autoplay = 'yes' == $settings['autoplay'] ? 'true' : 'false';
        $shuffle = 'yes' == $settings['shuffle'] ? 'true' : 'false';
        $timer = 'yes' == $settings['timer'] ? 'true' : 'false';
        $overlay = 'none' == $settings['overlay'] ? 'false' : 'true';


        $slides = array();
        foreach ( $settings['slides'] as $i ) {
            $sdelay = $i['sdelay'] ? ',"delay":'.$i['sdelay'] : '';
            $mute = 'yes' == $i['mute'] ? 'true' : 'false';
            $bgcolor = $i['bgcolor'] ? ',"color":"'.$i['bgcolor'].'"' : '';
            if ( $i['vurl'] != '' ) {
                $slides[] .= '{"src":"'.$i['image']['url'].'","video": {"src":"'.$i['vurl'].'","loop": false,"mute":'.$mute.'}'.$sdelay.$bgcolor.'}';
            } else {
                $slides[] .= '{"src":"'.$i['image']['url'].'"'.$sdelay.$bgcolor.'}';
            }
        }

        $animation = array();
        foreach ( $settings['animation'] as $anim ) {
            $animation[] .=  '"'.$anim.'"';
        }

        $transition = array();
        foreach ( $settings['transition'] as $trans ) {
            $transition[] .=  '"'.$trans.'"';
        }

        $sliderattr .= '"slides":['.implode(',', $slides).'],';
        $sliderattr .= '"animation":['.implode(',', $animation).'],';
        $sliderattr .= '"transition":['.implode(',', $transition).'],';
        $sliderattr .= '"delay":'.$settings['delay'].',';
        $sliderattr .= '"duration":'.$settings['duration'].',';
        $sliderattr .= '"timer":"'.$settings['timer'].'",';
        $sliderattr .= '"shuffle":"'.$settings['shuffle'].'",';
        $sliderattr .= '"overlay":"'.$settings['overlay'].'",';
        $sliderattr .= '"autoplay":'.$autoplay;
		$split_text = 'yes' == $settings['splitting'] ? ' data-splitting' : '';

        echo '<div class="home-slider-vegas-wrapper slider-vegas-'.$settingsid.'">';
            if ( 'yes' == $settings['header'] ) {
                if ( 'template' == $settings['header_type'] && !empty( $settings['template'] ) ) {
                    echo '<div class="header-template-wrapper">';
                        $style = \Elementor\Plugin::$instance->editor->is_edit_mode() ? true : false;
                        $template_id = $settings['template'];
                        $mega_content = new Frontend;
                        echo $mega_content->get_builder_content_for_display($template_id, $style );
                    echo '</div>';
                } else {
                    do_action('wixi_header_action');
                }
            }
            echo '<div id="slider-'.$settingsid.'" class="nt-home-slider-vegas" data-slider-settings=\'{'.$sliderattr.'}\'></div>';
            $countt = 1;
            foreach ( $settings['slides'] as $item ) {
                $target = $item['btn_link']['is_external'] ? ' target="_blank"' : '';
                $nofollow = $item['btn_link']['nofollow'] ? ' rel="nofollow"' : '';
                $hasvideo = '' != $item['vurl'] ? ' has-bg-video' : '';
                $vertical_alignment = '' != $item['vertical_alignment'] ? ' style="align-items:'.$item['vertical_alignment'].';"' : '';
                echo '<div class="nt-vegas-slide-content elementor-repeater-item-' . $item['_id'] . ' '.$item['text_alignment'].$hasvideo.'"'.$vertical_alignment.'>';
                    if( $item['overlayclr'] ){
                        echo '<div class="nt-vegas-overlay" style="background-color:'.$item['overlayclr'].';"></div>';
                    }
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-12">';

                                if( $item['title'] ){
                                    echo '<h1 class="slider_hero_title"'.$split_text.'>'.$item['title'].'</h1>';
                                }
                                if( $item['desc'] ){
                                    echo '<p class="slider_hero_desc">'.$item['desc'].'</p>';
                                }
                                if( $item['btn_title'] ){
                                    $splitting = 'btn-stext' == $item['btn_type'] ? $split_text : '';
                                    $line = 'btn-stext' == $item['btn_type'] ? ' <div class="line"></div>' : '';
                                    echo '<a href="'.$item['btn_link']['url'].'" '.$target.$nofollow.' class="'.$item['btn_type'].'"'.$splitting.'>'.$line.$item['btn_title'].'</a>';
                                }

                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                    if ( '' != $item['vurl'] && 'yes' != $item['mute'] ) {
                        echo '<div class="equaliser-container">';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                        echo '</div>';
                    }
                echo '</div>';
                $countt++;
            }

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

                if ( $settings['social2'] ) {
                    echo '<div class="social"><span class="icon"><i class="fas fa-share-alt"></i></span>';
                    foreach ( $settings['social2'] as $item ) {
                        $target = $item['link2']['is_external'] ? ' target="_blank"' : '';
                        echo '<a class="social_link" href="'.esc_attr( $item['link2']['url'] ).'"'.$target.'>';
                            if ( ! empty($item['social']['value']) ) {
                                Icons_Manager::render_icon( $item['social'], [ 'aria-hidden' => 'true' ] );
                            }
                        echo '</a>';
                    }
                    echo '</div>';
                }
            }
            echo '<div class="nt-vegas-slide-counter">';
                echo '<span class="current">0</span>';
                echo '<span class="separator"> / </span>';
                echo '<span class="total">4</span>';
            echo '</div>';

            echo '<div class="vegas-control">';
                echo '<span id="vegas-control-prev" class="vegas-control-prev vegas-control-btn"><i class="fas fa-caret-left"></i></span>';
                echo '<span id="vegas-control-next" class="vegas-control-next vegas-control-btn"><i class="fas fa-caret-right"></i></span>';
            echo '</div>';
        echo '</div>';

        // Not in edit mode
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) { ?>
            <script>
            jQuery(document).ready(function ($) {

                var myEl       = $('.slider-vegas-<?php echo $settingsid; ?>'),
                    myVegasId    = myEl.find('.nt-home-slider-vegas').attr('id'),
                    myVegas      = $( '#' + myVegasId ),
                    myPrev       = myEl.find('.vegas-control-prev'),
                    myNext       = myEl.find('.vegas-control-next'),
                    mySettings   = myEl.find('.nt-home-slider-vegas').data('slider-settings'),
                    myContent    = myEl.find('.nt-vegas-slide-content'),
                    myCounter    = myEl.find('.nt-vegas-slide-counter'),
                    mySocials    = myEl.find('.social .icon');

                if( mySettings.slides.length ) {

                    myVegas.vegas({
                        autoplay: <?php echo $autoplay; ?>,
                        delay: <?php echo $settings['delay']; ?>,
                        timer: <?php echo $timer; ?>,
                        shuffle: <?php echo $shuffle; ?>,
                        animation: [<?php echo implode(',', $animation); ?>],
                        transition: [<?php echo implode(',', $transition); ?>],
                        transitionDuration: <?php echo $settings['duration']; ?>,
                        overlay: <?php echo $overlay; ?>,
                        slides: [<?php echo implode(',', $slides); ?>],
                        init: function (globalSettings) {
                            myContent.eq(0).addClass('active');
                            var total = myContent.size();
                            myCounter.find('.total').html(total);
                        },
                        walk: function (index, slideSettings) {
                            myContent.removeClass('active').eq(index).addClass('active');
                            var current = index +1;
                            myCounter.find('.current').html(current);
                        }
                    });
                    myPrev.on('click', function () {
                        myVegas.vegas('previous');
                    });

                    myNext.on('click', function () {
                        myVegas.vegas('next');
                    });
                    mySocials.on( 'click', function () {
                        $( this ).parent().toggleClass( "active" );
                    });
                }
            });
            </script>
            <?php
        }
    }
}
