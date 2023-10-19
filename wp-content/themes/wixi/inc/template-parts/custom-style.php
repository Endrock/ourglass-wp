<?php

/*
** theme options panel and metabox settings
** will change some parts of theme via custom style
*/

function wixi_custom_css()
{

  // stop on admin pages
    if (is_admin()) {
        return false;
    }

    // Redux global
    global $wixi;

    /* CSS to output */
    $theCSS = '';

    /*************************************************
    ## Elementor SETTINGS
    *************************************************/

    if ('1' == wixi_settings('use_elementor_style_kit')) {
        $theCSS .= '[class*=" elementor-kit-"] p.elementor-heading-title{
            line-height: inherit;
        }';
    }

    /*************************************************
    ## PRELOADER SETTINGS
    *************************************************/

    if ('0' != wixi_settings('preloader_visibility')) {
        $pretype = wixi_settings('pre_type', 'default');
        $prebg = wixi_settings('pre_bg', '#fff');
        $prebg = $prebg ? $prebg : '#f1f1f1';
        $spinclr = wixi_settings('pre_spin', '#000');
        $spinclr = $spinclr ? $spinclr : '#000';

        if ( 'default' == $pretype ) {
            $pretextcolor = wixi_settings('pre_text_clr', '');
            $theCSS .= 'body.dark .pace, body.light .pace { background-color: '. esc_attr( $spinclr ) .';}';
            $theCSS .= '#preloader:after, #preloader:before{ background-color:'. esc_attr( $prebg ) .';}';
            if ( $pretextcolor ) {
                $theCSS .= '#preloader .loading-text-overlay,.loading-text:before {color: '.$pretextcolor.';}
                .loading-text {-webkit-text-stroke-color: '.$pretextcolor.';}';
            }
        }


        $theCSS .= 'div#nt-preloader {background-color: '. esc_attr($prebg) .';overflow: hidden;background-repeat: no-repeat;background-position: center center;height: 100%;left: 0;position: fixed;top: 0;width: 100%;z-index: 9999999;}';
        $spinrgb = wixi_hex2rgb($spinclr);
        $spin_rgb = implode(", ", $spinrgb);

        if ('01' == $pretype) {
            $theCSS .= '.loader01 {width: 56px;height: 56px;border: 8px solid '. $spinclr .';border-right-color: transparent;border-radius: 50%;position: relative;animation: loader-rotate 1s linear infinite;top: 50%;margin: -28px auto 0; }.loader01::after {content: "";width: 8px;height: 8px;background: '. $spinclr .';border-radius: 50%;position: absolute;top: -1px;left: 33px; }@keyframes loader-rotate {0% {transform: rotate(0); }100% {transform: rotate(360deg); } }';
        }
        if ('02' == $pretype) {
            $theCSS .= '.loader02 {width: 56px;height: 56px;border: 8px solid rgba('. $spin_rgb .', 0.25);border-top-color: '. $spinclr .';border-radius: 50%;position: relative;animation: loader-rotate 1s linear infinite;top: 50%;margin: -28px auto 0; }@keyframes loader-rotate {0% {transform: rotate(0); }100% {transform: rotate(360deg); } }';
        }
        if ('03' == $pretype) {
            $theCSS .= '.loader03 {width: 56px;height: 56px;border: 8px solid transparent;border-top-color: '. $spinclr .';border-bottom-color: '. $spinclr .';border-radius: 50%;position: relative;animation: loader-rotate 1s linear infinite;top: 50%;margin: -28px auto 0; }@keyframes loader-rotate {0% {transform: rotate(0); }100% {transform: rotate(360deg); } }';
        }
        if ('04' == $pretype) {
            $theCSS .= '.loader04 {width: 56px;height: 56px;border: 2px solid rgba('. $spin_rgb .', 0.5);border-radius: 50%;position: relative;animation: loader-rotate 1s ease-in-out infinite;top: 50%;margin: -28px auto 0; }.loader04::after {content: "";width: 10px;height: 10px;border-radius: 50%;background: '. $spinclr .';position: absolute;top: -6px;left: 50%;margin-left: -5px; }@keyframes loader-rotate {0% {transform: rotate(0); }100% {transform: rotate(360deg); } }';
        }
        if ('05' == $pretype) {
            $theCSS .= '.loader05 {width: 56px;height: 56px;border: 4px solid '. $spinclr .';border-radius: 50%;position: relative;animation: loader-scale 1s ease-out infinite;top: 50%;margin: -28px auto 0; }@keyframes loader-scale {0% {transform: scale(0);opacity: 0; }50% {opacity: 1; }100% {transform: scale(1);opacity: 0; } }';
        }
        if ('06' == $pretype) {
            $theCSS .= '.loader06 {width: 56px;height: 56px;border: 4px solid transparent;border-radius: 50%;position: relative;top: 50%;margin: -28px auto 0; }.loader06::before {content: "";border: 4px solid rgba('. $spin_rgb .', 0.5);border-radius: 50%;width: 67.2px;height: 67.2px;position: absolute;top: -9.6px;left: -9.6px;animation: loader-scale 1s ease-out infinite;animation-delay: 1s;opacity: 0; }.loader06::after {content: "";border: 4px solid '. $spinclr .';border-radius: 50%;width: 56px;height: 56px;position: absolute;top: -4px;left: -4px;animation: loader-scale 1s ease-out infinite;animation-delay: 0.5s; }@keyframes loader-scale {0% {transform: scale(0);opacity: 0; }50% {opacity: 1; }100% {transform: scale(1);opacity: 0; } }';
        }
        if ('07' == $pretype) {
            $theCSS .= '.loader07 {width: 16px;height: 16px;border-radius: 50%;position: relative;animation: loader-circles 1s linear infinite;top: 50%;margin: -8px auto 0; }@keyframes loader-circles {0% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.05), 19px -19px 0 0 rgba('. $spin_rgb .', 0.1), 27px 0 0 0 rgba('. $spin_rgb .', 0.2), 19px 19px 0 0 rgba('. $spin_rgb .', 0.3), 0 27px 0 0 rgba('. $spin_rgb .', 0.4), -19px 19px 0 0 rgba('. $spin_rgb .', 0.6), -27px 0 0 0 rgba('. $spin_rgb .', 0.8), -19px -19px 0 0 '. $spinclr .'; }12.5% {box-shadow: 0 -27px 0 0 '. $spinclr .', 19px -19px 0 0 rgba('. $spin_rgb .', 0.05), 27px 0 0 0 rgba('. $spin_rgb .', 0.1), 19px 19px 0 0 rgba('. $spin_rgb .', 0.2), 0 27px 0 0 rgba('. $spin_rgb .', 0.3), -19px 19px 0 0 rgba('. $spin_rgb .', 0.4), -27px 0 0 0 rgba('. $spin_rgb .', 0.6), -19px -19px 0 0 rgba('. $spin_rgb .', 0.8); }25% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.8), 19px -19px 0 0 '. $spinclr .', 27px 0 0 0 rgba('. $spin_rgb .', 0.05), 19px 19px 0 0 rgba('. $spin_rgb .', 0.1), 0 27px 0 0 rgba('. $spin_rgb .', 0.2), -19px 19px 0 0 rgba('. $spin_rgb .', 0.3), -27px 0 0 0 rgba('. $spin_rgb .', 0.4), -19px -19px 0 0 rgba('. $spin_rgb .', 0.6); }37.5% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.6), 19px -19px 0 0 rgba('. $spin_rgb .', 0.8), 27px 0 0 0 '. $spinclr .', 19px 19px 0 0 rgba('. $spin_rgb .', 0.05), 0 27px 0 0 rgba('. $spin_rgb .', 0.1), -19px 19px 0 0 rgba('. $spin_rgb .', 0.2), -27px 0 0 0 rgba('. $spin_rgb .', 0.3), -19px -19px 0 0 rgba('. $spin_rgb .', 0.4); }50% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.4), 19px -19px 0 0 rgba('. $spin_rgb .', 0.6), 27px 0 0 0 rgba('. $spin_rgb .', 0.8), 19px 19px 0 0 '. $spinclr .', 0 27px 0 0 rgba('. $spin_rgb .', 0.05), -19px 19px 0 0 rgba('. $spin_rgb .', 0.1), -27px 0 0 0 rgba('. $spin_rgb .', 0.2), -19px -19px 0 0 rgba('. $spin_rgb .', 0.3); }62.5% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.3), 19px -19px 0 0 rgba('. $spin_rgb .', 0.4), 27px 0 0 0 rgba('. $spin_rgb .', 0.6), 19px 19px 0 0 rgba('. $spin_rgb .', 0.8), 0 27px 0 0 '. $spinclr .', -19px 19px 0 0 rgba('. $spin_rgb .', 0.05), -27px 0 0 0 rgba('. $spin_rgb .', 0.1), -19px -19px 0 0 rgba('. $spin_rgb .', 0.2); }75% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.2), 19px -19px 0 0 rgba('. $spin_rgb .', 0.3), 27px 0 0 0 rgba('. $spin_rgb .', 0.4), 19px 19px 0 0 rgba('. $spin_rgb .', 0.6), 0 27px 0 0 rgba('. $spin_rgb .', 0.8), -19px 19px 0 0 '. $spinclr .', -27px 0 0 0 rgba('. $spin_rgb .', 0.05), -19px -19px 0 0 rgba('. $spin_rgb .', 0.1); }87.5% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.1), 19px -19px 0 0 rgba('. $spin_rgb .', 0.2), 27px 0 0 0 rgba('. $spin_rgb .', 0.3), 19px 19px 0 0 rgba('. $spin_rgb .', 0.4), 0 27px 0 0 rgba('. $spin_rgb .', 0.6), -19px 19px 0 0 rgba('. $spin_rgb .', 0.8), -27px 0 0 0 '. $spinclr .', -19px -19px 0 0 rgba('. $spin_rgb .', 0.05); }100% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.05), 19px -19px 0 0 rgba('. $spin_rgb .', 0.1), 27px 0 0 0 rgba('. $spin_rgb .', 0.2), 19px 19px 0 0 rgba('. $spin_rgb .', 0.3), 0 27px 0 0 rgba('. $spin_rgb .', 0.4), -19px 19px 0 0 rgba('. $spin_rgb .', 0.6), -27px 0 0 0 rgba('. $spin_rgb .', 0.8), -19px -19px 0 0 '. $spinclr .'; } }';
        }
        if ('08' == $pretype) {
            $theCSS .= '.loader08 {width: 20px;height: 20px;position: relative;animation: loader08 1s ease infinite;top: 50%;margin: -46px auto 0; }@keyframes loader08 {0%, 100% {box-shadow: -13px 20px 0 '. $spinclr .', 13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 46px 0 rgba('. $spin_rgb .', 0.2), -13px 46px 0 rgba('. $spin_rgb .', 0.2); }25% {box-shadow: -13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 20px 0 '. $spinclr .', 13px 46px 0 rgba('. $spin_rgb .', 0.2), -13px 46px 0 rgba('. $spin_rgb .', 0.2); }50% {box-shadow: -13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 46px 0 '. $spinclr .', -13px 46px 0 rgba('. $spin_rgb .', 0.2); }75% {box-shadow: -13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 46px 0 rgba('. $spin_rgb .', 0.2), -13px 46px 0 '. $spinclr .'; } }';
        }
        if ('09' == $pretype) {
            $theCSS .= '.loader09 {width: 10px;height: 48px;background: '. $spinclr .';position: relative;animation: loader09 1s ease-in-out infinite;animation-delay: 0.4s;top: 50%;margin: -28px auto 0; }.loader09::after, .loader09::before {content:  "";position: absolute;width: 10px;height: 48px;background: '. $spinclr .';animation: loader09 1s ease-in-out infinite; }.loader09::before {right: 18px;animation-delay: 0.2s; }.loader09::after {left: 18px;animation-delay: 0.6s; }@keyframes loader09 {0%, 100% {box-shadow: 0 0 0 '. $spinclr .', 0 0 0 '. $spinclr .'; }50% {box-shadow: 0 -8px 0 '. $spinclr .', 0 8px 0 '. $spinclr .'; } }';
        }
        if ('10' == $pretype) {
            $theCSS .= '.loader10 {width: 28px;height: 28px;border-radius: 50%;position: relative;animation: loader10 0.9s ease alternate infinite;animation-delay: 0.36s;top: 50%;margin: -42px auto 0; }.loader10::after, .loader10::before {content: "";position: absolute;width: 28px;height: 28px;border-radius: 50%;animation: loader10 0.9s ease alternate infinite; }.loader10::before {left: -40px;animation-delay: 0.18s; }.loader10::after {right: -40px;animation-delay: 0.54s; }@keyframes loader10 {0% {box-shadow: 0 28px 0 -28px '. $spinclr .'; }100% {box-shadow: 0 28px 0 '. $spinclr .'; } }';
        }
        if ('11' == $pretype) {
            $theCSS .= '.loader11 {width: 20px;height: 20px;border-radius: 50%;box-shadow: 0 40px 0 '. $spinclr .';position: relative;animation: loader11 0.8s ease-in-out alternate infinite;animation-delay: 0.32s;top: 50%;margin: -50px auto 0; }.loader11::after, .loader11::before {content:  "";position: absolute;width: 20px;height: 20px;border-radius: 50%;box-shadow: 0 40px 0 '. $spinclr .';animation: loader11 0.8s ease-in-out alternate infinite; }.loader11::before {left: -30px;animation-delay: 0.48s;}.loader11::after {right: -30px;animation-delay: 0.16s; }@keyframes loader11 {0% {box-shadow: 0 40px 0 '. $spinclr .'; }100% {box-shadow: 0 20px 0 '. $spinclr .'; } }';
        }
        if ('12' == $pretype) {
            $theCSS .= '.loader12 {width: 20px;height: 20px;border-radius: 50%;position: relative;animation: loader12 1s linear alternate infinite;top: 50%;margin: -50px auto 0; }@keyframes loader12 {0% {box-shadow: -60px 40px 0 2px '. $spinclr .', -30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 0 40px 0 0 rgba('. $spin_rgb .', 0.2), 30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 60px 40px 0 0 rgba('. $spin_rgb .', 0.2); }25% {box-shadow: -60px 40px 0 0 rgba('. $spin_rgb .', 0.2), -30px 40px 0 2px '. $spinclr .', 0 40px 0 0 rgba('. $spin_rgb .', 0.2), 30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 60px 40px 0 0 rgba('. $spin_rgb .', 0.2); }50% {box-shadow: -60px 40px 0 0 rgba('. $spin_rgb .', 0.2), -30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 0 40px 0 2px '. $spinclr .', 30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 60px 40px 0 0 rgba('. $spin_rgb .', 0.2); }75% {box-shadow: -60px 40px 0 0 rgba('. $spin_rgb .', 0.2), -30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 0 40px 0 0 rgba('. $spin_rgb .', 0.2), 30px 40px 0 2px '. $spinclr .', 60px 40px 0 0 rgba('. $spin_rgb .', 0.2); }100% {box-shadow: -60px 40px 0 0 rgba('. $spin_rgb .', 0.2), -30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 0 40px 0 0 rgba('. $spin_rgb .', 0.2), 30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 60px 40px 0 2px '. $spinclr .'; } }';
        }
    }


    $theCSS .= '.lazyloading {
      background-image: url('.get_template_directory_uri().'/images/loader.gif'.');
    }';

    $pattern = get_template_directory().'/images/pattern-bg.gif';
    $pattern = file_exists( $pattern ) ? get_template_directory_uri().'/images/pattern-bg.gif' : '';

    $theCSS .= '.nt-404 .call-action:before {
      background-image: url('.$pattern.');
      background-repeat: repeat;
      opacity: .04;
    }';

    $menu_close = wixi_settings( 'nav_close_title', 'Close' );
    $nav_aline = wixi_settings( 'nav_a_line_visibility', '1' );
    $arrow_visibility = wixi_settings( 'arrow_visibility', '1' );

    if( $menu_close ){
        $theCSS .= '.overlaynav .menu-toggle .text:after {
            content: "'.esc_html( $menu_close ).'";width: max-content;
        }';
    }
    if( '0' == $nav_aline ){
        $theCSS .= '.main-overlaymenu .menu-wrapper .main-menu > li span.nm {
            display: none!important;
        }';
        $theCSS .= '.main-overlaymenu .link:after,.main-overlaymenu .link:before {
            content: none!important;
        }';
    }

    if( '0' == $arrow_visibility ){
        $theCSS .= 'body {
            cursor: none!important;
        }';
    }
    $backtotop_clr1 = wixi_settings( 'backtotop_bg1' );
    $backtotop_clr2 = wixi_settings( 'backtotop_bg' );
    $backtotop_clr3 = wixi_settings( 'backtotop_arrow' );

    if ( !empty( $backtotop_clr1['rgba'] ) ) {
        $theCSS .= '.backtotop-wrap {
            -webkit-box-shadow: inset 0 0 0 2px '.$backtotop_clr1['rgba'].';
            box-shadow: inset 0 0 0 2px '.$backtotop_clr1['rgba'].';
        }';
    }
    if ( '' != $backtotop_clr2 ) {
        $theCSS .= '.backtotop-wrap svg.progress-circle path {
            stroke: '.$backtotop_clr2.';
        }';
    }
    if ( '' != $backtotop_clr3 ) {
        $theCSS .= '.backtotop-wrap::after {
            color: '.$backtotop_clr3.';
        }';
    }

    $main_root_color = wixi_settings( 'theme_main_clr' );
	$theme_main_dark_btnclr = wixi_settings( 'theme_main_dark_btnclr' );
	$theme_main_light_btnclr = wixi_settings( 'theme_main_light_btnclr' );
	$overlay_menu_transition = wixi_settings( 'overlay_menu_transition' );
	$overlay_menuitem_transition = wixi_settings( 'overlay_menuitem_transition' );
	$overlay_submenu_transitiondelay = wixi_settings( 'overlay_submenu_transitiondelay' );
	if( $main_root_color ){
		$theCSS .= ':root {
			--color-secondary: '.$main_root_color.';
		}
		.nt-blog .controls .swiper-pagination-fraction span,.nav--xusni .nav__item-title{
		color:'.$main_root_color.';
		}
		.services_icon.icon svg path[stroke="#75DAB4"]{
			stroke:'.$main_root_color.';
		}
		.agency .img .icon svg path[stroke="#75DAB4"]{
			stroke:'.$main_root_color.';
		}
		.agency .img .exp h6:after,.tagcloud a:hover,.nav--xusni .swiper-slide-thumb-active::after {
    		background: '.$main_root_color.';
		}';
	}
	if( $theme_main_dark_btnclr ){
		$theCSS .= '.nt-sidebar-inner-widget .tag-cloud-link, .button-slide:after {
    		background: '.$theme_main_dark_btnclr.';
		}';
		$theCSS .= '.button-slide {
    		border-color: '.$theme_main_dark_btnclr.';
		}';
	}
	if( $theme_main_light_btnclr ){
		$theCSS .= '.button-slide.c-light:after {
    		background: '.$theme_main_light_btnclr.';
		}';
		$theCSS .= '.button-slide.c-light {
    		border-color: '.$theme_main_light_btnclr.';
		}';
	}
	if( $overlay_menu_transition ){
		$theCSS .= '.main-overlaymenu {
			-webkit-transition: '.$overlay_menu_transition.';
			transition: '.$overlay_menu_transition.';
		}';
	}
	if( $overlay_menuitem_transition ){
		$theCSS .= '.main-overlaymenu .menu-wrapper .main-menu > li {
			-webkit-transition: '.$overlay_menuitem_transition.';
			transition: '.$overlay_menuitem_transition.';
		}';
	}
	if( $overlay_submenu_transitiondelay ){
		$theCSS .= '.main-overlaymenu .menu-wrapper .main-menu .sub-menu {
			-webkit-transition-delay: '.$overlay_submenu_transitiondelay.';
			transition-delay: '.$overlay_submenu_transitiondelay.';
		}';
	}


    /*************************************************
    ## THEME COLORS
    *************************************************/
    if( ! is_page() ){

    }

    // use page/post ID for page settings
    $page_id = get_the_ID();

    /*************************************************
    ## THEME PAGINATION
    *************************************************/
    // pagination color
    $pag_clr = wixi_settings('pag_clr');
    // pagination active and hover color
    $pag_hvrclr = wixi_settings( 'pag_hvrclr' );
    // pagination number color
    $pag_nclr = wixi_settings( 'pag_nclr' );
    // pagination active and hover color
    $pag_hvrnclr = wixi_settings( 'pag_hvrnclr' );

    // pagination color
    if ($pag_clr) {
        $theCSS .= '
        .nt-pagination.-style-outline .nt-pagination-item .nt-pagination-link { border-color: '. esc_attr($pag_clr) .'; }
        .nt-pagination.-style-default .nt-pagination-link { background-color: '. esc_attr($pag_clr) .';
        }';
    }

    // pagination active and hover color
    if ($pag_hvrclr) {
        $theCSS .= '
        .nt-pagination.-style-outline .nt-pagination-item.active .nt-pagination-link,
        .nt-pagination.-style-outline .nt-pagination-item .nt-pagination-link:hover { border-color: '. esc_attr($pag_hvrclr) .'; }
        .nt-pagination.-style-default .nt-pagination-item.active .nt-pagination-link,
        .nt-pagination.-style-default .nt-pagination-item .nt-pagination-link:hover { background-color: '. esc_attr($pag_hvrclr) .';
        }';
    }

    // pagination number color
    if ( $pag_nclr ) {
        $theCSS .= '
        .nt-pagination.-style-outline .nt-pagination-item .nt-pagination-link,
        .nt-pagination.-style-default .nt-pagination-link { color: '. esc_attr($pag_nclr) .';
        }';
    }

    // pagination active and hover color
    if ( $pag_hvrnclr ) {
        $theCSS .= '
        .nt-pagination.-style-outline .nt-pagination-item.active .nt-pagination-link,
        .nt-pagination.-style-outline .nt-pagination-item .nt-pagination-link:hover,
        .nt-pagination.-style-default .nt-pagination-item.active .nt-pagination-link,
        .nt-pagination.-style-default .nt-pagination-item .nt-pagination-link:hover { color: '. esc_attr($pag_hvrnclr) .';
        }';
    }

    /* Add CSS to style.css */
    wp_register_style('wixi-custom-style', false);
    wp_enqueue_style('wixi-custom-style');
    wp_add_inline_style('wixi-custom-style', $theCSS);
}

add_action('wp_enqueue_scripts', 'wixi_custom_css');


// customization on admin pages
function wixi_admin_custom_css()
{
    if (! is_admin()) {
        return false;
    }

    /* CSS to output */
    $theCSS = '';

    $theCSS .= '
    #setting-error-tgmpa, #setting-error-wixi {
        display: block !important;
    }
    .updated.vc_license-activation-notice,
    #redux-connect-message {
        display:none;
    }
    .redux_field_th {
        color: #191919;
        font-weight: 700;
    }
    .redux-main .description {
        display: block;
        font-weight: normal;
    }
    #redux-header .rAds {
        opacity: 0 !important;
        display: none !important;
        visibility : hidden;
    }
    .redux-main .wp-picker-container .wp-color-result-text {
        line-height: 28px;
    }
    .redux-container .redux-main .input-append .add-on, .redux-container .redux-main .input-prepend .add-on {
        line-height: 22px;
    }
  	#customize-controls img {
  		max-width: 75%;
  	}
    .wixi_gallery_mtb li {
        position: relative;
        display: inline-block;
        width: 80px;
        height: 80px;
        padding: 5px;
        border:1px solid transparent;
    }
    .wixi_gallery_mtb li:hover {
        border-color: #ddd;
    }
    .wixi_gallery_mtb li span{
        height: 80px;
        width: 80px;
        position: relative;
        display: inline-block;
        background-position: center;
        background-size: cover;
    }
    a.wixi_gallery_remove{
        font-size: 14px;
        position: absolute;
        right: 5px;
        top: 5px;
        display: none;
        text-decoration: none;
        width: 15px;
        height: 15px;
        line-height: 15px;
        background: #f00;
        border-radius: 2px;
        color: #fff;
        text-align: center;
    }
    .wixi_gallery_mtb li:hover > a.wixi_gallery_remove{
        display: block;
    }
    ';
    // end $theCSS

    /* Add CSS to style.css */
    wp_register_style('wixi-admin-custom-style', false);
    wp_enqueue_style('wixi-admin-custom-style');
    wp_add_inline_style('wixi-admin-custom-style', $theCSS);
}
add_action('admin_enqueue_scripts', 'wixi_admin_custom_css');
