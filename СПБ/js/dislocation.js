$("#dislocation").click(function(){
	if ( $(".block-dislocation").hasClass("active") ) {
		$(".block-dislocation").removeClass("active").find("form").hide("blind", 500);
	} else {
		$(".block-dislocation").addClass("active").find("form").show("blind", 500);
	}
});

$("#order").click(function(){
	if ( $(".block-order").hasClass("active") ) {
		$(".block-order").removeClass("active").find("form").hide("blind", 500);
	} else {
		$(".block-order").addClass("active").find("form").show("blind", 500);
	}
});