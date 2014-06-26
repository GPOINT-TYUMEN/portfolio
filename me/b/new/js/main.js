var order = $("#order");
var priceQ = $("#priceQuote");

$(document).ready(function() {
	$(".fancybox").fancybox();
	
	$(".popup .close").on("click", function() {
		$(this).parent().parent().parent().parent().hide();
	});

	$('#priceQuote').costEstimatr();
})

function order_show() {
	order.show();
}

function price() {
	priceQ.toggle("blind", 1000);
}
