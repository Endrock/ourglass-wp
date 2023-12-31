<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Page_Hero extends Widget_Base {
    use Wixi_Helper;
    public function get_name() {
        return 'wixi-page-hero';
    }
    public function get_title() {
        return 'Post Page Hero (N)';
    }
    public function get_icon() {
        return 'eicon-columns';
    }
    public function get_categories() {
        return [ 'wixi' ];
    }
    public function get_script_depends() {
        return [ 'parallaxie' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wixi_page_hero_settings',
            [
                'label'=> esc_html__( 'Text', 'wixi' ),
                'tab'=> Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Type 1', 'wixi' ),
                    '2' => esc_html__( 'Type 2', 'wixi' )
                ]
            ]
        );
        $this->add_control( 'desc',
            [
                'label' => esc_html__( 'Page Description', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'We believe that every <b>project</b> existing in <b>digital world</b> is a result of an <b>idea</b> and every idea has a cause.',
                'label_block' => true,
                'condition' => [ 'type' => '2' ],
            ]
        );
        $this->add_control( 'title_type',
            [
                'label' => esc_html__( 'Title Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => 'page',
                'options' => [
                    'page' => esc_html__( 'Page Title', 'wixi' ),
                    'custom' => esc_html__( 'Custom Text', 'wixi' )
                ]
            ]
        );
        $this->add_control( 'first_stroke',
            [
                'label' => esc_html__( 'First Word Stroked?', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => [ 'title_type' => 'page' ],
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => get_the_title(),
                'label_block' => true,
                'condition' => [ 'title_type' => 'custom' ],
                'description' => esc_html__( 'Please wrap your text <b></b>, if you want to use stroke text.', 'wixi' ),
            ]
        );
        $this->add_control( 'hide_image',
            [
                'label' => esc_html__( 'Hide Image', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'custom_image',
            [
                'label' => esc_html__( 'Use Custom Image?', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
                'condition' => [ 'hide_image!' => 'yes' ],
            ]
        );
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Bottom Parallax Image', 'wixi' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => plugins_url( 'assets/front/img/project-def.jpg', __DIR__ )],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        ['name' => 'custom_image','operator' => '==','value' => 'yes'],
                        ['name' => 'use_bg','operator' => '!=','value' => 'yes'],
                    ]
                ]
            ]
        );
        $this->add_control( 'use_bg',
            [
                'label' => esc_html__( 'Use Background Image ( for Mobile )', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
                'condition' => [ 'hide_image!' => 'yes' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'custom_bg',
                'label' => esc_html__( 'Background', 'wixi' ),
                'description' => esc_html__( 'You can use this option for different image sizes on different devices.', 'wixi' ),
                'types' => ['classic'],
                'selector' => '{{WRAPPER}} .page-header.type-project .img-wrapper',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        ['name' => 'hide_image','operator' => '!=','value' => 'yes'],
                        ['name' => 'use_bg','operator' => '==','value' => 'yes'],
                    ]
                ]
            ]
        );
        $this->add_control( 'speed',
            [
                'label' => esc_html__( 'Parallax Speed', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -1,
                'max' => 1,
                'step' => 0.1,
                'default' => 0.2,
                'separator' => 'before',
                'condition' => [ 'hide_image!' => 'yes' ],
            ]
        );
        $this->add_control( 'mdspeed',
            [
                'label' => esc_html__( 'Parallax Speed ( Tablet )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -1,
                'max' => 1,
                'step' => 0.1,
                'default' => 0.2,
                'condition' => [ 'hide_image!' => 'yes' ],
            ]
        );
        $this->add_control( 'smspeed',
            [
                'label' => esc_html__( 'Parallax Speed ( Phone )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -1,
                'max' => 1,
                'step' => 0.1,
                'default' => 0.2,
                'condition' => [ 'hide_image!' => 'yes' ],
            ]
        );
        $this->add_responsive_control( 'height',
            [
                'label' => esc_html__( 'Parallax Image Min Height', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'condition' => [ 'hide_image!' => 'yes' ],
                'selectors' => ['{{WRAPPER}} .page-header.type-project .img-wrapper' => 'min-height: auto; padding-top:{{SIZE}}%!important;'],
            ]
        );
        $this->add_responsive_control( 'bgsize',
            [
                'label' => esc_html__( 'Background Image Size', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => 'cover',
                'options' => [
                    'cover' => esc_html__( 'Cover', 'wixi' ),
                    'contain' => esc_html__( 'Contain', 'wixi' )
                ],
                'selectors' => ['{{WRAPPER}} .page-header.type-project .img-wrapper' => 'background-size: {{VALUE}}!important;'],
            ]
        );
        $this->add_control( 'offset',
            [
                'label' => esc_html__( 'Offset', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -500,
                'max' => 500,
                'step' =>1,
                'default' => '',
                'condition' => [ 'hide_image!' => 'yes' ],
            ]
        );
        $this->add_control( 'mdoffset',
            [
                'label' => esc_html__( 'Offset Tablet', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -500,
                'max' => 500,
                'step' =>1,
                'default' => '',
                'condition' => [ 'hide_image!' => 'yes' ],
            ]
        );
        $this->add_control( 'smoffset',
            [
                'label' => esc_html__( 'Offset Phone', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -500,
                'max' => 500,
                'step' =>1,
                'default' => '',
                'condition' => [ 'hide_image!' => 'yes' ],
            ]
        );
        $this->add_control( 'hide_bread',
            [
                'label' => esc_html__( 'Hide Breadcrumbs', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'wixi_post_bg_style',
            [
                'label' => esc_html__( 'Background', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'hero_bg',
                'label' => esc_html__( 'Background', 'wixi' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .page-header',
            ]
        );
        $this->add_responsive_control( 'hero_inner_padding',
            [
                'label' => esc_html__( 'Inner Conntent Padding', 'wixi' ),
                'description' => esc_html__( 'Default Top:240px and Bottom:120px', 'wixi' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .page-header .cont-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ],
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'hero_inner_column',
            [
                'label' => esc_html__( 'Inner Content Column Width', 'wixi' ),
                'description' => esc_html__( 'Default: 7 for Type 2, Default: 10 for Type 1', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
                'step' => 1,
                'default' => '',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section( 'wixi_post_title_style',
            [
                'label' => esc_html__( 'Post/Page Title', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->wixi_style_typo( 'post_title_typo','{{WRAPPER}} .page-header .img-wrapper .title .head-title' );
        $this->add_control( 'post_title_color',
            [
                'label' => esc_html__( 'Filled Text Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ 'body.elementor-msie {{WRAPPER}} .page-header .img-wrapper .title .head-title, {{WRAPPER}} .page-header.type-1 .head-title' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'post_title_outline_color',
            [
                'label' => esc_html__( 'Stroked Text Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ 'body:not(.elementor-msie) {{WRAPPER}} .page-header .img-wrapper .title .head-title, body:not(.elementor-msie) {{WRAPPER}} .page-header.type-1 .head-title b' => '-webkit-text-stroke-color:{{VALUE}};--fill-color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'post_title_outline_width',
            [
                'label' => esc_html__( 'Stroke Width', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => '',
                'selectors' => [ 'body:not(.elementor-msie) {{WRAPPER}} .page-header .img-wrapper .title .head-title, body:not(.elementor-msie) {{WRAPPER}} .page-header.type-1 .head-title b' => '-webkit-text-stroke-width:{{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'reveal',
            [
                'label' => esc_html__( 'Reveal Filled Effect?', 'wixi' ),
                'description' => esc_html__( 'This effect uses ( Stroked Text Color )', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
                'condition' => ['type' => '2']
            ]
        );
        $this->add_responsive_control( 'post_title_margin',
            [
                'label' => esc_html__( 'Margin', 'wixi' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .page-header .head-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ],
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'post_title_padding',
            [
                'label' => esc_html__( 'Padding', 'wixi' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .page-header .head-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_title_border',
                'label' => esc_html__( 'Border', 'wixi' ),
                'selector' => '{{WRAPPER}} .page-header .head-title',
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'post_title_bg',
                'label' => esc_html__( 'Background', 'wixi' ),
                'types' => [ 'classic', 'gradient'  ],
                'selector' => '{{WRAPPER}} .page-header .head-title',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'wixi_post_desc_style',
            [
                'label' => esc_html__( 'Description', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['type' => '2']
            ]
        );
        $this->wixi_style_typo( 'post_desc_typo','{{WRAPPER}} .page-header .cont-inner h4' );
        $this->add_control( 'post_desc_color',
            [
                'label' => esc_html__( 'Text Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .page-header .cont-inner h4' => 'color:{{VALUE}};-webkit-text-stroke-color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'post_desc_outline_color',
            [
                'label' => esc_html__( 'Stroked Text Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ 'body:not(.elementor-msie) {{WRAPPER}} .page-header .cont-inner h4 b' => '-webkit-text-stroke-color:{{VALUE}};--fill-color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'post_desc_outline_width',
            [
                'label' => esc_html__( 'Stroke Width', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => '',
                'selectors' => [ 'body:not(.elementor-msie) {{WRAPPER}} .page-header .cont-inner h4 b' => '-webkit-text-stroke-width:{{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'desc_reveal',
            [
                'label' => esc_html__( 'Reveal Filled Effect?', 'wixi' ),
                'description' => esc_html__( 'This effect uses ( Stroked Text Color )', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
                'condition' => ['type' => '2']
            ]
        );
        $this->add_responsive_control( 'post_desc_fontsz',
            [
                'label' => esc_html__( 'Stroke Text Font-size', 'wixi' ),
                'description' => esc_html__( 'You can change stroke text font size with this option.', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 120,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .page-header .cont-inner h4 b' => 'font-size:{{SIZE}}px;' ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'wixi_bread_style',
            [
                'label' => esc_html__( 'Breadcrumbs', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['hide_bread!' => 'yes']
            ]
        );
        $this->wixi_style_typo( 'post_bread_typo','{{WRAPPER}} .breadcrumbs' );
        $this->add_control( 'post_bread_color',
            [
                'label' => esc_html__( 'Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .breadcrumbs, {{WRAPPER}} .breadcrumbs a' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'post_bread_hvrcolor',
            [
                'label' => esc_html__( 'Hover Link Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .breadcrumbs a:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'post_bread_actcolor',
            [
                'label' => esc_html__( 'Current Page/Post Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .breadcrumbs .breadcrumb_active' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_responsive_control( 'post_bread_top',
            [
                'label' => esc_html__( 'Top Offset', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 500,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .bread-wrapper' => 'top:{{SIZE}}px;' ],
                'condition' => [ 'type' => '2' ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'post_bread_martop',
            [
                'label' => esc_html__( 'Top Offset', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 200,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .breadcrumbs' => 'margin-top:{{SIZE}}px;' ],
                'condition' => [ 'type' => '1' ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $elementid = $this->get_id();

        $imageurl = !empty( $settings['image']['url'] ) ? $settings['image']['url'] : '';
        $imageurl = 'yes' == $settings['custom_image'] ? $imageurl : get_the_post_thumbnail_url( get_the_ID(), 'full' );
        $speed    = $settings['speed'] ? $settings['speed'] : 0.2;
        $mdspeed  = $settings['mdspeed'] ? $settings['mdspeed'] : 0.2;
        $smspeed  = $settings['smspeed'] ? $settings['smspeed'] : 0.2;
        $offset   = $settings['offset'] ? $settings['offset'] : 0;
        $mdoffset = $settings['mdoffset'] ? $settings['mdoffset'] : 0;
        $smoffset = $settings['smoffset'] ? $settings['smoffset'] : 0;
        $revealtitle = $settings['title_type'] == 'custom' && $settings['title'] ? $settings['title'] : get_the_title();
        $reveal = 'yes' == $settings['reveal'] ? ' data-hover-reveal="'.strip_tags($revealtitle).'"' : '';

        if ( '2' == $settings['type'] ) {
            $column = $settings['hero_inner_column'] ? $settings['hero_inner_column'] : 9;
            echo '<div class="page-header type-'.$settings['type'].'">';
                if ( $settings['desc'] ) {
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-lg-'.$column.' col-md-9">';
                                echo '<div class="cont-inner">';
                                    echo '<div class="bread-wrapper">';
                                        if ( $settings['hide_bread'] != 'yes' ) {
                                            wixi_breadcrumbs();
                                        }
                                    echo '</div>';
                                    $desc = 'yes' == $settings['desc_reveal'] ? preg_replace('/<b>(.*?)<\/b>/', '<b data-hover-reveal="$1">$1</b>', $settings['desc']) : $settings['desc'];
                                    echo '<h4>'.$desc.'</h4>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
                if ( 'yes' == $settings['use_bg'] ) {
                    $bg_attr = 'yes' != $settings['hide_image'] ? ' class="img-wrapper bg-cover parallaxie" data-overlay-dark="3" data-wixi-parallaxie=\'{"speed":'.$speed.',"mdspeed":'.$mdspeed.',"smspeed":'.$smspeed.',"offset":'.$offset.',"mdoffset":'.$mdoffset.',"smoffset":'.$smoffset.'}\'' : 'class="img-wrapper bg-cover-none"';
                } else {
                    $imageurl = $imageurl && 'yes' != $settings['hide_image'] ? ' style="background-image:url('.$imageurl.')"' : '';
                    $bg_attr = 'yes' != $settings['hide_image'] ? ' class="img-wrapper bg-cover parallaxie"'.$imageurl.' data-overlay-dark="3" data-wixi-parallaxie=\'{"speed":'.$speed.',"mdspeed":'.$mdspeed.',"smspeed":'.$smspeed.',"offset":'.$offset.',"mdoffset":'.$mdoffset.',"smoffset":'.$smoffset.'}\'' : 'class="img-wrapper bg-cover-none"';
                }
                echo '<div '.$bg_attr.'>';
                    echo '<div class="title">';
                        echo '<div class="container">';
                            if ( $settings['title_type'] == 'custom' ) {
                                if ( $settings['title'] ) {
                                    echo '<h3 class="head-title"'.$reveal.'>'.$settings['title'].'</h3>';
                                }
                            } else {

                                $firstw = explode(' ',trim(get_the_title()));
                                $ptitle = 'yes' == $settings['first_stroke'] && is_array( $firstw ) && !empty($firstw[0]) ? str_replace ( $firstw[0], '<b>'.$firstw[0].'</b>', get_the_title() ) : get_the_title();
                                echo '<h3 class="head-title"'.$reveal.'>'.$ptitle.'</h3>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

        } else {

            $column = $settings['hero_inner_column'] ? $settings['hero_inner_column'] : 10;
            echo '<div class="page-header type-project post-'.$elementid.' type-'.$settings['type'].'">';
                echo '<div class="container">';
                    echo '<div class="row">';
                        echo '<div class="col-lg-'.$column.' col-md-12">';
                            echo '<div class="cont-inner">';
                                if ( 'custom' == $settings['title_type'] ) {
                                    if ( $settings['title'] ) {
                                        echo '<h1 class="head-title"'.$reveal.'>'.$settings['title'].'</h1>';
                                    }
                                } else {
                                    $firstw = explode(' ',trim(get_the_title()));
                                    $ptitle = 'yes' == $settings['first_stroke'] && is_array( $firstw ) && !empty($firstw[0]) ? str_replace ( $firstw[0], '<b>'.$firstw[0].'</b>', get_the_title() ) : get_the_title();
                                    echo '<h1 class="head-title"'.$reveal.'>'.$ptitle.'</h1>';
                                }
                                if ( $settings['hide_bread'] != 'yes' ) {
                                    wixi_breadcrumbs();
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                if ( 'yes' != $settings['hide_image'] ) {
                    if ( 'yes' == $settings['use_bg'] ) {
                        echo '<div class="img-wrapper bg-cover" data-wixi-parallaxie=\'{"speed":'.$speed.',"mdspeed":'.$mdspeed.',"smspeed":'.$smspeed.',"offset":'.$offset.',"mdoffset":'.$mdoffset.',"smoffset":'.$smoffset.'}\'></div>';
                    } else {
                        echo '<div class="img-wrapper bg-cover" style="background-image:url('.$imageurl.')" data-wixi-parallaxie=\'{"speed":'.$speed.',"mdspeed":'.$mdspeed.',"smspeed":'.$smspeed.',"offset":'.$offset.',"mdoffset":'.$mdoffset.',"smoffset":'.$smoffset.'}\'></div>';
                    }
                }
            echo '</div>';
        }
    }
}
