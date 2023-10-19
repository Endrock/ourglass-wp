(function(window, document, $) {

    "use strict";

    function wixiOdometer() {
        var wow = new WOW({
            boxClass: 'odometer',
            animateClass: 'wixi-odometer',
            offset: 100,
            callback: function ( el ){
                var myOdometers = $(el),
                    myID = myOdometers.attr('id'),
                    myData = myOdometers.data('wixi-odometer'),
                    myTheme = myData.theme,
                    myNumber = myData.number,
                    myNumber2 = myData.number2,
                    myTimeout = myData.timeout,
                    myFormat = myData.format,
                    myOdometer = document.getElementById(myID),
                    od = new Odometer({
                      el: myOdometer,
                      value: myNumber,
                      format: myFormat,
                      theme: myTheme,
                    });

                od.update(myNumber2);
            }
        });
        wow.init();
    }
    
    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/wixi-odometer.default', wixiOdometer);
    });

})(window, document, jQuery);
