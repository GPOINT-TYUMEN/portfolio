$(document).ready(function() {
	$("#carousel").carouFredSel({
		width: 990,
		height: 265,
		items: {
			visible: 5,
			minimum: 5,
			width: 194,
			height: 265
		},
		scroll: {
			pauseOnHover: true,
			items: 5
		},
		auto: 5000,
		pagination: ".pagination"
	});
})

$(".carousel .item .img").click(function(){
	$(this).transition({
		perspective: '1000',
		rotateY: '180deg'
	}, function() {
		$(this).hide();
		$(this).parent().find(".text").transition({
			perspective: '1000',
			rotateY: '0deg'
		}).show();
	});
});

$(".carousel .item .text").click(function(){
	$(this).transition({
		perspective: '1000',
		rotateY: '180deg'
	}, function() {
		$(this).hide();
		$(this).parent().find(".img").transition({
			perspective: '1000',
			rotateY: '0deg'
		}).show();
	});
})
