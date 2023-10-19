<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Two_Block_Slider extends Widget_Base {
    use Wixi_Helper;
    public function get_name() {
        return 'wixi-two-block-slider';
    }
    public function get_title() {
        return 'Two Block Slider (N)';
    }
    public function get_icon() {
        return 'eicon-tabs';
    }
    public function get_categories() {
        return [ 'wixi' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_register_style( 'wixi-two-block-slider', WIXI_PLUGIN_URL. 'widgets/two-block-slider/style.css');
        wp_register_script( 'custom-modernizr', WIXI_PLUGIN_URL. 'widgets/two-block-slider/modernizr.js', [ 'jquery' ], '1.0.0', false);
        wp_register_script( 'wixi-two-block-slider', WIXI_PLUGIN_URL. 'widgets/two-block-slider/script.js', [  'jquery','elementor-frontend' ], '1.0.0', true);

    }
    public function get_style_depends() {
        return [ 'wixi-two-block-slider' ];
    }
    public function get_script_depends() {
        return [ 'custom-modernizr','velocity', 'wixi-two-block-slider' ];
    }
    // Registering Controls
    protected function register_controls() {

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wixi_two_block_slider_settings',
            [
                'label' => esc_html__( 'Content', 'wixi'),
            ]
        );
        $this->add_control( 'prev',
            [
                'label' => esc_html__('Prev Text', 'wixi'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Prev', 'wixi'),

            ]
        );
        $this->add_control( 'next',
            [
                'label' => esc_html__('Next Text', 'wixi'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Next', 'wixi'),

            ]
        );
        $this->add_control( 'close',
            [
                'label' => esc_html__('Close Text', 'wixi'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Next', 'wixi'),

            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'tab_title',
            [
                'label' => esc_html__('Tab Title', 'wixi'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tab Title', 'wixi'),
                'label_block' => true
            ]
        );
        $repeater->add_control( 'bg_img',
            [
                'label' => esc_html__( 'Background Image', 'wixi' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => ''],
            ]
        );
        $repeater->add_control( 'content_type',
            [
                'label' => esc_html__('Content Type', 'wixi'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'content' => esc_html__('Content', 'wixi'),
                    'template' => esc_html__('Saved Templates', 'wixi'),
                ],
                'default' => 'content'
            ]
        );
        $repeater->add_control( 'primary_templates',
            [
                'label' => esc_html__('Choose Template', 'wixi'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->wixi_get_elementor_templates(),
                'condition' => [ 'content_type' => 'template' ]
            ]
        );
        $repeater->add_control( 'tab_content',
            [
                'label' => esc_html__('Content', 'wixi'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam et lacus libero. Nunc tincidunt leo a mauris volutpat lobortis. Phasellus tristique libero et maximus imperdiet.', 'wixi'),
                'dynamic' => ['active' => true],
                'condition' => [ 'content_type' => 'content' ]
            ]
        );
        $this->add_control( 'two_block_tabs',
            [
                'label' => esc_html__( 'Slide Items', 'wixi' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{tab_title}}',
                'default' => [
                    [
                        'content_type' => 'content',
                        'tab_title' => 'Project #1',
                        'tab_content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam et lacus libero. </p>'
                    ],
                    [
                        'content_type' => 'content',
                        'tab_title' => 'Project #2',
                        'tab_content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam et lacus libero. </p>'
                    ],
                    [
                        'content_type' => 'content',
                        'tab_title' => 'Project #3',
                        'tab_content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam et lacus libero. </p>'
                    ]
                ]
            ]
        );
        $this->end_controls_section();

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('two_block_slider_left_style_section',
            [
                'label'=> esc_html__( 'Container Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control( 'two_block_slider_height',
            [
                'label' => esc_html__( 'Height ( % )', 'wixi' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [ 'vh' => ['min' => 0,'max' => 100 ] ],
                'selectors' => [ '{{WRAPPER}} .nt-image-block, {{WRAPPER}} .nt-content-block' => 'height: {{SIZE}}vh;' ]
            ]
        );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('two_block_slider_text_style_section',
            [
                'label'=> esc_html__( 'Left Block Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control( 'two_block_slider_left_width',
            [
                'label' => esc_html__( 'Width ( % )', 'wixi' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [ '%' => ['min' => 0,'max' => 100 ] ],
                'selectors' => [
                    '{{WRAPPER}} .nt-image-block' => 'width: {{SIZE}}%;',
                    '{{WRAPPER}} .block-navigation' => 'width: {{SIZE}}%;',
                    '{{WRAPPER}} .nt-content-block' => 'width: calc( 100% - {{SIZE}}% );'
                ]
            ]
        );
		$this->add_control( 'two_block_slider_title_heading',
			[
				'label' => esc_html__( 'Title', 'wixi' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->wixi_style_typo( 'two_block_slider_left_title_typo','{{WRAPPER}} .nt-images-list h2' );
        $this->wixi_style_color( 'two_block_slider_left_title_color','{{WRAPPER}} .nt-images-list h2' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('two_block_slider_text_right_style_section',
            [
                'label'=> esc_html__( 'Right Block Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wixi_style_background( 'two_block_slider_text_right_background','{{WRAPPER}} .nt-content-block',array('classic','gradient') );
        $this->wixi_style_typo( 'two_block_slider_text_right_typo','{{WRAPPER}} .nt-content-block' );
        $this->wixi_style_color( 'two_block_slider_text_right_color','{{WRAPPER}} .nt-content-block' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $elementid = $this->get_id();
        $count = 1;

        echo '<div class="nt-two-block-wrapper">';
            echo '<div class="nt-image-block">';
                echo '<ul class="nt-images-list">';
                    foreach ( $settings[ 'two_block_tabs' ] as $tab ) {
                        $is_active = 1 == $count ? ' class="is-selected"' : '';
                        $bg_img = $tab[ 'bg_img' ] ? ' style="background-image: url(' . $tab[ 'bg_img' ]['url'] . ');"' : '';

                        if ( $tab['tab_title'] ) {

                           echo ' <li' . $is_active . $bg_img . '><a href="#0"><h2>' . $tab[ 'tab_title' ] . '</h2></a></li>';

                        } else {

                        	echo ' <li' . $is_active . '><a href="#0"><h2>' . esc_html__( 'Add Title','wixi' ) . '</h2></a></li>';

                        }
                        $count++;
                    }
                echo '</ul>';
            echo '</div>';

            echo '<div class="nt-content-block">';
                echo '<ul>';
                    $counttwo = 1;
                    foreach ($settings['two_block_tabs'] as $tab) {
                        $is_active = 1 == $counttwo ? ' class="is-selected"' : '';

                        echo '<li'.$is_active.'>';

                            if ( $tab['tab_content'] || !empty($tab['primary_templates']) ) {

                                if ( 'template' == $tab['content_type'] ) {

                                    if (!empty($tab['primary_templates'])) {

                                        $template_id = $tab['primary_templates'];
                                        $wixi_frontend = new Frontend;

                                        echo $wixi_frontend->get_builder_content($template_id, true);

                                    } else {

                                        echo do_shortcode( $tab['tab_content'] );
                                    }

                                } else {

                                    echo do_shortcode($tab['tab_content']);
                                }

                            } else {

                            	echo esc_html__('Add Some Content Here','wixi');

                            }
                        echo '</li>';
                        $counttwo++;
                    }

                echo '</ul>';

                echo '<div class="nt-close">'.$settings[ 'close' ].'</div>';
            echo '</div>';

            echo '<ul class="block-navigation">';
                echo '<li><div class="buttons nt-prev inactive">&larr; '.$settings[ 'prev' ].'</div></li>';
                echo '<li><div class="buttons nt-next">'.$settings[ 'next' ].' &rarr;</div></li>';
            echo '</ul>';
        echo '</div>';

    }
}
