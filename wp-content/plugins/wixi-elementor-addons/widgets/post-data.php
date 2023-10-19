<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wixi_Post_Data extends Widget_Base {
    use Wixi_Helper;
    public function get_name() {
        return 'wixi-post-data';
    }
    public function get_title() {
        return 'Post Data (N)';
    }
    public function get_icon() {
        return 'eicon-shortcode';
    }
    public function get_categories() {
        return [ 'wixi-post' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wixi_post_data_settings',
            [
                'label' => esc_html__('Post Data', 'wixi'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'data',
            [
                'label' => esc_html__( 'Data Type', 'wixi' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'title' => esc_html__( 'Title', 'wixi' ),
                    'featured' => esc_html__( 'Featured Image', 'wixi' ),
                    'author' => esc_html__( 'Author Name', 'wixi' ),
                    'desc' => esc_html__( 'Author Description', 'wixi' ),
                    'avatar' => esc_html__( 'Author Avatar', 'wixi' ),
                    'date' => esc_html__( 'Date', 'wixi' ),
                    'cat' => esc_html__( 'Category', 'wixi' ),
                    'tag' => esc_html__( 'Tags', 'wixi' ),
                    'commnet-number' => esc_html__( 'Comment Number', 'wixi' ),
                    'comment-template' => esc_html__( 'Comment Template', 'wixi' ),
                    'related' => esc_html__( 'Related Post', 'wixi' ),
                    'nav' => esc_html__( 'Navigation', 'wixi' ),
                    'prev' => esc_html__( 'Previous Post', 'wixi' ),
                    'next' => esc_html__( 'Next Post', 'wixi' ),
                ],
                'default' => 'title'
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Tag', 'elementories' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'p',
                'options' => [
                    'h1' => esc_html__( 'h1', 'elementories' ),
                    'h2' => esc_html__( 'h2', 'elementories' ),
                    'h3' => esc_html__( 'h3', 'elementories' ),
                    'h4' => esc_html__( 'h4', 'elementories' ),
                    'h5' => esc_html__( 'h5', 'elementories' ),
                    'h6' => esc_html__( 'h6', 'elementories' ),
                    'div' => esc_html__( 'div', 'elementories' ),
                    'p' => esc_html__( 'p', 'elementories' ),
                    'span' => esc_html__( 'span', 'elementories' )
                ],
                'separator' => 'before',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [ 'name' => 'data','operator' => '==','value' => 'date' ],
                        [ 'name' => 'data','operator' => '==','value' => 'cat' ],
                        [ 'name' => 'data','operator' => '==','value' => 'commnet-number' ],
                        [ 'name' => 'data','operator' => '==','value' => 'tag' ],
                        [ 'name' => 'data','operator' => '==','value' => 'title' ],
                        [ 'name' => 'data','operator' => '==','value' => 'author' ],
                        [ 'name' => 'data','operator' => '==','value' => 'desc' ]
                    ]
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [ 'name' => 'data','operator' => '==','value' => 'featured' ],
                        [ 'name' => 'data','operator' => '==','value' => 'related' ],
                    ]
                ]
            ]
        );
        $this->add_responsive_control( 'perpage',
            [
                'label' => esc_html__( 'Post Per Page', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 6,
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_responsive_control( 'title',
            [
                'label' => esc_html__( 'Section Title', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Related Posts',
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_responsive_control( 'subtitle',
            [
                'label' => esc_html__( 'Section Subtitle', 'wixi' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Awesome Works',
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'hidetitle',
            [
                'label' => esc_html__( 'Hide Title', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'hidedate',
            [
                'label' => esc_html__( 'Hide Date', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'hideexcerpt',
            [
                'label' => esc_html__( 'Hide Excerpt', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'excerpt_limit',
            [
                'label' => esc_html__( 'Excerpt Word Limit', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => 20,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [ 'name' => 'data','operator' => '==','value' => 'related' ],
                        [ 'name' => 'hideexcerpt','operator' => '!=','value' => 'yes' ],
                    ]
                ]
            ]
        );
        $this->add_control( 'perview',
            [
                'label' => esc_html__( 'Per View', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 4,
                'condition' => [ 'data' => 'related' ],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'mdperview',
            [
                'label' => esc_html__( 'Per View Tablet', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 2,
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'smperview',
            [
                'label' => esc_html__( 'Per View Phone', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 1,
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'speed',
            [
                'label' => esc_html__( 'Speed', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 100,
                'default' => 1000,
                'separator' => 'before',
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'loop',
            [
                'label' => esc_html__( 'Loop', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'mousewheel',
            [
                'label' => esc_html__( 'Mousewheel', 'wixi' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'gap',
            [
                'label' => esc_html__( 'Gap', 'wixi' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => 30,
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'wixi' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read more',
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->end_controls_section();

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('data_style_section',
            [
                'label'=> esc_html__( 'Data Style', 'wixi' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [ 'name' => 'data','operator' => '==','value' => 'date' ],
                        [ 'name' => 'data','operator' => '==','value' => 'cat' ],
                        [ 'name' => 'data','operator' => '==','value' => 'commnet-number' ],
                        [ 'name' => 'data','operator' => '==','value' => 'tag' ],
                        [ 'name' => 'data','operator' => '==','value' => 'title' ],
                        [ 'name' => 'data','operator' => '==','value' => 'author' ],
                        [ 'name' => 'data','operator' => '==','value' => 'desc' ]
                    ]
                ]
            ]
        );

        $this->add_control( 'post_data_color',
            [
                'label' => esc_html__( 'Color', 'wixi' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .post--data, {{WRAPPER}} .post--data a' => 'color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->wixi_style_typo( 'post_data_typo','{{WRAPPER}} .post--data' );
        $this->wixi_style_text_alignment( 'post_data_typo','{{WRAPPER}} .post--data' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    public function post_related() {
        $settings = $this->get_settings_for_display();
        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }
        $sattr = array();
        $sattr[] = $settings['speed'] ? '"speed":'.$settings['speed'] : '"speed":1000';
        $sattr[] = $settings['perview'] ? '"perview":'.$settings['perview'] : '"perview":4';
        $sattr[] = $settings['mdperview'] ? '"mdperview":'.$settings['mdperview'] : '"speed":3';
        $sattr[] = $settings['smperview'] ? '"smperview":'.$settings['smperview'] : '"smperview":2';
        $sattr[] = $settings['gap'] ? '"gap":'.$settings['gap'] : '"gap":30';
        $sattr[] = 'yes' == $settings['loop'] ? '"loop":true' : '"loop":false';
        $sattr[] = 'yes' == $settings['autoplay'] ? '"autoplay":true' : '"autoplay":false';
        $sattr[] = 'yes' == $settings['mousewheel'] ? '"mousewheel":true' : '"mousewheel":false';

        global $post;
        $cats = get_the_category( $post->ID );
        $args = array(
            'post__not_in' => array( $post->ID ),
            'posts_per_page' => $settings['perpage']
        );

        $the_query = new \WP_Query( $args );

        if( $the_query->have_posts() ) {
            wp_enqueue_script( 'swiper' );
        ?>

            <div class="nt-related-posts post--data nt-blog blog-grid-two">
                <div class="swiper-container" data-slider-settings='{<?php echo implode(',',$sattr); ?>}'>
                    <div class="swiper-wrapper">
                        <?php
                            while( $the_query->have_posts() ) {

                                $the_query->the_post();
                                if ( has_post_thumbnail() ) {
                                    $post_author = get_author_posts_url( get_the_author_meta( 'ID' ) );
                                    ?>
                                    <div class="swiper-slide item-column">

                                        <div class="item">
                                            <div class="content text-left">
                                                <?php if( has_post_thumbnail() ) { ?>
                                                    <div class="img">
                                                        <a class="img-link" href="<?php get_permalink(); ?>">
                                                           <?php the_post_thumbnail( $size ); ?>
                                                        </a>
                                                        <div class="info">
                                                            <a href="<?php the_permalink(); ?>"><i class="far fa-clock"></i> <?php the_time( get_option( 'date_format' ) ); ?></a>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                                <div class="content-footer">

                                                    <div class="title">
                                                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                    </div>

                                                    <?php if ( has_excerpt() ) { ?>
                                                        <div class="text">
                                                            <p><?php echo wp_trim_words( get_the_excerpt(), $settings[ 'excerpt_limit' ] ); ?></p>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if ( $settings[ 'btn_title' ] ) { ?>
                                                        <div class="more">
                                                            <a href="<?php the_permalink() ?>"><?php echo $settings[ 'btn_title' ]; ?></a>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php
            wp_reset_postdata();
        }
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        global $post;
        $tag = $settings['tag'];
        if ( 'title' == $settings['data'] ) {
            echo '<'.$tag.' class="post--data post--title post--id-'.$post->ID.'">'.get_the_title( $post->ID ).'</'.$tag.'>';
        }
        if ( 'featured' == $settings['data'] ) {
            echo '<div class="post--data post--img post--id-'.$post->ID.' img">' . get_the_post_thumbnail( get_the_ID(), $settings['thumbnail_size'], array( 'class' => 'thumparallax' ) ) . '</div>';
        }
        if ( 'cat' == $settings['data'] && has_category() ) {
            echo '<'.$tag.' class="post--data post--cat post--id-'.$post->ID.'">';
            the_category(', ');
            echo '</'.$tag.'>';
        }
        if ( 'tag' == $settings['data'] && has_tag() ) {
            echo '<'.$tag.' class="post--data post--tags post--id-'.$post->ID.'">';
            the_tags('', ', ', '');
            echo '</'.$tag.'>';
        }
        if ( 'date' == $settings['data'] && function_exists( 'wixi_post_meta_date' ) ) {
            echo '<'.$tag.' class="post--data post--date post--id-'.$post->ID.'">';
            wixi_post_meta_date();
            echo '</'.$tag.'>';
        }
        if ( 'comment-number' == $settings['data'] && function_exists( 'wixi_post_meta_comment_number' ) ) {
            echo '<'.$tag.' class="post--data post--author post--id-'.$post->ID.'">';
            wixi_post_meta_comment_number();
            echo '</'.$tag.'>';
        }
        if ( 'comment-template' == $settings['data'] ) {
            echo '<div class="post--data wixi-comments-wrapper post--id-'.$post->ID.'" id="wixi-comments-wrapper">';
            wixi_single_post_comment_template();
            echo'</div>';
        }
        if ( 'nav' == $settings['data'] && function_exists( 'wixi_single_navigation' ) ) {
            echo '<div class="post--data post--nav">';
            wixi_single_navigation();
            echo '</div>';
        }
        if ( 'related' == $settings['data'] ) {
            $this->post_related();
        }
        if ( 'author' == $settings['data'] && function_exists( 'wixi_post_meta_author' ) ) {
            echo '<'.$tag.' class="post--data post--author post--id-'.$post->ID.'">';
            wixi_post_meta_author();
            echo '</'.$tag.'>';
        }
        if ( 'desc' == $settings['data'] && get_the_author_meta('user_description', $post->post_author) ) {
            $desc = get_the_author_meta( 'user_description', $post->post_author );
            echo '<'.$tag.' class="post--data post--author post--id-'.$post->ID.'">'.$desc.'</'.$tag.'>';
        }
        if ( 'avatar' == $settings['data'] ) {
            if ( function_exists( 'get_avatar' ) ) {
                echo '<div class="post--data author--img post--id-'.$post->ID.'">'.get_avatar( get_the_author_meta( 'email' ), '140').'</div>';
            }
        }

    }
}
