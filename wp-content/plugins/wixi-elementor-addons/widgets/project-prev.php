<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Project_Prev extends Widget_Base {
    use Wixi_Helper;
    public function get_name() {
        return 'wixi-project-prev';
    }
    public function get_title() {
        return 'Project Previous Post (N)';
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
        $this->start_controls_section( 'wixi_project_prev_settings',
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
                'default' => 'Previous Projects',
                'label_block' => true
            ]
        );
        $this->add_control( 'prev_post_title',
            [
                'label' => esc_html__( 'Post Title', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => $this->wixi_cpt_get_prev_post_title(),
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
                    'url' => $this->wixi_cpt_get_prev_post_permalink(),
                    'is_external' => ''
                ],
                'show_external' => true,
                'condition' => ['use_post_data!' => 'yes']
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'wixi_project_prev_bg_style',
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
                'name' => 'project_prev_bg',
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
                'selectors' => [ '{{WRAPPER}} .call-action.prev:before' => 'content:none;' ],
            ]
        );
        $this->add_control( 'project_prev_overlay',
            [
                'label' => esc_html__( 'Background Overlay Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .call-action.prev:before' => 'background-color:{{VALUE}};' ],
                'condition' => [ 'hide_overlay!' => 'yes' ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'wixi_project_prev_title_style',
            [
                'label' => esc_html__( 'Text Before Post Title', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['title!' => '']
            ]
        );
        $this->wixi_style_typo( 'project_text_typo','{{WRAPPER}} .call-action.prev .content h6' );
        $this->add_control( 'project_text_color',
            [
                'label' => esc_html__( 'Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .call-action.prev .content h6' => 'color:{{VALUE}};' ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'wixi_project_prev_desc_style',
            [
                'label' => esc_html__( 'Next Post Title', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->wixi_style_typo( 'project_prev_title_typo','{{WRAPPER}} .call-action.prev .content h2' );
        $this->add_control( 'project_prev_title_color',
            [
                'label' => esc_html__( 'Filled Text Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .call-action.prev .content h2 > b.filled' => 'color:{{VALUE}};-webkit-text-stroke-color:{{VALUE}};-webkit-text-stroke-width:0;' ]
            ]
        );
        $this->add_control( 'project_prev_title_otline_color',
            [
                'label' => esc_html__( 'Stroked Text Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .call-action.prev .content h2' => '-webkit-text-stroke-color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'project_prev_title_otline_width',
            [
                'label' => esc_html__( 'Stroke Width', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .call-action.prev .content h2' => '-webkit-text-stroke-width:{{SIZE}}px;' ],
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings   = $this->get_settings_for_display();
        $hide_overlay = 'yes' == $settings['hide_overlay'] ? ' overlay-none' : '';
        if ( 'yes' == $settings['use_post_data'] ) {
            $link       = $this->wixi_cpt_get_prev_post_permalink();
            $prev_title = $this->wixi_cpt_get_prev_post_title();
            $word_count = !empty($prev_title) ? explode(' ',trim($prev_title)) : '';
            $title      = is_array( $word_count ) && !empty($word_count[0]) ? str_replace ( $word_count[0], '<b class="filled">'.$word_count[0].'</b>', $prev_title ) : '';
        } else {
            $link       = $settings['link']['url'] ? $settings['link']['url'] : $this->wixi_cpt_get_prev_post_permalink();
            $word_count = !empty($settings['prev_post_title']) ? explode(' ',trim($settings['prev_post_title'])) : '';
            $title      = is_array( $word_count ) && !empty($word_count[0]) ? str_replace ( $word_count[0], '<b class="filled">'.$word_count[0].'</b>', $settings['prev_post_title'] ) : $settings['prev_post_title'];
        }

        $prev_post = get_previous_post();
        if ( 'thumb' == $settings['bg_type'] && ! empty( $prev_post ) ) {
            $imageurl = get_the_post_thumbnail_url( $prev_post->ID,'full' );
        }
        if ( 'image' == $settings['bg_type'] && !empty( $prev_post ) && !empty( $settings['image']['url'] ) ) {
            $imageurl = $settings['image']['url'];
        }
        if ( 'bg' == $settings['bg_type'] && !empty( $settings['project_prev_bg_background'] ) ) {
            $imageurl = $settings['project_prev_bg_image']['url'];
        }

        echo '<div class="call-action gif-none prev'.$hide_overlay.'">';
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
                echo '<div class="prev-img bg-cover"'.$bgimage.'></div>';
            }

        echo '</div>';

    }
}
