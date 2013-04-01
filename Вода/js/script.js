$(document).ready(function(){
	Cufon.set('fontFamily','PT Serif');
	Cufon.replace('.main .block-info .top .info .block-price div.price span.price');
	Cufon.replace('.block-form .block-order .block-info .top .info .block-price div.price span.price');
	Cufon.replace('.about-water .block-order .block-info .top .info .block-price div.price span.price');
	Cufon.replace('.block-form .block-product .total .price');

	$("#carousel-big").carouFredSel({
		infinite: false,
		scroll: {
			fx: "fade"
		},
		auto: false,
		prev: "#prev-big",
		next: "#next-big",
		pagination: "#pag-big"
	});

	$("#carousel-order").carouFredSel({
		infinite: false,
		scroll: {
			fx: "fade"
		},
		auto: false,
		//prev: "#prev-big",
		//next: "#next-big",
		//pagination: "#pag-big"
	});
});