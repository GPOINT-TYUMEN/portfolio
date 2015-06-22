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

  $('#timetable').on('click', function() {
    $('.item-block--timetable').toggle();
    $(this).parent().parent().toggleClass('current');
  })

  $(document).ready(function() {
    $('.js-close').on('click', function(e) {
      e.preventDefault();
      $('.popup').addClass('hidden');
    });

    $('.js-resume').on('click', function(e) {
      e.preventDefault();
      $('.popup--resume').removeClass('hidden');
    })

    setTimeout(function() {
      $('input, select').styler();
    }, 100)

  	$('.owl-best').owlCarousel({
      loop: true,
      nav: true,
      items: 1
    });

    $('.owl-all').owlCarousel({
      loop: true,
      nav: true,
      items: 1
    });

    $('.owl-only-dots').owlCarousel({
      loop: true,
      nav: false,
      items: 1,
      dots: true
    });

    $('.owl-felicitation').owlCarousel({
      loop: true,
      nav: true,
      items: 1,
      dots: false,
      animateOut: 'fadeOut'
    });

    $('.owl-leader').owlCarousel({
      loop: true,
      nav: true,
      items: 3,
      dots: false
    });

    $('.owl-not-dots-three').owlCarousel({
      loop: true,
      nav: true,
      items: 3,
      dots: false
    });

    $('.owl-not-dots-four').owlCarousel({
      loop: true,
      nav: true,
      items: 4,
      dots: false
    });

    $('.owl-not-dots-five').owlCarousel({
      loop: true,
      nav: true,
      items: 5,
      dots: false
    });

    $('.owl-partners').owlCarousel({
      loop: true,
      nav: true,
      items: 4,
      dots: false
    });

    $('.owl-gallery').owlCarousel({
      loop: true,
      nav: true,
      items: 5,
      dots: false
    });

    $('#accordion').accordion();

    $('.tabs .item-block--tab a').on('click', function(e) {
      e.preventDefault();
      var $this = $(this),
        tab = $this.attr("href");

      $this.closest('.clearfix').find('a').removeClass("current");
      $this.addClass("current");

      $this.parent().parent().parent().parent().find(".item-block--100").addClass("hidden");
      $(tab).removeClass("hidden");
    });

    $('#vacancy .item-block--links a').on('click', function(e) {
      e.preventDefault();
      var $this = $(this),
        tab = $this.attr("href");

      $('#vacancy .item-block--links a').removeClass("current");
      $this.addClass("current");

      $(".item-block--text-tabs").addClass("hidden");
      $(tab).removeClass("hidden");
    });

    $('#maps').on('click', function(e) {
      e.preventDefault();
      $(this).parent().toggleClass('item-block--maps--open');
    });

    $('.item-block--about-gallery').magnificPopup({
      delegate: 'a',
      type: 'image',
      tLoading: 'Загрузка изображений #%curr%...',
      mainClass: 'mfp-img-mobile',
      gallery: {
        enabled: true,
        navigateByImgClick: true,
        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
      },
      image: {
        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
      }
    });

  })
})(jQuery);