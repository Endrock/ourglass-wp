/*
* Custom Script
*
*/
!(function ($) {

    function imgBeforeAfter($scope, $) {
        $scope.find('.nt-images-compare').each(function () {

            var myElement = $(this);
        var options = {
        // start value
        start: '50',
        // prefix
        prefix: 'nt'
    };
    $.fn.BeerSlider = function ( options ) {
      options = options || {};
      return this.each(function() {
        new BeerSlider(this, options);
      });
    };
            myElement.BeerSlider(options);
        });
    }

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/wixi-image-before-after.default', imgBeforeAfter);
    });

})(jQuery);
