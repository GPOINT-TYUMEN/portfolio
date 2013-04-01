var animation_phase = 0;
var is_mouse_out = false;

function animation_begin() {
	if(animation_phase == 0) {
		$("#children_small").animate({width: "95px"}, 0, function(){
			animation_phase = 1;
			$("#children_small").transition({rotate: "13deg"},200,function(){
				$("#children_small").fadeOut(0);
				$("#children_normal").fadeIn(0).animate({
					left: "-2px",
					width: "142px",
					top: "-8px"
				},1000, check_mouse);
			});
		});
	} else {
		is_mouse_out = false;
	}
}	

function check_mouse() {
	animation_phase = 2;
	if(is_mouse_out == true) {
		animation_end();
	}
}

function animation_end() {
	if(animation_phase == 2) {
		animation_phase = 3;
		$("#children_normal").animate({
			left: "45px",
			width: "92px",
			top: "55px"
		},500);
		$("#children_normal").fadeOut(0,function(){
			$("#children_small").fadeIn(0);
			$("#children_small").transition({rotate: "0deg"}, 400, function(){
				$("#children_small").animate({width: "96px"}, 500, function() {
					animation_phase = 0;
				});
			});
		});
	} else {
		is_mouse_out = true;
	}
}