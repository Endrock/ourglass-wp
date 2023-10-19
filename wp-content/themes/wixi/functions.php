<?php

/**
 *
 * @package WordPress
 * @subpackage wixi
 * @since Wixi 1.0
 *
**/


/*************************************************
## GOOGLE FONTS
*************************************************/

if (! function_exists( 'wixi_fonts_url' ) ) {
    function wixi_fonts_url()
    {
        $fonts_url = '';

        $rubik = _x( 'on', 'Rubik font: on or off', 'wixi' );
        $inter = _x( 'on', 'Inter font: on or off', 'wixi' );

        if ( 'off' !== $rubik || 'off' !== $inter ) {
            $font_families = array();

            if ( 'off' !== $rubik ) {
                $font_families[] = 'Rubik:300,400,500,600,700,800';
            }

            if ( 'off' !== $inter ) {
                $font_families[] = 'Inter:400,500,600,700,800,900';
            }

            $query_args = array(
                'family' => urlencode(implode( '|', $font_families) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg($query_args, "//fonts.googleapis.com/css");
        }

        return esc_url_raw( $fonts_url );
    }
}

/*************************************************
## STYLES AND SCRIPTS
*************************************************/

function wixi_theme_scripts()
{
    $rtl = is_rtl() ? '-rtl' : '';
    // theme inner pages files
    // bootstrap
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/js/plugins/bootstrap/bootstrap'.$rtl.'.min.css', false, '1.0' );
    wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/plugins/bootstrap/bootstrap.min.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'popper', get_template_directory_uri() . '/js/plugins/bootstrap/popper.min.js', array( 'jquery' ), '1.0', true );

    // plugins
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/plugins/animate.css', false, '1.0' );
    wp_enqueue_style( 'ionicons', get_template_directory_uri() . '/css/plugins/ionicons.min.css', false, '1.0' );
    wp_enqueue_style( 'fontawesome-all', get_template_directory_uri() . '/css/plugins/fontawesome-all.min.css', false, '1.0' );
    wp_enqueue_style( 'helper', get_template_directory_uri() . '/css/plugins/helper'.$rtl.'.css', false, '1.0' );
    wp_enqueue_style( 'hamburgers', get_template_directory_uri() . '/css/plugins/hamburgers'.$rtl.'.css', false, '1.0' );

    wp_register_script( 'pace', get_template_directory_uri() . '/js/plugins/pace/pace.min.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'parallaxie', get_template_directory_uri() . '/js/plugins/parallaxie/parallaxie.min.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'easings', get_template_directory_uri() . '/js/plugins/easings/easings.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/plugins/wow/wow.min.js', array( 'jquery' ), '1.0', false );

    wp_register_script( 'smoothScroll', get_template_directory_uri() . '/js/plugins/smooth-scroll/smoothScroll.min.js', array( 'jquery' ), '1.0', true );

    // gsap
    wp_register_script( 'tween-max', get_template_directory_uri() . '/js/plugins/gsap/TweenMax.min.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'gsap', get_template_directory_uri() . '/js/plugins/gsap/gsap.min.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'scrollmagic', get_template_directory_uri() . '/js/plugins/gsap/scrollmagic.min.js', array('jquery'), '1.0', true );

    // cursors
    wp_enqueue_style( 'all-cursors', get_template_directory_uri() . '/js/plugins/cursor/all-cursors.css', false, '1.0' );
    wp_enqueue_script( 'all-cursors', get_template_directory_uri() . '/js/plugins/cursor/all-cursors.js', array( 'jquery' ), '1.0', false );

    // aos
    wp_register_style( 'aos', get_template_directory_uri() . '/js/plugins/aos/aos.css', false, '1.0' );
    wp_register_script( 'aos', get_template_directory_uri() . '/js/plugins/aos/aos.js', array('jquery'), '1.0', true );


    // splitting text
    wp_register_style( 'overlay-scrollbars', get_template_directory_uri() . '/js/plugins/OverlayScrollbars/OverlayScrollbars.css', false, '1.0' );
    wp_register_script( 'overlay-scrollbars', get_template_directory_uri() . '/js/plugins/OverlayScrollbars/jquery.overlayScrollbars.min.js', array( 'jquery' ), '1.0', true );

    // splitting text
    if( '0' != wixi_settings( 'split_text_animation_visibility' ) ) {
        wp_register_style( 'splitting', get_template_directory_uri(). '/js/plugins/splitting/splitting.css', '1.0', true );
        wp_register_style( 'splitting-cells', get_template_directory_uri(). '/js/plugins/splitting/splitting-cells.css', '1.0', true );
        wp_register_script( 'splitting', get_template_directory_uri(). '/js/plugins/splitting/splitting.min.js', array( 'jquery' ), '1.0', true );
    }

    // swiper
    wp_register_style( 'swiper', get_template_directory_uri() . '/js/plugins/swiper/swiper.min.css', false, '1.0' );
    wp_register_script( 'swiper', get_template_directory_uri() . '/js/plugins/swiper/swiper.min.js', array( 'jquery' ), '1.0', true );

    // vegas slider
    wp_register_style( 'vegas', get_template_directory_uri(). '/js/plugins/vegas/vegas.css', '1.0', true );
    wp_register_script( 'vegas', get_template_directory_uri(). '/js/plugins/vegas/vegas.min.js', array( 'jquery' ), '1.0', true );

    // slick slider
    wp_register_style( 'slick', get_template_directory_uri(). '/js/plugins/slick/slick.css', false, '1.0' );
    wp_register_style( 'slick-theme', get_template_directory_uri() . '/js/plugins/slick/slick-theme.css', false, '1.0' );
    wp_register_script( 'slick', get_template_directory_uri(). '/js/plugins/slick/slick.min.js', array( 'jquery' ), false, '1.0');

    // justifiedGallery
    wp_register_style( 'justified', get_template_directory_uri(). '/js/plugins/justifiedGallery/justifiedGallery.min.css', false, '1.0' );
    wp_register_script( 'justified', get_template_directory_uri(). '/js/plugins/justifiedGallery/justifiedGallery.min.js', array( 'jquery' ), false, '1.0' );

    // magnific-popup-lightbox
    wp_register_style( 'magnific', get_template_directory_uri(). '/js/plugins/magnific/magnific-popup.css', false, '1.0' );
    wp_register_script( 'magnific', get_template_directory_uri(). '/js/plugins/magnific/magnific-popup.min.js', array( 'jquery' ), false, '1.0' );

    // isotope
    wp_register_script( 'isotope', get_template_directory_uri(). '/js/plugins/isotope/isotope.min.js', array( 'jquery' ), false, '1.0' );
    wp_register_script( 'imagesloaded', get_template_directory_uri(). '/js/plugins/isotope/imagesloaded.pkgd.min.js', array( 'jquery' ), false, '1.0' );

    // jarallax
    wp_register_script( 'jarallax', get_template_directory_uri(). '/js/plugins/jarallax/jarallax.min.js', array( 'jquery' ), false, '1.0' );
    wp_register_script( 'particles', get_template_directory_uri(). '/js/plugins/particles/particles.min.js', array( 'jquery' ), false, '1.0' );
    wp_register_script( 'simple-parallax', get_template_directory_uri(). '/js/plugins/simpleParallax/simpleParallax.min.js', array( 'jquery' ), false, '1.0' );
    wp_register_script( 'drawsvg', get_template_directory_uri(). '/js/plugins/drawsvg/drawsvg.min.js', array( 'jquery' ), false, '1.0' );
    wp_register_script( 'vivus', get_template_directory_uri(). '/js/plugins/vivus/vivus.min.js', array( 'jquery' ), false, '1.0' );
    wp_register_script( 'tilt', get_template_directory_uri(). '/js/plugins/tilt/tilt.jquery.min.js', array( 'jquery' ), false, '1.0' );

    // jquery-ui
    wp_register_style( 'jquery-ui', get_template_directory_uri(). '/js/plugins/jquery-ui/jquery-ui.min.css', false, '1.0' );
    wp_register_script( 'jquery-ui', get_template_directory_uri(). '/js/plugins/jquery-ui/jquery-ui.min.js', array( 'jquery' ), false, '1.0' );

    // YouTubePopUp
    wp_register_style( 'youtube-popup', get_template_directory_uri(). '/js/plugins/YouTubePopUp/YouTubePopUp.css', false, '1.0' );
    wp_register_script( 'youtube-popup', get_template_directory_uri(). '/js/plugins/YouTubePopUp/YouTubePopUp.min.js', array( 'jquery' ), false, '1.0' );

    // locomotive-page
    wp_register_style( 'locomotive-scroll', get_template_directory_uri(). '/js/plugins/locomotive/locomotive-scroll.css', false, '1.0');
    wp_register_script( 'polyfill', get_template_directory_uri(). '/js/plugins/locomotive/polyfill.min.js', [ 'jquery' ], '1.0', true);
    wp_register_script( 'locomotive-scroll', get_template_directory_uri(). '/js/plugins/locomotive/locomotive-scroll.min.js', [ 'jquery' ], '1.0', true);
    wp_register_script( 'locomotive-main', get_template_directory_uri(). '/js/plugins/locomotive/locomotive-main.js', array( 'jquery' ), '1.0', true );

    // nice-select
    wp_enqueue_style( 'nice-select', get_template_directory_uri() . '/js/plugins/nice-select/nice-select'.$rtl.'.css', false, '1.0' );
    wp_enqueue_script( 'jquery-nice-select', get_template_directory_uri() . '/js/plugins/nice-select/jquery-nice-select.min.js', array( 'jquery' ), '1.0', false );


    // wixi-main-style
    wp_enqueue_style( 'wixi-style', get_template_directory_uri() . '/css/style'.$rtl.'.css', false, '1.0' );
    // wixi-framework-style
    wp_enqueue_style( 'wixi-framework-style', get_template_directory_uri() . '/css/framework-style'.$rtl.'.css', false, '1.0' );
    // wixi-update-style
    wp_enqueue_style( 'wixi-update', get_template_directory_uri() . '/css/update'.$rtl.'.css', false, '1.0' );


    // upload Google Webfonts
    wp_enqueue_style( 'wixi-fonts', wixi_fonts_url(), array(), null );

    wp_enqueue_script( 'wixi-main', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'framework-settings', get_template_directory_uri() . '/js/framework-settings.js', array( 'jquery' ), '1.0', true );

    if( 'masonry' == wixi_settings( 'index_type', 'default' ) ) {
        wp_enqueue_script( 'masonry' );
    }

    // browser hacks
    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.min.js', array( 'jquery' ), '1,0', false );
    wp_script_add_data( 'modernizr', 'conditional', 'lt IE 9' );
    wp_enqueue_script( 'respond', get_template_directory_uri() . '/js/respond.min.js', array( 'jquery' ), '1.0', false );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
    wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js', array( 'jquery' ), '1.0', false );
    wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

    // comment form reply
    if (is_singular() ) {
        wp_enqueue_script( 'comment-reply' );
    }

}
add_action( 'wp_enqueue_scripts', 'wixi_theme_scripts' );


function wixi_resource_hints( $urls, $relation_type ) {

    if ( wp_style_is( 'wixi-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}
add_filter( 'wp_resource_hints', 'wixi_resource_hints', 10, 2 );


/*************************************************
## ADMIN STYLE AND SCRIPTS
*************************************************/


function wixi_admin_scripts()
{

    // Update CSS within in Admin
    wp_enqueue_script( 'wixi-custom-admin', get_template_directory_uri() . '/js/framework-admin.js', array( 'jquery','jquery-ui-sortable' ) );

}
add_action( 'admin_enqueue_scripts', 'wixi_admin_scripts' );


add_action('get_header', 'wixi_remove_admin_login_header');
function wixi_remove_admin_login_header() {
	remove_action('wp_head', '_admin_bar_bump_cb');
}

// Template-functions
include get_template_directory() . '/inc/template-functions.php';
include get_template_directory() . '/inc/template-parts/menu.php';
include get_template_directory() . '/inc/template-parts/post-formats.php';
include get_template_directory() . '/inc/template-parts/single-post-formats.php';
include get_template_directory() . '/inc/template-parts/paginations.php';
include get_template_directory() . '/inc/template-parts/comment-parts.php';
include get_template_directory() . '/inc/template-parts/small-parts.php';
include get_template_directory() . '/inc/template-parts/header-parts.php';
include get_template_directory() . '/inc/template-parts/footer-parts.php';
include get_template_directory() . '/inc/template-parts/page-hero.php';
include get_template_directory() . '/inc/template-parts/breadcrumbs.php';

// Theme dynamic css setting file
include get_template_directory() . '/inc/template-parts/custom-style.php';

// TGM plugin activation
include get_template_directory() . '/inc/core/class-tgm-plugin-activation.php';
// Redux theme options panel
require_once get_parent_theme_file_path( '/inc/core/merlin/admin-menu.php' );
// Redux theme options panel
include get_template_directory() . '/inc/core/theme-options/options.php';

// WooCommerce init
if (class_exists('woocommerce')) {
    include get_template_directory() . '/woocommerce/init.php';
}
/*************************************************
## THEME SETUP
*************************************************/


if (! isset($content_width) ) {
    $content_width = 960;
}

function wixi_theme_setup()
{
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );


    /*
    * Enable support for Post Thumbnails on posts and pages.
    *
    * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
    */
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'wixi-square', 500, 500, true );
    add_image_size( 'wixi-grid', 750, 750, true );
    add_image_size( 'wixi-single', 2400, 1200, true );
    add_image_size( 'wixi-index', 800, 400, true );

    // theme supports
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-background' );
    add_theme_support( 'custom-header' );
    add_theme_support( 'html5', array( 'search-form' ) );
    add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );

    // Make theme available for translation
    // Translations can be filed in the /languages/ directory
    load_theme_textdomain( 'wixi', get_template_directory() . '/languages' );

    register_nav_menus(array(
        'header_menu' => esc_html__( 'Header Menu', 'wixi' ),
    ) );

}
add_action( 'after_setup_theme', 'wixi_theme_setup' );


/*************************************************
## WIDGET COLUMNS
*************************************************/


function wixi_widgets_init()
{

    register_sidebar(array(
        'name' => esc_html__( 'Blog Sidebar', 'wixi' ),
        'id' => 'sidebar-1',
        'description' => esc_html__( 'These widgets for the Blog page.', 'wixi' ),
        'before_widget' => '<div class="nt-sidebar-inner-widget blog-sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="nt-sidebar-inner-widget-title blog-sidebar_widget_title">',
        'after_title' => '</h5>'
    ) );
    if ( function_exists( 'get_field' ) && 'full-width' != get_field( 'wixi_page_layout' ) ) {
        register_sidebar(array(
            'name' => esc_html__( 'Default Page Sidebar', 'wixi' ),
            'id' => 'wixi-page-sidebar',
            'description' => esc_html__( 'These widgets for the Default Page pages.', 'wixi' ),
            'before_widget' => '<div class="nt-sidebar-inner-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h5 class="nt-sidebar-inner-widget-title widget-title blog-sidebar_widget_title">',
            'after_title' => '</h5>'
        ) );
    }
    if ( class_exists( 'Redux' ) ) {
        if ( 'full-width' != wixi_settings( 'archive_layout', 'full-width' ) ) {
            register_sidebar(array(
                'name' => esc_html__( 'Archive Sidebar', 'wixi' ),
                'id' => 'wixi-archive-sidebar',
                'description' => esc_html__( 'These widgets for the Archive pages.', 'wixi' ),
                'before_widget' => '<div class="nt-sidebar-inner-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h5 class="nt-sidebar-inner-widget-title widget-title blog-sidebar_widget_title">',
                'after_title' => '</h5>'
            ) );
        }
        if ( 'full-width' != wixi_settings( 'search_layout', 'full-width' ) ) {
            register_sidebar(array(
                'name' => esc_html__( 'Search Sidebar', 'wixi' ),
                'id' => 'wixi-search-sidebar',
                'description' => esc_html__( 'These widgets for the Search pages.', 'wixi' ),
                'before_widget' => '<div class="nt-sidebar-inner-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h5 class="nt-sidebar-inner-widget-title widget-title blog-sidebar_widget_title">',
                'after_title' => '</h5>'
            ) );
        }
        if ( 'full-width' != wixi_settings( 'single_layout', 'full-width' ) ) {
            register_sidebar(array(
                'name' => esc_html__( 'Blog Single Sidebar', 'wixi' ),
                'id' => 'wixi-single-sidebar',
                'description' => esc_html__( 'These widgets for the Blog single page.', 'wixi' ),
                'before_widget' => '<div class="nt-sidebar-inner-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h5 class="nt-sidebar-inner-widget-title widget-title blog-sidebar_widget_title">',
                'after_title' => '</h5>'
            ) );
        }
        if ( '1' == wixi_settings( 'footer_visibility', '1' ) && '1' == wixi_settings( 'footer_widgetize_visibility', '0' ) ) {
            register_sidebar(array(
                'name' => esc_html__( 'Footer Widget Area', 'wixi' ),
                'id' => 'footer-widget-area',
                'description' => esc_html__( 'These widgets for the footer top section.', 'wixi' ),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h5 class="nt-footer-widget-title nt-sidebar-inner-widget-title blog-sidebar_widget_title">',
                'after_title' => '</h5>'
            ) );
        }

    } // end if redux exists
} // end wixi_widgets_init
add_action( 'widgets_init', 'wixi_widgets_init' );


/*************************************************
## INCLUDE THE TGM_PLUGIN_ACTIVATION CLASS.
*************************************************/


function wixi_register_required_plugins()
{
    $plugins = array(
        array(
            'name' => esc_html__( 'Custom Post Type UI', 'wixi' ),
            'slug' => 'custom-post-type-ui'
        ),
        array(
            'name' => esc_html__( 'Contact Form 7', 'wixi' ),
            'slug' => 'contact-form-7'
        ),
        array(
            'name' => esc_html__( 'Safe SVG', 'wixi' ),
            'slug' => 'safe-svg',
        ),
        array(
            'name' => esc_html__( 'Theme Options Panel', 'wixi' ),
            'slug' => 'redux-framework',
            'required' => true
        ),
        array(
            'name' => esc_html__( 'Elementor', 'wixi' ),
            'slug' => 'elementor',
            'required' => true
        ),
        array(
            'name' => esc_html__( 'Envato Auto Update Theme', 'wixi' ),
            'slug' => 'envato-market',
            'source' => 'https://ninetheme.com/documentation/plugins/envato-market.zip',
            'required' => false
        ),
        array(
            'name' => esc_html__( 'Wixi Elementor Addons', 'wixi' ),
            'slug' => 'wixi-elementor-addons',
            'source' => get_template_directory() . '/plugins/wixi-elementor-addons.zip',
            'required' => true,
            'version' => '1.0.9'
        )
        // end plugins list
    );

    $config = array(
        'id' => 'tgmpa',
        'default_path' => '',
        'menu' => 'tgmpa-install-plugins',
        'parent_slug' => apply_filters( 'ninetheme_parent_slug', 'themes.php' ),
        'has_notices' => true,
        'dismissable' => true,
        'dismiss_msg' => '',
        'is_automatic' => true,
        'message' => '',
    );

    tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'wixi_register_required_plugins' );



/*************************************************
## ONE CLICK DEMO IMPORT
*************************************************/


/*************************************************
## THEME SETUP WIZARD
    https://github.com/richtabor/MerlinWP
*************************************************/

require_once get_parent_theme_file_path( '/inc/core/merlin/class-merlin.php' );
require_once get_parent_theme_file_path( '/inc/core/demo-wizard-config.php' );

function wixi_merlin_local_import_files() {
    $rtl = is_rtl() ? '-rtl' : '';
    return array(
        array(
            'import_file_name'         => esc_html__( 'Main Demo','wixi' ),
            // XML data
            'local_import_file'        => get_parent_theme_file_path( 'inc/core/merlin/demodata/data'.$rtl.'.xml' ),
            // Widget data
            'local_import_widget_file' => get_parent_theme_file_path( 'inc/core/merlin/demodata/widgets.wie' ),
            // Theme options
            'local_import_redux'       => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ). 'inc/core/merlin/demodata/redux.json',
                    'option_name' => 'wixi'
                )
            ),
            // cptui -> custom post types data
            'import_cptui' => array(
                array(
                    'cpt_file_url' => trailingslashit( get_template_directory_uri() ) . 'inc/core/merlin/demodata/cpt.json',
                    'tax_file_url' => trailingslashit( get_template_directory_uri() ) . 'inc/core/merlin/demodata/cpttax.json'
                )
            )
        )
    );
}
add_filter( 'merlin_import_files', 'wixi_merlin_local_import_files' );


/**
 * Execute custom code after the whole import has finished.
 */
function wixi_merlin_after_import_setup() {
    // Assign menus to their locations.
    $primary = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

    set_theme_mod(
        'nav_menu_locations', array(
            'header_menu' => $primary->term_id
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

    if ( did_action( 'elementor/loaded' ) ) {
        // update some default elementor global settings after setup theme
        update_option( 'elementor_active_kit', '25' );
        update_option( 'elementor_disable_color_schemes', 'yes' );
        update_option( 'elementor_disable_typography_schemes', 'yes' );
        update_option( 'elementor_global_image_lightbox', 'yes' );
        update_option( 'elementor_cpt_support', ['post','page','projects'] );
    }


}
add_action( 'merlin_after_all_import', 'wixi_merlin_after_import_setup' );

add_action('init', 'do_output_buffer'); function do_output_buffer() { ob_start(); }


add_action( 'admin_init', function() {
    if ( did_action( 'elementor/loaded' ) ) {
        remove_action( 'admin_init', [ \Elementor\Plugin::$instance->admin, 'maybe_redirect_to_getting_started' ] );
    }
}, 1 );

function wixi_register_elementor_locations( $elementor_theme_manager ) {

    $elementor_theme_manager->register_location( 'header' );
    $elementor_theme_manager->register_location( 'footer' );
    $elementor_theme_manager->register_location( 'single' );
    $elementor_theme_manager->register_location( 'archive' );

}
add_action( 'elementor/theme/register_locations', 'wixi_register_elementor_locations' );
