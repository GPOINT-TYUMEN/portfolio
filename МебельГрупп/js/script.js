Cufon.set('fontFamily','DaxlinePro-Regular');
Cufon.replace('.block-index .furniture .text');
Cufon.replace('.block-text .prev');
Cufon.replace('.block-text .catalog .menu ul li a');
Cufon.replace('.block-text h3');
Cufon.replace('.block-price .head', { textShadow: '0 1px 2px #86ae18'});
Cufon.replace('.block-price ul li p');
Cufon.replace('.block-header-about .title');
Cufon.replace('.block-header-price .title');
Cufon.replace('.block-header-one .title');
Cufon.replace('.block-header-catalog .title');
Cufon.replace('.block-header-developers .title');
Cufon.replace('.block-header-contacts .title');
Cufon.set('fontFamily','Nokia Sans S60');
Cufon.replace('.block-about h2');
Cufon.replace('.footer .block-footer .phone .code');
Cufon.replace('.footer .block-footer .phone .tel');
Cufon.replace('.block-header-one .gallery .img div');
Cufon.replace('.block-text h2');
Cufon.replace('.block-text h1');
Cufon.replace('.block-offers h2');
Cufon.replace('.block-header-contacts .gallery .img div');
Cufon.replace('.block-header-catalog .gallery .img div');
Cufon.replace('.block-header-about .gallery .img div');
Cufon.replace('.colum-right .block-adress .phone');

jQuery(document).ready(function() {
    $('#mycarousel').jcarousel();
	$('#carousel-catalog').jcarousel({
			scroll: 1
		});
	$('#carousel').jcarousel({
			scroll: 1
		});
	$('#carousel-view').jcarousel({
			scroll: 1
		});
	$('.carousel-about').jcarousel({
		scroll: 1
	});
	$('#carousel-about-2').jcarousel({
		scroll: 1
	});
});