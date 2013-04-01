/*domReady(function()
{
    var instance = new ImageFlow();
    instance.init({ ImageFlowID: 'myImageFlow', startID:  3, imageFocusM: 1.0 });

});*/
$(document).ready(function() {
    Cufon.set('fontFamily','PlumbCondensed');
    Cufon.replace('.title h2');
});

$(function(){
	$("#gallery").carouFredSel({
    	auto : false,
        items: 1,
    	prev : {
    		button	: "#gallery_prev",
    		key		: "left"
    	},
    	next : {
    		button	: "#gallery_next",
    		key		: "right"
    	},
    	pagination	: "#gallery_pag",
	});
});

$(function(){
	$("#main-carousel").carouFredSel({
	    	auto : false,
	        items: 1,
	    	prev : {
	    		button	: "#main-carousel-prev",
	    		key		: "left"
	    	},
	    	next : {
	    		button	: "#main-carousel-next",
	    		key		: "right"
	    	},
	    	pagination	: "#main-carousel-pag",
	});
});