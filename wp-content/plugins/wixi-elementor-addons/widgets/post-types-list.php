<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Post_Types_List extends Widget_Base {
    use Wixi_Helper;
    public function get_name() {
        return 'wixi-post-types-list';
    }
    public function get_title() {
        return 'Post Types List (N)';
    }
    public function get_icon() {
        return 'eicon-post-list';
    }
    public function get_categories() {
        return [ 'wixi' ];
    }
    // Registering Controls
    protected function register_controls() {

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_types_list_query',
            [
                'label' => esc_html__( 'Query', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'post_type',
            [
                'label' => esc_html__( 'Show Post(s)', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wixi_get_post_types()
            ]
        );
        $this->add_control( 'post_per_page',
            [
                'label' => esc_html__( 'Posts Per Page', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 50,
                'default' => 4
            ]
        );
        $this->add_control( 'orderby',
            [
                'label' => esc_html__( 'Order By', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => 'None',
                    'ID' => 'Post ID',
                    'title' => 'Title',
                    'name' => 'Slug',
                    'date' => 'Date',
                    'rand' => 'Random',
                ],
                'default' => 'rand'
            ]
        );
        $this->add_control( 'permalink',
            [
                'label' => esc_html__( 'Permalink', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'before',
            [
                'label' => esc_html__( 'Before', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => 'you can use icon before link: <i class="fa fa-home"></i>'
            ]
        );
        $this->add_control( 'after',
            [
                'label' => esc_html__( 'After', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => 'you can use icon after link: <i class="fa fa-home"></i>'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_list_style_section',
            [
                'label' => esc_html__( 'List Container Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->wixi_style_text_alignment( 'post_list_alignment','{{WRAPPER}} .nt-post-list' );
        $this->wixi_style_padding( 'post_list_padding','{{WRAPPER}} .nt-post-list' );
        $this->wixi_style_margin( 'post_list_margin','{{WRAPPER}} .nt-post-list' );
        $this->wixi_style_background( 'post_list_margin','{{WRAPPER}} .nt-post-list', array('classic','gradient') );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_list_item_style_section',
            [
                'label' => esc_html__( 'List Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'list_style',
            [
                'label' => esc_html__( 'List Style', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => 'none',
                    'circle' => 'circle',
                    'decimal' => 'decimal',
                    'disc' => 'disc',
                    'inside' => 'inside',
                    'lower-latin' => 'lower-latin',
                    'lower-roman' => 'lower-roman',
                ],
                'default' => 'none',
                'selectors' => [ '{{WRAPPER}} .nt-post-list li' => 'list-style:{{VALUE}}!important;' ],
            ]
        );
        $this->wixi_style_typo( 'post_list_item_typo','{{WRAPPER}} .nt-post-list li' );
        $this->wixi_style_color( 'post_list_item_general_color','{{WRAPPER}} .nt-post-list li *' );
        $this->wixi_style_padding( 'post_list_item_padding','{{WRAPPER}} .nt-post-list li' );
        $this->wixi_style_margin( 'post_list_item_margin','{{WRAPPER}} .nt-post-list li' );
        
        $this->start_controls_tabs( 'post_list_tabs');
        $this->start_controls_tab( 'post_list_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'wixi' ) ]
        );
        // Style function
        $this->wixi_style_color( 'post_list_item_color','{{WRAPPER}} .nt-post-list a' );
        $this->wixi_style_background( 'post_list_item_background','{{WRAPPER}} .nt-post-list a',array('classic','gradient') );
        $this->wixi_style_border( 'post_listitem__border','{{WRAPPER}} .nt-post-list li a' );
        
        $this->end_controls_tab();

        $this->start_controls_tab( 'post_list_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wixi' ) ]
        );
        // Style function
        $this->wixi_style_color( 'post_list_item_hvr_color','{{WRAPPER}} .nt-post-list a:hover' );
        $this->wixi_style_background( 'post_list_item_hvr_background','{{WRAPPER}} .nt-post-list a:hover',array('classic','gradient') );
        $this->wixi_style_border( 'post_list_item_hvr_border','{{WRAPPER}} .nt-post-list a:hover' );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $before = $settings['before'];
        $after = $settings['after'];
        
        $myposts = get_posts( 
            array(
                'posts_per_page' => $settings['post_per_page'],
                'post_type'      => $settings['post_type'],
                'post_status'    => 'publish',
                'orderby'        => $settings['orderby']
            ) 
        );
        
        if ( $myposts ) {

            echo '<ul class="nt-post-list nt-orderby-' . $settings['orderby'] . '">';
            
                foreach ( $myposts as $post ) {
                    setup_postdata( $post );
                    $title     = get_the_title( $post->ID );
                    $permalink = get_the_permalink( $post->ID );
                    echo '<li class="nt-post-list-item nt-post-id-' . $post->ID . ' nt-post-type-' . $post->post_type . '">';
                    
                        if ( 'yes' == $settings['permalink'] ) {
                            
                            echo '<a href="' . esc_url( $permalink ) . '" title="' . $title . '">'. $before . ' ' . $title . ' ' . $after . '</a>';
                            
                        } 
                        else {
                            
                            echo $before . ' ' . $title . ' ' . $after;
                        
                        }
                    echo '</li>';
                
                }
                
            echo '</ul>';
            wp_reset_postdata();

        }

    }
}
