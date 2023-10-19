<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Header_Menu extends Widget_Base {
    use Wixi_Helper;

    public function get_name() {
        return 'wixi-menu';
    }
    public function get_title() {
        return 'Header Menu (N)';
    }
    public function get_icon() {
        return 'eicon-nav-menu';
    }
    public function get_categories() {
        return [ 'wixi' ];
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
        $this->start_controls_section('wixi_split_slider_general_settings',
            [
                'label' => esc_html__( 'General', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        // Exclude Category
        $this->add_control( 'register_menus',
            [
                'label' => esc_html__( 'Select Menu', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'label_block' => true,
                'options' => $this->nt_registered_nav_menus(),
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'header_menu_item_style_controls_section',
            [
                'label' => esc_html__( 'Menu Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wixi_style_typo( 'header_menu_item_normal_typo', '{{WRAPPER}} .main-overlaymenu.open .menu-wrapper .main-menu > li .link' );
        $this->wixi_style_padding( 'header_menu_item_padding', '{{WRAPPER}} .main-overlaymenu.open .menu-wrapper .main-menu > li .link' );
        $this->wixi_style_margin( 'header_menu_item_margin', '{{WRAPPER}} .main-overlaymenu.open .menu-wrapper .main-menu > li .link' );
        //  Tabs
        $this->start_controls_tabs('header_menu_item_normal_tabs');
        $this->start_controls_tab( 'header_menu_item_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wixi' ) ]
        );
        $this->wixi_style_color( 'header_menu_item_normal_color', '{{WRAPPER}} .main-overlaymenu.open .menu-wrapper .main-menu > li .link' );
        $this->end_controls_tab();
        $this->start_controls_tab('header_menu_item_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wixi' ) ]
        );
        $this->wixi_style_color( 'header_menu_item_hover_color', '{{WRAPPER}} .main-overlaymenu.open .menu-wrapper .main-menu > li .link:hover' );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        //  Tabs
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $css = ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) ? ' style="height:96px;"' : '';
        echo '<div id="navi" class="overlaynav wixi-header"'.$css.'>';
            echo '<div class="container-fluid">';
                echo '<div class="logo">';
                    wixi_logo();
                echo '</div>';
                echo '<div class="menu-toggle">';
                    echo '<span class="icon"><i></i><i></i></span>';
                    echo '<span class="text" data-splitting>'. esc_html__( 'Menu', 'wixi' ). '</span>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

        echo '<div class="main-overlaymenu"  id="main-overlaymenu">';
            echo '<div class="container">';
                echo '<div class="row">';
                    echo '<div class="col-lg-9 col-md-8">';
                        echo '<div class="menu-wrapper">';
                            echo '<ul class="main-menu">';
                                echo wp_nav_menu(
                                    array(
                                        'menu' => $settings['register_menus'],
                                        'theme_location' => 'header_menu',
                                        'container' => '', // menu wrapper element
                                        'container_class' => '',
                                        'container_id' => '', // default: none
                                        'menu_class' => '', // ul class
                                        'menu_id' => '', // ul id
                                        'items_wrap' => '%3$s',
                                        'before' => '', // before <a>
                                        'after' => '', // after <a>
                                        'link_before' => '', // inside <a>, before text
                                        'link_after' => '', // inside <a>, after text
                                        'depth' => 4, // '0' to display all depths
                                        'echo' => true,
                                        'fallback_cb' => 'Wixi_Menu_Navwalker::fallback',
                                        'walker' => new \Wixi_Menu_Navwalker()
                                    )
                                );
                            echo '</ul>';
                        echo '</div>';
                    echo '</div>';

                    echo '<div class="col-lg-3 col-md-4">';
                        echo '<div class="menu-info">';
                            $contact_details = wixi_settings( 'nav_contact', '1' );
                            echo do_shortcode( $contact_details );
                            echo '<div class="item">';
                                echo wixi_content_custom_search_form();
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';

                echo '</div>';
            echo '</div>';
        echo '</div>';

    }
}
