(function($){
  $(window).load(function(){
    $(".content").mCustomScrollbar();

    eventsInline = [{ "date": "2015-04-19 17:30:00", "type": "meeting", "title": "27 сентября – 12 октября", "description": "\"Шаг вперед\" 3 летняя смена", "url": "#" },{ "date": "2015-04-19 16:30:00", "type": "meeting", "title": "6–26 августа", "description": "\"Твой ход\" 4 летняя смена", "url": "#" },{ "date": "2015-04-19 15:30:00", "type": "meeting", "title": "28–30 августа", "description": "VII областной фестиваль методических идей \"Дорогой открытий\"", "url": "#" },{ "date": "2015-04-19 15:30:00", "type": "meeting", "title": "28–30 августа", "description": "VII областной фестиваль методических идей \"Дорогой открытий\"", "url": "#" },{ "date": "2015-04-19 15:30:00", "type": "meeting", "title": "28–30 августа", "description": "VII областной фестиваль методических идей \"Дорогой открытий\"", "url": "#" }];
  	$('.item-block--calendar').eventCalendar({
			jsonData: eventsInline,
			cacheJson: false,
			monthNames: [ "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь",	"Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь" ],
			dayNames: [ 'Воскресение','Понедельник','Вторник','Среда',
			'Четверг','Пятница','Суббота' ],
			dayNamesShort: [ 'Вс','Пн','Вт','Ср', 'Чт','Пт','Сб' ],
			txt_noEvents: "Нет событий за выбранный период",
			txt_loading: "загрузка...",
			txt_SpecificEvents_after: "events:",
			txt_NumAbbrevTh: "",
			txt_NumAbbrevSt: "",
			txt_NumAbbrevNd: "",
			txt_NumAbbrevRd: "",
			eventsScrollable: true,
			jsonDateFormat: "human",
			showDescription: true,
			eventsLimit: 30
		});
  });

  $(document).ready(function() {
  	$('.owl-best').owlCarousel({
      loop: true,
      nav: true,
      items: 1
    });

    $('.owl-felicitation').owlCarousel({
      loop: true,
      nav: true,
      items: 1,
      dots: false
    });

    $('.owl-leader').owlCarousel({
      loop: true,
      nav: true,
      items: 3,
      dots: false
    });

    $('.owl-partners').owlCarousel({
      loop: true,
      nav: true,
      items: 4,
      dots: false
    });
  })
})(jQuery);