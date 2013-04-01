$(document).ready(function(){
	$("div#unit1").css({
		width: "1",
		left: "150px",
		top: "257px",
		borderWidth: "0"
	});
	$("div#unit2").css({
		width: "1",
		left: "450px",
		top: "80px",
		borderWidth: "0"
	});
	$("div#unit3").css({
		width: "5",
		left: "820px",
		top: "130px",
		borderWidth: "0"
	});
	$("div#unit4").css({
		width: "1",
		left: "370px",
		top: "607px",
		borderWidth: "0"
	});
	$("div#unit5").css({
		width: "1",
		left: "440px",
		top: "546px",
		borderWidth: "0"
	});
	$("div#unit6").css({
		width: "1",
		left: "700px",
		top: "311px",
		borderWidth: "0"
	}); 
	
	$(".fon-tree img").transition({rotate: "36000deg"},5000000,'linear');
	
	function animateBackground1() {
	    $(".fon-one").animate(
	      { opacity: .1 },
	      2500,
	      function() {
	        $(".fon-one").animate(
	          { opacity: 1 },
	          1500
	        );
	        animateBackground1();
	      }
	    );
	  };
	
	  function animateBackground2() {
	    $(".fon-two").animate(
	      { opacity: .1 },
	      1500,
	      function() {
	        $(".fon-two").animate(
	          { opacity: 1 },
	          2500
	        );
	        animateBackground2();
	      }
	    );
	  };
	  
	  function animateBackground3() {
	    $(".fon-tree").animate(
	      { opacity: .1 },
	      2500,
	      function() {
	        $(".fon-tree").animate(
	          { opacity: 1 },
	          3500
	        );
	        animateBackground3();
	      }
	    );
	  };
	
	animateBackground1();
	animateBackground2();
	animateBackground3();
});

	

  function FuckingCosmicRay(){
		var t = $(this);
		t.clone().removeAttr('id').html('').css({ height: t.height(), width: t.width(), 'background': 'rgba(255,255,255,.2)', 'border': "rgba(255,255,255,.2)", "box-shadow":"0 0 10px 5px rgba(255,255,255,.2)" }).insertBefore(t).fadeOut(1000, function(){ $(this).remove() });
  }

	$(window).bind("load", function() {
		$("div#unit1").animate({
			width: "198",
			left: "199px",
			top: "134px",
			borderWidth: "2px"
		},{
		  duration: 1000,
		  easing: 'linear',
		  step: FuckingCosmicRay
		});

		$("div#unit2").animate({
			width: "198",
			left: "397px",
			top: "134px",
			borderWidth: "2px"
		},{
		  duration: 1200,
		  easing: 'linear',
		  step: FuckingCosmicRay
		});

		$("div#unit3").animate({
			width: "198",
			left: "595px",
			top: "134px",
			borderWidth: "2px"
		},{
		  duration: 1100,
		  easing: 'linear',
		  step: FuckingCosmicRay
		});

		$("div#unit4").animate({
			width: "198",
			left: "199px",
			top: "332px",
			borderWidth: "2px"
		},{
		  duration: 1300,
		  easing: 'linear',
		  step: FuckingCosmicRay
		});

		$("div#unit5").animate({
			width: "198",
			left: "397px",
			top: "332px",
			borderWidth: "2px"
		},{
		  duration: 1500,
		  easing: 'linear',
		  step: FuckingCosmicRay
		});

		$("div#unit6").animate({
			width: "198",
			left: "595px",
			top: "332px",
			borderWidth: "2px"
		},{
		  duration: 1600,
		  easing: 'linear',
		  step: FuckingCosmicRay
		});
	});
	

