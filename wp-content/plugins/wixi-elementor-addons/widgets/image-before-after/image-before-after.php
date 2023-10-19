<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Image_Before_After extends Widget_Base {
    use Wixi_Helper;
    public function get_name() {
        return 'wixi-image-before-after';
    }
    public function get_title() {
        return 'Image Before After (N)';
    }
    public function get_icon() {
        return 'eicon-image';
    }
    public function get_categories() {
        return [ 'wixi' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_register_style( 'wixi-image-before-after', WIXI_PLUGIN_URL. 'widgets/image-before-after/style.css');
        wp_register_script( 'hammer', WIXI_PLUGIN_URL. 'widgets/image-before-after/hammer.min.js', [  'jquery' ], '1.0.0', true);
        wp_register_script( 'jquery-images-compare', WIXI_PLUGIN_URL. 'widgets/image-before-after/jquery.images-compare.min.js', [  'jquery' ], '1.0.0', true);
        wp_register_script( 'wixi-image-before-after', WIXI_PLUGIN_URL. 'widgets/image-before-after/script.js', [  'elementor-frontend' ], '1.0.0', true);

    }
    public function get_style_depends() {
        return [ 'wixi-image-before-after' ];
    }
    public function get_script_depends() {
        return [ 'jquery-images-compare', 'wixi-image-before-after' ];
    }
    // Registering Controls
    protected function register_controls() {

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wixi_image_before_after_settings',
            [
                'label' => esc_html__( 'General', 'wixi'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'before',
            [
                'label' => esc_html__('Before Text', 'wixi'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Before', 'wixi'),

            ]
        );
        $this->add_control( 'after',
            [
                'label' => esc_html__('After Text', 'wixi'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('After', 'wixi'),

            ]
        );
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Before Image', 'wixi' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'condition' => [ 'image[url]!' => '' ],
            ]
        );
        $this->add_control( 'image2',
            [
                'label' => esc_html__( 'After Image', 'wixi' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail2',
                'default' => 'full',
                'condition' => [ 'image2[url]!' => '' ],
            ]
        );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('wixi_image_before_after_container_style_section',
            [
                'label'=> esc_html__( 'Container Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->wixi_style_border( 'image_before_after_container_border','{{WRAPPER}} .nt-images-compare');
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('wixi_image_before_after_handle_style_section',
            [
                'label'=> esc_html__( 'Handle Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->wixi_style_color( 'image_before_after_handle_color',array('{{WRAPPER}} .nt-handle' => 'color: {{VALUE}};'));
        $this->wixi_style_border( 'image_before_after_handle_border','{{WRAPPER}} .nt-handle');
        $this->wixi_style_background( 'image_before_after_handle_background','{{WRAPPER}} .nt-handle',array('classic','gradient') );
        $this->wixi_style_slider_width( 'image_before_after_handle_width',array('{{WRAPPER}} .nt-handle' => 'width: {{SIZE}}px;height: {{SIZE}}px;'), $min=30, $max=100, $unit='px' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('wixi_image_before_after_text_style_section',
            [
                'label'=> esc_html__( 'Text Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->wixi_style_typo( 'image_before_after_text_typo','{{WRAPPER}} .nt-images-compare[data-nt-label]:after,{{WRAPPER}} .nt-reveal[data-nt-label]:after' );
        $this->wixi_style_color( 'image_before_after_text_color','{{WRAPPER}} .nt-images-compare[data-nt-label]:after,{{WRAPPER}} .nt-reveal[data-nt-label]:after' );
        $this->wixi_style_border( 'image_before_after_text_border','{{WRAPPER}} .nt-images-compare[data-nt-label]:after,{{WRAPPER}} .nt-reveal[data-nt-label]:after');
        $this->wixi_style_background( 'image_before_after_text_background','{{WRAPPER}} .nt-images-compare[data-nt-label]:after,{{WRAPPER}} .nt-reveal[data-nt-label]:after',array('classic','gradient') );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $elementid  = $this->get_id();

        $image      = $this->get_settings( 'image' );
        $image_url  = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings );
        $imageurl   = empty( $image_url ) ? $image['url'] : $image_url;
        $imagealt   = esc_attr(get_post_meta($image['id'], '_wp_attachment_image_alt', true));
        $imagealt   = $imagealt ? $imagealt : basename ( get_attached_file( $image['id'] ) );

        $image2      = $this->get_settings( 'image2' );
        $image_url2  = Group_Control_Image_Size::get_attachment_image_src( $image2['id'], 'thumbnail', $settings );
        $imageurl2   = empty( $image_url2 ) ? $image2['url'] : $image_url2;
        $imagealt2   = esc_attr(get_post_meta($image2['id'], '_wp_attachment_image_alt', true));
        $imagealt2   = $imagealt2 ? $imagealt2 : basename ( get_attached_file( $image2['id'] ) );

        echo '<div id="myImageCompare_'.$elementid.'" class="nt-images-compare" data-nt-label="'.$settings[ 'before' ].'">';
          echo '<img src="' . $imageurl . '" alt="' . $imagealt . '">';
          echo '<div class="nt-reveal" data-nt-label="'.$settings[ 'after' ].'">';
            echo '<img src="' . $imageurl2 . '" alt="' . $imagealt2 . '">';
          echo '</div>';
        echo '</div>';
    }
}
