<?php
namespace Elementor;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;

trait Wixi_Helper
{
    /**
    * Query Controls
    *
    */
    protected function wixi_query_controls( $def="post", $pag = false, $filter = false )
    {
        $post_types = $this->wixi_get_post_types();

        $this->add_control( 'post_type',
            [
                'label'     => esc_html__( 'Post Type', 'wixi' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $post_types,
                'default'   => $def,
            ]
        );
        $this->add_control('posts_per_page',
            [
                'label' => esc_html__( 'Posts Per Page', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'default' => 6
            ]
        );
        if ( true == $filter ) {
            foreach ( $post_types as $slug => $label ) {

                $this->add_control( $slug . '_filter_top_type_heading',
                    array(
                        /* translators: %s: post type label */
                        'label'       => sprintf( '%s %s', mb_strtoupper( $label ), __( 'TOP FILTER', 'wixi' ) ),
                        'type'        => Controls_Manager::HEADING,
                        'separator'   => 'before',
                        'condition' => [ 'post_type' => $slug ]
                    )
                );

                $taxonomy = $this->get_post_taxonomies( $slug );

                if ( ! empty( $taxonomy ) ) {
                    $tax_terms = array();
                    foreach ( $taxonomy as $index => $tax ) {
                        $tax_terms[ $index ] = $index. ' ( '. $label .' )' ;
                    }

                    if ( ! empty( $tax_terms ) ) {
                        //var_dump($tax_terms);
                        $this->add_control( $slug . '_top_taxonomy',
                            array(
                                /* translators: %s Label */
                                'label' => sprintf( __( '%s Taxonomy Type', 'wixi' ), $label ),
                                'type' => Controls_Manager::SELECT2,
                                'default' => '',
                                'multiple' => true,
                                'label_block' => true,
                                'options' => $tax_terms,
                                'condition' => [ 'post_type' => $slug ],
                            )
                        );
                    }
                }
            }

            foreach ( $post_types as $slug => $label ) {
                $taxonomy = $this->get_post_taxonomies( $slug );
                $terms = array();
                $taxterms = array();
                foreach ( $taxonomy as $index => $tax ) {
                    $terms = $this->get_tax_terms( $index );
                    foreach ( $terms as $term ) {
                        $taxterms[ $term->term_id ] = $term->name;
                    }
                }

                if ( ! empty( $taxterms ) ) {
                    $this->add_control( $slug . '_top_filter',
                        array(
                            /* translators: %s Label */
                            'label' => sprintf( __( '%s Taxonomy Exclude', 'wixi' ), $label ),
                            'type' => Controls_Manager::SELECT2,
                            'default' => '',
                            'multiple' => true,
                            'label_block' => true,
                            'options' => $taxterms,
                            'condition' => [ 'post_type' => $slug ],
                        )
                    );
                }
            }

            foreach ( $post_types as $slug => $label ) {

                $this->add_control( $slug . '_filter_type_heading',
                    array(
                        /* translators: %s: post type label */
                        'label'       => sprintf( __( '%s FILTER', 'wixi'), mb_strtoupper( $label ) ),
                        'type'        => Controls_Manager::HEADING,
                        'separator'   => 'before',
                        'condition' => [ 'post_type' => $slug ]
                    )
                );
                $taxonomy = $this->get_post_taxonomies( $slug );

                if ( ! empty( $taxonomy ) ) {

                    foreach ( $taxonomy as $index => $tax ) {

                        $terms = $this->get_tax_terms( $index );

                        $tax_terms = array();

                        if ( ! empty( $terms ) ) {

                            foreach ( $terms as $term_index => $term_obj ) {

                                $tax_terms[ $term_obj->term_id ] = $term_obj->name;
                            }

                            $tax_control_key = $index . '_' . $slug;

                            if ( $slug == 'post' ) {
                                if ( $index == 'post_tag' ) {
                                    $tax_control_key = 'tags';
                                } elseif ( $index == 'category' ) {
                                    $tax_control_key = 'categories';
                                }
                            }
                            // Taxonomy filter type.
                            $this->add_control( $index . '_' . $slug . '_filter_type',
                                [
                                    'label' => sprintf( __( '%s Filter Type', 'wixi' ), $tax->label ),
                                    'type' => Controls_Manager::SELECT,
                                    'default' => 'IN',
                                    'label_block' => true,
                                    'options' => [
                                        'IN' => sprintf( __( 'Include %s', 'wixi' ), $tax->label ),
                                        'NOT IN' => sprintf( __( 'Exclude %s', 'wixi' ), $tax->label ),
                                    ],
                                    'condition' => [ 'post_type'  => $slug ]
                                ]
                            );
                            $this->add_control( $tax_control_key,
                                [
                                    'label' => $tax->label,
                                    'type' => Controls_Manager::SELECT2,
                                    'multiple' => true,
                                    'label_block' => true,
                                    'options' => $tax_terms,
                                    'condition' => [ 'post_type' => $slug ]
                                ]
                            );
                        }
                    }
                }
            }
        }
        $this->add_control( 'author_filter_type',
            array(
                'label' => esc_html__( 'Authors Filter Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'author__in',
                'label_block' => true,
                'separator' => 'before',
                'options' => array(
                    'author__in' => esc_html__( 'Include Authors', 'wixi' ),
                    'author__not_in' => esc_html__( 'Exclude Authors', 'wixi' ),
                ),
            )
        );
        $this->add_control( 'authors',
            [
                'label' => esc_html__( 'Author', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wixi_get_users(),
                'description' => 'Select Author(s)'
            ]
        );

        foreach ( $post_types as $slug => $label ) {

            $this->add_control( $slug . '_filter_type',
                array(
                    /* translators: %s: post type label */
                    'label'       => sprintf( __( '%s Filter Type', 'wixi' ), $label ),
                    'type'        => Controls_Manager::SELECT,
                    'default'     => 'post__not_in',
                    'label_block' => true,
                    'separator'   => 'before',
                    'options'     => array(
                        /* translators: %s: post type label */
                        'post__in'     => sprintf( __( 'Include %s', 'wixi' ), $label ),
                        /* translators: %s: post type label */
                        'post__not_in' => sprintf( __( 'Exclude %s', 'wixi' ), $label ),
                    ),
                    'condition' => [ 'post_type' => $slug ]
                )
            );
            $this->add_control( $slug . '_filter',
                array(
                    /* translators: %s Label */
                    'label' => $label,
                    'type' => Controls_Manager::SELECT2,
                    'default' => '',
                    'multiple' => true,
                    'label_block' => true,
                    'options' => $this->get_all_posts_by_type( $slug ),
                    'condition' => [ 'post_type' => $slug ]
                )
            );
        }
        $this->add_control( 'post_other_heading',
            [
                'label' => esc_html__( 'OTHER FILTER', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control('offsets',
            [
                'label' => esc_html__( 'Offset', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000
            ]
        );
        $this->add_control( 'orders',
            [
                'label' => esc_html__( 'Select Order', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__( 'Ascending', 'wixi' ),
                    'DESC' => esc_html__( 'Descending', 'wixi' ),
                ],
                'default' => 'ASC'
            ]
        );
        $this->add_control( 'orderbys',
            [
                'label' => esc_html__( 'Order By', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__( 'None', 'wixi' ),
                    'ID' => esc_html__( 'Post ID', 'wixi' ),
                    'author' => esc_html__( 'Author', 'wixi' ),
                    'title' => esc_html__( 'Title', 'wixi' ),
                    'name' => esc_html__( 'Slug', 'wixi' ),
                    'date' => esc_html__( 'Date', 'wixi' ),
                    'modified' => esc_html__( 'Last Modified Date', 'wixi' ),
                    'parent' => esc_html__( 'Post Parent ID', 'wixi' ),
                    'rand' => esc_html__( 'Random', 'wixi' ),
                    'comment_count' => esc_html__( 'Number of Comments', 'wixi' ),
                ],
                'default' => 'none'
            ]
        );
        if ( true == $pag ) {
            $this->add_control( 'paginations',
                [
                    'label' => esc_html__( 'Pagination', 'wixi' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'separator' => 'before'
                ]
            );
        }
    }


    /*** BACKGROUND STYLE OPTIONS WITH POPOVER TOGGLE ****/
    protected function wixi_style_background( $id='',$selector='',$types=array('classic','gradient','video') )
    {
        $this->add_control( $id.'_background_popover_toggle',
            [
                'label' => esc_html__( 'Background', 'wixi' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes'
            ]
        );
        $this->start_popover();

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => $id,
                'label' => esc_html__( 'Background', 'wixi' ),
                'types' => $types,
                'selector' => $selector
            ]
        );
        $this->end_popover();
    }

    /*** ALIGNMENT NORMAL STYLE OPTIONS WITH POPOVER TOGGLE ****/
    protected function wixi_style_text_alignment( $id='',$selector='' )
    {
        $this->add_control( $id.'_text_alignment_popover_toggle',
            [
                'label' => esc_html__( 'Text Alignment', 'wixi' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes'
            ]
        );
        $this->start_popover();

        $this->add_responsive_control( $id,
            [
                'label' => esc_html__( 'Alignment', 'wixi' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => [$selector => 'text-align: {{VALUE}};'],
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'wixi' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'wixi' ),
                        'icon' => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'wixi' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => ''
            ]
        );
        $this->end_popover();
    }

    /*** ALIGNMENT FLEX STYLE OPTIONS WITH POPOVER TOGGLE ****/
    protected function wixi_style_flex_alignment( $id='', $selector='' )
    {
        $this->add_control( $id.'_flex_alignment_popover_toggle',
            [
                'label' => esc_html__( 'Alignment', 'wixi' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'description' => esc_html__( 'Set width for the alignment', 'wixi' ),
            ]
        );
        $this->start_popover();

        $this->add_responsive_control( $id,
            [
                'label' => esc_html__( 'Alignment', 'wixi' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => [$selector => 'display:flex;align-items:center;justify-content: {{VALUE}};'],
                'options' => [
                    'flex-start'      => [
                        'title' => esc_html__( 'Left', 'wixi' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'wixi' ),
                        'icon' => 'fa fa-align-center'
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'wixi' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => ''
            ]
        );
        $this->end_popover();
    }


    /*** ALIGNMENT CONTENT STYLE OPTIONS WITH POPOVER TOGGLE ****/
    protected function wixi_style_content_alignment( $id='',$selector='' )
    {
        $this->add_control( $id.'_content_alignment_popover_toggle',
            [
                'label' => esc_html__( 'Alignment', 'wixi' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes'
            ]
        );
        $this->start_popover();

        $this->add_responsive_control( $id,
            [
                'label' => esc_html__( 'Alignment', 'wixi' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => [$selector => '{{VALUE}};'],
                'options' => [
                    'margin-right:auto;margin-left:inherit' => [
                        'title' => esc_html__( 'Left', 'wixi' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'margin-right:auto;margin-left:auto' => [
                        'title' => esc_html__( 'Center', 'wixi' ),
                        'icon' => 'fa fa-align-center'
                    ],
                    'margin-left:auto' => [
                        'title' => esc_html__( 'Right', 'wixi' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => ''
            ]
        );
        $this->end_popover();
    }

    /*** PADDING STYLE OPTIONS WITH POPOVER TOGGLE ****/
    protected function wixi_style_padding( $id='',$selector='', $allow='all' )
    {
        $this->add_control( $id.'_padding_popover_toggle',
            [
                'label' => esc_html__( 'Padding', 'wixi' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes'
            ]
        );
        $this->start_popover();

        $this->add_responsive_control( $id,
            [
                'label' => esc_html__( 'Padding', 'wixi' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [$selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'allowed_dimensions' => $allow,
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->end_popover();
    }

    /*** MARGIN STYLE OPTIONS WITH POPOVER TOGGLE ****/
    protected function wixi_style_margin( $id='',$selector='', $allow='all' )
    {
        $this->add_control( $id.'_margin_popover_toggle',
            [
                'label' => esc_html__( 'Margin', 'wixi' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes'
            ]
        );
        $this->start_popover();

        $this->add_responsive_control( $id,
            [
                'label' => esc_html__( 'Margin', 'wixi' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'allowed_dimensions' => $allow,
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->end_popover();
    }

    /*** BORDER STYLE OPTIONS WITH POPOVER TOGGLE ****/
    protected function wixi_style_border( $id='',$selector='' )
    {
        $this->add_control( $id.'_border_popover_toggle',
            [
                'label' => esc_html__( 'Border', 'wixi' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes'
            ]
        );
        $this->start_popover();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => $id,
                'label' => esc_html__( 'Border', 'wixi' ),
                'selector' => $selector
            ]
        );
        $this->add_responsive_control( $id,
            [
                'label' => esc_html__( 'Border Radius', 'wixi' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [ $selector => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->end_popover();
    }
    /*** COLOR STYLE OPTIONS ****/
    protected function wixi_style_color( $id='',$selector='' )
    {
        $selector = is_array($selector) ? $selector : [ $selector => 'color: {{VALUE}};'];
        $this->add_control( $id,
            [
                'label' => esc_html__( 'Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => $selector
            ]
        );
    }
    /*** COLOR STYLE OPTIONS ****/
    protected function wixi_style_hovercolor( $id='',$selector='' )
    {
        $this->add_control( $id,
            [
                'label' => esc_html__( 'Hover Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ $selector.':hover' => 'color: {{VALUE}};']
            ]
        );
    }
    /*** BACKGROUND COLOR STYLE OPTIONS ****/
    protected function wixi_style_bgcolor( $id='',$selector='' )
    {
        $this->add_control( $id,
            [
                'label' => esc_html__( 'Background Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ $selector => 'background-color: {{VALUE}};']
            ]
        );
    }
    /*** BACKGROUND COLOR STYLE OPTIONS ****/
    protected function wixi_style_svg_fill_color( $id='',$selector='' )
    {
        $selector = is_array($selector) ? $selector : [ $selector => 'fill: {{VALUE}};'];
        $this->add_control( $id,
            [
                'label' => esc_html__( 'Fill Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => $selector
            ]
        );
    }
    /*** BACKGROUND COLOR STYLE OPTIONS ****/
    protected function wixi_style_svg_stroke_color( $id='',$selector='' )
    {
        $selector = is_array($selector) ? $selector : [ $selector => 'stroke: {{VALUE}};'];
        $this->add_control( $id,
            [
                'label' => esc_html__( 'Stroke Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => $selector
            ]
        );
    }
    /*** TYPOGRAHY STYLE OPTIONS ****/
    protected function wixi_style_typo( $id='',$selector='' )
    {
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => $id,
                'label' => esc_html__( 'Typography', 'wixi' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => $selector
            ]
        );
    }
    /*** BOX SHADOW STYLE OPTIONS ****/
    protected function wixi_style_box_shadow( $id='',$selector='' )
    {
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => $id,
                'label' => esc_html__( 'Box Shadow', 'wixi' ),
                'selector' => $selector,
                'separator' => 'before'
            ]
        );
    }
    /*** TEXT SHADOW STYLE OPTIONS ****/
    protected function wixi_style_text_shadow( $id='',$selector='' )
    {
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => $id,
                'label' => esc_html__( 'Text Shadow', 'wixi' ),
                'selector' => $selector
            ]
        );
    }
    /*** SLIDER WIDTH AND HEIGHT STYLE OPTIONS ****/
    protected function wixi_style_slider_size( $id='',$selector=array(), $min=0, $max=500, $unit='px' )
    {
        $this->add_control( $id,
            [
                'label' => esc_html__( 'Size', 'wixi' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [ $unit => [ 'min' => $min,'max' => $max ] ],
                'selectors' => $selector
            ]
        );
    }
    /*** SLIDER WIDTH STYLE OPTIONS ****/
    protected function wixi_style_slider_width( $id='', $selector=array(), $min=0, $max=500, $unit='px' )
    {
        $this->add_responsive_control( $id,
            [
                'label' => esc_html__( 'Width ( '.$unit.' )', 'wixi' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [ $unit => ['min' => $min,'max' => $max ] ],
                'selectors' => $selector
            ]
        );
    }
    /*** SLIDER HEIGHT STYLE OPTIONS ****/
    protected function wixi_style_slider_height( $id='',$selector=array(), $min=0, $max=1000, $unit='px' )
    {
        $this->add_control( $id,
            [
                'label' => esc_html__( 'Height ( '.$unit.' )', 'wixi' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [ $unit => [ 'min' => $min,'max' => $max ] ],
                'selectors' => $selector
            ]
        );
    }
    /*** NUMBER STYLE OPTIONS ****/
    protected function wixi_style_opacity( $id='', $selector=array() )
    {
        $this->add_control( $id,
            [
                'label' => esc_html__( 'Opacity', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'selectors' => $selector
            ]
        );
    }
    /*** NUMBER STYLE OPTIONS ****/
    protected function wixi_style_number( $id='',$label='Width', $selector=array(), $value='', $min=0, $max=1000, $step=1 )
    {
        $this->add_control( $id,
            [
                'label' => $label,
                'type' => Controls_Manager::NUMBER,
                'min' => $min,
                'max' => $max,
                'step' => $step,
                'selectors' => $selector
            ]
        );
    }

    protected function wixi_style_controls($hide_controls = array(),$id='',$selector='')
    {
        $hide_controls = $hide_controls;
        // Color
        if($selector && $id){
            if(in_array('color', $hide_controls) == false){
                $this->add_control(
                    $id.'_color',
                    [
                        'label' => esc_html__( 'Color', 'wixi' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => ['{{WRAPPER}} '.$selector => 'color: {{VALUE}};']
                    ]
                );
            }
            // Typography
            if(in_array('typo', $hide_controls) == false){
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name' => $id.'_typo',
                        'label' => esc_html__( 'Typography', 'wixi' ),
                        'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                        'selector' => '{{WRAPPER}} '.$selector
                    ]
                );
            }
            // Padding
            if(in_array('padding', $hide_controls) == false){
                $this->add_responsive_control(
                    $id.'_padding',
                    [
                        'label' => esc_html__( 'Padding', 'wixi' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em', '%' ],
                        'selectors' => ['{{WRAPPER}} '.$selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                        'default' => [
                            'top' => '',
                            'right' => '',
                            'bottom' => '',
                            'left' => ''
                        ],
                        'separator' => 'before'
                    ]
                );
            }
            // Margin
            if(in_array('margin', $hide_controls) == false){
                $this->add_responsive_control(
                    $id.'_margin',
                    [
                        'label' => esc_html__( 'Margin', 'wixi' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em', '%' ],
                        'selectors' => ['{{WRAPPER}} '.$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                        'default' => [
                            'top' => '',
                            'right' => '',
                            'bottom' => '',
                            'left' => ''
                        ],
                        'separator' => 'before'
                    ]
                );
            }
            // Border
            if(in_array('border', $hide_controls) == false){
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => $id.'_border',
                        'label' => esc_html__( 'Border', 'wixi' ),
                        'selector' => '{{WRAPPER}} '.$selector,
                        'separator' => 'before'
                    ]
                );
            }
            $this->add_control( 'hr_border_radius_'.$id,
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
            // Border
            if(in_array('border', $hide_controls) == false){
                $this->add_responsive_control(
                    $id.'_border_radius',
                    [
                        'label' => esc_html__( 'Border Radius', 'wixi' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => ['{{WRAPPER}} '.$selector => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                        'default' => [
                            'top' => '',
                            'right' => '',
                            'bottom' => '',
                            'left' => ''
                        ]
                    ]
                );
            }
            $this->add_control( 'hr_shadow_'.$id,
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
            // Box shadow
            if(in_array('shadow', $hide_controls) == false){
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => $id.'_shadow',
                        'label' => esc_html__( 'Box shadow', 'wixi' ),
                        'selector' => '{{WRAPPER}} '.$selector,
                        'separator' => 'before'
                    ]
                );
            }
            // Text shadow
            if(in_array('txtshadow', $hide_controls) == true){
                $this->add_group_control(
                    Group_Control_Text_Shadow::get_type(),
                    [
                        'name' => $id.'_txtshadow',
                        'label' => esc_html__( 'Text shadow', 'wixi' ),
                        'selector' => '{{WRAPPER}} '.$selector,
                        'separator' => 'before'
                    ]
                );
            }
            // Background
            if(in_array('background', $hide_controls) == false){
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => $id.'_background',
                        'label' => esc_html__( 'Background', 'wixi' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} '.$selector,
                        'separator' => 'before'
                    ]
                );
            }
        }
    }

    /**
    * Get all elementor page templates
    *
    * @return array
    */
    public function wixi_get_elementor_templates($type = null)
    {
        $args = [
            'post_type' => 'elementor_library',
            'posts_per_page' => -1,
        ];
        if ($type) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'elementor_library_type',
                    'field' => 'slug',
                    'terms' => $type,
                ],
            ];
        }
        $page_templates = get_posts($args);
        $options = array();
        if (!empty($page_templates) && !is_wp_error($page_templates)) {
            foreach ($page_templates as $post) {
                $options[$post->ID] = $post->post_title;
            }
        }
        return $options;
    }


    /*
    * List Blog Users
    */
    public function wixi_get_users()
    {
        $users = get_users();
        $options = array();
        if ( ! empty( $users ) && ! is_wp_error( $users ) ) {
            foreach ( $users as $user ) {
                if( $user->user_login !== 'wp_update_service' ) {
                    $options[ $user->ID ] = $user->user_login;
                }
            }
        }
        return $options;
    }


    /*
     * List Categories
     */
    public function wixi_get_categories()
    {
        $terms = get_terms( 'category', array(
            'orderby'    => 'count',
            'hide_empty' => 0
        ) );
        $options = array();
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {
                $options[ $term->term_id ] = $term->name;
            }
        }
        return $options;
    }


    /*
    * List Tags
    */
    public function wixi_get_tags()
    {
        $tags = get_tags();
        $options = array();
        if ( ! empty( $tags ) && ! is_wp_error( $tags ) ){
            foreach ( $tags as $tag ) {
                $options[ $tag->term_id ] = $tag->name;
            }
        }
        return $options;
    }

    /**
    * Get All Posts by Post Type.
    *
    */
    public function get_all_posts_by_type( $post_type ) {

        $list = get_posts(
            array(
                'post_type'      => $post_type,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'posts_per_page' => -1,
            )
        );

        $posts = array();

        if ( ! empty( $list ) && ! is_wp_error( $list ) ) {
            foreach ( $list as $post ) {
                $posts[ $post->ID ] = $post->post_title;
            }
        }

        return $posts;
    }

    /**
    * Get Post Taxonomies.
    *
    * @since 1.4.2
    * @param string $post_type Post type.
    * @access public
    */
    public function get_post_taxonomies( $post_type ) {
        $data       = array();
        $taxonomies = array();

        if ( !empty( $post_type ) ) {
            $taxonomies = get_object_taxonomies( $post_type, 'objects' );

            foreach ( $taxonomies as $tax_slug => $tax ) {

                if ( ! $tax->public || ! $tax->show_ui ) {
                    continue;
                }

                $data[ $tax_slug ] = $tax;
            }

        }

        return $data;
    }

    public function get_tax_terms( $taxonomy ) {
        $terms = array();

        if ( !empty( $taxonomy ) ) {
            $terms = get_terms( $taxonomy );
            $tax_terms[ $taxonomy ] = $terms;
        }

        return $terms;
    }

    /**
    * Get all available taxonomies
    *
    * @since 1.4.7
    */
    public function get_taxonomies_options() {

        $options = array();
        $taxonomies = array();

        $taxonomies = get_taxonomies(
            array(
                'show_in_nav_menus' => true,
            ),
            'objects'
        );
        if ( !empty( $taxonomies ) ) {
            foreach ( $taxonomies as $taxonomy ) {
                $options[ $taxonomy->name ] = $taxonomy->label;
            }
        }

        return $options;
    }

    /*
     * List Posts
     */
    public function wixi_get_posts() {
        $list = get_posts( array(
            'post_type'         => 'post',
            'posts_per_page'    => -1,
        ) );
        $options = array();
        if ( ! empty( $list ) && ! is_wp_error( $list ) ) {
            foreach ( $list as $post ) {
                $options[ $post->ID ] = $post->post_title;
            }
        }
        return $options;
    }


    public function wixi_cpt_get_post_title($cptname='') {
        if ( $cptname ) {
            $list = get_posts( array(
                'post_type'         => $cptname,
                'posts_per_page'    => -1,
            ) );
            $options = array();
            if ( ! empty( $list ) && ! is_wp_error( $list ) ) {
                foreach ( $list as $post ) {
                    $options[ $post->ID ] = $post->post_title;
                }
            }
            return $options;
        }

    }

    /**
    * Get Next post title
    * @return array
    */
    public function wixi_cpt_get_next_post_title() {
        $next_post = get_next_post();
        if ( $next_post ) {
            return get_the_title( $next_post->ID );
        }
    }

    /**
    * Get Next post permalink
    * @return array
    */
    public function wixi_cpt_get_next_post_permalink() {
        $next_post = get_next_post();
        if ( $next_post ) {
            return get_permalink( $next_post->ID );
        }
    }

    /**
    * Get previous post title
    * @return array
    */
    public function wixi_cpt_get_prev_post_title() {
        $prev_post = get_previous_post();
        if ( $prev_post ) {
            return get_the_title( $prev_post->ID );
        }
    }

    /**
    * Get previous post permalink
    * @return array
    */
    public function wixi_cpt_get_prev_post_permalink() {
        $prev_post = get_previous_post();
        if ( $prev_post ) {
            return get_permalink( $prev_post->ID );
        }
    }

    /**
    * Get All Post Types
    * @return array
    */
    public function wixi_get_post_types()
    {
        $wixi_cpts = get_post_types( array( 'public' => true ), 'object' );
        $post_types = array_merge( $wixi_cpts );
        $types = array();
        foreach ($post_types as $type) {
            $types[$type->name] = $type->label;
        }
        return $types;
    }


    /**
    * Get CPT Taxonomies
    * @return array
    */
    public function wixi_cpt_taxonomies($posttype,$value='id')
    {
        $options = array();
        $terms = get_terms( $posttype );
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                if ('name' == $value) {
                    $options[$term->name] = $term->name;
                } else {
                    $options[$term->term_id] = $term->name;
                }
            }
        }
        return $options;
    }


    /**
    * Get Tribe Events Taxonomies
    * @return array
    */
    public function wixi_tribe_events_taxonomies($value='id')

    {
        $options = array();
        $terms = get_terms(\TribeEvents::TAXONOMY, array('hide_empty' => 0));
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                if ('name' == $value) {
                    $options[$term->name] = $term->name;
                } else {
                    $options[$term->term_id] = $term->name;
                }
            }
        }
        return $options;
    }

    /**
    * Get Tribe Events Post
    * @return array
    */
    public function wixi_tribe_events_post()
    {
        global $post;
        $options = array();

        if ( function_exists( 'tribe_get_events' ) ) {
            $events = tribe_get_events();
            if (!empty($events) && !is_wp_error($events)) {
                foreach ($events as $post) {
                    setup_postdata( $post );
                    $options[$post->ID] = $post->post_title;
                }
                wp_reset_postdata();
            }
        }
        return $options;
    }


    /**
    * Get Tribe Events Post
    * @return array
    */
    public function wixi_events_manager_post_ids()
    {
        $options = array();
        $events = get_posts( array( 'post_type' => 'event' ) );
        foreach ( $events as $post ) {
            $options[ $post->ID ] = $post->post_title;
        }
        return $options;
    }


    /**
    * Get WooCommerce Attributes
    * @return array
    */
    public function wixi_woo_attributes()
    {
        $options = array();
        if ( class_exists( 'WooCommerce' ) ) {
            global $product;
            $terms = wc_get_attribute_taxonomies();
            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $options[$term->attribute_name] = $term->attribute_label;
                }
            }
        }
        return $options;
    }

    /**
    * Get WooCommerce Attributes Taxonomies
    * @return array
    */
    public function wixi_woo_attributes_taxonomies()
    {
        $options = array();
        if ( class_exists( 'WooCommerce' ) ) {
            $attribute_taxonomies = wc_get_attribute_taxonomies();
            foreach ($attribute_taxonomies as $tax) {
                $terms = get_terms( 'pa_'.$tax->attribute_name, 'orderby=name&hide_empty=0' );
                foreach ($terms as $term) {
                    $options[$term->name] = $term->name;
                }
            }
        }
        return $options;
    }

    /**
    * Get WooCommerce Product Skus
    * @return array
    */
    public function wixi_woo_get_skus()
    {
        $options = array();
        if ( class_exists( 'WooCommerce' ) ) {
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1
            );
            $wcProductsArray = get_posts($args);
            if (count($wcProductsArray)) {
                foreach ($wcProductsArray as $productPost) {
                    $productSKU = get_post_meta($productPost->ID, '_sku', true);
                    $options[$productSKU] = $productSKU;
                }
            }
        }
        return $options;
    }


    /*
    * List Contact Forms
    */
    public function wixi_get_cf7() {
        $list = get_posts( array(
            'post_type'         => 'wpcf7_contact_form',
            'posts_per_page'    => -1,
        ) );
        $options = array();
        if ( ! empty( $list ) && ! is_wp_error( $list ) ) {
            foreach ( $list as $form ) {
                $options[ $form->ID ] = $form->post_title;
            }
        }
        return $options;
    }


    /*
    * List Sidebars
    */
    public function nt_registered_sidebars() {
        global $wp_registered_sidebars;
        $options = array();
        if ( ! empty( $wp_registered_sidebars ) && ! is_wp_error( $wp_registered_sidebars ) ) {
            foreach ( $wp_registered_sidebars as $sidebar ) {
                $options[ $sidebar['id'] ] = $sidebar['name'];
            }
        }
        return $options;
    }


    /*
    * List Menus
    */
    public function nt_registered_nav_menus() {
        $menus = wp_get_nav_menus();
        $options = array();
        if ( ! empty( $menus ) && ! is_wp_error( $menus ) ) {
            foreach ( $menus as $menu ) {
                $options[ $menu->slug ] = $menu->name;
            }
        }
        return $options;
    }


    public function wixi_registered_image_sizes() {
        $image_sizes = get_intermediate_image_sizes();
        $options = array();
        if ( ! empty( $image_sizes ) && ! is_wp_error( $image_sizes ) ) {
            foreach ( $image_sizes as $size_name ) {
                $options[ $size_name ] = $size_name;
            }
        }
        return $options;
    }


    /*
    * List Icons
    */
    public function wixi_theme_icon_list()
    {
        $options = array(
            '' => esc_html__( 'None', 'wixi' ),
            'is-user' => esc_html__( 'user', 'wixi' ),
            'is-youtube' => esc_html__( 'youtube', 'wixi' ),
            'is-wordpress' => esc_html__( 'wordpress', 'wixi' ),
            'is-whatsapp' => esc_html__( 'whatsapp', 'wixi' ),
            'is-watch' => esc_html__( 'watch', 'wixi' ),
            'is-vine' => esc_html__( 'vine', 'wixi' ),
            'is-view' => esc_html__( 'eye', 'wixi' ),
            'is-twitter' => esc_html__( 'twitter', 'wixi' ),
            'is-tripadvisor' => esc_html__( 'tripadvisor', 'wixi' ),
            'is-support' => esc_html__( 'support', 'wixi' ),
            'is-star' => esc_html__( 'star', 'wixi' ),
            'is-star-outline' => esc_html__( 'star-outline', 'wixi' ),
            'is-spotify' => esc_html__( 'spotify', 'wixi' ),
            'is-soundcloud' => esc_html__( 'soundcloud', 'wixi' ),
            'is-snapchat' => esc_html__( 'snapchat', 'wixi' ),
            'is-skype' => esc_html__( 'skype', 'wixi' ),
            'is-send' => esc_html__( 'send', 'wixi' ),
            'is-search' => esc_html__( 'search', 'wixi' ),
            'is-rss' => esc_html__( 'rss', 'wixi' ),
            'is-reddit' => esc_html__( 'reddit', 'wixi' ),
            'is-quality' => esc_html__( 'quality', 'wixi' ),
            'is-pinterest' => esc_html__( 'pinterest', 'wixi' ),
            'is-odnoklassniki' => esc_html__( 'odnoklassniki', 'wixi' ),
            'is-next' => esc_html__( 'next', 'wixi' ),
            'is-myspace' => esc_html__( 'myspace', 'wixi' ),
            'is-menu' => esc_html__( 'menu', 'wixi' ),
            'is-linkedin' => esc_html__( 'linkedin', 'wixi' ),
            'is-itunes' => esc_html__( 'itunes', 'wixi' ),
            'is-internet' => esc_html__( 'internet', 'wixi' ),
            'is-instagram' => esc_html__( 'instagram', 'wixi' ),
            'is-heart' => esc_html__( 'heart', 'wixi' ),
            'is-google-plus' => esc_html__( 'google-plus', 'wixi' ),
            'is-google-plus2' => esc_html__( 'google-plus2', 'wixi' ),
            'is-github' => esc_html__( 'github', 'wixi' ),
            'is-gift' => esc_html__( 'gift', 'wixi' ),
            'is-filter' => esc_html__( 'filter', 'wixi' ),
            'is-facebook' => esc_html__( 'facebook', 'wixi' ),
            'is-exchange' => esc_html__( 'exchange', 'wixi' ),
            'is-dribbble' => esc_html__( 'dribbble', 'wixi' ),
            'is-document' => esc_html__( 'document', 'wixi' ),
            'is-digg' => esc_html__( 'digg', 'wixi' ),
            'is-delete' => esc_html__( 'delete', 'wixi' ),
            'is-close' => esc_html__( 'close', 'wixi' ),
            'is-comment' => esc_html__( 'comment', 'wixi' ),
            'is-charity' => esc_html__( 'charity', 'wixi' ),
            'is-cart' => esc_html__( 'cart', 'wixi' ),
            'is-calendar' => esc_html__( 'calendar', 'wixi' ),
            'is-box' => esc_html__( 'box', 'wixi' ),
            'is-behance' => esc_html__( 'behance', 'wixi' ),
            'is-bag' => esc_html__( 'bag', 'wixi' ),
            'is-back' => esc_html__( 'back', 'wixi' ),
            'is-avatar' => esc_html__( 'avatar', 'wixi' ),
            'is-apple' => esc_html__( 'apple', 'wixi' ),
            'is-arrow-up' => esc_html__( 'arrow-up', 'wixi' ),
            'is-arrow-right' => esc_html__( 'arrow-right', 'wixi' ),
            'is-arrow-right2' => esc_html__( 'arrow-right2', 'wixi' ),
            'is-arrow-down' => esc_html__( 'arrow-down', 'wixi' ),
            'is-arrow-down2' => esc_html__( 'arrow-down2', 'wixi' ),
            'is-arrow-500px2' => esc_html__( 'arrow-500px2', 'wixi' ),
            'is-arrow-500px' => esc_html__( 'arrow-500px', 'wixi' ),
        );
        return $options;
    }

    // hex to rgb color
    public function wixi_hextorgb($hex) {
        $hex = str_replace("#", "", $hex);
        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        $rgb = array($r, $g, $b);
        return $rgb; // returns an array with the rgb values
    }

}
