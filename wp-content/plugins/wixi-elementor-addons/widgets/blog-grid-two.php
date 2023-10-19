<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Blog_Grid_Two extends Widget_Base {
    use Wixi_Helper;
    public function get_name() {
        return 'wixi-blog-grid-two';
    }
    public function get_title() {
        return 'Blog Grid (N)';
    }
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    public function get_categories() {
        return [ 'wixi' ];
    }
    public function get_style_depends() {
        return [ 'swiper' ];
    }
    public function get_script_depends() {
        return [ 'swiper','wow' ];
    }
    // Registering Controls
    protected function register_controls() {

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'nt_post_query',
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
        $this->add_control( 'author_filter',
            [
                'label' => esc_html__( 'Author', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wixi_get_users(),
                'description' => 'Select Author(s)'
            ]
        );
        $this->add_control( 'author_exclude_filter',
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
        $this->add_control( 'category_filter',
            [
                'label' => esc_html__( 'Category', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wixi_get_categories(),
                'description' => 'Select Category(s)'
            ]
        );
        $this->add_control( 'category_exclude_filter',
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
        $this->add_control( 'tag_filter',
            [
                'label' => esc_html__( 'Tag', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wixi_get_tags(),
                'description' => 'Select Tag(s)'
            ]
        );
        $this->add_control( 'tag_exclude_filter',
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
        $this->add_control( 'post_filter',
            [
                'label' => esc_html__( 'Specific Post(s)', 'wixi' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wixi_get_posts(),
                'description' => 'Select Specific Post(s)'
            ]
        );
        $this->add_control( 'post_exclude_filter',
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
        $this->add_control('post_per_page',
            [
                'label' => esc_html__( 'Posts Per Page', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'default' => 2
            ]
        );
        $this->add_control('offset',
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
                'label' => esc_html__( 'Pagination', 'betakit' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before'
            ]
        );
        $this->add_control( 'pag_prev',
            [
                'label' => esc_html__( 'Pagination Prev Text', 'betakit' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'PREV',
                'condition' => ['pagination' => 'yes']
            ]
        );
        $this->add_control( 'pag_next',
            [
                'label' => esc_html__( 'Pagination Next Text', 'betakit' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'NEXT',
                'condition' => ['pagination' => 'yes']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wixi_post_options',
            [
                'label' => esc_html__( 'Post Options', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'collg',
            [
                'label' => esc_html__( 'Column for Large Device', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '3' => esc_html__( '4 Column', 'wixi' ),
                    '4' => esc_html__( '3 Column', 'wixi' ),
                    '6' => esc_html__( '2 Column', 'wixi' ),
                    '12' => esc_html__( '1 Column', 'wixi' ),
                ],
                'default' => '4'
            ]
        );
        $this->add_control( 'colmd',
            [
                'label' => esc_html__( 'Column for Medium Device', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '4' => esc_html__( '3 Column', 'wixi' ),
                    '6' => esc_html__( '2 Column', 'wixi' ),
                    '12' => esc_html__( '2 Column', 'wixi' ),
                ],
                'default' => '6'
            ]
        );
        $this->add_control( 'colsm',
            [
                'label' => esc_html__( 'Column for Small Device', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => esc_html__( '2 Column', 'wixi' ),
                    '12' => esc_html__( '1 Column', 'wixi' ),
                ],
                'default' => '12',
            ]
        );
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'large',
			]
		);
        $this->add_control('gap',
            [
                'label' => esc_html__( 'Gap', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => 15,
                'selectors' => [
                    '{{WRAPPER}} .nt-blog .row' => 'margin: 0 -{{SIZE}}px;',
                    '{{WRAPPER}} .nt-blog.blog-grid-two .row' => 'margin-bottom: calc( -{{SIZE}}px * 2 );',
                    '{{WRAPPER}} .nt-blog .item-column' => 'padding: 0 {{SIZE}}px;',
                    '{{WRAPPER}} .nt-blog.blog-grid-two .item-column' => 'margin-bottom: calc( {{SIZE}}px * 2 );',
                ],
            ]
        );
        $this->add_responsive_control( 'alignment',
            [
                'label' => esc_html__( 'Content Alignment', 'wixi' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .nt-blog .item .content' => 'text-align: {{VALUE}};'],
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
            ]
        );
        $this->add_control( 'hideanim',
            [
                'label' => esc_html__( 'Disable Animation', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hidetitle',
            [
                'label' => esc_html__( 'Hide Title', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hidetags',
            [
                'label' => esc_html__( 'Hide Tags', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hidemeta',
            [
                'label' => esc_html__( 'Hide Meta', 'wixi' ),
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
        $this->start_controls_section( 'post_box_style_section',
            [
                'label'=> esc_html__( 'Box Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->wixi_style_padding( 'post_box_padding','{{WRAPPER}} .nt-blog .item' );
        $this->wixi_style_margin( 'post_box_margin','{{WRAPPER}} .nt-blog .item' );
        //  Tabs
        $this->start_controls_tabs('post_box_tabs');
        $this->start_controls_tab( 'post_box_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wixi' ) ]
        );
        $this->wixi_style_border( 'post_box_border','{{WRAPPER}} .nt-blog .item' );
        $this->wixi_style_box_shadow( 'post_box_shadow','{{WRAPPER}} .nt-blog .item' );
        $this->end_controls_tab();
        $this->start_controls_tab('post_box_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wixi' ) ]
        );
        $this->wixi_style_border( 'post_box_hvrborder','{{WRAPPER}} .nt-blog .item:hover .content' );
        $this->wixi_style_box_shadow( 'post_box_hvrshadow','{{WRAPPER}} .nt-blog .item:hover .content' );
        $this->add_control( 'post_box_tags_hvrcolor',
            [
                'label' => esc_html__( 'Hover Tags Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog .item:hover .content .tags' => 'color: {{VALUE}};' ],
                'condition' => ['hidetags!' => 'yes']
            ]
        );
        $this->add_control( 'post_box_meta_hvrcolor',
            [
                'label' => esc_html__( 'Hover Meta Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog .item:hover .content .info' => 'color: {{VALUE}};' ],
                'condition' => ['hidemeta!' => 'yes']
            ]
        );
        $this->add_control( 'post_box_title_hvrcolor',
            [
                'label' => esc_html__( 'Hover Title Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog .item:hover .content .title a' => 'color: {{VALUE}};' ],
                'condition' => ['hidetitle!' => 'yes']
            ]
        );
        $this->add_control( 'post_box_text_hvrcolor',
            [
                'label' => esc_html__( 'Hover Excerpt Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog .item:hover .content .excerpt' => 'color: {{VALUE}};' ],
                'condition' => ['hideexcerpt!' => 'yes']
            ]
        );
        $this->add_control( 'post_box_btn_hvrcolor',
            [
                'label' => esc_html__( 'Hover Button Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog .item:hover .content .more a' => 'color: {{VALUE}};' ],
                'condition' => ['hidebtn!' => 'yes']
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_texcontent_style_section',
            [
                'label'=> esc_html__( 'Text Content Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wixi_style_padding( 'post_texcontent_padding','{{WRAPPER}} .nt-blog .item .content .content-footer' );
        $this->wixi_style_margin( 'post_texcontent_margin','{{WRAPPER}} .nt-blog .item .content .content-footer' );
        $this->wixi_style_border( 'post_texcontent_border','{{WRAPPER}} .nt-blog .item .content .content-footer' );
        $this->wixi_style_box_shadow( 'post_texcontent_shadow','{{WRAPPER}} .nt-blog .item .content .content-footer' );
        $this->add_control( 'post_texcontent_hvrcolor',
            [
                'label' => esc_html__( 'Background Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog .item .content .content-footer' => 'background-color: {{VALUE}};' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_image_style_section',
            [
                'label'=> esc_html__( 'Image Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wixi_style_padding( 'post_image_padding','{{WRAPPER}} .nt-blog .item .content .img' );
        $this->wixi_style_margin( 'post_image_margin','{{WRAPPER}} .nt-blog .item .content .img' );
        $this->wixi_style_border( 'post_image_border','{{WRAPPER}} .nt-blog .item .img' );
        $this->wixi_style_box_shadow( 'post_image_shadow','{{WRAPPER}} .nt-blog .item .img' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_tags_style_section',
            [
                'label'=> esc_html__( 'Tags Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['hidetags!' => 'yes']
            ]
        );
        $this->wixi_style_typo( 'post_tags_typo','{{WRAPPER}} .nt-blog .item .content .tags,{{WRAPPER}} .nt-blog .item .content .tags a' );
        $this->wixi_style_color( 'post_tags_color','{{WRAPPER}} .nt-blog .item .content .tags,{{WRAPPER}} .nt-blog .item .content .tags a' );
        $this->add_control( 'post_tags_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog .item .content .tags a:hover' => 'color: {{VALUE}};' ]
            ]
        );
        $this->wixi_style_padding( 'post_tags_padding','{{WRAPPER}} .nt-blog .item .content .tags, {{WRAPPER}} .nt-blog-pg .posts .item .content .tags a' );
        $this->wixi_style_margin( 'post_tags_margin','{{WRAPPER}} .nt-blog .item .content .tags, {{WRAPPER}} .nt-blog-pg .posts .item .content .tags a' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_meta_style_section',
            [
                'label'=> esc_html__( 'Meta Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->wixi_style_typo( 'post_meta_typo','{{WRAPPER}} .nt-blog .item .content .info' );
        $this->wixi_style_color( 'post_meta_color','{{WRAPPER}} .nt-blog .item .content .info' );
        $this->add_control( 'post_meta_hvrcolor',
            [
                'label' => esc_html__( 'Background Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog.blog-grid-two .item .img .info' => 'background-color: {{VALUE}};' ]
            ]
        );
        $this->wixi_style_padding( 'post_meta_padding','{{WRAPPER}} .nt-blog .item .content .info a' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_title_style_section',
            [
                'label'=> esc_html__( 'Title Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['hidetitle!' => 'yes']
            ]
        );
        $this->wixi_style_typo( 'post_title_typo','{{WRAPPER}} .nt-blog .item .content .title h4' );
        $this->wixi_style_color( 'post_title_color','{{WRAPPER}} .nt-blog .item .content .title h4' );
        $this->add_control( 'post_title_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog .item .content .title h4 a:hover' => 'color: {{VALUE}};' ]
            ]
        );
        $this->wixi_style_padding( 'post_title_padding','{{WRAPPER}} .nt-blog .item .content .title h4' );
        $this->wixi_style_margin( 'post_title_margin','{{WRAPPER}} .nt-blog .item .content .title h4' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_text_style_section',
            [
                'label'=> esc_html__( 'Excerpt Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['hideexcerpt!' => 'yes']
            ]
        );
        $this->wixi_style_typo( 'post_text_typo','{{WRAPPER}} .nt-blog .item .content .excerpt p' );
        $this->wixi_style_color( 'post_text_color','{{WRAPPER}} .nt-blog .item .content .excerpt p' );
        $this->wixi_style_padding( 'post_text_padding','{{WRAPPER}} .nt-blog .item .content .excerpt p' );
        $this->wixi_style_margin( 'post_text_margin','{{WRAPPER}} .nt-blog .item .content .excerpt p' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_btn_style_section',
            [
                'label'=> esc_html__( 'Button Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['hidebtn!' => 'yes']
            ]
        );
        $this->wixi_style_typo( 'post_btn_typo','{{WRAPPER}} .nt-blog .item .content .more a, {{WRAPPER}} .nt-blog-pg .posts .item .content .more' );
        $this->wixi_style_color( 'post_btn_color','{{WRAPPER}} .nt-blog .item .content .more a, {{WRAPPER}} .nt-blog-pg .posts .item .content .more' );
        $this->add_control( 'post_btn_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nt-blog .item .content .more a:hover, {{WRAPPER}} .nt-blog-pg .posts .item .content .more:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .nt-blog-pg .posts .item .content .more:hover:after' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->wixi_style_padding( 'post_btn_padding','{{WRAPPER}} .nt-blog .item .content .more a' );
        $this->wixi_style_margin( 'post_btn_margin','{{WRAPPER}} .nt-blog .item .content .more a' );
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
        $this->wixi_style_typo( 'pagination_typo','{{WRAPPER}} .nt-blog-widget .nt-pagination .page-numbers' );
        $this->add_control( 'pagination_bg',
            [
                'label' => esc_html__( 'Background', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog-widget .nt-pagination .page-numbers' => 'background-color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'pagination_hvrbg',
            [
                'label' => esc_html__( 'Hover/Active Background', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog-widget .nt-pagination .page-numbers.current, {{WRAPPER}} .nt-blog-widget .nt-pagination .page-numbers:hover' => 'background-color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'pagination_color',
            [
                'label' => esc_html__( 'Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog-widget .nt-pagination .page-numbers' => 'color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'pagination_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog-widget .nt-pagination .page-numbers:hover' => 'color: {{VALUE}};' ]
            ]
        );
        $this->add_responsive_control( 'pag_alignment',
            [
                'label' => esc_html__( 'Alignment', 'wixi' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .nt-blog-widget .nt-pagination' => 'justify-content: {{VALUE}}!important;'],
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
                'default' => 'center',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if ( is_home() || is_front_page() ) {
            $paged = get_query_var( 'page') ? get_query_var('page') : 1;
        } else {
            $paged = get_query_var( 'paged') ? get_query_var('paged') : 1;
        }
        $args = array(
            'post_type'        => 'post',
            'author__in'       => $settings['author_filter'],
            'author__not_in'   => $settings['author_exclude_filter'],
            'category__in'     => $settings['category_filter'],
            'category__not_in' => $settings['category_exclude_filter'],
            'tag__in'          => $settings['tag_filter'],
            'tag__not_in'      => $settings['tag_exclude_filter'],
            'post__in'         => $settings['post_filter'],
            'post__not_in'     => $settings['post_exclude_filter'],
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

        $the_query = new \WP_Query( $args );
        if( $the_query->have_posts() ) {
            echo '<div class="blog-grid-two nt-blog nt-blog-widget">';
                echo '<div class="container-off">';
                    echo '<div class="row">';

                        $delay = 2;

                        while ($the_query->have_posts()) {
                            $the_query->the_post();

                            $animation = 'yes' == $settings['hideanim'] ? '"' : ' wow fadeInUp" data-wow-delay="'.($delay / 10).'s"';
                            echo '<div class="col-12 col-sm-'.$settings[ 'colsm' ].' col-md-'.$settings[ 'colmd' ].' col-lg-'.$settings[ 'collg' ].' item-column">';
                                echo '<div class="item'.$animation.'>';
                                    echo '<div class="content">';
                                        if( has_post_thumbnail() ) {
                                            echo '<div class="img">';
                                                echo '<a class="img-link" href="'.get_permalink().'">';
                                                    the_post_thumbnail( $size );
                                                echo '</a>';
                                                if ( 'yes' != $settings[ 'hidemeta' ] ) {
                                                    $post_author = get_author_posts_url( get_the_author_meta( 'ID' ) );
                                                    echo '<div class="info">';
                                                        echo '<i class="far fa-clock"></i> '.get_the_date();
                                                    echo '</div>';
                                                }
                                            echo '</div>';
                                        }
                                        echo '<div class="content-footer">';
                                            if ( has_tag() && 'yes' != $settings[ 'hidetags' ] ) {
                                                echo '<div class="tags">';
                                                    the_tags( '', ' | ', '' );
                                                echo '</div>';
                                            }

                                            if ( 'yes' != $settings[ 'hidetitle' ] ) {
                                                echo '<div class="title"><h5><a href="'.get_permalink().'">'.get_the_title().'</a></h4></div>';
                                            }

                                            if ( 'yes' != $settings[ 'hideexcerpt' ] ) {
                                                if ( has_excerpt() ){
                                                    echo '<div class="excerpt"><p>'.wp_trim_words( get_the_excerpt(), $settings['excerpt_limit'] ).'</p></div>';
                                                } else {
                                                    echo '<div class="excerpt"><p>'.wp_trim_words( trim( strip_tags( get_the_content() ) ), $settings['excerpt_limit'] ).'</p></div>';
                                                }
                                            }
                                            if ( $settings[ 'btn_title' ] && 'yes' != $settings[ 'hidebtn' ] ){
                                                echo '<div class="more"><a href="'.get_permalink().'">'.$settings[ 'btn_title' ].'</a></div>';
                                            }

                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            $delay++;
                        }
                        wp_reset_postdata();
                    echo '</div>';
                    if ( $settings['pagination'] == 'yes' ) {
                        echo '<div class="nt-pagination d-flex justify-content-center align-items-center">';
                            $total_pages = $the_query->max_num_pages;
                            $big = 999999999;
                            if ( $total_pages > 1){
                                echo paginate_links(array(
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
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';

        } else {
            echo '<p class="text">' . esc_html__( 'No post found!', 'wixi' ) . '</p>';
        }
    }
}
