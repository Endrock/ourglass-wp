(function(window, document, $) {

    "use strict";

    function wixiButton($scope,$) {
        $scope.find('.nt-btn-6').on('mouseenter', function(e) {
            var parentOffset = $(this).offset();
            if ( $('body').hasClass('rtl') ) {
                var relX = e.pageX - parentOffset.right,
                relY = e.pageY - parentOffset.top;
                $(this).find('span:not(.nt_btn_text)').css({top:relY, right:relX})
            } else {
                var relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
                $(this).find('span:not(.nt_btn_text)').css({top:relY, left:relX})
            }
        })
        .on('mouseout', function(e) {
            var parentOffset = $(this).offset();
            if ( $('body').hasClass('rtl') ) {
                var relX = e.pageX - parentOffset.right,
                relY = e.pageY - parentOffset.top;
                $(this).find('span:not(.nt_btn_text)').css({top:relY, right:relX})
            } else {
                var relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
                $(this).find('span:not(.nt_btn_text)').css({top:relY, left:relX})
            }
        });
    }

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/wixi-button2.default', wixiButton);
    });

})(window, document, jQuery);
