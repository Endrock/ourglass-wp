<?php


if ( ! function_exists( 'wixi_single_layout_fullwidth' ) ) {

    function wixi_single_layout_fullwidth()
    {
        wp_enqueue_script( 'parallaxie' );
        ?>

        <!-- Single page general div -->
        <div id="nt-single" class="nt-single">

            <?php wixi_single_post_header(); ?>

            <div class="nt-blog-pg single section-padding">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="post nt-theme-content">

                                <?php wixi_post_format(); ?>

                                <div class="content">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-10">
                                            <div class="cont-inner">
                                                <?php
                                                    while ( have_posts() ) :

                                                        the_post();

                                                        the_content();

                                                        wixi_wp_link_pages();

                                                    endwhile; // End of the loop.

                                                    wixi_single_post_author_box();

                                                    wixi_single_navigation();

                                                    wixi_single_post_comment_template();

                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <?php wixi_single_post_related(); ?>

            </div>
        </div>
        <!--End single page general div -->
        <?php
    }
}

if ( ! function_exists( 'wixi_single_layout_sidebar' ) ) {

    function wixi_single_layout_sidebar()
    {
        $wixi_layout  = wixi_settings( 'single_layout', 'right-sidebar' );
        $wixi_sidebar = natrurally_sidebar( 'wixi-single-sidebar', 'sidebar-1' );
        $wixi_column  = natrurally_sidebar( 'wixi-single-sidebar', 'sidebar-1' ) ? ' col-lg-8' : 'col-lg-10';

        ?>

        <!-- Single page general div -->
        <div id="nt-single" class="nt-single">

            <?php wixi_single_post_header(); ?>

            <div class="nt-blog-pg single section-padding pt-0">
                <div class="container">

                    <div class="row justify-content-lg-center">

                        <?php if ( 'left-sidebar' == $wixi_layout && $wixi_sidebar ) { ?>
                            <div id="nt-sidebar" class="nt-sidebar col-12 col-lg-4 pl-lg-5">
                                <div class="blog-sidebar nt-sidebar-inner">

                                    <?php dynamic_sidebar( $wixi_sidebar ); ?>

                                </div>
                            </div>
                        <?php } ?>

                        <div class="<?php echo esc_attr( $wixi_column ); ?>">
                            <div class="post">

                                <?php wixi_post_format(); ?>

                                <div class="content nt-theme-content">
                                    <div class="cont-inner">
                                        <?php
                                            while ( have_posts() ) :

                                                the_post();

                                                the_content();

                                                wixi_wp_link_pages();

                                            endwhile; // End of the loop.

                                            echo wixi_single_post_author_box();

                                        ?>
                                    </div>

                                    <?php wixi_single_navigation(); ?>

                                    <?php wixi_single_post_comment_template(); ?>

                                </div>
                            </div>
                        </div>

                        <?php if ( 'right-sidebar' == $wixi_layout && $wixi_sidebar ) { ?>
                            <div id="nt-sidebar" class="nt-sidebar col-12 col-lg-4 pl-lg-5">
                                <div class="blog-sidebar nt-sidebar-inner">

                                    <?php dynamic_sidebar( $wixi_sidebar ); ?>

                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>

                <?php wixi_single_post_related(); ?>

            </div>
        </div>
        <!--End single page general div -->
        <?php
    }
}


if ( ! function_exists( 'wixi_single_post_header_content' ) ) {

    function wixi_single_post_header()
    {
        $separator = '<span class="separator">/</span>';
    ?>
        <div class="page-header type-blog">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-9">
                        <div class="cont-inner text-center">
                            <?php wixi_single_post_header_title(); ?>
                            <div class="info">
                                <p><?php
                                wixi_post_meta_author();
                                echo wp_kses( $separator, wixi_allowed_html() );
                                wixi_post_meta_date();
                                if ( has_category() ) {
                                    echo wp_kses( $separator, wixi_allowed_html() );
                                    wixi_post_meta_categories();
                                }
                                ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}


if ( ! function_exists( 'wixi_single_post_header_title' ) ) {

    function wixi_single_post_header_title()
    {
        the_title( '<h1>', '</h1>' );
    }
}


if ( ! function_exists( 'wixi_single_post_formats_content' ) ) {

    function wixi_single_post_formats_content()
    {
        if ( has_post_thumbnail() ) {

            wixi_post_format();
        }
    }
}


if ( ! function_exists( 'wixi_single_post_tags' ) ) {

    function wixi_single_post_tags()
    {
        if ( '0' != wixi_settings('single_postmeta_tags_visibility', '1' ) && has_tag() ) {
        ?>
            <div class="share-info">
                <div class="tags"> <i class="fa fa-tag" aria-hidden="true"></i> <?php the_tags('', ',', ''); ?> </div>
            </div>
        <?php
        }
    }
}


if ( ! function_exists( 'wixi_single_post_comment_template' ) ) {

    function wixi_single_post_comment_template()
    {

        if ( comments_open() || '0' != get_comments_number() ) {

            comments_template();

        }
    }
}


if ( ! function_exists( 'wixi_post_meta_categories' ) ) {

    function wixi_post_meta_categories()
    {
        if ( '0' != wixi_settings('post_category_visibility', '1' ) && has_category() ) {
            the_category(',');
        }
    }
}


if ( ! function_exists( 'wixi_post_meta_date' ) ) {

    function wixi_post_meta_date()
    {
        $archive_year = get_the_time( 'Y' );
        $archive_month = get_the_time( 'm' );
        $archive_day = get_the_time( 'd' );
        ?>

        <a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>

        <?php
    }
}

if ( ! function_exists( 'wixi_post_meta_author' ) ) {

    function wixi_post_meta_author()
    {
        global $post;
        $author_id = $post->post_author;
        $author_link = get_author_posts_url( $author_id );
        ?>

        <a href="<?php echo esc_url( $author_link ); ?>"><?php the_author_meta( 'display_name', $post->post_author ); ?></a>

        <?php
    }
}


if ( ! function_exists( 'wixi_post_meta_comment_number' ) ) {

    function wixi_post_meta_comment_number()
    {
        ?>
        <a href="<?php echo get_comments_link( get_the_ID() ); ?>">
            <?php printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'wixi' ), number_format_i18n( get_comments_number() ) ); ?>
        </a>
        <?php
    }
}


/*************************************************
##  POST FORMAT
*************************************************/

if ( ! function_exists( 'wixi_post_format' ) ) {

    function wixi_post_format()
    {
        // post format
        $format = get_post_format();
        $format = $format ? $format : 'standard';

        // post format: video or audio embed
        if ( 'video' == $format || 'audio' == $format ) {

            wixi_single_post_format_embed();

        // post format: gallery
        } elseif ( 'gallery' == $format ) {

            wixi_single_post_format_gallery();

        // post format: quote
        } elseif ( 'quote' == $format ) {

            wixi_single_post_format_quote();

        // post format: link
        } elseif ( 'link' == $format ) {

            wixi_single_post_format_link();

        // post format: standart
        } else {

            if ( has_post_thumbnail() ) {

                $thumb = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );

                ?>

                <div class="post-img bg-cover parallaxie" data-wixi-background="<?php echo esc_url( $thumb ); ?>"></div>

                <?php
            }
        } // end post format
    }
}


/*************************************************
## POST FORMAT : VIDEO OR AUDIO EMBED
*************************************************/
if ( ! function_exists( 'wixi_single_post_format_embed' ) ) {

    function wixi_single_post_format_embed()
    {
        $post = get_post(get_the_ID());
        $content = apply_filters('the_content', $post->post_content);
        $embed = get_media_embedded_in_content($content, array( 'video', 'object', 'embed', 'iframe', 'audio'  ));
        $iframe = class_exists('ACF') && function_exists('get_field') ? get_field('wixi_media_embed') : '';

        if ( $iframe ) {
            $format = get_post_format();
            $iframe_format = 'audio' == $format ? 'audio' : 'video';

            // Use preg_match to find iframe src.
            preg_match('/src="(.+?)"/', $iframe, $matches);
            $src = $matches[1];

            // Add extra parameters to src and replcae HTML.
            $params = array(
                'controls'  => 0,
                'hd'        => 1,
                'autohide'  => 1
            );
            $new_src = add_query_arg($params, $src);
            $iframe = str_replace($src, $new_src, $iframe);

            // Add extra attributes to iframe HTML.
            $attributes = 'audio' == $format ? 'allow="autoplay"' : 'frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen';
            $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
        ?>

            <div class="blog-single_media_<?php echo esc_attr( $iframe_format ); ?>"><?php echo wp_kses( $iframe, wixi_allowed_html() ); ?></div>

        <?php } else {

            if ( false === strpos( $content, 'wp-playlist-script' ) ) {
                // If not a single post, highlight the video file.
                if (! empty( $embed ) ) {
                    foreach ( $embed as $embed_html ) { ?>
                        <div class="blog-single_media_video"><?php echo wp_kses( $embed_html, wixi_allowed_html() ); ?></div>
                        <?php
                    }
                }
            }
        }
    }
}


/*************************************************
## POST FORMAT : GALLERY
*************************************************/
if ( ! function_exists( 'wixi_single_post_format_gallery' ) ) {

    function wixi_single_post_format_gallery()
    {
        $images = get_post_meta( get_the_ID(), 'wixi_post_gallery' );

        if ( $images ) { ?>

            <div class="blog-single_media_gallery">
                <div class="slick-slider text-center">

                    <?php foreach ( $images as $image ) { ?>

                        <div class="slick-slide">
                            <span class="aspect-ratio is-2x1">

                                <?php if ( function_exists( 'wixi_aq_resize' ) ) {

                                    $blankimg = get_template_directory_uri().'/images/blank.gif';
                                    $srcset1 = wixi_aq_resize( wp_get_attachment_url( $image, 'full' ), 1200, 600, true, true, true );
                                    $srcset2 = wixi_aq_resize( wp_get_attachment_url( $image, 'full' ), 2400, 1200, true, true, true );
                                    $imagealt = esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true));

                                ?>

                                    <img class="aspect-ratio_object lazyload"
                                    src="<?php echo esc_url( $blankimg );?>"
                                    data-srcset="<?php echo esc_url( $srcset1 ); ?> 1x, <?php echo esc_url( $srcset2 ); ?> 2x"
                                    alt="<?php echo esc_attr( $imagealt ); ?>">

                                <?php
                                } else {

                                    the_post_thumbnail( 'wixi-single', array( 'class' => 'aspect-ratio_object lazyload' ) );

                                }
                                ?>

                            </span>
                        </div>

                    <?php } ?>

                </div>
            </div>
            <?php
        }
    }
}


/*************************************************
## POST FORMAT : QUOTE
*************************************************/
if ( ! function_exists( 'wixi_single_post_format_quote' ) ) {

    function wixi_single_post_format_quote()
    {

        $quote_text = $quote_author = '';
        if ( class_exists( 'ACF' ) && function_exists( 'get_field' ) ) {
            $quote_text = get_field('wixi_format_quote_text');
            $quote_author = get_field('wixi_format_quote_author');
        }

        if ( $quote_text ) { ?>

            <div class="blog-single_media_quote">
                <blockquote>

                    <p><?php echo esc_html( $quote_text ); ?></p>

                    <?php if ( $quote_author ) { ?>
                        <footer><cite title="<?php echo esc_attr( $quote_author ); ?>">- <?php echo esc_html( $quote_author ); ?></cite></footer>
                    <?php } ?>

                </blockquote>
            </div>
            <?php
        }
    }
}


/*************************************************
## POST FORMAT : LINK
*************************************************/
if (! function_exists( 'wixi_single_post_format_link' ) ) {

    function wixi_single_post_format_link()
    {
        $thumb_url = get_the_post_thumbnail_url();
        $thumb_url = function_exists('wixi_aq_resize') ? wixi_aq_resize( wp_get_attachment_url( get_post_thumbnail_id(), 'full' ), 1200, 600, true, true, true ) : $thumb_url;
        $link_title = $link_url = '';
        if ( class_exists('ACF') && function_exists('get_field') ) {
            $link_title = get_field('wixi_format_link_title');
            $link_url = get_field('wixi_format_link_url');
        }

        if ( $link_title || $link_url ) { ?>

            <div class="blog-single_media_link" data-wixi-background="<?php echo esc_url( $thumb_url ); ?>">
                <div class="blog-single_media_link_inner">

                    <?php if ( $link_title ) { ?>
                        <a href="<?php echo esc_url( $link_url ); ?>" class="blog-single_media_link_title"><?php echo esc_html( $link_title ); ?></a>
                    <?php } ?>

                    <?php if ( $link_url ) { ?>
                        <a href="<?php echo esc_url( $link_url ); ?>" class="blog-single_media_link_url"><?php echo esc_html( $link_url ); ?></a>
                    <?php } ?>

                </div>
            </div>
            <?php
        }
    }
}


/*************************************************
## SINGLE POST AUTHOR BOX FUNCTION
*************************************************/

if (! function_exists('wixi_single_post_author_box')) {

    function wixi_single_post_author_box()
    {
        global $post;
        if ('0' != wixi_settings('single_post_author_box_visibility', '1')) {
            // Get author's display name
            $display_name = get_the_author_meta('display_name', $post->post_author);
            // If display name is not available then use nickname as display name
            $display_name = empty($display_name) ? get_the_author_meta('nickname', $post->post_author) : $display_name ;
            // Get author's biographical information or description
            $user_description = get_the_author_meta('user_description', $post->post_author);
            // Get author's website URL
            $user_website = get_the_author_meta('url', $post->post_author);
            // Get link to the author archive page
            $user_posts = get_author_posts_url(get_the_author_meta('ID', $post->post_author));
            // Get the rest of the author links. These are stored in the
            // wp_usermeta table by the key assigned in wpse_user_contactmethods()
            $author_facebook = get_the_author_meta('facebook', $post->post_author);
            $author_twitter  = get_the_author_meta('twitter', $post->post_author);
            $author_instagram  = get_the_author_meta('instagram', $post->post_author);
            $author_linkedin = get_the_author_meta('linkedin', $post->post_author);
            $author_youtube  = get_the_author_meta('youtube', $post->post_author);

            if ('' != $user_description) { ?>

                <div class="author">
                    <div class="author-img">
                        <?php if ( function_exists( 'get_avatar' ) ) {
                            echo get_avatar( get_the_author_meta( 'email' ), '140');
                        } ?>
                    </div>
                    <div class="info">
                        <h6><span><?php echo esc_html_e( 'author', 'wixi' ); ?>: </span> <?php echo esc_html( $display_name ); ?></h6>
                        <p><?php echo esc_html($user_description); ?></p>

                        <div class="social">
                            <?php if ('' != $author_facebook) { ?>
                                <a class="social-icons_link" href="<?php echo esc_url($author_facebook); ?>" target="_blank"><span class="fab fa-facebook-f"></span></a>
                            <?php } ?>
                            <?php if ('' != $author_twitter) { ?>
                                <a class="social-icons_link" href="<?php echo esc_url($author_twitter); ?>" target="_blank"><span class="fab fa-twitter"></span></a>
                            <?php } ?>
                            <?php if ('' != $author_instagram) { ?>
                                <a class="social-icons_link" href="<?php echo esc_url($author_instagram); ?>" target="_blank"><span class="fab fa-instagram"></span></a>
                            <?php } ?>
                            <?php if ('' != $author_linkedin) { ?>
                                <a class="social-icons_link" href="<?php echo esc_url($author_linkedin); ?>" target="_blank"><span class="fab fa-linkedin"></span></a>
                            <?php } ?>
                            <?php if ('' != $author_youtube) { ?>
                                <a class="social-icons_link" href="<?php echo esc_url($author_youtube); ?>" target="_blank"><span class="ifab fa-youtube"></span></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
}


/*************************************************
## SINGLE POST RELATED POSTS
*************************************************/

if ( ! function_exists( 'wixi_single_post_related' ) ) {

    function wixi_single_post_related()
    {
        global $post;
        $wixi_post_type = get_post_type( $post->ID );

        if ( '0' != wixi_settings( 'single_related_visibility', '0' ) && 'post' == $wixi_post_type ) {
            $sattr = array();
            $sattr[] .= '"speed":'.wixi_settings( 'related_speed', 1000 );
            $sattr[] .= '"perview":'.wixi_settings( 'related_perview', 3 );
            $sattr[] .= '"mdperview":'.wixi_settings( 'related_mdperview', 3 );
            $sattr[] .= '"smperview":'.wixi_settings( 'related_smperview', 2 );
            $sattr[] .= '"xsperview":'.wixi_settings( 'related_xsperview', 1 );
            $sattr[] .= '"gap":'.wixi_settings( 'related_gap', 30 );
            $sattr[] .= '1' == wixi_settings( 'related_centered', 1 ) ? '"center":true' : '"center":false';
            $sattr[] .= '1' == wixi_settings( 'related_loop', 1 ) ? '"loop":true' : '"loop":false';
            $sattr[] .= '1' == wixi_settings( 'related_autoplay', 1 ) ? '"autoplay":true' : '"autoplay":false';
            $sattr[] .= '1' == wixi_settings( 'related_mousewheel', 0 ) ? '"mousewheel":true' : '"mousewheel":false';
            $imgsize = wixi_settings( 'related_imgsize', 'wixi-related' );
            $imgsize2 = wixi_settings( 'related_custom_imgsize' );
            $imgsize = '' == $imgsize && !empty( $imgsize2 ) ? array($imgsize2['width'],$imgsize2['height'] ) : $imgsize;
            $ttag = wixi_settings( 'related_title_tag', 'h3' );
            $subtag = wixi_settings( 'related_subtitle_tag', 'h6' );

            $cats = get_the_category( $post->ID );
            $args = array(
                'post__not_in' => array( $post->ID ),
                'posts_per_page' => wixi_settings( 'related_perpage', 6 )
            );

            $related_query = new WP_Query( $args );

            if( $related_query->have_posts() ) {
                wp_enqueue_script( 'swiper' );
            ?>

                <div class="nt-related-post pt-60">
                    <?php if ( '' != wixi_settings( 'related_subtitle' ) || '' != wixi_settings( 'related_title' ) ) { ?>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <div class="section-heading">
                                        <?php if ( '' != wixi_settings( 'related_subtitle' ) ) { ?>
                                            <<?php echo esc_attr( $subtag ); ?> class="wow subtitle"><?php echo esc_html( wixi_settings( 'related_subtitle' ) ); ?></<?php echo esc_attr( $subtag ); ?>>
                                        <?php } ?>
                                        <?php if ( '' != wixi_settings( 'related_title' ) ) { ?>
                                            <<?php echo esc_attr( $ttag ); ?> class="wow title"><?php echo esc_html( wixi_settings( 'related_title' ) ); ?></<?php echo esc_attr( $ttag ); ?>>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="nt-blog blog-grid-two ptb-0">

                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <div class="swiper-container" data-slider-settings='{<?php echo implode( ',',$sattr ); ?>}'>
                                        <div class="swiper-wrapper">
                                        <?php
                                            while( $related_query->have_posts() ) {

                                                $related_query->the_post();
                                                if ( has_post_thumbnail() ) {
                                                    $thumb_url = get_the_post_thumbnail_url();
                                                    ?>
                                                    <div class="swiper-slide item-column">

                                                        <div class="item">
                                                            <div class="content text-left">
                                                                <?php if ( has_post_thumbnail() ) { ?>
                                                                    <div class="img">
                                                                        <a class="img-link" href="<?php the_permalink(); ?>">
                                                                           <?php the_post_thumbnail( $imgsize ); ?>
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

                                                                    <?php if ( has_excerpt() && '0' != wixi_settings( 'related_excerpt_visibility' ) ) { ?>
                                                                        <div class="text">
                                                                            <p><?php echo wp_trim_words( get_the_excerpt(), wixi_settings( 'related_excerpt_limit' ) ); ?></p>
                                                                        </div>
                                                                    <?php } ?>

                                                                    <?php
                                                                    if ( '' != wixi_settings( 'related_btntitle' ) ) {
                                                                        printf( '<a class="more" href="%s" title="%s"><span>%s</span></a>',
                                                                            get_permalink(),
                                                                            the_title_attribute( 'echo=0' ),
                                                                            esc_html( wixi_settings( 'related_btntitle' ) )
                                                                        );
                                                                    }
                                                                    ?>
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
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                wp_reset_postdata();
            }
        }
    }
}
