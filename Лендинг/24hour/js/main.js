var order = $("#order");
var callback = $("#callback");

$(document).ready(function() {
	$(".fancybox").fancybox();
	
	$(".popup .close").on("click", function() {
		$(this).parent().parent().parent().parent().hide();
	});
})

function order_show() {
	order.show();
}

function callback_show() {
	callback.show();
}
