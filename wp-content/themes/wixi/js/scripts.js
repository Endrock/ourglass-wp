/*-----------------------------------------------------------------------------------

    Theme Name: Wixi
    Description: Creative Agency & Portfolio WordPress Theme
    Author: Ninetheme
    Author URI: https://ninetheme.com/
    Version: 1.0

-----------------------------------------------------------------------------------*/


(function(window, document, $) {

    "use strict";

    var win = $(window);
    /* Navbar Menu */

    win.on("scroll", function () {
        var bodyScroll = win.scrollTop();

        if ( bodyScroll > 100 ) {
            $("body").addClass("scroll-start");
        } else {
            $("body").removeClass("scroll-start");
        }
    });

    function wixiHeaderMenu() {

        var tlm = gsap.timeline();
        var tlg = gsap.timeline();

        if ( $('.main-menu .sub-menu').length ) {
            gsap.to($('.main-menu .sub-menu > .menu-item > div > a'), {yPercent: 80,autoAlpha: 0});
        }
        gsap.to($('.main-menu > .menu-item > div > a'), {yPercent: 0,autoAlpha: 1});


        $('.main-menu li.menu-item--has-child > div > a').on("click", function() {
            event.preventDefault();
            var parentUl = $(this).parent().next();
            var parentItems = $(this).parent().parent().parent().find('> .menu-item > div > a');
            var subItems = $(this).parent().next().find('> .menu-item > div > a');

            parentUl.addClass('opened');

            gsap.to(parentUl, .01, {height: 'auto',autoAlpha: 1,ease: Quad.easeOut})
            gsap.to(parentItems, {yPercent: 80,duration: .5,autoAlpha: 0,ease: Quad.easeOut})
            gsap.to(subItems, {yPercent: 0,duration: .5,delay:.3,autoAlpha: 1,ease: Quad.easeOut});

        });

        $('.main-menu .sub-menu .goback').on("click", function() {

            var parentUl   = $(this).parent();
            var subItems   = parentUl.find('> .menu-item > div > a');
            var paretItems = parentUl.parent().parent().find('> .menu-item > div > a');

            parentUl.toggleClass('opened');

            gsap.to(subItems, {yPercent: 80,duration: .5,autoAlpha: 0,ease: Quad.easeOut})
            gsap.to(parentUl, {autoAlpha: 0,height: 0,ease: Quad.easeOut})
            gsap.to(paretItems, {yPercent: 0,duration: .5,delay:.3,autoAlpha: 1,ease: Quad.easeOut});

        });
    }

    function wixiHeaderOverlay() {
        var open = false;

        if ( $('body.has-sidebar-menu').length || !$('.main-overlaymenu').length ) {
            return;
        }
        if ( $('body').hasClass('rtl') ) {
            gsap.to($('.overlaymenu-content'), {right: '-100%',autoAlpha: 0,});
            gsap.to($('.main-overlaymenu .menu-wrapper'), {xPercent: 40,autoAlpha: 0,});
            gsap.to($('.main-overlaymenu .menu-info'), {xPercent: 10, autoAlpha: 0,});
        } else {
            gsap.to($('.overlaymenu-content'), {left: '-100%',autoAlpha: 0,});
            gsap.to($('.main-overlaymenu .menu-wrapper'), {xPercent: -40,autoAlpha: 0,});
            gsap.to($('.main-overlaymenu .menu-info'), {xPercent: -10, autoAlpha: 0,});
        }

        $('.main-overlaymenu .menu-toggle, .main-overlaymenu .hamburger').on('click', function () {
            open = !open;
            $('.main-overlaymenu').toggleClass("open");
            $('.hamburger').toggleClass("is-active");

            if ( open ) {
                if ( $('body').hasClass('rtl') ) {
                    gsap.to($('.main-overlaymenu .overlaymenu-content'), {right: '0%',autoAlpha: 1});
                    gsap.to($('.main-overlaymenu .menu-wrapper'), {xPercent: 0,duration: .7,autoAlpha: 1,delay:.3,ease: Power1.easeInOut})
                    gsap.to($('.main-overlaymenu .menu-info'), {xPercent: 0,duration: .7,autoAlpha: 1,delay:.7,ease: Power1.easeInOut});
                } else {
                    gsap.to($('.main-overlaymenu .overlaymenu-content'), {left: '0%',autoAlpha: 1});
                    gsap.to($('.main-overlaymenu .menu-wrapper'), {xPercent: 0,duration: .7,autoAlpha: 1,delay:.3,ease: Power1.easeInOut})
                    gsap.to($('.main-overlaymenu .menu-info'), {xPercent: 0,duration: .7,autoAlpha: 1,delay:.7,ease: Power1.easeInOut});
                }

            } else {

                if ( $('body').hasClass('rtl') || $('body').hasClass('sidebar-menu-right') ) {
                    gsap.to($('.main-overlaymenu .menu-wrapper'), {autoAlpha: 0,duration: .5,xPercent: 40,ease: Quad.easeOut});
                    gsap.to($('.main-overlaymenu .menu-info'), {autoAlpha: 0,duration: .6,xPercent: 10,ease: Quad.easeOut});
                    gsap.to($('.main-overlaymenu .overlaymenu-content'), {right: '-100%',duration: .5,delay:.8,autoAlpha: 1,ease: Quad.easeOut});
                } else {
                    gsap.to($('.main-overlaymenu .menu-wrapper'), {autoAlpha: 0,duration: .5,xPercent: -40,ease: Quad.easeOut});
                    gsap.to($('.main-overlaymenu .menu-info'), {autoAlpha: 0,duration: .6,xPercent: -10,ease: Quad.easeOut});
                    gsap.to($('.main-overlaymenu .overlaymenu-content'), {left: '-100%',duration: .5,delay:.8,autoAlpha: 1,ease: Quad.easeOut});
                }
            }

            var sublang = $('.sub-list');
            if ( sublang.hasClass( 'show' ) ) {
                sublang.removeClass( 'show' );
            }
        });
        $('.internal .link').on('click', function () {
            open = !open;
            $('.main-overlaymenu').toggleClass("open");
            $('.hamburger').toggleClass("is-active");

            if ( open ) {
                if ( $('body').hasClass('rtl') ) {
                    gsap.to($('.main-overlaymenu .overlaymenu-content'), {right: '0%',autoAlpha: 1});
                    gsap.to($('.main-overlaymenu .menu-wrapper'), {xPercent: 0,duration: .7,autoAlpha: 1,delay:.3,ease: Power1.easeInOut})
                    gsap.to($('.main-overlaymenu .menu-info'), {xPercent: 0,duration: .7,autoAlpha: 1,delay:.7,ease: Power1.easeInOut});
                } else {
                    gsap.to($('.main-overlaymenu .overlaymenu-content'), {left: '0%',autoAlpha: 1});
                    gsap.to($('.main-overlaymenu .menu-wrapper'), {xPercent: 0,duration: .7,autoAlpha: 1,delay:.3,ease: Power1.easeInOut})
                    gsap.to($('.main-overlaymenu .menu-info'), {xPercent: 0,duration: .7,autoAlpha: 1,delay:.7,ease: Power1.easeInOut});
                }

            } else {

                if ( $('body').hasClass('rtl') || $('body').hasClass('sidebar-menu-right') ) {
                    gsap.to($('.main-overlaymenu .menu-wrapper'), {autoAlpha: 0,duration: .5,xPercent: 40,ease: Quad.easeOut});
                    gsap.to($('.main-overlaymenu .menu-info'), {autoAlpha: 0,duration: .6,xPercent: 10,ease: Quad.easeOut});
                    gsap.to($('.main-overlaymenu .overlaymenu-content'), {right: '-100%',duration: .5,delay:.8,autoAlpha: 1,ease: Quad.easeOut});
                } else {
                    gsap.to($('.main-overlaymenu .menu-wrapper'), {autoAlpha: 0,duration: .5,xPercent: -40,ease: Quad.easeOut});
                    gsap.to($('.main-overlaymenu .menu-info'), {autoAlpha: 0,duration: .6,xPercent: -10,ease: Quad.easeOut});
                    gsap.to($('.main-overlaymenu .overlaymenu-content'), {left: '-100%',duration: .5,delay:.8,autoAlpha: 1,ease: Quad.easeOut});
                }
            }
        });

        wixiHeaderMenu();
    }

    function wixiSidebarMenu() {
        const open = false;
        const toggleBtn = $('.sidebarmenu--hamburger-menu');
        const navMenu = $('.sidebarmenu--navigation');
        const searchBox = $('.sidebarmenu--search-box');
        const searchOpen = $('.sidebarmenu--search-open');
        const searchClose = $('.sidebarmenu--search-close');

        if ( navMenu.length ) {
            // Hamburger
            toggleBtn.on('click', function(e) {
                toggleBtn.toggleClass('open');
                navMenu.toggleClass('open');
                $('.main-overlaymenu').toggleClass("open");

                if (!$(this).hasClass('open')) {
                    $('.main-menu').removeClass("open-sub");
                    $('.sub-menu').removeClass("sub-open");
                }
                if (searchBox.hasClass('open')) {
                    searchOpen.removeClass('hide');
                    searchClose.removeClass('show');
                    searchBox.removeClass('open');
                }
            });

            // Search Open
            searchOpen.on('click', function(e) {
                searchOpen.addClass('hide');
                searchClose.addClass('show');
                searchBox.addClass('open');
                if (toggleBtn.hasClass('open')) {
                    toggleBtn.toggleClass('open');
                }
                if (navMenu.hasClass('open')) {
                    navMenu.toggleClass('open');
                    $('.main-overlaymenu').toggleClass("open");
                    $('.main-menu').removeClass("open-sub");
                    $('.sub-menu').removeClass("sub-open");
                }
            });

            // Search Close
            searchClose.on('click', function(e) {
                searchOpen.removeClass('hide');
                searchClose.removeClass('show');
                searchBox.removeClass('open');
            });

            $(window).on("scroll", function () {
                if ( $('body').hasClass('scroll-start')) {
                    if (toggleBtn.hasClass('open')) {
                        toggleBtn.toggleClass('open');
                        navMenu.toggleClass('open');
                        $('.main-overlaymenu').toggleClass("open");
                        $('.main-menu').removeClass("open-sub");
                        $('.sub-menu').removeClass("sub-open");
                    }
                    if (searchBox.hasClass('open')) {
                        searchOpen.removeClass('hide');
                        searchClose.removeClass('show');
                        searchBox.removeClass('open');
                    }
                }
            });

            $('.internal .link').on('click', function () {
                toggleBtn.toggleClass('open');
                navMenu.toggleClass('open');
                $('.main-overlaymenu').toggleClass("open");

                if (!$(this).hasClass('open')) {
                    $('.main-menu').removeClass("open-sub");
                    $('.sub-menu').removeClass("sub-open");
                }
                if (searchBox.hasClass('open')) {
                    searchOpen.removeClass('hide');
                    searchClose.removeClass('show');
                    searchBox.removeClass('open');
                }
            });

            wixiHeaderMenu();
        }
    }

    function wixiHeaderLang() {
        $('.lang-select .lang-item.active').on('click', function (e) {
            var lang = $(this),
                langselect = $('.lang-select'),
                sublang = lang.parent().find('.sub-list');

            if ( langselect.hasClass( 'lang-active' ) ) {
                langselect.removeClass( 'lang-active' );
            } else {
                langselect.addClass( 'lang-active' );
            }
            if ( sublang.hasClass( 'show' ) ) {
                sublang.removeClass( 'show' );
            } else {
                sublang.addClass( 'show' );
            }
        });

        $('.lang-select .sub-lang-item a').on('click', function (e) {

            var sublang = $(this),
                langText = sublang.text(),
                activeLangText = $('.lang-select .lang-item.active .uppercase').text(),
                sublangList = sublang.parents('.sub-list');

            sublangList.removeClass( 'show' );

            $('.lang-select .lang-item.active .uppercase').html(langText);
            sublang.html(activeLangText);
        });

        // Bind to scroll
        jQuery(window).scroll(function(){

            var sublang = $('.sub-list');
            var langselect = $('.lang-select');
            if ( langselect.hasClass( 'lang-active' ) ) {
                langselect.removeClass( 'lang-active' );
            }
            if ( sublang.hasClass( 'show' ) ) {
                sublang.removeClass( 'show' );
            }
        });
    }

    var mainProgress = document.querySelector(".loading-text-overlay");
    function changeProgress(to, time = 0.5) {
        if ( !mainProgress ){
            return;
        }
        var currentWidth = parseInt(mainProgress.style.width);
        if (!currentWidth)
        currentWidth = 5;
        mainProgress.style.transition =
        Math.abs(time * (to - currentWidth) / 100) + "s linear";
        mainProgress.style.width = to + "%";
    }

    function wixiRelatedSlider() {
        const mySwiper = $('.nt-related-post .swiper-container');
        if ( mySwiper.length ) {
            const myData= mySwiper.data( 'slider-settings' );
            const relatedSwiper = new Swiper(mySwiper, {
                slidesPerView: 'auto',
                spaceBetween: myData.gap,
                speed: myData.speed,
                autoplay: myData.autoplay,
                loop: myData.loop,
                centeredSlides: myData.center,
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 0,
                        centeredSlides: false
                    },
                    480: {
                        slidesPerView: myData.xsperview,
                        centeredSlides: false
                    },
                    768: {
                        slidesPerView: myData.smperview,
                        centeredSlides: myData.center,
                    },
                    991: {
                        slidesPerView: myData.mdperview,
                        centeredSlides: myData.center,
                    },
                    1200: {
                        slidesPerView: myData.perview,
                        centeredSlides: myData.center,
                    }
                }
            });
        }
    }

    function wixiSingleParallaxie() {

        var myParallaxie = $( '.single .parallaxie' );
        if ( myParallaxie.length ) {
            myParallaxie.parallaxie({
                speed: 0.2,
                size : 'contain'
            });
        }
    }

    /* Mouse Hover */
    function wixiMouseHover() {
        $('.team .item .img').on('mouseenter', function () {
            $(".team .item .img").addClass("filter");
            $(this).removeClass("filter");
        });

        $('.team .item .img').on('mouseleave', function () {
            $(".team .item .img").removeClass("filter");
        });
    }

    /* page Section */
    function wixiSectionBg() {
        var pageSection = $(".bg-cover, section");

        pageSection.each(function (indx) {

            var myEl = $(this),
                myBg = myEl.data("wixi-background");

            if ( myBg ) {
                myEl.css("background-image", "url(" + myBg + ")");
            }
        });
    }

    /* wixiBackToTop */
    function wixiBackToTop() {
        //Scroll back to top
        var progressPath = document.querySelector('.backtotop-wrap path');
        if ( progressPath ) {
            var pathLength = progressPath.getTotalLength();
            progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
            progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
            progressPath.style.strokeDashoffset = pathLength;
            progressPath.getBoundingClientRect();
            progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
            var updateProgress = function () {
                var scroll = $(window).scrollTop();
                var height = $(document).height() - $(window).height();
                var progress = pathLength - (scroll * pathLength / height);
                progressPath.style.strokeDashoffset = progress;
            }
            updateProgress();
            $(window).scroll(updateProgress);
            var offset = 150;
            var duration = 550;
            jQuery(window).on('scroll', function () {
                if (jQuery(this).scrollTop() > offset) {
                    jQuery('.backtotop-wrap').addClass('active-progress');
                } else {
                    jQuery('.backtotop-wrap').removeClass('active-progress');
                }
            });
            jQuery('.backtotop-wrap').on('click', function (event) {
                event.preventDefault();
                jQuery('html, body').animate({ scrollTop: 0 }, duration);
                return false;
            });
        }
    }


    /* simpleParallax*/
    function wixiSimpleParallax() {
        var imageUp = document.getElementsByClassName('thumparallax');
        var imageDown = document.getElementsByClassName('thumparallax-down');
        if ( imageUp.length || imageDown.length ) {
            new simpleParallax(imageUp, {
                delay: 1
            });
            new simpleParallax(imageDown, {
                orientation: 'down',
                delay: 1
            });
        }
    }

    // wixiHeadingSplit
     function wixiHeadingSplit() {
         $('body:not(.split-animation-none) .wixi-headig-split').each(function () {
             var myElement = $(this);
             var myId      = myElement.data( 'id' );
             var myData    = myElement.data( 'split-settings' );
             var mySplit   = myElement.find( '.elementor-heading-title' );
             if ( myElement.hasClass( 'wixi-headig-split' ) && myData ) {
                var myType = myData.type ? myData.type : 'chars';
                mySplit.addClass('wow');
                Splitting({
                    target: mySplit,
                    by: myType,
                });
             }
         });
     }

    /* Wow Animation */
    function wixiWow() {
        var wow = new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 100
        });
        wow.init();

        var wow2 = new WOW({
            boxClass: 'wow2',
            animateClass: 'animated',
            offset: 100,
            mobile: true,
            live: true
        });
        wow2.init();
    }

    /* fade slideshow  */
    function wixifadeSlideshow() {
        $(window).scroll(function () {
            var scrolled = $(this).scrollTop();
            $('.slider .caption').css({
                'transform': 'translate3d(0, ' + -(scrolled * 0.20) + 'px, 0)',
                'opacity': 1 - scrolled / 600
            });
        });
    }


    /* fade slideshow  */
    function splitHeading() {
        var splitElement = $('.nt-sidebar-inner-widget-title');
        splitElement.each(function (indx) {
            var myText = $(this).text().split(' ').slice(-1)[0];
            if( myText ) {
                $(this).html($(this).html().replace(myText,'<span class="stroke">'+myText+'<span>'));
            }
        });
    }


    function ntrUITooltip() {
        var myTooltips = $('[data-wixi-ui-tooltip]');
        if (myTooltips.length) {
            myTooltips.each(function(i, el) {
                var myTooltip = $(el);
                var myData = myTooltip.data('wixiUiTooltip');
                if (!myData) {
                    return true; // next iteration
                }
                var myPosition = {};
                var myClasses = {
                    'ui-tooltip': 'ui-corner-all ui-widget-shadow'
                };
                if (myData.position === 'top') {
                    myPosition.my = 'center bottom-25';
                    myPosition.at = 'center top';
                    myClasses = {
                        'ui-tooltip': 'ui-corner-all ui-widget-shadow is-top'
                    };
                }
                if (myData.position === 'left') {
                    myPosition.my = 'right-25 center';
                    myPosition.at = 'left center';
                    myClasses = {
                        'ui-tooltip': 'ui-corner-all ui-widget-shadow is-left'
                    };
                }
                if (myData.position === 'right') {
                    myPosition.my = 'left+25 center';
                    myPosition.at = 'right center';
                    myClasses = {
                        'ui-tooltip': 'ui-corner-all ui-widget-shadow is-right'
                    };
                }
                if (myData.position === 'bottom') {
                    myPosition.my = 'center top+25';
                    myPosition.at = 'center bottom';
                    myClasses = {
                        'ui-tooltip': 'ui-corner-all ui-widget-shadow is-bottom'
                    };
                }
                myTooltip.tooltip({
                    classes: myClasses,
                    position: myPosition,
                    items: myTooltip,
                    content: function() {
                        return myData.content;
                    }
                });
            });
        }
    }

    function ntrLightbox() {
        var myLightboxes = $('[data-wixi-lightbox]');
        if (myLightboxes.length) {
            myLightboxes.each(function(i, el) {
                var myLightbox = $(el);
                var myData = myLightbox.data('wixiLightbox');
                var myOptions = {};
                if (!myData || !myData.type) {
                    return true; // next iteration
                }
                if (myData.type === 'gallery') {
                    if (!myData.selector) {
                        return true; // next iteration
                    }
                    myOptions = {
                        delegate: myData.selector,
                        type: 'image',
                        gallery: {
                            enabled: true
                        }
                    };

                }
                if (myData.type === 'image') {
                    myOptions = {
                        type: 'image'
                    };
                }
                if (myData.type === 'iframe') {
                    myOptions = {
                        type: 'iframe'
                    };
                }
                if (myData.type === 'inline') {
                    myOptions = {
                        type: 'inline',
                    };
                }
                if (myData.type === 'modal') {
                    myOptions = {
                        type: 'inline',
                        modal: false
                    };
                }
                if (myData.type === 'ajax') {
                    myOptions = {
                        type: 'ajax',
                        overflowY: 'scroll'
                    };
                }
                myLightbox.magnificPopup(myOptions);
            });
        }
    }

    // ntrNavMenus
    function wixiNavMenus() {
        $('body:not(.elementor-page) [data-ntr-custom-header]').each(function (i, el) {
            var myHeader = $(el);
            if (myHeader.length) {
                myHeader.find('.header_nav_sub').each(function (i, eli) {
                    var $_this = $(eli);
                    $_this.find('> ul > li').each(function (i, eli) {
                        var $_this = $(eli);
                        $_this.attr( 'style', '--char-index:'+i );
                    });
                });
                if (myHeader.hasClass('is-split')) {
                    if ( $('body').hasClass('split-animation-enabled') ) {
                        Splitting({
                            target: '.button_text',
                        });
                    }
                }
                myHeader.each(function (i, ell) {
                    var myHeader2 = $(ell);
                    var myHeaderNav = myHeader2.find('.header_nav');
                    var myHeaderNavArrows = $('.header_nav_arrow', myHeaderNav);
                    var myHeaderNavToggle = $('.header_nav_toggle', myHeader);
                    var myHeaderNavClose = $('.header_nav_close', myHeader);
                    var myHeaderHandlers = {
                        navOpen: function () {
                            myHeaderNav.addClass('is-active');
                            $(document).on('click.ntrHeaderNav', function (e) {
                                if (!$(e.target).closest(myHeaderNavToggle).length) {
                                    if (!$(e.target).closest(myHeaderNav).length) {
                                        myHeaderHandlers.navClose();
                                    }
                                }
                            });
                            $(document).on('keyup.ntrHeaderNav', function (e) {
                                if (e.keyCode === 27) {
                                    myHeaderHandlers.navClose();
                                }
                            });
                        },
                        navClose: function () {
                            myHeaderNav.removeClass('is-active');
                            $(document).off('click.ntrHeaderNav');
                            $(document).off('keyup.ntrHeaderNav');
                        },
                    };

                    // Conditional Handlers
                    var myMedia = window.matchMedia('(max-width: 1199px)');
                    var myMediaHandler = function (m) {
                        if (m.matches) {
                            myHeaderNavToggle.on('click.ntrHeaderNavToggle', function (e) {
                                e.preventDefault();
                                if (myHeaderNav.hasClass('is-active')) {
                                    myHeaderHandlers.navClose();
                                } else {
                                    myHeaderHandlers.navOpen();
                                }
                            });
                            myHeaderNavClose.on('click.ntrHeaderNavClose', function (e) {
                                e.preventDefault();
                                myHeaderHandlers.navClose();
                            });
                            myHeaderNavArrows.on('click.ntrHeaderNavArrows', function (e) {
                                e.preventDefault();
                                var myArrow = $(this);
                                var myParent = myArrow.parent('li');
                                if (myParent.hasClass('is-active')) {
                                    myParent.removeClass('is-active');
                                    $('.icon', myArrow).toggleClass('is-arrow-up2 is-arrow-down2');
                                } else {
                                    myParent.addClass('is-active');
                                    $('.icon', myArrow).toggleClass('is-arrow-down2 is-arrow-up2');
                                }
                            });
                        } else {
                            // Remove Nav Events
                            $(document).off('click.ntrHeaderNav');
                            $(document).off('keyup.ntrHeaderNav');
                            myHeaderNavToggle.off('click.ntrHeaderNavToggle');
                            myHeaderNavClose.off('click.ntrHeaderNavClose');
                            myHeaderNavArrows.off('click.ntrHeaderNavArrows');
                        }
                    };
                    myMedia.addListener(myMediaHandler);
                    myMediaHandler(myMedia);

                    // Sticky
                    if (myHeader.hasClass('is-sticky')) {
                        var myWindow = $(window);
                        var myHeaderHolder = $('.header_holder', myHeader);
                        var myHeaderContainer = $('.header_container', myHeader);
                        var mystickyOffset = myHeader.attr('data-ntr-sticky-offset');
                        var myHeaderHeight = myHeaderContainer.outerHeight();
                        var mystickyOffset = myHeaderContainer.offset().top;
                        var mystickyOffsetone = mystickyOffset ? mystickyOffset : myHeaderHeight;
                        var mystickyOffsetTwo = mystickyOffset ? mystickyOffset+myHeaderHeight : 1;
                        var myHeaderTimer;
                        if (!myHeader.hasClass('is-overlay')) {
                            myHeaderHolder.css({'height': myHeaderHeight});
                        }
                        myWindow.on('scroll', function() {
                            if (myHeaderTimer) {
                                clearTimeout(myHeaderTimer);
                            }
                            //myHeaderTimer = setTimeout(function() {
                            if (myWindow.scrollTop() > mystickyOffsetone) {
                                myHeader.addClass('is-sticky-active');
                            } else if (myWindow.scrollTop() < mystickyOffsetTwo ) {
                                myHeader.removeClass('is-sticky-active');
                            }
                            //}, 200);

                        });
                    }
                });
            }
        });
    }

    function wixiAnimationFix() {
        $('body:not(.elementor-page) .elementor-invisible').each(function () {

            var myEl = $( this ),
            animData  = myEl.data('settings'),
            animName  = animData._animation,
            animDelay = animData._animation_delay;
            myEl.addClass( 'wow2 '+ animName );

            myEl.css({
                "animation-name": animName,
            });

        });
        var myWow = new WOW({
            boxClass: 'wow2',
            animateClass: 'animated',
        });
        myWow.init();
    }

    function wixiImageReveal() {

        $('.wixi-image-reveal').each(function () {
            var myEl = $( this ),
            animData = myEl.data('image-reveal-settings'),
            pos = animData.orientation,
            offset = animData.offset,
            once = animData.once,
            delay = animData.delay;
            myEl.find('.elementor-image')
            .addClass('reveal-holder')
            .attr({"data-aos":"reveal-item","data-aos-delay": delay,"data-aos-offset": offset,"data-aos-once": once})
            .prepend( '<div class="reveal-block '+pos+'" data-aos="reveal-'+pos+'"></div>' );
            myEl.find('.reveal-block')
            .attr({"data-aos-delay": delay,"data-aos-offset": offset,"data-aos-once": once});
        });
        if( $('.wixi-image-reveal').size() ) {
            AOS.init({
                duration: 500,
                easing: 'ease-out-quart',
                mirror: true,
            });
        }
    }

    // wixiVegasSlider Preview function
    function wixiVegasSlider() {
        $(".home-slider-vegas-wrapper").each(function (i, el) {
            var myEl         = jQuery(el),
                myVegasId    = myEl.find('.nt-home-slider-vegas').attr('id'),
                myVegas      = $( '#' + myVegasId ),
                myPrev       = myEl.find('.vegas-control-prev'),
                myNext       = myEl.find('.vegas-control-next'),
                mySettings   = myEl.find('.nt-home-slider-vegas').data('slider-settings'),
                myContent    = myEl.find('.nt-vegas-slide-content'),
                myCounter    = myEl.find('.nt-vegas-slide-counter'),
                mySocials    = myEl.find('.social .icon');

            myEl.parents('.elementor-widget-wixi-vegas-slider').removeClass('elementor-invisible');

            if( mySettings.slides.length ) {
                var slides = mySettings.slides,
                    anim   = mySettings.animation ? mySettings.animation : 'kenburns',
                    trans  = mySettings.transition ? mySettings.transition : 'slideLeft',
                    delay  = mySettings.delay ? mySettings.delay : 7000,
                    dur    = mySettings.duration ? mySettings.duration : 2000,
                    autoply= mySettings.autoplay,
                    shuf   = 'yes' == mySettings.shuffle ? true : false,
                    timer  = 'yes' == mySettings.timer ? true : false,
                    over   = 'none' != mySettings.overlay ? true : false;

                myVegas.vegas({
                    autoplay: autoply,
                    delay: delay,
                    timer: timer,
                    shuffle: shuf,
                    animation: anim,
                    transition: trans,
                    transitionDuration: dur,
                    overlay: over,
                    slides: mySettings.slides,
                    init: function (globalSettings) {
                        myContent.eq(0).addClass('active');
                        var total = myContent.size();
                        myCounter.find('.total').html(total);
                    },
                    walk: function (index, slideSettings) {
                        myContent.removeClass('active').eq(index).addClass('active');
                        var current = index +1;
                        myCounter.find('.current').html(current);
                    },
                    end: function (index, slideSettings) {
                    }
                });

                myPrev.on('click', function () {
                    myVegas.vegas('previous');
                });

                myNext.on('click', function () {
                    myVegas.vegas('next');
                });

                mySocials.on( 'click', function () {
                    $( this ).parent().toggleClass( "active" );
                });

            }
        });
    }
    // wixiVegasTemplate Preview function
    function wixiVegasTemplate() {
        $(".slider-vegas-template-wrapper").each(function () {
            var myEl         = $(this),
                myVegasId    = myEl.find('.slider-vegas-template').attr('id'),
                myVegas      = $( '#' + myVegasId ),
                myPrev       = myEl.find('.vegas-control-prev'),
                myNext       = myEl.find('.vegas-control-next'),
                mySettings   = myEl.find('.slider-vegas-template').data('slider-settings'),
                myContent    = myEl.find('.elementor-top-section'),
                myCounter    = myEl.find('.nt-vegas-slide-counter'),
                mySocials    = myEl.find('.social .icon');

            myEl.parents('.elementor-widget-wixi-vegas-template').removeClass('elementor-invisible');

            var mySlides = [];
            myEl.find( '.elementor-top-section' ).each( function(){
                var mySlide = $(this),
                    bgImage = mySlide.css('background-image');
                    bgImage = bgImage.replace(/.*\s?url\([\'\"]?/, '').replace(/[\'\"]?\).*/, ''),
                    bgImage = {"src": bgImage};

                mySlides.push( bgImage );
                mySlide.addClass('vegas-slide-template-section').css({
                    'background-image' : 'none',
                    'background-color' : 'transparent',
                });
            });

            if( mySlides.length ) {
                var anim  = mySettings.animation ? mySettings.animation : 'kenburns',
                    trans = mySettings.transition ? mySettings.transition : 'slideLeft',
                    delay = mySettings.delay ? mySettings.delay : 7000,
                    dur   = mySettings.duration ? mySettings.duration : 2000,
                    aply  = mySettings.autoplay,
                    shuf  = 'yes' == mySettings.shuffle ? true : false,
                    timer = 'yes' == mySettings.timer ? true : false,
                    over  = 'none' != mySettings.overlay ? true : false;

                myVegas.vegas({
                    autoplay: aply,
                    delay: delay,
                    timer: timer,
                    shuffle: shuf,
                    animation: anim,
                    transition: trans,
                    transitionDuration: dur,
                    overlay: over,
                    slides: mySlides,
                    init: function (globalSettings) {
                        myContent.eq(0).addClass('active');
                        var total = myContent.size();
                        myCounter.find('.total').html(total);
                        myContent.find( '[data-split-settings]' ).each( function(){
                            var mySplit = $(this),
                                myData = mySplit.data('split-settings'),
                                myAnim = myData.animation;
                            myContent.find('.elementor-heading-title').removeClass('wow animated');
                        });
                        myContent.each( function(){
                            var myElAnim = $(this).find( '.elementor-element[data-settings]' ),
                                myData = myElAnim.data('settings'),
                                myAnim = myData && myData._animation ? myData._animation : '',
                                myDelay = myData && myData._animation_delay ? myData._animation_delay / 1000 : '';

                            if (myData && myAnim ) {
                                myElAnim.removeClass( 'animated' );
                                $(this).find(myElAnim).css({
                                    'animation-delay' : myDelay+'s',
                                });
                            }
                        });
                    },
                    walk: function (index, slideSettings) {

                        myContent.removeClass('active').eq(index).addClass('active');

                        myContent.find( '[data-split-settings]' ).each( function(){
                            var mySplit = $(this),
                                myData = mySplit.data('split-settings'),
                                myAnim = myData.animation;

                                myContent.find('.elementor-heading-title').removeClass('animated');
                                myContent.eq(index).find('.elementor-heading-title').addClass('animated');
                        });

                        myContent.each( function(){
                            var myElAnim = $(this).find( '.elementor-element[data-settings]' ),
                                myData = myElAnim.data('settings'),
                                myAnim = myData && myData._animation ? myData._animation : '',
                                myDelay = myData && myData._animation_delay ? myData._animation_delay / 1000 : '';

                            if (myData && myAnim ) {
                                myElAnim.removeClass( 'animated ' + myAnim );
                                myContent.eq(index).find(myElAnim).addClass('animated ' + myAnim);
                            }
                        });
                        var current = index +1;
                        myCounter.find('.current').html(current);
                    },
                    end: function (index, slideSettings) {
                    }
                });

                myPrev.on('click', function () {
                    myVegas.vegas('previous');
                });

                myNext.on('click', function () {
                    myVegas.vegas('next');
                });

            }
        });
    }
   // wixiFixedSection
    function wixiFixedSection() {
        var myFixedSection = $('.wixi-section-fixed-yes');
        if ( myFixedSection.size() ) {
            myFixedSection.parents('[data-elementor-type="section"]').addClass( 'wixi-section-fixed wixi-custom-header' );
            $(window).on("scroll", function () {
                var bodyScroll = $(window).scrollTop();
                if ( bodyScroll>100 ) {
                    myFixedSection.parents('[data-elementor-type="section"]').addClass( 'section-fixed-active' );
                } else {
                   myFixedSection.parents('[data-elementor-type="section"]').removeClass( 'section-fixed-active' );
                }
            });
        }
    }

    class ShapeOverlays {
        constructor(elm) {
            this.elm = elm;
            this.path = elm.querySelectorAll('path');
            this.numPoints = 18;
            this.duration = 600;
            this.delayPointsArray = [];
            this.delayPointsMax = 300;
            this.delayPerPath = 100;
            this.timeStart = Date.now();
            this.isOpened = false;
            this.isAnimating = false;
        }
        toggle() {
            this.isAnimating = true;
            const range = 4 * Math.random() + 6;
            for (var i = 0; i < this.numPoints; i++) {
                const radian = i / (this.numPoints - 1) * Math.PI;
                this.delayPointsArray[i] = (Math.sin(-radian) + Math.sin(-radian * range) + 2) / 4 * this.delayPointsMax;
            }
            if (this.isOpened === false) {
                this.open();
            } else {
                this.close();
            }
        }
        open() {
            this.isOpened = true;
            this.elm.classList.add('is-opened');
            this.timeStart = Date.now();
            this.renderLoop();
        }
        close() {
            this.isOpened = false;
            this.elm.classList.remove('is-opened');
            this.timeStart = Date.now();
            this.renderLoop();
        }
        updatePath(time) {
            const points = [];
            for (var i = 0; i < this.numPoints + 1; i++) {
                points[i] = ease.cubicInOut(Math.min(Math.max(time - this.delayPointsArray[i], 0) / this.duration, 1)) * 100
            }

            let str = '';
            str += (this.isOpened) ? 'M 0 0 V ' + points[0] : 'M 0 ' + points[0];
            for (var i = 0; i < this.numPoints - 1; i++) {
                const p = (i + 1) / (this.numPoints - 1) * 100;
                const cp = p - (1 / (this.numPoints - 1) * 100) / 2;
                str += ' C ' + cp +' '+ points[i] +' '+ cp +' '+ points[i + 1] +' '+ p +' '+ points[i + 1];
            }
            str += (this.isOpened) ? 'V 0 H 0' : 'V 100 H 0';
            return str;
        }
        render() {
            if (this.isOpened) {
                for (var i = 0; i < this.path.length; i++) {
                    this.path[i].setAttribute('d', this.updatePath(Date.now() - (this.timeStart + this.delayPerPath * i)));
                }
            } else {
                for (var i = 0; i < this.path.length; i++) {
                    this.path[i].setAttribute('d', this.updatePath(Date.now() - (this.timeStart + this.delayPerPath * (this.path.length - i - 1))));
                }
            }
        }
        renderLoop() {
            this.render();
            if (Date.now() - this.timeStart < this.duration + this.delayPerPath * (this.path.length - 1) + this.delayPointsMax) {
                requestAnimationFrame(() => {
                    this.renderLoop();
                });
            }
            else {
                this.isAnimating = false;
            }
        }
    }
    class ShapeOverlays2 {
        constructor(elm) {
            this.elm = elm;
            this.path = elm.querySelectorAll('path');
            this.numPoints = 4;
            this.duration = 800;
            this.delayPointsArray = [];
            this.delayPointsMax = 180;
            this.delayPerPath = 70;
            this.timeStart = Date.now();
            this.isOpened = false;
            this.isAnimating = false;
        }
        toggle() {
            this.isAnimating = true;
            const range = Math.random() * Math.PI * 2;
            for (var i = 0; i < this.numPoints; i++) {
                const radian = (i / (this.numPoints - 1)) * Math.PI * 2;
                this.delayPointsArray[i] = (Math.sin(radian + range) + 1) / 2 * this.delayPointsMax;
            }
            if (this.isOpened === false) {
                this.open();
            } else {
                this.close();
            }
        }
        open() {
            this.isOpened = true;
            this.elm.classList.add('is-opened');
            this.timeStart = Date.now();
            this.renderLoop();
        }
        close() {
            this.isOpened = false;
            this.elm.classList.remove('is-opened');
            this.timeStart = Date.now();
            this.renderLoop();
        }
        updatePath(time) {
            const points = [];
            for (var i = 0; i < this.numPoints; i++) {
                points[i] = ease.cubicInOut(Math.min(Math.max(time - this.delayPointsArray[i], 0) / this.duration, 1)) * 100
            }

            let str = '';
            str += (this.isOpened) ? 'M 0 0 V ' + points[0] : 'M 0 ' + points[0];
            for (var i = 0; i < this.numPoints - 1; i++) {
                const p = (i + 1) / (this.numPoints - 1) * 100;
                const cp = p - (1 / (this.numPoints - 1) * 100) / 2;
                str += ' C ' + cp +' '+ points[i] +' '+ cp +' '+ points[i + 1] +' '+ p +' '+ points[i + 1];
            }
            str += (this.isOpened) ? 'V 0 H 0' : 'V 100 H 0';
            return str;
        }
        render() {
            if (this.isOpened) {
                for (var i = 0; i < this.path.length; i++) {
                    this.path[i].setAttribute('d', this.updatePath(Date.now() - (this.timeStart + this.delayPerPath * i)));
                }
            } else {
                for (var i = 0; i < this.path.length; i++) {
                    this.path[i].setAttribute('d', this.updatePath(Date.now() - (this.timeStart + this.delayPerPath * (this.path.length - i - 1))));
                }
            }
        }
        renderLoop() {
            this.render();
            if (Date.now() - this.timeStart < this.duration + this.delayPerPath * (this.path.length - 1) + this.delayPointsMax) {
                requestAnimationFrame(() => {
                    this.renderLoop();
                });
            }
            else {
                this.isAnimating = false;
            }
        }
    }
    class ShapeOverlays3 {
        constructor(elm) {
            this.elm = elm;
            this.path = elm.querySelectorAll('path');
            this.numPoints = 2;
            this.duration = 600;
            this.delayPointsArray = [];
            this.delayPointsMax = 0;
            this.delayPerPath = 200;
            this.timeStart = Date.now();
            this.isOpened = false;
            this.isAnimating = false;
        }
        toggle() {
            this.isAnimating = true;
            for (var i = 0; i < this.numPoints; i++) {
                this.delayPointsArray[i] = 0;
            }
            if (this.isOpened === false) {
                this.open();
            } else {
                this.close();
            }
        }
        open() {
            this.isOpened = true;
            this.elm.classList.add('is-opened');
            this.timeStart = Date.now();
            this.renderLoop();
        }
        close() {
            this.isOpened = false;
            this.elm.classList.remove('is-opened');
            this.timeStart = Date.now();
            this.renderLoop();
        }
        updatePath(time) {
            const points = [];
            for (var i = 0; i < this.numPoints; i++) {
                const thisEase = this.isOpened ?
                (i == 1) ? ease.cubicOut : ease.cubicInOut:
                (i == 1) ? ease.cubicInOut : ease.cubicOut;
                points[i] = thisEase(Math.min(Math.max(time - this.delayPointsArray[i], 0) / this.duration, 1)) * 100
            }

            let str = '';
            str += (this.isOpened) ? 'M 0 0 V ' + points[0] : 'M 0 ' + points[0];
            for ( var i = 0; i < this.numPoints - 1; i++ ) {
                var p = (i + 1) / (this.numPoints - 1) * 100;
                var cp = p - (1 / (this.numPoints - 1) * 100) / 2;
                str += ' C ' + cp +' '+ points[i] +' '+ cp +' '+ points[i + 1] +' '+ p +' '+ points[i + 1];
            }
            str += (this.isOpened) ? 'V 0 H 0' : 'V 100 H 0';
            return str;
        }
        render() {
            if (this.isOpened) {
                for (var i = 0; i < this.path.length; i++) {
                    this.path[i].setAttribute('d', this.updatePath(Date.now() - (this.timeStart + this.delayPerPath * i)));
                }
            } else {
                for (var i = 0; i < this.path.length; i++) {
                    this.path[i].setAttribute('d', this.updatePath(Date.now() - (this.timeStart + this.delayPerPath * (this.path.length - i - 1))));
                }
            }
        }
        renderLoop() {
            this.render();
            if (Date.now() - this.timeStart < this.duration + this.delayPerPath * (this.path.length - 1) + this.delayPointsMax) {
                requestAnimationFrame(() => {
                    this.renderLoop();
                });
            }
            else {
                this.isAnimating = false;
            }
        }
    }
    class ShapeOverlays4 {
        constructor(elm) {
            this.elm = elm;
            this.path = elm.querySelectorAll('path');
            this.numPoints = 4;
            this.duration = 1000;
            this.delayPointsArray = [];
            this.delayPointsMax = 0;
            this.delayPerPath = 60;
            this.timeStart = Date.now();
            this.isOpened = false;
            this.isAnimating = false;
        }
        toggle() {
            this.isAnimating = true;
            for (var i = 0; i < this.numPoints; i++) {
                this.delayPointsArray[i] = 0;
            }
            if (this.isOpened === false) {
                this.open();
            } else {
                this.close();
            }
        }
        open() {
            this.isOpened = true;
            this.elm.classList.add('is-opened');
            this.timeStart = Date.now();
            this.renderLoop();
        }
        close() {
            this.isOpened = false;
            this.elm.classList.remove('is-opened');
            this.timeStart = Date.now();
            this.renderLoop();
        }
        updatePath(time) {
            const points = [];
            for (var i = 0; i < this.numPoints; i++) {
                const thisEase = (i % 2 === 1) ? ease.sineOut : ease.exponentialInOut;
                points[i] = (1 - thisEase(Math.min(Math.max(time - this.delayPointsArray[i], 0) / this.duration, 1))) * 100
            }

            let str = '';
            str += (this.isOpened) ? 'M 0 0 H ' + points[0] : 'M ' + points[0] + ' 0';
            for (var i = 0; i < this.numPoints - 1; i++) {
                const p = (i + 1) / (this.numPoints - 1) * 100;
                const cp = p - (1 / (this.numPoints - 1) * 100) / 2;
                str += ' C ' + points[i] +' '+ cp +' '+ points[i + 1] +' '+ cp +' '+ points[i + 1] +' '+ p;
            }
            str += (this.isOpened) ? 'H 100 V 0' : 'H 0 V 0';
            return str;
        }
        render() {
            if (this.isOpened) {
                for (var i = 0; i < this.path.length; i++) {
                    this.path[i].setAttribute('d', this.updatePath(Date.now() - (this.timeStart + this.delayPerPath * i)));
                }
            } else {
                for (var i = 0; i < this.path.length; i++) {
                    this.path[i].setAttribute('d', this.updatePath(Date.now() - (this.timeStart + this.delayPerPath * (this.path.length - i - 1))));
                }
            }
        }
        renderLoop() {
            this.render();
            if (Date.now() - this.timeStart < this.duration + this.delayPerPath * (this.path.length - 1) + this.delayPointsMax) {
                requestAnimationFrame(() => {
                    this.renderLoop();
                });
            }
            else {
                this.isAnimating = false;
            }
        }
    }

    function shapeOverlaysMenu() {
        const elmNavi = document.querySelector('.wixi-shape-overlay-menu');
        const elmHamburger = document.querySelector('.hamburger');
        const gNavItems = document.querySelectorAll('.global-menu__item');
        const elmOverlay = document.querySelector('.shape-overlays');
        var overlay = new ShapeOverlays(elmOverlay);

        if ( $(elmNavi).hasClass('demo-2') ){
            overlay = new ShapeOverlays2(elmOverlay);
        }
        if ( $(elmNavi).hasClass('demo-3') ){
            overlay = new ShapeOverlays3(elmOverlay);
        }
        if ( $(elmNavi).hasClass('demo-4') ){
            overlay = new ShapeOverlays4(elmOverlay);
        }

        elmHamburger.addEventListener('click', () => {
            if (overlay.isAnimating) {
                return false;
            }
            overlay.toggle();
            if (overlay.isOpened === true) {
                elmNavi.classList.add('is-opened-navi');
                elmHamburger.classList.add('is-opened-navi');
                for (var i = 0; i < gNavItems.length; i++) {
                    gNavItems[i].classList.add('is-opened');
                }
            } else {

                for (var i = 0; i < gNavItems.length; i++) {
                    gNavItems[i].classList.remove('is-opened');
                }
                setTimeout(function(){
                elmNavi.classList.remove('is-opened-navi');
                elmHamburger.classList.remove('is-opened-navi');
                }, 1000);
            }
        });

        for (var i = 0; i < gNavItems.length; i++) {
            gNavItems[i].addEventListener('click', () => {
                if (overlay.isAnimating) {
                    return false;
                }
                overlay.toggle();
                if (overlay.isOpened === true) {
                    elmNavi.classList.add('is-opened-navi');
                    elmHamburger.classList.add('is-opened-navi');
                    for (var i = 0; i < gNavItems.length; i++) {
                        gNavItems[i].classList.add('is-opened');
                    }
                } else {

                    for (var i = 0; i < gNavItems.length; i++) {
                        gNavItems[i].classList.remove('is-opened');
                    }
                    setTimeout(function(){
                    elmNavi.classList.remove('is-opened-navi');
                    elmHamburger.classList.remove('is-opened-navi');
                    }, 1000);
                }
            });
        }
    }

    function wixiCustomScrollbar() {
        if( ! $('.page-template-locomotive-pag').size() ) {
            if( $('#main-scrollbar').size() ) {
                $('html').addClass('has-custom--scrollbar');
                var myScrollData= $('#main-scrollbar').data('wixi-scrollbar');
                SmoothScroll(
                    {
                        // Scrolling Core
                        animationTime    : myScrollData.time, // [ms]
                        stepSize         : myScrollData.step, // [px]
                        // Acceleration
                        accelerationDelta : myScrollData.delta,  // 50
                        accelerationMax   : myScrollData.max,   // 3
                        // Keyboard Settings
                        keyboardSupport   : true,  // option
                        arrowScroll       : 10,    // [px]
                        // Pulse (less tweakable)
                        // ratio of "tail" to "acceleration"
                        pulseAlgorithm   : true,
                        pulseScale       : 4,
                        pulseNormalize   : 1,
                        // Other
                        touchpadSupport   : false, // ignore touchpad by default
                        fixedBackground   : true,
                        excluded          : ''
                    }
                );
            }
        }
    }
    /* wixiBgImage */
    function wixiBgImage() {
        $( '[data-wixi-bg-src]' ).each(function () {
            var myBg  = $( this ),
                mySrc = myBg.data('wixi-bg-src');
            if ( mySrc ) {
                myBg.css( 'background-image', 'url(' + mySrc + ')' );
            }
        });
    }

    $( document ).ready( function() {
        $('a').on('click', function () {
           $(window).on('beforeunload', function(){
                $('body').addClass('page-transition-start');
            });
        });

        // add video support on mobile device for vegas slider
        if( $(".home-slider-vegas-wrapper").size() ) {
            $.vegas.isVideoCompatible = function () {
                return true;
            }
        }
        if ( $(window).width() <= 1024 ) {
            $('body').removeClass('nt-desktop').addClass('nt-mobile');
        }else {
            $('body').removeClass('nt-mobile').addClass('nt-desktop');
        }

        $(window).on('resize', function () {
            if ( $(window).width() <= 1024 ) {
                $('body').removeClass('nt-desktop').addClass('nt-mobile');
            }else {
                $('body').removeClass('nt-mobile').addClass('nt-desktop');
            }
        });

        wixiHeaderOverlay();
        wixiSidebarMenu();
        wixiRelatedSlider();
        wixiMouseHover();
        wixiSectionBg();
        wixiBackToTop();
        wixifadeSlideshow();
        ntrUITooltip();
        ntrLightbox();
        wixiSingleParallaxie();
        wixiAnimationFix();
        wixiImageReveal();
        wixiNavMenus();
        wixiVegasSlider();
        wixiVegasTemplate();
        wixiCustomScrollbar();
        wixiHeadingSplit();
        wixiFixedSection();
        wixiHeaderLang();
        if ( $('.wixi-shape-overlay-menu').length){
            shapeOverlaysMenu();
        }

        /* ===============================  Preloader page  =============================== */
        if ( $('body').hasClass('preloader-on') && $('body').hasClass('preloader-default') ) {
            var paceOptions = {
                ajax: true,
                document: true,
                eventLag: false
            };

            Pace.on('done', function () {

                $('#preloader').addClass("isdone");
                $('.loading-text').addClass("isdone");
            });
        }
    });

    // === window When Loading === //
    $( window ).on("load", function () {
        wixiBgImage();
        wixiWow();
        if ( $('body').hasClass('split-animation-enabled') ) {
            if ( $('[data-splitting]').size() ) {
                Splitting();
            }
        }
        wixiSimpleParallax();
        changeProgress(100, 0.5);
    });

})(window, document, jQuery);
