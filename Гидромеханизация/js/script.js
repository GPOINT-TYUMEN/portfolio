Cufon.set('fontFamily','Plumb');
Cufon.replace('.header .menu ul li');
Cufon.replace('.index .block-promo div span');
Cufon.set('fontFamily','Myriad Pro');
Cufon.replace('.block-gallery .block .head');
Cufon.replace('.colum-left .block-text h2');

$(window).load(function() {
    $('#slider').nivoSlider({
			effect: 'fade',
			directionNav: false,
			controlNav: false,
			keyboardNav: false,
		});
});