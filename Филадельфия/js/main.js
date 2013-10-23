$(".header .menu a").click(function() {
	$(".header .menu li").removeClass("active");
	$(this).parent().addClass("active");
})
