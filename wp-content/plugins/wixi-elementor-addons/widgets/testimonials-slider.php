<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Testimonials extends Widget_Base {
    use Wixi_Helper;
    public function get_name() {
        return 'wixi-testimonials';
    }
    public function get_title() {
        return 'Testimonials Carousel (N)';
    }
    public function get_icon() {
        return 'eicon-testimonial';
    }
    public function get_categories() {
        return [ 'wixi' ];
    }
    public function get_style_depends() {
        return [ 'slick','slick-theme' ];
    }
    public function get_script_depends() {
        return [ 'slick' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wixi_testimonials_settings',
            [
                'label' => esc_html__('General', 'wixi'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Section Title', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Testimonials',
                'label_block' => true,
            ]
        );
        $this->add_control( 'title_type',
            [
                'label' => esc_html__( 'Title Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Type 1', 'wixi' ),
                    '2' => esc_html__( 'Type 2', 'wixi' )
                ],
                'condition' => [ 'title!' => '' ],
            ]
        );
        $this->add_control( 'quote_icon',
            [
                'label' => esc_html__( 'Quote Image', 'wixi' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => plugins_url( 'assets/front/img/quote.svg', __DIR__ )],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wixi_testimonials_one_items_settings',
            [
                'label' => esc_html__('Testimonials Items', 'wixi'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'testi_name',
            [
                'label' => esc_html__( 'Name', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Sam Peters',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'testi_pos',
            [
                'label' => esc_html__( 'Position', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'CEO Solar Systems LLC',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'testi_text',
            [
                'label' => esc_html__( 'Quote', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'label_block' => true,
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail',
            'separator' => 'none',
            ]
        );
        $def_img = plugins_url( 'assets/front/img/author.jpg', __DIR__ );
        $repeater->add_control( 'testi_image',
            [
                'label' => esc_html__( 'Avatar', 'wixi' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => $def_img],
            ]
        );
        $this->add_control( 'testi_items',
            [
                'label' => esc_html__( 'Items', 'wixi' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{testi_name}}',
                'default' => [
                    [
                        'testi_name' => 'Alex Martin',
                        'testi_pos' => 'Envato Customer',
                        'testi_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel purus fringilla, lobortis libero ut, interdum lacus. Ut quis urna sollicitudin, iaculis dolor sed, sodales mi. Proin a velit convallis, fermentum orci in, rutrum diam. Duis elementum odio a pharetra commodo. Sed eget massa sit amet nunc egestas tristique.'
                    ],
                    [
                        'testi_name' => 'Terry Figueroa',
                        'testi_pos' => 'Marketing Manager',
                        'testi_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel purus fringilla, lobortis libero ut, interdum lacus. Ut quis urna sollicitudin, iaculis dolor sed, sodales mi. Proin a velit convallis, fermentum orci in, rutrum diam. Duis elementum odio a pharetra commodo. Sed eget massa sit amet nunc egestas tristique.'
                    ],
                    [
                        'testi_name' => 'Kaycee Hess',
                        'testi_pos' => 'Human Resources',
                        'testi_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel purus fringilla, lobortis libero ut, interdum lacus. Ut quis urna sollicitudin, iaculis dolor sed, sodales mi. Proin a velit convallis, fermentum orci in, rutrum diam. Duis elementum odio a pharetra commodo. Sed eget massa sit amet nunc egestas tristique.'
                    ]
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_haeding_style_section',
            [
                'label'=> esc_html__( 'Heading Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->wixi_style_typo( 'testi_title_typo','{{WRAPPER}} .testimonials .title h5, {{WRAPPER}} .testimonials.no-bg .text-bg' );
        $this->add_control( 'testi_title_color',
            [
                'label' => esc_html__( 'Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonials .title h5' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_responsive_control( 'testi_title_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -100,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonials .title h5, {{WRAPPER}} .testimonials.no-bg .text-bg' => 'left:{{SIZE}}%;' ]
            ]
        );
        $this->add_responsive_control( 'testi_title_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -100,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonials .title h5, {{WRAPPER}} .testimonials.no-bg .text-bg' => 'top:{{SIZE}}px;' ]
            ]
        );
        $this->add_control( 'testi_title_otline_color',
            [
                'label' => esc_html__( 'Stroke Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonials.no-bg .text-bg' => '-webkit-text-stroke-color:{{VALUE}};' ],
                'separator' => 'before',
                'condition' => [ 'title_type' => '2' ]
            ]
        );
        $this->add_responsive_control( 'testi_title_otline_width',
            [
                'label' => esc_html__( 'Stroke Width', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonials .title h5, {{WRAPPER}} .testimonials.no-bg .text-bg' => '-webkit-text-stroke-width:{{SIZE}}px;' ],
                'condition' => [ 'title_type' => '2' ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_quote_style_section',
            [
                'label'=> esc_html__( 'Quote Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->wixi_style_typo( 'testi_quote_typo','{{WRAPPER}} .testimonials p' );
        $this->wixi_style_color( 'testi_quote_typo','{{WRAPPER}} .testimonials p' );
        $this->wixi_style_padding( 'testi_quote_padding','{{WRAPPER}} .testimonials p' );
        $this->wixi_style_margin( 'testi_quote_margin','{{WRAPPER}} .testimonials p' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_name_style_section',
            [
                'label'=> esc_html__( 'Name Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->wixi_style_typo( 'testi_name_typo','{{WRAPPER}} .testimonials h6' );
        $this->wixi_style_color( 'testi_name_typo','{{WRAPPER}} .testimonials h6' );
        $this->wixi_style_padding( 'testi_name_padding','{{WRAPPER}} .testimonials h6' );
        $this->wixi_style_margin( 'testi_name_margin','{{WRAPPER}} .testimonials h6' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_job_style_section',
            [
                'label'=> esc_html__( 'Job / Position Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->wixi_style_typo( 'testi_job_typo','{{WRAPPER}} .testimonials h6 span' );
        $this->wixi_style_color( 'testi_job_typo','{{WRAPPER}} .testimonials h6 span' );
        $this->wixi_style_padding( 'testi_job_padding','{{WRAPPER}} .testimonials h6 span' );
        $this->wixi_style_margin( 'testi_job_margin','{{WRAPPER}} .testimonials h6 span' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_img_style_section',
            [
                'label'=> esc_html__( 'Image Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wixi_style_slider_width( 'testi_avatar_width',array( '{{WRAPPER}} .testimonials .author' => 'width: {{SIZE}}px' ), $min=0, $max=500, $unit='px' );
        $this->wixi_style_slider_height( 'testi_avatar_height',array( '{{WRAPPER}} .testimonials .author' => 'height: {{SIZE}}px' ), $min=0, $max=500, $unit='px' );
        $this->wixi_style_border( 'testi_avatar_border','{{WRAPPER}} .testimonials .author' );
        $this->wixi_style_box_shadow( 'testi_avatar_border','{{WRAPPER}} .testimonials .author' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_box_nav_style_section',
            [
                'label'=> esc_html__( 'Nav Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wixi_style_slider_width( 'testi_navs_width',array( '{{WRAPPER}} .testimonials .navs span' => 'width: {{SIZE}}px' ), $min=0, $max=200, $unit='px' );
        $this->wixi_style_slider_height( 'testi_navs_height',array( '{{WRAPPER}} .testimonials .navs span' => 'height: {{SIZE}}px' ), $min=0, $max=200, $unit='px' );

        $this->start_controls_tabs( 'testi_navs_tabs');
        $this->start_controls_tab( 'testi_navs_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'wixi' ) ]
        );

		$this->wixi_style_background( 'testi_navs_background','{{WRAPPER}} .testimonials .navs span',array( 'classic','gradient' ) );
        $this->wixi_style_border( 'testi_navs_border','{{WRAPPER}} .testimonials .navs span' );
        $this->end_controls_tab();

        $this->start_controls_tab( 'testi_navs_hover_tab',
            [ 'label' => esc_html__( 'Hover / Active', 'wixi' ) ]
        );
		$this->wixi_style_background( 'testi_navs_hvr_background','{{WRAPPER}} .testimonials .navs span:hover',array( 'classic','gradient' ) );
        $this->wixi_style_border( 'testi_navs_hvr_border','{{WRAPPER}} .testimonials .navs span:hover' );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        echo '<div class="testimonials">';
            echo '<div class="positive-r">';
                echo '<div class="slider-for">';

                    foreach ($settings['testi_items'] as $item) {
                        $timagealt = esc_attr(get_post_meta($item['testi_image']['id'], '_wp_attachment_image_alt', true));
                        $timagealt = $timagealt ? $timagealt : basename ( get_attached_file( $item['testi_image']['id'] ) );
                        $image = Group_Control_Image_Size::get_attachment_image_src( $item['testi_image']['id'], 'thumbnail', $settings );

                        echo '<div class="info">';
                            echo '<div class="item">';
                                echo '<div class="cont-inner">';
                                    if ( $item['testi_text'] ) {
                                        echo '<p  class="testi-text">'.$item['testi_text'].'</p>';
                                    }
                                echo '</div>';
                            echo '</div>';
                            if ($item['testi_image']['url']) {
            				    echo '<div class="author-c"><div class="author"><img class="testi-img" src="'.$image.'" alt="'.$timagealt.'"></div></div>';
                            }
                            if ( $item['testi_name'] ) {
                                $testipos = $item['testi_pos'] ? ' <span class="testi-pos">'.$item['testi_pos'].'</span>' : '';
                                echo '<h6 class="testi-name">'.$item['testi_name'].' '.$testipos.' </h6>';
                            }
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';

            echo '<div class="quote-text">';
                echo '<div class="slider-nav">';
                    foreach ($settings['testi_items'] as $item) {

                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';

    }
}
