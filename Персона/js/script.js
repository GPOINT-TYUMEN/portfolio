$(document).ready(function(){
    Cufon.set('fontFamily','Palatino Linotype');
    Cufon.replace('.header .phone .code');
    Cufon.replace('.header .phone .tel');

  $("#foo").carouFredSel({
  	auto : false,
    items: 1,
  	prev : {
  		button	: "#foo_prev",
  		key		: "left"
  	},
  	next : {
  		button	: "#foo_next",
  		key		: "right"
  	},
  	pagination	: "#foo_pag"
  });

  $("#kitchen-classic").carouFredSel({
  	auto : false,
    items: 1,
  	prev : {
  		button	: "#classic_prev",
  		key		: "left"
  	},
  	next : {
  		button	: "#classic_next",
  		key		: "right"
  	}
  });

  $("#kitchen-new").carouFredSel({
  	auto : false,
    items: 1,
  	prev : {
  		button	: "#new_prev",
  		key		: "left"
  	},
  	next : {
  		button	: "#new_next",
  		key		: "right"
  	}
  });

  $("#kitchen-modern").carouFredSel({
  	auto : false,
    items: 1,
  	prev : {
  		button	: "#modern_prev",
  		key		: "left"
  	},
  	next : {
  		button	: "#modern_next",
  		key		: "right"
  	}
  });

  $("#news").carouFredSel({
  	auto : false,
    items: 1,
    infinite: false,
    circular: false,
  	prev : {
  		button	: "#news_prev",
  		key		: "left"
  	},
  	next : {
  		button	: "#news_next",
  		key		: "right"
  	}
  });

  $("#feedback").carouFredSel({
  	auto : false,
    items: 1,
    infinite: false,
    circular: false,
  	prev : {
  		button	: "#feedback_prev",
  		key		: "left"
  	},
  	next : {
  		button	: "#feedback_next",
  		key		: "right"
  	}
  });
});