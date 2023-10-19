(function($) {

	/*-- Strict mode enabled --*/
	'use strict';

	/* svg load and animation
	================================================== */
	function _wrapRelatedTitle () {

		var text = $('.related.products > h2').text();
		$('.related.products > h2').addClass('__title');
		var split = text.split(' ');
		var firstLetter = split[0];
		var rest = split.splice(1,split.length)
		$('.related.products > h2').html('<span>' + firstLetter +'</span> ' + rest.join(''));
		$('.related.products > h2').wrap('<div class="section-headinging"></div>');

	}
	$(document).ready(function() {

		/* wrapRelatedTitle
		================================================== */
		_wrapRelatedTitle();
		
    function wixiShopRelatedSlider() {
        $('.thm-swiper__slider2').each(function () {
            const options = JSON.parse(this.dataset.swiperOptions);
            let mySlider = new Swiper($(this), options);
        });
    }
    wixiShopRelatedSlider();

	});
}(jQuery));
