<?php

add_action( 'wixi_blog_post_action', 'wixi_blog_post_thumbnail', 10 );
add_action( 'wixi_blog_post_action', 'wixi_blog_post_title', 20 );
add_action( 'wixi_blog_post_action', 'wixi_blog_post_meta', 30 );
add_action( 'wixi_blog_post_action', 'wixi_blog_post_content', 40 );
add_action( 'wixi_blog_post_action', 'wixi_blog_post_button', 50 );


if ( ! function_exists( 'wixi_post_style_one' ) ) {

    function wixi_post_style_one()
    {
        ?>
        <div id="post-<?php echo get_the_ID(); ?>" <?php echo post_class( wixi_settings( 'index_post_column', 'col-lg-6' ) ); ?>>

            <div class="item wow fadeInUp mb-50" data-wow-delay=".3s">

                <?php wixi_sticky_post(); ?>

                <?php wixi_blog_post_thumbnail(); ?>

                <div class="cont-inner">
                    <div class="info">
                        <?php
                            if ( '0' != wixi_settings( 'post_author_visibility', '1' ) ) {

                                printf( '<a href="%1$s" title="%1$s">%2$s</a>',
                                    get_author_posts_url( get_the_author_meta( 'ID' ) ),
                                    get_the_author()
                                );
                            }

                            if ( '0' != wixi_settings( 'post_date_visibility', '1' ) ) {

                                $archive_year  = get_the_time( 'Y' );
                                $archive_month = get_the_time( 'm' );
                                $archive_day   = get_the_time( 'd' );
                                printf( '<a href="%1$s" title="%1$s">%2$s</a>',
                                    esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ),
                                    get_the_date()
                                );
                            }
                        ?>
                    </div>

                    <?php
                        if ( '0' != wixi_settings( 'post_title_visibility', '1' ) ) {
                            printf( '<h5><a href="%s" title="%s">%s</a></h5>',
                                get_permalink(),
                                the_title_attribute( 'echo=0' ),
                                get_the_title()
                            );
                        }
                    ?>

                    <?php wixi_blog_post_content(); ?>

                    <?php wixi_blog_post_button(); ?>
                </div>
            </div>
        </div>

        <?php
    }
}

if ( ! function_exists( 'wixi_post_style_two' ) ) {

    function wixi_post_style_two()
    {
        ?>
        <div id="post-<?php echo get_the_ID(); ?>" <?php echo post_class( 'item mb-80' ); ?>>

            <?php wixi_sticky_post(); ?>

            <?php wixi_blog_post_thumbnail(); ?>

            <div class="content">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">

                        <div class="info">
                            <?php
                                if ( '0' != wixi_settings( 'post_author_visibility', '1' ) ) {

                                    printf( '<a href="%1$s" title="%1$s">%2$s</a>',
                                        get_author_posts_url( get_the_author_meta( 'ID' ) ),
                                        get_the_author()
                                    );
                                }

                                if ( '0' != wixi_settings( 'post_date_visibility', '1' ) ) {

                                    $archive_year  = get_the_time( 'Y' );
                                    $archive_month = get_the_time( 'm' );
                                    $archive_day   = get_the_time( 'd' );
                                    printf( '<a href="%1$s" title="%1$s">%2$s</a>',
                                        esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ),
                                        get_the_date()
                                    );
                                }
                            ?>
                        </div>

                        <?php
                            wixi_blog_post_title();
                            wixi_blog_post_content();
                            wixi_blog_post_button();
                        ?>
                    </div>

                </div>
            </div>
        </div>

        <?php
    }
}

if ( ! function_exists('wixi_post_style_three')) {

    function wixi_post_style_three()
    {
        ?>
        <div id="post-<?php echo get_the_ID(); ?>" <?php echo post_class( 'col-12 mb-80 style-1 item' ); ?>>
            <!-- Post -->
            <div class="blog-post2">

                <?php if ( is_sticky() ) { ?>
                    <div class="nt-sticky-label"><span class="label is-green-light"><?php echo esc_html__( 'Featured', 'wixi' ); ?></span></div>
                <?php } ?>

                <?php if ( has_post_thumbnail() ) { ?>
                    <a class="blog-post2_photo" href="<?php echo esc_url( get_permalink() ); ?>">
                       <?php the_post_thumbnail( 'wixi-post', array( 'class' => 'img-responsive' ) ); ?>
                    </a>
                <?php } ?>

                <div class="blog-post2_info content">

                    <?php
                    if ('0' != wixi_settings( 'post_title_visibility', '1' ) ) {
                        the_title( sprintf( '<h4 class="blog-post2_title"><a href="%s" rel="bookmark">',esc_url(get_permalink() ) ), '</a></h4>' );
                    }
                    ?>

                    <?php
                    if ( get_the_author_meta( 'url' ) ) {
                        echo sprintf( '<div class="blog-post2_meta">%1$s - %2$s %3$s</div>',
                            apply_filters( 'wixi_post_date', get_the_date(), true ),
                            esc_html__( 'By','wixi' ),
                            get_the_author_link()
                        );
                    } else {
                        echo sprintf( '<div class="blog-post2_meta">%1$s <span class="blog-post2_meta_sep">-</span> %2$s <a href="%3$s" title="%4$s">%4$s</a></div>',
                            apply_filters( 'wixi_post2_date', get_the_date(), true ),
                            esc_html__( 'By', 'wixi' ),
                            esc_url( get_permalink() ),
                            get_the_author()
                        );
                    }
                    if ( has_excerpt() ) { ?>

                        <div class="blog-post2_summary">
                            <?php echo wpautop( wp_trim_words( trim( strip_tags( get_the_excerpt() ) ), wixi_settings( 'excerptsz', '30' ) ) ); ?>
                        </div>

                    <?php } elseif  ( get_the_content() ) { ?>

                        <div class="blog-post2_summary">
                            <?php echo wpautop( wp_trim_words( trim(strip_tags( get_the_content() ) ), wixi_settings( 'excerptsz', '30' ) ) ); ?>
                        </div>

                        <?php
                    }

                    wixi_wp_link_pages();

                    echo '<div class="mt-20">';
                        wixi_blog_post_button();
                    echo '</div>';

                    ?>

                </div>
            </div>
            <!-- Post End -->
        </div>

        <?php
    }
}


if ( ! function_exists('wixi_sticky_post')) {

    function wixi_sticky_post()
    {
        if ( is_sticky() ) { ?>
            <div class="nt-sticky-label"><span class="label is-green-light"><?php echo esc_html__( 'Featured', 'wixi' ); ?></span></div>
        <?php }
    }
}

if ( ! function_exists('wixi_blog_post_thumbnail')) {

    function wixi_blog_post_thumbnail()
    {
        if ( has_post_thumbnail() ) {

             if ( 'grid' == wixi_settings( 'index_type', 'default' ) ) {

                printf( '<div class="post-img"><div class="img"><a href="%s" title="%s">%s</a></div></div>',
                    esc_url( get_permalink() ),
                    the_title_attribute( 'echo=0' ),
                    get_the_post_thumbnail( get_the_ID(), 'large' )
                );

            } else { ?>

                <div class="img">
                <div class="post-bg-image">
                <?php echo  get_the_post_thumbnail( get_the_ID(), 'large' ); ?>
                </div></div>
                   <?php 
                

            }
        }
    }
}


if ( ! function_exists( 'wixi_blog_post_title' ) ) {

    function wixi_blog_post_title()
    {
        if ( '0' != wixi_settings( 'post_title_visibility', '1' ) ) {

            the_title( sprintf( '<h4 class="title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

        }
    }
}


if ( ! function_exists( 'wixi_blog_post_date' ) ) {

    function wixi_blog_post_date()
    {
        if ( '0' != wixi_settings( 'post_date_visibility', '1' ) ) {

            $archive_year  = get_the_time( 'Y' );
            $archive_month = get_the_time( 'm' );
            $archive_day   = get_the_time( 'd' );

            ?>

            <div class="date">
                <a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>">
                    <span class="num"><?php the_time('d'); ?></span>
                    <span class="month"><?php the_time('F'); ?></span>
                </a>
            </div>

        <?php
        }
    }
}


if ( ! function_exists( 'wixi_blog_post_meta' ) ) {

    function wixi_blog_post_meta()
    {
        if ( '0' != wixi_settings('post_meta_visibility', '1' ) ) {

            if( get_the_author_meta( 'url' ) ) {

                echo sprintf( '<p class="blog-post_meta">%1$s %2$s %3$s</p>',
                    apply_filters( 'wixi_post_date', get_the_date(), true ),
                    esc_html__( 'By', 'wixi' ),
                    get_the_author_link()
                );

            } else {

                echo sprintf( '<p class="blog-post_meta">%1$s %2$s <a href="%3$s" title="%4$s">%4$s</a></p>',
                    apply_filters( 'wixi_post_date', get_the_date(), true ),
                    esc_html__( 'By', 'wixi' ),
                    esc_url( get_permalink() ),
                    get_the_author()
                );

            }
        }
    }
}


if ( ! function_exists( 'wixi_blog_post_category' ) ) {

    function wixi_blog_post_category()
    {
        if ( has_category() && '0' != wixi_settings( 'post_category_visibility', '1' ) ) { ?>

            <div class="blog-post_category"><?php the_category( ', ' ); ?></div>

        <?php
        }
    }
}


if ( ! function_exists( 'wixi_blog_post_tags' ) ) {

    function wixi_blog_post_tags()
    {
        if ( has_tag() && '0' != wixi_settings( 'post_tags_visibility', '1' ) ) {

            the_tags('<div class="tags">','','</div>');

        }
    }
}


if ( ! function_exists( 'wixi_blog_post_content' ) ) {

    function wixi_blog_post_content()
    {
        if ( '0' != wixi_settings( 'post_excerpt_visibility', '1' ) ) {

            if ( has_excerpt() ) {

                echo wpautop( wp_trim_words( strip_tags( trim( get_the_excerpt() ) ), wixi_settings( 'excerptsz', '30' ) ) );

            } else {

                echo wpautop( wp_trim_words( strip_tags( trim( get_the_content() ) ), wixi_settings( 'excerptsz', '30' ) ) );

            }

            wixi_wp_link_pages();
        }
    }
}

if ( ! function_exists( 'wixi_blog_post_button' ) ) {

    function wixi_blog_post_button()
    {
        if ( '0' != wixi_settings( 'post_button_visibility', '1' ) ) {

            $button_title = wixi_settings( 'post_button_title' ) ? esc_html( wixi_settings( 'post_button_title' ) ) : esc_html__( 'Read More', 'wixi' );

            printf( '<a  class="more" href="%s" title="%s"><span>%s<i class="fa fa-caret-right"></i></span></a>',
                get_permalink(),
                the_title_attribute( 'echo=0' ),
                $button_title
            );

        }
    }
}
