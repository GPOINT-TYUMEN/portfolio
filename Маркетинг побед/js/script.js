$(document).ready(function(){
	Cufon.set('fontFamily', 'Plumb');
	Cufon.replace('h2');
	Cufon.replace('.block .title');
	Cufon.replace('.item .block .text h3');
	Cufon.replace('.popup .title');

	$("a.register").click(function(){
		$("div.substrate").show();
	});
	$("a.close").click(function(){
		$("div.substrate").hide();
	});
});