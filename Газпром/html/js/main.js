$(function () {
  $('#jstree').jstree({
    "core": {
      "dblclick_toggle": false
    },
  }).bind('dblclick.jstree', function (event) {
    var node = $(event.target).closest("li");
    var data = node.data("jstree");
    console.log(node)
    console.log(data)
  });

  $('.close').on('click', function() {
    $('.popup').hide();
    if ( $('.item-column.column-last').hasClass('position') ) {
      $('.position').removeClass('position');
    }
  });

  $('.total-price input[type=submit]').on('click', function(e) {
    e.preventDefault();

    $('#popup_mail').show();
  });

  $(document).ready(function() {
    $('.btn-number').on('click', function(e){
      e.preventDefault();

      var $button = $(this),
        oldValue = $button.parent().find(".input-number").val();

      if ($button.text() == "+") {
        var newVal = parseFloat(oldValue) + 1;
      } else {
        if (oldValue > 0) {
          var newVal = parseFloat(oldValue) - 1;
        } else {
          newVal = 0;
        }
      }

      $button.parent().find("input.input-number").val(newVal);
    });
  });

  function resize() {
    var windowHeight = $(window).height(),
      headerHeight = $('.header').height() + 1,
      titleHeight = $('.title-column').height() + 1;
    $('.wrapper').css({
      height: windowHeight - headerHeight
    });
    $('.content').css({
      height: windowHeight - headerHeight - titleHeight
    });
    $('.middle').css({
      lineHeight: windowHeight - headerHeight+'px'
    })
  }

  $(window).load(function(){
    $(".content").mCustomScrollbar({
      setHeight: 500,
      scrollButtons: {
        enable: false
      },
      autoDraggerLength: false
    });

    resize();
  });

  $(window).resize(function() {
    resize();
  })
});