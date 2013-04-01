
$(document).ready(function() {
    var all_load = false;
    var current_item_pos =$('.content').offset().top;
    var review_pos;
    var is_loaded = false;
    var load =false;

    $(window).scroll(function() {
         review_pos = $(window).scrollTop()+$(window).height() + $(window).scrollTop();
         node = $("#node").val();
         items = $(".item").size();
         if (items<8) {is_loaded=true;}
            if (current_item_pos  < review_pos && !is_loaded) {

						if (load==false){

						load = true;
						 $('<div></div>', {
                    id: "loader",
                    style: "float: left; width: 100%; height: 40px;" +
                "margin: 50px auto; border: solid 1px peru;" +
                "background: url(/images/circle_loader_site.gif) no-repeat center;"
                }).appendTo(".content");
							$.ajax({
									url: "/products/ajax",
									data: {item_id:items, node:node},
									dataType : "script",
									success : function (html){
										load=false;
										if (html.length<60) is_loaded=true;
									}
							});
					}
      }
	});
});

