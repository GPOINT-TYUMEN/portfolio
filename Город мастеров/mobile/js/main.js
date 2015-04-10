$(document).ready(function() {
  $('.style').styler();

  $('.owl-carousel').owlCarousel({
    loop: true,
    nav: true,
    margin: 17,
    items: 5,
    dots: false,
    navText: ''
  });

  $('.owl-carousel-footer').owlCarousel({
    loop: true,
    nav: true,
    margin: 39,
    items: 3,
    dots: false,
    navText: ''
  })
})
