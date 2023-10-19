<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Blog_Grid extends Widget_Base {
    use Wixi_Helper;
    public function get_name() {
        return 'wixi-blog-grid';
    }
    public function get_title() {
        return 'Blog Grid 2 (N)';
    }
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    public function get_categories() {
        return [ 'wixi' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        $rtl = is_rtl() ? '-rtl' : '';
        wp_register_style( 'wixi-blog-grid', WIXI_PLUGIN_URL. 'widgets/blog/grid'.$rtl.'.css');
    }
    public function get_style_depends() {
        return [ 'wixi-blog-grid' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'general_settings',
            [
                'label' => esc_html__( 'General', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'classic' => esc_html__( 'Classic', 'wixi' ),
                    'classic2' => esc_html__( 'Classic 2', 'wixi' ),
                    'classic3' => esc_html__( 'Classic 3', 'wixi' ),
                    'minimal1' => esc_html__( 'Minimal', 'wixi' ),
                    'minimal2' => esc_html__( 'Minimal 2', 'wixi' ),
                    'minimal3' => esc_html__( 'Minimal 3', 'wixi' ),
                    'minimal4' => esc_html__( 'Minimal 4', 'wixi' ),
                    'minimal5' => esc_html__( 'Minimal 5', 'wixi' ),
                    'minimal6' => esc_html__( 'Minimal 6', 'wixi' ),
                    'split' => esc_html__( 'Split', 'wixi' ),
                    'split2' => esc_html__( 'Split 2', 'wixi' ),
                ],
                'default' => 'classic'
            ]
        );
        $this->add_responsive_control( 'box_splitwidth',
            [
                'label' => esc_html__( 'Image Content Width ( % )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => 40,
                'selectors' => [
                    '{{WRAPPER}} .box--split .post--link' => 'width: {{SIZE}}%;',
                    '{{WRAPPER}} .box--split .post--content-wrapper' => 'width: calc( 100% - {{SIZE}}% );',
                    '{{WRAPPER}} .box--split2 .post--link' => 'width: {{SIZE}}%;',
                    '{{WRAPPER}} .box--split2 .post--content-wrapper' => 'width: calc( 100% - {{SIZE}}% );'
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        ['name' => 'type','operator' => '==','value' => 'split'],
                        ['name' => 'type','operator' => '==','value' => 'split2'],
                    ]
                ]
            ]
        );
        $this->add_responsive_control( 'box_splitwidth2',
            [
                'label' => esc_html__( 'Image Content Width ( Hover )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => 50,
                'selectors' => [
                    '{{WRAPPER}} .box--split .blog--layout-grid:hover .post--link' => 'width: {{SIZE}}%;',
                    '{{WRAPPER}} .box--split .blog--layout-grid:hover .post--content-wrapper' => 'width: calc( 100% - {{SIZE}}% );',
                    '{{WRAPPER}} .box--split2 .blog--layout-grid:hover .post--link' => 'width: {{SIZE}}%;',
                    '{{WRAPPER}} .box--split2 .blog--layout-grid:hover .post--content-wrapper' => 'width: calc( 100% - {{SIZE}}% );'
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        ['name' => 'type','operator' => '==','value' => 'split'],
                        ['name' => 'type','operator' => '==','value' => 'split2'],
                    ]
                ]
            ]
        );
        $this->add_control( 'thumb_type',
            [
                'label' => esc_html__( 'Thumbnail Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'image' => esc_html__( 'Default Image', 'wixi' ),
                    'bg' => esc_html__( 'Background Image', 'wixi' ),
                ],
                'default' => 'image',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'box_minh',
            [
                'label' => esc_html__( 'Max Height ( % )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => 100,
                'selectors' => [
                    '{{WRAPPER}} .item--thumb-bg .post--bg-image' => 'padding-top: calc( {{SIZE}}vh - 40px );',
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        ['name' => 'thumb_type','operator' => '==','value' => 'bg'],
                        [
                            'relation' => 'or',
                            'terms' => [
                                ['name' => 'type','operator' => '==','value' => 'classic'],
                                ['name' => 'type','operator' => '==','value' => 'classic2'],
                                ['name' => 'type','operator' => '==','value' => 'classic3']
                            ]
                        ]
                    ]
                ]
            ]
        );
        $this->add_responsive_control( 'box_minh2',
            [
                'label' => esc_html__( 'Max Height ( vh )', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .item--thumb-bg .post--bg-image' => 'padding-top: calc( {{SIZE}}vh );',
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        ['name' => 'thumb_type','operator' => '==','value' => 'bg'],
                        ['name' => 'type','operator' => '!=','value' => 'classic'],
                        ['name' => 'type','operator' => '!=','value' => 'classic2'],
                        ['name' => 'type','operator' => '!=','value' => 'classic3']
                    ]
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
            ]
        );
        $this->add_control( 'scale_image',
            [
                'label' => esc_html__( 'Scale Image Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__( 'None', 'wixi' ),
                    'out' => esc_html__( 'Scale Out', 'wixi' ),
                    'in' => esc_html__( 'Scale In', 'wixi' ),
                ],
                'default' => 'out',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        ['name' => 'type','operator' => '!=','value' => 'split'],
                        ['name' => 'type','operator' => '!=','value' => 'split2'],
                    ]
                ]
            ]
        );
        $this->add_control( 'overlay_type',
            [
                'label' => esc_html__( 'Overlay Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__( 'None', 'wixi' ),
                    'always' => esc_html__( 'Always Show', 'wixi' ),
                    'on-hover' => esc_html__( 'On Hover', 'wixi' ),
                ],
                'default' => 'on-hover',
            ]
        );
        $this->add_control( 'gap',
            [
                'label' => esc_html__( 'Gap', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => 15,
                'selectors' => [
                    '{{WRAPPER}} .item--grid' => 'padding: calc( {{SIZE}}px / 2 );',
                    '{{WRAPPER}} .blog--grid-row' => 'margin: 0 calc( -{{SIZE}}px / 2 );',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'col',
            [
                'label' => esc_html__( 'Column', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'col-lg-3' => esc_html__( '4 Column', 'wixi' ),
                    'col-lg-4' => esc_html__( '3 Column', 'wixi' ),
                    'col-lg-6' => esc_html__( '2 Column', 'wixi' ),
                    'col-lg-12' => esc_html__( '1 Column', 'wixi' ),
                ],
                'default' => 'col-lg-6',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'colmd',
            [
                'label' => esc_html__( 'Column ( Desktop )', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'col-md-4' => esc_html__( '3 Column', 'wixi' ),
                    'col-md-6' => esc_html__( '2 Column', 'wixi' ),
                    'col-md-12' => esc_html__( '2-1 Column', 'wixi' ),
                ],
                'default' => 'col-md-6',
            ]
        );
        $this->add_control( 'colsm',
            [
                'label' => esc_html__( 'Column ( Tablet )', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'col-sm-4' => esc_html__( '3 Column', 'wixi' ),
                    'col-sm-6' => esc_html__( '2 Column', 'wixi' ),
                    'col-sm-12' => esc_html__( '1 Column', 'wixi' ),
                ],
                'default' => 'col-sm-6',
            ]
        );
        $this->add_control( 'colxs',
            [
                'label' => esc_html__( 'Column ( Phone )', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'col-xs-6' => esc_html__( '2 Column', 'wixi' ),
                    'col-xs-12' => esc_html__( '1 Column', 'wixi' ),
                ],
                'default' => 'col-xs-12',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'query_section',
            [
                'label' => esc_html__( 'Query', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'author_filter_heading',
            [
                'label' => esc_html__( 'Author Filter', 'wixi' ),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_control( 'author_include',
            [
                'label' => esc_html__( 'Author', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wixi_get_users(),
                'description' => 'Select Author(s)'
            ]
        );
        $this->add_control( 'author_exclude',
            [
                'label' => esc_html__( 'Exclude Author', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wixi_get_users(),
                'description' => 'Select Author(s) to Exclude',
                'separator' => 'after'
            ]
        );
        $this->add_control( 'category_filter_heading',
            [
                'label' => esc_html__( 'Category Filter', 'wixi' ),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_control( 'category_include',
            [
                'label' => esc_html__( 'Category', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wixi_get_categories(),
                'description' => 'Select Category(s)'
            ]
        );
        $this->add_control( 'category_exclude',
            [
                'label' => esc_html__( 'Exclude Category', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wixi_get_categories(),
                'description' => 'Select Category(s) to Exclude',
                'separator' => 'after'
            ]
        );
        $this->add_control( 'tag_filter_heading',
            [
                'label' => esc_html__( 'Tag Filter', 'wixi' ),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_control( 'tag_include',
            [
                'label' => esc_html__( 'Tag', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wixi_get_tags(),
                'description' => 'Select Tag(s)'
            ]
        );
        $this->add_control( 'tag_exclude',
            [
                'label' => esc_html__( 'Exclude Tag', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wixi_get_tags(),
                'description' => 'Select Tag(s) to Exclude',
                'separator' => 'after'
            ]
        );
        $this->add_control( 'post_filter_heading',
            [
                'label' => esc_html__( 'Post Filter', 'wixi' ),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_control( 'post_include',
            [
                'label' => esc_html__( 'Specific Post(s)', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wixi_get_posts(),
                'description' => 'Select Specific Post(s)'
            ]
        );
        $this->add_control( 'post_exclude',
            [
                'label' => esc_html__( 'Exclude Post', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wixi_get_posts(),
                'description' => 'Select Post(s) to Exclude',
                'separator' => 'after'
            ]
        );
        $this->add_control( 'post_other_heading',
            [
                'label' => esc_html__( 'Other Filter', 'wixi' ),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_control( 'post_per_page',
            [
                'label' => esc_html__( 'Posts Per Page', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'default' => 6
            ]
        );
        $this->add_control( 'offset',
            [
                'label' => esc_html__( 'Offset', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000
            ]
        );
        $this->add_control( 'order',
            [
                'label' => esc_html__( 'Select Order', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'Ascending',
                    'DESC' => 'Descending'
                ],
                'default' => 'ASC'
            ]
        );
        $this->add_control( 'orderby',
            [
                'label' => esc_html__( 'Order By', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => 'None',
                    'ID' => 'Post ID',
                    'author' => 'Author',
                    'title' => 'Title',
                    'name' => 'Slug',
                    'date' => 'Date',
                    'modified' => 'Last Modified Date',
                    'parent' => 'Post Parent ID',
                    'rand' => 'Random',
                    'comment_count' => 'Number of Comments',
                ],
                'default' => 'none'
            ]
        );
        $this->add_control( 'pagination',
            [
                'label' => esc_html__( 'Pagination', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before'
            ]
        );
        $this->add_control( 'pag_prev',
            [
                'label' => esc_html__( 'Pagination Prev Text', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'PREV',
                'condition' => ['pagination' => 'yes']
            ]
        );
        $this->add_control( 'pag_next',
            [
                'label' => esc_html__( 'Pagination Next Text', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'NEXT',
                'condition' => ['pagination' => 'yes']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_options_section',
            [
                'label' => esc_html__( 'Post Data Display', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'hidethumb',
            [
                'label' => esc_html__( 'Hide Thumbnail', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hidetitle',
            [
                'label' => esc_html__( 'Hide Title', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hidechar',
            [
                'label' => esc_html__( 'Hide First Letter', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hidecats',
            [
                'label' => esc_html__( 'Hide Category', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'cats_sep',
            [
                'label' => esc_html__( 'Category Separator', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'condition' => ['hidecats!' => 'yes']
            ]
        );
        $this->add_control( 'hideestimate',
            [
                'label' => esc_html__( 'Hide Estimate', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hideavatar',
            [
                'label' => esc_html__( 'Hide Author Avatar', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hideauthor',
            [
                'label' => esc_html__( 'Hide Author', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'before_author',
            [
                'label' => esc_html__( 'Author Before', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Posted by',
                'label_block' => true,
                'condition' => ['hideauthor!' => 'yes']
            ]
        );
        $this->add_control( 'hidedate',
            [
                'label' => esc_html__( 'Hide Date', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hideexcerpt',
            [
                'label' => esc_html__( 'Hide Excerpt', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'excerpt_limit',
            [
                'label' => esc_html__( 'Excerpt Word Limit', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => 20,
                'condition' => ['hideexcerpt!' => 'yes']
            ]
        );
        $this->add_control( 'hidebtn',
            [
                'label' => esc_html__( 'Hide Button', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Read More Title', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read more',
                'label_block' => true,
                'condition' => ['hidebtn!' => 'yes']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_fast_style_section',
            [
                'label'=> esc_html__( 'Fast Color', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'general_box_item',
            [
                'label' => esc_html__( 'GENERAL', 'wixi' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control( 'item_box_color',
            [
                'label' => esc_html__( 'Box Background Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog--layout-grid' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'item_overlay_color',
            [
                'label' => esc_html__( 'Overlay Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .post--thumb:after' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'hover_link_color',
            [
                'label' => esc_html__( 'Link Hover Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog--layout-grid a:hover, {{WRAPPER}} .blog--layout-grid .post--btn-more:hover' => 'color:{{VALUE}}!important;' ]
            ]
        );
        $this->add_responsive_control( 'alignment',
            [
                'label' => esc_html__( 'Alignment', 'wixi' ),
                'type' => Controls_Manager::CHOOSE,
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
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .post--content-wrapper' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .post--btn-more' => 'justify-content: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control( 'btn_alignment',
            [
                'label' => esc_html__( 'Button Alignment', 'wixi' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
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
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .post--btn-more' => 'max-width: 100%;justify-content: {{VALUE}};',
                ]
            ]
        );
        $this->start_controls_tabs('item_normal_tabs');
        $this->start_controls_tab( 'item_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wixi' ) ]
        );
        $this->add_control( 'item_date_color',
            [
                'label' => esc_html__( 'Date Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .post--author-details,{{WRAPPER}} .post--date-stroked' => 'color:{{VALUE}};', ],
                'condition' => ['hidedate!' => 'yes']
            ]
        );
        $this->add_control( 'item_dateday_color',
            [
                'label' => esc_html__( 'Date Day Color ( Minimal )', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .date--day' => '-webkit-text-stroke-color:{{VALUE}};',
                    '{{WRAPPER}} .blog--layout-grid:hover .date--day' => 'color:{{VALUE}};',
                ],
                'condition' => ['hidedate!' => 'yes']
            ]
        );
        $this->add_control( 'item_authname_color',
            [
                'label' => esc_html__( 'Author Name Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .post--author-details .post--author b' => 'color:{{VALUE}};', ],
                'condition' => ['hideauthor!' => 'yes']
            ]
        );
        $this->add_control( 'item_char_color',
            [
                'label' => esc_html__( 'Char Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .title--char' => '-webkit-text-stroke-color:{{VALUE}};',
                    '{{WRAPPER}} .title--char:before' => 'color:{{VALUE}};',
                ],
                'condition' => ['hidechar!' => 'yes']
            ]
        );
        $this->add_control( 'item_cats_color',
            [
                'label' => esc_html__( 'Category Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .post--category' => 'color:{{VALUE}};', ],
                'condition' => ['hidecats!' => 'yes']
            ]
        );
        $this->add_control( 'item_estimate_color',
            [
                'label' => esc_html__( 'Estimate Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .post--estimate' => 'color:{{VALUE}};', ],
                'condition' => ['hideestimate!' => 'yes']
            ]
        );
        $this->add_control( 'item_estimate_sep_color',
            [
                'label' => esc_html__( 'Estimate Separator Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .post--estimate:before' => 'color:{{VALUE}};', ],
                'condition' => ['hideestimate!' => 'yes']
            ]
        );
        $this->add_control( 'item_title_color',
            [
                'label' => esc_html__( 'Title Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .post--heading' => 'color:{{VALUE}};', ],
                'condition' => ['hidetitle!' => 'yes']
            ]
        );
        $this->add_control( 'item_excerpt_color',
            [
                'label' => esc_html__( 'Excerpt Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .post--excerpt' => 'color:{{VALUE}};', ],
                'condition' => ['hideexcerpt!' => 'yes']
            ]
        );
        $this->add_control( 'item_btn_color',
            [
                'label' => esc_html__( 'Button Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .post--btn-more' => 'color:{{VALUE}};' ],
                'condition' => ['hidebtn!' => 'yes']
            ]
        );
        $this->add_control( 'item_btn_arrow_color',
            [
                'label' => esc_html__( 'Button Arrow Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .post--btn-more i' => 'color:{{VALUE}};' ],
                'condition' => ['hidebtn!' => 'yes']
            ]
        );
        $this->add_control( 'btn_point_color',
            [
                'label' => esc_html__( 'Button Point Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .post--btn-point:after, {{WRAPPER}} .post--btn-point:before' => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} .blog--layout-grid .post--btn-point:after' => 'opacity:0.3;',
                ],
                'condition' => ['hidebtn!' => 'yes']
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'item_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wixi' ) ]
        );
        $this->add_control( 'item_hover_date_color',
            [
                'label' => esc_html__( 'Date Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .post--author-details' => 'color:{{VALUE}};', ],
                'condition' => ['hidedate!' => 'yes']
            ]
        );
        $this->add_control( 'item_hover_author_color',
            [
                'label' => esc_html__( 'Author Name Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .post--author-details .post--author b' => 'color:{{VALUE}};', ],
                'condition' => ['hideauthor!' => 'yes']
            ]
        );
        $this->add_control( 'item_hover_cats_color',
            [
                'label' => esc_html__( 'Category Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .blog--layout-grid:hover .post--category' => 'color:{{VALUE}};', ],
                'condition' => ['hidecats!' => 'yes']
            ]
        );
        $this->add_control( 'item_hover_estimate_color',
            [
                'label' => esc_html__( 'Estimate Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .blog--layout-grid:hover .post--estimate' => 'color:{{VALUE}};', ],
                'condition' => ['hideestimate!' => 'yes']
            ]
        );
        $this->add_control( 'item_hover_estimate_sep_color',
            [
                'label' => esc_html__( 'Estimate Separator Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .blog--layout-grid:hover .post--estimate:before' => 'color:{{VALUE}};', ],
                'condition' => ['hideestimate!' => 'yes']
            ]
        );
        $this->add_control( 'item_hover_title_color',
            [
                'label' => esc_html__( 'Title Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .blog--layout-grid:hover .post--heading' => 'color:{{VALUE}};', ],
                'condition' => ['hidetitle!' => 'yes']
            ]
        );
        $this->add_control( 'item_hover_excerpt_color',
            [
                'label' => esc_html__( 'Excerpt Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .blog--layout-grid:hover .post--excerpt' => 'color:{{VALUE}};', ],
                'condition' => ['hideexcerpt!' => 'yes']
            ]
        );
        $this->add_control( 'item_hover_btn_color',
            [
                'label' => esc_html__( 'Button Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog--layout-grid:hover .post--btn-more' => 'color:{{VALUE}};' ],
                'condition' => ['hidebtn!' => 'yes']
            ]
        );
        $this->add_control( 'item_hover_btn_arrow_color',
            [
                'label' => esc_html__( 'Button Arrow Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog--layout-grid .post--btn-more:hover i' => 'color:{{VALUE}};' ],
                'condition' => ['hidebtn!' => 'yes']
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_advanced_style_section',
            [
                'label'=> esc_html__( 'Advanced Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control( 'post_box_heading',
            [
                'label' => esc_html__( 'BOX', 'wixi' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->wixi_style_border( 'post_box_border','{{WRAPPER}} .blog--layout-grid' );
        $this->wixi_style_box_shadow( 'post_box_shadow','{{WRAPPER}} .blog--layout-grid' );
        $this->add_control( 'post_text_content_heading',
            [
                'label' => esc_html__( 'TEXT CONTENT', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->wixi_style_border( 'post_text_content_border','{{WRAPPER}} .post--content-wrapper' );
        $this->wixi_style_padding( 'post_text_content_padding','{{WRAPPER}} .post--content-wrapper' );
        $this->wixi_style_margin( 'post_text_content_margin','{{WRAPPER}} .post--content-wrapper' );
        $this->wixi_style_box_shadow( 'post_text_content_shadow','{{WRAPPER}} .post--content-wrapper' );
        $this->add_control( 'post_author_heading',
            [
                'label' => esc_html__( 'AUTHOR AVATAR', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'post_author_size',
            [
                'label' => esc_html__( 'Size', 'wixi' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100
                    ]
                ],
                'default' => [''],
                'selectors' => ['{{WRAPPER}} .post--meta-author .avatar' => 'width: {{SIZE}};height: {{SIZE}};'],
            ]
        );
        $this->wixi_style_border( 'post_author_border','{{WRAPPER}} .post--meta-author .avatar' );
        $this->wixi_style_box_shadow( 'post_author_shadow','{{WRAPPER}} .post--meta-author .avatar' );
        $this->add_control( 'post_author_details_heading',
            [
                'label' => esc_html__( 'AUTHOR DETAILS', 'wixi' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->wixi_style_typo( 'post_author_typo','{{WRAPPER}} .post--author-details' );
        $this->wixi_style_margin( 'post_author_margin','{{WRAPPER}} .post--author-details' );
        $this->add_control( 'post_cats_heading',
            [
                'label' => esc_html__( 'CATEGORY', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->wixi_style_typo( 'post_cats_typo','{{WRAPPER}} .post--category' );
        $this->wixi_style_margin( 'post_cats_margin','{{WRAPPER}} .post--category' );
        $this->add_control( 'post_estimate_heading',
            [
                'label' => esc_html__( 'ESTIMATE', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->wixi_style_typo( 'post_estimate_typo','{{WRAPPER}} .post--estimate' );
        $this->wixi_style_margin( 'post_estimate_margin','{{WRAPPER}} .post--estimate' );
        $this->add_control( 'post_title_heading',
            [
                'label' => esc_html__( 'TITLE', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->wixi_style_typo( 'post_title_typo','{{WRAPPER}} .blog--layout-grid .post--heading' );
        $this->wixi_style_margin( 'post_title_margin','{{WRAPPER}} .blog--layout-grid .post--heading' );
        $this->add_control( 'post_excerpt_heading',
            [
                'label' => esc_html__( 'EXCERPT', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->wixi_style_typo( 'post_excerpt_typo','{{WRAPPER}} .post--excerpt' );
        $this->wixi_style_margin( 'post_excerpt_margin','{{WRAPPER}} .post--excerpt' );
        $this->add_control( 'post_btn_heading',
            [
                'label' => esc_html__( 'BUTTON', 'wixi' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->wixi_style_typo( 'post_btn_typo','{{WRAPPER}} .post--btn-more' );
        $this->wixi_style_margin( 'post_btn_margin','{{WRAPPER}} .post--btn-more' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'pagination_style_section',
            [
                'label'=> esc_html__( 'Pagination Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['pagination' => 'yes']
            ]
        );
        $this->wixi_style_typo( 'pagination_typo','{{WRAPPER}} .nt-pagination .page-numbers' );
        $this->add_responsive_control( 'pag_alignment',
            [
                'label' => esc_html__( 'Alignment', 'wixi' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .nt-pagination' => 'justify-content: {{VALUE}}!important;'],
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'wixi' ),
                        'icon' => 'eicon-h-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'wixi' ),
                        'icon' => 'eicon-h-align-center'
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'wixi' ),
                        'icon' => 'eicon-h-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => 'center',
            ]
        );
        $this->add_control( 'pagination_spacing',
            [
                'label' => esc_html__( 'Space Between Items', 'wixi' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100
                    ]
                ],
                'default' => [''],
                'selectors' => ['{{WRAPPER}} .nt-pagination .page-numbers' => 'margin: 0 {{SIZE}}px;'],
            ]
        );
        $this->wixi_style_padding( 'pagination_padding','{{WRAPPER}} .nt-pagination .page-numbers' );
        $this->start_controls_tabs('pagination_normal_tabs');
        $this->start_controls_tab( 'pagination_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wixi' ) ]
        );
        $this->add_control( 'pagination_bg',
            [
                'label' => esc_html__( 'Background', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-pagination .page-numbers' => 'background-color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'pagination_color',
            [
                'label' => esc_html__( 'Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-pagination .page-numbers' => 'color: {{VALUE}};' ]
            ]
        );
        $this->wixi_style_border( 'pagination_border','{{WRAPPER}} .nt-pagination .page-numbers' );
        $this->end_controls_tab();
        $this->start_controls_tab( 'pagination_hover_tab',
            [ 'label' => esc_html__( 'Hover/Active', 'wixi' ) ]
        );
        $this->add_control( 'pagination_hvrbg',
            [
                'label' => esc_html__( 'Background', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-pagination .page-numbers.current, {{WRAPPER}} .nt-pagination .page-numbers:hover' => 'background-color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'pagination_hvrcolor',
            [
                'label' => esc_html__( 'Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-pagination .page-numbers.current,{{WRAPPER}} .nt-pagination .page-numbers:hover' => 'color: {{VALUE}};' ]
            ]
        );
        $this->wixi_style_border( 'pagination_hvrborder','{{WRAPPER}} .nt-pagination .page-numbers' );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }
    //estimated reading time
    public function reading_time( $pid ) {
        $content = get_post_field( 'post_content', $pid );
        $word_count = str_word_count( strip_tags( $content ) );
        $readingtime = ceil( $word_count / 200);
        $timer = " min read";
        $totalreadingtime = $readingtime . $timer;
        return $totalreadingtime;
    }
    //estimated reading time
    public function post_author() {
        $settings = $this->get_settings_for_display();
        $html = '';
        if ( 'yes' != $settings[ 'hideavatar' ] || 'yes' != $settings[ 'hideauthor' ] || 'yes' != $settings[ 'hidedate' ] ) {
            $html .= '<div class="post--meta-author">';
                if ( 'yes' != $settings[ 'hideavatar' ] ) {
                    $html .= get_avatar( get_the_author_meta( 'ID' ), 50 );
                }
                if ( 'yes' != $settings[ 'hideauthor' ] || 'yes' != $settings[ 'hidedate' ] ) {
                    $html .= '<div class="post--author-details">';
                        if ( 'yes' != $settings[ 'hideauthor' ] ) {
                            $before_author = $settings['before_author'] ? $settings['before_author'] : '';
                            $html .= '<div class="post--author">'.$before_author.' <b>'.get_the_author().'</b></div>';
                        }
                        if ( 'minimal2' != $settings[ 'type' ] ) {
                            if ( 'yes' != $settings[ 'hidedate' ] ) {
                                $html .= '<span class="post--date">'.get_the_date().'</span>';
                            }
                        }
                    $html .= '</div>';
                }
            $html .= '</div>';
        }
        return $html;
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $type = $settings[ 'type' ];
        $attrtype = preg_match("/minimal/i", $type ) ? 'minimal '.$type : $type;
        $is_editor = \Elementor\Plugin::$instance->editor->is_edit_mode() ? true : false;
        $html = '';

        if ( is_home() || is_front_page() ) {
            $paged = get_query_var( 'page') ? get_query_var('page') : 1;
        } else {
            $paged = get_query_var( 'paged') ? get_query_var('paged') : 1;
        }

        $args = array(
            'post_type'        => 'post',
            'author__in'       => $settings['author_include'],
            'author__not_in'   => $settings['author_exclude'],
            'category__in'     => $settings['category_include'],
            'category__not_in' => $settings['category_exclude'],
            'tag__in'          => $settings['tag_include'],
            'tag__not_in'      => $settings['tag_exclude'],
            'post__in'         => $settings['post_include'],
            'post__not_in'     => $settings['post_exclude'],
            'posts_per_page'   => $settings['post_per_page'],
            'offset'           => $settings['offset'],
            'order'            => $settings['order'],
            'orderby'          => $settings['orderby'],
            'paged'            => $paged
        );

        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }

        $classes[] = $settings['col'];
        $classes[] .= $settings['colmd'];
        $classes[] .= $settings['colsm'];
        $classes[] .= $settings['colxs'];
        $classes[] .= 'box--grid box--'.$attrtype;
        $classes[] .= 'item--grid item--'.$attrtype;
        $classes[] .= 'item--thumb-'.$settings[ 'thumb_type' ];
        $classes[] .= 'item--scale-image-'.$settings[ 'scale_image' ];
        $classes[] .= 'item--overlay-'.$settings[ 'overlay_type' ];

        $the_query = new \WP_Query( $args );
        if ( $the_query->have_posts() ) {

            while ($the_query->have_posts()) {
                $the_query->the_post();

                    $postclasses = get_post_class( '', get_the_ID() );
                    $classes = array_merge( $classes, $postclasses );

                    $html .= '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">';

                        $html .= '<div class="blog--layout-grid">';

                            if ( ( 'minimal2' == $type || 'minimal4' == $type ) && 'yes' != $settings[ 'hidedate' ] ) {
                                $html .= '<span class="post--date-stroked">';
                                    $html .= '<span class="date--day">'.get_the_date('d').'</span>';
                                    $html .= '<span class="date--small">';
                                        $html .= '<span class="date--month">'.get_the_date('M').'</span> / ';
                                        $html .= '<span class="date--year">'.get_the_date('Y').'</span>';
                                    $html .= '</span>';
                                $html .= '</span>';
                            }

                            if ( ( 'minimal3' == $type || 'minimal5' == $type ) && 'yes' != $settings[ 'hidechar' ] ) {

                                $html .= '<span class="title--char-wrapper">';
                                    $html .= '<span class="title--char" data-char="'.substr( get_the_title(), 0, 1 ).'">';
                                        $html .= substr( get_the_title(), 0, 1 );
                                    $html .= '</span>';
                                $html .= '</span>';
                            }

                            if ( 'classic2' == $type || 'minimal2' == $type || 'minimal3' == $type ) {
                                $html .= $this->post_author();
                            }

                            if ( has_post_thumbnail() && 'yes' != $settings[ 'hidethumb' ] ) {
                                $bgurl = get_the_post_thumbnail_url( get_the_ID(), $size );
                                $bgimage = $is_editor ? ' style="background-image:url('.$bgurl.')"' : ' data-wixi-bg-src="'.$bgurl.'"';
                                $html .= '<a class="post--link" href="'.get_permalink().'">';
                                    $html .= '<figure class="post--thumb">';
                                        if ( 'bg' == $settings[ 'thumb_type' ] ) {
                                            $html .= '<div class="post--bg-image"'.$bgimage.'></div>';
                                        } else {
                                            $html .= get_the_post_thumbnail( get_the_ID(), $size, array( 'class' => 'post--image' ) );
                                        }
                                        if ( 'classic' == $type || 'split' == $type || 'minimal' == $type ) {
                                            $html .= $this->post_author();
                                        }
                                    $html .= '</figure>';
                                $html .= '</a>';
                            }

                            $html .= '<div class="post--content-wrapper">';
                                if ( 'classic3' == $type ) {
                                    $html .= $this->post_author();
                                }
                                $html .= '<div class="post--content">';
                                    if ( 'yes' != $settings[ 'hidecats' ] ) {
                                        $cats_sep = $settings[ 'cats_sep' ] ? $settings[ 'cats_sep' ] : ', ';
                                        $html .= '<div class="post--category">';
                                            ob_start();
                                            the_category( $cats_sep );
                                        $html .= ob_get_clean();
                                        if ( 'yes' != $settings[ 'hideestimate' ] ) {
                                            $html .= '<span class="post--estimate">'.$this->reading_time(get_the_ID()).'</span>';
                                        }
                                        $html .= '</div>';
                                    }
                                    if ( 'yes' != $settings[ 'hidetitle' ] ) {
                                        $html .= '<h3 class="post--heading"><a href="'.get_permalink().'">'.get_the_title().' </a></h3>';
                                    }
                                    if ( !preg_match("/minimal/i", $type ) && 'yes' != $settings[ 'hideexcerpt' ] ) {
                                        $html .= '<p class="post--excerpt">'.wp_trim_words( get_the_excerpt(), $settings['excerpt_limit'] ).'</p>';
                                    }

                                    if ( 'yes' != $settings[ 'hidebtn' ] ) {
                                        $html .= '<a href="'.get_permalink().'" class="post--btn-more type--circle"><span class="post--btn-point"></span>'.$settings[ 'btn_title' ];
                                            $html .= '<i class="post--btn-icon"><svg class="arrow-icon"
                                            width="16"
                                            height="16"
                                            viewBox="0 0 16 16"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"><path d="M0 8H15M15 8L8.5 1.5M15 8L8.5 14.5"
                                            stroke-width="2"
                                            stroke-linejoin="round"></path></svg></i>';
                                        $html .= '</a>';
                                    }

                                $html .= '</div>';
                            $html .= '</div>';

                        $html .= '</div>';
                    $html .= '</div>'; // column
                }
                wp_reset_postdata();
                $pag = '';
                if ( $settings['pagination'] == 'yes' ) {

                    $pag .= '<div class="nt-pagination d-flex justify-content-center align-items-center">';
                    $total_pages = $the_query->max_num_pages;
                    $big = 999999999;
                    if ( $total_pages > 1){
                        $pag .= paginate_links(array(
                            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format'    => '?paged=%#%',
                            'current'   => max(1, $paged),
                            'total'     => $total_pages,
                            'type'      => '',
                            'prev_text' => $settings['pag_prev'] ? esc_html($settings['pag_prev']) : 'PREV',
                            'next_text' => $settings['pag_next'] ? esc_html($settings['pag_next']) : 'NEXT',
                            'before_page_number' => '<div class="nt-pagination-item">',
                            'after_page_number' => '</div>'
                        ));
                    }
                    $pag .= '</div>';
                }
            // print html

            echo '<div class="blog--layout-grid-wrapper"><div id="blog--grid-'.$id.'" class="row blog--grid-row">'.$html.'</div>'.$pag.'</div>';

        } else {
            echo '<p class="text">' . esc_html__( 'No post found!', 'wixi' ) . '</p>';
        }
    }
}
