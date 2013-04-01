Cufon.set('fontFamily', 'Plumb');
Cufon.replace('.header .phone .code');
Cufon.replace('.header .phone .tel');
Cufon.replace('.block-promo .block .img div');
Cufon.set('fontFamily', 'AvantGardeCTT');
Cufon.replace('.left-colum .news h3');
Cufon.replace('.left-colum .poll h3');
Cufon.replace('.left-colum .poll .vote a');
Cufon.replace('.right-colum .item-catalog h2');
Cufon.replace('.right-colum .block-catalog h2');
Cufon.replace('.right-colum .block-catalog h3');
Cufon.replace('.right-colum .catalog-category h2');
Cufon.replace('.left-colum .point .text');
Cufon.replace('.right-colum .office h2');
Cufon.replace('.right-colum .block-shop h2');
Cufon.replace('.right-colum .master-class .head');
Cufon.replace('.right-colum .master-class-view h2');

jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel({
    	wrap: 'circular',
		scroll: 1,
    });
	
	$('.menu .catalog a').hover(
		 function () {
			 $('.submenu').show();
		 }
	);
	$('ul.submenu').hover(
		function () {
			 $('.submenu').show();
		 },
		function () {
			 $('.submenu').hide();
		 }
	);
	$('.popup-item .close').click(
		function () {
			$('.popup-item').hide();
		}
	);

});