$(document).ready(function() {
  Cufon.set('fontFamily','Palatino Linotype');
  Cufon.replace('.header .block-info .phone');

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

  $("#resident").carouFredSel({
  	auto : false,
    items: 1,
  	prev : {
  		button	: "#resident_prev",
  		key		: "left"
  	},
  	next : {
  		button	: "#resident_next",
  		key		: "right"
  	}
  });
  $("#photo").carouFredSel({
  	auto : false,
    items: 1,
  	prev : {
  		button	: "#photo_prev",
  		key		: "left"
  	},
  	next : {
  		button	: "#photo_next",
  		key		: "right"
  	}
  });
});
