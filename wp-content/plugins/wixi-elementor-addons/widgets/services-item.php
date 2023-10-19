<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Services_Item extends Widget_Base {
    use Wixi_Helper;
    public function get_name() {
        return 'wixi-services-item';
    }
    public function get_title() {
        return 'Services Item (N)';
    }
    public function get_icon() {
        return 'eicon-columns';
    }
    public function get_categories() {
        return [ 'wixi' ];
    }
    public function get_script_depends() {
        return [ 'drawsvg' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wixi_services_one_items_settings',
            [
                'label' => esc_html__('Services Item', 'wixi')
            ]
        );
        $this->add_control( 'use_ionicon',
            [
                'label' => esc_html__( 'Use Ion Icon', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes'
            ]
        );
        $this->add_control( 'ionicon',
            [
                'label' => esc_html__( 'Icon Name', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'ion-ios-monitor',
                'pleaceholder' => 'ion-ios-monitor',
                'label_block' => true,
                'condition' => ['use_ionicon' => 'yes']
            ]
        );
        $this->add_control( 'icon',
            [
                'label' => esc_html__('Icon', 'wixi'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-home',
                    'library' => 'fa-solid'
                ],
                'condition' => ['use_ionicon!' => 'yes']
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Interface Design',
                'label_block' => true
            ]
        );
        $this->add_control( 'desc',
            [
                'label' => esc_html__( 'Description', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Implementation and rollout of new network infrastructure,including consolidation.',
                'label_block' => true
            ]
        );
        $this->add_control( 'link',
            [
                'label' => esc_html__( 'Link', 'wixi' ),
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

        $this->start_controls_section( 'wixi_services_box_style',
            [
                'label' => esc_html__( 'Box', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs('services_box_tabs');
        $this->start_controls_tab( 'services_box_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wixi' ) ]
        );
        $this->wixi_style_background( $id='services_box_normal_bg','{{WRAPPER}} .services.items',['classic','gradient'] );
        $this->wixi_style_border( 'services_box_normal_border','{{WRAPPER}} .services.items' );
        $this->wixi_style_box_shadow( 'services_box_normal_box_shadow','{{WRAPPER}} .services.items' );
        $this->add_control( 'services_normal_icon',
            [
                'label' => esc_html__( 'Icon Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .services .services_icon.icon' => 'color:{{VALUE}};' ],
                'separator' => 'before'
            ]
        );
        $this->add_control( 'services_normal_title',
            [
                'label' => esc_html__( 'Title Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .services .services_title' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'services_normal_desc',
            [
                'label' => esc_html__( 'Description Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .services .service_summary' => 'color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab('services_box_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wixi' ) ]
        );
        $this->wixi_style_background( $id='services_box_hover_bg','{{WRAPPER}} .services.items:hover',['classic','gradient'] );
        $this->wixi_style_border( 'services_box_hover_border','{{WRAPPER}} .services.items:hover' );
        $this->wixi_style_box_shadow( 'services_box_hover_box_shadow','{{WRAPPER}} .services.items.items:hover' );
        $this->add_control( 'services_active_icon',
            [
                'label' => esc_html__( 'Icon Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .services-container:hover .services_icon.icon' => 'color:{{VALUE}};' ],
                'separator' => 'before'
            ]
        );
        $this->add_control( 'services_active_title',
            [
                'label' => esc_html__( 'Title Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .services-container:hover .services_title' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'services_active_desc',
            [
                'label' => esc_html__( 'Description Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .services-container:hover .service_summary' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'services_active_arrow',
            [
                'label' => esc_html__( 'Arrow Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .services-container .items .arrow-icon span, {{WRAPPER}} .services-container .items .arrow-icon span:after, {{WRAPPER}} .services-container .items .arrow-icon span:before' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section( 'wixi_services_icon_style',
            [
                'label' => esc_html__( 'Icon', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wixi_style_controls(array('color','shadow','background'),$id='services_icon',$selector='.services_icon.icon, {{WRAPPER}} .services_icon .icon');
        $this->end_controls_section();

        $this->start_controls_section( 'wixi_services_title_style',
            [
                'label' => esc_html__( 'Title', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['title!' => '']
            ]
        );
        $this->wixi_style_controls(array('color','shadow'),$id='services_title',$selector='.services_title');
        $this->end_controls_section();

        $this->start_controls_section( 'wixi_services_desc_style',
            [
                'label' => esc_html__( 'Description', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['desc!' => '']
            ]
        );
        $this->wixi_style_controls(array('color','shadow'),$id='services_desc',$selector='.services .service_summary');
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';

        echo '<div class="about services-container">';
            echo '<div class="services items">';
                echo '<div class="item wow fadeIn">';

                    if ( 'yes' == $settings['use_ionicon'] ) {
                        echo '<span class="services_icon icon"><i class="'.$settings['ionicon'].'"></i></span>';
                    } else {
                        if ( ! empty( $settings['icon']['value'] ) ) {
                            echo '<span class="services_icon icon">';
                                Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                            echo '</span>';
                        }
                    }
                    if ( $settings['title'] ) {
                        echo '<h5 class="services_title">'.$settings['title'].'</h5>';
                    }
                    if ( $settings['desc'] ) {
                        echo '<p class="service_summary">'.$settings['desc'].'</p>';
                    }
                    if( $settings['link']['url'] ) {
                        echo '<a href="'.$settings['link']['url'].'"'.$target.$nofollow.' class="arrow-icon"><span></span></a>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}
