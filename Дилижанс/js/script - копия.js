Cufon.set('fontFamily','Markiz de Sad script');
Cufon.replace('.header .slogan');
Cufon.set('fontFamily','Nokia Sans S60');
Cufon.replace('.header .phone .code');
Cufon.replace('.header .phone .tel');
Cufon.replace('.carousel .jcarousel-clip li .info p');
Cufon.replace('.container h2');
Cufon.replace('.block-proposal .our-proposal .order a');
Cufon.replace('.block-reviews .head .link a');

function mycarousel_initCallback(carousel) {
    jQuery('.jcarousel-control a').bind('click', function() {
        carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
        return false;
    });

};

	jQuery(document).ready(function() {
		jQuery("#mycarousel").jcarousel({
			initCallback: mycarousel_initCallback,
			scroll: 1,
			buttonNextHTML: null,
			buttonPrevHTML: null
		});
		
	$('#print_button').click(function(){
			$('#myPrintArea').jqprint();
		});

    $("#button").click(function(){
        $(".shadow").show();
		
        $(".form").animate({
            height: "50px",
            top: "450px"
        }, 500);
        
        setTimeout(function() {
            $("#form").hide();
			$(".form p.button").hide();
            $(".thanks").show();
        }, 500);
        
        return false;
    });
	
});