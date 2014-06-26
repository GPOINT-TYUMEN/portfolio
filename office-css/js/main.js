$(document).ready(function(){
	var isMobile={
		Android:function(){
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry:function(){
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS:function(){
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera:function(){
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows:function(){
			return navigator.userAgent.match(/IEMobile/i);
		},
		any:function(){
			return(isMobile.Android()||isMobile.BlackBerry()||isMobile.iOS()||isMobile.Opera()||isMobile.Windows());
		}
	};

	$('#logo').hoverIntent(function(){
		$(this).parent().find('#logoh-arrow').stop(true,false).animate({"left":0,"top":0},250);
		$(this).parent().find('#logoh-text').stop(true,false).delay(200).animate({"opacity":1},400);
	},
	function(){
		$(this).parent().find('#logoh-text').stop(true,false).animate({"opacity":0},250);
		$(this).parent().find('#logoh-arrow').stop(true,false).delay(250).animate({"left":-139,"top":20},250);
	});

	var animCookie=$.cookie("psdgator_anim");

	if(!animCookie){

		$(window).load(function(){
			$('#logo').delay(300).parent().find('#logoh-arrow').stop(true,false).animate({"left":0,"top":0},250);
			$('#logo').delay(300).parent().find('#logoh-text').stop(true,false).delay(200).animate({"opacity":1},400);
		});

		setTimeout(function(){
			$('#logo').parent().find('#logoh-text').stop(true,false).animate({"opacity":0},250);
			$('#logo').parent().find('#logoh-arrow').stop(true,false).delay(250).animate({"left":-139,"top":20},250);
		},5000);
		
		$.cookie("psdgator_anim",1,{
			expires:30
		});
	}

	if(!$('body').hasClass('simple-page')){
		$('nav ul').onePageNav({
			currentClass:'on',
			changeHash:true,
			scrollThreshold:0.3
		});
	}
	
	var $container=$('#projects');

	$(".project a").fancybox();

	function isotopeProjects(){
		if($(window).width()>960){
			var num_cols=4;
			var margin=20;
		} else if($(window).width()>=728){
			var num_cols=3;
			var margin=20;
		} else {
			var num_cols=2;
			var margin=12;
		}
	
	var colWidth=Math.floor($container.width()/num_cols);

	$('.project, .project a').css({
		"width":colWidth-margin-15,
		"height":colWidth-margin-15
	});

	$container.imagesLoaded(function(){
		$container.isotope({
			filter:'*',
			resizable:false,
			animationOptions:{
				duration:750,
				easing:'linear',
				queue:false},
				masonry:{
					columnWidth:colWidth
				}
			});
		});
	}

	$('#filters a').click(function(){
		$('#filters a').parent().removeClass('on');
		$(this).parent().addClass('on');

		var selector=$(this).attr('data-filter');

		$container.isotope({
			filter:selector
		});
		return false;
	});

	if($('html').hasClass('lt-ie9'))
		isotopeProjects();
	if(/Opera/.test(navigator.userAgent)){
		$(".project img").each(function(i,elem){
			var img=$(elem);

			$(this).parent().css({
				background:"url("+ img.attr("src")+") no-repeat"
			});
			img.remove();
		});
	}
	if(!$('html').hasClass('lt-ie8')){
		$('.faq-list dt').click(function(){
			if($(this).next().is(':visible')==false){
				$('.faq-list dt').removeClass('open');
				$(this).addClass('open');
				$('.faq-list dd').slideUp();
				$(this).next().slideDown();
			} else {
				$(this).next().slideUp();
				$(this).removeClass('open');
			}
			return false;
		});
	}
	
	$('.acc-title').click(function(){
		if($(this).next().is(':visible')==false){
			$('.acc-cont').slideUp();
			$(this).next().slideDown();
		} else {
			$(this).next().slideUp();
		}
		return false;
	});

	$('.acc-title').eq(0).trigger('click');

	$('#services-menu a').click(function(){
		if($('#services-cont').is(":hidden")){
			$('#services-cont').show();
			$('#that-simple').hide();
		}
		$('.tab').removeClass('open');
		$($(this).attr('href')).addClass('open');
		$('#services-menu li').removeClass('on');
		$(this).parent().addClass('on');
		$('#services-cont').animate({
			"height":$($(this).attr('href')).height()
		},300,function(){
			if($('html').hasClass('lt-ie9')){
				$('.section-title h1').redraw();
			}
		});
		return false;
	});

	$('.menu-link').click(function(){
		$(this).toggleClass('active');
		$('header nav').toggleClass('active');
		return false;
	});

	$('input, textarea').placeholder();

	$('.big-submit-button, .portfolio-btn').click(function(){
		$("html,body").animate({
			scrollTop:$($(this).attr('href')).offset().top
		},600);
		return false;
	});

	$('.back_top').click(function(){
		$("html,body").animate({scrollTop:0},1000);
		return false;
	});

	var loader=$('.formloader');

	$(document).ajaxStart(function(){
		loader.show();
	}).ajaxStop(function(){
		loader.fadeOut();
	}).ajaxError(function(a,b,e){
		throw e;
	});

	function clearForm(form){
		setTimeout(function(){
			$(form).each(function(){
				this.reset();
			});
		},2000);

		_gaq.push(['_trackEvent','Form','Submission','Success'])
	};
	var v=$("#request-quote").validate({
		submitHandler:function(form){
			$(form).ajaxSubmit({
				target:"#form-result",
				success:clearForm("#request-quote")
			});
		},
		rules:{
			name:{
				required:true,
				minlength:3
			},
			message:{
				required:true,
				minlength:3
			}
		}
	});
	
	function createUploader(){
		var uploader=new qq.FileUploader({
			element:document.getElementById('upload-files'),
			action:'handleUploads.php',
			debug:false,
			onComplete:function(id,fileName,responseJSON){
				if($('#file_name').val()=="")
					$('#file_name').val($('#file_name').val()+ fileName);
				else
					$('#file_name').val($('#file_name').val()+'/'+ fileName);
			},sizeLimit:200000000
		});
	}

	window.onload=createUploader;
	
	$.jStyling.createSelect($('select'));

	if(isMobile.iOS()){
		$(document).on('focus','input, textarea',function(){
			$('#top').css({
				position:'absolute'
			});
		});

		$(document).on('blur','input, textarea',function(){
			$('#top').css({
				position:'fixed'
			});
		});
	}

	$(window).smartresize(function(){
		if(!$('html').hasClass('lt-ie9'))
			isotopeProjects();
	}).smartresize();
});