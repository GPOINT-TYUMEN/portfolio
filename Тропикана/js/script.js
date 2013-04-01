$(document).ready(function(){
	
/*var newnews = $("<ul>").attr("class", "newsticker");
newnews.append("<li><a href='#'>Пресс-релиз «Юридическое и налоговое консультирование».</a></li>");
newnews.append("<li><a href='#'></a>ХI Открытый региональный конкурс управленческого мастерства «Молодые ТОП - менеджеры Урала.</li>");
newnews.append("<li><a href='#'>В Ханты-Мансийске подвели итоги Чемпионата мира по биатлону 2011.</a></li>");
newnews.append("<li><a href='#'>Генеральный консул Великобритании в Екатеринбурге посетил Управляющую компанию «ПАРТИКОМ»</a></li>");
newnews.appendTo("#news").newsTicker();*/

var i = 0;

/*
        <td id="m1"><div class="TMAL"><div class="TMAR"><div class="TMLP"><a href="/about/">О компании</a></div></div></div></td>
        <td id="m2"><div class="TMAL"><div class="TMAR"><div class="TMLP"><a href="/trade/">Продажа и аренда</a></div></div></div></td>
        <td id="m3"><div class="TMAL"><div class="TMAR"><div class="TMLP"><a href="/projects/">Проекты</a></div></div></div></td>
        <td id="m4"><div class="TMAL"><div class="TMAR"><div class="TMLP"><a href="/press/">Пресс-центр</a></div></div></div></td>
        <td id="m5"><div class="TMAL"><div class="TMAR"><div class="TMLP"><a href="/contacts/">Контакты</a></div></div></div></td>

*/

	$('#m1').click(function(){
		document.location="/about/";
	});
	$('#m2').click(function(){
		document.location="/trade/";
	});
	$('#m3').click(function(){
		document.location="/projects/";
	});
	$('#m4').click(function(){
		document.location="/press/";
	});
	$('#m5').click(function(){
		document.location="/contacts/";
	});

	$('#AR').click(function(){
		$(this).css("backgroundPosition","0 0");
		if (i<3) i++; else i=0;
		ml=-i*975;
		ml2=-i*380;
		$('#IllustrationShifter').stop().animate({marginLeft: ml},250);
		$('#TextShifter').stop().animate({marginLeft: ml2},250);
	});
	
	$('#AL').click(function(){
		$(this).css("backgroundPosition","0 0");
		if (i>0) i--; else i=3;
		ml=-i*975;
		ml2=-i*380;
		$('#IllustrationShifter').stop().animate({marginLeft: ml},250);
		$('#TextShifter').stop().animate({marginLeft: ml2},250);
	});
	
	$('#AR').mouseenter(function(){
		$(this).css("backgroundPosition","0 -58px");
	}).mouseleave(function(){
		$(this).css("backgroundPosition","0 0");
	}).mousedown(function(){
		$(this).css("backgroundPosition","0 -176px");	
	});

	
	$('#AL').mouseenter(function(){
		$(this).css("backgroundPosition","0 -58px");
	}).mouseleave(function(){
		$(this).css("backgroundPosition","0 0");
	}).mousedown(function(){
		$(this).css("backgroundPosition","0 -176px");	
	});

	$("#news").newsticker();
	


function resize()
{
	w=$(window).width();
	if (w<1200) w=1200;
//	w=$('#Canvas').width();
	$('body').css('width', w);
	$('html').css('width', w);

//	h=$('body').height();
//	$('#Canvas').css('height', h);
		
	
}

	resize();
	
	$(window).resize(function(){resize();});

});

