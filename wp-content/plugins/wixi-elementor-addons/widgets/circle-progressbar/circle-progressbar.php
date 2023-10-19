<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Circle_Progressbar extends Widget_Base {
    use Wixi_Helper;
    public function get_name() {
        return 'wixi-circle-progresbar';
    }
    public function get_title() {
        return 'Circle Progressbar (N)';
    }
    public function get_icon() {
        return 'eicon-counter';
    }
    public function get_categories() {
        return [ 'wixi' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        wp_register_script( 'jquery-circle-progress', WIXI_PLUGIN_URL. 'widgets/circle-progressbar/jquery-circle-progress.min.js', [ 'jquery' ], '1.0.0', true);
        wp_register_script( 'wixi-circle-progresbar', WIXI_PLUGIN_URL. 'widgets/circle-progressbar/script.js', [ 'elementor-frontend' ], '1.0.0', true);
    }
    public function get_script_depends() {
        return ['wow', 'jquery-circle-progress', 'wixi-circle-progresbar' ];
    }
    // Registering Controls
    protected function register_controls() {
        $this->start_controls_section('general_settings',
            [
                'label' => esc_html__( 'Odometer General', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'Default', 'wixi' ),
                    'counter' => esc_html__( 'Counter', 'wixi' ),
                    'counter2' => esc_html__( 'Counter 2', 'wixi' ),
                ]
            ]
        );
        $this->add_control( 'linecap',
            [
                'label' => esc_html__( 'Line Cap', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'round',
                'options' => [
                    'round' => esc_html__( 'Round', 'wixi' ),
                    'butt' => esc_html__( 'Butt', 'wixi' ),
                    'square' => esc_html__( 'Square', 'wixi' ),
                ]
            ]
        );
        $this->add_control( 'value',
            [
                'label' => esc_html__( 'Value', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 50,
            ]
        );
        $this->add_control( 'size',
            [
                'label' => esc_html__( 'Size', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 10,
                'default' => 50,
            ]
        );
        $this->add_control( 'thickness',
            [
                'label' => esc_html__( 'Thickness', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 5,
            ]
        );
        $this->add_control( 'colortype',
            [
                'label' => esc_html__( 'Theme', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'color',
                'options' => [
                    'color' => esc_html__( 'Color', 'wixi' ),
                    'grad' => esc_html__( 'Gradient', 'wixi' ),
                ]
            ]
        );
        $this->add_control( 'color1',
            [
                'label' => esc_html__( 'Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_control( 'color2',
            [
                'label' => esc_html__( 'Color 2', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => ['colortype' => 'grad']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typo',
                'label' => esc_html__( 'Number Typography', 'wixi' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .progress--number',
                'condition' => ['type!' => 'default']
            ]
        );
        $this->add_control( 'number_color',
            [
                'label' => esc_html__( 'Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => ['type!' => 'default'],
                'selectors' => [
                    '{{WRAPPER}} .progress--number:not(.stroked)' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .progress--number.stroked' => '-webkit-text-stroke-color:{{VALUE}};text-stroke-color:{{VALUE}};',
                ],
            ]
        );
        $this->add_control( 'stroked',
            [
                'label' => esc_html__( 'Use Stroke', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => ['type!' => 'default']
            ]
        );
        $this->end_controls_section();
        /*****   Style   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $stroked = 'yes' == $settings['stroked'] ? ' stroked' : '';
        $color = 'grad' == $settings['colortype'] ? '{ "gradient": ["'.$settings['color1'].'", "'.$settings['color2'].'"] }' : '{"color": "'.$settings['color1'].'"}';
        echo '<div class="circle--progressbar-wrapper"><div
        id="circle--'.$id.'"
        class="circle--progressbar"
        data-type="'.$settings['type'].'"
        data-value="'. ($settings['value'] / 100) .'"
        data-size="'.$settings['size'].'"
        data-thickness="'.$settings['thickness'].'"
        data-line-cap="'.$settings['linecap'].'"
        data-start-angle="-Math.PI/2"
        data-fill=\''.$color.'\'
        data-reverse="false"
        ><strong class="progress--number'.$stroked.'"></strong></div></div>';
    }
}
