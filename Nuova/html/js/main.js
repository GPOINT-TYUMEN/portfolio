$(document).ready(function() {
  $('.owl-carousel').owlCarousel({
    loop: true,
    items: 1,
    nav: true,
    dots: false,
    center: true,
    autoplay: true,
    autoplayHoverPause: false,
    autoplayTimeout: 3000
  });

  $('.owl-review').owlCarousel({
    loop: true,
    items: 3,
    nav: true,
    dots: false,
    center: true,
    autoplay: true,
    autoplayHoverPause: false,
    autoplayTimeout: 5000
  });

  $('.hide-out').hide();

  var showDiv = function(){
    $('.hide-out').show();
  };

  var timeOut = setTimeout(showDiv, 8000);
  $('body').mousemove(function() {
    if ( !$('body').hasClass('submit-form') ) {
      clearTimeout(timeOut);
      $('.hide-out').hide();
      timeOut = setTimeout(showDiv, 8000);
    } else {
      $('.hide-out').hide();
    }
  });

})
