<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Caption_Hover_Effects extends Widget_Base {

    use Wixi_Helper;

    public function get_name() {
        return 'wixi-caption-hover-effects';
    }
    public function get_title() {
        return 'Caption Hover Effects (N)';
    }
    public function get_icon() {
        return 'eicon-image-rollover';
    }
    public function get_categories() {
        return [ 'wixi' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        
        wp_register_style( 'wixi-caption-hover', WIXI_PLUGIN_URL. 'widgets/caption-hover/style.css');
        wp_register_script( 'wixi-modernizr-custom', WIXI_PLUGIN_URL. 'widgets/caption-hover/modernizr.custom.js', [ 'jquery' ], '1.0.0', false);
        wp_register_script( 'wixi-caption-hover', WIXI_PLUGIN_URL. 'widgets/caption-hover/script.js', [ 'elementor-frontend' ], '1.0.0', true);
        
    }
    public function get_style_depends() {
        return [ 'wixi-caption-hover' ];
    }
    public function get_script_depends() {
        return [ 'wixi-modernizr-custom', 'wixi-caption-hover' ];
    }
    
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('wixi_caption_hover_settings',
            [
                'label' => esc_html__( 'Caption Hover', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'style',
            [
                'label' => esc_html__( 'Style', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Style 1', 'wixi' ),
                    '2' => esc_html__( 'Style 2', 'wixi' ),
                    '3' => esc_html__( 'Style 3', 'wixi' ),
                    '4' => esc_html__( 'Style 4', 'wixi' ),
                    '5' => esc_html__( 'Style 5', 'wixi' ),
                    '6' => esc_html__( 'Style 6', 'wixi' ),
                    '7' => esc_html__( 'Style 7', 'wixi' )
                ]
            ]
        );
        $this->add_responsive_control( 'text_content_height',
            [
                'label' => esc_html__( 'Text Content Size', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 500,
                'step' => 1,
                'default' => '',
                'conditions' => [
    				'relation' => 'or',
    				'terms' => [
    					['name' => 'style','operator' => '==','value' => '2'],
    					['name' => 'style','operator' => '==','value' => '3'],
    					['name' => 'style','operator' => '==','value' => '4'],
    				]
    			],
                'selectors' => [
                    '.no-touch {{WRAPPER}} .cs-style-2 figure:hover img, {{WRAPPER}} .cs-style-2 figure.cs-hover img' => '-webkit-transform: translateY(-{{SIZE}}px);-moz-transform: translateY(-{{SIZE}}px);-ms-transform: translateY(-{{SIZE}}px);transform: translateY(-{{SIZE}}px);',
                    '{{WRAPPER}} .cs-style-2 figcaption' => 'height:{{SIZE}}px;',
                    '{{WRAPPER}} .cs-style-3 figcaption' => 'height:{{SIZE}}px;',
                    '{{WRAPPER}} .cs-style-4 figcaption' => 'width:{{SIZE}}px;',
                ]
            ]
        );
        $this->add_responsive_control( 'text_content_height7',
            [
                'label' => esc_html__( 'Text Content Height ( % )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 200,
                'step' => 1,
                'default' => '',
                'condition' => [ 'style' => '7' ],
                'selectors' => [ '.no-touch {{WRAPPER}} .cs-style-7 figure:hover figcaption, {{WRAPPER}} .cs-style-7 figure.cs-hover figcaption' => 'height:{{SIZE}}%;',]
            ]
        );
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'wixi' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => '' ],
                'separator' => 'before'
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
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Camera',
                'separator' => 'before'
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Tag', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1' => esc_html__( 'h1', 'wixi' ),
                    'h2' => esc_html__( 'h2', 'wixi' ),
                    'h3' => esc_html__( 'h3', 'wixi' ),
                    'h4' => esc_html__( 'h4', 'wixi' ),
                    'h5' => esc_html__( 'h5', 'wixi' ),
                    'h6' => esc_html__( 'h6', 'wixi' ),
                    'div' => esc_html__( 'div', 'wixi' ),
                    'p' => esc_html__( 'p', 'wixi' )
                ]
            ]
        );
        $this->add_control( 'desc',
            [
                'label' => esc_html__( 'Short Text', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'by Jacob Cummings',
                'separator' => 'before'
            ]
        );
        
        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Button Title',
                'separator' => 'before'
            ]
        );
        $this->add_control( 'link',
            [
                'label' => esc_html__( 'Link', 'wixi' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'Place URL here', 'wixi' )
            ]
        );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('caption_effect_box_style_section',
            [
                'label'=> esc_html__( 'Box Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->wixi_style_border( 'caption_effect_box_border','{{WRAPPER}} .element-item ');
        $this->wixi_style_background( 'caption_effect_box_background','{{WRAPPER}} .element-item',array('classic','gradient') );
        $this->wixi_style_padding( 'caption_effect_box_padding','{{WRAPPER}} .element-item');
        $this->wixi_style_margin( 'caption_effect_box_margin','{{WRAPPER}} .element-item');
        
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('caption_effect_caption_style_section',
            [
                'label'=> esc_html__( 'Caption Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->wixi_style_border( 'caption_effect_caption_border','{{WRAPPER}} .element-item figcaption');
        $this->wixi_style_background( 'caption_effect_caption_background','{{WRAPPER}} .element-item figcaption',array('classic','gradient') );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('caption_effect_title_style_section',
            [
                'label'=> esc_html__( 'Title Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wixi_style_typo( 'caption_effect_title_typo','{{WRAPPER}} .element-item figcaption .caption-heading' );
        $this->wixi_style_color( 'caption_effect_title_color','{{WRAPPER}} .element-item figcaption .caption-heading' );
        $this->wixi_style_padding( 'caption_effect_title_padding','{{WRAPPER}} .element-item figcaption .caption-heading' );
        $this->wixi_style_margin( 'caption_effect_title_margin','{{WRAPPER}} .element-item figcaption .caption-heading' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('caption_effect_desc_style_section',
            [
                'label'=> esc_html__( 'Short Desc Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wixi_style_typo( 'caption_effect_desc_typo','{{WRAPPER}} .element-item figcaption .caption-desc' );
        $this->wixi_style_color( 'caption_effect_desc_color','{{WRAPPER}} .element-item figcaption .caption-desc' );
        $this->wixi_style_padding( 'caption_effect_desc_padding','{{WRAPPER}} .element-item figcaption .caption-desc' );
        $this->wixi_style_margin( 'caption_effect_desc_margin','{{WRAPPER}} .element-item figcaption .caption-desc' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('caption_effect_btn_style_section',
            [
                'label' => esc_html__( 'Button Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->wixi_style_typo( 'caption_effect_btn_typo','{{WRAPPER}} .element-item a' );
        $this->wixi_style_slider_width( 'caption_effect_btn_width',array('{{WRAPPER}} .element-item a' => 'text-align:center;width: {{SIZE}}%;min-width: {{SIZE}}%;'), $min=0, $max=100, $unit='%' );
        $this->wixi_style_padding( 'caption_effect_btn_padding','{{WRAPPER}} .element-item a' );
        $this->wixi_style_margin( 'caption_effect_btn_margin','{{WRAPPER}} .element-item a' );
        
        $this->start_controls_tabs( 'caption_effect_btn_tabs');
        $this->start_controls_tab( 'caption_effect_btn_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'wixi' ) ]
        );
        // Style function
        $this->wixi_style_color( 'caption_effect_btn_color','{{WRAPPER}} .element-item a' );
        $this->wixi_style_background( 'caption_effect_btn_background','{{WRAPPER}} .element-item a',array('classic','gradient') );
        $this->wixi_style_border( 'caption_effect_btn_border','{{WRAPPER}} .element-item a' );
        $this->wixi_style_box_shadow( 'caption_effect_btn_boxshadow','{{WRAPPER}} .element-item a' );
        $this->end_controls_tab();

        $this->start_controls_tab( 'caption_effect_btn_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wixi' ) ]
        );
        // Style function
        $this->wixi_style_color( 'caption_effect_btn_hvr_color','{{WRAPPER}} .element-item a:hover' );
        $this->wixi_style_background( 'caption_effect_btn_hvr_background','{{WRAPPER}} .element-item a:hover',array('classic','gradient') );
        $this->wixi_style_border( 'caption_effect_btn_hvr_border','{{WRAPPER}} .element-item a:hover' );
        $this->wixi_style_box_shadow( 'caption_effect_btn_hvr_boxshadow','{{WRAPPER}} .element-item a:hover' );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        $image      = $this->get_settings( 'image' );
        $image_url  = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings );
        $imagealt   = esc_attr(get_post_meta($image['id'], '_wp_attachment_image_alt', true));
        $imagealt   = $imagealt ? $imagealt : basename ( get_attached_file( $image['id'] ) );
        $imageurl   = empty( $image_url ) ? $image['url'] : $image_url;

		echo '<div class="hover-caption-wrapper cs-style-'.$settings['style'].'">';
			echo '<div class="element-item">';
				echo '<figure>';
    				if ( $imageurl ) {
    					echo '<img src="'.$imageurl.'" alt="'.$imagealt.'">';
    				}
					echo '<figcaption>';
    					if ( $settings['title'] ) {
    						echo '<'.$settings['tag'].' class="caption-heading">'.$settings['title'].'</'.$settings['tag'].'>';
    					}
    					if ( $settings['desc'] ) {
						    echo '<span class="caption-desc">'.$settings['desc'].'</span>';
    					}
    					if ( $settings['btn_title'] ) {
    					    $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
						    echo '<a href="'.$settings['link']['url'].'" title="'.$settings['btn_title'].'"'.$target.'>'.$settings['btn_title'].'</a>';
    					}
					echo '</figcaption>';
				echo '</figure>';
			echo '</div>';
		echo '</div>';
            
    }
}