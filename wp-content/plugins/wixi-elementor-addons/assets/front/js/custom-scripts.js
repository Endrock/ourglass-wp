/* NT Addons for Elementor v1.0 */

!(function ($) {

    /* homeSlider */
    function wixiHomeSlider($scope, $) {
        $scope.find('.home-slider').each(function () {
            var mySlider   = $( this ),
                myData     = mySlider.data( 'slider-settings' ),
                mySocials  = mySlider.find('.social .icon'),
                myspeed    = myData.speed,
                myarrows   = myData.arrows,
                myparallax = myData.parallax,
                myautoplay = myData.autoplay,
                myloop     = myData.loop,
                parallaxSlider;

            var parallaxSliderOptions = {
                speed      : myspeed,
                autoplay   : myautoplay,
                parallax   : myparallax,
                loop       : myloop,
                pagination : {
                    el: '.slider .parallax-slider .swiper-pagination',
                    clickable: true
                },
                on: {
                    init: function () {
                        var swiper = this;
                        for ( var i = 0; i < swiper.slides.length; i++ ) {
                            $( swiper.slides[i] ).find( '.bg-cover' ).attr({ 'data-swiper-parallax': 0.75 * swiper.width });
                        }
                    },
                    resize: function () {
                        this.update();
                    }
                },
                pagination: {
                    el: '.slider .parallax-slider .swiper-pagination',
                    type: 'fraction',
                },
                navigation: {
                    nextEl: '.slider .parallax-slider .next-ctrl',
                    prevEl: '.slider .parallax-slider .prev-ctrl'
                }
            };
            parallaxSlider = new Swiper( '.slider .parallax-slider', parallaxSliderOptions );

            mySocials.on( 'click', function () {
                $( this ).parent().toggleClass( "active" );
            });

            var myWin = $(window);
            var myWinH = myWin.height();
            if ( mySlider.hasClass('fixed-slider') ) {
                myWin.on('scroll', function() {
                    var bodyScroll = myWin.scrollTop();
                    var myFixed = mySlider.hasClass('fixed-slider')
                    if ( bodyScroll >= myWinH ) {
                            mySlider.removeClass('fixed-slider');
                    } else {
                        mySlider.addClass('fixed-slider');
                    }
                });
            }
        });
    }

    /* wixiOnepage */
    function wixiOnepage($scope, $) {
        $scope.find('.home-onepage').each(function () {
            var mySlider     = $( this ),
                myPSlider    = mySlider.find( '.parallax-slider-two' ),
                mySocials    = myPSlider.find( '.social .icon' ),
                mySplitText  = mySlider.find( '.wixi-headig-split .elementor-heading-title' ),
                myInvisible  = mySlider.find( '.elementor-invisible' ),
                mySlide      = myPSlider.find( '.elementor-top-section' ),
                myWrapper    = myPSlider.find( '.swiper-wrapper' ),
                myPage       = mySlider.find( '[data-elementor-type="page"]' ),
                myPageClass  = mySlider.find( '[data-elementor-type="page"]' ).attr( 'class' ),
                myPagination = myPSlider.find( '.swiper-pagination' ),
                myScrollbar  = myPSlider.find( '.swiper-scrollbar' ),
                myNextEl     = myPSlider.find( '.next-ctrl' ),
                myPrevEl     = myPSlider.find( '.prev-ctrl' ),
                myThumbs     = mySlider.find( '.gallery-thumbs' ),
                myText       = mySlider.find( '.gallery-text' ),
                myData       = mySlider.data( 'slider-settings' ),
                myDestroy    = myData.destroy,
                myDirection  = myData.direction,
                mySpeed      = myData.speed,
                myWhell      = myData.mousewheel,
                myParallax   = myData.parallax,
                myThumb      = myData.thumbs,
                myAutoplay   = myData.autoplay,
                myLoop       = myData.loop,
                thumbs       = false,
                pagination   = false,
                navigation   = false,
                scrollbar    = false,
                parallaxSlider,
                myThumbsNav,
                myTextNav,
                myVideoMuteYoutube,
                myVideoMuteVimeo,
                myVideoHtml,
                myEqualizer,
                windowWidth  = window.innerWidth,
                getdirection = windowWidth <= 1024 ? 'horizontal' : myDirection,
                getmousewheel= windowWidth <= 1024 ? false : myWhell,
                getmobile    = windowWidth <= 1024 ? true : false;
                getmobilee   = 'true' == myDestroy ? getmobile : false;

            function getDirection() {
                return getdirection;
            };
            function getMousewheel() {
                return getmousewheel;
            };

            if ( mySlider.hasClass('video-unmute') ) {
                myVideoMuteYoutube = 'mute=0';
                myVideoMuteVimeo = 'muted=0';
                myVideoHtml = 'muted';
                myEqualizer = '<div class="equaliser-container"><ol class="equaliser-column"><li class="colour-bar"></li></ol><ol class="equaliser-column"><li class="colour-bar"></li></ol><ol class="equaliser-column"><li class="colour-bar"></li></ol><ol class="equaliser-column"><li class="colour-bar"></li></ol><ol class="equaliser-column"><li class="colour-bar"></li></ol></div>';
            } else {
                myVideoMuteYoutube = 'mute=1';
                myVideoMuteVimeo = 'muted=1';
            }

            if ( false == getmobilee ) {

                $( 'html' ).addClass( 'betakit-vh-100' );
                $( 'body' ).addClass( 'betakit-vh-100' );

                mySlider.addClass( myPageClass );

                mySlide.each( function () {

                    if ( true == myParallax ) {

                        $( this ).addClass( 'bg-cover' ).wrap( '<div class="swiper-slide"></div>' );

                    } else {

                        $( this ).addClass( 'swiper-slide' );

                    }

                    var html_video,
                        video = $( this ).data('wixi-bg-video'),
                        provider = video ? video.provider : '',
                        videoid = video ? video.video_id : '',
                        videocontainer = $( this ).find('.elementor-background-video-container');

                    if ( videoid.length ) {

                        videocontainer.find('div.elementor-background-video-embed').remove();

                        if ( 'vimeo' == provider ) {
                            html_video = '<iframe class="elementor-background-embed-video vimeo-video" title="vimeo Video Player" src="https://player.vimeo.com/video/'+video.video_id+'?autoplay=1&loop=1&autopause=0&'+myVideoMuteVimeo+'" allow="autoplay; fullscreen" webkitallowfullscreen mozallowfullscreen allowfullscreen frameborder="0" data-ready="true" width="640" height="360"></iframe>'+myEqualizer;
                        }

                        if ( 'youtube' == provider ) {
                            html_video = '<iframe class="elementor-background-embed-video youtube-video" title="youtube Video Player" src="https://www.youtube.com/embed/'+video.video_id+'?controls=0&rel=0&autoplay=1&playsinline=1&enablejsapi=1&version=3&playerapiid=ytplayer&'+myVideoMuteYoutube+'" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" webkitallowfullscreen mozallowfullscreen allowfullscreen frameborder="0" width="640" height="360"></iframe>'+myEqualizer;
                        }
                        if ( 'hosted' == provider ) {
                            videocontainer.find('video:first-child').remove();
                            html_video = '<video class="elementor-background-video-hosted elementor-html5-video video-hosted" autoplay '+myVideoHtml+' playsinline loop src="'+video.video_id+'"></video>'+myEqualizer;
                        }

                        videocontainer.prepend( html_video );
                    }

                });

                myPSlider.find( '.swiper-slide' ).wrapAll( '<div class="swiper-wrapper"></div>' );

                myPSlider.find( '.swiper-wrapper' ).prependTo( myPSlider );

                myPage.remove();

                mySplitText.each( function () {
                    var $this = $( this );
                    $this.addClass('wow');
                    Splitting({
                      target: $this,
                    });
                });

                myInvisible.each( function () {

                    var $this     = $( this ),
                        animData  = $this.data('settings'),
                        animDelay = animData._animation_delay;

                    $this.css( 'animation-delay', animDelay + 'ms');
                    $this.removeClass( 'elementor-invisible' ).addClass( 'has-def-animation' );
                });

                if ( myData.pagination ) {

                    if ( 'dots' == myData.pagination ) {

                        pagination = {
                            el           : myPagination,
                            clickable    : true,
                            renderBullet : function ( index, className ) {
                                return '<span class="nav__item ' + className + '"><svg class="nav__icon"><use xlink:href="#icon-circle"></use></svg></span>';
                            }
                        }

                    } else if ( 'number' == myData.pagination ) {

                        pagination = {
                            el           : myPagination,
                            clickable    : true,
                            renderBullet : function ( index, className ) {
                                return '<span class="nav__item ' + className + '"><span class="number__item">' + ( index + 1 ) + '</span><svg class="nav__icon"><use xlink:href="#icon-circle"></use></svg></span>';
                            }
                        };

                    } else if ( 'thumb' == myData.pagination ) {

                        myThumbsNav = new Swiper( myThumbs, {
                            spaceBetween               : 10,
                            slidesPerView              : 'auto',
                            centeredSlides             : false,
                            watchOverflow              : false,
                            touchRatio                 : 0.2,
                            slideToClickedSlide        : true,
                            virtualTranslate           : false,
                            freeMode                   : false,
                            speed                      : 1000,
                            autoplay                   : false,
                            loop                       : false,
                            releaseOnEdges             : true,
                            mousewheel                 : getMousewheel(),
                            direction                  : getDirection(),
                            watchSlidesVisibility      : true,
                            handleElementorBreakpoints : true,
                            observer                   : true,
                            observeParents             : true,
                            on                         : {
                                resize: function () {
                                    myThumbsNav.changeDirection( getDirection() );
                                }
                            }
                        });

                        thumbs = {
                          swiper : myThumbsNav
                        }

                        pagination = {
                            el   : myPagination,
                            type : 'fraction'
                        }

                    } else if ( 'custom' == myData.pagination ) {

                        var myTextNav = new Swiper( myText, {
                            spaceBetween               : 10,
                            slidesPerView              : 'auto',
                            centeredSlides             : false,
                            watchOverflow              : false,
                            touchRatio                 : 0.2,
                            slideToClickedSlide        : true,
                            virtualTranslate           : false,
                            freeMode                   : false,
                            speed                      : 1000,
                            autoplay                   : false,
                            loop                       : false,
                            releaseOnEdges             : true,
                            mousewheel                 : getMousewheel(),
                            direction                  : getDirection(),
                            watchSlidesVisibility      : true,
                            handleElementorBreakpoints : true,
                            on                         : {
                                resize: function () {
                                    myTextNav.changeDirection( getDirection() );
                                }
                            }
                        });

                        thumbs = {
                          swiper : myTextNav
                        }

                        pagination = {
                            el   : myPagination,
                            type : 'fraction'
                        }

                    } else {

                        pagination = {
                            el   : myPagination,
                            type : 'fraction'
                        }

                    }
                }

                if ( true == myData.navigation && 'thumbs' != myData.pagination && 'custom' != myData.pagination ) {
                    navigation = {
                        nextEl: myNextEl,
                        prevEl: myPrevEl
                    };
                } else {

                    navigation = false;
                }

                if ( true == myData.scrollbar && 'thumbs' != myData.pagination && 'custom' != myData.pagination ) {
                    scrollbar = {
                      el  : myScrollbar,
                      hide: false,
                  };
                } else {

                    scrollbar = false;
                }

                var parallaxSliderOptions = {
                    speed                       : mySpeed,
                    parallax                    : myParallax,
                    autoplay                    : myAutoplay,
                    loop                        : myLoop,
                    releaseOnEdges              : true,
                    mousewheel                  : getMousewheel(),
                    allowTouchMove              : true,
                    direction                   : getDirection(),
                    watchSlidesVisibility       : true,
                    handleElementorBreakpoints  : true,
                    observer                    : true,
                    on: {
                        init: function () {
                            var swiper = this;
                            for ( var i = 0; i < swiper.slides.length; i++ ) {
                                $( swiper.slides[i] ).find( '.bg-cover' ).attr( { 'data-swiper-parallax': 0.75 * swiper.height } );
                            }
                            setTimeout(function(){
                                mySlider.find( '.swiper-slide:not(:first-child)' ).each(function () {

                                    var iframe = $( this ).find('iframe');
                                    var vid = $( this ).find('.video-hosted');
                                    if ( iframe.size() && iframe.hasClass('youtube-video') ) {
                                        iframe[0].contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
                                    }
                                    if ( iframe.size() && iframe.hasClass('vimeo-video') ) {
                                        iframe[0].contentWindow.postMessage('{"method":"pause"}', '*');
                                    }
                                    if ( vid.size() ) {
                                        vid.get(0).pause();
                                    }
                                });
                            }, 2000);

                        },
                        slideChange: function () {

                            var activeSlid = $( '.swiper-slide-visible .has-def-animation' );
                            var inactiveSlid = $( '.swiper-slide:not(.swiper-slide-visible) .has-def-animation' );
                            activeSlid.removeClass( 'animated' );

                            inactiveSlid.each(function () {
                                var $this = $( this ),
                                    animData = $this.data('settings'),
                                    anim = animData._animation;
                                if ( 'undefined' === typeof animData._animation ) {
                                    anim = animData.animation;
                                }

                                $this.removeClass( 'animated ' + anim );

                            });

                            activeSlid.each(function () {
                                var $this = $( this ),
                                    animData = $this.data( 'settings' ),
                                    anim = animData._animation;
                                if ( 'undefined' === typeof animData._animation ) {
                                    anim = animData.animation;
                                }
                                $this.addClass( 'animated ' + anim );
                            });

                            $( '.swiper-slide:not(.swiper-slide-visible)' ).each(function () {

                                var iframe = $( this ).find('iframe');
                                var vid = $( this ).find('.video-hosted');
                                if ( iframe.size() && iframe.hasClass('youtube-video') ) {
                                    iframe[0].contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
                                }
                                if ( iframe.size() && iframe.hasClass('vimeo-video') ) {
                                    iframe[0].contentWindow.postMessage('{"method":"pause"}', '*');
                                }
                                if ( vid.size() ) {
                                    vid.get(0).pause();
                                }

                            });

                            $( '.swiper-slide-visible' ).each(function () {

                                var iframe2 = $( this ).find('iframe');
                                var vid = $( this ).find('.video-hosted');
                                if ( iframe2.size() && iframe2.hasClass('youtube-video') ) {
                                    iframe2[0].contentWindow.postMessage('{"event":"command","func":"' + 'playVideo' + '","args":""}', '*');
                                }
                                if ( iframe2.size() && iframe2.hasClass('vimeo-video') ) {
                                    iframe2[0].contentWindow.postMessage('{"method":"play"}', '*');
                                }
                                if ( vid.size() ) {
                                    vid.get(0).play();
                                }
                            });


                            mySlider.find( '.wow' ).removeClass( 'animated' );

                            $( '.swiper-slide-visible .wow' ).addClass( 'animated' );

                        },
                        resize: function () {
                            this.update();
                        }
                    },
                    pagination : pagination,
                    navigation : navigation,
                    scrollbar  : scrollbar,
                    thumbs     : thumbs
                };

                parallaxSlider = new Swiper( myPSlider, parallaxSliderOptions );

            } else {

                myPSlider.addClass('slider-destroyed');

                myPSlider.find( '.elementor-heading-title.splitting:not(.animated)' ).each( function () {

                    var $this = $( this );
                    $this.css(
                        {
                        'visibility': 'hidden'
                        }
                    );
                });

            }

            mySocials.on( 'click', function () {
                $( this ).parent().toggleClass( "active" );
            });
        });
    }

    /* wixiProjectsSlider */
    function wixiProjectsSlider( $scope, $ ) {
        $scope.find( '.metro' ).each(function () {
            var myTarget    = $( this ),
                mySlider    = myTarget.find( '.swiper-container' ),
                myData      = myTarget.data( 'slider-settings' ),
                myspeed     = myData.speed,
                myperview   = myData.perview,
                mymdperview = myData.mdperview,
                mysmperview = myData.smperview,
                myxsperview = myData.xsperview,
                myautoplay  = myData.autoplay,
                myloop      = myData.loop,
                myprogress  = false,
                mynav       = false;

            if ( true == myData.progress ) {
                myprogress = {
                    el  : myTarget.find( '.swiper-pagination' ),
                    type: 'progressbar'
                };
            }
            if ( true == myData.nav ) {
                mynav = {
                    nextEl: myTarget.find( '.next-ctrl' ),
                    prevEl: myTarget.find( '.prev-ctrl' )
                };
            }
            var mySwiper     = new Swiper( mySlider, {
                spaceBetween  : 0,
                speed         : myspeed,
                loop          : myloop,
                autoplay      : myautoplay,
                centeredSlides: true,
                breakpoints   : {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 0
                    },
                    480: {
                        slidesPerView: myxsperview,
                        spaceBetween: 0
                    },
                    640: {
                        slidesPerView: mysmperview,
                        spaceBetween: 0
                    },
                    991: {
                        slidesPerView: mymdperview,
                        spaceBetween: 0
                    }
                },
                pagination: myprogress,
                navigation: mynav
            });

        });

        $scope.find( '.slider-scroll' ).each(function () {
            var myTarget    = $( this ),
                mySlider    = myTarget.find( '.swiper-container' ),
                myData      = myTarget.data( 'slider-settings' ),
                myspeed     = myData.speed,
                myperview   = myData.perview,
                mymdperview = myData.mdperview,
                mysmperview = myData.smperview,
                myxsperview = myData.xsperview,
                myautoplay  = myData.autoplay,
                myloop      = myData.loop,
                myspace     = myData.space ? myData.space : 30,
                myprogress  = false,
                mynav       = false;

            if ( true == myData.progress ) {
                myprogress = {
                    el  : myTarget.find( '.swiper-pagination' ),
                    type: 'progressbar'
                };
            }
            if ( true == myData.nav ) {
                mynav = {
                    nextEl: myTarget.find( '.next-ctrl' ),
                    prevEl: myTarget.find( '.prev-ctrl' )
                };
            }

            var scrollSwiper = new Swiper( mySlider, {
                handleElementorBreakpoints: true,
                slidesPerView : myperview,
                spaceBetween  : myspace,
                mousewheel    : false,
                centeredSlides: true,
                speed         : myspeed,
                loop          : myloop,
                autoplay      : myautoplay,
                breakpoints   : {
                    320: {
                        slidesPerView: 1
                    },
                    480: {
                        slidesPerView: myxsperview
                    },
                    768: {
                        slidesPerView: mysmperview
                    },
                    1024: {
                        slidesPerView: mymdperview
                    }
                },
                navigation: mynav
            });

        });
    }

    /* wixiBlogSlider */
    function wixiBlogSlider( $scope, $ ) {
        $scope.find( '.nt-blog' ).each(function () {
            var myEl   = $( this ),
                mySlider   = myEl.find( '.swiper-img' ),
                mySlider2  = myEl.find( '.swiper-content' ),
                myData     = myEl.data( 'slider-settings' ),

                mySwiper = new Swiper( mySlider, {
                    slidesPerView: 1,
                    spaceBetween : 0,
                    speed        : myData.speed,
                    loop         : myData.loop,
                    effect       : 'fade',
                    pagination   : {
                        el  : myEl.find( '.swiper-pagination' ),
                        type: 'fraction'
                    },
                    navigation: {
                        nextEl: myEl.find( '.next-ctrl' ),
                        prevEl: myEl.find( '.prev-ctrl' )
                    }
                }),

                mySwiper2 = new Swiper( mySlider2, {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    speed: myData.speed,
                    loop: myData.loop,
                    pagination: {
                        el: myEl.find( '.swiper-pagination' ),
                        type: 'fraction'
                    },
                    navigation: {
                        nextEl: myEl.find( '.next-ctrl' ),
                        prevEl: myEl.find( '.prev-ctrl' )
                    }
                });
        });
    }
    /* wixiTestimonialsSlider */
    function wixiTestimonialsSlider( $scope, $ ) {
        $scope.find( '.testimonials' ).each(function () {

            var myEl  = $( this ),
                mySlider  = myEl.find( '.slider-for' ),
                mySlider2 = myEl.find( '.slider-nav' );

            if ( mySlider ) {
                mySlider.slick({
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    arrows: false,
                    prevArrow: '.prev',
                    nextArrow: '.next',
                    dots: true,
                    autoplay: true,
                    fade: false,
                    asNavFor: '.slider-nav',
                    responsive: [
                        {
                          breakpoint: 1024,
                          settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            infinite: true,
                            dots: true
                          }
                        },
                        {
                          breakpoint: 600,
                          settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                          }
                        },
                        {
                          breakpoint: 480,
                          settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                          }
                        }

                      ]
                });

                mySlider2.slick({
                    slidesToShow: 2,
                    asNavFor: '.slider-for',
                    arrows: false,
                    dots: false,
                    focusOnSelect: true
                });
            }
        });
    }

    /* wixiTestimonialsSlider2 */
    function wixiTestimonialsSlider2( $scope, $ ) {
        $scope.find( '.testimonials2' ).each(function () {

            var myEl     = $( this ),
                mySlider = myEl.find( '.testimonials-slider' ),
                myData   = myEl.data( 'slider-settings' );

            if ( mySlider ) {
                mySlider.slick({
                    slidesToShow: myData.show,
                    slidesToScroll: myData.showscroll,
                    arrows: myData.arrows,
                    prevArrow: '.prev',
                    nextArrow: '.next',
                    dots: myData.dots,
                    autoplay: myData.autoplay,
                    fade: myData.fade,
                    speed: myData.speed,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                arrows: myData.mdarrows,
                                dots: myData.mddots,
                                slidesToShow: myData.mdshow
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                arrows: myData.smarrows,
                                dots: myData.smdots,
                                slidesToShow: myData.smshow
                            }
                        }
                    ]
                });
            }
        });
    }

    /* wixiGalleryIsotope */
    function wixiGalleryIsotope( $scope, $ ) {
        $scope.find( '.portfolio' ).each(function () {

            var myGallery = $( this ),
                myIsotope = myGallery.find(".gallery"),
                myFilters = myGallery.find(".filtering");

            if ( myIsotope ) {
                myIsotope.isotope({
                    itemSelector: '.items',
                    layoutMode: 'masonry'
                });
                var $gallery = myIsotope.isotope();
                myFilters.on('click', 'span', function () {
                    var filterValue = $(this).attr('data-filter');
                    $gallery.isotope({ filter: filterValue });
                });
                myFilters.on('click', 'span', function () {
                    $(this).addClass('active').siblings().removeClass('active');
                    myIsotope.find('.item-img').removeClass('wow fadeInUp').removeAttr('style');
                    myIsotope.find('.item-img-overlay-two').removeClass('item-img-overlay-two wow2').removeAttr('style');
                });
            }
        });
    }

    /* wixiMasonryBlog */
    function wixiMasonryBlog() {
        $( '.blog--masonry-row' ).each(function(){

            var myMasonry = $( this ).attr('id');

            if ( myMasonry ) {
                var container = document.querySelector('#'+myMasonry);
                var msnry;
                imagesLoaded( container, function() {
                   msnry = new Masonry( container, {
                       itemSelector: '.item--masonry'
                   });
                });
            }
        });
    }

    /* wixiJustifiedGallery */
    function wixiJustifiedGallery( $scope, $ ) {
        $scope.find( '.justified-gallery' ).each(function () {

            var myEl      = $( this ),
                myData    = myEl.data( 'wixi-justified' );

            if ( myEl ) {
                myEl.justifiedGallery({
                    rowHeight: myData.rows,
                    margins  : myData.margins,
                    lastRow  : myData.lastrow
                });
            }
        });
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

    /* wixiParallaxie */
    function wixiParallaxie( $scope, $ ) {
        $scope.find( '.page-header .bg-cover' ).each(function () {
            var myEl      = $( this ),
                myWinw    = $( window ).width(),
                myData    = myEl.data( 'wixi-parallaxie' ),
                myspeed   = myData.speed,
                mymdspeed = myData.mdspeed ? myData.mdspeed : myspeed,
                mysmspeed = myData.smspeed ? myData.smspeed : myspeed,
                myoffset  = myData.offset ? myData.offset : 0;

            if ( myEl ) {
                    if ( myWinw > 480 && myWinw <= 768 ) {
                        myoffset = myData.mdoffset;
                        myspeed = mymdspeed;
                    }
                    if ( myWinw < 480 ) {
                        myoffset = myData.smoffset;
                        myspeed = mysmspeed;
                    }
                $( window ).on('resize', function(){
                    if ( myWinw > 480 && myWinw <= 768 ) {
                        myoffset = myData.mdoffset;
                        myspeed = mymdspeed;
                    }
                    if ( myWinw < 480 ) {
                        myoffset = myData.smoffset;
                        myspeed = mysmspeed;
                    }
                });
                myEl.parallaxie({
                    speed: myspeed,
                    size : 'cover',
                    offset : myoffset,
                });
            }
        });
    }

    /* wixiPopupVideo */
    function wixiPopupVideo( $scope, $ ) {
        $scope.find( 'a.popup-video' ).each(function () {
            var myVideo = $( this );
            if ( myVideo ) {
                myVideo.YouTubePopUp();
            }
        });
    }

    // wixiBackground2
    function wixiBackground($scope, $) {
        $scope.find('[data-wixi-background]').each(function () {
            var myEl = $(this);
            if (myEl.length) {
                var myBg = myEl.data('wixi-background');
                myEl.css({'background-image': 'url("'+ myBg +'")'});
                myEl.removeAttr('data-wixi-background');
            }
        });
    }

    // wixiIsotope
    function wixiIsotope($scope, $) {
        $scope.find('[data-wixi-isotope]').each(function () {
            var myIsotopes = $('[data-wixi-isotope]');
            if (myIsotopes.length) {
                myIsotopes.each(function (i, el) {
                    var myIsotope = $(el);
                    var myData    = myIsotope.data('wixiIsotope');
                    if (!myData.itemSelector) {
                        return true; // next iteration
                    }
                    myIsotope.imagesLoaded(function() {
                        // Isotope Options
                        var myIsotopeOptions = {
                            percentPosition: true,
                            layoutMode: myData.layoutMode || 'masonry',
                            itemSelector: myData.itemSelector,
                            masonry: {
                                columnWidth: '.grid_sizer'
                            }
                        };
                        // Isotope Init
                        myIsotope.isotope(myIsotopeOptions);
                        // Isotope Filter
                        if ($('[data-wixi-isotope-filter]').length) {
                            var myFilters    = $('[data-wixi-isotope-filter]').filter(function (i, el) {
                                var myFilter = $(el);
                                var myFilterData = myFilter.data('wixiIsotopeFilter');
                                return myFilterData.name === myData.name && myFilterData.selector;
                            });
                            if (myFilters.length) {
                                myFilters.on('click', function (e) {
                                    e.preventDefault();
                                    var myFilter = $(this);
                                    var myFilterData = myFilter.data('wixiIsotopeFilter');
                                    var myFilterSelector = myFilterData.selector;
                                    var myFilterParent = myFilter.parent();
                                    myFilterParent.siblings().removeClass('is-active');
                                    myFilterParent.addClass('is-active');
                                    myIsotope.isotope({filter: myFilterSelector});
                                });
                            }
                        }
                    });
                });
            }
        });
    }

    /* wixiAnimationFix */
    function wixiAnimationFix() {
        $scope.find('body:not(.elementor-page)').each(function () {

            var myTarget     = $( this ),
                myInvisible  = myTarget.find( '.elementor-invisible' );

            myInvisible.each( function () {
                var $this     = $( this ),
                    animData  = $this.data('settings'),
                    animName  = animData._animation,
                    animDelay = animData._animation_delay;
                $this.addClass( 'wow '+ animName ).removeClass( 'elementor-invisible' );
                $this.css( 'animation-delay', animDelay + 'ms');
            });
        });
    }

   // wixiJarallax
    function wixiJarallax() {
        var myParallaxs = $('.wixi-parallax');
        myParallaxs.each(function (i, el) {

            var myParallax = $(el),
                myData     = myParallax.data('wixiParallax');
            if (!myData) {
                return true; // next iteration
            }
            myParallax.jarallax({
                type            : myData.type,
                speed           : myData.speed,
                imgSize         : myData.imgsize,
                imgSrc          : myData.imgsrc,
                disableParallax : myData.mobile ? /iPad|iPhone|iPod|Android/ : null,
                keepImg         : false,
            });
        });
    }

   // wixiHeadingSplit
    function wixiHeadingSplit( $scope, $ ) {
        $scope.each(function () {

            var myEl    = $(this),
                myId    = myEl.data( 'id' ),
                myData  = myEl.data( 'split-settings' ),
                mySplit = myEl.find( '.elementor-heading-title' );

            if ( myEl.hasClass( 'wixi-headig-split' ) && myData ) {
                mySplit.addClass('wow');
                Splitting({
                  target: mySplit,
                  //by: "chars",
                });
            }
        });
    }

   // wixiImageParallax
    function wixiImageJarallax($scope, $) {
        $scope.each(function () {

            var myEl   = $(this),
                myId   = myEl.data('id'),
                myData = myEl.data('image-parallax-settings');

            if ( myEl.hasClass('wixi-image-parallax') && myData ) {

                var myParallax = myEl.find('img').addClass('parallax-image-'+myId);
                var image      = document.getElementsByClassName('parallax-image-'+myId);
                new simpleParallax(image, {
                    orientation: myData.orientation,
                    scale: myData.scale,
                    overflow: myData.overflow,
                    delay: myData.delay,
                    maxTransition: myData.maxtrans
                });
            }
        });
    }

    function wixiColorAware($scope,$) {
        $scope.find('.brands').each(function (i, el) {
            $(this).on('mouseenter', function(e) {
                var parentOffset = $(this).offset();
                if ( $('body').hasClass('rtl') ) {
                    var relX = e.pageX - parentOffset.left,
                    relY = e.pageY - parentOffset.top;
                    $(this).find('.color-aware').css({top:relY, right:relX})
                } else {
                    var relX = e.pageX - parentOffset.left,
                    relY = e.pageY - parentOffset.top;
                    $(this).find('.color-aware').css({top:relY, left:relX})
                }
            })
            .on('mouseout', function(e) {
                var parentOffset = $(this).offset();
                if ( $('body').hasClass('rtl') ) {
                    var relX = e.pageX - parentOffset.left,
                    relY = e.pageY - parentOffset.top;
                    $(this).find('.color-aware').css({top:relY, right:relX})
                } else {
                    var relX = e.pageX - parentOffset.left,
                    relY = e.pageY - parentOffset.top;
                    $(this).find('.color-aware').css({top:relY, left:relX})
                }
            });
        });
    }

    // ntrNavMenus
    function wixiNavMenus($scope, $) {
        $scope.find('[data-ntr-custom-header]').each(function (i, el) {
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
                    var myHeader2 = $(ell),
                        myHeaderNav = myHeader2.find('.header_nav'),
                        myHeaderNavArrows = $('.header_nav_arrow', myHeaderNav),
                        myHeaderNavToggle = $('.header_nav_toggle', myHeader),
                        myHeaderNavClose  = $('.header_nav_close', myHeader),
                        myHeaderHandlers  = {
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
                        var myWindow = $(window),
                            myHeaderHolder = $('.header_holder', myHeader),
                            myHeaderContainer = $('.header_container', myHeader),
                            mystickyOffset = myHeader.attr('data-ntr-sticky-offset'),
                            myHeaderHeight = myHeaderContainer.outerHeight(),
                            mystickyOffset = myHeaderContainer.offset().top,
                            mystickyOffsetone = mystickyOffset ? mystickyOffset : myHeaderHeight,
                            mystickyOffsetTwo = mystickyOffset ? mystickyOffset+myHeaderHeight : 1,
                            myHeaderTimer;

                        if (!myHeader.hasClass('is-overlay')) {
                            myHeaderHolder.css({'height': myHeaderHeight});
                        }
                        myWindow.on('scroll', function() {
                            if (myHeaderTimer) {
                                clearTimeout(myHeaderTimer);
                            }
                            if (myWindow.scrollTop() > mystickyOffsetone) {
                                myHeader.addClass('is-sticky-active');
                            } else if (myWindow.scrollTop() < mystickyOffsetTwo ) {
                                myHeader.removeClass('is-sticky-active');
                            }
                        });
                    }
                });
            }
        });
    }

    var NtVegasHandler = function ($scope, $) {
        var target = $scope,
            sectionId = target.data("id"),
            settings = false,
            editMode = elementorFrontend.isEditMode();

        if (editMode) {
            settings = generateEditorSettings(sectionId);
        }

        if (!editMode || !settings) {
            //return false;
        }

        if(settings[1]){
            generateVegas();
        }

        function generateEditorSettings(targetId) {
            var editorElements = null,
                sectionData = {},
                sectionMultiData = {},
                settings = [];

            if (!window.elementor.hasOwnProperty("elements")) {
                return false;
            }

            editorElements = window.elementor.elements;

            if (!editorElements.models) {
                return false;
            }

            $.each(editorElements.models, function(index, elem) {

                if (targetId == elem.id) {

                    sectionData = elem.attributes.settings.attributes;
                } else if ( elem.id == target.closest(".elementor-top-section").data("id") ) {

                    $.each(elem.attributes.elements.models, function(index, col) {
                        $.each(col.attributes.elements.models, function(index,subSec) {
                            sectionData = subSec.attributes.settings.attributes;
                        });
                    });
                }
            });

            if (!sectionData.hasOwnProperty("wixi_vegas_animation_type") || "" == sectionData["wixi_vegas_animation_type"]) {
                return false;
            }

            settings.push(sectionData["wixi_vegas_switcher"]);  // settings[0]
            settings.push(sectionData["wixi_vegas_images"]);    // settings[1]
            settings.push(sectionData["wixi_vegas_animation_type"]);      // settings[2]
            settings.push(sectionData["wixi_vegas_transition_type"]);     // settings[3]
            settings.push(sectionData["wixi_vegas_overlay_type"]);    // settings[4]
            settings.push(sectionData["wixi_vegas_delay"]);     // settings[5]
            settings.push(sectionData["wixi_vegas_duration"]);   // settings[6]
            settings.push(sectionData["wixi_vegas_shuffle"]);   // settings[7]
            settings.push(sectionData["wixi_vegas_timer"]);   // settings[8]

            if (0 !== settings.length) {
                return settings;
            }

            return false;
        }


        function generateVegas() {

            var vegas_animation  = settings[2] ? Object.values(settings[2]) : 'kenburns';
            var vegas_transition = settings[3] ? Object.values(settings[3]) : 'slideLeft';
            var vegas_delay      = settings[5] ? settings[5] : 7000;
            var vegas_duration   = settings[6] ? settings[6] : 2000;
            var vegas_shuffle    = 'yes' == settings[7] ? true : false;
            var vegas_timer      = 'yes' == settings[8] ? true : false;
            var vegas_overlay    = 'none' != settings[4] ? true : false;

            if(settings[1].length){

                if ( settings[0] == 'yes' && !$('#vegas-js_' + sectionId ).size() ) {
                    $('<div id="vegas-js_' + sectionId + '" class="wixi-vegas-effect"></div>').prependTo(target);

                    var images = [];
                    for(i = 0; i<settings[1].length; i++){
                        images.push({ src: settings[1][i]['url'] });
                    }

                    setTimeout(function() {
                        $('#vegas-js_' + sectionId).vegas({
                            delay: vegas_delay,
                            timer: vegas_timer,
                            shuffle: vegas_shuffle,
                            animation: vegas_animation,
                            transition: vegas_transition,
                            transitionDuration: vegas_duration,
                            overlay: vegas_overlay,
                            slides: images
                        });
                    }, 500);

                } else {
                    if ( settings[0] != 'yes' && $('#vegas-js_' + sectionId ).size() ) {
                        $('#vegas-js_' + sectionId ).remove();
                    }
                }

            }

        }
    }


    // NtVegas Preview function
    function ntTilt() {

        $("[data-tilt]").each(function (i, el) {
            var myTiltGlare = jQuery(el);
            var myTiltBg = myTiltGlare.find('.js-tilt-glare-inner').css('background-image');
            if ( myTiltBg ) {
                myTiltGlare.find('.js-tilt-glare-inner').css('background-image', '' );
            }

        });

    }
    // NtVegas Preview function
    function NtVegas() {

        $(".elementor-section[data-vegas-settings]").each(function (i, el) {
            var myVegas = jQuery(el);
            var myVegasId = myVegas.data('vegas-id');
            var myElementType = myVegas.data('element_type');
            if ( myElementType == 'section' ) {

                $('<div id="vegas-js_' + myVegasId + '" class="wixi-vegas-effect"></div>').prependTo(myVegas);

                var settings = myVegas.data('vegas-settings');

                if(settings.slides.length) {

                    var vegas_animation  = settings.animation ? settings.animation : 'kenburns';
                    var vegas_transition = settings.transition ? settings.transition : 'slideLeft';
                    var vegas_delay      = settings.delay ? settings.delay : 7000;
                    var vegas_duration   = settings.duration ? settings.duration : 2000;
                    var vegas_shuffle    = 'yes' == settings.shuffle ? true : false;
                    var vegas_timer      = 'yes' == settings.timer ? true : false;
                    var vegas_overlay    = 'none' != settings.overlay ? true : false;

                    $( '#vegas-js_' + myVegasId ).vegas({
                        delay: vegas_delay,
                        timer: vegas_timer,
                        shuffle: vegas_shuffle,
                        animation: vegas_animation,
                        transition: vegas_transition,
                        transitionDuration: vegas_duration,
                        overlay: vegas_overlay,
                       slides: settings.slides
                    });
                }
            }

        });

    }


    var NtParticlesHandler = function ($scope, $) {
        var target = $scope,
            sectionId = target.data("id"),
            settings = false,
            editMode = elementorFrontend.isEditMode();

        if (editMode) {
            settings = generateEditorSettings(sectionId);
        }

        if (!editMode || !settings) {
            return false;
        }

        if ( "none" != settings[1]) {
            target.addClass('wixi-particles');
            $('<div id="particles-js_' + sectionId + '" class="wixi-particles-effect"></div>').prependTo(target);
            generateParticles();
        }

        function generateEditorSettings(targetId) {
            var editorElements = null,
                sectionData = {},
                sectionMultiData = {},
                settings = [];

            if (!window.elementor.hasOwnProperty("elements")) {
                return false;
            }

            editorElements = window.elementor.elements;

            if (!editorElements.models) {
                return false;
            }

            $.each(editorElements.models, function(index, elem) {

                if (targetId == elem.id) {

                    sectionData = elem.attributes.settings.attributes;
                } else if ( elem.id == target.closest(".elementor-top-section").data("id") ) {

                    $.each(elem.attributes.elements.models, function(index, col) {
                        $.each(col.attributes.elements.models, function(index,subSec) {
                            sectionData = subSec.attributes.settings.attributes;
                        });
                    });
                }
            });

            if (!sectionData.hasOwnProperty("wixi_particles_type") || "none" == sectionData["wixi_particles_type"]) {
                return false;
            }

            settings.push(sectionData["wixi_particles_switcher"]);  // settings[0]
            settings.push(sectionData["wixi_particles_type"]);      // settings[1]
            settings.push(sectionData["wixi_particles_shape"]);     // settings[2]
            settings.push(sectionData["wixi_particles_number"]);    // settings[3]
            settings.push(sectionData["wixi_particles_color"]);     // settings[4]
            settings.push(sectionData["wixi_particles_opacity"]);   // settings[5]
            settings.push(sectionData["wixi_particles_size"]);      // settings[5]

            if (0 !== settings.length) {
                return settings;
            }

            return false;
        }


        function generateParticles() {

            var type     = settings[1] ? settings[1] : 'deafult';
            var shape    = settings[2] ? settings[2] : 'buble';
            var number   = settings[3] ? settings[3] : '';
            var color    = settings[4] ? settings[4] : '#fff';
            var opacity  = settings[5] ? settings[5] : '';
            var d_size   = settings[6] ? settings[6] : '';
            //var n_size   = settings[8] ? settings[8] : '';
            //var s_size   = settings[9] ? settings[9] : '';
            var snumber = number ? number : 6;
            var nbsides = shape == 'star' ? 5 : 6;
            var size    = d_size ? d_size : 100;
            setTimeout(function() {

                if ( type == 'bubble' ) {
                    snumber = number ? number : 6;
                    nbsides = shape == 'star' ? 5 : 6;
                    size    = d_size ? d_size : 100;
                    particlesJS("particles-js_" + sectionId, { "fps_limit": 0, "particles": { "number": { "value": snumber, "density": { "enable": true, "value_area": 800 } }, "color": { "value": color }, "shape": { "type": shape, "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": nbsides }, "image": { "src": "img/github.svg", "width": 100, "height": 100 } }, "opacity": { "value": opacity, "random": true, "anim": { "enable": false, "speed": 1, "opacity_min": 0.1, "sync": false } }, "size": { "value": size, "random": false, "anim": { "enable": true, "speed": 10, "size_min": 40, "sync": false } }, "line_linked": { "enable": false, "distance": 200, "color": "#ffffff", "opacity": 1, "width": 2 }, "move": { "enable": true, "speed": 8, "direction": "none", "random": false, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 1200 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": false, "mode": "grab" }, "onclick": { "enable": false, "mode": "push" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 1 } }, "bubble": { "distance": 400, "size": 40, "duration": 2, "opacity": 8, "speed": 3 }, "repulse": { "distance": 200, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true });
                } else if( type == 'nasa' ) {
                    snumber = number ? number : 160;
                    size    = d_size ? d_size : 3;
                    particlesJS("particles-js_" + sectionId, { "fps_limit": 0, "particles": { "number": { "value": snumber, "density": { "enable": true, "value_area": 800 } }, "color": { "value": color }, "shape": { "type": shape, "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": 5 }, "image": { "src": "img/github.svg", "width": 100, "height": 100 } }, "opacity": { "value": opacity, "random": true, "anim": { "enable": true, "speed": 1, "opacity_min": 0, "sync": false } }, "size": { "value": size, "random": true, "anim": { "enable": false, "speed": 4, "size_min": 0.3, "sync": false } }, "line_linked": { "enable": false, "distance": 150, "color": "#ffffff", "opacity": 0.4, "width": 1 }, "move": { "enable": true, "speed": 1, "direction": "none", "random": true, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 600 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "bubble" }, "onclick": { "enable": true, "mode": "repulse" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 1 } }, "bubble": { "distance": 250, "size": 0, "duration": 2, "opacity": 0, "speed": 3 }, "repulse": { "distance": 400, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true });
                } else if( type == 'snow' ) {
                    snumber = number ? number : 400;
                    size    = d_size ? parseFloat(d_size) : 10;
                    particlesJS("particles-js_" + sectionId, { "fps_limit": 0, "particles": { "number": { "value": snumber, "density": { "enable": true, "value_area": 800 } }, "color": { "value": color }, "shape": { "type": shape, "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": 5 }, "image": { "src": "img/github.svg", "width": 100, "height": 100 } }, "opacity": { "value": opacity, "random": true, "anim": { "enable": false, "speed": 1, "opacity_min": 0.1, "sync": false } }, "size": { "value": size, "random": true, "anim": { "enable": false, "speed": 40, "size_min": 0.1, "sync": false } }, "line_linked": { "enable": false, "distance": 500, "color": "#ffffff", "opacity": 0.4, "width": 2 }, "move": { "enable": true, "speed": 6, "direction": "bottom", "random": false, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 1200 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "bubble" }, "onclick": { "enable": true, "mode": "repulse" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 0.5 } }, "bubble": { "distance": 400, "size": 4, "duration": 0.3, "opacity": 1, "speed": 3 }, "repulse": { "distance": 200, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true });
                } else if( type == 'default' ) {
                    snumber = number ? number : 80;
                    size    = d_size ? d_size : 3;
                    particlesJS("particles-js_" + sectionId, { "fps_limit": 0, "particles": { "number": { "value": snumber, "density": { "enable": true, "value_area": 800 } }, "color": { "value": color }, "shape": { "type": shape, "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": 5 }, "image": { "src": "img/github.svg", "width": 100, "height": 100 } }, "opacity": { "value": opacity, "random": false, "anim": { "enable": false, "speed": 1, "opacity_min": 0.1, "sync": false } }, "size": { "value": size, "random": true, "anim": { "enable": false, "speed": 40, "size_min": 0.1, "sync": false } }, "line_linked": { "enable": true, "distance": 150, "color": "#ffffff", "opacity": 0.4, "width": 1 }, "move": { "enable": true, "speed": 6, "direction": "none", "random": false, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 1200 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "repulse" }, "onclick": { "enable": true, "mode": "push" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 1 } }, "bubble": { "distance": 400, "size": 40, "duration": 2, "opacity": 8, "speed": 3 }, "repulse": { "distance": 200, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true });
                } else {
                    target.find('.wixi-particles-effect').remove();
                    target.removeClass('wixi-particles');
                }
            }, 500);

        }
    }

    // ntrParticles Preview function
    function NtParticles() {

        $(".elementor-section[data-particles-settings]").each(function (i, el) {
            var myParticles = $(el);
            var myParticlesId = myParticles.attr('data-particles-id');
            var myElementTtype = myParticles.attr('data-element_type');
            if ( myElementTtype == 'section' ) {

                $('<div id="particles-js_' + myParticlesId + '" class="wixi-particles-effect"></div>').prependTo(myParticles);

                var settings = myParticles.data('particles-settings');

                var type     = settings.type;
                var color    = settings.color ? settings.color : '#fff';
                var opacity  = settings.opacity ? settings.opacity : 0.4;
                var shape    = settings.shape ? settings.shape : 'circle';
                var snumber = settings.number ? settings.number : 6;
                var nbsides = settings.shape == 'star' ? 5 : 6;
                var size    = settings.size ? settings.size : 100;

                if ( type == 'bubble' ) {
                    snumber = settings.number ? settings.number : 6;
                    nbsides = settings.shape == 'star' ? 5 : 6;
                    size = settings.size ? settings.size : 100;
                    particlesJS("particles-js_" + myParticlesId,{ "fps_limit": 0,"particles": { "number": { "value": snumber, "density": { "enable": true, "value_area": 800 } }, "color": { "value": color }, "shape": { "type": shape, "stroke": { "width": 0, "color": "#000" }, "polygon": { "nb_sides": nbsides }, "image": { "src": "img/github.svg", "width": 100, "height": 100 } }, "opacity": { "value": opacity, "random": true, "anim": { "enable": false, "speed": 1, "opacity_min": 0.1, "sync": false } }, "size": { "value": size, "random": false, "anim": { "enable": true, "speed": 10, "size_min": 40, "sync": false } }, "line_linked": { "enable": false, "distance": 200, "color": "#ffffff", "opacity": 1, "width": 2 }, "move": { "enable": true, "speed": 8, "direction": "none", "random": false, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 1200 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": false, "mode": "grab" }, "onclick": { "enable": false, "mode": "push" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 1 } }, "bubble": { "distance": 400, "size": 40, "duration": 2, "opacity": 8, "speed": 3 }, "repulse": { "distance": 200, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true });
                } else if( type == 'nasa' ) {
                    snumber = settings.number ? settings.number : 160;
                    size = settings.size ? settings.size : 3;
                    particlesJS("particles-js_" + myParticlesId, { "fps_limit": 0,"particles": { "number": { "value": snumber, "density": { "enable": true, "value_area": 800 } }, "color": { "value": color }, "shape": { "type": shape, "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": 5 }, "image": { "src": "img/github.svg", "width": 100, "height": 100 } }, "opacity": { "value": opacity, "random": true, "anim": { "enable": true, "speed": 1, "opacity_min": 0, "sync": false } }, "size": { "value": size, "random": true, "anim": { "enable": false, "speed": 4, "size_min": 0.3, "sync": false } }, "line_linked": { "enable": false, "distance": 150, "color": "#ffffff", "opacity": 0.4, "width": 1 }, "move": { "enable": true, "speed": 1, "direction": "none", "random": true, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 600 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "bubble" }, "onclick": { "enable": true, "mode": "repulse" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 1 } }, "bubble": { "distance": 250, "size": 0, "duration": 2, "opacity": 0, "speed": 3 }, "repulse": { "distance": 400, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true });
                } else if( type == 'snow' ) {
                    snumber = settings.number ? settings.number : 400;
                    size = settings.size ? settings.size : 10;
                    particlesJS("particles-js_" + myParticlesId, { "fps_limit": 0,"particles": { "number": { "value": snumber, "density": { "enable": true, "value_area": 800 } }, "color": { "value": "#fff" }, "shape": { "type": shape, "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": 5 }, "image": { "src": "img/github.svg", "width": 100, "height": 100 } }, "opacity": { "value": opacity, "random": true, "anim": { "enable": false, "speed": 1, "opacity_min": 0.1, "sync": false } }, "size": { "value": size, "random": true, "anim": { "enable": false, "speed": 40, "size_min": 0.1, "sync": false } }, "line_linked": { "enable": false, "distance": 500, "color": "#ffffff", "opacity": 0.4, "width": 2 }, "move": { "enable": true, "speed": 6, "direction": "bottom", "random": false, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 1200 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "bubble" }, "onclick": { "enable": true, "mode": "repulse" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 0.5 } }, "bubble": { "distance": 400, "size": 4, "duration": 0.3, "opacity": 1, "speed": 3 }, "repulse": { "distance": 200, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true });
                } else if( type == 'default' ) {
                    snumber = settings.number ? settings.number : 80;
                    size = settings.size ? settings.size : 3;
                    particlesJS("particles-js_" + myParticlesId, { "fps_limit": 0,"particles": { "number": { "value": snumber, "density": { "enable": true, "value_area": 800 } }, "color": { "value": "#ffffff" }, "shape": { "type": "circle", "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": 5 }, "image": { "src": "img/github.svg", "width": 100, "height": 100 } }, "opacity": { "value": 0.5, "random": false, "anim": { "enable": false, "speed": 1, "opacity_min": 0.1, "sync": false } }, "size": { "value": 3, "random": true, "anim": { "enable": false, "speed": 40, "size_min": 0.1, "sync": false } }, "line_linked": { "enable": true, "distance": 150, "color": "#ffffff", "opacity": 0.4, "width": 1 }, "move": { "enable": true, "speed": 6, "direction": "none", "random": false, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 1200 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "repulse" }, "onclick": { "enable": true, "mode": "push" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 1 } }, "bubble": { "distance": 400, "size": 40, "duration": 2, "opacity": 8, "speed": 3 }, "repulse": { "distance": 200, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true });
                } else {

                }
            }

        });

    }

    var NtParallaxHandler = function ($scope, $) {
        var target = $scope,
            sectionId = target.data("id"),
            settings = false,
            editMode = elementorFrontend.isEditMode();

        if (editMode) {
            settings = generateEditorSettings(sectionId);
        }

        if (!editMode || !settings) {
            //return false;
        }

        if (settings[0] == "yes") {

            generateJarallax();
        }

        function generateEditorSettings(targetId) {
            var editorElements = null,
                sectionData = {},
                sectionMultiData = {},
                settings = [];

            if (!window.elementor.hasOwnProperty("elements")) {
                return false;
            }

            editorElements = window.elementor.elements;

            if (!editorElements.models) {
                return false;
            }

            $.each(editorElements.models, function(index, elem) {

                if (targetId == elem.id) {

                    sectionData = elem.attributes.settings.attributes;
                } else if ( elem.id == target.closest(".elementor-top-section").data("id") ) {

                    $.each(elem.attributes.elements.models, function(index, col) {
                        $.each(col.attributes.elements.models, function(index,subSec) {
                            sectionData = subSec.attributes.settings.attributes;
                        });
                    });
                }
            });

            if (!sectionData.hasOwnProperty("wixi_parallax_type") || "" == sectionData["wixi_parallax_type"]) {
                return false;
            }

            settings.push(sectionData["wixi_parallax_switcher"]);                          // settings[0]
            settings.push(sectionData["wixi_parallax_type"]);                              // settings[1]
            settings.push(sectionData["wixi_parallax_speed"]);                             // settings[2]
            settings.push(sectionData["wixi_parallax_bg_size"]);                           // settings[3]
            settings.push("yes" == sectionData["wixi_parallax_mobile_support"] ? 0 : 1);   // settings[4]
            settings.push("yes" == sectionData["wixi_add_parallax_video"] ? 1 : 0);        // settings[5]
            settings.push(sectionData["wixi_local_video_format"]);                         // settings[6]
            settings.push(sectionData["wixi_parallax_video_url"]);                         // settings[7]
            settings.push(sectionData["wixi_parallax_video_start_time"]);                  // settings[8]
            settings.push(sectionData["wixi_parallax_video_end_time"]);                    // settings[9]
            settings.push(sectionData["wixi_parallax_video_volume"]);                      // settings[10]


            if (0 !== settings.length) {
                return settings;
            }

            return false;
        }

        function responsiveParallax(android, ios) {
            switch (true || 1) {
                case android && ios:
                    return /iPad|iPhone|iPod|Android/;
                    break;
                case android && !ios:
                    return /Android/;
                    break;
                case !android && ios:
                    return /iPad|iPhone|iPod/;
                    break;
                case !android && !ios:
                    return null;
            }
        }

        function generateJarallax() {
            var $type     = settings[1] ? settings[1] : 'scroll';
            var $speed    = settings[2] ? settings[2] : '0.4';
            var $imgsize  = settings[3] ? settings[3] : 'cover';

            setTimeout(function() {

                target.jarallax({
                    type            : $type,
                    speed           : $speed,
                    imgSize         : $imgsize,
                    disableParallax : responsiveParallax(1 == settings[4])
                });

            }, 500);

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

    function shapeOverlaysMenu($Scope, $) {
        const elmNavi = document.querySelector('.wixi-shape-overlay-menu');
        const elmHamburger = document.querySelector('.hamburger');
        const gNavItems = document.querySelectorAll('.global-menu__item');
        const elmOverlay = document.querySelector('.shape-overlays');
        const overlay = new ShapeOverlays(elmOverlay);

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


    function updatePageSettings(newValue) {
        var settings = false,
            editMode = elementorFrontend.isEditMode();
        if (!editMode ) {
            return false;
        }
        if (editMode) {

            var page_skin   = elementor.settings.page.model.attributes.wixi_elementor_page_skin;
            var hide_header = elementor.settings.page.model.attributes.wixi_elementor_hide_page_header;
            var hide_footer = elementor.settings.page.model.attributes.wixi_elementor_hide_page_footer;


            if ( 'dark' === page_skin ) {
                $('body').removeClass('light').addClass( 'dark' );
            } else {
                $('body').removeClass('dark').addClass( 'light' );
            }
            if ( hide_header && 'yes' === hide_header ) {
                $('body .main-overlaymenu, body .wixi-elementor-header').hide();
            } else {
                $('body .main-overlaymenu, body .wixi-elementor-header').show();
            }
            if ( hide_footer && 'yes' === hide_footer ) {
                $('body .footer-sm, body .wixi-elementor-footer').hide();
            } else {
                $('body .footer-sm, body .wixi-elementor-footer').show();
            }

        }
    }

    jQuery(window).on('load', function () {
        wixiBgImage();
        wixiGalleryIsotope(jQuery('body'),$);
        wixiMasonryBlog();
    });

    jQuery(window).on('elementor/frontend/init', function () {

        if ( typeof elementor != "undefined" && typeof elementor.settings.page != "undefined") {

            elementor.settings.page.addChangeCallback( 'wixi_elementor_page_skin', updatePageSettings );
            elementor.settings.page.addChangeCallback( 'wixi_elementor_hide_page_header', updatePageSettings );
            elementor.settings.page.addChangeCallback( 'wixi_elementor_page_header_type', updatePageSettings );
            elementor.settings.page.addChangeCallback( 'wixi_elementor_hide_page_footer', updatePageSettings );
        }

        elementorFrontend.hooks.addAction('frontend/element_ready/section', wixiJarallax);
        elementorFrontend.hooks.addAction('frontend/element_ready/image.default', wixiImageJarallax);
        elementorFrontend.hooks.addAction('frontend/element_ready/wixi-header-menu.default', wixiNavMenus);
        elementorFrontend.hooks.addAction('frontend/element_ready/wixi-home-slider.default', wixiHomeSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/wixi-onepage.default', wixiOnepage);
        elementorFrontend.hooks.addAction('frontend/element_ready/wixi-projects-slider.default', wixiProjectsSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/wixi-justified-gallery.default', wixiJustifiedGallery);
        elementorFrontend.hooks.addAction('frontend/element_ready/wixi-popup-video.default', wixiPopupVideo);
        elementorFrontend.hooks.addAction('frontend/element_ready/wixi-testimonials.default', wixiTestimonialsSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/wixi-testimonials-two.default', wixiTestimonialsSlider2);
        elementorFrontend.hooks.addAction('frontend/element_ready/wixi-blog-slider.default', wixiBlogSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/wixi-page-hero.default', wixiParallaxie);
        elementorFrontend.hooks.addAction('frontend/element_ready/wixi-brands-board.default', wixiColorAware);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', ntTilt);

        var editMode = elementorFrontend.isEditMode();
        if (editMode) {

            elementorFrontend.hooks.addAction('frontend/element_ready/global', NtVegasHandler);
            elementorFrontend.hooks.addAction('frontend/element_ready/global', NtParticlesHandler);
            elementorFrontend.hooks.addAction('frontend/element_ready/global', NtParallaxHandler);
            elementorFrontend.hooks.addAction('frontend/element_ready/wixi-shape-overlays-menu.default', shapeOverlaysMenu);
        } else {
            NtVegas();
            NtParticles();
        }

        // disable elementor scrol to id
        if ( typeof wixi_page_vars != "undefined" && wixi_page_vars.scrolltoid === "yes" ) {

            elementorFrontend.hooks.addFilter( 'frontend/handlers/menu_anchor/scroll_top_distance', function( scrollTop ) {
                return;
            });

            var scrolltoid = wixi_page_vars.scrolltoid;
            var duration   = wixi_page_vars.duration;

            var scrollToId = function () {
                if ( scrolltoid && 'yes' === scrolltoid ) {
                    duration = duration ? parseFloat(duration) : 100;
                    $('a[href*="#"]').bind('click', function (e) {
                        e.preventDefault();
                        var target = this.hash,
                            $target = $(target);
                        $('html, body').animate({scrollTop: $target.offset().top },duration,'linear');
                    });
                }
            }

            scrollToId();
        }

        elementorFrontend.hooks.addFilter( 'frontend/handlers/menu_anchor/scroll_top_distance', function( scrollTop ) {
            if( $('.nt-locomotive-wrapper').size() ){
                return false;
            } else {
                if ( typeof wixi_page_vars != "undefined" && wixi_page_vars.scrolltoid != "yes" ) {
                    return scrollTop;
                }
            }
        });

    });

})(jQuery);
