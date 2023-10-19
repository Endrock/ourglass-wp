<?php

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Base\Document;
use Elementor\Core\Base\Module as BaseModule;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Core\DocumentTypes\PageBase as PageBase;
use Elementor\Modules\Library\Documents\Page as LibraryPageDocument;

if( !defined( 'ABSPATH' ) ) exit;

class Wixi_Customizing_Page_Settings {
    use Wixi_Helper;
    private static $instance = null;
    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new Wixi_Customizing_Page_Settings();
        }
        return self::$instance;
    }
    public function __construct(){
        // custom option for elementor heading widget font size
        add_action( 'elementor/element/wp-page/document_settings/before_section_end',[ $this,'wixi_add_theme_skin_to_page_settings'], 10);
        add_action( 'elementor/element/wp-post/document_settings/before_section_end',[ $this,'wixi_add_theme_skin_to_page_settings'], 10);
    }

    public function wixi_add_theme_skin_to_page_settings( $page )
    {

        if ( isset( $page ) && $page->get_id() > "" ) {

            $template = basename( get_page_template() );
            $wixi_post_type = false;
            $wixi_post_type = get_post_type( $page->get_id() );

            $page->add_control( 'wixi_elementor_page_header_settings_heading',
                [
                    'label' => esc_html__( 'WIXI HEADER', 'wixi' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $page->add_control( 'wixi_elementor_hide_page_header',
                [
                    'label' => esc_html__( 'Hide Page Header', 'wixi' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [ 'name' => 'template','operator' => '==','value' => 'default' ],
                            [ 'name' => 'template','operator' => '==','value' => 'wixi-elementor-page.php' ],
                            [ 'name' => 'template','operator' => '==','value' => 'locomotive-page.php' ]
                        ]
                    ]
                ]
            );
            $page->add_control( 'wixi_elementor_page_header_template',
                [
                    'label' => esc_html__( 'Select Header Template', 'venam' ),
                    'type' => Controls_Manager::SELECT2,
                    'default' => '',
                    'multiple' => false,
                    'options' => $this->wixi_get_elementor_templates('section'),
                    'condition' => [ 'wixi_elementor_hide_page_header!' => 'yes' ]
                ]
            );
            $page->add_control( 'wixi_elementor_page_skin_settings_heading',
                [
                    'label' => esc_html__( 'WIXI PAGE SKIN', 'wixi' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $page->add_control( 'wixi_elementor_page_skin',
                [
                    'label' => esc_html__( 'Page Skin Type', 'wixi' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__( 'Slect a type', 'wixi' ),
                        'dark' => esc_html__( 'Dark', 'wixi' ),
                        'light' => esc_html__( 'Light', 'wixi' ),
                    ],
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [ 'name' => 'template','operator' => '==','value' => 'default' ],
                            [ 'name' => 'template','operator' => '==','value' => 'wixi-elementor-page.php' ],
                        ]
                    ]
                ]
            );
            $page->add_control( 'wixi_page_heading_color',
                [
                    'label' => esc_html__( 'Section Heading Color', 'wixi' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '.elementor-widget-heading' => 'color:{{VALUE}};',
                        '.wixi-headig-line .elementor-heading-title::after' => 'background-color:{{VALUE}};',
                    ],
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [ 'name' => 'wixi_elementor_page_skin','operator' => '==','value' => 'dark' ],
                            [
                                'relation' => 'or',
                                'terms' => [
                                    [ 'name' => 'template','operator' => '==','value' => 'default' ],
                                    [ 'name' => 'template','operator' => '==','value' => 'wixi-elementor-page.php' ]
                                ]
                            ]
                        ]
                    ]
                ]
            );
            $page->add_control( 'wixi_elementor_page_footer_settings_heading',
                [
                    'label' => esc_html__( 'WIXI FOOTER', 'wixi' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $page->add_control( 'wixi_elementor_hide_page_footer',
                [
                    'label' => esc_html__( 'Hide Footer', 'wixi' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [ 'name' => 'template','operator' => '==','value' => 'default' ],
                            [ 'name' => 'template','operator' => '==','value' => 'wixi-elementor-page.php' ],
                        ]
                    ]
                ]
            );
            $page->add_control( 'wixi_elementor_page_scrolltoid_heading',
                [
                    'label' => esc_html__( 'WIXI SCROLL TO ID', 'wixi' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $page->add_control( 'wixi_elementor_page_scrolltoid',
                [
                    'label' => esc_html__( 'Scroll to Section', 'wixi' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [ 'name' => 'template','operator' => '==','value' => 'default' ],
                            [ 'name' => 'template','operator' => '==','value' => 'wixi-elementor-page.php' ],
                        ]
                    ]
                ]
            );
            $page->add_control( 'wixi_elementor_page_scrolltoid_duration',
                [
                    'label' => esc_html__( 'Duration ( ms )', 'wixi' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 1000,
                    'step' => 1,
                    'default' => '',
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [ 'name' => 'template','operator' => '==','value' => 'default' ],
                            [ 'name' => 'template','operator' => '==','value' => 'wixi-elementor-page.php' ],
                            [ 'name' => 'wixi_elementor_page_scrolltoid','operator' => '==','value' => 'yes' ],
                        ]
                    ]
                ]
            );
        }
    }

    public function wixi_add_custom_css_to_page_settings( $page )
    {

        if( isset($page) && $page->get_id() > "" ){

            $nt_post_type   = false;
            $nt_post_type   = get_post_type($page->get_id());

            if ( $nt_post_type == 'page' || $nt_post_type == 'revision' ) {

                $page->start_controls_section( 'header_custom_css_controls_section',
                    [
                        'label' => esc_html__( 'WIXI Page Custom CSS', 'wixi' ),
                        'tab' => Controls_Manager::TAB_SETTINGS,
                    ]
                );
                $page->add_control( 'wixi_page_custom_css',
                    [
                        'label' => esc_html__( 'Custom CSS', 'wixi' ),
                        'type' => Controls_Manager::CODE,
                        'language' => 'css',
                        'rows' => 20,
                    ]
                );
                $page->end_controls_section();
            }
        }
    }
    public function wixi_page_registered_nav_menus()
    {
        $menus = wp_get_nav_menus();
        $options = array();
        if ( ! empty( $menus ) && ! is_wp_error( $menus ) ) {
            foreach ( $menus as $menu ) {
                $options[ $menu->slug ] = $menu->name;
            }
        }
        return $options;
    }
}
Wixi_Customizing_Page_Settings::get_instance();
