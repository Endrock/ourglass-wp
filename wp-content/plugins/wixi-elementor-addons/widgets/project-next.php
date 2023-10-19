<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Project_Next extends Widget_Base {
    use Wixi_Helper;
    public function get_name() {
        return 'wixi-project-next';
    }
    public function get_title() {
        return 'Project Next Post (N)';
    }
    public function get_icon() {
        return 'eicon-image';
    }
    public function get_categories() {
        return [ 'wixi-cpt' ];
    }
    public function get_style_depends() {
        return [ 'splitting','splitting-cells' ];
    }
    public function get_script_depends() {
        return [ 'splitting' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wixi_project_next_settings',
            [
                'label' => esc_html__('Projects Next Post', 'wixi'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'use_post_data',
            [
                'label' => esc_html__( 'Use Post Data ( Title / Permalink )', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Text Before Post Title', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Next Projects',
                'label_block' => true
            ]
        );
        $this->add_control( 'next_post_title',
            [
                'label' => esc_html__( 'Post Title', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => $this->wixi_cpt_get_next_post_title(),
                'label_block' => true,
                'condition' => ['use_post_data!' => 'yes']
            ]
        );
        $this->add_control( 'link',
            [
                'label' => esc_html__( 'Link', 'wixi' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => $this->wixi_cpt_get_next_post_permalink(),
                    'is_external' => ''
                ],
                'show_external' => true,
                'condition' => ['use_post_data!' => 'yes']
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'wixi_project_next_bg_style',
            [
                'label' => esc_html__( 'Background', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'bg_type',
            [
                'label' => esc_html__( 'Background Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => 'image',
                'options' => [
                    'image' => esc_html__( 'Custom Image', 'wixi' ),
                    'thumb' => esc_html__( 'Post Tumbnail', 'wixi' ),
                    'bg' => esc_html__( 'Custom Background', 'wixi' )
                ]
            ]
        );
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'wixi' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => plugins_url( 'assets/front/img/1.jpg', __DIR__ )],
                'condition' => ['bg_type' => 'image']
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'project_next_bg',
                'label' => esc_html__( 'Background', 'wixi' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .nxt-img.bg-cover',
                'condition' => ['bg_type' => 'bg']
            ]
        );
        $this->add_control( 'hide_overlay',
            [
                'label' => esc_html__( 'Hide Overlay Color', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'project_next_overlay',
            [
                'label' => esc_html__( 'Background Overlay Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .call-action.next:before' => 'background-color:{{VALUE}};' ],
                'condition' => [ 'hide_overlay!' => 'yes' ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'wixi_project_next_title_style',
            [
                'label' => esc_html__( 'Text Before Post Title', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['title!' => '']
            ]
        );
        $this->wixi_style_typo( 'project_text_typo','{{WRAPPER}} .call-action.next .content h6' );
        $this->add_control( 'project_text_color',
            [
                'label' => esc_html__( 'Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .call-action.next .content h6' => 'color:{{VALUE}};' ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'wixi_project_next_desc_style',
            [
                'label' => esc_html__( 'Next Post Title', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->wixi_style_typo( 'project_next_title_typo','{{WRAPPER}} .call-action.next .content h2' );
        $this->add_control( 'project_next_title_color',
            [
                'label' => esc_html__( 'Filled Text Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .call-action.next .content h2 > b.filled' => 'color:{{VALUE}};-webkit-text-stroke-color:{{VALUE}};-webkit-text-stroke-width:0;' ]
            ]
        );
        $this->add_control( 'project_next_title_otline_color',
            [
                'label' => esc_html__( 'Stroked Text Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .call-action.next .content h2' => '-webkit-text-stroke-color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'project_next_title_otline_width',
            [
                'label' => esc_html__( 'Stroke Width', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .call-action.next .content h2' => '-webkit-text-stroke-width:{{SIZE}}px;' ],
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings   = $this->get_settings_for_display();
        $hide_overlay = 'yes' == $settings['hide_overlay'] ? ' overlay-none' : '';
        if ( 'yes' == $settings['use_post_data'] ) {
            $link       = $this->wixi_cpt_get_next_post_permalink();
            $next_title = $this->wixi_cpt_get_next_post_title();
            $word_count = !empty($next_title) ? explode(' ',trim($next_title)) : '';
            $title      = is_array( $word_count ) && !empty($word_count[0]) ? str_replace ( $word_count[0], '<b class="filled">'.$word_count[0].'</b>', $next_title ) : '';
        } else {
            $link       = $settings['link']['url'] ? $settings['link']['url'] : $this->wixi_cpt_get_next_post_permalink();
            $word_count = !empty($settings['next_post_title']) ? explode(' ',trim($settings['next_post_title'])) : '';
            $title      = is_array( $word_count ) && !empty($word_count[0]) ? str_replace ( $word_count[0], '<b class="filled">'.$word_count[0].'</b>', $settings['next_post_title'] ) : $settings['next_post_title'];
        }
        $imageurl = '';
        $next_post = get_next_post();
        if ( 'thumb' == $settings['bg_type'] && ! empty( $next_post ) ) {
            $imageurl = get_the_post_thumbnail_url( $next_post->ID,'full' );
        }
        if ( 'image' == $settings['bg_type'] && !empty( $next_post ) && !empty( $settings['image']['url'] ) ) {
            $imageurl = $settings['image']['url'];
        }
        if ( 'bg' == $settings['bg_type'] && !empty( $settings['project_next_bg_image']['url'] ) ) {
            $imageurl = $settings['project_next_bg_image']['url'];
        }

        echo '<div class="call-action gif-none next'.$hide_overlay.'">';
            echo '<div class="container">';
                echo '<div class="row">';
                    echo '<div class="col-md-12">';
                        echo '<div class="content text-center">';
                            echo '<a href="'.$link.'">';
                                if ( $settings['title'] ) {
                                    echo '<h6 class="wow" data-splitting>'.$settings['title'].'</h6>';
                                }
                                if ( $title ) {
                                    echo '<h2 class="wow" data-splitting>'.$title.'</h2>';
                                }
                            echo '</a>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

            if ( $imageurl ) {
                $bgimage = '';
                if ( 'bg' != $settings['bg_type'] ) {
                    $bgimage = \Elementor\Plugin::$instance->editor->is_edit_mode() ? ' style="background-image:url('.$imageurl.');"' : ' data-wixi-background="'.$imageurl.'"';
                }
                echo '<div class="nxt-img bg-cover"'.$bgimage.'></div>';
            }

        echo '</div>';
    }
}
