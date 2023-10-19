<?php
/**
* Plugin Name: Wixi Elementor Addons
* Description: Premium & Advanced Essential Elements for Elementor
* Plugin URI:  http://themeforest.net/user/Ninetheme
* Version:     1.0.9
* Author:      Ninetheme
* Author URI:  https://ninetheme.com/
*/

/*
* Exit if accessed directly.
*/

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'WIXI_PLUGIN_FILE', __FILE__ );
define( 'WIXI_PLUGIN_BASENAME', plugin_basename(__FILE__) );
define( 'WIXI_PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'WIXI_PLUGIN_URL', plugins_url('/', __FILE__) );

final class Wixi_Elementor_Addons
{

    /**
    * Plugin Version
    *
    * @since 1.0
    *
    * @var string The plugin version.
    */
    const VERSION = '1.0.9';

    /**
    * Minimum Elementor Version
    *
    * @since 1.0
    *
    * @var string Minimum Elementor version required to run the plugin.
    */
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    /**
    * Minimum PHP Version
    *
    * @since 1.0
    *
    * @var string Minimum PHP version required to run the plugin.
    */
    const MINIMUM_PHP_VERSION = '5.6';

    /**
    * Instance
    *
    * @since 1.0
    *
    * @access private
    * @static
    *
    * @var Wixi_Elementor_Addons The single instance of the class.
    */
    private static $_instance = null;

    /**
    * Instance
    *
    * Ensures only one instance of the class is loaded or can be loaded.
    *
    * @since 1.0
    *
    * @access public
    * @static
    *
    * @return Wixi_Elementor_Addons An instance of the class.
    */
    public static function instance()
    {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
    * Constructor
    *
    * @since 1.0
    *
    * @access public
    */
    public function __construct()
    {
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );
    }

    /**
    * Load Textdomain
    *
    * Load plugin localization files.
    *
    * Fired by `init` action hook.
    *
    * @since 1.0
    *
    * @access public
    */
    public function i18n()
    {
        load_plugin_textdomain( 'wixi' );
    }

    /**
    * Initialize the plugin
    *
    * Load the plugin only after Elementor (and other plugins) are loaded.
    * Checks for basic plugin requirements, if one check fail don't continue,
    * if all check have passed load the files required to run the plugin.
    *
    * Fired by `plugins_loaded` action hook.
    *
    * @since 1.0
    *
    * @access public
    */
    public function init()
    {
        // Check if Elementor is installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'wixi_admin_notice_missing_main_plugin' ] );
            return;
        }
        // Check for required Elementor version
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'wixi_admin_notice_minimum_elementor_version' ] );
            return;
        }
        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'wixi_admin_notice_minimum_php_version' ] );
            return;
        }
        // register template name for the elementor saved templates
        add_filter( 'elementor/editor/localize_settings', [ $this,'wixi_register_template'],10,2 );

        /* Custom plugin helper functions */
        require_once( WIXI_PLUGIN_PATH . '/classes/class-helpers-functions.php' );
        /* Elementor section parallax */
        require_once( WIXI_PLUGIN_PATH . '/classes/class-custom-elementor-section.php' );
        /* Add custom controls to default widgets */
        require_once( WIXI_PLUGIN_PATH . '/classes/class-customizing-default-widgets.php' );
        /* Add custom controls to page settings */
        require_once( WIXI_PLUGIN_PATH . '/classes/class-customizing-page-settings.php' );
        /* Image resizer */
        require_once( WIXI_PLUGIN_PATH . '/classes/class-image-resizer.php' );
        /* Wixi Elementor template */
        require_once( WIXI_PLUGIN_PATH . '/classes/class-templater.php' );
        /* Custom metaboxes for gallery post type */
        require_once( WIXI_PLUGIN_PATH . '/classes/class-metaboxes-gallery.php' );
        /* includes/shortcodes/elementor */
        if ( ! get_option( 'disable_wixi_list_shortcodes' ) == 1 ) {
            require_once( WIXI_PLUGIN_PATH . '/classes/class-list-shortcodes.php' );
        }
        /* Admin template */
        require_once( WIXI_PLUGIN_PATH . '/templates/admin/admin.php' );

        // Categories registered
        add_action( 'elementor/elements/categories_registered', [ $this, 'wixi_add_widget_category' ] );
        // Widgets registered
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_single_widgets' ] );
        // Register Widget Styles
        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
        // Register Widget Scripts
        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ] );

        add_action('elementor/editor/after_enqueue_scripts', [ $this, 'admin_custom_scripts' ]);
        // Register Widget Scripts
        add_action( 'wp_print_styles', [ $this, 'dequeue_style' ], 100 );
        add_action( 'wp_print_scripts', [ $this, 'dequeue_scripts' ], 100 );

    }

    public function dequeue_style() {
        if( is_page_template( 'wixi-elementor-page.php' ) ){
            wp_dequeue_style( 'wixi-framework-style' );
        }
    }

    public function dequeue_scripts() {
        if( is_page_template( 'wixi-elementor-page.php' ) ){
            //wp_dequeue_script( 'swiper' );
        }
    }

    public function wixi_register_template( $localized_settings, $config )
    {
        $localized_settings = [
            'i18n' => [
                'my_templates' => esc_html__( 'Wixi Templates', 'wixi' )
            ]
        ];
        return $localized_settings;
    }


    public function admin_custom_scripts()
    {
        // Plugin custom css
        wp_enqueue_style( 'wixi-custom-editor', WIXI_PLUGIN_URL. 'assets/front/css/plugin-editor.css' );
    }

    public function widget_styles()
    {
        // Plugin custom css
        $rtl = is_rtl() ? '-rtl' : '';
        wp_enqueue_style( 'wixi-custom', WIXI_PLUGIN_URL. 'assets/front/css/custom'.$rtl.'.css' );

    }

    public function widget_scripts()
    {
        wp_enqueue_script( 'jarallax');
        wp_enqueue_script( 'particles');
        wp_enqueue_style( 'vegas');
        wp_enqueue_script( 'vegas');

        // custom-scripts
        wp_register_script( 'wixi-addons-custom-scripts', WIXI_PLUGIN_URL. 'assets/front/js/custom-scripts.js', [ 'jquery' ], self::VERSION, true );
        wp_enqueue_script( 'wixi-addons-custom-scripts' );
        $template = basename( get_page_template() );
        if ( $template == 'wixi-elementor-page.php' || $template == 'page.php' ) {
            if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {
                $page_settings = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' )->get_model( get_the_ID() );
                $scrolltoid = $page_settings->get_settings( 'wixi_elementor_page_scrolltoid' );
                $duration   = $page_settings->get_settings( 'wixi_elementor_page_scrolltoid_duration' );
                if ( 'yes' == $scrolltoid ) {
                    wp_localize_script( 'wixi-addons-custom-scripts', 'wixi_page_vars',
                        [
                            'scrolltoid' => $scrolltoid,
                            'duration' => $duration ? $duration : 50,
                        ]
                    );
                }
            }
        }
    }

    /**
    * Admin notice
    *
    * Warning when the site doesn't have Elementor installed or activated.
    *
    * @since 1.0
    *
    * @access public
    */
    public function wixi_admin_notice_missing_main_plugin()
    {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '%1$s requires %2$s to be installed and activated.', 'wixi' ),
            '<strong>' . esc_html__( 'Wixi Elementor Addons', 'wixi' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'wixi' ) . '</strong>'
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
    * Admin notice
    *
    * Warning when the site doesn't have a minimum required Elementor version.
    *
    * @since 1.0
    *
    * @access public
    */
    public function wixi_admin_notice_minimum_elementor_version()
    {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '%1$s requires %2$s version %3$s or greater.', 'wixi' ),
            '<strong>' . esc_html__( 'Wixi Elementor Addons', 'wixi' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'wixi' ) . '</strong>',
             self::MINIMUM_ELEMENTOR_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
    * Admin notice
    *
    * Warning when the site doesn't have a minimum required PHP version.
    *
    * @since 1.0
    *
    * @access public
    */
    public function wixi_admin_notice_minimum_php_version()
    {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '%1$s requires %2$s version %3$s or greater.', 'wixi' ),
            '<strong>' . esc_html__( 'Wixi Elementor Addons', 'wixi' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'wixi' ) . '</strong>',
             self::MINIMUM_PHP_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
    * Register Widgets Category
    *
    */
    public function wixi_add_widget_category( $elements_manager )
    {
        $elements_manager->add_category( 'wixi', [ 'title' => esc_html__( 'Wixi Addons', 'wixi' ) ] );
        $elements_manager->add_category( 'wixi-cpt', [ 'title' => esc_html__( 'Wixi CPT', 'wixi' ) ] );
        $elements_manager->add_category( 'wixi-post', [ 'title' => esc_html__( 'Wixi Post', 'wixi' ) ] );
    }

    public function wixi_widgets_list()
    {
        $list = array(
            array( 'name' => 'header-menu', 'class' => 'Wixi_Header_Menu' ),
            array( 'name' => 'header-menu-two', 'class' => 'Wixi_Header_Menu_Two' ),
            array( 'name' => 'mega-menu', 'subfolder' => 'mega-menu', 'class' => 'Wixi_Mega_Menu' ),
            array( 'name' => 'shape-overlays-menu', 'subfolder' => 'shape-overlays-menu', 'class' => 'Wixi_Shape_Overlays_Menu' ),
            array( 'name' => 'page-hero', 'class' => 'Wixi_Page_Hero' ),
            array( 'name' => 'breadcrumbs', 'class' => 'Wixi_Breadcrumbs' ),
            array( 'name' => 'home-slider', 'class' => 'Wixi_Home_Slider' ),
            array( 'name' => 'vegas-slider', 'class' => 'Wixi_Vegas_Slider' ),
            array( 'name' => 'vegas-template', 'class' => 'Wixi_Vegas_Template' ),
            array( 'name' => 'services-item', 'class' => 'Wixi_Services_Item' ),
            array( 'name' => 'projects-slider', 'class' => 'Wixi_Projects_Slider' ),
            array( 'name' => 'projects-gallery', 'class' => 'Wixi_Projects_Gallery' ),
            array( 'name' => 'justified-gallery', 'class' => 'Wixi_Justified_Gallery' ),
            array( 'name' => 'popup-video', 'class' => 'Wixi_Popup_Video' ),
            array( 'name' => 'testimonials-two', 'class' => 'Wixi_Testimonials_Two' ),
            array( 'name' => 'button', 'class' => 'Wixi_Button' ),
            array( 'name' => 'button2', 'subfolder' => 'button2', 'class' => 'Wixi_Button2' ),
            array( 'name' => 'animated-headline', 'class' => 'Wixi_Animated_Headline' ),
            array( 'name' => 'blog-slider', 'class' => 'Wixi_Blog_Slider' ),
            array( 'name' => 'blog-grid-two', 'class' => 'Wixi_Blog_Grid_Two' ),
            array( 'name' => 'brands-board', 'class' => 'Wixi_Brands_Board' ),
            array( 'name' => 'team-member', 'class' => 'Wixi_Team_Member' ),
            array( 'name' => 'contact-form-7', 'class' => 'Wixi_Contact_Form_7' ),
            array( 'name' => 'google-map', 'class' => 'Wixi_Map' ),
            array( 'name' => 'onepage', 'class' => 'Wixi_Onepage' ),
            array( 'name' => 'odometer', 'class' => 'Wixi_Odometer' ),
            array( 'name' => 'advanced-pricing', 'class' => 'Wixi_Advanced_Pricing' ),
            array( 'name' => 'svg-animation', 'subfolder' => 'vivus', 'class' => 'Wixi_Svg_Animation' ),
            array( 'name' => 'flip-card', 'class' => 'Wixi_Flip_Card' ),
            array( 'name' => 'crossroads-slideshow', 'subfolder' => 'crossroads-slideshow', 'class' => 'Wixi_Crossroads_Slideshow' ),
            array( 'name' => 'page-flip-layout', 'subfolder' => 'page-flip-layout', 'class' => 'Wixi_Page_Flip_Layout' ),
            array( 'name' => 'interactive-slider', 'subfolder' => 'interactive-link', 'class' => 'Wixi_Interactive_Link_Slider' ),
            array( 'name' => 'block-revealers', 'subfolder' => 'block-revealers', 'class' => 'Wixi_Block_Revealers' ),
            array( 'name' => 'two-block-slider', 'subfolder' => 'two-block-slider', 'class' => 'Wixi_Two_Block_Slider' ),
            array( 'name' => 'svg-pattern', 'subfolder' => 'svg-pattern', 'class' => 'Wixi_Svg_Pattern' ),
            array( 'name' => 'caption-hover-effects', 'subfolder' => 'caption-hover', 'class' => 'Wixi_Caption_Hover_Effects' ),
            array( 'name' => 'image-before-after', 'subfolder' => 'image-before-after', 'class' => 'Wixi_Image_Before_After' ),
            array( 'name' => 'animated-text-background', 'class' => 'Wixi_Animated_Text_Background' ),
            array( 'name' => 'post-types-list', 'class' => 'Wixi_Post_Types_List' ),
            array( 'name' => 'blog-grid', 'subfolder' => 'blog', 'class' => 'Wixi_Blog_Grid' ),
            array( 'name' => 'blog-masonry', 'subfolder' => 'blog', 'class' => 'Wixi_Blog_Masonry' ),
            array( 'name' => 'blog-slider2', 'subfolder' => 'blog', 'class' => 'Wixi_Blog_Slider2' ),
            array( 'name' => 'circle-progressbar', 'subfolder' => 'circle-progressbar', 'class' => 'Wixi_Circle_Progressbar' ),
        );
        return $list;
    }

    /**
    * Init Widgets
    */
    public function init_widgets()
    {
        $widgets = $this->wixi_widgets_list();

        if ( ! empty( $widgets ) ) {

            foreach ( $widgets as $widget ) {

                $option = 'disable_'.str_replace( '-', '_', $widget['name'] );
                $path = WIXI_PLUGIN_PATH . '/widgets/';
                $file = $widget['name'] . '.php';
                $file = isset( $widget['subfolder'] ) != '' ? $path.$widget['subfolder'] . '/' . $widget['name']. '.php' : $path.$file;
                $class = 'Elementor\\'.$widget['class'];

                if ( ! get_option( $option ) == 1 ) {

                    if ( file_exists( $file ) ) {

                        require_once( $file );
                        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class() );
                    }
                }
            }
        }
    }


    /**
    * Register Single Post Widgets
    */
    public function wixi_single_widgets_list()
    {
        $list = array(
            array( 'post-type' => 'projects', 'name' => 'project-next', 'class' => 'Wixi_Project_Next' ),
            array( 'post-type' => 'projects', 'name' => 'project-prev', 'class' => 'Wixi_Project_Prev' ),
            array( 'post-type' => 'projects', 'name' => 'project-meta', 'class' => 'Wixi_Project_Meta' ),
            array( 'post-type' => 'post', 'name' => 'post-data', 'class' => 'Wixi_Post_Data' ),
        );
        return $list;
    }

    /**
    * Init Single Post Widgets
    */
    public function init_single_widgets()
    {
        $widgets = $this->wixi_single_widgets_list();
        global $post;
        $wixi_post_type = false;

        if ( ! empty( $widgets ) && !is_404() ) {

            $wixi_post_type = get_post_type( $post->ID );

            $count = 0;

            foreach ( $widgets as $widget ) {

                if ( $wixi_post_type == $widgets[$count]['post-type'] ) {

                    $option = 'disable_'.str_replace( '-', '_', $widget['name'] );
                    $path = WIXI_PLUGIN_PATH . '/widgets/';
                    $file = $widget['name'] . '.php';
                    $file = isset( $widget['subfolder'] ) != '' ? $path.$widget['subfolder'] . '/' . $widget['name']. '.php' : $path.$file;
                    $class = 'Elementor\\'.$widget['class'];

                    if ( ! get_option( $option ) == 1 ) {

                        if ( file_exists( $file ) ) {

                            require_once( $file );
                            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class() );
                        }
                    }
                }
                $count++;
            }
        }
    }

}
Wixi_Elementor_Addons::instance();
