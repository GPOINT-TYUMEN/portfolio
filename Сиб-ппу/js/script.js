function resize(){
	var wight = 1180;
	var height = 398;
	var wh = wight / height;
	var real_wight = $(window).width();
	var real_height = real_wight / wh;
	if (real_wight <= wight) {
		$(".carousel ul li").each(function() {
			$(this).css("width", parseInt(real_wight) - 20);
			$(this).css("height", parseInt(real_height));
		});
		$("#index").css("height", parseInt(real_height));
		$(".carousel .bg-center .caroufredsel_wrapper").css("width", parseInt(real_wight) - 20);
		$(".carousel .bg-center .caroufredsel_wrapper").css("height", parseInt(real_height));
		$(".carousel .bg-center").css("width", parseInt(real_wight) - 20);
		$(".carousel .bg-center").css("height", parseInt(real_height));
	} else {
		$(".carousel ul li").each(function() {
			$(this).css("width", wight);
			$(this).css("height", height);
		});
		$("#index").css("height", height);
		$(".carousel .bg-center .caroufredsel_wrapper").css("width", wight);
		$(".carousel .bg-center .caroufredsel_wrapper").css("height", height);
		$(".carousel .bg-center").css("width", wight);
		$(".carousel .bg-center").css("height", height);
	}
};

$(document).ready(function(){

	Cufon.set('fontFamily','Plumb');
	Cufon.replace('.block-menu .menu ul li a');
	Cufon.replace('.block-promo .title .head .text', { textShadow: '3px 3px 0 #0e0d0e'});
	Cufon.replace('.block-promo .title-blue .head .text', { textShadow: '3px 3px 0 #001f48'});
	Cufon.replace('.block-partner .title .head .text', { textShadow: '3px 3px 0 #0e0d0e'});
	Cufon.replace('.block-text .block-title .left-title .title-bg .bg-right h2', { textShadow: '3px 3px 0 #777'});
	Cufon.replace('.block-text .block-text-b .title .h h3', { textShadow: '3px 3px 0 #777'});
	Cufon.set('fontFamily','Myriad Pro');
	Cufon.replace('.block-menu .menu .mail a');
	Cufon.replace('.block-promo .block-product .product span', { textShadow: '1px 1px 0 #a31000'});
	Cufon.replace('.block-promo .block-application .application span', { textShadow: '1px 1px 0 #0038ac'});
	Cufon.set('fontFamily','PlumbCondensed');
	Cufon.replace('.block-header .header .block-logo .slogan', { textShadow: '1px 4px 4px #000'});

	resize();
	$(window).resize(function() {
		resize();
	});
});

$(window).load(function(){
	/*$("#carousel").carouFredSel({
		curcular: false,
		infinite: false,
		auto: false,
		pagination: "#carousel-pag"
	});*/

	$("#text-carousel").carouFredSel({
		curcular: false,
		infinite: false,
		auto: false,
		pagination: "#text-carousel-pag"
	});

	$("#partner").carouFredSel({
		curcular: false,
		infinite: false,
		auto : false,
		prev : {
			button	: "#partner-prev",
			key		: "left"
		},
		next : {
			button	: "#partner-next",
			key		: "right"
		}
	});
});