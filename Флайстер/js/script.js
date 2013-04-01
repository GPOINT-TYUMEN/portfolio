Cufon.set('fontFamily','Nokia Sans S60');
Cufon.replace('.block-logo .logo .slogan a', { textShadow: '0 2px 1px #0182af'});

function mycarousel_initCallback(carousel) {
    jQuery('.jcarousel-control a').bind('click', function() {
        carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
        return false;
    });

};

	jQuery(document).ready(function() {
		jQuery("#mycarousel").jcarousel({
			initCallback: mycarousel_initCallback,
			scroll: 1,
			buttonNextHTML: null,
			buttonPrevHTML: null
		});
	
});